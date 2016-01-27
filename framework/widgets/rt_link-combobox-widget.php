<?php
add_action('widgets_init', create_function('', "register_widget('LinkCombobox_Widget');"));
class LinkCombobox_Widget extends WP_Widget {

	/**
	 * Register widget with WordPress.
	 */
	public function __construct() {
		parent::__construct(
	 		'LinkCombobox_Widget', // Base ID
			'RT Link ComboBox Widget', // Name
			array( 'description' => __( 'Hiển thị liên kết dưới dạng ô chọn sổ xuống', 'rt' ), ) // Args
		);
	}

	/**
	 * Front-end display of widget.
	 *
	 * @see WP_Widget::widget()
	 *
	 * @param array $args     Widget arguments.
	 * @param array $instance Saved values from database.
	 */
	public function widget( $args, $instance ) {
		extract( $args );
		$title = apply_filters( 'widget_title', $instance['title'] );
		$text = $instance['text'];
		$category_id = !empty($instance['category_id'])? $instance['category_id'] : '';
		
		echo $before_widget;
		if ( ! empty( $title ) )
			echo $before_title . $title . $after_title;
			
			
		$args = array('category' => $category_id); 
		$bookmarks = get_bookmarks( $args );
		echo '<div class="widget-content-link">';
			echo '<select onchange="openUrl(this.value)" style="height:35px;">';
				echo '<option value=""> Chọn liên kết </option>';
			foreach ( $bookmarks as $bookmark ) { 
				echo '<option value="',$bookmark->link_url,'">',$bookmark->link_name,'</a><br />';
			}
			echo '</select>';
		echo '</div>';
		echo $after_widget;
		
		add_action('wp_footer', 'addJs_LinkCombobox_Widget');
		function addJs_LinkCombobox_Widget(){
			echo '<script language="javascript">';
			echo 'function openUrl(url){
					if(url.length) window.open(url);
				}
			</script>';
		}
	}

	/**
	 * Back-end widget form.
	 *
	 * @see WP_Widget::form()
	 *
	 * @param array $instance Previously saved values from database.
	 */
	public function form( $instance ) {
		if ( isset( $instance[ 'title' ] ) ) {
			$title = $instance[ 'title' ];
		}else {
			$title = __( 'New title', 'rt' );
		}
		
		$category_id = $instance[ 'category_id' ];
		
		
		$args = array(
			'hide_empty'    => false,
		);		
		$terms = get_terms( 'link_category', $args ) ;
		?>
		<p>
		<label for="<?php echo $this->get_field_name( 'title' ); ?>"><strong><?php _e( 'Title:' ); ?></strong></label> 
		<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
		</p>
        <p>
		<label for="<?php echo $this->get_field_name( 'category_id' ); ?>"><strong><?php _e( 'Link Category:' ); ?></strong></label> 
        <select id="<?php echo $this->get_field_id( 'category_id' ); ?>" name="<?php echo $this->get_field_name( 'category_id' ); ?>" class="widefat">
        	<option value="">Tất cả</option>
            <?php 
			foreach($terms as $term):
			$selected = ($term->term_id == $category_id) ? ' selected="selected"' :''; ?>
            <option value="<?php echo $term->term_id; ?>"<?php echo $selected; ?>><?php echo $term->name; ?></option>
            <?php endforeach; ?>
        </select>
		</p>
		<?php 
	}

	/**
	 * Sanitize widget form values as they are saved.
	 *
	 * @see WP_Widget::update()
	 *
	 * @param array $new_instance Values just sent to be saved.
	 * @param array $old_instance Previously saved values from database.
	 *
	 * @return array Updated safe values to be saved.
	 */
	public function update( $new_instance, $old_instance ) {
		$instance = array();
		$instance['title'] = ( !empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
		$instance['category_id'] = ( !empty( $new_instance['category_id'] ) ) ? intval( $new_instance['category_id'] ) : '';

		return $instance;
	}

} 