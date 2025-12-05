<?php

namespace Modules\Lead\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

use Modules\Lead\Models\Lead;
use Modules\Lead\Models\LeadFollowup;

class LeadSeeder extends Seeder
{
    public function run()
	{
		Lead::factory()->count(20)->create()->each(function ($lead) {
			LeadFollowup::factory()->count(rand(1,5))->create(['lead_id' => $lead->id]);
		});
	}
}