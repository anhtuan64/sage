<?php
	$current_cat_id = get_query_var('cat');
	get_header(); 
?>
	<div id="content" <?php Avada()->layout->add_class( 'content_class' ); ?> <?php Avada()->layout->add_style( 'content_style' ); ?>>
		<h1 class="page-heading"><?php echo rt_replace_color_title_in_archive( get_cat_name( $current_cat_id ) );?></h1>
		<?php if( category_description() ): ?>
		<div id="post-<?php the_ID(); ?>" <?php post_class( 'fusion-archive-description' ); ?>>
			<div class="post-content">
				<?php echo category_description(); ?>
			</div>
		</div>
		<?php endif; ?>

		<?php get_template_part( 'templates/blog', 'layout' ); ?>
	</div>
	<?php do_action( 'fusion_after_content' ); ?>
<?php get_footer();

// Omit closing PHP tag to avoid "Headers already sent" issues.
