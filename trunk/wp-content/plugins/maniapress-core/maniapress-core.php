<?php
/*
  Plugin Name: ManiaPress Core
  Plugin URI: http://code.google.com/p/maniapress/
  Description: This plugin is part of ManiaPress: a suite to display your WordPress install directly in Maniaplanet. No need to activate it, files are automatically required.
  Version: beta2
  Author: Nadeo
  Author URI: http://www.nadeo.com
  Tags: ubisoft, nadeo, maniaplanet, trackmania, shootmania, questmania, manialink
  License: LGPL v3
 */

define('MANIAPRESS_THEME', 'maniapress');
define('MANIAPRESS_CORE_PATH', ABSPATH.'/wp-content/plugins/maniapress-core/');
define('MANIAPRESS_THEME_PATH',
	ABSPATH.'/wp-content/themes/'.MANIAPRESS_THEME.'/');

require_once MANIAPRESS_CORE_PATH.'libraries/autoload.php';

function maniapress_get_option($name, $default = null)
{
	$options = get_option('maniapress-options');
	if(is_array($options) && array_key_exists($name, $options))
	{
		return $options[$name];
	}
	return $default;
}

add_action('admin_menu', 'maniapress_core_admin_add_page');

function maniapress_core_admin_add_page()
{
	add_options_page('ManiaPress Settings', 'ManiaPress', 'manage_options',
		'maniapress-settings', 'maniapress_core_settings_page');
}

function maniapress_core_settings_page()
{
	?>
	<div class="wrap">
		<div id="icon-options-general" class="icon32"><br /></div><h2>ManiaPress Settings</h2>
		<p><b>Need help?</b> Don't hesitate to check out 
			<a href="http://code.google.com/p/maniapress/" target="_blank">the Wiki on the projects' Website</a> 
			or to <a href="http://forum.maniaplanet.com/viewforum.php?f=330" target="_blank">ask your questions in the forum</a>!</p>
		<form action="options.php" method="post">
			<?php settings_fields('maniapress-options'); ?>
			<?php do_settings_sections('maniapress-settings'); ?>
			<p class="submit">
				<input name="submit" type="submit" id="submit" class="button-primary" 
					   value="<?php esc_attr_e('Save Changes'); ?>" />
			</p>
		</form>
	</div>
	<?php
}

add_action('admin_init', 'maniapress_core_admin_init');

function maniapress_core_admin_init()
{
	register_setting('maniapress-options', 'maniapress-options',
		'maniapress_core_settings_validate');
	add_settings_section('maniapress-settings-general', 'General Settings',
		'maniapress_core_settings_general_text', 'maniapress-settings');
	add_settings_field('maniapress-manialink', 'Manialink',
		'maniapress_core_settings_manialink_input', 'maniapress-settings',
		'maniapress-settings-general');
	add_settings_field('maniapress-manialink-name', 'Manialink display name',
		'maniapress_core_settings_manialink_name_input', 'maniapress-settings',
		'maniapress-settings-general');
	add_settings_section('maniapress-settings-theme', 'Theme Settings',
		'maniapress_core_settings_theme_text', 'maniapress-settings');
	add_settings_field('maniapress-theme-background', 'Background',
		'maniapress_core_settings_background_input', 'maniapress-settings',
		'maniapress-settings-theme');
	add_settings_field('maniapress-theme-header-bg', 'Header background color',
		'maniapress_core_settings_header_input', 'maniapress-settings',
		'maniapress-settings-theme');
	add_settings_field('maniapress-theme-content-bg', 'Content background color',
		'maniapress_core_settings_content_input', 'maniapress-settings',
		'maniapress-settings-theme');
	add_settings_field('maniapress-theme-footer-bg', 'Footer background color',
		'maniapress_core_settings_footer_input', 'maniapress-settings',
		'maniapress-settings-theme');
	add_settings_section('maniapress-settings-event-publishing',
		'Event Publishing Settings', 'maniapress_core_settings_event_publishing_text',
		'maniapress-settings');
	add_settings_field('maniapress-api-username', 'API Username',
		'maniapress_core_settings_api_username_input', 'maniapress-settings',
		'maniapress-settings-event-publishing');
	add_settings_field('maniapress-api-password', 'API Password',
		'maniapress_core_settings_api_password_input', 'maniapress-settings',
		'maniapress-settings-event-publishing');
}

function maniapress_core_settings_validate($settings)
{
	$newsettings = array();
	$newsettings['manialink'] = \ManiaLib\Utils\Arrays::get($settings, 'manialink');
	$newsettings['manialink-name'] = \ManiaLib\Utils\Arrays::get($settings, 'manialink-name');
	$newsettings['api-username'] = \ManiaLib\Utils\Arrays::get($settings, 'api-username');
	$newsettings['api-password'] = \ManiaLib\Utils\Arrays::get($settings, 'api-password');
	$newsettings['theme-background'] = \ManiaLib\Utils\Arrays::get($settings, 'theme-background');
	$newsettings['theme-header'] = \ManiaLib\Utils\Arrays::get($settings, 'theme-background');
	
	return $settings;
}

