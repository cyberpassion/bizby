<?php

namespace Modules\Examresult\Database\Seeders;

use Illuminate\Database\Seeder;

use Modules\Examresult\Database\Seeders\ExamresultSeeder;

class ExamresultDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->call([
            ExamresultSeeder::class,
        ]);
    }
}
