<?php get_header(); ?>
	<div id="content" <?php Avada()->layout->add_style( 'content_style' ); ?>>
		<?php if( ( ! Avada()->settings->get( 'blog_pn_nav' ) && get_post_meta($post->ID, 'pyre_post_pagination', true) != 'no' ) ||
				  ( Avada()->settings->get( 'blog_pn_nav' ) && get_post_meta($post->ID, 'pyre_post_pagination', true) == 'yes' ) ): ?>
		<div class="single-navigation clearfix">
			<?php previous_post_link('%link', __('Previous', 'Avada')); ?>
			<?php next_post_link('%link', __('Next', 'Avada')); ?>
		</div>
		<?php endif; ?>
		<?php while( have_posts() ): the_post(); ?>
		<div id="post-<?php the_ID(); ?>" <?php post_class('post'); ?>>
			
			<div class="post-content">
				<?php the_content(); ?>
				<?php avada_link_pages(); ?>
			</div>
			<?php if( ! post_password_required($post->ID) ): ?>
			<?php echo avada_render_post_metadata( 'single' ); ?>
			<?php avada_render_social_sharing(); ?>
			<?php if( ( Avada()->settings->get( 'author_info' ) && get_post_meta($post->ID, 'pyre_author_info', true) != 'no' ) ||
					  ( ! Avada()->settings->get( 'author_info' ) && get_post_meta($post->ID, 'pyre_author_info', true) == 'yes' ) ): ?>
			<div class="about-author">
				<?php
					ob_start();
					the_author_posts_link();
					$title = sprintf( '%s %s', __( 'About the Author:', 'Avada' ), ob_get_clean() );
					echo Avada()->template->title_template( $title, '3' );
				?>
				<div class="about-author-container">
					<div class="avatar">
						<?php echo get_avatar(get_the_author_meta('email'), '72'); ?>
					</div>
					<div class="description">
						<?php the_author_meta("description"); ?>
					</div>
				</div>
			</div>
			<?php endif; ?>

			<?php
			// Render Related Posts
			echo avada_render_related_posts();
			?>

			<?php if( ( Avada()->settings->get( 'blog_comments' ) && get_post_meta($post->ID, 'pyre_post_comments', true ) != 'no' ) ||
					  ( ! Avada()->settings->get( 'blog_comments' ) && get_post_meta($post->ID, 'pyre_post_comments', true) == 'yes' ) ): ?>
				<?php
				wp_reset_query();
				comments_template();
				?>
			<?php endif; ?>
			<?php endif; ?>
		</div>
		<?php endwhile; ?>
		<?php wp_reset_query(); ?>
	</div>
	<?php do_action( 'fusion_after_content' ); ?>
<?php get_footer();

// Omit closing PHP tag to avoid "Headers already sent" issues.
