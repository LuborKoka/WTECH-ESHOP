window.ShoppingCart = {
    csrfToken: document.querySelector('meta[name="csrf-token"]').getAttribute('content'),


    removeItem: function(cartItemId) {
        fetch(`/cart/item?id=${cartItemId}`, {
            method: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': this.csrfToken,
                'Content-Type': 'application/json'
            }
        })
        .then(r => {
            if ( r.status === 200 ) {
                this.removeGuiItem(cartItemId)
                r.json().then(d => this.updateCost(d.totalCost))
            }
        })
        .catch()
    },

    changeItemCount: function(cartItemId, cost) {
        const count = document.querySelector(`#item-${cartItemId} input`).valueAsNumber
        fetch(`/cart/item?id=${cartItemId}&count=${count}`, {
            method: 'PATCH',
            headers: {
                'X-CSRF-TOKEN': this.csrfToken,
                'Content-Type': 'application/json'
            }
        })
        .then(r => r.json())
        .then(data => {
            if ( data.resultCount == 0 ) {
                this.removeGuiItem(cartItemId)
            } else {
                this.updateGuiItem(cartItemId, data.resultCount, cost)
            }
            this.updateCost(data.cost)
        })
        .catch()
    },

    updateCost: function(cost) {
        document.querySelector('#cart-total').innerHTML = `Zaplatit celkom: ${cost}€`
    },

    removeGuiItem: function(itemId) {
        document.querySelector(`#item-${itemId}`).remove()
    },

    updateGuiItem: function(cartItemId, count, cost) {
        const resultCost = count*cost
        document.querySelector(`#item-${cartItemId} p:last-of-type`).innerHTML = `${String(resultCost.toFixed(2))}€`
    }
}
