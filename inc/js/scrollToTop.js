$(document).ready(function(){

    $(function(){

        $(document).on( 'scroll', function(){

            if ($(window).scrollTop() > 100) {
                $('.scroll-top-wrapper').addClass('show');
            } else {
                $('.scroll-top-wrapper').removeClass('show');
            }
        });

        $('.scroll-top-wrapper').on('click', scrollToTop);
    });

    function scrollToTop() {
        verticalOffset = typeof(verticalOffset) != 'undefined' ? verticalOffset : 0;
        element = $('body');
        offset = element.offset();
        offsetTop = offset.top;
        $('html, body').animate({scrollTop: offsetTop}, 500, 'linear');
    }
    
    });



// jQuery : see first menu on scroll up
var prevScrollpos = window.pageYOffset;
$(window).scroll(function() {
var currentScrollPos = window.pageYOffset;
if (prevScrollpos > currentScrollPos) {
    $('.sticky-top').addClass('active');
} else {
    $('.sticky-top').removeClass('active');
}
prevScrollpos = currentScrollPos;
});
