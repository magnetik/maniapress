<?php
/*
  Plugin Name: ManiaPress Core
  Plugin URI: http://code.google.com/p/maniapress/
  Description: This plugin is part of ManiaPress: a suite to display your WordPress install directly in Maniaplanet. This plugin needs to be activated before you use other plugins or the theme.
  Version: beta
  Author: Nadeo
  Author URI: http://www.nadeo.com
  Tags: ubisoft, nadeo, maniaplanet, trackmania, shootmania, questmania, manialink
  License: LGPL v3
 */

define('MANIAPRESS_THEME', 'maniapress-beta');
define('MANIAPRESS_CORE_PATH', ABSPATH.'/wp-content/plugins/maniapress-core/');
define('MANIAPRESS_THEME_PATH',
	ABSPATH.'/wp-content/themes/'.MANIAPRESS_THEME.'/');

define('APP_PATH', MANIAPRESS_CORE_PATH);

require_once MANIAPRESS_CORE_PATH.'libraries/autoload.php';
?>