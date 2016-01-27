<?php
add_action('admin_enqueue_scripts', 'my_admin_scripts2');
// Thêm các script cần thiết cho bộ upload trong theme options
function my_admin_scripts2() {
        wp_enqueue_media();
        wp_register_script('my-admin-js2', get_stylesheet_directory_uri() .'/lib/js/upload.js', array('jquery'));
        wp_enqueue_script('my-admin-js2');

}
add_action('widgets_init', create_function('', "register_widget('GTID_Image_QC');"));
class GTID_Image_QC extends WP_Widget {

	function GTID_Image_QC() {
		$widget_ops = array( 'classname' => 'img-qc', 'description' => __('Ảnh - Image', 'genesis') );
		$control_ops = array( 'width' => 250, 'height' => 350, 'id_base' => 'imgqc' );
		$this->WP_Widget( 'imgqc', __('RT - Ảnh quảng cáo', 'genesis'), $widget_ops, $control_ops );
        //add_action('wp_enqueue_scripts', array(&$this, 'gtid_scripts'));
	}

	function widget($args, $instance) {
		extract($args);

		// defaults
		$instance = wp_parse_args( (array)$instance, array(
			'title' => '',
            'img_num' => 0
		) );

		echo $before_widget;

            if ($instance['title']) echo $before_title . apply_filters('widget_title', $instance['title']) . $after_title;
            ?>


                <div class="image-slider">
                        <?php for($i = 0; $i < $instance['img_num']; $i++) : ?>
                            <a href="<?php echo $instance['img_link_'.$i]; ?>" rel="nofollow" target="_blank">
                                <img src="<?php echo $instance['img_src_'.$i]; ?>" alt="Logo" />
                            </a>
                        <?php endfor; ?>
                </div>

            <?php

		echo $after_widget;
	}

	function update($new_instance, $old_instance) {
		return $new_instance;
	}

	function form($instance) {

		// ensure value exists
		$instance = wp_parse_args( (array)$instance, array(
			'title' => '',
            'link' => '',
            'img_num' => 0
		) );

?>

		<p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Tiêu đề', 'genesis'); ?>:</label>
		<input type="text" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" value="<?php echo esc_attr( $instance['title'] ); ?>" style="width:99%;" /></p>

        <div style="overflow: hidden;"><label for="<?php echo $this->get_field_id('img_num'); ?>"><?php _e('Số lượng ảnh', 'genesis'); ?>:</label>
		<input type="text" id="<?php echo $this->get_field_id('img_num'); ?>" name="<?php echo $this->get_field_name('img_num'); ?>" value="<?php echo esc_attr( $instance['img_num'] ); ?>" size="2" />

            <p class="alignright">
        		<img alt="" title="" class="ajax-feedback " src="<?php bloginfo('url'); ?>/wp-admin/images/wpspin_light.gif" style="visibility: hidden;" />
        		<input type="submit" value="Lưu" class="button-primary widget-control-save" id="savewidget" name="savewidget" />
            </p>
        </div>

        <?php for($i = 0; $i < $instance['img_num']; $i++) : ?>
            <div style="background: #F5F5F5; margin-bottom: 10px; padding: 10px;">
            <p><label for="<?php echo $this->get_field_id('img_src_'.$i); ?>"><?php _e('Nguồn ảnh ', 'genesis'); echo $i+1; ?>:</label>
		<input type="text" id="<?php echo $this->get_field_id('img_src_'.$i); ?>" name="<?php echo $this->get_field_name('img_src_'.$i); ?>" value="<?php echo esc_attr( $instance['img_src_'.$i] ); ?>" style="width:90%;" />
	       </p>

        <p><label for="<?php echo $this->get_field_id('img_link_'.$i); ?>"><?php _e('Link ảnh ', 'genesis'); echo $i+1; ?>:</label>
        		<input type="text" id="<?php echo $this->get_field_id('img_link_'.$i); ?>" name="<?php echo $this->get_field_name('img_link_'.$i); ?>" value="<?php echo esc_attr( $instance['img_link_'.$i] ); ?>" style="width:90%;" />
        </p>
            </div>
        <?php endfor; ?>

	<?php
	}

}