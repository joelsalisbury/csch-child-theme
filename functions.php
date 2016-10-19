<?php
/**
 * cornerstone functions and definitions
 *
 * @package cornerstone
 */

/**
 * Set the content width based on the theme's design and stylesheet.
 */
if ( ! isset( $content_width ) ) {
	$content_width = 640; /* pixels */
}

if ( ! function_exists( 'cs_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function cs_setup() {

	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on cornerstone, use a find and replace
	 * to change 'cs' to the name of your theme in all the template files
	 */
	load_theme_textdomain( 'cs', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link http://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
	 */
	add_theme_support( 'post-thumbnails' );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'primary' => __( 'Primary Menu', 'cs' ),
	) );

	// Enable support for HTML5 markup.
	add_theme_support( 'html5', array(
		'comment-list',
		'search-form',
		'comment-form',
		'gallery',
		'caption',
	) );
}
endif; // cs_setup
add_action( 'after_setup_theme', 'cs_setup' );

if(!function_exists('is_parent_private')){
	function is_parent_private($id){
		$page = get_post($id);
		if($page->post_parent > 0){
			$parent = get_post($page->post_parent);
			$private = get_post_meta($parent->ID, 'uc-private', true);
			if($private == 'admins' || $private == 'users' || $private == 'list'){
				return $parent->ID;
			}
			else return is_parent_private($parent->ID);
		}
		else{
			return false;
		}
	}
}

/**
 * Register widget area.
 *
 * @link http://codex.wordpress.org/Function_Reference/register_sidebar
 */
function cs_widgets_init() {
	require get_template_directory() . '/inc/reg-sidebars.php';
}
add_action( 'widgets_init', 'cs_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
require get_template_directory() . '/inc/scripts-and-styles.php';

/**
 * Browser hacks
 */
require get_template_directory() . '/inc/ie-hacks.php';

/**
 * Private Pages
 */
require get_template_directory() . '/inc/private-pages.php';


/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
* New nav walkers
*/
require get_template_directory() . '/inc/nav-walker.php';
require get_template_directory() . '/inc/nav-drop-multi-walker.php';
require get_template_directory() . '/inc/nav-tabs-walker.php';

/**
* Bootstrap the comment form.
*/
require get_template_directory() . '/inc/bootstrap-forms.php';

/**
* Custom site settings
*/
require get_template_directory() . '/inc/settings.php';

/**
* Bootstrap Whitelist
*/
require get_template_directory() . '/inc/bootstrap-whitelist.php';







// Change what's hidden by default
add_filter('default_hidden_meta_boxes', 'be_hidden_meta_boxes', 10, 2);
function be_hidden_meta_boxes($hidden, $screen) {
	if ( 'post' == $screen->base || 'page' == $screen->base )
		$hidden = array('slugdiv', 'trackbacksdiv', 'postexcerpt', 'commentstatusdiv', 'commentsdiv', 'authordiv', 'revisionsdiv');
		// removed 'postcustom',
	return $hidden;
}



/*the fallback from wp_nav_menu, we want to replicate the output of wp_page_menu to be similar to wp_nav_menu
@param args, it comes from the wp_nav_menu arguments*/
function hale_main_nav_fallback($args) {
	$args['echo'] = 0; // don't echo the output yet.
	$nav_menu = wp_page_menu($args);
	if(!empty($nav_menu)){
		$doc = new DOMDocument();
		@$doc->loadHTML($nav_menu);//surpress the warnings
		$data = $doc->getElementsByTagName('li');
		//the default behaviour of wp_page_menu is that it wraps the list items with a ul and div
		//menu_class is for div in wp_page_menu, but is for the ul in wp_nav_menu
		//create the container, if any
		//container class and id come from wp_nav_menu arguments. Which is not used in wp_page_menu.
		if($args['container'] != false) {
			$attributes = (!empty($args['container_class'])?' class="'.$args['container_class'].'"':'');
			$attributes .= (!empty($args['container_id'])?' id="'.$args['container_id'].'"':'');
			if($args['container'] == 'nav') {
				echo '<nav'.$attributes.'>';
			} else {
				echo '<div'.$attributes.'>';
			}

		}
		$attributes = (!empty($args['menu_class'])?' class="'.$args['menu_class'].'"':'');
		$attributes .= (!empty($args['menu_id'])?' id="'.$args['menu_id'].'"':'');
		echo '<ul'.$attributes.'>';
		if($data->length > 0) {
			foreach($data as $item) {
				echo $item->ownerDocument->saveXML($item);//saveHTML wouldn't accept it as paramater.
			}
		}
		echo '</ul>';
		//close the container, if any
		if($args['container'] != false) {
			if($args['container'] == 'nav') {
				echo '</nav>';
			} else {
				echo '</div>';
			}

		}
	}
	return;
}

function disable_comments_media_attachments( $open, $post_id ){
	$post = get_post_type( $post_id );
	if( $post == 'attachment' ) {
		$open = false;
	}
	return $open;
}
add_filter('comments_open', 'disable_comments_media_attachments', 10 , 2);

function metaslider_filmstrip_alt_tags( $list_item, $post, $url ) {
	$alt = get_post_meta( $post->ID, '_wp_attachment_image_alt', true );
	$list_item = "<li class=\"ms-thumb slide-{$post->ID} post-{$post->ID}\" style=\"display: none;\"><img src=\"{$url}\" alt=\"{$alt} Thumbnail\" /></li>";
	return $list_item;
}
add_filter( 'metaslider_filmstrip_list_item', 'metaslider_filmstrip_alt_tags', 10, 3 );



function remove_submenu() {
	if (network_home_url() != 'http://development.wordpress.uconn.edu/'){
		remove_submenu_page( 'themes.php', 'megamenu_settings');
	}
}
add_action( 'admin_menu', 'remove_submenu', 999 );

function remove_core_widgets() {
	unregister_widget('WP_Widget_Calendar');
	unregister_widget('WP_Widget_Meta');
}
add_action( 'widgets_init', 'remove_core_widgets' );

function cornerstone_show_people(){
	if ( !is_plugin_active('uc-people/uc-people.php') ) {
		activate_plugin('uc-people/uc-people.php');
	}
};
add_action( 'admin_init', 'cornerstone_show_people' );

// Force the Page Builder plugin to include the 'simple-social-icons' class
add_filter( 'siteorigin_panels_widget_classes', 'ssi_add_widget_class' );
function ssi_add_widget_class( $classes ) {
	if ( in_array( 'widget_simple-social-icons', $classes ) ) {
		$classes[] = 'simple-social-icons';
	}

	return $classes;
}

function uc_redirect_403() {
	if( get_query_var( 'is_403' ) == true ){
		global $wp_query;

		status_header(403);
		$wp_query->is_404=false;

		add_filter( 'wp_title', function( $title='', $sep='' ){
			 return "Forbidden | ".get_bloginfo('name');
		});
		get_template_part('403');
		exit;
	}
}

add_action( 'template_redirect', 'uc_redirect_403' );

?>