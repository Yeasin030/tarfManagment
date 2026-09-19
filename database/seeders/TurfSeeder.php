<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Turf;
use App\Models\TurfImage;

class TurfSeeder extends Seeder
{
    public function run(): void
    {
        Turf::factory(6)->create()->each(function ($turf) {
            // Create a primary image for each turf
            TurfImage::create([
                'turf_id' => $turf->id,
                'image_path' => '/hero-bg.jpg', // Using the existing hero image as a placeholder
                'is_primary' => true,
            ]);
        });
    }
}
