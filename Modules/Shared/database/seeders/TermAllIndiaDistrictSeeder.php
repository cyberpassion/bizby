<?php

namespace Modules\Shared\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class TermAllIndiaDistrictSeeder extends Seeder
{
    public function run(): void
    {
        $path = base_path(
            'Modules/Shared/Database/Seeders/all_india_districts.csv'
        );

        if (!file_exists($path)) {
            $this->command->error('District CSV file not found!');
            return;
        }

        $rows = array_map('str_getcsv', file($path));
        $header = array_shift($rows); // remove header

        $order = 1;

        foreach ($rows as $row) {

            if (count($row) < 2) {
                continue;
            }

            [$state, $district] = $row;

            DB::table('terms')->updateOrInsert(
                [
                    'slug'  => Str::slug($district),
                    'group' => 'district',
                ],
                [
                    'client_id'  => 1,
                    'status'     => 1,
                    'name'       => $district,
                    'module'     => 'address',
                    'sort_order' => $order++,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]
            );
        }
    }
}
