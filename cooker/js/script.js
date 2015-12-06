(function($) {;
	var mealsCarousel = $('#meals-of-the-day .meals-of-the-day-jcarousel');

	//==============================================
			// DOCUMENT READY
	//==============================================
	$(document).ready(function() {
		var clickEvent;
		if(isMobile()) {
			clickEvent = "touchend";
		}else {
			clickEvent = "click";
		}


		//==============================================
				//Main Menu
		//==============================================
		$('header .top-nav nav.desktop ul  li').mouseenter(function(){
			if($(this).find('ul').length) { 
				$(this).find('ul').first().stop(true, true).fadeIn();
				$(this).siblings().find('ul').css('display','none');
			}
		});

		$('header .top-nav nav.desktop ul  li').mouseleave(function(){
			if($(this).find('ul').length) {
				$(this).find('ul').first().stop(true, true).delay(500).fadeOut('fast');
			}
		});

		//==============================================
				//Mobile Menu
		//==============================================

		$('.dsm-mobile-nav li.dsm-search').on(clickEvent,function(e) {
			e.preventDefault();
			e.stopPropagation();

			var searchHolder = $('.dsm-mobile-nav-dropdown .dsm-mobile-search-hidden');
			searchHolder.toggleClass('open');
			
			if(searchHolder.hasClass('open')) {
				$('.dsm-mobile-search-hidden input.search-field').focus();
			}else {
				$('.dsm-mobile-search-hidden input.search-field').focusout();
			}
		});

		$('.dsm-mobile-nav li.dsm-mobile-nav').on(clickEvent,function(e) {
			e.preventDefault();
			e.stopPropagation();

			$('.dsm-mobile-nav-dropdown .dsm-mobile-nav-hidden').toggleClass('open');
		});

		//==============================================
				//Shop Menu Card
		//==============================================

		$('.dsm-menu-card-nav li a').click(function (e) {
            e.preventDefaultEvents;
            var catId = $(this).data('catid');

            if(catId != '-1') {
                $('.dsm-menu-card-wrapper').addClass('full-width');
                $('.dsm-menu-card > li').css('display', 'none');
                $('.dsm-menu-card > li[data-catid=' + catId + ']').fadeIn();
            } else {
                $('.dsm-menu-card-wrapper').removeClass('full-width');
                $('.dsm-menu-card > li').fadeIn();
            }
        });

		//==============================================
				//Lava Menu
		//==============================================
		var style = 'easeOutElastic';
		// Main Menu hover and current functionality
		if($('.main-menu li.current-cat').length){
			currentCheck = 1; //check if there is current 1== yes 0 == no
			default_left = Math.round($('.main-menu li.current-cat').offset().left - $('.main-menu').offset().left - 5);
			default_top = Math.round($('.main-menu li.current-cat').offset().top - $('.main-menu').offset().top);
			default_width = $('.main-menu li.current-cat').width();
			default_height = $('.main-menu li.current-cat').height();
		} else {
			currentCheck = 0; //check if there is current
			default_left = 0;
			default_top = 0;
			default_width = 0;
			default_height = 47;
			$('.main-menu #lava-elm').css('opacity','0');
		}

		$('.main-menu #lava-elm').stop(false, true).animate({top: default_top, left: default_left, width: default_width, height: default_height},{duration:10});

		$('.main-menu ul > li').not('ul ul li').mouseenter(function (){
			if (!$(this).is('#lava-elm')) {
				elemTop = Math.round($(this).offset().top - $('.main-menu').offset().top);
				elemLeft = Math.round($(this).offset().left - $('.main-menu').offset().left - 5);
				width = $(this).width();
				height = $(this).height();

				$('#lava-elm').stop(false, false).animate({
					top: elemTop, 
					left: elemLeft, 
					width:width, 
					height:height
				},{duration:700,easing: style});

				if (currentCheck == 0) {
					$('.main-menu #lava-elm').css('opacity','100');
				}
				//SUB MENU
				if($(this).find('ul').length) { 
					$('ul',this).stop(true, true).slideDown(500);
				}
				$(this).siblings().find('ul').css('display','none');
			}
		});

		$('.main-menu').mouseleave(function () {
			//Set the floating bar position, width and transition
			if (currentCheck == 0) {
				$('.main-menu #lava-elm').css('opacity','0');
			}

			$('.main-menu ul li ul').stop(true, true).delay(500).css('display','none');
			$('.main-menu #lava-elm').stop(false, true).animate({top: default_top, left: default_left, width: default_width,height: default_height},{duration:100});
		});

		//==============================================
				//Main Carousel Starter
		//==============================================
		if($('body').is('.home')){
			var HeaderCarousel = $('.jcarousel-skin-header-slider .jcarousel');

			HeaderCarousel.on('jcarousel:reload jcarousel:create', function () {
				var carousel = $(this),
						width = carousel.innerWidth();

				carousel.jcarousel('items').css('width', Math.ceil(width) + 'px');
			}).jcarousel({
				scroll: 1,
				wrap: 'both'
			});

		 $('.header-slider-prev').on(clickEvent, function(e) {
			e.preventDefault();
			HeaderCarousel.jcarousel('scroll', '-=1');
		});

		$('.header-slider-next').on(clickEvent, function(e) {
			e.preventDefault();
				HeaderCarousel.jcarousel('scroll', '+=1');
		});

		//==============================================
				//Meals Carousel Starter
		//==============================================
		$('#meals-of-the-day .jcarousel-prev').on(clickEvent, function(e) {
			e.preventDefault();
			mealsCarousel.jcarousel('scroll', '-=3');
		});

		$('#meals-of-the-day .jcarousel-next').on(clickEvent, function(e) {
			e.preventDefault();
			mealsCarousel.jcarousel('scroll', '+=3');
		});
	}

	mealsCarouselFunction();
	//////////////////////

	//==============================================
			//Open Sidebar
	//==============================================
	$('.open-sidebar').on('click', function(e){
		e.preventDefault();

		sidebarMobileOpening();
	});

	$('#content, .content').on('click', function(){

		if($('.right-content.main').hasClass('open')){
			sidebarMobileOpening();
		}
	});
	$('.right-content.main').on(clickEvent, function(e){
		e.stopPropagation();
	})

	$(window).resize(function() {
		mealsCarouselFunction();
	});
});//===End Doc Ready


	//==============================================
			//Payment Method
	//==============================================
	$('#payment-methods ul li').click(function () {
		$('#payment-methods ul li .form-controls.checked').removeClass('checked');
		$('#payment-methods ul li input').attr('checked',false);
		$('.form-controls',this).addClass('checked');
		$('input', this).attr('checked',true);    
	});


	//==============================================
			//Front Slider Init Callback
	//==============================================

	 // function mycarousel_initCallback(carousel)  {
	 //      // Pause autoscrolling if the user moves with the cursor over the clip.
	 //      $('#mycarousel .description').mouseenter(function() {
	 //          carousel.stopAuto();
	 //      });
	 //      $('#mycarousel .description').mouseleave(function() {
	 //          carousel.startAuto();
	 //      });
	 //  }; 


	function mealsCarouselFunction () {
		winWidth = $(window).width();	
		if (winWidth <= 1024) {
			if(!mealsCarousel.hasClass('off')) {
				mealsCarousel.jcarousel('destroy');
				mealsCarousel.addClass('off');

				$('#meals-of-the-day .jcarousel-next, #meals-of-the-day .jcarousel-prev').css('display', 'none');
			}
			} else {
				if( !!mealsCarousel.hasClass('off') ) {
					mealsCarousel.jcarousel({
					wrap : 'both'
					,itemFallbackDimension : 400
				});

				mealsCarousel.removeClass('off');

				$('#meals-of-the-day .jcarousel-next, #meals-of-the-day .jcarousel-prev').css('display', 'inline-block');
			}
		}
	}

	function sidebarMobileOpening () {
		var sidebar = $('.right-content.main'),
			mainCnt = $('#content, .content');

		$('.right-content a.open-sidebar').toggleClass('active');
		sidebar.toggleClass('open');

		if(sidebar.hasClass('open')){
			if(sidebar.height() > mainCnt.height()) {
				mainCnt.css('height', sidebar.height());
			}
		}else {
			mainCnt.css('height', 'auto');
		}
	}

	function isMobile() { 
		if( navigator.userAgent.match(/Android/i)
		|| navigator.userAgent.match(/webOS/i)
		|| navigator.userAgent.match(/iPhone/i)
		|| navigator.userAgent.match(/iPad/i)
		|| navigator.userAgent.match(/iPod/i)
		|| navigator.userAgent.match(/BlackBerry/i)
		|| navigator.userAgent.match(/Windows Phone/i)
		){
			return true;
		}
		else {
			return false;
		}
	}
})(jQuery);



