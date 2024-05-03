<?php

function dev_export($var)
{
    echo '<pre>';
    print_r($var);
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
function RandString($length = 8)
{
    //    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
    //    $sc = '@#$!';
    $sc = 'ASEW';
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, strlen($characters) - 1)];
    }
    $sp = $sc[rand(0, strlen($sc) - 1)];

    return str_shuffle($sp . $randomString);
}
function Keygenerator($length = 8)
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

function File_name_generator($length = 8)
{
    $characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $sc = 'XDFTWPO';
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, strlen($characters) - 1)];
    }
    $sp = $sc[rand(0, strlen($sc) - 1)];

    return str_shuffle($sp . $randomString);
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


function xml_generator($data)
{
    $xml_data = "<table>";
    foreach ($data as $value) {
        $xml_data = $xml_data . "<row>";
        foreach ($value as $key => $data_value) {
            $xml_data = $xml_data . "<" . $key . ">" . $data_value . "</" . $key . ">";
        }
        $xml_data = $xml_data . "</row>";
    }
    $xml_data = $xml_data . "</table>";
    return $xml_data;
}
