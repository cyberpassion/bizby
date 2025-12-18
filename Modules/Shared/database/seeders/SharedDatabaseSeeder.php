<?php

namespace Modules\Shared\Database\Seeders;

use Illuminate\Database\Seeder;

use Modules\Shared\Database\Seeders\TermSeeder;
use Modules\Shared\Database\Seeders\PermissionPermissionsSeeder;
use Modules\Shared\Database\Seeders\PermissionRoleSeeder;
use Modules\Shared\Database\Seeders\PermissionRolePermissionsSeeder;
use Modules\Shared\Database\Seeders\OptionsSeeder;
use Modules\Shared\Database\Seeders\ActivityLogsSeeder;
use Modules\Shared\Database\Seeders\TermStateSeeder;
use Modules\Shared\Database\Seeders\TermOnlinePaymentsSeeder;
use Modules\Shared\Database\Seeders\TermUniversitySeeder;
use Modules\Shared\Database\Seeders\TermSchoolBoardSeeder;
use Modules\Shared\Database\Seeders\TermReligionSeeder;
use Modules\Shared\Database\Seeders\TermCategorySeeder;
use Modules\Shared\Database\Seeders\TermDistrictSeeder;

class SharedDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->call([
            TermSeeder::class,
			PermissionPermissionsSeeder::class,
			PermissionRoleSeeder::class,
			PermissionRolePermissionsSeeder::class,
            TermOnlinePaymentsSeeder::class,
            OptionsSeeder::class,
            ActivityLogsSeeder::class,
            TermStateSeeder::class,
            TermUniversitySeeder::class,
            TermSchoolBoardSeeder::class,
            TermReligionSeeder::class,
            TermCategorySeeder::class,
			TermDistrictSeeder::class,
        ]);
    }
}
