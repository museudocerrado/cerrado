//console.log(Modernizr)

jQuery(document).ready(function($) {
if ($.browser.msie) $("html").removeClass("csstransforms3d");
var dtGlobals = {}; // Global storage


/* !Custom touch events */
/* !(we need to add swipe events here) */

dtGlobals.touches = {};
dtGlobals.touches.touching = false;
dtGlobals.touches.touch = false;
dtGlobals.touches.currX = 0;
dtGlobals.touches.currY = 0;
dtGlobals.touches.cachedX = 0;
dtGlobals.touches.cachedY = 0;
dtGlobals.touches.count = 0;
dtGlobals.resizeCounter = 0;

dtGlobals.isMobile	= (/(Android|BlackBerry|iPhone|iPod|iPad|Palm|Symbian)/.test(navigator.userAgent));
dtGlobals.isAndroid	= (/(Android)/.test(navigator.userAgent));
dtGlobals.isiOS		= (/(iPhone|iPod|iPad)/.test(navigator.userAgent));
dtGlobals.isiPhone	= (/(iPhone|iPod)/.test(navigator.userAgent));
dtGlobals.isiPad	= (/(iPad)/.test(navigator.userAgent));

var smartMenu = true;
if (dtGlobals.isMobile && !dtGlobals.isiPad) smartMenu = false;

$(document).on('touchstart',function(e) {
	if (e.originalEvent.touches.length == 1) {
		dtGlobals.touches.touch = e.originalEvent.touches[0];

		// caching the current x
		dtGlobals.touches.cachedX = dtGlobals.touches.touch.pageX;
		// caching the current y
		dtGlobals.touches.cachedY = dtGlobals.touches.touch.pageY;
		// a touch event is detected      
		dtGlobals.touches.touching = true;

		// detecting if after 200ms the finger is still in the same position
		setTimeout(function() {

			dtGlobals.touches.currX = dtGlobals.touches.touch.pageX;
			dtGlobals.touches.currY = dtGlobals.touches.touch.pageY;      

			if ((dtGlobals.touches.cachedX === dtGlobals.touches.currX) && !dtGlobals.touches.touching && (dtGlobals.touches.cachedY === dtGlobals.touches.currY)) {
				// Here you get the Tap event
				dtGlobals.touches.count++;
				//console.log(dtGlobals.touches.count)
				$(e.target).trigger("tap");
			}
		},200);
	}
});

$(document).on('touchend touchcancel',function (e){
	// here we can consider finished the touch event
	dtGlobals.touches.touching = false;
});

$(document).on('touchmove',function (e){
	dtGlobals.touches.touch = e.originalEvent.touches[0];

	if(dtGlobals.touches.touching) {
		// here you are swiping
	}
});


$(document).on("tap", function(e) {
	console.log("Deligating: "+e.type);
	$(".dt-hovered").trigger("mouseout");
});

/* Custom touch events:end */
/* !Debounced resize event */
	var dtResizeTimeout;
if(dtGlobals.isMobile){
	$(window).bind('orientationchange', function(event) {
		//var dtResizeTimeout;
		$(window).on("resize", function() {
			clearTimeout(dtResizeTimeout);
			dtResizeTimeout = setTimeout(function() {
				$(window).trigger( "debouncedresize" );
			}, 200);
		});
	});
}else{
	$(window).on("resize", function() {
		clearTimeout(dtResizeTimeout);
		dtResizeTimeout = setTimeout(function() {
			$(window).trigger( "debouncedresize" );
		}, 200);
	});
}
/* Debounced resize event: end */

/* !jQuery extensions */

/* !- Check if element exists */
$.fn.exists = function() {
	if ($(this).length > 0) {
		return true;
	} else {
		return false;
	}
}

/* !- Check if element is loaded */
$.fn.loaded = function(callback, jointCallback, ensureCallback){
	var len	= this.length;
	if (len > 0) {
		return this.each(function() {
			var	el		= this,
				$el		= $(el),
				blank	= "data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///ywAAAAAAQABAAACAUwAOw==";

			$el.on("load.dt", function(event) {
				$(this).off("load.dt");
				if (typeof callback == "function") {
					callback.call(this);
				}
				if (--len <= 0 && (typeof jointCallback == "function")){
					jointCallback.call(this);
				}
			});

			if (!el.complete || el.complete === undefined) {
				el.src = el.src;
			} else {
				$el.trigger("load.dt")
			}
		});
	} else if (ensureCallback) {
		if (typeof jointCallback == "function") {
			jointCallback.call(this);
		}
		return this;
	}
};

/* jQuery extensions: end */


/* !Main navigation */
/* We need to fine-tune timings and do something about the usage of jQuery "animate" function */ 

$("#mobile-menu").wrap('<div id="dl-menu" class="dl-menuwrapper wf-mobile-visible" />');

var $mainNav = $("#main-nav");

$(".act", $mainNav).parents("li").addClass("act");

var	$mobileNav = $mainNav.clone();
var backCap = $("#mobile-menu > .menu-back").html();

$mobileNav
	.attr("id", "")
	.attr("class", "dl-menu")
	.find(".sub-nav")
		.addClass("dl-submenu")
		.removeClass("sub-nav")
		.prepend('<li class="dl-back"><a href="#"><span>'+backCap+'</a></li>');

$mobileNav.appendTo("#dl-menu").wrap('<div class="dl-container" />');

if (!$("html").hasClass("old-ie")) $( '#dl-menu' ).dlmenu();


if ($mainNav.hasClass("fancy-rollovers") && $("html").hasClass("csstransforms3d")) {
	$("> li > a", $mainNav).each(function() {
		var $this = $(this).css("padding", 0),
			tempHtml = $this.html();

		tempHtml = '<span>'+tempHtml+'<span>'+tempHtml+'</span></span>';
		$this.html(tempHtml);
	});
}	

$(".sub-nav", $mainNav).parent().each(function() {
	var $this = $(this);

	$this.find("> a").on("click", function(e) {
		if (!$(this).hasClass("dt-clicked")) {
			e.preventDefault();
			$mainNav.find(".dt-clicked").removeClass("dt-clicked");
			$(this).addClass("dt-clicked");
		} else {
			e.stopPropagation();
		}

	});

	var menuTimeoutShow,
		menuTimeoutHide;

	$this.on("mouseenter tap", function(e) {
		if(e.type == "tap") e.stopPropagation();

		var $this = $(this);
		$this.addClass("dt-hovered");

		if ($("#page").width() - ($this.children('ul').offset().left - $("#page").offset().left) - 230 < 0) {
			$this.children('ul').addClass("right-overflow");
		}

		clearTimeout(menuTimeoutShow);
		clearTimeout(menuTimeoutHide);

		menuTimeoutShow = setTimeout(function() {
			if($this.hasClass("dt-hovered")){
				$this.children('ul').stop().css("visibility", "visible").animate({
					"opacity": 1
				}, 200);
			}
		}, 350);
	});

	$this.on("mouseleave", function(e) {
		var $this = $(this);
		$this.removeClass("dt-hovered");

		clearTimeout(menuTimeoutShow);
		clearTimeout(menuTimeoutHide);

		menuTimeoutHide = setTimeout(function() {
			if(!$this.hasClass("dt-hovered")){
				$this.children('ul').stop().animate({
					"opacity": 0
				}, 150, function() {
					$(this).css("visibility", "hidden");
				});
				
				setTimeout(function() {
					if(!$this.hasClass("dt-hovered")){
						$this.children('ul').removeClass("right-overflow");
					}
				}, 400);
			}
		}, 200);

		$this.find("> a").removeClass("dt-clicked");
	});

});

/* Main navigation: end */


/* !Navigation widget */
var customTimeoutShow
$('.custom-nav > li > a').click(function(e){
    $menuItem = $(this).parent();
	if ($menuItem.hasClass("has-children")) e.preventDefault();
	
	
	    if ($(this).attr('class') != 'active'){
		    	$('.custom-nav > li > ul').stop(true, true).slideUp(400);
		    	$(this).next().stop(true, true).slideDown(500);
		    	$('.custom-nav > li > a').removeClass('active');
		    	$(this).addClass('active');
	    }else{
	    		$(this).next().stop(true, true).slideUp(500);
	    		$(this).removeClass('active');
	    }

		$menuItem.siblings().removeClass("act");
		$menuItem.addClass("act");
	
});
$('.custom-nav > li > ul').each(function(){
	clearTimeout(customTimeoutShow);
	$this = $(this);
	$thisChildren = $this.find('li');
	if($thisChildren.hasClass('act')){
		$this.prev().addClass('active');
		$this.parent().siblings().removeClass("act");
		$this.parent().addClass('act');
		$(this).slideDown(500);
	}
});


/* Navigation widget: end */

$('.shortcode-tabs').goTabs().css('visibility', 'visible');

/* !Royal Slider */
if ($(".rsHomePorthole").exists()) {
	var portholeSlider = {};
		portholeSlider.container = $("#main-slideshow");
		portholeSlider.width = portholeSlider.container.attr("data-width") ? parseInt(portholeSlider.container.attr("data-width")) : 1280;
		portholeSlider.height = portholeSlider.container.attr("data-height") ? parseInt(portholeSlider.container.attr("data-height")) : 720;
		portholeSlider.autoslide = portholeSlider.container.attr("data-autoslide") && parseInt(portholeSlider.container.attr("data-autoslide")) > 999 ? parseInt(portholeSlider.container.attr("data-autoslide")) : 5000;
		portholeSlider.scale = portholeSlider.container.attr("data-scale") ? portholeSlider.container.attr("data-scale") : "fill";
		portholeSlider.paused = portholeSlider.container.attr("data-paused") ? portholeSlider.container.attr("data-paused") : true;
		portholeSlider.hendheld = $(window).width() < 740 && dtGlobals.isMobile ? true : false;
	
	$("#main-slideshow-content").appendTo(portholeSlider.container);
	
	portholeSlider.api = $(".rsHomePorthole").royalSlider({
		autoScaleSlider: true,
		autoScaleSliderWidth: portholeSlider.width,
		autoScaleSliderHeight: portholeSlider.height,
		autoPlay: {
			enabled: !portholeSlider.hendheld,
			stopAtAction: false,
			pauseOnHover: false,
			delay: portholeSlider.autoslide
		},
		imageScaleMode: portholeSlider.scale,
		imageScalePadding: 0,
		numImagesToPreload: 999,
		slidesOrientation: "horizontal",
		disableResponsiveness: false,
		loopRewind: true,
		arrowsNav: false,
		globalCaption: true,
		controlNavigation: !portholeSlider.hendheld ? 'porthole' : 'none',
		thumbs: {
			orientation: 'vertical',
			drag: false,
			touch: false,
			spacing: 10,
			firstMargin: false,
			appendSpan: false
		},
		block: {
			fadeEffect: true,
			moveEffect: 'bottom',
			moveOffset: 5
		}
	}).data("royalSlider");
	if (portholeSlider.paused === "true" || portholeSlider.paused === true) portholeSlider.api.stopAutoPlay();
}


$(".slider-post").each(function(){
	$(this).royalSlider({
		autoScaleSlider: true,
		imageScaleMode: "fit",
		autoScaleSliderWidth: $(this).attr('data-width'),
		autoScaleSliderHeight: $(this).attr('data-height'),
		imageScalePadding: 0,
		numImagesToPreload: 6,
		slidesOrientation: "horizontal",
		disableResponsiveness: false,
		globalCaption:true
	});
});

$(".slider-simple").each(function(){
	$(this).royalSlider({
		autoScaleSlider: true,
		imageScaleMode: "fit",
		autoScaleSliderWidth: $(this).attr('data-width'),
		autoScaleSliderHeight: $(this).attr('data-height'),
		imageScalePadding: 0,
		numImagesToPreload: 6,
		slidesOrientation: "horizontal",
		disableResponsiveness: false,
		globalCaption:true
	});
});
$(".slider-content .preload-me").loaded(null, function() {
	$(".slider-content").each(function(){
		var $this = $(this),
			autoslide = $this.attr("data-autoslide") && parseInt($this.attr("data-autoslide")) > 999 ? parseInt($this.attr("data-autoslide")) : 5000;		
			hendheld = !($(window).width() < 740 && dtGlobals.isMobile) && $this.attr("data-autoslide") ? true : false;
		
		$this.royalSlider({			
			autoPlay: {
				enabled: hendheld,
				stopAtAction: false,
				pauseOnHover: false,
				delay: autoslide
			},
			autoHeight: true,
			controlsInside: false,
		    fadeinLoadedSlide: false,
		    controlNavigationSpacing: 0,
		    controlNavigation: 'bullets',
		    imageScaleMode: 'none',
		    imageAlignCenter:false,
		    loop: false,
		    loopRewind: true,
		    numImagesToPreload: 6,
		    keyboardNavEnabled: true

		}).data('royalSlider');
	});
});

/* Royal Slider: end */
/*!Full-width scroller*/
$(".fullwidth-slider").each(function() {
	var	$this = $(this),
		scroller = $this.theScroller({
			"prev": $this.parent().find('.prev'),
			"next": $this.parent().find('.next')
		}).data("theScroller");

	
});
/*!Revolution slider*/
if ($('.rev_slider_wrapper').length > 0){
	$('#main-slideshow').each(function(){
		var $this = $(this);
		if( $this.find('> .rev_slider_wrapper')){
			$this.addClass('fixed');
		};
		if ($('.rev_slider_wrapper').hasClass('fullscreen-container') || $('.rev_slider_wrapper').hasClass('fullwidthbanner-container')){
			$this.removeClass('fixed');
		};
	});
}
//Instagram
function calcPics(maxitemwidth){
	var $collection = $('.instagram-photos');
	if ($collection.length < 1) return false;


	$collection.each(function(){
		var maxitemwidth = maxitemwidth ? maxitemwidth : parseInt($(this).find('> a').css('max-width'));

		// Cahce everything
		var $container = $(this),
			containerwidth = $container.width(),
			itemperc = (100/(Math.ceil(containerwidth/maxitemwidth)));

		$container.find('a').css({ 'width': itemperc+'%' });
	});
};
function moveOffset(){
	if( $(".map-container.full").length ){
		var offset_map = $(".map-container.full").position().left;
		$(".map-container.full").css({
			width: $('#main').width(),
			marginLeft: -offset_map
		});
	};
	if( $(".slider-wrapper").length ){
		$(".slider-wrapper.full").each(function(){
			var offset_fs = $(this).position().left;
			var $frame = $(this).children('.fullwidth-slider');
			$(this).css({
				width: $('#main').width(),
				'margin-left': -offset_fs
			});

		var scroller = $(this).children().data("theScroller");
		scroller.update();

		});
	};
};
/*calcPics();
moveOffset();*/

/* !Masonry layout: */

var	$isoCollection = $(".iso-container");
var	$gridCollection = $(".wf-container.grid-masonry");
// !- Columns width calculation
function calculateColumns(container) {

	var $isoContainer = container,
		containerWidth = $isoContainer.width(),
		minCol = Math.floor(containerWidth / 12);

	if (minCol*3 >= 200) {

		$("> .iso-item", $isoContainer).each(function() {
			var $this = $(this);
			if ($this.hasClass("wf-1-4")) {
				$this.css("width", minCol*3);
			} else if ($this.hasClass("wf-2-4") || $this.hasClass("wf-1-2")) {
				$this.css("width", minCol*6);
			} else if ($this.hasClass("wf-1-3")) {
				$this.css("width", minCol*4);
			} else if ($this.hasClass("wf-2-3")) {
				$this.css("width", minCol*8);
			}
		});

	} else if ( minCol*3 < 200 && minCol*3 > 150) {

		$("> .iso-item", $isoContainer).each(function() {
			var $this = $(this);
			if ($this.hasClass("wf-1-4")) {
				$this.css("width", minCol*6);
			} else if ($this.hasClass("wf-2-4") || $this.hasClass("wf-1-2")) {
				$this.css("width", minCol*12);
			} else if ($this.hasClass("wf-1-3")) {
				$this.css("width", minCol*6);
			} else if ($this.hasClass("wf-2-3")) {
				$this.css("width", minCol*12);
			}
		});

	}  else if ( minCol*3 <= 150) {
		$("> .iso-item", $isoContainer).each(function() {
			$(this).css("width", minCol*12);
		});
	}
};

$isoCollection.each(function() {
	var $isoContainer = $(this);

	calculateColumns($isoContainer);
	
	$(".preload-me", $isoContainer).loaded(null, function() {

		// !- Slider initialization
		$(".slider-masonry", $isoContainer).each(function(){
			var $_this = $(this),
				attrW = $_this.data('width'),
				attrH = $_this.data('height'); 

			$_this.royalSlider({
				autoScaleSlider: true,
				autoScaleSliderWidth: attrW,
				autoScaleSliderHeight: attrH,
				imageScaleMode: "fit",
				imageScalePadding: 0,
				slidesOrientation: "horizontal",
				disableResponsiveness: true
			});
		});

		// !- Masonry initialization
		$isoContainer.isotope({
			itemSelector : '.iso-item',
			resizable: false,
			layoutMode : 'masonry',
			animationEngine: 'best-available',
			masonry: { columnWidth: 1 },
			getSortData : {
				date : function( $elem ) {
					return $elem.attr('data-date');
				},
				name : function( $elem ) {
					return $elem.attr('data-name');
				}
			}
		});

		$(".iso-item", $isoContainer).css("visibility", "visible");

		// !- Window resize event
		$(window).on("debouncedresize", function () {
			calculateColumns($isoContainer);

			$(".royalSlider", $isoContainer).each(function() {
				$(this).data('royalSlider').updateSliderSize();
			});

			$isoContainer.isotope('reLayout');
		});
	}, true);
});

/**/
function calculateGridColumns(container) {

	var $gridContainer = container,
		containerWidth = $gridContainer.width();
		if( $('#main').hasClass('sidebar-none') ){
			minCol = Math.floor(containerWidth / 248);
		}else{			
			minCol = Math.floor(containerWidth / 186);
		}

	if ( minCol == 5) {
		$("> .wf-cell", $gridContainer).each(function() {
			var $this = $(this);
			if ($this.hasClass("wf-1-4")) {
				$(this).css("width", minCol*5 + "%");
			}else if ($this.hasClass("wf-2-4") || $this.hasClass("wf-1-2")) {
				$this.css("width", minCol*10 + "%");
			} else if ($this.hasClass("wf-1-3")) {
				$this.css("width", minCol*6.6666 + "%");
			}
		});
	} else if ( minCol < 5 && minCol >= 4) {
		$("> .wf-cell", $gridContainer).each(function() {
			var $this = $(this);
			if ($this.hasClass("wf-1-4")) {
				$(this).css("width", minCol*6.25 + "%");
			}else if ($this.hasClass("wf-2-4") || $this.hasClass("wf-1-2")) {
				$this.css("width", minCol*12.5 + "%");
			} else if ($this.hasClass("wf-1-3")) {
				$this.css("width", minCol*8.333 + "%");
			}
		});
	}else if ( minCol < 4 && minCol >=3 ) {
		$("> .wf-cell", $gridContainer).each(function() {
			var $this = $(this);
			if ($this.hasClass("wf-1-4")) {
				$this.css("width", minCol*11.111 + "%");
			}else if ($this.hasClass("wf-2-4") || $this.hasClass("wf-1-2")) {
				$this.css("width", minCol*16.667 + "%");
			} else if ($this.hasClass("wf-1-3")) {
				$this.css("width", minCol*11.111 + "%");
			}
		});

	} 
	else if (minCol < 3 && minCol >=2) {
		$("> .wf-cell", $gridContainer).each(function() {
			var $this = $(this);
			$this.css("width", minCol*25 + "%");						
		});
	}
	else if (minCol < 2 && minCol >=1) {
		$("> .wf-cell", $gridContainer).each(function() {
			var $this = $(this);
			$this.css("width", minCol*50 + "%");
			
		});
	}
	 if (containerWidth < 360) {
		$("> .wf-cell", $gridContainer).each(function() {
			var $this = $(this);
			$this.css("width", "100%");			
		});
	}
};
$gridCollection.each(function() {
	var $gridContainer = $(this);
	calculateGridColumns($gridContainer);
	$(window).on("debouncedresize", function () {
		calculateGridColumns($gridCollection);
	});
});
// !- Filter
$(".filter-categories > a").on("click", function(e) {
	var $this = $(this);
	
	if ( typeof arguments.callee.dtPreventD == 'undefined' ) {
		arguments.callee.dtPreventD = !$this.parents('.filter').first().hasClass('without-isotope');
	}

	e.preventDefault();

	$this.trigger("mouseleave");
	
	if ($this.hasClass("act") && !$this.hasClass("show-all")) {
		e.stopImmediatePropagation();
		$this.removeClass("act");
		$this.siblings("a.show-all").trigger('click');//.addClass("act");
	} else {
		$this.siblings().removeClass("act");
		$this.addClass("act");

		if ( !arguments.callee.dtPreventD ) {
			window.location.href = $this.attr('href');
		}
	}
});

$(".filter-extras a").on("click", function(e) {
	var $this = $(this);
	
	if ( typeof arguments.callee.dtPreventD == 'undefined' ) {
		arguments.callee.dtPreventD = !$this.parents('.filter').first().hasClass('without-isotope');
	}

	if ( arguments.callee.dtPreventD ) {
		e.preventDefault();
	}

	$this.siblings().removeClass("act");
	$this.addClass("act");
});

/* Masonry layout: end */

$('.full-boxed-pricing').each(function(){
	$(this).find('.shortcode-pricing-table').last().addClass('last')
})

/* !Widgets: */

if(dtGlobals.isMobile){
	$('.fs-navigation .prev, .fs-navigation .next').addClass('ar-hide');
	
}else{
	
};

$('img').on('dragstart', function(event) { event.preventDefault(); });
$('.fs-entry .show-content, .rollover-project .show-content').each(function(){
	var $this = $(this);
	$this.append('<i></i>')
});

$('.no-touch .fs-entry, .no-touch .swiper-slide').each(function() {
	var ent = $(this);
	
	ent.find('> .link').on('mousedown', function(e) {
		var mouseDX = e.pageX,
			mouseDY = e.pageY;

		ent.find('> .link').one('mouseup', function(e) {
			var mouseUX = e.pageX,
				mouseUY = e.pageY;

			if( Math.abs(mouseDX - mouseUX) < 5 ){
				var $thisLink = $(this),
					ent=jQuery(this).parents('.fs-entry, .swiper-slide'),
					mi=ent.find('.fs-entry-content, > .swiper-caption');
				$('.fs-entry .link, .swiper-slide > .link').removeClass('act');
				$thisLink.addClass('act');
				$('.fs-entry-content, .swiper-caption').not(mi).fadeOut(300);
				mi.fadeIn(400);					
			}
		})
		
	});
	ent.find('.close-link').on('mousedown tap', function(e) {
		var $this = $(this),
			ent=jQuery(this).parents('.fs-entry, .swiper-slide'),
			mi=ent.find('.fs-entry-content, > .swiper-caption');
		
		mi.delay(100).fadeOut(300, function(){
			ent.find('> .link').removeClass('act');
		});
	});
});
$('.shortcode-instagram .fs-entry').each(function() {
	var ent = $(this);

	//ent.find('> .link a').attr('rel', '');
	ent.find('> .link').on('mousedown', function(e) {
		var mouseDX = e.pageX,
			mouseDY = e.pageY;

			
		ent.find('> .link').one('mouseup', function(e) {
			var mouseUX = e.pageX,
				mouseUY = e.pageY;

			if( Math.abs(mouseDX - mouseUX) < 5 ){
				var $thisLink = $(this);
				var $link = $(this).find('a');
				if ( $link.length > 0 ) { $link.trigger('click'); }
			}
		})
		
	});
});
$('.touch .fs-entry, .rollover-project, .touch .swiper-slide').each(function() {
	var ent=jQuery(this);			
	/*ent.find('>.link').on('tap', function() {
		var $this = $(this),
			ent=jQuery(this).parents('.fs-entry, .swiper-slide'),
			mi=ent.find('.fs-entry-content, > .swiper-caption');
		$('.fs-entry .link, .swiper-slide > .link').removeClass('act');
		$this.addClass('act');
		$('.fs-entry-content, .swiper-caption').not(mi).fadeOut(300);
		//mi.fadeOut(300);		
		mi.delay(300).fadeIn(400);		
	});
	
	ent.find('.close-link').on('tap', function() {
		var $this = $(this),
			ent=jQuery(this).parents('.fs-entry, .swiper-slide'),
			mi=ent.find('.fs-entry-content, > .swiper-caption');
		
		mi.delay(100).fadeOut(300, function(){
			ent.find('> .link').removeClass('act');
		});
	});*/
	ent.find('> .link').on('mousedown tap', function(e) {
		var mouseDX = e.pageX,
			mouseDY = e.pageY;
		ent.find('> .link').one('mouseup tap', function(e) {
			var mouseUX = e.pageX,
				mouseUY = e.pageY;
			if( Math.abs(mouseDX - mouseUX) < 5 ){
				var $thisLink = $(this),
					ent=jQuery(this).parents('.fs-entry, .swiper-slide'),
					mi=ent.find('.fs-entry-content, > .swiper-caption');
				
				$('.fs-entry-content, .swiper-caption').not(mi).fadeOut(200);
				mi.delay(150).fadeIn(300);					
			}
		})
		
	});
	ent.find('.close-link').on('mousedown tap', function(e) {
		var $this = $(this),
			ent=jQuery(this).parents('.fs-entry, .swiper-slide'),
			mi=ent.find('.fs-entry-content, > .swiper-caption');
		
		mi.delay(100).fadeOut(200, function(){
		});
	});
});
$('.touch .rollover-project').each(function() {
	var ent = $(this);			
	ent.find('.link').on('mouseenter tap', function() {
		var $this = $(this),
			ent = $(this).parents('.rollover-project'),
			mi = ent.find('.rollover-content');
		$('.rollover-project .link').removeClass('act');
		$this.addClass('act');
		$('.rollover-content').not(mi).fadeOut(300);
		//mi.fadeOut(300);		
		mi.delay(150).fadeIn(200);		
	});
	
	ent.find('.close-link').on('tap', function() {
		var $this = $(this),
			ent=jQuery(this).parents('.rollover-project'),
			mi=ent.find('.rollover-content');
		
		mi.delay(100).fadeOut(100, function(){
			ent.find('.link').removeClass('act');
		});
	});
});
// Albums, exclude featured image from gallery post
$('.albums .ignore-feaured-image').on('click', function(e) {
	e.preventDefault();
	$(this).siblings('.dt-prettyphoto-gallery-container').first().find("a[rel^='prettyPhoto']").first().click();
	return false;
});

// albums with rollover info
$('.albums .rollover-content, .media .rollover-content').on('click', function(e){
	if ( $(e.target).is('a') ) return true;
	$(this).siblings("a[rel^='prettyPhoto']").first().click();
});

// init prettyPhoto
$("a[rel^='prettyPhoto']").prettyPhoto();

//device rollovers

$("a.pp_close").on('touchstart touchend', function(e) {
	alert('click')
	e.type = "click";
	$(this).trigger(e);
	return false;
});


$('.touch .rollover').each(function(){
	if( $('.rollover-thumbnails', this).length > 0){
		$('body').on('touchend', function(e) {			
			  $('.touch .rollover').removeClass("is-clicked");
		})

	    var $this = $(this),
	    	thisPar = $this.parents('.wf-cell');
	 
	   	$this.on('touchstart', function(e) {    		
			//$.prettyPhoto.close();
			origY = e.originalEvent.pageY;
			origX = e.originalEvent.pageX;
			
		});
		$this.on('touchcancel', function(e){
			alert('cancel')
		})
		
		$this.on('touchend', function(e) {
			//$this.unbind('click.prettyphoto');
			var touchEX = e.originalEvent.changedTouches[0].pageX,
				touchEY = e.originalEvent.changedTouches[0].pageY;
			if( origY == touchEY || origX == touchEX ){
		   		if ($this.hasClass("is-clicked")) {
					//alert($this.attr('class'))

				} else {
					e.preventDefault();
		   			$('.touch .rollover').removeClass("is-clicked");
					$this.addClass("is-clicked");
					return false;
				};
			};
		});
	};

});


/*$('.touch .rollover').each(function(){
	if( $('.rollover-thumbnails', this).length > 0){
		$('body').on('touchstart', function(e) {			
			  $('.touch .rollover').removeClass("is-clicked");
		})

	   	$(document).on('touchstart', '.rollover', function(event) {

    		touchSX = event.originalEvent.targetTouches[0].pageX,
			touchSY = event.originalEvent.targetTouches[0].pageY;
			//console.log($(this).attr('class') + 'touchSY' )
			
		});
		$(document).on('touchend', '.rollover', function(event) {

				
			var touchEX = event.originalEvent.targetTouches[0].pageX,
			touchEY = event.originalEvent.targetTouches[0].pageY;
			if( (Math.abs(touchSY - touchEY) < 20) || (Math.abs(touchSX - touchEX) < 30) ){
				//alert($this)
				//console.log('(touchSY - touchEY) < 20')
				console.log('touchEY' + Math.abs(touchSY - touchEY))
		   		if ($(this).hasClass("is-clicked")) {
				} else {
					e.preventDefault();
		   			$('.touch .rollover').removeClass("is-clicked");
					$(this).addClass("is-clicked");
					
				};
			}
		});
	};

});*/


$('#parent-element a').live("touchstart",function(e){
    var $link_id = $(this).attr('id');
    if ($(this).parent().data('clicked') == $link_id) {
        // element has been tapped (hovered), reset 'clicked' data flag on parent element and return true (activating the link)
        $(this).parent().data('clicked', null);
        return true;
    } else {
        $(this).trigger("mouseenter").siblings().trigger("mouseout"); //triggers the hover state on the tapped link (because preventDefault(); breaks this) and untriggers the hover state for all other links in the container.
        // element has not been tapped (hovered) yet, set 'clicked' data flag on parent element to id of clicked link, and prevent click
        e.preventDefault(); // return false; on the end of this else statement would do the same
        $(this).parent().data('clicked', $link_id); //set this link's ID as the last tapped link ('clicked')
    }
});

$('.skills').addClass('animation-builder');
function mk_skill_meter() {

	//$('.skill-value > span').hide();
	if($('.skill').length > 0 ){
	    $(".skill .skill-value").each(function () {
	    	var $this = $(this);
	        if (!$this.hasClass('scroll-animated')) {
	            $this.addClass('scroll-animated');
				
	            setTimeout(function () {
		            $this.css({
		                width: $this.data('width') + '%'
		            });
					$this.find('> span').delay(2000).fadeOut(200, function(){});
		            
		        }, 300);
		        var skill_html = parseInt($this.find('> span').html());
				if( skill_html >= 99 || $this.data('width') == 100 ){
					$this.addClass('full');
				}
	        }

			var fadeTimeout;
			$this.hover(function() {
				clearTimeout(fadeTimeout);
				fadeTimeout = setTimeout(function() {
					$this.find('> span').stop(true, true).fadeIn(200);
				}, 200);
			}, function(){
				clearTimeout(fadeTimeout);
				$this.find('> span').fadeOut(200);
			}); 
	   

	    });
	}
}
function animated_skills(){
	if(!dtGlobals.isMobile){	    
		if ($('.animation-builder')) {
	        $(".animation-builder .skill-value:in-viewport").each(function (i) {

				var $_this = $(this),
					$this_data = $_this.data('width'),
					current_percent = 0,
					progress = null;
				if (!$_this.hasClass('scroll-animated')) {
	                $_this.addClass('scroll-animated');
					var progress = setInterval(function(){
						if( current_percent >= $this_data ){
							clearInterval(progress);
							$_this.find('> span').delay(2000).fadeOut(200, function(){});			

						}else{
							current_percent+=1
							var skill_html = parseInt($_this.find('> span').html());
							$_this.css({
								width: current_percent + '%'
							});
							if( skill_html >= 99 || $_this.data('width') > 99 ){
								$_this.addClass('full');
							}
						}
						$_this.find('> span').text(current_percent + '%');

					},10*i)
				}

				var fadeTimeout;
				$_this.hover(function() {
					clearTimeout(fadeTimeout);
					fadeTimeout = setTimeout(function() {
						$_this.find('> span').stop(true, true).fadeIn(200);
					}, 200);
				}, function(){
					clearTimeout(fadeTimeout);
					$_this.find('> span').fadeOut(200);
				});
			
	            
	       });
	    }
	}
}
if(dtGlobals.isMobile){
	jQuery(document).ready(function($) {
		mk_skill_meter();
	});
	$(window).scroll(function () {
	    mk_skill_meter();
	});
}
animated_skills();
if (!$("html").hasClass("old-ie")){
	$(window).scroll(function () {
	    animated_skills();
	});
}else{
	$(".skill-value").each(function () {

			var $_this = $(this),
				$this_data = $_this.data('width'),
				current_percent = 0,
				progress = null;
			var progress = setInterval(function(){
				if( current_percent >= $this_data ){
					clearInterval(progress);
					$_this.find('> span').delay(2000).fadeOut(200, function(){});			

				}else{
					current_percent+=1
					var skill_html = parseInt($_this.find('> span').html());
					$_this.css({
						width: current_percent + '%'
					});
					if( skill_html >= 99 ){
						$_this.addClass('full');
					}
				}
				$_this.find('> span').text(current_percent + '%');

			},10)

			var fadeTimeout;
			$_this.hover(function() {
				clearTimeout(fadeTimeout);
				fadeTimeout = setTimeout(function() {
					$_this.find('> span').stop(true, true).fadeIn(200);
				}, 200);
			}, function(){
				clearTimeout(fadeTimeout);
				$_this.find('> span').fadeOut(200);
			});
		
            
       });
}
/* !- Grayscale */
 
simple_tooltip(".shortcode-tooltip","shortcode-tooltip-content");

// !- Accordion
$('.st-toggle').toggle();
$('.st-accordion').accordion({
	open            : 0,
	oneOpenedItem : true
});

$(".filter-grayscale .slider-masonry").on("mouseenter tap", function(e) {
	if(e.type == "tap") {
		e.stopPropagation();
		//e.preventDefault();
		console.log("Prevented: "+e.type);
	}
	console.log("Enter: "+e.type);
	$(this).addClass("dt-hovered");
});

$(".filter-grayscale .slider-masonry").on("mouseleave", function(e) {
	console.log("Leave: "+e.type);
	$(this).removeClass("dt-hovered");
});

/* Grayscale: end */


/* !- Fancy grid */

$.fn.fancyGrid = function(options) {
	return this.each(function() {

		var	defaults = {
				setWidth: true,
				setHeight: false,
				setLineHeight: false,
				cellsSelector: "",
				contentSelector: "",
				borderBoxSelector: "",
				maintainBorders: false,
				maintainImages: false,
				minColWidth: 150
			},
			settings = $.extend({}, defaults, options),
			$gridContainer	= $(this),
			$cells = settings.cellsSelector ? $(settings.cellsSelector, $gridContainer) : $gridContainer.children();


		if ($cells.length < 1) return false;

		var calcWidth = function() {
			var	containerWidth = $gridContainer.width();

			var $this = $($cells[0]),
				curW = $this.width(),
				basicW,
				basicDenom = $gridContainer.data("basicDenom"),
				basicCSS = $gridContainer.data("basicCSS"),
				basicClass =  $gridContainer.data("basicClass");

			if (!basicDenom){
				if ($this.hasClass("wf-1-6")) {
					basicDenom = 6;
					basicCSS = "16.6667%";
					basicClass = "wf-1-6";
				}
				else if ($this.hasClass("wf-1-5")) {
					basicDenom = 5;
					basicCSS = "20%";
					basicClass = "wf-1-5";
				}
				else if ($this.hasClass("wf-1-4")) {
					basicDenom = 4;
					basicCSS = "25%";
					basicClass = "wf-1-4";
				}
				else if ($this.hasClass("wf-1-3")) {
					basicDenom = 3;
					basicCSS = "33.3333%";
					basicClass = "wf-1-3";
				}
				else if ($this.hasClass("wf-2-4") || $this.hasClass("wf-1-2")) {
					basicDenom = 2;
					basicCSS = "50%";
					basicClass = "wf-1-2";
				}
				else if ($this.hasClass("wf-1")) {
					basicDenom = 1;
					basicCSS = "100%";
					basicClass = "wf-1";
				};
			};

			$gridContainer.data("basicDenom", basicDenom);
			$gridContainer.data("basicCSS", basicCSS);
			$gridContainer.data("basicClass", basicClass);

			basicW = containerWidth/basicDenom;

			if (basicW < settings.minColWidth) {
				$cells.css({ 'width': 100/Math.floor(containerWidth/settings.minColWidth)+'%' });
			} else {
				$cells.css("width", basicCSS);
			}

		};

		var calcHeight = function() {
			var	topPosition = 0,
				totalRows = 0,
				currentRowStart = 0,
				currentRow = -1,
				rows = [],
				tallest =  [];

				$cells.each(function() {
		
					var $this = $(this),
						currentHeight = settings.contentSelector ? $(settings.contentSelector, $this).outerHeight(true) : $this.children().outerHeight(true);

					topPostion = $this.position().top;
		
					if (currentRowStart != topPostion) {
						// We just came to a new row
						// Set the variables for the new row
						currentRow++;
						currentRowStart = topPostion;
						tallest[currentRow] = currentHeight;
						rows.push([]);
						rows[currentRow].push($this);
		
					} else {					
						if (currentRow < 0) {
							currentRow = 0;
							rows.push([]);

						}
						// Another div on the current row. Add it to the list and check if it's taller
						rows[currentRow].push($this);
						tallest[currentRow] = (tallest[currentRow] < currentHeight) ? (currentHeight) : (tallest[currentRow]);

					}

				});
		
				totalRows = rows.length;
		
				for (i = 0; i < totalRows; i++) {
					var inCurrentRow = rows[i].length;
					
					for (j = 0; j < inCurrentRow; j++) {

						settings.borderBoxSelector ? $(settings.borderBoxSelector, rows[i][j]).css("height", tallest[i]) : rows[i][j].css("height", tallest[i]);
						if (settings.setLineHeight)
						settings.borderBoxSelector ? $(settings.borderBoxSelector, rows[i][j]).css("line-height", tallest[i] + 'px') : rows[i][j].css("line-height", tallest[i] + 'px');

						if (settings.maintainBorders && j == 0) {
							rows[i][j].addClass("border-left-none");
						} else {
							rows[i][j].removeClass("border-left-none");
						}
						
						if (settings.maintainBorders && i == totalRows - 1) {
							rows[i][j].addClass("border-bottom-none");
						} else {
							rows[i][j].removeClass("border-bottom-none");
						}

					}
				}

			}


		if (settings.setWidth) calcWidth();
		if (settings.setHeight || settings.setLineHeight) calcHeight();

		if (settings.maintainImages) {
			$("img", $cells).loaded(null, function() {
				$gridContainer.addClass("grid-ready");
				if (settings.setHeight || settings.setLineHeight) calcHeight();
			}, true);
		} else {
			$gridContainer.addClass("grid-ready");
		}

		$(window).on("debouncedresize", function() { // ! needs to be !changed
			if (settings.setWidth) calcWidth();
			if (settings.setHeight || settings.setLineHeight) calcHeight();
		});

	});
}

$(".items-grid").fancyGrid({
	setWidth: true,
	setHeight: true,
	maintainBorders: true,
	contentSelector: "article",
	borderBoxSelector: ".borders",
	minColWidth: 180
});

$(".benefits-grid").fancyGrid({
	setWidth: true,
	setHeight: true,
	maintainBorders: true,
	maintainImages: true,
	contentSelector: ".borders > div",
	borderBoxSelector: ".borders",
	minColWidth: 180
});
$(".logos-grid").fancyGrid({
	setWidth: true,
	setHeight: true,
	setLineHeight: true,
	maintainBorders: true,
	maintainImages: true,
	contentSelector: ".borders > a img",
	borderBoxSelector: ".borders",
	minColWidth: 130
});

/* Fancy grid: end */


/* !Sandbox */
/* !Fancy header*/
var fancyFeaderOverlap = $("#fancy-header.overlap").exists();

function fancyFeaderCalc() {
	if (fancyFeaderOverlap) {
		$("#fancy-header.overlap > .wf-wrap").css({
			"padding-top" : $("#header").height()
		});
	}
}

fancyFeaderCalc();

/* Fancy header:end*/
/* !Rolovers*/
$('.rollover, .rollover-video, .post-rollover, .swiper-slide .link').each(function(){
	var $this = $(this);
	$this.append('<i></i>');
});
$('.rollover, .post-rollover').each(function(){
	var $this = $(this);
	if( $("html").hasClass("old-ie") ){
		$this.hover(function(){
			$("> i, .rollover-thumbnails", this).stop(true).fadeIn();
		},function(){			
			$(" > i, .rollover-thumbnails", this).stop(true).fadeOut();
		});
	}
});
$('.fs-entry, .rollover-project .link, .swiper-slide').each(function(){
	var $this = $(this);
	if( $("html").hasClass("old-ie") ){
		$(".fs-entry .link, .rollover-project .link i, .swiper-slide .link").stop(true).fadeOut();
		$this.hover(function(){
			$(" > .link, i", this).css('display', 'block');
		},function(){			
			$(" > .link, i", this).css('display', 'none');
		});
	}
});
/* Rolovers:end*/
/* !Share links*/
$('.entry-share a').each(function(){
	var caroufredselTimeout;
	var $this = $(this);
	$this.find('.share-content').css({
		'margin-left': - $this.find('.share-content').width()/2
	})
	
		$this.hover(function() {
			clearTimeout(caroufredselTimeout);
			caroufredselTimeout = setTimeout(function() {
				$this.find('.share-content').stop(true, true).fadeIn(200);
			}, 200);
		}, function(){
			clearTimeout(caroufredselTimeout);
			$this.find('.share-content').fadeOut(200);
		});
	
});
/*Share links: end*/

$(window).on("debouncedresize", function( event ) {	
	dtGlobals.resizeCounter++;
	console.log("resize!" + dtGlobals.resizeCounter)
	calcPics();
	moveOffset();
	fancyFeaderCalc();
	$(".slider-wrapper").not('.full').each(function(){
		var scroller = $(this).children().data("theScroller");	
		scroller.update();
	});
	/*H1 max-width*/
	$('h1.entry-title').css({
		'max-width': $('.content').width() - $('.navigation-inner').width() 
	});	

}).trigger( "debouncedresize" );


/* !- Animated content*/
function animated_contents() {

	if(!dtGlobals.isMobile){
		$('body').addClass('no-mobile');
	    $(".animate-element:in-viewport").each(function (i) {
	        var $this = $(this);
	        if (!$this.hasClass('start-animation')) {
	            setTimeout(function () {
	                $this.addClass('start-animation');
	            }, 200 * i);
	        }
	    });
	}
}
animated_contents();
if (!$("html").hasClass("old-ie")){
	$(window).scroll(function () {
	    animated_contents();
	});
};
/*Animated content: end*/
/* !Beautiful loading */

dtGlobals.imgLoaded = setTimeout(function() {
	$("body").append('<style>img {opacity: 1}</style>');
}, 20000);

$("img").not('.no-mobile .animate-element, .rev_slider_wrapper img').loaded(
	function () {
		$(this).css("opacity", 1);
	},
	function () {
		clearTimeout(dtGlobals.imgLoaded);
	},
	true
);

/* Beautiful loading: end */


/* !Smart floating menu */

if (smartMenu) {
	var scrTop = 0,
		scrDir = 0,
		scrUp = false,
		scrDown = false,
		$header = $("#main-nav"),
		$parent = $header.parent(),
		$phantom = $('<div id="phantom" />').appendTo("body"),
		$headerH = $header.height(),
		isMoved = false,
		breakPoint = 0,
		threshold = $("#header").offset().top + $("#header").height(),
		doScroll = false;

	$(window).on("debouncedresize", function() {
		$headerH = $header.height();
	});

	$(window).on("scroll", function() {
		var tempCSS = {},
			tempScrTop = $(window).scrollTop();

		scrDir = tempScrTop - scrTop;


		if (tempScrTop > threshold && isMoved === false) {
			$phantom.css("opacity", 1);
			$header.appendTo($phantom);
			isMoved = true;
		}
		else if (tempScrTop <= threshold && isMoved === true) {
			$header.appendTo($parent);
			$phantom.css("opacity", 0);
			isMoved = false;
		};


/*
		if (scrDir < 0 && tempScrTop > threshold) {
			if (scrDown == true && scrUp == false) {
				$phantom.css("top", -1000);
				breakPoint = tempScrTop;
				doScroll = true;
			};
			
			if ( (doScroll == true) && ((breakPoint - tempScrTop) < $headerH) ) {
				$phantom.css("top", (breakPoint - tempScrTop)-$headerH );
			}
			else if (doScroll == true) {
				$phantom.css("top", 0 );
				doScroll = false;
			};

			scrUp = true;
			scrDown = false;
		}
		else if (scrDir > 0 && tempScrTop > threshold) {
			if (scrDown == false && scrUp == true) {
				$(".dt-hovered").trigger("mouseout");
				breakPoint = tempScrTop;
				doScroll = true;
			}

			if ( (doScroll == true) && ((breakPoint - tempScrTop) > -$headerH) ) {
				$phantom.css("top", (breakPoint - tempScrTop) );
			}
			else if (doScroll == true) {
				$phantom.css("top", -1000);
				doScroll = false;
			};

			scrUp = false;
			scrDown = true;
		}
		else {
			if (scrDown == false && scrUp == true) {
				$(".dt-hovered").trigger("mouseout");
				breakPoint = 0;
			}

			scrUp = false;
			scrDown = false;
		};
*/


		scrTop = $(window).scrollTop();
	});
}

/* Smart floating menu: end */



/* Sandbox: end */

});