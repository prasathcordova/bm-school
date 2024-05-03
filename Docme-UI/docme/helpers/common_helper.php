<?php

function dev_export($vars)
{
    echo '<pre>';
    print_r($vars);
}

function procedure_param_string($data)
{
    if (!empty($data)) {
        foreach ($data as $data) {
            $string_array[] = '?';
        }
        $param_string = implode(',', $string_array);
        return $param_string;
    }
}


function isLoggedin()
{
    $CI = get_instance();
    $status = $CI->session->userdata('isloggedin');
    if ($status == 1 && null !== $CI->session->userdata('API-Key'))
        return 1;
    else
        return 0;
}

function check_permission($pageid, $operationid = NULL, $moduleid = NULL)
{
    $CI = get_instance();
    $apppages = $CI->session->userdata('apppage');
    $operation = $CI->session->userdata('operationid');
    $module = $CI->session->userdata('moduleid');
    if (isset($moduleid) && !empty($moduleid) && $moduleid > 0 && $pageid == 0 && $operationid == 0) {
        if (in_array($moduleid, $module)) {
            return 1;
        } else {
            return 0;
        }
    }
    if (isset($apppages) && !empty($apppages)) {
        $status = in_array($pageid, $apppages);
        if (!empty($status)) {
            if (isset($operation) && !empty($operation)) {
                if (isset($operationid) && !empty($operationid)) {
                    if (in_array($operationid, $operation)) {
                        return 1;
                    } else {
                        return 0;
                    }
                } else {
                    return 1;
                }
            } else {
                return 0;
            }
        } else {
            return 0;
        }
    } else {
        return 0;
    }
}

function RandString($length = 8)
{
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $sc = '@#$!';
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, strlen($characters) - 1)];
    }
    $sp = $sc[rand(0, strlen($sc) - 1)];

    return str_shuffle($sp . $randomString);
}

function Filenamegenerator($length = 8)
{
    $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $sc = '589FGT';
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, strlen($characters) - 1)];
    }
    $sp = $sc[rand(0, strlen($sc) - 1)];

    return str_shuffle($sp . $randomString);
}

function isJson($string)
{
    json_decode($string);
    return (json_last_error() == JSON_ERROR_NONE);
}

function bread_crump_maker($breadcrump)
{
    $bread_crump_data = "";
    if (isset($breadcrump) && !empty($breadcrump)) {
        if (is_array($breadcrump)) {
            foreach ($breadcrump as $crump) {
                if (isset($crump['link']) && !empty($crump['link'])) {
                    $bread_crump_data = $bread_crump_data . '<li><a href = "' . $crump['link'] . '">' . $crump['title'] . '</a></li>';
                } else if (isset($crump['function']) && !empty($crump['function'])) {
                    $bread_crump_data = $bread_crump_data . '<li><a href = "javascript:void(0);" onclick="' . $crump['function'] . '">' . $crump['title'] . '</a></li>';
                } else {
                    $bread_crump_data = $bread_crump_data . '<li>' . $crump['title'] . '</li>';
                }
            }
        } else {
            $bread_crump_data = $breadcrump;
        }
    }
    return $bread_crump_data;
}

function address_formatter($address1, $address2 = NULL, $address3 = NULL)
{
    $address_group = array();
    $address_group[] = $address1;
    if ($address2) {
        $address_group[] = $address2;
    }
    if ($address3) {
        $address_group[] = $address3;
    }
    $address_details = implode(",", $address_group);
    return $address_details;
}

