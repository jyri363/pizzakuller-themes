//==============================================
//Front Slider Init Callback
//==============================================

function mycarousel_initCallback(carousel) {
    // Pause autoscrolling if the user moves with the cursor over the clip.
    jQuery('#mycarousel .description').mouseenter(function() {
        carousel.stopAuto();
    });
    jQuery('#mycarousel .description').mouseleave(function() {
        carousel.startAuto();
    });
}
;

//==============================================
// DOCUMENT READY
//==============================================
jQuery(document).ready(function() {

//==============================================
    //Main Menu
//==============================================
    jQuery('header .top-nav  ul  li').mouseenter(function() {
        if (jQuery(this).find('ul').length) {
            jQuery(this).find('ul').first().stop(true, true).fadeIn();
            jQuery(this).siblings().find('ul').css('display', 'none');
        }
    });
    jQuery('header .top-nav  ul  li').mouseleave(function() {
        if (jQuery(this).find('ul').length) {
            jQuery(this).find('ul').first().stop(true, true).delay(500).fadeOut('fast');
        }
    });



    if (jQuery('body').is('.home')) {
//==============================================
        //Meals Carousel Starter
//==============================================
        jQuery('#mycarousel').jcarousel({
            scroll: 1,
            auto: 3,
            wrap: 'both',
            initCallback: mycarousel_initCallback
        });

//==============================================
        //Meals Carousel Starter
//==============================================


        jQuery('#meals-of-the-day ul').jcarousel({
            wrap: 'both'
                    , itemFallbackDimension: 400
        });

        jQuery('.featured-meals ul').jcarousel({
            wrap: 'both'
                    , scroll: 1
                    , itemFallbackDimension: 215
        });
    }
//////////////////////		
});//===End Doc Ready


//==============================================
//Payment Method
//==============================================
jQuery('#payment-methods ul li').click(function() {
    jQuery('#payment-methods ul li .form-controls.checked').removeClass('checked');
    jQuery('#payment-methods ul li input').attr('checked', false);
    jQuery('.form-controls', this).addClass('checked');
    jQuery('input', this).attr('checked', true);
});

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
                shipping_method: 'pizzashipper',
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