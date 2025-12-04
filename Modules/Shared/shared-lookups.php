<?php

return [

    // ===================================================================
    // Client List (official names in uppercase)
    // ===================================================================
    "client-json" => (function () {
        $clients = \Db::core_connect()->select('cyp_client', ['module' => ['!', 'admin']]);
        $res = [];
        foreach ($clients as $client) {
            $res[$client['client_id']] = strtoupper($client['client_official_name']);
        }
        return $res;
    })(),

    // ===================================================================
    // Communication Templates
    // ===================================================================
    "communicationTemplate-module" => [
        "user_entry_new_sms"               => "User Entry SMS",
        "user_entry_new_whatsapp"          => "User Entry Whatsapp",
        "user_entry_new_email"             => "User Entry Email",
        "user_entry_update_sms"            => "User Entry Update SMS",
        "user_entry_update_whatsapp"       => "User Entry Update Whatsapp",
        "user_entry_update_email"          => "User Entry Update Email",
        "user_passwordchange_new_sms"      => "User Password Change SMS",
        "user_passwordchange_new_whatsapp" => "User Password Change Whatsapp",
        "user_passwordchange_new_email"    => "User Password Change Email",
        "user_passwordreset_new_sms"       => "User Password Reset SMS",
        "user_passwordreset_new_whatsapp"  => "User Password Reset Whatsapp",
        "user_passwordreset_new_email"     => "User Password Reset Email"
    ],

    // ===================================================================
    // User Module List Filters
    // ===================================================================
    "listFilters-user_entry_update" =>
    "listFilters-user_list_update" =>
    "listFilters-user_detail_update" => (function () {
        $pg = \v3\C\user::$pg;
        return [
            'admin' => [
                $pg => [
                    'Profile'      => "{$pg}/profile",
                    'Edit'         => "{$pg}/entry/update",
                    'Upload'       => "{$pg}/upload",
                    'View Details' => "{$pg}/detail",
                    'Permissions'  => [
                        'path'   => "permission/entry",
                        'params' => [
                            'type'    => $pg,
                            'type_id' => 'user_id'
                        ]
                    ]
                ]
            ]
        ];
    })(),

    // ===================================================================
    // Primary Modules / ERPs
    // ===================================================================
    "cyperp-json" =>
    "primarymodule-json" => \v3\M\Option\Core::get_available_primary_module_names(),

    // ===================================================================
    // Login Types
    // ===================================================================
    "login_type-json" => array_keys(\v3\C\Module::get_all_allowed_logins()),

    // ===================================================================
    // Business Types
    // ===================================================================
    "business_type-json" => [
        "individual"               => "Individual",
        "school"                   => "School",
        "college"                  => "College",
        "university"               => "University",
        "petrol_pump"              => "Petrol Pump",
        "hospital"                 => "Hospital",
        "clinic"                   => "Clinic",
        "shop_owner"               => "Shop Owner",
        "retail_store"             => "Retail Store",
        "restaurant"               => "Restaurant",
        "cafe"                     => "Cafe",
        "supermarket"              => "Supermarket",
        "bank"                     => "Bank",
        "financial_institution"    => "Financial Institution",
        "insurance_company"        => "Insurance Company",
        "real_estate_agency"       => "Real Estate Agency",
        "construction_company"     => "Construction Company",
        "it_services"              => "IT Services",
        "software_development"     => "Software Development",
        "consulting_firm"          => "Consulting Firm",
        "legal_services"           => "Legal Services",
        "accounting_firm"          => "Accounting Firm",
        "marketing_agency"         => "Marketing Agency",
        "advertising_agency"       => "Advertising Agency",
        "travel_agency"            => "Travel Agency",
        "hotel"                    => "Hotel",
        "motel"                    => "Motel",
        "resort"                   => "Resort",
        "tour_operator"            => "Tour Operator",
        "car_rental"               => "Car Rental",
        "manufacturing"            => "Manufacturing",
        "warehouse"                => "Warehouse",
        "logistics"                => "Logistics",
        "transportation"           => "Transportation",
        "pharmaceutical_company"   => "Pharmaceutical Company",
        "biotechnology"            => "Biotechnology",
        "agriculture"              => "Agriculture",
        "farm"                     => "Farm",
        "food_processing"          => "Food Processing",
        "textile_industry"         => "Textile Industry",
        "apparel_industry"         => "Apparel Industry",
        "automotive_industry"      => "Automotive Industry",
        "electronics"              => "Electronics",
        "telecommunications"       => "Telecommunications",
        "media_entertainment"      => "Media and Entertainment",
        "publishing"               => "Publishing",
        "education_services"       => "Education Services",
        "health_wellness"          => "Health and Wellness",
        "fitness_center"           => "Fitness Center",
        "beauty_salon"             => "Beauty Salon",
        "barber_shop"              => "Barber Shop",
        "dry_cleaning"             => "Dry Cleaning",
        "laundry_services"         => "Laundry Services",
        "furniture_store"          => "Furniture Store",
        "home_improvement"         => "Home Improvement",
        "garden_center"            => "Garden Center",
        "pet_store"                => "Pet Store",
        "veterinary_clinic"        => "Veterinary Clinic",
        "non_profit_organization"  => "Non-Profit Organization",
        "government_agency"        => "Government Agency"
    ],

    // ===================================================================
    // Option Names (excluding is_* flags)
    // ===================================================================
    "option_name-json" => (function () {
        $allOptions = \v3\C\Settings::reformat_values_for_prefill(\v3\M\Option\Module::get());
        $res = ['Select'];
        foreach (array_keys($allOptions) as $optionName) {
            if (stripos($optionName, 'is_') !== 0) {
                $res[$optionName] = $optionName;
            }
        }
        return $res;
    })(),

    // ===================================================================
    // Themes
    // ===================================================================
    "theme-json" => [
        "#3f51b5"       => "DEFAULT BLUE",
        "orangered"     => "ORANGE RED",
        "deepskyblue"   => "SKY BLUE",
        "deeppink"      => "DEEP PINK",
        "blueviolet"    => "BLUE VIOLET",
        "indigo"        => "INDIGO",
        "limegreen"     => "LIMEGREEN",
        "maroon"        => "MAROON",
        "tomato"        => "TOMATO",
        "teal"          => "TEAL",
        "steelblue"     => "STEEL BLUE",
        "saddlebrown"   => "SADDLE BROWN",
        "royalblue"     => "ROYAL BLUE",
        "red"           => "RED",
        "darkmagenta"   => "MAGENTA",
        "deeppink"      => "PINK",
        "seagreen"      => "GREEN",
        "darkslateblue" => "DARK BLUE",
        "purple"        => "PURPLE",
        "navy"          => "NAVY",
        "mediumvioletred"=> "VIOLET RED",
        "firebrick"     => "FIREBRICK",
        "darkslategrey" => "DARK GREY"
    ],

    // ===================================================================
    // Indian States (uppercase values)
    // ===================================================================
    "indian_state-json" => array_map('strtoupper', [
        "AP" => "Andhra Pradesh",
        "AR" => "Arunachal Pradesh",
        "AS" => "Assam",
        "BR" => "Bihar",
        "CG" => "Chhattisgarh",
        "GA" => "Goa",
        "GJ" => "Gujarat",
        "HR" => "Haryana",
        "HP" => "Himachal Pradesh",
        "JK" => "Jammu and Kashmir",
        "JH" => "Jharkhand",
        "KA" => "Karnataka",
        "KL" => "Kerala",
        "MP" => "Madhya Pradesh",
        "MH" => "Maharashtra",
        "MN" => "Manipur",
        "ML" => "Meghalaya",
        "MZ" => "Mizoram",
        "NL" => "Nagaland",
        "OR" => "Odisha",
        "PB" => "Punjab",
        "RJ" => "Rajasthan",
        "SK" => "Sikkim",
        "TN" => "Tamil Nadu",
        "TG" => "Telangana",
        "TR" => "Tripura",
        "UP" => "Uttar Pradesh",
        "UK" => "Uttarakhand",
        "WB" => "West Bengal",
        "AN" => "Andaman and Nicobar Islands",
        "CH" => "Chandigarh",
        "DN" => "Dadra and Nagar Haveli",
        "DD" => "Daman and Diu",
        "LD" => "Lakshadweep",
        "DL" => "National Capital Territory of Delhi",
        "PY" => "Puducherry"
    ]),

    // ===================================================================
    // Indian State → Districts
    // ===================================================================
    "indian_state_district-json" => [
        'AN'=>['name'=>'ANDAMAN AND NICOBAR ISLAND (UT)','districts'=>['NICOBAR','NORTH AND MIDDLE ANDAMAN','SOUTH ANDAMAN']],
        'AP'=>['name'=>'ANDHRA PRADESH','districts'=>['ANANTAPUR','CHITTOOR','EAST GODAVARI','GUNTUR','KRISHNA','KURNOOL','PRAKASAM','SRIKAKULAM','SRI POTTI SRIRAMULU NELLORE','VISAKHAPATNAM','VIZIANAGARAM','WEST GODAVARI','YSR DISTRICT,KADAPA (CUDDAPAH)']],
        'AR'=>['name'=>'ARUNACHAL PRADESH','districts'=>['ANJAW','CHANGLANG','DIBANG VALLEY','EAST KAMENG','EAST SIANG','KRA DAADI','KURUNG KUMEY','LOHIT','LONGDING','LOWER DIBANG VALLEY','LOWER SIANG','LOWER SUBANSIRI','NAMSAI','PAPUM PARE','SIANG','TAWANG','TIRAP','UPPER SIANG','UPPER SUBANSIRI','WEST KAMENG','WEST SIANG']],
        'AS'=>['name'=>'ASSAM','districts'=>['BAKSA','BARPETA','BISWANATH','BONGAIGAON','CACHAR','CHARAIDEO','CHIRANG','DARRANG','DHEMAJI','DHUBRI','DIBRUGARH','DIMA HASAO (NORTH CACHAR HILLS)','GOALPARA','GOLAGHAT','HAILAKANDI','HOJAI','JORHAT','KAMRUP','KAMRUP METROPOLITAN','KARBI ANGLONG','KARIMGANJ','KOKRAJHAR','LAKHIMPUR','MAJULI','MORIGAON','NAGAON','NALBARI','SIVASAGAR','SONITPUR','SOUTH SALAMARA-MANKACHAR','TINSUKIA','UDALGURI','WEST KARBI ANGLONG']],
        'BR'=>['name'=>'BIHAR','districts'=>['ARARIA','ARWAL','AURANGABAD','BANKA','BEGUSARAI','BHAGALPUR','BHOJPUR','BUXAR','DARBHANGA','EAST CHAMPARAN (MOTIHARI)','GAYA','GOPALGANJ','JAMUI','JEHANABAD','KAIMUR (BHABUA)','KATIHAR','KHAGARIA','KISHANGANJ','LAKHISARAI','MADHEPURA','MADHUBANI','MUNGER (MONGHYR)','MUZAFFARPUR','NALANDA','NAWADA','PATNA','PURNIA (PURNEA)','ROHTAS','SAHARSA','SAMASTIPUR','SARAN','SHEIKHPURA','SHEOHAR','SITAMARHI','SIWAN','SUPAUL','VAISHALI','WEST CHAMPARAN']],
        'CH'=>['name'=>'CHANDIGARH (UT)','districts'=>['CHANDIGARH']],
        'CG'=>['name'=>'CHHATTISGARH','districts'=>['BALOD','BALODA BAZAR','BALRAMPUR','BASTAR','BEMETARA','BIJAPUR','BILASPUR','DANTEWADA (SOUTH BASTAR)','DHAMTARI','DURG','GARIYABAND','JANJGIR-CHAMPA','JASHPUR','KABIRDHAM (KAWARDHA)','KANKER (NORTH BASTAR)','KONDAGAON','KORBA','KOREA (KORIYA)','MAHASAMUND','MUNGELI','NARAYANPUR','RAIGARH','RAIPUR','RAJNANDGAON','SUKMA','SURAJPUR ','SURGUJA']],
        'DN'=>['name'=>'DADRA AND NAGAR HAVELI (UT)','districts'=>['DADRA & NAGAR HAVELI']],
        'DD'=>['name'=>'DAMAN AND DIU (UT)','districts'=>['DAMAN','DIU']],
        'DL'=>['name'=>'DELHI (NCT)','districts'=>['CENTRAL DELHI','EAST DELHI','NEW DELHI','NORTH DELHI','NORTH EAST DELHI','NORTH WEST DELHI','SHAHDARA','SOUTH DELHI','SOUTH EAST DELHI','SOUTH WEST DELHI','WEST DELHI']],
        'GA'=>['name'=>'GOA','districts'=>['NORTH GOA','SOUTH GOA']],
        'GJ'=>['name'=>'GUJARAT','districts'=>['AHMEDABAD','AMRELI','ANAND','ARAVALLI','BANASKANTHA (PALANPUR)','BHARUCH','BHAVNAGAR','BOTAD','CHHOTA UDEPUR','DAHOD','DANGS (AHWA)','DEVBHOOMI DWARKA','GANDHINAGAR','GIR SOMNATH','JAMNAGAR','JUNAGADH','KACHCHH','KHEDA (NADIAD)','MAHISAGAR','MEHSANA','MORBI','NARMADA (RAJPIPLA)','NAVSARI','PANCHMAHAL (GODHRA)','PATAN','PORBANDAR','RAJKOT','SABARKANTHA (HIMMATNAGAR)','SURAT','SURENDRANAGAR','TAPI (VYARA)','VADODARA','VALSAD']],
        'HR'=>['name'=>'HARYANA','districts'=>['AMBALA','BHIWANI','CHARKHI DADRI','FARIDABAD','FATEHABAD','GURGAON','HISAR','JHAJJAR','JIND','KAITHAL','KARNAL','KURUKSHETRA','MAHENDRAGARH','MEWAT','PALWAL','PANCHKULA','PANIPAT','REWARI','ROHTAK','SIRSA','SONIPAT','YAMUNANAGAR']],
        'HP'=>['name'=>'HIMACHAL PRADESH','districts'=>['BILASPUR','CHAMBA','HAMIRPUR','KANGRA','KINNAUR','KULLU','LAHAUL & SPITI','MANDI','SHIMLA','SIRMAUR (SIRMOUR)','SOLAN','UNA']],
        'JK'=>['name'=>'JAMMU AND KASHMIR','districts'=>['ANANTNAG','BANDIPORE','BARAMULLA','BUDGAM','DODA','GANDERBAL','JAMMU','KARGIL','KATHUA','KISHTWAR','KULGAM','KUPWARA','LEH','POONCH','PULWAMA','RAJOURI','RAMBAN','REASI','SAMBA','SHOPIAN','SRINAGAR','UDHAMPUR']],
        'JH'=>['name'=>'JHARKHAND','districts'=>['BOKARO','CHATRA','DEOGHAR','DHANBAD','DUMKA','EAST SINGHBHUM','GARHWA','GIRIDIH','GODDA','GUMLA','HAZARIBAG','JAMTARA','KHUNTI','KODERMA','LATEHAR','LOHARDAGA','PAKUR','PALAMU','RAMGARH','RANCHI','SAHIBGANJ','SERAIKELA-KHARSAWAN','SIMDEGA','WEST SINGHBHUM']],
        'KA'=>['name'=>'KARNATAKA','districts'=>['BAGALKOT','BALLARI (BELLARY)','BELAGAVI (BELGAUM)','BENGALURU (BANGALORE) RURAL','BENGALURU (BANGALORE) URBAN','BIDAR','CHAMARAJANAGAR','CHIKBALLAPUR','CHIKKAMAGALURU (CHIKMAGALUR)','CHITRADURGA','DAKSHINA KANNADA','DAVANGERE','DHARWAD','GADAG','HASSAN','HAVERI','KALABURAGI (GULBARGA)','KODAGU','KOLAR','KOPPAL','MANDYA','MYSURU (MYSORE)','RAICHUR','RAMANAGARA','SHIVAMOGGA (SHIMOGA)','TUMAKURU (TUMKUR)','UDUPI','UTTARA KANNADA (KARWAR)','VIJAYAPURA (BIJAPUR)','YADGIR']],
        'KL'=>['name'=>'KERALA','districts'=>['ALAPPUZHA','ERNAKULAM','IDUKKI','KANNUR','KASARAGOD','KOLLAM','KOTTAYAM','KOZHIKODE','MALAPPURAM','PALAKKAD','PATHANAMTHITTA','THIRUVANANTHAPURAM','THRISSUR','WAYANAD']],
        'LD'=>['name'=>'LAKSHADWEEP (UT)','districts'=>['LAKSHADWEEP']],
        'MP'=>['name'=>'MADHYA PRADESH','districts'=>['AGAR MALWA','ALIRAJPUR','ANUPPUR','ASHOKNAGAR','BALAGHAT','BARWANI','BETUL','BHIND','BHOPAL','BURHANPUR','CHHATARPUR','CHHINDWARA','DAMOH','DATIA','DEWAS','DHAR','DINDORI','GUNA','GWALIOR','HARDA','HOSHANGABAD','INDORE','JABALPUR','JHABUA','KATNI','KHANDWA','KHARGONE','MANDLA','MANDSAUR','MORENA','NARSINGHPUR','NEEMUCH','PANNA','RAISEN','RAJGARH','RATLAM','REWA','SAGAR','SATNA','SEHORE','SEONI','SHAHDOL','SHAJAPUR','SHEOPUR','SHIVPURI','SIDHI','SINGRAULI','TIKAMGARH','UJJAIN','UMARIA','VIDISHA']],
        'MH'=>['name'=>'MAHARASHTRA','districts'=>['AHMEDNAGAR','AKOLA','AMRAVATI','AURANGABAD','BEED','BHANDARA','BULDHANA','CHANDRAPUR','DHULE','GADCHIROLI','GONDIA','HINGOLI','JALGAON','JALNA','KOLHAPUR','LATUR','MUMBAI CITY','MUMBAI SUBURBAN','NAGPUR','NANDED','NANDURBAR','NASHIK','OSMANABAD','PALGHAR','PARBHANI','PUNE','RAIGAD','RATNAGIRI','SANGLI','SATARA','SINDHUDURG','SOLAPUR','THANE','WARDHA','WASHIM','YAVATMAL']],
        'MN'=>['name'=>'MANIPUR','districts'=>['BISHNUPUR','CHANDEL','CHURACHANDPUR','IMPHAL EAST','IMPHAL WEST','JIRIBAM','KAKCHING','KAMJONG','KANGPOKPI','NONEY','PHERZAWL','SENAPATI','TAMENGLONG','TENGNOUPAL','THOUBAL','UKHRUL']],
        'ML'=>['name'=>'MEGHALAYA','districts'=>['EAST GARO HILLS','EAST JAINTIA HILLS','EAST KHASI HILLS','NORTH GARO HILLS','RI BHOI','SOUTH GARO HILLS','SOUTH WEST GARO HILLS ','SOUTH WEST KHASI HILLS','WEST GARO HILLS','WEST JAINTIA HILLS','WEST KHASI HILLS']],
        'MZ'=>['name'=>'MIZORAM','districts'=>['AIZAWL','CHAMPHAI','KOLASIB','LAWNGTLAI','LUNGLEI','MAMIT','SAIHA','SERCHHIP']],
        'NL'=>['name'=>'NAGALAND','districts'=>['DIMAPUR','KIPHIRE','KOHIMA','LONGLENG','MOKOKCHUNG','MON','PEREN','PHEK','TUENSANG','WOKHA','ZUNHEBOTO']],
        'OR'=>['name'=>'ODISHA','districts'=>['ANGUL','BALANGIR','BALASORE','BARGARH','BHADRAK','BOUDH','CUTTACK','DEOGARH','DHENKANAL','GAJAPATI','GANJAM','JAGATSINGHAPUR','JAJPUR','JHARSUGUDA','KALAHANDI','KANDHAMAL','KENDRAPARA','KENDUJHAR (KEONJHAR)','KHORDHA','KORAPUT','MALKANGIRI','MAYURBHANJ','NABARANGPUR','NAYAGARH','NUAPADA','PURI','RAYAGADA','SAMBALPUR','SONEPUR','SUNDARGARH']],
        'PY'=>['name'=>'PUDUCHERRY (UT)','districts'=>['KARAIKAL','MAHE','PONDICHERRY','YANAM']],
        'PB'=>['name'=>'PUNJAB','districts'=>['AMRITSAR','BARNALA','BATHINDA','FARIDKOT','FATEHGARH SAHIB','FAZILKA','FEROZEPUR','GURDASPUR','HOSHIARPUR','JALANDHAR','KAPURTHALA','LUDHIANA','MANSA','MOGA','MUKTSAR','NAWANSHAHR (SHAHID BHAGAT SINGH NAGAR)','PATHANKOT','PATIALA','RUPNAGAR','SAHIBZADA AJIT SINGH NAGAR (MOHALI)','SANGRUR','TARN TARAN']],
        'RJ'=>['name'=>'RAJASTHAN','districts'=>['AJMER','ALWAR','BANSWARA','BARAN','BARMER','BHARATPUR','BHILWARA','BIKANER','BUNDI','CHITTORGARH','CHURU','DAUSA','DHOLPUR','DUNGARPUR','HANUMANGARH','JAIPUR','JAISALMER','JALORE','JHALAWAR','JHUNJHUNU','JODHPUR','KARAULI','KOTA','NAGAUR','PALI','PRATAPGARH','RAJSAMAND','SAWAI MADHOPUR','SIKAR','SIROHI','SRI GANGANAGAR','TONK','UDAIPUR']],
        'SK'=>['name'=>'SIKKIM','districts'=>['EAST SIKKIM','NORTH SIKKIM','SOUTH SIKKIM','WEST SIKKIM']],
        'TN'=>['name'=>'TAMIL NADU','districts'=>['ARIYALUR','CHENNAI','COIMBATORE','CUDDALORE','DHARMAPURI','DINDIGUL','ERODE','KANCHIPURAM','KANYAKUMARI','KARUR','KRISHNAGIRI','MADURAI','NAGAPATTINAM','NAMAKKAL','NILGIRIS','PERAMBALUR','PUDUKKOTTAI','RAMANATHAPURAM','SALEM','SIVAGANGA','THANJAVUR','THENI','THOOTHUKUDI (TUTICORIN)','TIRUCHIRAPPALLI','TIRUNELVELI','TIRUPPUR','TIRUVALLUR','TIRUVANNAMALAI','TIRUVARUR','VELLORE','VILUPPURAM','VIRUDHUNAGAR']],
        'TG'=>['name'=>'TELANGANA','districts'=>['ADILABAD','BHADRADRI KOTHAGUDEM','HYDERABAD','JAGTIAL','JANGAON','JAYASHANKAR BHOOPALPALLY','JOGULAMBA GADWAL','KAMAREDDY','KARIMNAGAR','KHAMMAM','KOMARAM BHEEM ASIFABAD','MAHABUBABAD','MAHABUBNAGAR','MANCHERIAL','MEDAK','MEDCHAL','NAGARKURNOOL','NALGONDA','NIRMAL','NIZAMABAD','PEDDAPALLI','RAJANNA SIRCILLA','RANGAREDDY','SANGAREDDY','SIDDIPET','SURYAPET','VIKARABAD','WANAPARTHY','WARANGAL (RURAL)','WARANGAL (URBAN)','YADADRI BHUVANAGIRI']],
        'TR'=>['name'=>'TRIPURA','districts'=>['DHALAI','GOMATI','KHOWAI','NORTH TRIPURA','SEPAHIJALA','SOUTH TRIPURA','UNAKOTI','WEST TRIPURA']],
        'UK'=>['name'=>'UTTARAKHAND','districts'=>['ALMORA','BAGESHWAR','CHAMOLI','CHAMPAWAT','DEHRADUN','HARIDWAR','NAINITAL','PAURI GARHWAL','PITHORAGARH','RUDRAPRAYAG','TEHRI GARHWAL','UDHAM SINGH NAGAR','UTTARKASHI']],
        'UP'=>['name'=>'UTTAR PRADESH','districts'=>['AGRA','ALIGARH','ALLAHABAD','AMBEDKAR NAGAR','AMETHI (CHATRAPATI SAHUJI MAHRAJ NAGAR)','AMROHA (J.P. NAGAR)','AURAIYA','AZAMGARH','BAGHPAT','BAHRAICH','BALLIA','BALRAMPUR','BANDA','BARABANKI','BAREILLY','BASTI','BHADOHI','BIJNOR','BUDAUN','BULANDSHAHR','CHANDAULI','CHITRAKOOT','DEORIA','ETAH','ETAWAH','FAIZABAD','FARRUKHABAD','FATEHPUR','FIROZABAD','GAUTAM BUDDHA NAGAR','GHAZIABAD','GHAZIPUR','GONDA','GORAKHPUR','HAMIRPUR','HAPUR (PANCHSHEEL NAGAR)','HARDOI','HATHRAS','JALAUN','JAUNPUR','JHANSI','KANNAUJ','KANPUR DEHAT','KANPUR NAGAR','KANSHIRAM NAGAR (KASGANJ)','KAUSHAMBI','KUSHINAGAR (PADRAUNA)','LAKHIMPUR - KHERI','LALITPUR','LUCKNOW','MAHARAJGANJ','MAHOBA','MAINPURI','MATHURA','MAU','MEERUT','MIRZAPUR','MORADABAD','MUZAFFARNAGAR','PILIBHIT','PRATAPGARH','RAEBARELI','RAMPUR','SAHARANPUR','SAMBHAL (BHIM NAGAR)','SANT KABIR NAGAR','SHAHJAHANPUR','SHAMALI (PRABUDDH NAGAR)','SHRAVASTI','SIDDHARTH NAGAR','SITAPUR','SONBHADRA','SULTANPUR','UNNAO','VARANASI']],
        'WB'=>['name'=>'WEST BENGAL','districts'=>['ALIPURDUAR','BANKURA','BIRBHUM','COOCH BEHAR','DAKSHIN DINAJPUR (SOUTH DINAJPUR)','DARJEELING','HOOGHLY','HOWRAH','JALPAIGURI','JHARGRAM','KALIMPONG','KOLKATA','MALDA','MURSHIDABAD','NADIA','NORTH 24 PARGANAS','PASCHIM MEDINIPUR (WEST MEDINIPUR)','PASCHIM (WEST) BURDWAN (BARDHAMAN)','PURBA BURDWAN (BARDHAMAN)','PURBA MEDINIPUR (EAST MEDINIPUR)','PURULIA','SOUTH 24 PARGANAS','UTTAR DINAJPUR (NORTH DINAJPUR)']]
    ],

    // ===================================================================
    // Country Mobile Codes
    // ===================================================================
    "country_mobile_code-json" => [
        '44' => 'UK (+44)', '1' => 'USA (+1)', '213' => 'Algeria (+213)', '376' => 'Andorra (+376)', '244' => 'Angola (+244)',
        '1264' => 'Anguilla (+1264)', '1268' => 'Antigua & Barbuda (+1268)', '54' => 'Argentina (+54)', '374' => 'Armenia (+374)',
        '297' => 'Aruba (+297)', '61' => 'Australia (+61)', '43' => 'Austria (+43)', '994' => 'Azerbaijan (+994)',
        '1242' => 'Bahamas (+1242)', '973' => 'Bahrain (+973)', '880' => 'Bangladesh (+880)', '1246' => 'Barbados (+1246)',
        '375' => 'Belarus (+375)', '32' => 'Belgium (+32)', '501' => 'Belize (+501)', '229' => 'Benin (+229)',
        '1441' => 'Bermuda (+1441)', '975' => 'Bhutan (+975)', '591' => 'Bolivia (+591)', '387' => 'Bosnia Herzegovina (+387)',
        '267' => 'Botswana (+267)', '55' => 'Brazil (+55)', '673' => 'Brunei (+673)', '359' => 'Bulgaria (+359)',
        '226' => 'Burkina Faso (+226)', '257' => 'Burundi (+257)', '855' => 'Cambodia (+855)', '237' => 'Cameroon (+237)',
        '238' => 'Cape Verde Islands (+238)', '1345' => 'Cayman Islands (+1345)', '236' => 'Central African Republic (+236)',
        '56' => 'Chile (+56)', '86' => 'China (+86)', '57' => 'Colombia (+57)', '269' => 'Comoros (+269)',
        '242' => 'Congo (+242)', '682' => 'Cook Islands (+682)', '506' => 'Costa Rica (+506)', '385' => 'Croatia (+385)',
        '53' => 'Cuba (+53)', '90392' => 'Cyprus North (+90392)', '357' => 'Cyprus South (+357)', '42' => 'Czech Republic (+42)',
        '45' => 'Denmark (+45)', '253' => 'Djibouti (+253)', '1809' => 'Dominica (+1809)', '1809' => 'Dominican Republic (+1809)',
        '593' => 'Ecuador (+593)', '20' => 'Egypt (+20)', '503' => 'El Salvador (+503)', '240' => 'Equatorial Guinea (+240)',
        '291' => 'Eritrea (+291)', '372' => 'Estonia (+372)', '251' => 'Ethiopia (+251)', '500' => 'Falkland Islands (+500)',
        '298' => 'Faroe Islands (+298)', '679' => 'Fiji (+679)', '358' => 'Finland (+358)', '33' => 'France (+33)',
        '594' => 'French Guiana (+594)', '689' => 'French Polynesia (+689)', '241' => 'Gabon (+241)', '220' => 'Gambia (+220)',
        '7880' => 'Georgia (+7880)', '49' => 'Germany (+49)', '233' => 'Ghana (+233)', '350' => 'Gibraltar (+350)',
        '30' => 'Greece (+30)', '299' => 'Greenland (+299)', '1473' => 'Grenada (+1473)', '590' => 'Guadeloupe (+590)',
        '671' => 'Guam (+671)', '502' => 'Guatemala (+502)', '224' => 'Guinea (+224)', '245' => 'Guinea - Bissau (+245)',
        '592' => 'Guyana (+592)', '509' => 'Haiti (+509)', '504' => 'Honduras (+504)', '852' => 'Hong Kong (+852)',
        '36' => 'Hungary (+36)', '354' => 'Iceland (+354)', '91' => 'India (+91)', '62' => 'Indonesia (+62)',
        '98' => 'Iran (+98)', '964' => 'Iraq (+964)', '353' => 'Ireland (+353)', '972' => 'Israel (+972)',
        '39' => 'Italy (+39)', '1876' => 'Jamaica (+1876)', '81' => 'Japan (+81)', '962' => 'Jordan (+962)',
        '7' => 'Kazakhstan (+7)', '254' => 'Kenya (+254)', '686' => 'Kiribati (+686)', '850' => 'Korea North (+850)',
        '82' => 'Korea South (+82)', '965' => 'Kuwait (+965)', '996' => 'Kyrgyzstan (+996)', '856' => 'Laos (+856)',
        '371' => 'Latvia (+371)', '961' => 'Lebanon (+961)', '266' => 'Lesotho (+266)', '231' => 'Liberia (+231)',
        '218' => 'Libya (+218)', '417' => 'Liechtenstein (+417)', '370' => 'Lithuania (+370)', '352' => 'Luxembourg (+352)',
        '853' => 'Macao (+853)', '389' => 'Macedonia (+389)', '261' => 'Madagascar (+261)', '265' => 'Malawi (+265)',
        '60' => 'Malaysia (+60)', '960' => 'Maldives (+960)', '223' => 'Mali (+223)', '356' => 'Malta (+356)',
        '692' => 'Marshall Islands (+692)', '596' => 'Martinique (+596)', '222' => 'Mauritania (+222)', '269' => 'Mayotte (+269)',
        '52' => 'Mexico (+52)', '691' => 'Micronesia (+691)', '373' => 'Moldova (+373)', '377' => 'Monaco (+377)',
        '976' => 'Mongolia (+976)', '1664' => 'Montserrat (+1664)', '212' => 'Morocco (+212)', '258' => 'Mozambique (+258)',
        '95' => 'Myanmar (+95)', '264' => 'Namibia (+264)', '674' => 'Nauru (+674)', '977' => 'Nepal (+977)',
        '31' => 'Netherlands (+31)', '687' => 'New Caledonia (+687)', '64' => 'New Zealand (+64)', '505' => 'Nicaragua (+505)',
        '227' => 'Niger (+227)', '234' => 'Nigeria (+234)', '683' => 'Niue (+683)', '672' => 'Norfolk Islands (+672)',
        '670' => 'Northern Marianas (+670)', '47' => 'Norway (+47)', '968' => 'Oman (+968)', '680' => 'Palau (+680)',
        '507' => 'Panama (+507)', '675' => 'Papua New Guinea (+675)', '595' => 'Paraguay (+595)', '51' => 'Peru (+51)',
        '63' => 'Philippines (+63)', '48' => 'Poland (+48)', '351' => 'Portugal (+351)', '1787' => 'Puerto Rico (+1787)',
        '974' => 'Qatar (+974)', '262' => 'Reunion (+262)', '40' => 'Romania (+40)', '7' => 'Russia (+7)',
        '250' => 'Rwanda (+250)', '378' => 'San Marino (+378)', '239' => 'Sao Tome & Principe (+239)', '966' => 'Saudi Arabia (+966)',
        '221' => 'Senegal (+221)', '381' => 'Serbia (+381)', '248' => 'Seychelles (+248)', '232' => 'Sierra Leone (+232)',
        '65' => 'Singapore (+65)', '421' => 'Slovak Republic (+421)', '386' => 'Slovenia (+386)', '677' => 'Solomon Islands (+677)',
        '252' => 'Somalia (+252)', '27' => 'South Africa (+27)', '34' => 'Spain (+34)', '94' => 'Sri Lanka (+94)',
        '290' => 'St. Helena (+290)', '1869' => 'St. Kitts (+1869)', '1758' => 'St. Lucia (+1758)', '249' => 'Sudan (+249)',
        '597' => 'Suriname (+597)', '268' => 'Swaziland (+268)', '46' => 'Sweden (+46)', '41' => 'Switzerland (+41)',
        '963' => 'Syria (+963)', '886' => 'Taiwan (+886)', '7' => 'Tajikstan (+7)', '66' => 'Thailand (+66)',
        '228' => 'Togo (+228)', '676' => 'Tonga (+676)', '1868' => 'Trinidad & Tobago (+1868)', '216' => 'Tunisia (+216)',
        '90' => 'Turkey (+90)', '993' => 'Turkmenistan (+993)', '1649' => 'Turks & Caicos Islands (+1649)', '688' => 'Tuvalu (+688)',
        '256' => 'Uganda (+256)', '380' => 'Ukraine (+380)', '971' => 'United Arab Emirates (+971)', '598' => 'Uruguay (+598)',
        '678' => 'Vanuatu (+678)', '379' => 'Vatican City (+379)', '58' => 'Venezuela (+58)', '84' => 'Vietnam (+84)',
        '1284' => 'Virgin Islands - British (+1284)', '1340' => 'Virgin Islands - US (+1340)', '681' => 'Wallis & Futuna (+681)',
        '969' => 'Yemen (North)(+969)', '967' => 'Yemen (South)(+967)', '260' => 'Zambia (+260)', '263' => 'Zimbabwe (+263)'
    ],

    // ===================================================================
    // Miscellaneous
    // ===================================================================
    "blood_group-json"           => ["","A+","A-","B+","B-","AB+","AB-","O+","O-"],
    "month-list"                 => ["january"=>"January","february"=>"February","march"=>"March","april"=>"April","may"=>"May","june"=>"June","july"=>"July","august"=>"August","september"=>"September","october"=>"October","november"=>"November","december"=>"December"],
    "month-json"                 => ["01"=>"January","02"=>"February","03"=>"March","04"=>"April","05"=>"May","06"=>"June","07"=>"July","08"=>"August","09"=>"September","10"=>"October","11"=>"November","12"=>"December"],
    "weekday-list"               => ['sunday','monday','tuesday','wednesday','thursday','friday','saturday'],
    "date-list" => "month_day-list" => array_combine(range(1,31), array_map(fn($i)=>"{$i} d", range(1,31))),
    "hour-list"                  => array_combine(array_map(fn($i)=>str_pad($i,2,0,STR_PAD_LEFT), range(0,24)), array_map(fn($i)=>str_pad($i,2,0,STR_PAD_LEFT).' hr', range(0,24))),
    "minute-list"                => range(1,59),
    "bdayfilter-list"            => ["today"=>"BDAY TODAY","tomorrow"=>"BDAY TOMORROW","-7 days"=>"PAST 7 DAYS","+7 days"=>"NEXT 7 DAYS"],
    "report_display_type-json"   => ["tabled"=>"Tabled"],
    "status-json"                => ["1"=>"ACTIVE","2"=>"DELETED"],
    "yes_no-json"                => ['true'=>'Yes','false'=>'No'],
    "boolean-json"               => [true=>'Yes',false=>'No'],
    "year-json"                  => range(2000, 2049),

    // ===================================================================
    // Term Tags (Active terms only)
    // ===================================================================
    "term_tag-json" => (function () {
        $allTags = \Db::get(\v3\M\Term::$table, ['status' => 1]);
        return $allTags
            ? create_key_value_pair($allTags, 'term_name', 'term_name')
            : [];
    })(),

    // ===================================================================
    // Mandatory Options Before Using Any Module
    // ===================================================================
    "mandatoryOptionsBeforeUsing-module" => [
        'missing_option' => [
            'Current Session' => ['current_session', ['data-key' => 'session-json']],
            'Session Span'     => ['session_span', ['class' => 'jqdate-range']]
        ]
    ],

    // ===================================================================
    // Default Columns - User Module
    // ===================================================================
    "defaultColumns-user" => [
        'entry'         => ['user_id', 'username', 'email_id', 'phone_number', 'auth_level', 'privileges', 'tags', 'status'],
        'list'          => ['user_id', 'username', 'email_id', 'phone_number', 'auth_level', 'privileges', 'tags', 'status'],
        'detail'        => ['user_id', 'username', 'email_id', 'phone_number', 'auth_level', 'privileges', 'tags', 'status'],
        'report'        => ['user_id', 'username', 'email_id', 'phone_number', 'auth_level', 'privileges', 'tags', 'status'],
        'sample_export' => ['sno', 'username', 'email_id', 'phone_number', 'auth_level', 'privileges', 'status'],
        'selected_columns' => ['username', 'email_id', 'phone_number', 'auth_level', 'privileges', 'status']
    ],

    // ===================================================================
    // Admin Permissions - User Module
    // ===================================================================
    "permissionAdmin-user" => (function () {
        $pg = \v3\C\User::$pg;
        return [
            'restricted' => [
                '2' => [
                    ['pg' => $pg, 'sub_pg' => 'entry'],
                    ['pg' => $pg, 'sub_pg' => 'list'],
                ],
                '3' => [
                    ['pg' => $pg, 'sub_pg' => 'entry'],
                    ['pg' => $pg, 'sub_pg' => 'list']
                ]
            ]
        ];
    })(),

    // ===================================================================
    // Admin Permissions - Permission Module
    // ===================================================================
    "permissionAdmin-permission" => (function () {
        $pg = \v3\C\Permission::$pg;
        return [
            'restricted' => [
                '2' => [
                    ['pg' => $pg, 'sub_pg' => 'entry']
                ],
                '3' => [
                    ['pg' => $pg, 'sub_pg' => 'entry']
                ]
            ]
        ];
    })(),

    // ===================================================================
    // Column Name Mapping - Term & Generic Module
    // ===================================================================
    "columnNameMapping-module" =>
    "columnNameMapping-terms" => [
        'ptr'       => 'SNo',
        'term_id'   => 'ID',
        'term_name' => 'Name',
    ],

    // ===================================================================
    // Default Columns - Term Module
    // ===================================================================
    "defaultColumns-terms" => [
        'entry'         => ['term_id', 'term_name', 'type', 'tags'],
        'list'          => ['term_id', 'term_name', 'type', 'tags'],
        'detail'        => ['term_id', 'term_name', 'type', 'tags'],
        'report'        => ['term_id', 'term_name', 'type', 'tags'],
        'sample_export' => ['term_name', 'type', 'status'],
        'selected_columns' => ['date', 'term_name', 'type']
    ],

    // ===================================================================
    // Term Bulk Operations
    // ===================================================================
    "term_bulk_operation-list" => [
        "op:remove"  => "Delete",
        "op:restore" => "Restore"
    ]

];