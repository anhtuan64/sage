<?php get_header(); ?>
	<div id="content" <?php Avada()->layout->add_style( 'content_style' ); ?>>
		<?php while( have_posts() ): the_post(); ?>
		<div id="post-<?php the_ID(); ?>" <?php post_class('post'); ?>>

			<div class="cate-caurse">
			<?php
				$course_terms = get_the_terms( get_the_ID(), 'k-course-category' );
				$arr_course_id = array();
				if ( count( $course_terms ) > 0 ) {
					foreach ( $course_terms as $key => $obj ) {
						$arr_course_id[] = $obj->term_id;
					}
				}
				// var_dump($course_terms );
				$terms = get_terms( 'k-course-category', 'hide_empty=0' );
				if ( ! empty( $terms ) && ! is_wp_error( $terms ) ) :
					echo '<ul class="cate-ul">';
					foreach ( $terms as $term ) : 
						$bgcate = get_field( 'images', 'k-course-category_'.$term->term_id );
						$class = '';
						if ( in_array( $term->term_id, $arr_course_id ) ) {
							$class = 'active';
						}
			?>
				<li class="<?php echo $class;?>">
					<span class="img-cate">
						<?php if($bgcate) { ?>
							<img src="<?php echo $bgcate['url']; ?>" alt="" /> 
						<?php } ?>
					</span>
					<span class="title-cate" title="<?php echo $term->name; ?> ">
						<?php echo $term->name; ?>
					</span> 
					<div class="arrow-up"></div>
				</li>
			<?php
					endforeach;
					echo '</ul>'; // end cate ul 
				endif;
			?>
			</div>

			<div class="post-inner">
				<div class="post-meta">
					<?php
					// List Meta of course
					$arr_course_meta 		= array( 
						'adress'				=> '', 
						'opening' 				=> '',
						'class'					=> '',
						'time'					=> '', 
						'duration'				=> '', 
						'tuition'				=> '', 
						'teacher'				=> '', 
						'gallery'				=> '', 
						// Course Content
						'course_content'		=> '', 
						'course_benefits'		=> '',
						'who_course'			=> '', 
						'brochure'				=> '',
					);

					foreach ( $arr_course_meta as $meta => $val ) {
						if ( function_exists( 'get_field' ) ) {
							if ( get_field( $meta, get_the_ID() ) ) {
								$arr_course_meta_val[$meta] = get_field( $meta, get_the_ID() );
							}
						}
					}
					extract( shortcode_atts( $arr_course_meta, $arr_course_meta_val ) );
					?>
					<div class="course-meta">
						<?php 
							// Adress
							if ( is_array( $adress ) && count( $adress ) ) {
								echo '<p><label>'. __( 'Adress: ', RT_LANGUAGE ) .'</label><select class="">';
								foreach ( $adress as $key => $value ) {
									echo '<option value="'. $value['name'] .'">'. $value['name'] .'</option>';
								}
								echo '</select></p>';
							}
							// Opening
							if ( is_array( $opening ) && count( $opening ) ) {
								echo '<p><label>'. __( 'Opening: ', RT_LANGUAGE ) .'</label><select class="">';
								foreach ( $opening as $key => $value ) {
									echo '<option value="'. $value['date'] .'">'. $value['date'] .'</option>';
								}
								echo '</select></p>';
							}
							// Class
							if ( ! empty( $class ) ) {
								echo '<p><label>'. __( 'Class: ', RT_LANGUAGE ) .'</label><span class="">'. $class .'</span></p>';
							}
							// Duration
							if ( ! empty( $duration ) ) {
								echo '<p><label>'. __( 'Duration: ', RT_LANGUAGE ) .'</label><span class="">'. $duration .'</span></p>';
							}
							// Tuition
							if ( ! empty( $tuition ) ) {
								echo '<p><label>'. __( 'Tuition: ', RT_LANGUAGE ) .'</label><span class="">'. $tuition .'</span></p>';
							}

						// var_dump($adress);?>
					</div>
					<div>
					<?php 
						global $smof_data;

						$register_page_link = $smof_data['theme_setup_register_page_link'];
						if ( ! empty( $register_page_link ) ) :
							$new_register_link = str_replace( '?', '', $register_page_link );
							if ( $new_register_link != $register_page_link ) {
								$register_page_link .= '&course_id=' . get_the_ID();
							} else {
								$register_page_link .= '?course_id=' . get_the_ID();
							}
					?>
						<a href="<?php echo $register_page_link;?>" class="course-register"><?php _e( 'Course Register', RT_LANGUAGE )?></a>
					<?php endif;?>
					</div>
				</div>
				<div class="post-content">
					<?php the_content(); ?>
				</div>
			</div>
			<div class="course-content">
				<?php
					// Trainer
					$trainer = '';
					if ( $teacher ) {
						$trainer .= '<div class="course-teacher">';
						$trainer .= '<div class="course-teacher-thumb">';
						if ( has_post_thumbnail( $teacher->ID ) ) {
							$trainer .= '<a href="'. get_permalink( $teacher->ID ) .'" title="'. $teacher->post_title .'">'. get_the_post_thumbnail( $teacher->ID, 'rt_thumb300x300' ) .'</a>';
						}
						$trainer .= '<p class="course-teacher-title"><a href="'. get_permalink( $teacher->ID ) .'" title="'. $teacher->post_title .'">'. $teacher->post_title .'</a></p>';
						if ( get_field( 'organize', $teacher->ID ) ) {
							$trainer .= get_field( 'organize', $teacher->ID );
						}
						$trainer .= '</div>';
						$trainer .= '<div class="course-teacher-excerpt">';
						$trainer .= apply_filters( 'the_content', $teacher->post_excerpt );
						$trainer .= '</div>';
						$trainer .= '</div>';
					}
					// var_dump($brochure);
					$shortcodes = '[fusion_tabs design="clean" layout="horizontal" justified="yes" backgroundcolor="" inactivecolor="" bordercolor="" class="" id=""]
					[fusion_tab title="'. __( 'Course Content', RT_LANGUAGE ) .'" icon=""]'. $course_content .'[/fusion_tab]
					[fusion_tab title="'. __( 'Benefits of Participation', RT_LANGUAGE ) .'" icon=""]'. $course_benefits .'[/fusion_tab]
					[fusion_tab title="'. __( 'Who should attend', RT_LANGUAGE ) .'" icon=""]'. $who_course .'[/fusion_tab]
					[fusion_tab title="'. __( 'Trainer', RT_LANGUAGE ) .'" icon=""]'. $trainer .'[/fusion_tab]
					[fusion_tab title="'. __( 'Brochure', RT_LANGUAGE ) .'" icon=""]'. '<embed src="'. $brochure .'" width="100%" height="500"></embed>' .'[/fusion_tab]
					[/fusion_tabs]';
					echo do_shortcode( $shortcodes );
				?>
			</div>
		</div>
		<?php endwhile; ?>
		<?php wp_reset_query(); ?>
	</div>
	<?php do_action( 'fusion_after_content' ); ?>
<?php get_footer();

// Omit closing PHP tag to avoid "Headers already sent" issues.
