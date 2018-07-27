(function($){
"use strict"; // Start of use strict
//Pre Load
$(function() {
    $(window).load(function(){
		$('.wrap').removeClass('preload');
	});
});
//Tag Toggle
function toggle_tab(){
	if($('.toggle-tab').length>0){
		$('.toggle-tab').each(function(){
			/* $(this).find('.item-toggle-tab').first().find('.toggle-tab-content').show(); */
			$('.toggle-tab-title').on('click',function(){
				$(this).parent().siblings().removeClass('active');
				$(this).parent().toggleClass('active');
				$(this).parents('.toggle-tab').find('.toggle-tab-content').slideUp();
				$(this).next().stop(true,false).slideToggle();
			});
		});
	}
}	
//Popup Wishlist
function popup_wishlist(){
	$('.wishlist-link').on('click',function(event){
		event.preventDefault();
		$('.wishlist-mask').fadeIn();
		var counter = 5;
		var popup;
		popup = setInterval(function() {
			counter--;
			if(counter < 0) {
				clearInterval(popup);
				$('.wishlist-mask').hide();
			} else {
				$(".wishlist-countdown").text(counter.toString());
			}
		}, 1000);
	});
}
//Menu Responsive
function rep_menu(){
	$('.toggle-mobile-menu').on('click',function(event){
		event.preventDefault();
		$(this).parents('.main-nav').toggleClass('active');
	});
	$('.main-nav li.menu-item-has-children> a > .mb-icon-menu').on('click',function(event){
		if($(window).width()<768){
			/*event.preventDefault();
			$(this).next().stop(true,false).slideToggle();*/
			var t = $(this);
			var link = t.closest('a');
			link.next().stop(true,false).slideToggle('slow');
			event.preventDefault();
			event.stopPropagation();
		}
	});
}
//Custom ScrollBar
function custom_scroll(){
	if($('.custom-scroll').length>0){
		$('.custom-scroll').each(function(){
			$(this).mCustomScrollbar({
				scrollButtons:{
					enable:true
				}
			});
		});
	}
}
//Offset Menu
function offset_menu(){
	if($(window).width()>767){
		$('.main-nav .sub-menu').each(function(){
			var wdm = $(window).width();
			var wde = $(this).width();
			var offset = $(this).offset().left;
			var tw = offset+wde;
			if(tw>wdm){
				$(this).addClass('offset-right');
			}
		});
	}else{
		return false;
	}
}
//Fixed Header
function fixed_header(){
	if($('.header-ontop').length>0){
		if($(window).width()>1023){
			var ht = $('#header').height();
			var st = $(window).scrollTop();
			if(st>ht){
				$('.header-ontop').addClass('fixed-ontop');
			}else{
				$('.header-ontop').removeClass('fixed-ontop');
			}
		}else{
			$('.header-ontop').removeClass('fixed-ontop');
		}
	}
} 
//Slider Background
function background(){
	$('.bg-slider .item-slider').each(function(){
		var src=$(this).find('.banner-thumb a img').attr('src');
		$(this).css('background-image','url("'+src+'")');
	});	
}
function animated(){
	$('.banner-slider .owl-item').each(function(){
		var check = $(this).hasClass('active');
		if(check==true){
			$(this).find('.animated').each(function(){
				var anime = $(this).attr('data-animated');
				$(this).addClass(anime);
			});
		}else{
			$(this).find('.animated').each(function(){
				var anime = $(this).attr('data-animated');
				$(this).removeClass(anime);
			});
		}
	});
}
function slick_animated(){
	$('.banner-slider .item-slider').each(function(){
		var check = $(this).hasClass('slick-active');
		if(check==true){
			$(this).find('.animated').each(function(){
				var anime = $(this).attr('data-animated');
				$(this).addClass(anime);
			});
		}else{
			$(this).find('.animated').each(function(){
				var anime = $(this).attr('data-animated');
				$(this).removeClass(anime);
			});
		}
	});
}
function slick_control(){
	$('.slick-slider').each(function(){
		$(this).find('.slick-prev').html($('.slick-active').prev().find('.client-thumb a').html());
		$(this).find('.slick-next').html($('.slick-active').next().find('.client-thumb a').html());
	});
}
//Detail Gallery
function detail_gallery(){
	if($('.detail-gallery').length>0){
		$('.detail-gallery').each(function(){
           /* var visible = $(this).find(".carousel").attr("data-visible");
            console.log(visible);
			$(this).find(".carousel").jCarouselLite({
				btnNext: $(this).find(".gallery-control .next"),
				btnPrev: $(this).find(".gallery-control .prev"),
				speed: 800,
				visible:visible
			});*/
			$(this).find(".carousel .list-none").owlCarousel({
                addClassActive:true,
                stopOnHover:true,
                lazyLoad:true,
                itemsCustom:[[0, 4]],
                navigation:true,
                pagination:false,
                navigationText:['<i class="icon ion-ios-arrow-thin-left"></i>','<i class="icon ion-ios-arrow-thin-right"></i>'],
			});
			//Elevate Zoom
			if($(window).width()>991){
                $('.detail-gallery').find('.mid img').elevateZoom({
                    zoomType: "inner",
                    cursor: "crosshair",
                    zoomWindowFadeIn: 500,
                    zoomWindowFadeOut: 750
                });
			}


			$(this).find(".carousel a").on('click',function(event) {
				event.preventDefault();
				$(this).parents('.detail-gallery').find(".carousel a").removeClass('active');
				$(this).addClass('active');
				var z_url =  $(this).find('img').attr("src");
				var srcset =  $(this).find('img').attr("srcset");
				$(this).parents('.detail-gallery').find(".mid img").attr("src", z_url);
				$(this).parents('.detail-gallery').find(".mid img").attr("srcset", srcset);
				$('.zoomWindow').css('background-image','url("'+z_url+'")');
                $('.zoomWindow').css('background-image','url("'+z_url+'")');
                $.removeData($('.detail-gallery').find('.mid img'), 'elevateZoom');//remove zoom instance from image
                if($(window).width()>991) {
                    $('.zoomContainer').remove();
                    $('.detail-gallery').find('.mid img').elevateZoom({
                        zoomType: "inner",
                        cursor: "crosshair",
                        zoomWindowFadeIn: 500,
                        zoomWindowFadeOut: 750
                    });
                }
			});
		});
	}
}
//Background Image
function background_image(){
	if($('.banner-background').length>0){
		$('.banner-background').each(function(){
			var i_url = $(this).find('.image-background').attr("src");
			$(this).css('background-image','url("'+i_url+'")');	
		});
	}
}

//Document Ready
jQuery(document).ready(function(){
    //Parallax Slider

	/*check browser*/
	var userAgent = navigator.userAgent.toLowerCase();
	$.browser.chrome = /chrome/.test(navigator.userAgent.toLowerCase());
	if(!!navigator.userAgent.match(/Trident\/7\./)){
		$('body').addClass('browserIE');
		$('body').addClass('browserIE' + $.browser.version.substring(0,1));
	}
	if($.browser.chrome){

		$('body').addClass('browserChrome');
		userAgent = userAgent.substring(userAgent.indexOf('chrome/') +7);
		userAgent = userAgent.substring(0,1);
		$('body').addClass('browserChrome' + userAgent);
		$.browser.safari = false;
	}
	if($.browser.safari){
		$('body').addClass('browserSafari');
		userAgent = userAgent.substring(userAgent.indexOf('version/') +8);
		userAgent = userAgent.substring(0,1);
		$('body').addClass('browserSafari' + userAgent);
	}
	if($.browser.mozilla){
		if(navigator.userAgent.toLowerCase().indexOf('firefox') != -1){
			$('body').addClass('browserFirefox');
			userAgent = userAgent.substring(userAgent.indexOf('firefox/') +8);
			userAgent = userAgent.substring(0,1);
			$('body').addClass('browserFirefox' + userAgent);
		}
		else{
			$('body').addClass('browserMozilla');
		}
	}
	if($.browser.opera){
		$('body').addClass('browserOpera');
	}
	//Full Mega Menu

	//Vegetable Hover
	if($('.fruit-list-cat').length>0){
		$('.fruit-list-cat').each(function(){
			$(this).find('.item-fruit-cat1').on('mouseover',function(){
				$(this).parents('.fruit-list-cat').find('.item-fruit-cat1').removeClass('item-center');
				$(this).addClass('item-center');
			});
			$(this).on('mouseout',function(){
				$(this).find('.item-fruit-cat1').removeClass('item-center');
				$(this).find('.item-active').addClass('item-center');
			});
		});
	}
	//Filter Price
	if($('.range-filter').length>0){
		$('.range-filter').each(function(){
			$(this).find( ".slider-range" ).slider({
				range: true,
				min: 0,
				max: 800,
				values: [ 50, 545 ],
				slide: function( event, ui ) {
					$(this).parents('.range-filter').find( ".amount" ).html( '<span>' + 'Price: $' +ui.values[ 0 ]+'</span>' + '<span>' + ' - $' + ui.values[ 1 ]+'</span>');
				}
			});
			$(this).find( ".amount" ).html('<span>' + 'Price: $' +$(this).find( ".slider-range" ).slider( "values", 0 )+'</span>' + '<span>'+ ' - $' +$(this).find( ".slider-range" ).slider( "values", 1 )+'</span>');
		});
	}
	//Custom Scroll
	custom_scroll();
	//Detail Gallery
	detail_gallery();
	//Wishlist Popup
	popup_wishlist();
	//Menu Responsive 
	rep_menu();
	//Offset Menu
	offset_menu();
	//Toggle Tab
	toggle_tab();
	//Background Image
	background_image();
	//Animate
	if($('body.browserIE9').length<=0){
		if($('.wow').length>0){
			new WOW().init();
		}
	}

	//Video Light Box
	if($('.btn-video').length>0){
		$('.btn-video').fancybox({
			openEffect : 'none',
			closeEffect : 'none',
			prevEffect : 'none',
			nextEffect : 'none',

			arrows : false,
			helpers : {
				media : {},
				buttons : {}
			}
		});	
	}
	//Light Box
	if($('.mb-element-gallery').length>0){
		$(this).find('.fancybox').fancybox();
	}
	//Back To Top
	$('.scroll-top').on('click',function(event){
		event.preventDefault();
		$('html, body').animate({scrollTop:0}, 'slow');
	});
	//Shop The Look

});
//Window Load
jQuery(window).on('load',function(){ 
	//Owl Carousel
	if($('.wrap-item').length>0){
		$('.wrap-item').each(function(){
			var data = $(this).data();
			$(this).owlCarousel({
				addClassActive:true,
				stopOnHover:true,
				lazyLoad:true,
				itemsCustom:data.itemscustom,
				autoPlay:data.autoplay,
				transitionStyle:data.transition, 
				paginationNumbers:data.paginumber,
				beforeInit:background,
				afterAction:animated,
				navigationText:['<i class="icon ion-ios-arrow-thin-left"></i>','<i class="icon ion-ios-arrow-thin-right"></i>'],
			});
		});
	}
    if($('.parallax-slider').length>0){
        $(window).scroll(function() {
            var ot = $('.parallax-slider').offset().top;
            var sh = $('.parallax-slider').height();
            var st = $(window).scrollTop();
            var top = (($(window).scrollTop() - ot) * 0.5) + 'px';
            if(st>ot&&st<ot+sh){
                $('.parallax-slider .item-slider').css({
                    'background-position': 'center ' + top
                });
            }
            if(st<ot){
                $('.parallax-slider .item-slider').css({
                    'background-position': 'center 0'
                });
            }else{
                return false;
            }
        });
    }
	//Slick Slider
	if($('.client-slider .slick').length>0){
		$('.client-slider .slick').each(function(){
			$(this).slick({
				fade: true,
				infinite: true,
				initialSlide:1,
				slidesToShow: 1,
				prevArrow:'<div class="slick-prev slick-nav"></div>',
				nextArrow:'<div class="slick-next slick-nav"></div>',
			});
			slick_control();
			$('.slick').on('afterChange', function(event){
				slick_control();
			});
		});
	}
	//Slick Slider
	if($('.product-style1b-slick').length>0){
		$('.product-style1b-slick').each(function(){
            if($(window).width()>1440){
                $(this).slick({
                    centerMode: true,
                    centerPadding: '400px',
                    slidesToShow: 1,
                });
            }else if($(window).width()>1024){
                $(this).slick({
                    centerMode: true,
                    centerPadding: '250px',
                    slidesToShow: 1,
                });
            }
           else{
                $(this).slick({
                    centerMode: true,
                    centerPadding: '0px',
                    slidesToShow: 1,
                    arrows: false,
                });
            }

		});
	}


	//Day Countdown
	if($('.days-countdown').length>0){
		$(".days-countdown").TimeCircles({
			fg_width: 0.05,
			bg_width: 0,
			text_size: 0,
			circle_bg_color: "transparent",
			time: {
				Days: {
					show: true,
					text: "Days",
					color: "#fff"
				},
				Hours: {
					show: true,
					text: "Hours",
					color: "#fff"
				},
				Minutes: {
					show: true,
					text: "Mins",
					color: "#fff"
				},
				Seconds: {
					show: true,
					text: "Secs",
					color: "#fff"
				}
			}
		}); 
	}
	//Day Countdown
	if($('.deal-timer').length>0){
		$(".deal-timer").TimeCircles({
			fg_width: 0.05,
			bg_width: 0,
			text_size: 0,
			circle_bg_color: "transparent",
			time: {
				Days: {
					show: true,
					text: "",
					color: "#fff"
				},
				Hours: {
					show: true,
					text: "",
					color: "#fff"
				},
				Minutes: {
					show: true,
					text: "",
					color: "#fff"
				},
				Seconds: {
					show: true,
					text: "",
					color: "#fff"
				}
			}
		}); 
	}
	//Count Down Master
	if($('.countdown-master').length>0){
		$('.countdown-master').each(function(){
			$(this).FlipClock(65100,{
		        clockFace: 'HourlyCounter',
		        countdown: true,
		        autoStart: true,
		    });
		});
	}
	//Blog Masonry 
	if($('.masonry-list-post').length>0){
		$('.masonry-list-post').masonry({
			// options
			itemSelector: '.item-post-masonry',
		});
	}
});
//Window Resize
jQuery(window).on('resize',function(){
	offset_menu();
	fixed_header();
	detail_gallery();
});
//Window Scroll
jQuery(window).on('scroll',function(){
	//Scroll Top
	if($(this).scrollTop()>$(this).height()){
		$('.scroll-top').addClass('active');
	}else{
		$('.scroll-top').removeClass('active');
	}
	//Fixed Header
	fixed_header();
	//Rotate Number
	if($('.list-statistic').length>0){
		var hT = $('.list-statistic').offset().top;
		var	hH = $('.list-statistic').outerHeight();
		var	wH = $(window).height();
		var	wS = $(this).scrollTop();
		if (wS > (hT + hH - wH)) {
			$('.numscroller').each(function() {
				$(this).prop('Counter', 0).animate({
					Counter: $(this).text()
				}, {
					duration: 1000,
					easing: 'swing',
					step: function() {
						$(this).text(Math.ceil(this.Counter));
					}
				});
			}); {
				$('.rotate-number').removeClass('numscroller');
			};
		}
	}
});
})(jQuery); // End of use strict