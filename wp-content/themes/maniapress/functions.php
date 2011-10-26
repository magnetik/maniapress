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

require_once ABSPATH.'wp-content/plugins/maniapress-core/maniapress-core.php';

require_once __DIR__.'/include/config.php';

// TODO MANIAPRESS Add check to see if ManiaPress Core is enabled

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
	if(!$input)
	{
		return '';
	}
	
	$xslt = <<<'XSLT'
<?xml version="1.0" encoding="UTF-8"?>
<xsl:stylesheet xmlns:xsl="http://www.w3.org/1999/XSL/Transform" version="1.0">
	<xsl:output method="text"  encoding="utf-8" />
	<xsl:template match="h1|h2">$&lt;$o<xsl:apply-templates/>$&gt;&#10;</xsl:template>
	<xsl:template match="h3|h4|h5|h6">$&lt;$o$n<xsl:apply-templates/>$&gt;&#10;</xsl:template>
	<xsl:template match="b|strong|em">$&lt;$o<xsl:apply-templates/>$&gt;</xsl:template>
	<xsl:template match="i">$&lt;$i<xsl:apply-templates/>$&gt;</xsl:template>
	<xsl:template match="p"><xsl:apply-templates/>&#10;</xsl:template>
	<xsl:template match="a">$&lt;$l[<xsl:value-of select="@href"/>]<xsl:apply-templates/>$l$&gt;</xsl:template>
	<xsl:template match="img">$&lt;$l<xsl:value-of select="@src"/>$l$&gt;</xsl:template>
	<xsl:template match="span|font"><xsl:apply-templates/></xsl:template>
</xsl:stylesheet>
XSLT;
	
	$doc = new DOMDocument('1.0', 'UTF-8');
	$doc->loadHTML($input);

	$xsl = new DOMDocument('1.0', 'UTF-8');
	$xsl->loadXML($xslt);

	$proc = new XSLTProcessor();
	$proc->importStylesheet($xsl);

	$input = $proc->transformToXml($doc);
	
	return $input;
}

// Configure WordPress
add_filter('pre_get_posts', 'maniapress_posts_per_page');
add_theme_support('menus');

// Configure ManiaLib
$config = ManiaLib\Application\Config::getInstance();
$config->mediaURL = get_bloginfo('template_directory').'/';

?>