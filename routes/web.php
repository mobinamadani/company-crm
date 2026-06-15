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

/*Leaves*/
Route::middleware(['auth'])->group(function () {
    Route::get('/leaves', [\App\Http\Controllers\Admin\LeaveController::class, 'index'])->name('leaves.index');
    Route::get('/leaves/create', [\App\Http\Controllers\Admin\LeaveController::class, 'create'])->name('leaves.create');
    Route::post('/leaves', [\App\Http\Controllers\Admin\LeaveController::class, 'store'])->name('leaves.store');

    Route::middleware(['role:admin'])->group(function () {
        Route::get('/leaves/{leave}/approve', [\App\Http\Controllers\Admin\LeaveController::class, 'approve'])->name('leaves.approve');
        Route::get('/leaves/{leave}/reject', [\App\Http\Controllers\Admin\LeaveController::class, 'reject'])->name('leaves.reject');
    });

});

/*Notification*/
Route::get('/notification/read/{id}', function ($id) {
    auth()->user()->notifications()->findOrFail($id)->markAsRead();
    return back();
})->name('notifications.read');

Route::get('/notification/read-all', function () {
    auth()->user()->unreadNotifications->markAsRead();
    return back();
})->name('notifications.read.all');


Route::get('/dashboard', function () { return view('dashboard.index'); })->name('dashboard');

