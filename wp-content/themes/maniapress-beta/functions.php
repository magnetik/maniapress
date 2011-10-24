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

define('APP_PATH', __DIR__.'/');

require_once APP_PATH.'libraries/autoload.php';

function maniapress_get_bloginfo($show = '')
{
	return htmlspecialchars_decode(get_bloginfo($show, 'display'), ENT_QUOTES);
}

function maniapress_posts_per_page($query)
{
	$query->query_vars['posts_per_page'] = 4;
    return $query;
}

function maniapress_get_categories($postId)
{
	$categories = get_the_category($postId);
	foreach($categories as $key => $category)
	{
		$categories[$key] = sprintf('$h[%s]%s$h',
			get_category_link($category->term_id), $category->name);
	}
	$categories = implode(', ', $categories);
	if($categories)
	{
		$categories = 'in '.$categories;
	}
	return $categories;
}

function maniapress_get_tags($postId)
{
	$tags = get_the_tags($postId);
	if($tags)
	{
		foreach ($tags as $key => $tag)
		{
			$tags[$key] = sprintf('$h[%s]%s$h', get_tag_link($tag->term_id), $tag->name);
		}
		$tags = 'in '.implode(', ', $tags);
	}
	return $tags;
}

function maniapress_get_comments_number()
{
	ob_start();
	comments_number();
	return ob_get_clean();
}

function maniapress_html_decode($input)
{
	$input = html_entity_decode($input, ENT_QUOTES, 'UTF-8');
	return $input;
}

function maniapress_html_filter($input)
{
	$input = strip_tags($input);
	return $input;
}

// Configure WordPress
add_filter('pre_get_posts', 'maniapress_posts_per_page');
add_theme_support('menus');

// Configure ManiaLib
$config = ManiaLib\Application\Config::getInstance();
$config->mediaURL = get_bloginfo('template_directory').'/';

?>