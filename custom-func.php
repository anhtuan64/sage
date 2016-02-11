<?php 

/**
 *
 * Replace color title in archive page
 *
 * @param    
 * @return
 *
 */
if( ! function_exists( 'rt_replace_color_title_in_archive' ) ) {
	function rt_replace_color_title_in_archive( $str = '' ) {
		$array = ( explode( " ", $str ) );
		$separate_arr = ceil( count( $array )/2 );
		$array_child_1 = array_slice( $array, 0, $separate_arr );
		$array_child_2 = array_slice( $array, $separate_arr );
		$string_child_1 = implode( $array_child_1,' ');
		$string_child_2 = implode( $array_child_2,' ');
		return '<span class="first-character">'. $string_child_1 .'</span> ' . $string_child_2;
	}
}

/**
 *
 * Shortcode post teacher
 *
 * @param    
 * @return
 *
 */
function shortcode_post_teacher( $atts , $content ) {
    $html = '';
    $html .= '<div class="fusion-posts-teacher fusion-blog-layout-grid fusion-blog-layout-grid-4 isotope">';
   	
   	$args = array(
			'post_type'  			=> 'post-k-teacher',
			'posts_per_page'		=> 4,
	);

   	$the_query = new WP_Query( $args );
   	while( $the_query -> have_posts() ):
   		$the_query -> the_post();
	   	$html .= '<article id="post-'. get_the_ID() .'" class="fusion-post-grid '. implode( ' ', get_post_class( $post_class ) ) .'"><div class="post-inner">';
	   	if ( has_post_thumbnail() ) :
			$html .= '<div class="entry-thumb">';
			$html .= '<a href="'. get_permalink() .'" title="'. get_the_title() .'">' . get_the_post_thumbnail( get_the_ID(), 'rt_thumb255x275' ) . '</a>';
			$html .= '</div>';
		endif;
	   	$html .= '<h3 class="entry-title"><a href="'. get_permalink() .'" title="'. get_the_title() .'">'. get_the_title() .'</a></h3>';
	   	$manifesto = get_field ('manifesto');
	   	if( !empty( $manifesto ) ) :
	   		$html .= '<div class="entry-manifesto">';
	   		$html .= $manifesto;
	   		$html .= '</div>';
	   	endif;
	   	$html .= '</div></article>';
   	endwhile;
   	$html .= '</div>';
    return $html;
}
add_shortcode( 'shortcode_post_teacher' , 'shortcode_post_teacher' );