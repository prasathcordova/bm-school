<?php

function dev_export($vars)
{
    echo '<pre>';
    print_r($vars);
}

function isLoggedin()
{
    $CI = get_instance();
    $status = $CI->session->userdata('isLoggedIn');
    if ($status == 1 && null !== $CI->session->userdata('API-Key'))
        return 1;
    else
        return 0;
}

function CheckPermission2($pageid, $operationid = NULL)
{
    // $CI = get_instance();
}

function check_permission($pageid, $operationid = NULL)
{
    $CI = get_instance();
    $apppages = $CI->session->userdata('apppage');
    $operation = $CI->session->userdata('operationid');
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

function bread_crump_maker($breadcrump)
{
    $bread_crump_data = "";
    if (isset($breadcrump) && !empty($breadcrump)) {
        if (is_array($breadcrump)) {
            foreach ($breadcrump as $crump) {
                if (isset($crump['link']) && !empty($crump['link'])) {
                    $bread_crump_data = $bread_crump_data . '<li><a href = "' . $crump['link'] . '">' . $crump['title'] . '</a></li>';
                } else if (isset($crump['jqf']) && !empty($crump['jqf'])) {
                    $bread_crump_data = $bread_crump_data . '<li><a href = "javascript:void(0);" onclick="' . $crump['jqf'] . '">' . $crump['title'] . '</a></li>';
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

function number_rep_for_periods($val)
{
    $formatted = '';
    if ($val) {
        switch ($val) {
            case 1:
                $formatted = "1st";
                break;
            case 2:
                $formatted = "2nd";
                break;
            case 3:
                $formatted = "3rd";
                break;
            case 4:
                $formatted = "4th";
                break;
            case 5:
                $formatted = "5th";
                break;
            case 6:
                $formatted = "6th";
                break;
            case 7:
                $formatted = "7th";
                break;
            case 8:
                $formatted = "8th";
                break;
            case 9:
                $formatted = "9th";
                break;
            case 10:
                $formatted = "10th";
                break;
        }
        return $formatted;
    }
}

function time_elapsed_string($datetime, $full = false)
{

    date_default_timezone_set(DEFAULT_TIMEZONE);
    $now = new DateTime;
    $ago = new DateTime($datetime);
    $diff = $now->diff($ago);

    $diff->w = floor($diff->d / 7);
    $diff->d -= $diff->w * 7;

    $string = array(
        'y' => 'year',
        'm' => 'month',
        'w' => 'week',
        'd' => 'day',
        'h' => 'hour',
        'i' => 'minute',
        's' => 'second',
    );
    foreach ($string as $k => &$v) {
        if ($diff->$k) {
            $v = $diff->$k . ' ' . $v . ($diff->$k > 1 ? 's' : '');
        } else {
            unset($string[$k]);
        }
    }

    if (!$full)
        $string = array_slice($string, 0, 1);

    return $string ? implode(', ', $string) . ' ago' : 'just now';
}
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

function print_currency($color = "", $size = '', $inst_id = '')
{
    // $CI = get_instance();
    // if ($CI->session->userdata('Currency_font')) {
    //     //echo $CI->session->userdata('Currency_font');
    //     echo '<i class="fa ' . $CI->session->userdata('Currency_font') . '" aria-hidden="true" style="color:' . $color . '; font-weight:bold; font-size:' . $size . 'px; "></i>';
    // } else {
    //     echo '<span style="color:' . $color . '; font-weight:bold; font-size:' . $size . 'px; ">' . $CI->session->userdata('Currency_abbr') . '</span>';
    // }

    $indian_array = ['5', '8', '20'];
    if (in_array($inst_id, $indian_array))
        echo '<i class="fa fa-inr" aria-hidden="true" style="color:' . $color . '; font-weight:bold; font-size:' . $size . 'px; "></i>';
    else
        echo '<span style="color:' . $color . '; font-weight:bold; font-size:' . $size . 'px; ">AED</span>';
}
function print_tax_vat($inst_id)
{
    // $CI = get_instance();
    // echo $CI->session->userdata('TAXNAME');
    $indian_array = ['5', '8', '20'];
    if (in_array($inst_id, $indian_array)) echo 'Tax';
    else echo 'Vat';
}

function get_student_image($id)
{
    $docme_ui_path = str_replace('Portal', 'Docme-UI', FCPATH);
    $filepath = $docme_ui_path . 'student_profiles/' . $id . '.txt';
    if (file_exists($filepath)) {
        $filedata = json_decode(file_get_contents($filepath));
        //    if(!empty($filedata->profileImage)){
        return $filedata->profileImage;
    } else {
        return '';
    }
}
