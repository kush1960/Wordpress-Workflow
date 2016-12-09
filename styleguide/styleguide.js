$(function() {
	// clipboard.js for copying swatches - https://zenorocha.github.io/clipboard.js
	new Clipboard('.sgColourSwatch');





	// typography - read css properties and add to page
	var typeElement = '.sgTypeBox h1';
	var cssProperties = $( typeElement ).css([
    "font-size", "font-family", "font-weight", "line-height", "letter-spacing", "color", "background-color", 
  	]);

	$.each( cssProperties, function( property, value ) {
	  //alert( property + ": " + value );
	  $( ".sgTypeCSS" ).append( '<div class="sgCSSRow"><span class="sgCSSProperty">' + property + '</span> : <span class="sgCSSValue">' + value + '</span></div>' );
	  
	});

	




	// smooth scroll anything to anything with an ID
	$(function() {



		$('a[href*=\\#]:not([href=\\#])').click(function(e) {
		    if (location.pathname.replace(/^\//,'') === this.pathname.replace(/^\//,'') && location.hostname === this.hostname) {

		        var target = $(this.hash);

		        target = target.length ? target : $('[name=' + this.hash.slice(1) +']');

		        if (target.length) {

		            $('html, body').animate({

		                scrollTop: target.offset().top

		            }, 1000);

		            e.preventDefault();

		        }

		    }

		});	  

	});


	$(function() {



		  // $sections incleudes all of the container divs that relate to menu items.
		  var $sections = $('.sgComponent');
		  
		  // The user scrolls
		  $(window).scroll(function(){
		    
		    // currentScroll is the number of pixels the window has been scrolled
		    var currentScroll = $(this).scrollTop();
		    
		    // $currentSection is somewhere to place the section we must be looking at
		    var $currentSection;
		    
		    // We check the position of each of the divs compared to the windows scroll positon
		    $sections.each(function(){
		      // divPosition is the position down the page in px of the current section we are testing      
		      var divPosition = $(this).offset().top;
		      
		      // If the divPosition is less the the currentScroll position the div we are testing has moved above the window edge.
		      // the -200 is so that it includes the div before its's actually at the top of the screen
		      if( divPosition - 200 < currentScroll ){
		        // We have either read the section or are currently reading the section so we'll call it our current section
		      	
		        $currentSection = $(this);
		        
		        // If the next div has also been read or we are currently reading it we will overwrite this value again. This will leave us with the LAST div that passed.
		      }
		     
		      // This is the bit of code that uses the currentSection as its source of ID
		      if($currentSection != undefined){
			      	var id = $currentSection.attr('id');
	  		   		$('.sgSideMenu a').removeClass('sgSideMenuActive');
			   		$('a[href^="#'+id+'"]').addClass('sgSideMenuActive');
		      }
		      
		    })

		  });

	});

});

