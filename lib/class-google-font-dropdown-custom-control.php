<?php

if ( ! class_exists( 'WP_Customize_Control' ) ) {
	return null;
}

/**
 * A class to create a dropdown for all google fonts
 */
class Google_Font_Dropdown_Custom_Control extends WP_Customize_Control {

	/**
	 * Private var $fonts
	 *
	 * @var bool $fonts
	 */
	private $fonts = false;

	/**
	 * Constructor
	 *
	 * @param object $manager - Builder Blocks.
	 * @param int    $id - the id.
	 * @param array  $args - the arguments.
	 * @param array  $options - options.
	 *
	 * @return void
	 */
	public function __construct( $manager, $id, $args = [], $options = [] ) {
		$this->fonts = $this->get_fonts();
		parent::__construct( $manager, $id, $args );
	}

	/**
	 * Render the content of the category dropdown
	 *
	 * @return void
	 */
	public function render_content() {
		if ( ! empty( $this->fonts ) ) {
			?>
				<label>
					<span class="customize-category-select-control"><?php echo esc_html( $this->label ); ?></span>
					<select <?php $this->link(); ?>>
						<?php
						foreach ( $this->fonts as $k => $v ) {
							printf( '<option value="%s" %s>%s</option>', esc_attr( $v->family ), selected( $this->value(), esc_attr( $k ), false ), esc_attr( $v->family ) );
						}
						?>
					</select>
				</label>
			<?php
		}
	}

	/**
	 * Get the google fonts from the API or in the cache
	 *
	 * @param int $amount - number of fonts to get.
	 *
	 * @return String
	 */
	public function get_fonts( $amount = 30 ) {

		$font_file = __DIR__ . '/cache/google-web-fonts.txt';

		// Total time the file will be cached in seconds, set to a week.
		$cachetime = 86400 * 7;

		if ( file_exists( $font_file ) && $cachetime < filemtime( $font_file ) ) {
			$content = json_decode( file_get_contents( $font_file ) );
		} else {

			$google_api = 'https://www.googleapis.com/webfonts/v1/webfonts?sort=popularity&key={API_KEY}';

			$font_content = wp_remote_get( $google_api, array( 'sslverify' => false ) );

			$fp = fopen( $font_file, 'w' );
			fwrite( $fp, $font_content['body'] );
			fclose( $fp );

			$content = json_decode( $font_content['body'] );
		}

		if ( 'all' === $amount ) {
			return $content->items;
		} else {
			return array_slice( $content->items, 0, $amount );
		}
	}
}
