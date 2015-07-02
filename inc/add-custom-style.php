<?php
/**
 * Add more styling options to the editor
 *
 * @package Writr Bamba
 */

function wpb_mce_buttons_2($buttons) {
	array_unshift($buttons, 'styleselect');
 	return $buttons;
}
add_filter('mce_buttons_2', 'wpb_mce_buttons_2');


/*
* Callback function to filter the MCE settings
*/

function my_mce_before_init_insert_formats( $init_array ) {  

// Define the style_formats array

	$style_formats = array(  
		// Each array child is a format with it's own settings
		array(  
			'title' => __('Sidenote', 'writr'),  
			'block' => 'aside',  
			'classes' => 'sidenote',
			'wrapper' => false,
		),
		array(  
			'title' => __('Left-to-Right', 'writr'),  
			'block' => 'p',  
			'classes' => 'ltr',
			'wrapper' => false,

		), 
		array(  
			'title' => __('Right-to-Left', 'writr'),  
			'block' => 'p',  
			'classes' => 'rtl',
			'wrapper' => false,

		),  
	);  
	// Insert the array, JSON ENCODED, into 'style_formats'
	$init_array['style_formats'] = json_encode( $style_formats );  
	
	return $init_array;  
  
} 
// Attach callback to 'tiny_mce_before_init' 
add_filter( 'tiny_mce_before_init', 'my_mce_before_init_insert_formats' ); 