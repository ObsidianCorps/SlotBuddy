import flatpickr from 'flatpickr'
import 'flatpickr/dist/flatpickr.min.css'
import tippy from 'tippy.js'
import 'tippy.js/dist/tippy.css'
import { vars, lang } from '../lib/vars.js'
import { siteUrl } from '../lib/url.js'
import { dayjs } from '../lib/date.js'
import { isEmailValid, isPhoneValid } from '../lib/validation.js'
import { confirmDialog } from '../lib/message.js'
import {
    getAvailableHours,
    getUnavailableDates,
    registerAppointment,
    deletePersonalInformation,
    applyPreviousUnavailableDates,
} from '../http/booking-api.js'

let manageMode = false

function escapeHtml(str) {
    if (!str) return ''
    const div = document.createElement('div')
    div.textContent = str
    return div.textContent
}

function queryParam(name) {
    const params = new URLSearchParams(window.location.search)
    return params.get(name)
}

function getWeekdayId(weekDayName) {
    const days = { sunday: 0, monday: 1, tuesday: 2, wednesday: 3, thursday: 4, friday: 5, saturday: 6 }
    return days[weekDayName?.toLowerCase()] ?? 0
}

function getFlatpickrLocale() {
    const firstWeekDay = vars('first_weekday')
    return {
        weekdays: {
            shorthand: [
                lang('sunday_short'), lang('monday_short'), lang('tuesday_short'),
                lang('wednesday_short'), lang('thursday_short'), lang('friday_short'), lang('saturday_short'),
            ],
            longhand: [
                lang('sunday'), lang('monday'), lang('tuesday'),
                lang('wednesday'), lang('thursday'), lang('friday'), lang('saturday'),
            ],
        },
        months: {
            shorthand: [
                lang('january_short'), lang('february_short'), lang('march_short'),
                lang('april_short'), lang('may_short'), lang('june_short'),
                lang('july_short'), lang('august_short'), lang('september_short'),
                lang('october_short'), lang('november_short'), lang('december_short'),
            ],
            longhand: [
                lang('january'), lang('february'), lang('march'),
                lang('april'), lang('may'), lang('june'),
                lang('july'), lang('august'), lang('september'),
                lang('october'), lang('november'), lang('december'),
            ],
        },
        firstDayOfWeek: getWeekdayId(firstWeekDay),
        rangeSeparator: ` ${lang('to')} `,
        weekAbbreviation: lang('week_short'),
        amPM: ['am', 'pm'],
    }
}

function getDateFormat() {
    switch (vars('date_format')) {
        case 'DMY': return 'd/m/Y'
        case 'MDY': return 'm/d/Y'
        case 'YMD': return 'Y/m/d'
        default: return 'Y/m/d'
    }
}

function formatDisplayDate(date, dateFormatType, timeFormatType, withHours = false) {
    const d = dayjs(date)
    if (!d.isValid()) return ''

    let dateFormat
    switch (dateFormatType) {
        case 'DMY': dateFormat = 'DD/MM/YYYY'; break
        case 'MDY': dateFormat = 'MM/DD/YYYY'; break
        default: dateFormat = 'YYYY/MM/DD'
    }

    let timeFormat = timeFormatType === 'regular' ? 'h:mm a' : 'HH:mm'
    return withHours ? d.format(`${dateFormat} ${timeFormat}`) : d.format(dateFormat)
}

