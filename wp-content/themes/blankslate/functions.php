<?php
add_action( 'after_setup_theme', 'blankslate_setup' );
function blankslate_setup()
{
	load_theme_textdomain( 'blankslate', get_template_directory() . '/languages' );
	add_theme_support( 'automatic-feed-links' );
	add_theme_support( 'post-thumbnails' );
	global $content_width;
	if ( ! isset( $content_width ) ) $content_width = 640;
	register_nav_menus(
		array( 'main-menu' => __( 'Main Menu', 'blankslate' ) )
		);
}
//add_action( 'wp_enqueue_scripts', 'blankslate_load_scripts' );
function blankslate_load_scripts()
{
	if(!is_admin()){
		wp_enqueue_script( 'jquery' );
		wp_enqueue_script('ui-datepicker', get_bloginfo('template_url') . '/calendar/jquery.ui.datepicker.js');
		wp_enqueue_script( 'mi-script-ajax',get_bloginfo('template_url') . '/calendar/search-events.js', array( 'jquery' ) );
		wp_enqueue_script('custom_script', get_bloginfo('template_url').'/calendar/functions2.js', array('jquery'));
		wp_enqueue_script( 'mi-script-ajax_2',get_bloginfo('template_url') . '/calendar/search-all-events.js', array( 'jquery' ) );
		wp_enqueue_script('custom_script_2', get_bloginfo('template_url').'/calendar/functions3.js', array('jquery'));
		wp_enqueue_script('jquery-ui', get_bloginfo('template_url') . '/calendar/jquery-ui-1.8.9.custom.min.js', array('jquery'));
		wp_enqueue_style('ui-datepicker', get_bloginfo('template_url') . '/calendar/jquery-ui-1.8.9.custom.css');
		wp_enqueue_style('bootstrap', "http://maxcdn.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css");
		wp_localize_script( 'mi-script-ajax', 'MyAjax', array( 'url' => admin_url( 'admin-ajax.php' ), 'nonce' => wp_create_nonce('myajax-post-comment-nonce' )) );
	}
}
add_action( 'comment_form_before', 'blankslate_enqueue_comment_reply_script' );
function blankslate_enqueue_comment_reply_script()
{
	if ( get_option( 'thread_comments' ) ) { wp_enqueue_script( 'comment-reply' ); }
}
add_filter( 'the_title', 'blankslate_title' );
function blankslate_title( $title ) {
	if ( $title == '' ) {
		return '&rarr;';
	} else {
		return $title;
	}
}
add_filter( 'wp_title', 'blankslate_filter_wp_title' );
function blankslate_filter_wp_title( $title )
{
	return $title . esc_attr( get_bloginfo( 'name' ) );
}
add_action( 'widgets_init', 'blankslate_widgets_init' );
function blankslate_widgets_init()
{
	register_sidebar( array (
		'name' => __( 'Sidebar Widget Area', 'blankslate' ),
		'id' => 'primary-widget-area',
		'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
		'after_widget' => "</li>",
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
		) );
}
function blankslate_custom_pings( $comment )
{
	$GLOBALS['comment'] = $comment;
	?>
	<li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>"><?php echo comment_author_link(); ?></li>
	<?php 
}
add_filter( 'get_comments_number', 'blankslate_comments_number' );
function blankslate_comments_number( $count )
{
	if ( !is_admin() ) {
		global $id;
		$comments_by_type = &separate_comments( get_comments( 'status=approve&post_id=' . $id ) );
		return count( $comments_by_type['comment'] );
	} else {
		return $count;
	}
}

add_action( 'init', 'create_event_postype' );

