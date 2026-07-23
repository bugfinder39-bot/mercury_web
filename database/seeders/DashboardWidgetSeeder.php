<?php

namespace Database\Seeders;

use App\Models\DashboardWidget;
use App\Models\AuditLog;
use Illuminate\Database\Seeder;

class DashboardWidgetSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $defaultWidgets = [
            [
                'widget_key' => 'website_visitors',
                'title' => 'Website Visitors',
                'subtitle' => 'Traffic overview & trends',
                'icon' => 'Users',
                'bg_style' => 'default',
                'chart_type' => 'area',
                'size' => 'medium', // col-span-4
                'display_order' => 1,
                'refresh_interval' => 30,
                'animation' => 'fade',
                'is_enabled' => true,
                'permission_role' => 'all',
            ],
            [
                'widget_key' => 'todays_visitors',
                'title' => "Today's Visitors",
                'subtitle' => 'Daily traffic count',
                'icon' => 'Eye',
                'bg_style' => 'card',
                'chart_type' => 'mini',
                'size' => 'small', // col-span-3
                'display_order' => 2,
                'refresh_interval' => 10,
                'animation' => 'pulse',
                'is_enabled' => true,
                'permission_role' => 'all',
            ],
            [
                'widget_key' => 'online_visitors',
                'title' => 'Online Visitors',
                'subtitle' => 'Currently active users',
                'icon' => 'Activity',
                'bg_style' => 'glass',
                'chart_type' => 'mini',
                'size' => 'small',
                'display_order' => 3,
                'refresh_interval' => 5,
                'animation' => 'pulse',
                'is_enabled' => true,
                'permission_role' => 'all',
            ],
            [
                'widget_key' => 'page_views',
                'title' => 'Page Views',
                'subtitle' => 'Most viewed site sections',
                'icon' => 'TrendingUp',
                'bg_style' => 'default',
                'chart_type' => 'bar',
                'size' => 'medium',
                'display_order' => 4,
                'refresh_interval' => 60,
                'animation' => 'fade',
                'is_enabled' => true,
                'permission_role' => 'all',
            ],
            [
                'widget_key' => 'contact_messages',
                'title' => 'Contact Messages & Inbox',
                'subtitle' => 'Unread inquiries & submissions',
                'icon' => 'Mail',
                'bg_style' => 'card',
                'chart_type' => 'line',
                'size' => 'large', // col-span-6
                'display_order' => 5,
                'refresh_interval' => 15,
                'animation' => 'fade',
                'is_enabled' => true,
                'permission_role' => 'all',
            ],
            [
                'widget_key' => 'exchange_rates',
                'title' => 'Exchange Rates',
                'subtitle' => 'Live currency rates status',
                'icon' => 'DollarSign',
                'bg_style' => 'default',
                'chart_type' => 'line',
                'size' => 'medium',
                'display_order' => 6,
                'refresh_interval' => 60,
                'animation' => 'fade',
                'is_enabled' => true,
                'permission_role' => 'all',
            ],
            [
                'widget_key' => 'announcements',
                'title' => 'Announcements',
                'subtitle' => 'Public notices & active pins',
                'icon' => 'Megaphone',
                'bg_style' => 'default',
                'chart_type' => 'mini',
                'size' => 'medium',
                'display_order' => 7,
                'refresh_interval' => 30,
                'animation' => 'fade',
                'is_enabled' => true,
                'permission_role' => 'all',
            ],
            [
                'widget_key' => 'latest_news',
                'title' => 'Latest News & Pages',
                'subtitle' => 'Recent CMS content changes',
                'icon' => 'BookOpen',
                'bg_style' => 'default',
                'chart_type' => 'bar',
                'size' => 'medium',
                'display_order' => 8,
                'refresh_interval' => 60,
                'animation' => 'fade',
                'is_enabled' => true,
                'permission_role' => 'all',
            ],
            [
                'widget_key' => 'recent_users',
                'title' => 'Recent Users',
                'subtitle' => 'Registered admin users',
                'icon' => 'UserCheck',
                'bg_style' => 'default',
                'chart_type' => 'mini',
                'size' => 'small',
                'display_order' => 9,
                'refresh_interval' => 60,
                'animation' => 'fade',
                'is_enabled' => true,
                'permission_role' => 'super_admin',
            ],
            [
                'widget_key' => 'audit_logs',
                'title' => 'Latest Activity & Audit Logs',
                'subtitle' => 'System & CMS action trail',
                'icon' => 'ShieldAlert',
                'bg_style' => 'card',
                'chart_type' => 'line',
                'size' => 'large',
                'display_order' => 10,
                'refresh_interval' => 15,
                'animation' => 'fade',
                'is_enabled' => true,
                'permission_role' => 'admin',
            ],
            [
                'widget_key' => 'media_storage',
                'title' => 'Media & Storage Usage',
                'subtitle' => 'Disk space & uploaded assets',
                'icon' => 'HardDrive',
                'bg_style' => 'default',
                'chart_type' => 'pie',
                'size' => 'small',
                'display_order' => 11,
                'refresh_interval' => 120,
                'animation' => 'fade',
                'is_enabled' => true,
                'permission_role' => 'admin',
            ],
            [
                'widget_key' => 'company_stats',
                'title' => 'Company Statistics',
                'subtitle' => 'Logistics performance counters',
                'icon' => 'BarChart3',
                'bg_style' => 'gradient',
                'chart_type' => 'bar',
                'size' => 'full', // col-span-12
                'display_order' => 12,
                'refresh_interval' => 300,
                'animation' => 'fade',
                'is_enabled' => true,
                'permission_role' => 'all',
            ],
            [
                'widget_key' => 'homepage_status',
                'title' => 'Homepage Components Status',
                'subtitle' => 'Active section visibility',
                'icon' => 'Layout',
                'bg_style' => 'default',
                'chart_type' => 'mini',
                'size' => 'medium',
                'display_order' => 13,
                'refresh_interval' => 60,
                'animation' => 'fade',
                'is_enabled' => true,
                'permission_role' => 'admin',
            ],
            [
                'widget_key' => 'system_health',
                'title' => 'System Health & Server Info',
                'subtitle' => 'PHP, Laravel & memory overview',
                'icon' => 'Server',
                'bg_style' => 'dark',
                'chart_type' => 'mini',
                'size' => 'medium',
                'display_order' => 14,
                'refresh_interval' => 30,
                'animation' => 'fade',
                'is_enabled' => true,
                'permission_role' => 'super_admin',
            ],
            [
                'widget_key' => 'database_status',
                'title' => 'Database & Cache Status',
                'subtitle' => 'DB connections & cache health',
                'icon' => 'Database',
                'bg_style' => 'default',
                'chart_type' => 'mini',
                'size' => 'small',
                'display_order' => 15,
                'refresh_interval' => 60,
                'animation' => 'fade',
                'is_enabled' => true,
                'permission_role' => 'super_admin',
            ],
        ];

        foreach ($defaultWidgets as $widget) {
            DashboardWidget::updateOrCreate(
                [
                    'user_id' => null,
                    'widget_key' => $widget['widget_key'],
                ],
                $widget
            );
        }

        // Seed initial audit log if empty
        if (AuditLog::count() === 0) {
            AuditLog::log('system_init', 'Dashboard widget module initialized & default layout seeded.');
        }
    }
}
