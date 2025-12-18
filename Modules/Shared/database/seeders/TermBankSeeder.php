<?php

namespace Modules\Shared\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class TermBankSeeder extends Seeder
{
    public function run(): void
    {
        $banks = [

            // =========================
            // Public Sector Banks
            // =========================
            ['State Bank of India', 'public'],
            ['Punjab National Bank', 'public'],
            ['Bank of Baroda', 'public'],
            ['Canara Bank', 'public'],
            ['Union Bank of India', 'public'],
            ['Indian Bank', 'public'],
            ['Central Bank of India', 'public'],
            ['Bank of India', 'public'],
            ['Indian Overseas Bank', 'public'],
            ['UCO Bank', 'public'],
            ['Punjab and Sind Bank', 'public'],
            ['Bank of Maharashtra', 'public'],

            // =========================
            // Private Sector Banks
            // =========================
            ['HDFC Bank', 'private'],
            ['ICICI Bank', 'private'],
            ['Axis Bank', 'private'],
            ['Kotak Mahindra Bank', 'private'],
            ['IndusInd Bank', 'private'],
            ['Yes Bank', 'private'],
            ['IDFC First Bank', 'private'],
            ['Federal Bank', 'private'],
            ['South Indian Bank', 'private'],
            ['Karur Vysya Bank', 'private'],
            ['City Union Bank', 'private'],
            ['DCB Bank', 'private'],
            ['RBL Bank', 'private'],
            ['Bandhan Bank', 'private'],
            ['Tamilnad Mercantile Bank', 'private'],
            ['Jammu and Kashmir Bank', 'private'],
            ['Karnataka Bank', 'private'],
            ['Nainital Bank', 'private'],

            // =========================
            // Small Finance Banks
            // =========================
            ['AU Small Finance Bank', 'small_finance'],
            ['Equitas Small Finance Bank', 'small_finance'],
            ['Ujjivan Small Finance Bank', 'small_finance'],
            ['Jana Small Finance Bank', 'small_finance'],
            ['Suryoday Small Finance Bank', 'small_finance'],
            ['Utkarsh Small Finance Bank', 'small_finance'],
            ['Capital Small Finance Bank', 'small_finance'],
            ['North East Small Finance Bank', 'small_finance'],
            ['ESAF Small Finance Bank', 'small_finance'],
            ['Fincare Small Finance Bank', 'small_finance'],
            ['Shivalik Small Finance Bank', 'small_finance'],
            ['Unity Small Finance Bank', 'small_finance'],

            // =========================
            // Payments Banks
            // =========================
            ['Airtel Payments Bank', 'payments'],
            ['India Post Payments Bank', 'payments'],
            ['Fino Payments Bank', 'payments'],
            ['Paytm Payments Bank', 'payments'],
            ['Jio Payments Bank', 'payments'],

            // =========================
            // Foreign Banks in India
            // =========================
            ['Citibank', 'foreign'],
            ['HSBC Bank', 'foreign'],
            ['Standard Chartered Bank', 'foreign'],
            ['Deutsche Bank', 'foreign'],
            ['Barclays Bank', 'foreign'],
            ['BNP Paribas', 'foreign'],
            ['Credit Suisse', 'foreign'],
            ['DBS Bank', 'foreign'],
            ['Bank of America', 'foreign'],
            ['JP Morgan Chase Bank', 'foreign'],

            // =========================
            // Regional Rural Banks (Major)
            // =========================
            ['Aryavart Bank', 'rrb'],
            ['Baroda UP Bank', 'rrb'],
            ['Kerala Gramin Bank', 'rrb'],
            ['Karnataka Gramin Bank', 'rrb'],
            ['Madhyanchal Gramin Bank', 'rrb'],
            ['Rajasthan Marudhara Gramin Bank', 'rrb'],
            ['Utkal Grameen Bank', 'rrb'],
            ['Assam Gramin Vikash Bank', 'rrb'],
            ['Chaitanya Godavari Grameena Bank', 'rrb'],

            // =========================
            // Cooperative Banks (Common)
            // =========================
            ['Saraswat Cooperative Bank', 'cooperative'],
            ['Cosmos Cooperative Bank', 'cooperative'],
            ['Abhyudaya Cooperative Bank', 'cooperative'],
            ['Punjab and Maharashtra Cooperative Bank', 'cooperative'],
            ['Thane Bharat Sahakari Bank', 'cooperative'],
        ];

        $data = [];

        foreach ($banks as $index => [$name, $type]) {
            $data[] = [
                'client_id'  => 1,
                'status'     => 1,
                'name'       => $name,
                'slug'       => Str::slug($name),
                'group'      => 'bank',
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
