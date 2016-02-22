<?php 
/**
 * Template Name: Page Register
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
			<div class="post-content page-register">
			<?php
				$check_submit = 0;
				// Get data of form submit
				if( $_SERVER["REQUEST_METHOD"] == "POST" && isset( $_POST['submit'] ) ) :
					$arr_form_element = array(
						'course'				=> '',
						'adress'					=> '',
						'date'					=> '',
						'sex'					=> '',
						'fullname'				=> '',
						'phone'					=> '',
						'email'					=> '',
						'company'				=> '',
						'position'				=> '',
						'fields'				=> '',
						'where_source_course'	=> '',
						'payment_type'			=> '',
					);
					foreach ( $arr_form_element as $key => $val ) {
						if ( isset( $_POST[$key] ) ) {
							$arr_form_element_val[$key] = $_POST[$key];
						}
					}
					extract( shortcode_atts( $arr_form_element, $arr_form_element_val ) );

					if ( count( $sex ) > 0 && count( $fullname ) > 0 && count( $email ) > 0 ) :
						$course = '';
						
						$args = array(
							'post_type'  			=> 'post-k-course',
							'posts_per_page'		=> 1,
							'p'						=> $course,
						);
						$course_query = new WP_Query( $args );
						if ( $course_query->have_posts() ) :
							while( $course_query->have_posts() ): $course_query->the_post();
								$course = get_the_title();
							endwhile;
						endif;
						for ( $i = 0; $i < count( $sex ); $i++ ) { 
							if ( ! empty( $sex[$i] ) && ! empty( $fullname[$i] ) && ! empty( $phone[$i] ) && ! empty( $email[$i] ) ) {
								// Insert member to database
								$memeber_arr = array(
									'post_type'			=> 'post-k-member',
									// 'post_status'		=> 'publish',
									'post_title'		=> wp_strip_all_tags( $fullname[$i] ),
									'meta_input'		=> array(
										'course_name'			=> wp_strip_all_tags( $course ),
										'adress'				=> wp_strip_all_tags( $adress ),
										'date'					=> wp_strip_all_tags( $date ),
										'sex'					=> wp_strip_all_tags( $sex[$i] ),
										'phone'					=> wp_strip_all_tags( $phone[$i] ),
										'email'					=> wp_strip_all_tags( $email[$i] ),
										'company'				=> wp_strip_all_tags( $company[$i] ),
										'position'				=> wp_strip_all_tags( $position[$i] ),
										'field'					=> wp_strip_all_tags( $fields[$i] ),
										'where_source_course'	=> wp_strip_all_tags( $where_source_course ),
										'payment_type'			=> wp_strip_all_tags( $payment_type ),
									),

								);
								if ( wp_insert_post( $memeber_arr ) ) {
									_e( '<center>Học viện Thương hiệu Plato cảm ơn sự quan tâm của anh chị tới các hoạt động của học viện.<br/>Chúng tôi xin phép được gửi mail cho anh chị những thông tin về khóa học và các hoạt động của học viện để anh chị có thể theo dõi và tham gia cùng học viên Thương hiệu Plato.<br/>Trân trọng!</center>', RT_LANGUAGE );
								} 
								// else {
								// 	_e( '<center>Your register error, Please try again.</center>', RT_LANGUAGE );
								// }
							} 
							// else {
							// 	_e( '<center>You have not filled all information, Please reset the page and fill in the information before submit.</center>', RT_LANGUAGE );
							// }
						}
						wp_reset_postdata();
					endif;
				else:
					$course_id = $_GET['course_id'];
					// var_dump($course_id);
			?>
				<form method="post" class="register-form">
					<div class="box-science course-information">
						<div class="acf-error-message"></div>
						<h3> <?php _e( 'Thông tin khóa học', RT_LANGUAGE ) ?> </h3>
						<?php 
							// Get custom fields of page register
							$fields 					= get_field( "fields", get_the_ID() );
							$where_source_course 		= get_field( "where_source_course", get_the_ID() );
							$payment_type 				= get_field( "payment_type", get_the_ID() );

							// Get all course
							$args = array(
								'post_type'  			=> 'post-k-course',
								'posts_per_page'		=> -1,
							);
							$course_query = new WP_Query( $args );
						?> 
						<ul> 
							<li> 
								<span class="left">	<?php _e( 'Tên khóa học: *', RT_LANGUAGE ) ?> </span>
								<span class="right"> 
									<select name="course" class="course" onchange="course_selected( jQuery(this) );" required>
										<option value=""><?php _e( 'Please choose', RT_LANGUAGE ) ?></option>
										<?php 
											if ( $course_query->have_posts() ) :
												while( $course_query->have_posts() ): $course_query->the_post();
													echo '<option value="'. get_the_ID() .'">'. get_the_title() .'</option>';
												endwhile;
												wp_reset_postdata();
											endif;
										?>				
									</select>
								</span>
							</li><!-- end Science name  -->
							<li> 
								<span class="left">	<?php _e( 'Địa điểm:', RT_LANGUAGE ) ?> </span>
								<span class="right"> 
									<select name="adress" class="adress">
										<option value=""><?php _e( 'Please choose', RT_LANGUAGE ) ?></option>
									</select>
								</span>
							</li><!-- end adress  -->
							<li> 
								<span class="left">	<?php _e( 'Date:', RT_LANGUAGE ) ?> </span>
								<span class="right"> 
									<select name="date" class="date">
										<option value=""><?php _e( 'Please choose', RT_LANGUAGE ) ?></option>
									</select>
								</span>
							</li><!-- end Date  -->
						</ul>
					</div> <!-- end Course Information -->

					<div class="student-information">
						<div class="box-science">
							<h3> <?php _e( 'Thông tin học viên', RT_LANGUAGE ) ?> </h3>
							<ul> 
								<li> 
									<span class="left">	<?php _e( 'Quý danh: ', RT_LANGUAGE ) ?> </span>
									<span class="right"> 
										<select name="sex[]" required>
											<option value="Mr">Mr</option>
											<option value="Ms">Ms</option>
										</select>
									</span>
								</li><!-- end name  -->
								<li> 
									<span class="left">	<?php _e( 'Họ và tên: ', RT_LANGUAGE ) ?> </span>
									<span class="right"> 
										 <input name="fullname[]" class="fullname" placeholder="<?php _e( 'First and last name: ', RT_LANGUAGE ) ?>" value="" required />
									</span>
								</li><!-- end First and last name  -->
								<li> 
									<span class="left">	<?php _e( 'Điện thoại: ', RT_LANGUAGE ) ?> </span>
									<span class="right"> 
										 <input name="phone[]" class="phone" placeholder="<?php _e( 'Phone: ', RT_LANGUAGE ) ?>"  required />
									</span>
								</li><!-- end Phone  -->
								<li> 
									<span class="left">	<?php _e( 'Email: ', RT_LANGUAGE ) ?> </span>
									<span class="right"> 
										 <input name="email[]" class="email" placeholder="<?php _e( 'Email: ', RT_LANGUAGE ) ?>"  required />
									</span>
								</li><!-- end email  -->
								<li> 
									<span class="left">	<?php _e( 'Công ty: ', RT_LANGUAGE ) ?> </span>
									<span class="right"> 
										 <input name="company[]" class="company" placeholder="<?php _e( 'Company: ', RT_LANGUAGE ) ?>"  required />
									</span>
								</li><!-- end Company  -->
								<li> 
									<span class="left">	<?php _e( 'Chức vụ: ', RT_LANGUAGE ) ?> </span>
									<span class="right"> 
										 <input name="position[]" class="position" placeholder="<?php _e( 'Position: ', RT_LANGUAGE ) ?>"  required />
									</span>
								</li><!-- end Position  -->
								<li> 
									<span class="left">	<?php _e( 'Lĩnh vực: ', RT_LANGUAGE ) ?> </span>
									<span class="right"> 
										<select name="fields[]" required>
											<option value=""><?php _e( 'Please choose', RT_LANGUAGE ) ?></option>
											<?php 
												if ( count( $fields ) > 0 ) {
													foreach ( $fields as $key => $value ) {
														echo '<option value="'. $value['field_name'] .'">'. $value['field_name'] .'</option>';
													}
												}	
											?>		
										</select>
									</span>
								</li><!-- end Specialize  -->
							</ul>
						</div>
					</div> <!-- end Student information -->

					<div class="box-science more-information">
						<h3> <?php _e( 'Thông tin thêm', RT_LANGUAGE ) ?> </h3>
						<ul>
							<li> 
								<span class="left">	<?php _e( 'Bạn biết đến khóa học qua nguồn nào?: ', RT_LANGUAGE ) ?> </span>
								<span class="right"> 
									<select name="where_source_course" class="where_source_course" required>
										<option value=""><?php _e( 'Please choose', RT_LANGUAGE ) ?></option>
										<?php 
											if ( count( $where_source_course ) > 0 ) {
												foreach ( $where_source_course as $key => $value ) {
													echo '<option value="'. $value['source_name'] .'">'. $value['source_name'] .'</option>';
												}
											}	
										?>				
									</select>
								</span>
							</li><!-- end You know what courses through sources  -->
							<li> 
								<span class="left">	<?php _e( 'Loại hình thanh toán: ', RT_LANGUAGE ) ?> </span>
								<span class="right"> 
									<select name="payment_type" class="payment_type" required>
										<option value=""><?php _e( 'Please choose', RT_LANGUAGE ) ?></option>
										<?php 
											if ( count( $payment_type ) > 0 ) {
												foreach ( $payment_type as $key => $value ) {
													echo '<option value="'. $value['payment_name'] .'">'. $value['payment_name'] .'</option>';
												}
											}	
										?>			
									</select>
								</span>
							</li><!-- end You know what courses through sources  -->
						</ul>
					</div> <!-- end More information -->

					<div class="button-register"> 
						<a id="register_user_addmore" class="button navy small" href="#"><?php _e( 'Thêm người đăng ký', RT_LANGUAGE ) ?></a>
						<input class="button small" type="submit" name="submit" value="<?php _e( 'Đăng Ký', RT_LANGUAGE ) ?>" />
					</div>

				</form>
			<?php endif;?>
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
