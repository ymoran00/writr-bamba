<?php
/**
 * The Sidebar containing the main widget areas.
 *
 * @package Writr
 */
?>

<div id="sidebar-extra" class="sidebar-area-2">
	<a id="sidebar-extra-toggle" href="#" title="<?php esc_attr_e( 'Extra Sidebar', 'writr-bamba' ); ?>"><span class="genericon genericon-close"></span><span class="screen-reader-text"><?php _e( 'Extra Sidebar', 'writr-bamba' ); ?></span></a>

	<?php if ( is_active_sidebar( 'sidebar-2' ) ) : ?>
		<div id="extra" class="widget-area" role="complementary">
			<?php do_action( 'before_sidebar' ); ?>
			<?php dynamic_sidebar( 'sidebar-2' ) ?>
			<?php do_action( 'after_sidebar' ); ?>
		</div><!-- #secondary -->
	<?php endif; // end sidebar widget area ?>
</div><!-- #sidebar -->
