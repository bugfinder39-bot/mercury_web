<?php

namespace Database\Seeders;

use App\Models\Service;
use Illuminate\Database\Seeder;

class ServiceSeeder extends Seeder
{
    public function run(): void
    {
        Service::create([
            'name' => 'Ocean Freight Forwarding',
            'slug' => 'ocean-freight',
            'icon' => 'Ship',
            'short_description' => 'FCL and LCL container scheduling across major trade routes.',
            'long_description' => 'We coordinate with major steamship lines to secure container allocations even during peak seasons. Offering both Full Container Load (FCL) and Less than Container Load (LCL) consolidated services, we manage import and export files with rigorous accuracy.',
            'order' => 1,
            'is_active' => true,
        ]);

        Service::create([
            'name' => 'Air Freight Logistics',
            'slug' => 'air-freight',
            'icon' => 'Plane',
            'short_description' => 'Time-sensitive global air transport and expedited clearance.',
            'long_description' => 'For high-value or urgent cargo, our air freight division schedules optimal flights. We manage express shipments, airport-to-airport freight, and door-to-door delivery manifests with complete customs preparation.',
            'order' => 2,
            'is_active' => true,
        ]);

        Service::create([
            'name' => 'Warehousing & Consolidation',
            'slug' => 'warehousing',
            'icon' => 'Warehouse',
            'short_description' => 'Secure temporary storage and freight consolidation hubs.',
            'long_description' => 'Our secure facilities offer short-term and long-term cargo storage. We provide packaging, palletization, label manifest printing, and buyers cargo consolidation to optimize container utilization before export.',
            'order' => 3,
            'is_active' => true,
        ]);

        Service::create([
            'name' => 'Customs Brokerage',
            'slug' => 'customs-brokerage',
            'icon' => 'FileCheck',
            'short_description' => 'Expert clearance and regulatory compliance management.',
            'long_description' => 'Customs laws require absolute accuracy in HS codes and values. Our licensed customs brokers prepare import and export files, calculate duties, handle inspections, and secure prompt clearance at ports.',
            'order' => 4,
            'is_active' => true,
        ]);
    }
}
