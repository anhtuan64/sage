<?php

/**
 *
 * Child Theme hook body class
 *
 * @param    
 * @return $classes
 *
 */
if ( ! function_exists( 'rt_browser_body_class' ) ) {
	function rt_browser_body_class( $classes ) {
		global $smof_data;

		if ( is_archive() || is_author() ) {
			if ( isset( $smof_data['custom_blog_archive_layout'] ) && ! empty( $smof_data['custom_blog_archive_layout'] ) ) {
				$classes[] = 'blog-' . $smof_data['custom_blog_archive_layout'];
			}
		}
		return $classes;
	}

	add_filter( 'body_class', 'rt_browser_body_class' );
}

/**
 *
 * Header: Hook top menu
 *
 * @param    
 * @return 
 *
 */
if ( ! function_exists( 'rt_hook_top_menu' ) ) {
	add_action( 'avada_header', 'rt_hook_top_menu' );
	function rt_hook_top_menu() {
		if ( is_active_sidebar( 'rt-top-header-left' ) || is_active_sidebar( 'rt-top-header-right' ) ) {
			echo '<div class="fusion-secondary-header rt-top-header"><div class="fusion-row">';
			if ( is_active_sidebar( 'rt-top-header-left' ) ) {
				echo '<div class="fusion-alignleft">';
				dynamic_sidebar( 'rt-top-header-left' );
				echo '</div>';
			}
			if ( is_active_sidebar( 'rt-top-header-right' ) ) {
				echo '<div class="fusion-alignright">';
				dynamic_sidebar( 'rt-top-header-right' );
				echo '</div>';
			}
			echo '</div></div>';
		}
	}
}