function create_event_postype() {

	$labels = array(
		'name' => __('Eventos del CECEQ'),
		'singular_name' => __('Eventos'),
		'add_new' => __('Registrar nuevo evento'),
		'add_new_item' => __('Registrar nuevo evento'),
		'edit_item' => __('Editar evento'),
		'new_item' => __('Nuevo evento'),
		'view_item' => __('Ver evento'),
		'search_items' => __('Buscar eventos'),
		'not_found' =>  __('No hay eventos'),
		'not_found_in_trash' => __('No hay eventos'),
		'parent_item_colon' => '',
		);

	$args = array(
		'label' => __('Eventos del CECEQ'),	
		'labels' => $labels,
		'public' => true,
		'can_export' => true,
		'show_ui' => true,
		'has_archive' => true,
		'_builtin' => false,
		'capability_type' => 'post',
		'hierarchical' => true,
		'supports'=> array('title', 'thumbnail') ,
		'show_in_nav_menus' => true,
		'taxonomies' => array( 'categorias_ceceq', 'post_tag')
		);

	register_post_type( 'eventos_ceceq', $args);

}

function create_eventcategory_taxonomy() {

	$labels = array(
		'name' => __( 'Categorías' ),
		'singular_name' => __( 'Categoría' ),
		'search_items' =>  __( 'Buscar categoría' ),
		'popular_items' => __( 'Categorías populares' ),
		'all_items' => __( 'Todas las categorías' ),
		'parent_item' => null,
		'parent_item_colon' => null,
		'edit_item' => __( 'Editar categorías' ),
		'update_item' => __( 'Actualizar Categorías' ),
		'add_new_item' => __( 'Agregar nueva categoría' ),
		'new_item_name' => __( 'Nuevo nombre de categoría' ),
		'separate_items_with_commas' => __( 'Separar categorías con comas' ),
		'add_or_remove_items' => __( 'Agregar o eliminar categorías' ),
		'choose_from_most_used' => __( 'Seleccionar de las categorías más usadas' ),
		);

	register_taxonomy('categorias_ceceq','eventos_ceceq', array(
		'label' => __('Categorías de evento'),
		'labels' => $labels,
		'hierarchical' => true,
		'show_ui' => true,
		'query_var' => true,
		'rewrite' => array( 'slug' => 'event-category' ),
		));
}

add_action( 'init', 'create_eventcategory_taxonomy', 0 );


add_filter ("manage_edit-eventos_ceceq_columns", "eventos_ceceq_edit_columns");

function eventos_ceceq_edit_columns($columns) {

	$columns = array(
		"cb" => "<input type=\"checkbox\" />",
		"title" => "Event",
		"ceceq_col_ev_cat" => "Categoría",
		"ceceq_col_ev_date" => "Fechas",
		"ceceq_col_ev_times" => "Horas",
		"ceceq_col_ev_thumb" => "Thumbnail",
		"ceceq_col_ev_desc" => "Descripción"
		);
	return $columns;
}

add_action ("manage_eventos_ceceq_posts_custom_column", "eventos_ceceq_custom_columns");
function eventos_ceceq_custom_columns($column)
{
	global $post;
	$custom = get_post_custom($post->ID);
	switch ($column)
	{
		case "ceceq_col_ev_cat":
    // - show taxonomy terms -
		$eventcats = get_the_terms($post->ID, "categorias_ceceq");
		$eventcats_html = array();
		if ($eventcats) {
			foreach ($eventcats as $eventcat)
				array_push($eventcats_html, $eventcat->name);
			echo implode($eventcats_html, ", ");
		} else {
			_e('None', 'themeforce');;
		}
		break;
		case "ceceq_col_ev_date":
    // - show dates -
		$startd = $custom["eventos_ceceq_startdate"][0];
		$endd = $custom["eventos_ceceq_enddate"][0];
		$startdate = date("F j, Y", $startd);
		$enddate = date("F j, Y", $endd);
		echo $startdate . '<br /><em>' . $enddate . '</em>';
		break;
		case "ceceq_col_ev_times":
    // - show times -
		$startt = $custom["eventos_ceceq_startdate"][0];
		$endt = $custom["eventos_ceceq_enddate"][0];
		$time_format = get_option('time_format');
		$starttime = date($time_format, $startt);
		$endtime = date($time_format, $endt);
		echo $starttime . ' - ' .$endtime;
		break;
		case "ceceq_col_ev_thumb":
    // - show thumb -
		$post_image_id = get_post_thumbnail_id(get_the_ID());
		if ($post_image_id) {
			$url = wp_get_attachment_url( get_post_thumbnail_id($post->ID) );
			echo "<a href='$url' target='_blank'>";
			the_post_thumbnail( 'thumbnail' );
			echo "</a>";
		}
		break;
		case "ceceq_col_ev_desc":
		$descripcion = $custom["eventos_ceceq_descripcion"][0];
		echo $descripcion;
		//the_excerpt();
		break;

	}
}

