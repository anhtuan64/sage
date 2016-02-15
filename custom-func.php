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
 * Register custom post type
 *
 * @param    
 * @return
 *
 */
if( ! function_exists( 'rt_register_custom_post_type' ) ) {
	function rt_register_custom_post_type( ) {
		$labels = array(  
			'name' 					=> esc_html__( 'K-Member', RT_LANGUAGE ),  
			'singular_name' 		=> esc_html__( 'K-Member', RT_LANGUAGE ),  
			'add_new' 				=> esc_html__( 'Add New Member', RT_LANGUAGE ),  
			'add_new_item' 			=> esc_html__( 'Add New Member', RT_LANGUAGE ),  
			'edit_item' 			=> esc_html__( 'Edit Member', RT_LANGUAGE ),  
			'new_item' 				=> esc_html__( 'New Member', RT_LANGUAGE ),  
			'view_item' 			=> esc_html__( 'View Member', RT_LANGUAGE ),  
			'search_items' 			=> esc_html__( 'Search Member', RT_LANGUAGE ),  
			'not_found' 			=> esc_html__( 'No Member found', RT_LANGUAGE ),  
			'not_found_in_trash' 	=> esc_html__( 'No Member found in Trash', RT_LANGUAGE ),  
			'parent_item_colon' 	=> '' 
		);  
		$args = array(  
			'labels' 				=> $labels,  
			'menu_position' 		=> 5, 
			'public' 				=> true,
			'publicly_queryable' 	=> true,
			'has_archive' 			=> true,
			'hierarchical' 			=> false,
			'supports' 				=> array( 'title', 'thumbnail' ),
			// 'slug'					=> array( 'slug' => 'door' )
		);
		register_post_type( 'post-k-member', $args );
	}
	add_action( 'init', 'rt_register_custom_post_type' );
}

/**
 *
 * Shortcode post teacher
 *
 * @param    
 * @return
 *
 */
if ( ! function_exists( 'shortcode_post_teacher' ) ) {
	function shortcode_post_teacher( $atts , $content ) {
		$html = '<div class="tribe-events"><div class="fusion-posts-teacher fusion-blog-layout-grid fusion-blog-layout-grid-4 isotope">';
		
		$args = array(
			'post_type'  			=> 'post-k-teacher',
			'posts_per_page'		=> 4,
		);

		$the_query = new WP_Query( $args );
		while( $the_query -> have_posts() ):
			$the_query -> the_post();
			$html .= '<article id="post-'. get_the_ID() .'" class="'. implode( ' ', get_post_class( 'post fusion-post-grid' ) ) .'"><div class="post-inner">';
			if ( has_post_thumbnail() ) :
				$html .= '<div class="entry-thumb">';
				$html .= '<a href="'. get_permalink() .'" title="'. get_the_title() .'">' . get_the_post_thumbnail( get_the_ID(), 'rt_thumb255x275' ) . '</a>';
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
			$html .= '</div></article>';
		endwhile;
		$html .= '</div></div>';
		return $html;
	}
	add_shortcode( 'shortcode_post_teacher' , 'shortcode_post_teacher' );
}

/**
 *
 * Load meta data of course by ajax
 *
 * @param    
 * @return
 *
 */
if ( ! function_exists( 'rt_load_meta_data_of_course' ) ) {
	function rt_load_meta_data_of_course() {
		global $post, $wp_embed;
		$id = $_GET['id'];
		$args = array(
			'post_type'  			=> 'post-k-course',
			'posts_per_page'		=> 1,
			'p'						=> $id,
		);
		$course_query = new WP_Query( $args );
		if ( $course_query->have_posts() ) :
			while( $course_query->have_posts() ): $course_query->the_post();
				$arr_course_meta 		= array( 
					'adress'				=> '', 
					'opening' 				=> '',
				);

				foreach ( $arr_course_meta as $meta => $val ) {
					if ( function_exists( 'get_field' ) ) {
						if ( get_field( $meta, get_the_ID() ) ) {
							$arr_course_meta_val[$meta] = get_field( $meta, get_the_ID(), 'array' );
						}
					}
				}
				extract( shortcode_atts( $arr_course_meta, $arr_course_meta_val ) );

				$print = array(
					'adress' 	=> json_encode( $adress ),
					'opening'	=> json_encode( $opening )
				);
				echo( json_encode( $print ) );

			endwhile;
		endif;
		wp_reset_postdata();
		die();
	}
	add_action('wp_ajax_rt_load_meta_data_of_course', 'rt_load_meta_data_of_course');
	add_action('wp_ajax_nopriv_rt_load_meta_data_of_course', 'rt_load_meta_data_of_course');
}
