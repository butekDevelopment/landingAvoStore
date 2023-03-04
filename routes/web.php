<?php

use Illuminate\Support\Facades\Route;
// admin
Route::get('/admin/login', 'admin\Login@index');
Route::post('/admin/doLogin', 'admin\Login@doLogin');

Route::get('/admin/register','admin\Register@index');
Route::post('/admin/doRegister', 'admin\Register@doRegister');

// admin - Profile
Route::get('/admin/logOut', 'admin\Login@logOut');
Route::get('/admin/profile', 'admin\SettingProfile\ShowProfile@index');
Route::post('/admin/profile/update', 'admin\SettingProfile\ShowProfile@updateProfile');
Route::get('/admin/profile/changePassword', 'admin\SettingProfile\ChangePassword@index');
Route::post('/admin/profile/updatePassword', 'admin\SettingProfile\ChangePassword@updatePassword');

// admin - Landing Page content
Route::get('/admin', 'admin\LandingPage\HomeContent@index');
Route::post('/admin/banner/{banner}', 'admin\LandingPage\HomeContent@updateBanner');
Route::post('/admin/content/edit', 'admin\LandingPage\HomeContent@editContent');

// admin - Product Content
Route::get('/admin/productContent', 'admin\LandingPage\ProductContent@index');
Route::post('/admin/productContent/banner', 'admin\LandingPage\ProductContent@updateBanner');

// admin - Promotion content
Route::get('/admin/promotionContent', 'admin\LandingPage\PromotionContent@index');
Route::post('/admin/promotionContent/banner', 'admin\LandingPage\PromotionContent@updateBanner');

// admin - Product
Route::get('/admin/category', 'admin\Product\CategoryProduct@index');
Route::post('/admin/category/create', 'admin\Product\CategoryProduct@createCategory');
Route::post('/admin/category/update', 'admin\Product\CategoryProduct@updateCategory');
Route::get('/admin/category/delete/{id}', 'admin\Product\CategoryProduct@deleteCategory');

Route::get('/admin/product', 'admin\Product\Product@index');
Route::post('/admin/product/create', 'admin\Product\Product@createProduct');
Route::get('/admin/product/view/{id}', 'admin\Product\Product@viewProduct');
Route::get('/admin/product/edit/{id}', 'admin\Product\Product@editProduct');
Route::post('/admin/product/submit/edit/{id}', 'admin\Product\Product@saveEdit');
Route::get('/admin/product/delete/{id}', 'admin\Product\Product@deleteProduct');

// admin - ProductSale
Route::get('/admin/sale', 'admin\SaleEvent\Sale@index');
Route::post('/admin/sale/create', 'admin\SaleEvent\Sale@addEvent');
Route::get('/admin/sale/edit/{id}', 'admin\SaleEvent\Sale@editEvent');
Route::post('/admin/sale/saveEvent', 'admin\SaleEvent\Sale@saveEvent' );
Route::get('/admin/sale/view/{id}', 'admin\SaleEvent\Sale@viewEvent');
Route::get('/admin/sale/delete/{id}', 'admin\SaleEvent\Sale@deleteEvent');

Route::get('/admin/productSale', 'admin\SaleEvent\Product@index' );
Route::get('/admin/productSale/getProduct/{id}', 'admin\SaleEvent\Product@getProduct' );
Route::get('/admin/productSale/getDiscount/{id}', 'admin\SaleEvent\Product@getDiscount' );
Route::post('/admin/productSale/addNew', 'admin\SaleEvent\Product@addProductForSale' );
Route::get('/admin/productSale/view/{id}', 'admin\SaleEvent\Product@viewProductForSale' );
Route::get('/admin/productSale/delete/{id}', 'admin\SaleEvent\Product@deleteProductForSale' );
Route::get('/admin/productSale/edit/{id}', 'admin\SaleEvent\Product@editViewProductForSale' );
Route::post('/admin/productSale/saveEdit', 'admin\SaleEvent\Product@saveEditProductForSale' );

// landing Page
Route::get('/', 'landing\Home@index');
Route::get('/product', 'landing\Product@index');
Route::get('/product/detail/{id}', 'landing\Product@getDetail');
Route::get('/product/at/{category}', 'landing\Product@atCategory');
Route::get('/event', 'landing\EventProdcut@index');
Route::get('/event/detail/{id}', 'landing\EventProdcut@getDetailProductEvent');
