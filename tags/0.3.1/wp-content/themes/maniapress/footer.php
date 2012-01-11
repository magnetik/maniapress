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
use ManiaLib\ManiaScript\UI;
use ManiaLib\ManiaScript\Action;
use ManiaLib\ManiaScript\Event;

Manialink::beginFrame(-100, -83, 0.2);
{
	$ui = new Label(175);
	$ui->setValign('center2');
	$ui->setPosition(3, -3.5, 0);
	$ui->setScale(0.75);
	$ui->setStyle(Label::TextInfoSmall);
	$ui->setText(sprintf('$<$000%s$> is proudly powered by $l[http://wordpress.org/]WordPress$l and $l[http://code.google.com/p/maniapress/]ManiaPress$l.',
			maniapress_get_bloginfo('name')));
	$ui->save();

	if(maniapress_get_option('manialink'))
	{
		Manialink::beginFrame(150, 1.5, 0.1);
		{
			$params['url'] = maniapress_get_option('manialink');
			if(maniapress_get_option('manialink-name'))
			{
				$params['name'] = maniapress_get_option('manialink-name');
			}
			$url = 'http://maniahome.maniaplanet.com/add/?'.http_build_query($params);

			$ui = new \ManiaLib\Gui\Elements\IncludeManialink();
			$ui->setUrl($url);
			$ui->save();
		}
		Manialink::endFrame();
	}

	Manialink::beginFrame(188, -1, 0.1);
	{
		$ui = new Icons64x64_1(5);
		$ui->setSubStyle(Icons64x64_1::ToolUp);
		$ui->setScriptEvents();
		$ui->setId('view-external');
		//$ui->setUrl(ManiaLib\Utils\URI::getCurrent());
		$ui->save();

		UI::tooltip('view-external', 'Visit the Website');
		Event::addListener('view-external', Event::mouseClick,
			array(Action::external, \ManiaLib\Utils\URI::getCurrent()));

		$ui = new Icons64x64_1(5);
		$ui->setPosition(5.5);
		$ui->setSubStyle(Icons64x64_1::Refresh);
		$ui->setScriptEvents();
		$ui->setId('refresh-button');
		//$ui->setManialink(ManiaLib\Utils\URI::getCurrent());
		$ui->save();

		UI::tooltip('refresh-button', 'Refresh');
		Event::addListener('refresh-button', Event::mouseClick,
			array(Action::manialink, \ManiaLib\Utils\URI::getCurrent()));
	}
	Manialink::endFrame();
}
Manialink::endFrame();

\ManiaLib\ManiaScript\Main::loop();
\ManiaLib\ManiaScript\Main::end();

Manialink::render();
?>