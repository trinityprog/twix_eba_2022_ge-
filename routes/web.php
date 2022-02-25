<?php

use App\Http\Controllers\Admin\AuthenticatedSessionController;
use App\Http\Controllers\Admin\DeliveryController;
use App\Http\Controllers\Admin\DeliveryRegionController;
use App\Http\Controllers\Admin\FaqController;
use App\Http\Controllers\Admin\PrizeController;
use App\Http\Controllers\Admin\RuleController;
use App\Http\Controllers\Admin\StatsController;
use App\Http\Controllers\Admin\Test\QuestionController;
use App\Http\Controllers\Admin\Test\ResultController;
use App\Http\Controllers\Admin\TestUserController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\WinnerController;
use App\Http\Controllers\CheckController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\RedirectController;
use App\Http\Controllers\ScannerController;
use App\Http\Middleware\ActionLimit;
use App\Http\Middleware\EndPromo;
use App\Http\Middleware\TestLimit;
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
Route::get('/', [PageController::class, 'index'])->name('index');
Route::get('/home', [PageController::class, 'home'])->name('home');
Route::get('lang/{key}', [PageController::class, 'lang'])->name('lang');
Route::view('restricted', 'pages.restricted')->name('restricted');

Route::get('rules_file', fn () => redirect(asset('rules/'.app()->getLocale().'.pdf')))->name('rules_file');

Route::get('telegram/start', [PageController::class, 'telegramStart'])->name('telegram_start');

Route::group(['middleware' => 'auth'], function () {
    Route::get('profile', [PageController::class, 'profile'])->name('profile');

    Route::group(['middleware' => [ActionLimit::class, EndPromo::class], 'prefix' => 'scanner', 'as' => 'scanner.'],  function () {
        Route::get('scan/{type?}', [ScannerController::class, 'scan'])->name('scan')->where('type', 'confirm');
        Route::get('file/{type?}', [ScannerController::class, 'file'])->name('file')->where('type', 'confirm');
        Route::post('store_scan', [ScannerController::class, 'storeScan'])->name('store_scan');
        Route::post('store_file', [ScannerController::class, 'storeFile'])->name('store_file');
    });

    Route::view('test', 'pages.test.index')->name('test')->middleware([TestLimit::class, EndPromo::class]);
    Route::get('test/result/{test_user_id}', [PageController::class, 'test_result'])->name('test_result');

    Route::get('delivery', [PageController::class, 'delivery'])->name('delivery');

    Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');
});

Route::group(['prefix' => 'admin', 'as' => 'admin.'], function () {
    Route::group(['middleware' => 'guest'], function () {
        Route::get('login', [AuthenticatedSessionController::class, 'create'])->name('login');

        Route::post('login', [AuthenticatedSessionController::class, 'store']);
    });

    Route::group(['middleware' => ['auth', 'admin']], function () {
        Route::view('/', 'admin.dashboard')->name('index');

        Route::get('users', [UserController::class, 'index'])->name('users.index');
        Route::get('users/export', [UserController::class, 'export'])->name('users.export');

        Route::get('test_users', [TestUserController::class, 'index'])->name('test_users.index');
        Route::get('test_users/export', [TestUserController::class, 'export'])->name('test_users.export');

        Route::get('scanners', [App\Http\Controllers\Admin\ScannerController::class, 'index'])->name('scanners.index');
        Route::get('scanners/export', [App\Http\Controllers\Admin\ScannerController::class, 'export'])->name('scanners.export');

        Route::resource('winners', WinnerController::class);

        Route::resource('rules', RuleController::class)->only(['index', 'edit', 'update']);

        Route::resource('faqs', FaqController::class);

        Route::resource('prizes', PrizeController::class)->only(['index', 'edit', 'update']);

        Route::resource('questions', \App\Http\Controllers\Admin\QuestionController::class)->only(['index', 'edit', 'update']);

        Route::resource('delivery_regions', DeliveryRegionController::class);
        Route::resource('deliveries', DeliveryController::class)->only(['index', 'edit', 'update']);

        Route::get('test-stats/check-envoys-prize', [StatsController::class, 'checkEnvoysPrize']);
        Route::get('test-stats/confirm-checks', [StatsController::class, 'confirmChecks']);



        Route::group(['prefix' => 'tests', 'as' => 'tests.'], function () {
            Route::resource('questions', QuestionController::class)->only(['index', 'edit', 'update']);
            Route::resource('results', ResultController::class)->only(['index', 'edit', 'update']);
        });
    });
});