function maniapress_core_settings_general_text()
{
	
}

function maniapress_core_settings_manialink_input()
{
	?>
	<input id="maniapress-manialink" name="maniapress-options[manialink]"
		   size="25" type="text" value="<?php echo maniapress_get_option('manialink') ?>" 
		   class="regular-text"/>
	<span class="description">Set you Manialink code and the ManiaHome bookmark button 
		will automatically appear on your Manialink. You can manage your manialink
		codes on the <a href="http://player.maniaplanet.com" target="_blank">the 
			player page</a></span>.
	<?php
}

function maniapress_core_settings_manialink_name_input()
{
	?>
	<input id="maniapress-manialink" name="maniapress-options[manialink-name]"
		   size="75" type="text" value="<?php echo maniapress_get_option('manialink-name') ?>" 
		   class="regular-text code"/>
	<span class="description">Display name of your Manialink on ManiaHome. You can
		use special formatting characters (like in nicknames).</span>
	<?php
}

function maniapress_core_settings_theme_text()
{
	echo '<p>Change the look-and-feel of your Manialink theme</p>';
}

function maniapress_core_settings_background_input()
{
	?>
	<input id="maniapress-theme-background" name="maniapress-options[theme-background]"
		   size="25" type="text" value="<?php echo maniapress_get_option('theme-background') ?>" 
		   class="regular-text"/>
	<span class="description">If empty, it uses the default image background. 
		Else, you can either specify <b>a background image URL or a background color</b>(3 chars format).</span>
	<?php
}

function maniapress_core_settings_header_input()
{
	?>
	<input id="maniapress-theme-header-bg" name="maniapress-options[theme-header-bg]"
		   size="4" type="text" value="<?php echo maniapress_get_option('theme-header-bg',
		'fff') ?>" 
		   class="small-text code"/>
	<span class="description">Colors use the 3 hex chars + 1 alpha hex char. See 
		<a href="http://tutorials.mania-creative.com/tm2_general_formattingtext/index-eng-1#colours" 
		   target="_blank">this tutorial</a>.</span>
		<?php
	}

	function maniapress_core_settings_content_input()
	{
		?>
	<input id="maniapress-theme-content-bg" name="maniapress-options[theme-content-bg]"
		   size="4" type="text" value="<?php echo maniapress_get_option('theme-content-bg',
			'fffa') ?>" 
		   class="small-text code"/>
		   <?php
	   }

	   function maniapress_core_settings_footer_input()
	   {
		   ?>
	<input id="maniapress-theme-footer-bg" name="maniapress-options[theme-footer-bg]"
		   size="4" type="text" value="<?php echo maniapress_get_option('theme-footer-bg',
		   'fff') ?>" 
		   class="small-text code"/>
		   <?php
	   }

	   function maniapress_core_settings_event_publishing_text()
	   {
		   wp_enqueue_script('jquery');
		   ?>
	<p>The Event Publishing is a really important feature. It will <b>automatically 
			notify the players that bookmarked your Manialink when you publish a 
			new Post by sending a public Event to ManiaHome</b>. Check out the 
		<a href="http://code.google.com/p/maniapress/wiki/GettingStarted#Event_Publishing" target="_blank">
			documentation to setup the event publishing</a>.
	</p>
	<p>
		API Test:
		<?php $test = maniapress_core_api_test(); ?>
		<?php if($test === null): ?>
			<span class="description">Set your credentials and click "Save changes" to test.</span>
	<?php elseif($test === false): ?>
			<b style="color: red">Error, please check your credentials.</b>
	<?php elseif($test === true): ?>
			<b  style="color: green">Success !</b>
	<?php endif ?>
	</p>
	<?php
}

function maniapress_core_api_test()
{
	if(!maniapress_get_option('api-username') || !maniapress_get_option('api-password'))
	{
		return null;
	}
	try
	{
		$players = new Maniaplanet\WebServices\Players(maniapress_get_option('api-username'), maniapress_get_option('api-password'));
		$players->get('gouxim');
		return true;
	}
	catch(Exception $e)
	{
		return false;
	}
}

function maniapress_core_settings_api_username_input()
{
	?>
	<input id="maniapress-api-username" name="maniapress-options[api-username]"
		   size="25" type="text" value="<?php echo maniapress_get_option('api-username') ?>" 
		   class="regular-text"/>
		   <?php
	   }

	   function maniapress_core_settings_api_password_input()
	   {
		   ?>
	<input id="maniapress-api-password" name="maniapress-options[api-password]"
		   size="25" type="password" value="<?php echo maniapress_get_option('api-password') ?>" 
		   class="regular-text"/>
	<?php
}
?>