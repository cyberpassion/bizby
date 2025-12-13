<?php

namespace Modules\Student\Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\Student\Models\StudentFeeTransaction;

class StudentFeeTransactionSeeder extends Seeder
{
    public function run()
    {
        StudentFeeTransaction::factory()->count(20)->create();
    }
}
