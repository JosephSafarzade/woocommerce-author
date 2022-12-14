<?php

/**
 * wooa_core class.
 *
 * This class is created to have some core functionality which will be used across our plugin
 *
 * @package wooa_core
 * @version 1.0
 *
 */
class wooa_core
{


	/**
	 *
	 * Setup author data as global $post variable to be accessed later by other functions
	 *
	 * @param int $author_id
	 *
	 * @return void
	 *
	 *
	 */
    function setup_initial_post_data(int $author_id) : void {

        status_header(200);

        global $post;

        $post = get_post( $author_id, OBJECT );

        setup_postdata( $post );

    }



    function load_author_template_file() : void {

        $template_path = locate_template('single-woocommerce-author.php') != '' ? locate_template('single-woocommerce-author.php') :  WOOA_PLUGIN_TEMPLATE_DIR . DIRECTORY_SEPARATOR . 'single-woocommerce-author.php' ;

        require_once ( $template_path );

        exit ;

    }


	/**
	 *
	 * Check if author exist by have a query in database by using author name
	 *
	 * @param string $author_name name of author we are searching for
	 *
	 * @return int number of founded authors
	 *
	 *
	 */
    function check_if_author_exist( string $author_name ) : int {

		if(strpos($author_name,"-") > 0 ){

			$author_name =str_replace("-"," " , $author_name );

		}

        $args = array(
            'post_type'  => 'woocommerce-author',
            'fields' => 'ids',
            'meta_query' => array(
                array(
                    'key'     => 'wooa_author_username',
                    'value'   => array( $author_name ),
                    'compare' => 'IN',
                ),
            ),
        );


        $posts = get_posts( $args );

        return empty( $posts ) ? 0 : $posts[0] ;

    }


	/**
	 *
	 * Get current page full URL
	 *
	 * @return string
	 */
    function get_full_url() : string {

        return   (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]" ;

    }


    function check_for_right_url_structure(string $url) : bool {

        if ( '' == $url ){

            return false;

        }

        $url = rtrim ($url , "/" );

        $site_url = rtrim ( site_url() , "/" );

        $base_url = basename($url);

        $result = rtrim ( str_replace( $base_url , '' , $url ) , "/" );

        return  $site_url == $result ;

    }


	/**
	 *
	 * Return list of authors for admin panel
	 *
	 * In our admin panel we need to have a list of authors to be shown in select input so users can choose between
	 * them , this function will run a query through database and return the value.
	 *
	 * @return array
	 *
	 */
    static function return_all_authors_for_admin_panel_input():array {

        $authors = array(
            '0' => __('No Author',WOOA_TEXT_DOMAIN )
        );

        $args = array(
            'post_type' => 'woocommerce-author',
            'posts_per_page' => -1
        );

        $authors_list = get_posts($args);

        foreach ($authors_list as $author){

            $authors[$author->ID] = $author->post_title;

        }

        return $authors;
    }












    function return_author_country_name($author_id){

        global $post;

        $author_id = $author_id == '0' || $author_id == '' ? get_post_meta ( $post->ID , 'wooa_product_author_id' , true ) : $author_id;

        $country_shortname = get_post_meta($author_id , 'wooa_author_country' , true );

        $country_fullname = ucfirst( strtolower ( apply_filters('wooa_return_country_full_name',$country_shortname) ) );

        return esc_attr( $country_fullname );

    }



    function return_author_city_name($author_id){

        global $post;

        $author_id = $author_id == '0' || $author_id == '' ? get_post_meta ( $post->ID , 'wooa_product_author_id' , true ) : $author_id;

        return esc_attr( get_post_meta($author_id , 'wooa_author_city' , true ) );

    }




