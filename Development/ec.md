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

API:

REST: https://developer.paypal.com/api/rest

Base URL: https://api-m.sandbox.paypal.com

Step 1 - Auth: 

![](/Illustrations/Development/ec/paypal_rest_1_auth.png)

Types of responses

Success:
```
{
    "scope": "https://uri.paypal.com/services/checkout/one-click-with-merchant-issued-token https://uri.paypal.com/services/payments/futurepayments https://uri.paypal.com/services/invoicing https://uri.paypal.com/services/vault/payment-tokens/read https://uri.paypal.com/services/disputes/read-buyer https://uri.paypal.com/services/payments/realtimepayment https://api.paypal.com/v1/vault/credit-card https://api.paypal.com/v1/payments/.* https://uri.paypal.com/services/wallet/mandates/write https://uri.paypal.com/services/vault/payment-tokens/readwrite https://uri.paypal.com/services/applications/webhooks https://uri.paypal.com/services/disputes/update-seller https://uri.paypal.com/services/payments/payment/authcapture openid https://uri.paypal.com/services/disputes/read-seller Braintree:Vault https://uri.paypal.com/services/payments/refund https://uri.paypal.com/services/pricing/quote-exchange-rates/read https://uri.paypal.com/services/billing-agreements https://uri.paypal.com/services/wallet/mandates/read https://uri.paypal.com/payments/payouts https://api.paypal.com/v1/vault/credit-card/.* https://uri.paypal.com/services/shipping/trackers/readwrite https://uri.paypal.com/services/subscriptions",
    "access_token": "A21AALbFc6pmaPdgjdHOCPCXaMnotgVGwGjmMrZ5lE8-kRZerFG-ORTJsCpzIyngpWu0uEEGAt5LLZAB0QKi5Gw3Zq9Jt1a_w",
    "token_type": "Bearer",
    "app_id": "APP-80W284485P519543T",
    "expires_in": 32400,
    "supported_authn_schemes": [
        "email_password",
        "remember_me"
    ],
    "nonce": "2024-08-16T07:56:05Zt3QXzXeCxIEfiptiPw0E5a7TmT1Mft5l5BOY9rICYfg",
    "client_metadata": {
        "name": "Appname",
        "display_name": "Appname",
        "logo_uri": "",
        "scopes": [
            "https://uri.paypal.com/services/payments/futurepayments",
            "https://uri.paypal.com/services/checkout/one-click-with-merchant-issued-token",
            "https://uri.paypal.com/services/invoicing",
            "https://uri.paypal.com/services/vault/payment-tokens/read",
            "https://uri.paypal.com/services/payments/basic",
            "https://uri.paypal.com/services/disputes/read-buyer",
            "https://uri.paypal.com/services/payments/realtimepayment",
            "https://api.paypal.com/v1/vault/credit-card",
            "Braintree:Vault",
            "https://api.paypal.com/v1/payments/.*",
            "https://uri.paypal.com/services/wallet/mandates/write",
            "https://uri.paypal.com/services/vault/payment-tokens/readwrite",
            "https://uri.paypal.com/services/applications/webhooks",
            "https://uri.paypal.com/services/payments/payment/authcapture",
            "https://uri.paypal.com/services/disputes/update-seller",
            "openid",
            "https://uri.paypal.com/services/disputes/read-seller",
            "https://uri.paypal.com/services/payments/refund",
            "https://uri.paypal.com/web/experience/incontextxo",
            "https://uri.paypal.com/services/pricing/quote-exchange-rates/read",
            "https://uri.paypal.com/services/billing-agreements",
            "https://uri.paypal.com/services/wallet/mandates/read",
            "https://uri.paypal.com/payments/payouts",
            "https://api.paypal.com/v1/vault/credit-card/.*",
            "https://uri.paypal.com/services/shipping/trackers/readwrite",
            "https://uri.paypal.com/services/subscriptions"
        ],
        "ui_type": "NEW"
    }
}
```

Failures:
```
{
    "error": "invalid_client",
    "error_description": "Client Authentication failed"
}
```

Step 2 - Create Order (or Payment): https://developer.paypal.com/docs/api/orders/v2/#orders_create

![](/Illustrations/Development/ec/paypal_rest_2_auth.png)

Payload
```
{
    "intent": "CAPTURE",
    "purchase_units": [
        {
            "items": [
                {
                    "name": "T-Shirt",
                    "description": "Green XL",
                    "quantity": "1",
                    "unit_amount": {
                        "currency_code": "USD",
                        "value": "100.00"
                    }
                }
            ],
            "amount": {
                "currency_code": "USD",
                "value": "100.00",
                "breakdown": {
                    "item_total": {
                        "currency_code": "USD",
                        "value": "100.00"
                    }
                }
            }
        }
    ],
    "application_context": {
        "return_url": "https://example.com/return",
        "cancel_url": "https://example.com/cancel"
    }
}
```

