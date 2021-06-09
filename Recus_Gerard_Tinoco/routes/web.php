<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

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

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');


Route::get('edicio/{id}', [UserController::class,'edit'])->middleware(['auth'])->name('UserEdit');
Route::post('update/{id}', [UserController::class,'update'])->middleware(['auth'])->name('UserUpdate');

require __DIR__.'/auth.php';