// function my_money_format($num, $currency = "")
// {
//     $num = ROUND(abs($num), 4); //added abs() function to avoid 0..020 for -0.020
//     $int_part = (int) $num;
//     $float_part = $num - $int_part;
//     $float_part = round($float_part, 4); //, PHP_ROUND_HALF_UP
//     $myfloat = substr($float_part, 2, 4);
//     $pp = array();
//     if (strlen($myfloat) == 0)
//         $myfloat = '0000';
//     if (strlen($myfloat) == 1)
//         $myfloat = $myfloat . '000';
//     if (strlen($myfloat) == 2)
//         $myfloat = $myfloat . '00';
//     if (strlen($myfloat) == 3)
//         $myfloat = $myfloat . '0';
//     if (strlen($int_part) == 0)
//         $int_part = '0';
//     if (strlen($int_part) > 2) {
//         $myint = $int_part;
//         $thousand = substr($myint, -3);
//         $myint = substr($myint, 0, strlen($myint) - 3);
//         $i = 0;
//         while (strlen($myint) > 0) {
//             if (strlen($myint) > 1) {
//                 $pp[$i] = substr($myint, -2);
//                 $myint = substr($myint, 0, strlen($myint) - 2);
//             } else {
//                 $pp[$i] = substr($myint, -1);
//                 $myint = substr($myint, 0, strlen($myint) - 1);
//             }
//             $i++;
//         }
//         $myint_add = '';
//         for ($j = sizeof($pp) - 1; $j >= 0; $j--) { //below condition checked for removing comma fro -ve value with extra comma(,) : SALAH - NOv 8,2019
//             // if ($pp[$j] == '-') $myint_add .= $pp[$j];
//             // else 
//             $myint_add .= $pp[$j] . ',';
//         }
//         return $currency . $myint_add . $thousand . "." . $myfloat;
//     } else {
//         return $currency . $int_part . "." . $myfloat;
//     }
// }
function my_money_format($num, $currency = "")
{
    $symbol = substr($num, 0, 1);
    if ($symbol != '-') $symbol = '';
    $num = ROUND(abs($num), 2); //added abs() function and $symbol to avoid 0..020 for -0.020
    $int_part = (int) $num;
    $float_part = $num - $int_part;
    $float_part = round($float_part, 2, PHP_ROUND_HALF_UP);
    $myfloat = substr($float_part, 2, 2);
    $pp = array();
    if (strlen($myfloat) == 0)
        $myfloat = '00';
    if (strlen($myfloat) == 1)
        $myfloat = $myfloat . '0';
    if (strlen($int_part) == 0)
        $int_part = '0';
    if (strlen($int_part) > 2) {
        $myint = $int_part;
        $thousand = substr($myint, -3);
        $myint = substr($myint, 0, strlen($myint) - 3);
        $i = 0;
        while (strlen($myint) > 0) {
            if (strlen($myint) > 1) {
                $pp[$i] = substr($myint, -2);
                $myint = substr($myint, 0, strlen($myint) - 2);
            } else {
                $pp[$i] = substr($myint, -1);
                $myint = substr($myint, 0, strlen($myint) - 1);
            }
            $i++;
        }
        $myint_add = '';
        for ($j = sizeof($pp) - 1; $j >= 0; $j--)
            $myint_add .= $pp[$j] . ',';
        return $symbol . $currency . $myint_add . $thousand . "." . $myfloat;
    } else {
        return $symbol . $currency . $int_part . "." . $myfloat;
    }
}
function my_money_format_for_excel($num, $currency = "")
{
    $symbol = substr($num, 0, 1);
    if ($symbol != '-') $symbol = '';
    $num = ROUND(abs($num), 2); //added abs() function and $symbol to avoid 0..020 for -0.020
    $int_part = (int) $num;
    $float_part = $num - $int_part;
    $float_part = round($float_part, 2, PHP_ROUND_HALF_UP);
    $myfloat = substr($float_part, 2, 2);
    $pp = array();
    if (strlen($myfloat) == 0)
        $myfloat = '00';
    if (strlen($myfloat) == 1)
        $myfloat = $myfloat . '0';
    if (strlen($int_part) == 0)
        $int_part = '0';
    if (strlen($int_part) > 2) {
        $myint = $int_part;
        $thousand = substr($myint, -3);
        $myint = substr($myint, 0, strlen($myint) - 3);
        $i = 0;
        while (strlen($myint) > 0) {
            if (strlen($myint) > 1) {
                $pp[$i] = substr($myint, -2);
                $myint = substr($myint, 0, strlen($myint) - 2);
            } else {
                $pp[$i] = substr($myint, -1);
                $myint = substr($myint, 0, strlen($myint) - 1);
            }
            $i++;
        }
        $myint_add = '';
        for ($j = sizeof($pp) - 1; $j >= 0; $j--)
            $myint_add .= $pp[$j];
        return $symbol . $currency . $myint_add . $thousand . "." . $myfloat;
    } else {
        return $symbol . $currency . $int_part . "." . $myfloat;
    }
}
//Function written by Vinoth K @ 15.05.2019 3:35
function number_to_words($num)
{
    $ones = array(
        0 => "ZERO",
        1 => "ONE",
        2 => "TWO",
        3 => "THREE",
        4 => "FOUR",
        5 => "FIVE",
        6 => "SIX",
        7 => "SEVEN",
        8 => "EIGHT",
        9 => "NINE",
        10 => "TEN",
        11 => "ELEVEN",
        12 => "TWELVE",
        13 => "THIRTEEN",
        14 => "FOURTEEN",
        15 => "FIFTEEN",
        16 => "SIXTEEN",
        17 => "SEVENTEEN",
        18 => "EIGHTEEN",
        19 => "NINETEEN",
        "014" => "FOURTEEN"
    );
    $tens = array(
        0 => "ZERO",
        1 => "TEN",
        2 => "TWENTY",
        3 => "THIRTY",
        4 => "FORTY",
        5 => "FIFTY",
        6 => "SIXTY",
        7 => "SEVENTY",
        8 => "EIGHTY",
        9 => "NINETY"
    );
    $hundreds = array(
        "HUNDRED",
        "THOUSAND",
        "MILLION",
        "BILLION",
        "TRILLION",
        "QUARDRILLION"
    );
    $num = number_format($num, 2, ".", ",");
    $num_arr = explode(".", $num);
    $wholenum = $num_arr[0];
    $decnum = $num_arr[1];
    $whole_arr = array_reverse(explode(",", $wholenum));
    krsort($whole_arr, 1);
    $rettxt = "";
    foreach ($whole_arr as $key => $i) {

        while (substr($i, 0, 1) == "0")
            $i = substr($i, 1, 5);
        if ($i < 20) {
            /* echo "getting:".$i; */
            $rettxt .= $ones[$i];
        } elseif ($i < 100) {
            if (substr($i, 0, 1) != "0")
                $rettxt .= $tens[substr($i, 0, 1)];
            if (substr($i, 1, 1) != "0")
                $rettxt .= " " . $ones[substr($i, 1, 1)];
        } else {
            if (substr($i, 0, 1) != "0")
                $rettxt .= $ones[substr($i, 0, 1)] . " " . $hundreds[0];
            if (substr($i, 1, 1) != "0")
                $rettxt .= " " . $tens[substr($i, 1, 1)];
            if (substr($i, 2, 1) != "0")
                $rettxt .= " " . $ones[substr($i, 2, 1)];
        }
        if ($key > 0) {
            $rettxt .= " " . $hundreds[$key] . " ";
        }
    }
    if ($decnum > 0) {
        $rettxt .= " and ";
        if ($decnum < 20) {
            $rettxt .= $ones[$decnum];
        } elseif ($decnum < 100) {
            $rettxt .= $tens[substr($decnum, 0, 1)];
            $rettxt .= " " . $ones[substr($decnum, 1, 1)];
        }
    }
    return $rettxt;
}
//Function written by SALAHUDHEEN @ 04.06.2019 3:35
function convert_number_to_words($number)
{
    $hyphen      = '-';
    $conjunction = ' and ';
    $separator   = ' ';
    $negative    = 'negative ';
    $decimal     = ' point ';
    $dictionary  = array(
        0                   => 'zero',
        1                   => 'one',
        2                   => 'two',
        3                   => 'three',
        4                   => 'four',
        5                   => 'five',
        6                   => 'six',
        7                   => 'seven',
        8                   => 'eight',
        9                   => 'nine',
        10                  => 'ten',
        11                  => 'eleven',
        12                  => 'twelve',
        13                  => 'thirteen',
        14                  => 'fourteen',
        15                  => 'fifteen',
        16                  => 'sixteen',
        17                  => 'seventeen',
        18                  => 'eighteen',
        19                  => 'nineteen',
        20                  => 'twenty',
        30                  => 'thirty',
        40                  => 'fourty',
        50                  => 'fifty',
        60                  => 'sixty',
        70                  => 'seventy',
        80                  => 'eighty',
        90                  => 'ninety',
        100                 => 'hundred',
        1000                => 'thousand',
        1000000             => 'million',
        1000000000          => 'billion',
        1000000000000       => 'trillion',
        1000000000000000    => 'quadrillion',
        1000000000000000000 => 'quintillion'
    );
    if (!is_numeric($number)) {
        return false;
    }
    if (($number >= 0 && (int) $number < 0) || (int) $number < 0 - PHP_INT_MAX) {
        // overflow
        trigger_error(
            'convert_number_to_words only accepts numbers between -' . PHP_INT_MAX . ' and ' . PHP_INT_MAX,
            E_USER_WARNING
        );
        return false;
    }
    if ($number < 0) {
        return $negative . convert_number_to_words(abs($number));
    }
    $string = $fraction = null;
    if (strpos($number, '.') !== false) {
        list($number, $fraction) = explode('.', $number);
    }
    switch (true) {
        case $number < 21:
            $string = $dictionary[$number];
            break;
        case $number < 100:
            $tens   = ((int) ($number / 10)) * 10;
            $units  = $number % 10;
            $string = $dictionary[$tens];
            if ($units) {
                $string .= $hyphen . $dictionary[$units];
            }
            break;
        case $number < 1000:
            $hundreds  = $number / 100;
            $remainder = $number % 100;
            $string = $dictionary[$hundreds] . ' ' . $dictionary[100];
            if ($remainder) {
                $string .= $conjunction . convert_number_to_words($remainder);
            }
            break;
        default:
            $baseUnit = pow(1000, floor(log($number, 1000)));
            $numBaseUnits = (int) ($number / $baseUnit);
            $remainder = $number % $baseUnit;
            $string = convert_number_to_words($numBaseUnits) . ' ' . $dictionary[$baseUnit];
            if ($remainder) {
                $string .= $remainder < 100 ? $conjunction : $separator;
                $string .= convert_number_to_words($remainder);
            }
            break;
    }
    if (null !== $fraction && is_numeric($fraction)) {
        $string .= $decimal;
        $words = array();
        foreach (str_split((string) $fraction) as $number) {
            $words[] = $dictionary[$number];
        }
        $string .= implode(' ', $words);
    }
    return $string;
}
function convert_number_to_indian_words(float $number)
{
    $decimal = round($number - ($no = floor($number)), 2) * 100;
    $hundred = null;
    $digits_length = strlen($no);
    $i = 0;
    $str = array();
    $words = array(
        0 => '', 1 => 'one', 2 => 'two',
        3 => 'three', 4 => 'four', 5 => 'five', 6 => 'six',
        7 => 'seven', 8 => 'eight', 9 => 'nine',
        10 => 'ten', 11 => 'eleven', 12 => 'twelve',
        13 => 'thirteen', 14 => 'fourteen', 15 => 'fifteen',
        16 => 'sixteen', 17 => 'seventeen', 18 => 'eighteen',
        19 => 'nineteen', 20 => 'twenty', 30 => 'thirty',
        40 => 'forty', 50 => 'fifty', 60 => 'sixty',
        70 => 'seventy', 80 => 'eighty', 90 => 'ninety'
    );
    $digits = array('', 'hundred', 'thousand', 'lakh', 'crore');
    while ($i < $digits_length) {
        $divider = ($i == 2) ? 10 : 100;
        $number = floor($no % $divider);
        $no = floor($no / $divider);
        $i += $divider == 10 ? 1 : 2;
        if ($number) {
            $plural = (($counter = count($str)) && $number > 9) ? '' : null;
            $hundred = ($counter == 1 && $str[0]) ? ' and ' : null;
            $str[] = ($number < 21) ? $words[$number] . ' ' . $digits[$counter] . $plural . ' ' . $hundred : $words[floor($number / 10) * 10] . ' ' . $words[$number % 10] . ' ' . $digits[$counter] . $plural . ' ' . $hundred;
        } else $str[] = null;
    }
    $Rupees = implode('', array_reverse($str));
    // $paise = ($decimal > 0) ? " and " . ($words[$decimal / 10] . " " . $words[$decimal % 10]) . ' Paise' : '';
    $paise = ($decimal > 0) ? (($Rupees > 0) ? " and " : "" . (convert_number_to_indian_words($decimal)) . ' Paise') : '';

    return ucwords(($Rupees ? $Rupees . ' ' : '') . $paise);
}

