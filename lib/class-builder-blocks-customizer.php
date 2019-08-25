<?php
/**
 * Builder Blocks Customizer
 *
 * Adds customizer fields for Builder Blocks THeme
 *
 * @package    WordPress
 * @subpackage Builder Blocks Theme
 * @since      0.1.0
 */

require_once dirname( __FILE__ ) . '/class-google-font-dropdown-custom-control.php';

/**
 * Adds customizer controls for Builder Blocks
 *
 * @since 0.1.0
 */
class Builder_Blocks_Customizer {
	/**
	 * Constructor
	 *
	 * @since 0.1.0
	 */
	public static function init() {
		add_action( 'customize_register', [ self::class, 'builder_blocks_customizer_manager' ] );
	}

	/**
	 * Customizer manager demo
	 *
	 * @param  object $wp_customize - Builder Blocks.
	 * @return void
	 */
	public static function builder_blocks_customizer_manager( $wp_customize ) {
		self::builder_blocks_fonts_section( $wp_customize );
		self::builder_blocks_colors_section( $wp_customize );
	}

	/**
	 * Adds a new section to use custom controls in the WordPress customiser
	 *
	 * @param object $wp_customize - Builder Blocks.
	 *
	 * @return void
	 */
	private static function builder_blocks_fonts_section( $wp_customize ) {
		$wp_customize->add_section(
			'builder_blocks_customizer_fonts_section',
			[
				'title' => __( 'Builder Blocks Fonts', 'builder-blocks-theme' ),
			]
		);

		/**
		 * Heading Font
		 */
		$wp_customize->add_setting(
			'builder_blocks_heading_fonts_setting',
			[
				'default'           => 'Open Sans',
				'capability'        => 'edit_theme_options',
				'sanitize_callback' => 'sanitize_text_field',
			]
		);
		$wp_customize->add_control(
			new Google_Font_Dropdown_Custom_Control(
				$wp_customize,
				'builder_blocks_heading_font_setting',
				array(
					'label'    => 'Heading Font',
					'section'  => 'builder_blocks_customizer_fonts_section',
					'settings' => 'builder_blocks_heading_fonts_setting',
					'priority' => 12,
				)
			)
		);

		/**
		 * Body Font
		 */
		$wp_customize->add_setting(
			'builder_blocks_body_fonts_setting',
			array(
				'default'           => 'PT Sans',
				'capability'        => 'edit_theme_options',
				'sanitize_callback' => 'sanitize_text_field',
			)
		);
		$wp_customize->add_control(
			new Google_Font_Dropdown_Custom_Control(
				$wp_customize,
				'builder_blocks_body_fonts_setting',
				array(
					'label'    => 'Body Font',
					'section'  => 'builder_blocks_customizer_fonts_section',
					'settings' => 'builder_blocks_body_fonts_setting',
					'priority' => 13,
				)
			)
		);
	}

	/**
	 * Adds a new section to use custom controls in the WordPress customiser
	 *
	 * @param object $wp_customize - Builder Blocks.
	 *
	 * @return void
	 */
	private static function builder_blocks_colors_section( $wp_customize ) {
		$wp_customize->add_section(
			'builder_blocks_customizer_colors_section',
			[
				'title' => __( 'Builder Blocks Colors', 'builder-blocks-theme' ),
			]
		);

		/**
		 * Background Color
		 */
		$wp_customize->add_setting(
			'builder_blocks_customizer_background_color_setting',
			array(
				'default' => '#f4f7fa',
			)
		);
		$wp_customize->add_control(
			new WP_Customize_Color_Control(
				$wp_customize,
				'builder_blocks_customizer_background_color_setting',
				array(
					'label'    => 'Body Background Color',
					'section'  => 'builder_blocks_customizer_colors_section',
					'settings' => 'builder_blocks_customizer_background_color_setting',
					'priority' => 6,
				)
			)
		);

		/**
		 * Primary Color
		 */
		$wp_customize->add_setting(
			'builder_blocks_customizer_primary_color_setting',
			array(
				'default' => '#5d62f5',
			)
		);
		$wp_customize->add_control(
			new WP_Customize_Color_Control(
				$wp_customize,
				'builder_blocks_customizer_primary_color_setting',
				array(
					'label'    => 'Primary Color',
					'section'  => 'builder_blocks_customizer_colors_section',
					'settings' => 'builder_blocks_customizer_primary_color_setting',
					'priority' => 6,
				)
			)
		);

		/**
		 * Secondary Color
		 */
		$wp_customize->add_setting(
			'builder_blocks_customizer_secondary_color_setting',
			array(
				'default' => '#f8bf24',
			)
		);
		$wp_customize->add_control(
			new WP_Customize_Color_Control(
				$wp_customize,
				'builder_blocks_customizer_secondary_color_setting',
				array(
					'label'    => 'Secondary Color',
					'section'  => 'builder_blocks_customizer_colors_section',
					'settings' => 'builder_blocks_customizer_secondary_color_setting',
					'priority' => 6,
				)
			)
		);
	}
}
