$(function () {
    $("#included__header").load("./modules/header/index.html");
    $("#included__footer").load("./modules/footer/index.html");
    $("#included__preloader").load("./modules/preloader/index.html");
    $("#included__header-en").load("./modules/header/index_en.html");
    $("#included__footer-en").load("./modules/footer/index_en.html");
});

window.onload = function () {
    document.body.classList.add('loaded_hiding');
    window.setTimeout(function () {
        document.body.classList.add('loaded');
        document.body.classList.remove('loaded_hiding');
    }, 500);
}

$(function() {
    const hiddenText = $('.how-it-works__content--hidden-text');
    const readMoreBtn = $('.how-it-works__read-more');

    readMoreBtn.on('click', function () {
        hiddenText.addClass('active');
        $(this).hide();
    });
});

$(function() {
    $('.open-btn').on('click', function(){
        $('.modal-bg').addClass('modal-bg--active');
    });

    $('.modal-bg, .modal__close, .close-second-step').on('click', function(){
        $('.modal-bg').removeClass('modal-bg--active');
    });

    $('.modal').on('click', function(event){
        event.stopPropagation();
    });
});


// setInterval( function(){
//     // function getResponse() {
//         let myHeaders = new Headers();
//         myHeaders.append("apikey", "NEI8r1RaGmNnIGgVohe7oizDrlBZmDu5");
//
//         let requestOptions = {
//             method: 'GET',
//             redirect: 'follow',
//             headers: myHeaders
//         };
//
//         console.log('GET API');
//
//         fetch("https://api.apilayer.com/exchangerates_data/latest?symbols=USD%2C%20EUR&base=UAH", requestOptions)
//             .then(response => response.text())
//             .then(result => getCurrentValue(result))
//             .catch(error => console.log('error when try get EUR and USD in API', error));
//     // }
// } , 500033333);


// function getCurrentValue(result){
//     let getObjectResult = JSON.parse(result);
//
//     if ('rates' in getObjectResult) {
//         const eur = getObjectResult.rates['EUR'];
//         const usd = getObjectResult.rates['USD'];
//         sendActualValue(eur, usd);
//         console.log('EUR and USD api work')
//     } else {
//         console.log('not found current rates in API');
//         sendActualValue(0.033322, 0.033853);
//     }
// }
//
// function sendActualValue(actualEurValue, actualUsdValue) {
//     const inputVal = document.getElementById("inputAmount").value;
//     const updatedEur = document.querySelector(".updatedEUR");
//     const updatedUsd = document.querySelector(".updatedUSD");
//     const defaultEurValue = document.querySelector(".defaultEurValue");
//     const defaultUsdValue = document.querySelector(".defaultUsdValue");
//
//     const currentValueEur = Number(inputVal) * actualEurValue;
//     const currentValueUsd = Number(inputVal) * actualUsdValue;
//     updatedEur.innerHTML = currentValueEur.toString().slice(0, 4);
//     updatedUsd.innerHTML = currentValueUsd.toString().slice(0, 4);
//
//     const calcDefUahInEUR = 1 / actualEurValue;
//     const calcDefUahInUsd = 1 / actualUsdValue;
//     defaultEurValue.innerHTML = calcDefUahInEUR.toString().slice(0, 5);
//     defaultUsdValue.innerHTML = calcDefUahInUsd.toString().slice(0, 5);
// }


function sendActualValue(actualEurValue, actualUsdValue) {
    const inputVal = document.getElementById("inputAmount").value;
    const updatedEur = document.querySelector(".updatedEUR");
    const updatedUsd = document.querySelector(".updatedUSD");
    const defaultEurValue = document.querySelector(".defaultEurValue");
    const defaultUsdValue = document.querySelector(".defaultUsdValue");

    const currentValueEur = Number(inputVal) * actualEurValue;
    const currentValueUsd = Number(inputVal) * actualUsdValue;
    updatedEur.innerHTML = currentValueEur.toString().slice(0, 4);
    updatedUsd.innerHTML = currentValueUsd.toString().slice(0, 4);

    const calcDefUahInEUR = 1 / actualEurValue;
    const calcDefUahInUsd = 1 / actualUsdValue;
    defaultEurValue.innerHTML = calcDefUahInEUR.toString().slice(0, 5);
    defaultUsdValue.innerHTML = calcDefUahInUsd.toString().slice(0, 5);
}

$(function() {
    calcValue();
});

// ========================================
function calcValue() {
    // FIRST VALUE ITS EURO, SECOND VALUE ITS USD
    sendActualValue(0.033543, 0.034182);
}
// ========================================
