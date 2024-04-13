document.addEventListener('DOMContentLoaded', () => {
    const template = document.querySelector('#product-card')
    const html = template.innerHTML
    const container = document.querySelector('#product-list-container')

    for ( let i = 0; i < 15; i++ ) {
        container.innerHTML += html
    }

    const sortByTabs = document.querySelectorAll('.sort-by-header span')
    sortByTabs.forEach(t => {
        t.addEventListener('click', () => {
            const tab = document.querySelector('.sort-by-header .active')
            tab.classList.remove('active')
            t.classList.add('active')
        })
    })
})

