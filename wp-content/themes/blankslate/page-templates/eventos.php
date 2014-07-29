<?php 
/**
 * Template Name: Eventos
 *
 * @package WordPress
 * @subpackage Gomez Morin
 * @since WP 3.0
 */
get_header(); ?>


<?php blankslate_load_scripts(); ?>

<div id="main-content" class="main-content">
	<style>.right{float:right; padding:10px; background:white;} li{margin-bottom: 10px;}</style>
	<div id="primary" class="content-area">
		<div id="content" class="site-content" role="main">
			<div class="eventos">
				<div class="calendario-eventos">
					<?php 					$parent_perm = basename(get_permalink($post->post_parent));
					$perm = basename(get_permalink());
					if(strcmp($parent_perm, $perm)!=0) $parent_perm2 = $parent_perm."-".$perm;
				//parent_perm: para los que no son de actividades
				//parent_perm2: para los que son de actividades
					if((strcmp($parent_perm, 'adultos')==0)||strcmp($parent_perm, 'ninos')==0) $perm = $parent_perm2;
					else $perm = $parent_perm;?>
					<form id="ajax-form" method="post" action="">
						<input type="text" hidden=true value='<?php echo $perm ?>' id="perm"/>
						<input type="text" id="calendar" hidden=true name="calendar"/>
						<div class="calendario"></div>
						<input type="submit" name="buscar" value="buscar"/>
					</form>
				</div>
				<div class="contenedor-eventos">
					<ul class="list-unstyled" id="posts_container">
					</ul>
				</div>
			</div>
			<div class="abajo-eventos">
				<section>
					<?php echo get_social_media() ?>
				</section>	
			</div>		
		</div><!-- #content -->
	</div><!-- #primary -->
</div><!-- #main-content -->

<?php
get_sidebar();
get_footer();
