# Tutorials

- https://www.youtube.com/playlist?list=PL4cUxeGkcC9ixPU-QkScoRBVxtPPzVjrQ
- https://www.youtube.com/playlist?list=PLC3y8-rFHvwhiQJD1di4eRVN30WWCXkg1

# Simple start

1/ Install node    

2/ Create new project

- https://docs.expo.dev/more/create-expo/#--template    
- `npx create-expo-app@latest projectName --template blank`  
- https://stackoverflow.com/questions/58675179/error-emfile-too-many-open-files-react-native-cli/62437140#62437140  
- `npx expo start --clear # Better than npm start` https://github.com/expo/expo/issues/24523#issuecomment-1871372714   

3/ Download Expo Go to phone  

4/ It's advantageous to install xCode and Android Studio too

Common iOS emulator problem: https://github.com/expo/expo/issues/21727#issuecomment-1471621054  

# Common things

## Query
- https://tanstack.com/query/latest/docs/framework/react/guides/dependent-queries?from=reactQueryV3
- https://tanstack.com/query/latest/docs/framework/react/guides/disabling-queries
- https://www.codemzy.com/blog/react-query-force-refetch

## Push notification
- https://www.npmjs.com/package/react-native-push-notification
- https://www.youtube.com/watch?v=MjdF5HM05ls

## Data management
- https://rnfirebase.io/reference/auth/authprovider
- https://github.com/mrousavy/react-native-mmkv
- https://dev.to/alvessteve/the-complete-guide-to-env-variable-in-react-native-5999
- https://dev.to/bhatvikrant/how-to-add-environment-variables-in-a-react-native-project-with-ts-2ne5
- https://www.freecodecamp.org/news/how-to-store-data-locally-in-react-native-expo
- https://github.com/pmndrs/zustand
- https://www.npmjs.com/package/@clerk/clerk-expo (Maybe not for RN)
- https://blog.codemagic.io/redux-vs-recoil-for-react-native/

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

## Infinite Scroll
- https://gist.github.com/atabegruslan/6964ffb347abedeab82db271bff52bcf

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
