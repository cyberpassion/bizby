<?php

namespace Modules\Product\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ProductSeeder extends Seeder
{
    public function run()
    {
        DB::table('products')->insert([
            [
                'client_id'             => 1,
                'status'                => 1,
                'created_by'            => 1,
                'updated_by'            => 1,
                'deleted_by'            => null,
                'deleted_at'            => null,

                'entry_source'          => 'system',
                'entry_source_ref_id'   => null,
                'remark'                => 'Initial product entry',
                'system_remark'         => 'Seeder generated record',
                'meta_info'             => json_encode([
                    'ip' => '127.0.0.1',
                    'device' => 'Seeder',
                ]),

                'product_type'          => 'Medicine',
                'brand_name'            => 'HealthCare',
                'product_name'          => 'Paracetamol 500mg',

                'retail_price'          => 50.00,
                'sale_price'            => 45.00,

                'product_description'   => 'Fever and pain relief medication.',
                'tags'                  => 'fever,pain,tablet',
                'additional_features'   => 'Fast relief, doctor recommended',

                'total_quantity'        => 500,
                'available_stock'       => 480,
                'sold_quantity'         => 20,

                'unit'                  => 'Strip',
                'availability'          => 'In Stock',

                'created_at'            => now(),
                'updated_at'            => now(),
            ],

            [
                'client_id'             => 1,
                'status'                => 1,
                'created_by'            => 1,
                'updated_by'            => 1,
                'deleted_by'            => null,
                'deleted_at'            => null,

                'entry_source'          => 'system',
                'entry_source_ref_id'   => null,
                'remark'                => 'Initial product entry 2',
                'system_remark'         => 'Seeder generated record',
                'meta_info'             => json_encode([
                    'ip' => '127.0.0.1',
                    'device' => 'Seeder',
                ]),

                'product_type'          => 'Surgical',
                'brand_name'            => 'MediCare',
                'product_name'          => 'Surgical Gloves',

                'retail_price'          => 120.00,
                'sale_price'            => 100.00,

                'product_description'   => 'Latex powdered disposable gloves.',
                'tags'                  => 'surgical,gloves,latex',
                'additional_features'   => 'Powdered, comfortable',

                'total_quantity'        => 1000,
                'available_stock'       => 950,
                'sold_quantity'         => 50,

                'unit'                  => 'Box',
                'availability'          => 'In Stock',

                'created_at'            => now(),
                'updated_at'            => now(),
            ]
        ]);
    }
}
