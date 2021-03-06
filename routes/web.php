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

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::get('/model', function (){


    //produtos loja
    $loja = \App\Store::find(2);

    return $loja->products()->where('id', 2)->get(); //retorna uma collection


//    return $user->store; //1:1 retorna o objeto unico | retorna a loja do usuario 41
});


Route::group(['middleware' => ['auth']], function (){
    Route::prefix('admin')->name('admin.')->namespace('Admin')->group(function(){
        Route::resource('products', 'ProductController');
        Route::resource('stores', 'StoreController');
        Route::resource('categories', 'CategoryController');
        Route::delete('photos/remove/', 'ProductPhotoController@removePhoto')->name('photo.remove');


        /*Route::prefix('stores')->name('stores.')->group(function (){
            Route::get('/', 'StoreController@index')->name('index');
            Route::get('/create', 'StoreController@create')->name('create');
            Route::post('/add', 'StoreController@add')->name('add');
            Route::get('/edit/{id}', 'StoreController@edit')->name('edit');
            Route::post('/update/{id}', 'StoreController@update')->name('update');
            Route::get('/delete/{id}', 'StoreController@delete')->name('delete');
        });*/
    });
});

Auth::routes();

Route::get('/index', 'HomeController@index')->name('index'); //->middleware('auth');
