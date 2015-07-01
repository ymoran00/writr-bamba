<?php
/**
 * Custom functions that act independently of the theme templates
 *
 * Eventually, some of the functionality here could be replaced by core features
 *
 * @package Writr
 */

/** Create the category overlay */

$category_colors = array (
	"#f44336",
	"#3f51b5",
	"#4caf50",
	"#ff9800",
	"#9c27b0",
	"#00bcd4",
	"#e91e63",
	"#2196f3",
	"#8bc34a",
	"#ff5722",
	"#673ab7",
	"#009688",
	"#ffc107",
	"#03a9f4",
	"#cddc39",
	"#607d8b"
);


function update_cat_thumbnail ($content) {
	global $category_colors;
	if ( is_admin() || is_page()) {
		return;
	}

	 $cats = get_the_category();

	$iconPostfix = _get_category_icon();

	$categoryName = $cats[0]->name;
	$categorySlug = $cats[0]->slug;
	$categoryId = $cats[0]->term_id; 
	$categoryColor = $category_colors[intval($categoryId) % sizeof($category_colors)];
	$overlay = "<a href='" . esc_url( get_category_link($categoryId) ) . "' class='tag-container'>" . 
					"<svg width='50px' height='110px' viewBox='0 0 500 1100' xmlns='http://www.w3.org/2000/svg' version='1.1'>" .  
  						"<path style='fill: " . $categoryColor ."'" .
    						"d='M 0,0 L 500,0 L 500,1100 L 0,1000 Z'/>" .
					"</svg>" .
					"<span class='tag-name'>" . $categoryName . "</span>" .
					"<i class='tag-icon fa fa-" . $iconPostfix . "'></i>" .
				"</a>";
	$content = $overlay . $content;
	return $content;
}

add_filter( 'post_thumbnail_html', 'update_cat_thumbnail');


