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
get_header('single');

if(have_posts())
{
	the_post();
	get_template_part('content', 'single');
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

get_sidebar('single');
get_footer('single');
?>