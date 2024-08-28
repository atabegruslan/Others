# Payment Gateways

## Stripe

- Stripe developer dashboard: https://dashboard.stripe.com

![](/Illustrations/Development/ec/stripe_dashboard.png)

See "Payments" (left side) for the payment log

- https://docs.stripe.com/testing#cards

## Paypal

### Preliminaries

- SignUp to Paypal (Developer or not): https://www.paypal.com/en/webapps/mpp/country-worldwide , https://www.paypal.com/vn/signin . Using your real email and password (Not your sandbox accounts)

- Auto-generate sandbox Paypal accounts: https://developer.paypal.com/developer/accounts 

![](/Illustrations/Development/ec/paypal_developer_credentials.png)

![](/Illustrations/Development/ec/paypal_sandbox_accounts.png)

![](/Illustrations/Development/ec/paypal_sandbox_account_detail.png)

### REST API

https://developer.paypal.com/api/rest

**Step 1 - Auth**

https://developer.paypal.com/api/rest/authentication

![](/Illustrations/Development/ec/paypal_rest_1_auth.png)

**Responses**

Success
```
{
    "scope": "https://uri.paypal.com/services/checkout/one-click-with-merchant-issued-token https://uri.paypal.com/services/payments/futurepayments ...",
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
            ...
        ],
        "ui_type": "NEW"
    }
}
```

Failure
```
{
    "error": "invalid_client",
    "error_description": "Client Authentication failed"
}
```

**Step 2 - Create Order (or Payment)**

https://developer.paypal.com/docs/api/orders/v2/#orders_create

![](/Illustrations/Development/ec/paypal_rest_2_auth.png)

**Payload**
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

PS: Notice the usage of the return URLs. An alternative to it is Instant Payment Notification https://developer.paypal.com/api/nvp-soap/ipn  
Instead of redirecting back, Paypal silently gives back the result information.  

**Responses**

Success
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

