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

use ManiaLib\Gui\Manialink;
use ManiaLib\Gui\Elements\Label;

get_header();

if(have_posts())
{
	$layout = new \ManiaLib\Gui\Layouts\Column();
	$layout->setMarginHeight(1);

	Manialink::beginFrame(-95, 50, 0.2, 1, $layout);

	while(have_posts())
	{
		the_post();

		get_template_part('content', get_post_format());
	}
	Manialink::endFrame();

	$next = maniapress_html_decode(\ManiaLib\Utils\Arrays::get(explode('"', get_next_posts_link()), 1));
	$prev = maniapress_html_decode(\ManiaLib\Utils\Arrays::get(explode('"', get_previous_posts_link()), 1));

	$ui = new ManiaLib\Gui\Cards\PageNavigator();
	$ui->setPosition(0, -75, 0);
	$ui->arrowNext->setManialink($next);
	$ui->arrowPrev->setManialink($prev);
	$ui->save();
}
else
{
	$ui = new Label(120/1.5);
	$ui->setScale(1.5);
	$ui->setHalign('center');
	$ui->setPosition(0, 40, 0.2);
	$ui->enableAutonewline();
	$ui->setStyle(Label::TextButtonSmall);
	$ui->setText('Apologies, but no results were found for the requested archive. Perhaps searching will help find a related post.');
	$ui->save();
}

get_sidebar();
get_footer();

?>