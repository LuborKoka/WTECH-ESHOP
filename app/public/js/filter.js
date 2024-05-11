window.Filter = {
    bar: document.querySelector('.filter-content .price-filter .bar'),
    rangeOne: document.getElementById('range-1'),
    rangeTwo: document.getElementById('range-2'),
    minText: document.getElementById('cost-min'),
    maxText: document.getElementById('cost-max'),

    apply: function() {
        const form = this.createForm()
        const url = this.constructUrl(form)

        window.location.href = url
    },

    constructUrl: function(form) {
        const url = new URL(window.location.href)
        const params = new URLSearchParams(url)

        for ( key in form ) {
            params.set(key, form[key])
        }

        url.search = params.toString()
        return url.toString()
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
        if ( min > this.rangeOne.min ) form.min_cost = min
        if ( max < this.rangeOne.max) form.max_cost = max
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
