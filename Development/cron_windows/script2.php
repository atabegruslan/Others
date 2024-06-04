<?php

echo "Hello, testing 2";

$conn = mysqli_connect("localhost", "ruslan", "ruslan", "cron");

if (mysqli_connect_errno())
{
	die("Failed to connect to MySQL: " . mysqli_connect_error());
}

$testname = $_GET['testname'] ? $_GET['testname'] : 'Nameless 2';

mysqli_query($conn,"INSERT INTO cron (testname) VALUES ('". $testname ."')");

mysqli_close($conn);
