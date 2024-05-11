function slideShow(direction) {
    const activeElement = document.querySelector('.carousel-item-container:not(.to-left):not(.to-right)')
    const onTheRight = [...document.querySelectorAll('.carousel-item-container.to-right')]
    const onTheLeft = [...document.querySelectorAll('.carousel-item-container.to-left')]

    activeElement?.classList.add(direction ? 'to-left' : 'to-right')

    if ( direction ) {
        onTheRight.at(0)?.classList.remove('to-right')
        if ( onTheRight.length === 1 ) carouselToRightButton.style.display = 'none'
        if ( onTheLeft.length === 0 ) carouselToLeftButton.style.display = 'flex'
        return
    }


    onTheLeft.at(-1)?.classList.remove('to-left')
    if ( onTheLeft.length === 1 ) carouselToLeftButton.style.display = 'none'
    if ( onTheRight.length === 0 ) carouselToRightButton.style.display = 'flex'
}

const carouselToRightButton = document.querySelector('.swipe.right')
carouselToRightButton.addEventListener('click', () => slideShow(true))

const carouselToLeftButton = document.querySelector('.swipe.left')
carouselToLeftButton.addEventListener('click', () => slideShow(false))
