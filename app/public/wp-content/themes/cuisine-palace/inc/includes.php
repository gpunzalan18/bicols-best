<?php
/**
 * This file includes the other files.
 *
 * @package cuisine-palace
 */

/**
 * Exit if accessed directly.
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$cuisine_palace_theme_root = get_template_directory();

/**
 * Inc.
 */
require_once "{$cuisine_palace_theme_root}/inc/customizer/customizer.php";
require_once "{$cuisine_palace_theme_root}/inc/after-theme-setup.php";
require_once "{$cuisine_palace_theme_root}/inc/register-widget-areas.php";
require_once "{$cuisine_palace_theme_root}/inc/template-tags.php";
require_once "{$cuisine_palace_theme_root}/inc/template-functions.php";
require_once "{$cuisine_palace_theme_root}/inc/frontpage-sections.php";
require_once "{$cuisine_palace_theme_root}/inc/tgm-plugin/tgmpa-hook.php";

/**
 * Styles and Scripts.
 */
require_once "{$cuisine_palace_theme_root}/inc/classes/class-cuisine-palace-assets-loader.php";
