import { vars, lang } from '../lib/vars.js'
import { siteUrl } from '../lib/url.js'
import { dayjs } from '../lib/date.js'

const MONTH_SEARCH_LIMIT = 2

let unavailableDatesBackup
let selectedDateStringBackup
let processingUnavailableDates = false
let searchedMonthStart
let searchedMonthCounter = 0

/**
 * Fetch available hours for a given date.
 */
export function getAvailableHours(selectedDate) {
    const availableHoursEl = document.getElementById('available-hours')
    const selectService = document.getElementById('select-service')
    const selectProvider = document.getElementById('select-provider')

    // Clear previous hours safely
    while (availableHoursEl.firstChild) {
        availableHoursEl.removeChild(availableHoursEl.firstChild)
    }

    const serviceId = selectService.value
    let serviceDuration = 15

    const service = (vars('available_services') || []).find(
        (s) => Number(s.id) === Number(serviceId),
    )

    if (service) {
        serviceDuration = service.duration
    }

    const appointmentId = vars('manage_mode') ? vars('appointment_data').id : null

    const url = siteUrl('booking/get_available_hours')

    const body = new URLSearchParams({
        csrf_token: vars('csrf_token'),
        service_id: selectService.value,
        provider_id: selectProvider.value,
        selected_date: selectedDate,
        service_duration: serviceDuration,
        manage_mode: Number(vars('manage_mode') || 0),
        appointment_id: appointmentId || '',
    })

    fetch(url, {
        method: 'POST',
        headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
        body,
    })
        .then((res) => res.json())
        .then((response) => {
            // Clear again safely
            while (availableHoursEl.firstChild) {
                availableHoursEl.removeChild(availableHoursEl.firstChild)
            }

            if (response.length > 0) {
                let providerId = selectProvider.value

                if (providerId === 'any-provider') {
                    for (const p of vars('available_providers') || []) {
                        if (p.services.indexOf(Number(serviceId)) !== -1) {
                            providerId = p.id
                            break
                        }
                    }
                }

                const provider = (vars('available_providers') || []).find(
                    (p) => Number(providerId) === Number(p.id),
                )

                if (!provider) {
                    throw new Error('Could not find provider.')
                }

                const providerTimezone = provider.timezone
                const selectedTimezone = document.getElementById('select-timezone').value
                const timeFormat = vars('time_format') === 'regular' ? 'h:mm a' : 'HH:mm'

                response.forEach((availableHour) => {
                    const availableHourDayjs = dayjs
                        .tz(selectedDate + ' ' + availableHour + ':00', providerTimezone)
                        .tz(selectedTimezone)

                    if (availableHourDayjs.format('YYYY-MM-DD') !== selectedDate) {
                        return
                    }

                    const btn = document.createElement('button')
                    btn.type = 'button'
                    btn.className =
                        'available-hour px-3 py-2 text-sm rounded-lg border border-gray-200 dark:border-gray-700 ' +
                        'text-gray-700 dark:text-gray-300 hover:border-accent hover:text-accent ' +
                        'dark:hover:border-accent dark:hover:text-accent transition-colors cursor-pointer'
                    btn.dataset.value = availableHour
                    btn.textContent = availableHourDayjs.format(timeFormat)
                    availableHoursEl.appendChild(btn)
                })

                if (vars('manage_mode')) {
                    const manageTimeFormat = vars('time_format') === 'regular' ? 'h:mm a' : 'HH:mm'
                    const appointmentTime = dayjs(vars('appointment_data').start_datetime).format(manageTimeFormat)

                    availableHoursEl.querySelectorAll('.available-hour').forEach((el) => {
                        el.classList.remove('selected-hour', 'bg-accent', 'text-white', 'border-accent')
                        if (el.textContent === appointmentTime) {
                            el.classList.add('selected-hour', 'bg-accent', 'text-white', 'border-accent')
                        }
                    })
                } else {
                    const firstHour = availableHoursEl.querySelector('.available-hour')
                    if (firstHour) {
                        firstHour.classList.add('selected-hour', 'bg-accent', 'text-white', 'border-accent')
                    }
                }

                // Trigger confirm frame update
                document.dispatchEvent(new CustomEvent('booking:updateConfirm'))
            }

            if (!availableHoursEl.querySelector('.available-hour')) {
                availableHoursEl.textContent = lang('no_available_hours')
            }
        })
}

/**
 * Register an appointment.
 */
export function registerAppointment() {
    const captchaText = document.querySelector('.captcha-text')

    if (captchaText) {
        captchaText.classList.remove('border-red-500')
        if (!captchaText.value) {
            captchaText.classList.add('border-red-500')
            return
        }
    }

    const postDataInput = document.querySelector('input[name="post_data"]')
    const formData = JSON.parse(postDataInput.value)

    const data = {
        csrf_token: vars('csrf_token'),
        post_data: formData,
    }

    if (captchaText) {
        data.captcha = captchaText.value
    }

    if (vars('manage_mode')) {
        data.exclude_appointment_id = vars('appointment_data').id
    }

    const url = siteUrl('booking/register')

    const overlay = document.createElement('div')
    overlay.className = 'fixed inset-0 bg-white/50 dark:bg-gray-950/50 z-50'
    document.body.appendChild(overlay)

    fetch(url, {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify(data),
    })
        .then((res) => res.json())
        .then((response) => {
            if (response.captcha_verification === false) {
                const captchaHint = document.getElementById('captcha-hint')
                if (captchaHint) {
                    captchaHint.textContent = lang('captcha_is_wrong')
                    captchaHint.style.opacity = '1'
                    setTimeout(() => {
                        captchaHint.style.opacity = '0'
                    }, 3000)
                }

                const refreshBtn = document.querySelector('.captcha-title button')
                if (refreshBtn) refreshBtn.click()

                if (captchaText) captchaText.classList.add('border-red-500')
                return
            }

            window.location.href = siteUrl('booking_confirmation/of/' + response.appointment_hash)
        })
        .catch(() => {
            const refreshBtn = document.querySelector('.captcha-title button')
            if (refreshBtn) refreshBtn.click()
        })
        .finally(() => {
            overlay.remove()
        })
}

