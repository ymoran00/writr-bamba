<?php
// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;


/**
 * Setup My Child Theme's textdomain.
 *
 * Declare textdomain for this child theme.
 * Translations can be filed in the /languages/ directory.
 */
function my_child_theme_setup() {
    load_child_theme_textdomain( 'writr-bamba', get_stylesheet_directory() . '/languages' );
    load_child_theme_textdomain( 'writr', get_stylesheet_directory() . '/languages' );
}
add_action( 'after_setup_theme', 'my_child_theme_setup' );

// END ENQUEUE PARENT ACTION


if (!is_admin()) add_action( "wp_enqueue_script", "my_jquery_enqueue", 11 );
function my_jquery_enqueue () {
	wp_deregister_script('jquery' );
	wp_register_script('jquery', "http" . ($_SERVER['SERVER_PORT']==443?"s":"") . "://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js", false, null );
	//wp_register_script('jquery', "//code.jquery.com/jquery-1.11.3.min.js", false, null );
	wp_enqueue_script('jquery' );
}

// Set the FavIcon
function childtheme_favicon() { ?>
	<link rel="icon" type="image/png" href="<?php echo esc_url( get_stylesheet_directory_uri() ) ?>/images/favicon.png" >
<?php }
add_action('wp_head', 'childtheme_favicon');


add_action('admin_head', 'my_custom_fonts');

function my_custom_fonts() {
  wp_enqueue_style( 'admin-child', trailingslashit(get_stylesheet_directory_uri()) . '/admin.css' );
}


/** Create the category overlay */
function update_cat_thumbnail ($content) {
	if ( is_admin()) {
		return;
	}

	$cats = get_the_category();

	if (function_exists('get_terms_meta'))
	{
	    $iconPostfix = get_terms_meta($cats[0]->term_id, 'icon')[0];
	} else {
		$iconPostfix = 'tags';
	}

	$categoryName = $cats[0]->name;

	$overlay = "<div class='overlay-category-container'>" .
					"<div class='overlay-category-banner'></div>" .
					"<i class='fa fa-" . $iconPostfix . "'></i>" .
					"<span>" . $categoryName . "</span>" .
				"</div>"; 
	$content = $overlay . $content;
	return $content;
}

add_filter( 'post_thumbnail_html', 'update_cat_thumbnail');

function add_tag_icon ($content) {
	return "<i class='fa fa-tag'></i> &nbsp" . $content;
}
add_filter( 'single_tag_title', 'add_tag_icon', 10, 2);


function writr_bamba_widgets_init() {
	register_sidebar( array(
		'name'          => __( 'Extra Sidebar', 'writr-bamba' ),
		'id'            => 'sidebar-2',
		'description'   => __('Widgets here will appear on the other side of test, holding extra (less important) data.', 'writr-bamba'),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h1 class="widget-title">',
		'after_title'   => '</h1>',
	) );
}
add_action( 'widgets_init', 'writr_bamba_widgets_init' );