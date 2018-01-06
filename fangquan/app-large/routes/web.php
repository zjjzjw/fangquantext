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

Route::get('/{p}', ['as' => 'home.index', 'uses' => 'HomeController@index'])->where('p', '[\d]+');

Route::get('/map', ['as' => 'home.map', 'uses' => 'HomeController@map']);

Route::get('/provider/provider/index',
    ['as' => 'provider.provider.index', 'uses' => 'Provider\ProviderController@index']);
Route::get('/provider/provider/second',
    ['as' => 'provider.provider.second', 'uses' => 'Provider\ProviderController@second']);

Route::get('/provider/provider/detail/{id}',
    ['as' => 'provider.provider.detail', 'uses' => 'Provider\ProviderController@detail']);


Route::get('/developer/developer/index',
    ['as' => 'developer.developer.index', 'uses' => 'Developer\DeveloperController@index']);

Route::get('/developer/developer-project/index',
    ['as' => 'developer.developer-project.index', 'uses' => 'Developer\DeveloperProjectController@index']);

Route::get('/developer/developer-project/detail/{id}',
    ['as' => 'developer.developer-project.detail', 'uses' => 'Developer\DeveloperProjectController@detail']);


//供应商工程案例
Route::get('/provider/engineer-case/{id}',
    ['as' => 'provider.provider.engineer-case', 'uses' => 'Provider\ProviderController@cases']);
//供应商产品展示
Route::get('/provider/product-display/{id}',
    ['as' => 'provider.provider.product-display', 'uses' => 'Provider\ProviderController@display']);
//服务网点
Route::get('/provider/service-network/{id}',
    ['as' => 'provider.provider.service-network', 'uses' => 'Provider\ProviderController@serviceNetwork']);


Route::get('/provider/product-display/{provider_id}/detail/{product_id}', [
    'as' => 'provider.product-display.detail', 'uses' => 'Provider\ProviderController@displayDetail']);


