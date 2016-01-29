<?php
	$current_cat_id = get_query_var('cat');
	get_header(); 
	$url = get_stylesheet_directory_uri();
?>
	<div id="content" <?php Avada()->layout->add_class( 'content_class' ); ?> <?php Avada()->layout->add_style( 'content_style' ); ?>>
		
		<h1 class="page-heading"><?php echo rt_replace_color_title_in_archive( get_cat_name( $current_cat_id ) );?></h1>

		<?php 
		//load js
		wp_enqueue_script( 'isotope-pkgd' );
		wp_enqueue_script( 'packery-layout' );
		?>
		<div class="isotope-layout" id="isotope-posts-<?php echo $current_cat_id;?>">
		<?php
			$args = array(
				'cat' => $current_cat_id,
			);
			$q = new WP_Query($args);
            if($q->have_posts()):
                while($q->have_posts()):
                    $q->the_post();
                
                ?>
				<article id="post-<?php echo get_the_ID();?>" class="isotope-element isotope-element-width2 <?php echo implode( ' ', get_post_class() ); ?>">
            		<div class="post-inner">
            			<?php if(has_post_thumbnail()) : ?>
                			<div class="entry-thumb">
	                			<a href="<?php the_permalink();?>" title="<?php the_title();?>">
						        	<?php the_post_thumbnail("rt_thumb500x999",array("alt" => get_the_title())) ;?>
						        </a>
						    </div>
						<?php endif;?>
						<h3 class="entry-title">
							<a href="<?php echo get_the_permalink();?>" title="<?php the_title();?>">
								<?php the_title( );?>
							</a>
						</h3>
						<div class="entry-content">
						    <?php //the_excerpt(30);?>
						</div>
            		</div>
                </article>				

               	<?php

            endwhile;
            if(function_exists('wp_pagenavi')) {wp_pagenavi();}
            wp_reset_postdata();
        endif;
		?>
		</div>
	</div>
	<?php do_action( 'fusion_after_content' ); ?>
<?php get_footer();

// Omit closing PHP tag to avoid "Headers already sent" issues.
