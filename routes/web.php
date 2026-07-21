<?php

use App\Http\Controllers\PublicController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\PageController;
use App\Http\Controllers\Admin\ServiceController;
use App\Http\Controllers\Admin\PartnerController;
use App\Http\Controllers\Admin\MessageController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\LayoutController;
use Illuminate\Support\Facades\Route;

// Public Pages
Route::get('/', [PublicController::class, 'home'])->name('home');
Route::get('/about', [PublicController::class, 'about'])->name('about');
Route::get('/services', [PublicController::class, 'services'])->name('services');
Route::get('/contact', [PublicController::class, 'contact'])->name('contact');
Route::post('/contact', [PublicController::class, 'submitContactForm'])->name('contact.submit');


// Authenticated Admin Dashboard & CMS Controls
Route::middleware(['auth', 'verified'])->group(function () {
    // Legacy/Redirect
    Route::redirect('dashboard', '/admin/dashboard');
    Route::get('/admin/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // CMS Pages & Section items
    Route::get('/admin/pages', [PageController::class, 'index'])->name('admin.pages.index');
    Route::get('/admin/pages/{page}/edit', [PageController::class, 'edit'])->name('admin.pages.edit');
    Route::put('/admin/pages/{page}', [PageController::class, 'update'])->name('admin.pages.update');
    Route::put('/admin/sections/{section}', [PageController::class, 'updateSection'])->name('admin.sections.update');
    Route::post('/admin/sections/{section}/items', [PageController::class, 'storeSectionItem'])->name('admin.sections.items.store');
    Route::put('/admin/section-items/{item}', [PageController::class, 'updateSectionItem'])->name('admin.section-items.update');
    Route::delete('/admin/section-items/{item}', [PageController::class, 'destroySectionItem'])->name('admin.section-items.destroy');

    // Services CRUD
    Route::resource('/admin/services', ServiceController::class)->names('admin.services');

    // Partners CRUD
    Route::resource('/admin/partners', PartnerController::class)->names('admin.partners');

    // Inbox messages
    Route::get('/admin/messages', [MessageController::class, 'index'])->name('admin.messages.index');
    Route::patch('/admin/messages/{message}/toggle-read', [MessageController::class, 'toggleRead'])->name('admin.messages.toggle-read');
    Route::delete('/admin/messages/{message}', [MessageController::class, 'destroy'])->name('admin.messages.destroy');

    // Global settings configuration
    Route::get('/admin/settings', [SettingController::class, 'edit'])->name('admin.settings.edit');
    Route::put('/admin/settings', [SettingController::class, 'update'])->name('admin.settings.update');

    // Layout configuration
    Route::get('/admin/layout', [LayoutController::class, 'edit'])->name('admin.layout.edit');
    Route::post('/admin/layout', [LayoutController::class, 'update'])->name('admin.layout.update');

    // Admin Users CRUD
    Route::resource('/admin/users', UserController::class)->names('admin.users');
});

require __DIR__.'/settings.php';


