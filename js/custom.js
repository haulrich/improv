jQuery(document).ready(function($) {
    $(window).scroll(function () {
        if ($(window).scrollTop() > 55) {
            console.log('scrolling!');
            $('header').addClass('sticky');
        } else {
            $('header').removeClass('sticky');
        }
    });
});