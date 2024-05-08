window.ShoppingCart = {
    csrfToken: document.querySelector('meta[name="csrf-token"]').getAttribute('content'),


    removeItem: function(cartId, itemId) {
        fetch(`/cart/item?item_id=${itemId}&cart_id=${cartId}`, {
            method: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': this.csrfToken,
                'Content-Type': 'application/json'
            }
        })
        .then(r => {
            console.log(r)
            if ( r.status === 204 ) {
                this.removeGuiItem(itemId)
            }
        })
        .catch()
    },

    removeGuiItem: function(itemId) {
        document.querySelector(`#item-${itemId}`).remove()
    }
}




const items = []

function RNG(min, max) {
    return Math.floor(Math.random() * (max - min + 1)) + min
}

class CartItem {
    constructor(price, count, id) {
        this.count = count
        this.price = price
        this.id = id

        this.html = document.querySelector('#cart-item-template').content.firstElementChild.cloneNode(true)

        const input = this.html.querySelector('input')
        input.value = count
        input.addEventListener('input', e => this.updateCost(e))

        this.html.querySelector('i').addEventListener('click', () => this.remove())

        this.html.querySelector('b').innerHTML = `${String(price)}€/ks`
        this.html.querySelector('p:last-of-type').innerHTML = `${String(price * count)}€`
    }

    remove() {
        //optional zobrazit nejaky dialog

        const index = items.findIndex(i => i.id = this.id)
        items.splice(index, 1)
        this.html.remove()
    }

    updateCost(e) {
        const count = e.target.valueAsNumber || 0

        if ( count === 0 ) {
            this.remove()
            return
        }

        this.count = count
        this.totalPriceHtmlTag.innerHTML = `${this.price * count}€`
        document.querySelector('#cart-total').innerHTML = `Zaplatit celkom: ${this.getCartTotal()}€`
    }

    getCartTotal() {
        return items.reduce((acc, curr) => acc + curr.totalCost, 0)
    }

    get totalCost() {
        return this.count * this.price
    }

    get totalPriceHtmlTag() {
        return this.html.querySelector('p:last-of-type')
    }


}


for ( let i = 0; i < 5; i++ ) {
    items.push(new CartItem(RNG(10, 250), Math.floor(RNG(1, 10)), i))
}

document.querySelector('main section #items').append(...items.map(i => i.html))
document.querySelector('#cart-total').innerHTML = `Zaplatit celkom: ${items.at(-1).getCartTotal()}€`