add_action( 'admin_init', 'eventos_ceceq_create' );

function eventos_ceceq_create() {
	add_meta_box('eventos_ceceq_meta', 'Events', 'eventos_ceceq_meta', 'eventos_ceceq');
}

function eventos_ceceq_meta () {

// - grab data -

	global $post;
	$custom = get_post_custom($post->ID);
	$meta_sd = $custom["eventos_ceceq_startdate"][0];
	$meta_ed = $custom["eventos_ceceq_enddate"][0];
	$meta_st = $meta_sd;
	$meta_et = $meta_ed;
	$meta_desc = $custom["eventos_ceceq_descripcion"][0];
// - grab wp time format -

$date_format = get_option('date_format'); // Not required in my code
$time_format = get_option('time_format');

// - populate today if empty, 00:00 for time -

if ($meta_sd == null) { $meta_sd = time(); $meta_ed = $meta_sd; $meta_st = 12; $meta_et = 12;}

// - convert to pretty formats -

$clean_sd = date("D, M d, Y", $meta_sd);
$clean_ed = date("D, M d, Y", $meta_ed);
$clean_st = date("H:i", $meta_st);
$clean_et = date("H:i", $meta_et);

// - security -

echo '<input type="hidden" name="ceceq-events-nonce" id="ceceq-events-nonce" value="' .
wp_create_nonce( 'ceceq-events-nonce' ) . '" />';

// - output -
?>

<style>
	ul.event-data{
		font-size: 1.3em;
	}
	ul.event-data li{
		display: inline-block;
	}
	ul.event-data li label{
		display: block;
	}
	.col-md-3{width: 33.333333%;}
</style>
<div class="ceceq-meta">
	<ul class = "event-data row">
		<?php 
		$start = "00:00";
		$end = "23:30";

		$tStart = strtotime($start);
		$tEnd = strtotime($end);
		$tNow = $tStart;
		?>
		<li class="col-md-3"><label>Fecha de inicio</label><input readonly="true" name="eventos_ceceq_startdate" class="tfdate" value="<?php echo $clean_sd; ?>" /></li>
		<li class="col-md-3"><label>Fecha de fin</label><input readonly="true" name="eventos_ceceq_enddate" class="tfdate" value="<?php echo $clean_ed; ?>" /></li>
		<li class="col-md-3"><label>Hora de inicio</label>

		<select name="eventos_ceceq_starttime">
		<?php echo "<option value='".$clean_st."' selected>".$clean_st."</option>"?>
			<?php while($tNow <= $tEnd){
				echo "<option value='".date("H:i",$tNow)."'>".date("H:i",$tNow)."</option>";
				$tNow = strtotime('+30 minutes',$tNow);
			} 
			?>
		</select>
		<em>24h</em></li>

		<?php 
		$start = "00:00";
		$end = "23:30";

		$tStart = strtotime($start);
		$tEnd = strtotime($end);
		$tNow = $tStart;
		 ?>
		 <li class="col-md-3"><label>Hora de fin</label>
		 <select name="eventos_ceceq_endtime">
		<?php echo "<option value='".$clean_et."' selected>".$clean_et."</option>"?>
			<?php while($tNow <= $tEnd){
				echo "<option value='".date("H:i",$tNow)."'>".date("H:i",$tNow)."</option>";
				$tNow = strtotime('+30 minutes',$tNow);
			} 
			?>
		</select>
		<em>24h </em>
		<li class="col-md-3"><label>Descripción del evento</label><textarea cols=80 rows=5 name="eventos_ceceq_descripcion"><?php echo $meta_desc ?></textarea></li>
	</ul>
</div>

<?php
}

