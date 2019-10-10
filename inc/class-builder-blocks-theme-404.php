<?php
/**
 * Adds 404 setup
 *
 * @package Builder Blocks Theme
 */

/**
 * 404 Class
 *
 * @since 0.1
 */
class Builder_Blocks_Theme_404 {

	/**
	 * Initializes 404
	 *
	 * @return void
	 */
	public static function init() {
		add_action( 'admin_menu', [ self::class, 'builder_blocks_add_404_menu_item' ] );
		add_action( 'admin_init', [ self::class, 'create_header' ], 1 );
		add_action( 'admin_init', [ self::class, 'builder_blocks_404_redirect' ], 2 );
	}

	/**
	 * Create the 404 reusable block
	 *
	 * @return int the post id
	 */
	public static function create_header() {
		$content = '<!-- wp:builder-blocks/section -->
		<div class="wp-block-builder-blocks-section builder-blocks-section-block" style="background-color:rgba(255, 255, 255, 1);background-image:url();background-position:top left;background-repeat:no-repeat;background-size:auto;border-color:rgba(255, 255, 255, 1);border-width:0px;border-style:solid;display:flex;justify-content:center;margin:0 auto;position:relative;width:100%;z-index:1"><div class="builder-blocks-section-block-content" style="margin:0px -20px 0px -20px;max-width:1200px;padding:20px 20px 20px 20px;width:1200px"><!-- wp:heading -->
		<h2>Error 404</h2>
		<!-- /wp:heading -->

		<!-- wp:paragraph -->
		<p>Sorry, that page couldn\'t be found, please check out one of the following pages:</p>
		<!-- /wp:paragraph -->

		<!-- wp:builder-blocks/nav /--></div></div>
		<!-- /wp:builder-blocks/section -->

		<!-- wp:paragraph -->
		<p></p>
		<!-- /wp:paragraph -->';

		$args = [
			'post_content' => $content,
			'post_status'  => 'publish',
			'post_title'   => '404',
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
	 * Adds option for the 404 page
	 *
	 * @return bool whether option is added
	 */
	public static function add_option( int $post_id ) {
		return add_option( 'builder_blocks_404_post_id', $post_id );
	}

	/**
	 * Gets option for the 404 page
	 *
	 * @return string|bool the option or false if it doesn't exit
	 */
	public static function get_option() {
		return get_option( 'builder_blocks_404_post_id' );
	}

	/**
	 * Adds header menu item
	 *
	 * @return void
	 */
	public static function builder_blocks_add_404_menu_item() {
		add_submenu_page( 'themes.php', '404', '404', 'manage_options', 'builder-blocks-theme-404', '__return_false' );
	}

	/**
	 * Redirects header menu page to edit post.
	 *
	 * @return void
	 */
	public static function builder_blocks_404_redirect() {
		$post_id = get_option( 'builder_blocks_404_post_id' );

		if ( isset( $_GET['page'] ) && $_GET['page'] === 'builder-blocks-theme-404' ) {
			wp_safe_redirect( get_home_url() . '/wp-admin/post.php?post=' . $post_id . '&action=edit', 301 );
			exit;
		}
	}
}
