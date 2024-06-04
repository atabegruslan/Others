' cscript C:\xampp\htdocs\test\cron\shellscript.vbs

Set WinScriptHost = CreateObject("WScript.Shell")
WinScriptHost.Run Chr(34) & "C:\xampp\htdocs\test\cron\script1.bat" & Chr(34), 0
WinScriptHost.Run Chr(34) & "C:\xampp\htdocs\test\cron\script2.bat" & Chr(34), 0
Set WinScriptHost = Nothing

msgbox "Hello, " & "Testing"
