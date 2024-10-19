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
use Database\Seeders\Webapp\ProviderSeeder;
use Database\Seeders\Webapp\ContractSeeder;
use Database\Seeders\Webapp\ManufacturerSeeder;
use Database\Seeders\Webapp\AssetConditionSeeder;
use Database\Seeders\Webapp\AssetStatusSeeder;
use Database\Seeders\Webapp\AssetCategorySeeder;
use Database\Seeders\Webapp\AssetTypeSeeder;
use Database\Seeders\Webapp\AssetModelSeeder;

use Database\Seeders\Webapp\IssueTypeSeeder;
use Database\Seeders\Webapp\RequestCategorySeeder;
use Database\Seeders\Webapp\RequestTypeSeeder;
use Database\Seeders\Webapp\RequestStatusSeeder;
use Database\Seeders\Webapp\UrgencyLevelSeeder;
use Database\Seeders\Webapp\PriorityLevelSeeder;
use Database\Seeders\Webapp\RequestChannelSeeder;
use Database\Seeders\Webapp\ServiceDeskAgentSeeder;

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
            ProviderSeeder::class,
            ContractSeeder::class,
            ManufacturerSeeder::class,
            AssetConditionSeeder::class,
            AssetStatusSeeder::class,
            AssetCategorySeeder::class,
            AssetTypeSeeder::class,
            AssetModelSeeder::class,
            IssueTypeSeeder::class,
            RequestCategorySeeder::class,
            RequestTypeSeeder::class,
            RequestStatusSeeder::class,
            UrgencyLevelSeeder::class,
            PriorityLevelSeeder::class,
            RequestChannelSeeder::class,
            ServiceDeskAgentSeeder::class,
            UserSeeder::class,
        ]);
    }
}
