# Database

```
CREATE TABLE `countries` (
	`id` int(11) NOT NULL AUTO_INCREMENT,
	`country` varchar(100) NOT NULL DEFAULT '',
	PRIMARY KEY (`id`)
);

INSERT INTO `countries` VALUES (1,'Afghanistan'),(2,'Albania'),(3,'Algeria');
```

# Backend

`autosugg.php`

```php
require('conn.php');       

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

if ($_GET['callback'])
{
	header("Content-Type: application/javascript; charset=UTF-8");
}
else
{
	header("Content-Type: application/json; charset=UTF-8");
}

$conn = database_conn();
$sql = "SELECT country FROM countries";

if ($_GET['page_size'])
{
	$sql .= " LIMIT " . $_GET['page_size'];
}

$sth = $conn->prepare($sql);

if ($sth->execute()) 
{
	$countries = $sth->fetchAll(PDO::FETCH_COLUMN, 0);
	$countries = implode($countries, '","');
	$countries = '["' . $countries . '"]';
	
	if ($_GET['callback'])
	{
		echo $_GET['callback']."(".json_encode($countries).");";
	}
	else
	{
		echo json_encode($countries);
	}
} 
else 
{
	echo json_encode('[]');
}
```

# Frontend

```html
<!DOCTYPE html>
<html>
	<head>

		<title>JSONP and jQuery UI Autosuggest</title>

		<link rel="stylesheet" href="http://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
		<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
		<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

		<style>
			body {
				font-family: Arial, Helvetica, sans-serif;
			}

			table {
				font-size: 1em;
			}

			.ui-draggable, .ui-droppable {
				background-position: top;
			}
		</style>

	</head>

	<body>

		<div class="ui-widget">
			<label for="countries">Countries: </label>
			<input id="countries">
		</div>

		<!-- https://www.w3schools.com/js/js_json_jsonp.asp -->
		<script>
			function getCountries(data) 
			{
				window.countries = data;
			}
		</script>
		<script src="https://ruslan-website.com/misc/autosugg/autosugg.php?callback=getCountries"></script>
		<script>
			// https://jqueryui.com/autocomplete/  
			$(function() {
				var countries = JSON.parse(window.countries);

				$( "#countries" ).autocomplete({
					source: countries
				});
			});
		</script>

	</body>
</html>
```
