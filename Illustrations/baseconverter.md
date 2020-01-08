# Convert number between ways of expression. For example: Decimal to Binary.

## [Demo](http://ruslan-website.com/misc/baseconverter.php)

```php
<?php
if(isset($_POST['number'])&&isset($_POST['base'])){
	$value= $_POST['number'];
	$numberBase= $_POST['base'];
	
	$finalResult=integerToString($value, $numberBase);
	echo "<p><br>The result is: ".$finalResult."<br></p>";	
}

function integerToString($value, $numberBase){	
	$result="";
	while($value!=0){
		$remainder=$value%$numberBase;
		
		switch ($remainder) {
		  case 10:
			$remainder='A';
			continue;
		  case 11:
			$remainder='B';
			continue;
		  case 12:
			$remainder='C';
			continue;
		  case 13:
			$remainder='D';
			continue;
		  case 14:
			$remainder='E';
			continue;
		  case 15:
			$remainder='F';
			continue;	
		}	
	
		$result=$remainder.$result;
		$value=$value/$numberBase;
		$value=floor($value);
	}
	return $result;
}	
?>

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap-theme.min.css">
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
		
<form role="form" action="" method="post">
	<label>Number: </label><input type='number' class="form-control" name='number' min="1" value='10' />
	<label>Base: </label><input type='number' class="form-control" name='base' min="2" max="16" value='10' />                           
	<input type='submit' class="btn btn-default" value='Convert' /> 
</form>		
```
