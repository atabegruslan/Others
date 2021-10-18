<?php

require ('./smarty/libs/Smarty.class.php');

$smarty = new Smarty;
$smarty->caching = true;
$smarty->caching_lifetime = 120;
$smarty->template_dir = './templates';
$smarty->compile_dir = './templates_c';


