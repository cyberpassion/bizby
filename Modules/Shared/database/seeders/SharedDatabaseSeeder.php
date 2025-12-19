<?php

namespace Modules\Shared\Database\Seeders;

use Illuminate\Database\Seeder;

use Modules\Shared\Database\Seeders\TermSeeder;
use Modules\Shared\Database\Seeders\PermissionPermissionsSeeder;
use Modules\Shared\Database\Seeders\PermissionRoleSeeder;
use Modules\Shared\Database\Seeders\PermissionRolePermissionsSeeder;
use Modules\Shared\Database\Seeders\OptionsSeeder;
use Modules\Shared\Database\Seeders\ActivityLogsSeeder;
use Modules\Shared\Database\Seeders\TermOnlinePaymentsSeeder;
use Modules\Shared\Database\Seeders\TermStateSeeder;
use Modules\Shared\Database\Seeders\TermUniversitiesSeeder;
use Modules\Shared\Database\Seeders\TermSchoolBoardSeeder;
use Modules\Shared\Database\Seeders\TermReligionSeeder;
use Modules\Shared\Database\Seeders\TermCategorySeeder;
use Modules\Shared\Database\Seeders\TermCasteSeeder;
use Modules\Shared\Database\Seeders\TermDesignationSeeder;
use Modules\Shared\Database\Seeders\TermGenderSeeder;
use Modules\Shared\Database\Seeders\TermBankSeeder;
use Modules\Shared\Database\Seeders\TermAcademicQualificationSeeder;
use Modules\Shared\Database\Seeders\TermBusinessTypeSeeder;
use Modules\Shared\Database\Seeders\TermPaymentModeSeeder;
use Modules\Shared\Database\Seeders\TermAllIndiaDistrictSeeder;
use Modules\Shared\Database\Seeders\TermBloodGroupSeeder;

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
            OptionsSeeder::class,
            ActivityLogsSeeder::class,
            TermOnlinePaymentsSeeder::class,
            TermStateSeeder::class,
            TermUniversitiesSeeder::class,
            TermSchoolBoardSeeder::class,
            TermReligionSeeder::class,
            TermCategorySeeder::class,
            TermCasteSeeder::class,
            TermDesignationSeeder::class,
            TermGenderSeeder::class,
            TermBankSeeder::class,
            TermAcademicQualificationSeeder::class,
            TermBusinessTypeSeeder::class,
            TermPaymentModeSeeder::class,
            TermAllIndiaDistrictSeeder::class,
            TermBloodGroupSeeder::class,
        ]);
    }
}
