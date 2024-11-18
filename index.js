

// Initiate the wowjs
new WOW().init();


// Sticky Navbar
$(window).scroll(function () {
    if ($(this).scrollTop() > 40) {
        $('.navbar').addClass('sticky-top');
    } else {
        $('.navbar').removeClass('sticky-top');
    }
});

// Back to top button
$(window).scroll(function () {
    if ($(this).scrollTop() > 500) {
        $('.back-to-top').show();
    } else {
        $('.back-to-top').hide();
    }
});


