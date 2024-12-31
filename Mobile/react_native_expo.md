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
- https://docs.expo.dev/get-started/create-a-project/
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

`npx expo start` vs `npx expo run`

`start` defaults to Expo Go.   
If you press `a` or `i` after that, it will run in any attached simulators or devices.   

`run` automatically runs prebuild under the hood.   
It does everything in one command, eg: `npx expo run:android`   

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

## Bare vs Expo

Bare means without using Expo nor Metro bundler (nor any other frameworks) to manage it for you. You create the native app and configure everything yourself.

Back in the days, Expo wasn't fully stable and had some drawbacks in terms of using native Code and modules but today most projects can be run in Expo really well.

https://docs.expo.dev/workflow/prebuild is used to adapt from Expo to bare. But not fully bare.

You can create and run an Expo app on Expo Go on your phone and emulator. But when you start working with native stuff you'll need a dev build

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
- If you have an older version of Mac, then you'll probably need an older version of `xCode`: https://developer.apple.com/download/all/ . Also see this for reference: https://developer.apple.com/support/xcode    
- As of 2024, xCode 16 is buggy: https://www.reddit.com/r/iOSProgramming/comments/1flfm36/xcode_16_is_buggy_a_tragic_tale_of_regret_and/?rdt=39591

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

## Audio

- https://docs.expo.dev/versions/latest/sdk/audio
- https://docs.expo.dev/versions/latest/sdk/audio-av/
- https://github.com/expo/expo/discussions/18869#discussioncomment-8404583

At its most bare-basic
```js
import { Audio } from 'expo-av';

async function playSound() {
  const { sound } = await Audio.Sound.createAsync( require('../assets/audio/xxx.wav') );
  await sound.playAsync();
}

<Button title="Play Sound" onPress={playSound} />
```

## Camera

- https://gist.github.com/atabegruslan/0ee8047d4fbfce85f15711208a9cfb69

## Forms

- https://stackoverflow.com/a/61447938

## Keyboard Avoidance

- https://www.youtube.com/watch?v=jhyuk68YdWA
- https://www.npmjs.com/package/react-native-keyboard-aware-scroll-view

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

## Tabs

https://gist.github.com/atabegruslan/07fc9e556141b7a5e27c7ed7bf8a96c0

## Render HTML

- https://meliorence.github.io/react-native-render-html/docs/intro

## FlatList Infinite Scroll

- https://gist.github.com/atabegruslan/6964ffb347abedeab82db271bff52bcf

## Flash List

- https://github.com/Shopify/flash-list
- https://gist.github.com/atabegruslan/e1b124673144da40ce32d777478bed6d
- https://shopify.github.io/flash-list/docs/known-issues

## Payments

- https://medium.com/@subtain.techling/subscription-in-react-native-a-comprehensive-guide-75fa1ec34f95
- Apple store in app payment: https://developer.apple.com/in-app-purchase
  - https://developer.apple.com/app-store/subscriptions
- Google play in app payment
- https://docs.expo.dev/guides/in-app-purchases
  - https://www.revenuecat.com/blog/engineering/expo-in-app-purchase-tutorial
  - https://www.revenuecat.com/docs/getting-started/installation/reactnative
    - Apple's Store Kit 2: https://developer.apple.com/storekit
    - Google Play Billing: https://developer.android.com/google/play/billing/integrate

## Publish

**EAS**

- https://docs.expo.dev/eas-update/getting-started/  
  - `npm install --global eas-cli`

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

Google Play Console don't accept `.apk` anymore

![](/Illustrations/Mobile/google_play_console_dont_accept_apk_anymore.png)

### Test publish - iOS

**Different ways:** https://developer.apple.com/help/app-store-connect/manage-builds/upload-builds 

