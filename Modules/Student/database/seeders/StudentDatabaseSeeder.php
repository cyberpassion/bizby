<?php

namespace Modules\Student\Database\Seeders;

use Modules\Student\Database\Seeders\StudentSeeder;
use Modules\Student\Database\Seeders\StudentClassHistorySeeder;
use Modules\Student\Database\Seeders\StudentFeeHeadSeeder;
use Modules\Student\Database\Seeders\StudentFeeSeeder;
use Modules\Student\Database\Seeders\StudentFeeTransactionSeeder;
use Modules\Student\Database\Seeders\StudentFeeTransactionItemsSeeder;

use Illuminate\Database\Seeder;

class StudentDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->call([
            StudentSeeder::class,
            StudentClassHistorySeeder::class,
            StudentFeeHeadSeeder::class,
            StudentFeeSeeder::class,
            StudentFeeTransactionSeeder::class,
            StudentFeeTransactionItemSeeder::class

        ]);
    }
}
