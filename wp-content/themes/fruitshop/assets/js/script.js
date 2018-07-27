(function($){
    "use strict"; // Start of use strict  

    /************** FUNCTION ****************/ 

    // Menu fixed
    function fixed_header(){
        var menu_element;
        menu_element = $('.main-nav:not(.menu-fixed-content)').closest('.vc_row');
        if($('.menu-fixed-enable').length > 0 && $(window).width()>1024){           
            var menu_class = $('.main-nav').attr('class');
            var header_height = $("#header").height()+100;
            var ht = header_height + 150;
            var st = $(window).scrollTop();

            if(!menu_element.hasClass('header-fixed') && menu_element.attr('data-vc-full-width') == 'true') menu_element.addClass('header-fixed');
            if(st>header_height){               
                if(menu_element.attr('data-vc-full-width') == 'true'){
                    if(st > ht) menu_element.addClass('active');
                    else menu_element.removeClass('active');
                    menu_element.addClass('fixed-header');
                }
                else{
                    if(st > ht) menu_element.parent().parent().addClass('active');
                    else menu_element.parent().parent().removeClass('active');
                    if(!menu_element.parent().parent().hasClass('fixed-header')){
                        menu_element.wrap( "<div class='menu-fixed-content fixed-header "+menu_class+"'><div class='container'></div></div>" );
                    }
                }
            }else{
                menu_element.removeClass('active');
                if(menu_element.attr('data-vc-full-width') == 'true') menu_element.removeClass('fixed-header');
                else{
                    if(menu_element.parent().parent().hasClass('fixed-header')){
                        menu_element.unwrap();
                        menu_element.unwrap();
                    }
                }
            }
        }
        else{
            menu_element.removeClass('active');
            if(menu_element.attr('data-vc-full-width') == 'true') menu_element.removeClass('fixed-header');
            else{
                if(menu_element.parent().parent().hasClass('fixed-header')){
                    menu_element.unwrap();
                    menu_element.unwrap();
                }
            }
        }
    }
    function background(){
		$('.bg-slider .item-slider').each(function(){
			var src=$(this).find('.banner-thumb a img').attr('src');
			$(this).css('background-image','url("'+src+'")');
		});	
	}
    
    function fix_variable_product(){
    	//Fix product variable thumb    	
        $('body .variations_form select').live('change',function(){
            var id = $('input[name="variation_id"]').val();
            if(id){
                $('.product-gallery #bx-pager').find('a[data-variation_id="'+id+'"]').trigger( 'click' );
            }
        })
        // variable product
        if($('.wrap-attr-product1.special').length > 0){
            $('.attr-filter ul li a').live('click',function(){
                event.preventDefault();
                $(this).parents('ul').find('li').removeClass('active');
                $(this).parent().addClass('active');
                var attribute = $(this).parent().attr('data-attribute');
                var id = $(this).parents('ul').attr('data-attribute-id');
                $('#'+id).val(attribute);
                $('#'+id).trigger( 'change' );
                $('#'+id).trigger( 'focusin' );
                return false;
            })
            $('.attr-hover-box').hover(function(){
                var seff = $(this);
                var old_html = $(this).find('ul').html();
                var current_val = $(this).find('ul li.active').attr('data-attribute');
                $(this).next().find('select').trigger( 'focusin' );
                var content = '';
                $(this).next().find('select').find('option').each(function(){
                    var val = $(this).attr('value');
                    var title = $(this).html();
                    var el_class = '';
                    if(current_val == val) el_class = ' class="active"';
                    if(val != ''){
                        content += '<li'+el_class+' data-attribute="'+val+'"><a href="#" class="bgcolor-'+val+'"><span></span>'+title+'</a></li>';
                    }
                })
                // console.log(content);
                if(old_html != content) $(this).find('ul').html(content);
            })
            $('body .reset_variations').live('click',function(){
                $('.attr-hover-box').each(function(){
                    var seff = $(this);
                    var old_html = $(this).find('ul').html();
                    var current_val = $(this).find('ul li.active').attr('data-attribute');
                    $(this).next().find('select').trigger( 'focusin' );
                    var content = '';
                    $(this).next().find('select').find('option').each(function(){
                        var val = $(this).attr('value');
                        var title = $(this).html();
                        var el_class = '';
                        if(current_val == val) el_class = ' class="active"';
                        if(val != ''){
	                        content += '<li'+el_class+' data-attribute="'+val+'"><a href="#" class="bgcolor-'+val+'"><span></span>'+title+'</a></li>';
	                    }
                    })
                    if(old_html != content) $(this).find('ul').html(content);
                    $(this).find('ul li').removeClass('active');
                })
            })
        }
        //end
    }
    
    function afterAction(){
		this.$elem.find('.owl-item').removeClass('active');
		this.$elem.find('.owl-item').eq(this.owl.currentItem).addClass('active');
		this.$elem.find('.owl-item').each(function(){
			// $(this).find('.wow').removeClass('animated');
			var check = $(this).hasClass('active');
			if(check==true){
				$(this).find('.animated').each(function(){
					var anime = $(this).attr('data-anim-type');
					$(this).addClass(anime);
				});
			}else{
				$(this).find('.animated').each(function(){
					var anime = $(this).attr('data-anim-type');
					$(this).removeClass(anime);
				});
			}
		})
	}

    function s7upf_qty_click(){
        $("body").on("click",".quantity .qty-up",function(){
            var seff = $(this).parents('.quantity').find('input');
            var min = seff.attr("min");
            var max = seff.attr("max");
            var step = seff.attr("step");
            if(step === undefined) step = 1;
            if(max !==undefined && Number(seff.val())< Number(max) || max === undefined || !max){
                if(step!='') seff.val(Number(seff.val())+Number(step));
            }
            $( 'body .button[name="update_cart"]' ).prop( 'disabled', false );

            return false;
        })
        $("body").on("click",".quantity .qty-down",function(){
            var seff = $(this).parents('.quantity').find('input');
            var min = seff.attr("min");
            var max = seff.attr("max");
            var step = seff.attr("step");
            if(step === undefined) step = 1;
            if(Number($(this).next('input').val()) > 1){
                if(min !==undefined && seff.val()>min || min === undefined || !min){
                    if(step!='') seff.val(Number(seff.val())-Number(step));
                }
            }
            $( 'body .button[name="update_cart"]' ).prop( 'disabled', false );
            return false;
        })
        $("body").on("keyup change","input.qty-val",function(){
            var max = $(this).attr('data-max');
            if( Number($(this).val()) > Number(max) ) $(this).val(max);
            $( 'body .button[name="update_cart"]' ).prop( 'disabled', false );
        })
    }

    function s7upf_owl_slider(){
    	//Carousel Slider
		if($('.sv-slider').length>0){
			$('.sv-slider').each(function(){
				var seff = $(this);
				var item = seff.attr('data-item');
				var speed = seff.attr('data-speed');
				var itemres = seff.attr('data-itemres');
				var animation = seff.attr('data-animation');
				var nav = seff.attr('data-nav');
				var text_prev = seff.attr('data-prev');
				var text_next = seff.attr('data-next');
				var pagination = false, navigation= true, singleItem = false;
				var autoplay;
				if(speed != '') autoplay = speed;
				else autoplay = false;
				// Navigation
				if(nav == 'nav-hidden'){
					pagination = false;
					navigation= false;
				}
				if(nav == 'banner-slider3' || nav == 'about-testimo-slider'){
					pagination = true;
					navigation= false;
				}
				if(nav == 'banner-slider2 banner-slider11'){
					pagination = true;
					navigation= true;
				}
				if(animation != ''){
					singleItem = true;
					item = '1';
				}
				var prev_text = '<i class="fa fa-angle-left" aria-hidden="true"></i>';
				var next_text = '<i class="fa fa-angle-right" aria-hidden="true"></i>';
				if(nav == 'nav-text-data'){
					var prev_text = text_prev;
					var next_text = text_next;
				}
				if(nav == 'banner-slider2' || nav == 'banner-slider13' || nav == 'about-service-slider' || nav == 'banner-slider9 long-arrow' || nav == 'banner-slider10' || nav == 'hotcat-slider14 arrow-style14' || nav == 'banner-slider2 banner-slider11'){
					prev_text = '<i class="fa fa-arrow-circle-left" aria-hidden="true"></i>';
					next_text = '<i class="fa fa-arrow-circle-right" aria-hidden="true"></i>';
				}
				if(itemres == '' || itemres === undefined){
					if(item == '1') itemres = '0:1,480:1,768:1,1200:1';
					if(item == '2') itemres = '0:1,480:1,768:2,1200:2';
					if(item == '3') itemres = '0:1,480:2,768:2,1200:3';
					if(item == '4') itemres = '0:1,480:2,768:2,1200:4';
					if(item >= '5') itemres = '0:1,480:2,568:3,1024:5,1200:'+item;
				}				
				itemres = itemres.split(',');
				var i;
				for (i = 0; i < itemres.length; i++) { 
				    itemres[i] = itemres[i].split(':');
				}
				seff.owlCarousel({
					items: item,
					itemsCustom: itemres,
					autoPlay:autoplay,
					pagination: pagination,
					navigation: navigation,
					navigationText:[prev_text,next_text],
					singleItem : singleItem,
					beforeInit:background,
					// addClassActive : true,
					afterAction: afterAction,
					transitionStyle : animation
				});
			});			
		}
    }

    function s7upf_all_slider(){
    	//Carousel Slider
		if($('.smart-slider').length>0){
			$('.smart-slider').each(function(){
				var seff = $(this);
				var item = seff.attr('data-item');
				var speed = seff.attr('data-speed');
				var itemres = seff.attr('data-itemres');
				var text_prev = seff.attr('data-prev');
				var text_next = seff.attr('data-next');
				var pagination = seff.attr('data-pagination');
				var navigation = seff.attr('data-navigation');
				var paginumber = seff.attr('data-paginumber');
				var autoplay;
				if(speed === undefined) speed = '';
				if(speed != '') autoplay = speed;
				else autoplay = false;
				if(item == '' || item === undefined) item = 1;
				if(itemres === undefined) itemres = '';
				if(text_prev == 'false') text_prev = '';
				else{
					if(text_prev == '' || text_prev === undefined) text_prev = '<i class="icon ion-ios-arrow-thin-left" aria-hidden="true"></i>';
					else text_prev = '<i class="fa '+text_prev+'" aria-hidden="true"></i>';
				}
				if(text_next == 'false') text_next = '';
				else{
					if(text_next == '' || text_next === undefined) text_next = '<i class="icon ion-ios-arrow-thin-right" aria-hidden="true"></i>';
					else text_next = '<i class="fa '+text_next+' aria-hidden="true"></i>';
				}
				if(pagination == 'true') pagination = true;
				else pagination = false;
				if(navigation == 'true') navigation = true;
				else navigation = false;
				if(paginumber == 'true') paginumber = true;
				else paginumber = false;
				// Item responsive
				if(itemres == '' || itemres === undefined){
					if(item == '1') itemres = '0:1,480:1,768:1,1024:1';
					if(item == '2') itemres = '0:1,480:1,768:2,1024:2';
					if(item == '3') itemres = '0:1,480:2,768:2,1024:3';
					if(item == '4') itemres = '0:1,480:2,768:2,1024:4';
					if(item >= '5') itemres = '0:1,480:2,568:3,1024:'+item;
				}				
				itemres = itemres.split(',');
				var i;
				for (i = 0; i < itemres.length; i++) { 
				    itemres[i] = itemres[i].split(':');
				}
				seff.owlCarousel({
					items: item,
					itemsCustom: itemres,
					autoPlay:autoplay,
					pagination: pagination,
					navigation: navigation,
					navigationText:[text_prev,text_next],
					paginationNumbers:paginumber,
					// addClassActive : true,
					// afterAction: afterAction,
				});
			});			
		}
    }
    function tool_panel(){
        $('.dm-open').on('click',function(){
            $('#widget_indexdm').toggleClass('active');
            $('#indexdm_img').toggleClass('background');
            $('.dm-content .item-content').hover(
                function(){
                    $('#indexdm_img').addClass('active');
                    var img_src = $(this).find('img').attr('data-src');
                    $('.img-demo').css('display','block');
                    $('.img-demo').css('background-image','url('+img_src+')');
                },
                function(){
                    $('#indexdm_img').removeClass('active');
                    $('.img-demo').attr('style','');
                }
            );
            return false;
        })
    }
    /************ END FUNCTION **************/  
	$(document).ready(function(){
        tool_panel();
		//Menu Responsive
		s7upf_qty_click();
		fix_variable_product();
		if($('.fruit-list-cat').length>0){
			$('.fruit-list-cat').each(function () {
				$(this).find('.fruit-list-cat').removeClass('fruit-list-cat');
			})
		}
		$('.box-hover-dir').each( function() {
			$(this).hoverdir();
		});
		if($('.mb-mailchimp').length>0){
			$('.mb-mailchimp').each(function () {
				var namesubmit = $(this).data('namesubmit');
				var placeholder = $(this).data('placeholder');
				if(placeholder) $(this).find('input[name="EMAIL"]').attr('placeholder',placeholder);
				if(namesubmit) $(this).find('input[type="submit"]').val(namesubmit);
			})
		}

		if($('.mb-element-product-style4').length>0){
			$('.mb-element-product-style4').each(function(){
				$(this).find('.add_to_cart_button.button').addClass('addcart-link color');
				$(this).find('.product_type_external.button').addClass('addcart-link color');
				$(this).find('.product_type_grouped.button').addClass('addcart-link color');
				$(this).find('.add_to_cart_button.button').html('<i class="fa fa-shopping-basket" aria-hidden="true"></i>');
				$(this).find('.product_type_external.button').html('<i class="fa fa-shopping-basket" aria-hidden="true"></i>');
				$(this).find('.product_type_grouped.button').html('<i class="fa fa-shopping-basket" aria-hidden="true"></i>');
			});
		}
		if($('.mb-element-product-style6').length>0){
			$('.mb-element-product-style6').each(function(){
				$(this).find('.add_to_cart_button.button').addClass('addcart-link color');
				$(this).find('.product_type_external.button').addClass('addcart-link color');
				$(this).find('.product_type_grouped.button').addClass('addcart-link color');
				$(this).find('.add_to_cart_button.button').html('<i class="fa fa-shopping-basket" aria-hidden="true"></i>');
				$(this).find('.product_type_external.button').html('<i class="fa fa-shopping-basket" aria-hidden="true"></i>');
				$(this).find('.product_type_grouped.button').html('<i class="fa fa-shopping-basket" aria-hidden="true"></i>');
			});
		}
		$('.live-search-on input[name="s"]').on('click',function(event){
			event.preventDefault();
			event.stopPropagation();
			$(this).parents('.live-search-on').addClass('active');
		})
		$('body').on('click',function(event){
			$('.live-search-on.active').removeClass('active');
		})
		//menu mega
		$(".s7up_mega_menu").parent().parent('.menu-item').addClass("has-mega-menu");
		if($('.main-nav').length>0){
			$('.main-nav').each(function(){
				var nav_os = $(this).offset().left;
				var par_os = $(this).parents('.container').offset().left;
				var nav_left = nav_os - par_os - 15;
				$(this).find('.has-mega-menu > .sub-menu').css('margin-left','-'+nav_left+'px');
			});
		}
		//map
		$(".mb-google-map").each(function () {
			$(this).find('.control-mask').click(function () {
				console.log($(this).find('.mask'));
			$('.mb-google-map .mask').animate({
				height: 'toggle',
				width: 'toggle',
			});
			})

		})
		//Fix mailchimp
        $('.sv-mailchimp-form').each(function(){
            var placeholder = $(this).attr('data-placeholder');
            var submit = $(this).attr('data-submit');
            if(placeholder) $(this).find('input[name="EMAIL"]').attr('placeholder',placeholder);
            if(submit) $(this).find('input[type="submit"]').val(submit);
        })
		//Count item cart
        if($("#count-cart-item").length){
            var count_cart_item = $("#count-cart-item").val();
            $(".cart-item-count").html(count_cart_item);
        }        
        //Back To Top
		$('.scroll-top').on('click',function(event){
			event.preventDefault();
			$('html, body').animate({scrollTop:0}, 'slow');
		});
		//Cat search
		$('.select-category ul li a').click(function(event){
			event.preventDefault();
			$(this).parents('.list-category-toggle').find('li').removeClass('active');
			$(this).parent().addClass('active');
			var x = $(this).attr('data-filter');
			if(x){
				x = x.replace('.','');
				$('.cat-value').val(x);
			}
			else $('.cat-value').val('');
			$('.category-toggle-link span').text($(this).text());
		});

	});

	$(window).load(function(){
		s7upf_owl_slider();
		s7upf_all_slider();
		// menu fixed onload

        // rtl-enable
        // rtl-enable
        if($('.rtl-enable').length > 0){
            $('*[data-vc-full-width="true"]').each(function(){
                var style = $(this).attr('style');
                style = style.replace("left","right");
                $(this).attr('style',style);
            })
        }
		//menu fix
		if($(window).width() >= 768){
			var c_width = $(window).width();
			$('.main-nav ul ul ul.sub-menu').each(function(){
				var left = $(this).offset().left;
				if(c_width - left < 180){
					$(this).css({"left": "-100%"})
				}
				if(left < 180){
					$(this).css({"left": "100%"})
				}
			})
		}
	});// End load

	/* ---------------------------------------------
     Scripts resize
     --------------------------------------------- */
	var w_width = $(window).width();
	$(window).resize(function(){
		var c_width = $(window).width();
        setTimeout(function() {
            if($('.rtl-enable').length > 0 && c_width != w_width){
                $('*[data-vc-full-width="true"]').each(function(){
                    var style = $(this).attr('style');
                    style = style.replace(" left:"," right:");
                    $(this).attr('style',style);
                })
                w_width = c_width;
            }
        }, 3000);
	});

	jQuery(window).scroll(function(){
		fixed_header();

		//Scroll Top
		if($(this).scrollTop()>$(this).height()){
			$('.scroll-top').addClass('active');
		}else{
			$('.scroll-top').removeClass('active');
		}
	});// End Scroll

})(jQuery);