- `eas build --platform ios [--profile preview2]` and `eas submit -p ios --latest` with EAS (expo.dev): https://www.notjust.dev/blog/2022-03-29-how-to-publish-expo-react-native-app-to-apple-app-store
- Archive, and then upload with xCode: https://www.codecademy.com/article/ios-how-to-push-your-app-to-app-store-connect
- In CLI, build `.xacrhive` files (`eas build -p ios [--profile preview2] [--local]`), and then upload with xCode (xCode > organizer window > click upload to testflight): https://developer.apple.com/documentation/xcode/distributing-your-app-for-beta-testing-and-releases
- `xcrun altool`: https://help.apple.com/asc/appsaltool
- Transporter app: Need to get it from Apple App Store 
  - Even though it's free, you still need an Apple ID associated with an payment method.
    - If you don't have an Apple ID associated with an payment method; Then ask someone with an Apple ID associated with an payment method, ask them to download it and send it to you as `.zip`, then you unzip it and drag it into the `Applications` folder. Then you'll be prompted to login with your Apple ID, here you can login with your own Apple ID.

If you encounter this issue below, you need to agree to Apple's latest contract (2024).   
https://stackoverflow.com/questions/78680844/ios-you-do-not-have-required-contracts-to-perform-an-operation     
https://forums.developer.apple.com/forums/thread/710906    

![](/Illustrations/Mobile/ios_transporter_upload_contract_error.png)

Before agreeing

![](/Illustrations/Mobile/apple_2024_before_agree_new_contract.png)

After agreeing

![](/Illustrations/Mobile/apple_2024_after_agree_new_contract.png)

**Once you publish a build to App Store Connect's TestFlight:**

- Give info such as Privacy and Contact Info and Screenshots,
- Select a build (ie: version) from TestFlight,
- Submit for Review
- Invite Users and add Internal Testers

**References:**

- https://cic.ubc.ca/2023/08/28/how-to-publish-an-ios-app-to-testflight
- https://developer.apple.com/help/app-store-connect/test-a-beta-version/testflight-overview
- https://developer.apple.com/testflight
- https://www.youtube.com/watch?v=cdUVbpT-Vks&t=487s
- https://www.youtube.com/watch?v=DLvdZtTAJrE&t=994s
- https://stackoverflow.com/a/52661591
- https://www.kodeco.com/10868372-testflight-tutorial-ios-beta-testing

- ![](/Illustrations/Mobile/RN_Expo/ios_publish_test_external_link.png)

### Local builds

https://docs.expo.dev/build-reference/local-builds

### Update

