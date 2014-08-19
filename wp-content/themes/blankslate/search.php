<?php get_header(); ?>
<div id="primary" class="content-area">

	<section id="content" role="main" class="content-page-content">
		<?php 
		$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
		$args1 = array(
			'post_type' => array('page', 'eventos_ceceq'),
			'posts_per_page' => 6,
			's' => $problem,
			'paged' => $paged
			);

		$args2 = array(
			'tax_query' => array(
				array(
					'taxonomy' => 'post_tag',
					'field' => 'slug',
					'terms' => $problem
					)
				),
			'post_type' => 'product',
			'posts_per_page' => 6,
			'paged' => $paged
			);

		$todosposts = get_posts( $args1 );
		$aeventosposts = get_posts( $args2 );

		$mergedposts = array_merge( $todosposts, $aeventosposts );
		?>
	<?php if ( have_posts() ) : ?>
		<header class="header">
			<h1 class="entry-title"><?php printf( __( 'Resultados para: %s', 'blankslate' ), get_search_query() ); ?></h1>
		</header>
		<?php while ( have_posts() ) : the_post(); ?>
			<?php get_template_part( 'entry' ); ?>
		<?php endwhile; ?>
		<?php get_template_part( 'nav', 'below' ); ?>
	<?php else : ?>
		<article id="post-0" class="post no-results not-found">
			<header class="header">
				<h2 class="entry-title"><?php _e( 'Nothing Found', 'blankslate' ); ?></h2>
			</header>
			<section class="entry-content">
				<p><?php _e( 'Sorry, nothing matched your search. Please try again.', 'blankslate' ); ?></p>
				<?php get_search_form(); ?>
			</section>
		</article>
	<?php endif; ?>
</section>
</div>
<?php get_sidebar(); ?>
<?php get_footer(); ?>