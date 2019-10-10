<?php
/**
 * Functions which enhance the theme by hooking into WordPress
 *
 * @package Builder_Blocks_Theme
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function builder_blocks_theme_body_classes( $classes ) {
	// Adds a class of hfeed to non-singular pages.
	if ( ! is_singular() ) {
		$classes[] = 'hfeed';
	}

	// Adds a class of no-sidebar when there is no sidebar present.
	if ( ! is_active_sidebar( 'sidebar-1' ) ) {
		$classes[] = 'no-sidebar';
	}

	return $classes;
}
add_filter( 'body_class', 'builder_blocks_theme_body_classes' );

/**
 * Add a pingback url auto-discovery header for single posts, pages, or attachments.
 */
function builder_blocks_theme_pingback_header() {
	if ( is_singular() && pings_open() ) {
		printf( '<link rel="pingback" href="%s">', esc_url( get_bloginfo( 'pingback_url' ) ) );
	}
}
add_action( 'wp_head', 'builder_blocks_theme_pingback_header' );

/**
 * Create the theme header
 *
 * @since 0.1
 *
 * @return String the markup of the header
 */
function builder_blocks_theme_get_header() {
	if ( ! class_exists( 'Builder_Blocks_Assets' ) ) {
		ob_start();

		get_template_part( 'templates/header' );

		$markup = ob_get_contents();

		return $markup;
	} else {
		$post_id = get_option( 'builder_blocks_header_post_id' );
		$post    = get_post( $post_id );

		ob_start();

		echo apply_filters( 'the_content', $post->post_content );

		$markup = ob_get_contents();

		return $markup;
	}
}

/**
 * Create the theme footer
 *
 * @since 0.1
 *
 * @return String the markup of the footer
 */
function builder_blocks_theme_get_footer() {
	if ( ! class_exists( 'Builder_Blocks_Assets' ) ) {
		ob_start();

		get_template_part( 'templates/footer' );

		$markup = ob_get_contents();

		return $markup;
	} else {
		$post_id = get_option( 'builder_blocks_footer_post_id' );
		$post    = get_post( $post_id );

		ob_start();

		echo apply_filters( 'the_content', $post->post_content );

		$markup = ob_get_contents();

		return $markup;
	}
}

/**
 * Create the theme 404
 *
 * @since 0.1
 *
 * @return String the markup of the 404
 */
function builder_blocks_theme_get_404() {
	if ( ! class_exists( 'Builder_Blocks_Assets' ) ) {
		ob_start();

		get_template_part( 'templates/404' );

		$markup = ob_get_contents();

		return $markup;
	} else {
		$post_id = get_option( 'builder_blocks_404_post_id' );
		$post    = get_post( $post_id );

		ob_start();

		echo apply_filters( 'the_content', $post->post_content );

		$markup = ob_get_contents();

		return $markup;
	}
}
