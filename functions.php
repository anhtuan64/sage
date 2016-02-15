<?php

define( 'RT_THEME_URL', get_stylesheet_directory_uri() . '/' );
define( 'RT_LANGUAGE', 'rt_language' );

/**
 *
 * Include files on theme
 *
 *
 */
require_once( 'custom-func.php' );
require_once( 'framework/func.php' );
require_once( 'mce/mce.php' );
require_once( 'woocommerce/func-woocommerce.php' );
require_once( 'framework/widgets/func-widget.php' );
require_once( 'framework/theme-options/func-options.php' );

/**
 *
 * Add Thumb Size
 *
 *
 */
add_image_size( 'rt_thumb600x300', 600, 300, array( 'center', 'center' ) );
add_image_size( 'rt_thumb300x200', 300, 200, array( 'center', 'center' ) );
add_image_size( 'rt_thumb150x100', 150, 100, array( 'center', 'center' ) );
add_image_size( 'rt_thumb500x999', 500, 999, array( 'center', 'center' ) );
add_image_size( 'rt_thumb300x300', 300, 300, array( 'center', 'center' ) );
add_image_size( 'rt_thumb255x275', 255, 275, array( 'center', 'center' ) );

/**
 *
 * Avada child theme
 *
 * @param    
 * @return  
 *
 */
function theme_enqueue_styles() {
	global $smof_data;
	// Enqueue Avada Style
	wp_enqueue_style( 'avada-parent-stylesheet', get_template_directory_uri() . '/style.css' );

	wp_register_style( 'owl-carousel', RT_THEME_URL . 'assets/css/third-party/owl-carousel/owl.carousel.min.css' );
	wp_register_style( 'owl-carousel-theme-default', RT_THEME_URL . 'assets/css/third-party/owl-carousel/owl.theme.default.min.css' );
	wp_register_style( 'magnific-popup', RT_THEME_URL . 'assets/css/third-party/magnific-popup.css' );

	// Register shortcodes css
	wp_register_style( 'rt-rtblog', RT_THEME_URL . 'assets/css/shortcodes/rt-rtblog.css' );
	wp_register_style( 'rt-rtblog-carousel', RT_THEME_URL . 'assets/css/shortcodes/rt-rtblog-carousel.css' );

	// Enqueue RT Style
	wp_enqueue_style( 'rt-widgets', RT_THEME_URL . 'assets/css/widgets.css' );
	wp_enqueue_style( 'rt-main-style', RT_THEME_URL . 'assets/css/main-style.css' );
	wp_enqueue_style( 'rt-custom-style', RT_THEME_URL . 'assets/css/custom-style.css' );

	/*-----------------------------------------------------------------*/
	wp_register_script( 'owl-carousel', RT_THEME_URL . 'assets/js/third-party/owl-carousel/owl.carousel.min.js', array(), '1.0', true );
	wp_register_script( 'magnific-popup', RT_THEME_URL . 'assets/js/third-party/jquery.magnific-popup.min.js', array(), '1.0', true );
	
	// Enqueue register
	wp_register_script( 'rt-page-register', RT_THEME_URL . 'assets/js/page-register.js', array(), '1.0', true );

	// Enqueue RT Script
	wp_enqueue_script( 'rt-main', RT_THEME_URL . 'assets/js/main.js', array(), '1.0', true );
	wp_localize_script( 'rt-main', 'ajax_object', array( 'ajax_url' => admin_url( 'admin-ajax.php' ) ) );


	// Localize script
	$AvadaParams = array();
	$AvadaParams['ajaxurl'] = admin_url( 'admin-ajax.php' );
	if ( isset( $smof_data['offcanvas-swipe'] ) && $smof_data['offcanvas-swipe'] ) {
		$AvadaParams['offcanvas_turnon'] = $smof_data['offcanvas-turnon'];
	}
	if ( isset( $smof_data['woocommerce_product_thumb_design'] ) && ! empty( $smof_data['woocommerce_product_thumb_design'] ) ) {
		$AvadaParams['woocommerce_product_thumb_design'] = $smof_data['woocommerce_product_thumb_design'];
	}
	wp_localize_script( 'avada', 'AvadaParams', $AvadaParams );

}
add_action( 'wp_enqueue_scripts', 'theme_enqueue_styles', 11 );

/**
 *
 * Load style in admin page
 *
 * @param    
 * @return  
 *
 */
if ( ! function_exists( 'rt_load_admin_style' ) ) {
	function load_custom_wp_admin_style() {
		wp_enqueue_style( 'rt-login', RT_THEME_URL . 'admin/assets/css/login.css' );
		wp_enqueue_style( 'rt-admin-style-theme', RT_THEME_URL . 'admin/assets/css/admin-style.css' );
	}
	add_action( 'admin_enqueue_scripts', 'load_custom_wp_admin_style' );
	add_action( 'login_enqueue_scripts', 'load_custom_wp_admin_style' );
}

/**
 *
 * Language Setting
 *
 * @param    
 * @return  
 *
 */
