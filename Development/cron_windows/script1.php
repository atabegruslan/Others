<?php

echo "Hello, testing 1";

$conn = mysqli_connect("localhost", "ruslan", "ruslan", "cron");

if (mysqli_connect_errno())
{
	die("Failed to connect to MySQL: " . mysqli_connect_error());
}

$testname = $argv[1] ? $argv[1] : 'Nameless 1';

mysqli_query($conn,"INSERT INTO cron (testname) VALUES ('". $testname ."')");

mysqli_close($conn);
