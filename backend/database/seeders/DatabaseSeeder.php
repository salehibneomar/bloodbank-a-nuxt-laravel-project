<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {;
        \Database\Factories\AdminFactory::new()->create();
        //\Database\Factories\VisitorFactory::new()->count(100)->create();
        //\Database\Factories\DonorFactory::new()->count(100)->create();
    }
}
