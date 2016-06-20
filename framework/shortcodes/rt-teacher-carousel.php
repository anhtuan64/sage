<?php
/**
 * Shortcode RT Teacher Blog Carousel.
 *
 * @since  1.0
 * @author QH
 * @link   
 */
class rt_teacher_shortcode {

	public static $args;

	/**
	 * Initiate the shortcode
	 */
	public function __construct() {

		add_shortcode( 'rtteacher_carousel', array( $this, 'render' ) );

	}

	/**
	 * Render the shortcode
	 * @param  array $args	 Shortcode paramters
	 * @param  string $content Content between shortcode
	 * @return string		  HTML output
	 */
	function render( $atts, $content = '') {
		$html = '';
		extract( shortcode_atts( array(
			'posts_per_page'				=> '5',
			'column'						=> '4',
			'margin_item'					=> '50',
			'autoplay'						=> 'yes',
			'touch_scroll'					=> 'yes',
			'navigation'                    => '1',
		), $atts ) );

		// wp_enqueue_style( 'rt-teacher' );
		$html  = '<div class="fusion-image-carousel-fixed carousel-teacher">';
			$html .= '<div class="fusion-carousel" 
						data-autoplay    = "'. $autoplay .'" 
						data-columns     = "'. $column .'" 
						data-itemmargin  = "'. $margin_item .'" 
						data-touchscroll = "'. $touch_scroll .'">';
				$html .= '<div class="fusion-carousel-positioner">';

					$html .= '<div class="fusion-carousel-wrapper">';
						$html .= '<ul class="fusion-posts-teacher fusion-carousel-holder">';
						$args = array(
							'post_type'  			=> 'post-k-teacher',
							'posts_per_page'		=> $posts_per_page,
						);


						$the_query = new WP_Query( $args );


						// The Loop
						if ( $the_query->have_posts() ) {
							while( $the_query -> have_posts() ):
								$the_query -> the_post();
								$html .= '<li id="post-'. get_the_ID() .'" class="'. implode( ' fusion-carousel-item ', get_post_class( 'post fusion-post-grid' ) ) .'" >';
									$html .= '<div class="post-inner">';
									if ( has_post_thumbnail() ) :
										$html .= '<div class="entry-thumb">';
										$html .= '<a href="'. get_permalink() .'" title="'. get_the_title() .'">' . get_the_post_thumbnail( get_the_ID(), 'rt_thumb300x400' ) . '</a>';
										$html .= '</div>';
									endif;
									$html .= '<h3 class="entry-title"><a href="'. get_permalink() .'" title="'. get_the_title() .'">'. get_the_title() .'</a></h3>';
									if ( function_exists( 'get_field' ) ) :
										$manifesto = get_field ( 'manifesto' );
										if( ! empty( $manifesto ) ) :
											$html .= '<div class="entry-manifesto">';
											$html .= $manifesto;
											$html .= '</div>';
										endif;
									endif;
									$html .= '</div>';
								$html .= '</li>';
							endwhile;
						}
						$html .= '</ul>';
					$html .= '</div>';
					if ( $navigation == '1' ) {
						$html .= '<div class="wrap-carousel-navigation">';
						$html .= '<div class="fusion-carousel-nav">';
							$html .= '<span class="fusion-nav-prev">';
							$html .= '</span>';
							$html .= '<span class="fusion-nav-next">';
							$html .= '</span>';
						$html .= '</div>';
						$html .= '</div>';
					}
				$html .= '</div>';
			$html .= '</div>';
		$html .= '</div>';
		return $html;
	}


}
new rt_teacher_shortcode();