/**
 * Get unavailable dates for a provider/service.
 */
export function getUnavailableDates(providerId, serviceId, selectedDateString, monthChangeStep = 1) {
    if (processingUnavailableDates) return
    if (!providerId || !serviceId) return

    const appointmentId = vars('manage_mode') ? vars('appointment_data').id : null

    const url = siteUrl('booking/get_unavailable_dates')

    const params = new URLSearchParams({
        provider_id: providerId,
        service_id: serviceId,
        selected_date: selectedDateString,
        csrf_token: vars('csrf_token'),
        manage_mode: Number(vars('manage_mode') || 0),
        appointment_id: appointmentId || '',
    })

    fetch(`${url}?${params}`)
        .then((res) => res.json())
        .then((response) => {
            if (response.is_month_unavailable) {
                if (!searchedMonthStart) {
                    searchedMonthStart = selectedDateString
                }

                if (searchedMonthCounter >= MONTH_SEARCH_LIMIT) {
                    const selectedDateDayjs = dayjs(searchedMonthStart)
                    const startOfMonth = selectedDateDayjs.startOf('month')
                    const endOfMonth = selectedDateDayjs.endOf('month')
                    const unavailableDates = []

                    let current = startOfMonth
                    while (current.isBefore(endOfMonth) || current.isSame(endOfMonth, 'day')) {
                        unavailableDates.push(current.format('YYYY-MM-DD'))
                        current = current.add(1, 'day')
                    }

                    applyUnavailableDates(unavailableDates, searchedMonthStart, true)
                    searchedMonthStart = undefined
                    searchedMonthCounter = 0
                    return
                }

                searchedMonthCounter++
                const nextDate = dayjs(selectedDateString).add(1, 'month').format('YYYY-MM-DD')
                getUnavailableDates(providerId, serviceId, nextDate, monthChangeStep)
                return
            }

            unavailableDatesBackup = response
            selectedDateStringBackup = selectedDateString
            applyUnavailableDates(response, selectedDateString, true)
        })
        .catch(() => {
            const selectDateEl = document.getElementById('select-date')
            if (selectDateEl?.parentElement) {
                selectDateEl.parentElement.style.opacity = '1'
            }
        })
}

export function applyPreviousUnavailableDates() {
    applyUnavailableDates(unavailableDatesBackup, selectedDateStringBackup)
}

function applyUnavailableDates(unavailableDates, selectedDateString, setDate = false) {
    const selectDateEl = document.getElementById('select-date')

    if (selectDateEl?.parentElement) {
        selectDateEl.parentElement.style.opacity = '1'
    }

    processingUnavailableDates = true

    const selectedDateDayjs = dayjs(selectedDateString)
    const numberOfDays = selectedDateDayjs.daysInMonth()

    const availableHoursEl = document.getElementById('available-hours')

    if (unavailableDates.length === numberOfDays) {
        availableHoursEl.textContent = lang('no_available_hours')
    }

    // Update flatpickr disabled dates
    const fp = selectDateEl?._flatpickr
    if (fp) {
        fp.set(
            'disable',
            unavailableDates.map((d) => new Date(d + 'T00:00')),
        )
    }

    if (setDate && !vars('manage_mode')) {
        const selectedDate = selectedDateDayjs.toDate()

        for (let i = 1; i <= numberOfDays; i++) {
            const currentDate = new Date(selectedDate.getFullYear(), selectedDate.getMonth(), i)

            if (unavailableDates.indexOf(dayjs(currentDate).format('YYYY-MM-DD')) === -1) {
                if (fp) fp.setDate(currentDate)
                getAvailableHours(dayjs(currentDate).format('YYYY-MM-DD'))
                break
            }
        }
    }

    // Check for date query param
    const urlParams = new URLSearchParams(window.location.search)
    const dateParam = urlParams.get('date')

    if (dateParam) {
        const dateParamDayjs = dayjs(dateParam)

        if (
            dateParamDayjs.isValid() &&
            !unavailableDates.includes(dateParam) &&
            dateParamDayjs.format('YYYY-MM') === selectedDateDayjs.format('YYYY-MM')
        ) {
            if (fp) fp.setDate(dateParamDayjs.toDate())
        }
    }

    searchedMonthStart = undefined
    searchedMonthCounter = 0
    processingUnavailableDates = false
}

/**
 * Delete personal information.
 */
export function deletePersonalInformation(customerToken) {
    const url = siteUrl('privacy/delete_personal_information')

    fetch(url, {
        method: 'POST',
        headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
        body: new URLSearchParams({
            csrf_token: vars('csrf_token'),
            customer_token: customerToken,
        }),
    }).then(() => {
        window.location.href = vars('base_url')
    })
}
