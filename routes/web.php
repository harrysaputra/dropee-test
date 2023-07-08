<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;

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

// Route to show the admin panel form
Route::get('/admin', [AdminController::class, 'index']);

// Route to submit the admin panel form
Route::post('/admin', [AdminController::class, 'createText']);

// Route to show the index page
Route::get('/', function () {
    $boxes = json_decode(Storage::disk('s3')->get('boxes.json'), true);
    return view('welcome', compact('boxes'));
});
