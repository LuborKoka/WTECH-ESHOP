document.addEventListener('DOMContentLoaded', () => {
    const template = document.querySelector('#product-card')
    const container = document.querySelector('#product-list-container')

    let productIdCounter = 1;

    for (let i = 0; i < 15; i++) {
        const productCard = template.content.cloneNode(true);
        
        productCard.querySelector('.card').setAttribute('data-product-id', productIdCounter);
        container.appendChild(productCard);

        productIdCounter++;
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
