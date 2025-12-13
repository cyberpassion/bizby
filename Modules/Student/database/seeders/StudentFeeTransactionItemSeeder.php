<?php

namespace Modules\Student\Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\Student\Models\StudentFeeTransactionItem;

class StudentFeeTransactionItemSeeder extends Seeder
{
    public function run()
    {
        StudentFeeTransactionItem::factory()->count(20)->create();
    }
}
