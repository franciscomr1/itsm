<?php

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use Laravel\Fortify\Fortify;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Catalog\CompanyController;



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
    Route::get('/companies', 'index')->name('companies.index');
    Route::get('/companies/search', 'search')->name('companies.search');
});
