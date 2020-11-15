jQuery(document).ready(function($) {
    $(window).scroll(function () {
        if ($(window).scrollTop() > 1) {
            console.log('scrolling!');
            $('header').addClass('sticky');
        } else {
            $('header').removeClass('sticky');
        }
    });
    $('nav.toggle button').click(function () {
        $('nav.header-menu').toggleClass('toggled');
    });
});