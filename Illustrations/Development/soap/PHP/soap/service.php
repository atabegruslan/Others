<?php

// https://www.youtube.com/playlist?list=PLI5t0u6ye3FG1GId9ZDqRZVJsyVwjpeT6
// https://sourceforge.net/projects/nusoap/

require 'functions.php';
require 'lib/nusoap.php';

$server = new nusoap_server();//function name
$server->configureWSDL('soap', 'urn:soap');//inputs
$server->register('price', ['name'=>'xsd:string'], ['return'=>'xsd:integer']);//outputs

//$HTTP_RAW_POST_DATA = isset($HTTP_RAW_POST_DATA) ? $HTTP_RAW_POST_DATA : '';
//$server->service($HTTP_RAW_POST_DATA);
@$server->service(file_get_contents("php://input"));
