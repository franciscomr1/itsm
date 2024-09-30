<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Database\Seeders\Webapp\CompanySeeder;
use Database\Seeders\Webapp\BranchSeeder;
use Database\Seeders\Webapp\DepartmentSeeder;
use Database\Seeders\Webapp\PositionSeeder;
use Database\Seeders\Webapp\EmployeeSeeder;
use Database\Seeders\UserSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();
        $this->call([
            CompanySeeder::class,
            BranchSeeder::class,
            DepartmentSeeder::class,
            PositionSeeder::class,
            EmployeeSeeder::class,
            UserSeeder::class,
        ]);
    }
}
