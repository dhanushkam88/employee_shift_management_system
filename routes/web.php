<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Http\Controllers\Admin\AdminProfileController;
use App\Helpers\ConnectHelper;
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
    return redirect('/login');
})->name('home');

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard.adminDashboard');
    })->name('dashboard');
});
Route::get('full-calender', [AdminProfileController::class, 'calander'])->name('fullCalender');
 /** Admin routes **/
Route::prefix('admin')->group(function () {
    Route::middleware(['role:admin|supervisor'])->group(function(){
        Route::get('user-management', [AdminProfileController::class, 'userManagement'])->name('userManagement');
        Route::get('view-all-users', [AdminProfileController::class, 'viewAllUserProfile'])->name('viewAllUserProfile');
        Route::post('create-employee', [AdminProfileController::class, 'createEmployee'])->name('createEmployee');
        Route::post('update-user', [AdminProfileController::class, 'updateUserProfile'])->name('updateUserProfile');
        Route::get('delete-user', [AdminProfileController::class, 'deleteUser'])->name('deleteUser');
        Route::post('delete-user-confirm', [AdminProfileController::class, 'deleteUserConfirm'])->name('deleteUserConfirm');

        Route::get('employee-management', [AdminProfileController::class, 'employeeManagement'])->name('employeeManagement');
        Route::post('create-my-shift-request', [AdminProfileController::class, 'createMyShiftRequest'])->name('createMyShiftRequest');
        Route::post('create-my-shift', [AdminProfileController::class, 'createMyShift'])->name('createMyShift');
        Route::post('edit-my-shift-request', [AdminProfileController::class, 'editMyShiftRequest'])->name('editMyShiftRequest');
        Route::post('edit-my-shift', [AdminProfileController::class, 'editMyShift'])->name('editMyShift');
        Route::post('delete-my-shift', [AdminProfileController::class, 'deleteMyShift'])->name('deleteMyShift');
    });
});
