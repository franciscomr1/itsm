<?php

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use Laravel\Fortify\Fortify;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Webapp\CompanyController;
use App\Http\Controllers\Webapp\BranchController;
use App\Http\Controllers\Webapp\DepartmentController;
use App\Http\Controllers\Webapp\PositionController;
use App\Http\Controllers\Webapp\EmployeeController;




Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return Inertia::render('Custom/Dashboard');
    })->name('dashboard');
});


Fortify::loginView(function () {
    return Inertia::render('Custom/Auth/Login', [
        //  'canResetPassword' => Route::has('password.request'),
        'fortifyUsername' => Fortify::username(),
    ]);
});

Route::controller(CompanyController::class)->group(function () {
    Route::get('companies', 'index')->name('companies.index');
    Route::get('companies/search', 'search')->name('companies.search');
    Route::post('companies/store', 'store')->name('companies.store');
    Route::patch('companies/update/{id}', 'update')->name('companies.update');

});

Route::controller(BranchController::class)->group(function () {
    Route::get('branches', 'index')->name('branches.index');
    Route::get('branches/search', 'search')->name('branches.search');
    Route::post('branches/store', 'store')->name('branches.store');
    Route::patch('branches/update/{id}', 'update')->name('branches.update');

});

Route::controller(DepartmentController::class)->group(function () {
    Route::get('departments', 'index')->name('departments.index');
    Route::get('departments/search', 'search')->name('departments.search');
    Route::post('departments/store', 'store')->name('departments.store');
    Route::patch('departments/update/{id}', 'update')->name('departments.update');

});

Route::controller(PositionController::class)->group(function () {
    Route::get('positions', 'index')->name('positions.index');
    Route::get('positions/search', 'search')->name('positions.search');
    Route::post('positions/store', 'store')->name('positions.store');
    Route::patch('positions/update/{id}', 'update')->name('positions.update');

});

Route::controller(EmployeeController::class)->group(function () {
    Route::get('employees', 'index')->name('employees.index');
    Route::get('employees/search', 'search')->name('employees.search');
    Route::post('employees/store', 'store')->name('employees.store');
    Route::patch('employees/update/{id}', 'update')->name('employees.update');
    Route::patch('employees/deactivate/{id}', 'deactivate')->name('employees.deactivate');
});
