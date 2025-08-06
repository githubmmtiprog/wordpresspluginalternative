jQuery(document).ready(function($) {
    $('.mchp-carousel.owl-carousel').owlCarousel({
        items: 3,
        loop: true,
        margin: 10,
        nav: true,
        dots: true,
        autoplay: true,
        autoplayTimeout: 3000,
        autoplayHoverPause: true,
        responsive: {
            0: {items: 1},
            600: {items: 2},
            1000: {items: 3}
        }
    });
});
