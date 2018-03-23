/**
 * Theme's Custom Javascript Main Files
 */
jQuery( document ).ready( function () {

	// Setting for the navigation toggle feature
	function initMainNavigation( container ) {
		// Add dropdown toggle that display child menu items.
		container.find( '.menu-item-has-children > a, .page_item_has_children > a' ).after( '<button class="dropdown-toggle" aria-expanded="false">' + '<i class="fa fa-angle-down"></i>' + '</button>' );

		container.find( '.dropdown-toggle' ).click( function ( e ) {
			var _this = jQuery( this );
			e.preventDefault();
			_this.toggleClass( 'toggle-on' );
			_this.next( '.children, .sub-menu' ).toggleClass( 'toggled-on' );
			_this.attr( 'aria-expanded', _this.attr( 'aria-expanded' ) === 'false' ? 'true' : 'false' );
			_this.html( _this.html() === '<i class="fa fa-angle-down"></i>' ? '<i class="fa fa-angle-up"></i>' : '<i class="fa fa-angle-down"></i>' );
		} );
	}

	initMainNavigation( jQuery( '.main-navigation' ) );

	// Display the breaking news area on full page load
	jQuery( '.breaking-news' ).show();

	// Display the magazine top area on full page load
	jQuery( '.magazine-page-top-area' ).show();

	// Scroll up function
	jQuery( '#scroll-up' ).hide();
	jQuery( function () {
		jQuery( window ).scroll( function () {
			if ( jQuery( this ).scrollTop() > 1000 ) {
				jQuery( '#scroll-up' ).fadeIn();
			} else {
				jQuery( '#scroll-up' ).fadeOut();
			}
		} );
		jQuery( 'a#scroll-up' ).click( function () {
			jQuery( 'body,html' ).animate( {
				scrollTop : 0
			}, 1000 );
			return false;
		} );
	} );

	// Search toggle
	jQuery( '.search-top' ).click( function () {
		jQuery( '#masthead .search-form-top' ).slideToggle( '500' );
	} );

	// Setting for the menu superfish feature
	if ( typeof jQuery.fn.superfish !== 'undefined' && typeof enquire !== 'undefined' ) {
		var sf = jQuery( 'ul.nav-menu' );
		enquire.register( "screen and (min-width: 768px)", {
			// Triggered when a media query matches.
			match   : function () {
				sf.superfish( {
					speed     : 700,
					delay     : 2000,
					animation : {
						opacity : 'show',
						height  : 'show'
					}
				} );
			},
			// Triggered when the media query transitions
			// *from a matched state to an unmatched state*.
			unmatch : function () {
				sf.superfish( 'destroy' );
			}
		} );
	}

	// Setting for the primary menu visible on up page scroll
	if ( typeof jQuery.fn.headroom !== 'undefined' ) {
		var wpAdminBar = jQuery( '#wpadminbar' );
		var offset_value;
		if ( wpAdminBar.length ) {
			offset_value = wpAdminBar.height() + document.getElementById( 'site-navigation' ).offsetTop;
		} else {
			offset_value = document.getElementById( 'site-navigation' ).offsetTop;
		}
		jQuery( '.main-navigation' ).headroom( {
			'offset'    : offset_value,
			'tolerance' : 0,
			onPin       : function () {
				if ( wpAdminBar.length ) {
					jQuery( '.main-navigation' ).css( {
						'top'      : wpAdminBar.height(),
						'position' : 'fixed'
					} );
				} else {
					jQuery( '.main-navigation' ).css( {
						'top'      : 0,
						'position' : 'fixed'
					} );
				}
			},
			onTop       : function () {
				jQuery( '.main-navigation' ).css( {
					'top'      : 0,
					'position' : 'relative'
				} );
			}
		} );
	}

	// Setting for the sticky menu
	if ( typeof jQuery.fn.sticky !== 'undefined' ) {
		var wpAdminBar = jQuery( '#wpadminbar' );
		if ( wpAdminBar.length ) {
			jQuery( '.main-navigation' ).sticky( {
				topSpacing : wpAdminBar.height(),
				zIndex     : 9999
			} );
		} else {
			jQuery( '.main-navigation' ).sticky( {
				topSpacing : 0,
				zIndex     : 9999
			} );
		}
	}

	// Setting for the bxslider
	if ( typeof jQuery.fn.bxSlider !== 'undefined' ) {
		// Setting for the breaking news
		jQuery( '.latest-news' ).bxSlider( {
			minSlides    : 3,
			maxSlides    : 3,
			slideWidth   : 380,
			slideMargin  : 10,
			ticker       : true,
			speed        : 120000,
			tickerHover  : true,
			useCSS       : false,
			onSliderLoad : function () {
				jQuery( '.latest-news' ).css( 'visibility', 'visible' );
				jQuery( '.latest-news' ).css( 'height', 'auto' );
			}
		} );

		// Setting for the gallery slider
		jQuery( '.gallery-slider' ).bxSlider( {
			mode           : 'horizontal',
			speed          : 2000,
			auto           : true,
			pause          : 6000,
			adaptiveHeight : true,
			pager          : false,
			nextText       : '<span class="slide-next"><i class="fa fa-angle-right"></i></span>',
			prevText       : '<span class="slide-prev"><i class="fa fa-angle-left"></i></span>',
			onSliderLoad   : function () {
				jQuery( '.gallery-slider' ).css( 'visibility', 'visible' );
				jQuery( '.gallery-slider' ).css( 'height', 'auto' );
			}
		} );

		// Setting for the slider widget
		jQuery( '.the-newsmag-category-slider' ).bxSlider( {
			mode           : 'horizontal',
			speed          : 2000,
			auto           : true,
			pause          : 6000,
			adaptiveHeight : true,
			pager          : false,
			nextText       : '<span class="slide-next"><i class="fa fa-angle-right"></i></span>',
			prevText       : '<span class="slide-prev"><i class="fa fa-angle-left"></i></span>',
			onSliderLoad   : function () {
				jQuery( '.the-newsmag-category-slider' ).css( 'visibility', 'visible' );
				jQuery( '.the-newsmag-category-slider' ).css( 'height', 'auto' );
			}
		} );
	}

	// Setting for the popup featured image
	if ( typeof jQuery.fn.magnificPopup !== 'undefined' ) {
		jQuery( '.featured-image-popup' ).magnificPopup( { type : 'image' } );
	}

	// Setting for the responsive video using fitvids
	if ( typeof jQuery.fn.fitVids !== 'undefined' ) {
		jQuery( '.fitvids-video' ).fitVids();
	}

	// Setting for the tabs widget
	if ( typeof jQuery.fn.tabs !== 'undefined' ) {
		jQuery( 'base' ).remove();
		jQuery( '.tab-content' ).tabs( {
			activate : function ( event, ui ) {
				var active = jQuery( '.tab-content' ).tabs( 'option', 'active' );
			}
		} );
	}

	// Setting for sticky sidebar and content area
	if ( (typeof jQuery.fn.theiaStickySidebar !== 'undefined') && (typeof ResizeSensor !== 'undefined') ) {
		// Calculate the whole height of sticky menu
		var height = jQuery( '#site-navigation-sticky-wrapper' ).outerHeight();

		// Assign height value to 0 if it returns null
		if ( height === null ) {
			height = 0;
		}

		jQuery( '#primary, #secondary' ).theiaStickySidebar( {
			additionalMarginTop : 40 + height
		} );
	}

} );

// Setting for masonry layout
if ( typeof jQuery.fn.masonry !== 'undefined' ) {
	jQuery( window ).load( function () {
		jQuery( '.footer-masonry-sidebar' ).masonry( {
			itemSelector : '.widget'
		} );
	} );
}