/** OTHER STUFf */


function displayPopupWarn(link, returnurl) {
    jQuery('#popupwarn').find('.close').css('display', 'block');
    jQuery('#popupwarn').find('.action_close').css('display', 'block');

    jQuery('#popupwarn').css('display', 'block');
    jQuery('#popupwarn .action_continue').attr('href', link + '?clear-cart=1');
    if (returnurl) {
        jQuery('#popupwarn').find('.close').css('display', 'none');
        jQuery('#popupwarn').find('.action_close').attr('href', returnurl);
    }
}

jQuery(document).ready(function() {

    jQuery('img[usemap]').rwdImageMaps();

    //

    jQuery(".location").on({
        click: function() {
            var active = jQuery('#menu-peamenuu li.current-page-ancestor a');
            var type = $(active).attr('title');
            var name = $(this).attr('name');
            var data = {
                action: 'woocommerce_update_shipping_method',
                security: woocommerce_params.update_shipping_method_nonce,
                shipping_method: 'wc_pizzashipper',
                type: type,
                name: name
            };

            $.post(woocommerce_params.ajax_url, data, function(response) {
                $('.woocommerce_error').css('display', 'none');
                $('#order_review').replaceWith(response);
                $('.map-popup').css('display', 'none');

            });
        },
        mouseenter: function() {
            var map = jQuery(this).attr('file');
            var img = jQuery('#mapurl').html() + 'map_hovers/' + map + '.png';
            jQuery('#maphover').attr('src', img);
        },
        mouseleave: function() {
            var img = jQuery('#mapurl').html() + '/map.jpg';
            jQuery('#maphover').attr('src', img);
        }
    });

    var incart = jQuery('.cart-box').find('.products').find('strong').text();
    var active = jQuery('#menu-peamenuu li.current-page-ancestor a');
    if (jQuery('#single-product-categories').length > 0 && !active.length) {
        var maincat = jQuery('#single-product-categories a:first').text();
    } else {
        var maincat = jQuery('#product-categories a:first').text();
    }
    var realmain = jQuery('#menu-peamenuu').find('a:contains("' + maincat + '")');

    // Check if wrong url
    if (maincat.length > 0) {
        jQuery('#menu-peamenuu').find('a:contains("' + maincat + '")').parent().addClass('current-page-ancestor');
        if (jQuery('#single-product-categories').length > 0) {
            var secondcat = jQuery('#single-product-categories a:last').last().text();
            jQuery('#alammenuu').find('a:contains("' + secondcat + '")').parent().addClass('current-menu-item');
        }
    }

    if (jQuery('#single-product-categories').length > 0 && jQuery('#product-categories').length > 0) {
        var productcat = jQuery('#single-product-categories a:first').text();
        var maincat = jQuery('#product-categories a:first').text();
        var incart = jQuery('.cart-box').find('.products').find('strong').text();
        if (productcat != maincat && jQuery('#product-categories a:first').length >0) {
            var returnurl = jQuery('#menu-peamenuu').find('a:contains("' + maincat + '")').attr('href');
            displayPopupWarn(realmain.attr('href'), returnurl);
        }
    }

    jQuery(document).on('click', '#popupwarn .close,#popupwarn .action_close', function(e) {
        if (jQuery(this).attr('href') == 'javascript: void(0);')
            jQuery('#popupwarn').css('display', 'none');
    });

    jQuery(document).on('click', '.map-popup .close', function(e) {
        jQuery('.map-popup').css('display', 'none');
    });

    jQuery(document).on('click', '#menu-peamenuu a', function(e) {
        var maincat = jQuery('#product-categories a:first').text();
        var incart = jQuery('.cart-box').find('.products').find('strong').text();
        var productcat = jQuery(this).text();
        if (jQuery('#product-categories').length>0 && productcat != maincat) {
            e.preventDefault();
            displayPopupWarn(jQuery(this).attr('href'));
        }

    });

    jQuery(document).on('click', '.action_chooselocation', function(e) {
        e.preventDefault();
        var active = jQuery('#menu-peamenuu li.current-page-ancestor a');
        var type = $(active).attr('title');

        var img = jQuery('#mapurl').html() + '/prices_' + type + '.png';
        jQuery('#prices').attr('src', img);

        $('.map-popup').css('display', 'block');
    });


});