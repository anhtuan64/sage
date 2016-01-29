+function ($) {
	'use strict';

	$(document).ready(function() {


		/*  [ magnific-popup ]
		- - - - - - - - - - - - - - - - - - - - */
		if ( $().magnificPopup ) {
			var zoom = false, gallery = false;

			if ( typeof check_popup_gallery_zoom !== 'undefined' && check_popup_gallery_zoom == 'true' ) {
				zoom = true;
			}

			if ( typeof check_popup_gallery !== 'undefined' && check_popup_gallery == 'true' ) {
				gallery = true;
			}

			$('.popup-gallery').magnificPopup({
				type: 'image',
				mainClass: 'mfp-with-zoom', // this class is for CSS animation below
				zoom: {
					enabled: zoom, // By default it's false, so don't forget to enable it

					duration: 300, // duration of the effect, in milliseconds
					easing: 'ease-in-out', // CSS transition easing function

					// The "opener" function should return the element from which popup will be zoomed in
					// and to which popup will be scaled down
					// By defailt it looks for an image tag:
					opener: function(openerElement) {
					// openerElement is the element on which popup was initialized, in this case its <a> tag
					// you don't need to add "opener" option if this code matches your needs, it's defailt one.
						return openerElement.is('img') ? openerElement : openerElement.find('img');
					}
				},
				gallery: {
					// options for gallery
					enabled: gallery
				},
				image: {
					// options for image content type
					titleSrc: 'title'
				}
			});
		}

		/*  [ Shop: Filter Category ]
		- - - - - - - - - - - - - - - - - - - - */
		$( '.category-parent' ).change(function(){
			var val = $( this ).val();
			var parent = $( this ).parent();
			if ( val != '' ) {
				$( '.loading', parent.parent() ).addClass( 'enable' );
				$.ajax({
					type: "GET",
					url: ajax_object.ajax_url,
					dataType: 'html',
					data: ({ action: 'load_product_categories_child', parent: val }),
					success: function( data ) {
						if( data != '' && parent.next().find( '.category-parent' ).length ) {
							parent.next().find( '.category-parent' ).append( data );
						}
						$( '.loading', parent.parent() ).removeClass( 'enable' );
					}			
				});
			}
		});

		/*  [ Shop: Filter Category ]
		- - - - - - - - - - - - - - - - - - - - */
		if ( $().owlCarousel ) {
			var owl = jQuery(".owl-carousel");
			owl.each(function(){
				var items 			= $(this).attr('data-items'),
					autoPlay 		= $(this).attr('data-autoPlay'),
					margin 			= $(this).attr('data-margin'),
					loop 			= $(this).attr('data-loop'),
					nav 			= $(this).attr('data-nav'),
					dots 			= $(this).attr('data-dots'),
					mobile 			= $(this).attr('data-mobile'),
					tablet 			= $(this).attr('data-tablet'),
					desktop 		= $(this).attr('data-desktop'),
					URLhashListener = $(this).attr('data-URLhashListener');

				$(this).owlCarousel({
					items: items,
					autoPlay: autoPlay == "true" ? true : false,
					margin: parseInt( margin ),
					loop: true,
					nav: nav == "true" ? true : false,
					navText: [
						'<i class="fa fa-angle-left"></i>',
						'<i class="fa fa-angle-right"></i>'
					],
					dots: dots == "true" ? true : false,
					responsive: {
						320: {
							items: mobile
						},
						480: {
							items: mobile
						},
						768: {
							items: tablet
						},
						992: {
							items: desktop
						},
						1200: {
							items: items
						}
					},
					URLhashListener: URLhashListener == "true" ? true : false,
				});
			});
		}
		
  		/*  Packery Layout in Archive Page
		- - - - - - - - - - - - - - - - - - - - */
		if ( $().isotope ) {
			$('.isotope-layout').each(function(){
				$(this).isotope({
					itemSelector: '.isotope-element',
					masonry: {
						gutter: 30
					}
				});
			});
		}
			  

	});
}(jQuery);