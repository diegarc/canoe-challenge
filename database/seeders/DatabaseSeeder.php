<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Manager;
use App\Models\Fund;
use App\Models\Alias;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $managers = Manager::factory(30)->create();

        for ($i = 0; $i < 100; $i++) {
            $fund = Fund::factory()->create(['manager_id' => $managers->random()]);

            $aliasCant = fake()->numberBetween(0, 10);
            Alias::factory($aliasCant)->create(['fund_id' => $fund]);
        }
    }
}
