<?php

namespace Modules\Student\Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\Student\Database\Seeders\AcademicLevelSeeder;
use Modules\Student\Database\Seeders\AcademicClassSeeder;
use Modules\Student\Database\Seeders\StudentSeeder;
use Modules\Student\Database\Seeders\StudentClassHistorySeeder;
use Modules\Student\Database\Seeders\StudentFeeHeadSeeder;
use Modules\Student\Database\Seeders\StudentFeeStructureSeeder;
use Modules\Student\Database\Seeders\StudentFeeSeeder;
use Modules\Student\Database\Seeders\StudentOptionalFeeSeeder;
use Modules\Student\Database\Seeders\StudentFeeTransactionSeeder;
use Modules\Student\Database\Seeders\StudentFeeTransactionItemSeeder;

class StudentDatabaseSeeder extends Seeder
{
    public function run()
    {
        $this->call([
            AcademicLevelSeeder::class,
            AcademicClassSeeder::class,
            StudentSeeder::class,
            StudentClassHistorySeeder::class,
            StudentFeeHeadSeeder::class,
            StudentFeeStructureSeeder::class,
            StudentFeeSeeder::class,
            StudentOptionalFeeSeeder::class,
            StudentFeeTransactionSeeder::class,
            StudentFeeTransactionItemSeeder::class,
        ]);
    }
}
