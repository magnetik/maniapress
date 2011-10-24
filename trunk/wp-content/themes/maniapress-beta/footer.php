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
use ManiaLib\Gui\Elements\Icons64x64_1;

Manialink::beginFrame(-100, -83, 0.2);
{
	$ui = new Label(175);
	$ui->setValign('center2');
	$ui->setPosition(3, -3.5, 0);
	$ui->setScale(0.75);
	$ui->setStyle(Label::TextInfoSmall);
	$ui->setText(sprintf('$<$000%s$> is proudly powered by WordPress and ManiaPress.',
			maniapress_get_bloginfo('name')));
	$ui->save();

	Manialink::beginFrame(188, -1, 0.1);
	{
		$ui = new Icons64x64_1(5);
		$ui->setSubStyle(Icons64x64_1::ToolUp);
		$ui->setScriptEvents();
		$ui->setId('view-external');
		//$ui->setUrl(ManiaLib\Utils\URI::getCurrent());
		$ui->save();

		Manialink::appendScript(sprintf('manialib_ui_autotip2("view-external", "%s"); ',
				addslashes('Visit the Website')));
		Manialink::appendScript(sprintf('manialib_ui_dialog2("view-external", "%s", "external", "%s");',
				addslashes('Do you want to open your Web browser to visit this Website?'),
				addslashes(\ManiaLib\Utils\URI::getCurrent())));

		$ui = new Icons64x64_1(5);
		$ui->setPosition(5.5);
		$ui->setSubStyle(Icons64x64_1::Refresh);
		$ui->setScriptEvents();
		$ui->setId('refresh-button');
		//$ui->setManialink(ManiaLib\Utils\URI::getCurrent());
		$ui->save();

		Manialink::appendScript(sprintf('manialib_ui_autotip2("refresh-button", "%s");',
				addslashes('Refresh')));
		Manialink::appendScript(sprintf('manialib_ui_addlink("refresh-button", "%s");',
				addslashes(\ManiaLib\Utils\URI::getCurrent())));
	}
	Manialink::endFrame();
}
Manialink::endFrame();

Manialink::appendScript('manialib_main_loop();}');

Manialink::render();
?>