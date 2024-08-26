<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\FactoryController;
use App\Http\Controllers\Admin\ReportController;
use App\Http\Controllers\Admin\SensorController;
use App\Http\Controllers\Admin\SiteController;
use App\Http\Controllers\Admin\UserController;
use Illuminate\Support\Facades\Route;

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

// Direct Login
Route::get('/', function () {
    return redirect(route('dashboard'));
});

Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');


Route::get('/report',[ReportController::class, 'index'])->name('report');

// Factories Controller
Route::resource('factories', FactoryController::class);

// Sites Controller
Route::get('factories/{idFactory}/site/create', [SiteController::class, 'create'])->name('sites.create');
Route::post('factories/{idFactory}/site/store', [SiteController::class, 'store'])->name('sites.store');
Route::get('factories/{idFactory}/site/show/{idSite}', [SiteController::class, 'show'])->name('sites.show');
Route::get('factories/{idFactory}/site/edit/{idSite}', [SiteController::class, 'edit'])->name('sites.edit');
Route::put('factories/{idFactory}/site/update/{idSite}', [SiteController::class, 'update'])->name('sites.update');
Route::delete('factories/{idFactory}/site/delete/{idSite}', [SiteController::class, 'destroy'])->name('sites.destroy');

// Sites Controller
Route::get('site/{idSite}/create', [SensorController::class, 'create'])->name('sensors.create');
Route::post('site/{idSite}/store', [SensorController::class, 'store'])->name('sensors.store');
Route::get('site/{idSite}/show/{idSensor}', [SensorController::class, 'show'])->name('sensors.show');
Route::get('site/{idSite}/edit/{idSensor}', [SensorController::class, 'edit'])->name('sensors.edit');
Route::put('site/{idSite}/update/{idSensor}', [SensorController::class, 'update'])->name('sensors.update');
Route::delete('site/{idSite}/delete/{idSensor}', [SensorController::class, 'destroy'])->name('sensors.destroy');

// Route::resource('sites', SiteController::class);
// Route::resource('sensors', SensorController::class);

// Route::middleware(['auth'])->group(function () {
//     // Users
//     Route::prefix('users')->name('users.')->group(function () {
//         Route::get('/', [UserController::class, 'index'])->name('index');
//         Route::get('get-data', [UserController::class, 'getUsers'])->name('get-data');
//         Route::get('modal-add', [UserController::class, 'getModalAdd'])->name('modal-add');
//         Route::post('store', [UserController::class, 'store'])->name('store');
//         Route::get('modal-edit/{userId}', [UserController::class, 'getModalEdit'])->name('modal-edit');
//         Route::put('update/{userId}', [UserController::class, 'update'])->name('update');
//         Route::get('modal-delete/{userId}', [UserController::class, 'getModalDelete'])->name('modal-delete');
//         Route::delete('delete/{userId}', [UserController::class, 'destroy'])->name('destroy');
//     });

//     // Roles
//     Route::prefix('roles')->name('roles.')->group(function () {
//         Route::get('/', [RoleController::class, 'index'])->name('index');
//         Route::get('get-data', [RoleController::class, 'getRoles'])->name('get-data');
//         Route::get('modal-add', [RoleController::class, 'getModalAdd'])->name('modal-add');
//         Route::post('store', [RoleController::class, 'store'])->name('store');
//         Route::get('modal-edit/{roleId}', [RoleController::class, 'getModalEdit'])->name('modal-edit');
//         Route::put('update/{roleId}', [RoleController::class, 'update'])->name('update');
//         Route::get('modal-delete/{roleId}', [RoleController::class, 'getModalDelete'])->name('modal-delete');
//         Route::delete('delete/{roleId}', [RoleController::class, 'destroy'])->name('destroy');
//         Route::post('update-permission', [RoleController::class, 'updatePermissionByID'])->name('update.permission');
//         Route::post('update-all-permissions', [RoleController::class, 'updateAllPermissions'])->name('update.permission');
//     });
// });






// ================================================================================================================================
// User Route
// ================================================================================================================================

// Route::name('user.')->middleware(['web'])->group(function () {

// });
