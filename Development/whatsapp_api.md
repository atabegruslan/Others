# Official APIs

Not officially public and not free

![](https://raw.githubusercontent.com/atabegruslan/Others/master/Illustrations/Development/whatsapp_api.png)

- https://developers.facebook.com/docs/whatsapp/on-premises/get-started/postman/
  - https://www.postman.com/meta
- https://business.whatsapp.com/developers/developer-hub

# However there are 2 libraries that works around that

## wwebjs

Web JS interacts with WhatsApp via WhatsApp Web ( https://web.whatsapp.com ). It uses puppeteer ( https://www.npmjs.com/package/puppeteer ) to visit WhatsApp Web in a background browser, and uses ModuleRaid ( https://www.npmjs.com/package/@pedroslopez/moduleraid ) to pick out various info from WhatsApp Web.

- https://github.com/pedroslopez/whatsapp-web.js
  - https://docs.wwebjs.dev/
  - https://wwebjs.dev/

## Baileys 

Baileys directly uses the websocket mechanism behind WhatsApp Web to interact with WhatsApp

![Screenshot 2024-03-30 152743](https://github.com/atabegruslan/Others/assets/20809372/370b3beb-fd3f-4314-86d4-4556150430dc)

- https://github.com/WhiskeySockets/Baileys
  - https://whiskeysockets.github.io/Baileys/modules.html
  - https://whiskeysockets.github.io/docs/intro
  - Help forum: https://discord.com/invite/WeJM5FP9GG
- Other usage examples:
  - https://github.com/APdev93/WaBot-With-PairingCode
  - https://www.youtube.com/watch?v=DHEIO9YdRV8
    - https://github.com/saifkhan7865/baileys-integration-youtube
    - https://discord.com/invite/9v43X2tt89
  - Simple usage example: https://gist.github.com/atabegruslan/b9d8b28d376e55c08e7ddb25176b33c9

# Other relevant websites

- https://waha.devlike.pro/docs/overview/quick-start/
  - https://github.com/devlikeapro/whatsapp-http-api
  - https://boosty.to/wa-http-api
- Reverse-engineered WhatsApp Web: https://github.com/sigalor/whatsapp-web-reveng
- Other related libraries: https://www.libhunt.com/r/whatsapp-http-api
- https://medium.com/@anisettyanudeep/demystifying-the-whatsapp-web-desktop-qr-code-scanning-process-9e5a0ba10c22
