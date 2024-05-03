<?php

class ProcessPayment
{

    function __construct()
    {
    }

    function requestMerchant($params)
    {
        // echo '<pre>';print_r($params);die;
        $Url = "https://paynetzuat.atomtech.in/paynetz/epi/fts";
        $Login = "160";
        $Password = "Test@123";
        $MerchantName = "ATOM";
        $TxnCurr = "INR";
        $TxnScAmt = "0";
        $productId = "NSE";

        $datenow = date("Y/d/m h:m:s");

        $modifiedDate = str_replace(" ", "%20", $datenow);


        $postFields = "";
        $postFields .= "&login=" . $Login;
        $postFields .= "&pass=" . $Password;
        $postFields .= "&ttype=" . $params['TType'];
        $postFields .= "&prodid=" . $productId;
        $postFields .= "&amt=" . $params['amount'];
        //$postFields .= "&udf1=".$params['udf1'];
        $postFields .= "&txncurr=" . $TxnCurr;
        $postFields .= "&txnscamt=" . $TxnScAmt;
        $postFields .= "&clientcode=" . urlencode(base64_encode($params['clientcode']));
        $postFields .= "&txnid=" . rand(0, 999999);
        $postFields .= "&date=" . $modifiedDate;
        //$postFields .= "&mdd=CC";
        //$postFields .= "&mdd=NB";
        $postFields .= "&custacc=" . $params['AccountNo'];


        $postFields .= "&udf1=" . $params['udf1'];
        $postFields .= "&udf2=" . $params['udf2'];
        $postFields .= "&udf3=" . $params['udf3'];
        //$postFields .= "&udf4=".$params['udf4'];




        $postFields .= "&ru=" . $params['ru'];
        // Not required for merchant
        //$postFields .= "&bankid=".$params['bankid'];

        $sendUrl = $Url . "?" . substr($postFields, 1) . "\n";

        //$this->writeLog($sendUrl);

        $returnData = $this->sendInfo($postFields, $Url);

        $xmlObjArray = $this->xmltoarray($returnData);

        $url = $xmlObjArray['url'];
        $postFields = "";
        $postFields .= "&ttype=" . $params['TType'];
        $postFields .= "&tempTxnId=" . $xmlObjArray['tempTxnId'];
        $postFields .= "&token=" . $xmlObjArray['token'];
        $postFields .= "&txnStage=1";
        $url = $Url . "?" . $postFields;
        //$this->writeLog($url."\n");
        //        echo $url;die;
        //redirect($url);
        header("Location:" . $url);
        exit;
    }

    /* 	function writeLog($data){
      //return true;
      $fileName = date("Y-m-d").".txt";
      $fp = fopen("/log/".$fileName, 'a+');
      $data = date("Y-m-d H:i:s")." - ".$data;
      fwrite($fp,$data);
      fclose($fp);
      } */

    function xmltoarray($data)
    {
        $parser = xml_parser_create('');
        xml_parser_set_option($parser, XML_OPTION_TARGET_ENCODING, "UTF-8");
        xml_parser_set_option($parser, XML_OPTION_CASE_FOLDING, 0);
        xml_parser_set_option($parser, XML_OPTION_SKIP_WHITE, 1);
        xml_parse_into_struct($parser, trim($data), $xml_values);
        xml_parser_free($parser);

        $returnArray = array();
        $returnArray['url'] = $xml_values[3]['value'];
        $returnArray['tempTxnId'] = $xml_values[5]['value'];
        $returnArray['token'] = $xml_values[6]['value'];

        return $returnArray;
    }

    function sendInfo($data, $url)
    {

        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_PORT, 443);
        //curl_setopt($ch, CURLOPT_SSLVERSION,3);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);

        $returnData = curl_exec($ch);

        curl_close($ch);
        return $returnData;
    }
}
