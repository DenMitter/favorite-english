export default {
    mounted(el, binding) {
        const { action, loadingText = 'Завантаження...', successText = 'Успішно!', errorText = 'Помилка' } = binding.value
        const originalText = el.textContent

        el.addEventListener('click', async () => {
            el.disabled = true
            el.textContent = loadingText

            try {
                await action()
                el.textContent = successText
                el.classList.add('success')
            } catch (e) {
                el.textContent = errorText
                el.classList.add('error')
            } finally {
                setTimeout(() => {
                    el.textContent = originalText
                    el.disabled = false
                    el.classList.remove('success', 'error')
                }, 2000)
            }
        })
    }
}
