// Import HTML template
$(function () {
    // layout
    $("#included__header").load("/modules/header/index.html");
    $("#included__footer").load("/modules/footer/index.html");
    // any
    $("#included__preloader").load("/modules/preloader/index.html");
});
// ---------------------------------------------------------------------------

// Прелоадер
window.onload = function () {
    document.body.classList.add('loaded_hiding');
    window.setTimeout(function () {
        document.body.classList.add('loaded');
        document.body.classList.remove('loaded_hiding');
    }, 500);
}

$(document).ready(function () {
    $('#home-desc__read-more-btn').on('click', function () {
        $('.home-desc__info--hide-text').css('display', 'block');
        $(this).hide();
    });
});

