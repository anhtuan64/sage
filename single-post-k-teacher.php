<?php get_header(); ?>
	<div id="content" <?php Avada()->layout->add_style( 'content_style' ); ?>>
		<?php while( have_posts() ): the_post(); ?>
		<div id="post-<?php the_ID(); ?>" <?php post_class('post'); ?>>
			<div class="post-meta">
				<?php if(has_post_thumbnail()) the_post_thumbnail("medium",array("alt" => get_the_title()));
	            else echo $no_thum; ?>
				<p class="title-name"> <?php the_title(); ?> </p>
				<?php 
					$manifesto = get_field('manifesto');
					if (!empty($manifesto)) :
				 ?>
				<p class="excerpt-meta"><?php echo $manifesto; ?> </p>
				<?php endif; ?>
			</div>
			<div class="post-inner">
				<p class="title-name"> <?php the_title(); ?> </p>
				<div class="post-content">
					<?php the_content(); ?>
				</div>
				<div class="realate-post"> 
				<?php 
					$relate = get_field('courses'); 
					$name = "KHÓA HỌC ĐANG GIẢNG DẠY";
				 
					if( is_array( $relate ) && count( $relate ) > 0 ) {
						echo '<p class="entry-title">'. rt_replace_color_title_in_archive($name) .'</p>';
						for ( $i = 0; $i < count( $relate ); $i++ ) { 
							$url 		= wp_get_attachment_image_src( get_post_thumbnail_id($relate[$i]['course_of_teacher']->ID,'medium') );
							$link 		= get_post_permalink( $relate[$i]['course_of_teacher']->ID );
							$title 		= $relate[$i]['course_of_teacher']->post_title;
							$excerpt 	= $relate[$i]['course_of_teacher']->post_excerpt;
							if ( ( $i % 2 == 0 ) ) {
								echo "<div class='box-relate'>";
							}
				?>
					<div class="list-relate">
						<a class="img" href="<?php echo $link; ?>">
							<img src="<?php echo $url[0]; ?>" alt="" />
						</a>
						<a class="title-relate" href="<?php echo $link; ?>" title="<?php echo $title;?>">
							<?php echo $title;?> 
						</a>
						<div class="excerpt"> 
							<?php echo substr($excerpt, 0,80); ?>
							<a class="read-more" href="<?php echo $link; ?>" title="<?php echo $title;?>"><?php echo __( '... Readmore ', RT_LANGUAGE ) ?></a>
						</div>
					</div>
				<?php
							if ( ( $i % 2 != 0 ) || ( $i == count( $relate ) - 1 ) ) {
								echo "</div>";
							}
						} // end for
					} // end if
				?>
				</div> <!-- end post relate post -->
			</div> <!-- end post inner -->
		</div> <!-- end post id -->
		<?php endwhile; ?>
		<?php wp_reset_query(); ?>
	</div>
	<?php do_action( 'fusion_after_content' ); ?>
<?php get_footer();

// Omit closing PHP tag to avoid "Headers already sent" issues.
