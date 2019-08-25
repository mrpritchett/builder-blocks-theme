<?php

class Footer {

	/**
	 * Adds Option for the Footer Block Post
	 *
	 * @return int post_id
	 */
	public static function init() {
		$post_id = self::get_option();

		if ( ! $post_id ) {
			$post = self::create_footer();

			$post_id = self::add_option( $post );
		}

		return $post_id;
	}

	/**
	 * Create the footer reusable block
	 *
	 * @return int the post id
	 */
	public static function create_footer() {
		$content = '';

		$args = [
			'post_title' => 'Footer',
			'post_content' => esc_html( $content ),
		];

		return wp_insert_post( $args );
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
}