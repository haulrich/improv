jQuery(document).ready(function($) {
    $(window).scroll(function () {
        if ($(window).scrollTop() > 60) {
            console.log('scrolling!');
            $('header').addClass('sticky');
        } else {
            $('header').removeClass('sticky');
        }
    });
    $('nav.toggle button').click(function () {
        $('nav.header-menu').toggleClass('toggled');
    });

    let masonry_height = null;
    $('div.masonry article').each(function() {
        masonry_height = masonry_height + $(this).outerHeight();
    });
    $('div.masonry').css('height', ((masonry_height / 4) + ((masonry_height / $('div.masonry article').length)) * 2.5));
});