add_action ('save_post', 'guardar_evento');

function guardar_evento(){

	global $post;

// - still require nonce

	if ( isset( $_POST['ceceq-events-nonce'] ) && ! wp_verify_nonce( $_POST['ceceq-events-nonce'], 'ceceq-events-nonce' ) ) {
		return $post->ID;
	}


	//if ( !current_user_can( 'edit_post', $post->ID ))
	//	return $post->ID;

// - convert back to unix & update post

	if(!isset($_POST["eventos_ceceq_startdate"])):
		return $post;
	endif;
	$updatestartd = strtotime ( $_POST["eventos_ceceq_startdate"] . $_POST["eventos_ceceq_starttime"] );
	update_post_meta($post->ID, "eventos_ceceq_startdate", $updatestartd );

	if(!isset($_POST["eventos_ceceq_enddate"])):
		return $post;
	endif;
	$updateendd = strtotime ( $_POST["eventos_ceceq_enddate"] . $_POST["eventos_ceceq_endtime"]);
	update_post_meta($post->ID, "eventos_ceceq_enddate", $updateendd );

	if(!isset($_POST["eventos_ceceq_descripcion"])):
		return $post;
	endif;
	$updatedesc =  ( $_POST["eventos_ceceq_descripcion"] );
	update_post_meta($post->ID, "eventos_ceceq_descripcion", $updatedesc );

}

add_filter('post_updated_messages', 'events_updated_messages');

function events_updated_messages( $messages ) {

	global $post, $post_ID;

	$messages['eventos_ceceq'] = array(
    0 => '', // Unused. Messages start at index 1.
    1 => sprintf( __('Event updated. <a href="%s">View item</a>'), esc_url( get_permalink($post_ID) ) ),
    2 => __('Custom field updated.'),
    3 => __('Custom field deleted.'),
    4 => __('Event updated.'),
    /* translators: %s: date and time of the revision */
    5 => isset($_GET['revision']) ? sprintf( __('Event restored to revision from %s'), wp_post_revision_title( (int) $_GET['revision'], false ) ) : false,
    6 => sprintf( __('Event published. <a href="%s">View event</a>'), esc_url( get_permalink($post_ID) ) ),
    7 => __('Event saved.'),
    8 => sprintf( __('Event submitted. <a target="_blank" href="%s">Preview event</a>'), esc_url( add_query_arg( 'preview', 'true', get_permalink($post_ID) ) ) ),
    9 => sprintf( __('Event scheduled for: <strong>%1$s</strong>. <a target="_blank" href="%2$s">Preview event</a>'),
      // translators: Publish box date format, see http://php.net/date
    	date_i18n( __( 'M j, Y @ G:i' ), strtotime( $post->post_date ) ), esc_url( get_permalink($post_ID) ) ),
    10 => sprintf( __('Event draft updated. <a target="_blank" href="%s">Preview event</a>'), esc_url( add_query_arg( 'preview', 'true', get_permalink($post_ID) ) ) ),
    );

return $messages;
}


// 7. JS Datepicker UI

function events_styles() {
	global $post_type;
	if( 'eventos_ceceq' != $post_type )
		return;
	wp_enqueue_style('ui-datepicker', get_bloginfo('template_url') . '/calendar/jquery-ui-1.8.9.custom.css');
}

function events_scripts() {
	global $post_type;
	if( 'eventos_ceceq' != $post_type )
		return;
	wp_enqueue_script('ui-datepicker', get_bloginfo('template_url') . '/calendar/jquery.ui.datepicker.js');
	wp_enqueue_script('custom_script', get_bloginfo('template_url').'/calendar/functions.js', array('jquery'));
}

add_action( 'admin_print_styles-post.php', 'events_styles', 1000 );
add_action( 'admin_print_styles-post-new.php', 'events_styles', 1000 );

add_action( 'admin_print_scripts-post.php', 'events_scripts', 1000 );
add_action( 'admin_print_scripts-post-new.php', 'events_scripts', 1000 );

