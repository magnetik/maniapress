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

get_header('single');

if(have_posts())
{
	the_post();

	Manialink::beginFrame(-95, 47, 0.2);
	Manialink::setFrameId('post-'.get_the_ID());
	{
		$ui = new Label(190);
		$ui->setScale(1.5);
		$ui->setStyle(Label::TextButtonBig);
		$ui->setText(the_title('$000', '', false));
		$ui->save();

		$ui = new Label(190);
		$ui->setPosition(0, -12);
		$ui->enableAutonewline();
		$ui->setMaxline(21);
		$ui->setTextColor('000');
		$ui->setTextSize(2);
		$ui->setText(maniapress_html_filter(get_the_content()));
		$ui->save();

		$ui = new \ManiaLib\Gui\Elements\Button();
		$ui->setHalign('center');
		$ui->setPosition(95, -120, 0.1);
		$ui->setStyle(\ManiaLib\Gui\Elements\Button::CardButtonSmallWide);
		$ui->setUrl(ManiaLib\Utils\URI::getCurrent());
		$ui->setText('View the full page on the Web');
		$ui->save();
	}
	Manialink::endFrame();
}
else
{
	// Apologies, but no results were found for the requested archive. Perhaps searching will help find a related post.
}

get_sidebar('single');

get_footer('single');
?>