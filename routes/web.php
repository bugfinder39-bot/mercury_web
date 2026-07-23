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
use App\Http\Controllers\Admin\NetworkLocationController;
use App\Http\Controllers\Admin\CertificationController;
use App\Http\Controllers\Admin\AnnouncementController;
use App\Http\Controllers\Admin\ExchangeRateController;
use App\Http\Controllers\Admin\DashboardWidgetController;
use Illuminate\Support\Facades\Route;

// Public Pages
Route::get('/', [PublicController::class, 'home'])->name('home');
Route::get('/about', [PublicController::class, 'about'])->name('about');
Route::get('/services', [PublicController::class, 'services'])->name('services');
Route::get('/contact', [PublicController::class, 'contact'])->name('contact');
Route::post('/contact', [PublicController::class, 'submitContactForm'])->name('contact.submit');
Route::get('/coming-soon', [PublicController::class, 'comingSoon'])->name('coming-soon');
Route::get('/exchange-rates', [PublicController::class, 'exchangeRates'])->name('exchange-rates');


// Authenticated Admin Dashboard & CMS Controls
Route::middleware(['auth', 'verified'])->group(function () {
    // Legacy/Redirect
    Route::redirect('dashboard', '/admin/dashboard');
    Route::get('/admin/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // CMS Dashboard Widgets Module
    Route::get('/admin/dashboard-widgets', [DashboardWidgetController::class, 'index'])->name('admin.dashboard-widgets.index');
    Route::put('/admin/dashboard-widgets/{id}', [DashboardWidgetController::class, 'update'])->name('admin.dashboard-widgets.update');
    Route::post('/admin/dashboard-widgets/layout', [DashboardWidgetController::class, 'updateLayout'])->name('admin.dashboard-widgets.layout.update');
    Route::post('/admin/dashboard-widgets/reset', [DashboardWidgetController::class, 'resetLayout'])->name('admin.dashboard-widgets.reset');
    Route::get('/admin/dashboard-widgets/export', [DashboardWidgetController::class, 'exportLayout'])->name('admin.dashboard-widgets.export');
    Route::post('/admin/dashboard-widgets/import', [DashboardWidgetController::class, 'importLayout'])->name('admin.dashboard-widgets.import');
    Route::get('/admin/dashboard-widgets/data', [DashboardWidgetController::class, 'getWidgetData'])->name('admin.dashboard-widgets.data');

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

    // Global Network CRUD
    Route::patch('/admin/global-network/{global_network}/toggle-status', [NetworkLocationController::class, 'toggleStatus'])->name('admin.global-network.toggle-status');
    Route::post('/admin/global-network/reorder', [NetworkLocationController::class, 'reorder'])->name('admin.global-network.reorder');
    Route::resource('/admin/global-network', NetworkLocationController::class)->names('admin.global-network');

    // Certifications CRUD
    Route::patch('/admin/certifications/{certification}/toggle-status', [CertificationController::class, 'toggleStatus'])->name('admin.certifications.toggle-status');
    Route::post('/admin/certifications/reorder', [CertificationController::class, 'reorder'])->name('admin.certifications.reorder');
    Route::post('/admin/certifications/{certification}/duplicate', [CertificationController::class, 'duplicate'])->name('admin.certifications.duplicate');
    Route::put('/admin/certifications/section-settings', [CertificationController::class, 'updateSectionSettings'])->name('admin.certifications.section-settings');
    Route::resource('/admin/certifications', CertificationController::class)->names('admin.certifications');

    // Exchange Rates CRUD & Management
    Route::post('/admin/exchange-rates/refresh-rates', [ExchangeRateController::class, 'refreshRates'])->name('admin.exchange-rates.refresh-rates');
    Route::post('/admin/exchange-rates/test-connection', [ExchangeRateController::class, 'testConnection'])->name('admin.exchange-rates.test-connection');
    Route::patch('/admin/exchange-rates/{exchangeRate}/toggle-status', [ExchangeRateController::class, 'toggleStatus'])->name('admin.exchange-rates.toggle-status');
    Route::patch('/admin/exchange-rates/{exchangeRate}/toggle-manual', [ExchangeRateController::class, 'toggleManual'])->name('admin.exchange-rates.toggle-manual');
    Route::post('/admin/exchange-rates/{exchangeRate}/restore-live', [ExchangeRateController::class, 'restoreLive'])->name('admin.exchange-rates.restore-live');
    Route::post('/admin/exchange-rates/reorder', [ExchangeRateController::class, 'reorder'])->name('admin.exchange-rates.reorder');
    Route::put('/admin/exchange-rates/settings', [ExchangeRateController::class, 'updateSettings'])->name('admin.exchange-rates.settings.update');
    Route::resource('/admin/exchange-rates', ExchangeRateController::class)->names('admin.exchange-rates');

    // Announcements CRUD & System Settings
    Route::patch('/admin/announcements/{announcement}/toggle-status', [AnnouncementController::class, 'toggleStatus'])->name('admin.announcements.toggle-status');
    Route::patch('/admin/announcements/{announcement}/toggle-pin', [AnnouncementController::class, 'togglePin'])->name('admin.announcements.toggle-pin');
    Route::post('/admin/announcements/reorder', [AnnouncementController::class, 'reorder'])->name('admin.announcements.reorder');
    Route::put('/admin/announcements/settings', [AnnouncementController::class, 'updateSettings'])->name('admin.announcements.settings.update');
    Route::resource('/admin/announcements', AnnouncementController::class)->names('admin.announcements');

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
    Route::patch('/admin/users/{user}/toggle-status', [UserController::class, 'toggleStatus'])->name('admin.users.toggle-status');
    Route::post('/admin/users/{user}/reset-password', [UserController::class, 'resetPassword'])->name('admin.users.reset-password');
    Route::resource('/admin/users', UserController::class)->names('admin.users');
});

require __DIR__.'/settings.php';