function my_scripts_method() {
	if(!is_admin()){
		wp_enqueue_script( 'jquery' );
		wp_enqueue_script( 'custom_script', get_template_directory_uri() . '/plugin-slider/js/bjqs-1.3.js' );
	}
}

//add_action( 'wp_enqueue_scripts', 'my_scripts_method' );
function extra_setup() {
register_nav_menu ('primary mobile', __( 'Navigation Mobile', 'blankslate' ));
}
add_action( 'after_setup_theme', 'extra_setup' );

function get_social_media(){
	return '
	<div class="social-media">
		<div id="twitter-box" class="">
			<a class="twitter-timeline" href="https://twitter.com/Central_CECEQ" data-widget-id="487090241400893440">Tweets by @Central_CECEQ</a>
			<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?\'http\':\'https\';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+"://platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>
		</div>
		<div id="facebook-box" class="">
			<div class="fb-like-box" data-href="https://www.facebook.com/centralCECEQ" data-height="600" data-colorscheme="light" data-show-faces="true" data-header="false" data-stream="true" data-show-border="true"></div>
		</div>
	</div>
	';
}

function get_suscription_form(){
	echo do_shortcode( '[contact-form-7 id="469" title="Suscripción cartelera"]' );
}

add_action('wp_ajax_buscar_posts', 'buscar_posts_callback');
add_action('wp_ajax_nopriv_buscar_posts', 'buscar_posts_callback');
 
function custom_posts_join( $join, $query ){
 
    global $wpdb;
 
    //  if current query is the main query and a search...
    if( is_main_query() && is_search() ){
 
        //  join term_relationships, term_taxonomy, and terms into the current SQL where clause
        $join .= "
        INNER JOIN
          {$wpdb->term_relationships} ON {$wpdb->posts}.ID = {$wpdb->term_relationships}.object_id
        INNER JOIN
          {$wpdb->term_taxonomy} ON {$wpdb->term_taxonomy}.term_taxonomy_id = {$wpdb->term_relationships}.term_taxonomy_id
        INNER JOIN
          {$wpdb->terms} ON {$wpdb->terms}.term_id = {$wpdb->term_taxonomy}.term_id ";
 
    }
 
    return $join;
 
}
add_filter( 'posts_join', 'custom_posts_join', 10, 2 );
function custom_posts_where( $where, $query ){
 
    global $wpdb;
 
    //  if current query is the main query and a search...
    if( is_main_query() && is_search() ){
 
        //  explictly search category and post_tag taxonomies
        $where .= " OR ( {$wpdb->term_taxonomy}.taxonomy IN('category', 'post_tag') ";
 
        $where .= " AND {$wpdb->terms}.name LIKE '%" . $wpdb->escape( get_query_var('s') ) . "%' )";
 
    }
 
    //  return the where clause
    return $where;
 
}
add_filter( 'posts_where', 'custom_posts_where', 10, 2 );

function custom_posts_groupby( $groupby, $query ){
 
    global $wpdb;
 
    //  if current query is the main query and a search...
    if( is_main_query() && is_search() ){
 
        //  assign the GROUPBY
        $groupby = "{$wpdb->posts}.ID";
 
    }
 
    //  return the GROUP BY clause
    return $groupby;
 
}
add_filter( 'posts_groupby', 'custom_posts_groupby', 10, 2 );

