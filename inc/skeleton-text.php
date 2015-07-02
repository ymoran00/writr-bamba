<?php
/**
 * Text and icon updated on the template's L&F - titles, tooltips, etc.
 *
 * @package Writr Bamba
 */

function fix_tag_title ($content) {
	return "<i class='fa fa-tag'></i>  " . __('Tag:', 'writr') . " " . $content;
}
add_filter( 'single_tag_title', 'fix_tag_title', 10, 2);


function fix_category_title ($content) {
	$iconPostfix = _get_category_icon();
	return "<i class='fa fa-" . $iconPostfix . "'></i>  " . __('Category:', 'writr') . " " . $content;
}
add_filter( 'single_cat_title','fix_category_title', 10, 2);