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

// In this Route we delete the closure that was previously in place and instead hook up the controller
// One way is to pass a string as the second argument which describes the controller/action we want to use
// format : nameOfController@nameOfAction
// Another way is to pass an array of key/value pairs a la 'uses' => nameOfController@nameOfAction
// The advantage of this is that you can configure more of the array's properties, such as using
// 'as' => 'blog.index' as the name and then removing the ->name('blog.index') from the end
// The route is a little more structured and easier to read this way
Route::get('/', 'PostController@getIndex')->name('blog.index');

Route::get('post/{id}', [
    'uses' => 'PostController@getPost',
    'as' => 'blog.post'
]);

Route::get('about', function () {
  return view('other.about');
})->name('other.about');

// Route::group allows you to pass associative array as the first argument which configures how the routes should be grouped

Route::group(['prefix' => 'admin'], function () {
  Route::get('', [
      'uses' => 'PostController@getAdminIndex',
      'as' => 'admin.index'
  ]);

  Route::get('create', [
      'uses' => 'PostController@getAdminCreate',
      'as' => 'admin.create'
  ]);

  Route::post('create', [
      'uses' => 'PostController@postAdminCreate',
      'as' => 'admin.create'
  ]);

  Route::get('edit/{id}', [
      'uses' => 'PostController@getAdminEdit',
      'as' => 'admin.edit'
  ]);

  Route::post('edit', [
      'uses' => 'PostController@postAdminUpdate',
      'as' => 'admin.update'
  ]);
 });
