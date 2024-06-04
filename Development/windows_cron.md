# Cron on Windows

![](/Illustrations/Development/cron_windows_TaskScheduler.png)

`shellscript.vbs`
```
' cscript C:\xampp\htdocs\test\cron\shellscript.vbs

Set WinScriptHost = CreateObject("WScript.Shell")
WinScriptHost.Run Chr(34) & "C:\xampp\htdocs\test\cron\script1.bat" & Chr(34), 0
WinScriptHost.Run Chr(34) & "C:\xampp\htdocs\test\cron\script2.bat" & Chr(34), 0
Set WinScriptHost = Nothing

msgbox "Hello, " & "Testing"
```

`script1.bat`
```
C:\xampp\php\php.exe C:\xampp\htdocs\test\cron\script1.php test1
```

`script1.php`
```php
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
```

`script2.bat`
```
"C:\Users\Victor\curl\src\curl.exe" "http://localhost/test/cron/script2.php?testname=test2"
```

`script2.php`
```php
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
```

![](/Illustrations/Development/cron_windows_db.png)