export function initialize() {
    const selectDate = document.getElementById('select-date')
    const selectService = document.getElementById('select-service')
    const selectProvider = document.getElementById('select-provider')
    const selectTimezone = document.getElementById('select-timezone')
    const availableHoursEl = document.getElementById('available-hours')

    manageMode = vars('manage_mode') || false

    // Init tooltips
    tippy('[data-tippy-content]')

    // Init flatpickr inline calendar
    let monthTimeout
    const today = dayjs()

    flatpickr(selectDate, {
        inline: true,
        allowInput: true,
        dateFormat: getDateFormat(),
        locale: getFlatpickrLocale(),
        minDate: today.subtract(1, 'day').endOf('day').toDate(),
        maxDate: today.add(vars('future_booking_limit') || 90, 'day').toDate(),
        onChange: (selectedDates) => {
            getAvailableHours(dayjs(selectedDates[0]).format('YYYY-MM-DD'))
            updateConfirmFrame()
        },
        onMonthChange: (selectedDates, dateStr, instance) => {
            selectDate.parentElement.style.opacity = '0.3'

            if (monthTimeout) clearTimeout(monthTimeout)

            monthTimeout = setTimeout(() => {
                const previousDayjs = dayjs(instance.selectedDates[0])
                const displayedMonth = dayjs(
                    instance.currentYearElement.value +
                    '-' +
                    String(Number(instance.monthsDropdownContainer.value) + 1).padStart(2, '0') +
                    '-01',
                )
                const step = previousDayjs.isAfter(displayedMonth) ? -1 : 1

                getUnavailableDates(
                    selectProvider.value,
                    selectService.value,
                    displayedMonth.format('YYYY-MM-DD'),
                    step,
                )
            }, 500)
        },
        onYearChange: (selectedDates, dateStr, instance) => {
            setTimeout(() => {
                const previousDayjs = dayjs(instance.selectedDates[0])
                const displayedMonth = dayjs(
                    instance.currentYearElement.value +
                    '-' +
                    String(Number(instance.monthsDropdownContainer.value) + 1).padStart(2, '0') +
                    '-01',
                )
                const step = previousDayjs.isAfter(displayedMonth) ? -1 : 1

                getUnavailableDates(
                    selectProvider.value,
                    selectService.value,
                    displayedMonth.format('YYYY-MM-DD'),
                    step,
                )
            }, 500)
        },
    })

    // Set initial date
    selectDate._flatpickr.setDate(new Date())

    // Detect browser timezone
    const browserTimezone = Intl.DateTimeFormat().resolvedOptions().timeZone
    const tzOption = selectTimezone.querySelector(`option[value="${browserTimezone}"]`)
    selectTimezone.value = tzOption ? browserTimezone : 'UTC'

    // Bind events
    addEventListeners()

    // Auto-select single service
    const serviceOptions = selectService.querySelectorAll('option')
    if (serviceOptions.length === 2) {
        const emptyOpt = selectService.querySelector('option[value=""]')
        if (emptyOpt) emptyOpt.remove()
        selectService.dispatchEvent(new Event('change'))
    }

    if (manageMode) {
        applyAppointmentData(vars('appointment_data'), vars('provider_data'), vars('customer_data'))
        showFrame(1)
    } else {
        // Check URL params
        const selectedServiceId = queryParam('service')

        if (selectedServiceId && selectService.querySelector(`option[value="${selectedServiceId}"]`)) {
            selectService.value = selectedServiceId
        }

        selectService.dispatchEvent(new Event('change'))

        const selectedProviderId = queryParam('provider')

        if (selectedProviderId && !selectProvider.querySelector(`option[value="${selectedProviderId}"]`)) {
            for (const provider of vars('available_providers') || []) {
                if (Number(provider.id) === Number(selectedProviderId) && provider.services.length > 0) {
                    selectService.value = provider.services[0]
                    selectService.dispatchEvent(new Event('change'))
                }
            }
        }

        if (selectedProviderId && selectProvider.querySelector(`option[value="${selectedProviderId}"]`)) {
            selectProvider.value = selectedProviderId
            selectProvider.dispatchEvent(new Event('change'))
        }

        if (
            (selectedServiceId && selectedProviderId) ||
            ((vars('available_services') || []).length === 1 && (vars('available_providers') || []).length === 1)
        ) {
            if (!selectedServiceId) {
                selectService.value = vars('available_services')[0].id
                selectService.dispatchEvent(new Event('change'))
            }

            if (!selectedProviderId) {
                selectProvider.value = vars('available_providers')[0].id
                selectProvider.dispatchEvent(new Event('change'))
            }

            setActiveStep(2)
            document.getElementById('wizard-frame-1').classList.add('hidden')
            document.getElementById('wizard-frame-2').classList.remove('hidden')

            const step1 = document.getElementById('step-1')
            if (step1) step1.style.display = 'none'

            const backBtn = document.querySelector('.button-back')
            if (backBtn) backBtn.style.visibility = 'hidden'
        } else {
            showFrame(1)
        }

        // Prefill from URL params
        prefillFromQueryParam('first-name', 'first_name')
        prefillFromQueryParam('last-name', 'last_name')
        prefillFromQueryParam('email', 'email')
        prefillFromQueryParam('phone-number', 'phone')
        prefillFromQueryParam('address', 'address')
        prefillFromQueryParam('city', 'city')
        prefillFromQueryParam('zip-code', 'zip')
    }

    // Listen for confirm frame update events from the HTTP module
    document.addEventListener('booking:updateConfirm', () => updateConfirmFrame())
}

