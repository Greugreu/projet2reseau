$(document).ready(function () {

    ScrollReveal().reveal('#h2', { duration: 7000});
    ScrollReveal().reveal('.boxleft', { duration: 7000});
    ScrollReveal().reveal('.boxright', { duration: 7000});

    //AJAX modal
    $('#manual-ajax').click(function(event) {
        event.preventDefault();
        this.blur(); // Manually remove focus from clicked link.
        $.get(this.href, function(html) {
            $(html).appendTo('body').modal();
        });
    });

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
