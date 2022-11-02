<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Route;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;

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


Route::group(['middleware'=>['auth']], function(){
    Route::get('/dashboard',[PostController::class,'dashboard'
    ])->name('dashboard');

Route::resource('categories',CategoryController::class,)->middleware('is_admin');
Route::resource('posts',PostController::class);


});




require __DIR__.'/auth.php';
