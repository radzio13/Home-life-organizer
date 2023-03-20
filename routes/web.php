<?php

use App\Http\Controllers\DictionaryController;
use App\Http\Controllers\ExpenditureController;
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
    return view('welcome');
});

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::middleware(['auth'])->group(function() {
    Route::prefix('my-expenditure')->as('my-expenditure')->group(function () {
        Route::get('/', [ExpenditureController::class, 'myExpenditureView'])->name('myExpenditureView');
    });

    Route::prefix('dictionaries')->as('dictionaries')->group(function () {
        Route::get('/', [DictionaryController::class, 'dictionariesView'])->name('dictionariesView');

        Route::prefix('expenditure-categories')->as('expenditure-categories')->group(function () {
            Route::get('/', [DictionaryController::class, 'getExpenditureCategoriesData'])->name('getExpenditureCategoriesData');
            Route::post('store', [DictionaryController::class, 'storeExpenditureCategory'])->name('storeExpenditureCategory');
            Route::post('{expenditureCategory}/delete', [DictionaryController::class, 'deleteExpenditureCategory'])->name('deleteExpenditureCategory');
        });
    });
});
