<?php
/**
 * @copyright   Copyright (c) 2009-2011 NADEO (http://www.nadeo.com)
 * @version     $Revision$:
 * @author      $Author$:
 * @date        $Date$:
 */

use ManiaLib\Gui\Manialink;
use ManiaLib\Gui\Elements\Bgs1;
use ManiaLib\Gui\Elements\Label;

/*<header class="page-header">
<h1 class="page-title">
<?php if ( is_day() ) : ?>
<?php  ?>
<?php elseif ( is_month() ) : ?>
<?php printf( __( 'Monthly Archives: %s', 'twentyeleven' ), '<span>' . get_the_date( 'F Y' ) . '</span>' ); ?>
<?php elseif ( is_year() ) : ?>
<?php printf( __( 'Yearly Archives: %s', 'twentyeleven' ), '<span>' . get_the_date( 'Y' ) . '</span>' ); ?>
<?php else : ?>
<?php _e( 'Blog Archives', 'twentyeleven' ); ?>
<?php endif; ?>
</h1>
</header>*/

get_header();

if(is_day())
{
	$archive = sprintf('Daily Archives: %s', get_the_date());
}
elseif(is_month())
{
	$archive = sprintf('Monthly Archives: %s', get_the_date('F Y'));
}
elseif(is_year())
{
	$archive = sprintf('Yearly Archives: %s', get_the_date('Y'));
}
elseif(is_category())
{
	$archive = sprintf('Category Archives: %s', single_cat_title( '', false ));
}
elseif(is_tag())
{
	$archive = sprintf('Tag Archives: %s', single_cat_title( '', false ));
}

Manialink::beginFrame(-95, 55, 0.2);
{
	$ui = new \ManiaLib\Gui\Elements\UIConstructionSimple_Buttons(5);
	$ui->setSubStyle(\ManiaLib\Gui\Elements\UIConstructionSimple_Buttons::Directory);
	$ui->save();
	
	$ui = new Label(190/1.5);
	$ui->setScale(1.5);
	$ui->setPosition(7, -1, 0.1);
	$ui->setStyle(Label::TextButtonSmall);
	$ui->setText('$333'.$archive);
	$ui->save();
}
Manialink::endFrame();



Manialink::beginFrame(0, -5, 0);
{
	require __DIR__.'/include/list.php';
}
Manialink::endFrame();

get_sidebar();
get_footer();


?>