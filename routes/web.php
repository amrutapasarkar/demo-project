<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
/* -------Admin theme routes----------*/
/*--------Admin login route----------*/
Route::get('/', function () {
  return view('login');
});

/*----------Admin dashboard route-------*/
Route::get('/dashboard', 'HomeController@index')->name('dashboard');

/*----------Logout route-----------------*/
Route::get('/logout', function () {
  return view('login');
});

Route::get('/category-dropdown/{id}','DropdownController@subCategories');

Route::get('/country-dropdown/{id}','DropdownController@states');

Route::get('/address-dropdown/{id}','DropdownController@address');

Route::group(['middleware' => ['auth']], function() {
 
//Route::resource('users','UserController');
//Route::resource('roles','RoleController');
});

/*------------------Routes for user management-------------*/
Route::get('users','UserController@index')->name('users.index')->middleware('permission:user-list');
Route::post('users','UserController@store')->name('users.store');
Route::get('users/create','UserController@create')->name('users.create')->middleware('permission:role-create');
Route::get('users/{users}','UserController@show')->name('users.show');
Route::patch('users/{users}','UserController@update')->name('users.update');
Route::delete('users/{users}','UserController@destroy')->name('users.destroy');
Route::get('users/{users}/edit','UserController@edit')->name('users.edit')->middleware('permission:user-edit');

/*------------------Routes for role management-------------*/
Route::get('roles','RoleController@index')->name('roles.index')->middleware('permission:role-list');
Route::post('roles','RoleController@store')->name('roles.store');
Route::get('roles/create','RoleController@create')->name('roles.create')->middleware('permission:role-create');
Route::get('roles/{roles}','RoleController@show')->name('roles.show');
Route::patch('roles/{roles}','RoleController@update')->name('roles.update');
Route::delete('roles/{roles}','RoleController@destroy')->name('roles.destroy');
Route::get('roles/{roles}/edit','RoleController@edit')->name('roles.edit')->middleware('permission:role-edit');

Auth::routes();

/*------------------Route for configuration management--------------*/
Route::resource('admin/configurations', 'Admin\\ConfigurationsController')->middleware('role:admin');

/*------------------Route for banner management--------------*/
Route::resource('admin/banners', 'Admin\\BannersController')->middleware('role:admin');

/*------------------Route for category management------------------*/
Route::resource('admin/category', 'Admin\\categoryController');

/*------------------Route for product management-------------------*/
Route::resource('admin/product', 'Admin\\ProductController');

/*------------------Route for coupon management-------------------*/
Route::resource('admin/coupon', 'Admin\\CouponController');

/*------------------Routes for Order Management-------------*/
Route::get('/indexorder','Frontend\\OrderManagementController@index');
Route::get('/showorder/{id}','Frontend\\OrderManagementController@show');
Route::get('/editorder/{id}/edit','Frontend\\OrderManagementController@edit');
Route::patch('/updateorder/{id}/{email}/update','Frontend\\OrderManagementController@update')->name('updateorder');


/*--------Frontend Eshopper routes----------*/

/*--------Route for frontend dashboard------*/
Route::get('/Eshopper','Frontend\\DashboardController@showDashboard');

/*--------Route for frontend login------*/
Route::get('/Eshopperlogin', function () {
  return view('Eshopper.login');
})->name('Eshopperlogin');
Route::post('Userlogin','Frontend\FrontendLoginController@login')->name('Userlogin');

/*-----------Route for frontend user logout-----------*/
Route::post('Userlogout','Frontend\FrontendLoginController@logout')->name('Userlogout');

/*-----------Route for user registration--------------*/
Route::post('UserRegistration','Frontend\FrontendLoginController@store')->name('UserRegistration');

/*-----------Route for password reset-----------------*/
Route::get('/reset-password', function () {
  return view('Eshopper.reset_password');
})->name('reset-password');

/*---------Route for cart procssing---------*/
Route::get('/cart','Frontend\\CartController@total')->name('cart');
Route::get('/addcart/{id}','Frontend\\CartController@cartStore');
Route::get('/removeproduct/{rowid}','Frontend\\CartController@removeproduct');
Route::get('/incrementQuantity/{rowid}/{rowqty}','Frontend\\CartController@incrementQuantity');
Route::get('/decrementQuantity/{rowid}/{rowqty}','Frontend\\CartController@decrementQuantity');


/*---------Route for frontend product information---------*/
Route::get('/product/{id}','Frontend\\DashboardController@product');
Route::get('/productinfo','Frontend\\DashboardController@categories')->name('productinfo');
Route::get('/product-details/{id}','Frontend\\ProductDetailsController@ShowProductDetails');

/*---------Route for user wishlist---------*/
Route::get('/addcartbywishlist/{id}','Frontend\\WishlistController@cartStorebywishlist');

/*---------Route for coupon discount---------*/
Route::get('/couponDiscount/','Frontend\\CouponController@couponDiscount')->name('coupon');

/*---------Route for page not found----------*/
Route::get('/404', function () {
  return view('Eshopper.404');
})->name('404');

/*-----------Route for blog---------------------------*/
Route::get('/blog', function () {
  return view('Eshopper.blog');
})->name('blog');

Route::get('/blog-single', function () {
  return view('Eshopper.blog-single');
})->name('blog-single');

