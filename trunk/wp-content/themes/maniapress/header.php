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
use ManiaLib\Gui\Cards\Panel;
use ManiaLib\Gui\Elements\Label;
use ManiaLib\Gui\Elements\Quad;
use ManiaLib\Gui\Elements\Icons128x128_1;
use ManiaLib\Gui\Elements\Icons64x64_1;
use ManiaLib\Gui\Elements\UIConstructionSimple_Buttons;

Manialink::load();

$ui = new \ManiaLib\Gui\Elements\IncludeManialink();
$ui->setUrl('manialib.xml', false);
$ui->save();

$ui = new ManiaLib\Gui\Cards\ManiaScriptStandardElements();
$ui->save();

Manialink::appendScript('main() {');

$background = maniapress_get_option('theme-background');

$ui = new Quad(320, 180);
$ui->setAlign('center', 'center');
if($background)
{
	if(ctype_xdigit($background) && strlen($background) < 4)
	{
		$ui->setBgcolor($background);		
	}
	else
	{
		$ui->setImage($background, true);
	}
}
else
{
	$ui->setImage('bg.jpg');
}
$ui->save();

$ui = new \ManiaLib\Gui\Elements\Bgs1InRace(202, 200);
$ui->setPosition(0, 0, 0.09);
$ui->setAlign('center', 'center');
$ui->setSubStyle(\ManiaLib\Gui\Elements\Bgs1InRace::BgTitleShadow);
$ui->save();

Manialink::beginFrame(-100, 90, 0.1);
{
	$ui = new Quad(200, 28);
	$ui->setBgcolor(maniapress_get_option('theme-header-bg', 'fff'));
	$ui->save();

	$ui = new \ManiaLib\Gui\Elements\Quad(200, 145);
	$ui->setPosition(0, -28, 0);
	$ui->setBgcolor(maniapress_get_option('theme-content-bg', 'fffa'));
	$ui->save();

	$ui = new \ManiaLib\Gui\Elements\Quad(200, 7);
	$ui->setPosition(0, -173, 0);
	$ui->setBgcolor(maniapress_get_option('theme-footer-bg', 'fff'));
	$ui->save();

	Manialink::beginFrame(10, -5.5, 0.1);
	{
		$ui = new Icons128x128_1(15);
		$ui->setSubStyle(Icons128x128_1::Vehicles);
		$ui->save();

		$ui = new Label(100);
		$ui->setPosition(17, -2.5, 0);
		$ui->setScale(1.75);
		$ui->setStyle(Label::TextButtonBig);
		$ui->setText(maniapress_get_bloginfo('name'));
		$ui->save();

		$ui = new Label(150);
		$ui->setPosition(17, -9, 0.1);
		$ui->setStyle(Label::TextTips);
		$ui->setText(maniapress_get_bloginfo('description'));
		$ui->save();
	}
	Manialink::endFrame();
	
	Manialink::beginFrame(145, -8.5, 0.1);
	{
		$ui = new \ManiaLib\Gui\Elements\Entry(40, 5);
		$ui->setName('search');
		$ui->setDefault(\ManiaLib\Application\Request::getInstance()->get('s'));
		$ui->save();

		$ui = new Icons64x64_1(6);
		$ui->setPosition(41, 0.5);
		$ui->setSubStyle(Icons64x64_1::Maximize);
		$ui->setManialink(maniapress_get_bloginfo('url').'?s=search');
		$ui->save();
	}
	Manialink::endFrame();

	$layout = new ManiaLib\Gui\Layouts\Line();
	$layout->setMarginWidth(1);

	Manialink::beginFrame(10, -24, 0.2, 1, $layout);
	{
		// TODO MANIAPRESS Handle drop-down menus
		$menu = wp_get_nav_menu_object('manialink');
		if($menu)
		{
			$menu_items = wp_get_nav_menu_items($menu->term_id);
			foreach((array) $menu_items as $key => $menu_item)
			{
				$title = $menu_item->title;
				$url = $menu_item->url;

				$ui = new ManiaLib\Gui\Elements\Button();
				$ui->setText($menu_item->title);
				$ui->setManialink($menu_item->url);
				$ui->save();
			}
		}
		else
		{
			$ui = new ManiaLib\Gui\Elements\Button();
			$ui->setText('Home');
			$ui->setManialink(maniapress_get_bloginfo('url'));
			$ui->save();
		}
	}
	Manialink::endFrame();
}
Manialink::endFrame();
?>