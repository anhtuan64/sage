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
		$str2 = ( explode( " ", $str ) );
		$str3 = array_shift( $str2 );
		return '<span class="first-character">'. $str3 .'</span> ' . implode( " ", $str2 );
	}
}
