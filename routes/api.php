<?php


use App\Http\Controllers\Api\BotController;
use App\Http\Middleware\ActionLimit;
use App\Http\Middleware\CheckAuthKeyHeader;
use App\Http\Middleware\ForceJsonResponse;
use App\Models\Prize;
use App\Models\TestUser;
use App\Models\User;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
