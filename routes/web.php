<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DisciplineController;

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

Route::middleware(['auth'])->group(function () {
Route::get('/disciplines', [App\Http\Controllers\DisciplineController::class, 'index'])->name('discipline-dashboard');
Route::post('/create-discipline', [App\Http\Controllers\DisciplineController::class, 'store'])->name('create-discipline');
Route::get('/fetch-disciplines', [App\Http\Controllers\DisciplineController::class, 'fetchDisciplines'])->name('fetch-disciplines');
Route::get('/edit-disciplines/{id}', [App\Http\Controllers\DisciplineController::class, 'editDisciplines'])->name('edit-disciplines');
Route::put('/update-disciplines/{id}', [App\Http\Controllers\DisciplineController::class, 'updateDiscipline'])->name('update-disciplines');
Route::delete('/delete-discipline/{id}', [App\Http\Controllers\DisciplineController::class, 'deleteDiscipline'])->name('delete-discipline');

});

Auth::routes();
