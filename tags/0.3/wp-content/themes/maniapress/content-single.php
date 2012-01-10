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
use ManiaLib\ManiaScript\UI;

Manialink::beginFrame(-95, 47, 0.2);
Manialink::setFrameId('post-'.get_the_ID());
{
	$ui = new Label(190);
	$ui->setScale(1.5);
	$ui->setStyle(Label::TextButtonBig);
	$ui->setText('$000'.maniapress_html_filter(the_title('', '', false))); //
	$ui->save();

	Manialink::beginFrame(153, 1, 0.1);
	{
		$ui = new ManiaLib\Gui\Elements\Bgs1(30, 7);
		$ui->setSubStyle(ManiaLib\Gui\Elements\Bgs1::BgList);
		$ui->save();

		$ui = new Label(23);
		$ui->setPosition(2, -2, 0.1);
		$ui->setText(maniapress_get_comments_number());
		$ui->setStyle(Label::TextButtonMedium);
		$ui->setUrl(ManiaLib\Utils\URI::getCurrent());
		$ui->setScriptEvents();
		$ui->setId('comments-count');
		$ui->save();

		UI::tooltip('comments-count', 'Read the comments on the Web');

		$ui = new \ManiaLib\Gui\Elements\BgRaceScore2(13, 13);
		$ui->setPosition(25, 1.75, 0.1);
		$ui->setSubStyle(\ManiaLib\Gui\Elements\BgRaceScore2::Speaking);
		$ui->save();
	}
	Manialink::endFrame();

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
	$ui->setPosition(95, -105, 0.1);
	$ui->setStyle(\ManiaLib\Gui\Elements\Button::CardButtonSmallWide);
	$ui->setUrl(ManiaLib\Utils\URI::getCurrent());
	$ui->setText('Read the full post on the Web');
	$ui->save();

	$categories = maniapress_get_categories(get_the_ID());
	$tags = maniapress_get_tags(get_the_ID());

	$metadata = sprintf(
		'This entry was written by %s, posted on %s at %s, filed under %s and tagged %s.',
		get_the_author(), the_date('', '', '', false), get_the_time(), $categories,
		$tags);

	$ui = new Label(190 / 1.25);
	$ui->setScale(1.25);
	$ui->setPosition(0, -115, 0);
	$ui->setStyle(Label::TextButtonSmall);
	$ui->setText($metadata);
	$ui->enableAutonewline();
	$ui->save();
}
Manialink::endFrame();
?>