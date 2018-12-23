(function ($) {
    "use strict";
/*--
    Commons Variables
-----------------------------------*/
var windows = $(window);
var windowWidth = windows.width();
var mainWrapper = $('.main-wrapper');


/*--
    Header Cart
-----------------------------------*/
var cartToggle = $('.header-cart-toggle');
var miniCart = $('.header-mini-cart');
// Toggle Header Cart
cartToggle.on("click", function () {
    miniCart.slideToggle();
});
// Closing the Header Cart by clicking in the menu button or anywhere in the screen
$('body').on('click', function (e) {
    var target = e.target;
    if (!$(target).is('.header-cart-toggle') && !$(target).parents().is('.header-cart-toggle')) {
        miniCart.slideUp();
    }
});
// Prevent closing Header Cart upon clicking inside the Header Cart
$('.header-mini-cart').on('click', function (e) {
    e.stopPropagation();
});
    
/*--
    Mobile Menu
-----------------------------------*/
var mainMenuNav = $('.main-menu');
mainMenuNav.meanmenu({
    meanScreenWidth: '991',
    meanMenuContainer: '.mobile-menu',
    meanMenuClose: '<span class="menu-close"></span>',
    meanMenuOpen: '<span class="menu-bar"></span>',
    meanRevealPosition: 'right',
    meanMenuCloseSize: '0'
});

/*--
    Sliders
-----------------------------------*/
// Hero Slider
$('.hero-slider').slick({
    infinite: true,
    fade: true,
    dots: false,
    prevArrow: '<button class="slick-prev"><i class="fa fa-angle-left"></i></button>',
    nextArrow: '<button class="slick-next"><i class="fa fa-angle-right"></i></button>',
    responsive: [
        {
        breakpoint: 992,
            settings: {
                dots: true,
                arrows: false,
            }
        },
    ]
}); 
// Product Slider 4 Column
$('.product-slider-4').slick({
    infinite: true,
    dots: false,
    slidesToShow: 4,
    slidesToScroll: 1,
    prevArrow: '<button class="slick-prev"><i class="fa fa-angle-left"></i></button>',
    nextArrow: '<button class="slick-next"><i class="fa fa-angle-right"></i></button>',
    responsive: [
        {
            breakpoint: 1200,
            settings: {
                slidesToShow: 3,
            }
        },
        {
            breakpoint: 992,
            settings: {
                slidesToShow: 2,
            }
        },
        {
            breakpoint: 576,
            settings: {
                slidesToShow: 1,
            }
        },
    ]
});
// Product Slider 3 Column
$('.product-slider-3').slick({
    infinite: true,
    dots: false,
    slidesToShow: 3,
    slidesToScroll: 1,
    prevArrow: '<button class="slick-prev"><i class="fa fa-angle-left"></i></button>',
    nextArrow: '<button class="slick-next"><i class="fa fa-angle-right"></i></button>',
    responsive: [
        {
            breakpoint: 1200,
            settings: {
                slidesToShow: 2,
            }
        },
        {
            breakpoint: 992,
            settings: {
                slidesToShow: 2,
            }
        },
        {
            breakpoint: 576,
            settings: {
                slidesToShow: 1,
            }
        },
    ]
});
// Single Product Slider
$('.single-product-slider').slick({
    infinite: true,
    dots: false,
    slidesToShow: 1,
    slidesToScroll: 1,
    prevArrow: '<button class="slick-prev"><i class="fa fa-angle-left"></i></button>',
    nextArrow: '<button class="slick-next"><i class="fa fa-angle-right"></i></button>',
});
// Single Product Slider
$('.single-product-slider-syn').slick({
    infinite: true,
    arrows: false,
    dots: false,
    slidesToShow: 1,
    slidesToScroll: 1,
    prevArrow: '<button class="slick-prev"><i class="fa fa-angle-left"></i></button>',
    nextArrow: '<button class="slick-next"><i class="fa fa-angle-right"></i></button>',
    asNavFor: '.single-product-thumb-slider-syn',
});
// Single Product Thumbnail Slider
$('.single-product-thumb-slider-syn').each(function() {
    var $vertical = $(this).attr('data-vertical') === 'true' ? true : false;
    var $verticalPrevArrow = $(this).attr('data-vertical') === 'true' ? 'up' : 'left';
    var $verticalNextArrow = $(this).attr('data-vertical') === 'true' ? 'down' : 'right';
    $(this).slick({
        infinite: true,
        dots: false,
        slidesToShow: 3,
        slidesToScroll: 1,
        focusOnSelect: true,
        centerMode: true,
        centerPadding: '0px',
        prevArrow: '<button class="slick-prev"><i class="fa fa-angle-'+$verticalPrevArrow+'"></i></button>',
        nextArrow: '<button class="slick-next"><i class="fa fa-angle-'+$verticalNextArrow+'"></i></button>',
        asNavFor: '.single-product-slider-syn',
        vertical: $vertical,
        responsive: [
            {
                breakpoint: 479,
                settings: {
                    arrows: false,
                    vertical: false,
                    prevArrow: '<button class="slick-prev"><i class="fa fa-angle-left"></i></button>',
                    nextArrow: '<button class="slick-next"><i class="fa fa-angle-right"></i></button>',
                }
            },
        ]
    });
});
// Brand Slider
$('.brand-slider').slick({
    infinite: true,
    arrows: false,
    dots: false,
    slidesToShow: 5,
    slidesToScroll: 1,
    responsive: [
        {
            breakpoint: 992,
            settings: {
                slidesToShow: 4,
            }
        },
        {
            breakpoint: 768,
            settings: {
                slidesToShow: 3,
            }
        },
        {
            breakpoint: 576,
            settings: {
                slidesToShow: 2,
            }
        },
    ]
});
// Brand Slider
$('.blog-slider').slick({
    infinite: true,
    arrows: true,
    dots: false,
    slidesToShow: 1,
    slidesToScroll: 1,
    prevArrow: '<button class="slick-prev"><i class="fa fa-angle-left"></i></button>',
    nextArrow: '<button class="slick-next"><i class="fa fa-angle-right"></i></button>',
});
// Testimonial Slider
$('.testimonial-image-slider').slick({
    infinite: true,
    arrows: true,
    dots: false,
    slidesToShow: 1,
    slidesToScroll: 1,
    prevArrow: '<button class="slick-prev">prev</button>',
    nextArrow: '<button class="slick-next">next</button>',
    asNavFor: '.testimonial-content-slider'
});
$('.testimonial-content-slider').slick({
    infinite: true,
    arrows: false,
    dots: false,
    slidesToShow: 1,
    slidesToScroll: 1,
    asNavFor: '.testimonial-image-slider'
});

/*--
    Imageloaded & Masonry
-----------------------------------*/
var $masonryGird = $('.masonry-grid');
$masonryGird.imagesLoaded( function() {
    $masonryGird.masonry({
      // options
      itemSelector: '.masonry-grid > *',
    });
});

/*--
    Rellax Parallax
-----------------------------------*/
windows.on('load', function(){
    if($('.rellax').length){
        var rellax = new Rellax('.rellax');
    }
});
/*--
    Perfect Scrollbar
-----------------------------------*/
$('.custom-scroll').each(function(){
    const ps = new PerfectScrollbar($(this)[0],);
});
    
/*--
    Nice Select
-----------------------------------*/
$('.nice-select').niceSelect();
    
/*--
	MailChimp
-----------------------------------*/
$('#mc-form').ajaxChimp({
	language: 'en',
	callback: mailChimpResponse,
	// ADD YOUR MAILCHIMP URL BELOW HERE!
	url: 'http://devitems.us11.list-manage.com/subscribe/post?u=6bbb9b6f5827bd842d9640c82&amp;id=05d85f18ef'

});
function mailChimpResponse(resp) {
	
	if (resp.result === 'success') {
		$('.mailchimp-success').html('' + resp.msg).fadeIn(900);
		$('.mailchimp-error').fadeOut(400);
		
	} else if(resp.result === 'error') {
		$('.mailchimp-error').html('' + resp.msg).fadeIn(900);
	}  
}

/*--
	Price Range
-----------------------------------*/
$('#price-range').slider({
    range: true,
    min: 0,
    max: 300,
    values: [ 25, 225 ],
    slide: function( event, ui ) {
        $('.ui-slider-handle:eq(0)').html( '<span>' + '$' + ui.values[ 0 ] + '</span>');
        $('.ui-slider-handle:eq(1)').html( '<span>' + '$' + ui.values[ 1 ] + '</span>');
    }
});
$('.ui-slider-handle:eq(0)').html( '<span>' + '$' + $( "#price-range" ).slider( "values", 0 ) + '</span>' );
$('.ui-slider-handle:eq(1)').html( '<span>' + '$' + $( "#price-range" ).slider( "values", 1 ) + '</span>' );   
    

/*----- 
	Quantity
--------------------------------*/
$('.pro-qty').prepend('<span class="dec qtybtn">-</span>');
$('.pro-qty').append('<span class="inc qtybtn">+</span>');
$('.qtybtn').on('click', function() {
	var $button = $(this);
	var oldValue = $button.parent().find('input').val();
	if ($button.hasClass('inc')) {
	  var newVal = parseFloat(oldValue) + 1;
	  if(newVal >= 16){
	      return;
      }
	} else {
	   // Don't allow decrementing below zero
	  if (oldValue > 1) {
		var newVal = parseFloat(oldValue) - 1;
		} else {
		newVal = 1;
	  }
	  }
	$button.parent().find('input').val(newVal);
});  
    
/*--
	Product View Mode
-----------------------------------*/
$('body').on('click', '.product-view-mode button', function(e) {
    e.stopPropagation();
    var $this = $(this);
    var $modeClass = $this.data('mode');
    var $productWrap = $this.closest('body').find('.shop-product-wrap');
    
    $('.product-view-mode button').removeClass('active');
    $this.addClass('active');
    
    $productWrap.removeClass('grid-3 grid-4 list').addClass($modeClass).find('.product-item').removeClass('list');
    
    if($modeClass === 'list') {
        $productWrap.find('.product-item').addClass('list');
    }
    
});
    
/*----- 
	Shipping Form Toggle
--------------------------------*/ 
$('[data-shipping]').on('click', function(){
    if( $('[data-shipping]:checked').length > 0 ) {
        $('#shipping-form').slideDown();
    } else {
        $('#shipping-form').slideUp();
    }
})
    
/*----- 
	Payment Method Select
--------------------------------*/
$('[name="payment-method"]').on('click', function(){
    
    var $value = $(this).attr('value');

    $('.single-method p').slideUp();
    $('[data-method="'+$value+'"]').slideDown();
    
})
    
/*--
	Sticky Sidebar
-----------------------------------*/
if($('.product-details-with-gallery').length) {
    var sidebar = new StickySidebar('.product-content', {
        containerSelector: '.product-details-with-gallery',
        innerWrapperSelector: '.product-content-inner',
        topSpacing: 20,
        bottomSpacing: 20,
        minWidth: 992,
    });
};
    
    
    
})(jQuery);	