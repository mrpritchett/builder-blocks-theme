<?php
/**
 * Adds theme functionality
 *
 * @package Builder Blocks Theme
 */

require_once __DIR__ . '/class-builder-blocks-theme-plugin-recommendation.php';
require_once __DIR__ . '/class-builder-blocks-theme-header.php';
require_once __DIR__ . '/class-builder-blocks-theme-footer.php';
require_once __DIR__ . '/class-builder-blocks-theme-404.php';
require_once __DIR__ . '/class-builder-blocks-customizer.php';
require_once __DIR__ . '/class-builder-blocks-theme-assets.php';

Builder_Blocks_Theme_Plugin_Recommendation::init();
Builder_Blocks_Theme_Header::init();
Builder_Blocks_Theme_Footer::init();
Builder_Blocks_Theme_404::init();
Builder_Blocks_Customizer::init();
Builder_Blocks_Theme_Assets::init();

require_once __DIR__ . '/template-functions.php';
