<?php

namespace Modules\Lead\Database\Seeders;

use Illuminate\Database\Seeder;

use Modules\Lead\Models\Lead;
use Modules\Lead\Models\LeadFollowup;

class LeadSeeder extends Seeder
{
    public function run(): void
    {
        /*
        |--------------------------------------------------------------------------
        | Create 100 Leads
        |--------------------------------------------------------------------------
        */

        Lead::factory()

            ->count(100)

            ->create()

            ->each(function ($lead) {

                /*
                |--------------------------------------------------------------------------
                | Create 4–5 Followups
                |--------------------------------------------------------------------------
                */

                LeadFollowup::factory()

                    ->count(rand(4, 5))

                    ->create([
                        'lead_id' => $lead->id,
                    ]);
            });
    }
}