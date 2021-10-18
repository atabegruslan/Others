# Open Android Apps from Web

- https://developer.android.com/training/app-links

1. On web side:
```html
<a href="app.travelblog://param1/param2/param3"><h1>Open in App</h1></a>
```

2. On Android side:

`AndroidManifest.xml`
```xml
<manifest ...
    package="com.ruslan_website.travelblog">
  
    <application
        android:name=".utils.TravelBlogApplication"
        ... >
      

        <activity android:name=".WebLinkActivity">
            <intent-filter>
                <action android:name="android.intent.action.VIEW" />

                <category android:name="android.intent.category.DEFAULT" />
                <category android:name="android.intent.category.BROWSABLE" />

                <data android:scheme="app.travelblog" />
            </intent-filter>
        </activity>
```

`app/src/main/java/com/ruslan_website/travelblog/WebLinkActivity.java`
```java
package com.ruslan_website.travelblog;

import ...

public class WebLinkActivity extends AppCompatActivity {

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);

        Uri data = getIntent().getData();
        if(data != null) {
            List<String> params = data.getPathSegments();
            String first = params.get(0);
            String second = params.get(1);
            Log.i("Param", first + second);
        }

        Intent intent = new Intent(WebLinkActivity.this, LoginActivity.class);
        startActivity(intent);
    }
}
```
