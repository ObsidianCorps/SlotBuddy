import './css/app.css'
import '@fortawesome/fontawesome-free/css/all.min.css'
import 'flatpickr/dist/flatpickr.min.css'
import 'tom-select/dist/css/tom-select.css'
import { initDarkMode, toggleDarkMode } from './lib/dark-mode.js'
import { initSidebar } from './lib/sidebar.js'

initDarkMode()
initSidebar()

document.getElementById('dark-mode-toggle')?.addEventListener('click', toggleDarkMode)
