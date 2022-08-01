<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\dashController;
use App\Http\Controllers\PostController;

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

######  Route N.C.  #####
Route::get('deletepost/{idPost}', [PostController::class, 'destroy'])->name('deletPost');

Route::resource('posts', PostController::class)->except('index');

Route::middleware(['auth'])->group(function(){
    
    Route::get('/', [PostController::class, 'index'])->name('posts.index');
    
    Route::get('/dashboard', [dashController::class, 'index'])
    ->name('dashboard');
    
});


######## Route perso ###########

Route::get('/index', function () {
    return view('post.index')->name('accueil');
});

require __DIR__.'/auth.php';

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
