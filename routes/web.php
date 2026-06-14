<?php


use App\Http\Controllers\Attendance\AttendanceController;
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

Route::get('/', function () {
    return view('welcome');
});


/*User Login*/
Route::middleware('guest')->group(function () {
    Route::get('/login', [\App\Http\Controllers\Auth\LoginController::class ,'showLoginForm'])
        ->name('login');

    Route::post('/login' , [\App\Http\Controllers\Auth\LoginController::class , 'login'])
        ->name('login.submit');

});


/*User Logout**/
Route::post('/logout' , [\App\Http\Controllers\Auth\LoginController::class, 'logout'])
    ->middleware('auth')
    ->name('logout');

    Route::get('/dashboard', function () {

        return view('dashboard.index');

    })->middleware('auth')->name('dashboard');


/*Attendances*/
Route::middleware('auth')->group(function () {
   Route::get('/attendance', [AttendanceController::class, 'index'])->name('attendance.index');
   Route::post('/attendance/check-in', [AttendanceController::class, 'checkIn'])->name('attendance.checkin');
   Route::post('/attendance/check-out', [AttendanceController::class, 'checkOut'])->name('attendance.checkout');
});


/*Admin*/
Route::middleware(['auth', 'role:admin'])->prefix('admin')
    ->name('admin.')
    ->group(function() {
        Route::resource('users', \App\Http\Controllers\Admin\UserController::class);
        Route::get(
            'attendances',
            [\App\Http\Controllers\Admin\AttendanceController::class, 'index'])->name('attendances.index');
    });



/*Task*/
Route::middleware('auth')->prefix('task')->name('task.')
    ->group(function () {
    Route::get('/', [\App\Http\Controllers\Task\TaskController::class, 'index'])->name('index');
    Route::get('/create', [\App\Http\Controllers\Task\TaskController::class, 'create'])->name('create');
    Route::get('/{task}', [\App\Http\Controllers\Task\TaskController    ::class, 'show'])->name('show');
    Route::post('/store', [\App\Http\Controllers\Task\TaskController::class, 'store'])->name('store');
    Route::get('/{task}/edit', [\App\Http\Controllers\Task\TaskController::class, 'edit'])->name('edit');
    Route::put('/{task}/update', [\App\Http\Controllers\Task\TaskController::class, 'update'])->name('update');
    Route::delete('/{task}/destroy', [\App\Http\Controllers\Task\TaskController::class, 'destroy'])->name('destroy');
});


Route::get('/dashboard', function () { return view('dashboard.index'); })->name('dashboard');

