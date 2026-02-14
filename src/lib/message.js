export function toast(message, type = 'info', duration = 4000) {
    const colors = {
        info: 'bg-blue-500',
        success: 'bg-green-500',
        warning: 'bg-amber-500',
        error: 'bg-red-500',
    }

    const el = document.createElement('div')
    el.className = [
        'fixed top-4 right-4 z-50 px-4 py-3 rounded-lg text-white shadow-lg',
        'transition-all duration-300',
        colors[type] || colors.info,
    ].join(' ')
    el.textContent = message
    document.body.appendChild(el)

    setTimeout(() => {
        el.classList.add('opacity-0', 'translate-x-4')
        setTimeout(() => el.remove(), 300)
    }, duration)
}

export function confirmDialog(title, body, onConfirm) {
    const backdrop = document.createElement('div')
    backdrop.className = 'fixed inset-0 z-50 flex items-center justify-center bg-black/50 backdrop-blur-sm'

    const card = document.createElement('div')
    card.className = 'bg-white dark:bg-gray-800 rounded-xl shadow-xl max-w-md w-full mx-4 p-6'

    const heading = document.createElement('h3')
    heading.className = 'text-lg font-semibold text-gray-900 dark:text-white mb-2'
    heading.textContent = title

    const content = document.createElement('div')
    content.className = 'text-gray-600 dark:text-gray-300 mb-6'
    content.textContent = body

    const actions = document.createElement('div')
    actions.className = 'flex justify-end gap-3'

    const cancelBtn = document.createElement('button')
    cancelBtn.className = 'sb-btn-secondary'
    cancelBtn.textContent = 'Cancel'
    cancelBtn.addEventListener('click', () => backdrop.remove())

    const confirmBtn = document.createElement('button')
    confirmBtn.className = 'sb-btn-primary'
    confirmBtn.textContent = 'OK'
    confirmBtn.addEventListener('click', () => {
        onConfirm?.()
        backdrop.remove()
    })

    actions.append(cancelBtn, confirmBtn)
    card.append(heading, content, actions)
    backdrop.appendChild(card)
    backdrop.addEventListener('click', (e) => {
        if (e.target === backdrop) backdrop.remove()
    })

    document.body.appendChild(backdrop)
}
