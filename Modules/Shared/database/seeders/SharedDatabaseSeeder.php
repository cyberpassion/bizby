<?php

namespace Modules\Shared\Database\Seeders;

use Illuminate\Database\Seeder;

// use Modules\Shared\Database\Seeders\Developer\ActivityLogsSeeder;

use Modules\Shared\Database\Seeders\Options\OptionsSeeder;

// Permissions
use Modules\Shared\Database\Seeders\Permissions\PermissionPermissionsSeeder;
use Modules\Shared\Database\Seeders\Permissions\PermissionRoleSeeder;
use Modules\Shared\Database\Seeders\Permissions\PermissionRolePermissionsSeeder;
use Modules\Shared\Database\Seeders\Permissions\PermissionUserRoleSeeder;
use Modules\Shared\Database\Seeders\Permissions\PermissionUserPermissionSeeder;

// Terms
use Modules\Shared\Database\Seeders\Terms\TermSeeder;
use Modules\Shared\Database\Seeders\Terms\TermUniversitySeeder;
use Modules\Shared\Database\Seeders\Terms\TermSchoolBoardSeeder;
use Modules\Shared\Database\Seeders\Terms\TermReligionSeeder;
use Modules\Shared\Database\Seeders\Terms\TermCategorySeeder;
use Modules\Shared\Database\Seeders\Terms\TermCasteSeeder;
use Modules\Shared\Database\Seeders\Terms\TermDesignationSeeder;
use Modules\Shared\Database\Seeders\Terms\TermGenderSeeder;
use Modules\Shared\Database\Seeders\Terms\TermBankSeeder;
use Modules\Shared\Database\Seeders\Terms\TermAcademicQualificationSeeder;
use Modules\Shared\Database\Seeders\Terms\TermPaymentModeSeeder;
use Modules\Shared\Database\Seeders\Terms\TermBloodGroupSeeder;
use Modules\Shared\Database\Seeders\Terms\TermCompanySizeSeeder;
use Modules\Shared\Database\Seeders\Terms\TermEmployeeTypeSeeder;
use Modules\Shared\Database\Seeders\Terms\TermHealthCardSeeder;
use Modules\Shared\Database\Seeders\Terms\TermLeadSourceSeeder;
use Modules\Shared\Database\Seeders\Terms\TermLeadStageSeeder;
use Modules\Shared\Database\Seeders\Terms\TermRelationTypeSeeder;
use Modules\Shared\Database\Seeders\Terms\TermCurrencySeeder;
use Modules\Shared\Database\Seeders\Terms\TermDepartmentSeeder;
use Modules\Shared\Database\Seeders\Terms\TermLanguageSeeder;
use Modules\Shared\Database\Seeders\Terms\TermInstituteTypeSeeder;
use Modules\Shared\Database\Seeders\Terms\TermMaritalStatusSeeder;
use Modules\Shared\Database\Seeders\Terms\TermNationalitySeeder;
use Modules\Shared\Database\Seeders\Terms\TermPrioritySeeder;
use Modules\Shared\Database\Seeders\Terms\TermTimeZoneSeeder;
use Modules\Shared\Database\Seeders\Terms\TermUnitSeeder;

class SharedDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->call([

			// Just for testing purposes
			// ActivityLogsSeeder::class,

			// System
            OptionsSeeder::class,

            // Core
            TermSeeder::class,

            // Permissions
            // Create roles (Owner, Admin, Staff)
		    PermissionRoleSeeder::class,

		    // Create all permissions (users.*, orders.*, etc.)
		    PermissionPermissionsSeeder::class,

		    // Assign permissions to roles
		    PermissionRolePermissionsSeeder::class,

		    // Assign roles to users
		    PermissionUserRoleSeeder::class,

		    // Assign direct user permissions (overrides)
		    PermissionUserPermissionSeeder::class,

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
