<?php
/**
 * Adds Assets
 *
 * @package Builder Blocks Theme
 */

require_once dirname( __DIR__, 1 ) . '/vendor/autoload.php';

/**
 * Builder Blocks Theme Assets Class
 *
 * @since 0.1
 */
class Builder_Blocks_Theme_Assets {
	/**
	 * Enqueue constant
	 *
	 * @since 0.1
	 * @var Object
	 */
	public static $enqueue;

	/**
	 * Ininitialize class methods.
	 *
	 * @since 0.1
	 */
	public static function init() {
		self::$enqueue = new \WPackio\Enqueue( 'builderBlocksTheme', 'dist', '1.0.0', 'theme', __FILE__ );

		add_action( 'wp_enqueue_scripts', [ self::class, 'inline_styles' ] );
		add_action( 'wp_enqueue_scripts', [ self::class, 'scripts' ] );
	}

	/**
	 * Adds inline styles
	 *
	 * @since 0.1
	 */
	public static function inline_styles() {
		wp_enqueue_style( 'builder-blocks-style', get_stylesheet_uri(), [], '1.0.0' );
		self::$enqueue->enqueue( 'main', 'main', [] );

		$heading_font     = get_theme_mod( 'builder_blocks_heading_fonts_setting' );
		$body_font        = get_theme_mod( 'builder_blocks_body_fonts_setting' );
		$background_color = get_theme_mod( 'builder_blocks_customizer_background_color_setting' );
		$primary_color    = get_theme_mod( 'builder_blocks_customizer_primary_color_setting' );
		$secondary_color  = get_theme_mod( 'builder_blocks_customizer_secondary_color_setting' );

		$custom_css = '
			body {
				background-color: ' . esc_attr( $background_color ) . ';
				font-family: ' . esc_attr( $body_font ) . ', sans-serif;
			}
			h1, h2, h3, h4, h5, h6 {
				color: ' . esc_attr( $primary_color ) . ';
				font-family: ' . esc_attr( $heading_font ) . ', sans-serif;
			}
			.site-title, .site-title a, a {
				color: ' . esc_attr( $secondary_color ) . ';
			}
			button, .wp-block-button__link {
				background-color: ' . esc_attr( $secondary_color ) . ';
			}';
		wp_add_inline_style( 'builder-blocks-style', $custom_css );
	}

	/**
	 * Add scripts
	 *
	 * @since 0.1
	 */
	public static function scripts() {
		wp_enqueue_script( 'builder-blocks-skip-link', get_stylesheet_directory_uri() . '/assets/js/skip-link-focus.js', [], '1.0.0' );
	}
}
