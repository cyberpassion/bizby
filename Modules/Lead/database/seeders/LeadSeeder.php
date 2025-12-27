<?php

namespace Modules\Lead\Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\Lead\Models\Lead;
use Modules\Lead\Models\LeadFollowup;

class LeadSeeder extends Seeder
{
    public function run(): void
    {
        // Create 20 leads
        Lead::factory()
            ->count(20)
            ->create()
            ->each(function ($lead) {

                // Attach 1–5 followups per lead
                LeadFollowup::factory()
                    ->count(rand(1, 5))
                    ->create([
                        'lead_id' => $lead->id,
                    ]);
            });
    }
}
