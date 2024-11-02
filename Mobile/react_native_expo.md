# Tutorials

- https://www.youtube.com/playlist?list=PL4cUxeGkcC9ixPU-QkScoRBVxtPPzVjrQ
- https://www.youtube.com/playlist?list=PLC3y8-rFHvwhiQJD1di4eRVN30WWCXkg1

# Simple start

1/ Install node    

2/ Create new project

Either `npx create-expo-app` or `npx create-react-native-app`

Local Expo CLI has became preferred over the Global one: https://blog.expo.dev/the-new-expo-cli-f4250d8e3421   
So `npx create-expo-app xxx` became preferred over `expo init xxx`   

Eg: You can start a project like this:

`npx create-expo-app@latest projectName --template blank` 

References
- https://docs.expo.dev/more/create-expo/#--template    
- A common problem and solution: https://stackoverflow.com/questions/58675179/error-emfile-too-many-open-files-react-native-cli/62437140#62437140  

3/ Run

`npx create-expo-app` by default creates these scripts in `package.json`
```
"scripts": {
  "start": "expo start",
  "android": "expo start --android",
  "ios": "expo start --ios",
  "web": "expo start --web"
},
```

You can run using the `Expo Go` app from your phone, or with `development build`. The `Expo Go` option is simpler. So,    
download `Expo Go` to your phone,    
run `npm run start` or `yarn start` (A.K.A.: `npx expo start`)       
scan the QR code from within the Expo Go app.   

References
- Earlier version of `Expo Go` (v50): https://expo.dev/go?sdkVersion=50&platform=android&device=true
- Use Yarn over NPM because it's faster: https://waverleysoftware.com/blog/yarn-vs-npm
- `Expo Go` is easy, but limited. Check what is compatible with `Expo Go` here: https://reactnative.directory

# Development build

- Very good article: https://expo.dev/blog/expo-go-vs-development-builds 
- https://docs.expo.dev/guides/local-app-development/#local-app-compilation

Various commands
- https://docs.expo.dev/more/expo-cli/#launch-target
  - `npm install expo-dev-client` then `npx expo start` will run a development build
  - `npx expo start --dev-client` will run a development build too.
  - `npx expo start` will run with Expo Go.
  - `npx expo start --clear` will run with Expo Go, without cache.
- `expo start` vs **`expo run`**
  - https://www.reddit.com/r/expo/comments/10wngus/what_is_the_functional_difference_between_expo
  - https://stackoverflow.com/a/76301305
- `ios` & `android` folders
  - `npx expo prebuild` generates `ios` & `android` folders.   
  - `npx expo eject` used to do this, but is now obsolete.   

References
- USB debug, a common problem and solution: https://github.com/expo/fyi/blob/main/authorize-android-device.md
- https://niteco.com/articles/from-expo-to-react-native
- https://stackoverflow.com/questions/69060280/react-native-convert-an-expo-bare-project-to-a-pure-react-native-app

## Local app compilation

To build your project locally you can use compile commands from Expo CLI which generates the android and ios directories:
`npx expo run:android`
`npx expo run:ios`
The above commands compile your project, using your locally installed Android SDK or Xcode, into a debug build of your app.

These compilation commands initially run npx expo prebuild to generate native directories (android and ios) before building, if they do not exist yet. If they already exist, this will be skipped.
You can also add the `--device` flag to select a device to run the app on — you can select a physically connected device or emulator/simulator.
You can pass in `--variant release` (Android) or `--configuration Release` (iOS) to build a production build of your app. Note that these builds are not signed and you cannot submit them to app stores. To sign your production build, see Local app production.

## Local builds with `expo-dev-client`

If you install expo-dev-client to your project, then a debug build of your project will include the expo-dev-client UI and tooling, and we call these development builds.

## `npx expo install expo-dev-client`
To create a development build, you can use local app compilation commands (`npx expo run:[android|ios]`) which will create a debug build and start the development server.

# Android Studio and xCode

It's advantageous to install `xCode` and `Android Studio` too.      
Typical system requirements:     
`xCode` needs ~50GB disk space, `Android Studio` needs ~20GB disk space. Overall, a Mac of ~200GB disk space.    
Android Emulator typically needs 16GB RAM & 16GB disk space. Though 8GB of RAM can still cope.    

References
- Common iOS emulator problem: https://github.com/expo/expo/issues/21727#issuecomment-1471621054  
- If you have an older version of Mac, then you'll probably need an older version of `xCode`. See this for reference: https://developer.apple.com/support/xcode    

# Common things

## Query

