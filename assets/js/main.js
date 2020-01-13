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

/*ScrollReveal footer*/

ScrollReveal().reveal('.copyright', { delay: 50});
ScrollReveal().reveal('.contact', { delay: 100 });
ScrollReveal().reveal('.ml', { delay: 150 });
ScrollReveal().reveal('.cgu', { delay: 200 });
ScrollReveal().reveal('.who', { delay: 250 });