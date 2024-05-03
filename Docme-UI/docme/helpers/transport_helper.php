<?php


function transport_data_with_param_with_urlencode($data, $apikey)
{
    $path = SERVICE_URL;
    $data_string = http_build_query($data);
    $ch = curl_init($path);
    $http_header = [
        "API-KEY:$apikey",
        'Content-Type: application/x-www-form-urlencoded',
        'Content-Length: ' . strlen($data_string)
    ];
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $http_header);
    $result = curl_exec($ch);
    $final_result = json_decode($result, TRUE);
   // dev_export($final_result);die;
    return $final_result;
}

function transport_data_with_param_with_formdata($data, $apikey)
{
    $path = SERVICE_URL;
    $data_string = http_build_query($data);
    $ch = curl_init($path);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
    curl_setopt(
        $ch,
        CURLOPT_HTTPHEADER,
        array(
            "API-KEY:$apikey"
        )
    );
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $result = curl_exec($ch);
    $final_result = json_decode($result, TRUE);
    if (count($final_result) == 0) {
        return $result;
    } else {
        return $final_result;
    }
}

function transport_data_to_mis($data, $apikey)
{
    $path = 'http://10.10.4.47/wfm/api/MISNew/postExemptionApprovalNewList';
    //$data_string = http_build_query($data);
    $data_string = $data;
    $ch = curl_init($path);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
    curl_setopt(
        $ch,
        CURLOPT_HTTPHEADER,
        array(
            'API-KEY:' . $apikey,
            'Content-Type: application/json',
            'Content-Length: ' . strlen($data_string)
        )
    );
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $result = curl_exec($ch);
    $final_result = json_decode($result, TRUE);
    if ($final_result == 0) {
        return $result;
    } else {
        return $final_result;
    }
}

function transport_data_to_rims($data, $apikey, $func, $inst_id = 0)
{
    switch ($inst_id) {
        case 1:
            $api_url = RIMS_API_URL_TCS;
            break;
        case 2:
            $api_url = RIMS_API_URL_NIMSSSJ;
            break;
        case 3:
            $api_url = RIMS_API_URL_NIMSALAIN;
            break;
        case 4:
            $api_url = RIMS_API_URL_NIMSDXB;
            break;
        case 5:
            $api_url = RIMS_API_URL_OXFTVM;
            break;
        case 8:
            $api_url = RIMS_API_URL_OXFKLM;
            break;
        case 9:
            $api_url = RIMS_API_URL_MODELAUH;
            break;
        case 20:
            $api_url = RIMS_API_URL_OXFCLT;
            break;
        default:
            $api_url = SERVICE_URL_RIMS;
            break;
    }
    $path = $api_url . '/' . $func;
    //$data_string = http_build_query($data);
    $data_string = $data;
    $ch = curl_init($path);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
    curl_setopt(
        $ch,
        CURLOPT_HTTPHEADER,
        array(
            'API-KEY:' . $apikey,
            'Content-Type: application/json',
            'Content-Length: ' . strlen($data_string)
        )
    );
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $result = curl_exec($ch);
    $final_result = json_decode($result, TRUE);
    if ($final_result == 0) {
        return $result;
    } else {
        return $final_result;
    }
}
