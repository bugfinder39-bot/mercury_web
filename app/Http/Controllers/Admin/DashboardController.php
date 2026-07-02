<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Page;
use App\Models\Service;
use App\Models\Partner;
use App\Models\ContactMessage;
use Inertia\Inertia;
use Inertia\Response;

class DashboardController extends Controller
{
    /**
     * Display the admin panel dashboard.
     */
    public function index(): Response
    {
        return Inertia::render('Admin/Dashboard', [
            'stats' => [
                'pages_count' => Page::count(),
                'services_count' => Service::where('is_active', true)->count(),
                'partners_count' => Partner::where('is_active', true)->count(),
                'unread_messages_count' => ContactMessage::where('is_read', false)->count(),
            ],
        ]);
    }
}