- Use Tanstack React-Query from now on: https://www.npmjs.com/package/react-query -> https://tanstack.com/query/latest/docs/framework/react/quick-start
- Common good-to-knows:
  - https://tanstack.com/query/latest/docs/framework/react/guides/disabling-queries
  - https://www.codemzy.com/blog/react-query-force-refetch

## Push notification

- https://www.npmjs.com/package/react-native-push-notification
- https://www.youtube.com/watch?v=MjdF5HM05ls
- https://firebase.google.com/docs/cloud-messaging/ios/client

## Data management

- https://rnfirebase.io/reference/auth/authprovider
- https://dev.to/alvessteve/the-complete-guide-to-env-variable-in-react-native-5999
- https://dev.to/bhatvikrant/how-to-add-environment-variables-in-a-react-native-project-with-ts-2ne5
- https://www.freecodecamp.org/news/how-to-store-data-locally-in-react-native-expo
- https://docs.expo.dev/develop/user-interface/store-data/#expo-filesystem (Works with Expo Go, but slow)
- MMKV https://github.com/mrousavy/react-native-mmkv (Doesn't work with Expo Go, but fast)
- Jotai https://www.youtube.com/watch?v=-AR2PN38ovo
- Zustand 
  - https://www.youtube.com/watch?v=_ngCLZ5Iz-0
  - https://github.com/pmndrs/zustand
- https://www.npmjs.com/package/@clerk/clerk-expo (Maybe not for RN)
- https://blog.codemagic.io/redux-vs-recoil-for-react-native

![](/Illustrations/Mobile/RN_Expo/rn_storages.png)

## Social media integration

- https://www.npmjs.com/package/react-native-app-auth

## Toast messages

- https://www.youtube.com/watch?v=SgoI-fRiFTM

## Forms

- https://stackoverflow.com/a/61447938

## OS specific frontend styling

- https://reactnative.dev/docs/platform-specific-code

## Paypal integration

This tutorial is for RN Cli: https://www.npmjs.com/package/react-native-paypal - `react-native link react-native-paypal` generates `android` & `ios` folders

This tutorial is for Expo: https://chatgpt.com/share/d1c838b8-2e6e-4f89-92b6-d603d2a3f176 - `expo eject` generates `android` & `ios` folders

## Routers and navigators

- https://expo.github.io/router/docs/migration/react-navigation/params
- https://www.youtube.com/watch?v=Z20nUdAUGmM
- https://www.youtube.com/watch?v=AP08wUBhpKM
- https://docs.expo.dev/router/advanced/drawer
  - https://www.youtube.com/watch?v=3p9LtOUg5fw
- https://reactnavigation.org/docs/drawer-based-navigation
- https://docs.expo.dev/router/advanced/nesting-navigators

