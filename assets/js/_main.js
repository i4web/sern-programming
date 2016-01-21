/* ========================================================================
 * DOM-based Routing
 * Based on http://goo.gl/EUTi53 by Paul Irish
 *
 * Only fires on body classes that match. If a body class contains a dash,
 * replace the dash with an underscore when adding it to the object below.
 *
 * .noConflict()
 * The routing is enclosed within an anonymous function so that you can
 * always reference jQuery with $, even when in .noConflict() mode.
 *
 * Google CDN, Latest jQuery
 * To use the default WordPress version of jQuery, go to lib/config.php and
 * remove or comment out: add_theme_support('jquery-cdn');
 * ======================================================================== */

(function($) {

// Use this variable to set up the common and page specific functions. If you
// rename this variable, you will also need to rename the namespace below.
var I4web = {
  // All pages
  common: {
    init: function() {
      // JavaScript to be fired on all pages


  // init Isotope
  var $grid = $('.grid').isotope({
    itemSelector: '.element-item',
    layoutMode: 'fitRows'
  });
  // filter functions
  var filterFns = {
    // show if number is greater than 50
    numberGreaterThan50: function() {
      var number = $(this).find('.number').text();
      return parseInt( number, 10 ) > 50;
    },
    // show if name ends with -ium
    ium: function() {
      var name = $(this).find('.name').text();
      return name.match( /ium$/ );
    }
  };
  // bind filter button click
  $('.filters-button-group').on( 'click', 'a', function() {
    var filterValue = $( this ).attr('data-filter');
    // use filterFn if matches value
    filterValue = filterFns[ filterValue ] || filterValue;
    $grid.isotope({ filter: filterValue });
  });
  // change is-checked class on buttons
  $('.button-group').each( function( i, buttonGroup ) {
    var $buttonGroup = $( buttonGroup );
    $buttonGroup.on( 'click', 'a', function() {
      $buttonGroup.find('.is-checked').removeClass('is-checked');
      $( this ).addClass('is-checked');
    });
  });




    }
  },
  // Home page
  home: {
    init: function() {
      // JavaScript to be fired on the home page

	  //Simple solution for smooth scrolling
	   $('a[href*=#]:not([href=#])').click(function() {
      if (location.pathname.replace(/^\//,'') == this.pathname.replace(/^\//,'') && location.hostname == this.hostname) {

	    var target = $(this.hash);

	    target = target.length ? target : $('[name=' + this.hash.slice(1) +']');

	  if (target.length) {
        $('html,body').animate({
          scrollTop: target.offset().top
        }, 500);
        return false;
      }
      }
 	   });  //end solution for smooth scrolling

	   //Script to trigger the radial progress bars when they enter the users viewport
	   //Function to check whether the elements are in the viewport
  $.fn.visible = function(partial) {

      var $t            = $(this),
          $w            = $(window),
          viewTop       = $w.scrollTop(),
          viewBottom    = viewTop + $w.height(),
          _top          = $t.offset().top,
          _bottom       = _top + $t.height(),
          compareTop    = partial === true ? _bottom : _top,
          compareBottom = partial === true ? _top : _bottom;

    return ((compareBottom <= viewBottom) && (compareTop >= viewTop));

  };

	//Store the window element
	var win = $(window);

	// Store the target class to look for in the viewport. This triggers the action of the radial progress bar upon moving
	// into the viewport
	var allMods = $(".radial-progress");


	//Function to store the Strengths Pct into Data Progress. Effectively Changes the data-progress value enabling the 0 to *num* effect
	$.fn.sernStrengths = function() {
		$('.radial-a').attr('data-progress', strengths[0]);
		$('.radial-b').attr('data-progress', strengths[1]);
		$('.radial-c').attr('data-progress', strengths[2]);
	}

	//Declare the Strengths Array. Will hold the data-strength attributes input via WordPress Admin area and collected from the HTML data-strength attribute
	var strengths = [];

	// Loop through each of the data-strength attributes. We will store the attributes and
	$("[data-strength]").each(function() {

		 var strength = $(this).attr('data-strength');
		 strengths.push(strength);

	//$('.radial-progress').click(window.sernStrengths);

	});


	allMods.each(function(i, el) {
	  var el = $(el);
	  if (el.visible(true)) {
		el.addClass("already-visible");
	  }
	});

	win.scroll(function(event) {

	  allMods.each(function(i, el) {
		var el = $(el);
		if (el.visible(true)) {
		  el.addClass("radial-progress-complete");
		  setTimeout(el.sernStrengths, 400);
		}
	  });

	});



    }
  },

  single_i4web_portfolio: {
      init: function() {
          $('.menu-portfolio').addClass('active');
      }
  }
};

// The routing fires all common scripts, followed by the page specific scripts.
// Add additional events for more control over timing e.g. a finalize event
var UTIL = {
  fire: function(func, funcname, args) {
    var namespace = I4web;
    funcname = (funcname === undefined) ? 'init' : funcname;
    if (func !== '' && namespace[func] && typeof namespace[func][funcname] === 'function') {
      namespace[func][funcname](args);
    }
  },
  loadEvents: function() {
    UTIL.fire('common');

    $.each(document.body.className.replace(/-/g, '_').split(/\s+/),function(i,classnm) {
      UTIL.fire(classnm);
    });
  }
};

$(document).ready(UTIL.loadEvents);

})(jQuery); // Fully reference jQuery after this point.
