$(document).ready(function () {


});

ScrollReveal().reveal('#h2', { duration: 2000});
ScrollReveal().reveal('.boxleft', { duration: 3000});
ScrollReveal().reveal('.boxright', { duration: 4000});

ScrollReveal().reveal('#h2section2', { duration: 2000});

ScrollReveal().reveal('#p1', { duration: 4000});
ScrollReveal().reveal('#p2', { duration: 6000});
ScrollReveal().reveal('#p3', { duration: 8000});


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
