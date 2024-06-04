# 1. Introduction:

Bagisto Marketplace Extension will convert your Bagisto store into a multi vendor marketplace with separate seller product collection, order management, feedback support ratings and commissions.

It packs in lots of demanding features that allows your business to scale in no time:

* Separate seller / vendor  profile / micro site .
* Seller can add banner , shop logo custom HTML text .
* Seller / Vendor product search in vendor panel .
* Separate seller's product collection.
* Feedback and review system with interactive star rating.
* Contact to seller support.
* Back-end admin product assignment for seller account.
* Interactive Seller Dashboard
* Stock Availability check .
* Vendor / Seller and Admin moderation and approval.
* Seller / Vendor Enable disable from admin of the store.
* This module provides an attractive landing page with top 4 sellers with their top 5 products.
* Allow to seller to edit shop URL for Profile page, collection page, review page, Location page.
* Admin can do the Landing page setting.
* Multi Lingual support  / All language working including RTL ( http://en.wikipedia.org/wiki/Right-to-left  hebrew and arabic).
* Product Edit and Delete option on seller panel.
* Interactive view for seller profile and easy to upload seller logo and banner with colors.
* Latest order at vendor dashboard and order management.
* Seller / Vendor transaction report at seller panel.
* Seller can check the refunded orders.
* All currencies Supported.
* Cart & Catalog rules Supported.


# 2. Installation:

```
git clone -b v1.2.0-BETA1 --single-branch --depth 1 git@github.com:bagisto/bagisto.git
cd bagisto
cp .env.example .env
```

Config DB:
```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=blah
DB_USERNAME=***
DB_PASSWORD=***
DB_PREFIX=
```

```
composer install
php artisan bagisto:install
```

## Add MultiVendor MarketPlace package

Merge-copy the "packages" and "storage" folders into the project root directory.

Goto `config/app.php` file and add the following line in 'providers': `Webkul\Marketplace\Providers\MarketplaceServiceProvider::class,`

Goto `composer.json` file and add following line in 'psr-4': `"Webkul\\Marketplace\\": "packages/Webkul/Marketplace/src"`

```
composer dump-autoload
composer require laravel/helpers
php artisan migrate
php artisan db:seed --class=Webkul\\Marketplace\\Database\\Seeders\\DatabaseSeeder 
php artisan route:cache
php artisan key:generate 
php artisan vendor:publish --force
```

Goto `config/app.php file` and set your 'default_country'

# 3. Vue

Unfortunately Vue isn't configured out-of-the-box in this Bagisto setup. To get Vue started:

## 1 Simplest example

Get Laravel's pre-existing ExampleComponent working:

`npm install`

In `resources/themes/velocity/views/layouts/master.blade.php` (the published `packages/Webkul/Velocity/src/Resources/views/shop/layouts/master.blade.php`): 

- Add `<example></example>` inside `<div id="app">`
- Add `<script type="text/javascript" src="{{ asset('js/app.js') }}"></script>` after `<div id="app">`

In `resources/assets/js/app.js`:

- Make sure you have this: `Vue.component('example-component', require('./components/ExampleComponent.vue').default);`
- Add the below function (this is just a temporary workaround for now):
```
Vue.mixin({
  methods: {
    isMobile: function () {
	    if (/Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent)) 
	    {
	    	return true;
	    } 
	    else 
	    {
	    	return false;
	    }
    },
  },
});
```

`npm run dev`

Note: In reality, you shouldn't be using `/resources/assets/js/app.js`, because it will clash with the existing `/public/themes/velocity/assets/js/velocity.js` . In fact, you shouldn't even be editing `/resources/assets/js/app.js` .

## 2 Bagisto's Vue components

Bagisto's Vue components are actually in here: https://github.com/bagisto/bagisto/tree/master/packages/Webkul/Velocity/src/Resources/assets/js . 

https://github.com/bagisto/bagisto/blob/master/packages/Webkul/Velocity/publishable/assets/js/velocity.js is the compiled https://github.com/bagisto/bagisto/blob/master/packages/Webkul/Velocity/src/Resources/assets/js/app.js

It is then published: https://github.com/bagisto/bagisto/blob/master/packages/Webkul/Velocity/src/Providers/VelocityServiceProvider.php#L82

That `/public/themes/velocity/assets/js/velocity.js` is already included in that `/resources/themes/velocity/views/layouts/master.blade.php` file.

So you can pick on from https://github.com/bagisto/bagisto/tree/master/packages/Webkul/Velocity/src/Resources/assets/js/UI/components (eg: `<mini-cart></mini-cart>`) and put it inside `<div id="app">`. Run `npm run dev` again and you will see the results.

## 3 Your own custom Vue components

Before everything, exclude any script-references to `/resources/assets/js/app.js` in your blade files.

First you need to see how https://github.com/bagisto/bagisto/tree/master/packages/Webkul/Velocity handles their Vue components:

- https://github.com/bagisto/bagisto/blob/master/packages/Webkul/Velocity/webpack.mix.js#L15 compiles https://github.com/bagisto/bagisto/blob/master/packages/Webkul/Velocity/src/Resources/assets/js/app.js to https://github.com/bagisto/bagisto/blob/master/packages/Webkul/Velocity/publishable/assets/js/velocity.js when `npm run prod` is run ( https://github.com/bagisto/bagisto/blob/master/packages/Webkul/Velocity/package.json#L9-L10 )
- Then https://github.com/bagisto/bagisto/blob/master/packages/Webkul/Velocity/src/Providers/VelocityServiceProvider.php#L81-L83 publishes https://github.com/bagisto/bagisto/blob/master/packages/Webkul/Velocity/publishable/assets/ to `/public/themes/velocity/assets/`
- `/public/themes/velocity/assets/js/velocity.js` is included in the `/resources/themes/velocity/views/layouts/master.blade.php` file.

However, it's not good to directly override their code. So to override:

- Copy the needed folders and files ( `webpack.mix.js`, `package.json` & `src/Resources/assets/` ) to our custom override-package (" `Custom/VelocityOverride`" ).
- `cd packages/Custom/VelocityOverride` and `npm install`
- Write your own custom Vue component in `src/Resources/assets/js/UI/components/` then registers it in `src/Resources/assets/js/UI/app.js`.
- `npm run prod` then `cd ../../..`
- Use your custom Vue component in your blade-override (eg: `/packages/Custom/VelocityOverride/src/Resources/views/shop/layouts/master.blade.php` ) files.
- Run `php artisan vendor:publish --tag=velocity_override --force` & `php artisan vendor:publish --tag=public_override --force`

# 4. How to use the site

## Admin Login

```
URL: {domain}/public/admin/login
Username: example
Email: admin@example.com
Password: admin123
```

## Normal User Signup

`{domain}/public/customer/register`

Opt to become a seller.

Clicks signup then login again.

Login as admin and approve the seller `{domain}/public/admin/marketplace/sellers`

Login as seller, create shop `{domain}/public/marketplace`

Might need to signin as seller again, then go to `{domain}/public/marketplace/account/edit`, enter details then save.

You can click View Seller Page `{domain}/public/marketplace/seller/profile/{shop-slug}` to see seller's info (not seller's shop's info)

Create new product: `{domain}/public/marketplace/account/catalog/products/create` , `{domain}/public/marketplace/account/catalog/products/edit/{id}`

Login as admin, activate product `{domain}/public/admin/catalog/products`

Now any customer can see the product at the frontend home page and add to cart and checkout.

# 5. View Override

Example, for: `{domain}/public/admin/catalog/products`

Original: `packages⁩/Webkul/⁨Admin⁩/⁨src⁩/Resources⁩/views⁩/catalog⁩/products/index.blade.php` 

Overridden by: ⁨`resources⁩/⁨views⁩/vendor⁩/admin⁩/catalog⁩/products/index.blade.php`

# 6. Purchase & Support

support@bagisto.com

Tutorials: https://bagisto.com/en/social-login-for-bagisto

- https://bagisto.com/en
	- https://bagisto.com/en/download
		- https://github.com/bagisto/bagisto/tree/v1.2.0-BETA1
		- https://webkul.com/blog/laravel-ecommerce-website
		
- https://bagisto.com/en/laravel-multi-vendor-marketplace
	- https://webkul.com/blog/laravel-multi-vendor-marketplace

---

# Also read

- https://bagisto.com/en/how-to-create-custom-payment-method-in-bagisto
- https://github.com/bagisto/bagisto/blob/2f1c999a5484b42f909379316a9565035554409c/packages/Webkul/Core/src/Database/Migrations/2018_07_20_064849_create_channels_table.php
