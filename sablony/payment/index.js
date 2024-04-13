const shippingOptions = document.querySelectorAll('#step-1 .option')
const stepTwoFields = document.querySelectorAll('#step-2 .labeled-input input')
const paymentOptions = document.querySelectorAll('#step-3 .option')

let currentStep = 1

function fillBar(index, percentage = 100) {
    const bar = document.querySelectorAll('.payment-progress .bar')[index]
    bar.classList.add(`filled-${percentage}`)
}

function removeBarClassList(index, regex) {
    const element = document.querySelectorAll('.payment-progress .bar')[index]
    // ono asi mozem rovno povedat, ze vymazat element.classList[1], lebo filled-val je na indexe 1,
    // ale toto je krajsie riesenie (asi)
    element.classList.forEach((c, i) => {
        if ( regex.test(c) ) {
            element.classList.remove(element.classList[i])
            return
        }
    })

}

function validateTab(tabId) {
    function getFieldsValidity() {
        let count = 0
        stepTwoFields.forEach(e => {
            e.checkValidity() && count++
        })
    
        return Math.ceil(count / stepTwoFields.length * 100)
    }

    let validity
    switch(tabId) {
        case 1:
            validity = Number([...document.querySelectorAll('#step-1 input[type="radio"]')].some(i => i.checked === true)) * 100
            break
        case 2:
            validity =  getFieldsValidity()
            break
        case 3:
            validity = Number([...document.querySelectorAll('#step-3 input[type="radio"]')].some(i => i.checked === true)) * 100
    }

    validity === true || removeBarClassList(tabId - 1, new RegExp('filled-[0-9]*'))
    fillBar(tabId - 1, validity)
    
    if ( validity === true || validity === 100 ) {
        document.querySelector(`#step-${tabId} .clickable-button:not(.low-prio)`).disabled = false
    } else {
        document.querySelector(`#step-${tabId} .clickable-button:not(.low-prio)`).disabled = true
    }

}


async function nextPrevStep(isNext) {
    const n = isNext ? currentStep : currentStep - 1
    const circle = document.querySelectorAll(`.payment-progress .circle`)[n]
    isNext ? circle.classList.add('filled') : setTimeout(() => circle.classList.remove('filled'), 1000)

    document.querySelector(`#step-${currentStep}`).style.display = 'none'
    document.querySelector(`#step-${isNext ? ++currentStep : --currentStep}`).style.display = 'grid'
    isNext && validateTab(currentStep)
    isNext || removeBarClassList(currentStep, new RegExp('filled-[0-9]*'))
}

const formData = {}

//uvidim, ci toto vobec budeme potrebovat
function setFormVal(type, name, val) {
    if ( type === 'radio' ) {
        formData[name.slice(0, -2)] = name.slice(-1)
        return
    } 

    if ( type === 'text' ) {
        formData[name] = val
    }
}


function addListeners() {
    document.querySelectorAll('.payment-details input').forEach(e => {
        e.addEventListener('input', function(e) {
            setFormVal(this.type, this.type === 'radio' ? this.id : this.name, this.value)
        })
    })

    shippingOptions.forEach(e => {
        const input = e.querySelector('input')
        input.addEventListener('change', () => {
            validateTab(1)
        })
        e.addEventListener('click', () => {    
            input.checked = true
            validateTab(1)
        })
    })

    stepTwoFields.forEach(e => {
        e.addEventListener('input', function() {
            validateTab(2)
        })   
    })

    paymentOptions.forEach(e => {
        const input = e.querySelector('input')
        input.addEventListener('change', () => {
            validateTab(3)
        })
        e.addEventListener('click', () => {    
            input.checked = true
            validateTab(3)
        })
    })
}


addListeners()