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

//登录相关
//Route::get('/login', ['as' => 'login', 'uses' => 'Auth\LoginController@showLoginForm']);
Route::get('/login', ['as' => 'login', 'uses' => 'Auth\LoginController@loginForm']);

Route::post('/login', ['as' => 'post.login', 'uses' => 'Auth\LoginController@login']);

Route::get('/register', ['as' => 'register', 'uses' => 'Auth\RegisterController@register']);
Route::get('/reset-password/reset-password', ['as' => 'reset-password.reset-password', 'uses' => 'Auth\ResetPasswordController@resetPassword']);
Route::get('/logout', ['as' => 'logout', 'uses' => 'Auth\LoginController@logout']);

//Route::get('/', ['as' => 'home.index', 'uses' => 'HomeController@exhibition']);
//Route::get('/', ['as' => 'home.index', 'uses' => 'HomeController@index']);
Route::get('/', ['as' => 'home.index', 'uses' => 'Developer\HomeController@index']);

Route::get('/error', ['as' => 'error', 'uses' => 'HomeController@error']);
Route::get('/home', ['as' => 'home.index', 'uses' => 'HomeController@exhibition']);

Route::get('auth/weixin', ['as' => 'auth.weixin', 'uses' => 'Auth\WeixinController@redirectToProvider']);
Route::get('auth/weixin/callback', ['as' => 'auth.weixin.callback', 'uses' => 'Auth\WeixinController@handleProviderCallback']);

// 供应商列表
Route::get('/provider/list', ['as' => 'provider.list', 'uses' => 'Provider\ProviderListController@index']);

// 供应商企业基本信息
Route::get('/provider/enterprise-info/{provider_id}',
    ['as' => 'provider.enterprise-info', 'uses' => 'Provider\ProviderEnterpriseInfoController@index']);

//供应商工商信息
Route::get('/provider/business-info/{provider_id}',
    ['as' => 'provider.business-info', 'uses' => 'Provider\ProviderBusinessInfoController@index']);

//供应商历史项目
Route::get('/provider/history-project/{provider_id}',
    ['as' => 'provider.history-project', 'uses' => 'Provider\ProviderHistoryProjectController@index']);

// 供应商产品方案--产品列表
Route::get('/provider/product-scheme/{provider_id}/product',
    ['as' => 'provider.product-scheme.product', 'uses' => 'Provider\ProviderProductSchemeController@productList']);
// 供应商产品方案--方案列表
Route::get('/provider/product-scheme/{provider_id}/scheme',
    ['as' => 'provider.product-scheme.scheme', 'uses' => 'Provider\ProviderProductSchemeController@schemeList']);
// 供应商产品方案--产品详细信息
Route::get('/provider/product-scheme/{provider_id}/product/{provider_product_id}',
    ['as' => 'provider.product-scheme.product.detail', 'uses' => 'Provider\ProviderProductSchemeController@productDetail']);
// 供应商产品方案--方案详细信息
Route::get('/provider/product-scheme/{provider_id}/scheme/{provider_scheme_id}',
    ['as' => 'provider.product-detail.scheme.detail', 'uses' => 'Provider\ProviderProductSchemeController@schemeDetail']);


//企业动态
Route::get('/provider/company-dynamic/list/{provider_id}',
    ['as' => 'provider.company-dynamic.list', 'uses' => 'Provider\ProviderCompanyDynamicController@index']);
Route::get('/provider/company-dynamic/{provider_id}/detail/{news_id}',
    ['as' => 'provider.company-dynamic.detail', 'uses' => 'Provider\ProviderCompanyDynamicController@detail']);

//供应商服务网点
Route::get('/provider/service-network/{provider_id}',
    ['as' => 'provider.service-network', 'uses' => 'Provider\ProviderServiceNetworkController@index']);

Route::group(['middleware' => 'auth.web'], function () {
    //个人中心页面 - 首页
    Route::get('/personal/home', ['as' => 'personal.home', 'uses' => 'Personal\HomeController@index']);
    //个人中心页面 - 账号信息
    Route::get('/personal/account/account-info', ['as' => 'personal.account.account-info', 'uses' => 'Personal\AccountInfoController@index']);

    //收藏项目
    Route::get('/personal/collection/collection-project', ['as' => 'personal.collection.collection-project', 'uses' => 'Personal\CollectionController@collectionProject']);
    //收藏供应商
    Route::get('/personal/collection/collection-provider', ['as' => 'personal.collection.collection-provider', 'uses' => 'Personal\CollectionController@collectionProvider']);
    //收藏产品
    Route::get('/personal/collection/collection-product', ['as' => 'personal.collection.collection-product', 'uses' => 'Personal\CollectionController@collectionProduct']);
    //收藏方案
    Route::get('/personal/collection/collection-scheme', ['as' => 'personal.collection.collection-scheme', 'uses' => 'Personal\CollectionController@collectionScheme']);

    //消息
    Route::get('/personal/message/list', ['as' => 'personal.message.list', 'uses' => 'Personal\MessageController@index']);
});

