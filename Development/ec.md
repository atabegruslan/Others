# Payment Gateways

## Stripe

- Stripe developer dashboard: https://dashboard.stripe.com


- https://docs.stripe.com/testing#cards

## Paypal

- SignUp to Paypal (Developer or not): https://www.paypal.com/en/webapps/mpp/country-worldwide , https://www.paypal.com/vn/signin

- Auto-generate sandbox Paypal accounts: https://developer.paypal.com/developer/accounts 
	- then https://developer.paypal.com/developer/applications

See payment log: https://www.sandbox.paypal.com/mep/dashboard

Help

- https://developer.paypal.com/docs/support
- https://www.paypal-community.com/mts

## Paypal's Venmo

Intro

https://www.youtube.com/watch?v=itpIJ7ewn4E

Docs

- https://developer.paypal.com/docs/checkout/pay-with-venmo/integrate
- https://venmo.com/gettingstarted/apipayment
- https://venmo.com/docs/overview
- https://venmo.com/developers

Eligibility:
- https://github.com/eileenmcnaughton/nz.co.fuzion.omnipaymultiprocessor/blob/master/docs/Paypal.md#venmo
- https://woocommerce.com/document/woocommerce-paypal-payments/#pay-with-venmo
	- https://developer.paypal.com/docs/checkout/pay-with-venmo/#link-eligibility

## Bambora's ePay

	ePay (a part of Euronet): https://www.youtube.com/watch?v=mKHw_-ISV9w 
	https://en.wikipedia.org/wiki/Euronet_Worldwide

	Bambora, aka Beanstream, aka Worldline: https://doc.dynamicweb.com/documentation-9/ecommerce/payment/bambora


- https://developer.paypal.com/tools/sandbox/card-testing


- https://webappick.com/woocommerce-support-forum
- https://woocommerce.com/community


- https://stackshare.io/stackups/bambora-vs-paypal
- https://stackshare.io/stackups/bambora-vs-stripe

## Shopify's Shop Pay

## Google Pay & Apple Pay

- https://www.youtube.com/watch?v=cHv8LqkbPHk

Supported on both Stripe and Paypal

- https://docs.stripe.com/apple-pay
- https://stripe.com/payments/apple-pay

## Ali Pay & WeChat Pay

- https://www.youtube.com/watch?v=nHkyOOcFEDE

Supported on Stripe 

- https://docs.stripe.com/payments/alipay
- https://stripe.com/payment-method/alipay
- https://stripe.com/resources/more/alipay-an-in-depth-guide
- https://support.stripe.com/questions/activating-alipay-on-your-stripe-account

- https://docs.stripe.com/payments/wechat-pay
- https://stripe.com/resources/more/wechat-pay-an-in-depth-guide

- https://romanglushach.medium.com/alipay-and-wechat-pay-how-they-work-what-they-offer-and-how-to-use-them-ade7d6e20944

---

# Example projects

- Stripe
	- Plain PHP
		- https://github.com/Ruslan-Aliyev/Stripe-API-Plain-PHP
	- Laravel
		- https://medium0.com/@juangsalazprabowo/how-to-integrate-laravel-with-stripe-fc54e54a767c
	- Misc
		- https://stackoverflow.com/questions/29851706/how-to-create-a-customer-in-omnipay-stripe
- Paypal
	- Plain PHP
		- https://www.youtube.com/watch?v=5AbkSomC-a4
		- https://gist.github.com/atabegruslan/1de5d2d7c4d6c1c6681c5e66f5503913
	- Laravel
		- https://www.youtube.com/watch?v=_7YBIRQfSN0
		- https://sujipthapa.co/blog/a-guide-to-integrate-omnipay-paypal-with-laravel
- WP-WooCommerce
	- https://github.com/atabegruslan/WP_WooCommerce
- Laravel Bagisto
	- https://github.com/atabegruslan/Others/blob/master/Illustrations/bagisto.md
- Magento 2
	- https://github.com/atabegruslan/Magento

---

# Others

## Database design

- https://moqups.com/templates/diagrams-flowcharts/erd/ecommerce-database-diagram/
- https://creately.com/diagram/example/he7cxejx1/e-Commerce%20Database
- WP WooCommerce DB: https://github.com/woocommerce/woocommerce/wiki/Database-Description
- Bagisto DB: https://github.com/atabegruslan/Others/blob/master/Illustrations/Development/ec/bagisto.mwb
- A Joomla EC extension DB: https://github.com/atabegruslan/Others/blob/master/Illustrations/Development/ec/joomla.mwb



- Why have seperate orders and carts table:
	- https://stackoverflow.com/questions/60157839/should-i-have-a-cart-table-in-my-e-commerce-app-or-just-have-an-open-order-stat
	- https://www.reddit.com/r/Database/comments/iq2g9q/q_how_to_design_cart_and_order_tables_in
	- https://dba.stackexchange.com/questions/328854/ecommerce-app-design-relation-between-order-and-cart
- How to design tables for Product Variations
	- https://stackoverflow.com/questions/76093147/product-variations-table-for-ecommerce
	- https://stackoverflow.com/questions/24923469/modeling-product-variants
	- https://flixtechs.co.zw/posts/laravel-ecommerce-tutorial-part-8-product-variations







GENERAL TUTs

- https://docs.drupalcommerce.org/v1/user-guide






From plain php ec

### Plugins

- https://github.com/srmklive/laravel-paypal
- https://laravel-vuejs.com/paystack-payment-gateway-plugin/
- https://www.positronx.io/how-to-integrate-paypal-payment-gateway-in-laravel/
- https://github.com/shetabit/payment
- https://codecanyon.net/search/php%20stripe%20payments
- https://www.expresstechsoftwares.com/integrate-laravel-stripe-payment-gateway-online-payments/
- https://laravel.com/docs/8.x/billing
- https://onlinewebtutorblog.com/stripe-payment-gateway-integration-in-laravel-8/
- https://www.tutsmake.com/laravel-8-stripe-payment-gateway-integration-tutorial/
- https://github.com/rap2hpoutre/laravel-stripe-connect
