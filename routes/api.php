<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\NewsController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\EventController;
use App\Http\Controllers\Api\MesseController;
use App\Http\Controllers\Api\ListenController;
use App\Http\Controllers\Api\PastorController;
use App\Http\Controllers\Api\ServiceController;
use App\Http\Controllers\Api\DonationController;
use App\Http\Controllers\Api\TimeSlotController;
use App\Http\Controllers\Api\MediationController;
use App\Http\Controllers\Api\ProgrammationController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/


Route::prefix('auth')->group(function () {
    Route::post('register', [AuthController::class, 'register']);
    Route::post('login', [AuthController::class, 'login']);

    Route::middleware('auth:sanctum')->group(function () {
        Route::post('logout', [AuthController::class, 'logout']);
        Route::post('refresh', [AuthController::class, 'refresh']);
    });
});



// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });


/*
|--------------------------------------------------------------------------
| API Routes (Protected)
|--------------------------------------------------------------------------
*/
Route::middleware('auth:sanctum')->group(function () {
    // Users
    Route::apiResource('users', UserController::class);

    // Donations
    Route::apiResource('donations', DonationController::class);

    // Events
    Route::apiResource('events', EventController::class)->except('index');

    // Listens
    Route::apiResource('listens', ListenController::class);

    // Mediations
    Route::apiResource('mediations', MediationController::class);

    // Messes
    Route::apiResource('messes', MesseController::class);

    // News
    Route::apiResource('news', NewsController::class)->except('index');

    // Pastors
    Route::apiResource('pastors', PastorController::class)->except('index');

    // Programmations
    Route::apiResource('programmations', ProgrammationController::class)->except('index');

    // Services
    Route::apiResource('services', ServiceController::class)->except('index');

    // Time Slots
    Route::apiResource('time-slots', TimeSlotController::class);
});

// PUBLIC ROUTES
Route::apiResource('news', NewsController::class)->only('index');
Route::apiResource('events', EventController::class)->only('index');
Route::apiResource('pastors', PastorController::class)->only('index');
Route::apiResource('programmations', ProgrammationController::class)->only('index');
Route::apiResource('services', ServiceController::class)->only('index');

