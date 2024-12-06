<?php

use App\Http\Controllers\Administrator\Club\ClubManagementController;
use App\Http\Controllers\Administrator\Club\ClubReservationManagementController;
use App\Http\Controllers\Administrator\ClubCategory\ClubCategoryManagementController;
use App\Http\Controllers\Administrator\Food\FoodAssignmentManagementController;
use App\Http\Controllers\Administrator\Food\FoodManagementController;
use App\Http\Controllers\Administrator\Food\FoodReservationManagementController;
use App\Http\Controllers\Administrator\Role\PermissionController;
use App\Http\Controllers\Administrator\Role\RoleController;
use App\Http\Controllers\Administrator\Store\StoreManagementController;
use App\Http\Controllers\Administrator\Store\StoreDiscountManagementController;
use App\Http\Controllers\Administrator\StoreCategory\StoreCategoryManagementController;
use App\Http\Controllers\Administrator\Users\FamilyMembersControllerController;
use App\Http\Controllers\Administrator\Users\UsersController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Frontend\Club\ClubReservationController;
use App\Http\Controllers\Frontend\Food\FoodReservationController;
use App\Http\Controllers\Frontend\Letter\AllLettersController;
use App\Http\Controllers\Frontend\Store\StoreDiscountController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', [AuthenticatedSessionController::class, 'create'])->name('login')->middleware(['guest']);
Route::get('login', fn() => redirect('/'))->middleware(['guest']);
Route::post('login', [AuthenticatedSessionController::class, 'store'])->name('login_password')->middleware(['guest']);


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    
    Route::get('/dashboard', [HomeController::class, 'index'])->name('dashboard');

    Route::post('/users/edit/{user}/family', [FamilyMembersControllerController::class, 'store'])->name('users.store.family');
    Route::delete('/users/edit/{user}/family', [FamilyMembersControllerController::class, 'destroy'])->name('users.destroy.family');

    Route::get('/users/manage', [UsersController::class, 'manage'])->name('users.manage');
    Route::get('/users/add', [UsersController::class, 'create'])->name('users.create');
    Route::get('/users/edit/{user}', [UsersController::class, 'edit'])->name('users.edit');
    Route::resource('users', UsersController::class)->names('users')->except('edit', 'create');


    
    Route::name('clubcategory.')->prefix('clubcategory')->group(function() {
        Route::get('/manage', [ClubCategoryManagementController::class, 'manage'])->name('manage');
        Route::get('/', [ClubCategoryManagementController::class, 'index'])->name('index');
        Route::get('/add', [ClubCategoryManagementController::class, 'create'])->name('create');
        Route::post('/', [ClubCategoryManagementController::class, 'store'])->name('store');
        Route::get('/edit/{clubCategory}', [ClubCategoryManagementController::class, 'edit'])->name('edit');
        Route::put('/edit/{clubCategory}', [ClubCategoryManagementController::class, 'update'])->name('update');
        Route::delete('/edit/{clubCategory}', [ClubCategoryManagementController::class, 'destroy'])->name('destroy');
    });
    Route::name('club.')->prefix('clubs')->group(function() {
        Route::get('/manage', [ClubManagementController::class, 'index'])->name('manage');
        Route::get('/stats', [ClubReservationManagementController::class, 'stats'])->name('stats');
        Route::get('/allreservations', [ClubReservationManagementController::class, 'index'])->name('allreservations');
        Route::get('/myreservations', [ClubReservationController::class, 'myreservations'])->name('myreservations');
        Route::get('/add', [ClubManagementController::class, 'create'])->name('create');
        Route::post('/', [ClubManagementController::class, 'store'])->name('store');
        Route::get('/edit/{club}', [ClubManagementController::class, 'edit'])->name('edit');
        Route::put('/edit/{club}', [ClubManagementController::class, 'update'])->name('update');
        Route::post('/edit/{club}/deleteimage', [ClubManagementController::class, 'deleteImage'])->name('deleteImage');
        Route::get('/id/{club}', [ClubReservationController::class, 'create'])->name('reserve.create');
        Route::post('/id/{club}', [ClubReservationController::class, 'store'])->name('reserve.store');
        Route::get('/letter/{clubReservations:trackingCode}', [ClubReservationController::class, 'letter'])->name('letter');
        Route::get('/clubs/reserveinfo', [ClubReservationController::class, 'reserveinfo'])->name('reserveinfo');
        Route::get('/', [ClubReservationController::class, 'index'])->name('index');
    });

    Route::name('storecategory.')->prefix('storecategory')->group(function() {
        Route::get('/manage', [StoreCategoryManagementController::class, 'manage'])->name('manage');
        Route::get('/', [StoreCategoryManagementController::class, 'index'])->name('index');
        Route::get('/add', [StoreCategoryManagementController::class, 'create'])->name('create');
        Route::post('/', [StoreCategoryManagementController::class, 'store'])->name('store');
        Route::get('/edit/{storeCategory}', [StoreCategoryManagementController::class, 'edit'])->name('edit');
        Route::put('/edit/{storeCategory}', [StoreCategoryManagementController::class, 'update'])->name('update');
        Route::delete('/edit/{storeCategory}', [StoreCategoryManagementController::class, 'destroy'])->name('destroy');
    });
    Route::name('store.')->prefix('stores')->group(function() {
        Route::get('/manage', [StoreManagementController::class, 'manage'])->name('manage');
        Route::get('/stats', [StoreDiscountManagementController::class, 'stats'])->name('stats');
        Route::get('/alldiscounts', [StoreDiscountManagementController::class, 'alldiscounts'])->name('alldiscounts');
        Route::get('/verifydiscounts', [StoreDiscountManagementController::class, 'verifydiscounts'])->name('verifydiscounts');
        Route::get('/mydiscounts', [StoreDiscountController::class, 'mydiscounts'])->name('mydiscounts');
        Route::get('/add', [StoreManagementController::class, 'create'])->name('create');
        Route::post('/', [StoreManagementController::class, 'store'])->name('store');
        Route::get('/edit/{store}', [StoreManagementController::class, 'edit'])->name('edit');
        Route::put('/edit/{store}', [StoreManagementController::class, 'update'])->name('update');
        Route::post('/edit/{store}/deleteimage', [StoreManagementController::class, 'deleteImage'])->name('deleteImage');
        Route::get('/id/{store}', [StoreDiscountController::class, 'create'])->name('discount.create');
        Route::post('/id/{store}', [StoreDiscountController::class, 'store'])->name('discount.store');
        Route::get('/letter/{storeDiscount:trackingCode}', [StoreDiscountController::class, 'letter'])->name('letter');
        Route::get('/discountinfo', [StoreDiscountController::class, 'discountinfo'])->name('discountinfo');
        Route::get('/', [StoreDiscountController::class, 'index'])->name('index');
    });


    Route::name('food.')->prefix('foods')->group(function() {
        Route::get('/', [FoodReservationController::class, 'index'])->name('reserve.index');
        Route::get('/reserve', [FoodReservationController::class, 'create'])->name('reserve.create');
        Route::post('/reserve', [FoodReservationController::class, 'store'])->name('reserve.store');
        Route::get('/myreservations', [FoodReservationController::class, 'myreservations'])->name('myreservations');
        Route::get('/stats', [FoodReservationManagementController::class, 'stats'])->name('stats');
        Route::get('/manage', [FoodManagementController::class, 'manage'])->name('manage');
        Route::get('/add', [FoodManagementController::class, 'create'])->name('create');
        Route::post('/', [FoodManagementController::class, 'store'])->name('store');
        Route::get('/edit/{food}', [FoodManagementController::class, 'edit'])->name('edit');
        Route::put('/edit/{food}', [FoodManagementController::class, 'update'])->name('update');
        Route::delete('/edit/{food}', [FoodManagementController::class, 'destroy'])->name('destroy');
    });
    Route::name('foodassignment.')->prefix('foodassignment')->group(function() {
        Route::get('/manage', [FoodAssignmentManagementController::class, 'manage'])->name('manage');
        Route::get('/edit/{month}', [FoodAssignmentManagementController::class, 'edit'])->name('edit');
        Route::put('/edit/{month}', [FoodAssignmentManagementController::class, 'update'])->name('update');
    });

    Route::name('role.')->prefix('roles')->group(function() {
        Route::get('/manage', [RoleController::class, 'manage'])->name('manage');
        Route::get('/', [RoleController::class, 'index'])->name('index');
        Route::get('/add', [RoleController::class, 'create'])->name('create');
        Route::post('/', [RoleController::class, 'store'])->name('store');
        Route::get('/edit/{role}', [RoleController::class, 'edit'])->name('edit');
        Route::put('/edit/{role}', [RoleController::class, 'update'])->name('update');
        Route::resource('permissions', PermissionController::class);
    });

});


Route::get('/letter/id', [AllLettersController::class, 'create'])->name('letter.create');
Route::post('/letter/id', [AllLettersController::class, 'store'])->name('letter.store');
Route::get('/letter/show/{trackingCode}', [AllLettersController::class, 'show'])->name('letter.show');

require __DIR__.'/auth.php';
