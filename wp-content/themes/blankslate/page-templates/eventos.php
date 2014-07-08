<?php 
/**
 * Template Name: Eventos
 *
 * @package WordPress
 * @subpackage Gomez Morin
 * @since WP 3.0
 */
get_header(); ?>


<?php  ?>

<div id="main-content" class="main-content">

	<div id="primary" class="content-area">
		<div id="content" class="site-content" role="main">
			<?php 
			$parent_perm = basename(get_permalink($post->post_parent));
			$perm = basename(get_permalink());
			if(strcmp($parent_perm, $perm)!=0) $parent_perm2 = $parent_perm."-".$perm;
			//parent_perm: para los que no son de actividades
			//parent_perm2: para los que son de actividades
			if((strcmp($parent_perm, 'adultos')==0)||strcmp($parent_perm, 'ninos')==0) $perm = $parent_perm2;
			else $perm = $parent_perm;
			$args = array (
					'post_type' => 'eventos_ceceq',
					'categorias_ceceq' => $perm
				);
			query_posts( $args );
			?>
			<?php
				// Start the Loop.
			while ( have_posts() ) : the_post();
				//the_post_thumbnail();
			$url = wp_get_attachment_url( get_post_thumbnail_id($post->ID) );
			echo "<a href='$url' target='_blank'>";
			the_post_thumbnail( 'medium' );
			echo "</a>";
			$custom = get_post_custom($post->ID);
			$descripcion = $custom["eventos_ceceq_descripcion"][0];
			echo "<p>$descripcion</p>";
			endwhile;
			?>

		</div><!-- #content -->
	</div><!-- #primary -->
</div><!-- #main-content -->

<?php
get_sidebar();
get_footer();
