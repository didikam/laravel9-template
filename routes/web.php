<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\NewsController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Auth;
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


Route::get('/', function () {
   // return view('welcome');
   return redirect('/admin/dashboard');
})->name('index');


Route::group(['as' => 'auth.'], function () {
   Route::group(['middleware' => 'auth'], function () {
      Route::post('logout', [LoginController::class, 'logout'])->name('logout');
   });

   Route::group(['middleware' => 'guest'], function () {
      // Authentication
      Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
      Route::post('login', [LoginController::class, 'login']);
   });
});

/*------------------------------------------
--------------------------------------------
All Normal Users Routes List
--------------------------------------------
--------------------------------------------*/
Route::middleware(['auth', 'permission:user.access.index'])->group(function () {
   Route::get('/home', [HomeController::class, 'index'])->name('home');
});
/*------------------------------------------
--------------------------------------------
All Admin Routes List
--------------------------------------------
--------------------------------------------*/
Route::middleware(['auth', 'permission:admin.access.index'])->group(function () {
   Route::group(['prefix' => 'admin', 'as' => 'admin.'], function () {
      Route::redirect('/', '/admin/dashboard', 301);

      Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');

      Route::group(['prefix' => 'news', 'as' => 'news.', 'middleware' => 'permission:admin.access.news'], function () {
         Route::get('/', [NewsController::class, 'index'])->name('index');
         Route::get('datatable', [NewsController::class, 'datatable'])->name('datatable');
         Route::get('create', [NewsController::class, 'create'])->name('create');
         Route::get('{id}/edit', [NewsController::class, 'edit'])->name('edit');
         Route::post('store', [NewsController::class, 'store'])->name('store');
         Route::delete('{id}/destroy', [NewsController::class, 'destroy'])->name('destroy');
      });

      Route::group(['prefix' => 'user', 'as' => 'user.', 'middleware' => 'permission:admin.access.user'], function () {
         Route::get('/', [UserController::class, 'index'])->name('index');
         Route::get('datatable', [UserController::class, 'datatable'])->name('datatable');
         Route::get('create', [UserController::class, 'create'])->name('create');
         Route::get('{id}/edit', [UserController::class, 'edit'])->name('edit');
         Route::post('store', [UserController::class, 'store'])->name('store');
         Route::delete('{id}/destroy', [UserController::class, 'destroy'])->name('destroy');
      });

      Route::group(['prefix' => 'profile', 'as' => 'profile.', 'middleware' => 'permission:admin.access.profile'], function () {
         Route::get('/', [ProfileController::class, 'index'])->name('index');
         Route::post('store', [ProfileController::class, 'store'])->name('store');
      });
   });
});
