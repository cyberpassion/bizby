<?php

namespace Modules\Shared\Database\Seeders\Terms;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class TermRelationTypeSeeder extends Seeder
{
    public function run(): void
    {
        $relations = [

            // Parents / Guardians
            'Father',
            'Mother',
            'Step Father',
            'Step Mother',
            'Guardian',
            'Legal Guardian',
            'Adoptive Father',
            'Adoptive Mother',

            // Spouse / Partner
            'Spouse',
            'Husband',
            'Wife',
            'Partner',

            // Siblings
            'Brother',
            'Sister',
            'Step Brother',
            'Step Sister',

            // Children
            'Son',
            'Daughter',
            'Adopted Son',
            'Adopted Daughter',

            // Extended Family
            'Grandfather',
            'Grandmother',
            'Uncle',
            'Aunt',
            'Cousin',
            'Nephew',
            'Niece',

            // In-laws
            'Father-in-law',
            'Mother-in-law',
            'Brother-in-law',
            'Sister-in-law',
            'Son-in-law',
            'Daughter-in-law',

            // Emergency / Professional
            'Emergency Contact',
            'Caregiver',
            'Local Guardian',

            // Other
            'Friend',
            'Relative',
            'Other',
        ];

        $data = [];

        foreach ($relations as $index => $relation) {
            $data[] = [
                'tenant_id'  => 1,
                'status'     => 1,
                'name'       => $relation,
                'slug'       => Str::slug($relation),
                'group'      => 'relation-types',
                'module'     => 'shared',
                'sort_order' => $index + 1,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        DB::table('terms')->upsert(
            $data,
            ['slug', 'tenant_id'],
            ['status', 'updated_at']
        );
    }
}
