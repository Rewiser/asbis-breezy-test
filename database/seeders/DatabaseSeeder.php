<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\ApiUsers;
use App\Models\Managers;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        User::factory()->count(10)->create();
        ApiUsers::factory()->count(10)->create();
        Managers::factory()->count(10)->create();
    }
}