function print_currency($color = "", $size = '')
{
    $CI = get_instance();
    if ($CI->session->userdata('Currency_font')) {
        //echo $CI->session->userdata('Currency_font');
        echo '<i class="fa ' . $CI->session->userdata('Currency_font') . '" aria-hidden="true" style="color:' . $color . '; font-weight:bold; font-size:' . $size . 'px; "></i>';
    } else {
        echo '<span style="color:' . $color . '; font-weight:bold; font-size:' . $size . 'px; ">' . $CI->session->userdata('Currency_abbr') . '</span>';
    }
}

// Student image save and get function written by Elavarasan S @ 20-06-2019 12:00

function save_student_image($image, $id, $inst, $user)
{
    $filepath = FCPATH . 'student_profiles/' . $id . '.txt';
    if (!file_exists($filepath)) {
        $file = fopen($filepath, 'w');
        $data = array(
            'profileImage' => $image,
            'inst_id' => $inst,
            'createdBy' => $user,
            'createdOn' => date('d-m-Y h:i'),
            'modifiedBy' => '-',
            'modifiedOn' => '-'
        );
        fwrite($file, json_encode($data));
        fclose($file);
    } else {
        $filedata = json_decode(file_get_contents($filepath));
        $filedata->profileImage = $image;
        $filedata->inst_id = $inst;
        $filedata->createdBy = $filedata->createdBy;
        $filedata->createdOn = $filedata->createdOn;
        $filedata->modifiedBy = $user;
        $filedata->modifiedOn = date('d-m-Y h:i');
        $file = fopen($filepath, 'w');
        fwrite($file, json_encode($filedata));
        fclose($file);
    }
}

