<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>" />
	<meta name="viewport" content="width=device-width" />
	<title><?php wp_title( ' | ', true, 'right' ); ?></title>
	<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css">
	<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="<?php echo get_stylesheet_uri(); ?>" />
	<?php wp_head(); ?>
	<script type="text/javascript">
		jQuery(document).ready(function($){
			/* prepend menu icon */
			$('#title-area').append('<div id="mobile-menu"></div>');

			/* toggle nav */
			$("#mobile-menu").on("click", function(){
				$("#nav_menu-2").slideToggle();
				$(this).toggleClass("active");
			});
		});
	</script>

</head>
<body <?php body_class(); ?>>
	<div class="loader"></div>
	<script type="text/javascript">
		jQuery(window).load(function() {
			jQuery(".loader").fadeOut("slow");
		})
	</script>
	<script>
		jQuery(document).ready(function(){
			var imgNames = new Array(
				window.location.origin+'/gomezMorin/images/backgrounds/fondo1.JPG'
				, window.location.origin+'/gomezMorin/images/backgrounds/fondo2.JPG'
				, window.location.origin+'/gomezMorin/images/backgrounds/fondo3.JPG'
				, window.location.origin+'/gomezMorin/images/backgrounds/fondo4.JPG'
				, window.location.origin+'/gomezMorin/images/backgrounds/fondo5.JPG'
				, window.location.origin+'/gomezMorin/images/backgrounds/fondo6.JPG'
				, window.location.origin+'/gomezMorin/images/backgrounds/fondo7.JPG'
				, window.location.origin+'/gomezMorin/images/backgrounds/fondo8.JPG'
				, window.location.origin+'/gomezMorin/images/backgrounds/fondo9.JPG'
				);
			imgs = new Array();
			var divImg = jQuery("#backgrounds");
			var ulImg = jQuery("<ul class='back-images' />");
			i=1;
			jQuery.each(imgNames, function(i, val) {
				var liImg = jQuery("<li/>").attr("id", "bg-img"+i);
				jQuery("<img />").attr("src", val).appendTo(liImg);
				i++;
				liImg.appendTo(ulImg);
			});
			ulImg.appendTo(divImg);


			var images = jQuery('ul.back-images li');
			var current = 0;

			images.hide().first().show();
			function sliderResponse() {
				image = jQuery("#bg-img"+current);
				current++;
				current = current % imgNames.length;
				image2 = jQuery("#bg-img"+current);
				image.fadeOut(1000);
				image2.fadeIn(1000);
			}
			setInterval(sliderResponse, 5000);
		});

</script>
<header id="header" role="banner">
	<section id="branding">
		<a href='<?php echo home_url();?>'><div id="logo"></div></a>
		<div id="site-title"><?php if ( ! is_singular() ) { echo '<h1>'; } ?><a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php esc_attr_e( get_bloginfo( 'name' ), 'blankslate' ); ?>" rel="home"><?php echo esc_html( get_bloginfo( 'name' ) ); ?></a><?php if ( ! is_singular() ) { echo '</h1>'; } ?></div>
		<div id="site-description"><?php bloginfo( 'description' ); ?></div>
	</section>
	<div class="gobierno"></div>
	<section id="search-destroy">
		<div class="social inline">
			<ul >
				<a href="http://www.youtube.com/channel/UCV-XD4fizSpGEIU5U9lyDAA?feature=watch"><li id="youtube"></li></a>
				<a href="http://www.facebook.com/centralCECEQ"><li id="facebook"></li></a>
				<a href="http://twitter.com/central_ceceq"><li id="twitter"></li></a>
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
