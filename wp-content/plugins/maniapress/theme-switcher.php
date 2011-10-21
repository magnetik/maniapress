<?php
/*
  Plugin Name: ManiaPress Theme Switcher
  Plugin URI: http://code.google.com/p/maniapress/
  Description: This plugin is part of ManiaPress: a suite to display your WordPress install directly in Maniaplanet. This plugin automatically selects the ManiaPress theme when accessing a page in the Manialink browser of Maniaplanet, based on the User Agent.
  Version: beta
  Author: Nadeo
  Author URI: http://www.nadeo.com
  License: LGPL v3
 */

require_once __DIR__.'/core.php';

function maniapress_theme_switcher_activate()
{
	require_once ABSPATH.'wp-admin/includes/plugin.php';
	
	if(!is_plugin_active('maniapress/core.php'))
	{
		$message = 'It seems the ManiaPress Core plugin is not activated. Please <strong>activate the ManiaPress Core plugin</strong> before using other components of ManiaPress';
		trigger_error($message, E_USER_ERROR);
	}
}

register_activation_hook(__FILE__, 'maniapress_theme_switcher_activate');

function maniapress_check_user_agent()
{
	if(array_key_exists('maniapress', $_GET))
	{
		return (bool) $_GET['maniapress'];
	}
	return ManiaLib\Application\Filters\UserAgentCheck::isManiaplanet();
}

function maniapress_installed()
{
	return is_dir(MANIAPRESS_THEME_PATH);
}

function maniapress_template($theme)
{
	if(maniapress_installed())
	{
		return apply_filters('maniapress_template', MANIAPRESS_THEME);
	}
	else
	{
		return $theme;
	}
}

if(maniapress_check_user_agent())
{
	add_filter('template', 'maniapress_template');
	add_filter('option_template', 'maniapress_template');
	add_filter('option_stylesheet', 'maniapress_template');
}
?>