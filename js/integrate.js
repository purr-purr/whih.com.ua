let submitButton = document.querySelector('div.donation-page__approve > button.main-btn')
let form = document.querySelector('form.donation-page__form')

let nameInput = form.querySelector('input[type=name]')
let descriptionInput = form.querySelector('input[type=text]')
let amountInput = form.querySelector('div.donation-page__input-amount > input[type=number]')

let lang = document.documentElement.lang

submitButton.addEventListener(
    'click',
    function () {
        let params = {
            amount: amountInput.value,
            currency: 'UAH',
            description: descriptionInput.value,
            language: lang,
            name: nameInput.value
        }
        let paramsString = ''

        for (let key in params) {
            paramsString += `${key}=${params[key]}&`
        }

        paramsString = paramsString.slice(0, -1)

        let http = new XMLHttpRequest()
        let url = '/methods/payment.php'
        http.open('POST', url, true);
        http.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
        http.onreadystatechange = function() {
            if (http.readyState == 4 && http.status == 200) {
                let json = JSON.parse(http.responseText)
                window.location = json.url
            }
        }
        http.send(paramsString)

    },
    true
)