    function show_author_country_flag($author_id){

        global $post;

        $author_id = $author_id == '0' || $author_id == '' ? get_post_meta ( $post->ID , 'wooa_product_author_id' , true ) : $author_id;

        $country_code =  get_post_meta($author_id , 'wooa_author_country' , true );

        $country_flag = 'https://countryflagsapi.com/png/' . $country_code ;

        return sprintf ("<div class='woo-author-flag-container'>
                                    <img src='%s' >
                                </div>" , $country_flag );

    }








    static function return_all_country_names_for_admin_panel_input(){

        return  array(
            "AF" => "Afghanistan",
            "AX" => "Aland Islands",
            "AL" => "Albania",
            "DZ" => "Algeria",
            "AS" => "American Samoa",
            "AD" => "Andorra",
            "AO" => "Angola",
            "AI" => "Anguilla",
            "AQ" => "Antarctica",
            "AG" => "Antigua and Barbuda",
            "AR" => "Argentina",
            "AM" => "Armenia",
            "AW" => "Aruba",
            "AU" => "Australia",
            "AT" => "Austria",
            "AZ" => "Azerbaijan",
            "BS" => "Bahamas",
            "BH" => "Bahrain",
            "BD" => "Bangladesh",
            "BB" => "Barbados",
            "BY" => "Belarus",
            "BE" => "Belgium",
            "BZ" => "Belize",
            "BJ" => "Benin",
            "BM" => "Bermuda",
            "BT" => "Bhutan",
            "BO" => "Bolivia",
            "BQ" => "Bonaire, Sint Eustatius and Saba",
            "BA" => "Bosnia and Herzegovina",
            "BW" => "Botswana",
            "BV" => "Bouvet Island",
            "BR" => "Brazil",
            "IO" => "British Indian Ocean Territory",
            "BN" => "Brunei Darussalam",
            "BG" => "Bulgaria",
            "BF" => "Burkina Faso",
            "BI" => "Burundi",
            "KH" => "Cambodia",
            "CM" => "Cameroon",
            "CA" => "Canada",
            "CV" => "Cape Verde",
            "KY" => "Cayman Islands",
            "CF" => "Central African Republic",
            "TD" => "Chad",
            "CL" => "Chile",
            "CN" => "China",
            "CX" => "Christmas Island",
            "CC" => "Cocos (Keeling) Islands",
            "CO" => "Colombia",
            "KM" => "Comoros",
            "CG" => "Congo",
            "CD" => "Congo, the Democratic Republic of the",
            "CK" => "Cook Islands",
            "CR" => "Costa Rica",
            "CI" => "Cote D'Ivoire",
            "HR" => "Croatia",
            "CU" => "Cuba",
            "CW" => "Curacao",
            "CY" => "Cyprus",
            "CZ" => "Czech Republic",
            "DK" => "Denmark",
            "DJ" => "Djibouti",
            "DM" => "Dominica",
            "DO" => "Dominican Republic",
            "EC" => "Ecuador",
            "EG" => "Egypt",
            "SV" => "El Salvador",
            "GQ" => "Equatorial Guinea",
            "ER" => "Eritrea",
            "EE" => "Estonia",
            "ET" => "Ethiopia",
            "FK" => "Falkland Islands (Malvinas)",
            "FO" => "Faroe Islands",
            "FJ" => "Fiji",
            "FI" => "Finland",
            "FR" => "France",
            "GF" => "French Guiana",
            "PF" => "French Polynesia",
            "TF" => "French Southern Territories",
            "GA" => "Gabon",
            "GM" => "Gambia",
            "GE" => "Georgia",
            "DE" => "Germany",
            "GH" => "Ghana",
            "GI" => "Gibraltar",
            "GR" => "Greece",
            "GL" => "Greenland",
            "GD" => "Grenada",
            "GP" => "Guadeloupe",
            "GU" => "Guam",
            "GT" => "Guatemala",
            "GG" => "Guernsey",
            "GN" => "Guinea",
            "GW" => "Guinea-Bissau",
            "GY" => "Guyana",
            "HT" => "Haiti",
            "HM" => "Heard Island and Mcdonald Islands",
            "VA" => "Holy See (Vatican City State)",
            "HN" => "Honduras",
            "HK" => "Hong Kong",
            "HU" => "Hungary",
            "IS" => "Iceland",
            "IN" => "India",
            "ID" => "Indonesia",
            "IR" => "Iran, Islamic Republic of",
            "IQ" => "Iraq",
            "IE" => "Ireland",
            "IM" => "Isle of Man",
            "IL" => "Israel",
            "IT" => "Italy",
            "JM" => "Jamaica",
            "JP" => "Japan",
            "JE" => "Jersey",
            "JO" => "Jordan",
            "KZ" => "Kazakhstan",
            "KE" => "Kenya",
            "KI" => "Kiribati",
            "KP" => "Korea, Democratic People's Republic of",
            "KR" => "Korea, Republic of",
            "XK" => "Kosovo",
            "KW" => "Kuwait",
            "KG" => "Kyrgyzstan",
            "LA" => "Lao People's Democratic Republic",
            "LV" => "Latvia",
            "LB" => "Lebanon",
            "LS" => "Lesotho",
            "LR" => "Liberia",
            "LY" => "Libyan Arab Jamahiriya",
            "LI" => "Liechtenstein",
            "LT" => "Lithuania",
            "LU" => "Luxembourg",
            "MO" => "Macao",
            "MK" => "Macedonia, the Former Yugoslav Republic of",
            "MG" => "Madagascar",
            "MW" => "Malawi",
            "MY" => "Malaysia",
            "MV" => "Maldives",
            "ML" => "Mali",
            "MT" => "Malta",
            "MH" => "Marshall Islands",
            "MQ" => "Martinique",
            "MR" => "Mauritania",
            "MU" => "Mauritius",
            "YT" => "Mayotte",
            "MX" => "Mexico",
            "FM" => "Micronesia, Federated States of",
            "MD" => "Moldova, Republic of",
            "MC" => "Monaco",
            "MN" => "Mongolia",
            "ME" => "Montenegro",
            "MS" => "Montserrat",
            "MA" => "Morocco",
            "MZ" => "Mozambique",
            "MM" => "Myanmar",
            "NA" => "Namibia",
            "NR" => "Nauru",
            "NP" => "Nepal",
            "NL" => "Netherlands",
            "AN" => "Netherlands Antilles",
            "NC" => "New Caledonia",
            "NZ" => "New Zealand",
            "NI" => "Nicaragua",
            "NE" => "Niger",
            "NG" => "Nigeria",
            "NU" => "Niue",
            "NF" => "Norfolk Island",
            "MP" => "Northern Mariana Islands",
            "NO" => "Norway",
            "OM" => "Oman",
            "PK" => "Pakistan",
            "PW" => "Palau",
            "PS" => "Palestinian Territory, Occupied",
            "PA" => "Panama",
            "PG" => "Papua New Guinea",
            "PY" => "Paraguay",
            "PE" => "Peru",
            "PH" => "Philippines",
            "PN" => "Pitcairn",
            "PL" => "Poland",
            "PT" => "Portugal",
            "PR" => "Puerto Rico",
            "QA" => "Qatar",
            "RE" => "Reunion",
            "RO" => "Romania",
            "RU" => "Russian Federation",
            "RW" => "Rwanda",
            "BL" => "Saint Barthelemy",
            "SH" => "Saint Helena",
            "KN" => "Saint Kitts and Nevis",
            "LC" => "Saint Lucia",
            "MF" => "Saint Martin",
            "PM" => "Saint Pierre and Miquelon",
            "VC" => "Saint Vincent and the Grenadines",
            "WS" => "Samoa",
            "SM" => "San Marino",
            "ST" => "Sao Tome and Principe",
            "SA" => "Saudi Arabia",
            "SN" => "Senegal",
            "RS" => "Serbia",
            "CS" => "Serbia and Montenegro",
            "SC" => "Seychelles",
            "SL" => "Sierra Leone",
            "SG" => "Singapore",
            "SX" => "Sint Maarten",
            "SK" => "Slovakia",
            "SI" => "Slovenia",
            "SB" => "Solomon Islands",
            "SO" => "Somalia",
            "ZA" => "South Africa",
            "GS" => "South Georgia and the South Sandwich Islands",
            "SS" => "South Sudan",
            "ES" => "Spain",
            "LK" => "Sri Lanka",
            "SD" => "Sudan",
            "SR" => "Suriname",
            "SJ" => "Svalbard and Jan Mayen",
            "SZ" => "Swaziland",
            "SE" => "Sweden",
            "CH" => "Switzerland",
            "SY" => "Syrian Arab Republic",
            "TW" => "Taiwan, Province of China",
            "TJ" => "Tajikistan",
            "TZ" => "Tanzania, United Republic of",
            "TH" => "Thailand",
            "TL" => "Timor-Leste",
            "TG" => "Togo",
            "TK" => "Tokelau",
            "TO" => "Tonga",
            "TT" => "Trinidad and Tobago",
            "TN" => "Tunisia",
            "TR" => "Turkey",
            "TM" => "Turkmenistan",
            "TC" => "Turks and Caicos Islands",
            "TV" => "Tuvalu",
            "UG" => "Uganda",
            "UA" => "Ukraine",
            "AE" => "United Arab Emirates",
            "GB" => "United Kingdom",
            "US" => "United States",
            "UM" => "United States Minor Outlying Islands",
            "UY" => "Uruguay",
            "UZ" => "Uzbekistan",
            "VU" => "Vanuatu",
            "VE" => "Venezuela",
            "VN" => "Viet Nam",
            "VG" => "Virgin Islands, British",
            "VI" => "Virgin Islands, U.s.",
            "WF" => "Wallis and Futuna",
            "EH" => "Western Sahara",
            "YE" => "Yemen",
            "ZM" => "Zambia",
            "ZW" => "Zimbabwe"
        );


    }







    function return_country_full_name($country_slang) {

        $countries = array(
            "AF" => array("AFGHANISTAN", "AF", "AFG", "004"),
            "AL" => array("ALBANIA", "AL", "ALB", "008"),
            "DZ" => array("ALGERIA", "DZ", "DZA", "012"),
            "AS" => array("AMERICAN SAMOA", "AS", "ASM", "016"),
            "AD" => array("ANDORRA", "AD", "AND", "020"),
            "AO" => array("ANGOLA", "AO", "AGO", "024"),
            "AI" => array("ANGUILLA", "AI", "AIA", "660"),
            "AQ" => array("ANTARCTICA", "AQ", "ATA", "010"),
            "AG" => array("ANTIGUA AND BARBUDA", "AG", "ATG", "028"),
            "AR" => array("ARGENTINA", "AR", "ARG", "032"),
            "AM" => array("ARMENIA", "AM", "ARM", "051"),
            "AW" => array("ARUBA", "AW", "ABW", "533"),
            "AU" => array("AUSTRALIA", "AU", "AUS", "036"),
            "AT" => array("AUSTRIA", "AT", "AUT", "040"),
            "AZ" => array("AZERBAIJAN", "AZ", "AZE", "031"),
            "BS" => array("BAHAMAS", "BS", "BHS", "044"),
            "BH" => array("BAHRAIN", "BH", "BHR", "048"),
            "BD" => array("BANGLADESH", "BD", "BGD", "050"),
            "BB" => array("BARBADOS", "BB", "BRB", "052"),
            "BY" => array("BELARUS", "BY", "BLR", "112"),
            "BE" => array("BELGIUM", "BE", "BEL", "056"),
            "BZ" => array("BELIZE", "BZ", "BLZ", "084"),
            "BJ" => array("BENIN", "BJ", "BEN", "204"),
            "BM" => array("BERMUDA", "BM", "BMU", "060"),
            "BT" => array("BHUTAN", "BT", "BTN", "064"),
            "BO" => array("BOLIVIA", "BO", "BOL", "068"),
            "BA" => array("BOSNIA AND HERZEGOVINA", "BA", "BIH", "070"),
            "BW" => array("BOTSWANA", "BW", "BWA", "072"),
            "BV" => array("BOUVET ISLAND", "BV", "BVT", "074"),
            "BR" => array("BRAZIL", "BR", "BRA", "076"),
            "IO" => array("BRITISH INDIAN OCEAN TERRITORY", "IO", "IOT", "086"),
            "BN" => array("BRUNEI DARUSSALAM", "BN", "BRN", "096"),
            "BG" => array("BULGARIA", "BG", "BGR", "100"),
            "BF" => array("BURKINA FASO", "BF", "BFA", "854"),
            "BI" => array("BURUNDI", "BI", "BDI", "108"),
            "KH" => array("CAMBODIA", "KH", "KHM", "116"),
            "CM" => array("CAMEROON", "CM", "CMR", "120"),
            "CA" => array("CANADA", "CA", "CAN", "124"),
            "CV" => array("CAPE VERDE", "CV", "CPV", "132"),
            "KY" => array("CAYMAN ISLANDS", "KY", "CYM", "136"),
            "CF" => array("CENTRAL AFRICAN REPUBLIC", "CF", "CAF", "140"),
            "TD" => array("CHAD", "TD", "TCD", "148"),
            "CL" => array("CHILE", "CL", "CHL", "152"),
            "CN" => array("CHINA", "CN", "CHN", "156"),
            "CX" => array("CHRISTMAS ISLAND", "CX", "CXR", "162"),
            "CC" => array("COCOS (KEELING) ISLANDS", "CC", "CCK", "166"),
            "CO" => array("COLOMBIA", "CO", "COL", "170"),
            "KM" => array("COMOROS", "KM", "COM", "174"),
            "CG" => array("CONGO", "CG", "COG", "178"),
            "CK" => array("COOK ISLANDS", "CK", "COK", "184"),
            "CR" => array("COSTA RICA", "CR", "CRI", "188"),
            "CI" => array("COTE D'IVOIRE", "CI", "CIV", "384"),
            "HR" => array("CROATIA (local name: Hrvatska)", "HR", "HRV", "191"),
            "CU" => array("CUBA", "CU", "CUB", "192"),
            "CY" => array("CYPRUS", "CY", "CYP", "196"),
            "CZ" => array("CZECH REPUBLIC", "CZ", "CZE", "203"),
            "DK" => array("DENMARK", "DK", "DNK", "208"),
            "DJ" => array("DJIBOUTI", "DJ", "DJI", "262"),
            "DM" => array("DOMINICA", "DM", "DMA", "212"),
            "DO" => array("DOMINICAN REPUBLIC", "DO", "DOM", "214"),
            "TL" => array("EAST TIMOR", "TL", "TLS", "626"),
            "EC" => array("ECUADOR", "EC", "ECU", "218"),
            "EG" => array("EGYPT", "EG", "EGY", "818"),
            "SV" => array("EL SALVADOR", "SV", "SLV", "222"),
            "GQ" => array("EQUATORIAL GUINEA", "GQ", "GNQ", "226"),
            "ER" => array("ERITREA", "ER", "ERI", "232"),
            "EE" => array("ESTONIA", "EE", "EST", "233"),
            "ET" => array("ETHIOPIA", "ET", "ETH", "210"),
            "FK" => array("FALKLAND ISLANDS (MALVINAS)", "FK", "FLK", "238"),
            "FO" => array("FAROE ISLANDS", "FO", "FRO", "234"),
            "FJ" => array("FIJI", "FJ", "FJI", "242"),
            "FI" => array("FINLAND", "FI", "FIN", "246"),
            "FR" => array("FRANCE", "FR", "FRA", "250"),
            "FX" => array("FRANCE, METROPOLITAN", "FX", "FXX", "249"),
            "GF" => array("FRENCH GUIANA", "GF", "GUF", "254"),
            "PF" => array("FRENCH POLYNESIA", "PF", "PYF", "258"),
            "TF" => array("FRENCH SOUTHERN TERRITORIES", "TF", "ATF", "260"),
            "GA" => array("GABON", "GA", "GAB", "266"),
            "GM" => array("GAMBIA", "GM", "GMB", "270"),
            "GE" => array("GEORGIA", "GE", "GEO", "268"),
            "DE" => array("GERMANY", "DE", "DEU", "276"),
            "GH" => array("GHANA", "GH", "GHA", "288"),
            "GI" => array("GIBRALTAR", "GI", "GIB", "292"),
            "GR" => array("GREECE", "GR", "GRC", "300"),
            "GL" => array("GREENLAND", "GL", "GRL", "304"),
            "GD" => array("GRENADA", "GD", "GRD", "308"),
            "GP" => array("GUADELOUPE", "GP", "GLP", "312"),
            "GU" => array("GUAM", "GU", "GUM", "316"),
            "GT" => array("GUATEMALA", "GT", "GTM", "320"),
            "GN" => array("GUINEA", "GN", "GIN", "324"),
            "GW" => array("GUINEA-BISSAU", "GW", "GNB", "624"),
            "GY" => array("GUYANA", "GY", "GUY", "328"),
            "HT" => array("HAITI", "HT", "HTI", "332"),
            "HM" => array("HEARD ISLAND & MCDONALD ISLANDS", "HM", "HMD", "334"),
            "HN" => array("HONDURAS", "HN", "HND", "340"),
            "HK" => array("HONG KONG", "HK", "HKG", "344"),
            "HU" => array("HUNGARY", "HU", "HUN", "348"),
            "IS" => array("ICELAND", "IS", "ISL", "352"),
            "IN" => array("INDIA", "IN", "IND", "356"),
            "ID" => array("INDONESIA", "ID", "IDN", "360"),
            "IR" => array("IRAN, ISLAMIC REPUBLIC OF", "IR", "IRN", "364"),
            "IQ" => array("IRAQ", "IQ", "IRQ", "368"),
            "IE" => array("IRELAND", "IE", "IRL", "372"),
            "IL" => array("ISRAEL", "IL", "ISR", "376"),
            "IT" => array("ITALY", "IT", "ITA", "380"),
            "JM" => array("JAMAICA", "JM", "JAM", "388"),
            "JP" => array("JAPAN", "JP", "JPN", "392"),
            "JO" => array("JORDAN", "JO", "JOR", "400"),
            "KZ" => array("KAZAKHSTAN", "KZ", "KAZ", "398"),
            "KE" => array("KENYA", "KE", "KEN", "404"),
            "KI" => array("KIRIBATI", "KI", "KIR", "296"),
            "KP" => array("KOREA, DEMOCRATIC PEOPLE'S REPUBLIC OF", "KP", "PRK", "408"),
            "KR" => array("KOREA, REPUBLIC OF", "KR", "KOR", "410"),
            "KW" => array("KUWAIT", "KW", "KWT", "414"),
            "KG" => array("KYRGYZSTAN", "KG", "KGZ", "417"),
            "LA" => array("LAO PEOPLE'S DEMOCRATIC REPUBLIC", "LA", "LAO", "418"),
            "LV" => array("LATVIA", "LV", "LVA", "428"),
            "LB" => array("LEBANON", "LB", "LBN", "422"),
            "LS" => array("LESOTHO", "LS", "LSO", "426"),
            "LR" => array("LIBERIA", "LR", "LBR", "430"),
            "LY" => array("LIBYAN ARAB JAMAHIRIYA", "LY", "LBY", "434"),
            "LI" => array("LIECHTENSTEIN", "LI", "LIE", "438"),
            "LT" => array("LITHUANIA", "LT", "LTU", "440"),
            "LU" => array("LUXEMBOURG", "LU", "LUX", "442"),
            "MO" => array("MACAU", "MO", "MAC", "446"),
            "MK" => array("MACEDONIA, THE FORMER YUGOSLAV REPUBLIC OF", "MK", "MKD", "807"),
            "MG" => array("MADAGASCAR", "MG", "MDG", "450"),
            "MW" => array("MALAWI", "MW", "MWI", "454"),
            "MY" => array("MALAYSIA", "MY", "MYS", "458"),
            "MV" => array("MALDIVES", "MV", "MDV", "462"),
            "ML" => array("MALI", "ML", "MLI", "466"),
            "MT" => array("MALTA", "MT", "MLT", "470"),
            "MH" => array("MARSHALL ISLANDS", "MH", "MHL", "584"),
            "MQ" => array("MARTINIQUE", "MQ", "MTQ", "474"),
            "MR" => array("MAURITANIA", "MR", "MRT", "478"),
            "MU" => array("MAURITIUS", "MU", "MUS", "480"),
            "YT" => array("MAYOTTE", "YT", "MYT", "175"),
            "MX" => array("MEXICO", "MX", "MEX", "484"),
            "FM" => array("MICRONESIA, FEDERATED STATES OF", "FM", "FSM", "583"),
            "MD" => array("MOLDOVA, REPUBLIC OF", "MD", "MDA", "498"),
            "MC" => array("MONACO", "MC", "MCO", "492"),
            "MN" => array("MONGOLIA", "MN", "MNG", "496"),
            "MS" => array("MONTSERRAT", "MS", "MSR", "500"),
            "MA" => array("MOROCCO", "MA", "MAR", "504"),
            "MZ" => array("MOZAMBIQUE", "MZ", "MOZ", "508"),
            "MM" => array("MYANMAR", "MM", "MMR", "104"),
            "NA" => array("NAMIBIA", "NA", "NAM", "516"),
            "NR" => array("NAURU", "NR", "NRU", "520"),
            "NP" => array("NEPAL", "NP", "NPL", "524"),
            "NL" => array("NETHERLANDS", "NL", "NLD", "528"),
            "AN" => array("NETHERLANDS ANTILLES", "AN", "ANT", "530"),
            "NC" => array("NEW CALEDONIA", "NC", "NCL", "540"),
            "NZ" => array("NEW ZEALAND", "NZ", "NZL", "554"),
            "NI" => array("NICARAGUA", "NI", "NIC", "558"),
            "NE" => array("NIGER", "NE", "NER", "562"),
            "NG" => array("NIGERIA", "NG", "NGA", "566"),
            "NU" => array("NIUE", "NU", "NIU", "570"),
            "NF" => array("NORFOLK ISLAND", "NF", "NFK", "574"),
            "MP" => array("NORTHERN MARIANA ISLANDS", "MP", "MNP", "580"),
            "NO" => array("NORWAY", "NO", "NOR", "578"),
            "OM" => array("OMAN", "OM", "OMN", "512"),
            "PK" => array("PAKISTAN", "PK", "PAK", "586"),
            "PW" => array("PALAU", "PW", "PLW", "585"),
            "PA" => array("PANAMA", "PA", "PAN", "591"),
            "PG" => array("PAPUA NEW GUINEA", "PG", "PNG", "598"),
            "PY" => array("PARAGUAY", "PY", "PRY", "600"),
            "PE" => array("PERU", "PE", "PER", "604"),
            "PH" => array("PHILIPPINES", "PH", "PHL", "608"),
            "PN" => array("PITCAIRN", "PN", "PCN", "612"),
            "PL" => array("POLAND", "PL", "POL", "616"),
            "PT" => array("PORTUGAL", "PT", "PRT", "620"),
            "PR" => array("PUERTO RICO", "PR", "PRI", "630"),
            "QA" => array("QATAR", "QA", "QAT", "634"),
            "RE" => array("REUNION", "RE", "REU", "638"),
            "RO" => array("ROMANIA", "RO", "ROU", "642"),
            "RU" => array("RUSSIAN FEDERATION", "RU", "RUS", "643"),
            "RW" => array("RWANDA", "RW", "RWA", "646"),
            "KN" => array("SAINT KITTS AND NEVIS", "KN", "KNA", "659"),
            "LC" => array("SAINT LUCIA", "LC", "LCA", "662"),
            "VC" => array("SAINT VINCENT AND THE GRENADINES", "VC", "VCT", "670"),
            "WS" => array("SAMOA", "WS", "WSM", "882"),
            "SM" => array("SAN MARINO", "SM", "SMR", "674"),
            "ST" => array("SAO TOME AND PRINCIPE", "ST", "STP", "678"),
            "SA" => array("SAUDI ARABIA", "SA", "SAU", "682"),
            "SN" => array("SENEGAL", "SN", "SEN", "686"),
            "RS" => array("SERBIA", "RS", "SRB", "688"),
            "SC" => array("SEYCHELLES", "SC", "SYC", "690"),
            "SL" => array("SIERRA LEONE", "SL", "SLE", "694"),
            "SG" => array("SINGAPORE", "SG", "SGP", "702"),
            "SK" => array("SLOVAKIA (Slovak Republic)", "SK", "SVK", "703"),
            "SI" => array("SLOVENIA", "SI", "SVN", "705"),
            "SB" => array("SOLOMON ISLANDS", "SB", "SLB", "90"),
            "SO" => array("SOMALIA", "SO", "SOM", "706"),
            "ZA" => array("SOUTH AFRICA", "ZA", "ZAF", "710"),
            "ES" => array("SPAIN", "ES", "ESP", "724"),
            "LK" => array("SRI LANKA", "LK", "LKA", "144"),
            "SH" => array("SAINT HELENA", "SH", "SHN", "654"),
            "PM" => array("SAINT PIERRE AND MIQUELON", "PM", "SPM", "666"),
            "SD" => array("SUDAN", "SD", "SDN", "736"),
            "SR" => array("SURINAME", "SR", "SUR", "740"),
            "SJ" => array("SVALBARD AND JAN MAYEN ISLANDS", "SJ", "SJM", "744"),
            "SZ" => array("SWAZILAND", "SZ", "SWZ", "748"),
            "SE" => array("SWEDEN", "SE", "SWE", "752"),
            "CH" => array("SWITZERLAND", "CH", "CHE", "756"),
            "SY" => array("SYRIAN ARAB REPUBLIC", "SY", "SYR", "760"),
            "TW" => array("TAIWAN, PROVINCE OF CHINA", "TW", "TWN", "158"),
            "TJ" => array("TAJIKISTAN", "TJ", "TJK", "762"),
            "TZ" => array("TANZANIA, UNITED REPUBLIC OF", "TZ", "TZA", "834"),
            "TH" => array("THAILAND", "TH", "THA", "764"),
            "TG" => array("TOGO", "TG", "TGO", "768"),
            "TK" => array("TOKELAU", "TK", "TKL", "772"),
            "TO" => array("TONGA", "TO", "TON", "776"),
            "TT" => array("TRINIDAD AND TOBAGO", "TT", "TTO", "780"),
            "TN" => array("TUNISIA", "TN", "TUN", "788"),
            "TR" => array("TURKEY", "TR", "TUR", "792"),
            "TM" => array("TURKMENISTAN", "TM", "TKM", "795"),
            "TC" => array("TURKS AND CAICOS ISLANDS", "TC", "TCA", "796"),
            "TV" => array("TUVALU", "TV", "TUV", "798"),
            "UG" => array("UGANDA", "UG", "UGA", "800"),
            "UA" => array("UKRAINE", "UA", "UKR", "804"),
            "AE" => array("UNITED ARAB EMIRATES", "AE", "ARE", "784"),
            "GB" => array("UNITED KINGDOM", "GB", "GBR", "826"),
            "US" => array("UNITED STATES", "US", "USA", "840"),
            "UM" => array("UNITED STATES MINOR OUTLYING ISLANDS", "UM", "UMI", "581"),
            "UY" => array("URUGUAY", "UY", "URY", "858"),
            "UZ" => array("UZBEKISTAN", "UZ", "UZB", "860"),
            "VU" => array("VANUATU", "VU", "VUT", "548"),
            "VA" => array("VATICAN CITY STATE (HOLY SEE)", "VA", "VAT", "336"),
            "VE" => array("VENEZUELA", "VE", "VEN", "862"),
            "VN" => array("VIET NAM", "VN", "VNM", "704"),
            "VG" => array("VIRGIN ISLANDS (BRITISH)", "VG", "VGB", "92"),
            "VI" => array("VIRGIN ISLANDS (U.S.)", "VI", "VIR", "850"),
            "WF" => array("WALLIS AND FUTUNA ISLANDS", "WF", "WLF", "876"),
            "EH" => array("WESTERN SAHARA", "EH", "ESH", "732"),
            "YE" => array("YEMEN", "YE", "YEM", "887"),
            "YU" => array("YUGOSLAVIA", "YU", "YUG", "891"),
            "ZR" => array("ZAIRE", "ZR", "ZAR", "180"),
            "ZM" => array("ZAMBIA", "ZM", "ZMB", "894"),
            "ZW" => array("ZIMBABWE", "ZW", "ZWE", "716"),
        );


        return $countries[$country_slang][0];
        
        
        
    }




    function return_author_social_url($author_id,$social_name){


        global $post;

        if ($post->post_type == 'woocommerce-author'){

            $author_id = $post->ID;

        } else {

            $author_id = $author_id == '0' || $author_id == '' ? get_post_meta ( $post->ID , 'wooa_product_author_id' , true ) : $author_id;

        }


        return esc_url( get_post_meta($author_id , 'wooa_author_'.$social_name."_url" , true) );

    }



    function return_author_poster_url($author_id){

        global $post;

        if ($post->post_type == 'woocommerce-author'){

            $author_id = $post->ID;

        } else {

            $author_id = $author_id == '0' || $author_id == '' ? get_post_meta ( $post->ID , 'wooa_product_author_id' , true ) : $author_id;

        }

        $poster_id = get_post_meta($author_id , 'wooa_author_poster' , true );

        return esc_url( $poster_id != '' ? wp_get_attachment_url($poster_id) : '' );

    }





    function return_author_name_by_id($author_id)  {

        $author_name = get_post_meta($author_id , 'wooa_author_name' , true );

        return  $author_name != '' && $author_name != false ?  esc_attr( $author_name ) : false ;

    }


    function return_author_username_by_id($author_id){

        $author_username = get_post_meta($author_id , 'wooa_author_username' , true );

        return  $author_username != '' && $author_username != false ?  esc_attr( $author_username ) : false ;


    }



    function return_author_profession_by_id($author_id){

        $author_profession = get_post_meta($author_id , 'wooa_author_profession' , true );

        return  $author_profession != '' && $author_profession != false ?  esc_attr( $author_profession ) : false ;

    }




    function return_author_description_by_id($author_id){

        $author_description = get_post_meta($author_id , 'wooa_author_description' , true );

        return  $author_description != '' && $author_description != false ?  esc_attr( $author_description ) : false ;

    }



    function return_author_email_by_id($author_id){

        $author_email_address = get_post_meta($author_id , 'wooa_author_email_address' , true );

        return  $author_email_address != '' && $author_email_address != false ?  esc_attr( $author_email_address ) : false ;

    }



    function return_author_products_id( $author_id ){


        $args = array(
            'post_type' => 'product',
            'posts_per_page' => -1,
            'fields'  => 'ids',
            'meta_query' => array(
                array(
                    'key'     => 'wooa_product_author_id',
                    'value'   => array( $author_id ),
                    'compare' => 'IN',
                ),
            ),
        );

        $products = get_posts($args);

        return !empty($products) ? $products : false ;

    }




    function handle_template_redirect_hook() : void {

        if(is_single() && get_post_type() == 'woocommerce-author') {

	        $this->load_author_template_file();

        } else {

	        if ( is_404() ){

		        $current_url = $this->get_full_url();

		        $is_correct_url_structure_loaded = $this->check_for_right_url_structure( $current_url );


		        if ( $is_correct_url_structure_loaded ) {

			        $author_name = basename($current_url);



			        $author_id = $this->check_if_author_exist ( $author_name );



			        if( $author_id != 0 ){

				        $this->setup_initial_post_data($author_id);

				        $this->load_author_template_file();

			        }


		        }


	        }

        }




    }





    function modify_woocommerce_author_detail_title($title, $sep, $seplocation){

        global $post;

        if ( $post->post_type == 'woocommerce-author' ) {

            $author_name = get_post_meta( $post->ID , 'wooa_author_name' , 'true' );

            if( $author_name != '' ){

                $new_title = $author_name . " Profile";


            } else {

                $author_username = get_post_meta( $post->ID , 'wooa_author_username' , 'true' );

                $new_title = $author_username != '' ? $author_username . " Profile" : $post->title . " Profile";

            }

            return apply_filters ('wooa_single_author_detail_title' , $new_title , $sep , $seplocation );

        } else {

            return $title;

        }


    }




    function return_author_detail_url($author_id){

        $author_username = strtolower ( apply_filters('wooa_show_author_username' , $author_id ) );

        if( $author_username && $author_username != '' ){

            $site_url = get_site_url();

            return esc_url($site_url . "/" . $author_username );

        } else{

            return false;

        }

    }


    static function return_author_list_for_elementor_widget_setting(){

        $authors = array(
            '0' => __('Default',WOOA_TEXT_DOMAIN )
        );

        $args = array(
            'post_type' => 'woocommerce-author',
            'posts_per_page' => -1
        );

        $authors_list = get_posts($args);

        foreach ($authors_list as $author){

            $authors[$author->ID] = $author->post_title;

        }

        return $authors;


    }




    static function return_social_list_for_elementor_widget_setting(){

        return array(
            'instagram'     => 'Instagram',
            'dribble'       => 'Dribble',
            'behance'       => 'Behance',
            'twitter'       => 'Twitter',
            'linkedin'      => 'Linkedin',
        );

    }



    static function return_container_tag_list_for_elementor_widget_setting(){


        return array(
            'p' => __('Paragraph',WOOA_TEXT_DOMAIN ),
            'h1' => __('Heading 1 ( H1 )',WOOA_TEXT_DOMAIN ),
            'h2' => __('Heading 2 ( H2 )',WOOA_TEXT_DOMAIN ),
            'h3' => __('Heading 3 ( H3 )',WOOA_TEXT_DOMAIN ),
            'h4' => __('Heading 4 ( H4 )',WOOA_TEXT_DOMAIN ),
            'h5' => __('Heading 5 ( H5 )',WOOA_TEXT_DOMAIN ),
            'h6' => __('Heading 6 ( H6 )',WOOA_TEXT_DOMAIN ),

        );;


    }




    function return_author_id($author_id){


        if(is_array($author_id)){

            $author_id = $author_id[0];

        }

        if( $author_id != '0' ){

            return $author_id;

        }



        if(is_page()){

            return $author_id;

        }


        if(is_single() && get_post_type() == 'product'){

            global $post;

            return get_post_meta ( $post->ID , 'wooa_product_author_id' , true );

        }



        if(is_single() && get_post_type() == 'woocommerce-author'){

            return get_the_ID();

        }


		if(is_404()){

			return get_the_ID();

		}


        return $author_id;


    }

    static function load_author_products(array $settings){

        $args = array(

            'post_type' => 'product',
            'posts_per_page' => $settings['products_count'],
            'post_status' => 'publish',
            'fields' => 'ids',
            'meta_query' => array(
                array(
                    'key'     => 'wooa_product_author_id',
                    'value'   => $settings['author_id'],
                    'compare' => '=',
                ),
            ),

        );

        $products = get_posts($args);

        return empty($products) ? false : $products;


    }


    static function generate_author_products_html(array $products){


        foreach ($products as $product_id){

            try {

                    $product = new WC_Product($product_id);

                $product_data = array(
					'id'    => $product_id,
                    'title' => $product->get_title(),
                    'url' => $product->get_permalink(),
                    'regular_price' => $product->get_regular_price(),
                    'sale_price' => $product->get_sale_price(),
                    'image_id' => $product->get_image_id(),
                    'is_sale' => $product->is_on_sale(),
                    'image' => $product->get_image(),
                    'description' => $product->get_description(),
                    'short_description' => $product->get_short_description(),
                    'price_with_currency'=> $product->get_price_html(),
                    'currency' => get_woocommerce_currency_symbol(),
                );

                wooa_core::generate_single_product_box_html($product_data);



            }catch(Exception $e){

                _e('Invalid Product ID Has Been Provided' , WOOA_TEXT_DOMAIN);

                continue;

            }

        }


    }


    static public function generate_single_product_box_html($product_data){

		$theme_template_file_path = locate_template('woocommerce-author/wooa-single-product-box.php');

	    if(  $theme_template_file_path != '' ) {

		    get_template_part ('woocommerce-author/wooa-single-product-box','',array('product_id'=>$product_data['id']));


	    } else {

		    require (WOOA_PLUGIN_TEMPLATE_DIR . DIRECTORY_SEPARATOR . 'wooa-single-product-box.php');


	    }


    }




	function wooa_return_author_profile_picture_url($author_id){


		return get_the_post_thumbnail_url($author_id,'full');

	}





}


if( class_exists('wooa_core') ){

    $wooa_core = new wooa_core();

}