Responses

Success:
```
{
    "id": "5XW25497LW098850V",
    "intent": "CAPTURE",
    "status": "CREATED",
    "purchase_units": [
        {
            "reference_id": "default",
            "amount": {
                "currency_code": "USD",
                "value": "100.00",
                "breakdown": {
                    "item_total": {
                        "currency_code": "USD",
                        "value": "100.00"
                    }
                }
            },
            "payee": {
                "email_address": "sb-opxam783557@business.example.com",
                "merchant_id": "YQU2LUQB75CXS"
            },
            "items": [
                {
                    "name": "T-Shirt",
                    "unit_amount": {
                        "currency_code": "USD",
                        "value": "100.00"
                    },
                    "quantity": "1",
                    "description": "Green XL"
                }
            ]
        }
    ],
    "create_time": "2024-07-24T12:28:52Z",
    "links": [
        {
            "href": "https://api.sandbox.paypal.com/v2/checkout/orders/5XW25497LW098850V",
            "rel": "self",
            "method": "GET"
        },
        {
            "href": "https://www.sandbox.paypal.com/checkoutnow?token=5XW25497LW098850V",
            "rel": "approve",
            "method": "GET"
        },
        {
            "href": "https://api.sandbox.paypal.com/v2/checkout/orders/5XW25497LW098850V",
            "rel": "update",
            "method": "PATCH"
        },
        {
            "href": "https://api.sandbox.paypal.com/v2/checkout/orders/5XW25497LW098850V/capture",
            "rel": "capture",
            "method": "POST"
        }
    ]
}
```

Failures:

```
array:3 [
  "name" => "AUTHENTICATION_FAILURE"
  "message" => "Authentication failed due to invalid authentication credentials or a missing Authorization header."
  "links" => array:1 [▼
    0 => array:2 [▼
      "href" => "https://developer.paypal.com/docs/api/overview/#error"
      "rel" => "information_link"
    ]
  ]
]
```

```
{
   "error":"invalid_token",
   "error_description":"Token signature verification failed"
}
```

```
{
    "error": "invalid_token",
    "error_description": "Access Token not found in cache"
}
```

Step 3 - Redirect, for customer to review and confirm their payment on PayPal's side 

Step 4 - Capture: Customer approves the payment from payer to payee. https://developer.paypal.com/docs/api/orders/v2/#orders_capture

In the context of PayPal, the term "CAPTURE" refers to the process of collecting payment from a customers account for a particular transaction. When a payment is authorized or approved, it is not immediately transferred to the merchant's account. Instead, the funds are put on hold within the customer's account. 

During the capture process, the merchant initiates the transfer of funds from the customer's account to their account. This typically happens when the goods or services have been delivered or rendered. Capturing the funds completes the payment process and ensures that the merchant receives the payment for the transaction. 

- https://stackoverflow.com/a/20436759

Responses:

Success:
```
{
   "id":"2PR99067LX431202H",
   "links":[
      [
         "Object"
      ]
   ],
   "payer":{
      "address":[
         "Object"
      ],
      "email_address":"sb-sg0ld782482@personal.example.com",
      "name":[
         "Object"
      ],
      "payer_id":"WD2K39ARGH7EL"
   },
   "payment_source":{
      "paypal":[
         "Object"
      ]
   },
   "purchase_units":[
      [
         "Object"
      ]
   ],
   "status":"COMPLETED"
}

array:6 [
  "id" => "4ES87444HL7053000"
  "status" => "COMPLETED"
  "payment_source" => array:1 [▼
    "paypal" => array:5 [▼
      "email_address" => "sb-ti7bx31580669@personal.example.com"
      "account_id" => "RSC8ZQ9JQRJXG"
      "account_status" => "VERIFIED"
      "name" => array:2 [▼
        "given_name" => "John"
        "surname" => "Doe"
      ]
      "address" => array:1 [▼
        "country_code" => "US"
      ]
    ]
  ]
  "purchase_units" => array:1 [▼
    0 => array:3 [▼
      "reference_id" => "default"
      "shipping" => array:2 [▼
        "name" => array:1 [▼
          "full_name" => "John Doe"
        ]
        "address" => array:5 [▼
          "address_line_1" => "1 Main St"
          "admin_area_2" => "San Jose"
          "admin_area_1" => "CA"
          "postal_code" => "95131"
          "country_code" => "US"
        ]
      ]
      "payments" => array:1 [▼
        "captures" => array:1 [▼
          0 => array:9 [▼
            "id" => "29F20523UX105592H"
            "status" => "COMPLETED"
            "amount" => array:2 [▶]
            "final_capture" => true
            "seller_protection" => array:2 [▶]
            "seller_receivable_breakdown" => array:3 [▶]
            "links" => array:3 [▶]
            "create_time" => "2024-08-13T09:34:41Z"
            "update_time" => "2024-08-13T09:34:41Z"
          ]
        ]
      ]
    ]
  ]
  "payer" => array:4 [▼
    "name" => array:2 [▼
      "given_name" => "John"
      "surname" => "Doe"
    ]
    "email_address" => "sb-ti7bx31580669@personal.example.com"
    "payer_id" => "RSC8ZQ9JQRJXG"
    "address" => array:1 [▼
      "country_code" => "US"
    ]
  ]
  "links" => array:1 [▼
    0 => array:3 [▼
      "href" => "https://api.sandbox.paypal.com/v2/checkout/orders/4ES87444HL7053000"
      "rel" => "self"
      "method" => "GET"
    ]
  ]
]
```

