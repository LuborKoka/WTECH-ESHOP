window.Filter = {
    bar: document.querySelector('.filter-content .price-filter .bar'),
    rangeOne: document.getElementById('range-1'),
    rangeTwo: document.getElementById('range-2'),
    minText: document.getElementById('price-min'),
    maxText: document.getElementById('price-max'),

    apply: function() {
        const form = this.createForm()
        const url = this.constructUrl(form)

        window.location.href = url
    },

    constructUrl: function(form) {
        let url = `${window.location.origin}/`

        const sortBy = new URLSearchParams(window.location.search).get('sort_by')
        if ( sortBy ) {
            url += `?sort_by=${sortBy}`
        }

        for ( key in form ) {
            const value = form[key]
            if ( Array.isArray(value) ) {
                value.forEach((val, i) => {
                    if ( i === 0 ) {
                        url += `&${key}[]=${encodeURIComponent(val)}`
                    } else {
                        url += `&${key}[]=${encodeURIComponent(val)}`
                    }
                })
            } else {
                url += `&${key}=${encodeURIComponent(value)}`
            }
        }

        if (url.indexOf('?') === -1) {
            url = url.replace(/\/&/, '/?');
        }

        return url
    },


    createForm: function() {
        const authors = []
        const publishers = []
        const [min, max] = this.getPriceRange()

        document.querySelectorAll('input[name="book_author"]').forEach(e => {
            if ( e.checked ) authors.push(e.id)
        })

        document.querySelectorAll('input[name="book_publisher"]').forEach(e => {
            if ( e.checked ) publishers.push(e.id)
        })

        const form = {}
        if ( min > this.rangeOne.min ) form.min_price = min
        if ( max < this.rangeOne.max) form.max_price = max
        if ( authors.length > 0 ) form.authors = authors
        if ( publishers.length > 0 ) form.publishers = publishers

        return form
    },


    updateText: function(min, max) {
        this.minText.innerText = `Min. cena: ${min}€`
        this.maxText.innerText = `Max. cena: ${max}€`
    },

    resizeBar: function(min, max) {
        const maxValue = this.rangeOne.max
        const priceRange = ( max - min ) / maxValue

        this.bar.style.left = `${min * 100 / maxValue}%`
        this.bar.style.width = `${priceRange * 100}%`
        this.updateText(min, max)
    },

    getPriceRange: function() {
        const min = Math.min(this.rangeOne.valueAsNumber, this.rangeTwo.valueAsNumber)
        const max = Math.max(this.rangeOne.valueAsNumber, this.rangeTwo.valueAsNumber)

        return [min, max]
    },

    addListeners: function() {
        this.rangeOne.addEventListener('input', () => {
            const [min, max] = this.getPriceRange()
            this.resizeBar(min, max)
        })

        this.rangeTwo.addEventListener('input', () => {
            const [min, max] = this.getPriceRange()
            this.resizeBar(min, max)
        })
    }
}


Filter.addListeners()
