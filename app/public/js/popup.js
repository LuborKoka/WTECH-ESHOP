window.Popup = {
    frameFix: document.querySelector('.filter-window-framefix'),
    animationFrame: document.querySelector('.filter-animation-frame'),

    open: function() {
        this.frameFix.style.display = 'block'
        this.animationFrame.style.animation = 'roll-in 1s'
    },

    close: function() {
        this.animationFrame.style.animation = 'roll-out 1s reverse'
        setTimeout(() => this.frameFix.style.display = 'none', 800)
    },

    addListeners: function() {
        document.querySelector('.filter-window').addEventListener('click', e => {
            e.stopPropagation()
        })

        document.querySelectorAll('.filter-expand i').forEach(e => {
            e.addEventListener('click', () => {
                e.parentElement.classList.toggle('open')
            })
        })
    }
}


Popup.addListeners()
