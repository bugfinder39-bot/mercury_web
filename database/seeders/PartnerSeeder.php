<?php

namespace Database\Seeders;

use App\Models\Partner;
use Illuminate\Database\Seeder;

class PartnerSeeder extends Seeder
{
    public function run(): void
    {
        Partner::create([
            'name' => 'Maersk Line',
            'logo' => '/images/partners/maersk.png',
            'link' => 'https://www.maersk.com',
            'order' => 1,
            'is_active' => true,
        ]);

        Partner::create([
            'name' => 'MSC Shipping',
            'logo' => '/images/partners/msc.png',
            'link' => 'https://www.msc.com',
            'order' => 2,
            'is_active' => true,
        ]);

        Partner::create([
            'name' => 'CMA CGM',
            'logo' => '/images/partners/cma-cgm.png',
            'link' => 'https://www.cma-cgm.com',
            'order' => 3,
            'is_active' => true,
        ]);

        Partner::create([
            'name' => 'Hapag-Lloyd',
            'logo' => '/images/partners/hapag-lloyd.png',
            'link' => 'https://www.hapag-lloyd.com',
            'order' => 4,
            'is_active' => true,
        ]);
    }
}
