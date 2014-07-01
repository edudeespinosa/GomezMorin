<?php 
/**
 * Template Name: Página con submenus
 *
 * @package WordPress
 * @subpackage Gomez Morin
 * @since WP 3.0
 */
get_header(); ?>

<div id="main-content" class="main-content">
	<div id="primary" class="content-area">
		<div id="content" class="site-content" role="main">
			<div id="banner-slide">
				<?php 
				$args = array(
					'post_type'      => 'page',
					//'post_type'      => 'tf_events',
					'posts_per_page' => -1,
					'post_parent'    => $post->ID,
					//'post_parent'    => $post->ID,
					'order'          => 'ASC',
					'orderby'        => 'menu_order'
					);
				$parent = new WP_Query( $args );
				$children = get_pages('child_of='.$post->ID);
				if ( $parent->have_posts() ) : ?>
				<ul class="bjqs">
					<?php while ( $parent->have_posts() ) : $parent->the_post();?>
						<li>
							<a href="<?php the_permalink(); ?>">
								<img src="<?php print wp_get_attachment_url( get_post_thumbnail_id(get_the_ID()) ); ?>" height="320" width="620" title="<?php print the_title(); ?>">
							</a>
						</li>
					<?php endwhile; ?>
				</ul>
			<?php endif; ?>
		</div>
		<script class="secret-source">
			jQuery(document).ready(function($) {

				jQuery('#banner-slide').bjqs({
					animtype      : 'slide',
					height        : 320,
					width         : 620,
					responsive    : true,
					randomstart   : true
				});

			});
		</script>

		<div class="subsecciones">
			<?php 
			$args = array(
				'post_type'      => 'page',
				'posts_per_page' => -1,
				'post_parent'    => $post->ID,
				'order'          => 'ASC',
				'orderby'        => 'menu_order'
				);
			$contador = count($children);
			$i = 0;
			$left = "left";
			$right = "right";?>
			<?php if ( $parent->have_posts() ) : ?>
				<?php if( $contador %2 == 0 ) :?>
					<ul class="even-children">
					<?php else : ?>
						<ul class="even-children inline">
						<?php endif; ?>
						<?php while ( $parent->have_posts() ) : $parent->the_post();
						$title = current(explode(' ', get_the_title()));
						?>
						<li id="<?php the_ID(); ?>" class="<?php if($i%2==0){ print $left;} else print $right; $i++;?> children">
							<a href="<?php the_permalink(); ?>">
								<div id="<?php print the_ID();?>" style="background: url('<?php print wp_get_attachment_url( get_post_thumbnail_id(get_the_ID()) ); ?>') no-repeat; background-size: cover;">
								</div>
							</a>
						</li>
					<?php endwhile; ?>
				</ul>
			<?php endif; wp_reset_query(); ?>
		</div>
	</div>		
</div>
</div>


<?php
get_sidebar();
get_footer();
