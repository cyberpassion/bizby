<?php

namespace Modules\Shared\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TermNationalitySeeder extends Seeder
{
    public function run(): void
    {
        $nationalities = [

            // Asia
            ['AF','Afghan'], ['AM','Armenian'], ['AZ','Azerbaijani'], ['BH','Bahraini'],
            ['BD','Bangladeshi'], ['BT','Bhutanese'], ['BN','Bruneian'], ['KH','Cambodian'],
            ['CN','Chinese'], ['CY','Cypriot'], ['GE','Georgian'], ['IN','Indian'],
            ['ID','Indonesian'], ['IR','Iranian'], ['IQ','Iraqi'], ['IL','Israeli'],
            ['JP','Japanese'], ['JO','Jordanian'], ['KZ','Kazakh'], ['KW','Kuwaiti'],
            ['KG','Kyrgyz'], ['LA','Laotian'], ['LB','Lebanese'], ['MY','Malaysian'],
            ['MV','Maldivian'], ['MN','Mongolian'], ['MM','Myanmar'], ['NP','Nepalese'],
            ['KP','North Korean'], ['OM','Omani'], ['PK','Pakistani'], ['PH','Filipino'],
            ['QA','Qatari'], ['SA','Saudi'], ['SG','Singaporean'], ['KR','South Korean'],
            ['LK','Sri Lankan'], ['SY','Syrian'], ['TH','Thai'], ['TL','Timorese'],
            ['TR','Turkish'], ['AE','Emirati'], ['UZ','Uzbek'], ['VN','Vietnamese'],
            ['YE','Yemeni'],

            // Europe
            ['AL','Albanian'], ['AD','Andorran'], ['AT','Austrian'], ['BY','Belarusian'],
            ['BE','Belgian'], ['BA','Bosnian'], ['BG','Bulgarian'], ['HR','Croatian'],
            ['CZ','Czech'], ['DK','Danish'], ['EE','Estonian'], ['FI','Finnish'],
            ['FR','French'], ['DE','German'], ['GR','Greek'], ['HU','Hungarian'],
            ['IS','Icelandic'], ['IE','Irish'], ['IT','Italian'], ['LV','Latvian'],
            ['LI','Liechtensteiner'], ['LT','Lithuanian'], ['LU','Luxembourgish'],
            ['MT','Maltese'], ['MD','Moldovan'], ['MC','Monégasque'], ['ME','Montenegrin'],
            ['NL','Dutch'], ['MK','North Macedonian'], ['NO','Norwegian'], ['PL','Polish'],
            ['PT','Portuguese'], ['RO','Romanian'], ['RU','Russian'], ['SM','Sammarinese'],
            ['RS','Serbian'], ['SK','Slovak'], ['SI','Slovenian'], ['ES','Spanish'],
            ['SE','Swedish'], ['CH','Swiss'], ['UA','Ukrainian'], ['GB','British'],
            ['VA','Vatican'],

            // Africa
            ['DZ','Algerian'], ['AO','Angolan'], ['BJ','Beninese'], ['BW','Botswanan'],
            ['BF','Burkinabé'], ['BI','Burundian'], ['CM','Cameroonian'], ['CF','Central African'],
            ['TD','Chadian'], ['KM','Comorian'], ['CG','Congolese'], ['CI','Ivorian'],
            ['DJ','Djiboutian'], ['EG','Egyptian'], ['GQ','Equatorial Guinean'],
            ['ER','Eritrean'], ['SZ','Swazi'], ['ET','Ethiopian'], ['GA','Gabonese'],
            ['GM','Gambian'], ['GH','Ghanaian'], ['GN','Guinean'], ['GW','Bissau-Guinean'],
            ['KE','Kenyan'], ['LS','Lesotho'], ['LR','Liberian'], ['LY','Libyan'],
            ['MG','Malagasy'], ['MW','Malawian'], ['ML','Malian'], ['MR','Mauritanian'],
            ['MU','Mauritian'], ['MA','Moroccan'], ['MZ','Mozambican'], ['NA','Namibian'],
            ['NE','Nigerien'], ['NG','Nigerian'], ['RW','Rwandan'], ['ST','São Toméan'],
            ['SN','Senegalese'], ['SC','Seychellois'], ['SL','Sierra Leonean'],
            ['SO','Somali'], ['ZA','South African'], ['SS','South Sudanese'],
            ['SD','Sudanese'], ['TZ','Tanzanian'], ['TG','Togolese'], ['TN','Tunisian'],
            ['UG','Ugandan'], ['ZM','Zambian'], ['ZW','Zimbabwean'],

            // Americas
            ['AG','Antiguan'], ['AR','Argentine'], ['BS','Bahamian'], ['BB','Barbadian'],
            ['BZ','Belizean'], ['BO','Bolivian'], ['BR','Brazilian'], ['CA','Canadian'],
            ['CL','Chilean'], ['CO','Colombian'], ['CR','Costa Rican'], ['CU','Cuban'],
            ['DM','Dominican'], ['DO','Dominican'], ['EC','Ecuadorian'], ['SV','Salvadoran'],
            ['GD','Grenadian'], ['GT','Guatemalan'], ['GY','Guyanese'], ['HT','Haitian'],
            ['HN','Honduran'], ['JM','Jamaican'], ['MX','Mexican'], ['NI','Nicaraguan'],
            ['PA','Panamanian'], ['PY','Paraguayan'], ['PE','Peruvian'], ['KN','Kittitian'],
            ['LC','Saint Lucian'], ['VC','Vincentian'], ['SR','Surinamese'],
            ['TT','Trinidadian'], ['US','American'], ['UY','Uruguayan'], ['VE','Venezuelan'],

            // Oceania
            ['AU','Australian'], ['FJ','Fijian'], ['KI','I-Kiribati'],
            ['MH','Marshallese'], ['FM','Micronesian'], ['NR','Nauruan'],
            ['NZ','New Zealander'], ['PW','Palauan'], ['PG','Papua New Guinean'],
            ['WS','Samoan'], ['SB','Solomon Islander'], ['TO','Tongan'],
            ['TV','Tuvaluan'], ['VU','Ni-Vanuatu'],
        ];

        $data = [];

        foreach ($nationalities as $index => [$code, $name]) {
            $slug = strtolower($code) . '-' . strtolower(str_replace(' ', '-', $name));

            $data[] = [
                'client_id'  => 1,
                'status'     => 1,
                'name'       => $name,
                'slug'       => $slug, // eg: in-indian
                'group'      => 'nationality',
                'module'     => 'shared',
                'meta'       => json_encode([
                    'country_code' => $code,
                ]),
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
