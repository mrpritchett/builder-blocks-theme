<?php

class Header {

	/**
	 * Adds Option for the Header Block Post
	 *
	 * @return int post_id
	 */
	public static function init() {
		add_action( 'admin_menu', [ self::class, 'builder_blocks_add_header_menu_item' ] );
		add_action( 'admin_init', [ self::class, 'create_header' ], 1 );
		add_action( 'admin_init', [ self::class, 'builder_blocks_header_redirect' ], 2 );
	}

	/**
	 * Create the header reusable block
	 *
	 * @return int the post id
	 */
	public static function create_header() {
		$content = '<!-- wp:builder-blocks/section -->
		<div class="wp-block-builder-blocks-section builder-blocks-section-block" style="background-color:rgba(255, 255, 255, 1);background-image:url();background-position:top left;background-repeat:no-repeat;background-size:auto;border-color:rgba(255, 255, 255, 1);border-width:0px;border-style:solid;margin:0px 0px 0px 0px;padding:20px 20px 20px 20px;width:100%"><div class="builder-blocks-section-block-content" style="margin:0 auto;max-width:1200px;width:100%"><!-- wp:columns -->
		<div class="wp-block-columns has-2-columns"><!-- wp:column -->
		<div class="wp-block-column"><!-- wp:builder-blocks/logo -->
		<div class="wp-block-builder-blocks-logo builder-blocks-logo-block" style="background-color:rgba(255, 255, 255, 1);background-image:url();background-position:top left;background-repeat:no-repeat;background-size:auto;border-color:rgba(255, 255, 255, 1);border-width:0px;border-style:solid;margin:0px 0px 0px 0px;padding:20px 20px 20px 20px"><div class="site-branding"><h1 class="site-title"><a href="">Site Title</a></h1><h2 class="site-description">Site Description</h2></div></div>
		<!-- /wp:builder-blocks/logo --></div>
		<!-- /wp:column -->

		<!-- wp:column -->
		<div class="wp-block-column"></div>
		<!-- /wp:column --></div>
		<!-- /wp:columns --></div></div>
		<!-- /wp:builder-blocks/section -->';
		$args = [
			'post_content' => $content,
			'post_status'  => 'publish',
			'post_title'   => 'Header',
			'post_type'    => 'wp_block',
		];

		$post_id = self::get_option();

		if ( ! $post_id ) {
			$post = wp_insert_post( $args );

			$post_id = self::add_option( $post );
		}

		return $post_id;
	}

	/**
	 * Adds option for the header
	 *
	 * @return bool whether option is added
	 */
	public static function add_option( int $post_id ) {
		return add_option( 'builder_blocks_header_post_id', $post_id );
	}

	/**
	 * Gets option for the header
	 *
	 * @return string|bool the option or false if it doesn't exit
	 */
	public static function get_option() {
		return get_option( 'builder_blocks_header_post_id' );
	}

	/**
	 * Adds header menu item
	 *
	 * @return void
	 */
	public static function builder_blocks_add_header_menu_item() {
		add_submenu_page( 'themes.php', 'Header', 'Header', 'manage_options', 'builder-blocks-theme-header', '__return_false' );
	}

	/**
	 * Redirects header menu page to edit post.
	 *
	 * @return void
	 */
	public static function builder_blocks_header_redirect() {
		$post_id = get_option( 'builder_blocks_header_post_id' );

		if ( isset( $_GET['page'] ) && $_GET['page'] === 'builder-blocks-theme-header' ) {
			wp_safe_redirect( get_home_url() . '/wp-admin/post.php?post=' . $post_id . '&action=edit', 301 );
			exit;
		}
	}
}