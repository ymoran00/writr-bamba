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
	load_child_theme_textdomain( 'writr', get_stylesheet_directory() . '/languages' );

	add_editor_style();
}
add_action( 'after_setup_theme', 'my_child_theme_setup' , 20);

// END ENQUEUE PARENT ACTION


// Set the FavIcon
function childtheme_favicon() { ?>
	<link rel="icon" type="image/png" href="<?php echo esc_url( get_stylesheet_directory_uri() ) ?>/images/favicon.png" >
<?php }
add_action('wp_head', 'childtheme_favicon');



function bamba_scripts () {
	
}
add_action( 'wp_enqueue_scripts', 'bamba_scripts' ,20);


function bamba_admin_scripts() {
	wp_enqueue_style( 'admin-child', trailingslashit(get_stylesheet_directory_uri()) . '/admin.css' );

}
add_action( 'admin_enqueue_scripts', 'bamba_admin_scripts' );


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

/**
 * Skeleton text.
 */
require get_stylesheet_directory() . '/inc/skeleton-text.php';


/**
 * Category Overlay.
 */
require get_stylesheet_directory() . '/inc/category-overlay.php';


/**
 * Add custom style.
 */
require get_stylesheet_directory() . '/inc/add-custom-style.php';


