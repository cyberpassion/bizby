<?php

namespace Modules\Shared\Database\Seeders;

use Illuminate\Database\Seeder;

use Modules\Shared\Database\Seeders\TermSeeder;
use Modules\Shared\Database\Seeders\PermissionPermissionsSeeder;
use Modules\Shared\Database\Seeders\PermissionRoleSeeder;
use Modules\Shared\Database\Seeders\PermissionRolePermissionsSeeder;
use Modules\Shared\Database\Seeders\OptionsSeeder;
use Modules\Shared\Database\Seeders\ActivityLogsSeeder;
use Modules\Shared\Database\Seeders\TermIndianStateSeeder;
use Modules\Shared\Database\Seeders\TermPaymentModeSeeder;
use Modules\Shared\Database\Seeders\TermUniversitySeeder;
use Modules\Shared\Database\Seeders\TermSchoolBoardSeeder;
use Modules\Shared\Database\Seeders\TermReligionSeeder;
use Modules\Shared\Database\Seeders\TermCategorySeeder;
use Modules\Shared\Database\Seeders\TermDistrictSeeder;
use Modules\Shared\Database\Seeders\TermBloodGroupSeeder;
use Modules\Shared\Database\Seeders\TermGenderSeeder;
use Modules\Shared\Database\Seeders\TermMaritalStatusSeeder;
use Modules\Shared\Database\Seeders\TermNationalitySeeder;
use Modules\Shared\Database\Seeders\TermCurrencySeeder;
use Modules\Shared\Database\Seeders\TermBankSeeder;
use Modules\Shared\Database\Seeders\TermLanguageSeeder;
use Modules\Shared\Database\Seeders\TermTimeZoneSeeder;
use Modules\Shared\Database\Seeders\TermUnitSeeder;
use Modules\Shared\Database\Seeders\TermBusinessTypeSeeder;
use Modules\Shared\Database\Seeders\TermCompanySizeSeeder;
use Modules\Shared\Database\Seeders\TermCasteSeeder;
use Modules\Shared\Database\Seeders\TermInstituteTypeSeeder;
use Modules\Shared\Database\Seeders\TermRelationTypeSeeder;
use Modules\Shared\Database\Seeders\TermLeadSourceSeeder;
use Modules\Shared\Database\Seeders\TermHealthCardSeeder;
use Modules\Shared\Database\Seeders\TermAcademicQualificationSeeder;
use Modules\Shared\Database\Seeders\TermEmployeeTypeSeeder;
use Modules\Shared\Database\Seeders\TermDepartmentSeeder;
use Modules\Shared\Database\Seeders\TermDesignationSeeder;
use Modules\Shared\Database\Seeders\TermPrioritySeeder;

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
            TermPaymentModeSeeder::class,
            OptionsSeeder::class,
            ActivityLogsSeeder::class,
            TermIndianStateSeeder::class,
            TermUniversitySeeder::class,
            TermSchoolBoardSeeder::class,
            TermReligionSeeder::class,
            TermCategorySeeder::class,
			TermDistrictSeeder::class,
			TermBloodGroupSeeder::class,
			TermGenderSeeder::class,
			TermMaritalStatusSeeder::class,
			TermNationalitySeeder::class,
			TermCurrencySeeder::class,
			TermBankSeeder::class,
			TermLanguageSeeder::class,
			TermTimeZoneSeeder::class,
			TermUnitSeeder::class,
			TermBusinessTypeSeeder::class,
			TermCompanySizeSeeder::class,
			TermCasteSeeder::class,
			TermInstituteTypeSeeder::class,
			TermRelationTypeSeeder::class,
			TermLeadSourceSeeder::class,
			TermHealthCardSeeder::class,
			TermAcademicQualificationSeeder::class,
			TermEmployeeTypeSeeder::class,
			TermDepartmentSeeder::class,
			TermDesignationSeeder::class,
			TermPrioritySeeder::class,
        ]);
    }
}
