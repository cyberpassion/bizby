<?php

namespace Modules\Shared\Database\Seeders\Terms;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TermCurrencySeeder extends Seeder
{
    public function run(): void
    {
        $currencies = [

            // Asia
            ['INR','Indian Rupee'],
            ['PKR','Pakistani Rupee'],
            ['BDT','Bangladeshi Taka'],
            ['LKR','Sri Lankan Rupee'],
            ['NPR','Nepalese Rupee'],
            ['BTN','Bhutanese Ngultrum'],
            ['CNY','Chinese Yuan'],
            ['JPY','Japanese Yen'],
            ['KRW','South Korean Won'],
            ['THB','Thai Baht'],
            ['SGD','Singapore Dollar'],
            ['MYR','Malaysian Ringgit'],
            ['IDR','Indonesian Rupiah'],
            ['PHP','Philippine Peso'],
            ['VND','Vietnamese Dong'],
            ['AED','UAE Dirham'],
            ['SAR','Saudi Riyal'],
            ['QAR','Qatari Riyal'],
            ['KWD','Kuwaiti Dinar'],
            ['OMR','Omani Rial'],
            ['BHD','Bahraini Dinar'],
            ['ILS','Israeli New Shekel'],
            ['IRR','Iranian Rial'],
            ['IQD','Iraqi Dinar'],
            ['TRY','Turkish Lira'],

            // Europe
            ['EUR','Euro'],
            ['GBP','British Pound'],
            ['CHF','Swiss Franc'],
            ['SEK','Swedish Krona'],
            ['NOK','Norwegian Krone'],
            ['DKK','Danish Krone'],
            ['PLN','Polish Zloty'],
            ['CZK','Czech Koruna'],
            ['HUF','Hungarian Forint'],
            ['RON','Romanian Leu'],
            ['BGN','Bulgarian Lev'],
            ['HRK','Croatian Kuna'],
            ['ISK','Icelandic Krona'],
            ['RUB','Russian Ruble'],
            ['UAH','Ukrainian Hryvnia'],

            // Americas
            ['USD','US Dollar'],
            ['CAD','Canadian Dollar'],
            ['MXN','Mexican Peso'],
            ['BRL','Brazilian Real'],
            ['ARS','Argentine Peso'],
            ['CLP','Chilean Peso'],
            ['COP','Colombian Peso'],
            ['PEN','Peruvian Sol'],
            ['UYU','Uruguayan Peso'],
            ['VES','Venezuelan Bolívar'],
            ['BOB','Bolivian Boliviano'],
            ['PYG','Paraguayan Guarani'],
            ['DOP','Dominican Peso'],
            ['JMD','Jamaican Dollar'],

            // Africa
            ['ZAR','South African Rand'],
            ['NGN','Nigerian Naira'],
            ['KES','Kenyan Shilling'],
            ['TZS','Tanzanian Shilling'],
            ['UGX','Ugandan Shilling'],
            ['GHS','Ghanaian Cedi'],
            ['EGP','Egyptian Pound'],
            ['MAD','Moroccan Dirham'],
            ['DZD','Algerian Dinar'],
            ['TND','Tunisian Dinar'],
            ['ETB','Ethiopian Birr'],
            ['XOF','West African CFA Franc'],
            ['XAF','Central African CFA Franc'],

            // Oceania
            ['AUD','Australian Dollar'],
            ['NZD','New Zealand Dollar'],
            ['FJD','Fijian Dollar'],
            ['PGK','Papua New Guinean Kina'],
            ['SBD','Solomon Islands Dollar'],

            // Others / Special
            ['HKD','Hong Kong Dollar'],
            ['MOP','Macanese Pataca'],
            ['XCD','East Caribbean Dollar'],
            ['BMD','Bermudian Dollar'],
            ['KYD','Cayman Islands Dollar'],
        ];

        $data = [];

        foreach ($currencies as $index => [$code, $name]) {
            $data[] = [
                'tenant_id'  => 1,
                'status'     => 1,
                'name'       => $name,
                'slug'       => strtolower($code), // usd, inr, eur
                'group'      => 'currencies',
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
