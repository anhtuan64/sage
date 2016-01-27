<?php
	//Add needed scripts
    add_action('wp_enqueue_scripts', 'gtid_script');

    function gtid_script() {
        wp_enqueue_script('jquery-slide-1',CHILD_URL.'/lib/js/jquery.vticker.js', array( "jquery" ));
?>
    <?php
	}

    //Widget contracter
    add_action('widgets_init', 'register_gtid_promotion_products_slider_widget');

    function register_gtid_promotion_products_slider_widget() {
        //unregister_widget('WP_Widget_Categories');
        register_widget('Gtid_Promotion_Products_Widget');
    }


    class Gtid_Promotion_Products_Widget extends WP_Widget {

        function Gtid_Promotion_Products_Widget() {
            $widget_ops = array('classname' => 'products-slider-widget', 'description' => __('Hiển thị một slide sản phẩm chạy dọc', 'genesis') );
            $this->WP_Widget('products-slider', __('RT - Slide Product', 'genesis'), $widget_ops);
        }


        function widget($args, $instance) {
            global $post;
            extract($args);
            $instance = wp_parse_args( (array)$instance, array(    'title' => '', 'numpro' => '',  'cat' => ''    ) );
            echo $before_widget;

            if ($instance['title']) echo $before_title . apply_filters('widget_title', $instance['title']) . $after_title;
            ?>
  		        <div class="promoteslider">
				<ul>
						<?php
                            $hotPosts = new WP_Query('showposts=20&cat='.$instance['cat']);
                            while($hotPosts->have_posts()):
                            $hotPosts->the_post();
                        ?>
    			
    				<?php get_template_part('inc/loop-product'); ?>
    		
						<?php  endwhile; wp_reset_postdata(); ?>
				</ul>
                </div>
                <script type="text/javascript">
                    jQuery(function() {
                        jQuery('.promoteslider').vTicker({
                            showItems: <?php echo $instance['numpro']; ?>
                        });
                    });
                </script>
    		<?php
			echo $after_widget;
        }

        function update($new_instance, $old_instance) {
            return $new_instance;
        }

        function form($instance) {
            $instance = wp_parse_args( (array)$instance, array( 'title' => '', 'numpro' => '3', 'cat' => '' ) );
            ?>
    		<p>
    			<label for="<?php  echo $this->get_field_id('title'); ?>">
    			<?php  _e('Tiêu đề', 'genesis'); ?>:
    			</label>
    			<input type="text" id="<?php  echo $this->get_field_id('title'); ?>" name="<?php  echo $this->get_field_name('title'); ?>" value="<?php  echo esc_attr( $instance['title'] ); ?>" style="width:95%;" />
    		</p>
            <p>
				<label for="<?php  echo $this-> get_field_id('cat'); ?>"><?php  _e('Chuyên mục','genesis'); ?>:</label>
				<?php
 wp_dropdown_categories(array('name'=> $this->get_field_name('cat'),'selected'=>$instance['cat'],'orderby'=>'Name','hierarchical'=>1,'show_option_all'=>__('Tất cả','genesis'),'hide_empty'=>'0')); ?>
            </p>

            <p>
                <label for="<?php  echo $this->get_field_id('numpro'); ?>">
                <?php  _e('Số sản phẩm hiển thị', 'genesis'); ?>:
                </label>
                <input type="text" id="<?php  echo $this->get_field_id('numpro'); ?>" name="<?php  echo $this->get_field_name('numpro'); ?>" value="<?php  echo esc_attr( $instance['numpro'] ); ?>" style="width:10%;" />
            </p>
    	<?php
        }

    }

    ?>