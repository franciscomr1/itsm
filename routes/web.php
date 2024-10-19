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
use App\Http\Controllers\Webapp\ProviderController;
use App\Http\Controllers\Webapp\ContractController;
use App\Http\Controllers\Webapp\ManufacturerController;
use App\Http\Controllers\Webapp\AssetConditionController;
use App\Http\Controllers\Webapp\AssetStatusController;
use App\Http\Controllers\Webapp\AssetCategoryController;
use App\Http\Controllers\Webapp\AssetTypeController;
use App\Http\Controllers\Webapp\AssetModelController;
use App\Http\Controllers\Webapp\IssueTypeController;
use App\Http\Controllers\Webapp\RequestCategoryController;
use App\Http\Controllers\Webapp\RequestTypeController;
use App\Http\Controllers\Webapp\RequestStatusController;
use App\Http\Controllers\Webapp\TicketController;





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

Route::controller(ProviderController::class)->group(function () {
    Route::get('providers', 'index')->name('providers.index');
    Route::get('providers/search', 'search')->name('providers.search');
    Route::post('providers/store', 'store')->name('providers.store');
    Route::patch('providers/update/{id}', 'update')->name('providers.update');
});

Route::controller(ContractController::class)->group(function () {
    Route::get('contracts', 'index')->name('contracts.index');
    Route::get('contracts/search', 'search')->name('contracts.search');
    Route::post('contracts/store', 'store')->name('contracts.store');
    Route::patch('contracts/update/{id}', 'update')->name('contracts.update');
});

Route::controller(ManufacturerController::class)->group(function () {
    Route::get('manufacturers', 'index')->name('manufacturers.index');
    Route::get('manufacturers/search', 'search')->name('manufacturers.search');
    Route::post('manufacturers/store', 'store')->name('manufacturers.store');
    Route::patch('manufacturers/update/{id}', 'update')->name('manufacturers.update');
});

Route::controller(AssetConditionController::class)->group(function () {
    Route::get('asset_conditions', 'index')->name('asset_conditions.index');
    Route::get('asset_conditions/search', 'search')->name('asset_conditions.search');
    Route::post('asset_conditions/store', 'store')->name('asset_conditions.store');
    Route::patch('asset_conditions/update/{id}', 'update')->name('asset_conditions.update');
});

Route::controller(AssetStatusController::class)->group(function () {
    Route::get('asset_statuses', 'index')->name('asset_statuses.index');
    Route::get('asset_statuses/search', 'search')->name('asset_statuses.search');
    Route::post('asset_statuses/store', 'store')->name('asset_statuses.store');
    Route::patch('asset_statuses/update/{id}', 'update')->name('asset_statuses.update');
});

Route::controller(AssetCategoryController::class)->group(function () {
    Route::get('asset_categories', 'index')->name('asset_categories.index');
    Route::get('asset_categories/search', 'search')->name('asset_categories.search');
    Route::post('asset_categories/store', 'store')->name('asset_categories.store');
    Route::patch('asset_categories/update/{id}', 'update')->name('asset_categories.update');
});

Route::controller(AssetTypeController::class)->group(function () {
    Route::get('asset_types', 'index')->name('asset_types.index');
    Route::get('asset_types/search', 'search')->name('asset_types.search');
    Route::post('asset_types/store', 'store')->name('asset_types.store');
    Route::patch('asset_types/update/{id}', 'update')->name('asset_types.update');
});

Route::controller(AssetModelController::class)->group(function () {
    Route::get('asset_models', 'index')->name('asset_models.index');
    Route::get('asset_models/search', 'search')->name('asset_models.search');
    Route::post('asset_models/store', 'store')->name('asset_models.store');
    Route::patch('asset_models/update/{id}', 'update')->name('asset_models.update');
});


Route::controller(IssueTypeController::class)->group(function () {
    Route::get('issue_types', 'index')->name('issue_types.index');
    Route::get('issue_types/search', 'search')->name('issue_types.search');
    Route::post('issue_types/store', 'store')->name('issue_types.store');
    Route::patch('issue_types/update/{id}', 'update')->name('issue_types.update');
});

Route::controller(RequestCategoryController::class)->group(function () {
    Route::get('request_categories', 'index')->name('request_categories.index');
    Route::get('request_categories/search', 'search')->name('request_categories.search');
    Route::post('request_categories/store', 'store')->name('request_categories.store');
    Route::patch('request_categories/update/{id}', 'update')->name('request_categories.update');
});

Route::controller(RequestTypeController::class)->group(function () {
    Route::get('request_types', 'index')->name('request_types.index');
    Route::get('request_types/search', 'search')->name('request_types.search');
    Route::post('request_types/store', 'store')->name('request_types.store');
    Route::patch('request_types/update/{id}', 'update')->name('request_types.update');
});

Route::controller(RequestStatusController::class)->group(function () {
    Route::get('request_statuses', 'index')->name('request_statuses.index');
    Route::get('request_statuses/search', 'search')->name('request_statuses.search');
    Route::post('request_statuses/store', 'store')->name('request_statuses.store');
    Route::patch('request_statuses/update/{id}', 'update')->name('request_statuses.update');
});

Route::controller(TicketController::class)->group(function () {
    Route::get('tickets', 'index')->name('tickets.index');
    Route::get('tickets/create', 'create')->name('tickets.create');
    Route::get('tickets/chart', 'chart')->name('tickets.chart');
    Route::get('tickets/search', 'search')->name('tickets.search');
    Route::post('tickets/store', 'store')->name('tickets.store');
    Route::patch('tickets/update/{id}', 'update')->name('tickets.update');
    Route::patch('tickets/assign/{id}', 'assign')->name('tickets.assign');
});