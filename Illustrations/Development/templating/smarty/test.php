<?php

require ('./smartyHeader.php');

$msg = 'Test msg';

$smarty->assign('msg', $msg);

$smarty->display('test.tpl');
