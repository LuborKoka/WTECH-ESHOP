const nav = document.querySelector('nav')

document.querySelector('.hamburger').addEventListener('click', function() {
    this.classList.toggle('is-active')
    this.style.transform == '' ? this.style.transform = `translateX(${nav.offsetWidth}px)` : this.style.transform = ''
    nav.classList.toggle('nav-active')
})

