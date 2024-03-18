const toggles = document.querySelectorAll('.filter-expand i')
const filter = document.getElementById('filter')
const frameFix = document.querySelector('.filter-window-framefix')
const animationFrame = document.querySelector('.filter-animation-frame')
const filterWindow = document.querySelector('.filter-window')

toggles.forEach(e => {
    e.addEventListener('click', () => {
        e.parentElement.classList.toggle('open')
    })
})

filter.addEventListener('click', () => {
    frameFix.style.display = 'block'
    animationFrame.style.animation = 'roll-in 1s'
})

frameFix.addEventListener('click', function() {
    animationFrame.style.animation = 'roll-out 1s reverse'
    setTimeout(() => this.style.display = 'none', 800)
})

filterWindow.addEventListener('click', e => {
    e.stopPropagation()
})