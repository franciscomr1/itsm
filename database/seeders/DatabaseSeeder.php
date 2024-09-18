<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Database\Seeders\Catalog\CompanySeeder;
use Database\Seeders\Catalog\BranchSeeder;
use Database\Seeders\Catalog\DepartmentSeeder;
use Database\Seeders\Catalog\PositionSeeder;
use Database\Seeders\Catalog\EmployeeSeeder;
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
