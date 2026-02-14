import dayjs from 'dayjs'
import utc from 'dayjs/plugin/utc'
import timezone from 'dayjs/plugin/timezone'
import customParseFormat from 'dayjs/plugin/customParseFormat'

dayjs.extend(utc)
dayjs.extend(timezone)
dayjs.extend(customParseFormat)

export { dayjs }

export function formatDate(date, format = 'YYYY-MM-DD') {
    return dayjs(date).format(format)
}

export function formatTime(date, format = 'HH:mm') {
    return dayjs(date).format(format)
}

export function toTimezone(date, tz) {
    return dayjs(date).tz(tz)
}
