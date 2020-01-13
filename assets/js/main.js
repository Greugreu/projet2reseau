$(document).ready(function () {

    ScrollReveal().reveal('#h2', { duration: 7000});

})

/*Menu Burger*/
$('a').click(function() {
    $(this).toggleClass('active');
});

/*Zoom site*/

setTimeout(function () {
    $('.intro_bg').addClass('zout');
}, 1000);