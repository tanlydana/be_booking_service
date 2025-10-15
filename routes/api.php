<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StaffController;


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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });
Route::get('/test', function () {
    return response()->json([
        'message' => 'Backend is working!',
        'status' => 'success',
        'timestamp' => now()
    ]);
});

Route::controller(StaffController::class)->group(function(){
    Route::get('/staff', 'index');                  // Get all staff
    Route::get('/staff/{id}', 'show');              // Get single staff
    Route::post('/staff', 'store');                 // Create staff
    Route::put('/staff/{id}', 'update');            // Update staff
    Route::delete('/staff/{id}', 'destroy');        // Delete staff
});