function prefillFromQueryParam(fieldId, paramName) {
    const el = document.getElementById(fieldId)
    if (!el) return
    const val = queryParam(paramName)
    if (val) el.value = val
}

function showFrame(index) {
    const frame = document.getElementById('wizard-frame-' + index)
    if (frame) {
        frame.classList.remove('hidden')
        frame.style.opacity = '0'
        requestAnimationFrame(() => {
            frame.style.transition = 'opacity 0.3s ease'
            frame.style.opacity = '1'
        })
    }
}

function setActiveStep(stepIndex) {
    document.querySelectorAll('.book-step').forEach((el) => {
        el.classList.remove('bg-accent', 'text-white')
        el.classList.add('bg-gray-200', 'dark:bg-gray-700', 'text-gray-500', 'dark:text-gray-400')
        const badge = el.querySelector('span:first-child')
        if (badge) {
            badge.classList.remove('bg-white/20')
            badge.classList.add('bg-gray-300', 'dark:bg-gray-600')
        }
    })

    const active = document.getElementById('step-' + stepIndex)
    if (active) {
        active.classList.add('bg-accent', 'text-white')
        active.classList.remove('bg-gray-200', 'dark:bg-gray-700', 'text-gray-500', 'dark:text-gray-400')
        const badge = active.querySelector('span:first-child')
        if (badge) {
            badge.classList.add('bg-white/20')
            badge.classList.remove('bg-gray-300', 'dark:bg-gray-600')
        }
    }
}

