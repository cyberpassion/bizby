<?php

namespace Modules\Shared\Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\Shared\Database\Seeders\TermSeeder;
use Modules\Shared\Database\Seeders\PermissionPermissionsSeeder;
use Modules\Shared\Database\Seeders\PermissionRoleSeeder;
use Modules\Shared\Database\Seeders\PermissionRolePermissionsSeeder;
use Modules\Shared\Database\Seeders\OptionsSeeder;
use Modules\Shared\Database\Seeders\ActivityLogsSeeder;

use Modules\Shared\Database\Seeders\TermUniversitySeeder;
use Modules\Shared\Database\Seeders\TermSchoolBoardSeeder;
use Modules\Shared\Database\Seeders\TermReligionSeeder;
use Modules\Shared\Database\Seeders\TermCategorySeeder;
use Modules\Shared\Database\Seeders\TermCasteSeeder;
use Modules\Shared\Database\Seeders\TermDesignationSeeder;
use Modules\Shared\Database\Seeders\TermGenderSeeder;
use Modules\Shared\Database\Seeders\TermBankSeeder;
use Modules\Shared\Database\Seeders\TermAcademicQualificationSeeder;
use Modules\Shared\Database\Seeders\TermPaymentModeSeeder;
use Modules\Shared\Database\Seeders\TermBloodGroupSeeder;
use Modules\Shared\Database\Seeders\TermCompanySizeSeeder;
use Modules\Shared\Database\Seeders\TermEmployeeTypeSeeder;
use Modules\Shared\Database\Seeders\TermHealthCardSeeder;
use Modules\Shared\Database\Seeders\TermLeadSourceSeeder;
use Modules\Shared\Database\Seeders\TermLeadStageSeeder;
use Modules\Shared\Database\Seeders\TermRelationTypeSeeder;
use Modules\Shared\Database\Seeders\TermCurrencySeeder;
use Modules\Shared\Database\Seeders\TermDepartmentSeeder;
use Modules\Shared\Database\Seeders\TermLanguageSeeder;
use Modules\Shared\Database\Seeders\TermInstituteTypeSeeder;
use Modules\Shared\Database\Seeders\TermMaritalStatusSeeder;
use Modules\Shared\Database\Seeders\TermNationalitySeeder;
use Modules\Shared\Database\Seeders\TermPrioritySeeder;
use Modules\Shared\Database\Seeders\TermTimeZoneSeeder;
use Modules\Shared\Database\Seeders\TermUnitSeeder;

class SharedDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->call([

            // Core
            TermSeeder::class,

            // Permissions
            PermissionPermissionsSeeder::class,
            PermissionRoleSeeder::class,
            PermissionRolePermissionsSeeder::class,

            // System
            OptionsSeeder::class,
            ActivityLogsSeeder::class,

            // Academic / Institute
            TermUniversitySeeder::class,
            TermSchoolBoardSeeder::class,
            TermInstituteTypeSeeder::class,

            // Personal / Identity
            TermReligionSeeder::class,
            TermCasteSeeder::class,
            TermGenderSeeder::class,
            TermBloodGroupSeeder::class,
            TermMaritalStatusSeeder::class,
            TermNationalitySeeder::class,
            TermLanguageSeeder::class,

            // Organization / HR
            TermDesignationSeeder::class,
            TermDepartmentSeeder::class,
            TermEmployeeTypeSeeder::class,
            TermCompanySizeSeeder::class,
            TermHealthCardSeeder::class,
            TermAcademicQualificationSeeder::class,

            // Finance / Admin
            TermBankSeeder::class,
            TermPaymentModeSeeder::class,
            TermCurrencySeeder::class,
            TermUnitSeeder::class,

            // CRM / Leads
            TermCategorySeeder::class,
            TermLeadSourceSeeder::class,
			TermLeadStageSeeder::class,
            TermRelationTypeSeeder::class,
            TermPrioritySeeder::class,

            // System / Global
            TermTimeZoneSeeder::class,
        ]);
    }
}