Failures:

```
array:5 [
  "name" => "INVALID_REQUEST"
  "message" => "Request is not well-formed, syntactically incorrect, or violates schema."
  "debug_id" => "f95357509c89e"
  "details" => array:1 [▼
    0 => array:4 [▼
      "field" => "/"
      "location" => "body"
      "issue" => "MALFORMED_REQUEST_JSON"
      "description" => "The request JSON is not well formed."
    ]
  ]
  "links" => array:1 [▼
    0 => array:3 [▼
      "href" => "https://developer.paypal.com/docs/api/orders/v2/#error-MALFORMED_REQUEST_JSON"
      "rel" => "information_link"
      "encType" => "application/json"
    ]
  ]
]
```

```
{
   "debug_id":"dcaee54c782d4",
   "details":[
      "Array"
   ],
   "links":[
      "Array"
   ],
   "message":"The requested action could not be performed, semantically incorrect, or failed business validation.",
   "name":"UNPROCESSABLE_ENTITY"
}
```

Step 5 - (auto, JS SDK, credit card) POST /v2/checkout/orders/6BL93065U7701963D/confirm-payment-source

Positive response
```
{
    "id": "6BL93065U7701963D",
    "status": "APPROVED",
    "payment_source": {
        "card": {
            "last_digits": "2373",
            "expiry": "2029-07",
            "brand": "VISA",
            "available_networks": [
                "VISA"
            ],
            "type": "CREDIT",
            "bin_details": {
                "bin": "403203",
                "issuing_bank": "Baxter Credit Union",
                "bin_country_code": "US"
            }
        }
    },
    "links": [
        {
            "href": "https://api.sandbox.paypal.com/v2/checkout/orders/6BL93065U7701963D",
            "rel": "self",
            "method": "GET"
        },
        {
            "href": "https://api.sandbox.paypal.com/v2/checkout/orders/6BL93065U7701963D/capture",
            "rel": "capture",
            "method": "POST"
        }
    ]
}
```

Fail response
```
{
    "name": "UNPROCESSABLE_ENTITY",
    "details": [
        {
            "field": "/payment_source/card/number",
            "location": "body",
            "issue": "VALIDATION_ERROR",
            "description": "Invalid card number"
        }
    ],
    "message": "The requested action could not be performed, semantically incorrect, or failed business validation.",
    "debug_id": "f519443ba968c",
    "links": [
        {
            "href": "https://developer.paypal.com/docs/api/orders/v2/#error-VALIDATION_ERROR",
            "rel": "information_link",
            "method": "GET"
        }
    ]
}
```

Test cards: https://developer.paypal.com/tools/sandbox/card-testing

See payment log: https://www.sandbox.paypal.com/mep/dashboard

Fees

- https://www.paypal.com/US/webapps/mpp/merchant-fees
- https://www.paypal.com/vn/cshelp/topic/help_my_account_business/help_tax_information_business

Force fails

- https://developer.paypal.com/tools/sandbox/card-testing/#link-simulatecarderrorscenarios
- https://www.paypal.com/us/cshelp/article/how-do-i-test-failed-transactions-in-the-paypal-sandbox-ts1259
    - https://developer.paypal.com/tools/sandbox/negative-testing/request-headers/

Help

- https://developer.paypal.com/docs/support
- https://developer.paypal.com/support
    - https://www.paypal-community.com
        - https://www.paypal-support.com
- https://www.paypal.com/us/cshelp/business
- https://www.paypal.com/us/cshelp/contact-us

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
- Paypal's ApplePay: https://developer.paypal.com/docs/checkout/apm/apple-pay
- https://developer.apple.com/apple-pay/sandbox-testing

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