function addEventListeners() {
    const selectDate = document.getElementById('select-date')
    const selectService = document.getElementById('select-service')
    const selectProvider = document.getElementById('select-provider')
    const selectTimezone = document.getElementById('select-timezone')
    const availableHoursEl = document.getElementById('available-hours')
    const bookSubmit = document.getElementById('book-appointment-submit')
    const captchaTitle = document.querySelector('.captcha-title')

    // Timezone change
    selectTimezone.addEventListener('change', () => {
        const fp = selectDate._flatpickr
        const date = fp?.selectedDates[0]
        if (!date) return

        getAvailableHours(dayjs(date).format('YYYY-MM-DD'))
        updateConfirmFrame()
    })

    // Provider change
    selectProvider.addEventListener('change', () => {
        const todayDate = new Date()
        selectDate._flatpickr?.setDate(todayDate)

        getUnavailableDates(
            selectProvider.value,
            selectService.value,
            dayjs(todayDate).format('YYYY-MM-DD'),
        )

        updateConfirmFrame()
    })

    // Service change
    selectService.addEventListener('change', () => {
        const serviceId = selectService.value
        selectProvider.parentElement.hidden = !serviceId

        // Clear and repopulate providers
        while (selectProvider.firstChild) {
            selectProvider.removeChild(selectProvider.firstChild)
        }

        const pleaseSelectOpt = document.createElement('option')
        pleaseSelectOpt.value = ''
        pleaseSelectOpt.textContent = lang('please_select')
        selectProvider.appendChild(pleaseSelectOpt)

        ;(vars('available_providers') || []).forEach((provider) => {
            const canServe = provider.services.some(
                (sid) => Number(sid) === Number(serviceId),
            )

            if (canServe) {
                const opt = document.createElement('option')
                opt.value = provider.id
                opt.textContent = provider.first_name + ' ' + provider.last_name
                selectProvider.appendChild(opt)
            }
        })

        const providerOptions = selectProvider.querySelectorAll('option')

        if (providerOptions.length === 2) {
            const emptyOpt = selectProvider.querySelector('option[value=""]')
            if (emptyOpt) emptyOpt.remove()
        }

        if (providerOptions.length > 2 && Number(vars('display_any_provider'))) {
            const anyOpt = document.createElement('option')
            anyOpt.value = 'any-provider'
            anyOpt.textContent = lang('any_provider')
            selectProvider.insertBefore(anyOpt, selectProvider.children[1])
        }

        const fpDate = selectDate._flatpickr?.selectedDates[0]
        getUnavailableDates(
            selectProvider.value,
            selectService.value,
            dayjs(fpDate || new Date()).format('YYYY-MM-DD'),
        )

        updateConfirmFrame()
        updateServiceDescription(serviceId)
    })

    // Next buttons
    document.querySelectorAll('.button-next').forEach((btn) => {
        btn.addEventListener('click', (e) => {
            const stepIndex = parseInt(e.currentTarget.dataset.step_index)

            // Step 1: require provider
            if (stepIndex === 1 && !selectProvider.value) return

            // Step 2: require selected hour
            if (stepIndex === 2) {
                if (!document.querySelector('.selected-hour')) {
                    if (!document.getElementById('select-hour-prompt')) {
                        const prompt = document.createElement('div')
                        prompt.id = 'select-hour-prompt'
                        prompt.className = 'text-red-500 text-sm mb-2'
                        prompt.textContent = lang('appointment_hour_missing')
                        availableHoursEl.prepend(prompt)
                    }
                    return
                }
            }

            // Step 3: validate customer form
            if (stepIndex === 3) {
                if (!validateCustomerForm()) return
                updateConfirmFrame()
            }

            const nextIndex = stepIndex + 1
            const currentFrame = document.getElementById('wizard-frame-' + stepIndex)
            const nextFrame = document.getElementById('wizard-frame-' + nextIndex)

            if (currentFrame) {
                currentFrame.style.transition = 'opacity 0.3s ease'
                currentFrame.style.opacity = '0'
                setTimeout(() => {
                    currentFrame.classList.add('hidden')
                    currentFrame.style.opacity = ''
                    setActiveStep(nextIndex)
                    if (nextFrame) {
                        nextFrame.classList.remove('hidden')
                        nextFrame.style.opacity = '0'
                        requestAnimationFrame(() => {
                            nextFrame.style.transition = 'opacity 0.3s ease'
                            nextFrame.style.opacity = '1'
                        })
                    }
                }, 300)
            }

            // Scroll to top on mobile
            if (window.innerHeight < document.scrollingElement.scrollHeight) {
                document.scrollingElement.scrollTop = 0
            }
        })
    })

    // Back buttons
    document.querySelectorAll('.button-back').forEach((btn) => {
        btn.addEventListener('click', (e) => {
            const stepIndex = parseInt(e.currentTarget.dataset.step_index)
            const prevIndex = stepIndex - 1
            const currentFrame = document.getElementById('wizard-frame-' + stepIndex)
            const prevFrame = document.getElementById('wizard-frame-' + prevIndex)

            if (currentFrame) {
                currentFrame.style.transition = 'opacity 0.3s ease'
                currentFrame.style.opacity = '0'
                setTimeout(() => {
                    currentFrame.classList.add('hidden')
                    currentFrame.style.opacity = ''
                    setActiveStep(prevIndex)
                    if (prevFrame) {
                        prevFrame.classList.remove('hidden')
                        prevFrame.style.opacity = '0'
                        requestAnimationFrame(() => {
                            prevFrame.style.transition = 'opacity 0.3s ease'
                            prevFrame.style.opacity = '1'
                        })
                    }
                }, 300)
            }
        })
    })

    // Available hour click (delegated)
    availableHoursEl.addEventListener('click', (e) => {
        const hourBtn = e.target.closest('.available-hour')
        if (!hourBtn) return

        availableHoursEl.querySelectorAll('.selected-hour').forEach((el) => {
            el.classList.remove('selected-hour', 'bg-accent', 'text-white', 'border-accent')
        })
        hourBtn.classList.add('selected-hour', 'bg-accent', 'text-white', 'border-accent')
        updateConfirmFrame()
    })

    // Manage mode events
    if (manageMode) {
        const cancelBtn = document.getElementById('cancel-appointment')
        if (cancelBtn) {
            cancelBtn.addEventListener('click', () => {
                const cancelForm = document.getElementById('cancel-appointment-form')

                const backdrop = document.createElement('div')
                backdrop.className = 'fixed inset-0 z-50 flex items-center justify-center bg-black/50 backdrop-blur-sm'

                const card = document.createElement('div')
                card.className = 'bg-white dark:bg-gray-800 rounded-xl shadow-xl max-w-md w-full mx-4 p-6'

                const heading = document.createElement('h3')
                heading.className = 'text-lg font-semibold text-gray-900 dark:text-white mb-2'
                heading.textContent = lang('cancel_appointment_title')

                const body = document.createElement('p')
                body.className = 'text-gray-600 dark:text-gray-300 mb-4'
                body.textContent = lang('write_appointment_removal_reason')

                const textarea = document.createElement('textarea')
                textarea.className = 'sb-input mb-4'
                textarea.rows = 3
                textarea.id = 'cancellation-reason'

                const actions = document.createElement('div')
                actions.className = 'flex justify-end gap-3'

                const closeBtn = document.createElement('button')
                closeBtn.className = 'sb-btn-secondary'
                closeBtn.textContent = lang('close')
                closeBtn.addEventListener('click', () => backdrop.remove())

                const confirmBtn = document.createElement('button')
                confirmBtn.className = 'sb-btn-primary'
                confirmBtn.textContent = lang('confirm')
                confirmBtn.addEventListener('click', () => {
                    if (!textarea.value) {
                        textarea.style.borderColor = '#DC3545'
                        return
                    }
                    const hiddenInput = document.getElementById('hidden-cancellation-reason')
                    if (hiddenInput) hiddenInput.value = textarea.value
                    cancelForm.submit()
                })

                actions.append(closeBtn, confirmBtn)
                card.append(heading, body, textarea, actions)
                backdrop.appendChild(card)
                backdrop.addEventListener('click', (e) => {
                    if (e.target === backdrop) backdrop.remove()
                })
                document.body.appendChild(backdrop)
            })
        }

        const deleteBtn = document.getElementById('delete-personal-information')
        if (deleteBtn) {
            deleteBtn.addEventListener('click', () => {
                confirmDialog(
                    lang('delete_personal_information'),
                    lang('delete_personal_information_prompt'),
                    () => deletePersonalInformation(vars('customer_token')),
                )
            })
        }
    }

    // Book appointment submit
    if (bookSubmit) {
        bookSubmit.addEventListener('click', () => {
            const termsCheckbox = document.getElementById('accept-to-terms-and-conditions')
            if (termsCheckbox) {
                termsCheckbox.classList.remove('border-red-500')
                if (!termsCheckbox.checked) {
                    termsCheckbox.classList.add('border-red-500')
                    return
                }
            }

            const privacyCheckbox = document.getElementById('accept-to-privacy-policy')
            if (privacyCheckbox) {
                privacyCheckbox.classList.remove('border-red-500')
                if (!privacyCheckbox.checked) {
                    privacyCheckbox.classList.add('border-red-500')
                    return
                }
            }

            registerAppointment()
        })
    }

    // Captcha refresh
    if (captchaTitle) {
        captchaTitle.addEventListener('click', (e) => {
            if (e.target.closest('button')) {
                const img = document.querySelector('.captcha-image')
                if (img) img.src = siteUrl('captcha?' + Date.now())
            }
        })
    }

    // Flatpickr date mousedown to reapply unavailable dates
    selectDate.addEventListener('mousedown', (e) => {
        if (e.target.closest('.flatpickr-day')) {
            setTimeout(() => applyPreviousUnavailableDates(), 300)
        }
    })

    // Terms & privacy modal links
    document.addEventListener('click', (e) => {
        const modalLink = e.target.closest('[data-modal]')
        if (!modalLink) return
        e.preventDefault()

        const type = modalLink.dataset.modal
        let title = ''
        let content = ''

        if (type === 'terms-and-conditions') {
            title = lang('terms_and_conditions')
            content = vars('terms_and_conditions_content') || ''
        } else if (type === 'privacy-policy') {
            title = lang('privacy_policy')
            content = vars('privacy_policy_content') || ''
        }

        const backdrop = document.createElement('div')
        backdrop.className = 'fixed inset-0 z-50 flex items-center justify-center bg-black/50 backdrop-blur-sm p-4'

        const card = document.createElement('div')
        card.className = 'bg-white dark:bg-gray-800 rounded-xl shadow-xl max-w-lg w-full max-h-[80vh] flex flex-col'

        const header = document.createElement('div')
        header.className = 'flex items-center justify-between p-4 border-b border-gray-200 dark:border-gray-700'

        const heading = document.createElement('h3')
        heading.className = 'text-lg font-semibold text-gray-900 dark:text-white'
        heading.textContent = title

        const closeBtn = document.createElement('button')
        closeBtn.className = 'text-gray-400 hover:text-gray-600 dark:hover:text-gray-300'
        closeBtn.textContent = '\u00D7'
        closeBtn.style.fontSize = '1.5rem'
        closeBtn.addEventListener('click', () => backdrop.remove())

        header.append(heading, closeBtn)

        const body = document.createElement('div')
        body.className = 'p-4 overflow-y-auto text-sm text-gray-600 dark:text-gray-300 prose dark:prose-invert max-w-none'
        body.textContent = content

        const footer = document.createElement('div')
        footer.className = 'p-4 border-t border-gray-200 dark:border-gray-700 flex justify-end'

        const okBtn = document.createElement('button')
        okBtn.className = 'sb-btn-secondary'
        okBtn.textContent = lang('close')
        okBtn.addEventListener('click', () => backdrop.remove())
        footer.appendChild(okBtn)

        card.append(header, body, footer)
        backdrop.appendChild(card)
        backdrop.addEventListener('click', (e) => {
            if (e.target === backdrop) backdrop.remove()
        })
        document.body.appendChild(backdrop)
    })
}

