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
