export function initSidebar() {
    const sidebar = document.getElementById('sidebar')
    const main = document.getElementById('main-content')
    const toggle = document.getElementById('sidebar-toggle')
    const mobileToggle = document.getElementById('mobile-sidebar-toggle')
    const overlay = document.getElementById('sidebar-overlay')

    toggle?.addEventListener('click', () => {
        sidebar.classList.toggle('w-64')
        sidebar.classList.toggle('w-16')
        sidebar.classList.toggle('sidebar-collapsed')
        main?.classList.toggle('lg:pl-64')
        main?.classList.toggle('lg:pl-16')
        localStorage.setItem('sb-sidebar',
            sidebar.classList.contains('sidebar-collapsed') ? 'collapsed' : 'expanded')
    })

    mobileToggle?.addEventListener('click', () => {
        sidebar.classList.toggle('-translate-x-full')
        overlay?.classList.toggle('hidden')
    })

    overlay?.addEventListener('click', () => {
        sidebar.classList.add('-translate-x-full')
        overlay.classList.add('hidden')
    })

    if (localStorage.getItem('sb-sidebar') === 'collapsed') {
        sidebar?.classList.remove('w-64')
        sidebar?.classList.add('w-16', 'sidebar-collapsed')
        main?.classList.remove('lg:pl-64')
        main?.classList.add('lg:pl-16')
    }
}
