<?php

namespace Modules\Shared\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TermBusinessTypeSeeder extends Seeder
{
    public function run(): void
    {
        $businessTypes = [

            // Individuals / Education
            'individual'              => 'Individual',
            'school'                  => 'School',
            'college'                 => 'College',
            'university'              => 'University',

            // Fuel / Healthcare
            'petrol_pump'             => 'Petrol Pump',
            'hospital'                => 'Hospital',
            'clinic'                  => 'Clinic',

            // Retail / Food
            'shop_owner'              => 'Shop Owner',
            'retail_store'            => 'Retail Store',
            'restaurant'              => 'Restaurant',
            'cafe'                    => 'Cafe',
            'supermarket'             => 'Supermarket',

            // Finance
            'bank'                    => 'Bank',
            'financial_institution'   => 'Financial Institution',
            'insurance_company'       => 'Insurance Company',

            // Real Estate / Construction
            'real_estate_agency'      => 'Real Estate Agency',
            'construction_company'    => 'Construction Company',

            // IT / Professional Services
            'it_services'             => 'IT Services',
            'software_development'    => 'Software Development',
            'consulting_firm'         => 'Consulting Firm',
            'legal_services'          => 'Legal Services',
            'accounting_firm'         => 'Accounting Firm',
            'marketing_agency'        => 'Marketing Agency',
            'advertising_agency'      => 'Advertising Agency',

            // Travel / Hospitality
            'travel_agency'           => 'Travel Agency',
            'hotel'                   => 'Hotel',
            'motel'                   => 'Motel',
            'resort'                  => 'Resort',
            'tour_operator'           => 'Tour Operator',
            'car_rental'              => 'Car Rental',

            // Manufacturing / Logistics
            'manufacturing'           => 'Manufacturing',
            'warehouse'               => 'Warehouse',
            'logistics'               => 'Logistics',
            'transportation'          => 'Transportation',

            // Pharma / Science
            'pharmaceutical_company'  => 'Pharmaceutical Company',
            'biotechnology'           => 'Biotechnology',

            // Agriculture / Food
            'agriculture'             => 'Agriculture',
            'farm'                    => 'Farm',
            'food_processing'         => 'Food Processing',

            // Industry
            'textile_industry'        => 'Textile Industry',
            'apparel_industry'        => 'Apparel Industry',
            'automotive_industry'     => 'Automotive Industry',
            'electronics'             => 'Electronics',
            'telecommunications'      => 'Telecommunications',

            // Media / Education
            'media_entertainment'     => 'Media and Entertainment',
            'publishing'              => 'Publishing',
            'education_services'      => 'Education Services',

            // Health / Lifestyle
            'health_wellness'         => 'Health and Wellness',
            'fitness_center'          => 'Fitness Center',
            'beauty_salon'            => 'Beauty Salon',
            'barber_shop'             => 'Barber Shop',

            // Services
            'dry_cleaning'            => 'Dry Cleaning',
            'laundry_services'        => 'Laundry Services',

            // Home / Retail
            'furniture_store'         => 'Furniture Store',
            'home_improvement'        => 'Home Improvement',
            'garden_center'           => 'Garden Center',
            'pet_store'               => 'Pet Store',
            'veterinary_clinic'       => 'Veterinary Clinic',

            // Organization
            'non_profit_organization' => 'Non-Profit Organization',
            'government_agency'       => 'Government Agency',
        ];

        $data = [];
        $order = 1;

        foreach ($businessTypes as $slug => $name) {
            $data[] = [
                'client_id'  => 1,
                'status'     => 1,
                'name'       => $name,
                'slug'       => $slug, // controlled slug (important)
                'group'      => 'business-types',
                'module'     => 'shared',
                'sort_order' => $order++,
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
