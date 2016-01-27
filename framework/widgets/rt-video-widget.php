<?php
add_action('widgets_init', create_function('', "register_widget('GTID_Video');"));
class GTID_Video extends WP_Widget {

	function GTID_Video() {
		$widget_ops = array( 'classname' => 'video', 'description' => __('Video', 'genesis') );
		$control_ops = array( 'width' => 250, 'height' => 350, 'id_base' => 'video' );
		$this->WP_Widget( 'video', __('RT - Video', 'genesis'), $widget_ops, $control_ops );
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


                <div class="video-youtube">
                       
                <iframe width="<?php echo $instance['width']; ?>" height="<?php echo $instance['height']; ?>" 
            	src="<?php echo $instance['link_video']; ?>" frameborder="0" allowfullscreen>
                </iframe>
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

        <div style="overflow: hidden;">
    	<label for="<?php echo $this->get_field_id('width'); ?>"><?php _e('Width', 'genesis'); ?>:</label>
		<input type="text" id="<?php echo $this->get_field_id('width'); ?>" name="<?php echo $this->get_field_name('width'); ?>" value="<?php echo esc_attr( $instance['width'] ); ?>" size="2" />
		<label for="<?php echo $this->get_field_id('width'); ?>"><?php _e('height', 'genesis'); ?>:</label>
		<input type="text" id="<?php echo $this->get_field_id('height'); ?>" name="<?php echo $this->get_field_name('height'); ?>" value="<?php echo esc_attr( $instance['height'] ); ?>" size="2" />
        </div>
            <p><label for="<?php echo $this->get_field_id('link_video'); ?>"><?php _e('Link video ', 'genesis'); echo $i+1; ?>:</label>
				<input type="text" id="<?php echo $this->get_field_id('link_video'); ?>" name="<?php echo $this->get_field_name('link_video'); ?>" value="<?php echo esc_attr( $instance['link_video'] ); ?>" style="width:90%;" />
	       </p>
	<?php
	}

}