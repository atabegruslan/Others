![](https://raw.githubusercontent.com/atabegruslan/JavaScript-Works/master/res/jqautosuggbe02.PNG)

```html
<head>
  <meta charset="utf-8">
  <title>jQuery UI Autocomplete</title>
  <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
  <script src="//code.jquery.com/jquery-1.10.2.js"></script>
  <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
  <script>
    
  function process(str){
	if( !(str.match(/[^a-z]/i) || str=='') ){
		var xmlhttp;
		
		try{
			if(window.ActiveXObject){
				xmlHttp = new ActiveXObject("Microsoft.XMLHTTP");
			}else{
				xmlhttp=new XMLHttpRequest();
			}
		}catch(e){alert('cant create XmlHttp Object!');}
		xmlhttp.onreadystatechange=function(){
			if(xmlhttp.readyState==4 && xmlhttp.status==200){
				var sugg = JSON.parse( xmlhttp.responseText );
				$( "#tags" ).autocomplete({
				  source: sugg
				});
			}
		}
		xmlhttp.open("GET","autosugg.php?substr="+str,true);
		xmlhttp.send();
	}
  }	

  </script>
</head>
<body>
 
<div class="ui-widget">
  <label for="tags">Enter a country's name beginning with B: </label>
  <input id="tags" onkeyup="process(this.value)" />
</div>
```

```php
<?php

include("conn.php");

$substr = preg_replace('/[^A-Za-z]/', '', $_GET["substr"] );

$dbh = database_conn();
$sql = "SELECT Country FROM country WHERE Country LIKE '{$substr}%'";
$sth = $dbh->prepare($sql);

if ( $sth->execute() ) {
	$result = $sth->fetchAll(PDO::FETCH_COLUMN, 0);
	echo json_encode($result);
} else {
	echo "";
}
?>
```

```php
<?php

define('DB_DRIVER', "mysql");
define('DB_SERVER', "localhost"); 
define('DB_DATABASE', "autosugg");   
define('DB_USERNAME', "root");
define('DB_PASSWORD', "");         

function database_conn(){
	try {
		$dsn = DB_DRIVER.":host=".DB_SERVER.";dbname=".DB_DATABASE.";charset=UTF8";
		$dbh = new PDO($dsn, DB_USERNAME, DB_PASSWORD);
		$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);	
		return $dbh;
	} catch (PDOException $exception) {
		echo $exception;		
	}	
}

?>
```

![](https://raw.githubusercontent.com/atabegruslan/JavaScript-Works/master/res/jqautosuggbe01.PNG)
