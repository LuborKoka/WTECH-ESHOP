window.Cashier = {
    csrfToken: document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
    shippingOptions: document.querySelectorAll('#step-1 .option'),
    userDataElements: document.querySelectorAll('#step-2 .labeled-input input'),
    paymentOptions: document.querySelectorAll('#step-3 .option'),
    currentStep: 1,
    circles: document.querySelectorAll(`.payment-progress .circle`),
    bars: document.querySelectorAll('.payment-progress .bar'),
    formData: {},

    makePayment: function() {
        fetch('/payment', {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': this.csrfToken,
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({
                form: this.formData
            })
        })
        .then(r => {
            if ( r.status === 201 ) {
                this.nextPrevStep(true)
            }
            r.json().then(d => {
                if ( d?.error ) {
                    alert(d.error)
                }
            })
        })
        .catch()
    },

    nextPrevStep: function(isNext) {
        const n = isNext ? this.currentStep : this.currentStep - 1
        const circle = this.circles[n]
        isNext ? circle.classList.add('filled') : setTimeout(() => circle.classList.remove('filled'), 1000)

        document.querySelector(`#step-${this.currentStep}`).style.display = 'none'
        document.querySelector(`#step-${isNext ? ++this.currentStep : --this.currentStep}`).style.display = 'grid'
        isNext ? this.validateTab(this.currentStep) : this.removeBarClassList(this.currentStep, new RegExp('filled-[0-9]*'))
    },

    fillBar: function(index, percentage = 100) {
        const bar = this.bars[index]
        bar.classList.add(`filled-${percentage}`)
    },

    removeBarClassList: function(index, regex) {
        const element = this.bars[index]
        element.classList.forEach((c, i) => {
            if ( regex.test(c) ) {
                element.classList.remove(element.classList[i])
                return
            }
        })
    },

    getFieldsValidity: function() {
        let count = 0
        this.userDataElements.forEach(e => {
            e.checkValidity() && count++
        })
        return Math.ceil(count / this.userDataElements.length * 100)
    },

    validateTab: function(tabId) {
        let validity
        switch(tabId) {
            case 1:
                validity = Number([...document.querySelectorAll('#step-1 input[type="radio"]')].some(i => i.checked === true)) * 100
                break
            case 2:
                validity =  this.getFieldsValidity()
                break
            case 3:
                validity = Number([...document.querySelectorAll('#step-3 input[type="radio"]')].some(i => i.checked === true)) * 100
        }

        validity === true || this.removeBarClassList(tabId - 1, new RegExp('filled-[0-9]*'))
        this.fillBar(tabId - 1, validity)

        if ( validity === true || validity === 100 ) {
            document.querySelector(`#step-${tabId} .clickable-button:not(.low-prio)`).disabled = false
        } else {
            document.querySelector(`#step-${tabId} .clickable-button:not(.low-prio)`).disabled = true
        }
    },

    setFormVal: function(type, name, val) {
        switch(type) {
            case 'radio':
                this.formData[name.slice(0, -2)] = name.slice(-1)
                return
            default:
                this.formData[name] = val
                return
        }
    },

    addListeners: function() {
        const setFormVal = this.setFormVal.bind(this)

        document.querySelectorAll('.payment-details input').forEach(e => {
            e.addEventListener('input', function() {
                setFormVal(this.type, this.type === 'radio' ? this.id : this.name, this.value)
            })
        })

        this.shippingOptions.forEach(e => {
            const input = e.querySelector('input')
            input.addEventListener('input', () => {
                this.validateTab(1)
            })
            e.addEventListener('click', () => {
                input.checked = true
                input.dispatchEvent(new Event('input'))
            })
        })

        this.userDataElements.forEach(e => {
            e.addEventListener('input', () => {
                this.validateTab(2)
            })
        })

        this.paymentOptions.forEach(e => {
            const input = e.querySelector('input')
            input.addEventListener('input', () => {
                this.validateTab(3)
            })
            e.addEventListener('click', () => {
                input.checked = true
                input.dispatchEvent(new Event('input'))
            })
        })
    }
}

Cashier.addListeners()