//关于房圈
Route::get('/station/about', ['as' => 'station.about', 'uses' => 'Station\StationController@about']);
Route::get('/station/contact', ['as' => 'station.contact', 'uses' => 'Station\StationController@contact']);
Route::get('/station/agreement', ['as' => 'station.agreement', 'uses' => 'Station\StationController@agreement']);
Route::get('/station/recruitmen', ['as' => 'station.recruitmen', 'uses' => 'Station\StationController@recruitmen']);


/***************************** 展会部分  *************************/

//展会概况
Route::get('/exhibition/flashback/index', ['as' => 'exhibition.flashback.index', 'uses' => 'Exhibition\ExhibitionController@flashbackIndex']);
Route::get('/exhibition/flashback/allaudio/{length}', ['as' => 'exhibition.flashback.allaudio', 'uses' => 'Exhibition\ExhibitionController@allAudios']);
Route::get('/exhibition/flashback/audio/{id}', ['as' => 'exhibition.flashback.audio', 'uses' => 'Exhibition\ExhibitionController@flashbackAudio']);
Route::get('/exhibition/flashback/detail/{id}', ['as' => 'exhibition.flashback.detail', 'uses' => 'Exhibition\ExhibitionController@flashbackDetail']);

Route::get('/exhibition/cooperation', ['as' => 'exhibition.cooperation', 'uses' => 'Exhibition\ExhibitionController@cooperation']);
Route::get('/exhibition/introduce', ['as' => 'exhibition.introduce', 'uses' => 'Exhibition\ExhibitionController@introduce']);
Route::get('/exhibition/activity', ['as' => 'exhibition.activity', 'uses' => 'Exhibition\ExhibitionController@activity']);
//展会服务
Route::get('/exhibition/service', ['as' => 'exhibition.service', 'uses' => 'Exhibition\ExhibitionController@service']);
//展会成果
Route::get('/exhibition/result', ['as' => 'exhibition.result', 'uses' => 'Exhibition\ExhibitionController@result']);
Route::get('/exhibition/result-detail/{id}', ['as' => 'exhibition.result-detail', 'uses' => 'Exhibition\ExhibitionController@resultDetail']);
//新闻资讯
Route::get('/information/list', ['as' => 'information.list', 'uses' => 'Information\InformationController@list']);

Route::get('/information/detail/{id}', ['as' => 'information.detail', 'uses' => 'Information\InformationController@detail']);
Route::get('/information/particulars/{id}', ['as' => 'information.particulars', 'uses' => 'Information\InformationController@particulars']);
//供应商列表
Route::get('/exhibition/provider/list', ['as' => 'exhibition.provider-list', 'uses' => 'Exhibition\ProviderController@providerList']);

//展开发商
Route::get('/exhibition/developer-list', ['as' => 'exhibition.developer-list', 'uses' => 'Exhibition\DeveloperController@developerList']);

//供应商一级分类
Route::get('/exhibition/new-provider-list', ['as' => 'exhibition.new-provider-list', 'uses' => 'Exhibition\ProviderController@newProviderList']);
//供应商二级分类
Route::get('/exhibition/provider/second-level', ['as' => 'exhibition.provider.second-level', 'uses' => 'Exhibition\ProviderController@secondLevel']);

Route::get('/review/list', ['as' => 'review.list', 'uses' => 'Review\ReviewController@index']);
Route::get('/review/detail/{id}', ['as' => 'review.detail', 'uses' => 'Review\ReviewController@detail']);

//供应商详情页
Route::get('/exhibition/provider/detail/{id}', ['as' => 'exhibition.provider.detail', 'uses' => 'Exhibition\ProviderController@ProviderDetail']);
//供应商工程案例
Route::get('/exhibition/provider/engineer-case/{provider_id}', ['as' => 'exhibition.provider.engineer-case', 'uses' => 'Exhibition\ProviderController@cases']);
//供应商产品展示
Route::get('/exhibition/provider/product-display/{provider_id}', ['as' => 'exhibition.provider.product-display', 'uses' => 'Exhibition\ProviderController@display']);
Route::get('/exhibition/provider/product-display/{provider_id}/detail/{product_id}', [
    'as' => 'exhibition.provider.product-display.detail', 'uses' => 'Exhibition\ProviderController@displayDetail']);