How to solve this problem ("`RNCSafeAreaProvider` was not found in the `UIManager` Error") when using Expo Drawer Nav ( https://docs.expo.dev/router/advanced/drawer )

- https://stackoverflow.com/a/70891254
- https://github.com/software-mansion/react-native-reanimated/issues/4736#issuecomment-1639967526
- `package.json`
```
{
  "name": "drawers",
  "version": "1.0.0",
  "main": "expo-router/entry",
  "scripts": {
    "start": "expo start",
    "android": "expo start --android",
    "ios": "expo start --ios",
    "web": "expo start --web"
  },
  "dependencies": {
    "@react-native-community/masked-view": "^0.1.11",
    "@react-navigation/drawer": "^6.7.2",
    "expo": "~51.0.28",
    "expo-router": "^3.5.23",
    "expo-status-bar": "~1.12.1",
    "react": "18.2.0",
    "react-native": "0.74.5",
    "react-native-gesture-handler": "^2.18.1",
    "react-native-reanimated": "3.10.1",
    "react-native-safe-area-context": "^4.10.9",
    "react-native-screens": "^3.34.0"
  },
  "devDependencies": {
    "@babel/core": "^7.20.0"
  },
  "private": true
}
```

## Render HTML

- https://meliorence.github.io/react-native-render-html/docs/intro

## FlatList Infinite Scroll

- https://gist.github.com/atabegruslan/6964ffb347abedeab82db271bff52bcf

## Flash List

- https://github.com/Shopify/flash-list
- https://gist.github.com/atabegruslan/e1b124673144da40ce32d777478bed6d

## Payments

- https://www.revenuecat.com/docs/getting-started/installation/reactnative
- Apple store in app payment: https://developer.apple.com/in-app-purchase
- https://developer.apple.com/app-store/subscriptions
- Google play in app payment
- https://docs.expo.dev/guides/in-app-purchases

## Firebase

- https://30dayscoding.com/blog/adding-firebase-hosting-to-react-native-apps
- https://medium.com/one-thing-i-learned-today/perfect-guide-for-releasing-your-react-native-ios-and-android-app-using-firebase-app-distribution-7107f98ca122

## Publish

### Pre-publish

```
npx expo-doctor@latest
Advice: Use 'npx expo install --check' to review and upgrade your dependencies.
```

- Credential related: https://docs.expo.dev/app-signing/app-credentials
- Keystore: https://www.youtube.com/watch?v=3lDtAf8Jk_c

1/ https://docs.expo.dev/workflow/prebuild
1a/ https://www.youtube.com/watch?v=2yHI0e4MzUE

- https://www.notjust.dev/blog
  - https://www.youtube.com/watch?v=A3--3Ozxz6o
  - https://www.youtube.com/watch?v=oBWBDaqNuws
  - https://www.youtube.com/watch?v=r-Z--YDrmjI
  - https://www.youtube.com/watch?v=LE4Mgkrf7Sk

- `iOS` Distribution certificate: https://www.youtube.com/watch?v=DLvdZtTAJrE&t=600s
- https://www.sphinx-solution.com/blog/cost-to-put-an-app-on-the-app-store
- https://medium.com/@sisongqolosi/step-by-step-tutorial-publishing-a-react-native-app-to-google-play-store-8ab3db39cd07

- ![](/Illustrations/Mobile/RN_Expo/ios_publishing_encryption_compliance.png)

### Test publish - Android

- https://www.youtube.com/watch?v=oBWBDaqNuws&t=1354s

- ![](/Illustrations/Mobile/RN_Expo/android_publish_test.png)

### Test publish - iOS

- https://cic.ubc.ca/2023/08/28/how-to-publish-an-ios-app-to-testflight
- https://developer.apple.com/help/app-store-connect/test-a-beta-version/testflight-overview
- https://developer.apple.com/testflight
- https://www.youtube.com/watch?v=cdUVbpT-Vks&t=487s
- https://www.youtube.com/watch?v=DLvdZtTAJrE&t=994s
- https://stackoverflow.com/a/52661591
- https://www.kodeco.com/10868372-testflight-tutorial-ios-beta-testing

- ![](/Illustrations/Mobile/RN_Expo/ios_publish_test_external_link.png)

### Update

`app.json`
```
    "ios": {
      "supportsTablet": true,
      "bundleIdentifier": "com.adhg.try2.oscarsurfaces",
      "buildNumber": "1",
      "config": {
        "usesNonExemptEncryption": false
      }
    },
    "android": {
      "package": "com.adhg.try2.oscarsurfaces",
      "versionCode": 1,
      "adaptiveIcon": {
        "foregroundImage": "./assets/adaptive-icon.png",
        "backgroundColor": "#ffffff"
      }
    },
```

### Update - Android

Increment `versionCode`!

- https://www.youtube.com/watch?v=oBWBDaqNuws&t=1635s

When testing: `Testing` > `Internal Testing` > `Create new release` & add testers

When creating anew: (Todo)

This step isn't necessary
- https://www.notjust.dev/blog/2022-04-11-how-to-publish-expo-react-native-app-to-google-play-store#creating-google-service-account
- https://www.notjust.dev/blog/2022-04-11-how-to-publish-expo-react-native-app-to-google-play-store#updating-application

If you do it (Linking service account and downloading the key), you can then publish new releases automatically by: `eas build --platform android` then `eas submit -p android --latest`, with `eas.json`:
```js
{
  ...
  "submit": {
    "production": {
      "android": {
        "serviceAccountKeyPath": "path to that downloaded key"
      }
    }
  }
}
```

If not, then just `eas build --platform android`, manually download build from expo.dev and upload to Google Play Console.

### Update - iOS

- Increment `buildNumber`! Version number can stay the same - esp for small changes, `eas build --platform=ios` then `eas submit -p ios --latest`
- https://www.youtube.com/watch?v=LE4Mgkrf7Sk&t=1654s
- https://www.youtube.com/watch?v=cdUVbpT-Vks&t=710s

### Docs

- https://reactnative.dev/docs/activityindicator
- https://reactnavigation.org/docs/deep-linking

### Support

Google Play Developer support 

https://support.google.com/googleplay/android-developer/gethelp?visit_id=638130374458737855-1460335542&rd=1&sjid=5078581807697071668-AP# 

googleplay-developer-support@google.com  

Apple   

https://developer.apple.com

https://appstoreconnect.apple.com 

Login at: https://idmsa.apple.com/appleauth/auth/signin 
  
Apple support https://developer.apple.com/contact/topic/select 

---

# Theory

- https://developers.facebook.com/blog/post/2021/11/01/eli5-metro-javascript-bundler-react-native
