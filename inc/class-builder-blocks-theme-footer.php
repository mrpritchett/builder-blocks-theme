<?php

class Builder_Blocks_Theme_Footer {

	/**
	 * Adds Option for the Footer Block Post
	 *
	 * @return int post_id
	 */
	public static function init() {
		add_action( 'admin_menu', [ self::class, 'builder_blocks_add_footer_menu_item' ] );
		add_action( 'admin_init', [ self::class, 'create_footer' ], 1 );
		add_action( 'admin_init', [ self::class, 'builder_blocks_footer_redirect' ], 2 );
	}

	/**
	 * Create the footer reusable block
	 *
	 * @return int the post id
	 */
	public static function create_footer() {
		$content = '<!-- wp:builder-blocks/section -->
		<div class="wp-block-builder-blocks-section builder-blocks-section-block" style="background-color:rgba(255, 255, 255, 1);background-image:url();background-position:top left;background-repeat:no-repeat;background-size:auto;border-color:rgba(255, 255, 255, 1);border-width:0px;border-style:solid;margin:0px 0px 0px 0px;padding:20px 20px 20px 20px;width:100%"><div class="builder-blocks-section-block-content" style="margin:0 auto;max-width:1200px;width:100%"><!-- wp:columns {"columns":3} -->
		<div class="wp-block-columns has-3-columns"><!-- wp:column -->
		<div class="wp-block-column"><!-- wp:paragraph -->
		<p></p>
		<!-- /wp:paragraph --></div>
		<!-- /wp:column -->

		<!-- wp:column -->
		<div class="wp-block-column"></div>
		<!-- /wp:column -->

		<!-- wp:column -->
		<div class="wp-block-column"></div>
		<!-- /wp:column --></div>
		<!-- /wp:columns --></div></div>
		<!-- /wp:builder-blocks/section -->';
		$args = [
			'post_content' => $content,
			'post_status'  => 'publish',
			'post_title'   => 'Footer',
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
	 * Adds option for the footer
	 *
	 * @return bool whether option is added
	 */
	public static function add_option( int $post_id ) {
		return add_option( 'builder_blocks_footer_post_id', $post_id );
	}

	/**
	 * Gets option for the footer
	 *
	 * @return string|bool the option or false if it doesn't exit
	 */
	public static function get_option() {
		return get_option( 'builder_blocks_footer_post_id' );
	}

	/**
	 * Adds footer menu item
	 *
	 * @return void
	 */
	public static function builder_blocks_add_footer_menu_item() {
		add_submenu_page( 'themes.php', 'Footer', 'Footer', 'manage_options', 'builder-blocks-theme-footer', '__return_false' );
	}

	/**
	 * Redirects footer menu page to edit post.
	 *
	 * @return void
	 */
	public static function builder_blocks_footer_redirect() {
		$post_id = get_option( 'builder_blocks_footer_post_id' );

		if ( isset( $_GET['page'] ) && $_GET['page'] === 'builder-blocks-theme-footer' ) {
			wp_safe_redirect( get_home_url() . '/wp-admin/post.php?post=' . $post_id . '&action=edit', 301 );
			exit;
		}
	}
}