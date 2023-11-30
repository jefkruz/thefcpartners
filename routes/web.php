<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AjaxController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CommissionController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MainController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\PropertyController;
use App\Http\Controllers\ReceiptController;
use App\Http\Controllers\UserController;
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

//MAIN ROUTES
Route::get('/', [MainController::class, 'index'])->name('index');
Route::get('about', [MainController::class, 'about'])->name('about');
Route::get('contact', [MainController::class, 'contact'])->name('contact');
Route::post('contact-us',  [MainController::class, 'messages']);
Route::get('property/{slug}', [MainController::class, 'viewproperty'])->name('viewproperty');
Route::get('property', [MainController::class, 'property'])->name('property');
Route::get('blog', [MainController::class, 'posts'])->name('blog');
Route::get('profile/share/{username}',  [MainController::class, 'profileshare'])->name('profileshare');


Route::get('auth/v1/register/confirm/{username}/{code}', [AuthController::class, 'verifyRegistration'])->name('verifyRegistration');
Route::get('login', [AuthController::class, 'showLogin'])->name('login');
Route::post('login', [AuthController::class, 'login']);
Route::get('register', [AuthController::class, 'showRegister'])->name('register');
Route::get('register/{username}', [AuthController::class, 'showRegister'])->name('referralRegister');
Route::post('register', [AuthController::class, 'register']);
Route::post('register/{username}', [AuthController::class, 'register']);
Route::get('profile/share/{username}',  [PropertyController::class, 'profileshare'])->name('profileshare');
Route::post('logout', [AuthController::class, 'logout'])->name('logout');

Route::get('download/{id}',  [ReceiptController::class, 'download'])->name('download');
Route::get('subscribe/{id}',  [PropertyController::class, 'subscribe'])->name('subscribe');


Route::group(['middleware' => 'isLoggedin'], function(){
    Route::get('/', [HomeController::class, 'index'])->name('home');
    Route::get('referral', [HomeController::class, 'referrals'])->name('referrals');
    Route::get('referral/{username}', [HomeController::class, 'viewreferral'])->name('view');
    Route::get('profile', [HomeController::class, 'profile'])->name('profile');
    Route::get('properties/list', [HomeController::class, 'listProperties'])->name('properties.list');
    Route::get('properties/view/{id}', [HomeController::class, 'viewProperties'])->name('viewProperties');
    Route::put('profile', [HomeController::class, 'updateprofile'])->name('profile.update');
    Route::put('profile/bank', [HomeController::class, 'updateBank'])->name('profile.updateBank');
    Route::get('viewpost/{slug}', [HomeController::class, 'viewpost'])->name('viewpost');
    Route::put('profile/image', [HomeController::class, 'updateimage'])->name('updateimage');
    Route::resource('receipts', ReceiptController::class);
    Route::get('commissions', [HomeController::class,'commission'])->name('viewcommission');
    Route::post('withdraw', [CommissionController::class, 'withdrawFund'])->name('withdrawFund');

    Route::group(['prefix' => 'ajax'], function(){
        Route::get('banks', [AjaxController::class, 'getBanks'])->name('getBanks');
        Route::get('bank/account', [AjaxController::class, 'getBankAccount'])->name('getBankAccount');
    });

});


Route::group(['prefix' => 'admin', 'middleware' => 'isAdmin'], function () {
    Route::get('/', [AdminController::class, 'index'])->name('admin');
    Route::get('settings', [AdminController::class, 'settings'])->name('settings');
    Route::put('settings/wallet', [AdminController::class, 'updateWalletSetting'])->name('settings.wallet');
    Route::put('settings/password', [AdminController::class, 'updatePassword'])->name('settings.password');
    Route::get('receipts', [AdminController::class, 'receipts'])->name('receipts.admin');
    Route::get('showreceipts/{id}', [AdminController::class, 'showreceipts'])->name('receipts.view');
    Route::put('confirm',  [AdminController::class, 'confirm'])->name('confirm');
    Route::get('paid/{id}',  [AdminController::class, 'paid'])->name('paid');
    Route::get('birthdays', [AdminController::class, 'birthdays'])->name('birthdays');


    Route::group(['prefix' => 'ajax'], function(){
        Route::put('receipt/code', [AjaxController::class, 'setReceiptCode'])->name('setReceiptCode');
    });


//CRUD ROUTES

    Route::resource('users', UserController::class);
    Route::resource('properties', PropertyController::class);
    Route::resource('commissions', CommissionController::class);
    Route::resource('posts', PostController::class);

    Route::put('properties/{id}/image', [PropertyController::class, 'uploadImage'])->name('property.uploadImage');
    Route::delete('property/{property}/image/{image}', [PropertyController::class, 'deleteImage'])->name('property.deleteImage');






});