function avada_lang_setup() {
	$lang = get_stylesheet_directory() . '/languages';
	load_child_theme_textdomain( 'Avada', $lang );
}
add_action( 'after_setup_theme', 'avada_lang_setup' );

/**
 *
 * Active Plugins
 *
 * @param    
 * @return  
 *
 */
if ( ! function_exists( 'rt_active_plugins' ) ) {
	function rt_active_plugins () {
		global $smof_data;

		activate_plugin ( 'fusion-core/fusion-core.php' );
		activate_plugin ( 'rt-customer-support/rt-customer-support.php' );

		if ( $smof_data['theme_setup_admin_theme'] == 'admin-theme-1' ) {
			activate_plugin ( 'slate-admin-theme/slate-admin-theme.php' );
		} else {
			deactivate_plugins( 'slate-admin-theme/slate-admin-theme.php' );
		}

		if ( $smof_data['theme_setup_banner_side_out_enable'] ) {
			activate_plugin ( 'float-left-right-advertising/float_left_right_ads.php' );
		} else {
			deactivate_plugins( 'float-left-right-advertising/float_left_right_ads.php' );
		}

		if ( $smof_data['woocommerce_compare_products'] ) {
			activate_plugin ( 'yith-woocommerce-compare/init.php' );
		} else {
			deactivate_plugins( 'yith-woocommerce-compare/init.php' );
		}

		if ( $smof_data['woocommerce_wishlist_products'] ) {
			activate_plugin ( 'yith-woocommerce-wishlist/init.php' );
		} else {
			deactivate_plugins( 'yith-woocommerce-wishlist/init.php' );
		}

		if ( $smof_data['woocommerce_product_zoom_thumb'] ) {
			activate_plugin ( 'yith-woocommerce-zoom-magnifier/init.php' );
		} else {
			deactivate_plugins( 'yith-woocommerce-zoom-magnifier/init.php' );
		}

		if ( $smof_data['theme_setup_statistics'] ) {
			activate_plugin ( 'wp-statistics/wp-statistics.php' );
		} else {
			deactivate_plugins( 'wp-statistics/wp-statistics.php' );
		}
	}
	add_action( 'admin_init', 'rt_active_plugins' );
}

/**
 *
 * Register Widgets
 *
 * @param    
 * @return  
 *
 */
if ( ! function_exists( 'rt_register_widget' ) ) {
	function rt_register_widget() {
		global $smof_data;
		if ( $smof_data['theme_setup_top_header'] ) {
			register_sidebar( array(
				'name'          => 'Top Header Left',
				'id'            => 'rt-top-header-left',
				'description'   => __( 'Sidebar of Left Top Header', RT_LANGUAGE ),
				'before_widget' => '<div id="%1$s" class="widget %2$s">',
				'after_widget'  => '</div>',
				'before_title'  => '<div class="heading"><h4 class="widget-title">',
				'after_title'   => '</h4></div>',
			) );

			register_sidebar( array(
				'name'          => 'Top Header Right',
				'id'            => 'rt-top-header-right',
				'description'   => __( 'Sidebar of Right Top Header', RT_LANGUAGE ),
				'before_widget' => '<div id="%1$s" class="widget %2$s">',
				'after_widget'  => '</div>',
				'before_title'  => '<div class="heading"><h4 class="widget-title">',
				'after_title'   => '</h4></div>',
			) );
		}
	}
	add_action( 'widgets_init', 'rt_register_widget' );
}

/**
 *
 * Return List Shortcodes
 *
 * @param    
 * @return $shortcodes: list shortcodes in site
 *
 */
if ( ! function_exists( 'rt_return_list_shortcode' ) ) {
	function rt_return_list_shortcode() {
		$shortcodes = 'rtblog, rtblog_carousel';
		return $shortcodes;
	}
}

/**
 *
 * Register Shortcodes
 *
 */
$shortcodes = rt_return_list_shortcode();
$shortcodes = explode( ",", $shortcodes );
$shortcodes = array_map( "trim", $shortcodes );
foreach ( $shortcodes as $shortcode ) {
	require_once( 'framework/shortcodes/rt-' . $shortcode . '.php' );
	// add_shortcode( $shortcode, 'rt_' . $shortcode . '_shortcode' );
}

/*------------------------------ Security Theme -----------------------------------*/
define( 'DISALLOW_FILE_EDIT', true );
remove_action( 'wp_head', 'wlwmanifest_link' );
remove_action( 'wp_head', 'rsd_link' );
add_filter( 'xmlrpc_enabled', '__return_false' );
if ( ! function_exists( 'rt_remove_version' ) ) {
	function rt_remove_version() {
		return '';
	}
	add_filter( 'the_generator', 'rt_remove_version' );
}
if ( ! function_exists( 'rt_wrong_login' ) ) {
	function rt_wrong_login() {
		return __( 'Wrong username or password.', RT_LANGUAGE );
	}
	add_filter( 'login_errors', 'rt_wrong_login' );
}





