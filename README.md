# Bootstrap CMS for Laravel

This package is a Content Management System for a laravel website with all the common features available.
It has a fully functional backend for administering the website and uses Laravel 5.*, bootstrapCSS, jquery, fontawesome, DataTables, Tinymce, etc.

It is very simple to setup and use. One will only need to create a theme for their website using blade templates as would be necessary.

## Installation

### Through Composer

```bash
composer require gogilo/admin

```

#### Or

You can also update your composer.json as follows

```json
"require": {
    "gogilo/admin": "dev-master"
}
```

then run

```bash
composer update
```

### Add service provider to the list of providers

This step is optional for those using Laravel 5.5 and above, as the package is discoverable by laravel. But incase you disable discovarability for this package or if you are using a lower version of Laravel, you can always add this service provider to you list of service providers in the config/app.php file

```php
Ogilo\AdminMd\AdminServiceProvider::class,
```

### Handling guest access to the admin routes

To ensure the user is directed to the correct login page why trying to access the admin page, modify the unauthenticated() function inthe app/Exceptions/Handler.php by adding

```php
if(is_admin_path()){
    return redirect()->guest('admin/login');
}
```

in case the function is not already in your exceptions handler class, you can just add the function below to overide the inherited function.

```php
/**
* Convert an authentication exception into a response.
*
* @param  \Illuminate\Http\Request  $request
* @param  \Illuminate\Auth\AuthenticationException  $exception
* @return \Symfony\Component\HttpFoundation\Response
*/
protected function unauthenticated($request, \Illuminate\Auth\AuthenticationException $exception)
{
    if (is_admin_path()) {
        return redirect()->guest('admin/login');
    }

    if ($request->expectsJson()) {
        return response()->json(['error' => 'Unauthenticated.'], 401);
    }

    return redirect()->guest('login');
}
```

### Install or Update

run artisan admin:intsal/admin:update command to create all the neccesary tables for the CMS including all roles and user tables as well as publish all required resources;

This Commands will install all frontend components, create the neccesary database structure(perform migrations) and publish neccesary recsources for the package.

```bash
php artisan admin:install
```

After every update of gogilo/admin, it's neccesary to run the admin:update command as this will fix any database structure changes, any theme changes and also perform neccesary cleanup/houskeeping.

```bash
php artisan admin:update
```

### Guards and Auth Providers

Update the config/auth.php file to include the admins provider and admin guard

To the list of your auth providers, add

```php
'admins' => [
    'driver' => 'eloquent',
    'model' => Ogilo\AdminMd\Models\Admin::class,
],
```

To the list of your guards, add

```php
'admin' => [
    'driver' => 'session',
    'provider' => 'admins',
],
```

remember for api too

```php
'api' => [
    'driver' => 'token',
    'provider' => 'admins',
    'hash' => false,
],
```

Add the login route to the routes/web.php

```php
Route::get('admin/login',[Ogilo\AdminMd\Http\Controllers\AuthController::class,'getLogin'])->name('login');
```

### Extending Admin

You can easily add more items to the admin section of the CMS by creating your iwn custom content type and providing links to the content type you have created. It can either be in your application by adding a couple of Controllers, Models and Views.

#### Routes

Ensure that your routes are protected by "auth:admin" guard

##### Example

```php
Route::group(['middleware'=>'auth:admin','prefix'=>'admin','as'=>'admin'],function(){
    Route::get('',['as'=>'-example','uses'=>'SomeController@someMethod']);
});
```

this will create a route named admin-example with uri /admin/example

#### Menu

Add your Item to the admin menu/nav by adding it to the admin.menu config. This you should do in the boot method of the application's/package's service provider class.

###### Example

```php
class AppServiceProvider{
    ...
    function boot(){
        config(['admin.menu.admin-example'=>'Examples']);
    }
    ...
}
```

##### Sub Menus

You can also create a dropdown menu(s) using the above simple configurations. Use your config name as the key while the submenu(s) and items will take place of the caption as an array of submenus.

###### Example

```php
function boot(){
        config(['admin.menu.admin-example'=>[
            [
                'caption'=>'Menu One',
                'submenu'=>[
                    'menu-one-route-name-one'=>'Caption One',
                    'menu-one-route-name-two'=>'Caption Two',
                    'menu-one-route-name-three'=>'Caption Three',
                    'menu-one-route-name-four'=>'Caption Four',
                ]
            ],[
                'caption'=>'Menu Two',
                'submenu'=>[
                    'menu-two-route-name-one'=>'Menu 2 Caption One',
                    'menu-two-route-name-two'=>'Menu 2 Caption Two',
                    'menu-two-route-name-three'=>'Menu 2 Caption Three',
                    'menu-two-route-name-four'=>'Menu 2 Caption Four',
                    'menu-two-route-name-five'=>'Menu 2 Caption Five',
                ]
            ]
        ]]);
    }
```

