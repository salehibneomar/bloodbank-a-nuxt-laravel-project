<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        //\Database\Factories\AdminFactory::new()->create();
        //\Database\Factories\VisitorFactory::new()->count(100)->create();
        //$donors = \Database\Factories\DonorFactory::new()->count(50)->create();

        // Create donor information for each donor
        // $donors->each(function ($donor) {
        //     \App\Models\DonorInformation::factory()->create([
        //         'user_id' => $donor->id,
        //     ]);
        // });
    }
}
