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

	$input = htmlentities($input, ENT_QUOTES | ENT_IGNORE | ENT_HTML401, 'UTF-8', false);
	$input = str_ireplace(array('&lt;', '&gt;', '&quot;', '&#039;', '$'),array('<','>', '"', "'", '$$'), $input);

	// removing \n \t
	$input = strtr($input, array("\n" => null, "\t" => null));

	// uncomment to debug input
	//header("Content-type: text/plain; charset=UTF-8");
	//echo($input);exit;

	$xslt = <<<'XSLT'
<?xml version="1.0" encoding="UTF-8"?>
<xsl:stylesheet xmlns:xsl="http://www.w3.org/1999/XSL/Transform" version="1.0">
	<xsl:output method="text"  encoding="utf-8" />
	<xsl:template match="h1|h2"><xsl:text>$&lt;$o</xsl:text><xsl:apply-templates/><xsl:text>$&gt;&#10;</xsl:text></xsl:template>
	<xsl:template match="h3|h4|h5|h6"><xsl:text>$&lt;$o$n</xsl:text><xsl:apply-templates/><xsl:text>$&gt;&#10;</xsl:text></xsl:template>
	<xsl:template match="b|strong|em"><xsl:text>$&lt;$o</xsl:text><xsl:apply-templates/><xsl:text>$&gt;</xsl:text></xsl:template>
	<xsl:template match="i"><xsl:text>$&lt;$i</xsl:text><xsl:apply-templates/><xsl:text>$&gt;</xsl:text></xsl:template>
	<xsl:template match="p"><xsl:text>&#10;</xsl:text><xsl:apply-templates/><xsl:text>&#10;</xsl:text></xsl:template>
	<xsl:template match="a"><xsl:text>$&lt;$l[</xsl:text><xsl:value-of select="@href"/><xsl:text>]</xsl:text><xsl:apply-templates select="*[name!=img]"/><xsl:text>$l$&gt;</xsl:text></xsl:template>
	<xsl:template match="img"><xsl:text>$&lt;$l[</xsl:text><xsl:value-of select="@src"/><xsl:text>]</xsl:text><xsl:choose><xsl:when test="string-length(@alt)>0"><xsl:value-of select="@alt"/></xsl:when><xsl:when test="string-length(@title)>0"><xsl:value-of select="@title"/></xsl:when><xsl:otherwise><xsl:call-template name="getBaseName"><xsl:with-param name="filename" select="@src" /></xsl:call-template></xsl:otherwise></xsl:choose><xsl:text>$l$&gt;</xsl:text></xsl:template>
	<xsl:template match="span|font"><xsl:apply-templates/></xsl:template>
	<xsl:template match="li"><xsl:text>&#10;* </xsl:text><xsl:apply-templates/></xsl:template>
	<xsl:template match="ul"><xsl:apply-templates/><xsl:text>&#10;</xsl:text></xsl:template>
	<xsl:template name="getBaseName">
        <xsl:param name="filename" />
            <xsl:if test="not(contains($filename,'/'))">
                <xsl:value-of select="$filename"/>
            </xsl:if>
            <xsl:if  test="contains($filename,'/')">
                <xsl:call-template name="getBaseName">
                    <xsl:with-param name="filename" select="substring-after($filename,'/')"/>
                </xsl:call-template>
            </xsl:if>
    </xsl:template>
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