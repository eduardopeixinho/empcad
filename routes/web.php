<?php

use App\Http\Controllers\CompanyController;
use App\Http\Controllers\CompanySizeController;
use App\Http\Controllers\CompanyTestController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use Laravel\Socialite\Facades\Socialite;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {

    Route::get('/', function () {
        return view('home');
    });

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::controller(CompanyTestController::class)->group(function () {
        Route::resource('companies-test', CompanyTestController::class);
        Route::get('companies-test/{id}/show', 'show')->name('companies-show');
        Route::get('companies-test/create', 'create');        
        Route::post('companies-test/{id}/delete', 'destroy');
    });

    Route::controller(CompanyController::class)->group(function () {
        Route::resource('companies', CompanyController::class);
        Route::get('companies/{id}/show', 'show')->name('companies-show');
        Route::get('companies/create', 'create');        
        
    });

    Route::controller(CompanySizeController::class)->group(function () {
        Route::resource('companies-size', CompanySizeController::class);
        Route::post('companies-size/{id}/edit', 'edit');
        Route::put('companies-size/{id}', 'update');
        Route::post('companies-size/{id}/delete', 'destroy');
    });     

});

require __DIR__.'/auth.php';

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/login/redirect', function () {
    return Socialite::driver('google')->redirect();
})->name('google.login');

Route::get('/login/googlecallback', '\App\Http\Middleware\SocialiteLogin@googleCallBack')
    ->name('google.callback');

    Route::get('/logout/google', '\App\Http\Middleware\SocialiteLogin@googleLogout')
->name('google.logout');

Auth::routes();
