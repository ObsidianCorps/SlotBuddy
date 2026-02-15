import './css/app.css'
import { initDarkMode } from './lib/dark-mode.js'
import { initialize as initBooking } from './pages/booking.js'

initDarkMode()
document.addEventListener('DOMContentLoaded', initBooking)
