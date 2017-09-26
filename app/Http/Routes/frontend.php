<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/
Route::get('/test', function() {
    return view('frontend.email.thanks');
});


Route::group(['namespace' => 'Frontend'], function()
{
    Route::get('/', ['as' => 'home', 'uses' => 'HomeController@index']);   
    Route::get('/rss', ['as' => 'rss', 'uses' => 'HomeController@rss']);
    Route::post('/rating', ['as' => 'rating', 'uses' => 'HomeController@insertRating']);    
    Route::post('/send-contact', ['as' => 'send-contact', 'uses' => 'ContactController@store']);
    Route::post('/send-bao-gia', ['as' => 'send-thi-cong', 'uses' => 'ContactController@storeThiCong']);
    Route::post('/send-thiet-ke', ['as' => 'send-thiet-ke', 'uses' => 'ContactController@storeThietKe']);
    Route::get('tag/{slug}', ['as' => 'tag', 'uses' => 'DetailController@tagDetail']);
    Route::get('tin-tuc/{slug}', ['as' => 'news-list', 'uses' => 'NewsController@newsList']);
    Route::get('/tin-tuc/{slug}-p{id}.html', ['as' => 'news-detail', 'uses' => 'NewsController@newsDetail']);
    Route::get('/dich-vu/{slug}-s{id}.html', ['as' => 'services-detail', 'uses' => 'NewsController@newsDetail']);

    Route::get('{slug}-{id}.html', ['as' => 'product', 'uses' => 'DetailController@index']);
    
    
    
    Route::get('/dang-tin-ky-gui.html', ['as' => 'ky-gui', 'uses' => 'DetailController@kygui']);
    Route::get('/dang-tin-thanh-cong.html', ['as' => 'ky-gui-thanh-cong', 'uses' => 'DetailController@kyguiSuccess']);    
    Route::post('/post-ky-gui', ['as' => 'post-ky-gui', 'uses' => 'DetailController@postKygui']);    

    Route::post('/dang-ki-newsletter', ['as' => 'register.newsletter', 'uses' => 'HomeController@registerNews']);    
    
    Route::get('/tim-kiem.html', ['as' => 'search', 'uses' => 'HomeController@search']);

    Route::get('lien-he.html', ['as' => 'contact', 'uses' => 'HomeController@contact']);
    Route::get('dich-vu.html', ['as' => 'services', 'uses' => 'HomeController@services']);

    Route::get('{slug}.html', ['as' => 'pages', 'uses' => 'HomeController@pages']);    
    Route::get('{slugCateParent}', ['as' => 'cate-parent', 'uses' => 'CateController@cateParent']);    
    Route::get('{slugCateParent}/{slugCateChild}', ['as' => 'cate', 'uses' => 'CateController@cateChild']);


});