**Failure**
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
array:5 [
  "name" => "INVALID_REQUEST"
  "details" => array:1 [
    0 => array:2 [
      "issue" => "PAYPAL_REQUEST_ID_REQUIRED"
      "description" => "A PayPal-Request-Id is required if you are trying to process payment for an Order. Please specify a PayPal-Request-Id or Create the Order without a 'payment_source' specified."
    ]
  ]
  "message" => "Request is not well-formed, syntactically incorrect, or violates schema."
  "debug_id" => "f84351255676d"
  "links" => array:1 [
    0 => array:3 [
      "href" => "https://developer.paypal.com/docs/api/orders/v2/#error-PAYPAL_REQUEST_ID_REQUIRED"
      "rel" => "information_link"
      "method" => "GET"
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

Bearer Token Expired
```
{
    "error": "invalid_token",
    "error_description": "Access Token not found in cache"
}
```

The returned Order ID is short lived (~2 hours). During that time you can retrive order information using it: https://developer.paypal.com/docs/api/orders/v2/#orders_get

In the long term, the order ID will expire and you will not be able to get order details. If a transaction was completed, you must use the transaction ID with the transaction search API to get that information.
https://developer.paypal.com/docs/api/transaction-search/v1/

**Step 3 - Redirect**

For customer to review and confirm their payment on PayPal's side 

**Step 4 - Capture**

Customer approves the payment from payer to payee. https://developer.paypal.com/docs/api/orders/v2/#orders_capture

In the context of PayPal, the term "CAPTURE" refers to the process of collecting payment from a customers account for a particular transaction. When a payment is authorized or approved, it is not immediately transferred to the merchant's account. Instead, the funds are put on hold within the customer's account. 

During the capture process, the merchant initiates the transfer of funds from the customer's account to their account. This typically happens when the goods or services have been delivered or rendered. Capturing the funds completes the payment process and ensures that the merchant receives the payment for the transaction. 

- https://stackoverflow.com/a/20436759

**Response**

Success
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
```

```
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

Failure
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

```
{
    "name": "UNPROCESSABLE_ENTITY",
    "details": [
        {
            "issue": "ORDER_ALREADY_CAPTURED",
            "description": "Order already captured.If 'intent=CAPTURE' only one capture per order is allowed."
        }
    ],
    "message": "The requested action could not be performed, semantically incorrect, or failed business validation.",
    "debug_id": "f4093615f4375",
    "links": [
        {
            "href": "https://developer.paypal.com/docs/api/orders/v2/#error-ORDER_ALREADY_CAPTURED",
            "rel": "information_link",
            "method": "GET"
        }
    ]
}
```

### JS SDK

- https://developer.paypal.com/sdk/js
- https://developer.paypal.com/sdk/js/configuration
- https://developer.paypal.com/studio/checkout/standard/integrate
- https://developer.paypal.com/docs/checkout/advanced/integrate/#link-addpaypalbuttonsandcardfields

**Step 1 - Auth**

**Step 2 - Order**

**Step 2a - `createOrder(data, links)`**

- `data`: `{paymentSource: 'paypal'}`
- `links`: `{"order":{},"payment":null}`

Checkout Paypal order should be done in here.  

https://developer.paypal.com/sdk/js/reference/#createorder

**Step 2b - `onApprove(data, actions)`**

The **response** (`data`) when using Paypal
```
billingToken: null
facilitatorAccessToken: "A21AAKM3Aoqv1cBYVpHg9-8i33elGM7bxCd97Yr3ZdgoXiD1eYl05g2lVTWov_DRYga0qEbGGFm50mEuQW0BhgBUpIRo-S_Yg"
orderID: "6SF99533Y2354682T"
payerID: "RSC8ZQ9JQRJXG"
paymentID: "6SF99533Y2354682T"
paymentSource: "paypal"
```

The **response** (`data`) when using Credit Card
```
orderID: "6BL93065U7701963D"
```

**Step 2c - `onError(error)`**

The **response** (`error`)
```
clientId: "AZ0JkHcFBaa1dkhd2rO58YiN1zahwbfd8jc7_sfQF_1-2Bal3KCDFaWFkzpX5z5SG9OlwmlGKn4vFHYZ"
csnwCorrelationId: "f47553443456f"
env: "sandbox"
err: "Error: /v2/checkout/orders/09E684306S227361C/confirm-payment-source returned status 422 (Corr ID: f519443ba968c).\n\n{\"name\":\"UNPROCESSABLE_ENTITY\",\"details\":[{\"field\":\"/payment_source/card/number\",\"location\":\"body\",\"issue\":\"VALIDATION_ERROR\",\"description\":\"Invalid card number\"}]..."
loadedInFrame: "non_paypal"
merchantId: []
referrer: "localhost:8000"
sessionId: "uid_89118d75a6_mde6mzc6mzu"
timestamp: "1724204670147"
uid: "uid_89118d75a6_mde6mzc6mzu"
userAction: "commit"
version: "5.0.456"
```

**Step 3 - Capture** 

Should be done in `onApprove(data)`

**Response**

Success
```
{
    "id": "67606836DE7840901",
    "status": "COMPLETED",
    "payment_source": {
        "card": {
            "name": "Aaa Bbb",
            "last_digits": "1881",
            "expiry": "2024-10",
            "brand": "VISA",
            "type": "UNKNOWN",
            "attributes": {
                "vault": {
                    "id": "8g8048225v9124622",
                    "status": "VAULTED",
                    "customer": {
                        "id": "yzNVpsiOPE"
                    },
                    "links": [
                        {
                            "href": "https:\/\/api.sandbox.paypal.com\/v3\/vault\/payment-tokens\/8g8048225v9124622",
                            "rel": "self",
                            "method": "GET"
                        },
                        {
                            "href": "https:\/\/api.sandbox.paypal.com\/v3\/vault\/payment-tokens\/8g8048225v9124622",
                            "rel": "delete",
                            "method": "DELETE"
                        },
                        {
                            "href": "https:\/\/api.sandbox.paypal.com\/v2\/checkout\/orders\/67606836DE7840901",
                            "rel": "up",
                            "method": "GET"
                        }
                    ]
                }
            },
            "bin_details": []
        }
    },
    "purchase_units": [
        {
            "reference_id": "default",
            "payments": {
                "captures": [
                    {
                        "id": "9SM43437VR644225Y",
                        "status": "COMPLETED",
                        "amount": {
                            "currency_code": "USD",
                            "value": "57.00"
                        },
                        "final_capture": true,
                        "seller_protection": {
                            "status": "NOT_ELIGIBLE"
                        },
                        "seller_receivable_breakdown": {
                            "gross_amount": {
                                "currency_code": "USD",
                                "value": "57.00"
                            },
                            "paypal_fee": {
                                "currency_code": "USD",
                                "value": "1.97"
                            },
                            "net_amount": {
                                "currency_code": "USD",
                                "value": "55.03"
                            }
                        },
                        "links": [
                            {
                                "href": "https:\/\/api.sandbox.paypal.com\/v2\/payments\/captures\/9SM43437VR644225Y",
                                "rel": "self",
                                "method": "GET"
                            },
                            {
                                "href": "https:\/\/api.sandbox.paypal.com\/v2\/payments\/captures\/9SM43437VR644225Y\/refund",
                                "rel": "refund",
                                "method": "POST"
                            },
                            {
                                "href": "https:\/\/api.sandbox.paypal.com\/v2\/checkout\/orders\/67606836DE7840901",
                                "rel": "up",
                                "method": "GET"
                            }
                        ],
                        "create_time": "2024-08-22T05:10:48Z",
                        "update_time": "2024-08-22T05:10:48Z",
                        "network_transaction_reference": {
                            "id": "022880997781778",
                            "network": "VISA"
                        },
                        "processor_response": {
                            "avs_code": "A",
                            "cvv_code": "M",
                            "response_code": "0000"
                        }
                    }
                ]
            }
        }
    ],
    "links": [
        {
            "href": "https:\/\/api.sandbox.paypal.com\/v2\/checkout\/orders\/67606836DE7840901",
            "rel": "self",
            "method": "GET"
        }
    ]
}
```

**Step 4 (auto) - Confirm Payment Source**  (for payment with credit card)

`POST /v2/checkout/orders/6BL93065U7701963D/confirm-payment-source`

**Response** 

Success
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

**Failure**
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

#### Vault - For Saving Payment Methods

Save credit cards in Vault: 

- https://developer.paypal.com/docs/checkout/save-payment-methods/during-purchase/js-sdk/cards
- https://developer.paypal.com/docs/checkout/save-payment-methods/purchase-later/payment-tokens-api/cards

**Step 1 - Save during order**

**First timer's order payload**
```
{
    "intent": "CAPTURE",
    "purchase_units": [
        { ...
        }
    ],
    "payment_source": {
        "card": {
            // "name": "Firstname Lastname",
            // "billing_address": {
            // },
            "attributes": {
                "verification" : {
                    "method": "SCA_ALWAYS"
                },
                "vault": {
                    "store_in_vault": "ON_SUCCESS"
                }
            }
        }
    }
}
```

**Returnee's order payload**
```
{
    "intent": "CAPTURE",
    "purchase_units": [
        {
        }
    ],
    "payment_source": {
        "card": {
            // "name": "Firstname Lastname",
            // "billing_address": {
            // },
            "attributes": {
                "customer" : {
                    "id": "LLjCvrsDkR"
                },
                "vault": {
                    "store_in_vault": "ON_SUCCESS"
                }
            }
        }
    }
}
```

**Step 2 - Capture the payment**

The response contains the customer ID and the saved card's ID.

**Step 3 - Retrieve saved card**

Retrieve all your saved cards' ID using customer ID: `GET /v3/vault/payment-tokens?customer_id={customerId}`

**Step 4 - Pay with saved card**

https://developer.paypal.com/docs/checkout/save-payment-methods/purchase-later/payment-tokens-api/cards/#link-usesavedpaymenttoken

**Returnee's order payload**
```
{
    "intent": "CAPTURE",
    "purchase_units": [
        {...
        }
    ],
    "payment_source": {
        "card": {
            "vault_id":"26s98413kp959840m"
        }          
    }
}
```

PS: No need to capture here

### Omnipay library for Paypal

Checkout order response
```
Array (
    [id] => PAYID-M2IK4BI6R537860XT1277453 
    [intent] => sale 
    [state] => approved 
    [cart] => 4W444739J44028549 
    [payer] => Array (
        [payment_method] => paypal 
        [status] => VERIFIED 
        [payer_info] => Array ( 
            [email] => sb-sg0ld782482@personal.example.com 
            [first_name] => John 
            [last_name] => Doe 
            [payer_id] => WD2K39ARGH7EL 
            [shipping_address] => Array ( 
                [recipient_name] => John Doe 
                [line1] => 1 Main St 
                [city] => San Jose 
                [state] => CA 
                [postal_code] => 95131 
                [country_code] => US 
            ) 
            [country_code] => US 
        ) 
    ) 
    [transactions] => Array ( 
        [0] => Array ( 
            [amount] => Array ( 
                [total] => 11.00 
                [currency] => USD 
                [details] => Array ( 
                    [subtotal] => 11.00 
                    [shipping] => 0.00 
                    [insurance] => 0.00 
                    [handling_fee] => 0.00 
                    [shipping_discount] => 0.00 
                    [discount] => 0.00 
                ) 
            ) 
            [payee] => Array ( 
                [merchant_id] => YQU2LUQB75CXS 
                [email] => sb-opxam783557@business.example.com 
            ) 
            [item_list] => Array ( 
                [shipping_address] => Array ( 
                    [recipient_name] => John Doe 
                    [line1] => 1 Main St 
                    [city] => San Jose 
                    [state] => CA 
                    [postal_code] => 95131 
                    [country_code] => US 
                ) 
            ) 
            [related_resources] => Array ( 
                [0] => Array ( 
                    [sale] => Array ( 
                        [id] => 1A307792V3848154J 
                        [state] => completed 
                        [amount] => Array ( 
                            [total] => 11.00 
                            [currency] => USD 
                            [details] => Array ( 
                                [subtotal] => 11.00 
                                [shipping] => 0.00 
                                [insurance] => 0.00 
                                [handling_fee] => 0.00 
                                [shipping_discount] => 0.00 
                                [discount] => 0.00 
                            ) 
                        ) 
                        [payment_mode] => INSTANT_TRANSFER 
                        [protection_eligibility] => ELIGIBLE 
                        [protection_eligibility_type] => ITEM_NOT_RECEIVED_ELIGIBLE,UNAUTHORIZED_PAYMENT_ELIGIBLE 
                        [transaction_fee] => Array ( 
                            [value] => 0.87 
                            [currency] => USD 
                        ) 
                        [parent_payment] => PAYID-M2IK4BI6R537860XT1277453 
                        [create_time] => 2024-07-12T04:16:28Z 
                        [update_time] => 2024-07-12T04:16:28Z 
                        [links] => Array (
                            [0] => Array ( 
                                [href] => https://api.sandbox.paypal.com/v1/payments/sale/1A307792V3848154J 
                                [rel] => self 
                                [method] => GET 
                            ) 
                            [1] => Array ( 
                                [href] => https://api.sandbox.paypal.com/v1/payments/sale/1A307792V3848154J/refund 
                                [rel] => refund 
                                [method] => POST 
                            ) 
                            [2] => Array ( 
                                [href] => https://api.sandbox.paypal.com/v1/payments/payment/PAYID-M2IK4BI6R537860XT1277453 
                                [rel] => parent_payment 
                                [method] => GET 
                            ) 
                        ) 
                    ) 
                ) 
            ) 
        ) 
    ) 
    [failed_transactions] => Array ( ) 
    [create_time] => 2024-07-12T04:16:05Z 
    [update_time] => 2024-07-12T04:16:28Z 
    [links] => Array ( 
        [0] => Array ( 
            [href] => https://api.sandbox.paypal.com/v1/payments/payment/PAYID-M2IK4BI6R537860XT1277453 
            [rel] => self 
            [method] => GET 
        ) 
    ) 
) 
```

### Pay later

- Pay in 4

- Pay monthly

### Split pay

### CSS / Styling

- Paypal: https://developer.paypal.com/sdk/js/reference
- Credit Card: https://developer.paypal.com/docs/checkout/advanced/customize/card-field-style
- Apple Pay Button:
```
<style>
    /* Apply styles to the container */
    #applepay-container {
        /* Add any desired styles to the container */
    }
    
    /* Apply styles to the button */
    apple-pay-button[type="plain"] {
        /* Add your desired styles to the button */
    }
</style>

<div id="applepay-container">
    <apple-pay-button id="applepay_button" buttonstyle="black" type="plain" locale="en"></apple-pay-button>
</div>
```

### Tools

Test cards: https://developer.paypal.com/tools/sandbox/card-testing

Seller see payment log: https://www.sandbox.paypal.com/mep/dashboard

Seller's settings: https://www.paypal.com/businessmanage/account/accountAccess

Fees:
- https://www.paypal.com/US/webapps/mpp/merchant-fees
- https://www.paypal.com/vn/cshelp/topic/help_my_account_business/help_tax_information_business

Force fails:
- https://developer.paypal.com/tools/sandbox/card-testing/#link-simulatecarderrorscenarios
- https://www.paypal.com/us/cshelp/article/how-do-i-test-failed-transactions-in-the-paypal-sandbox-ts1259
    - https://developer.paypal.com/tools/sandbox/negative-testing/request-headers

Help:
- https://developer.paypal.com/docs/support
- https://developer.paypal.com/support
    - https://www.paypal-community.com
        - https://www.paypal-support.com
        - https://www.paypal-support.com/s
- https://www.paypal.com/us/cshelp/business
- https://www.paypal.com/us/cshelp/contact-us

## Paypal's Venmo

### Intro

- https://www.youtube.com/watch?v=itpIJ7ewn4E
- https://www.youtube.com/watch?v=kTKNRrKADKc

### Docs

- https://developer.paypal.com/docs/checkout/pay-with-venmo/integrate
- https://venmo.com/gettingstarted/apipayment
- https://venmo.com/docs/overview
- https://venmo.com/developers

### Account

- https://venmo.com/gettingstarted/createapp
- https://account.venmo.com

### Eligibility

- https://github.com/eileenmcnaughton/nz.co.fuzion.omnipaymultiprocessor/blob/master/docs/Paypal.md#venmo
- https://developer.paypal.com/docs/checkout/pay-with-venmo/#link-eligibility

![](/Illustrations/Development/ec/Paypal/account_prerequisites_1.png)

![](/Illustrations/Development/ec/Paypal/account_prerequisites_2.png)

## Google Pay & Apple Pay

If paying from iPhone in a EC website, it's like: https://github.com/atabegruslan/Others/raw/master/Illustrations/Development/ec/applepay.mp4

If paying at a physical supermarket: https://vt.tiktok.com/ZGe3XFrJd/

If paying from computer, there will be a QR code for your iPhone to scan

- https://www.youtube.com/watch?v=cHv8LqkbPHk
- Applepay: https://www.youtube.com/watch?v=mt5FEvoEHEk
- https://developer.apple.com/videos/play/tech-talks/111381
- Paypal's ApplePay: 
    - https://developer.paypal.com/docs/checkout/apm/apple-pay
    - https://www.youtube.com/watch?v=E3gUASHQMrU
    - https://github.com/rauljr7/ppcp_apms_apple_pay_tutorial/blob/main/script.js
- https://developer.apple.com/apple-pay/sandbox-testing

Supported on both Stripe and Paypal
- https://docs.stripe.com/apple-pay
- https://stripe.com/payments/apple-pay

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
