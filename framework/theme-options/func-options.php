<?php

add_action( 'init', 'rt_of_options', 30 );

if( ! function_exists( 'rt_of_options_array') )
{
	function rt_of_options_array()
	{
		$of_options = array();

		/*-----------------------------------------------------------------------------------*/
		/* The Options Array */
		/*-----------------------------------------------------------------------------------*/

		// Theme Setup
		$of_options[] = array( "name" => __("Theme Setup", RT_LANGUAGE),
			"id" => "theme_setup",
			"type" => "heading"
		);

		$of_options[] = array( "name" => __("Register page link", RT_LANGUAGE),
			"id" => "theme_setup_register_page_link",
			"std" => "",
			"type" => "text");

		$of_options[] = array( "name" => __("Enable admin theme", RT_LANGUAGE),
			"id" => "theme_setup_admin_theme",
			"std" => "default",
			"type" => "select",
			"options" => array(
				"default" => __("Default", RT_LANGUAGE),
				"admin-theme-1" => __("Admin Theme 1", RT_LANGUAGE),
			)
		);

		$of_options[] = array( "name" => __("Support Developer Level 1", RT_LANGUAGE),
			"id" => "theme_setup_developer_level_1",
			"std" => 1,
			"on" 		=> "Enable",
			"off" 		=> "Disable",
			"type" 		=> "switch"
		);

		$of_options[] = array( "name" => __("Enable Customer Support", RT_LANGUAGE),
			"desc" => __('Disable this feature If you are a developer', RT_LANGUAGE),
			"id" => "theme_setup_customer_support",
			"std" => 1,
			"on" 		=> "Enable",
			"off" 		=> "Disable",
			"type" 		=> "switch"
		);

		$of_options[] = array( "name" => __("Enable Top Header", RT_LANGUAGE),
			"id" => "theme_setup_top_header",
			"std" => 0,
			"on" 		=> "Enable",
			"off" 		=> "Disable",
			"type" 		=> "switch"
		);

		$of_options[] = array( "name" => __("Enable Banner side out", RT_LANGUAGE),
			"desc" => __('Enable to use banner side out. Click <a target="_blank" href="'. get_admin_url() .'/options-general.php?page=float_left_right_ads.php">Here</a> to setup banner', RT_LANGUAGE),
			"id" => "theme_setup_banner_side_out_enable",
			"std" => 0,
			"on" 		=> "Enable",
			"off" 		=> "Disable",
			"type" 		=> "switch"
		);

		$of_options[] = array( "name" => __("Enable Statistic", RT_LANGUAGE),
			"desc" => __('Enabled Statistics to measure website traffic', RT_LANGUAGE),
			"id" => "theme_setup_statistics",
			"std" => 0,
			"on" 		=> "Enable",
			"off" 		=> "Disable",
			"type" 		=> "switch"
		);

		// Single Woocommerce
		$of_options[] = array( "name" => __("Custom Woocommerce", RT_LANGUAGE),
			"id" => "custom_woocommerce",
			"type" => "heading"
		);

		$of_options[] = array( "name" => __("Enable Compare Products", RT_LANGUAGE),
			"desc" => __('Enable/Disable Compare products. Click <a target="_blank" href="'. get_admin_url() .'/admin.php?page=yith_woocompare_panel">Here</a> to setup feature.', RT_LANGUAGE),
			"id" => "woocommerce_compare_products",
			"std" => 0,
			"on" 		=> "Enable",
			"off" 		=> "Disable",
			"type" 		=> "switch"
		);

		$of_options[] = array( "name" => __("Enable Wishlist Products", RT_LANGUAGE),
			"desc" => __('Enable/Disable Wishlist products.', RT_LANGUAGE),
			"id" => "woocommerce_wishlist_products",
			"std" => 0,
			"on" 		=> "Enable",
			"off" 		=> "Disable",
			"type" 		=> "switch"
		);

		$of_options[] = array( "name" => __("Shop Page", RT_LANGUAGE),
			"desc" => "",
			"id" => "shop_page_code",
			"std" => "<h3 style='margin: 0;'>" . __("Shop Page", RT_LANGUAGE) . "</h3>",
			"icon" => true,
			"type" => "info"
		);

		$of_options[] = array( "name" => __("Shop Page Filter Display?", RT_LANGUAGE),
			"desc" => __("Enable/Disable filter on shop page", RT_LANGUAGE),
			"id" => "woocommerce_shop_filter_display",
			"std" => 0,
			"on" 		=> "Enable",
			"off" 		=> "Disable",
			"type" 		=> "switch"
		);

		$of_options[] = array( "name" => __("Shop Page Thumbnail Hover Effect", RT_LANGUAGE),
			"desc" => __("Choose Thumbnail Hover Effect in Shop Page", RT_LANGUAGE),
			"id" => "woocommerce_shop_thumb_hover_effect",
			"std" => "default",
			"type" => "select",
			"options" => array(
				"default" => __("Default", RT_LANGUAGE),
				"hover-zoom" => __("Zoom Thumbnail", RT_LANGUAGE),
			)
		);

		$of_options[] = array( "name" => __("Shop Page Thumbnail Click Effect", RT_LANGUAGE),
			"desc" => __("Choose Thumbnail Click Effect in Shop Page", RT_LANGUAGE),
			"id" => "woocommerce_shop_thumb_click_effect",
			"std" => "default",
			"type" => "select",
			"options" => array(
				"default" => __("Default", RT_LANGUAGE),
				"popup-image" => __("Popup Image", RT_LANGUAGE),
				"popup-image-zoom" => __("Popup Image and Zoom", RT_LANGUAGE),
				"popup-gallery" => __("Popup Gallery", RT_LANGUAGE),
				"popup-gallery-zoom" => __("Popup Gallery and Zoom", RT_LANGUAGE),
			)
		);

		$of_options[] = array( "name" => __("Single Product", RT_LANGUAGE),
			"desc" => "",
			"id" => "single_product_code",
			"std" => "<h3 style='margin: 0;'>" . __("Single Product", RT_LANGUAGE) . "</h3>",
			"icon" => true,
			"type" => "info");

		$of_options[] = array( "name" => __("Enable Zoom Thumbnail", RT_LANGUAGE),
			"desc" => __('Enable to use zoom thumbnail effect. Click <a target="_blank" href="'. get_admin_url() .'/admin.php?page=yith_woocommerce_zoom-magnifier_panel">Here</a> to setup effect.', RT_LANGUAGE),
			"id" => "woocommerce_product_zoom_thumb",
			"std" => 0,
			"on" 		=> "Enable",
			"off" 		=> "Disable",
			"type" 		=> "switch"
		);

		$of_options[] = array( "name" => __("Single Product thumbnail gallery design", RT_LANGUAGE),
			"desc" => __("Choose if the thumbnail gallery on the single product page are vertical or horizontal.", RT_LANGUAGE),
			"id" => "woocommerce_product_thumb_design",
			"std" => "horizontal",
			"type" => "select",
			"options" => array(
				"horizontal" => __("Horizontal Design", RT_LANGUAGE),
				"vertical" => __("Vertical Design", RT_LANGUAGE)
			)
		);

		// Custom Blog
		$of_options[] = array( "name" => __("Custom Blog", RT_LANGUAGE),
			"id" => "heading_custom_blog",
			"type" => "heading"
		);

		$of_options[] = array( "name" => __("General Blog Options", "Avada"),
			"desc" => "",
			"id" => "custom_blog_single_post",
			"std" => "<h3 style='margin: 0;'>" . __("General Blog Options", "Avada") . "</h3>",
			"icon" => true,
			"type" => "info"
		);

		$of_options[] = array( "name" => __("Blog Archive/Category Layout", RT_LANGUAGE),
			"desc" => __("Select the layout for the blog archive/category pages.", RT_LANGUAGE),
			"id" => "custom_blog_archive_layout",
			"std" => "Large",
			"type" => "select",
			"options" => array(
				'' => 'None',
				'medium-1' => 'Medium 1',
			)
		);


		return $of_options;
	}
}

if ( ! function_exists( 'rt_of_options' ) )
{
	function rt_of_options()
	{
		global $of_options;

		// foreach ( $of_options as $key => $option ) {
		// 	if ( $option['id'] == 'blog_archive_layout' ) { 
		// 		$of_options[$key]['options'] = array(
				// 	'Large' => 'Large',
				// 	'Medium' => 'Medium',
				// 	'Medium 2' => 'Medium 2',
				// 	'Medium 3' => 'Medium 3',
				// 	'Large Alternate' => 'Large Alternate',
				// 	'Medium Alternate' => 'Medium Alternate',
				// 	'Grid' => 'Grid',
				// 	'Timeline' => 'Timeline'
				// );
		// 	}
		// }

		$of_options = array_merge( $of_options, rt_of_options_array() );
		// End Avada Edit
	}//End function: of_options()
}//End chack if function exists: of_options()


// Omit closing PHP tag to avoid "Headers already sent" issues.