If you only have one sub-menu, you can just pass the array to the root key as shown below

```php
function boot(){
    config(['admin.menu.admin-example'=>
        [
            'caption'=>'Menu One',
            'submenu'=>[
                'menu-one-route-name-one'=>'Caption One',
                'menu-one-route-name-two'=>'Caption Two',
                'menu-one-route-name-three'=>'Caption Three',
                'menu-one-route-name-four'=>'Caption Four',
            ]
        ]
    ]);
}
```

**NOTE:** Each submenu must have a caption and submenu keys. The caption will be the caption of the menu while submenu cantains route caption key value pairs for all the items in the submenu.

To add a devider in the sub menu. just add a dash key value pair item 

```php
'-'=>'-'
```

```php
'submenu'=>[
        'menu-one-route-name-one'=>'Caption One',
        'menu-one-route-name-two'=>'Caption Two',
        '-'=>'-',
        'menu-one-route-name-three'=>'Caption Three',
        'menu-one-route-name-four'=>'Caption Four',
    ]
```

#### Views

Your views should:

1. extend the admin::layout.main.
2. Have the following sections on your view
    i) title
    ii page_title
    iii) breadcrumbs
    iv) sidebar
    v) content
    vi) styles
    vii) scripts_top
    viii) scripts_bottom

##### Example

```php
@extends('admin::layout.main')

@section('title')
    Title
@endsection

@section('page_title')
    <i class="fa fa-list-alt"></i> Item
@endsection

@section('breadcrumbs')
    @parent
    <li class="active"><span><i class="fa fa-list-alt"></i> Item</span></li>
@endsection

@section('sidebar')
    @parent
    {{-- @include('admin::some-additional sidebar items') --}}
@endsection

@section('content')
    Put content details
@endsection

@section('styles')
    <style type="text/css">

    </style>
@endsection
@section('scripts_top')
    <script type="text/javascript">

    </script>
@endsection

@section('scripts_bottom')
    <script type="text/javascript">

    </script>
@endsection
```

### Feedback form handling

Submit feedback by posting to the contact/post or contact-post route in Laravel. the following parameters need to be posted

```text
url: domain.tld/contact/post
OR
url: {{ route('contact-post') }}
```

and the data

```json
data:
{
    "name": "appropriate name",
    "email": "email@example",
    "phone": "valid phone number",
    "comments": "some comment text"
}
```

The name, email and comments fields are required.

#### Response

On submission of the comment, you'll get a json response for error or success

##### Error

```json
{
    "success": false,
    "message": "Additional error message"
}
```

##### Success

```json
{
    "success": true,
    "message": "Success message"
}
```

You can handle this response and give appropriate response.

## Input fileds in views

### Select

To enable select picker on you select fields, include the following properties for the select element

```html
<select class="selectpicker" data-live-search="true" data-size="5"></select>
```

#### Example

```html
<select name="selectInput" class="selectpicker" data-live-search="true" data-size="5">
<option>Text 1</option>
<option>Text 2</option>
<option>Text 3</option>
<option>Text 4</option>
</select>
```

## Frontend

You can now use vuejs in your admin pages. all admin related vuejs components along with any related sass files will be compiled into admin.js and admin.css files respectively, this therefore requires that you you modify the wbpack.mix.js to cover these two files. The following steps will help you in handling this situation.

### 1. Publish Vue Resources

run the publish artisan command with the tag vue-resources as follows

```bash
php artisan vendor:publish --tag=vue-resources
```

### 2. Update webpack.mix.js file

Add compilation of admin.js and admin.css to webpack config

```javascript
mix.js('resources/assets/js/app.js', 'public/js')
   .sass('resources/assets/sass/app.scss', 'public/css')
   .js('resources/assets/vendor/admin/js/admin.js','public/vendor/admin/js')
   .sass('resources/assets/vendor/admin/scss/admin.scss', 'public/vendor/admin/css');
```

## SETUP

Admin CMS is now equiped with a quick tool for webmasters to generate the sitemap of the website quickly and effeciently
use the url [site_url]/admin/setup

Click Grenerate Sitemap and one will be quickly generated for you on the website public_path

You also have the alternative of making using console by running the command

```bash
php artisan sitemap:generate
```

You can schedule the generation of the sitemap at regular intervals using laravel's task scheduler

```php
// app/Console/Kernel.php
protected function schedule(Schedule $schedule)
{
    ...
    $schedule->command('sitemap:generate')->daily();
    ...
}
```

Happy websiting

By George Ogilo
info@gogilo.com
https://www.gogilo.com
+254711347184/+254735388704
