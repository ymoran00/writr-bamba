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

function _get_category_icon() {
	$cats = get_the_category();
	if (function_exists('get_terms_meta'))
	{
		$iconPostfixArr = get_terms_meta($cats[0]->term_id, 'icon'); // For PHP < 5.4
	    $iconPostfix = $iconPostfixArr[0];
	} else {
		$iconPostfix = 'tags';
	}
	return $iconPostfix;
}

/** Create the category overlay */
function update_cat_thumbnail ($content) {
	if ( is_admin() || is_page()) {
		return;
	}

	 $cats = get_the_category();

	$iconPostfix = _get_category_icon();

	$categoryName = $cats[0]->name;
	$categorySlug = $cats[0]->slug;
	$overlay = "<a href='category/" . $categorySlug . "' class='tag-container'>".
					"<object type='image/svg+xml' data='" .
							get_stylesheet_directory_uri() . "/tag.svg'>" . 
							"<param name='tname' value='" . $categoryName . "'/>" .
					"</object>" .
					"<span class='tag-name'>" . $categoryName . "</span>" .
					"<i class='tag-icon fa fa-" . $iconPostfix . "'></i>" .
				"</a>";
	$content = $overlay . $content;
	return $content;
}

add_filter( 'post_thumbnail_html', 'update_cat_thumbnail');

function fix_tag_title ($content) {
	return "<i class='fa fa-tag'></i> &nbsp" . $content;
}
add_filter( 'single_tag_title', 'fix_tag_title', 10, 2);


function fix_category_title ($content) {
	$iconPostfix = _get_category_icon();
	return "<i class='fa fa-" . $iconPostfix . "'></i> &nbsp" . __('Category:', 'writr-bamba') . " " . $content;
}
add_filter( 'single_cat_title','fix_category_title', 10, 2);

add_action('wp_enqueue_scripts', create_function(null, "wp_dequeue_script('devicepx');"), 20);