function validateCustomerForm() {
    const frame3 = document.getElementById('wizard-frame-3')
    frame3.querySelectorAll('.border-red-500').forEach((el) => el.classList.remove('border-red-500'))

    const formMessage = document.getElementById('form-message')

    let missingRequired = false

    frame3.querySelectorAll('.required').forEach((el) => {
        if (!el.value) {
            el.classList.add('border-red-500')
            missingRequired = true
        }
    })

    if (missingRequired) {
        if (formMessage) {
            formMessage.textContent = lang('fields_are_required')
            formMessage.classList.remove('hidden')
        }
        return false
    }

    const email = document.getElementById('email')
    if (email?.value && !isEmailValid(email.value)) {
        email.classList.add('border-red-500')
        if (formMessage) {
            formMessage.textContent = lang('invalid_email')
            formMessage.classList.remove('hidden')
        }
        return false
    }

    const phone = document.getElementById('phone-number')
    if (phone?.value && !isPhoneValid(phone.value)) {
        phone.classList.add('border-red-500')
        if (formMessage) {
            formMessage.textContent = lang('invalid_phone')
            formMessage.classList.remove('hidden')
        }
        return false
    }

    if (formMessage) formMessage.classList.add('hidden')
    return true
}

function updateConfirmFrame() {
    const selectService = document.getElementById('select-service')
    const selectProvider = document.getElementById('select-provider')
    const selectDate = document.getElementById('select-date')
    const selectTimezone = document.getElementById('select-timezone')
    const availableHoursEl = document.getElementById('available-hours')
    const displayBookingSelection = document.getElementById('display-booking-selection')

    const serviceId = selectService.value
    const providerId = selectProvider.value

    const serviceText = serviceId
        ? selectService.options[selectService.selectedIndex]?.text
        : lang('service')
    const providerText = providerId
        ? selectProvider.options[selectProvider.selectedIndex]?.text
        : lang('provider')

    if (displayBookingSelection) {
        displayBookingSelection.textContent = `${serviceText} \u00B7 ${providerText}`
    }

    const selectedHour = availableHoursEl.querySelector('.selected-hour')
    if (!selectedHour?.textContent) return

    const service = (vars('available_services') || []).find(
        (s) => Number(s.id) === Number(serviceId),
    )

    if (!service) return

    const fp = selectDate._flatpickr
    const selectedDateObj = fp?.selectedDates[0]
    const selectedDateStr = dayjs(selectedDateObj).format('YYYY-MM-DD')
    const selectedTime = selectedHour.textContent

    let formattedDate = ''
    if (selectedDateObj) {
        formattedDate =
            formatDisplayDate(selectedDateStr, vars('date_format'), vars('time_format'), false) +
            ' ' +
            selectedTime
    }

    const timezoneText = selectTimezone.options[selectTimezone.selectedIndex]?.text || ''

    // Update appointment details
    const appointmentDetails = document.getElementById('appointment-details')
    if (appointmentDetails) {
        // Clear safely
        while (appointmentDetails.firstChild) {
            appointmentDetails.removeChild(appointmentDetails.firstChild)
        }

        const container = document.createElement('div')
        container.className = 'space-y-2'

        const serviceName = document.createElement('div')
        serviceName.className = 'text-lg font-semibold text-gray-900 dark:text-white'
        serviceName.textContent = serviceText
        container.appendChild(serviceName)

        const providerName = document.createElement('div')
        providerName.className = 'text-sm font-medium text-gray-500 dark:text-gray-400'
        providerName.textContent = providerText
        container.appendChild(providerName)

        const dateRow = document.createElement('div')
        dateRow.className = 'text-sm text-gray-700 dark:text-gray-300'
        dateRow.textContent = formattedDate
        container.appendChild(dateRow)

        const durationRow = document.createElement('div')
        durationRow.className = 'text-sm text-gray-700 dark:text-gray-300'
        durationRow.textContent = `${service.duration} ${lang('minutes')}`
        container.appendChild(durationRow)

        const tzRow = document.createElement('div')
        tzRow.className = 'text-sm text-gray-700 dark:text-gray-300'
        tzRow.textContent = timezoneText
        container.appendChild(tzRow)

        if (Number(service.price)) {
            const priceRow = document.createElement('div')
            priceRow.className = 'text-sm text-gray-700 dark:text-gray-300'
            priceRow.textContent = `${Number(service.price).toFixed(2)} ${service.currency}`
            container.appendChild(priceRow)
        }

        appointmentDetails.appendChild(container)
    }

    // Update customer details
    const customerDetails = document.getElementById('customer-details')
    if (customerDetails) {
        while (customerDetails.firstChild) {
            customerDetails.removeChild(customerDetails.firstChild)
        }

        const container = document.createElement('div')
        container.className = 'space-y-2'

        const heading = document.createElement('div')
        heading.className = 'text-lg font-semibold text-gray-900 dark:text-white'
        heading.textContent = lang('contact_info')
        container.appendChild(heading)

        const firstName = escapeHtml(document.getElementById('first-name')?.value || '')
        const lastName = escapeHtml(document.getElementById('last-name')?.value || '')
        const fullName = `${firstName} ${lastName}`.trim()
        const emailVal = escapeHtml(document.getElementById('email')?.value || '')
        const phoneVal = escapeHtml(document.getElementById('phone-number')?.value || '')
        const addressVal = escapeHtml(document.getElementById('address')?.value || '')
        const cityVal = escapeHtml(document.getElementById('city')?.value || '')
        const zipVal = escapeHtml(document.getElementById('zip-code')?.value || '')

        const fields = [fullName, emailVal, phoneVal, addressVal]
        const addressParts = [cityVal, zipVal].filter(Boolean).join(', ')
        if (addressParts) fields.push(addressParts)

        fields.filter(Boolean).forEach((text) => {
            const row = document.createElement('div')
            row.className = 'text-sm text-gray-700 dark:text-gray-300'
            row.textContent = text
            container.appendChild(row)
        })

        customerDetails.appendChild(container)
    }

    // Update hidden form data
    const data = {}

    data.customer = {
        last_name: document.getElementById('last-name')?.value || '',
        first_name: document.getElementById('first-name')?.value || '',
        email: document.getElementById('email')?.value || '',
        phone_number: document.getElementById('phone-number')?.value || '',
        address: document.getElementById('address')?.value || '',
        city: document.getElementById('city')?.value || '',
        zip_code: document.getElementById('zip-code')?.value || '',
        timezone: selectTimezone.value,
        custom_field_1: document.getElementById('custom-field-1')?.value || '',
        custom_field_2: document.getElementById('custom-field-2')?.value || '',
        custom_field_3: document.getElementById('custom-field-3')?.value || '',
        custom_field_4: document.getElementById('custom-field-4')?.value || '',
        custom_field_5: document.getElementById('custom-field-5')?.value || '',
    }

    const selectedHourValue = selectedHour.dataset.value
    data.appointment = {
        start_datetime:
            dayjs(selectedDateObj).format('YYYY-MM-DD') +
            ' ' +
            dayjs(selectedHourValue, 'HH:mm').format('HH:mm') +
            ':00',
        end_datetime: calculateEndDatetime(),
        notes: document.getElementById('notes')?.value || '',
        is_unavailability: false,
        id_users_provider: selectProvider.value,
        id_services: selectService.value,
    }

    data.manage_mode = Number(manageMode)

    if (manageMode) {
        data.appointment.id = vars('appointment_data').id
        data.customer.id = vars('customer_data').id
    }

    const postDataInput = document.querySelector('input[name="post_data"]')
    if (postDataInput) postDataInput.value = JSON.stringify(data)
}