function get_student_image($id)
{
    $filepath = FCPATH . 'student_profiles/' . $id . '.txt';
    if (file_exists($filepath)) {
        $filedata = json_decode(file_get_contents($filepath));
        //    if(!empty($filedata->profileImage)){
        return $filedata->profileImage;
    } else {
        return '';
    }
}
//Function written by SALAHUDHEEN 

function print_tax_vat()
{
    $CI = get_instance();
    echo $CI->session->userdata('TAXNAME');
}

function encrypt_data_for_url($input_data){
                
    // Store a string into the variable which 
    // need to be Encrypted 
    $simple_string = $input_data; 
    
    // Store the cipher method 
    $ciphering = "AES-128-CTR"; 
    
    // Use OpenSSl Encryption method 
    $iv_length = openssl_cipher_iv_length($ciphering); 
    $options = 0; 
    
    // Non-NULL Initialization Vector for encryption 
    $encryption_iv = '1234567891011121'; 
    
    // Store the encryption key 
    $encryption_key = "WelcometoDocMe"; 
    
    // Use openssl_encrypt() function to encrypt the data 
    $encryption = openssl_encrypt($simple_string, $ciphering,$encryption_key, $options, $encryption_iv); 
    return base64_encode( $encryption ); 
    
}
function decrypt_data_for_url($input_key){
            
    // Store a string into the variable which 
    // need to be Encrypted
    $encryption = base64_decode($input_key);  
    
    // Store the cipher method 
    $ciphering = "AES-128-CTR"; 
    
    // Use OpenSSl Encryption method 
    $iv_length = openssl_cipher_iv_length($ciphering); 
    $options = 0; 
    
    // Non-NULL Initialization Vector for decryption 
    $decryption_iv = '1234567891011121'; 
    
    // Store the decryption key 
    $decryption_key = "WelcometoDocMe"; 
    
    // Use openssl_decrypt() function to decrypt the data 
    $decryption=openssl_decrypt ($encryption, $ciphering, $decryption_key, $options, $decryption_iv); 
    
    // Display the decrypted string 
    return $decryption; 
}
function arrear_sms_data($data)
{
    $path = SMS_SERVICE_URL;

    $data_string = http_build_query($data);
    $ch = curl_init($path);
    $http_header = [
        'Content-Type: application/x-www-form-urlencoded',
        'Content-Length: ' . strlen($data_string)
    ];
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $http_header);
    $result = curl_exec($ch);
    return $result;
}
