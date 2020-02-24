/*
 * Copyright (c) by anime-free
 * Date: 2020.
 * User: Alukardua
 */

$("#carousel").owlCarousel({loop: true, items: 1, nav: false, dots: false, autoplay: true});

$(document).ready(function() {
    $('.mdb-select').materialSelect();
});

$('li').click(function() {
    $(this).addClass('active').siblings().removeClass('active');
});

$(function () {
    $(window).scroll(function () {
        if ($(this).scrollTop() != 0) {
            $('#toTop').fadeIn();
        } else {
            $('#toTop').fadeOut();
        }
    });
    $('#toTop').click(function () {
        $('body,html').animate({scrollTop: 0}, 800);
    });
});

$(function () {
    $('[data-toggle="tooltip"]').tooltip({
        template: '<div class="tooltip md-tooltip"><div class="tooltip-arrow md-arrow"></div><div class="tooltip-inner md-inner"></div></div>'
    })
});
$(function () {
    $('[data-toggle="popover"]').popover()
});

// $(function () {
// $("#comment-text")
// })

new WOW().init();
