jQuery(document).ready(function($) {
    $(window).scroll(function () {
        if ($(window).scrollTop() > 3) {
            $('header').addClass('sticky');
        } else {
            $('header').removeClass('sticky');
        }
    });
});