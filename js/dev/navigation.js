// don't trigger hamburger menu if old IE
if ($("html").hasClass("lt-ie9") === false){

	 var nav = responsiveNav("nav.main",
	 	{
	 		openPos:'static',
	 		open: function(){
	 			//$('.titleStrip').addClass('burgerOpen');
	 		},
	 		close: function(){
	 			//$('.titleStrip').removeClass('burgerOpen');	 			
	 		}
	 	});

}
