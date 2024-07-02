<?php

namespace Database\Seeders;

use App\Models\Application;
use Illuminate\Database\Seeder;

class ApplicationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        if (! app()->isProduction()) {
            for ($i = 1; $i < 5; $i++) {
                Application::factory()
                    ->create([
                        'id' => $i,
                        'key' => "key-$i",
                        'secret' => "secret-$i",
                        'is_active' => true
                    ]);
            }
        }
    }
}
