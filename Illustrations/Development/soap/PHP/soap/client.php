<?php

require 'lib/nusoap.php';

$client = new nusoap_client('http://localhost/soap/service.php?wsdl');

$book_name = 'abc';

$response = $client->call('price', ['name' => $book_name]);

if (empty($response))
{
	echo 'unavailible';
}
else
{
	echo $response;
}
