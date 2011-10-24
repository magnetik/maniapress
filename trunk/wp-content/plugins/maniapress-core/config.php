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
/**
 * Config for ManiaPress. Eventually it will be handled by an admin page, in the 
 * meantime we rely on a good old config file...
 */

/**
 * Your short Manialink code. You need it to display the bookmark button.
 * You can manage them at http://player.maniaplanet.com/
 */
define('MANIAPRESS_CORE_MANIALINK', null);

/**
 * Display name of your Manialink, leave null if you want to use the Manialink 
 * code as its display name.
 */
define('MANIAPRESS_CORE_MANIALINK_NAME', null);

/**
 * Your API credentials. You need them if you want to use the Event Publisher 
 * plugin.
 */
define('MANIAPRESS_CORE_API_USERNAME', null);
define('MANIAPRESS_CORE_API_PASSWORD', null);

?>