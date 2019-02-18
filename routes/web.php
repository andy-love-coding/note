<?php

Route::get('/', 'StaticPagesController@home')->name('home');
Route::post('/', 'StaticPagesController@store')->name('home');
Route::get('editor', 'StaticPagesController@editor')->name('editor');
Route::get('/help', 'StaticPagesController@help')->name('help');
Route::get('/about', 'StaticPagesController@about')->name('about');

Route::get('signup', 'UsersController@create')->name('signup');
Route::resource('users', 'UsersController'); // 生成7个路由

Route::get('login', 'SessionsController@create')->name('login');
Route::post('login', 'SessionsController@store')->name('login');
Route::delete('logout', 'SessionsController@destroy')->name('logout');

// 显示重置密码的邮箱发送页面
Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
// 邮箱发送重设链接
Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
// 密码更新页面
Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
// 执行密码更新操作
Route::post('password/reset', 'Auth\ResetPasswordController@reset')->name('password.update');

// 分类
Route::resource('categories', 'CategoriesController');

// 文章
Route::resource('articles', 'ArticlesController');
Route::get('categories/{category}/articles/{article}', 'ArticlesController@show')->name('category.articles.show');

// 段落
Route::get('articles/{article}/paragraphs/create', 'ParagraphsController@create_edit')->name('article.paragraphs.create');
Route::get('articles/{article}/paragraphs/{paragraph}/edit', 'ParagraphsController@create_edit')->name('article.paragraphs.edit');
Route::post('articles/{article}/paragraphs', 'ParagraphsController@store')->name('article.paragraphs.store');
Route::patch('articles/{article}/paragraphs/{paragraph}', 'ParagraphsController@update')->name('article.paragraphs.update');
Route::delete('articles/{article}/paragraphs/{paragraph}', 'ParagraphsController@destroy')->name('article.paragraphs.destroy');