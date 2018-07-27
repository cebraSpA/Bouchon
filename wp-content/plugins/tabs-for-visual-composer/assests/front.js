jQuery(document).ready(function($) {
	wdo_localize_vars;
	console.log(wdo_localize_vars);
	// $(".wdo-postcarousel").each(function(index, el) {
	// 	var slick_ob = {
	// 	  	infinite: (wdo_localize_vars.infinite == 'yes') ? true : false,	
	// 		dots: (wdo_localize_vars.dots == 'yes') ? true : false,		  
	// 		arrows: (wdo_localize_vars.arrows == 'yes') ? true : false,		  
	// 		autoplay: (wdo_localize_vars.autoplay == 'yes') ? true : false,
	// 		autoplaySpeed: wdo_localize_vars.autoplaySpeed,
	// 		draggable: true,
	// 		speed: wdo_localize_vars.speed,
	// 		slidesToShow: wdo_localize_vars.slidesToShow,
	// 		slidesToScroll: 4,
	// 		centerPadding: wdo_localize_vars.centerPadding,
	// 		pauseOnHover: wdo_localize_vars.pauseOnHover,
	// 	  	responsive: [{
	// 	      breakpoint: 600,
	// 	      settings: {
	// 	        slidesToShow: wdo_localize_vars.slides_ontablets,
	// 	        slidesToScroll: wdo_localize_vars.slides_ontablets,
	// 	      }
	// 	    },
	// 	    {
	// 	      breakpoint: 470,
	// 	      settings: {
	// 	        slidesToShow: wdo_localize_vars.slides_onmobile,
	// 	        slidesToScroll: wdo_localize_vars.slides_onmobile,
	// 	      }
	// 	    }]			
	// 	};
	// 	$(this).slick(slick_ob);
	// });
	$('.wdo-postcarousel').slick({
	  centerMode: false,
	  centerPadding: '60px',
	  infinite: (wdo_localize_vars.infinite == 'yes') ? true : false,
	  autoplay: (wdo_localize_vars.autoplay == 'yes') ? true : false,
	  autoplaySpeed: wdo_localize_vars.autoplaySpeed,
	  slidesToShow: wdo_localize_vars.slides_ondesktop,
	  dots: (wdo_localize_vars.dots == 'yes') ? true : false,
	  arrows: (wdo_localize_vars.arrows == 'yes') ? true : false,
	  responsive: [{
		      breakpoint: 600,
		      settings: {
		        slidesToShow: wdo_localize_vars.slides_ontablets,
		        slidesToScroll: wdo_localize_vars.slides_ontablets,
		      }
		    },
		    {
		      breakpoint: 470,
		      settings: {
		        slidesToShow: wdo_localize_vars.slides_onmobile,
		        slidesToScroll: wdo_localize_vars.slides_onmobile,
		      }
		    }]
	});
});