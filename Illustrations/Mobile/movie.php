<?php

require('../conn.php');       

function database_conn()
{
	try 
	{
		$dsn = DB_DRIVER.":host=".DB_SERVER.";dbname=".DB_DATABASE.";charset=UTF8";
		$dbh = new PDO($dsn, DB_USERNAME, DB_PASSWORD);
		$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);	

		return $dbh;
	} 
	catch (PDOException $exception) 
	{
		echo json_encode('[]');
		//echo $exception;		
	}	
}

function getBaseUrl()
{
	$baseUrl = $_SERVER['REQUEST_SCHEME'] . '://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
	$urlParts = explode('/', $baseUrl);
	array_pop($urlParts);
	$baseUrl = implode('/', $urlParts);
	$baseUrl .= '/';
	
	return $baseUrl;
}

if ($_SERVER['REQUEST_METHOD'] === 'GET') 
{
	$conn = database_conn();
	$sql = "SELECT title, year, image FROM movies";

	if ($_GET['keyword'])
	{
		$sql .= " WHERE title LIKE :keyword";
		$keyword = "%" . $_GET['keyword'] . "%";
		$sth = $conn->prepare($sql);
		$sth->bindParam(':keyword', $keyword, PDO::PARAM_STR);
	}
	else
	{
		$sth = $conn->prepare($sql);
	}

	header("Content-Type: application/json; charset=UTF-8");
	
	if ($sth->execute()) 
	{
		$movies = $sth->fetchAll(PDO::FETCH_ASSOC);
		
		echo json_encode($movies);
	} 
	else 
	{
		echo json_encode('[]');
	}
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') 
{
	//$file_path = "/var/www/vhosts/ruslan-website.com/httpdocs/misc/api/uploads/";
	$file_path = $_SERVER['DOCUMENT_ROOT'] . '/misc/api/uploads/';

	$title = $_POST["title"];
	$year = $_POST["year"];
	$image = '';
	
	if ($_FILES['uploaded_image'])
	{
		$file_name = basename( $_FILES['uploaded_image']['name'] );
		$dest = $file_path . $file_name;
		
		if(!move_uploaded_file($_FILES['uploaded_image']['tmp_name'], $dest)) 
		{
			echo json_encode(['code' => 2, 'message' => 'multipart post failure']);
			
			return;
		}
		
		$image = getBaseUrl() . 'uploads/' . $file_name;
	}
	
	$conn = database_conn();
	$sql = "INSERT INTO movies(title, year, image) VALUES(:title, :year, :image)";
	$sth = $conn->prepare($sql);
	$sth->bindParam(':title', $title, PDO::PARAM_STR);
	$sth->bindParam(':year', $year, PDO::PARAM_INT);
	$sth->bindParam(':image', $image, PDO::PARAM_STR);
	
	if (!$sth->execute()) 
	{
		echo json_encode(['code' => 1, 'message' => 'post failure']);
	}
		
	echo json_encode(['code' => 0, 'message' => 'post success']);
}
	
?>