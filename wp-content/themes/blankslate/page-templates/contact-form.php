<?php
/**
 * Template Name: Forma de contacto
 *
 * @package WordPress
 * @subpackage Twenty_Fourteen
 * @since Twenty Fourteen 1.0
 */

get_header(); ?>

<div id="main-content" class="main-content">
	<div id="primary" class="content-area">
		<div id="content" class="site-content" role="main">
			<div class="contact-form">
				<?php
						// Include the page content template.
					get_template_part( 'content', 'page' );
					echo do_shortcode('[contact-form-7 id="474" title="Contacto principal"]');
				?>
			</div>
		</div><!-- #content -->
	</div><!-- #primary -->
</div><!-- #main-content -->

<?php
get_sidebar();
get_footer();
