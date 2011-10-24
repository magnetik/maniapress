<?php
/*
  Plugin Name: ManiaPress Core
  Plugin URI: http://code.google.com/p/maniapress/
  Description: This plugin is part of ManiaPress: a suite to display your WordPress install directly in Maniaplanet. No need to activated, files are automatically required.
  Version: beta
  Author: Nadeo
  Author URI: http://www.nadeo.com
  Tags: ubisoft, nadeo, maniaplanet, trackmania, shootmania, questmania, manialink
  License: LGPL v3
 */

define('MANIAPRESS_THEME', 'maniapress');
define('MANIAPRESS_CORE_PATH', ABSPATH.'/wp-content/plugins/maniapress-core/');
define('MANIAPRESS_THEME_PATH',
	ABSPATH.'/wp-content/themes/'.MANIAPRESS_THEME.'/');

define('APP_PATH', MANIAPRESS_CORE_PATH);

require_once MANIAPRESS_CORE_PATH.'libraries/autoload.php';
require_once MANIAPRESS_CORE_PATH.'config.php';

?>