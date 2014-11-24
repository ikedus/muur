<?php 
include("./class.TemplatePower.inc.php");
$tpl = new TemplatePower("./template.tpl");
$tpl->prepare();

/*$tpl->newBlock('login');*/

/*$tpl->newBlock('topMenu');
$tpl->newBlock('topMenuLabel');
$tpl->newBlock('topMenuItem');
$tpl->newBlock('topMenuLabel');
$tpl->newBlock('topMenuItem');
$tpl->newBlock('topMenuItem');*/

$tpl->newBlock('gridIndex');
/*for ($i=0; $i < 5; $i++) { 
	$tpl->newBlock('item');
}*/


$tpl->printToscreen();
 ?>