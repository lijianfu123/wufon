<?php

use think\facade\Route;

//单页面
Route::get('intro_detail:id', 'Intro/detail');

//新闻
Route::get('news_index', 'News/index');
Route::get('news_commend:news_class_id', 'News/commend');
Route::get('news_new:news_class_id', 'News/new');
Route::get('news_hot:news_class_id', 'News/hot');
Route::get('news_list:news_class_id', 'News/list');
Route::get('news_detail:id', 'News/detail');

//商品
Route::get('product_index', 'Product/index');
Route::get('product_commend:product_class_id', 'Product/commend');
Route::get('product_new:product_class_id', 'Product/new');
Route::get('product_hot:product_class_id', 'Product/hot');
Route::get('product_list:product_class_id', 'Product/list');
Route::get('product_detail:id', 'Product/detail')->name('product_detail');

//下载
Route::get('download_index', 'Download/index');
Route::get('download_commend:download_class_id', 'Download/commend');
Route::get('download_new:download_class_id', 'Download/new');
Route::get('download_hot:download_class_id', 'Download/hot');
Route::get('download_list:download_class_id/:page?', 'Download/list');
Route::get('download_detail:id', 'Download/detail');