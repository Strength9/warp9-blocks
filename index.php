<?php 
get_header();
do_action('warp9_after_body');
?>
<main>
<?php if ( have_posts() ) :  ?>

				<?php while ( have_posts() ) : the_post(); ?>

					
							<?php the_content(); ?>
							
						

				<?php endwhile;  ?>
				
			<?php endif;  ?>
			</main>
<?php get_footer();  ?>