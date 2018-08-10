jQuery(document).ready(function($) {
  $(window).scroll(function() {
    var scrollPos = $(window).scrollTop(),
        navbar = $('.x-navbar');

    if (scrollPos > 130) {
        // document.getElementById("nav").className += " pink";
        navbar.addClass('pink');
    	
    } else {
    	nav.classList.remove("pink");
      // navbar.removeClass('pink');
    }
  });
});