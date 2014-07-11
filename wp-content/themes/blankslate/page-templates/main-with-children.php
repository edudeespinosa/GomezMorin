<?php 
/**
 * Template Name: Página con submenus
 *
 * @package WordPress
 * @subpackage Gomez Morin
 * @since WP 3.0
 */
get_header(); 
?>
<?php 
	wp_enqueue_script( 'jquery' );
	wp_enqueue_script( 'custom_script', get_template_directory_uri() . '/plugin-slider/js/bjqs-1.3.js' );
?>
<div id="main-content" class="main-content">
	<div id="primary" class="content-area">
		<div id="content" class="site-content" role="main">
		<?php //echo do_shortcode( '[contact-form-7 id="468" title="Contact form 1"]' );?>
			<div id="banner-slide">
				<?php 
				$parent_perm = basename(get_permalink($post->post_parent));
				$perm = basename(get_permalink());
				if(strcmp($parent_perm, $perm)!=0) $perm = $parent_perm."-".$perm;
				if(!is_front_page())
					$args = array(
						'post_type' => 'eventos_ceceq',
						'posts_per_page' => 5,
						'tax_query' => array(
							'relation'=>'and',
							array('taxonomy' => 'categorias_ceceq',
								'field' => 'slug',
								'terms' => $perm),
							array('taxonomy' => 'categorias_ceceq',
								'field' => 'slug',
								'terms' => 'destacado')
							)
						);
				else
					$args = array('post_type' => 'eventos_ceceq',
						'categorias_ceceq' => 'destacado',
						'posts_per_page' => 5);
				$parent = new WP_Query( $args );
				$children = get_pages('child_of='.$post->ID);
				if ( $parent->have_posts() ) : ?>
				<ul class="bjqs">
					<?php while ( $parent->have_posts() ) : $parent->the_post();?>
						<li>
							<?php $url = wp_get_attachment_url( get_post_thumbnail_id($post->ID) ); ?>
							<a target="_blank" href="<?php /*the_permalink();*/ echo $url ?>">
								<img style="background: white" src="<?php print wp_get_attachment_url( get_post_thumbnail_id(get_the_ID()) ); ?>" height="480" width="840" title="<?php print the_title(); ?>">
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
					height        : 480,
					width         : 840,
					responsive    : true,
					randomstart   : true
				});

			});
		</script>

		<div class="subsecciones">
			<?php 
			wp_reset_query();
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
			$right = "right";
			$parent = new WP_Query( $args );
			?>
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
								<?php if ( has_post_thumbnail( ) ) { ?>
								<div id="<?php print the_ID();?>" style="background: url('<?php print wp_get_attachment_url( get_post_thumbnail_id(get_the_ID()) ); ?>') no-repeat; background-size: cover;">
								</div>
								<?php }else{ ?>
								<div id="<?php print the_ID();?>" style="background: white no-repeat; background-size: cover;">
									<?php the_title() ?>
								</div>
								<?php }?>
							</a>
						</li>
					<?php endwhile; ?>
				</ul>
			<?php endif; wp_reset_query(); ?>
		</div>
		<?php echo get_social_media(); ?>
	</div>		
</div>
</div>
<div id="fb-root"></div>

<?php
get_sidebar();
get_footer();
