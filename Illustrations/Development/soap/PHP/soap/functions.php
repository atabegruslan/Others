<?php

function price($name)
{
	$details = ['abc'=>100, 'xyz'=>200];

	foreach ($details as $n => $p) 
	{
		if ($name === $n)
		{
			$price = $p;
		}
	}

	return $price;
}