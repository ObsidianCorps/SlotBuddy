import './css/app.css'
import { initDarkMode, toggleDarkMode } from './lib/dark-mode.js'
import { initSidebar } from './lib/sidebar.js'

initDarkMode()
initSidebar()

document.getElementById('dark-mode-toggle')?.addEventListener('click', toggleDarkMode)
