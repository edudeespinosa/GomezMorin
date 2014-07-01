<?php 
/**
 * Template Name: Eventos
 *
 * @package WordPress
 * @subpackage Gomez Morin
 * @since WP 3.0
 */
get_header(); ?>


<?php query_posts( 'post_type=tf_events'); ?>

<div id="main-content" class="main-content">

	<div id="primary" class="content-area">
		<div id="content" class="site-content" role="main">
			<?php
				// Start the Loop.
				while ( have_posts() ) : the_post();
				the_post_thumbnail();

				endwhile;
			?>
		</div><!-- #content -->
	</div><!-- #primary -->
</div><!-- #main-content -->

<?php
get_sidebar();
get_footer();
