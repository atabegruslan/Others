- Enable Developer options on Android phone: Settings, About phone, tap Build number 7 times.
- Enable USB debugging: Settings, Developer options, turn this on, turn on Stay awake, turn on USB debugging.
- Connect device: Press Allow on phone. Set to the appropriate USB connect options on phone. Download necessary drivers if needed.

# Mac

- https://www.samsung.com/vn/apps/smart-switch/
- https://www.android.com/filetransfer/

# Windows

If you cant see your phone there or in AndroidStudio's Select Deployment Target window, the most likely cause is the driver. 

Start, Device Manager: If you see "other devices" with ADB Interface and Android Samsung under it with exclaimation icons beside them, then do:

- https://uptodrivers.com/samsung-galaxy-a01-usb-driver-free-download/90393/ (I have Samsung A01)
	- https://uptodrivers.com/android-usb-driver/ (Get Google USB Driver in Android Package Manager > SDK tools)
		- https://uptodrivers.com/adb-usb-drivers-free-download/ (NEED ADB Driver)
			- https://www.youtube.com/watch?v=171KC_K3W4E (Have to manually install ADB Driver)
		- https://developer.samsung.com/mobile/android-usb-driver.html (Get Android driver)

Manually install ADB Driver:

1. Device Manager
2. Right click on faulty ADB interface
3. Update Driver Software
4. Browse computer
5. Pick from a list of device drivers
6. Select the android_winusb.inf in the unzipped ADB driver that was downloaded from https://dl-ssl.google.com/android/repository/latest_usb_driver_windows.zip
7. Install
