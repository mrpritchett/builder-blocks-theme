<?php
/**
 *
 */
require_once __DIR__ . '/lib/load.php';

/**
 * Undocumented function
 *
 * @return void
 */
function builder_blocks_register_styles() {
	wp_enqueue_style( 'builder-blocks-style', get_template_directory_uri() . '/style.css', [], '1.0.0' );
}
add_action( 'wp_enqueue_scripts', 'builder_blocks_register_styles' );
