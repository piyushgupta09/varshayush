<?php

use App\Http\Controllers\ChecklistController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EventController;
use App\Http\Controllers\GuestController;
use App\Http\Controllers\VenueController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\SettingController;

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
    return view('home');
});

Route::get('/home', function () {
    return view('home');
})->middleware(['auth', 'verified']);

Route::resource('venues', VenueController::class);
Route::resource('events', EventController::class);
Route::resource('settings', SettingController::class);

Route::resource('tasks', TaskController::class);
Route::post('tasks/delete', [TaskController::class, 'delete'])->name('tasks.delete');
Route::post('tasks/archive', [TaskController::class, 'archive'])->name('tasks.archive');
Route::post('tasks/persist', [TaskController::class, 'persist'])->name('tasks.persist');

Route::resource('checklists', ChecklistController::class);
Route::post('checklists/delete', [ChecklistController::class, 'delete'])->name('checklists.delete');
Route::post('checklists/archive', [ChecklistController::class, 'archive'])->name('checklists.archive');
Route::post('checklists/persist', [ChecklistController::class, 'persist'])->name('checklists.persist');

Route::resource('guests', GuestController::class);
Route::post('guests/persist', [GuestController::class, 'persist'])->name('guests.persist');
Route::get('guests/invite/{guest}', [GuestController::class, 'invite'])->name('guests.invite');
