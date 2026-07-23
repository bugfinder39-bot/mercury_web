<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Page;
use App\Models\Service;
use App\Models\Partner;
use App\Models\ContactMessage;
use App\Models\NetworkLocation;
use App\Models\Certification;
use App\Models\Announcement;
use App\Models\ExchangeRate;
use App\Models\User;
use App\Http\Controllers\Admin\DashboardWidgetController;
use Inertia\Inertia;
use Inertia\Response;

class DashboardController extends Controller
{
    /**
     * Display the admin panel customizable dashboard.
     */
    public function index(): Response
    {
        $userId = auth()->id();
        $userRole = auth()->user()->role ?? 'admin';

        $widgetController = app(DashboardWidgetController::class);
        $userWidgets = $widgetController->getUserWidgets($userId, $userRole);

        // Pre-fetch data for active widgets
        $widgetData = [];
        foreach ($userWidgets as $widget) {
            if ($widget->is_enabled) {
                try {
                    $widgetData[$widget->widget_key] = $widgetController->fetchDataForWidget($widget->widget_key);
                } catch (\Throwable $e) {
                    \Illuminate\Support\Facades\Log::error("Dashboard widget pre-fetch failed for [{$widget->widget_key}]: " . $e->getMessage(), [
                        'exception' => $e,
                    ]);
                    $widgetData[$widget->widget_key] = ['error' => true, 'message' => 'Unable to retrieve widget data.'];
                }
            }
        }

        return Inertia::render('Admin/Dashboard', [
            'widgets' => $userWidgets,
            'initial_widget_data' => $widgetData,
            'stats' => [
                'pages_count' => Page::count(),
                'services_count' => Service::where('is_active', true)->count(),
                'services_total' => Service::count(),
                'partners_count' => Partner::where('is_active', true)->count(),
                'partners_total' => Partner::count(),
                'unread_messages_count' => ContactMessage::where('is_read', false)->count(),
                'total_messages_count' => ContactMessage::count(),
                'network_locations_count' => NetworkLocation::where('is_active', true)->count(),
                'network_locations_total' => NetworkLocation::count(),
                'certifications_count' => Certification::where('is_active', true)->count(),
                'certifications_total' => Certification::count(),
                'announcements_count' => Announcement::where('is_active', true)->count(),
                'announcements_total' => Announcement::count(),
                'exchange_rates_count' => ExchangeRate::where('is_active', true)->count(),
                'exchange_rates_total' => ExchangeRate::count(),
                'users_count' => User::count(),
            ],
            'recent_messages' => ContactMessage::orderBy('created_at', 'desc')
                ->take(5)
                ->get(['id', 'name', 'email', 'subject', 'is_read', 'created_at']),
        ]);
    }
}
