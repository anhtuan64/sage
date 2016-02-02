<?php get_header(); ?>
	<div id="content" <?php Avada()->layout->add_style( 'content_style' ); ?>>
		<?php while( have_posts() ): the_post(); ?>
		<div id="post-<?php the_ID(); ?>" <?php post_class('post'); ?>>
			
			<h1 class="page-heading"><?php echo rt_replace_color_title_in_archive( get_the_title() );?></h1>

			<div class="cate-caurse">
			<?php
				$terms = get_terms( 'k-course-category', 'orderby=count&hide_empty=0' );
				if ( ! empty( $terms ) && ! is_wp_error( $terms ) ) :
					echo '<ul class="cate-ul">';
					foreach ( $terms as $term ) :
						$bgcate = get_field( 'images', 'k-course-category_'.$term->term_id );
					
			?>
				<li> 
					<span class="img-cate">
						<?php if($bgcate) { ?>
						<img src="<?php echo $bgcate['url']; ?>" />
						<?php } ?> 
					</span>
					<a class="title-cate" href="<?php echo get_term_link( $term->term_id, 'k-course-category'); ?>" title="<?php echo $term->name; ?> ">
						<?php echo $term->name; ?>
					</a> 
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
							if ( get_field( $meta, $id ) ) {
								$arr_course_meta_val[$meta] = get_field( $meta, $id );
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
						<a href="" class="course-register"><?php _e( 'Course Register', RT_LANGUAGE )?></a>
					</div>
				</div>
				<div class="post-content">
					<?php the_content(); ?>
				</div>
			</div>
			<div class="course-content">
				<?php
					$shortcodes = '[fusion_tabs design="clean" layout="horizontal" justified="yes" backgroundcolor="" inactivecolor="" bordercolor="" class="" id=""]
					[fusion_tab title="'. __( 'Course Content', RT_LANGUAGE ) .'" icon=""]'. $course_content .'[/fusion_tab]
					[fusion_tab title="'. __( 'Benefits of Participation', RT_LANGUAGE ) .'" icon=""]'. $course_benefits .'[/fusion_tab]
					[fusion_tab title="'. __( 'Who should attend', RT_LANGUAGE ) .'" icon=""]'. $who_course .'[/fusion_tab]
					[fusion_tab title="'. __( 'Trainer', RT_LANGUAGE ) .'" icon=""]'. $course_content .'[/fusion_tab]
					[fusion_tab title="'. __( 'Brochure', RT_LANGUAGE ) .'" icon=""][/fusion_tab]
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
