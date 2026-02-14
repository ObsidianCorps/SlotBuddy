export function isEmailValid(email) {
    const re = /^[^\s@]+@[^\s@]+\.[^\s@]+$/
    return re.test(email)
}

export function isPhoneValid(phone) {
    const re = /^[+]?[\d\s\-().]{7,20}$/
    return re.test(phone)
}

export function isRequired(value) {
    return value !== null && value !== undefined && String(value).trim() !== ''
}
