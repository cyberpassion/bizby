<?php

namespace Modules\Shared\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TermUnitSeeder extends Seeder
{
    public function run(): void
    {
        $units = [

            // Length
            ['Meter', 'm', 'length'],
            ['Kilometer', 'km', 'length'],
            ['Centimeter', 'cm', 'length'],
            ['Millimeter', 'mm', 'length'],

            // Weight
            ['Kilogram', 'kg', 'weight'],
            ['Gram', 'g', 'weight'],
            ['Tonne', 'ton', 'weight'],

            // Volume
            ['Liter', 'l', 'volume'],
            ['Milliliter', 'ml', 'volume'],

            // Time
            ['Second', 'sec', 'time'],
            ['Minute', 'min', 'time'],
            ['Hour', 'hr', 'time'],
            ['Day', 'day', 'time'],

            // Quantity
            ['Piece', 'pcs', 'quantity'],
            ['Dozen', 'dozen', 'quantity'],
        ];

        $data = [];

        foreach ($units as $index => [$name, $symbol, $type]) {
            $data[] = [
                'client_id'  => 1,
                'status'     => 1,
                'name'       => $name,
                'slug'       => strtolower($symbol),
                'group'      => 'unit',
                'module'     => 'shared',
                'sort_order' => $index + 1,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        DB::table('terms')->upsert(
            $data,
            ['slug', 'client_id'],
            ['status', 'updated_at']
        );
    }
}