`app.json`
```
    "ios": {
      "supportsTablet": true,
      "bundleIdentifier": "com.yyy.xxx",
      "buildNumber": "1",
      "config": {
        "usesNonExemptEncryption": false
      }
    },
    "android": {
      "package": "com.yyy.xxx",
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

### Versions

- ![](/Illustrations/Mobile/RN_Expo/versions_in_react_native.png)

Don't forget to update remote version too https://docs.expo.dev/build-reference/app-versions/#remote-version-source

So:   
`eas build:version:set` to set Android `versionCode` and iOS `buildNumber`, and chose remote. `eas.json` will be updated.   
`eas build:version:sync`   

And don't forget to update:
- `android/app/build.gradle`'s `versionCode` and `versionName`
  - `versionCode` corresponds to `app.json`'s Android `versionCode`
  - `versionName` corresponds to `app.json`'s `version`
- `ios/quizlingo/Info.plist`'s `CFBundleVersion` and `CFBundleShortVersionString`:
  - `CFBundleVersion` corresponds to `app.json`'s iOS `buildNumber`
  - `CFBundleShortVersionString` corresponds to `app.json`'s `version`

### Others

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

**Metro;** The JavaScript bundler for React Native:

- https://github.com/facebook/metro
- https://developers.facebook.com/blog/post/2021/11/01/eli5-metro-javascript-bundler-react-native

---

# Platform Specific

## Audio

Android emulator control output volume

![](/Illustrations/Mobile/android_emulator_control_output_volume.png)

Android emulator control input microphone - Method 1

![](/Illustrations/Mobile/android_emulator_control_input_mic_1a.png)

![](/Illustrations/Mobile/android_emulator_control_input_mic_1b.png)

Android emulator control input microphone - Method 2

![](/Illustrations/Mobile/android_emulator_control_input_mic_2.png)

iOS simulator control output volume

![](/Illustrations/Mobile/ios_simulator_control_output_volume.png)

iOS simulator control input microphone

![](/Illustrations/Mobile/ios_simulator_control_input_microphone_1.png)

![](/Illustrations/Mobile/ios_simulator_control_input_microphone_2.png)

https://stackoverflow.com/questions/3195739/turn-off-sound-in-iphone-simulator

Mac control input microphone

![](/Illustrations/Mobile/mac_control_input_mic_1.png)

![](/Illustrations/Mobile/mac_control_input_mic_2.png)

## Start afresh

Android emulator

![](/Illustrations/Mobile/android_emulator_start_afresh.png)

iOS simulator - just delete the app and reinstall

![](/Illustrations/Mobile/ios_simulator_start_afresh.png)

## Android

Dealing with multiple gradles

- ![](/Illustrations/Mobile/Gradle/multiple_gradles.png)

When you run `npx expo run:android`, you can also see:

```
yarn run v1.22.22
$ expo run:android --variant debug
› Building app...
Downloading https://services.gradle.org/distributions/gradle-8.8-all.zip
```

- https://stackoverflow.com/a/26254725
- https://stackoverflow.com/a/34532235
- https://stackoverflow.com/a/48155800
- https://github.com/NativeScript/android/issues/553#issuecomment-295862685
- https://www.simplilearn.com/tutorials/gradle-tutorial/gradle-installation
- Common issues:
  - https://github.com/facebook/react-native/issues/32858
    - Solution: Downgrade to Java v17 https://service.uoregon.edu/TDClient/2030/Portal/KB/ArticleDet?ID=32227 , remove `node_modules` and run `yarn` again.

## iOS

**Pod**: In iOS, a pod is a third-party library or framework that is integrated into a project using CocoaPods (CocoaPods is a dependency manager)

To reinstall all CocoaPods afresh: `rm -rf node_modules; rm -rf ios/build; rm -rf ios/Pods; rm -rf ios/Podfile.lock; yarn; yarn podinstall`.   
Or just delete `ios/build` and `ios/Pods` folders, then run `npx expo run:ios` again.   
Or alternatively: `cd ios`, then `pod repo update`, then `pod install`.   

### iOS simulator use simulator's keyboard instead of Mac's keyboard

![](/Illustrations/Mobile/ios_simulator_use_simulators_keyboard.png)

### Screenshot

![](/Illustrations/Mobile/ios_simulator_screenshot.png)

### Run many Simulators

![](/Illustrations/Mobile/create_and_run_on_many_ios_simulators_1.png)

![](/Illustrations/Mobile/create_and_run_on_many_ios_simulators_2.png)

![](/Illustrations/Mobile/create_and_run_on_many_ios_simulators_3.png)

## Firebase

Sometimes its faster to distribute builds among other developers during development phase

- https://30dayscoding.com/blog/adding-firebase-hosting-to-react-native-apps
- https://medium.com/one-thing-i-learned-today/perfect-guide-for-releasing-your-react-native-ios-and-android-app-using-firebase-app-distribution-7107f98ca122

Upload

- https://medium.com/one-thing-i-learned-today/perfect-guide-for-releasing-your-react-native-ios-and-android-app-using-firebase-app-distribution-7107f98ca122

Drag & Drop the build file (eg: `.apk`) into Firebase, like any online dropbox.

![](/Illustrations/Mobile/apk_to_firebase.png)

Invite others

https://www.youtube.com/watch?v=V3z97mWuvmA&t=180s

![](/Illustrations/Mobile/firebase_invite.png)
