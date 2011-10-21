<?php
/**
 * ManiaPress: a suite to display your WordPress install directly in Maniaplanet.
 * 
 * @see         http://code.google.com/p/maniapress/
 * @copyright   Copyright (c) 2011-2012 NADEO (http://www.nadeo.com)
 * @license     http://www.gnu.org/licenses/lgpl.html LGPL License 3
 * @version     $Revision$:
 * @author      $Author$:
 * @date        $Date$:
 */
define('MANIAPRESS_THEME', 'maniapress-beta');
define('MANIAPRESS_CORE_PATH', ABSPATH.'/wp-content/plugins/maniapress/');
define('MANIAPRESS_THEME_PATH',
	ABSPATH.'/wp-content/themes/'.MANIAPRESS_THEME.'/');

define('APP_PATH', MANIAPRESS_CORE_PATH);

require_once MANIAPRESS_CORE_PATH.'libraries/autoload.php';

?>