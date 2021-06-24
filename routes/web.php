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
});

Route::get('/model', function (){


    //produtos loja
    $loja = \App\Store::find(2);

    return $loja->products()->where('id', 2)->get(); //retorna uma collection


//    return $user->store; //1:1 retorna o objeto unico | retorna a loja do usuario 41
});
