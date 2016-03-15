<?php 
/**
 * Template Name: List Course Standard
 *
 * @package RT
 * @subpackage Sage
 * @since 1.0
 */
?>
<?php get_header(); ?>
	<div id="content" <?php Avada()->layout->add_style( 'content_style' ); ?>>
		<?php
			wp_enqueue_script( 'rt-page-register' );
			while( have_posts() ): the_post();
		?>
		<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
			<?php echo avada_render_rich_snippets_for_pages(); ?>
			<?php if( ! post_password_required($post->ID) ): // 1 ?>
			<?php if(!Avada()->settings->get( 'featured_images_pages' ) ): // 2 ?>
			<?php
			if( avada_number_of_featured_images() > 0 || get_post_meta( $post->ID, 'pyre_video', true ) ): // 3
			?>
			<div class="fusion-flexslider flexslider post-slideshow">
				<ul class="slides">
					<?php if(get_post_meta($post->ID, 'pyre_video', true)): ?>
					<li>
						<div class="full-video">
							<?php echo get_post_meta($post->ID, 'pyre_video', true); ?>
						</div>
					</li>
					<?php endif; ?>
					<?php if( has_post_thumbnail() && get_post_meta( $post->ID, 'pyre_show_first_featured_image', true ) != 'yes' ): ?>
					<?php $attachment_image = wp_get_attachment_image_src(get_post_thumbnail_id(), 'full'); ?>
					<?php $full_image = wp_get_attachment_image_src(get_post_thumbnail_id(), 'full'); ?>
					<?php $attachment_data = wp_get_attachment_metadata(get_post_thumbnail_id()); ?>
					<li>
						<a href="<?php echo $full_image[0]; ?>" rel="prettyPhoto[gallery<?php the_ID(); ?>]" title="<?php echo get_post_field('post_excerpt', get_post_thumbnail_id()); ?>" data-title="<?php echo get_post_field('post_title', get_post_thumbnail_id()); ?>" data-caption="<?php echo get_post_field('post_excerpt', get_post_thumbnail_id()); ?>"><img src="<?php echo $attachment_image[0]; ?>" alt="<?php echo get_post_meta(get_post_thumbnail_id(), '_wp_attachment_image_alt', true); ?>" /></a>
					</li>
					<?php endif; ?>
					<?php
					$i = 2;
					while($i <= Avada()->settings->get( 'posts_slideshow_number' )):
					$attachment_new_id = kd_mfi_get_featured_image_id('featured-image-'.$i, 'page');
					if($attachment_new_id):
					?>
					<?php $attachment_image = wp_get_attachment_image_src($attachment_new_id, 'full'); ?>
					<?php $full_image = wp_get_attachment_image_src($attachment_new_id, 'full'); ?>
					<?php $attachment_data = wp_get_attachment_metadata($attachment_new_id); ?>
					<li>
						<a href="<?php echo $full_image[0]; ?>" rel="prettyPhoto[gallery<?php the_ID(); ?>]" title="<?php echo get_post_field('post_excerpt', $attachment_new_id); ?>" data-title="<?php echo get_post_field( 'post_title', $attachment_new_id ); ?>" data-caption="<?php echo get_post_field('post_excerpt', $attachment_new_id ); ?>"><img src="<?php echo $attachment_image[0]; ?>" alt="<?php echo get_post_meta($attachment_new_id, '_wp_attachment_image_alt', true); ?>" /></a>
					</li>
					<?php endif; $i++; endwhile; ?>
				</ul>
			</div>
			<?php endif; // 3 ?>
			<?php endif; // 2 ?>
			<?php endif; // 1 password check ?>
			<div class="post-content">
				<?php 
					$current_month 	= date( "m" );
					$args 			= array(
						'post_type'  			=> 'post-k-course',
						'posts_per_page'		=> -1,
					);

					$course_query = new WP_Query( $args );
					if ( $course_query->have_posts() ) :
						echo '
						<div class="fusion-table table-1">
							<table width="100%">
								<tr>
									<th>Khóa học</th>
									<th>Thời lượng</th>
									<th>Học phí</th>
									<th>Địa điểm</th>
									<th>Tháng '. (int)date("m") .'</th>
									<th>Tháng '. ( date("m") + 1 ) .'</th>
									<th>Tháng '. ( date("m") + 2 ) .'</th>
									<th>Chi tiết</th>
								</tr>
						';
						while( $course_query->have_posts() ): $course_query->the_post();
							$arr_course_meta 		= array( 
								'adress'				=> '', 
								// 'opening' 				=> '',
							);

							foreach ( $arr_course_meta as $meta => $val ) {
								if ( function_exists( 'get_field' ) ) {
									if ( get_field( $meta, get_the_ID() ) ) {
										$arr_course_meta_val[$meta] = get_field( $meta, get_the_ID(), 'array' );
									}
								}
							}
							extract( shortcode_atts( $arr_course_meta, $arr_course_meta_val ) );
							
							if ( is_array( $adress ) && count( $adress ) ) {
								foreach ( $adress as $key => $value ) {
									$opening_1 = $opening_2 = $opening_3 = '';
									echo '<tr>';
									echo '<td><a href="'. get_permalink() .'" title="'. get_the_title() .'">'. get_the_title() .'</a></td>';
									echo '<td>'. $value['duration'] .'</td>';
									echo '<td>'. $value['tuition'] .'</td>';
									echo '<td>'. $value['name'] .'</td>'; 
									if ( is_array( $value['opening'] ) && count( $value['opening'] ) > 0 ) {
										foreach ( $value['opening'] as $key => $val ) {
											$opening_current = (int)date( "m", strtotime( $val['date'] ) );
											if ( empty( $opening_1 ) && $opening_current == $current_month ) {
												$opening_1 = $val['date'];
											}
											if ( empty( $opening_2 ) && $opening_current == ( $current_month + 1 ) ) {
												$opening_2 = $val['date'];
											}
											if ( empty( $opening_3 ) && $opening_current == ( $current_month + 2 ) ) {
												$opening_3 = $val['date'];
											}
										}
									}
									// var_dump($value['opening']);
									echo '<td>'. $opening_1 .'</td>';
									echo '<td>'. $opening_2 .'</td>';
									echo '<td>'. $opening_3 .'</td>';
									echo '<td><a href="'. get_permalink() .'" title="'. get_the_title() .'">Xem chi tiết</a></td>';
									echo '</tr>';
								}
							}					

						endwhile;
						echo '
							</table>
						</div><div style="height: 20px;"><!----></div>
						';
					endif;
					wp_reset_postdata();

				?>
			</div>
			<?php if( ! post_password_required($post->ID) ): ?>
			<?php if(class_exists('WooCommerce')): ?>
			<?php
			$woo_thanks_page_id = get_option('woocommerce_thanks_page_id');
			if( ! get_option('woocommerce_thanks_page_id') ) {
				$is_woo_thanks_page = false;
			} else {
				$is_woo_thanks_page = is_page( get_option( 'woocommerce_thanks_page_id' ) );
			}
			?>
			<?php if(Avada()->settings->get( 'comments_pages' ) && !is_cart() && !is_checkout() && !is_account_page() && ! $is_woo_thanks_page ): ?>
				<?php
				wp_reset_query();
				comments_template();
				?>
			<?php endif; ?>
			<?php else: ?>
			<?php if(Avada()->settings->get( 'comments_pages' )): ?>
				<?php
				wp_reset_query();
				comments_template();
				?>
			<?php endif; ?>
			<?php endif; ?>
			<?php endif; // password check ?>
		</div>
		<?php endwhile; ?>
		<?php wp_reset_query(); ?>
	</div>
	<?php do_action( 'fusion_after_content' ); ?>
<?php get_footer();

// Omit closing PHP tag to avoid "Headers already sent" issues.
