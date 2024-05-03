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


function transport_wfm_data_with_param_with_formdata($data)
{
    $path = WFM_SINGLE_SERVICE_URL;
    $data_string = json_encode($data);
    $ch = curl_init($path);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
    curl_setopt($ch, CURLOPT_HTTPHEADER,     array('Accept: application/json', 'Content-Type: application/json'));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $result = curl_exec($ch);
    curl_close($ch);
    $final_result = json_decode($result, TRUE);
    if (count($final_result) == 0) {
        return $result;
    } else {
        return $final_result;
    }
}

function transport_sms_data($data)
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
