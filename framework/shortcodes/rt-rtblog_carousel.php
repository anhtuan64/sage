<?php
/**
 * Shortcode RT Blog Carousel.
 *
 * @since  1.0
 * @author TuanNA
 * @link   http://ceotuanna.com
 */
class rt_rtblog_carousel_shortcode {

	private $alert_class;
	private $icon_class;

	public static $args;

	/**
	 * Initiate the shortcode
	 */
	public function __construct() {

		add_shortcode( 'rtblog_carousel', array( $this, 'render' ) );

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
			'style'   						=> '1',
			'posts_per_page'				=> '5',
			'categories'					=> '',
			'custom_text'					=> 'Xem Thêm',
			'custom_link'					=> '',
			'hide_category'					=> '1',
			'hide_viewmore'					=> '1',
		), $atts ) );

		wp_enqueue_style( 'rt-rtblog-carousel' );
		wp_enqueue_style( 'owl-carousel' );
		wp_enqueue_style( 'owl-carousel-theme-default' );
		wp_enqueue_script( 'owl-carousel' );

		$args = array(
			'post_type'  			=> 'post',
			'posts_per_page'		=> $posts_per_page,
		);

		if ( ! empty( $categories ) ) {
			$category = explode(",", $categories, 1);
			if ( is_numeric( $category ) ) {
				$args['cat'] = $categories;
			} else {
				$args['category_name'] = $categories;
			}
		}

		$the_query = new WP_Query( $args );


		// The Loop
		if ( $the_query->have_posts() ) {
			$html .= '<div class="style-'. $style .' rt-shortcodes rt-blog-carousel-shortcode"><div class="fusion-row">';
			$html .= '<div class="owl-carousel" data-items="1" data-autoPlay="false" data-margin="0" data-loop="true" data-nav="true"
						data-dots="false" data-mobile="1" data-tablet="1" data-desktop="1">';
			switch ( $style ) {
				case '1':
					$html .= $this->rt_blog_style_1( $the_query, $atts );
					break;
				default:
					$html .= $this->rt_blog_style_1( $the_query, $atts );
					break;
			}
			$html .= '</div></div></div>';
		}

		return $html;
	}

	/**
	 *
	 * Blog shortcode style 1
	 *
	 * @param  $the_query: Query get data; $atts: attribute
	 * @return $html: html of blog shortcode style 1
	 *
	 */
	function rt_blog_style_1 ( $the_query, $atts ) {

		extract( shortcode_atts( array(
			'style'   						=> '1',
		), $atts ) );

		$i = 0;
		$html = '';
		$image_size = 'rt_thumb300x200';
		
		while ( $the_query->have_posts() ) { $the_query->the_post(); $i++;
			$post_class = array( 'element', 'hentry', 'post-item', 'owl-item' );
			if ( $style == '1' ) {
				$atts['hide_category'] = '0';
			}
			$html .= $this->rt_general_post_html( $post_class, $atts, $image_size );
		}
		return $html;
	}

	/**
	 *
	 * General post html
	 *
	 * @param  $post_class: class of post
	 * @return $html: html of post
	 *
	 */
	function rt_general_post_html ( $post_class = array(), $atts = array(), $image_size = 'rt_thumb300x200' ) {
		extract( shortcode_atts( array(
			'style'   						=> '1',
			'posts_per_page'				=> '5',
			'categories'					=> '',
			'custom_text'					=> 'Xem Thêm',
			'custom_link'					=> '',
			'hide_thumb'					=> '1',
			'hide_category'					=> '1',
			'hide_desc'						=> '1',
			'hide_viewmore'					=> '1',
		), $atts ) );

		$html = '';
		$html .= '<article id="post-'. get_the_ID() .'" class="'. implode( ' ', get_post_class( $post_class ) ) .'"><div class="post-inner">';
		// Check display thumb of post
		if ( $hide_thumb == '1' && has_post_thumbnail() ) :
			$html .= '<div class="entry-thumb">';
			$html .= '<a href="'. get_permalink() .'" title="'. get_the_title() .'">' . get_the_post_thumbnail( get_the_ID(), $image_size ) . '</a>';
			$html .= '</div>';
		endif;
		$html .= '<div class="entry-content">';
			// Check display category
			if ( $hide_category == '1' ) {
				$categories = wp_get_post_categories( get_the_ID() );
				if ( count( $categories ) > 0 ) {
					$html .= '<div class="entry-cat">';
					foreach ( $categories as $key => $cat_id ) {
						$category = get_category( $cat_id );
						if ( $key == ( count( $categories ) - 1 ) ) {
							$html .= '<a href="'. get_term_link( $category ) .'" title="'. $category->name .'">'. $category->name .'</a>';	
						} else {
							$html .= '<a href="'. get_term_link( $category ) .'" title="'. $category->name .'">'. $category->name .'</a>, ';
						}
					}
					$html .= '</div>';
				}
			}
			$html .= '<h3 class="entry-title"><a href="'. get_permalink() .'" title="'. get_the_title() .'">'. get_the_title() .'</a></h3>';
			// Check display description
			if ( $hide_desc == '1' ) {
				$html .= '<div class="entry-description">'. get_the_excerpt() .'</div>';
			}
			// Check display view more button
			if ( $hide_viewmore == '1' ) {
				$html .= '<a href="'. get_permalink() .'" title="'. get_the_title() .'" class="view-more">'. __( 'View More', RT_LANGUAGE ) .'</a>';
			}
		$html .= '</div>';
		$html .= '</div></article>';
		return $html;
	}

}

new rt_rtblog_carousel_shortcode();
