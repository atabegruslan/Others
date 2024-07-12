# Payment Gateways

## Stripe

- Stripe developer dashboard: https://dashboard.stripe.com

![](/Illustrations/Development/ec/stripe_dashboard.png)

See "Payments" (left side) for the payment log

- https://docs.stripe.com/testing#cards

## Paypal

- SignUp to Paypal (Developer or not): https://www.paypal.com/en/webapps/mpp/country-worldwide , https://www.paypal.com/vn/signin . Using your real email and password (Not your sandbox accounts)

- Auto-generate sandbox Paypal accounts: https://developer.paypal.com/developer/accounts 

![](/Illustrations/Development/ec/paypal_developer_credentials.png)

![](/Illustrations/Development/ec/paypal_sandbox_accounts.png)

![](/Illustrations/Development/ec/paypal_sandbox_account_detail.png)

Test cards: https://developer.paypal.com/tools/sandbox/card-testing

See payment log: https://www.sandbox.paypal.com/mep/dashboard

Help

- https://developer.paypal.com/docs/support
- https://www.paypal-community.com/mts

## Paypal's Venmo

Intro

- https://www.youtube.com/watch?v=itpIJ7ewn4E

- https://www.youtube.com/watch?v=kTKNRrKADKc

Docs

- https://developer.paypal.com/docs/checkout/pay-with-venmo/integrate
- https://venmo.com/gettingstarted/apipayment
- https://venmo.com/docs/overview
- https://venmo.com/developers

Eligibility

- https://github.com/eileenmcnaughton/nz.co.fuzion.omnipaymultiprocessor/blob/master/docs/Paypal.md#venmo
- https://developer.paypal.com/docs/checkout/pay-with-venmo/#link-eligibility

## Bambora's ePay

![](/Illustrations/Development/ec/bambora_epay.png)

- ePay: https://www.youtube.com/watch?v=mKHw_-ISV9w 
- https://en.wikipedia.org/wiki/Euronet_Worldwide
- Bambora, aka Beanstream, aka Worldline: https://doc.dynamicweb.com/documentation-9/ecommerce/payment/bambora

Comparisons

- https://stackshare.io/stackups/bambora-vs-paypal
- https://stackshare.io/stackups/bambora-vs-stripe

## Shopify's Shop Pay

Sign up: https://www.youtube.com/watch?v=n2thn62SNrw

Laravel integration:
- https://github.com/Kyon147/laravel-shopify (`gnikyt`'s' & `osiset`'s' are obsolete) : https://github.com/Kyon147/laravel-shopify/wiki
- https://github.com/signifly/laravel-shopify : https://laravel-news.com/laravel-shopify
- `phpish/shopify-php-sdk` : https://medium.com/@maulanayusupp/integrated-laravel-with-shopify-a-beginners-guide-bb226c195d53

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

- Stripe in Plain PHP: https://github.com/Ruslan-Aliyev/Stripe-API-Plain-PHP
- Stripe & Paypal in Laravel, Omnipay: https://github.com/atabegruslan/laravel-ec
- Stripe & Paypal in Plain PHP: https://gist.github.com/atabegruslan/1de5d2d7c4d6c1c6681c5e66f5503913
- Stripe & Paypal in WP, WooCommerce: https://github.com/atabegruslan/WP_WooCommerce/blob/master/setup.md
- Laravel Bagisto: https://github.com/atabegruslan/Others/blob/master/Illustrations/bagisto.md
- Magento 2: https://github.com/atabegruslan/Magento
- OpenCart: https://github.com/Ruslan-Aliyev/OpenCart

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

- How to design tables to better handle Guest checkout
	- https://stackoverflow.com/questions/17352944/database-schema-for-registered-customers-and-guest-checkout
		- So no need to record strangers in users table
		- Just record guest checkouts in the orders table (with nullable FK to user)
		- Users with accounts have addresses linked to the users table
		- Guests' addresses should be linked to the orders table
		- https://stackoverflow.com/questions/36234548/how-track-sessionid-for-shopping-cart-table-in-laravel

- Session management
	- https://www.quora.com/Is-there-a-way-to-keep-a-login-session-without-using-any-cookies
	- https://stackoverflow.com/questions/39596509/do-i-still-need-sessions-if-i-use-token-based-authentication

- How to design tables for Product Variations
	- https://stackoverflow.com/questions/76093147/product-variations-table-for-ecommerce
	- https://stackoverflow.com/questions/24923469/modeling-product-variants
	- https://flixtechs.co.zw/posts/laravel-ecommerce-tutorial-part-8-product-variations

![](/Illustrations/Development/ec/prod_var_er.png)

Algorithm for generating variants (recursion involved):

```php
/*
$matrix = [
	[1, 2], // standing for: big, small
	[5, 6], // standing for: red, blue
];
*/
function generateVariants($matrix, $i, $var1, $product)
{
    if ($i == count($matrix)) return;

    foreach($matrix[$i] as $var2)
    {
        $this->generateVariants($matrix, $i+1, $var1 . ' ' . $var2, $product);

        if($i == count($matrix)-1)
        {
            $combo = trim($var1 . ' ' . $var2);
            $comboArr = explode(' ', $combo);

            $nextAvailableVariantId = (Variant::max('id') ?? 0) + 1;

            foreach($comboArr as $comboItem)
            {
                Variant::create([
                    'id' => $nextAvailableVariantId,
                    'attribute_value_id' => $comboItem,
                    'product_id' => $product->id,
                ]);
            }

            $product->product_variants()->create([
                'product_id' => $product->id,
                'variant_id' => $nextAvailableVariantId,
                'sku' => 'dummy-sku',
                'price' => 1.5,
                'name' => 'dummy-name',
                'description' => 'dummy-description',
                'in_stock' => true
            ]);
        }
    }
}
```
Ref: https://stackoverflow.com/a/16967147

## General tutorials

- https://docs.drupalcommerce.org/v1/user-guide
