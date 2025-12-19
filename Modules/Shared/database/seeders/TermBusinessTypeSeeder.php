<?php

namespace Modules\Shared\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class TermBusinessTypeSeeder extends Seeder
{
    public function run(): void
    {
        $businessTypes = [

            /* ---------- Ownership Based ---------- */
            'Proprietorship',
            'Partnership Firm',
            'Limited Liability Partnership (LLP)',
            'Private Limited Company',
            'Public Limited Company',
            'One Person Company (OPC)',

            /* ---------- Government / Trust ---------- */
            'Government Organization',
            'Public Sector Undertaking (PSU)',
            'Trust',
            'Society',
            'Non-Profit Organization (NGO)',

            /* ---------- Business Nature ---------- */
            'Manufacturer',
            'Trader',
            'Wholesaler',
            'Retailer',
            'Distributor',
            'Service Provider',

            /* ---------- Industry Based ---------- */
            'IT / Software Services',
            'E-Commerce',
            'Education & Training',
            'Healthcare',
            'Construction',
            'Real Estate',
            'Logistics & Transport',
            'Hospitality',
            'Tourism & Travel',
            'Media & Advertising',
            'Finance & Insurance',
            'Agriculture',
            'Food & Beverage',
            'Textile',
            'Automobile',
            'Energy & Power',
            'Telecom',
            'Manufacturing',
            'Mining',

            /* ---------- Other ---------- */
            'Startup',
            'Freelancer',
            'Consultancy',
            'Export / Import',
            'Other'
        ];

        foreach ($businessTypes as $index => $type) {
            DB::table('terms')->updateOrInsert(
                [
                    'slug'  => Str::slug($type),
                    'group' => 'business_type',
                ],
                [
                    'client_id'  => 1,
                    'status'     => 1,
                    'name'       => $type,
                    'module'     => 'business',
                    'sort_order' => $index + 1,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]
            );
        }
    }
}