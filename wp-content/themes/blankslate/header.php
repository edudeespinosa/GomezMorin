<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>" />
	<meta name="viewport" content="width=device-width" />
	<title><?php wp_title( ' | ', true, 'right' ); ?></title>
	<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="<?php echo get_stylesheet_uri(); ?>" />
	<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css">
	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
	<header id="header" role="banner">
		<section id="branding">
			<a href='<?php echo home_url();?>'><div id="logo"></div></a>
			<div id="site-title"><?php if ( ! is_singular() ) { echo '<h1>'; } ?><a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php esc_attr_e( get_bloginfo( 'name' ), 'blankslate' ); ?>" rel="home"><?php echo esc_html( get_bloginfo( 'name' ) ); ?></a><?php if ( ! is_singular() ) { echo '</h1>'; } ?></div>
			<div id="site-description"><?php bloginfo( 'description' ); ?></div>
		</section>
		<section id="search-destroy">
			<div class="social inline">
				<ul >
					<a href="#"><li id="youtube"></li></a>
					<a href="#"><li id="facebook"></li></a>
					<a href="#"><li id="twitter"></li></a>
				</ul>
			</div>
			<div id="search">
				<?php get_search_form(); ?>
			</div>
			<div id="suscription">
				<?php get_suscription_form(); ?>
			</div>
		</section>
		<nav id="menu" role="navigation">
			<?php wp_nav_menu( array( 'theme_location' => 'main-menu' ) ); ?>
		</nav>
	</header>
	<div id="backgrounds"></div>
	<script>(function(d, s, id) {//facebook timeline
		var js, fjs = d.getElementsByTagName(s)[0];
		if (d.getElementById(id)) return;
		js = d.createElement(s); js.id = id;
		js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.0";
		fjs.parentNode.insertBefore(js, fjs);
	}(document, 'script', 'facebook-jssdk'));</script>

	<script>
		document.getElementsByName('s')[0].placeholder='Buscar';
		jQuery(document).ready(function(){
			var header = jQuery('body');

			var backgrounds = new Array(
				'url('+window.location.origin+'/gomezMorin/images/backgrounds/fondo1.JPG)'
				, 'url('+window.location.origin+'/gomezMorin/images/backgrounds/fondo2.JPG)'
				, 'url('+window.location.origin+'/gomezMorin/images/backgrounds/fondo3.JPG)'
				, 'url('+window.location.origin+'/gomezMorin/images/backgrounds/fondo4.JPG)'
				, 'url('+window.location.origin+'/gomezMorin/images/backgrounds/fondo5.JPG)'
				, 'url('+window.location.origin+'/gomezMorin/images/backgrounds/fondo6.JPG)'
				, 'url('+window.location.origin+'/gomezMorin/images/backgrounds/fondo7.JPG)'
				, 'url('+window.location.origin+'/gomezMorin/images/backgrounds/fondo8.JPG)'
				, 'url('+window.location.origin+'/gomezMorin/images/backgrounds/fondo9.JPG)'
				);

			var current = 0;

			function nextBackground() {
				current++;
				current = current % backgrounds.length;
				jQuery('#backgrounds').css('background-image', backgrounds[current]);
			}
			setInterval(nextBackground, 10000);

			jQuery('#backgrounds').css('background-image', backgrounds[0]);
		});
</script>
<script>
	jQuery(window).scroll(function(){
		if(jQuery(document).scrollTop() > jQuery('#header').height()) {
			// put content here for if the page has scrolled 200 pixels
			jQuery('#header').addClass('minimized');
			jQuery('#logo').addClass('minimized');
			jQuery('#branding').addClass('minimized');
			jQuery('#menu').addClass('minimized');
			jQuery('#search-destroy').addClass('minimized');
			jQuery('#wrapper').css({
				"margin-top": jQuery('#header').height()
			});
		}
		else{
			jQuery('#header').removeClass('minimized');
			jQuery('#logo').removeClass('minimized');
			jQuery('#branding').removeClass('minimized');
			jQuery('#menu').removeClass('minimized');
			jQuery('#search-destroy').removeClass('minimized');
			jQuery('#wrapper').css({
				"margin-top": "0"
			});
		}
	});
</script>
<div id="wrapper" class="hfeed">
	<?php
	$children = get_pages('child_of='.$post->ID);
	if( count( $children ) != 0 ) { 
		print '<div class="titulo-seccion" id='.strtolower(get_the_title()).'>'.get_the_title().'</div>';
	}
	else
		print '<div class="titulo-seccion" id="none">'.get_the_title().'</div>'
	?>


	<div id="container">
