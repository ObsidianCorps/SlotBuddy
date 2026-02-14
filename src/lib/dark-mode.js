export function initDarkMode() {
    const stored = localStorage.getItem('sb-dark-mode')
    const prefersDark = window.matchMedia('(prefers-color-scheme: dark)').matches
    if (stored === 'dark' || (stored === null && prefersDark)) {
        document.documentElement.classList.add('dark')
    }
}

export function toggleDarkMode() {
    const isDark = document.documentElement.classList.toggle('dark')
    localStorage.setItem('sb-dark-mode', isDark ? 'dark' : 'light')
}
