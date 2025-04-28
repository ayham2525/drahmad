jQuery(document).ready(function($) {
  $("#owl-carousel-example").owlCarousel({
    items: 1,
    loop: true,
    nav: false,
    dots: true,
    autoplay: true,
    autoplayTimeout: 3000,
    autoplayHoverPause: true,
    rtl: $("html").attr("dir") === "rtl", // Detect RTL automatically
    animateOut: 'fadeOut'
  });
});
