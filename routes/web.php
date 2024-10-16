<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

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

// Route::get('/', function () {
//     return view('welcome');
// });
Route::get('/', [ProfileController::class, 'index'])->name('home');
Route::get('/create', [ProfileController::class, 'create'])->name('create');
Route::post('/create/store', [ProfileController::class, 'store'])->name('create.store');
Route::get('/edit/{id}', [ProfileController::class, 'edit'])->name('edit');
Route::post('/edit/update/', [ProfileController::class, 'update'])->name('update');
Route::post('/destroy/{id}', [ProfileController::class, 'destroy'])->name('destroy');
