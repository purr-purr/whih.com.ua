$(function () {
    $("#included__header").load("/modules/header/index.html");
    $("#included__footer").load("/modules/footer/index.html");
    $("#included__preloader").load("/modules/preloader/index.html");
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