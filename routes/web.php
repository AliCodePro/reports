<?php

use App\Http\Controllers\Admin\HomeController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Admin\PermissionsController;
use App\Http\Controllers\Admin\RolesController;
use App\Http\Controllers\Admin\UsersController;
use App\Http\Controllers\Admin\ReportController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\FaqController;
use App\Http\Controllers\Admin\SectionController;
use App\Http\Controllers\Admin\ChapterController;
use App\Http\Controllers\Auth\ChangePasswordController;


Route::redirect('/', '/login');
Route::get('/home', function () {
    if (session('status')) {
        return redirect()->route('admin.home')->with('status', session('status'));
    }

    return redirect()->route('admin.home');
});

Auth::routes(['register' => false]);

Route::group(['prefix' => 'admin', 'as' => 'admin.', 'middleware' => ['auth']], function () {
    Route::get('/', [HomeController::class, 'index'])->name('home');
    // Permissions
    Route::delete('permissions/destroy', [PermissionsController::class, 'massDestroy'])->name('permissions.massDestroy');
    Route::resource('permissions', PermissionsController::class);

    // Roles
    Route::delete('roles/destroy', [RolesController::class, 'massDestroy'])->name('roles.massDestroy');
    Route::resource('roles', RolesController::class);

    // Users
    Route::delete('users/destroy', [UsersController::class, 'massDestroy'])->name('users.massDestroy');
    Route::resource('users', UsersController::class);

    // Report
    Route::delete('reports/destroy', [ReportController::class, 'massDestroy'])->name('reports.massDestroy');
    Route::post('reports/media', [ReportController::class, 'storeMedia'])->name('reports.storeMedia');
    Route::post('reports/ckmedia', [ReportController::class, 'storeCKEditorImages'])->name('reports.storeCKEditorImages');
    Route::resource('reports', ReportController::class);

    // Category
    Route::delete('categories/destroy', [CategoryController::class, 'massDestroy'])->name('categories.massDestroy');
    Route::post('categories/media', [CategoryController::class, 'storeMedia'])->name('categories.storeMedia');
    Route::post('categories/ckmedia', [CategoryController::class, 'storeCKEditorImages'])->name('categories.storeCKEditorImages');
    Route::resource('categories', CategoryController::class);

    // Faq
    Route::delete('faqs/destroy', [FaqController::class, 'massDestroy'])->name('faqs.massDestroy');
    Route::post('faqs/media', [FaqController::class, 'storeMedia'])->name('faqs.storeMedia');
    Route::post('faqs/ckmedia', [FaqController::class, 'storeCKEditorImages'])->name('faqs.storeCKEditorImages');
    Route::resource('faqs', FaqController::class);

    // Section
    Route::delete('sections/destroy', [SectionController::class, 'massDestroy'])->name('sections.massDestroy');
    Route::post('sections/media', [SectionController::class, 'storeMedia'])->name('sections.storeMedia');
    Route::post('sections/ckmedia', [SectionController::class, 'storeCKEditorImages'])->name('sections.storeCKEditorImages');
    Route::resource('sections', SectionController::class);

    // Chapter
    Route::delete('chapters/destroy', [ChapterController::class, 'massDestroy'])->name('chapters.massDestroy');
    Route::resource('chapters', ChapterController::class);
});
Route::group(['prefix' => 'profile', 'as' => 'profile.', 'namespace' => 'Auth', 'middleware' => ['auth']], function () {
    // Change password
    if (file_exists(app_path('Http/Controllers/Auth/ChangePasswordController.php'))) {
        Route::get('password', [ChangePasswordController::class, 'edit'])->name('password.edit');
        Route::post('password', [ChangePasswordController::class, 'update'])->name('password.update');
        Route::post('profile', [ChangePasswordController::class, 'updateProfile'])->name('password.updateProfile');
        Route::post('profile/destroy', [ChangePasswordController::class, 'destroy'])->name('password.destroyProfile');
    }
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
