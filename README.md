# Bootstrap CMS for Laravel
This package is a Content Management System for a laravel website with all the common features available.
It has a fully functional backend for administering the website and uses Laravel 5.*, bootstrapCSS, jquery, fontawesome, DataTables, Tinymce, etc.

It is very simple to setup and use. One will only need to create a theme for their website using blade templates as would be necessary.


## Installation
### Through Composer
```
composer require gogilo/admin
```

#### Or

You can also update your composer.json as follows

```
"require": {
    "gogilo/admin": "dev-master"
}
```

then run
```
composer update
```

### Add service provider to the list of providers
This step is optional for those using Laravel 5.5 and above, as the package is discoverable by laravel. But incase you disable discovarability for this package or if you are using a lower version of Laravel, you can always add this service provider to you list of service providers in the config/app.php file
```
Ogilo\AdminMd\AdminServiceProvider::class,
```

### Handling guest access to the admin routes
To ensure the user is directed to the correct login page why trying to access the admin page, modify the unauthenticated() function inthe app/Exceptions/Handler.php by adding 

```
if(is_admin_path()){
    return redirect()->guest('admin/login');
}
```
in case the function is not already in your exceptions handler class, you can just add the unction below to overide the inherited function.


```
protected function unauthenticated($request, \Illuminate\Auth\AuthenticationException $exception)
{
    if(is_admin_path()){
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
```
php artisan admin:install
```
After every update of gogilo/admin, it's neccesary to run the admin:update command as this will fix any database structure changes, any theme changes and also any perform any neccesary cleanup/houskeeping.

```
php artisan admin:update
```
### Guards and Auth Providers
Update the config/auth.php file to include the admins provider and admin guard

To the list of your auth providers, add

```
'admins' => [
    'driver' => 'eloquent',
    'model' => Ogilo\AdminMd\Models\Admin::class,
],
```

To the list of your guards, add
```
'admin' => [
    'driver' => 'session',
    'provider' => 'admins',
],
```

### Extending Admin
You can easily add more items to the admin section of the CMS by creating your iwn custom content type and providing links to the content type you have created. It can either be in your application by adding a couple of Controllers, Models and Views.
#### Routes
Ensure that your routes are protected by "auth:admin" guard
##### Example
```
Route::group(['middleware'=>'auth:admin','prefix'=>'admin','as'=>'admin'],function(){
    Route::get('',['as'=>'-example','uses'=>'SomeController@someMethod']);
});
```
this will create a route named admin-example with uri /admin/example
#### Menu
Add your Item to the admin menu/nav by adding it to the admin.menu config. This you should do in the boot method of the application's/package's service provider class.
##### Example
```
class AppServiceProvider{
    ...
    function boot(){
        config(['admin.menu.admin-example'=>'Examples']);
    }
    ...
}
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
```
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
```
url: domain.tld/contact/post
OR
url: {{ route('contact-post') }}
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
```
{
    "success": false,
    "message": "Additional error message"
}
```
##### Success
```
{
    "success": true,
    "message": "Success message"
}
```
You can handle this response and give appropriate response.

## Input fileds in views

### Select
To enable select picker on you select fields, include the following properties for the select element
```
class="selectpicker" data-live-search="true" data-size="5"
```

#### Example
```
<select name="selectInput" class="selectpicker" data-live-search="true" data-size="5">
<option>Text 1</option>
<option>Text 2</option>
<option>Text 3</option>
<option>Text 4</option>
</select>
```

By George Ogilo
info@gogilo.com
https://www.gogilo.com
+254711347184/+254735388704