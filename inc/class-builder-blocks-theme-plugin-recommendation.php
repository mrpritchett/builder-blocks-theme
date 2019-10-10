<?php
/**
 * Adds plugin recommendation
 *
 * @package Builder Blocks Theme
 */

require_once __DIR__ . '/class-tgm-plugin-activation.php';

/**
 * Plugin Recommendation Class
 *
 * @since 0.1
 */
class Builder_Blocks_Theme_Plugin_Recommendation {

	/**
	 * Initializes Header
	 *
	 * @return void
	 */
	public static function init() {
		add_action( 'tgmpa_register', [ self::class, 'builder_blocks_theme_register_recommended_plugins' ] );
	}

	/**
	 * Add recommended plugins
	 *
	 * @return void
	 */
	public static function builder_blocks_theme_register_recommended_plugins() {
		$plugins = [
			[
				'name'     => 'Builder Blocks',
				'slug'     => 'builder-blocks',
				'required' => false,
			],
		];

		$config = [
			'id'           => 'builder-blocks-theme',
			'default_path' => '',
			'menu'         => 'tgmpa-install-plugins',
			'has_notices'  => true,
			'dismissable'  => true,
			'dismiss_msg'  => '',
			'is_automatic' => false,
			'message'      => '',
		];

		tgmpa( $plugins, $config );
	}
}
