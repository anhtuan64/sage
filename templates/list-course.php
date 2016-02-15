<?php 
/**
 * Template Name: List Course Template
 *
 * @package RT
 * @subpackage Sage
 * @since 1.0
 */

get_header(); ?>
<div class="cate-caurse">
		<?php
			$terms = get_terms( 'k-course-category', 'hide_empty=0' );
			if ( ! empty( $terms ) && ! is_wp_error( $terms ) ){
				echo '<ul class="cate-ul">';
				foreach ( $terms as $term ) {
				$bgcate = get_field( 'images', 'k-course-category_'.$term->term_id );
				
		?>
					<li>
						<span class="img-cate">
							<?php if($bgcate) { ?>
								<img src="<?php echo $bgcate['url']; ?>" alt="" /> 
							<?php } ?>
						</span>
						
						<span class="title-cate" title="<?php echo $term->name; ?> ">
							<?php echo $term->name; ?>
						</span> 
						<div class="post-cate">
							<?php 
								 $args = array (
								'post_type'              => 'post-k-course',
								'posts_per_page'         => 2,
								'tax_query' => array(
									array(
										'taxonomy' => 'k-course-category',
										'field'    => 'id',
										'terms'    => $term->term_id,
									),
								),
								);
								$news_post = new WP_Query($args); 
								while($news_post -> have_posts()):
								$news_post -> the_post();
							?>
							<div class="post-list">
								<a class="img" href="<?php the_permalink();?>" title="<?php the_title();?>">
								<?php if(has_post_thumbnail()) the_post_thumbnail( "rt_thumb300x300", array( "alt" => get_the_title() ) );
									else echo $no_thum; ?>
								</a>
								<a class="title-post" href="<?php the_permalink();?>" title="<?php the_title();?>"><?php echo the_title();?></a>
								<div class="excerpt-content">
									<?php echo get_the_excerpt(); ?>
							   </div>
							   <a class="read-more" href="<?php the_permalink();?>" title="<?php the_title();?>"><?php echo __( 'Readmore', RT_LANGUAGE ) ?></a>
							</div>
							<?php
								endwhile; wp_reset_postdata(); 
							?>
						</div> <!-- end post cate -->
					</li>
		<?php
				}
				echo '</ul>'; // end cate ul 
			}
		?>
		<div class="box-new-relate"> 
			<?php 
				$x = 0;
				$id = "";
				foreach ($terms as $key) {
					$x++;
					if ( $x==3 ) {
						$id = $key->term_id;
					}
				}
				//echo $id;
				 $args2 = array (
					'post_type'              => 'post-k-course',
					'posts_per_page'         =>6,
					'offset' => 2,
					'tax_query' => array(
						array(
									'taxonomy' => 'k-course-category',
									'field'    => 'id',
									'terms'    => $id,
							),
					),
					);
				$news_post_relate = new WP_Query($args2); 
				while($news_post_relate -> have_posts()):
				$news_post_relate -> the_post();
			?>
				<div class="list-relate"> 
					<a class="img" href="<?php the_permalink();?>" title="<?php the_title();?>">
					<?php if(has_post_thumbnail()) the_post_thumbnail("rt_thumb300x300",array("alt" => get_the_title()));
						else echo $no_thum; ?>
					</a>
					<a class="title-post" href="<?php the_permalink();?>" title="<?php the_title();?>"><?php echo the_title();?></a>
					<div class="excerpt-content">
						<?php echo get_the_excerpt(); ?>
					</div>
					<a class="read-more" href="<?php the_permalink();?>" title="<?php the_title();?>"><?php echo __( 'Readmore', RT_LANGUAGE ) ?></a>
				</div>
			<?php
				endwhile; wp_reset_postdata(); 
			?>
		</div>
</div>
<?php get_footer();