/*------------Routes for google login-----------*/
Route::get('google', function () {
  return view('googleAuth');
});   
Route::get('auth/google', 'Auth\LoginController@redirectToGoogle');
Route::get('login/google/callback', 'Auth\LoginController@handleGoogleCallback');

/*------------Routes for forgot password--------*/
Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
Route::get('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
Route::get('password/reset/{token}','Auth\ResetPasswordController@showResetForm')->name('password.reset');
Route::get('password/reset', 'Auth\ResetPasswordController@reset');

/*------------Route for user address-----------*/
Route::resource('/address', 'Admin\\addressController');
Route::get('address', 'Admin\\addressController@index')->name('address');
Route::get('/admin/address/{id}/edit', 'Admin\\addressController@edit');
Route::patch('/admin/address/{id}/update', 'Admin\\addressController@update');


/*------------Route for checkout processing---------*/
Route::get('checkOut','Frontend\\CheckoutController@address')->name('checkOut');
Route::post('check', ['as' => 'checkout', 'uses' => 'Frontend\\CheckoutController@checkout']);
Route::post('/removeproductfromcart/{id}','Frontend\\CheckoutController@removeProductFromCart');

/*-------------Route for paypal----------*/
Route::get('paywithpaypal', array('as' => 'addmoney.paywithpaypal','uses' => 'Frontend\\PayPalController@payWithPaypal',));
Route::post('paypal', array('as' => 'addmoney.paypal','uses' => 'Frontend\\PayPalController@postPaymentWithpaypal'));
Route::get('paypal', array('as' => 'payment.status','uses' => 'Frontend\\PayPalController@getPaymentStatus',));

/*-------------Wishlist routes------------*/
Route::get('wishlist/{id}','Frontend\\CheckoutController@wishlist')->name('wishlist');
Route::get('/showwishlist','Frontend\\CheckoutController@showwishlist')->name('showwishlist');

/*-------------Routes for MyAccount---------*/
Route::get('/MyAccount','Frontend\\MyAccountController@showAccountForm')->name('showAccountForm');
Route::post('/UpdateAccountInfo','Frontend\\MyAccountController@updateAccountForm')->name('updateAccountForm');

/*-------------Route for MyOrders------------*/
Route::get('/MyOrders','Frontend\\MyOrdersController@showOrders')->name('showOrdersForm');

/*-------------Routes for TrackOrders------------*/
Route::get('/TrackOrders', function () {
  return view('Eshopper.track_order');
});
Route::post('/viewOrderDetails','Frontend\\MyOrdersController@trackOrders')->name('trackOrders');

/*-------------Raute for Change Password-------*/
Route::post('/changePassword','Frontend\\MyAccountController@changePassword')->name('changePassword');

/*-------------Raute for ContactUS-------------*/
Route::get('/contact', function () {
  return view('Eshopper.contact-us');
})->name('contact');
Route::resource('admin/contact-us', 'Admin\\ContactUsController');

/*-------------Newsletter---------------*/
Route::post('newsletter','Frontend\\NewsletterController@store');

/*------------Admin email template-------*/
Route::get('/indextemplate','Frontend\\EmailTemplateController@index')->name('indextemplate');
Route::get('/addtemplate', function () {
  return view('add_template');
})->name('addtemplate');
Route::post('/storeTemplate','Frontend\\EmailTemplateController@store')->name('storeTemplate');
Route::get('/editTemplate/{id}','Frontend\\EmailTemplateController@edit');
Route::post('/updateTemplate/{id}','Frontend\\EmailTemplateController@updatetemplate');
Route::get('/showTemplate/{id}','Frontend\\EmailTemplateController@show');

/*-------------Route for Sales reports----------*/
Route::get('/SalesReport','ReportsController@showSalesReports');
Route::get('/salesReport','ReportsController@dateRangeRecords')->name('daterange.fetch_data');

/*-------------Route for Customer reports----------*/
Route::get('/CustomerReport','ReportsController@showCustomerReports');
Route::get('/customerReport','ReportsController@dateRangeRecordsofCustomer')->name('daterange.fetch_customer_data');

/*-------------Route for Coupon reports----------*/
Route::get('/CouponReport','ReportsController@showCouponsReports');
Route::get('/couponReport','ReportsController@dateRangeRecordsofCoupons')->name('daterange.fetch_coupons_data');

/*-------------Routes for Cms Management----------------*/
Route::get('/CMS','Frontend\\CmsManagementController@showCMSForm');
Route::get('/CMSindex','Frontend\\CmsManagementController@index')->name('CMSindex');
Route::post('/CMSstore','Frontend\\CmsManagementController@store')->name('storeCMS');
Route::get('/showCMS/{id}','Frontend\\CmsManagementController@show');
Route::get('/editCMS/{id}/edit','Frontend\\CmsManagementController@edit');
Route::patch('/updateCMS/{id}','Frontend\\CmsManagementController@update')->name('updateCMS');

/*------------Route for ajaxdemo--------------*/
Route::get('/ajaxdemo', function(){
  return view('ajax');
});
Route::post('/savetodb','demoController@save')->name('savetodb');
Route::get('/display','demoController@show')->name('show');

//------------Route for Cms page loading-------*/
Route::get('{page}', function($name){
  $page = \App\Cms::where('name',$name)->get();
  $count = \App\Cms::where('name',$name)->count();
  if($count != 0){
    return view('cms_page', compact('page'));
  } else {
    return view('Eshopper.404');
  }
  
});
