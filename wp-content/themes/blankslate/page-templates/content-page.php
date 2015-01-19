<?php 
/**
 * Template Name: Página con contenido estático
 *
 * @package WordPress
 * @subpackage Gomez Morin
 * @since WP 3.0
 */
get_header(); ?>



<div id="main-content" class="main-content">

	<div id="primary" class="content-area">
		<div id="content" class="content-page-content" role="main">
			<?php while ( have_posts() ) : the_post(); ?>
				<?php the_content() ?>
			<?php endwhile; // end of the loop. ?>
		</div><!-- #content -->
			<?php echo get_social_media(); ?>
	</div><!-- #primary -->
</div><!-- #main-content -->

<?php
get_sidebar();
get_footer();
