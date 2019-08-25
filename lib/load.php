<?php

require_once __DIR__ . '/class-header-template.php';
require_once __DIR__ . '/class-footer-template.php';
require_once __DIR__ . '/class-builder-blocks-customizer.php';
require_once __DIR__ . '/class-builder-blocks-theme-assets.php';

Header::init();
Footer::init();
Builder_Blocks_Customizer::init();
Builder_Blocks_Theme_Assets::init();

require_once __DIR__ . '/template-functions.php';
