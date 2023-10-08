jQuery(document).ready(function($) {
    // Add the "Back to Top" button with an arrow icon to the body
    $('body').append('<a href="#" id="back-to-top" title="Back to Top"><i class="arrow-up"></i></a>');
    
    // Scroll to top when the button is clicked
    $('#back-to-top').click(function() {
        $('html, body').animate({scrollTop : 0}, 800);
        return false;
    });
    
    // Show/hide the button based on scroll position
    $(window).scroll(function() {
        if ($(this).scrollTop() > 100) {
            $('#back-to-top').fadeIn();
        } else {
            $('#back-to-top').fadeOut();
        }
    });
});
