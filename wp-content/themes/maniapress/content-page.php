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

Manialink::beginFrame(-95, 47, 0.2);
Manialink::setFrameId('post-'.get_the_ID());
{
	$ui = new Label(190);
	$ui->setScale(1.5);
	$ui->setStyle(Label::TextButtonBig);
	$ui->setText('$000'.maniapress_html_filter(the_title('', '', false)));
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
?>