//服务网点
Route::get('/exhibition/provider/service-network/{provider_id}',
    ['as' => 'exhibition.provider.service-network', 'uses' => 'Exhibition\ProviderController@serviceNetwork']);

//开发商项目列表
Route::get('/exhibition/developer-project-list',
    ['as' => 'exhibition.developer-project-list', 'uses' => 'Exhibition\DeveloperController@developerProjectList']);

//开发商详项目详情
Route::get('/exhibition/developer/developer-detail/{id}',
    ['as' => 'exhibition.developer.developer-detail', 'uses' => 'Exhibition\DeveloperController@developerDetail'])
    ->middleware(['auth.web']);

//直播
Route::get('/exhibition/broadcast/detail',
    ['as' => 'exhibition.broadcast.detail', 'uses' => 'Exhibition\BroadcastController@detail']);

//深圳展会详情
Route::get('/tender/trendering/index',
    ['as' => 'tender.trendering.index', 'uses' => 'Tender\TrenderingController@index']);


// 开发商列表
//Route::get('/developer/list', ['as' => 'developer.list', 'uses' => 'Developer\DeveloperController@index']);
Route::get('/developer/list', ['as' => 'developer.list', 'uses' => 'HomeController@error']);


Route::get('/developer/developer-project/list', ['as' => 'developer.developer-project.list', 'uses' => 'Developer\DeveloperProjectController@index']);
Route::get('/developer/developer-project/detail/{developer_project_id}', ['as' => 'developer.developer-project.detail', 'uses' => 'Developer\DeveloperProjectController@detail']);

//新版本路由
//首页
Route::get('/developer/home', ['as' => 'developer.home', 'uses' => 'Developer\HomeController@index']);

//战略招采节点
Route::get('/developer/centrally-purchase/index',
    ['as' => 'developer.centrally-purchase.index', 'uses' => 'Developer\CentrallyPurchaseController@index']);

Route::get('/developer/centrally-purchase/detail/{id}',
    ['as' => 'developer.centrally-purchase.detail', 'uses' => 'Developer\CentrallyPurchaseController@detail']);

//合作开发商名录
Route::get('/developer/cooperation/cooperation',
    ['as' => 'developer.cooperation.cooperation', 'uses' => 'Developer\CooperationController@cooperation']);

//战略集采一览表
Route::get('/developer/cooperation/strategy-chart',
    ['as' => 'developer.cooperation.strategy-chart', 'uses' => 'Developer\CooperationController@strategyChart']);

//战略集采专区
Route::get('/developer/centrally-purchase/developer',
    ['as' => 'developer.centrally-purchase.developer', 'uses' => 'Developer\CentrallyPurchaseController@developer']);

Route::get('/developer/centrally-purchase/developer-project/{id}',
    ['as' => 'developer.centrally-purchase.developer-project', 'uses' => 'Developer\CentrallyPurchaseController@developerProject']);

Route::get('/developer/centrally-purchase/grade/{id}',
    ['as' => 'developer.centrally-purchase.grade', 'uses' => 'Developer\CentrallyPurchaseController@grade']);

Route::get('/developer/centrally-purchase/export',
    ['as' => 'developer.centrally-purchase.export', 'uses' => 'Developer\CentrallyPurchaseController@export']);

Route::get('/developer/centrally-purchase/project-detail/{id}',
    ['as' => 'developer.centrally-purchase.project-detail', 'uses' => 'Developer\CentrallyPurchaseController@projectDetail']);

Route::get('/developer/detail/{id}', ['as' => 'developer.detail', 'uses' => 'Developer\DeveloperController@detail']);

//非战略集采项目信息
Route::get('/developer/project-list', ['as' => 'developer.project-list', 'uses' => 'Developer\DeveloperController@projectList']);

Route::get('/developer/project-detail/{id}', ['as' => 'developer.project-detail', 'uses' => 'Developer\DeveloperController@projectDetail']);

Route::get('/developer/project-list/export', ['as' => 'developer.project-list.export', 'uses' => 'Developer\DeveloperController@projectListExport']);



//个人中心页面 - 首页
Route::get('/personal/main', ['as' => 'personal.main', 'uses' => 'Personal\MainController@index']);

//行业资讯
Route::get('/information/index', ['as' => 'information.index', 'uses' => 'Information\InformationController@index']);
Route::get('/information/infor-detail/{id}', ['as' => 'information.infor-detail', 'uses' => 'Information\InformationController@inforDetail']);

//个人中心页面 - 完善个人信息
Route::get('/personal/main/improve-information', ['as' => 'personal.main.improve-information', 'uses' => 'Personal\MainController@improveInformation']);