function calculateEndDatetime() {
    const selectService = document.getElementById('select-service')
    const selectDate = document.getElementById('select-date')
    const serviceId = selectService.value

    const service = (vars('available_services') || []).find(
        (s) => Number(s.id) === Number(serviceId),
    )

    const fp = selectDate._flatpickr
    const selectedDateStr = dayjs(fp?.selectedDates[0]).format('YYYY-MM-DD')
    const selectedHour = document.querySelector('.selected-hour')?.dataset.value

    const startDayjs = dayjs(selectedDateStr + ' ' + selectedHour)

    let endDayjs
    if (service?.duration && startDayjs.isValid()) {
        endDayjs = startDayjs.add(parseInt(service.duration), 'minute')
    } else {
        endDayjs = dayjs()
    }

    return endDayjs.format('YYYY-MM-DD HH:mm:ss')
}

function applyAppointmentData(appointment, provider, customer) {
    if (!appointment) return

    const selectService = document.getElementById('select-service')
    const selectProvider = document.getElementById('select-provider')
    const selectDate = document.getElementById('select-date')
    const selectTimezone = document.getElementById('select-timezone')

    selectService.value = appointment.id_services
    selectService.dispatchEvent(new Event('change'))
    selectProvider.value = appointment.id_users_provider

    const startDayjs = dayjs(appointment.start_datetime)
    selectDate._flatpickr?.setDate(startDayjs.toDate())
    getAvailableHours(startDayjs.format('YYYY-MM-DD'))

    getUnavailableDates(
        appointment.id_users_provider,
        appointment.id_services,
        startDayjs.format('YYYY-MM-DD'),
    )

    if (customer) {
        const fieldMap = {
            'last-name': customer.last_name,
            'first-name': customer.first_name,
            'email': customer.email,
            'phone-number': customer.phone_number,
            'address': customer.address,
            'city': customer.city,
            'zip-code': customer.zip_code,
            'notes': appointment.notes || '',
            'custom-field-1': customer.custom_field_1,
            'custom-field-2': customer.custom_field_2,
            'custom-field-3': customer.custom_field_3,
            'custom-field-4': customer.custom_field_4,
            'custom-field-5': customer.custom_field_5,
        }

        for (const [id, value] of Object.entries(fieldMap)) {
            const el = document.getElementById(id)
            if (el && value != null) el.value = value
        }

        if (customer.timezone) {
            selectTimezone.value = customer.timezone
        }
    }

    updateConfirmFrame()
}

function updateServiceDescription(serviceId) {
    const descriptionEl = document.getElementById('service-description')
    if (!descriptionEl) return

    while (descriptionEl.firstChild) {
        descriptionEl.removeChild(descriptionEl.firstChild)
    }

    const service = (vars('available_services') || []).find(
        (s) => Number(s.id) === Number(serviceId),
    )

    if (!service) return

    const parts = []

    if (service.duration) {
        parts.push(`${lang('duration')}: ${service.duration} ${lang('minutes')}`)
    }

    if (Number(service.price) > 0) {
        parts.push(`${lang('price')}: ${Number(service.price).toFixed(2)} ${service.currency}`)
    }

    if (service.location) {
        parts.push(`${lang('location')}: ${service.location}`)
    }

    if (parts.length) {
        const infoDiv = document.createElement('div')
        infoDiv.className = 'text-sm italic text-gray-500 dark:text-gray-400 mb-1'
        infoDiv.textContent = parts.join(', ')
        descriptionEl.appendChild(infoDiv)
    }

    if (service.description?.length) {
        const descDiv = document.createElement('div')
        descDiv.className = 'text-sm text-gray-500 dark:text-gray-400'
        descDiv.textContent = service.description
        descriptionEl.appendChild(descDiv)
    }
}
