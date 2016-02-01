<?php 
/**
 * Template Name: List Course Template
 *
 * @package RT
 * @subpackage Sage
 * @since 1.0
 */

get_header(); ?>
<?php 
	$title1 = get_field('title1');
	$title2 = get_field('title2');
?>
<div class="title-page"> 
	<?php echo $title1; ?>
	<span> <?php echo $title2; ?> </span>
</div>
<div class="cate-caurse">
  		<?php
			$categories = get_terms( 'k-course-category', 'orderby=count&hide_empty=0' );
  			if ( ! empty( $categories ) && ! is_wp_error( $categories ) ){
			    echo '<ul class="cate-ul">';
			    foreach ( $categories as $term ) {
			    $bgcate = get_field( 'images', 'k-course-category_'.$term->term_id )
				
		?>
		      		<li> 
		      			<a class="img-cate" href="<?php echo get_term_link( $term->term_id, 'k-course-category'); ?>" title="<?php echo $term->name; ?> ">
		      				<img src="<?php echo $bgcate['url']; ?>" /> 
		      			</a>
		      			<a class="title-cate" href="<?php echo get_term_link( $term->term_id, 'k-course-category'); ?>" title="<?php echo $term->name; ?> ">
		      				<?php echo $term->name; ?>
		      			</a> 
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
						        <?php if(has_post_thumbnail()) the_post_thumbnail("medium",array("alt" => get_the_title()));
						            else echo $no_thum; ?>
						        </a>
						        <a class="title-post" href="<?php the_permalink();?>" title="<?php the_title();?>"><?php echo the_title();?></a>
						        <?php 
						        	//print_r( get_the_content(50,'') ); 
						        ?>
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
</div>
<?php get_footer();