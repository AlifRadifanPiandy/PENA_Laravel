<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\APIController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Admin\DevHome;
use App\Http\Controllers\Admin\DevAdmin;
use App\Http\Controllers\Admin\DevCard;
use App\Http\Controllers\Admin\DevContent;
use App\Http\Controllers\Admin\DevEicCategory;
use App\Http\Controllers\Admin\DevFaq;
use App\Http\Controllers\Admin\DevGallery;
use App\Http\Controllers\Admin\DevMaster;
use App\Http\Controllers\Admin\DevSponsor;
use App\Http\Controllers\Auth\AdminAuthController;

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

Route::get('/', [HomeController::class, 'index']);
Route::get('/home', [HomeController::class, 'index']);
Route::get('/eic', [HomeController::class, 'eic']);
Route::get('/semnas', [HomeController::class, 'semnas']);

// ADMIN AUTH
Route::get('/dev/login', [AdminAuthController::class, 'index']);
Route::post('/dev/login', [AdminAuthController::class, 'login']);
Route::get('/dev/logout', [AdminAuthController::class, 'logout']);

// ADMIN PAGE
Route::group(['prefix'=> 'dev','middleware'=>['auth:admin']], function(){
    Route::get('/', [DevHome::class, 'index']);
    Route::get('/home', [DevHome::class, 'index']);
    Route::get('/admin', [DevAdmin::class, 'index']);
    Route::get('/card', [DevCard::class, 'index']);
    Route::get('/content', [DevContent::class, 'index']);
    Route::get('/faq', [DevFaq::class, 'index']);
    Route::get('/gallery', [DevGallery::class, 'index']);
    Route::get('/eic-category', [DevEicCategory::class, 'index']);
    Route::get('/master', [DevMaster::class, 'index']);
    Route::get('/sponsor', [DevSponsor::class, 'index']);

    Route::post('/admin', [DevAdmin::class, 'postHandler']);
    Route::post('/card', [DevCard::class, 'postHandler']);
    Route::post('/content', [DevContent::class, 'postHandler']);
    Route::post('/faq', [DevFaq::class, 'postHandler']);
    Route::post('/gallery', [DevGallery::class, 'postHandler']);
    Route::post('/eic-category', [DevEicCategory::class, 'postHandler']);
    Route::post('/master', [DevMaster::class, 'postHandler']);
    Route::post('/sponsor', [DevSponsor::class, 'postHandler']);
});

// API
Route::group(['prefix'=> 'api'], function(){
    Route::get('admin/{admin:id}', [APIController::class, 'Admin']);
    Route::get('card/{card:id}', [APIController::class, 'Card']);
    Route::get('content/{content:id}', [APIController::class, 'Content']);
    Route::get('faq/{faq:id}', [APIController::class, 'Faq']);
    Route::get('gallery/{gallery:id}', [APIController::class, 'Gallery']);
    Route::get('eic-category/{eicc:id}', [APIController::class, 'EicCategory']);
    Route::get('master/{master:id}', [APIController::class, 'Master']);
    Route::get('sponsor/{sponsor:id}', [APIController::class, 'Sponsor']);
    Route::post('masterpost', [APIController::class, 'MasterPost']);
});
