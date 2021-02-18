<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\auth\LoginController;
use App\Http\Controllers\Main\MainController;
use Illuminate\Support\Facades\Route;

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
Route::get('/', [MainController::class, 'goMainGet'])->name('main');
Route::get('/news', [MainController::class, 'news'])->name('news');
Route::get('/myorders', [MainController::class, 'goMyOrders'])->name('myorders');
Route::get('/marketinfo', [MainController::class, 'goMarketInfo'])->name('marketinfo');


Route::get('/productinfo/{product}', [MainController::class, 'productInfo'])->name('productnfo');
Route::get('/newsinfo/{news}', [MainController::class, 'newsInfo'])->name('newsinfo');

Route::namespace('Auth')->group(function () {
    //Route::post('/books/save', [BookController::class,'save'])->name('books.save');
    Route::get('/login',[LoginController::class,'login_form'])->name('login');
    Route::post('/login',[LoginController::class,'process_login']);
    Route::get('/register',[LoginController::class,'register_form'])->name('register');
    Route::post('/register',[LoginController::class,'process_register']);
    Route::get('/logout',[LoginController::class,'logout'])->name('logout');

    Route::get('/buy/{name}/{email}/{id}',[MainController::class,'buy'])->name('buy');
    Route::post('/buy/process',[MainController::class,'buyProcess'])->name('buyprocess');
});


Route::namespace('Admin')->group(function() {
    Route::get('/makegame', [AdminController::class, 'makegame'])->name('makegame');
    Route::post('/makegame', [AdminController::class, 'process_makegame']);
//
    Route::get('/makecategory', [AdminController::class, 'makecategory'])->name('makecategory');
    Route::post('/makecategory', [AdminController::class, 'process_makecategory']);
//
    Route::get('/makenews', [AdminController::class, 'makeNews'])->name('makenews');
    Route::post('/makenews', [AdminController::class, 'process_makeNews']);
//
    Route::get('/deletegame/{id}', [AdminController::class, 'deletegame'])->name('deletegame');
    Route::post('/deletegame/process', [AdminController::class, 'process_deletegame'])->name('deletegameprocess');
//
    Route::get('/editgame/{id}', [AdminController::class, 'editgame'])->name('editegame');
    Route::post('/editgame/process', [AdminController::class, 'process_editgame'])->name('editprocess');
//
    Route::get('/editcategory/{name}', [AdminController::class, 'editcategory'])->name('editcategory');
    Route::post('/editcategory', [AdminController::class, 'process_editcategory'])->name('editcategoryprocess');
//
    Route::get('/deletecategory/{name}', [AdminController::class, 'deletecategory'])->name('deletecategory');
    Route::post('/editcategory/process', [AdminController::class, 'process_deletecategory'])->name('deletecategoryprocess');

//
    Route::get('/checkorders', [AdminController::class,'checkOrder'])->name('checkorders');
});

Route::namespace('Category')->group(function()
{
    Route::get('category/{name}', [MainController::class, 'goCategory'])->name('category');
});
