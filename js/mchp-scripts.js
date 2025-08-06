jQuery(document).ready(function($) {
    $('.mchp-carousel.owl-carousel').owlCarousel({
        items: 1, // Show 1 item at a time
        loop: true,
        margin: 0, // No margin
        nav: true,
        dots: true,
        autoplay: true,
        autoplayTimeout: 5000,
        autoplayHoverPause: true
    });
});