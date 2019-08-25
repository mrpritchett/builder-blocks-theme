<?php

/**
 * Gets header markup
 *
 * @since 0.0.1
 * @return string the header markup
 */
function builder_blocks_get_block_header() {
	$post_id = get_option( 'builder_blocks_header_post_id' );
	$post = get_post( $post_id );
	return apply_filters( 'the_content', $post->post_content );
}

/**
 * Gets header markup
 *
 * @since 0.0.1
 * @return string the header markup
 */
function builder_blocks_get_block_footer() {
	$post_id = get_option( 'builder_blocks_footer_post_id' );
	$post = get_post( $post_id );
	return apply_filters( 'the_content', $post->post_content );
}