function buscar_posts_callback() {
	global $post;
	$nonce = $_POST['nonce'];
	if ( ! wp_verify_nonce( $nonce, 'myajax-post-comment-nonce' ) )
		die ( 'Te atrapamos maldito!');
	$my_time = time();
	$perm = $_POST['perm'];
	$fecha = $_POST['valor'];
	if($fecha!=null)
		$my_time = strtotime($fecha); 


	$args = array (
		'post_type' => 'eventos_ceceq',
		'tax_query' => array(
			array('taxonomy' => 'categorias_ceceq',
				'field' => 'slug',
				'terms' => $perm
				)
			),
		);
	query_posts( $args );
	// Start the Loop.
	$i = 0;
	while ( have_posts() ) : the_post();
	$custom = get_post_custom($post->ID);
	$descripcion = $custom["eventos_ceceq_descripcion"][0];
	$meta_sd = $custom["eventos_ceceq_startdate"][0];
	$meta_ed = $custom["eventos_ceceq_enddate"][0];
	$meta_st = $meta_sd;
	$meta_et = $meta_ed;
	if($meta_st<= $my_time+86399 && $meta_ed>=$my_time){
		$i++;
		$url = wp_get_attachment_url( get_post_thumbnail_id($post->ID) );
		echo "<li class=\"text-center\">";
		echo "<h2 class=\"titulo\">".get_the_title()."</h2>";
		echo "<a href='$url' target='_blank'>";
		the_post_thumbnail( 'medium' );
		echo "</a>";
		$meta_sd = date("D, M d, Y", $meta_sd);
		$meta_ed = date("D, M d, Y", $meta_ed);
		$meta_st = date("H:i a", $meta_st);
		$meta_et = date("H:i a", $meta_et);
		echo "<h4>Descripción del evento: $descripcion</h4>";
		echo "<h4>Fecha de inicio: $meta_sd</h4>";
		echo "<h4>Fecha de fin: $meta_ed</h4>";
		echo "<h4>Hora de inicio: $meta_st</h4>";
		echo "<h4>Hora de fin: $meta_et</h4>";
		$eventcats = get_the_terms($post->ID, "categorias_ceceq");
		$eventcats_html = array();
		echo "</li>";
	}
	endwhile;
	if(!have_posts()||$i==0)
		echo "No hay eventos en ese día.";
	echo "<div class='invisible'>";
}

add_action('wp_ajax_buscar_todos_posts', 'buscar_todos_posts_callback');
add_action('wp_ajax_nopriv_buscar_todos_posts', 'buscar_todos_posts_callback');


function buscar_todos_posts_callback() {
	global $post;
	$nonce = $_POST['nonce'];
	if ( ! wp_verify_nonce( $nonce, 'myajax-post-comment-nonce' ) )
		die ( 'Te atrapamos maldito!');
	$my_time = time();
	$fecha = $_POST['valor'];
	if($fecha!=null)
		$my_time = strtotime($fecha); 


	$args = array (
		'post_type' => 'eventos_ceceq',
		);
	query_posts( $args );
	// Start the Loop.
	$i = 0;
	while ( have_posts() ) : the_post();
	$custom = get_post_custom($post->ID);
	$descripcion = $custom["eventos_ceceq_descripcion"][0];
	$meta_sd = $custom["eventos_ceceq_startdate"][0];
	$meta_ed = $custom["eventos_ceceq_enddate"][0];
	$meta_st = $meta_sd;
	$meta_et = $meta_ed;
	if(($meta_st<= $my_time+86399 && $meta_et>=$my_time)){
		$i++;
		$url = wp_get_attachment_url( get_post_thumbnail_id($post->ID) );
		echo "<li class=\"text-center\">";
		echo "<h2 class=\"titulo\">".get_the_title()."</h2>";
		echo "<a href='$url' target='_blank'>";
		the_post_thumbnail( 'medium' );
		echo "</a>";
		$meta_sd = date("d/m/Y", $meta_sd);
		$meta_ed = date("d/m/Y", $meta_ed);
		$meta_st = date("H:i a", $meta_st);
		$meta_et = date("H:i a", $meta_et);
		echo "<h4>Descripción del evento: $descripcion</h4>";
		echo "<h4>Fecha de inicio: $meta_sd</h4>";
		echo "<h4>Fecha de fin: $meta_ed</h4>";
		echo "<h4>Hora de inicio: $meta_st</h4>";
		echo "<h4>Hora de fin: $meta_et</h4>";
		$eventcats = get_the_terms($post->ID, "categorias_ceceq");
		$eventcats_html = array();
		echo "</li>";
	}
	endwhile;
	if(!have_posts()||$i==0)
		echo "No hay eventos en ese día.";
	echo "<div class='invisible'>";
}
?>

