export function vars(key) {
    return window.__slotbuddy_vars?.[key] ?? null
}

export function lang(key) {
    return window.__slotbuddy_lang?.[key] ?? key
}
