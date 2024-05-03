<?php

/**
 * Description of Report_ccontroller
 *
 * @author Aju
 */
class Fee_report_controller extends MX_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Feereport_model', 'MReport');
    }

    //COLLECTION VOUCHER WISE REPORT
    public function get_voucher_wise_collection_report($params)
    {
        $apikey = $params['API_KEY'];

        if (!(isset($params['inst_id']) && !empty($params['inst_id']))) {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Inst code is required', 'data' => FALSE);
        } else {
            $inst_id = $params['inst_id'];
        }
        if (!(isset($params['acd_year_id']) && !empty($params['acd_year_id']))) {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Academic year data is required', 'data' => FALSE);
        } else {
            $acd_year_id = $params['acd_year_id'];
        }

        if (!(isset($params['from_date']) && !empty($params['from_date']))) {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'From date data is required', 'data' => FALSE);
        } else {
            $from_date = $params['from_date'];
        }
        // $to_date = $params['from_date'];
        $user_wise_report = $params['user_wise_report'];
        $logged_user = $params['logged_user'];

        if (!(isset($params['to_date']) && !empty($params['to_date']))) {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'To date data is required', 'data' => FALSE);
        } else {
            $to_date = $params['to_date'];
        }
        $report_data = $this->MReport->get_collection_voucher_wise_data($apikey, $inst_id, $acd_year_id, $from_date, $to_date, $user_wise_report);
        // return $report_data;

        //prospectus_amount
        $prospectus_data = $this->MReport->get_prospectus_data_report($apikey, $inst_id, $acd_year_id, $from_date, $to_date);
        // return $prospectus_data; if ($user_wise_report == 1) {
        // if (isset($prospectus_data) && !empty($prospectus_data) && count($prospectus_data) > 0) {
        //     $prospectus_amount = $prospectus_data[0]['prospectus_amount'];
        // } else $prospectus_amount = 0;
        $prospectus_amount = 0;
        if (isset($prospectus_data) && !empty($prospectus_data) && count($prospectus_data) > 0) {
            foreach ($prospectus_data as $pr_amt) {
                if ($user_wise_report == 1) {
                    if ($pr_amt['createdby'] == $logged_user) {
                        $prospectus_amount += $pr_amt['Amount'];
                    }
                } else {
                    $prospectus_amount += $pr_amt['Amount'];
                }
            }
            // $prospectus_amount = $prospectus_data[0]['prospectus_amount'];
        } else $prospectus_amount = 0;

        //Registration Fee
        $reg_fee_data = $this->MReport->get_regfee_collection_report($apikey, $inst_id, $acd_year_id, $from_date, $to_date);
        $regfee_amount = 0;
        if (isset($reg_fee_data) && !empty($reg_fee_data) && count($reg_fee_data) > 0) {
            foreach ($reg_fee_data as $reg_amt) {
                if ($user_wise_report == 1) {
                    if ($reg_amt['created_by'] == $logged_user) {
                        $regfee_amount += $reg_amt['amount'];
                    }
                } else {
                    $regfee_amount += $reg_amt['amount'];
                }
            }
        } else $regfee_amount = 0;

        // return $regfee_amount;
        $voucher_collection_details = $this->MReport->get_voucher_collection_details($apikey, $inst_id, $acd_year_id, $from_date, $to_date);
        // return $voucher_collection_details;
        $voucher_detail_array = array();
        /** */
        //$samt = 0;
        // if (is_array($serchg) && !empty($serchg[0])) {
        //     foreach ($serchg as $sr) {
        //         if ($sr['is_pros_fee'] != 1) {
        //             $samt += $sr['SERVICE_CHARGE_COLLECTED'];
        //         }
        //     }
        // }
        //$surcharge_amount = $samt;
        /** */
        // return $voucher_collection_details;
        if (isset($voucher_collection_details) && !empty($voucher_collection_details) && count($voucher_collection_details) > 0) {

            //$surcharge_amount = $voucher_collection_details[0]['SERVICE_CHARGE_COLLECTED'];
            $serchg = json_decode($voucher_collection_details[0]['SURCHARGE_DETAILS'], true);
            $rndoff = json_decode($voucher_collection_details[0]['ROUNDOFF_DETAILS'], true);
            $vatamt = json_decode($voucher_collection_details[0]['VAT_DETAILS'], true);
            $concamt = json_decode($voucher_collection_details[0]['CONC_DETAILS'], true);
            $st_concamt = json_decode($voucher_collection_details[0]['ST_CONC_DETAILS'], true);
            $expnamt = json_decode($voucher_collection_details[0]['EXPN_DETAILS'], true);
            $cnramt = json_decode($voucher_collection_details[0]['CNRA_DETAILS'], true);
            $pbkamt = json_decode($voucher_collection_details[0]['PBK_DETAILS'], true);
            $pnltyamt = json_decode($voucher_collection_details[0]['PENALTY_DETAILS'], true);
            $ser_amount = 0;
            $ser_pros_fee = 0;
            $tr_penalty = 0;
            $nr_penalty = 0;
            // return $serchg;
            foreach ($serchg as $a1) {
                //if(isset($a1['SERVICE_CHARGE_COLLECTED']))
                if ($a1['is_pros_fee'] != 1 and $a1['is_pros_fee'] != 2) {
                    // $ser_amount1 += $a1['SERVICE_CHARGE_COLLECTED'];
                    $voucher_detail_array[$a1['USERID']]['SERVICE_CHARGE_COLLECTED'] += $a1['SERVICE_CHARGE_COLLECTED'];
                } else if ($a1['is_pros_fee'] == 1) {
                    // $ser_pros_fee1 += $a1['SERVICE_CHARGE_COLLECTED'];
                    // if($a1['acd_year_id'] == $acd_year_id){
                    $voucher_detail_array[$a1['USERID']]['PROS_SERVICE_CHARGE_COLLECTED'] += $a1['SERVICE_CHARGE_COLLECTED'];
                    // }
                }
                // if ($a1['USERID'] == $logged_user) {
                //     $voucher_detail_array[$a1['USERID']]['SERVICE_CHARGE_COLLECTED'] = $ser_amount1;
                //     $voucher_detail_array[$a1['USERID']]['PROS_SERVICE_CHARGE_COLLECTED'] = $ser_pros_fee1;
                // }
            }
            // return $voucher_detail_array;
            // $surcharge_amount = $ser_amount + $ser_pros_fee;
            if (is_array($rndoff) && !empty($rndoff)) {
                foreach ($rndoff as $a2) {
                    $voucher_detail_array[$a2['USERID']]['ROUNDOFF_COLLECTED'] = $a2['ROUNDOFF_COLLECTED'];
                }
            }

            if (is_array($vatamt) && !empty($vatamt)) {
                foreach ($vatamt as $a3) {
                    $voucher_detail_array[$a3['USERID']]['VAT_COLLECTED'] = $a3['VAT_COLLECTED'];
                }
            }
            if (is_array($concamt) && !empty($concamt)) {
                foreach ($concamt as $a4) {
                    $voucher_detail_array[$a4['USERID']]['CONC_COLLECTED'] = $a4['CONC_COLLECTED'];
                }
            }
            if (is_array($st_concamt) && !empty($st_concamt)) {
                foreach ($st_concamt as $a4s) {
                    $voucher_detail_array[$a4s['USERID']]['ST_CONC_COLLECTED'] = $a4s['ST_CONC_COLLECTED'];
                }
            }
            if (is_array($expnamt) && !empty($expnamt)) {
                foreach ($expnamt as $a5) {
                    $voucher_detail_array[$a5['USERID']]['EXPN_COLLECTED'] = $a5['EXPN_COLLECTED'];
                }
            }
            if (is_array($cnramt) && !empty($cnramt)) {
                foreach ($cnramt as $a6) {
                    $voucher_detail_array[$a6['USERID']]['CNRA_COLLECTED'] = $a6['CNRA_COLLECTED'];
                }
            }
            if (is_array($pbkamt) && !empty($pbkamt)) {
                foreach ($pbkamt as $a7) {
                    $voucher_detail_array[$a7['USERID']]['PBK_COLLECTED'] = $a7['PBK_COLLECTED'];
                }
            }
            if (is_array($pnltyamt) && !empty($pnltyamt)) {
                foreach ($pnltyamt as $a8) {
                    if ($a8['payment_mode_id'] == 5) {
                        $voucher_detail_array[$a8['USERID']]['TR_PENALTY_COLLECTED'] += $a8['PENALTY_COLLECTED'];
                    } else {
                        $voucher_detail_array[$a8['USERID']]['PENALTY_COLLECTED'] += $a8['PENALTY_COLLECTED'];
                    }

                    // $voucher_detail_array[$a8['USERID']]['PENALTY_COLLECTED'] = $nr_penalty;
                    // $voucher_detail_array[$a8['USERID']]['TR_PENALTY_COLLECTED'] = $tr_penalty;
                }
            }
            // $surcharge_amount = $ser_amount + $ser_pros_fee;
            // return $voucher_detail_array;
            if ($user_wise_report == 1) {
                if (array_key_exists($logged_user, $voucher_detail_array)) {
                    $ser_amount = $voucher_detail_array[$logged_user]['SERVICE_CHARGE_COLLECTED'];
                    $ser_pros_fee = $voucher_detail_array[$logged_user]['PROS_SERVICE_CHARGE_COLLECTED'];
                    $roundoff_amount = $voucher_detail_array[$logged_user]['ROUNDOFF_COLLECTED'];
                    $vat_amount = $voucher_detail_array[$logged_user]['VAT_COLLECTED'];
                    $concession_amount = $voucher_detail_array[$logged_user]['CONC_COLLECTED'];
                    $st_concession_amount = $voucher_detail_array[$logged_user]['ST_CONC_COLLECTED'];
                    $exemption_amount = $voucher_detail_array[$logged_user]['EXPN_COLLECTED'];
                    $cnr_amount = $voucher_detail_array[$logged_user]['CNRA_COLLECTED'];
                    $approved_pbtamt = $voucher_detail_array[$logged_user]['PBK_COLLECTED'];
                    // $penaltyamt = $voucher_detail_array[$logged_user]['PENALTY_COLLECTED'];
                    $nr_penalty = $voucher_detail_array[$logged_user]['PENALTY_COLLECTED'];
                    $tr_penalty = $voucher_detail_array[$logged_user]['TR_PENALTY_COLLECTED'];
                } else {
                    // $surcharge_amount = 0;
                    $ser_amount = 0;
                    $ser_pros_fee = 0;
                    $roundoff_amount = 0;
                    $vat_amount = 0;
                    $concession_amount = 0;
                    $st_concession_amount = 0;
                    $exemption_amount = 0;
                    $cnr_amount = 0;
                    $approved_pbtamt = 0;
                    // $penaltyamt = 0;
                    $nr_penalty = 0;
                    $tr_penalty = 0;
                }
            } else {
                foreach ($voucher_detail_array as $kkey => $valuee) {
                    // $surcharge_amount += ($valuee['SERVICE_CHARGE_COLLECTED']);
                    $ser_amount += $valuee['SERVICE_CHARGE_COLLECTED'];
                    $ser_pros_fee += $valuee['PROS_SERVICE_CHARGE_COLLECTED'];
                    $roundoff_amount += $valuee['ROUNDOFF_COLLECTED'];
                    $vat_amount += $valuee['VAT_COLLECTED'];
                    $concession_amount += $valuee['CONC_COLLECTED'];
                    $st_concession_amount += $valuee['ST_CONC_COLLECTED'];
                    $exemption_amount += $valuee['EXPN_COLLECTED'];
                    $cnr_amount += $valuee['CNRA_COLLECTED'];
                    $approved_pbtamt += $valuee['PBK_COLLECTED'];
                    $nr_penalty += $valuee['PENALTY_COLLECTED'];
                    $tr_penalty += $valuee['TR_PENALTY_COLLECTED'];
                    // $penaltyamt += $valuee['PENALTY_COLLECTED'];
                }
            }
        } else {
            // $surcharge_amount = 0;
            $ser_amount = 0;
            $ser_pros_fee = 0;
            $roundoff_amount = 0;
            $vat_amount = 0;
            $concession_amount = 0;
            $st_concession_amount = 0;
            $exemption_amount = 0;
            $cnr_amount = 0;
            $approved_pbtamt = 0;
            // $penaltyamt = 0;
            $nr_penalty = 0;
            $tr_penalty = 0;
        }
        // return $ser_pros_fee;

        $primary_fee_code_data = $this->MReport->get_all_feecodes_available($apikey, $inst_id);
        $primary_fee_code_data[] = array(
            'feeCode' => 'OTH',
            'fee_shortcode' => 'OTH',
            'description' => 'OTHERS'
        );
        // return $primary_fee_code_data;

        $fine_formatted_data = array();
        $ndmd_array = array();
        $remove_array = array();
        foreach ($report_data as $rd) {
            foreach ($primary_fee_code_data as $feescode) {
                $fine_formatted_data[$rd['voucher_code']]['student_details'] = array(
                    'Admn_No' => $rd['Admn_No'],
                    'First_Name' => $rd['First_Name'],
                    'voucher_code' => $rd['voucher_code'],
                    'trans_type' => strtoupper($rd['trans_type'])
                );
                if ($feescode['feeCode'] == $rd['feeCode']) {
                    if ($feescode['demandType'] == 2 && $feescode['editable'] == 1) {
                        $ndmd_array[$rd['voucher_code']]['student_details'] = array(
                            'Admn_No' => $rd['Admn_No'],
                            'First_Name' => $rd['First_Name'],
                            'voucher_code' => $rd['voucher_code'],
                            'trans_type' => strtoupper($rd['trans_type'])
                        );
                    }
                    if ($feescode['demandType'] == 1) {
                        if ($rd['is_penalty'] == 0) {
                            $fine_formatted_data[$rd['voucher_code']]['fee_details'][$feescode['feeCode']] = array(
                                'feeCode' => $rd['feeCode'],
                                'fee_code_description' => $rd['fee_code_description'],
                                'amt_paid' => $rd['amt_paid'],
                                'trans_type' => strtoupper($rd['trans_type'])
                            );
                        }
                        if (isset($rd['vat_paid']) && $rd['vat_paid'] > 0) {
                            if (isset($fine_formatted_data[$rd['voucher_code']]['fee_details']['F103'])) {
                                $fine_formatted_data[$rd['voucher_code']]['fee_details']['F103']['amt_paid'] += $rd['vat_paid'];
                            } else {
                                $fine_formatted_data[$rd['voucher_code']]['fee_details']['F103'] = array(
                                    'feeCode' => 'F103',
                                    'fee_code_description' => 'TAX-VAT',
                                    'amt_paid' => $rd['vat_paid'],
                                    'trans_type' => strtoupper($rd['trans_type'])
                                );
                            }
                        }
                        if (isset($rd['ser_charge']) && $rd['ser_charge'] > 0) {
                            $fine_formatted_data[$rd['voucher_code']]['fee_details']['F025'] = array(
                                'feeCode' => 'F025',
                                'fee_code_description' => 'SERVICE CHARGE',
                                'amt_paid' => $rd['ser_charge'],
                                'trans_type' => strtoupper($rd['trans_type'])
                            );
                        }
                        if (isset($rd['round_off'])) { //&& $rd['round_off'] > 0
                            $fine_formatted_data[$rd['voucher_code']]['fee_details']['F102'] = array(
                                'feeCode' => 'F102',
                                'fee_code_description' => 'ROUND OFF',
                                'amt_paid' => $rd['round_off'],
                                'trans_type' => strtoupper($rd['trans_type'])
                            );
                        }
                        if (isset($rd['penalty_paid']) && $rd['penalty_paid'] > 0) {
                            if (isset($fine_formatted_data[$rd['voucher_code']]['fee_details']['F104'])) {
                                $fine_formatted_data[$rd['voucher_code']]['fee_details']['F104']['amt_paid'] += $rd['penalty_paid'];
                            } else {
                                $fine_formatted_data[$rd['voucher_code']]['fee_details']['F104'] = array(
                                    'feeCode' => 'F104',
                                    'fee_code_description' => 'PENALTY',
                                    'amt_paid' => $rd['penalty_paid'],
                                    'trans_type' => strtoupper($rd['trans_type'])
                                );
                            }
                        }
                    } else {
                        if ($feescode['demandType'] == 2 && $feescode['editable'] == 1) {
                            $ndmd_array[$rd['voucher_code']]['fee_details'][$feescode['feeCode']] = array(
                                'feeCode' => $rd['feeCode'],
                                'fee_code_description' => $rd['fee_code_description'],
                                'amt_paid' => $rd['amt_paid'],
                                'trans_type' => strtoupper($rd['trans_type'])
                            );
                            if ($rd['is_penalty'] == 0) {
                                if (isset($fine_formatted_data[$rd['voucher_code']]['fee_details']['OTH'])) {
                                    $fine_formatted_data[$rd['voucher_code']]['fee_details']['OTH']['amt_paid'] += $rd['amt_paid'];
                                } else {
                                    $fine_formatted_data[$rd['voucher_code']]['fee_details']['OTH'] = array(
                                        'feeCode' => 'OTH',
                                        'fee_code_description' => 'OTHERS',
                                        'amt_paid' => $rd['amt_paid'],
                                        'trans_type' => strtoupper($rd['trans_type'])
                                    );
                                }
                            }

                            if (isset($rd['vat_paid']) && $rd['vat_paid'] > 0) {
                                $ndmd_array[$rd['voucher_code']]['fee_details']['F103'] = array(
                                    'feeCode' => 'F103',
                                    'fee_code_description' => 'TAX-VAT',
                                    'amt_paid' => $rd['vat_paid'],
                                    'trans_type' => strtoupper($rd['trans_type'])
                                );
                                if (isset($fine_formatted_data[$rd['voucher_code']]['fee_details']['F103'])) {
                                    $fine_formatted_data[$rd['voucher_code']]['fee_details']['F103']['amt_paid'] += $rd['vat_paid'];
                                } else {
                                    $fine_formatted_data[$rd['voucher_code']]['fee_details']['F103'] = array(
                                        'feeCode' => 'F103',
                                        'fee_code_description' => 'TAX-VAT',
                                        'amt_paid' => $rd['vat_paid'],
                                        'trans_type' => strtoupper($rd['trans_type'])
                                    );
                                }
                            }
                            if (isset($rd['ser_charge']) && $rd['ser_charge'] > 0) {
                                $ndmd_array[$rd['voucher_code']]['fee_details']['F025'] = array(
                                    'feeCode' => 'F025',
                                    'fee_code_description' => 'SERVICE CHARGE',
                                    'amt_paid' => $rd['ser_charge'],
                                    'trans_type' => strtoupper($rd['trans_type'])
                                );
                                $fine_formatted_data[$rd['voucher_code']]['fee_details']['F025'] = array(
                                    'feeCode' => 'F025',
                                    'fee_code_description' => 'SERVICE CHARGE',
                                    'amt_paid' => $rd['ser_charge'],
                                    'trans_type' => strtoupper($rd['trans_type'])
                                );
                            }
                            if (isset($rd['round_off'])) { //&& $rd['round_off'] > 0
                                $ndmd_array[$rd['voucher_code']]['fee_details']['F102'] = array(
                                    'feeCode' => 'F102',
                                    'fee_code_description' => 'ROUND OFF',
                                    'amt_paid' => $rd['round_off'],
                                    'trans_type' => strtoupper($rd['trans_type'])
                                );
                                $fine_formatted_data[$rd['voucher_code']]['fee_details']['F102'] = array(
                                    'feeCode' => 'F102',
                                    'fee_code_description' => 'ROUND OFF',
                                    'amt_paid' => $rd['round_off'],
                                    'trans_type' => strtoupper($rd['trans_type'])
                                );
                            }
                            if (isset($rd['penalty_paid']) && $rd['penalty_paid'] > 0) {
                                $ndmd_array[$rd['voucher_code']]['fee_details']['F104'] = array(
                                    'feeCode' => 'F104',
                                    'fee_code_description' => 'PENALTY',
                                    'amt_paid' => $rd['penalty_paid'],
                                    'trans_type' => strtoupper($rd['trans_type'])
                                );
                                // if (isset($fine_formatted_data[$rd['voucher_code']]['fee_details']['F104'])) {
                                //     $fine_formatted_data[$rd['voucher_code']]['fee_details']['F104']['amt_paid'] += $rd['penalty_paid'];
                                // } else {
                                $fine_formatted_data[$rd['voucher_code']]['fee_details']['F104'] = array(
                                    'feeCode' => 'F104',
                                    'fee_code_description' => 'PENALTY',
                                    'amt_paid' => $rd['penalty_paid'],
                                    'trans_type' => strtoupper($rd['trans_type'])
                                );
                                // }
                            }
                        } else {
                            if ($rd['is_penalty'] == 0) {
                                $fine_formatted_data[$rd['voucher_code']]['fee_details'][$feescode['feeCode']] = array(
                                    'feeCode' => $rd['feeCode'],
                                    'fee_code_description' => $rd['fee_code_description'],
                                    'amt_paid' => $rd['amt_paid'],
                                    'trans_type' => strtoupper($rd['trans_type'])
                                );
                            }
                            if (isset($rd['ser_charge']) && $rd['ser_charge'] > 0) {
                                $fine_formatted_data[$rd['voucher_code']]['fee_details']['F025'] = array(
                                    'feeCode' => 'F025',
                                    'fee_code_description' => 'SERVICE CHARGE',
                                    'amt_paid' => $rd['ser_charge'],
                                    'trans_type' => strtoupper($rd['trans_type'])
                                );
                            }
                        }
                    }
                }
                // else {
                //     if (!(isset($fine_formatted_data[$rd['voucher_code']][$feescode['feeCode']]))) {
                //         $fine_formatted_data[$rd['voucher_code']]['fee_details'][$feescode['feeCode']] = array(
                //             'feeCode' => $feescode['feeCode'],
                //             'fee_code_description' => $feescode['description'],
                //             'amt_paid' => 0,
                //             'trans_type' => strtoupper($rd['trans_type'])
                //         );
                //     }
                // }
            }
        }
        // return $fine_formatted_data;
        $feecodearray = array();
        $minisummarray = array();
        $totsummarray = array();
        $cashtotal = 0;
        $cardtotal = 0;
        $chequetotal = 0;
        $onlinetotal = 0;
        $transfertotal = 0;
        $transfertotal_p = 0;
        $gttotal = 0;
        $ggtotal = 0;
        $tcashtotal = 0;
        $tcardtotal = 0;
        $tchequetotal = 0;
        $tonlinetotal = 0;
        $ttransfertotal = 0;

        $ttotal = 0;
        $gtotal = 0;
        $ttotal_o = 0;
        $ttotal_nd = 0;
        //  return $report_data;

        //Format Array as Daily Total
        $voucher_same = 0;
        $rndoff_array = array();
        foreach ($report_data as $rd) {
            $feecodearray[$rd['feeCode']]['total'] = 0;
            foreach ($primary_fee_code_data as $feescode) {
                if ($feescode['feeCode'] == $rd['feeCode']) {
                    if ($feescode['demandType'] == 1) {
                        if ($rd['trans_type'] == 'C') {
                            if ($rd['is_penalty'] == 0) {
                                if (isset($feecodearray[$rd['feeCode']]['cash'])) {
                                    $feecodearray[$rd['feeCode']]['cash']       += $rd['amt_paid'];
                                    $cashtotal =  $feecodearray[$rd['feeCode']]['cash'];
                                } else {
                                    $feecodearray[$rd['feeCode']]['cash']       = $rd['amt_paid'];
                                    $cashtotal =  $feecodearray[$rd['feeCode']]['cash'];
                                }
                            }
                            if (isset($rd['vat_paid']) && $rd['vat_paid'] > 0) {
                                $feecodearray['F103']['cash']       += $rd['vat_paid'];
                                $vatt_total_c = $feecodearray['F103']['cash'];
                            }
                            if (isset($rd['round_off'])) { // && $rd['is_penalty'] == 0 && $rd['round_off'] > 0
                                if (!isset($rndoff_array[$rd['master_id']])) {
                                    $feecodearray['F102']['cash']       += $rd['round_off'];
                                    $roundoff_total_c = $feecodearray['F102']['cash'];
                                }
                            }
                            if (isset($rd['penalty_paid']) && $rd['penalty_paid'] > 0) {
                                $feecodearray['F104']['cash']       += $rd['penalty_paid'];
                                $penalty_total_c = $feecodearray['F104']['cash'];
                            }
                            $ttotal += $cashtotal; //($cashtotal + $vatt_total + $roundoff_total);
                            //$feecodearray[$rd['feeCode']]['total']   = $ttotal;
                            // $feecodearray['F103']['total']   += $vatt_total;
                            // $feecodearray['F102']['total']   += $roundoff_total;
                        } else if ($rd['trans_type'] == 'D') {
                            if ($rd['is_penalty'] == 0) {
                                if (isset($feecodearray[$rd['feeCode']]['dbt'])) {
                                    $feecodearray[$rd['feeCode']]['dbt']       += $rd['amt_paid'];
                                    $dbttotal =  $feecodearray[$rd['feeCode']]['dbt'];
                                } else {
                                    $feecodearray[$rd['feeCode']]['dbt']       = $rd['amt_paid'];
                                    $dbttotal =  $feecodearray[$rd['feeCode']]['dbt'];
                                }
                            }
                            if (isset($rd['vat_paid']) && $rd['vat_paid'] > 0) {
                                $feecodearray['F103']['dbt']       += $rd['vat_paid'];
                                $vatt_total_d = $feecodearray['F103']['dbt'];
                            }
                            // if (isset($rd['round_off'])) { // && $rd['is_penalty'] == 0&& $rd['round_off'] > 0
                            //     $feecodearray['F102']['dbt']       += $rndoff_array[$rd['master_id']];
                            //     $roundoff_total_d = $feecodearray['F102']['dbt'];
                            // }
                            if (isset($rd['round_off'])) { // && $rd['is_penalty'] == 0 && $rd['round_off'] > 0
                                if (!isset($rndoff_array[$rd['master_id']])) {
                                    $feecodearray['F102']['dbt']       += $rd['round_off'];
                                    $roundoff_total_d = $feecodearray['F102']['dbt'];
                                }
                            }
                            if (isset($rd['penalty_paid']) && $rd['penalty_paid'] > 0) {
                                $feecodearray['F104']['dbt']       += $rd['penalty_paid'];
                                $penalty_total_d = $feecodearray['F104']['dbt'];
                            }
                            $ttotal += $dbttotal; //($dbttotal + $vatt_total + $roundoff_total);
                            //$feecodearray[$rd['feeCode']]['total']   = $ttotal;
                            // $feecodearray['F103']['total']   += $vatt_total;
                            // $feecodearray['F102']['total']   += $roundoff_total;
                        } else if ($rd['trans_type'] == 'Q') {
                            if ($rd['is_penalty'] == 0) {
                                if (isset($feecodearray[$rd['feeCode']]['cheque'])) {
                                    $feecodearray[$rd['feeCode']]['cheque']       += $rd['amt_paid'];
                                    $chequetotal =  $feecodearray[$rd['feeCode']]['cheque'];
                                } else {
                                    $feecodearray[$rd['feeCode']]['cheque']       = $rd['amt_paid'];
                                    $chequetotal =  $feecodearray[$rd['feeCode']]['cheque'];
                                }
                            }
                            if (isset($rd['vat_paid']) && $rd['vat_paid'] > 0) {
                                $feecodearray['F103']['cheque']       += $rd['vat_paid'];
                                $vatt_total_q = $feecodearray['F103']['cheque'];
                            }
                            // if (isset($rd['round_off'])) { // && $rd['is_penalty'] == 0&& $rd['round_off'] > 0
                            //     $feecodearray['F102']['cheque']       += $rndoff_array[$rd['master_id']];
                            //     $roundoff_total_q = $feecodearray['F102']['cheque'];
                            // }
                            if (isset($rd['round_off'])) { // && $rd['is_penalty'] == 0 && $rd['round_off'] > 0
                                if (!isset($rndoff_array[$rd['master_id']])) {
                                    $feecodearray['F102']['cheque']       += $rd['round_off'];
                                    $roundoff_total_q = $feecodearray['F102']['cheque'];
                                }
                            }
                            if (isset($rd['penalty_paid']) && $rd['penalty_paid'] > 0) {
                                $feecodearray['F104']['cheque']       += $rd['penalty_paid'];
                                $penalty_total_q = $feecodearray['F104']['cheque'];
                            }
                            $ttotal += $chequetotal; //($chequetotal + $vatt_total + $roundoff_total);
                            //$feecodearray[$rd['feeCode']]['total']   = $ttotal;
                            // $feecodearray['F103']['total']   += $vatt_total;
                            // $feecodearray['F102']['total']   += $roundoff_total;
                        } else if ($rd['trans_type'] == 'R') {
                            if ($rd['is_penalty'] == 0) {
                                if (isset($feecodearray[$rd['feeCode']]['card'])) {
                                    $feecodearray[$rd['feeCode']]['card']       += $rd['amt_paid'];
                                    $cardtotal =  $feecodearray[$rd['feeCode']]['card'];
                                } else {
                                    $feecodearray[$rd['feeCode']]['card']       = $rd['amt_paid'];
                                    $cardtotal =  $feecodearray[$rd['feeCode']]['card'];
                                }
                            }
                            if (isset($rd['ser_charge']) && $rd['ser_charge'] > 0) {
                                // $feecodearray['F025']['card']       += $rd['ser_charge'];
                                $feecodearray['F025']['card']       = $ser_amount;
                                $serchg_total_r = $feecodearray['F025']['card'];
                            }
                            if (isset($rd['vat_paid']) && $rd['vat_paid'] > 0) {
                                $feecodearray['F103']['card']       += $rd['vat_paid'];
                                $vatt_total_r = $feecodearray['F103']['card'];
                            }
                            // if (isset($rd['round_off'])) { // && $rd['is_penalty'] == 0 && $rd['round_off'] > 0
                            //     $feecodearray['F102']['card']       += $rndoff_array[$rd['master_id']];
                            //     $roundoff_total_r = $feecodearray['F102']['card'];
                            // }
                            if (isset($rd['round_off'])) { // && $rd['is_penalty'] == 0 && $rd['round_off'] > 0
                                if (!isset($rndoff_array[$rd['master_id']])) {
                                    $feecodearray['F102']['card']       += $rd['round_off'];
                                    $roundoff_total_r = $feecodearray['F102']['card'];
                                }
                            }
                            if (isset($rd['penalty_paid']) && $rd['penalty_paid'] > 0) {
                                $feecodearray['F104']['card']       += $rd['penalty_paid'];
                                $penalty_total_r = $feecodearray['F104']['card'];
                            }
                            $ttotal += $cardtotal; //($cardtotal + $vatt_total + $roundoff_total + $serchg_total);
                            //$feecodearray[$rd['feeCode']]['total']   = $ttotal;
                            // $feecodearray['F025']['total']   += $serchg_total;
                            // $feecodearray['F103']['total']   += $vatt_total;
                            // $feecodearray['F102']['total']   += $roundoff_total;
                        } else if ($rd['trans_type'] == 'O') {
                            if ($rd['is_penalty'] == 0) {
                                if (isset($feecodearray[$rd['feeCode']]['online'])) {
                                    $feecodearray[$rd['feeCode']]['online']       += $rd['amt_paid'];
                                    $onlinetotal =  $feecodearray[$rd['feeCode']]['online'];
                                } else {
                                    $feecodearray[$rd['feeCode']]['online']       = $rd['amt_paid'];
                                    $onlinetotal =  $feecodearray[$rd['feeCode']]['online'];
                                }
                            }
                            if (isset($rd['vat_paid']) && $rd['vat_paid'] > 0) {
                                $feecodearray['F103']['online']       += $rd['vat_paid'];
                                $vatt_total_on = $feecodearray['F103']['online'];
                            }
                            // if (isset($rd['round_off'])) { // && $rd['is_penalty'] == 0 && $rd['round_off'] > 0
                            //     $feecodearray['F102']['online']       += $rndoff_array[$rd['master_id']];
                            //     $roundoff_total_on = $feecodearray['F102']['online'];
                            // }
                            if (isset($rd['round_off'])) { // && $rd['is_penalty'] == 0 && $rd['round_off'] > 0
                                if (!isset($rndoff_array[$rd['master_id']])) {
                                    $feecodearray['F102']['online']       += $rd['round_off'];
                                    $roundoff_total_on = $feecodearray['F102']['online'];
                                }
                            }
                            if (isset($rd['penalty_paid']) && $rd['penalty_paid'] > 0) {
                                $feecodearray['F104']['online']       += $rd['penalty_paid'];
                                $penalty_total_on = $feecodearray['F104']['online'];
                            }
                            $ttotal += $onlinetotal; //($cashtotal + $vatt_total + $roundoff_total);
                            //$feecodearray[$rd['feeCode']]['total']   = $ttotal;
                            // $feecodearray['F103']['total']   += $vatt_total;
                            // $feecodearray['F102']['total']   += $roundoff_total;
                        } else if ($rd['trans_type'] == 'T' && $rd['is_others'] == 0) {
                            if ($rd['is_penalty'] == 0) {
                                if (isset($feecodearray[$rd['feeCode']]['transfer'])) {
                                    $feecodearray[$rd['feeCode']]['transfer']       += $rd['amt_paid'];
                                    $feecodearray[$rd['feeCode']]['transfer_p']     += $rd['amt_paid'];
                                    $transfertotal =  $feecodearray[$rd['feeCode']]['transfer'];
                                    $transfertotal_p =  $feecodearray[$rd['feeCode']]['transfer_p'];
                                } else {
                                    $feecodearray[$rd['feeCode']]['transfer']       = $rd['amt_paid'];
                                    $feecodearray[$rd['feeCode']]['transfer_p']     = $rd['amt_paid'];
                                    $transfertotal =  $feecodearray[$rd['feeCode']]['transfer'];
                                    $transfertotal_p =  $feecodearray[$rd['feeCode']]['transfer_p'];
                                }
                            }
                            if (isset($rd['vat_paid']) && $rd['vat_paid'] > 0) {
                                $feecodearray['F103']['transfer']       += $rd['vat_paid'];
                                $feecodearray['F103']['transfer_p']     += $rd['vat_paid'];
                                $vatt_total = $feecodearray['F103']['transfer'];
                                $vatt_total_p = $feecodearray['F103']['transfer_p'];
                            }
                            if (isset($rd['round_off'])) { // && $rd['is_penalty'] == 0&& $rd['round_off'] > 0
                                $feecodearray['F102']['transfer']       += $rndoff_array[$rd['master_id']];
                                $feecodearray['F102']['transfer_p']     += $rndoff_array[$rd['master_id']];
                                $roundoff_total = $feecodearray['F102']['transfer'];
                                $roundoff_total_p = $feecodearray['F102']['transfer_p'];
                            }
                            if ($rd['is_penalty'] == 1) {
                                if (isset($rd['penalty_paid']) && $rd['penalty_paid'] > 0) {
                                    $feecodearray['F104']['transfer']       += $rd['penalty_paid'];
                                    $feecodearray['F104']['transfer_p']     += $rd['penalty_paid'];
                                    $penalty_total = $feecodearray['F104']['transfer'];
                                    $penalty_total_p = $feecodearray['F104']['transfer_p'];
                                }
                            }
                            $ttotal += $transfertotal_p;
                            //$ttotal = $transfertotal;
                            // $feecodearray['F103']['total']   += $vatt_total_p;
                            // $feecodearray['F102']['total']   += $roundoff_total_p;
                        }
                        // $feecodearray['F025']['card'] = $surcharge_amount;
                        // $feecodearray[$rd['feeCode']]['total'] = $cashtotal + $chequetotal + $cardtotal + $onlinetotal + $transfertotal_p + $dbttotal;
                        $feecodearray[$rd['feeCode']]['total'] = $feecodearray[$rd['feeCode']]['cash'] + $feecodearray[$rd['feeCode']]['cheque'] + $feecodearray[$rd['feeCode']]['card'] + $feecodearray[$rd['feeCode']]['online'] + $feecodearray[$rd['feeCode']]['transfer_p'] + $feecodearray[$rd['feeCode']]['dbt'];
                        $feecodearray['F103']['total'] = $vatt_total_c + $vatt_total_d + $vatt_total_q + $vatt_total_r + $vatt_total_p + $vatt_total_on;
                        $feecodearray['F025']['total'] = $ser_amount; //$serchg_total_r;
                        // $feecodearray['F102']['total'] = $roundoff_amount;//$roundoff_total_c + $roundoff_total_d + $roundoff_total_q + $roundoff_total_r + $roundoff_total_p + $roundoff_total_on;
                        $feecodearray['F104']['total'] = $nr_penalty + $tr_penalty; //$penalty_total_c + $penalty_total_d + $penalty_total_q + $penalty_total_r + $penalty_total_p;
                    } else {
                        if ($feescode['demandType'] == 2 && $feescode['editable'] == 1) {
                            if ($rd['trans_type'] == 'C') {
                                if ($rd['is_penalty'] == 0) {
                                    if (isset($feecodearray['OTH']['cash'])) {
                                        $feecodearray['OTH']['cash']       += $rd['amt_paid'];
                                        $cashtotal_o =  $feecodearray['OTH']['cash'];
                                    } else {
                                        $feecodearray['OTH']['cash']       = $rd['amt_paid'];
                                        $cashtotal_o =  $feecodearray['OTH']['cash'];
                                    }
                                }
                                if (isset($rd['vat_paid']) && $rd['vat_paid'] > 0) {
                                    $feecodearray['F103']['cash']       += $rd['vat_paid'];
                                    $vatt_total_o_c = $feecodearray['F103']['cash'];
                                }
                                // if (isset($rd['round_off'])) { // && $rd['is_penalty'] == 0&& $rd['round_off'] > 0
                                //     $feecodearray['F102']['cash']       += $rndoff_array[$rd['master_id']];
                                //     $roundoff_total_o_c = $feecodearray['F102']['cash'];
                                // }
                                if (isset($rd['round_off'])) { // && $rd['is_penalty'] == 0 && $rd['round_off'] > 0
                                    if (!isset($rndoff_array[$rd['master_id']])) {
                                        $feecodearray['F102']['cash']       += $rd['round_off'];
                                        $roundoff_total_o_c = $feecodearray['F102']['cash'];
                                    }
                                }
                                if (isset($rd['penalty_paid']) && $rd['penalty_paid'] > 0) {
                                    $feecodearray['F104']['cash']       += $rd['penalty_paid'];
                                    $penalty_total_o_c = $feecodearray['F104']['cash'];
                                }
                                $ttotal_o += $cashtotal_o; //($cashtotal + $vatt_total + $roundoff_total);
                                //$feecodearray['OTH']['total']   = $ttotal_o;
                            } else if ($rd['trans_type'] == 'D') {
                                if ($rd['is_penalty'] == 0) {
                                    if (isset($feecodearray['OTH']['dbt'])) {
                                        $feecodearray['OTH']['dbt']       += $rd['amt_paid'];
                                        $dbttotal_o =  $feecodearray['OTH']['dbt'];
                                    } else {
                                        $feecodearray['OTH']['dbt']       = $rd['amt_paid'];
                                        $dbttotal_o =  $feecodearray['OTH']['dbt'];
                                    }
                                }
                                if (isset($rd['vat_paid']) && $rd['vat_paid'] > 0) {
                                    $feecodearray['F103']['dbt']       += $rd['vat_paid'];
                                    $vatt_total_o_d = $feecodearray['F103']['dbt'];
                                }
                                // if (isset($rd['round_off'])) { // && $rd['is_penalty'] == 0&& $rd['round_off'] > 0
                                //     $feecodearray['F102']['dbt']       += $rndoff_array[$rd['master_id']];
                                //     $roundoff_total_o_d = $feecodearray['F102']['dbt'];
                                // }
                                if (isset($rd['round_off'])) { // && $rd['is_penalty'] == 0 && $rd['round_off'] > 0
                                    if (!isset($rndoff_array[$rd['master_id']])) {
                                        $feecodearray['F102']['dbt']       += $rd['round_off'];
                                        $roundoff_total_o_d = $feecodearray['F102']['dbt'];
                                    }
                                }
                                if (isset($rd['penalty_paid']) && $rd['penalty_paid'] > 0) {
                                    $feecodearray['F104']['dbt']       += $rd['penalty_paid'];
                                    $penalty_total_o_d = $feecodearray['F104']['dbt'];
                                }
                                $ttotal_o += $dbttotal_o; //($dbttotal + $vatt_total + $roundoff_total);
                                //$feecodearray['OTH']['total']   = $ttotal_o;
                            } else if ($rd['trans_type'] == 'Q') {
                                if ($rd['is_penalty'] == 0) {
                                    if (isset($feecodearray['OTH']['cheque'])) {
                                        $feecodearray['OTH']['cheque']       += $rd['amt_paid'];
                                        $chequetotal_o =  $feecodearray['OTH']['cheque'];
                                    } else {
                                        $feecodearray['OTH']['cheque']       = $rd['amt_paid'];
                                        $chequetotal_o =  $feecodearray['OTH']['cheque'];
                                    }
                                }
                                if (isset($rd['vat_paid']) && $rd['vat_paid'] > 0) {
                                    $feecodearray['F103']['cheque']       += $rd['vat_paid'];
                                    $vatt_total_o_q = $feecodearray['F103']['cheque'];
                                }
                                // if (isset($rd['round_off'])) { // && $rd['is_penalty'] == 0&& $rd['round_off'] > 0
                                //     $feecodearray['F102']['cheque']       += $rndoff_array[$rd['master_id']];
                                //     $roundoff_total_o_q = $feecodearray['F102']['cheque'];
                                // }
                                if (isset($rd['round_off'])) { // && $rd['is_penalty'] == 0 && $rd['round_off'] > 0
                                    if (!isset($rndoff_array[$rd['master_id']])) {
                                        $feecodearray['F102']['cheque']       += $rd['round_off'];
                                        $roundoff_total_o_q = $feecodearray['F102']['cheque'];
                                    }
                                }
                                if (isset($rd['penalty_paid']) && $rd['penalty_paid'] > 0) {
                                    $feecodearray['F104']['cheque']       += $rd['penalty_paid'];
                                    $penalty_total_o_q = $feecodearray['F104']['cheque'];
                                }
                                $ttotal_o += $chequetotal_o; //($chequetotal + $vatt_total + $roundoff_total);
                                //$feecodearray['OTH']['total']   = $ttotal_o;
                                // $feecodearray['F103']['total']   = $vatt_total_o;
                                // $feecodearray['F102']['total']   = $roundoff_total_o;
                            } else if ($rd['trans_type'] == 'R') {
                                if ($rd['is_penalty'] == 0) {
                                    if (isset($feecodearray['OTH']['card'])) {
                                        $feecodearray['OTH']['card']       += $rd['amt_paid'];
                                        $cardtotal_o =  $feecodearray['OTH']['card'];
                                    } else {
                                        $feecodearray['OTH']['card']       = $rd['amt_paid'];
                                        $cardtotal_o =  $feecodearray['OTH']['card'];
                                    }
                                }
                                if (isset($rd['ser_charge']) && $rd['ser_charge'] > 0) {
                                    // $feecodearray['F025']['card']       += $rd['ser_charge'];
                                    $feecodearray['F025']['card']       = $ser_amount;
                                    $serchg_total_o_r = $feecodearray['F025']['card'];
                                }
                                if (isset($rd['vat_paid']) && $rd['vat_paid'] > 0) {
                                    $feecodearray['F103']['card']       += $rd['vat_paid'];
                                    $vatt_total_o_r = $feecodearray['F103']['card'];
                                }
                                // if (isset($rd['round_off'])) { // && $rd['is_penalty'] == 0&& $rd['round_off'] > 0
                                //     $feecodearray['F102']['card']       += $rndoff_array[$rd['master_id']];
                                //     $roundoff_total_o_r = $feecodearray['F102']['card'];
                                // }
                                if (isset($rd['round_off'])) { // && $rd['is_penalty'] == 0 && $rd['round_off'] > 0
                                    if (!isset($rndoff_array[$rd['master_id']])) {
                                        $feecodearray['F102']['card']       += $rd['round_off'];
                                        $roundoff_total_o_r = $feecodearray['F102']['card'];
                                    }
                                }
                                if (isset($rd['penalty_paid']) && $rd['penalty_paid'] > 0) {
                                    $feecodearray['F104']['card']       += $rd['penalty_paid'];
                                    $penalty_total_o_r = $feecodearray['F104']['card'];
                                }
                                $ttotal_o += $cardtotal_o; //($cardtotal + $vatt_total + $roundoff_total + $serchg_total);
                                //$feecodearray['OTH']['total']   = $ttotal_o;
                                // $feecodearray['F025']['total']   = $serchg_total_o;
                                // $feecodearray['F103']['total']   = $vatt_total_o;
                                // $feecodearray['F102']['total']   = $roundoff_total_o;
                            } else if ($rd['trans_type'] == 'O') {
                                if ($rd['is_penalty'] == 0) {
                                    if (isset($feecodearray['OTH']['online'])) {
                                        $feecodearray['OTH']['online']       += $rd['amt_paid'];
                                        $onlinetotal_o =  $feecodearray['OTH']['online'];
                                    } else {
                                        $feecodearray['OTH']['online']       = $rd['amt_paid'];
                                        $onlinetotal_o =  $feecodearray['OTH']['online'];
                                    }
                                }
                                if (isset($rd['vat_paid']) && $rd['vat_paid'] > 0) {
                                    $feecodearray['F103']['online']       += $rd['vat_paid'];
                                    $vatt_total_o_o = $feecodearray['F103']['online'];
                                }
                                // if (isset($rd['round_off'])) { // && $rd['is_penalty'] == 0&& $rd['round_off'] > 0
                                //     $feecodearray['F102']['online']       += $rndoff_array[$rd['master_id']];
                                //     $roundoff_total_o_o = $feecodearray['F102']['online'];
                                // }
                                if (isset($rd['round_off'])) { // && $rd['is_penalty'] == 0 && $rd['round_off'] > 0
                                    if (!isset($rndoff_array[$rd['master_id']])) {
                                        $feecodearray['F102']['online']       += $rd['round_off'];
                                        $roundoff_total_o_o = $feecodearray['F102']['online'];
                                    }
                                }
                                if (isset($rd['penalty_paid']) && $rd['penalty_paid'] > 0) {
                                    $feecodearray['F104']['online']       += $rd['penalty_paid'];
                                    $penalty_total_o_o = $feecodearray['F104']['online'];
                                }
                                $ttotal_o += $onlinetotal_o; //($cashtotal + $vatt_total + $roundoff_total);
                                //$feecodearray['OTH']['total']   = $ttotal_o;
                            } else if ($rd['trans_type'] == 'T' && $rd['is_others'] == 0) {
                                if ($rd['is_penalty'] == 0) {
                                    if (isset($feecodearray['OTH']['transfer'])) {
                                        $feecodearray['OTH']['transfer']       += $rd['amt_paid'];
                                        $feecodearray['OTH']['transfer_p']     += $rd['amt_paid'];
                                        $transfertotal =  $feecodearray['OTH']['transfer'];
                                        $transfertotal_po =  $feecodearray['OTH']['transfer_p'];
                                    } else {
                                        $feecodearray['OTH']['transfer']       = $rd['amt_paid'];
                                        $feecodearray['OTH']['transfer_p']     = $rd['amt_paid'];
                                        $transfertotal =  $feecodearray['OTH']['transfer'];
                                        $transfertotal_po =  $feecodearray['OTH']['transfer_p'];
                                    }
                                }
                                if (isset($rd['vat_paid']) && $rd['vat_paid'] > 0) {
                                    $feecodearray['F103']['transfer']       += $rd['vat_paid'];
                                    $feecodearray['F103']['transfer_p']     += $rd['vat_paid'];
                                    $vatt_total = $feecodearray['F103']['transfer'];
                                    $vatt_total_o_p = $feecodearray['F103']['transfer_p'];
                                }
                                if (isset($rd['round_off'])) { // && $rd['is_penalty'] == 0&& $rd['round_off'] > 0
                                    $feecodearray['F102']['transfer']       += $rndoff_array[$rd['master_id']];
                                    $feecodearray['F102']['transfer_p']     += $rndoff_array[$rd['master_id']];
                                    $roundoff_total = $feecodearray['F102']['transfer'];
                                    $roundoff_total_o_p = $feecodearray['F102']['transfer_p'];
                                }
                                if (isset($rd['penalty_paid']) && $rd['penalty_paid'] > 0) {
                                    $feecodearray['F104']['transfer']       += $rd['penalty_paid'];
                                    $feecodearray['F104']['transfer_p']     += $rd['penalty_paid'];
                                    $penalty_total = $feecodearray['F104']['transfer'];
                                    $penalty_total_o_p = $feecodearray['F104']['transfer_p'];
                                }
                                $ttotal += $transfertotal_p;
                            }
                            // $feecodearray['OTH']['total'] = $cashtotal_o + $dbttotal_o + $chequetotal_o + $cardtotal_o + $onlinetotal_o + $transfertotal_po;
                            $feecodearray['OTH']['total'] = $feecodearray['OTH']['cash'] + $feecodearray['OTH']['dbt'] + $feecodearray['OTH']['cheque'] + $feecodearray['OTH']['card'] + $feecodearray['OTH']['online'] + $feecodearray['OTH']['transfer_p'];
                            $feecodearray['F103']['total'] = ($vatt_total_o_c + $vatt_total_o_d + $vatt_total_o_q + $vatt_total_o_r + $vatt_total_o_p + $vatt_total_o_o);
                            $feecodearray['F025']['total'] = $ser_amount;
                            $feecodearray['F102']['total'] = $roundoff_amount; //$roundoff_total_o_c + $roundoff_total_o_d + $roundoff_total_o_q + $roundoff_total_o_r + $roundoff_total_o_p + $roundoff_total_o_o;
                            $feecodearray['F104']['total'] = $nr_penalty + $tr_penalty; //$penalty_total_o_c + $penalty_total_o_d + $penalty_total_o_q + $penalty_total_o_r + $penalty_total_o_p;
                        } else {
                            if ($rd['trans_type'] == 'C') {
                                if (isset($feecodearray[$rd['feeCode']]['cash'])) {
                                    $feecodearray[$rd['feeCode']]['cash']       += $rd['amt_paid'];
                                    $cashtotal_nd =  $feecodearray[$rd['feeCode']]['cash'];
                                } else {
                                    $feecodearray[$rd['feeCode']]['cash']       = $rd['amt_paid'];
                                    $cashtotal_nd =  $feecodearray[$rd['feeCode']]['cash'];
                                }

                                if (isset($rd['vat_paid']) && $rd['vat_paid'] > 0) {
                                    $feecodearray['F103']['cash']       += $rd['vat_paid'];
                                    $vatt_total_nd = $feecodearray['F103']['cash'];
                                }
                                // if (isset($rd['round_off'])) { // && $rd['is_penalty'] == 0&& $rd['round_off'] > 0
                                //     $feecodearray['F102']['cash']       += $rndoff_array[$rd['master_id']];
                                //     $roundoff_total_nd = $feecodearray['F102']['cash'];
                                // }
                                if (isset($rd['round_off'])) { // && $rd['is_penalty'] == 0 && $rd['round_off'] > 0
                                    if (!isset($rndoff_array[$rd['master_id']])) {
                                        $feecodearray['F102']['cash']       += $rd['round_off'];
                                        $roundoff_total_nd = $feecodearray['F102']['cash'];
                                    }
                                }
                                $ttotal_nd += $cashtotal_nd; //($cashtotal + $vatt_total + $roundoff_total);
                                $feecodearray[$rd['feeCode']]['total']   = $ttotal_nd;
                                $feecodearray['F103']['total']   = $vatt_total_nd;
                                $feecodearray['F102']['total']   = $roundoff_total_nd;
                            }
                            if ($rd['trans_type'] == 'D') {
                                if (isset($feecodearray[$rd['feeCode']]['dbt'])) {
                                    $feecodearray[$rd['feeCode']]['dbt']       += $rd['amt_paid'];
                                    $dbttotal_nd =  $feecodearray[$rd['feeCode']]['dbt'];
                                } else {
                                    $feecodearray[$rd['feeCode']]['dbt']       = $rd['amt_paid'];
                                    $dbttotal_nd =  $feecodearray[$rd['feeCode']]['dbt'];
                                }

                                if (isset($rd['vat_paid']) && $rd['vat_paid'] > 0) {
                                    $feecodearray['F103']['dbt']       += $rd['vat_paid'];
                                    $vatt_total_nd = $feecodearray['F103']['dbt'];
                                }
                                // if (isset($rd['round_off'])) { // && $rd['is_penalty'] == 0&& $rd['round_off'] > 0
                                //     $feecodearray['F102']['dbt']       += $rndoff_array[$rd['master_id']];
                                //     $roundoff_total_nd = $feecodearray['F102']['dbt'];
                                // }
                                if (isset($rd['round_off'])) { // && $rd['is_penalty'] == 0 && $rd['round_off'] > 0
                                    if (!isset($rndoff_array[$rd['master_id']])) {
                                        $feecodearray['F102']['dbt']       += $rd['round_off'];
                                        $roundoff_total_nd = $feecodearray['F102']['dbt'];
                                    }
                                }
                                $ttotal_nd += $dbttotal_nd; //($dbttotal + $vatt_total + $roundoff_total);
                                $feecodearray[$rd['feeCode']]['total']   = $ttotal_nd;
                                $feecodearray['F103']['total']   = $vatt_total_nd;
                                $feecodearray['F102']['total']   = $roundoff_total_nd;
                            }
                            if ($rd['trans_type'] == 'Q') {
                                if (isset($feecodearray[$rd['feeCode']]['cheque'])) {
                                    $feecodearray[$rd['feeCode']]['cheque']       += $rd['amt_paid'];
                                    $chequetotal_nd =  $feecodearray[$rd['feeCode']]['cheque'];
                                } else {
                                    $feecodearray[$rd['feeCode']]['cheque']       = $rd['amt_paid'];
                                    $chequetotal_nd =  $feecodearray[$rd['feeCode']]['cheque'];
                                }

                                if (isset($rd['vat_paid']) && $rd['vat_paid'] > 0) {
                                    $feecodearray['F103']['cheque']       += $rd['vat_paid'];
                                    $vatt_total_nd = $feecodearray['F103']['cheque'];
                                }
                                // if (isset($rd['round_off'])) { // && $rd['is_penalty'] == 0&& $rd['round_off'] > 0
                                //     $feecodearray['F102']['cheque']       += $rndoff_array[$rd['master_id']];
                                //     $roundoff_total_nd = $feecodearray['F102']['cheque'];
                                // }
                                if (isset($rd['round_off'])) { // && $rd['is_penalty'] == 0 && $rd['round_off'] > 0
                                    if (!isset($rndoff_array[$rd['master_id']])) {
                                        $feecodearray['F102']['cheque']       += $rd['round_off'];
                                        $roundoff_total_nd = $feecodearray['F102']['cheque'];
                                    }
                                }
                                $ttotal_nd += $chequetotal_nd; //($chequetotal + $vatt_total + $roundoff_total);
                                $feecodearray[$rd['feeCode']]['total']   = $ttotal_nd;
                                $feecodearray['F103']['total']   = $vatt_total_nd;
                                $feecodearray['F102']['total']   = $roundoff_total_nd;
                            }
                            if ($rd['trans_type'] == 'R') {
                                if (isset($feecodearray[$rd['feeCode']]['card'])) {
                                    $feecodearray[$rd['feeCode']]['card']       += $rd['amt_paid'];
                                    $cardtotal_nd =  $feecodearray[$rd['feeCode']]['card'];
                                } else {
                                    $feecodearray[$rd['feeCode']]['card']       = $rd['amt_paid'];
                                    $cardtotal_nd =  $feecodearray[$rd['feeCode']]['card'];
                                }

                                if (isset($rd['vat_paid']) && $rd['vat_paid'] > 0) {
                                    $feecodearray['F103']['card']       += $rd['vat_paid'];
                                    $vatt_total_nd = $feecodearray['F103']['card'];
                                }
                                // if (isset($rd['round_off'])) { // && $rd['is_penalty'] == 0&& $rd['round_off'] > 0
                                //     $feecodearray['F102']['card']       += $rndoff_array[$rd['master_id']];
                                //     $roundoff_total_nd = $feecodearray['F102']['card'];
                                // }
                                if (isset($rd['round_off'])) { // && $rd['is_penalty'] == 0 && $rd['round_off'] > 0
                                    if (!isset($rndoff_array[$rd['master_id']])) {
                                        $feecodearray['F102']['card']       += $rd['round_off'];
                                        $roundoff_total_nd = $feecodearray['F102']['card'];
                                    }
                                }
                                if (isset($rd['ser_charge']) && $rd['ser_charge'] > 0) {
                                    // $feecodearray['F025']['card']       += $rd['ser_charge'];
                                    $feecodearray['F025']['card']       = $ser_amount;
                                    $serchg_total_nd = $feecodearray['F025']['card'];
                                }
                                $ttotal_nd += $cardtotal_nd; //($cardtotal + $vatt_total + $roundoff_total + $serchg_total);
                                // $feecodearray[$rd['feeCode']]['total']   = $ttotal_nd;
                                // $feecodearray['F025']['total']   = $serchg_total_nd;
                                // $feecodearray['F103']['total']   = $vatt_total_nd;
                                // $feecodearray['F102']['total']   = $roundoff_total_nd;
                            }

                            if ($rd['trans_type'] == 'O') {
                                if (isset($feecodearray[$rd['feeCode']]['online'])) {
                                    $feecodearray[$rd['feeCode']]['online']       += $rd['amt_paid'];
                                    $onlinetotal_nd =  $feecodearray[$rd['feeCode']]['online'];
                                } else {
                                    $feecodearray[$rd['feeCode']]['online']       = $rd['amt_paid'];
                                    $onlinetotal_nd =  $feecodearray[$rd['feeCode']]['online'];
                                }
                                $ttotal_nd += $onlinetotal_nd; //($cashtotal + $vatt_total + $roundoff_total);
                                $feecodearray[$rd['feeCode']]['total']   = $ttotal_nd;
                            }
                            // $onlinetotal_nd = 0; //Should Calculate as above
                            $feecodearray[$rd['feeCode']]['total'] = $cashtotal_nd + $dbttotal_nd + $chequetotal_nd + $cardtotal_nd + $onlinetotal_nd;
                            $feecodearray['F025']['total'] = $ser_amount;
                        }
                    }
                    //$ttotal = $cashtotal + $chequetotal + $cardtotal + $onlinetotal; // + $transfertotal;
                    $gtotal = $ttotal; // - $transfertotal;
                    //$feecodearray[$rd['feeCode']]['total']   = $ttotal;
                    $feecodearray['F025']['total'] = $ser_amount;
                    $feecodearray['F102']['total'] = $roundoff_amount;
                    $feecodearray[$rd['feeCode']]['feetotal']   = $feecodearray[$rd['feeCode']]['total'] - $feecodearray[$rd['feeCode']]['transfer'];
                    $feecodearray['OTH']['feetotal']   = $feecodearray['OTH']['total'] - $feecodearray['OTH']['transfer'];
                    $feecodearray['F025']['feetotal']   = $feecodearray['F025']['total'] - $feecodearray['F025']['transfer'];
                    $feecodearray['F103']['feetotal']   = $feecodearray['F103']['total'] - $feecodearray['F103']['transfer'];
                    $feecodearray['F102']['feetotal']   = $roundoff_amount; //$feecodearray['F102']['total'] - $feecodearray['F102']['transfer'];
                    $feecodearray['F104']['feetotal']   = $feecodearray['F104']['total'] - $feecodearray['F104']['transfer'];
                } else {
                    if (!(isset($feecodearray[$feescode['feeCode']]))) {
                        $feecodearray[$feescode['feeCode']]['cash'] = 0;
                        $feecodearray[$feescode['feeCode']]['dbt'] = 0;
                        $feecodearray[$feescode['feeCode']]['cheque'] = 0;
                        $feecodearray[$feescode['feeCode']]['card'] = 0;
                        $feecodearray[$feescode['feeCode']]['online'] = 0;
                        $feecodearray[$feescode['feeCode']]['transfer_p'] = 0;
                        $feecodearray[$feescode['feeCode']]['transfer'] = 0;
                        $feecodearray[$feescode['feeCode']]['total'] = 0;
                        $feecodearray[$feescode['feeCode']]['feetotal'] = 0;
                    }
                }
            }
            $rndoff_array[$rd['master_id']] = $rd['round_off'];
        }

        // return $feecodearray; //['F103']['total'];
        // Find total in Each Column Above
        foreach ($feecodearray as $key => $value) {
            $tcashtotal += $value['cash'];
            $tdbttotal += $value['dbt'];
            $tchequetotal += $value['cheque'];
            $tcardtotal += $value['card'];
            $tonlinetotal += $value['online'];
            $ttransfertotal += $value['transfer'];
            $ttransfertotal_p += $value['transfer_p'];
            $gttotal += $value['total'];
            $ggtotal += $value['feetotal'];
        }

        $feecodearray['TOTAL']['cash']           =   $tcashtotal;
        $feecodearray['TOTAL']['dbt']            =   $tdbttotal;
        $feecodearray['TOTAL']['cheque']         =   $tchequetotal;
        $feecodearray['TOTAL']['card']           =   $tcardtotal;
        $feecodearray['TOTAL']['online']         =   $tonlinetotal;
        $feecodearray['TOTAL']['transfer_p']     =   $ttransfertotal_p;
        $feecodearray['TOTAL']['transfer']       =   $ttransfertotal;
        $feecodearray['TOTAL']['total']          =   $gttotal;
        $feecodearray['TOTAL']['feetotal']       =   $gttotal - $ttransfertotal; //'-'; //$ggtotal + $ttransfertotal;

        $feecodearray['TRANSTYPES']['cash']       =   'Cash';
        $feecodearray['TRANSTYPES']['dbt']        =   'Direct Bank';
        $feecodearray['TRANSTYPES']['cheque']     =   'Cheque';
        $feecodearray['TRANSTYPES']['card']       =   'Card';
        $feecodearray['TRANSTYPES']['online']     =   'Online';
        $feecodearray['TRANSTYPES']['transfer_p'] =   'Transfer (+)';
        $feecodearray['TRANSTYPES']['total']      =   'Total';
        $feecodearray['TRANSTYPES']['transfer']   =   'Transfer (-)';
        $feecodearray['TRANSTYPES']['feetotal']   =   'Fees Total';

        // return $feecodearray;
        //Mini Summary Box
        $minisummarray['cash']           =   $tcashtotal;
        $minisummarray['dbt']            =   $tdbttotal;
        $minisummarray['cheque']         =   $tchequetotal;
        $minisummarray['card']           =   $tcardtotal;
        $minisummarray['online']         =   $tonlinetotal;
        // $minisummarray['penalty']         =  $penaltyamt;
        $minisummarray['prospectus']     =   $pros_amt = $prospectus_amount + $ser_pros_fee;
        $minisummarray['regfee']         =   $regfee_amt = $regfee_amount; // + $ser_reg_fee; //need to implement
        $minisummarray['round_off']      =   $roundoff_amount;
        $minisummarray['transfer']       =   $ttransfertotal;
        $minisummarray['grossamount']    =   $grossamount = $tcashtotal + $tdbttotal + $tchequetotal + $tcardtotal + $tonlinetotal + $ttransfertotal + $pros_amt + $regfee_amt; //$gttotal + $ttransfertotal;
        $minisummarray['transferless']   =   $ttransfertotal;
        $minisummarray['paybackless']    =   $approved_pbtamt; // Should calculate 
        $minisummarray['netamount']      = ($grossamount) - ($ttransfertotal + $approved_pbtamt); //$ttransfertotal - here 0 as payback total. should calculate

        // $penaltyamt = $feecodearray['F104']['feetotal'];
        //Total Summary Box
        $totsummarray['Amount Collected']['amount']     = $feecollected = ((($tcashtotal - $nr_penalty) + $tdbttotal + $tchequetotal + $tcardtotal + $tonlinetotal) - ($vat_amount - $vatt_total_p) - $ser_amount - $roundoff_amount);
        $totsummarray['Amount Collected']['transfer']   = $ttransfertotal - $tr_penalty;
        $totsummarray['Amount Collected']['vat']        = $feesvat = ($vat_amount - $vatt_total_p); // Should calculate 
        $totsummarray['Amount Collected']['total']      = $af = $feecollected + $feesvat;

        $totsummarray['Penalty']['amount']     = $nr_penalty; //$penaltyamt; // Should calculate 
        $totsummarray['Penalty']['transfer']   = $pen_transfer = $tr_penalty; // Should calculate 
        $totsummarray['Penalty']['vat']        = $pensvat = 0; // Should calculate 
        $totsummarray['Penalty']['total']      = $bf = $nr_penalty + $pensvat;

        $totsummarray['Prospectus Fees']['amount']     = $prospectusfee = $prospectus_amount; // Should calculate 
        $totsummarray['Prospectus Fees']['transfer']   = $prostransfer = 0; // Should calculate 
        $totsummarray['Prospectus Fees']['vat']        = $prosvat = 0; // Should calculate 
        $totsummarray['Prospectus Fees']['total']      = $pf = $prospectusfee + $prosvat;

        $totsummarray['Registration Fees']['amount']     = $regfee = $regfee_amount; // Should calculate 
        $totsummarray['Registration Fees']['transfer']   = $regtransfer = 0; // Should calculate 
        $totsummarray['Registration Fees']['vat']        = $regvat = 0; // Should calculate 
        $totsummarray['Registration Fees']['total']      = $rgf = $regfee + $regvat;

        $totsummarray['Service Charge']['amount']     = $surchargefee = $ser_amount + $ser_pros_fee; // Should calculate 
        $totsummarray['Service Charge']['transfer']   = $surchargetransfer = 0; // Should calculate 
        $totsummarray['Service Charge']['vat']        = $surchargevat = 0; // Should calculate 
        $totsummarray['Service Charge']['total']      = $ef = $surchargefee + $surchargevat;

        $totsummarray['Round Off']['amount']     = $roundofffee = $roundoff_amount; // Should calculate 
        $totsummarray['Round Off']['transfer']   = $roundofftransfer = 0; // Should calculate 
        $totsummarray['Round Off']['vat']        = $roundoffvat = 0; // Should calculate 
        $totsummarray['Round Off']['total']      = $rf = $roundofffee + $roundoffvat;

        $totsummarray['Payback Amount (-)']['amount']     = $paybackamount = $approved_pbtamt; // Should calculate 
        $totsummarray['Payback Amount (-)']['transfer']   = $pybktransfer = 0; // Should calculate 
        $totsummarray['Payback Amount (-)']['vat']        = $pybkvat = 0; // Should calculate 
        $totsummarray['Payback Amount (-)']['total']      = $cf = $paybackamount + $pybkvat;

        $totsummarray['Total']['amount']     = $ftotal = (($feecollected + $prospectusfee + $regfee + ($ser_amount + $ser_pros_fee) + $nr_penalty + ($roundofffee)) - $paybackamount);
        $totsummarray['Total']['transfer']   = $transtotal = (($ttransfertotal + $prostransfer + $regtransfer + $surchargetransfer + ($roundofftransfer)) - $pybktransfer);
        $totsummarray['Total']['vat']        = $vattotal = (($feesvat + $prosvat + $regvat + $surchargevat + ($roundoffvat)) - $pybkvat);
        $totsummarray['Total']['total']      = $df = (($af + $bf + $ef) - $cf) + ($rf) + $pf + $rgf;
        //return $feecodearray;

        $otherdetails_data = array();
        //non_demandble_amount

        $non_demandble_amount = 0;
        $nd_transfer_amt = 0;
        $non_demandble_data = $this->MReport->get_received_non_demandable_data($apikey, $inst_id, $acd_year_id, $from_date, $to_date, $user_wise_report);
        if (isset($non_demandble_data) && !empty($non_demandble_data) && count($non_demandble_data) > 0) {
            foreach ($non_demandble_data as $ndd) {
                if ($ndd['payment_mode_id'] == 5 && $ndd['is_others'] == 0) {
                    $nd_transfer_amt += $ndd['amt_paid'] + $ndd['vat_amt'];
                }
                $non_demandble_amount += $ndd['amt_paid'] + $ndd['vat_amt'];
            }
        } else $non_demandble_amount = 0;

        // return $non_demandble_data;

        $otherdetails_data['Amount Subjected For Realization'] = $cnr_amount; // Should Calculate
        $otherdetails_data['Non Demandable Fees Collected'] = $non_demandble_amount; // - $nd_transfer_amt;
        $otherdetails_data['(Transfer) Concession Given'] = ($concession_amount + $st_concession_amount);
        $otherdetails_data['(Transfer) Exemption Given'] = $exemption_amount;
        $otherdetails_data['(Transfer) Fee Adjusted From Wallet'] = $ttransfertotal; // Should Calculate
        // return $otherdetails_data;
        $primary_fee_code_data = $this->MReport->get_all_demandable_feecodes_available($apikey, $inst_id);
        $primary_fee_code_data[] = array(
            'feeCode' => 'OTH',
            'fee_shortcode' => 'OTH',
            'description' => 'OTHERS (NON DEMANDABLE FEES)'
        );
        // return $primary_fee_code_data;
        $non_demandable_feecodes = $this->MReport->get_all_feecodes_non_demandable($apikey, $inst_id);

        $output_array = array(
            'data_status' => 1,
            'data' => $report_data,
            'formatted_data' => $fine_formatted_data,
            'feesummary' => $feecodearray,
            'minisummary' => $minisummarray,
            'totalsummary' => $totsummarray,
            'otherdetails' => $otherdetails_data,
            'ndmd_feedetails' => $ndmd_array,
            'non_demandable_feecodes' => $non_demandable_feecodes,
            'feecodesavailable' => $primary_fee_code_data
        );
        //if (isset($report_data) && !empty($report_data) && count($report_data) > 0) {
        if (isset($output_array) && !empty($output_array) && count($output_array) > 0) {
            return $output_array;
        } else {
            return array('data_status' => 0, 'message' => 'No data is available');
        }
    }

    //SUMMARY COLLECTION REPORT
    public function get_summary_collection_details($params)
    {
        $apikey = $params['API_KEY'];

        if (!(isset($params['inst_id']) && !empty($params['inst_id']))) {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Inst code is required', 'data' => FALSE);
        } else {
            $inst_id = $params['inst_id'];
        }
        if (!(isset($params['acd_year_id']) && !empty($params['acd_year_id']))) {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Academic year data is required', 'data' => FALSE);
        } else {
            $acd_year_id = $params['acd_year_id'];
        }

        if (!(isset($params['from_date']) && !empty($params['from_date']))) {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'From date data is required', 'data' => FALSE);
        } else {
            $from_date = $params['from_date'];
        }

        if (!(isset($params['to_date']) && !empty($params['to_date']))) {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'To date data is required', 'data' => FALSE);
        } else {
            $to_date = $params['to_date'];
        }
        $report_data = $this->MReport->get_summary_collection_data_for_report($apikey, $inst_id, $acd_year_id, $from_date, $to_date);
        // return $report_data;
        $primary_fee_code_data = $this->MReport->get_all_feecodes_available($apikey, $inst_id);
        $primary_fee_code_data[] = array(
            'feeCode' => 'OTH',
            'fee_shortcode' => 'OTH',
            'description' => 'OTHERS'
        );

        /** */
        //Service Charge
        $voucher_collection_details = $this->MReport->get_voucher_collection_details($apikey, $inst_id, $acd_year_id, $from_date, $to_date);
        // return $voucher_collection_details;
        if (isset($voucher_collection_details) && !empty($voucher_collection_details) && count($voucher_collection_details) > 0) {
            //$surcharge_amount = $voucher_collection_details[0]['SERVICE_CHARGE_COLLECTED'];
            $serchg = json_decode($voucher_collection_details[0]['SURCHARGE_DETAILS'], true);
            // $surcharge_amount = ($serchg[0]['SERVICE_CHARGE_COLLECTED'] > 0 ? $serchg[0]['SERVICE_CHARGE_COLLECTED'] : 0);
            $ser_amount = 0;
            $ser_pros_fee = 0;
            foreach ($serchg as $a1) {
                //if(isset($a1['SERVICE_CHARGE_COLLECTED']))
                // if ($a1['is_pros_fee'] != 1) {
                if ($a1['is_pros_fee'] != 1 and $a1['is_pros_fee'] != 2) {
                    $ser_amount += $a1['SERVICE_CHARGE_COLLECTED'];
                } else if ($a1['is_pros_fee'] == 1) {
                    // if($a1['acd_year_id'] == $acd_year_id){
                    $ser_pros_fee += $a1['SERVICE_CHARGE_COLLECTED'];
                    // }
                }
                // $voucher_detail_array[$a1['USERID']]['SERVICE_CHARGE_COLLECTED'] = $ser_amount;
                // $voucher_detail_array[$a1['USERID']]['PROS_SERVICE_CHARGE_COLLECTED'] = $ser_pros_fee;
            }
            $surcharge_amount = $ser_amount;

            $roundoff_amount = 0;
            $rndoff = json_decode($voucher_collection_details[0]['ROUNDOFF_DETAILS'], true);
            if (is_array($rndoff) && !empty($rndoff)) {
                foreach ($rndoff as $rnd_amt) {
                    $roundoff_amount += $rnd_amt['ROUNDOFF_COLLECTED'];
                }
            }
            // $roundoff_amount = ($rndoff[0]['ROUNDOFF_COLLECTED'] <> 0 ? $rndoff[0]['ROUNDOFF_COLLECTED'] : 0);

            $vatamt = json_decode($voucher_collection_details[0]['VAT_DETAILS'], true);
            if (is_array($vatamt) && !empty($vatamt)) {
                foreach ($vatamt as $vt_amt) {
                    $vat_amount += $vt_amt['VAT_COLLECTED'];
                }
            }
            // $vat_amount = ($vatamt[0]['VAT_COLLECTED'] <> 0 ? $vatamt[0]['VAT_COLLECTED'] : 0);

            $concamt = json_decode($voucher_collection_details[0]['CONC_DETAILS'], true);
            if (is_array($concamt) && !empty($concamt)) {
                foreach ($concamt as $cn_amt) {
                    $concession_amount += $cn_amt['CONC_COLLECTED'];
                }
            }
            // $concession_amount = ($concamt[0]['CONC_COLLECTED'] <> 0 ? $concamt[0]['CONC_COLLECTED'] : 0);

            $st_concamt = json_decode($voucher_collection_details[0]['ST_CONC_DETAILS'], true);
            if (is_array($st_concamt) && !empty($st_concamt)) {
                foreach ($st_concamt as $scn_amt) {
                    $st_concession_amount += $scn_amt['ST_CONC_COLLECTED'];
                }
            }
            // $st_concession_amount = ($st_concamt[0]['ST_CONC_COLLECTED'] <> 0 ? $st_concamt[0]['ST_CONC_COLLECTED'] : 0);

            $expnamt = json_decode($voucher_collection_details[0]['EXPN_DETAILS'], true);
            if (is_array($expnamt) && !empty($expnamt)) {
                foreach ($expnamt as $ex_amt) {
                    $exemption_amount += $ex_amt['EXPN_COLLECTED'];
                    // $voucher_detail_array[$ex_amt['USERID']]['CNRA_COLLECTED'] = $ex_amt['CNRA_COLLECTED'];
                }
            }
            // $exemption_amount = ($expnamt[0]['EXPN_COLLECTED'] <> 0 ? $expnamt[0]['EXPN_COLLECTED'] : 0);
            $cnr_amount = 0;
            $cnramt = json_decode($voucher_collection_details[0]['CNRA_DETAILS'], true);
            // $cnr_amount = ($cnramt[0]['CNRA_COLLECTED'] <> 0 ? $cnramt[0]['CNRA_COLLECTED'] : 0);
            if (is_array($cnramt) && !empty($cnramt)) {
                foreach ($cnramt as $a6) {
                    $cnr_amount += $a6['CNRA_COLLECTED'];
                    // $voucher_detail_array[$a6['USERID']]['CNRA_COLLECTED'] = $a6['CNRA_COLLECTED'];
                }
            }

            $approved_pbtamt = 0;
            $pbkamt = json_decode($voucher_collection_details[0]['PBK_DETAILS'], true);
            // $approved_pbtamt = ($pbkamt[0]['PBK_COLLECTED'] <> 0 ? $pbkamt[0]['PBK_COLLECTED'] : 0);
            if (is_array($pbkamt) && !empty($pbkamt)) {
                foreach ($pbkamt as $pb) {
                    $approved_pbtamt += $pb['PBK_COLLECTED'];
                }
            }

            $penaltyamt = 0;
            $pnltyamt = json_decode($voucher_collection_details[0]['PENALTY_DETAILS'], true);
            if (is_array($pnltyamt) && !empty($pnltyamt)) {
                foreach ($pnltyamt as $pnlt) {
                    $penaltyamt += $pnlt['PENALTY_COLLECTED'];
                }
            }
            // $penaltyamt = ($pnltyamt[0]['PENALTY_COLLECTED'] <> 0 ? $pnltyamt[0]['PENALTY_COLLECTED'] : 0);
        } else {
            $surcharge_amount = 0;
            $roundoff_amount = 0;
            $vat_amount = 0;
            $concession_amount = 0;
            $st_concession_amount = 0;
            $exemption_amount = 0;
            $cnr_amount = 0;
            $approved_pbtamt = 0;
            $penaltyamt = 0;
        }
        /** */
        // return $voucher_collection_details;
        $summary_detail_array = array();
        $ndmd_array = array();

        $fine_formatted_data = array();
        if (!empty($report_data)) {
            foreach ($report_data as $rdata) {
                foreach ($primary_fee_code_data as $feescode) {
                    if ($feescode['feeCode'] == $rdata['feeCode']) {
                        if ($feescode['demandType'] == 1) {
                            if ($rdata['is_penalty'] == 0) {
                                if (!isset($fine_formatted_data[$rdata['demand_date']][$rdata['trans_type']][$feescode['feeCode']]['amt_paid'])) {
                                    $fine_formatted_data[$rdata['demand_date']][$rdata['trans_type']][$feescode['feeCode']] = array(
                                        'feeCode' => $rdata['feeCode'],
                                        'fee_code_description' => $rdata['fee_code_description'],
                                        'amt_paid' => $rdata['amt_paid'],
                                        'trans_type' => strtoupper($rdata['trans_type'])
                                    );
                                } else {
                                    $fine_formatted_data[$rdata['demand_date']][$rdata['trans_type']][$feescode['feeCode']]['amt_paid'] += $rdata['amt_paid'];
                                }
                            }
                            if ($rdata['is_penalty'] == 1) {
                                if (isset($rdata['penalty_paid']) && $rdata['penalty_paid'] > 0) {
                                    if (isset($fine_formatted_data[$rdata['demand_date']][$rdata['trans_type']]['F104']['amt_paid'])) {
                                        $fine_formatted_data[$rdata['demand_date']][$rdata['trans_type']]['F104']['amt_paid'] += $rdata['penalty_paid'];
                                    } else {
                                        $fine_formatted_data[$rdata['demand_date']][$rdata['trans_type']]['F104'] = array(
                                            'feeCode' => 'F104',
                                            'fee_code_description' => 'PENALTY',
                                            'amt_paid' => $rdata['penalty_paid'],
                                            'trans_type' => strtoupper($rdata['trans_type'])
                                        );
                                    }
                                }
                            }
                            if (isset($rdata['vat_paid']) && $rdata['vat_paid'] > 0) {
                                $fine_formatted_data[$rdata['demand_date']][$rdata['trans_type']]['F103'] = array(
                                    'feeCode' => 'F103',
                                    'fee_code_description' => 'TAX-VAT',
                                    'amt_paid' => $rdata['vat_paid'],
                                    'trans_type' => strtoupper($rdata['trans_type'])
                                );
                            }
                            if (isset($rdata['ser_charge']) && $rdata['ser_charge'] > 0) {
                                $fine_formatted_data[$rdata['demand_date']][$rdata['trans_type']]['F025'] = array(
                                    'feeCode' => 'F025',
                                    'fee_code_description' => 'SERVICE CHARGE',
                                    'amt_paid' => $rdata['ser_charge'],
                                    'trans_type' => strtoupper($rdata['trans_type'])
                                );
                            }
                            if (isset($rdata['round_off']) && $rdata['round_off'] > 0) {
                                $fine_formatted_data[$rdata['demand_date']][$rdata['trans_type']]['F102'] = array(
                                    'feeCode' => 'F102',
                                    'fee_code_description' => 'ROUND OFF',
                                    'amt_paid' => $rdata['round_off'],
                                    'trans_type' => strtoupper($rdata['trans_type'])
                                );
                            }
                        } else {
                            if ($feescode['demandType'] == 2 && $feescode['editable'] == 1) {
                                if ($rdata['is_penalty'] == 0) {
                                    if (!isset($ndmd_array[$rdata['demand_date']][$rdata['trans_type']][$feescode['feeCode']]['amt_paid'])) {
                                        $ndmd_array[$rdata['demand_date']][$rdata['trans_type']][$feescode['feeCode']] = array(
                                            'feeCode' => $rdata['feeCode'],
                                            'fee_code_description' => $rdata['fee_code_description'],
                                            'amt_paid' => $rdata['amt_paid'],
                                            'trans_type' => strtoupper($rdata['trans_type'])
                                        );
                                    } else {
                                        $ndmd_array[$rdata['demand_date']][$rdata['trans_type']][$feescode['feeCode']]['amt_paid'] += $rdata['amt_paid'];
                                    }

                                    if (isset($fine_formatted_data[$rdata['demand_date']][$rdata['trans_type']]['OTH']['amt_paid']))
                                        $fine_formatted_data[$rdata['demand_date']][$rdata['trans_type']]['OTH']['amt_paid'] += $rdata['amt_paid'];
                                    else {
                                        $fine_formatted_data[$rdata['demand_date']][$rdata['trans_type']]['OTH'] = array(
                                            'feeCode' => 'OTH',
                                            'fee_code_description' => 'OTHERS',
                                            'amt_paid' => $rdata['amt_paid'],
                                            'trans_type' => strtoupper($rdata['trans_type'])
                                        );
                                    }
                                }
                                if ($rdata['is_penalty'] == 1) {
                                    if (isset($rdata['penalty_paid']) && $rdata['penalty_paid'] > 0) {
                                        $ndmd_array[$rdata['demand_date']][$rdata['trans_type']]['F104'] = array(
                                            'feeCode' => 'F104',
                                            'fee_code_description' => 'PENALTY',
                                            'amt_paid' => $rdata['penalty_paid'],
                                            'trans_type' => strtoupper($rdata['trans_type'])
                                        );
                                        $fine_formatted_data[$rdata['demand_date']][$rdata['trans_type']]['F104'] = array(
                                            'feeCode' => 'F104',
                                            'fee_code_description' => 'PENALTY',
                                            'amt_paid' => $rdata['penalty_paid'],
                                            'trans_type' => strtoupper($rdata['trans_type'])
                                        );
                                    }
                                }

                                if (isset($rdata['vat_paid']) && $rdata['vat_paid'] > 0) {
                                    $ndmd_array[$rdata['demand_date']][$rdata['trans_type']]['F103'] = array(
                                        'feeCode' => 'F103',
                                        'fee_code_description' => 'TAX-VAT',
                                        'amt_paid' => $rdata['vat_paid'],
                                        'trans_type' => strtoupper($rdata['trans_type'])
                                    );
                                    $fine_formatted_data[$rdata['demand_date']][$rdata['trans_type']]['F103'] = array(
                                        'feeCode' => 'F103',
                                        'fee_code_description' => 'TAX-VAT',
                                        'amt_paid' => $rdata['vat_paid'],
                                        'trans_type' => strtoupper($rdata['trans_type'])
                                    );
                                }
                                if (isset($rdata['ser_charge']) && $rdata['ser_charge'] > 0) {
                                    $ndmd_array[$rdata['demand_date']][$rdata['trans_type']]['F025'] = array(
                                        'feeCode' => 'F025',
                                        'fee_code_description' => 'SERVICE CHARGE',
                                        'amt_paid' => $rdata['ser_charge'],
                                        'trans_type' => strtoupper($rdata['trans_type'])
                                    );
                                    $fine_formatted_data[$rdata['demand_date']][$rdata['trans_type']]['F025'] = array(
                                        'feeCode' => 'F025',
                                        'fee_code_description' => 'SERVICE CHARGE',
                                        'amt_paid' => $rdata['ser_charge'],
                                        'trans_type' => strtoupper($rdata['trans_type'])
                                    );
                                }
                                if (isset($rdata['round_off']) && $rdata['round_off'] > 0) {
                                    $ndmd_array[$rdata['demand_date']][$rdata['trans_type']]['F102'] = array(
                                        'feeCode' => 'F102',
                                        'fee_code_description' => 'ROUND OFF',
                                        'amt_paid' => $rdata['round_off'],
                                        'trans_type' => strtoupper($rdata['trans_type'])
                                    );
                                    $fine_formatted_data[$rdata['demand_date']][$rdata['trans_type']]['F102'] = array(
                                        'feeCode' => 'F102',
                                        'fee_code_description' => 'ROUND OFF',
                                        'amt_paid' => $rdata['round_off'],
                                        'trans_type' => strtoupper($rdata['trans_type'])
                                    );
                                }
                            } else {
                                if (isset($fine_formatted_data[$rdata['demand_date']][$rdata['trans_type']][$feescode['feeCode']]['amt_paid']))
                                    $fine_formatted_data[$rdata['demand_date']][$rdata['trans_type']][$feescode['feeCode']]['amt_paid'] += $rdata['amt_paid'];
                                else {
                                    $fine_formatted_data[$rdata['demand_date']][$rdata['trans_type']][$feescode['feeCode']] = array(
                                        'feeCode' => $rdata['feeCode'],
                                        'fee_code_description' => $rdata['fee_code_description'],
                                        'amt_paid' => $rdata['amt_paid'],
                                        'trans_type' => strtoupper($rdata['trans_type'])
                                    );
                                }

                                if (isset($rdata['ser_charge']) && $rdata['ser_charge'] > 0) {
                                    $fine_formatted_data[$rdata['demand_date']][$rdata['trans_type']]['F025'] = array(
                                        'feeCode' => 'F025',
                                        'fee_code_description' => 'SERVICE CHARGE',
                                        'amt_paid' => $rdata['ser_charge'],
                                        'trans_type' => strtoupper($rdata['trans_type'])
                                    );
                                }
                            }
                        }
                    } else {
                        if (!isset($fine_formatted_data[$rdata['demand_date']][$rdata['trans_type']][$feescode['feeCode']]['amt_paid'])) {
                            $fine_formatted_data[$rdata['demand_date']][$rdata['trans_type']][$feescode['feeCode']] = array(
                                'feeCode' => $feescode['feeCode'],
                                'fee_code_description' => $feescode['description'],
                                'amt_paid' => 0,
                                'trans_type' => strtoupper($rdata['trans_type'])
                            );
                        }
                    }
                }
            }
        }
        // return $fine_formatted_data;
        //$formatted_data = $this->format_data_for_summary_collection($report_data, $primary_fee_code_data);
        $formatted_data = $fine_formatted_data;
        // $formatted_data['service_charge'] = $ser_amount;
        // return $ndmd_array;
        // return $formatted_data;
        //prospectus_amount
        $prospectus_data = $this->MReport->get_prospectus_data_report($apikey, $inst_id, $acd_year_id, $from_date, $to_date);
        // if (isset($prospectus_data) && !empty($prospectus_data) && count($prospectus_data) > 0) {
        //     $prospectus_amount = $prospectus_data[0]['prospectus_amount'];
        // } else $prospectus_amount = 0;
        $prospectus_amount = 0;
        if (isset($prospectus_data) && !empty($prospectus_data) && count($prospectus_data) > 0) {
            foreach ($prospectus_data as $pr_amt) {
                $prospectus_amount += $pr_amt['Amount'];
            }
            // $prospectus_amount = $prospectus_data[0]['prospectus_amount'];
        } else $prospectus_amount = 0;

        //Registration Fee
        $reg_fee_data = $this->MReport->get_regfee_collection_report($apikey, $inst_id, $acd_year_id, $from_date, $to_date);
        $regfee_amount = 0;
        if (isset($reg_fee_data) && !empty($reg_fee_data) && count($reg_fee_data) > 0) {
            foreach ($reg_fee_data as $reg_amt) {
                $regfee_amount += $reg_amt['amount'];
            }
        } else $regfee_amount = 0;

        // return $prospectus_amount;
        $feecodearray = array();
        $minisummarray = array();
        $totsummarray = array();
        $cashtotal = 0;
        $cardtotal = 0;
        $chequetotal = 0;
        $onlinetotal = 0;
        $transfertotal = 0;
        $transfertotal_p = 0;
        // $ttotal = 0;
        // $gtotal = 0;
        $gttotal = 0;
        $ggtotal = 0;
        $tcashtotal = 0;
        $tcardtotal = 0;
        $tchequetotal = 0;
        $tonlinetotal = 0;
        $ttransfertotal = 0;

        $ttotal = 0;
        $gtotal = 0;
        $ttotal_o = 0;
        $ttotal_nd = 0;
        $nettamt = 0;
        // return $report_data;

        //Format Array as Daily Total
        $tr_penalty = 0;
        $nr_penalty = 0;
        foreach ($report_data as $rd) {
            if ($rd['is_penalty'] == 1 && $rd['trans_type'] == 'T') {
                $tr_penalty += $rd['penalty_paid'];
            } else {
                $nr_penalty += $rd['penalty_paid'];
            }
            $feecodearray[$rd['feeCode']]['total'] = 0;
            foreach ($primary_fee_code_data as $feescode) {
                if ($feescode['feeCode'] == $rd['feeCode']) {
                    if ($feescode['demandType'] == 1) {
                        if ($rd['trans_type'] == 'C') { //penalty_paid
                            if ($rd['is_penalty'] == 0) {
                                if (isset($feecodearray[$rd['feeCode']]['cash'])) {
                                    $feecodearray[$rd['feeCode']]['cash']       += $rd['amt_paid'];
                                    $cashtotal =  $feecodearray[$rd['feeCode']]['cash'];
                                } else {
                                    $feecodearray[$rd['feeCode']]['cash']       = $rd['amt_paid'];
                                    $cashtotal =  $feecodearray[$rd['feeCode']]['cash'];
                                }
                            }
                            if ($rd['is_penalty'] == 1) {
                                if (isset($rd['penalty_paid']) && $rd['penalty_paid'] > 0) {
                                    $feecodearray['F104']['cash']       += $rd['penalty_paid'];
                                    $penalty_total_c = $feecodearray['F104']['cash'];
                                }
                            }
                            if (isset($rd['vat_paid']) && $rd['vat_paid'] > 0) {
                                $feecodearray['F103']['cash']       += $rd['vat_paid'];
                                $vatt_total_c = $feecodearray['F103']['cash'];
                            }
                            if (isset($rd['round_off']) && $rd['is_penalty'] == 0) { //&& $rd['round_off'] > 0
                                $feecodearray['F102']['cash']       += $rd['round_off'];
                                $roundoff_total_c = $feecodearray['F102']['cash'];
                            }
                            $ttotal += $cashtotal; //($cashtotal + $vatt_total + $roundoff_total);
                            //$feecodearray[$rd['feeCode']]['total']   = $ttotal;
                            // $feecodearray['F103']['total']   += $vatt_total;
                            // $feecodearray['F102']['total']   += $roundoff_total;
                        } else if ($rd['trans_type'] == 'D') {
                            if ($rd['is_penalty'] == 0) {
                                if (isset($feecodearray[$rd['feeCode']]['dbt'])) {
                                    $feecodearray[$rd['feeCode']]['dbt']       += $rd['amt_paid'];
                                    $dbttotal =  $feecodearray[$rd['feeCode']]['dbt'];
                                } else {
                                    $feecodearray[$rd['feeCode']]['dbt']       = $rd['amt_paid'];
                                    $dbttotal =  $feecodearray[$rd['feeCode']]['dbt'];
                                }
                            }
                            if (isset($rd['vat_paid']) && $rd['vat_paid'] > 0) {
                                $feecodearray['F103']['dbt']       += $rd['vat_paid'];
                                $vatt_total_d = $feecodearray['F103']['dbt'];
                            }
                            if (isset($rd['round_off']) && $rd['is_penalty'] == 0) { //&& $rd['round_off'] > 0
                                $feecodearray['F102']['dbt']       += $rd['round_off'];
                                $roundoff_total_d = $feecodearray['F102']['dbt'];
                            }
                            if ($rd['is_penalty'] == 1) {
                                if (isset($rd['penalty_paid']) && $rd['penalty_paid'] > 0) {
                                    $feecodearray['F104']['dbt']       += $rd['penalty_paid'];
                                    $penalty_total_d = $feecodearray['F104']['dbt'];
                                }
                            }
                            $ttotal += $dbttotal; //($dbttotal + $vatt_total + $roundoff_total);
                            //$feecodearray[$rd['feeCode']]['total']   = $ttotal;
                            // $feecodearray['F103']['total']   += $vatt_total;
                            // $feecodearray['F102']['total']   += $roundoff_total;
                        } else if ($rd['trans_type'] == 'Q') {
                            if ($rd['is_penalty'] == 0) {
                                if (isset($feecodearray[$rd['feeCode']]['cheque'])) {
                                    $feecodearray[$rd['feeCode']]['cheque']       += $rd['amt_paid'];
                                    $chequetotal =  $feecodearray[$rd['feeCode']]['cheque'];
                                } else {
                                    $feecodearray[$rd['feeCode']]['cheque']       = $rd['amt_paid'];
                                    $chequetotal_q =  $feecodearray[$rd['feeCode']]['cheque'];
                                }
                            }
                            if (isset($rd['vat_paid']) && $rd['vat_paid'] > 0) {
                                $feecodearray['F103']['cheque']       += $rd['vat_paid'];
                                $vatt_total_q = $feecodearray['F103']['cheque'];
                            }
                            if (isset($rd['round_off']) && $rd['is_penalty'] == 0) { //&& $rd['round_off'] > 0
                                $feecodearray['F102']['cheque']       += $rd['round_off'];
                                $roundoff_total_q = $feecodearray['F102']['cheque'];
                            }
                            if ($rd['is_penalty'] == 1) {
                                if (isset($rd['penalty_paid']) && $rd['penalty_paid'] > 0) {
                                    $feecodearray['F104']['cheque']       += $rd['penalty_paid'];
                                    $penalty_total_q = $feecodearray['F104']['cheque'];
                                }
                            }
                            $ttotal += $chequetotal; //($chequetotal + $vatt_total + $roundoff_total);
                            //$feecodearray[$rd['feeCode']]['total']   = $ttotal;
                            // $feecodearray['F103']['total']   += $vatt_total;
                            // $feecodearray['F102']['total']   += $roundoff_total;
                        } else if ($rd['trans_type'] == 'R') {
                            if ($rd['is_penalty'] == 0) {
                                if (isset($feecodearray[$rd['feeCode']]['card'])) {
                                    $feecodearray[$rd['feeCode']]['card']       += $rd['amt_paid'];
                                    $cardtotal =  $feecodearray[$rd['feeCode']]['card'];
                                } else {
                                    $feecodearray[$rd['feeCode']]['card']       = $rd['amt_paid'];
                                    $cardtotal =  $feecodearray[$rd['feeCode']]['card'];
                                }
                            }
                            // if (isset($rd['ser_charge']) && $rd['ser_charge'] > 0) {
                            //     $feecodearray['F025']['card']       += $rd['ser_charge'];
                            //     $serchg_total_r = $feecodearray['F025']['card'];
                            // }
                            if (isset($rd['vat_paid']) && $rd['vat_paid'] > 0) {
                                $feecodearray['F103']['card']       += $rd['vat_paid'];
                                $vatt_total_r = $feecodearray['F103']['card'];
                            }
                            if (isset($rd['round_off']) && $rd['is_penalty'] == 0) { //&& $rd['round_off'] > 0
                                $feecodearray['F102']['card']       += $rd['round_off'];
                                $roundoff_total_r = $feecodearray['F102']['card'];
                            }
                            if ($rd['is_penalty'] == 1) {
                                if (isset($rd['penalty_paid']) && $rd['penalty_paid'] > 0) {
                                    $feecodearray['F104']['card']       += $rd['penalty_paid'];
                                    $penalty_total_r = $feecodearray['F104']['card'];
                                }
                            }
                            $ttotal += $cardtotal; //($cardtotal + $vatt_total + $roundoff_total + $serchg_total);
                            //$feecodearray[$rd['feeCode']]['total']   = $ttotal;
                            // $feecodearray['F025']['total']   += $serchg_total;
                            // $feecodearray['F103']['total']   += $vatt_total;
                            // $feecodearray['F102']['total']   += $roundoff_total;
                        } else if ($rd['trans_type'] == 'O') { //penalty_paid
                            if ($rd['is_penalty'] == 0) {
                                if (isset($feecodearray[$rd['feeCode']]['online'])) {
                                    $feecodearray[$rd['feeCode']]['online']       += $rd['amt_paid'];
                                    $onlinetotal =  $feecodearray[$rd['feeCode']]['online'];
                                } else {
                                    $feecodearray[$rd['feeCode']]['online']       = $rd['amt_paid'];
                                    $onlinetotal =  $feecodearray[$rd['feeCode']]['online'];
                                }
                            }
                            if ($rd['is_penalty'] == 1) {
                                if (isset($rd['penalty_paid']) && $rd['penalty_paid'] > 0) {
                                    $feecodearray['F104']['online']       += $rd['penalty_paid'];
                                    $penalty_total_on = $feecodearray['F104']['online'];
                                }
                            }
                            if (isset($rd['vat_paid']) && $rd['vat_paid'] > 0) {
                                $feecodearray['F103']['online']       += $rd['vat_paid'];
                                $vatt_total_on = $feecodearray['F103']['online'];
                            }
                            if (isset($rd['round_off']) && $rd['is_penalty'] == 0) { //&& $rd['round_off'] > 0
                                $feecodearray['F102']['online']       += $rd['round_off'];
                                $roundoff_total_on = $feecodearray['F102']['online'];
                            }
                            $ttotal += $onlinetotal; //($cashtotal + $vatt_total + $roundoff_total);
                            //$feecodearray[$rd['feeCode']]['total']   = $ttotal;
                            // $feecodearray['F103']['total']   += $vatt_total;
                            // $feecodearray['F102']['total']   += $roundoff_total;
                        } else if ($rd['trans_type'] == 'T' && $rd['is_others'] == 0) {
                            if ($rd['is_penalty'] == 0) {
                                if (isset($feecodearray[$rd['feeCode']]['transfer'])) {
                                    $feecodearray[$rd['feeCode']]['transfer']       += $rd['amt_paid'];
                                    $feecodearray[$rd['feeCode']]['transfer_p']     += $rd['amt_paid'];
                                    $transfertotal =  $feecodearray[$rd['feeCode']]['transfer'];
                                    $transfertotal_p =  $feecodearray[$rd['feeCode']]['transfer_p'];
                                } else {
                                    $feecodearray[$rd['feeCode']]['transfer']       = $rd['amt_paid'];
                                    $feecodearray[$rd['feeCode']]['transfer_p']     = $rd['amt_paid'];
                                    $transfertotal =  $feecodearray[$rd['feeCode']]['transfer'];
                                    $transfertotal_p =  $feecodearray[$rd['feeCode']]['transfer_p'];
                                }
                            }
                            if (isset($rd['vat_paid']) && $rd['vat_paid'] > 0) {
                                $feecodearray['F103']['transfer']       += $rd['vat_paid'];
                                $feecodearray['F103']['transfer_p']     += $rd['vat_paid'];
                                $vatt_total = $feecodearray['F103']['transfer'];
                                $vatt_total_p = $feecodearray['F103']['transfer_p'];
                            }
                            if (isset($rd['round_off']) && $rd['is_penalty'] == 0) { //&& $rd['round_off'] > 0
                                $feecodearray['F102']['transfer']       += $rd['round_off'];
                                $feecodearray['F102']['transfer_p']     += $rd['round_off'];
                                $roundoff_total = $feecodearray['F102']['transfer'];
                                $roundoff_total_p = $feecodearray['F102']['transfer_p'];
                            }
                            if ($rd['is_penalty'] == 1) {
                                if (isset($rd['penalty_paid']) && $rd['penalty_paid'] > 0) {
                                    $feecodearray['F104']['transfer']       += $rd['penalty_paid'];
                                    $feecodearray['F104']['transfer_p']       += $rd['penalty_paid'];
                                    $penalty_total = $feecodearray['F104']['transfer'];
                                    $penalty_total_p = $feecodearray['F104']['transfer_p'];
                                }
                            }
                            $ttotal += $transfertotal_p;
                            //$ttotal = $transfertotal;
                            // $feecodearray['F103']['total']   += $vatt_total_p;
                            // $feecodearray['F102']['total']   += $roundoff_total_p;
                        }
                        $feecodearray['F025']['card'] = $surcharge_amount;
                        // $feecodearray[$rd['feeCode']]['total'] = $cashtotal + $dbttotal + $chequetotal + $cardtotal + $onlinetotal + $transfertotal_p;
                        $feecodearray[$rd['feeCode']]['total'] = $feecodearray[$rd['feeCode']]['cash'] + $feecodearray[$rd['feeCode']]['dbt'] + $feecodearray[$rd['feeCode']]['cheque'] + $feecodearray[$rd['feeCode']]['card'] + $feecodearray[$rd['feeCode']]['online'] + $feecodearray[$rd['feeCode']]['transfer_p'];
                        $feecodearray['F103']['total'] = $vatt_total_c + $vatt_total_d + $vatt_total_q + $vatt_total_r + $vatt_total_p + $vatt_total_on;
                        //$feecodearray['F025']['total'] = $serchg_total_r;
                        $feecodearray['F102']['total'] = $roundoff_total_c + $roundoff_total_d + $roundoff_total_q + $roundoff_total_r + $roundoff_total_p + $roundoff_total_on;
                        // $feecodearray['F104']['total'] = $penalty_total_c + $penalty_total_d + $penalty_total_q + $penalty_total_r + $penalty_total_p;
                        //$feecodearray['F104']['total'] = $feecodearray['F104']['cash'] + $feecodearray['F104']['dbt'] + $feecodearray['F104']['cheque'] + $feecodearray['F104']['card'] + $feecodearray['F104']['transfer_p'];
                    } else {
                        if ($feescode['demandType'] == 2 && $feescode['editable'] == 1) {
                            if ($rd['trans_type'] == 'C') {
                                if ($rd['is_penalty'] == 0) {
                                    if (isset($feecodearray['OTH']['cash'])) {
                                        $feecodearray['OTH']['cash']       += $rd['amt_paid'];
                                        $cashtotal_o =  $feecodearray['OTH']['cash'];
                                    } else {
                                        $feecodearray['OTH']['cash']       = $rd['amt_paid'];
                                        $cashtotal_o =  $feecodearray['OTH']['cash'];
                                    }
                                }

                                if (isset($rd['vat_paid']) && $rd['vat_paid'] > 0) {
                                    $feecodearray['F103']['cash']       += $rd['vat_paid'];
                                    $vatt_total_o_c = $feecodearray['F103']['cash'];
                                }
                                if (isset($rd['round_off']) && $rd['is_penalty'] == 0) { //&& $rd['round_off'] > 0
                                    $feecodearray['F102']['cash']       += $rd['round_off'];
                                    $roundoff_total_o_c = $feecodearray['F102']['cash'];
                                }
                                if ($rd['is_penalty'] == 1) {
                                    if (isset($rd['penalty_paid']) && $rd['penalty_paid'] > 0) {
                                        $feecodearray['F104']['cash']       += $rd['penalty_paid'];
                                        $penalty_total_o_c = $feecodearray['F104']['cash'];
                                    }
                                }
                                $ttotal_o += $cashtotal_o; //($cashtotal + $vatt_total + $roundoff_total);
                                //$feecodearray['OTH']['total']   = $ttotal_o;
                            } else if ($rd['trans_type'] == 'D') {
                                if ($rd['is_penalty'] == 0) {
                                    if (isset($feecodearray['OTH']['dbt'])) {
                                        $feecodearray['OTH']['dbt']       += $rd['amt_paid'];
                                        $dbttotal_o =  $feecodearray['OTH']['dbt'];
                                    } else {
                                        $feecodearray['OTH']['dbt']       = $rd['amt_paid'];
                                        $dbttotal_o =  $feecodearray['OTH']['dbt'];
                                    }
                                }

                                if (isset($rd['vat_paid']) && $rd['vat_paid'] > 0) {
                                    $feecodearray['F103']['dbt']       += $rd['vat_paid'];
                                    $vatt_total_o_d = $feecodearray['F103']['dbt'];
                                }
                                if (isset($rd['round_off']) && $rd['is_penalty'] == 0) { //&& $rd['round_off'] > 0
                                    $feecodearray['F102']['dbt']       += $rd['round_off'];
                                    $roundoff_total_o_d = $feecodearray['F102']['dbt'];
                                }
                                if ($rd['is_penalty'] == 1) {
                                    if (isset($rd['penalty_paid']) && $rd['penalty_paid'] > 0) {
                                        $feecodearray['F104']['dbt']       += $rd['penalty_paid'];
                                        $penalty_total_o_d = $feecodearray['F104']['dbt'];
                                    }
                                }
                                $ttotal_o += $dbttotal_o; //($dbttotal + $vatt_total + $roundoff_total);
                                //$feecodearray['OTH']['total']   = $ttotal_o;
                            } else if ($rd['trans_type'] == 'Q') {
                                if ($rd['is_penalty'] == 0) {
                                    if (isset($feecodearray['OTH']['cheque'])) {
                                        $feecodearray['OTH']['cheque']       += $rd['amt_paid'];
                                        $chequetotal_o =  $feecodearray['OTH']['cheque'];
                                    } else {
                                        $feecodearray['OTH']['cheque']       = $rd['amt_paid'];
                                        $chequetotal_o =  $feecodearray['OTH']['cheque'];
                                    }
                                }
                                if (isset($rd['vat_paid']) && $rd['vat_paid'] > 0) {
                                    $feecodearray['F103']['cheque']       += $rd['vat_paid'];
                                    $vatt_total_o_q = $feecodearray['F103']['cheque'];
                                }
                                if (isset($rd['round_off']) && $rd['is_penalty'] == 0) { //&& $rd['round_off'] > 0
                                    $feecodearray['F102']['cheque']       += $rd['round_off'];
                                    $roundoff_total_o_q = $feecodearray['F102']['cheque'];
                                }
                                if ($rd['is_penalty'] == 1) {
                                    if (isset($rd['penalty_paid']) && $rd['penalty_paid'] > 0) {
                                        $feecodearray['F104']['cheque']       += $rd['penalty_paid'];
                                        $penalty_total_o_q = $feecodearray['F104']['cheque'];
                                    }
                                }
                                $ttotal_o += $chequetotal_o; //($chequetotal + $vatt_total + $roundoff_total);
                                //$feecodearray['OTH']['total']   = $ttotal_o;
                                // $feecodearray['F103']['total']   = $vatt_total_o;
                                // $feecodearray['F102']['total']   = $roundoff_total_o;
                            } else if ($rd['trans_type'] == 'R') {
                                if ($rd['is_penalty'] == 0) {
                                    if (isset($feecodearray['OTH']['card'])) {
                                        $feecodearray['OTH']['card']       += $rd['amt_paid'];
                                        $cardtotal_o =  $feecodearray['OTH']['card'];
                                    } else {
                                        $feecodearray['OTH']['card']       = $rd['amt_paid'];
                                        $cardtotal_o =  $feecodearray['OTH']['card'];
                                    }
                                }
                                // if (isset($rd['ser_charge']) && $rd['ser_charge'] > 0) {
                                //     $feecodearray['F025']['card']       += $rd['ser_charge'];
                                //     $serchg_total_o_r = $feecodearray['F025']['card'];
                                // }
                                if (isset($rd['vat_paid']) && $rd['vat_paid'] > 0) {
                                    $feecodearray['F103']['card']       += $rd['vat_paid'];
                                    $vatt_total_o_r = $feecodearray['F103']['card'];
                                }
                                if (isset($rd['round_off']) && $rd['is_penalty'] == 0) { //&& $rd['round_off'] > 0
                                    $feecodearray['F102']['card']       += $rd['round_off'];
                                    $roundoff_total_o_r = $feecodearray['F102']['card'];
                                }
                                if ($rd['is_penalty'] == 1) {
                                    if (isset($rd['penalty_paid']) && $rd['penalty_paid'] > 0) {
                                        $feecodearray['F104']['card']       += $rd['penalty_paid'];
                                        $penalty_total_o_r = $feecodearray['F104']['card'];
                                    }
                                }
                                $ttotal_o += $cardtotal_o; //($cardtotal + $vatt_total + $roundoff_total + $serchg_total);
                                //$feecodearray['OTH']['total']   = $ttotal_o;
                                // $feecodearray['F025']['total']   = $serchg_total_o;
                                // $feecodearray['F103']['total']   = $vatt_total_o;
                                // $feecodearray['F102']['total']   = $roundoff_total_o;
                            } else if ($rd['trans_type'] == 'O') {
                                if ($rd['is_penalty'] == 0) {
                                    if (isset($feecodearray['OTH']['online'])) {
                                        $feecodearray['OTH']['online']       += $rd['amt_paid'];
                                        $onlinetotal_o =  $feecodearray['OTH']['online'];
                                    } else {
                                        $feecodearray['OTH']['online']       = $rd['amt_paid'];
                                        $onlinetotal_o =  $feecodearray['OTH']['online'];
                                    }
                                }

                                if (isset($rd['vat_paid']) && $rd['vat_paid'] > 0) {
                                    $feecodearray['F103']['online']       += $rd['vat_paid'];
                                    $vatt_total_o_o = $feecodearray['F103']['online'];
                                }
                                if (isset($rd['round_off']) && $rd['is_penalty'] == 0) { //&& $rd['round_off'] > 0
                                    $feecodearray['F102']['online']       += $rd['round_off'];
                                    $roundoff_total_o_o = $feecodearray['F102']['online'];
                                }
                                if ($rd['is_penalty'] == 1) {
                                    if (isset($rd['penalty_paid']) && $rd['penalty_paid'] > 0) {
                                        $feecodearray['F104']['online']       += $rd['penalty_paid'];
                                        $penalty_total_o_o = $feecodearray['F104']['online'];
                                    }
                                }
                                $ttotal_o += $onlinetotal_o; //($cashtotal + $vatt_total + $roundoff_total);
                                //$feecodearray['OTH']['total']   = $ttotal_o;
                            } else if ($rd['trans_type'] == 'T' && $rd['is_others'] == 0) {
                                if ($rd['is_penalty'] == 0) {
                                    if (isset($feecodearray['OTH']['transfer'])) {
                                        $feecodearray['OTH']['transfer']       += $rd['amt_paid'];
                                        $feecodearray['OTH']['transfer_p']     += $rd['amt_paid'];
                                        $transfertotal =  $feecodearray['OTH']['transfer'];
                                        $transfertotal_po =  $feecodearray['OTH']['transfer_p'];
                                    } else {
                                        $feecodearray['OTH']['transfer']       = $rd['amt_paid'];
                                        $feecodearray['OTH']['transfer_p']     = $rd['amt_paid'];
                                        $transfertotal =  $feecodearray['OTH']['transfer'];
                                        $transfertotal_po =  $feecodearray['OTH']['transfer_p'];
                                    }
                                }
                                if (isset($rd['vat_paid']) && $rd['vat_paid'] > 0) {
                                    $feecodearray['F103']['transfer']       += $rd['vat_paid'];
                                    $feecodearray['F103']['transfer_p']     += $rd['vat_paid'];
                                    $vatt_total = $feecodearray['F103']['transfer'];
                                    $vatt_total_o_p = $feecodearray['F103']['transfer_p'];
                                }
                                if (isset($rd['round_off']) && $rd['is_penalty'] == 0) { //&& $rd['round_off'] > 0
                                    $feecodearray['F102']['transfer']       += $rd['round_off'];
                                    $feecodearray['F102']['transfer_p']     += $rd['round_off'];
                                    $roundoff_total = $feecodearray['F102']['transfer'];
                                    $roundoff_total_o_p = $feecodearray['F102']['transfer_p'];
                                }
                                if ($rd['is_penalty'] == 1) {
                                    if (isset($rd['penalty_paid']) && $rd['penalty_paid'] > 0) {
                                        $feecodearray['F104']['transfer']       += $rd['penalty_paid'];
                                        $feecodearray['F104']['transfer_p']       += $rd['penalty_paid'];
                                        $penalty_total = $feecodearray['F104']['transfer'];
                                        $penalty_total_o_p = $feecodearray['F104']['transfer_p'];
                                    }
                                }
                                $ttotal += $transfertotal_p;
                            }
                            $feecodearray['OTH']['total'] = $cashtotal_o + $dbttotal_o + $chequetotal_o + $cardtotal_o + $onlinetotal_o + $transfertotal_po;
                            $feecodearray['F103']['total'] = ($vatt_total_o_c + $vatt_total_o_d + $vatt_total_o_q + $vatt_total_o_r + $vatt_total_o_p + $vatt_total_o_o);
                            //$feecodearray['F025']['total'] = $serchg_total_o_r;
                            $feecodearray['F102']['total'] = $roundoff_total_o_c + $roundoff_total_o_d + $roundoff_total_o_q + $roundoff_total_o_r + $roundoff_total_o_p + $roundoff_total_o_o;
                            //$feecodearray['F104']['total'] = $feecodearray['F104']['cash'] + $feecodearray['F104']['dbt'] + $feecodearray['F104']['cheque'] + $feecodearray['F104']['card'] + $feecodearray['F104']['transfer_p'];
                        } else {
                            if ($rd['trans_type'] == 'C') {
                                if (isset($feecodearray[$rd['feeCode']]['cash'])) {
                                    $feecodearray[$rd['feeCode']]['cash']       += $rd['amt_paid'];
                                    $cashtotal_nd =  $feecodearray[$rd['feeCode']]['cash'];
                                } else {
                                    $feecodearray[$rd['feeCode']]['cash']       = $rd['amt_paid'];
                                    $cashtotal_nd =  $feecodearray[$rd['feeCode']]['cash'];
                                }

                                if (isset($rd['vat_paid']) && $rd['vat_paid'] > 0) {
                                    $feecodearray['F103']['cash']       += $rd['vat_paid'];
                                    $vatt_total_nd = $feecodearray['F103']['cash'];
                                }
                                if (isset($rd['round_off'])) { //&& $rd['round_off'] > 0
                                    $feecodearray['F102']['cash']       += $rd['round_off'];
                                    $roundoff_total_nd = $feecodearray['F102']['cash'];
                                }
                                if (isset($rd['penalty_paid']) && $rd['penalty_paid'] > 0) {
                                    $feecodearray['F104']['cash']       = $rd['penalty_paid'];
                                    $penalty_total_nd = $feecodearray['F104']['cash'];
                                }
                                $ttotal_nd += $cashtotal_nd; //($cashtotal + $vatt_total + $roundoff_total);
                                $feecodearray[$rd['feeCode']]['total']   = $ttotal_nd;
                                $feecodearray['F103']['total']   = $vatt_total_nd;
                                $feecodearray['F102']['total']   = $roundoff_total_nd;
                                $feecodearray['F104']['total']   = $penalty_total_nd;
                            }
                            if ($rd['trans_type'] == 'D') {
                                if (isset($feecodearray[$rd['feeCode']]['dbt'])) {
                                    $feecodearray[$rd['feeCode']]['dbt']       += $rd['amt_paid'];
                                    $dbttotal_nd =  $feecodearray[$rd['feeCode']]['dbt'];
                                } else {
                                    $feecodearray[$rd['feeCode']]['dbt']       = $rd['amt_paid'];
                                    $dbttotal_nd =  $feecodearray[$rd['feeCode']]['dbt'];
                                }

                                if (isset($rd['vat_paid']) && $rd['vat_paid'] > 0) {
                                    $feecodearray['F103']['dbt']       += $rd['vat_paid'];
                                    $vatt_total_nd = $feecodearray['F103']['dbt'];
                                }
                                if (isset($rd['round_off'])) { //&& $rd['round_off'] > 0
                                    $feecodearray['F102']['dbt']       += $rd['round_off'];
                                    $roundoff_total_nd = $feecodearray['F102']['dbt'];
                                }
                                if (isset($rd['penalty_paid']) && $rd['penalty_paid'] > 0) {
                                    $feecodearray['F104']['dbt']       = $rd['penalty_paid'];
                                    $penalty_total_nd = $feecodearray['F104']['dbt'];
                                }
                                $ttotal_nd += $dbttotal_nd; //($dbttotal + $vatt_total + $roundoff_total);
                                $feecodearray[$rd['feeCode']]['total']   = $ttotal_nd;
                                $feecodearray['F103']['total']   = $vatt_total_nd;
                                $feecodearray['F102']['total']   = $roundoff_total_nd;
                                $feecodearray['F104']['total']   = $penalty_total_nd;
                            }
                            if ($rd['trans_type'] == 'Q') {
                                if (isset($feecodearray[$rd['feeCode']]['cheque'])) {
                                    $feecodearray[$rd['feeCode']]['cheque']       += $rd['amt_paid'];
                                    $chequetotal_nd =  $feecodearray[$rd['feeCode']]['cheque'];
                                } else {
                                    $feecodearray[$rd['feeCode']]['cheque']       = $rd['amt_paid'];
                                    $chequetotal_nd =  $feecodearray[$rd['feeCode']]['cheque'];
                                }

                                if (isset($rd['vat_paid']) && $rd['vat_paid'] > 0) {
                                    $feecodearray['F103']['cheque']       += $rd['vat_paid'];
                                    $vatt_total_nd = $feecodearray['F103']['cheque'];
                                }
                                if (isset($rd['round_off'])) { //&& $rd['round_off'] > 0
                                    $feecodearray['F102']['cheque']       += $rd['round_off'];
                                    $roundoff_total_nd = $feecodearray['F102']['cheque'];
                                }
                                if (isset($rd['penalty_paid']) && $rd['penalty_paid'] > 0) {
                                    $feecodearray['F104']['cheque']       = $rd['penalty_paid'];
                                    $penalty_total_nd = $feecodearray['F104']['cheque'];
                                }
                                $ttotal_nd += $chequetotal_nd; //($chequetotal + $vatt_total + $roundoff_total);
                                $feecodearray[$rd['feeCode']]['total']   = $ttotal_nd;
                                $feecodearray['F103']['total']   = $vatt_total_nd;
                                $feecodearray['F102']['total']   = $roundoff_total_nd;
                                $feecodearray['F104']['total']   = $penalty_total_nd;
                            }
                            if ($rd['trans_type'] == 'R') {
                                if (isset($feecodearray[$rd['feeCode']]['card'])) {
                                    $feecodearray[$rd['feeCode']]['card']       += $rd['amt_paid'];
                                    $cardtotal_nd =  $feecodearray[$rd['feeCode']]['card'];
                                } else {
                                    $feecodearray[$rd['feeCode']]['card']       = $rd['amt_paid'];
                                    $cardtotal_nd =  $feecodearray[$rd['feeCode']]['card'];
                                }

                                if (isset($rd['vat_paid']) && $rd['vat_paid'] > 0) {
                                    $feecodearray['F103']['card']       += $rd['vat_paid'];
                                    $vatt_total_nd = $feecodearray['F103']['card'];
                                }
                                if (isset($rd['round_off'])) { //&& $rd['round_off'] > 0
                                    $feecodearray['F102']['card']       += $rd['round_off'];
                                    $roundoff_total_nd = $feecodearray['F102']['card'];
                                }
                                if (isset($rd['ser_charge']) && $rd['ser_charge'] > 0) {
                                    $feecodearray['F025']['card']       += $rd['ser_charge'];
                                    $serchg_total_nd = $feecodearray['F025']['card'];
                                }
                                if (isset($rd['penalty_paid']) && $rd['penalty_paid'] > 0) {
                                    $feecodearray['F104']['card']       = $rd['penalty_paid'];
                                    $penalty_total_nd = $feecodearray['F104']['card'];
                                }
                                $ttotal_nd += $cardtotal_nd; //($cardtotal + $vatt_total + $roundoff_total + $serchg_total);
                                // $feecodearray[$rd['feeCode']]['total']   = $ttotal_nd;
                                // $feecodearray['F025']['total']   = $serchg_total_nd;
                                // $feecodearray['F103']['total']   = $vatt_total_nd;
                                // $feecodearray['F102']['total']   = $roundoff_total_nd;
                            }
                            if ($rd['trans_type'] == 'O') {
                                if (isset($feecodearray[$rd['feeCode']]['online'])) {
                                    $feecodearray[$rd['feeCode']]['online']       += $rd['amt_paid'];
                                    $onlinetotal_nd =  $feecodearray[$rd['feeCode']]['online'];
                                } else {
                                    $feecodearray[$rd['feeCode']]['online']       = $rd['amt_paid'];
                                    $onlinetotal_nd =  $feecodearray[$rd['feeCode']]['online'];
                                }
                                $ttotal_nd += $onlinetotal_nd; //($cashtotal + $vatt_total + $roundoff_total);
                                $feecodearray[$rd['feeCode']]['total']   = $ttotal_nd;
                            }
                            // $onlinetotal_nd = 0; //Should Calculate as above
                            $feecodearray[$rd['feeCode']]['total'] = ($cashtotal_nd + $dbttotal_nd + $chequetotal_nd + $cardtotal_nd + $onlinetotal_nd); // - ($feecodearray['F025']['total'] + $feecodearray['F103']['total'] + $feecodearray['F102']['total']);
                            $feecodearray['F025']['total'] = $surcharge_amount;
                        }
                    }
                    $feecodearray['F104']['total'] = $nr_penalty + $tr_penalty;
                    //$ttotal = $cashtotal + $chequetotal + $cardtotal + $onlinetotal; // + $transfertotal;
                    $gtotal = $ttotal; // - $transfertotal;
                    //$feecodearray[$rd['feeCode']]['total']   = $ttotal;
                    $feecodearray[$rd['feeCode']]['feetotal']   = $feecodearray[$rd['feeCode']]['total'] - $feecodearray[$rd['feeCode']]['transfer'];
                    $feecodearray['OTH']['feetotal']   = $feecodearray['OTH']['total'] - $feecodearray['OTH']['transfer'];
                    $feecodearray['F025']['feetotal']   = $feecodearray['F025']['total'] - $feecodearray['F025']['transfer'];
                    $feecodearray['F103']['feetotal']   = $feecodearray['F103']['total'] - $feecodearray['F103']['transfer'];
                    $feecodearray['F102']['feetotal']   = $feecodearray['F102']['total'] - $feecodearray['F102']['transfer'];
                    $feecodearray['F104']['feetotal']   = $feecodearray['F104']['total'] - $feecodearray['F104']['transfer'];
                } else {
                    if (!(isset($feecodearray[$feescode['feeCode']]))) {
                        $feecodearray[$feescode['feeCode']]['cash'] = 0;
                        $feecodearray[$feescode['feeCode']]['dbt'] = 0;
                        $feecodearray[$feescode['feeCode']]['cheque'] = 0;
                        $feecodearray[$feescode['feeCode']]['card'] = 0;
                        $feecodearray[$feescode['feeCode']]['online'] = 0;
                        $feecodearray[$feescode['feeCode']]['transfer_p'] = 0;
                        $feecodearray[$feescode['feeCode']]['transfer'] = 0;
                        $feecodearray[$feescode['feeCode']]['total'] = 0;
                        $feecodearray[$feescode['feeCode']]['feetotal'] = 0;
                    }
                }
            }
        }
        // return $feecodearray;

        // Find total in Each Column Above
        foreach ($feecodearray as $key => $value) {
            $tcashtotal += $value['cash'];
            $tdbttotal += $value['dbt'];
            $tchequetotal += $value['cheque'];
            $tcardtotal += $value['card'];
            $tonlinetotal += $value['online'];
            $ttransfertotal += $value['transfer'];
            $ttransfertotal_p += $value['transfer_p'];
            $gttotal += $value['total'];
            $ggtotal += $value['feetotal'];
        }

        $feecodearray['TOTAL']['cash']           =   $cct = $tcashtotal - ($feecodearray['F103']['cash'] + $feecodearray['F102']['cash']);
        $feecodearray['TOTAL']['dbt']            =   $dbt = $tdbttotal - ($feecodearray['F103']['dbt'] + $feecodearray['F102']['dbt']);
        $feecodearray['TOTAL']['cheque']         =   $cht = $tchequetotal - ($feecodearray['F103']['cheque'] + $feecodearray['F102']['cheque']);
        $feecodearray['TOTAL']['card']           =   $crt = $tcardtotal + $surcharge_amount - ($feecodearray['F025']['card'] + $feecodearray['F103']['card'] + $feecodearray['F102']['card']);
        $feecodearray['TOTAL']['online']         =   $tonlinetotal;
        $feecodearray['TOTAL']['transfer_p']     =   $ctp = $ttransfertotal_p - ($feecodearray['F025']['transfer_p'] + $feecodearray['F103']['transfer_p'] + $feecodearray['F102']['transfer_p']);
        $feecodearray['TOTAL']['roundoff']       =   $roundoff_amount;
        $feecodearray['TOTAL']['transfer']       =   $ctt = $ttransfertotal - ($feecodearray['F025']['transfer'] + $feecodearray['F103']['transfer'] + $feecodearray['F102']['transfer']);
        $feecodearray['TOTAL']['total']          =   $gttotal +  $surcharge_amount - ($feecodearray['F025']['total'] + $feecodearray['F103']['total'] + $feecodearray['F102']['total']);
        $feecodearray['TOTAL']['feetotal']       =   ($gttotal +  $surcharge_amount + $roundoff_amount - ($feecodearray['F025']['total'] + $feecodearray['F103']['total'] + $feecodearray['F102']['total'])) - $ctt; //'-'; //$ggtotal + $ttransfertotal;

        $feecodearray['TRANSTYPES']['cash']       =   'Cash';
        $feecodearray['TRANSTYPES']['dbt']        =   'Direct Bank';
        $feecodearray['TRANSTYPES']['cheque']     =   'Cheque';
        $feecodearray['TRANSTYPES']['card']       =   'Card';
        $feecodearray['TRANSTYPES']['online']     =   'Online';
        $feecodearray['TRANSTYPES']['transfer_p'] =   'Transfer (+)';
        $feecodearray['TRANSTYPES']['total']      =   'Total';
        $feecodearray['TRANSTYPES']['transfer']   =   'Transfer (-)';
        $feecodearray['TRANSTYPES']['roundoff']   =   'Round Off';
        $feecodearray['TRANSTYPES']['feetotal']   =   'Fees Total';
        // return $crt;
        // return $nr_penalty;
        //Mini Summary Box
        $minisummarray['cash']           =   $cct; //$tcashtotal;
        $minisummarray['dbt']            =   $dbt; //$tchequetotal;
        $minisummarray['cheque']         =   $cht; //$tchequetotal;
        $minisummarray['card']           =   $crt; //$tcardtotal;
        $minisummarray['online']         =   $tonlinetotal;
        // $minisummarray['penalty']         =  $penaltyamt;
        // $minisummarray['surcharge']     =    $scharge = $surcharge_amount + $ser_pros_fee;
        $minisummarray['prospectus']     =   $pros_amt = $prospectus_amount + $ser_pros_fee;
        $minisummarray['regfee']         =   $regfee_amt = $regfee_amount; // + $ser_reg_fee; //need to implement
        $minisummarray['round_off']      =   $roundoff_amount;
        $minisummarray['taxamount']      =   $ttt = $feecodearray['F103']['total'];
        $minisummarray['transfer']       =   $ctp; //$ttransfertotal;
        $minisummarray['grossamount']    =   $grossamount = $cct + $dbt + $cht + $crt + $tonlinetotal + $ctp + $pros_amt + $regfee_amt; // + $scharge; //$gttotal + $ttransfertotal;
        $minisummarray['transferless']   =   $ttransfertotal; //$ctt;
        $minisummarray['paybackless']    =   $approved_pbtamt; // Should calculate 
        $minisummarray['netamount']      =   $nettamt = ($grossamount + $roundoff_amount + $ttt) - ($ttransfertotal + $approved_pbtamt); //$ttransfertotal - here 0 as payback total. should calculate

        // $penaltyamt = $feecodearray['F104']['feetotal'];
        // return $feecodearray['F104']['feetotal'];
        //Total Summary Box

        $totsummarray['Amount Collected']['amount']     = $feecollected = ($cct + $dbt + $cht + $crt + $tonlinetotal + $roundoff_amount) - ($nr_penalty + $vat_amount + $vatt_total_p + $surcharge_amount + $roundoff_amount); // - ($nr_penalty + $vat_amount + $vatt_total_p + $surcharge_amount + $roundoff_amount);
        // $totsummarray['Amount Collected']['amount']     = $feecollected = ((($tcashtotal - $nr_penalty) + $tdbttotal + $tchequetotal + $tcardtotal + $tonlinetotal) - ($vat_amount - $vatt_total_p) - $surcharge_amount - $roundoff_amount);
        // $totsummarray['Amount Collected']['amount']     = $feecollected = $nettamt;
        $totsummarray['Amount Collected']['transfer']   = $ttransfertotal - $tr_penalty;
        $totsummarray['Amount Collected']['vat']        = $feesvat = ($vat_amount - $vatt_total_p); // Should calculate 
        $totsummarray['Amount Collected']['total']      = $af = $feecollected + $feesvat;

        $totsummarray['Penalty']['amount']     = $nr_penalty; //$penaltyamt; // Should calculate 
        $totsummarray['Penalty']['transfer']   = $pen_transfer = $tr_penalty; // Should calculate 
        $totsummarray['Penalty']['vat']        = $pensvat = 0; // Should calculate 
        $totsummarray['Penalty']['total']      = $bf = $nr_penalty + $pensvat;

        $totsummarray['Prospectus Fees']['amount']     = $prospectusfee = $prospectus_amount; // Should calculate 
        $totsummarray['Prospectus Fees']['transfer']   = $prostransfer = 0; // Should calculate 
        $totsummarray['Prospectus Fees']['vat']        = $prosvat = 0; // Should calculate 
        $totsummarray['Prospectus Fees']['total']      = $pf = $prospectusfee + $prosvat;

        $totsummarray['Registration Fees']['amount']     = $regfee = $regfee_amount; // Should calculate 
        $totsummarray['Registration Fees']['transfer']   = $regtransfer = 0; // Should calculate 
        $totsummarray['Registration Fees']['vat']        = $regvat = 0; // Should calculate 
        $totsummarray['Registration Fees']['total']      = $rgf = $regfee + $regvat;

        $totsummarray['Service Charge']['amount']     = $surchargefee = $surcharge_amount + $ser_pros_fee; // Should calculate 
        $totsummarray['Service Charge']['transfer']   = $surchargetransfer = 0; // Should calculate 
        $totsummarray['Service Charge']['vat']        = $surchargevat = 0; // Should calculate 
        $totsummarray['Service Charge']['total']      = $ef = $surchargefee + $surchargevat;

        $totsummarray['Round Off']['amount']     = $roundofffee = $roundoff_amount; // Should calculate 
        $totsummarray['Round Off']['transfer']   = $roundofftransfer = 0; // Should calculate 
        $totsummarray['Round Off']['vat']        = $roundoffvat = 0; // Should calculate 
        $totsummarray['Round Off']['total']      = $rf = $roundofffee + $roundoffvat;

        $totsummarray['Payback Amount (-)']['amount']     = $paybackamount = $approved_pbtamt; // Should calculate 
        $totsummarray['Payback Amount (-)']['transfer']   = $pybktransfer = 0; // Should calculate 
        $totsummarray['Payback Amount (-)']['vat']        = $pybkvat = 0; // Should calculate 
        $totsummarray['Payback Amount (-)']['total']      = $cf = $paybackamount + $pybkvat;

        $totsummarray['Total']['amount']     = $ftotal = (($feecollected + $prospectusfee + $regfee + $surchargefee + $nr_penalty + ($roundofffee)) - $paybackamount);
        $totsummarray['Total']['transfer']   = $transtotal = (($ttransfertotal + $prostransfer + $regtransfer + $surchargetransfer + ($roundofftransfer)) - $pybktransfer);
        $totsummarray['Total']['vat']        = $vattotal = (($feesvat + $prosvat + $regvat + $surchargevat + ($roundoffvat)) - $pybkvat);
        $totsummarray['Total']['total']      = $df = (($af + $bf + $ef) - $cf) + ($rf) + $pf + $rgf;
        //SEPT24 ENDS

        $otherdetails_data = array();
        //non_demandble_amount
        $non_demandble_amount = 0;
        $nd_transfer_amt = 0;
        $non_demandble_data = $this->MReport->get_received_non_demandable_data($apikey, $inst_id, $acd_year_id, $from_date, $to_date, 0);
        if (isset($non_demandble_data) && !empty($non_demandble_data) && count($non_demandble_data) > 0) {
            //$non_demandble_amount = $non_demandble_data[0]['non_demandble_amount'];
            foreach ($non_demandble_data as $ndd) {
                if ($ndd['payment_mode_id'] == 5 && $ndd['is_others'] == 0) {
                    $nd_transfer_amt += $ndd['amt_paid'] + $ndd['vat_amt'];
                }
                $non_demandble_amount += $ndd['amt_paid'] + $ndd['vat_amt'];
            }
        } else $non_demandble_amount = 0;


        $otherdetails_data['Amount Subjected For Realization'] = $cnr_amount; // Should Calculate
        $otherdetails_data['Non Demandable Fees Collected'] = $non_demandble_amount; // - $nd_transfer_amt;
        $otherdetails_data['(Transfer) Concession Given'] = ($concession_amount + $st_concession_amount); // Should Calculate
        $otherdetails_data['(Transfer) Exemption Given'] = $exemption_amount; // Should Calculate
        $otherdetails_data['(Transfer) Fee Adjusted From Wallet'] = $ttransfertotal; // Should Calculate

        $primary_fee_code_data = $this->MReport->get_all_demandable_feecodes_available($apikey, $inst_id, 'dfco'); //dfco = demandable fee codes only
        $primary_fee_code_data[] = array(
            'feeCode' => 'F023',
            'fee_shortcode' => 'DW',
            'description' => 'DOCME WALLET DEPOSIT'
        );
        $primary_fee_code_data[] = array(
            'feeCode' => 'F104',
            'fee_shortcode' => 'FINE',
            'description' => 'PENALTY'
        );
        $primary_fee_code_data[] = array(
            'feeCode' => 'F025',
            'fee_shortcode' => 'BCH',
            'description' => 'SERVICE CHARGE'
        );
        // $primary_fee_code_data[] = array(
        //     'feeCode' => 'F102',
        //     'fee_shortcode' => 'RND',
        //     'description' => 'ROUND OFF'
        // );
        $primary_fee_code_data[] = array(
            'feeCode' => 'OTH',
            'fee_shortcode' => 'OTH',
            'description' => 'OTHERS (NON DEMANDABLE FEES)'
        );
        //return $primary_fee_code_data;
        $non_demandable_feecodes = $this->MReport->get_all_feecodes_non_demandable($apikey, $inst_id);
        $summary_out_array = array(
            'data_status' => 1,
            'message' => 'Data extracted',
            'data' => $formatted_data,
            'feesummary' => $feecodearray,
            'minisummary' => $minisummarray,
            'totalsummary' => $totsummarray,
            'otherdetails' => $otherdetails_data,
            'ndmd_feedetails' => $ndmd_array,
            'non_demandable_feecodes' => $non_demandable_feecodes,
            'feecodes' => $primary_fee_code_data,
            'sercharge_for_payments' => $ser_amount,
            'roundoff_for_payments' => $roundoff_amount
        );

        if (isset($summary_out_array) && !empty($summary_out_array)) {
            return $summary_out_array;
        } else {
            return array('data_status' => 0, 'message' => 'No data available', 'data' => NULL, 'feecodes' => $primary_fee_code_data);
        }
    }
    private function format_data_for_summary_collection($report_data, $primary_fee_code_data)
    {
        $formatted_data = array();
        $demand_date = array();
        $feecode_data = array();
        $pay_type = array();

        foreach ($report_data as $rptdata) {
            if (in_array($rptdata['demand_date'], $demand_date)) {
                if (in_array($rptdata['payment_type_name'], $pay_type[$rptdata['demand_date']])) {
                    if (in_array($rptdata['feeCode'], $feecode_data[$rptdata['demand_date']][$rptdata['payment_type_name']])) {
                        $dt_count = count($formatted_data[$rptdata['demand_date']][$rptdata['payment_type_name']][$rptdata['feeCode']]);
                        $formatted_data[$rptdata['demand_date']][$rptdata['payment_type_name']][$rptdata['feeCode']][$dt_count] = array(
                            'demand_date' => $rptdata['demand_date'],
                            'feeCode' => $rptdata['feeCode'],
                            'fee_code_description' => $rptdata['fee_code_description'],
                            'payment_type_name' => $rptdata['payment_type_name'],
                            'amt_paid' => $rptdata['amt_paid']
                        );
                    } else {
                        $feecode_data[$rptdata['demand_date']][$rptdata['payment_type_name']][] = $rptdata['feeCode'];
                        $formatted_data[$rptdata['demand_date']][$rptdata['payment_type_name']][$rptdata['feeCode']] = array(
                            'demand_date' => $rptdata['demand_date'],
                            'feeCode' => $rptdata['feeCode'],
                            'fee_code_description' => $rptdata['fee_code_description'],
                            'payment_type_name' => $rptdata['payment_type_name'],
                            'amt_paid' => $rptdata['amt_paid']
                        );
                    }
                } else {
                    $pay_type[$rptdata['demand_date']][] = $rptdata['payment_type_name'];
                    $feecode_data[$rptdata['demand_date']][$rptdata['payment_type_name']][] = $rptdata['feeCode'];
                    $formatted_data[$rptdata['demand_date']][$rptdata['payment_type_name']][$rptdata['feeCode']] = array(
                        'demand_date' => $rptdata['demand_date'],
                        'feeCode' => $rptdata['feeCode'],
                        'fee_code_description' => $rptdata['fee_code_description'],
                        'payment_type_name' => $rptdata['payment_type_name'],
                        'amt_paid' => $rptdata['amt_paid']
                    );
                }
            } else {
                $demand_date[] = $rptdata['demand_date'];
                $pay_type[$rptdata['demand_date']][] = $rptdata['payment_type_name'];
                $feecode_data[$rptdata['demand_date']][$rptdata['payment_type_name']][] = $rptdata['feeCode'];


                $formatted_data[$rptdata['demand_date']][$rptdata['payment_type_name']][$rptdata['feeCode']] = array(
                    'demand_date' => $rptdata['demand_date'],
                    'feeCode' => $rptdata['feeCode'],
                    'fee_code_description' => $rptdata['fee_code_description'],
                    'payment_type_name' => $rptdata['payment_type_name'],
                    'amt_paid' => $rptdata['amt_paid']
                );
            }
        }

        $fine_formatted_data = array();
        foreach ($formatted_data as $ddate => $rpt1_lvl1) {
            foreach ($rpt1_lvl1 as $paytype => $rpt_lvl2) {
                foreach ($rpt_lvl2 as $fcode => $rpt_lvl3) {
                    foreach ($primary_fee_code_data as $feescode) {
                        if ($feescode['feeCode'] == $fcode && $paytype == $rpt_lvl3['payment_type_name']) {
                            $fine_formatted_data[$ddate][$paytype][$fcode] = $rpt_lvl3;
                        } else {
                            if (!(isset($fine_formatted_data[$ddate][$paytype][$feescode['feeCode']]))) {
                                $fine_formatted_data[$ddate][$paytype][$feescode['feeCode']] = array(
                                    'demand_date' => $ddate,
                                    'feeCode' => $feescode['feeCode'],
                                    'fee_code_description' => $feescode['description'],
                                    'payment_type_name' => $paytype,
                                    'amt_paid' => 0
                                );
                            }
                        }
                    }
                }
            }
        }
        return $fine_formatted_data;
    }

    //NON DEMANDABLE FEE COLLECTION REPORT
    public function get_received_non_demandable_report($params)
    {
        $apikey = $params['API_KEY'];

        if (!(isset($params['inst_id']) && !empty($params['inst_id']))) {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Inst code is required', 'data' => FALSE);
        } else {
            $inst_id = $params['inst_id'];
        }
        if (!(isset($params['acd_year_id']) && !empty($params['acd_year_id']))) {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Academic year data is required', 'data' => FALSE);
        } else {
            $acd_year_id = $params['acd_year_id'];
        }

        if (!(isset($params['from_date']) && !empty($params['from_date']))) {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'From date data is required', 'data' => FALSE);
        } else {
            $from_date = $params['from_date'];
        }

        if (!(isset($params['to_date']) && !empty($params['to_date']))) {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'To date data is required', 'data' => FALSE);
        } else {
            $to_date = $params['to_date'];
        }
        $report_data = $this->MReport->get_received_non_demandable_data($apikey, $inst_id, $acd_year_id, $from_date, $to_date, 0);

        if (isset($report_data) && !empty($report_data) && count($report_data) > 0) {
            return array('data_status' => 1, 'data' => $report_data);
        } else {
            return array('data_status' => 0, 'message' => 'No data is available');
        }
    }

    //INDIVIDUAL COLLECTION REPORT
    public function get_individual_collection_report($params)
    {
        $apikey = $params['API_KEY'];

        if (!(isset($params['inst_id']) && !empty($params['inst_id']))) {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Inst code is required', 'data' => FALSE);
        } else {
            $inst_id = $params['inst_id'];
        }
        if (!(isset($params['acd_year_id']) && !empty($params['acd_year_id']))) {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Academic year data is required', 'data' => FALSE);
        } else {
            $acd_year_id = $params['acd_year_id'];
        }

        if (!(isset($params['from_date']) && !empty($params['from_date']))) {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'From date data is required', 'data' => FALSE);
        } else {
            $from_date = $params['from_date'];
        }

        if (!(isset($params['to_date']) && !empty($params['to_date']))) {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'To date data is required', 'data' => FALSE);
        } else {
            $to_date = $params['to_date'];
        }
        if (!(isset($params['student_id']) && !empty($params['student_id']))) {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Student data is required', 'data' => FALSE);
        } else {
            $student_id = $params['student_id'];
        }
        $include_transfer = $params['include_transfer'];
        $report_data = $this->MReport->get_individual_collection_with_voucher_data($apikey, $inst_id, $acd_year_id, $from_date, $to_date, $student_id, $include_transfer);
        $report_data_chq = $this->MReport->get_individual_cheque_collection_with_voucher_data($apikey, $inst_id, $acd_year_id, $from_date, $to_date, $student_id);
        // return $report_data_chq;
        $sur_array = array();
        $transfer_amount = 0;
        $wallet_deposit_tr = 0;
        $total_ncr_chq_amt = 0;
        $arrcnt = 0;
        if (isset($report_data_chq) && !empty($report_data_chq) && count($report_data_chq) > 0) {
            foreach ($report_data_chq as $rdq) {
                $total_ncr_chq_amt += $rdq['voucher_amount'];
                $voucher_array_ncr[$rdq['voucher_date']][] = $rdq;
            }
            $arrcnt++;
        }
        if (isset($report_data) && !empty($report_data) && count($report_data) > 0) {
            foreach ($report_data as $rd) {
                if ($rd['payment_mode_id'] == 5 && $rd['is_others'] == 0) {
                    $transfer_amount += $rd['voucher_amount'];
                }
                if (substr($rd['voucher_code'], 0, 8) == 'RIMS_ADJ') {
                    $transfer_amount += $rd['voucher_amount'];
                }
                if ($rd['is_payback_credit'] == 1 && $rd['is_wallet_withdrawal'] == 0) {
                    $wallet_deposit_tr += $rd['voucher_amount'];
                }
                $sur_array['extradetails'][$rd['voucher_code']]['surcharge'] = $rd['surcharge'];
                $sur_array['extradetails'][$rd['voucher_code']]['roundoff'] = $rd['round_off'];
            }
            $servicecharge = 0;
            $roundoff = 0;
            if (is_array($sur_array['extradetails']) && !empty($sur_array['extradetails'])) {
                foreach ($sur_array['extradetails'] as $key => $values) {
                    $servicecharge += $values['surcharge'];
                    $roundoff += $values['roundoff'];
                }
            }
            foreach ($report_data as $rda) {
                $voucher_array[$rda['voucher_date']][] = $rda;
            }
            // return $voucher_array;//$report_data
            $arrcnt++;
        }
        if ($arrcnt > 0) {
            return array('data_status' => 1, 'data' => $voucher_array, 'ncr_chq' => $total_ncr_chq_amt, 'ncr_data' => $voucher_array_ncr, 'transfer_amount' => $transfer_amount, 'wallet_deposit_tr' => $wallet_deposit_tr, 'servicecharge' => $servicecharge, 'roundoff' => $roundoff);
        } else {
            return array('data_status' => 0, 'message' => 'No data is available');
        }
    }

    //COLLECTION CLASS WISE SUMMARY
    public function get_collection_class_wise_summary_report_data($params)
    {
        $apikey = $params['API_KEY'];

        if (!(isset($params['inst_id']) && !empty($params['inst_id']))) {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Inst code is required', 'data' => FALSE);
        } else {
            $inst_id = $params['inst_id'];
        }
        if (!(isset($params['acd_year_id']) && !empty($params['acd_year_id']))) {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Academic year data is required', 'data' => FALSE);
        } else {
            $acd_year_id = $params['acd_year_id'];
        }

        if (!(isset($params['from_date']) && !empty($params['from_date']))) {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'From date data is required', 'data' => FALSE);
        } else {
            $from_date = $params['from_date'];
        }

        if (!(isset($params['to_date']) && !empty($params['to_date']))) {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'To date data is required', 'data' => FALSE);
        } else {
            $to_date = $params['to_date'];
        }
        $include_transfer = $params['include_transfer'];

        $report_data = $this->MReport->get_collection_class_wise_summary_data($apikey, $inst_id, $acd_year_id, $from_date, $to_date, $include_transfer);
        //return $report_data;
        $voucher_collection_details = $this->MReport->get_voucher_collection_details($apikey, $inst_id, $acd_year_id, $from_date, $to_date);

        if (isset($voucher_collection_details) && !empty($voucher_collection_details) && count($voucher_collection_details) > 0) {
            //$surcharge_amount = $voucher_collection_details[0]['SERVICE_CHARGE_COLLECTED'];
            $serchg = json_decode($voucher_collection_details[0]['SURCHARGE_DETAILS'], true);
            $samt = 0;
            if (is_array($serchg) && !empty($serchg[0])) {
                foreach ($serchg as $sr) {
                    if ($sr['is_pros_fee'] != 1 and $sr['is_pros_fee'] != 2) {
                        $samt += $sr['SERVICE_CHARGE_COLLECTED'];
                    }
                }
            }
            $surcharge_amount = $samt;

            $rndoff = json_decode($voucher_collection_details[0]['ROUNDOFF_DETAILS'], true);
            if (is_array($rndoff) && !empty($rndoff)) {
                foreach ($rndoff as $rnd_amt) {
                    $roundoff_amount += $rnd_amt['ROUNDOFF_COLLECTED'];
                }
            }

            $pbkamt = json_decode($voucher_collection_details[0]['PBK_DETAILS'], true);
            if (is_array($pbkamt) && !empty($pbkamt)) {
                foreach ($pbkamt as $pb) {
                    $approved_pbtamt += $pb['PBK_COLLECTED'];
                }
            }
        } else {
            $surcharge_amount = 0;
            $roundoff_amount = 0;
            $approved_pbtamt = 0;
        }
        //return $voucher_collection_details;
        $primary_fee_code_data = $this->MReport->get_all_feecodes_available($apikey, $inst_id);

        $primary_fee_code_data[] = array(
            'feeCode' => 'OTH',
            'description' => 'OTHERS',
            'fee_shortcode' => 'OTH'
        );
        //need to check Other fee Transfer Here as demndable fee
        $transfer_total = 0;
        $final_array = array();
        $ndmd_array = array();
        if (!empty($report_data)) {
            foreach ($report_data as $rdata) {
                foreach ($primary_fee_code_data as $feescode) {
                    if ($feescode['feeCode'] == $rdata['feeCode']) {
                        if ($feescode['demandType'] == 1) {
                            if ($rdata['is_others'] == 0 && $rdata['payment_mode_id'] == 5) {
                                $transfer_total = $transfer_total + $rdata['amt_paid'];
                            }
                            if ($rdata['is_penalty'] == 0) {
                                if ($include_transfer != 1) {
                                    if ($rdata['is_others'] == 0 && $rdata['payment_mode_id'] == 5) {
                                        $amount_paid = 0;
                                    } else {
                                        $amount_paid = $rdata['amt_paid'];
                                    }
                                    if (isset($final_array[$rdata['class_name']][$rdata['batch_name']][$rdata['voucher_date']][$rdata['feeCode']]))
                                        $final_array[$rdata['class_name']][$rdata['batch_name']][$rdata['voucher_date']][$rdata['feeCode']] += $amount_paid;
                                    else
                                        $final_array[$rdata['class_name']][$rdata['batch_name']][$rdata['voucher_date']][$rdata['feeCode']] = $amount_paid;
                                } else {
                                    if (isset($final_array[$rdata['class_name']][$rdata['batch_name']][$rdata['voucher_date']][$rdata['feeCode']]))
                                        $final_array[$rdata['class_name']][$rdata['batch_name']][$rdata['voucher_date']][$rdata['feeCode']] += $rdata['amt_paid'];
                                    else
                                        $final_array[$rdata['class_name']][$rdata['batch_name']][$rdata['voucher_date']][$rdata['feeCode']] = $rdata['amt_paid'];
                                }
                            }
                            if ($rdata['is_penalty'] == 1) {
                                if ($include_transfer != 1) {
                                    if ($rdata['is_others'] == 0 && $rdata['payment_mode_id'] == 5) {
                                        $penalty_paid = 0;
                                    } else {
                                        $penalty_paid = $rdata['penalty_paid'];
                                    }
                                    if (isset($final_array[$rdata['class_name']][$rdata['batch_name']][$rdata['voucher_date']]['F104']))
                                        $final_array[$rdata['class_name']][$rdata['batch_name']][$rdata['voucher_date']]['F104'] += $penalty_paid;
                                    else
                                        $final_array[$rdata['class_name']][$rdata['batch_name']][$rdata['voucher_date']]['F104'] = $penalty_paid;
                                } else {
                                    if (isset($final_array[$rdata['class_name']][$rdata['batch_name']][$rdata['voucher_date']]['F104']))
                                        $final_array[$rdata['class_name']][$rdata['batch_name']][$rdata['voucher_date']]['F104'] += $rdata['penalty_paid'];
                                    else
                                        $final_array[$rdata['class_name']][$rdata['batch_name']][$rdata['voucher_date']]['F104'] = $rdata['penalty_paid'];
                                }
                            }
                        } else {
                            if ($rdata['is_others'] == 0 && $rdata['payment_mode_id'] == 5) {
                                $transfer_total = $transfer_total + $rdata['amt_paid'];
                            }
                            if ($feescode['editable'] == 1) {
                                if ($rdata['is_penalty'] == 0) {
                                    //OTH FEE DETAILS ARRAY : FROM HERE
                                    if (isset($ndmd_array[$rdata['class_name']][$rdata['batch_name']][$rdata['voucher_date']][$rdata['feeCode']]))
                                        $ndmd_array[$rdata['class_name']][$rdata['batch_name']][$rdata['voucher_date']][$rdata['feeCode']] += $rdata['amt_paid'];
                                    else
                                        $ndmd_array[$rdata['class_name']][$rdata['batch_name']][$rdata['voucher_date']][$rdata['feeCode']] = $rdata['amt_paid'];
                                    // To HERE

                                    if (isset($final_array[$rdata['class_name']][$rdata['batch_name']][$rdata['voucher_date']]['OTH']))
                                        $final_array[$rdata['class_name']][$rdata['batch_name']][$rdata['voucher_date']]['OTH'] += $rdata['amt_paid'];
                                    else
                                        $final_array[$rdata['class_name']][$rdata['batch_name']][$rdata['voucher_date']]['OTH'] = $rdata['amt_paid'];
                                }
                                if ($rdata['is_penalty'] == 1) {
                                    if (isset($ndmd_array[$rdata['class_name']][$rdata['batch_name']][$rdata['voucher_date']]['F104']))
                                        $ndmd_array[$rdata['class_name']][$rdata['batch_name']][$rdata['voucher_date']]['F104'] += $rdata['penalty_paid'];
                                    else
                                        $ndmd_array[$rdata['class_name']][$rdata['batch_name']][$rdata['voucher_date']]['F104'] = $rdata['penalty_paid'];

                                    if (isset($final_array[$rdata['class_name']][$rdata['batch_name']][$rdata['voucher_date']]['F104']))
                                        $final_array[$rdata['class_name']][$rdata['batch_name']][$rdata['voucher_date']]['F104'] += $rdata['penalty_paid'];
                                    else
                                        $final_array[$rdata['class_name']][$rdata['batch_name']][$rdata['voucher_date']]['F104'] = $rdata['penalty_paid'];
                                }
                            } else {
                                if (isset($final_array[$rdata['class_name']][$rdata['batch_name']][$rdata['voucher_date']][$rdata['feeCode']]))
                                    $final_array[$rdata['class_name']][$rdata['batch_name']][$rdata['voucher_date']][$rdata['feeCode']] += $rdata['amt_paid'];
                                else
                                    $final_array[$rdata['class_name']][$rdata['batch_name']][$rdata['voucher_date']][$rdata['feeCode']] = $rdata['amt_paid'];
                            }
                        }
                    } else {
                        if (isset($final_array[$rdata['class_name']][$rdata['batch_name']][$rdata['voucher_date']][$feescode['feeCode']]))
                            $final_array[$rdata['class_name']][$rdata['batch_name']][$rdata['voucher_date']][$feescode['feeCode']] += 0;
                        else
                            $final_array[$rdata['class_name']][$rdata['batch_name']][$rdata['voucher_date']][$feescode['feeCode']] = 0;
                    }
                }
            }
        }
        //return $final_array;
        $primary_fee_code_data = $this->MReport->get_all_demandable_feecodes_available($apikey, $inst_id, 'dfco');

        $primary_fee_code_data[] = array(
            'feeCode' => 'F023',
            'fee_shortcode' => 'DW',
            'description' => 'DOCME WALLET DEPOSIT'
        );
        $primary_fee_code_data[] = array(
            'feeCode' => 'F104',
            'fee_shortcode' => 'FINE',
            'description' => 'PENALTY'
        );
        $primary_fee_code_data[] = array(
            'feeCode' => 'OTH',
            'fee_shortcode' => 'OTH',
            'description' => 'OTHERS (NON DEMANDABLE FEES)'
        );
        $non_demandable_feecodes = $this->MReport->get_all_feecodes_non_demandable($apikey, $inst_id);
        $formatted_report = array();
        $formatted_fee_codes = array();
        if (isset($report_data) && !empty($report_data)) {
            //$formatted_report_temp = $this->get_report_formatted_for_collection_class_wise_summary_data($report_data, $include_transfer);
            //return $formatted_report_temp;
            $formatted_report = $final_array; //$formatted_report_temp['final_data'];
            $formatted_fee_codes = $primary_fee_code_data; //$formatted_report_temp['fee_code_all_data'];
            //$transfer_total = $formatted_report_temp['transfer_total'];
        } else {
            return array('data_status' => 0, 'message' => 'No data is available');
        }

        if (isset($formatted_report) && !empty($formatted_report) && count($formatted_report) > 0) {
            return array('data_status' => 1, 'data' => $formatted_report, 'nd_data' => $ndmd_array, 'fee_code_data' => $primary_fee_code_data, 'nd_fee_code_data' => $non_demandable_feecodes, 'common_data' => array('service_charge' => $surcharge_amount, 'round_off' => $roundoff_amount, 'payback_amount' => $approved_pbtamt, 'transfer_total' => $transfer_total));
        } else {
            return array('data_status' => 0, 'message' => 'No data is available');
        }
    }
    private function get_report_formatted_for_collection_class_wise_summary_data($report_data, $include_transfer)
    {
        $final_formatted_array = array();
        $class_name = array();
        $class_name_temp = '';
        $batch_details = array();
        $batch_name_temp = '';

        $amt_paid_temp = 0;

        $feecode_data = array();
        $feecode_temp = '';

        $date_data = array();
        $date_data_temp = '';

        $primary_fee_code_data = array();
        $primary_fee_code_data_temp = '';

        $class_total_temp = 0;

        foreach ($report_data as $rptdata_lvl1) {
            $primary_fee_code_data_temp = $rptdata_lvl1['feeCode'];
            if (!(in_array($primary_fee_code_data_temp, $primary_fee_code_data))) {
                $primary_fee_code_data[] = $primary_fee_code_data_temp;
            }
            $class_name_temp = $rptdata_lvl1['class_name'];
            if (in_array($class_name_temp, $class_name)) {
                if (isset($final_formatted_array[$class_name_temp]['class_summary']['class_total']) && !empty($final_formatted_array[$class_name_temp]['class_summary']['class_total'])) {
                    $class_total_temp = $final_formatted_array[$class_name_temp]['class_summary']['class_total'];
                    $final_formatted_array[$class_name_temp]['class_summary']['class_total'] = round(($class_total_temp + $rptdata_lvl1['amt_paid']), 4); //, PHP_ROUND_HALF_UP
                } else {
                    $final_formatted_array[$class_name_temp]['class_summary']['class_total'] = round($rptdata_lvl1['amt_paid'], 4); //, PHP_ROUND_HALF_UP
                }
                $batch_name_temp = $rptdata_lvl1['batch_name'];
                if (isset($batch_details[$class_name_temp]) && in_array($batch_name_temp, $batch_details[$class_name_temp])) {
                    if (isset($date_data['$batch_name_temp']) && in_array($date_data_temp, $date_data['$batch_name_temp'])) {
                        $date_data_temp = $rptdata_lvl1['voucher_date'];
                        if (isset($date_data[$batch_name_temp]) && in_array($date_data_temp, $date_data[$batch_name_temp])) {
                            $feecode_temp = $rptdata_lvl1['feeCode'];
                            if (isset($feecode_data[$batch_name_temp][$date_data_temp]) && in_array($feecode_data[$batch_name_temp][$date_data_temp], $feecode_temp)) {
                                $amt_paid_temp = $final_formatted_array[$class_name_temp]['batch'][$batch_name_temp]['date_data'][$date_data_temp]['fee_code_data'][$feecode_temp]['amt_paid'];
                                $final_formatted_array[$class_name_temp]['batch'][$batch_name_temp]['date_data'][$date_data_temp]['fee_code_data'][$feecode_temp]['amt_paid'] = $amt_paid_temp + $rptdata_lvl1['amt_paid'];
                                if (isset($final_formatted_array[$class_name_temp]['batch'][$batch_name_temp]['batch_summary']['batch_total']) && !empty($final_formatted_array[$class_name_temp]['batch'][$batch_name_temp]['batch_summary']['batch_total'])) {
                                    $final_formatted_array[$class_name_temp]['batch'][$batch_name_temp]['batch_summary']['batch_total'] = $final_formatted_array[$class_name_temp]['batch'][$batch_name_temp]['batch_summary']['batch_total'] + $rptdata_lvl1['amt_paid'];
                                } else {
                                    $final_formatted_array[$class_name_temp]['batch'][$batch_name_temp]['batch_summary']['batch_total'] = $rptdata_lvl1['amt_paid'];
                                }
                            } else {
                                $final_formatted_array[$class_name_temp]['batch'][$batch_name_temp]['date_data'][$date_data_temp]['fee_code_data'][$feecode_temp] = array(
                                    'feecode_name' => $feecode_temp,
                                    'amt_paid' => $rptdata_lvl1['amt_paid'],
                                    'is_others' => $rptdata_lvl1['is_others'],
                                    'payment_mode_id' => $rptdata_lvl1['payment_mode_id']
                                );
                                $final_formatted_array[$class_name_temp]['batch'][$batch_name_temp]['batch_summary']['batch_name'] = $rptdata_lvl1['batch_name'];
                                if (isset($final_formatted_array[$class_name_temp]['batch'][$batch_name_temp]['batch_summary']['batch_total']) && !empty($final_formatted_array[$class_name_temp]['batch'][$batch_name_temp]['batch_summary']['batch_total'])) {
                                    $final_formatted_array[$class_name_temp]['batch'][$batch_name_temp]['batch_summary']['batch_total'] = $final_formatted_array[$class_name_temp]['batch'][$batch_name_temp]['batch_summary']['batch_total'] + $rptdata_lvl1['amt_paid'];
                                } else {
                                    $final_formatted_array[$class_name_temp]['batch'][$batch_name_temp]['batch_summary']['batch_total'] = $rptdata_lvl1['amt_paid'];
                                }
                            }
                        } else {
                            $date_data[$batch_name_temp][] = $date_data_temp;
                            $feecode_temp = $rptdata_lvl1['feeCode'];
                            if (isset($feecode_data[$batch_name_temp][$date_data_temp]) && in_array($feecode_data[$batch_name_temp][$date_data_temp], $feecode_temp)) {
                                $amt_paid_temp = $final_formatted_array[$class_name_temp]['batch'][$batch_name_temp]['date_data'][$date_data_temp]['fee_code_data'][$feecode_temp]['amt_paid'];
                                $final_formatted_array[$class_name_temp]['batch'][$batch_name_temp]['date_data'][$date_data_temp]['fee_code_data'][$feecode_temp]['amt_paid'] = $amt_paid_temp + $rptdata_lvl1['amt_paid'];
                                if (isset($final_formatted_array[$class_name_temp]['batch'][$batch_name_temp]['batch_summary']['batch_total']) && !empty($final_formatted_array[$class_name_temp]['batch'][$batch_name_temp]['batch_summary']['batch_total'])) {
                                    $final_formatted_array[$class_name_temp]['batch'][$batch_name_temp]['batch_summary']['batch_total'] = $final_formatted_array[$class_name_temp]['batch'][$batch_name_temp]['batch_summary']['batch_total'] + $rptdata_lvl1['amt_paid'];
                                } else {
                                    $final_formatted_array[$class_name_temp]['batch'][$batch_name_temp]['batch_summary']['batch_total'] = $rptdata_lvl1['amt_paid'];
                                }
                            } else {
                                $final_formatted_array[$class_name_temp]['batch'][$batch_name_temp]['date_data'][$date_data_temp]['fee_code_data'][$feecode_temp] = array(
                                    'feecode_name' => $feecode_temp,
                                    'amt_paid' => $rptdata_lvl1['amt_paid'],
                                    'is_others' => $rptdata_lvl1['is_others'],
                                    'payment_mode_id' => $rptdata_lvl1['payment_mode_id']
                                );
                                $final_formatted_array[$class_name_temp]['batch'][$batch_name_temp]['batch_summary']['batch_name'] = $rptdata_lvl1['batch_name'];
                                if (isset($final_formatted_array[$class_name_temp]['batch'][$batch_name_temp]['batch_summary']['batch_total']) && !empty($final_formatted_array[$class_name_temp]['batch'][$batch_name_temp]['batch_summary']['batch_total'])) {
                                    $final_formatted_array[$class_name_temp]['batch'][$batch_name_temp]['batch_summary']['batch_total'] = $final_formatted_array[$class_name_temp]['batch'][$batch_name_temp]['batch_summary']['batch_total'] + $rptdata_lvl1['amt_paid'];
                                } else {
                                    $final_formatted_array[$class_name_temp]['batch'][$batch_name_temp]['batch_summary']['batch_total'] = $rptdata_lvl1['amt_paid'];
                                }
                            }
                        }
                    } else {
                        $date_data_temp = $rptdata_lvl1['voucher_date'];
                        if (isset($date_data[$batch_name_temp]) && in_array($date_data_temp, $date_data[$batch_name_temp])) {
                            $feecode_temp = $rptdata_lvl1['feeCode'];
                            if (isset($feecode_data[$batch_name_temp][$date_data_temp]) && in_array($feecode_data[$batch_name_temp][$date_data_temp], $feecode_temp)) {
                                $amt_paid_temp = $final_formatted_array[$class_name_temp]['batch'][$batch_name_temp]['date_data'][$date_data_temp]['fee_code_data'][$feecode_temp]['amt_paid'];
                                $final_formatted_array[$class_name_temp]['batch'][$batch_name_temp]['date_data'][$date_data_temp]['fee_code_data'][$feecode_temp]['amt_paid'] = $amt_paid_temp + $rptdata_lvl1['amt_paid'];
                                if (isset($final_formatted_array[$class_name_temp]['batch'][$batch_name_temp]['batch_summary']['batch_total']) && !empty($final_formatted_array[$class_name_temp]['batch'][$batch_name_temp]['batch_summary']['batch_total'])) {
                                    $final_formatted_array[$class_name_temp]['batch'][$batch_name_temp]['batch_summary']['batch_total'] = $final_formatted_array[$class_name_temp]['batch'][$batch_name_temp]['batch_summary']['batch_total'] + $rptdata_lvl1['amt_paid'];
                                } else {
                                    $final_formatted_array[$class_name_temp]['batch'][$batch_name_temp]['batch_summary']['batch_total'] = $rptdata_lvl1['amt_paid'];
                                }
                            } else {
                                $final_formatted_array[$class_name_temp]['batch'][$batch_name_temp]['date_data'][$date_data_temp]['fee_code_data'][$feecode_temp] = array(
                                    'feecode_name' => $feecode_temp,
                                    'amt_paid' => $rptdata_lvl1['amt_paid'],
                                    'is_others' => $rptdata_lvl1['is_others'],
                                    'payment_mode_id' => $rptdata_lvl1['payment_mode_id']
                                );
                                $final_formatted_array[$class_name_temp]['batch'][$batch_name_temp]['batch_summary']['batch_name'] = $rptdata_lvl1['batch_name'];
                                if (isset($final_formatted_array[$class_name_temp]['batch'][$batch_name_temp]['batch_summary']['batch_total']) && !empty($final_formatted_array[$class_name_temp]['batch'][$batch_name_temp]['batch_summary']['batch_total'])) {
                                    $final_formatted_array[$class_name_temp]['batch'][$batch_name_temp]['batch_summary']['batch_total'] = $final_formatted_array[$class_name_temp]['batch'][$batch_name_temp]['batch_summary']['batch_total'] + $rptdata_lvl1['amt_paid'];
                                } else {
                                    $final_formatted_array[$class_name_temp]['batch'][$batch_name_temp]['batch_summary']['batch_total'] = $rptdata_lvl1['amt_paid'];
                                }
                            }
                        } else {
                            $date_data[$batch_name_temp][] = $date_data_temp;
                            $feecode_temp = $rptdata_lvl1['feeCode'];
                            if (isset($feecode_data[$batch_name_temp][$date_data_temp]) && in_array($feecode_data[$batch_name_temp][$date_data_temp], $feecode_temp)) {
                                $amt_paid_temp = $final_formatted_array[$class_name_temp]['batch'][$batch_name_temp]['date_data'][$date_data_temp]['fee_code_data'][$feecode_temp]['amt_paid'];
                                $final_formatted_array[$class_name_temp]['batch'][$batch_name_temp]['date_data'][$date_data_temp]['fee_code_data'][$feecode_temp]['amt_paid'] = $amt_paid_temp + $rptdata_lvl1['amt_paid'];
                                if (isset($final_formatted_array[$class_name_temp]['batch'][$batch_name_temp]['batch_summary']['batch_total']) && !empty($final_formatted_array[$class_name_temp]['batch'][$batch_name_temp]['batch_summary']['batch_total'])) {
                                    $final_formatted_array[$class_name_temp]['batch'][$batch_name_temp]['batch_summary']['batch_total'] = $final_formatted_array[$class_name_temp]['batch'][$batch_name_temp]['batch_summary']['batch_total'] + $rptdata_lvl1['amt_paid'];
                                } else {
                                    $final_formatted_array[$class_name_temp]['batch'][$batch_name_temp]['batch_summary']['batch_total'] = $rptdata_lvl1['amt_paid'];
                                }
                            } else {
                                $final_formatted_array[$class_name_temp]['batch'][$batch_name_temp]['date_data'][$date_data_temp]['fee_code_data'][$feecode_temp] = array(
                                    'feecode_name' => $feecode_temp,
                                    'amt_paid' => $rptdata_lvl1['amt_paid'],
                                    'is_others' => $rptdata_lvl1['is_others'],
                                    'payment_mode_id' => $rptdata_lvl1['payment_mode_id']
                                );
                                $final_formatted_array[$class_name_temp]['batch'][$batch_name_temp]['batch_summary']['batch_name'] = $rptdata_lvl1['batch_name'];
                                if (isset($final_formatted_array[$class_name_temp]['batch'][$batch_name_temp]['batch_summary']['batch_total']) && !empty($final_formatted_array[$class_name_temp]['batch'][$batch_name_temp]['batch_summary']['batch_total'])) {
                                    $final_formatted_array[$class_name_temp]['batch'][$batch_name_temp]['batch_summary']['batch_total'] = $final_formatted_array[$class_name_temp]['batch'][$batch_name_temp]['batch_summary']['batch_total'] + $rptdata_lvl1['amt_paid'];
                                } else {
                                    $final_formatted_array[$class_name_temp]['batch'][$batch_name_temp]['batch_summary']['batch_total'] = $rptdata_lvl1['amt_paid'];
                                }
                            }
                        }
                    }
                } else {
                    $batch_details[$class_name_temp][] = $batch_name_temp;
                    if (isset($date_data['$batch_name_temp']) && in_array($date_data_temp, $date_data['$batch_name_temp'])) {
                        $date_data_temp = $rptdata_lvl1['voucher_date'];
                        if (isset($date_data[$batch_name_temp]) && in_array($date_data_temp, $date_data[$batch_name_temp])) {
                            $feecode_temp = $rptdata_lvl1['feeCode'];
                            if (isset($feecode_data[$batch_name_temp][$date_data_temp]) && in_array($feecode_data[$batch_name_temp][$date_data_temp], $feecode_temp)) {
                                $amt_paid_temp = $final_formatted_array[$class_name_temp]['batch'][$batch_name_temp]['date_data'][$date_data_temp]['fee_code_data'][$feecode_temp]['amt_paid'];
                                $final_formatted_array[$class_name_temp]['batch'][$batch_name_temp]['date_data'][$date_data_temp]['fee_code_data'][$feecode_temp]['amt_paid'] = $amt_paid_temp + $rptdata_lvl1['amt_paid'];
                                if (isset($final_formatted_array[$class_name_temp]['batch'][$batch_name_temp]['batch_summary']['batch_total']) && !empty($final_formatted_array[$class_name_temp]['batch'][$batch_name_temp]['batch_summary']['batch_total'])) {
                                    $final_formatted_array[$class_name_temp]['batch'][$batch_name_temp]['batch_summary']['batch_total'] = $final_formatted_array[$class_name_temp]['batch'][$batch_name_temp]['batch_summary']['batch_total'] + $rptdata_lvl1['amt_paid'];
                                } else {
                                    $final_formatted_array[$class_name_temp]['batch'][$batch_name_temp]['batch_summary']['batch_total'] = $rptdata_lvl1['amt_paid'];
                                }
                            } else {
                                $final_formatted_array[$class_name_temp]['batch'][$batch_name_temp]['date_data'][$date_data_temp]['fee_code_data'][$feecode_temp] = array(
                                    'feecode_name' => $feecode_temp,
                                    'amt_paid' => $rptdata_lvl1['amt_paid'],
                                    'is_others' => $rptdata_lvl1['is_others'],
                                    'payment_mode_id' => $rptdata_lvl1['payment_mode_id']
                                );
                                $final_formatted_array[$class_name_temp]['batch'][$batch_name_temp]['batch_summary']['batch_name'] = $rptdata_lvl1['batch_name'];
                                if (isset($final_formatted_array[$class_name_temp]['batch'][$batch_name_temp]['batch_summary']['batch_total']) && !empty($final_formatted_array[$class_name_temp]['batch'][$batch_name_temp]['batch_summary']['batch_total'])) {
                                    $final_formatted_array[$class_name_temp]['batch'][$batch_name_temp]['batch_summary']['batch_total'] = $final_formatted_array[$class_name_temp]['batch'][$batch_name_temp]['batch_summary']['batch_total'] + $rptdata_lvl1['amt_paid'];
                                } else {
                                    $final_formatted_array[$class_name_temp]['batch'][$batch_name_temp]['batch_summary']['batch_total'] = $rptdata_lvl1['amt_paid'];
                                }
                            }
                        } else {
                            $date_data[$batch_name_temp][] = $date_data_temp;
                            $feecode_temp = $rptdata_lvl1['feeCode'];
                            if (isset($feecode_data[$batch_name_temp][$date_data_temp]) && in_array($feecode_data[$batch_name_temp][$date_data_temp], $feecode_temp)) {
                                $amt_paid_temp = $final_formatted_array[$class_name_temp]['batch'][$batch_name_temp]['date_data'][$date_data_temp]['fee_code_data'][$feecode_temp]['amt_paid'];
                                $final_formatted_array[$class_name_temp]['batch'][$batch_name_temp]['date_data'][$date_data_temp]['fee_code_data'][$feecode_temp]['amt_paid'] = $amt_paid_temp + $rptdata_lvl1['amt_paid'];
                                if (isset($final_formatted_array[$class_name_temp]['batch'][$batch_name_temp]['batch_summary']['batch_total']) && !empty($final_formatted_array[$class_name_temp]['batch'][$batch_name_temp]['batch_summary']['batch_total'])) {
                                    $final_formatted_array[$class_name_temp]['batch'][$batch_name_temp]['batch_summary']['batch_total'] = $final_formatted_array[$class_name_temp]['batch'][$batch_name_temp]['batch_summary']['batch_total'] + $rptdata_lvl1['amt_paid'];
                                } else {
                                    $final_formatted_array[$class_name_temp]['batch'][$batch_name_temp]['batch_summary']['batch_total'] = $rptdata_lvl1['amt_paid'];
                                }
                            } else {
                                $final_formatted_array[$class_name_temp]['batch'][$batch_name_temp]['date_data'][$date_data_temp]['fee_code_data'][$feecode_temp] = array(
                                    'feecode_name' => $feecode_temp,
                                    'amt_paid' => $rptdata_lvl1['amt_paid'],
                                    'is_others' => $rptdata_lvl1['is_others'],
                                    'payment_mode_id' => $rptdata_lvl1['payment_mode_id']
                                );
                                $final_formatted_array[$class_name_temp]['batch'][$batch_name_temp]['batch_summary']['batch_name'] = $rptdata_lvl1['batch_name'];
                                if (isset($final_formatted_array[$class_name_temp]['batch'][$batch_name_temp]['batch_summary']['batch_total']) && !empty($final_formatted_array[$class_name_temp]['batch'][$batch_name_temp]['batch_summary']['batch_total'])) {
                                    $final_formatted_array[$class_name_temp]['batch'][$batch_name_temp]['batch_summary']['batch_total'] = $final_formatted_array[$class_name_temp]['batch'][$batch_name_temp]['batch_summary']['batch_total'] + $rptdata_lvl1['amt_paid'];
                                } else {
                                    $final_formatted_array[$class_name_temp]['batch'][$batch_name_temp]['batch_summary']['batch_total'] = $rptdata_lvl1['amt_paid'];
                                }
                            }
                        }
                    } else {
                        $date_data_temp = $rptdata_lvl1['voucher_date'];
                        if (isset($date_data[$batch_name_temp]) && in_array($date_data_temp, $date_data[$batch_name_temp])) {
                            $feecode_temp = $rptdata_lvl1['feeCode'];
                            if (isset($feecode_data[$batch_name_temp][$date_data_temp]) && in_array($feecode_data[$batch_name_temp][$date_data_temp], $feecode_temp)) {
                                $amt_paid_temp = $final_formatted_array[$class_name_temp]['batch'][$batch_name_temp]['date_data'][$date_data_temp]['fee_code_data'][$feecode_temp]['amt_paid'];
                                $final_formatted_array[$class_name_temp]['batch'][$batch_name_temp]['date_data'][$date_data_temp]['fee_code_data'][$feecode_temp]['amt_paid'] = $amt_paid_temp + $rptdata_lvl1['amt_paid'];
                                if (isset($final_formatted_array[$class_name_temp]['batch'][$batch_name_temp]['batch_summary']['batch_total']) && !empty($final_formatted_array[$class_name_temp]['batch'][$batch_name_temp]['batch_summary']['batch_total'])) {
                                    $final_formatted_array[$class_name_temp]['batch'][$batch_name_temp]['batch_summary']['batch_total'] = $final_formatted_array[$class_name_temp]['batch'][$batch_name_temp]['batch_summary']['batch_total'] + $rptdata_lvl1['amt_paid'];
                                } else {
                                    $final_formatted_array[$class_name_temp]['batch'][$batch_name_temp]['batch_summary']['batch_total'] = $rptdata_lvl1['amt_paid'];
                                }
                            } else {
                                $final_formatted_array[$class_name_temp]['batch'][$batch_name_temp]['date_data'][$date_data_temp]['fee_code_data'][$feecode_temp] = array(
                                    'feecode_name' => $feecode_temp,
                                    'amt_paid' => $rptdata_lvl1['amt_paid'],
                                    'is_others' => $rptdata_lvl1['is_others'],
                                    'payment_mode_id' => $rptdata_lvl1['payment_mode_id']
                                );
                                $final_formatted_array[$class_name_temp]['batch'][$batch_name_temp]['batch_summary']['batch_name'] = $rptdata_lvl1['batch_name'];
                                if (isset($final_formatted_array[$class_name_temp]['batch'][$batch_name_temp]['batch_summary']['batch_total']) && !empty($final_formatted_array[$class_name_temp]['batch'][$batch_name_temp]['batch_summary']['batch_total'])) {
                                    $final_formatted_array[$class_name_temp]['batch'][$batch_name_temp]['batch_summary']['batch_total'] = $final_formatted_array[$class_name_temp]['batch'][$batch_name_temp]['batch_summary']['batch_total'] + $rptdata_lvl1['amt_paid'];
                                } else {
                                    $final_formatted_array[$class_name_temp]['batch'][$batch_name_temp]['batch_summary']['batch_total'] = $rptdata_lvl1['amt_paid'];
                                }
                            }
                        } else {
                            $date_data[$batch_name_temp][] = $date_data_temp;
                            $feecode_temp = $rptdata_lvl1['feeCode'];
                            if (isset($feecode_data[$batch_name_temp][$date_data_temp]) && in_array($feecode_data[$batch_name_temp][$date_data_temp], $feecode_temp)) {
                                $amt_paid_temp = $final_formatted_array[$class_name_temp]['batch'][$batch_name_temp]['date_data'][$date_data_temp]['fee_code_data'][$feecode_temp]['amt_paid'];
                                $final_formatted_array[$class_name_temp]['batch'][$batch_name_temp]['date_data'][$date_data_temp]['fee_code_data'][$feecode_temp]['amt_paid'] = $amt_paid_temp + $rptdata_lvl1['amt_paid'];
                                if (isset($final_formatted_array[$class_name_temp]['batch'][$batch_name_temp]['batch_summary']['batch_total']) && !empty($final_formatted_array[$class_name_temp]['batch'][$batch_name_temp]['batch_summary']['batch_total'])) {
                                    $final_formatted_array[$class_name_temp]['batch'][$batch_name_temp]['batch_summary']['batch_total'] = $final_formatted_array[$class_name_temp]['batch'][$batch_name_temp]['batch_summary']['batch_total'] + $rptdata_lvl1['amt_paid'];
                                } else {
                                    $final_formatted_array[$class_name_temp]['batch'][$batch_name_temp]['batch_summary']['batch_total'] = $rptdata_lvl1['amt_paid'];
                                }
                            } else {
                                $final_formatted_array[$class_name_temp]['batch'][$batch_name_temp]['date_data'][$date_data_temp]['fee_code_data'][$feecode_temp] = array(
                                    'feecode_name' => $feecode_temp,
                                    'amt_paid' => $rptdata_lvl1['amt_paid'],
                                    'is_others' => $rptdata_lvl1['is_others'],
                                    'payment_mode_id' => $rptdata_lvl1['payment_mode_id']
                                );
                                $final_formatted_array[$class_name_temp]['batch'][$batch_name_temp]['batch_summary']['batch_name'] = $rptdata_lvl1['batch_name'];
                                if (isset($final_formatted_array[$class_name_temp]['batch'][$batch_name_temp]['batch_summary']['batch_total']) && !empty($final_formatted_array[$class_name_temp]['batch'][$batch_name_temp]['batch_summary']['batch_total'])) {
                                    $final_formatted_array[$class_name_temp]['batch'][$batch_name_temp]['batch_summary']['batch_total'] = $final_formatted_array[$class_name_temp]['batch'][$batch_name_temp]['batch_summary']['batch_total'] + $rptdata_lvl1['amt_paid'];
                                } else {
                                    $final_formatted_array[$class_name_temp]['batch'][$batch_name_temp]['batch_summary']['batch_total'] = $rptdata_lvl1['amt_paid'];
                                }
                            }
                        }
                    }
                }
            } else {
                $class_name[] = $rptdata_lvl1['class_name'];
                $final_formatted_array[$class_name_temp]['class_summary']['class_name'] = $rptdata_lvl1['class_name'];
                $final_formatted_array[$class_name_temp]['class_summary']['class_total'] = round($rptdata_lvl1['amt_paid'], 4); //, PHP_ROUND_HALF_UP
                $batch_name_temp = $rptdata_lvl1['batch_name'];
                if (isset($batch_details[$class_name_temp]) && in_array($batch_name_temp, $batch_details[$class_name_temp])) {
                    if (isset($date_data['$batch_name_temp']) && in_array($date_data_temp, $date_data['$batch_name_temp'])) {
                        $date_data_temp = $rptdata_lvl1['voucher_date'];
                        if (isset($date_data[$batch_name_temp]) && in_array($date_data_temp, $date_data[$batch_name_temp])) {
                            $feecode_temp = $rptdata_lvl1['feeCode'];
                            if (isset($feecode_data[$batch_name_temp][$date_data_temp]) && in_array($feecode_data[$batch_name_temp][$date_data_temp], $feecode_temp)) {
                                $amt_paid_temp = $final_formatted_array[$class_name_temp]['batch'][$batch_name_temp]['date_data'][$date_data_temp]['fee_code_data'][$feecode_temp]['amt_paid'];
                                $final_formatted_array[$class_name_temp]['batch'][$batch_name_temp]['date_data'][$date_data_temp]['fee_code_data'][$feecode_temp]['amt_paid'] = $amt_paid_temp + $rptdata_lvl1['amt_paid'];
                                if (isset($final_formatted_array[$class_name_temp]['batch'][$batch_name_temp]['batch_summary']['batch_total']) && !empty($final_formatted_array[$class_name_temp]['batch'][$batch_name_temp]['batch_summary']['batch_total'])) {
                                    $final_formatted_array[$class_name_temp]['batch'][$batch_name_temp]['batch_summary']['batch_total'] = $final_formatted_array[$class_name_temp]['batch'][$batch_name_temp]['batch_summary']['batch_total'] + $rptdata_lvl1['amt_paid'];
                                } else {
                                    $final_formatted_array[$class_name_temp]['batch'][$batch_name_temp]['batch_summary']['batch_total'] = $rptdata_lvl1['amt_paid'];
                                }
                            } else {
                                $final_formatted_array[$class_name_temp]['batch'][$batch_name_temp]['date_data'][$date_data_temp]['fee_code_data'][$feecode_temp] = array(
                                    'feecode_name' => $feecode_temp,
                                    'amt_paid' => $rptdata_lvl1['amt_paid'],
                                    'is_others' => $rptdata_lvl1['is_others'],
                                    'payment_mode_id' => $rptdata_lvl1['payment_mode_id']
                                );
                                $final_formatted_array[$class_name_temp]['batch'][$batch_name_temp]['batch_summary']['batch_name'] = $rptdata_lvl1['batch_name'];
                                if (isset($final_formatted_array[$class_name_temp]['batch'][$batch_name_temp]['batch_summary']['batch_total']) && !empty($final_formatted_array[$class_name_temp]['batch'][$batch_name_temp]['batch_summary']['batch_total'])) {
                                    $final_formatted_array[$class_name_temp]['batch'][$batch_name_temp]['batch_summary']['batch_total'] = $final_formatted_array[$class_name_temp]['batch'][$batch_name_temp]['batch_summary']['batch_total'] + $rptdata_lvl1['amt_paid'];
                                } else {
                                    $final_formatted_array[$class_name_temp]['batch'][$batch_name_temp]['batch_summary']['batch_total'] = $rptdata_lvl1['amt_paid'];
                                }
                            }
                        } else {
                            $date_data[$batch_name_temp][] = $date_data_temp;
                            $feecode_temp = $rptdata_lvl1['feeCode'];
                            if (isset($feecode_data[$batch_name_temp][$date_data_temp]) && in_array($feecode_data[$batch_name_temp][$date_data_temp], $feecode_temp)) {
                                $amt_paid_temp = $final_formatted_array[$class_name_temp]['batch'][$batch_name_temp]['date_data'][$date_data_temp]['fee_code_data'][$feecode_temp]['amt_paid'];
                                $final_formatted_array[$class_name_temp]['batch'][$batch_name_temp]['date_data'][$date_data_temp]['fee_code_data'][$feecode_temp]['amt_paid'] = $amt_paid_temp + $rptdata_lvl1['amt_paid'];
                                if (isset($final_formatted_array[$class_name_temp]['batch'][$batch_name_temp]['batch_summary']['batch_total']) && !empty($final_formatted_array[$class_name_temp]['batch'][$batch_name_temp]['batch_summary']['batch_total'])) {
                                    $final_formatted_array[$class_name_temp]['batch'][$batch_name_temp]['batch_summary']['batch_total'] = $final_formatted_array[$class_name_temp]['batch'][$batch_name_temp]['batch_summary']['batch_total'] + $rptdata_lvl1['amt_paid'];
                                } else {
                                    $final_formatted_array[$class_name_temp]['batch'][$batch_name_temp]['batch_summary']['batch_total'] = $rptdata_lvl1['amt_paid'];
                                }
                            } else {
                                $final_formatted_array[$class_name_temp]['batch'][$batch_name_temp]['date_data'][$date_data_temp]['fee_code_data'][$feecode_temp] = array(
                                    'feecode_name' => $feecode_temp,
                                    'amt_paid' => $rptdata_lvl1['amt_paid'],
                                    'is_others' => $rptdata_lvl1['is_others'],
                                    'payment_mode_id' => $rptdata_lvl1['payment_mode_id']
                                );
                                $final_formatted_array[$class_name_temp]['batch'][$batch_name_temp]['batch_summary']['batch_name'] = $rptdata_lvl1['batch_name'];
                                if (isset($final_formatted_array[$class_name_temp]['batch'][$batch_name_temp]['batch_summary']['batch_total']) && !empty($final_formatted_array[$class_name_temp]['batch'][$batch_name_temp]['batch_summary']['batch_total'])) {
                                    $final_formatted_array[$class_name_temp]['batch'][$batch_name_temp]['batch_summary']['batch_total'] = $final_formatted_array[$class_name_temp]['batch'][$batch_name_temp]['batch_summary']['batch_total'] + $rptdata_lvl1['amt_paid'];
                                } else {
                                    $final_formatted_array[$class_name_temp]['batch'][$batch_name_temp]['batch_summary']['batch_total'] = $rptdata_lvl1['amt_paid'];
                                }
                            }
                        }
                    } else {
                        $date_data_temp = $rptdata_lvl1['voucher_date'];
                        if (isset($date_data[$batch_name_temp]) && in_array($date_data_temp, $date_data[$batch_name_temp])) {
                            $feecode_temp = $rptdata_lvl1['feeCode'];
                            if (isset($feecode_data[$batch_name_temp][$date_data_temp]) && in_array($feecode_data[$batch_name_temp][$date_data_temp], $feecode_temp)) {
                                $amt_paid_temp = $final_formatted_array[$class_name_temp]['batch'][$batch_name_temp]['date_data'][$date_data_temp]['fee_code_data'][$feecode_temp]['amt_paid'];
                                $final_formatted_array[$class_name_temp]['batch'][$batch_name_temp]['date_data'][$date_data_temp]['fee_code_data'][$feecode_temp]['amt_paid'] = $amt_paid_temp + $rptdata_lvl1['amt_paid'];
                                if (isset($final_formatted_array[$class_name_temp]['batch'][$batch_name_temp]['batch_summary']['batch_total']) && !empty($final_formatted_array[$class_name_temp]['batch'][$batch_name_temp]['batch_summary']['batch_total'])) {
                                    $final_formatted_array[$class_name_temp]['batch'][$batch_name_temp]['batch_summary']['batch_total'] = $final_formatted_array[$class_name_temp]['batch'][$batch_name_temp]['batch_summary']['batch_total'] + $rptdata_lvl1['amt_paid'];
                                } else {
                                    $final_formatted_array[$class_name_temp]['batch'][$batch_name_temp]['batch_summary']['batch_total'] = $rptdata_lvl1['amt_paid'];
                                }
                            } else {
                                $final_formatted_array[$class_name_temp]['batch'][$batch_name_temp]['date_data'][$date_data_temp]['fee_code_data'][$feecode_temp] = array(
                                    'feecode_name' => $feecode_temp,
                                    'amt_paid' => $rptdata_lvl1['amt_paid'],
                                    'is_others' => $rptdata_lvl1['is_others'],
                                    'payment_mode_id' => $rptdata_lvl1['payment_mode_id']
                                );
                                $final_formatted_array[$class_name_temp]['batch'][$batch_name_temp]['batch_summary']['batch_name'] = $rptdata_lvl1['batch_name'];
                                if (isset($final_formatted_array[$class_name_temp]['batch'][$batch_name_temp]['batch_summary']['batch_total']) && !empty($final_formatted_array[$class_name_temp]['batch'][$batch_name_temp]['batch_summary']['batch_total'])) {
                                    $final_formatted_array[$class_name_temp]['batch'][$batch_name_temp]['batch_summary']['batch_total'] = $final_formatted_array[$class_name_temp]['batch'][$batch_name_temp]['batch_summary']['batch_total'] + $rptdata_lvl1['amt_paid'];
                                } else {
                                    $final_formatted_array[$class_name_temp]['batch'][$batch_name_temp]['batch_summary']['batch_total'] = $rptdata_lvl1['amt_paid'];
                                }
                            }
                        } else {
                            $date_data[$batch_name_temp][] = $date_data_temp;
                            $feecode_temp = $rptdata_lvl1['feeCode'];
                            if (isset($feecode_data[$batch_name_temp][$date_data_temp]) && in_array($feecode_data[$batch_name_temp][$date_data_temp], $feecode_temp)) {
                                $amt_paid_temp = $final_formatted_array[$class_name_temp]['batch'][$batch_name_temp]['date_data'][$date_data_temp]['fee_code_data'][$feecode_temp]['amt_paid'];
                                $final_formatted_array[$class_name_temp]['batch'][$batch_name_temp]['date_data'][$date_data_temp]['fee_code_data'][$feecode_temp]['amt_paid'] = $amt_paid_temp + $rptdata_lvl1['amt_paid'];
                                if (isset($final_formatted_array[$class_name_temp]['batch'][$batch_name_temp]['batch_summary']['batch_total']) && !empty($final_formatted_array[$class_name_temp]['batch'][$batch_name_temp]['batch_summary']['batch_total'])) {
                                    $final_formatted_array[$class_name_temp]['batch'][$batch_name_temp]['batch_summary']['batch_total'] = $final_formatted_array[$class_name_temp]['batch'][$batch_name_temp]['batch_summary']['batch_total'] + $rptdata_lvl1['amt_paid'];
                                } else {
                                    $final_formatted_array[$class_name_temp]['batch'][$batch_name_temp]['batch_summary']['batch_total'] = $rptdata_lvl1['amt_paid'];
                                }
                            } else {
                                $final_formatted_array[$class_name_temp]['batch'][$batch_name_temp]['date_data'][$date_data_temp]['fee_code_data'][$feecode_temp] = array(
                                    'feecode_name' => $feecode_temp,
                                    'amt_paid' => $rptdata_lvl1['amt_paid'],
                                    'is_others' => $rptdata_lvl1['is_others'],
                                    'payment_mode_id' => $rptdata_lvl1['payment_mode_id']
                                );
                                $final_formatted_array[$class_name_temp]['batch'][$batch_name_temp]['batch_summary']['batch_name'] = $rptdata_lvl1['batch_name'];
                                if (isset($final_formatted_array[$class_name_temp]['batch'][$batch_name_temp]['batch_summary']['batch_total']) && !empty($final_formatted_array[$class_name_temp]['batch'][$batch_name_temp]['batch_summary']['batch_total'])) {
                                    $final_formatted_array[$class_name_temp]['batch'][$batch_name_temp]['batch_summary']['batch_total'] = $final_formatted_array[$class_name_temp]['batch'][$batch_name_temp]['batch_summary']['batch_total'] + $rptdata_lvl1['amt_paid'];
                                } else {
                                    $final_formatted_array[$class_name_temp]['batch'][$batch_name_temp]['batch_summary']['batch_total'] = $rptdata_lvl1['amt_paid'];
                                }
                            }
                        }
                    }
                } else {
                    $batch_details[$class_name_temp][] = $batch_name_temp;
                    if (isset($date_data['$batch_name_temp']) && in_array($date_data_temp, $date_data['$batch_name_temp'])) {
                        $date_data_temp = $rptdata_lvl1['voucher_date'];
                        if (isset($date_data[$batch_name_temp]) && in_array($date_data_temp, $date_data[$batch_name_temp])) {
                            $feecode_temp = $rptdata_lvl1['feeCode'];
                            if (isset($feecode_data[$batch_name_temp][$date_data_temp]) && in_array($feecode_data[$batch_name_temp][$date_data_temp], $feecode_temp)) {
                                $amt_paid_temp = $final_formatted_array[$class_name_temp]['batch'][$batch_name_temp]['date_data'][$date_data_temp]['fee_code_data'][$feecode_temp]['amt_paid'];
                                $final_formatted_array[$class_name_temp]['batch'][$batch_name_temp]['date_data'][$date_data_temp]['fee_code_data'][$feecode_temp]['amt_paid'] = $amt_paid_temp + $rptdata_lvl1['amt_paid'];
                                if (isset($final_formatted_array[$class_name_temp]['batch'][$batch_name_temp]['batch_summary']['batch_total']) && !empty($final_formatted_array[$class_name_temp]['batch'][$batch_name_temp]['batch_summary']['batch_total'])) {
                                    $final_formatted_array[$class_name_temp]['batch'][$batch_name_temp]['batch_summary']['batch_total'] = $final_formatted_array[$class_name_temp]['batch'][$batch_name_temp]['batch_summary']['batch_total'] + $rptdata_lvl1['amt_paid'];
                                } else {
                                    $final_formatted_array[$class_name_temp]['batch'][$batch_name_temp]['batch_summary']['batch_total'] = $rptdata_lvl1['amt_paid'];
                                }
                            } else {
                                $final_formatted_array[$class_name_temp]['batch'][$batch_name_temp]['date_data'][$date_data_temp]['fee_code_data'][$feecode_temp] = array(
                                    'feecode_name' => $feecode_temp,
                                    'amt_paid' => $rptdata_lvl1['amt_paid'],
                                    'is_others' => $rptdata_lvl1['is_others'],
                                    'payment_mode_id' => $rptdata_lvl1['payment_mode_id']
                                );
                                $final_formatted_array[$class_name_temp]['batch'][$batch_name_temp]['batch_summary']['batch_name'] = $rptdata_lvl1['batch_name'];
                                if (isset($final_formatted_array[$class_name_temp]['batch'][$batch_name_temp]['batch_summary']['batch_total']) && !empty($final_formatted_array[$class_name_temp]['batch'][$batch_name_temp]['batch_summary']['batch_total'])) {
                                    $final_formatted_array[$class_name_temp]['batch'][$batch_name_temp]['batch_summary']['batch_total'] = $final_formatted_array[$class_name_temp]['batch'][$batch_name_temp]['batch_summary']['batch_total'] + $rptdata_lvl1['amt_paid'];
                                } else {
                                    $final_formatted_array[$class_name_temp]['batch'][$batch_name_temp]['batch_summary']['batch_total'] = $rptdata_lvl1['amt_paid'];
                                }
                            }
                        } else {
                            $date_data[$batch_name_temp][] = $date_data_temp;
                            $feecode_temp = $rptdata_lvl1['feeCode'];
                            if (isset($feecode_data[$batch_name_temp][$date_data_temp]) && in_array($feecode_data[$batch_name_temp][$date_data_temp], $feecode_temp)) {
                                $amt_paid_temp = $final_formatted_array[$class_name_temp]['batch'][$batch_name_temp]['date_data'][$date_data_temp]['fee_code_data'][$feecode_temp]['amt_paid'];
                                $final_formatted_array[$class_name_temp]['batch'][$batch_name_temp]['date_data'][$date_data_temp]['fee_code_data'][$feecode_temp]['amt_paid'] = $amt_paid_temp + $rptdata_lvl1['amt_paid'];
                                if (isset($final_formatted_array[$class_name_temp]['batch'][$batch_name_temp]['batch_summary']['batch_total']) && !empty($final_formatted_array[$class_name_temp]['batch'][$batch_name_temp]['batch_summary']['batch_total'])) {
                                    $final_formatted_array[$class_name_temp]['batch'][$batch_name_temp]['batch_summary']['batch_total'] = $final_formatted_array[$class_name_temp]['batch'][$batch_name_temp]['batch_summary']['batch_total'] + $rptdata_lvl1['amt_paid'];
                                } else {
                                    $final_formatted_array[$class_name_temp]['batch'][$batch_name_temp]['batch_summary']['batch_total'] = $rptdata_lvl1['amt_paid'];
                                }
                            } else {
                                $final_formatted_array[$class_name_temp]['batch'][$batch_name_temp]['date_data'][$date_data_temp]['fee_code_data'][$feecode_temp] = array(
                                    'feecode_name' => $feecode_temp,
                                    'amt_paid' => $rptdata_lvl1['amt_paid'],
                                    'is_others' => $rptdata_lvl1['is_others'],
                                    'payment_mode_id' => $rptdata_lvl1['payment_mode_id']
                                );
                                $final_formatted_array[$class_name_temp]['batch'][$batch_name_temp]['batch_summary']['batch_name'] = $rptdata_lvl1['batch_name'];
                                if (isset($final_formatted_array[$class_name_temp]['batch'][$batch_name_temp]['batch_summary']['batch_total']) && !empty($final_formatted_array[$class_name_temp]['batch'][$batch_name_temp]['batch_summary']['batch_total'])) {
                                    $final_formatted_array[$class_name_temp]['batch'][$batch_name_temp]['batch_summary']['batch_total'] = $final_formatted_array[$class_name_temp]['batch'][$batch_name_temp]['batch_summary']['batch_total'] + $rptdata_lvl1['amt_paid'];
                                } else {
                                    $final_formatted_array[$class_name_temp]['batch'][$batch_name_temp]['batch_summary']['batch_total'] = $rptdata_lvl1['amt_paid'];
                                }
                            }
                        }
                    } else {
                        $date_data_temp = $rptdata_lvl1['voucher_date'];
                        if (isset($date_data[$batch_name_temp]) && in_array($date_data_temp, $date_data[$batch_name_temp])) {
                            $feecode_temp = $rptdata_lvl1['feeCode'];
                            if (isset($feecode_data[$batch_name_temp][$date_data_temp]) && in_array($feecode_data[$batch_name_temp][$date_data_temp], $feecode_temp)) {
                                $amt_paid_temp = $final_formatted_array[$class_name_temp]['batch'][$batch_name_temp]['date_data'][$date_data_temp]['fee_code_data'][$feecode_temp]['amt_paid'];
                                $final_formatted_array[$class_name_temp]['batch'][$batch_name_temp]['date_data'][$date_data_temp]['fee_code_data'][$feecode_temp]['amt_paid'] = $amt_paid_temp + $rptdata_lvl1['amt_paid'];
                                if (isset($final_formatted_array[$class_name_temp]['batch'][$batch_name_temp]['batch_summary']['batch_total']) && !empty($final_formatted_array[$class_name_temp]['batch'][$batch_name_temp]['batch_summary']['batch_total'])) {
                                    $final_formatted_array[$class_name_temp]['batch'][$batch_name_temp]['batch_summary']['batch_total'] = $final_formatted_array[$class_name_temp]['batch'][$batch_name_temp]['batch_summary']['batch_total'] + $rptdata_lvl1['amt_paid'];
                                } else {
                                    $final_formatted_array[$class_name_temp]['batch'][$batch_name_temp]['batch_summary']['batch_total'] = $rptdata_lvl1['amt_paid'];
                                }
                            } else {
                                $final_formatted_array[$class_name_temp]['batch'][$batch_name_temp]['date_data'][$date_data_temp]['fee_code_data'][$feecode_temp] = array(
                                    'feecode_name' => $feecode_temp,
                                    'amt_paid' => $rptdata_lvl1['amt_paid'],
                                    'is_others' => $rptdata_lvl1['is_others'],
                                    'payment_mode_id' => $rptdata_lvl1['payment_mode_id']
                                );
                                $final_formatted_array[$class_name_temp]['batch'][$batch_name_temp]['batch_summary']['batch_name'] = $rptdata_lvl1['batch_name'];
                                if (isset($final_formatted_array[$class_name_temp]['batch'][$batch_name_temp]['batch_summary']['batch_total']) && !empty($final_formatted_array[$class_name_temp]['batch'][$batch_name_temp]['batch_summary']['batch_total'])) {
                                    $final_formatted_array[$class_name_temp]['batch'][$batch_name_temp]['batch_summary']['batch_total'] = $final_formatted_array[$class_name_temp]['batch'][$batch_name_temp]['batch_summary']['batch_total'] + $rptdata_lvl1['amt_paid'];
                                } else {
                                    $final_formatted_array[$class_name_temp]['batch'][$batch_name_temp]['batch_summary']['batch_total'] = $rptdata_lvl1['amt_paid'];
                                }
                            }
                        } else {
                            $date_data[$batch_name_temp][] = $date_data_temp;
                            $feecode_temp = $rptdata_lvl1['feeCode'];
                            if (isset($feecode_data[$batch_name_temp][$date_data_temp]) && in_array($feecode_data[$batch_name_temp][$date_data_temp], $feecode_temp)) {
                                $amt_paid_temp = $final_formatted_array[$class_name_temp]['batch'][$batch_name_temp]['date_data'][$date_data_temp]['fee_code_data'][$feecode_temp]['amt_paid'];
                                $final_formatted_array[$class_name_temp]['batch'][$batch_name_temp]['date_data'][$date_data_temp]['fee_code_data'][$feecode_temp]['amt_paid'] = $amt_paid_temp + $rptdata_lvl1['amt_paid'];
                                if (isset($final_formatted_array[$class_name_temp]['batch'][$batch_name_temp]['batch_summary']['batch_total']) && !empty($final_formatted_array[$class_name_temp]['batch'][$batch_name_temp]['batch_summary']['batch_total'])) {
                                    $final_formatted_array[$class_name_temp]['batch'][$batch_name_temp]['batch_summary']['batch_total'] = $final_formatted_array[$class_name_temp]['batch'][$batch_name_temp]['batch_summary']['batch_total'] + $rptdata_lvl1['amt_paid'];
                                } else {
                                    $final_formatted_array[$class_name_temp]['batch'][$batch_name_temp]['batch_summary']['batch_total'] = $rptdata_lvl1['amt_paid'];
                                }
                            } else {
                                $final_formatted_array[$class_name_temp]['batch'][$batch_name_temp]['date_data'][$date_data_temp]['fee_code_data'][$feecode_temp] = array(
                                    'feecode_name' => $feecode_temp,
                                    'amt_paid' => $rptdata_lvl1['amt_paid'],
                                    'is_others' => $rptdata_lvl1['is_others'],
                                    'payment_mode_id' => $rptdata_lvl1['payment_mode_id']
                                );
                                $final_formatted_array[$class_name_temp]['batch'][$batch_name_temp]['batch_summary']['batch_name'] = $rptdata_lvl1['batch_name'];
                                if (isset($final_formatted_array[$class_name_temp]['batch'][$batch_name_temp]['batch_summary']['batch_total']) && !empty($final_formatted_array[$class_name_temp]['batch'][$batch_name_temp]['batch_summary']['batch_total'])) {
                                    $final_formatted_array[$class_name_temp]['batch'][$batch_name_temp]['batch_summary']['batch_total'] = round(($final_formatted_array[$class_name_temp]['batch'][$batch_name_temp]['batch_summary']['batch_total'] + $rptdata_lvl1['amt_paid']), 4); //, PHP_ROUND_HALF_UP
                                } else {
                                    $final_formatted_array[$class_name_temp]['batch'][$batch_name_temp]['batch_summary']['batch_total'] = round($rptdata_lvl1['amt_paid'], 4); //, PHP_ROUND_HALF_UP
                                }
                            }
                        }
                    }
                }
            }
        }
        $transfer_total = 0;
        $final_formatted_array1 = $final_formatted_array;
        foreach ($final_formatted_array as $class_key => $formatted_class) {

            foreach ($formatted_class['batch'] as $batch_key => $formatted_batch) {
                foreach ($formatted_batch['date_data'] as $date_key => $formatted_date_data) {
                    $feecode_data_array = $final_formatted_array[$class_key]['batch'][$batch_key]['date_data'][$date_key];
                    $final_formatted_array[$class_key]['batch'][$batch_key]['date_data'][$date_key] = NULL;
                    $flag = 1;
                    $f_amt_total = 0;
                    $txamount = 0;
                    foreach ($primary_fee_code_data as $fcodedata) {
                        foreach ($feecode_data_array['fee_code_data'] as $value) {
                            if ($fcodedata == $value['feecode_name']) {
                                $flag = 2;
                                if ($value['is_others'] == 0 && $value['payment_mode_id'] == 5) {
                                    $transfer_total = $transfer_total + $value['amt_paid'];
                                }
                                if ($include_transfer != 1) {
                                    if ($value['is_others'] == 0 && $value['payment_mode_id'] == 5) {
                                        $final_formatted_array[$class_key]['batch'][$batch_key]['date_data'][$date_key]['fee_code_data'][$value['feecode_name']] = 0;
                                        $f_amt_total = $f_amt_total + 0;
                                    } else {
                                        $final_formatted_array[$class_key]['batch'][$batch_key]['date_data'][$date_key]['fee_code_data'][$value['feecode_name']] = $value['amt_paid'];
                                        $f_amt_total = $f_amt_total + $value['amt_paid'];
                                    }
                                    $txamount = $transfer_total;
                                    //$f_amt_total = $f_amt_total - $transfer_total;
                                } else {
                                    $final_formatted_array[$class_key]['batch'][$batch_key]['date_data'][$date_key]['fee_code_data'][$value['feecode_name']] = $value['amt_paid'];
                                    $f_amt_total = $f_amt_total + $value['amt_paid'];
                                    $txamount = 0;
                                }


                                // array(
                                //     'feecode' => $value['feecode_name'],
                                //     'amt_paid' => round($value['amt_paid'], 4)//, PHP_ROUND_HALF_UP
                                // );

                                //$f_amt_total = $f_amt_total + $value['amt_paid']; //round($value['amt_paid'], 4);//, PHP_ROUND_HALF_UP
                            }
                        }
                        if ($flag == 1) {
                            $final_formatted_array[$class_key]['batch'][$batch_key]['date_data'][$date_key]['fee_code_data'][$fcodedata] = 0;
                            // array(
                            //     'feecode' => $fcodedata,
                            //     'amt_paid' => 0
                            // );
                        } else {
                            $flag = 1;
                        }
                    }
                    $final_formatted_array[$class_key]['batch'][$batch_key]['date_data'][$date_key]['fcode_summary']['amt_total'] = $f_amt_total;
                    $final_formatted_array[$class_key]['batch'][$batch_key]['date_data'][$date_key]['fcode_summary']['transfer_total'] = $transfer_total;
                }
            }
        }

        return array('final_data' => $final_formatted_array, 'fee_code_all_data' => $primary_fee_code_data, 'transfer_total' => $transfer_total);
    }

    //COLLECTION BATCH WISE DETAILS
    public function get_collection_class_wise_details_report_data($params)
    {
        $apikey = $params['API_KEY'];

        if (!(isset($params['inst_id']) && !empty($params['inst_id']))) {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Inst code is required', 'data' => FALSE);
        } else {
            $inst_id = $params['inst_id'];
        }
        if (!(isset($params['acd_year_id']) && !empty($params['acd_year_id']))) {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Academic year data is required', 'data' => FALSE);
        } else {
            $acd_year_id = $params['acd_year_id'];
        }

        if (!(isset($params['from_date']) && !empty($params['from_date']))) {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'From date data is required', 'data' => FALSE);
        } else {
            $from_date = $params['from_date'];
        }

        if (!(isset($params['to_date']) && !empty($params['to_date']))) {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'To date data is required', 'data' => FALSE);
        } else {
            $to_date = $params['to_date'];
        }

        $primary_fee_code_data = $this->MReport->get_all_feecodes_available($apikey, $inst_id);

        $primary_fee_code_data[] = array(
            'feeCode' => 'OTH',
            'description' => 'OTHERS',
            'fee_shortcode' => 'OTH'
        );
        $final_array = array();
        $ndmd_array = array();
        $transfer_amount = 0;
        $tr_penalty = 0;
        $report_data = $this->MReport->get_collection_class_wise_details_data($apikey, $inst_id, $acd_year_id, $from_date, $to_date);
        // return $report_data;
        if (!empty($report_data)) {
            foreach ($report_data as $rdata) {
                $tpy = 0;
                // foreach ($primary_fee_code_data as $feescode) {
                //     if ($feescode['feeCode'] == $rdata['feeCode']) {
                if ($rdata['demandType'] == 1) {
                    if ($rdata['payment_mode_id'] == 5 && $rdata['is_others'] == 0) {
                        $transfer_amount += $rdata['amt_paid'];
                        $tr_penalty += $rdata['fee_penalty'];
                    }
                    if (array_key_exists($rdata['Admn_No'], $final_array[$rdata['batch_name']])) {
                        // if (isset($final_array[$rdata['batch_name']][$rdata['Admn_No']]['voucher_details'][$rdata['voucher_code']]['feeCode'])) {
                        //     $final_array[$rdata['batch_name']][$rdata['Admn_No']]['voucher_details'][$rdata['voucher_code']]['amt_paid'] += $rdata['amt_paid'];
                        // } else {

                        // $final_array[$rdata['batch_name']][$rdata['Admn_No']]['voucher_details'][$rdata['voucher_code']] = array(
                        //     'voucher_code' => $rdata['voucher_code'],
                        //     'voucher_date' => $rdata['voucher_date'],
                        //     'demand_date' => $rdata['demand_date'],
                        //     'is_others' => $rdata['is_others'],
                        //     'payment_mode_id' => $rdata['payment_mode_id']
                        // );
                        $final_array[$rdata['batch_name']][$rdata['Admn_No']]['voucher_details'][$rdata['demand_date']][$rdata['voucher_code']]['voucher_code'] = $rdata['voucher_code'];
                        $final_array[$rdata['batch_name']][$rdata['Admn_No']]['voucher_details'][$rdata['demand_date']][$rdata['voucher_code']]['voucher_date'] = $rdata['voucher_date'];
                        $final_array[$rdata['batch_name']][$rdata['Admn_No']]['voucher_details'][$rdata['demand_date']][$rdata['voucher_code']]['demand_date'] = $rdata['demand_date'];
                        $final_array[$rdata['batch_name']][$rdata['Admn_No']]['voucher_details'][$rdata['demand_date']][$rdata['voucher_code']]['is_others'] = $rdata['is_others'];
                        $final_array[$rdata['batch_name']][$rdata['Admn_No']]['voucher_details'][$rdata['demand_date']][$rdata['voucher_code']]['payment_mode_id'] = $rdata['payment_mode_id'];

                        $final_array[$rdata['batch_name']][$rdata['Admn_No']]['voucher_details'][$rdata['demand_date']][$rdata['voucher_code']]['fee_details'][$rdata['feeCode']] = $rdata['amt_paid'];

                        if (isset($rdata['vat_paid']) && $rdata['vat_paid'] > 0) {

                            $final_array[$rdata['batch_name']][$rdata['Admn_No']]['voucher_details'][$rdata['demand_date']][$rdata['voucher_code']]['vat_paid'] = $rdata['vat_paid'];
                        }
                        if (isset($rdata['ser_charge']) && $rdata['ser_charge'] > 0) {
                            $final_array[$rdata['batch_name']][$rdata['Admn_No']]['voucher_details'][$rdata['demand_date']][$rdata['voucher_code']]['ser_charge'] = $rdata['ser_charge'];
                        }
                        if (isset($rdata['round_off'])) { //&& $rdata['round_off'] > 0

                            $final_array[$rdata['batch_name']][$rdata['Admn_No']]['voucher_details'][$rdata['demand_date']][$rdata['voucher_code']]['round_off'] = $rdata['round_off'];
                        }
                        if (isset($rdata['penalty_paid']) && $rdata['penalty_paid'] > 0) {
                            $final_array[$rdata['batch_name']][$rdata['Admn_No']]['voucher_details'][$rdata['demand_date']][$rdata['voucher_code']]['penalty_paid'] += $rdata['penalty_paid'];
                        }
                        //}
                    } else {
                        $final_array[$rdata['batch_name']][$rdata['Admn_No']]['student_data'] = array(
                            'Admn_no' => $rdata['Admn_No'],
                            'Student_name' => $rdata['First_Name']
                        );
                        // $final_array[$rdata['batch_name']][$rdata['Admn_No']]['voucher_details'][$rdata['demand_date']][$rdata['voucher_code']] = array(
                        //     'voucher_code' => $rdata['voucher_code'],
                        //     'voucher_date' => $rdata['voucher_date'],
                        //     'demand_date' => $rdata['demand_date'],
                        //     'is_others' => $rdata['is_others'],
                        //     'payment_mode_id' => $rdata['payment_mode_id']
                        // );
                        $final_array[$rdata['batch_name']][$rdata['Admn_No']]['voucher_details'][$rdata['demand_date']][$rdata['voucher_code']]['voucher_code'] = $rdata['voucher_code'];
                        $final_array[$rdata['batch_name']][$rdata['Admn_No']]['voucher_details'][$rdata['demand_date']][$rdata['voucher_code']]['voucher_date'] = $rdata['voucher_date'];
                        $final_array[$rdata['batch_name']][$rdata['Admn_No']]['voucher_details'][$rdata['demand_date']][$rdata['voucher_code']]['demand_date'] = $rdata['demand_date'];
                        $final_array[$rdata['batch_name']][$rdata['Admn_No']]['voucher_details'][$rdata['demand_date']][$rdata['voucher_code']]['is_others'] = $rdata['is_others'];
                        $final_array[$rdata['batch_name']][$rdata['Admn_No']]['voucher_details'][$rdata['demand_date']][$rdata['voucher_code']]['payment_mode_id'] = $rdata['payment_mode_id'];

                        $final_array[$rdata['batch_name']][$rdata['Admn_No']]['voucher_details'][$rdata['demand_date']][$rdata['voucher_code']]['fee_details'][$rdata['feeCode']] = $rdata['amt_paid'];
                        if (isset($rdata['vat_paid']) && $rdata['vat_paid'] > 0) {

                            $final_array[$rdata['batch_name']][$rdata['Admn_No']]['voucher_details'][$rdata['demand_date']][$rdata['voucher_code']]['vat_paid'] = $rdata['vat_paid'];
                        }
                        if (isset($rdata['ser_charge']) && $rdata['ser_charge'] > 0) {

                            $final_array[$rdata['batch_name']][$rdata['Admn_No']]['voucher_details'][$rdata['demand_date']][$rdata['voucher_code']]['ser_charge'] = $rdata['ser_charge'];
                        }
                        if (isset($rdata['round_off'])) { //&& $rdata['round_off'] > 0

                            $final_array[$rdata['batch_name']][$rdata['Admn_No']]['voucher_details'][$rdata['demand_date']][$rdata['voucher_code']]['round_off'] = $rdata['round_off'];
                        }
                        if (isset($rdata['penalty_paid']) && $rdata['penalty_paid'] > 0) {
                            $final_array[$rdata['batch_name']][$rdata['Admn_No']]['voucher_details'][$rdata['demand_date']][$rdata['voucher_code']]['penalty_paid'] += $rdata['penalty_paid'];
                        }
                    }
                } else {
                    if ($rdata['payment_mode_id'] == 5 && $rdata['is_others'] == 0) {
                        $transfer_amount += $rdata['amt_paid'];
                        $tr_penalty += $rdata['fee_penalty'];
                    }
                    if ($rdata['editable'] == 1) {
                        //OTH FEE DETAILS : FROM HERE
                        if (array_key_exists($rdata['Admn_No'], $ndmd_array[$rdata['batch_name']])) {
                            $ndmd_array[$rdata['batch_name']][$rdata['Admn_No']]['voucher_details'][$rdata['demand_date']][$rdata['voucher_code']]['voucher_code'] = $rdata['voucher_code'];
                            $ndmd_array[$rdata['batch_name']][$rdata['Admn_No']]['voucher_details'][$rdata['demand_date']][$rdata['voucher_code']]['voucher_date'] = $rdata['voucher_date'];
                            $ndmd_array[$rdata['batch_name']][$rdata['Admn_No']]['voucher_details'][$rdata['demand_date']][$rdata['voucher_code']]['demand_date'] = $rdata['demand_date'];
                            $ndmd_array[$rdata['batch_name']][$rdata['Admn_No']]['voucher_details'][$rdata['demand_date']][$rdata['voucher_code']]['is_others'] = $rdata['is_others'];
                            $ndmd_array[$rdata['batch_name']][$rdata['Admn_No']]['voucher_details'][$rdata['demand_date']][$rdata['voucher_code']]['payment_mode_id'] = $rdata['payment_mode_id'];

                            $ndmd_array[$rdata['batch_name']][$rdata['Admn_No']]['voucher_details'][$rdata['demand_date']][$rdata['voucher_code']]['fee_details'][$rdata['feeCode']] = $rdata['amt_paid'];


                            // $ndmd_array[$rdata['batch_name']][$rdata['Admn_No']]['voucher_details'][$rdata['demand_date']][$rdata['voucher_code']] = array(
                            //     'voucher_code' => $rdata['voucher_code'],
                            //     'voucher_date' => $rdata['voucher_date'],
                            //     'demand_date' => $rdata['demand_date'],
                            //     'feeCode' => $rdata['feeCode'],
                            //     'amt_paid' => $rdata['amt_paid'],
                            //     'is_others' => $rdata['is_others'],
                            //     'payment_mode_id' => $rdata['payment_mode_id']
                            // );
                        } else {
                            $ndmd_array[$rdata['batch_name']][$rdata['Admn_No']]['student_data'] = array(
                                'Admn_no' => $rdata['Admn_No'],
                                'Student_name' => $rdata['First_Name']
                            );
                            $ndmd_array[$rdata['batch_name']][$rdata['Admn_No']]['voucher_details'][$rdata['demand_date']][$rdata['voucher_code']]['voucher_code'] = $rdata['voucher_code'];
                            $ndmd_array[$rdata['batch_name']][$rdata['Admn_No']]['voucher_details'][$rdata['demand_date']][$rdata['voucher_code']]['voucher_date'] = $rdata['voucher_date'];
                            $ndmd_array[$rdata['batch_name']][$rdata['Admn_No']]['voucher_details'][$rdata['demand_date']][$rdata['voucher_code']]['demand_date'] = $rdata['demand_date'];
                            $ndmd_array[$rdata['batch_name']][$rdata['Admn_No']]['voucher_details'][$rdata['demand_date']][$rdata['voucher_code']]['is_others'] = $rdata['is_others'];
                            $ndmd_array[$rdata['batch_name']][$rdata['Admn_No']]['voucher_details'][$rdata['demand_date']][$rdata['voucher_code']]['payment_mode_id'] = $rdata['payment_mode_id'];

                            $ndmd_array[$rdata['batch_name']][$rdata['Admn_No']]['voucher_details'][$rdata['demand_date']][$rdata['voucher_code']]['fee_details'][$rdata['feeCode']] = $rdata['amt_paid'];

                            // $ndmd_array[$rdata['batch_name']][$rdata['Admn_No']]['voucher_details'][$rdata['demand_date']][$rdata['voucher_code']] = array(
                            //     'voucher_code' => $rdata['voucher_code'],
                            //     'voucher_date' => $rdata['voucher_date'],
                            //     'demand_date' => $rdata['demand_date'],
                            //     'feeCode' => $rdata['feeCode'],
                            //     'amt_paid' => $rdata['amt_paid'],
                            //     'is_others' => $rdata['is_others'],
                            //     'payment_mode_id' => $rdata['payment_mode_id']
                            // );
                        }
                        //TO HERE
                        if (array_key_exists($rdata['Admn_No'], $final_array[$rdata['batch_name']])) {
                            $final_array[$rdata['batch_name']][$rdata['Admn_No']]['voucher_details'][$rdata['demand_date']][$rdata['voucher_code']]['voucher_code'] = $rdata['voucher_code'];
                            $final_array[$rdata['batch_name']][$rdata['Admn_No']]['voucher_details'][$rdata['demand_date']][$rdata['voucher_code']]['voucher_date'] = $rdata['voucher_date'];
                            $final_array[$rdata['batch_name']][$rdata['Admn_No']]['voucher_details'][$rdata['demand_date']][$rdata['voucher_code']]['demand_date'] = $rdata['demand_date'];
                            $final_array[$rdata['batch_name']][$rdata['Admn_No']]['voucher_details'][$rdata['demand_date']][$rdata['voucher_code']]['is_others'] = $rdata['is_others'];
                            $final_array[$rdata['batch_name']][$rdata['Admn_No']]['voucher_details'][$rdata['demand_date']][$rdata['voucher_code']]['payment_mode_id'] = $rdata['payment_mode_id'];

                            $final_array[$rdata['batch_name']][$rdata['Admn_No']]['voucher_details'][$rdata['demand_date']][$rdata['voucher_code']]['fee_details']['OTH'] += $rdata['amt_paid'];

                            // $final_array[$rdata['batch_name']][$rdata['Admn_No']]['voucher_details'][$rdata['demand_date']][$rdata['voucher_code']] = array(
                            //     'voucher_code' => $rdata['voucher_code'],
                            //     'voucher_date' => $rdata['voucher_date'],
                            //     'demand_date' => $rdata['demand_date'],
                            //     'feeCode' => 'OTH',
                            //     'amt_paid' => $rdata['amt_paid'],
                            //     'is_others' => $rdata['is_others'],
                            //     'payment_mode_id' => $rdata['payment_mode_id']
                            // );
                            if (isset($rdata['vat_paid']) && $rdata['vat_paid'] > 0) {
                                $final_array[$rdata['batch_name']][$rdata['Admn_No']]['voucher_details'][$rdata['demand_date']][$rdata['voucher_code']]['vat_paid'] = $rdata['vat_paid'];
                            }
                            if (isset($rdata['ser_charge']) && $rdata['ser_charge'] > 0) {
                                $final_array[$rdata['batch_name']][$rdata['Admn_No']]['voucher_details'][$rdata['demand_date']][$rdata['voucher_code']]['ser_charge'] = $rdata['ser_charge'];
                            }
                            if (isset($rdata['round_off'])) { //&& $rdata['round_off'] > 0
                                $final_array[$rdata['batch_name']][$rdata['Admn_No']]['voucher_details'][$rdata['demand_date']][$rdata['voucher_code']]['round_off'] = $rdata['round_off'];
                            }
                            if (isset($rdata['penalty_paid']) && $rdata['penalty_paid'] > 0) {
                                $final_array[$rdata['batch_name']][$rdata['Admn_No']]['voucher_details'][$rdata['demand_date']][$rdata['voucher_code']]['penalty_paid'] += $rdata['penalty_paid'];
                            }
                        } else {
                            $final_array[$rdata['batch_name']][$rdata['Admn_No']]['student_data'] = array(
                                'Admn_no' => $rdata['Admn_No'],
                                'Student_name' => $rdata['First_Name']
                            );
                            // $final_array[$rdata['batch_name']][$rdata['Admn_No']]['voucher_details'][$rdata['demand_date']][$rdata['voucher_code']] = array(
                            //     'voucher_code' => $rdata['voucher_code'],
                            //     'voucher_date' => $rdata['voucher_date'],
                            //     'demand_date' => $rdata['demand_date'],
                            //     'feeCode' => 'OTH',
                            //     'amt_paid' => $rdata['amt_paid'],
                            //     'is_others' => $rdata['is_others'],
                            //     'payment_mode_id' => $rdata['payment_mode_id']
                            // );
                            $final_array[$rdata['batch_name']][$rdata['Admn_No']]['voucher_details'][$rdata['demand_date']][$rdata['voucher_code']]['voucher_code'] = $rdata['voucher_code'];
                            $final_array[$rdata['batch_name']][$rdata['Admn_No']]['voucher_details'][$rdata['demand_date']][$rdata['voucher_code']]['voucher_date'] = $rdata['voucher_date'];
                            $final_array[$rdata['batch_name']][$rdata['Admn_No']]['voucher_details'][$rdata['demand_date']][$rdata['voucher_code']]['demand_date'] = $rdata['demand_date'];
                            $final_array[$rdata['batch_name']][$rdata['Admn_No']]['voucher_details'][$rdata['demand_date']][$rdata['voucher_code']]['is_others'] = $rdata['is_others'];
                            $final_array[$rdata['batch_name']][$rdata['Admn_No']]['voucher_details'][$rdata['demand_date']][$rdata['voucher_code']]['payment_mode_id'] = $rdata['payment_mode_id'];

                            $final_array[$rdata['batch_name']][$rdata['Admn_No']]['voucher_details'][$rdata['demand_date']][$rdata['voucher_code']]['fee_details']['OTH'] = $rdata['amt_paid'];

                            if (isset($rdata['vat_paid']) && $rdata['vat_paid'] > 0) {
                                $final_array[$rdata['batch_name']][$rdata['Admn_No']]['voucher_details'][$rdata['demand_date']][$rdata['voucher_code']]['vat_paid'] = $rdata['vat_paid'];
                            }
                            if (isset($rdata['ser_charge']) && $rdata['ser_charge'] > 0) {
                                $final_array[$rdata['batch_name']][$rdata['Admn_No']]['voucher_details'][$rdata['demand_date']][$rdata['voucher_code']]['ser_charge'] = $rdata['ser_charge'];
                            }
                            if (isset($rdata['round_off'])) { //&& $rdata['round_off'] > 0                                
                                $final_array[$rdata['batch_name']][$rdata['Admn_No']]['voucher_details'][$rdata['demand_date']][$rdata['voucher_code']]['round_off'] = $rdata['round_off'];
                            }
                            if (isset($rdata['penalty_paid']) && $rdata['penalty_paid'] > 0) {
                                $final_array[$rdata['batch_name']][$rdata['Admn_No']]['voucher_details'][$rdata['demand_date']][$rdata['voucher_code']]['penalty_paid'] += $rdata['penalty_paid'];
                            }
                        }
                    } else {
                        if (array_key_exists($rdata['Admn_No'], $final_array[$rdata['batch_name']])) {
                            $final_array[$rdata['batch_name']][$rdata['Admn_No']]['voucher_details'][$rdata['demand_date']][$rdata['voucher_code']]['voucher_code'] = $rdata['voucher_code'];
                            $final_array[$rdata['batch_name']][$rdata['Admn_No']]['voucher_details'][$rdata['demand_date']][$rdata['voucher_code']]['voucher_date'] = $rdata['voucher_date'];
                            $final_array[$rdata['batch_name']][$rdata['Admn_No']]['voucher_details'][$rdata['demand_date']][$rdata['voucher_code']]['demand_date'] = $rdata['demand_date'];
                            $final_array[$rdata['batch_name']][$rdata['Admn_No']]['voucher_details'][$rdata['demand_date']][$rdata['voucher_code']]['is_others'] = $rdata['is_others'];
                            $final_array[$rdata['batch_name']][$rdata['Admn_No']]['voucher_details'][$rdata['demand_date']][$rdata['voucher_code']]['payment_mode_id'] = $rdata['payment_mode_id'];

                            $final_array[$rdata['batch_name']][$rdata['Admn_No']]['voucher_details'][$rdata['demand_date']][$rdata['voucher_code']]['fee_details'][$rdata['feeCode']] = $rdata['amt_paid'];

                            // $final_array[$rdata['batch_name']][$rdata['Admn_No']]['voucher_details'][$rdata['demand_date']][$rdata['voucher_code']] = array(
                            //     'voucher_code' => $rdata['voucher_code'],
                            //     'voucher_date' => $rdata['voucher_date'],
                            //     'demand_date' => $rdata['demand_date'],
                            //     'feeCode' => $rdata['feeCode'],
                            //     'amt_paid' => $rdata['amt_paid'],
                            //     'is_others' => $rdata['is_others'],
                            //     'payment_mode_id' => $rdata['payment_mode_id']
                            // );
                            if (isset($rdata['ser_charge']) && $rdata['ser_charge'] > 0) {
                                $final_array[$rdata['batch_name']][$rdata['Admn_No']]['voucher_details'][$rdata['demand_date']][$rdata['voucher_code']]['ser_charge'] = $rdata['ser_charge'];
                            }
                        } else {
                            $final_array[$rdata['batch_name']][$rdata['Admn_No']]['student_data'] = array(
                                'Admn_no' => $rdata['Admn_No'],
                                'Student_name' => $rdata['First_Name']
                            );
                            // $final_array[$rdata['batch_name']][$rdata['Admn_No']]['voucher_details'][$rdata['demand_date']][$rdata['voucher_code']] = array(
                            //     'voucher_code' => $rdata['voucher_code'],
                            //     'voucher_date' => $rdata['voucher_date'],
                            //     'demand_date' => $rdata['demand_date'],
                            //     'feeCode' => $rdata['feeCode'],
                            //     'amt_paid' => $rdata['amt_paid'],
                            //     'is_others' => $rdata['is_others'],
                            //     'payment_mode_id' => $rdata['payment_mode_id']
                            // );
                            $final_array[$rdata['batch_name']][$rdata['Admn_No']]['voucher_details'][$rdata['demand_date']][$rdata['voucher_code']]['voucher_code'] = $rdata['voucher_code'];
                            $final_array[$rdata['batch_name']][$rdata['Admn_No']]['voucher_details'][$rdata['demand_date']][$rdata['voucher_code']]['voucher_date'] = $rdata['voucher_date'];
                            $final_array[$rdata['batch_name']][$rdata['Admn_No']]['voucher_details'][$rdata['demand_date']][$rdata['voucher_code']]['demand_date'] = $rdata['demand_date'];
                            $final_array[$rdata['batch_name']][$rdata['Admn_No']]['voucher_details'][$rdata['demand_date']][$rdata['voucher_code']]['is_others'] = $rdata['is_others'];
                            $final_array[$rdata['batch_name']][$rdata['Admn_No']]['voucher_details'][$rdata['demand_date']][$rdata['voucher_code']]['payment_mode_id'] = $rdata['payment_mode_id'];

                            $final_array[$rdata['batch_name']][$rdata['Admn_No']]['voucher_details'][$rdata['demand_date']][$rdata['voucher_code']]['fee_details'][$rdata['feeCode']] = $rdata['amt_paid'];

                            if (isset($rdata['ser_charge']) && $rdata['ser_charge'] > 0) {
                                $final_array[$rdata['batch_name']][$rdata['Admn_No']]['voucher_details'][$rdata['demand_date']][$rdata['voucher_code']]['ser_charge'] = $rdata['ser_charge'];
                            }
                        }
                    }
                }
                //     }
                // }
            }
        }
        // return $final_array;
        $voucher_collection_details = $this->MReport->get_voucher_collection_details($apikey, $inst_id, $acd_year_id, $from_date, $to_date);

        if (isset($voucher_collection_details) && !empty($voucher_collection_details) && count($voucher_collection_details) > 0) {
            //$surcharge_amount = $voucher_collection_details[0]['SERVICE_CHARGE_COLLECTED'];
            $serchg = json_decode($voucher_collection_details[0]['SURCHARGE_DETAILS'], true);
            $samt = 0;
            $ser_amount = 0;
            $ser_pros_fee = 0;
            if (is_array($serchg) && !empty($serchg[0])) {
                // foreach ($serchg as $sr) {
                //     if ($sr['is_pros_fee'] != 1) {
                //         $samt += $sr['SERVICE_CHARGE_COLLECTED'];
                //     }
                // }
                foreach ($serchg as $a1) {
                    if ($a1['is_pros_fee'] != 1 and $a1['is_pros_fee'] != 2) {
                        $ser_amount += $a1['SERVICE_CHARGE_COLLECTED'];
                    } else if ($a1['is_pros_fee'] == 1) {
                        $ser_pros_fee += $a1['SERVICE_CHARGE_COLLECTED'];
                    }
                }
            }
            $surcharge_amount = $ser_amount;
            // $surcharge_amount = $samt;

            $rndoff = json_decode($voucher_collection_details[0]['ROUNDOFF_DETAILS'], true);
            if (is_array($rndoff) && !empty($rndoff)) {
                foreach ($rndoff as $rnd_amt) {
                    $roundoff_amount += $rnd_amt['ROUNDOFF_COLLECTED'];
                }
            }
            $pbkamt = json_decode($voucher_collection_details[0]['PBK_DETAILS'], true);
            if (is_array($pbkamt) && !empty($pbkamt)) {
                foreach ($pbkamt as $pb) {
                    $approved_pbtamt += $pb['PBK_COLLECTED'];
                }
            }
            // $approved_pbtamt = $pbkamt[0]['PBK_COLLECTED'];
        } else {
            $surcharge_amount = 0;
            $roundoff_amount = 0;
            $approved_pbtamt = 0;
        }
        // return $rndoff;
        $primary_fee_code_data = $this->MReport->get_all_demandable_feecodes_available($apikey, $inst_id);
        $primary_fee_code_data[] = array(
            'feeCode' => 'OTH',
            'fee_shortcode' => 'OTH',
            'description' => 'OTHERS (NON DEMANDABLE FEES)'
        );
        $non_demandable_feecodes = $this->MReport->get_all_feecodes_non_demandable($apikey, $inst_id);

        $formatted_report = array();
        $formatted_fee_codes = array();
        if (isset($report_data) && !empty($report_data)) {
            $formatted_report_temp = $this->get_report_formatted_for_collection_class_wise_details_data($report_data);
            //return $formatted_report_temp;
            $formatted_report = $final_array; //$formatted_report_temp['final_data'];
            $formatted_fee_codes = $formatted_report_temp['fee_code_all_data'];
        } else {
            return array('data_status' => 0, 'message' => 'No data is available');
        }

        if (isset($formatted_report) && !empty($formatted_report) && count($formatted_report) > 0) {
            return array('data_status' => 1, 'data' => $formatted_report, 'nd_data' => $ndmd_array, 'fee_code_data' => $primary_fee_code_data, 'nd_fee_code_data' => $non_demandable_feecodes, 'common_data' => array('service_charge' => $surcharge_amount, 'round_off' => $roundoff_amount, 'payback_amount' => $approved_pbtamt, 'transfer_amount' => ($transfer_amount + $tr_penalty)));
        } else {
            return array('data_status' => 0, 'message' => 'No data is available');
        }
    }
    private function get_report_formatted_for_collection_class_wise_details_data($report_data)
    {
        $final_formatted_array = array();

        $batch_details = array();
        $batch_name_temp = '';
        $primary_fee_code_data = array();
        $primary_fee_code_data_temp = '';

        $admn_data = array();
        $admn_temp_name = '';

        $voucher_code_data = array();
        $voucher_data_name = '';

        $demand_data = array();
        $demand_temp = '';

        $feecode_data = array();
        $fee_codes = '';

        foreach ($report_data as $rptdata_batch) {
            $primary_fee_code_data_temp = $rptdata_batch['feeCode'];
            if (!(in_array($primary_fee_code_data_temp, $primary_fee_code_data))) {
                $primary_fee_code_data[] = $primary_fee_code_data_temp;
            }
            $batch_name_temp = $rptdata_batch['batch_name'];
            if (in_array($batch_name_temp, $batch_details)) {
                $admn_temp_name = $rptdata_batch['Admn_No'];
                if (in_array($admn_temp_name, $admn_data)) {
                    $voucher_data_name = $rptdata_batch['voucher_code'];
                    if (in_array($voucher_data_name, $voucher_code_data)) {
                        $final_formatted_array[$batch_name_temp][$admn_temp_name]['vouchers'][$voucher_data_name]['other_data'] = array(
                            'admn_no' => $rptdata_batch['Admn_No'],
                            'voucher_date' => $rptdata_batch['First_Name'],
                            'demand_date' => $rptdata_batch['demand_date'],
                            'voucher_date' => $rptdata_batch['voucher_date'],
                            'voucher_code' => $rptdata_batch['voucher_code'],
                            'voucher_amount' => $rptdata_batch['voucher_amount'],
                            'is_others' => $rptdata_batch['is_others'],
                            'payment_mode_id' => $rptdata_batch['payment_mode_id']
                        );
                        $demand_temp = $rptdata_batch['demand_date'];
                        if (isset($demand_data[$voucher_data_name]) && !empty($demand_data[$voucher_data_name]) && in_array($demand_temp, $demand_data[$voucher_data_name])) {
                            $fee_codes = $rptdata_batch['feeCode'];
                            if (isset($feecode_data[$voucher_data_name][$demand_temp]) && !empty($feecode_data[$voucher_data_name][$demand_temp]) && in_array($fee_codes, $feecode_data[$voucher_data_name][$demand_temp])) {
                                $amt_f_temp = $final_formatted_array[$batch_name_temp][$admn_temp_name]['vouchers'][$voucher_data_name]['demand_data'][$demand_temp]['fee_codes'][$fee_codes]['f_amt'] + $rptdata_batch['amt_paid'];
                                $final_formatted_array[$batch_name_temp][$admn_temp_name]['vouchers'][$voucher_data_name]['demand_data'][$demand_temp]['fee_codes'][$fee_codes]['f_amt'] = $amt_f_temp;
                            } else {
                                $feecode_data[$voucher_data_name][$demand_temp][] = $fee_codes;
                                $final_formatted_array[$batch_name_temp][$admn_temp_name]['vouchers'][$voucher_data_name]['demand_data'][$demand_temp]['fee_codes'][$fee_codes] = array(
                                    'fee_codes_name' => $fee_codes,
                                    'f_amt' => $rptdata_batch['amt_paid']
                                );
                            }
                        } else {
                            $demand_data[$voucher_data_name][] = $demand_temp;
                            $fee_codes = $rptdata_batch['feeCode'];
                            if (isset($feecode_data[$voucher_data_name][$demand_temp]) && !empty($feecode_data[$voucher_data_name][$demand_temp]) && in_array($fee_codes, $feecode_data[$voucher_data_name][$demand_temp])) {
                                $amt_f_temp = $final_formatted_array[$batch_name_temp][$admn_temp_name]['vouchers'][$voucher_data_name]['demand_data'][$demand_temp]['fee_codes'][$fee_codes]['f_amt'] + $rptdata_batch['amt_paid'];
                                $final_formatted_array[$batch_name_temp][$admn_temp_name]['vouchers'][$voucher_data_name]['demand_data'][$demand_temp]['fee_codes'][$fee_codes]['f_amt'] = $amt_f_temp;
                            } else {
                                $feecode_data[$voucher_data_name][$demand_temp][] = $fee_codes;
                                $final_formatted_array[$batch_name_temp][$admn_temp_name]['vouchers'][$voucher_data_name]['demand_data'][$demand_temp]['fee_codes'][$fee_codes] = array(
                                    'fee_codes_name' => $fee_codes,
                                    'f_amt' => $rptdata_batch['amt_paid']
                                );
                            }
                        }
                    } else {
                        $voucher_code_data[] = $voucher_data_name;
                        $final_formatted_array[$batch_name_temp][$admn_temp_name]['vouchers'][$voucher_data_name]['other_data'] = array(
                            'admn_no' => $rptdata_batch['Admn_No'],
                            'student_name' => $rptdata_batch['First_Name'],
                            'demand_date' => $rptdata_batch['demand_date'],
                            'voucher_date' => $rptdata_batch['voucher_date'],
                            'voucher_code' => $rptdata_batch['voucher_code'],
                            'voucher_amount' => $rptdata_batch['voucher_amount'],
                            'is_others' => $rptdata_batch['is_others'],
                            'payment_mode_id' => $rptdata_batch['payment_mode_id']
                        );
                        $demand_temp = $rptdata_batch['demand_date'];
                        if (isset($demand_data[$voucher_data_name]) && !empty($demand_data[$voucher_data_name]) && in_array($demand_temp, $demand_data[$voucher_data_name])) {
                            $fee_codes = $rptdata_batch['feeCode'];
                            if (isset($feecode_data[$voucher_data_name][$demand_temp]) && !empty($feecode_data[$voucher_data_name][$demand_temp]) && in_array($fee_codes, $feecode_data[$voucher_data_name][$demand_temp])) {
                                $amt_f_temp = $final_formatted_array[$batch_name_temp][$admn_temp_name]['vouchers'][$voucher_data_name]['demand_data'][$demand_temp]['fee_codes'][$fee_codes]['f_amt'] + $rptdata_batch['amt_paid'];
                                $final_formatted_array[$batch_name_temp][$admn_temp_name]['vouchers'][$voucher_data_name]['demand_data'][$demand_temp]['fee_codes'][$fee_codes]['f_amt'] = $amt_f_temp;
                            } else {
                                $feecode_data[$voucher_data_name][$demand_temp][] = $fee_codes;
                                $final_formatted_array[$batch_name_temp][$admn_temp_name]['vouchers'][$voucher_data_name]['demand_data'][$demand_temp]['fee_codes'][$fee_codes] = array(
                                    'fee_codes_name' => $fee_codes,
                                    'f_amt' => $rptdata_batch['amt_paid']
                                );
                            }
                        } else {
                            $demand_data[$voucher_data_name][] = $demand_temp;
                            $fee_codes = $rptdata_batch['feeCode'];
                            if (isset($feecode_data[$voucher_data_name][$demand_temp]) && !empty($feecode_data[$voucher_data_name][$demand_temp]) && in_array($fee_codes, $feecode_data[$voucher_data_name][$demand_temp])) {
                                $amt_f_temp = $final_formatted_array[$batch_name_temp][$admn_temp_name]['vouchers'][$voucher_data_name]['demand_data'][$demand_temp]['fee_codes'][$fee_codes]['f_amt'] + $rptdata_batch['amt_paid'];
                                $final_formatted_array[$batch_name_temp][$admn_temp_name]['vouchers'][$voucher_data_name]['demand_data'][$demand_temp]['fee_codes'][$fee_codes]['f_amt'] = $amt_f_temp;
                            } else {
                                $feecode_data[$voucher_data_name][$demand_temp][] = $fee_codes;
                                $final_formatted_array[$batch_name_temp][$admn_temp_name]['vouchers'][$voucher_data_name]['demand_data'][$demand_temp]['fee_codes'][$fee_codes] = array(
                                    'fee_codes_name' => $fee_codes,
                                    'f_amt' => $rptdata_batch['amt_paid']
                                );
                            }
                        }
                    }
                } else {
                    $admn_data[] = $admn_temp_name;
                    $final_formatted_array[$batch_name_temp][$admn_temp_name]['student_data'] = array(
                        'admn_no' => $rptdata_batch['Admn_No'],
                        'student_name' => $rptdata_batch['First_Name'],
                    );
                    $voucher_data_name = $rptdata_batch['voucher_code'];
                    if (in_array($voucher_data_name, $voucher_code_data)) {
                        $final_formatted_array[$batch_name_temp][$admn_temp_name]['vouchers'][$voucher_data_name]['other_data'] = array(
                            'admn_no' => $rptdata_batch['Admn_No'],
                            'student_name' => $rptdata_batch['First_Name'],
                            'demand_date' => $rptdata_batch['demand_date'],
                            'voucher_date' => $rptdata_batch['voucher_date'],
                            'voucher_code' => $rptdata_batch['voucher_code'],
                            'voucher_amount' => $rptdata_batch['voucher_amount'],
                            'is_others' => $rptdata_batch['is_others'],
                            'payment_mode_id' => $rptdata_batch['payment_mode_id']
                        );
                        $demand_temp = $rptdata_batch['demand_date'];
                        if (isset($demand_data[$voucher_data_name]) && !empty($demand_data[$voucher_data_name]) && in_array($demand_temp, $demand_data[$voucher_data_name])) {
                            $fee_codes = $rptdata_batch['feeCode'];
                            if (isset($feecode_data[$voucher_data_name][$demand_temp]) && !empty($feecode_data[$voucher_data_name][$demand_temp]) && in_array($fee_codes, $feecode_data[$voucher_data_name][$demand_temp])) {
                                $amt_f_temp = $final_formatted_array[$batch_name_temp][$admn_temp_name]['vouchers'][$voucher_data_name]['demand_data'][$demand_temp]['fee_codes'][$fee_codes]['f_amt'] + $rptdata_batch['amt_paid'];
                                $final_formatted_array[$batch_name_temp][$admn_temp_name]['vouchers'][$voucher_data_name]['demand_data'][$demand_temp]['fee_codes'][$fee_codes]['f_amt'] = $amt_f_temp;
                            } else {
                                $feecode_data[$voucher_data_name][$demand_temp][] = $fee_codes;
                                $final_formatted_array[$batch_name_temp][$admn_temp_name]['vouchers'][$voucher_data_name]['demand_data'][$demand_temp]['fee_codes'][$fee_codes] = array(
                                    'fee_codes_name' => $fee_codes,
                                    'f_amt' => $rptdata_batch['amt_paid']
                                );
                            }
                        } else {
                            $demand_data[$voucher_data_name][] = $demand_temp;
                            $fee_codes = $rptdata_batch['feeCode'];
                            if (isset($feecode_data[$voucher_data_name][$demand_temp]) && !empty($feecode_data[$voucher_data_name][$demand_temp]) && in_array($fee_codes, $feecode_data[$voucher_data_name][$demand_temp])) {
                                $amt_f_temp = $final_formatted_array[$batch_name_temp][$admn_temp_name]['vouchers'][$voucher_data_name]['demand_data'][$demand_temp]['fee_codes'][$fee_codes]['f_amt'] + $rptdata_batch['amt_paid'];
                                $final_formatted_array[$batch_name_temp][$admn_temp_name]['vouchers'][$voucher_data_name]['demand_data'][$demand_temp]['fee_codes'][$fee_codes]['f_amt'] = $amt_f_temp;
                            } else {
                                $feecode_data[$voucher_data_name][$demand_temp][] = $fee_codes;
                                $final_formatted_array[$batch_name_temp][$admn_temp_name]['vouchers'][$voucher_data_name]['demand_data'][$demand_temp]['fee_codes'][$fee_codes] = array(
                                    'fee_codes_name' => $fee_codes,
                                    'f_amt' => $rptdata_batch['amt_paid']
                                );
                            }
                        }
                    } else {
                        $voucher_code_data[] = $voucher_data_name;
                        $final_formatted_array[$batch_name_temp][$admn_temp_name]['vouchers'][$voucher_data_name]['other_data'] = array(
                            'admn_no' => $rptdata_batch['Admn_No'],
                            'student_name' => $rptdata_batch['First_Name'],
                            'demand_date' => $rptdata_batch['demand_date'],
                            'voucher_date' => $rptdata_batch['voucher_date'],
                            'voucher_code' => $rptdata_batch['voucher_code'],
                            'voucher_amount' => $rptdata_batch['voucher_amount'],
                            'is_others' => $rptdata_batch['is_others'],
                            'payment_mode_id' => $rptdata_batch['payment_mode_id']
                        );
                        $demand_temp = $rptdata_batch['demand_date'];
                        if (isset($demand_data[$voucher_data_name]) && !empty($demand_data[$voucher_data_name]) && in_array($demand_temp, $demand_data[$voucher_data_name])) {
                            $fee_codes = $rptdata_batch['feeCode'];
                            if (isset($feecode_data[$voucher_data_name][$demand_temp]) && !empty($feecode_data[$voucher_data_name][$demand_temp]) && in_array($fee_codes, $feecode_data[$voucher_data_name][$demand_temp])) {
                                $amt_f_temp = $final_formatted_array[$batch_name_temp][$admn_temp_name]['vouchers'][$voucher_data_name]['demand_data'][$demand_temp]['fee_codes'][$fee_codes]['f_amt'] + $rptdata_batch['amt_paid'];
                                $final_formatted_array[$batch_name_temp][$admn_temp_name]['vouchers'][$voucher_data_name]['demand_data'][$demand_temp]['fee_codes'][$fee_codes]['f_amt'] = $amt_f_temp;
                            } else {
                                $feecode_data[$voucher_data_name][$demand_temp][] = $fee_codes;
                                $final_formatted_array[$batch_name_temp][$admn_temp_name]['vouchers'][$voucher_data_name]['demand_data'][$demand_temp]['fee_codes'][$fee_codes] = array(
                                    'fee_codes_name' => $fee_codes,
                                    'f_amt' => $rptdata_batch['amt_paid']
                                );
                            }
                        } else {
                            $demand_data[$voucher_data_name][] = $demand_temp;
                            $fee_codes = $rptdata_batch['feeCode'];
                            if (isset($feecode_data[$voucher_data_name][$demand_temp]) && !empty($feecode_data[$voucher_data_name][$demand_temp]) && in_array($fee_codes, $feecode_data[$voucher_data_name][$demand_temp])) {
                                $amt_f_temp = $final_formatted_array[$batch_name_temp][$admn_temp_name]['vouchers'][$voucher_data_name]['demand_data'][$demand_temp]['fee_codes'][$fee_codes]['f_amt'] + $rptdata_batch['amt_paid'];
                                $final_formatted_array[$batch_name_temp][$admn_temp_name]['vouchers'][$voucher_data_name]['demand_data'][$demand_temp]['fee_codes'][$fee_codes]['f_amt'] = $amt_f_temp;
                            } else {
                                $feecode_data[$voucher_data_name][$demand_temp][] = $fee_codes;
                                $final_formatted_array[$batch_name_temp][$admn_temp_name]['vouchers'][$voucher_data_name]['demand_data'][$demand_temp]['fee_codes'][$fee_codes] = array(
                                    'fee_codes_name' => $fee_codes,
                                    'f_amt' => $rptdata_batch['amt_paid']
                                );
                            }
                        }
                    }
                }
            } else {
                $batch_details[] = $batch_name_temp;
                $admn_temp_name = $rptdata_batch['Admn_No'];
                if (in_array($admn_temp_name, $admn_data)) {
                    $voucher_data_name = $rptdata_batch['voucher_code'];
                    if (in_array($voucher_data_name, $voucher_code_data)) {
                        $final_formatted_array[$batch_name_temp][$admn_temp_name]['vouchers'][$voucher_data_name]['other_data'] = array(
                            'admn_no' => $rptdata_batch['Admn_No'],
                            'student_name' => $rptdata_batch['First_Name'],
                            'demand_date' => $rptdata_batch['demand_date'],
                            'voucher_date' => $rptdata_batch['voucher_date'],
                            'voucher_code' => $rptdata_batch['voucher_code'],
                            'voucher_amount' => $rptdata_batch['voucher_amount'],
                            'is_others' => $rptdata_batch['is_others'],
                            'payment_mode_id' => $rptdata_batch['payment_mode_id']
                        );
                        $demand_temp = $rptdata_batch['demand_date'];
                        if (isset($demand_data[$voucher_data_name]) && !empty($demand_data[$voucher_data_name]) && in_array($demand_temp, $demand_data[$voucher_data_name])) {
                            $fee_codes = $rptdata_batch['feeCode'];
                            if (isset($feecode_data[$voucher_data_name][$demand_temp]) && !empty($feecode_data[$voucher_data_name][$demand_temp]) && in_array($fee_codes, $feecode_data[$voucher_data_name][$demand_temp])) {
                                $amt_f_temp = $final_formatted_array[$batch_name_temp][$admn_temp_name][$voucher_data_name]['demand_data'][$demand_temp]['fee_codes'][$fee_codes]['f_amt'] + $rptdata_batch['amt_paid'];
                                $final_formatted_array[$batch_name_temp][$admn_temp_name][$voucher_data_name]['demand_data'][$demand_temp]['fee_codes'][$fee_codes]['f_amt'] = $amt_f_temp;
                            } else {
                                $feecode_data[$voucher_data_name][$demand_temp][] = $fee_codes;
                                $final_formatted_array[$batch_name_temp][$admn_temp_name][$voucher_data_name]['demand_data'][$demand_temp]['fee_codes'][$fee_codes] = array(
                                    'fee_codes_name' => $fee_codes,
                                    'f_amt' => $rptdata_batch['amt_paid']
                                );
                            }
                        } else {
                            $demand_data[$voucher_data_name][] = $demand_temp;
                            $fee_codes = $rptdata_batch['feeCode'];
                            if (isset($feecode_data[$voucher_data_name][$demand_temp]) && !empty($feecode_data[$voucher_data_name][$demand_temp]) && in_array($fee_codes, $feecode_data[$voucher_data_name][$demand_temp])) {
                                $amt_f_temp = $final_formatted_array[$batch_name_temp][$admn_temp_name][$voucher_data_name]['demand_data'][$demand_temp]['fee_codes'][$fee_codes]['f_amt'] + $rptdata_batch['amt_paid'];
                                $final_formatted_array[$batch_name_temp][$admn_temp_name][$voucher_data_name]['demand_data'][$demand_temp]['fee_codes'][$fee_codes]['f_amt'] = $amt_f_temp;
                            } else {
                                $feecode_data[$voucher_data_name][$demand_temp][] = $fee_codes;
                                $final_formatted_array[$batch_name_temp][$admn_temp_name][$voucher_data_name]['demand_data'][$demand_temp]['fee_codes'][$fee_codes] = array(
                                    'fee_codes_name' => $fee_codes,
                                    'f_amt' => $rptdata_batch['amt_paid']
                                );
                            }
                        }
                    } else {
                        $voucher_code_data[] = $voucher_data_name;
                        $final_formatted_array[$batch_name_temp][$admn_temp_name][$voucher_data_name]['other_data'] = array(
                            'admn_no' => $rptdata_batch['Admn_No'],
                            'student_name' => $rptdata_batch['First_Name'],
                            'demand_date' => $rptdata_batch['demand_date'],
                            'voucher_date' => $rptdata_batch['voucher_date'],
                            'voucher_code' => $rptdata_batch['voucher_code'],
                            'voucher_amount' => $rptdata_batch['voucher_amount'],
                            'is_others' => $rptdata_batch['is_others'],
                            'payment_mode_id' => $rptdata_batch['payment_mode_id']
                        );
                        $demand_temp = $rptdata_batch['demand_date'];
                        if (isset($demand_data[$voucher_data_name]) && !empty($demand_data[$voucher_data_name]) && in_array($demand_temp, $demand_data[$voucher_data_name])) {
                            $fee_codes = $rptdata_batch['feeCode'];
                            if (isset($feecode_data[$voucher_data_name][$demand_temp]) && !empty($feecode_data[$voucher_data_name][$demand_temp]) && in_array($fee_codes, $feecode_data[$voucher_data_name][$demand_temp])) {
                                $amt_f_temp = $final_formatted_array[$batch_name_temp][$admn_temp_name][$voucher_data_name]['demand_data'][$demand_temp]['fee_codes'][$fee_codes]['f_amt'] + $rptdata_batch['amt_paid'];
                                $final_formatted_array[$batch_name_temp][$admn_temp_name][$voucher_data_name]['demand_data'][$demand_temp]['fee_codes'][$fee_codes]['f_amt'] = $amt_f_temp;
                            } else {
                                $feecode_data[$voucher_data_name][$demand_temp][] = $fee_codes;
                                $final_formatted_array[$batch_name_temp][$admn_temp_name][$voucher_data_name]['demand_data'][$demand_temp]['fee_codes'][$fee_codes] = array(
                                    'fee_codes_name' => $fee_codes,
                                    'f_amt' => $rptdata_batch['amt_paid']
                                );
                            }
                        } else {
                            $demand_data[$voucher_data_name][] = $demand_temp;
                            $fee_codes = $rptdata_batch['feeCode'];
                            if (isset($feecode_data[$voucher_data_name][$demand_temp]) && !empty($feecode_data[$voucher_data_name][$demand_temp]) && in_array($fee_codes, $feecode_data[$voucher_data_name][$demand_temp])) {
                                $amt_f_temp = $final_formatted_array[$batch_name_temp][$admn_temp_name][$voucher_data_name]['demand_data'][$demand_temp]['fee_codes'][$fee_codes]['f_amt'] + $rptdata_batch['amt_paid'];
                                $final_formatted_array[$batch_name_temp][$admn_temp_name][$voucher_data_name]['demand_data'][$demand_temp]['fee_codes'][$fee_codes]['f_amt'] = $amt_f_temp;
                            } else {
                                $feecode_data[$voucher_data_name][$demand_temp][] = $fee_codes;
                                $final_formatted_array[$batch_name_temp][$admn_temp_name][$voucher_data_name]['demand_data'][$demand_temp]['fee_codes'][$fee_codes] = array(
                                    'fee_codes_name' => $fee_codes,
                                    'f_amt' => $rptdata_batch['amt_paid']
                                );
                            }
                        }
                    }
                } else {
                    $admn_data[] = $admn_temp_name;
                    $final_formatted_array[$batch_name_temp][$admn_temp_name]['student_data'] = array(
                        'admn_no' => $rptdata_batch['Admn_No'],
                        'student_name' => $rptdata_batch['First_Name'],
                    );
                    $voucher_data_name = $rptdata_batch['voucher_code'];
                    if (in_array($voucher_data_name, $voucher_code_data)) {
                        $final_formatted_array[$batch_name_temp][$admn_temp_name]['vouchers'][$voucher_data_name]['other_data'] = array(
                            'admn_no' => $rptdata_batch['Admn_No'],
                            'student_name' => $rptdata_batch['First_Name'],
                            'demand_date' => $rptdata_batch['demand_date'],
                            'voucher_date' => $rptdata_batch['voucher_date'],
                            'voucher_code' => $rptdata_batch['voucher_code'],
                            'voucher_amount' => $rptdata_batch['voucher_amount'],
                            'is_others' => $rptdata_batch['is_others'],
                            'payment_mode_id' => $rptdata_batch['payment_mode_id']
                        );
                        $demand_temp = $rptdata_batch['demand_date'];
                        if (isset($demand_data[$voucher_data_name]) && !empty($demand_data[$voucher_data_name]) && in_array($demand_temp, $demand_data[$voucher_data_name])) {
                            $fee_codes = $rptdata_batch['feeCode'];
                            if (isset($feecode_data[$voucher_data_name][$demand_temp]) && !empty($feecode_data[$voucher_data_name][$demand_temp]) && in_array($fee_codes, $feecode_data[$voucher_data_name][$demand_temp])) {
                                $amt_f_temp = $final_formatted_array[$batch_name_temp][$admn_temp_name]['vouchers'][$voucher_data_name]['demand_data'][$demand_temp]['fee_codes'][$fee_codes]['f_amt'] + $rptdata_batch['amt_paid'];
                                $final_formatted_array[$batch_name_temp][$admn_temp_name]['vouchers'][$voucher_data_name]['demand_data'][$demand_temp]['fee_codes'][$fee_codes]['f_amt'] = $amt_f_temp;
                            } else {
                                $feecode_data[$voucher_data_name][$demand_temp][] = $fee_codes;
                                $final_formatted_array[$batch_name_temp][$admn_temp_name]['vouchers'][$voucher_data_name]['demand_data'][$demand_temp]['fee_codes'][$fee_codes] = array(
                                    'fee_codes_name' => $fee_codes,
                                    'f_amt' => $rptdata_batch['amt_paid']
                                );
                            }
                        } else {
                            $demand_data[$voucher_data_name][] = $demand_temp;
                            $fee_codes = $rptdata_batch['feeCode'];
                            if (isset($feecode_data[$voucher_data_name][$demand_temp]) && !empty($feecode_data[$voucher_data_name][$demand_temp]) && in_array($fee_codes, $feecode_data[$voucher_data_name][$demand_temp])) {
                                $amt_f_temp = $final_formatted_array[$batch_name_temp][$admn_temp_name]['vouchers'][$voucher_data_name]['demand_data'][$demand_temp]['fee_codes'][$fee_codes]['f_amt'] + $rptdata_batch['amt_paid'];
                                $final_formatted_array[$batch_name_temp][$admn_temp_name]['vouchers'][$voucher_data_name]['demand_data'][$demand_temp]['fee_codes'][$fee_codes]['f_amt'] = $amt_f_temp;
                            } else {
                                $feecode_data[$voucher_data_name][$demand_temp][] = $fee_codes;
                                $final_formatted_array[$batch_name_temp][$admn_temp_name]['vouchers'][$voucher_data_name]['demand_data'][$demand_temp]['fee_codes'][$fee_codes] = array(
                                    'fee_codes_name' => $fee_codes,
                                    'f_amt' => $rptdata_batch['amt_paid']
                                );
                            }
                        }
                    } else {
                        $voucher_code_data[] = $voucher_data_name;
                        $final_formatted_array[$batch_name_temp][$admn_temp_name]['vouchers'][$voucher_data_name]['other_data'] = array(
                            'admn_no' => $rptdata_batch['Admn_No'],
                            'student_name' => $rptdata_batch['First_Name'],
                            'demand_date' => $rptdata_batch['demand_date'],
                            'voucher_date' => $rptdata_batch['voucher_date'],
                            'voucher_code' => $rptdata_batch['voucher_code'],
                            'voucher_amount' => $rptdata_batch['voucher_amount'],
                            'is_others' => $rptdata_batch['is_others'],
                            'payment_mode_id' => $rptdata_batch['payment_mode_id']
                        );
                        $demand_temp = $rptdata_batch['demand_date'];
                        if (isset($demand_data[$voucher_data_name]) && !empty($demand_data[$voucher_data_name]) && in_array($demand_temp, $demand_data[$voucher_data_name])) {
                            $fee_codes = $rptdata_batch['feeCode'];
                            if (isset($feecode_data[$voucher_data_name][$demand_temp]) && !empty($feecode_data[$voucher_data_name][$demand_temp]) && in_array($fee_codes, $feecode_data[$voucher_data_name][$demand_temp])) {
                                $amt_f_temp = $final_formatted_array[$batch_name_temp][$admn_temp_name]['vouchers'][$voucher_data_name]['demand_data'][$demand_temp]['fee_codes'][$fee_codes]['f_amt'] + $rptdata_batch['amt_paid'];
                                $final_formatted_array[$batch_name_temp][$admn_temp_name]['vouchers'][$voucher_data_name]['demand_data'][$demand_temp]['fee_codes'][$fee_codes]['f_amt'] = $amt_f_temp;
                            } else {
                                $feecode_data[$voucher_data_name][$demand_temp][] = $fee_codes;
                                $final_formatted_array[$batch_name_temp][$admn_temp_name]['vouchers'][$voucher_data_name]['demand_data'][$demand_temp]['fee_codes'][$fee_codes] = array(
                                    'fee_codes_name' => $fee_codes,
                                    'f_amt' => $rptdata_batch['amt_paid']
                                );
                            }
                        } else {
                            $demand_data[$voucher_data_name][] = $demand_temp;
                            $fee_codes = $rptdata_batch['feeCode'];
                            if (isset($feecode_data[$voucher_data_name][$demand_temp]) && !empty($feecode_data[$voucher_data_name][$demand_temp]) && in_array($fee_codes, $feecode_data[$voucher_data_name][$demand_temp])) {
                                $amt_f_temp = $final_formatted_array[$batch_name_temp][$admn_temp_name]['vouchers'][$voucher_data_name]['demand_data'][$demand_temp]['fee_codes'][$fee_codes]['f_amt'] + $rptdata_batch['amt_paid'];
                                $final_formatted_array[$batch_name_temp][$admn_temp_name]['vouchers'][$voucher_data_name]['demand_data'][$demand_temp]['fee_codes'][$fee_codes]['f_amt'] = $amt_f_temp;
                            } else {
                                $feecode_data[$voucher_data_name][$demand_temp][] = $fee_codes;
                                $final_formatted_array[$batch_name_temp][$admn_temp_name]['vouchers'][$voucher_data_name]['demand_data'][$demand_temp]['fee_codes'][$fee_codes] = array(
                                    'fee_codes_name' => $fee_codes,
                                    'f_amt' => $rptdata_batch['amt_paid']
                                );
                            }
                        }
                    }
                }
            }
        }

        $fee_code_data_array = array();

        foreach ($final_formatted_array as $batch_key => $rpt_batch) {
            foreach ($rpt_batch as $admn_key => $student_data) {

                foreach ($student_data['vouchers'] as $frv_key => $rpt_frv_data) {
                    foreach ($rpt_frv_data['demand_data'] as $demand_key => $rpt_demand_data) {
                        $feecode_data_array['fee_code_data'] = $rpt_demand_data['fee_codes'];
                        $final_formatted_array[$batch_key][$admn_key]['vouchers'][$frv_key]['demand_data'][$demand_key]['fee_codes'] = NULL;

                        $flag = 1;
                        foreach ($primary_fee_code_data as $fcodedata) {
                            foreach ($feecode_data_array['fee_code_data'] as $value) {
                                if ($fcodedata == $value['fee_codes_name']) {
                                    $flag = 2;
                                    $final_formatted_array[$batch_key][$admn_key]['vouchers'][$frv_key]['demand_data'][$demand_key]['fee_codes'][$value['fee_codes_name']] = $value['f_amt'];
                                    // array(
                                    //     'feecode' => $value['fee_codes_name'],
                                    //     'amt_paid' => round($value['f_amt'], 4)//, PHP_ROUND_HALF_UP
                                    // );
                                }
                            }
                            if ($flag == 1) {
                                $final_formatted_array[$batch_key][$admn_key]['vouchers'][$frv_key]['demand_data'][$demand_key]['fee_codes'][$fcodedata] = 0;
                                // array(
                                //     'feecode' => $fcodedata,
                                //     'amt_paid' => 0
                                // );
                            } else {
                                $flag = 1;
                            }
                        }
                    }
                }
            }
        }

        return array('final_data' => $final_formatted_array, 'fee_code_all_data' => $primary_fee_code_data);
    }

    //USER COLLECTION REPORT
    public function get_collection_user_wise_details_report_data($params)
    {
        $apikey = $params['API_KEY'];

        if (!(isset($params['inst_id']) && !empty($params['inst_id']))) {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Inst code is required', 'data' => FALSE);
        } else {
            $inst_id = $params['inst_id'];
        }
        if (!(isset($params['acd_year_id']) && !empty($params['acd_year_id']))) {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Academic year data is required', 'data' => FALSE);
        } else {
            $acd_year_id = $params['acd_year_id'];
        }

        if (!(isset($params['from_date']) && !empty($params['from_date']))) {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'From date data is required', 'data' => FALSE);
        } else {
            $from_date = $params['from_date'];
        }

        if (!(isset($params['user_id']) && !empty($params['user_id']))) {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'User data is required', 'data' => FALSE);
        } else {
            $user_id = $params['user_id'];
        }

        $report_data = $this->MReport->get_collection_user_wise_details_data($apikey, $inst_id, $acd_year_id, $from_date, $user_id);
        $payment_modes = $this->MReport->get_collection_user_wise_payment_modes_data($apikey);
        // return $report_data;
        //        dev_export($report_data);
        //        die;
        $formatted_data = $this->get_formatted_data_for_user_wise_collection_data($report_data, $payment_modes);
        // return $formatted_data;
        if (isset($formatted_data) && !empty($formatted_data) && count($formatted_data) > 0) {
            return array('data_status' => 1, 'data' => $formatted_data, 'pay_modes' => $payment_modes);
        } else {
            return array('data_status' => 0, 'message' => 'No data is available');
        }
    }
    private function get_formatted_data_for_user_wise_collection_data($report_data, $payment_modes)
    {
        $formatted_array = array();

        $emp_name = '';
        $emp_name_data = array();
        $pay_mode_name = '';

        foreach ($report_data as $rpt_data) {
            $pay_mode_name = $rpt_data['payment_type_name'];
            $emp_name = $rpt_data['Emp_Name'];
            if (in_array($emp_name, $emp_name_data)) {
                //$formatted_array[$emp_name][$pay_mode_name] = $rpt_data['transaction_amount'];
                if ($rpt_data['transaction_type'] == 0) {
                    $formatted_array['collection'][$emp_name][$pay_mode_name] = array(
                        'transaction_amt' => $formatted_array['collection'][$emp_name][$pay_mode_name]['transaction_amt'] + $rpt_data['transaction_amount'],
                        'service_charge' => $formatted_array['collection'][$emp_name][$pay_mode_name]['SERVICE_CHARGE_COLLECTED'] + $rpt_data['SERVICE_CHARGE_COLLECTED'],
                        'round_off_amount' => $formatted_array['collection'][$emp_name][$pay_mode_name]['round_off_amount'] + $rpt_data['round_off_amount']
                    );
                }
            } else {
                foreach ($payment_modes as $modes) {

                    if ($modes['payment_type_name'] == $pay_mode_name && $rpt_data['transaction_type'] == 0) {
                        $formatted_array['collection'][$emp_name][$modes['payment_type_name']] = array(
                            'transaction_amt' => $rpt_data['transaction_amount'],
                            'service_charge' => $rpt_data['SERVICE_CHARGE_COLLECTED'],
                            'round_off_amount' => $rpt_data['round_off_amount']
                            // ,
                            // 'not_recon_amount' => $rpt_data['not_recon_amount'],
                            // 'transfer_amount' => $rpt_data['transfer_amount'],
                            // 'payback_amount' => $rpt_data['payback_amount']
                        );
                    } else {
                        $formatted_array['collection'][$emp_name][$modes['payment_type_name']] = array(
                            'transaction_amt' => 0,
                            'service_charge' => 0,
                            'round_off_amount' => 0
                            // ,
                            // 'not_recon_amount' => 0,
                            // 'transfer_amount' => 0,
                            // 'payback_amount' => 0
                        );
                    }
                    array_push($emp_name_data, $emp_name);
                }
            }
        }
        $formatted_array['common']['transfer_amount'] = $report_data[0]['transfer_amount'];
        $formatted_array['common']['not_recon_amount'] = $report_data[0]['not_recon_amount'];
        $formatted_array['common']['payback_amount'] = $report_data[0]['payback_amount'];
        return $formatted_array;
    }

    //CHEQUE RECEIVED LEDGER
    public function get_cheque_ledger_details($params)
    {
        $apikey = $params['API_KEY'];

        if (!(isset($params['inst_id']) && !empty($params['inst_id']))) {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Inst code is required', 'data' => FALSE);
        } else {
            $inst_id = $params['inst_id'];
        }
        if (!(isset($params['acd_year_id']) && !empty($params['acd_year_id']))) {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Academic year data is required', 'data' => FALSE);
        } else {
            $acd_year_id = $params['acd_year_id'];
        }

        if (!(isset($params['from_date']) && !empty($params['from_date']))) {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'From date data is required', 'data' => FALSE);
        } else {
            $from_date = $params['from_date'];
        }

        if (!(isset($params['to_date']) && !empty($params['to_date']))) {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'To date data is required', 'data' => FALSE);
        } else {
            $to_date = $params['to_date'];
        }
        $report_data = $this->MReport->get_cheque_received_ledger_data($apikey, $inst_id, $acd_year_id, $from_date, $to_date);

        if (isset($report_data) && !empty($report_data) && count($report_data) > 0) {
            $chq_ledger_array = array();
            foreach ($report_data as $rdata) {
                $chq_ledger_array[$rdata['ch_date']][trim($rdata['class_desc'])][trim($rdata['Division'])][] = $rdata;
            }
            return array('data_status' => 1, 'data' => $chq_ledger_array);
        } else {
            return array('data_status' => 0, 'message' => 'No data is available');
        }
    }

    //TAX/VAT COLLECTION DETAILS REPORT
    public function get_vat_collection_details($params)
    {
        $apikey = $params['API_KEY'];

        if (!(isset($params['inst_id']) && !empty($params['inst_id']))) {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Inst code is required', 'data' => FALSE);
        } else {
            $inst_id = $params['inst_id'];
        }
        if (!(isset($params['acd_year_id']) && !empty($params['acd_year_id']))) {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Academic year data is required', 'data' => FALSE);
        } else {
            $acd_year_id = $params['acd_year_id'];
        }

        if (!(isset($params['from_date']) && !empty($params['from_date']))) {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'From date data is required', 'data' => FALSE);
        } else {
            $from_date = $params['from_date'];
        }

        if (!(isset($params['to_date']) && !empty($params['to_date']))) {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'To date data is required', 'data' => FALSE);
        } else {
            $to_date = $params['to_date'];
        }
        $report_data = $this->MReport->get_vat_collection_details($apikey, $inst_id, $acd_year_id, $from_date, $to_date);

        if (isset($report_data) && !empty($report_data) && count($report_data) > 0) {
            return array('data_status' => 1, 'data' => $report_data);
        } else {
            return array('data_status' => 0, 'message' => 'No data is available');
        }
    }

    //EXEMPTION DATA REPORT
    public function get_exemption_data_report($params)
    {
        $apikey = $params['API_KEY'];

        if (!(isset($params['inst_id']) && !empty($params['inst_id']))) {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Inst code is required', 'data' => FALSE);
        } else {
            $inst_id = $params['inst_id'];
        }
        if (!(isset($params['acd_year_id']) && !empty($params['acd_year_id']))) {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Academic year data is required', 'data' => FALSE);
        } else {
            $acd_year_id = $params['acd_year_id'];
        }

        if (!(isset($params['from_date']) && !empty($params['from_date']))) {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'From date data is required', 'data' => FALSE);
        } else {
            $from_date = $params['from_date'];
        }

        if (!(isset($params['to_date']) && !empty($params['to_date']))) {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'To date data is required', 'data' => FALSE);
        } else {
            $to_date = $params['to_date'];
        }
        $report_data = $this->MReport->get_exemption_data_report($apikey, $inst_id, $acd_year_id, $from_date, $to_date);

        if (isset($report_data) && !empty($report_data) && count($report_data) > 0) {
            $exempt_array = array();
            foreach ($report_data as $rdata) {
                $exempt_array[$rdata['Admn_No']]['studentdetails']['First_Name'] = $rdata['First_Name'];
                $exempt_array[$rdata['Admn_No']]['studentdetails']['Admn_No'] = $rdata['Admn_No'];
                $exempt_array[$rdata['Admn_No']]['studentdetails']['Batch_Name'] = $rdata['Batch_Name'];
                $exempt_array[$rdata['Admn_No']]['exemptions'][] = $rdata;
            }
            return array('data_status' => 1, 'data' => $exempt_array);
        } else {
            return array('data_status' => 0, 'message' => 'No data is available');
        }
    }
    //CONCESSION ENJOYING STUDENTS REPORT
    public function get_concession_students_report($params)
    {
        $apikey = $params['API_KEY'];

        if (!(isset($params['inst_id']) && !empty($params['inst_id']))) {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Inst code is required', 'data' => FALSE);
        } else {
            $inst_id = $params['inst_id'];
        }
        if (!(isset($params['acd_year_id']) && !empty($params['acd_year_id']))) {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Academic year data is required', 'data' => FALSE);
        } else {
            $acd_year_id = $params['acd_year_id'];
        }
        if (!(isset($params['concession_type']) && !empty($params['concession_type']))) {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Concession Type required', 'data' => FALSE);
        } else {
            $concession_type = $params['concession_type'];
        }
        $report_data = $this->MReport->get_concession_students_report($apikey, $inst_id, $acd_year_id, $concession_type);

        if (isset($report_data) && !empty($report_data) && count($report_data) > 0) {
            return array('data_status' => 1, 'data' => $report_data);
        } else {
            return array('data_status' => 0, 'message' => 'No data is available');
        }
    }
    public function get_fee_concession_details($params)
    {
        $apikey = $params['API_KEY'];

        if (!(isset($params['inst_id']) && !empty($params['inst_id']))) {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Inst code is required', 'data' => FALSE);
        } else {
            $inst_id = $params['inst_id'];
        }
        if (!(isset($params['acd_year_id']) && !empty($params['acd_year_id']))) {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Academic year data is required', 'data' => FALSE);
        } else {
            $acd_year_id = $params['acd_year_id'];
        }

        if (!(isset($params['from_date']) && !empty($params['from_date']))) {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'From date data is required', 'data' => FALSE);
        } else {
            $from_date = $params['from_date'];
        }

        if (!(isset($params['to_date']) && !empty($params['to_date']))) {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'To date data is required', 'data' => FALSE);
        } else {
            $to_date = $params['to_date'];
        }
        if (!(isset($params['concession_type']) && !empty($params['concession_type']))) {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Concession Type required', 'data' => FALSE);
        } else {
            $concession_type = $params['concession_type'];
        }
        $report_data = $this->MReport->get_fee_concession_details($apikey, $inst_id, $acd_year_id, $from_date, $to_date, $concession_type);

        $conc_array = array();
        $feecode_array = array();
        if (isset($report_data) && !empty($report_data) && count($report_data) > 0) {
            foreach ($report_data as $rd) {
                if (!in_array($rd['feeCode'], $feecode_array)) {
                    $feecode_array[$rd['feeCode']]['shortcode'] = $rd['fee_shortcode'];
                    $feecode_array[$rd['feeCode']]['description'] = $rd['fee_code_description'];
                }
                $conc_array[$rd['Batch_Name']][$rd['voucher_code']]['student_details'] = array(
                    'Batch_Name' => $rd['Batch_Name'],
                    'Admn_No' => $rd['Admn_No'],
                    'student_name' => $rd['student_name'],
                    'demand_date' => $rd['demand_date'],
                    'voucher_date' => $rd['voucher_date'],
                    'voucher_code' => $rd['voucher_code']
                );
                $conc_array[$rd['Batch_Name']][$rd['voucher_code']]['fee_details'][$rd['demand_date']][$rd['feeCode']] += $rd['paid_amount'];
            }
            return array('data_status' => 1, 'data' => array("report" => $conc_array, "feecode" => $feecode_array));
        } else {
            return array('data_status' => 0, 'message' => 'No data is available');
        }
    }

    //VOUCHER CANCELLATION REPORT
    public function get_voucher_cancellation_report($params)
    {
        $apikey = $params['API_KEY'];

        if (!(isset($params['inst_id']) && !empty($params['inst_id']))) {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Inst code is required', 'data' => FALSE);
        } else {
            $inst_id = $params['inst_id'];
        }
        if (!(isset($params['acd_year_id']) && !empty($params['acd_year_id']))) {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Academic year data is required', 'data' => FALSE);
        } else {
            $acd_year_id = $params['acd_year_id'];
        }

        if (!(isset($params['from_date']) && !empty($params['from_date']))) {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'From date data is required', 'data' => FALSE);
        } else {
            $from_date = $params['from_date'];
        }

        if (!(isset($params['to_date']) && !empty($params['to_date']))) {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'To date data is required', 'data' => FALSE);
        } else {
            $to_date = $params['to_date'];
        }

        $report_data = $this->MReport->get_voucher_cancellation_report($apikey, $inst_id, $acd_year_id, $from_date, $to_date);

        if (isset($report_data) && !empty($report_data) && count($report_data) > 0) {
            return array('data_status' => 1, 'data' => $report_data);
        } else {
            return array('data_status' => 0, 'message' => 'No data is available');
        }
    }

    //WALLET DEPOSIT DETAILS REPORT
    public function get_wallet_deposit_details($params)
    {
        $apikey = $params['API_KEY'];

        if (!(isset($params['inst_id']) && !empty($params['inst_id']))) {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Inst code is required', 'data' => FALSE);
        } else {
            $inst_id = $params['inst_id'];
        }
        if (!(isset($params['acd_year_id']) && !empty($params['acd_year_id']))) {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Academic year data is required', 'data' => FALSE);
        } else {
            $acd_year_id = $params['acd_year_id'];
        }

        if (!(isset($params['from_date']) && !empty($params['from_date']))) {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'From date data is required', 'data' => FALSE);
        } else {
            $from_date = $params['from_date'];
        }

        if (!(isset($params['to_date']) && !empty($params['to_date']))) {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'To date data is required', 'data' => FALSE);
        } else {
            $to_date = $params['to_date'];
        }
        $report_data = $this->MReport->get_wallet_deposit_data($apikey, $inst_id, $acd_year_id, $from_date, $to_date);

        if (isset($report_data) && !empty($report_data) && count($report_data) > 0) {
            return array('data_status' => 1, 'data' => $report_data);
        } else {
            return array('data_status' => 0, 'message' => 'No data is available');
        }
    }

    //WALLET WITHDRAW DETAILS REPORT
    public function get_wallet_withdraw_details($params)
    {
        $apikey = $params['API_KEY'];

        if (!(isset($params['inst_id']) && !empty($params['inst_id']))) {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Inst code is required', 'data' => FALSE);
        } else {
            $inst_id = $params['inst_id'];
        }
        if (!(isset($params['acd_year_id']) && !empty($params['acd_year_id']))) {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Academic year data is required', 'data' => FALSE);
        } else {
            $acd_year_id = $params['acd_year_id'];
        }

        if (!(isset($params['from_date']) && !empty($params['from_date']))) {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'From date data is required', 'data' => FALSE);
        } else {
            $from_date = $params['from_date'];
        }

        if (!(isset($params['to_date']) && !empty($params['to_date']))) {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'To date data is required', 'data' => FALSE);
        } else {
            $to_date = $params['to_date'];
        }
        $report_data = $this->MReport->get_wallet_withdraw_data($apikey, $inst_id, $acd_year_id, $from_date, $to_date);

        if (isset($report_data) && !empty($report_data) && count($report_data) > 0) {
            return array('data_status' => 1, 'data' => $report_data);
        } else {
            return array('data_status' => 0, 'message' => 'No data is available');
        }
    }

    //WALLET STATEMENT REPORT
    public function get_wallet_statement_details($params)
    {
        $apikey = $params['API_KEY'];

        if (!(isset($params['inst_id']) && !empty($params['inst_id']))) {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Inst code is required', 'data' => FALSE);
        } else {
            $inst_id = $params['inst_id'];
        }
        if (!(isset($params['acd_year_id']) && !empty($params['acd_year_id']))) {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Academic year data is required', 'data' => FALSE);
        } else {
            $acd_year_id = $params['acd_year_id'];
        }

        if (!(isset($params['from_date']) && !empty($params['from_date']))) {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'From date data is required', 'data' => FALSE);
        } else {
            $from_date = $params['from_date'];
        }

        if (!(isset($params['to_date']) && !empty($params['to_date']))) {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'To date data is required', 'data' => FALSE);
        } else {
            $to_date = $params['to_date'];
        }
        $report_data = $this->MReport->get_wallet_statement_data($apikey, $inst_id, $acd_year_id, $from_date, $to_date);

        if (isset($report_data) && !empty($report_data) && count($report_data) > 0) {
            return array('data_status' => 1, 'data' => $report_data);
        } else {
            return array('data_status' => 0, 'message' => 'No data is available');
        }
    }

    //HEADWISE COLLECTION REPORT
    public function get_headwise_collection_details($params)
    {
        $apikey = $params['API_KEY'];

        if (!(isset($params['inst_id']) && !empty($params['inst_id']))) {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Inst code is required', 'data' => FALSE);
        } else {
            $inst_id = $params['inst_id'];
        }
        if (!(isset($params['acd_year_id']) && !empty($params['acd_year_id']))) {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Academic year data is required', 'data' => FALSE);
        } else {
            $acd_year_id = $params['acd_year_id'];
        }

        if (!(isset($params['from_date']) && !empty($params['from_date']))) {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'From date data is required', 'data' => FALSE);
        } else {
            $from_date = $params['from_date'];
        }

        if (!(isset($params['to_date']) && !empty($params['to_date']))) {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'To date data is required', 'data' => FALSE);
        } else {
            $to_date = $params['to_date'];
        }
        $feecode_id = $params['feecode_id'];
        $report_data = $this->MReport->get_headwise_data_for_report($apikey, $inst_id, $acd_year_id, $from_date, $to_date, $feecode_id);
        // return $report_data;
        $head_array = array();
        $sur_array = array();
        $transfer_amount = 0;
        $w_wdrw_amount = 0;
        if (is_array($report_data) and !empty($report_data)) {
            foreach ($report_data as $rd) {
                if ($rd['is_wallet_withdrawal'] != 1) {
                    $head_array[$rd['fee_code_description']][$rd['class_name']][$rd['batch_name']][] = array(
                        'batch_name' => $rd['batch_name'],
                        'Admn_No' => $rd['Admn_No'],
                        'First_Name' => $rd['First_Name'],
                        'demand_date' => $rd['demand_date'],
                        'voucher_date' => $rd['voucher_date'],
                        'feeCode' => $rd['feeCode'],
                        'voucher_code' => $rd['voucher_code'],
                        'fee_code_description' => $rd['fee_code_description'],
                        'amt_paid' => $rd['amt_paid'],
                        'is_others' => $rd['is_others'],
                        'payment_mode_id' => $rd['payment_mode_id'],
                        'is_penalty' => $rd['is_penalty']
                    );
                    if ($rd['payment_mode_id'] == 5 && $rd['is_others'] == 0) {
                        $transfer_amount += $rd['amt_paid'];
                    }
                    $sur_array['extradetails'][$rd['voucher_code']]['surcharge'] = $rd['surcharge'];
                    $sur_array['extradetails'][$rd['voucher_code']]['roundoff'] = $rd['round_off'];
                }
                // if ($rd['is_wallet_withdrawal'] == 1) {
                //     $w_wdrw_amount += $rd['amt_paid'];
                // }
            }
        }
        $servicecharge = 0;
        $roundoff = 0;
        if (is_array($sur_array['extradetails']) && !empty($sur_array['extradetails'])) {
            foreach ($sur_array['extradetails'] as $key => $values) {
                $servicecharge += $values['surcharge'];
                $roundoff += $values['roundoff'];
            }
        }
        // $head_array['servicecharge'] = $servicecharge;
        $voucher_collection_details = $this->MReport->get_voucher_collection_details($apikey, $inst_id, $acd_year_id, $from_date, $to_date);
        // return $voucher_collection_details;
        if (isset($voucher_collection_details) && !empty($voucher_collection_details) && count($voucher_collection_details) > 0) {
            //$surcharge_amount = $voucher_collection_details[0]['SERVICE_CHARGE_COLLECTED'];
            $serchg = json_decode($voucher_collection_details[0]['SURCHARGE_DETAILS'], true);
            $samt = 0;
            if (is_array($serchg) && !empty($serchg[0])) {
                foreach ($serchg as $sr) {
                    if ($sr['is_pros_fee'] != 1 and $sr['is_pros_fee'] != 2) {
                        $samt += $sr['SERVICE_CHARGE_COLLECTED'];
                    }
                }
            }
            $surcharge_amount = $samt;

            $rndoff = json_decode($voucher_collection_details[0]['ROUNDOFF_DETAILS'], true);
            if (is_array($rndoff) && !empty($rndoff)) {
                foreach ($rndoff as $rnd_amt) {
                    $roundoff_amount += $rnd_amt['ROUNDOFF_COLLECTED'];
                }
            }

            $vatamt = json_decode($voucher_collection_details[0]['VAT_DETAILS'], true);
            if (is_array($vatamt) && !empty($vatamt)) {
                foreach ($vatamt as $vat_amt) {
                    $vat_amount += $vat_amt['VAT_COLLECTED'];
                }
            }
            $concamt = json_decode($voucher_collection_details[0]['CONC_DETAILS'], true);
            if (is_array($concamt) && !empty($concamt)) {
                foreach ($concamt as $conc_amt) {
                    $concession_amount += $conc_amt['CONC_COLLECTED'];
                }
            }
            $expnamt = json_decode($voucher_collection_details[0]['EXPN_DETAILS'], true);
            if (is_array($expnamt) && !empty($expnamt)) {
                foreach ($expnamt as $exmp_amt) {
                    $exemption_amount += $exmp_amt['EXPN_COLLECTED'];
                }
            }
            $cnramt = json_decode($voucher_collection_details[0]['CNRA_DETAILS'], true);
            if (is_array($cnramt) && !empty($cnramt)) {
                foreach ($cnramt as $cnr_amt) {
                    $cnr_amount += $cnr_amt['CNRA_COLLECTED'];
                }
            }
            $pbkamt = json_decode($voucher_collection_details[0]['PBK_DETAILS'], true);
            if (is_array($pbkamt) && !empty($pbkamt)) {
                foreach ($pbkamt as $pb) {
                    $approved_pbtamt += $pb['PBK_COLLECTED'];
                }
            }
        } else {
            $surcharge_amount = 0;
            $roundoff_amount = 0;
            $vat_amount = 0;
            $concession_amount = 0;
            $exemption_amount = 0;
            $cnr_amount = 0;
            $approved_pbtamt = 0;
        }

        $primary_fee_code_data = $this->MReport->get_all_feecodes_available($apikey, $inst_id);
        //return $primary_fee_code_data;
        if (isset($report_data) && !empty($report_data)) {
            return array('data_status' => 1, 'message' => 'Data extracted', 'data' => $head_array, 'feecodes' => $primary_fee_code_data, 'common_data' => array('service_charge' => $servicecharge, 'round_off' => $roundoff, 'concession_amount' => $concession_amount, 'exemption_amount' => $exemption_amount, 'transfer_amount' => $transfer_amount, 'withdrawal_amount' => $approved_pbtamt)); //$w_wdrw_amount
        } else {
            return array('data_status' => 0, 'message' => 'No data available', 'data' => NULL, 'feecodes' => $primary_fee_code_data);
        }
    }

    //INDIVIDUAL DCB    
    public function get_dcb_report_student_wise($params)
    {
        $apikey = $params['API_KEY'];

        if (!(isset($params['inst_id']) && !empty($params['inst_id']))) {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Inst code is required', 'data' => FALSE);
        } else {
            $inst_id = $params['inst_id'];
        }
        if (!(isset($params['acd_year_id']) && !empty($params['acd_year_id']))) {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Academic year data is required', 'data' => FALSE);
        } else {
            $acd_year_id = $params['acd_year_id'];
        }

        if (!(isset($params['student_id']) && !empty($params['student_id']))) {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Student data is required', 'data' => FALSE);
        } else {
            $student_id = $params['student_id'];
        }

        $report_data = $this->MReport->get_dcb_report_with_student($apikey, $inst_id, $acd_year_id, $student_id);
        // return $report_data;
        $student_data = $this->MReport->get_student_data_for_report($apikey, $student_id, $inst_id);

        if (!(isset($student_data[0]) && !empty($student_data[0]))) {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Student data is not available', 'data' => FALSE);
        }

        $formatted_report_data = $this->get_report_formatted_for_dcb_report($report_data, $student_data[0]);

        if (isset($formatted_report_data) && !empty($formatted_report_data) && count($formatted_report_data) > 0) {
            return array('data_status' => 1, 'data' => $formatted_report_data); //$formatted_report_data
        } else {
            return array('data_status' => 0, 'message' => 'No data is available');
        }
    }
    private function get_report_formatted_for_dcb_report($report_data, $student_data)
    {

        $formatted_data = array();
        $demand_month = array();
        $feecodes_demand_month = array();

        $total_demand = 0;
        $total_concession = 0;
        $total_exxcemption = 0;
        $total_net_due = 0;
        $total_payments = 0;
        $total_advance = 0;
        $total_regular = 0;
        $total_balance = 0;
        $total_arrear = 0;

        // return $report_data;
        foreach ($report_data as $rpt_lvl1) {
            if ($rpt_lvl1['is_by_transfer'] == 1) {
                $advanceamt = $rpt_lvl1['total_paid_amount'];
                $regularamt = 0;
            } else {
                $advanceamt = 0;
                $regularamt = $rpt_lvl1['total_paid_amount'];
            }
            $netdue = ($rpt_lvl1['final_payable_amount'] - ($rpt_lvl1['concession_amount'] + $rpt_lvl1['excemption_amount']));
            $formatted_data[$rpt_lvl1['demanded_month']]['feecode'][$rpt_lvl1['feeCode']]['feecode_desc']   = $rpt_lvl1['feecode_desc'];
            $formatted_data[$rpt_lvl1['demanded_month']]['feecode'][$rpt_lvl1['feeCode']]['demand']         += $rpt_lvl1['demand_amount'];
            $formatted_data[$rpt_lvl1['demanded_month']]['feecode'][$rpt_lvl1['feeCode']]['concession']     += $rpt_lvl1['concession_amount'];
            $formatted_data[$rpt_lvl1['demanded_month']]['feecode'][$rpt_lvl1['feeCode']]['excemption']     += $rpt_lvl1['excemption_amount'];
            $formatted_data[$rpt_lvl1['demanded_month']]['feecode'][$rpt_lvl1['feeCode']]['net_due']        += $netdue;
            $formatted_data[$rpt_lvl1['demanded_month']]['feecode'][$rpt_lvl1['feeCode']]['advance']        += $advanceamt;
            $formatted_data[$rpt_lvl1['demanded_month']]['feecode'][$rpt_lvl1['feeCode']]['regular']        += $regularamt;
            $formatted_data[$rpt_lvl1['demanded_month']]['feecode'][$rpt_lvl1['feeCode']]['balance']        += ($netdue - $rpt_lvl1['total_paid_amount']);
            $formatted_data[$rpt_lvl1['demanded_month']]['feecode'][$rpt_lvl1['feeCode']]['arrear']         += $rpt_lvl1['arrear_amount'];
            // $formatted_data[$rpt_lvl1['demanded_month']]['feecode'][$rpt_lvl1['feeCode']] = array(
            //     'feecode_desc' => $rpt_lvl1['feecode_desc'],
            //     'demand' => $rpt_lvl1['demand_amount'],
            //     'concession' => $rpt_lvl1['concession_amount'],
            //     'excemption' => $rpt_lvl1['excemption_amount'],
            //     'net_due' => $netdue,
            //     //'payments' => $rpt_lvl1['total_paid_amount'],
            //     'advance' => $advanceamt,
            //     'regular' => $regularamt,
            //     'balance' => $netdue - $rpt_lvl1['total_paid_amount'],
            //     'arrear' => $rpt_lvl1['arrear_amount'] // - ($rpt_lvl1['excemption_amount'] + $rpt_lvl1['concession_amount'])
            // );

            $total_demand = $total_demand + $rpt_lvl1['demand_amount'];
            $total_concession = $total_concession + $rpt_lvl1['concession_amount'];
            $total_exxcemption = $total_exxcemption + $rpt_lvl1['excemption_amount'];
            $total_net_due = $total_net_due + $netdue;
            //$total_payments = $total_payments + $rpt_lvl1['total_paid_amount'];
            $total_advance = $total_advance + $advanceamt;
            $total_regular = $total_regular + $regularamt;
            $total_balance = $total_balance + ($netdue - $rpt_lvl1['total_paid_amount']);
            $total_arrear = $total_arrear + ($rpt_lvl1['arrear_amount']);
        }
        // return $formatted_data;

        // foreach ($report_data as $rpt_lvl1) {
        //     if (in_array($rpt_lvl1['demanded_month'], $demand_month)) {
        //         if (in_array($rpt_lvl1['feeCode'], $feecodes_demand_month[$rpt_lvl1['demanded_month']])) {
        //             if ($rpt_lvl1['is_by_transfer'] == 1) {
        //                 $formatted_data[$rpt_lvl1['demanded_month']]['feecode'][$rpt_lvl1['feeCode']]['advance'] = $formatted_data[$rpt_lvl1['demanded_month']]['feecode'][$rpt_lvl1['feeCode']]['advance'] + $rpt_lvl1['total_paid_amount'];
        //                 $total_advance = $total_advance + $rpt_lvl1['total_paid_amount'];
        //             } else {
        //                 $formatted_data[$rpt_lvl1['demanded_month']]['feecode'][$rpt_lvl1['feeCode']]['regular'] = $formatted_data[$rpt_lvl1['demanded_month']]['feecode'][$rpt_lvl1['feeCode']]['regular'] + $rpt_lvl1['total_paid_amount'];
        //                 $total_regular = $total_regular + $rpt_lvl1['total_paid_amount'];
        //             }
        //             $formatted_data[$rpt_lvl1['demanded_month']]['feecode'][$rpt_lvl1['feeCode']]['balance'] = $formatted_data[$rpt_lvl1['demanded_month']]['feecode'][$rpt_lvl1['feeCode']]['balance'] - ($rpt_lvl1['total_paid_amount']);
        //             $formatted_data[$rpt_lvl1['demanded_month']]['feecode'][$rpt_lvl1['feeCode']]['demand'] = $formatted_data[$rpt_lvl1['demanded_month']]['feecode'][$rpt_lvl1['feeCode']]['demand'] + ($rpt_lvl1['demand_amount']);
        //             $total_balance = $total_balance - ($rpt_lvl1['total_paid_amount']);
        //             $total_arrear = $total_arrear + $rpt_lvl1['arrear_amount'];
        //         } else {
        //             if ($rpt_lvl1['is_by_transfer'] == 1) {
        //                 $advanceamt = $rpt_lvl1['total_paid_amount'];
        //                 $regularamt = 0;
        //             } else {
        //                 $advanceamt = 0;
        //                 $regularamt = $rpt_lvl1['total_paid_amount'];
        //             }
        //             // $advanceamt = 0;
        //             // $regularamt = $rpt_lvl1['total_paid_amount'];
        //             $netdue += ($rpt_lvl1['final_payable_amount'] - ($rpt_lvl1['concession_amount'] + $rpt_lvl1['excemption_amount']));
        //             $formatted_data[$rpt_lvl1['demanded_month']]['feecode'][$rpt_lvl1['feeCode']] = array(
        //                 'feecode_desc' => $rpt_lvl1['feecode_desc'],
        //                 'demand' => $rpt_lvl1['demand_amount'],
        //                 'concession' => $rpt_lvl1['concession_amount'],
        //                 'excemption' => $rpt_lvl1['excemption_amount'],
        //                 'net_due' => $netdue,
        //                 //'payments' => $rpt_lvl1['total_paid_amount'],
        //                 'advance' => $advanceamt,
        //                 'regular' => $regularamt,
        //                 'balance' => $netdue - $rpt_lvl1['total_paid_amount'],
        //                 'arrear' => $rpt_lvl1['arrear_amount'] // - ($rpt_lvl1['excemption_amount'] + $rpt_lvl1['concession_amount'])
        //             );

        //             $feecodes_demand_month[$rpt_lvl1['demanded_month']][] = $rpt_lvl1['feeCode'];

        //             $total_demand = $total_demand + $rpt_lvl1['demand_amount'];
        //             $total_concession = $total_concession + $rpt_lvl1['concession_amount'];
        //             $total_exxcemption = $total_exxcemption + $rpt_lvl1['excemption_amount'];
        //             $total_net_due = $total_net_due + $netdue;
        //             //$total_payments = $total_payments + $rpt_lvl1['total_paid_amount'];
        //             $total_advance = $total_advance + $advanceamt;
        //             $total_regular = $total_regular + $regularamt;
        //             $total_balance = $total_balance + ($netdue - $rpt_lvl1['total_paid_amount']);
        //             $total_arrear = $total_arrear + ($rpt_lvl1['arrear_amount']); //- ($rpt_lvl1['excemption_amount'] + $rpt_lvl1['concession_amount'])
        //         }
        //     } else {
        //         if ($rpt_lvl1['is_by_transfer'] == 1) {
        //             $advanceamt = $rpt_lvl1['total_paid_amount'];
        //             $regularamt = 0;
        //         } else {
        //             $advanceamt = 0;
        //             $regularamt = $rpt_lvl1['total_paid_amount'];
        //         }
        //         // $advanceamt = 0;
        //         // $regularamt = $rpt_lvl1['total_paid_amount'];
        //         $netdue = ($rpt_lvl1['final_payable_amount'] - ($rpt_lvl1['concession_amount'] + $rpt_lvl1['excemption_amount']));
        //         $formatted_data[$rpt_lvl1['demanded_month']]['feecode'][$rpt_lvl1['feeCode']] = array(
        //             'feecode_desc' => $rpt_lvl1['feecode_desc'],
        //             'demand' => $rpt_lvl1['demand_amount'],
        //             'concession' => $rpt_lvl1['concession_amount'],
        //             'excemption' => $rpt_lvl1['excemption_amount'],
        //             'net_due' => $netdue,
        //             //'payments' => $rpt_lvl1['total_paid_amount'],
        //             'advance' => $advanceamt,
        //             'regular' => $regularamt,
        //             'balance' => $netdue - $rpt_lvl1['total_paid_amount'],
        //             'arrear' => $rpt_lvl1['arrear_amount'] //- ($rpt_lvl1['excemption_amount'] + $rpt_lvl1['concession_amount'])
        //         );

        //         $demand_month[] = $rpt_lvl1['demanded_month'];
        //         $feecodes_demand_month[$rpt_lvl1['demanded_month']][] = $rpt_lvl1['feeCode'];

        //         $total_demand = $total_demand + $rpt_lvl1['demand_amount'];
        //         $total_concession = $total_concession + $rpt_lvl1['concession_amount'];
        //         $total_exxcemption = $total_exxcemption + $rpt_lvl1['excemption_amount'];
        //         $total_net_due = $total_net_due + $netdue;
        //         //$total_payments = $total_payments + $rpt_lvl1['total_paid_amount'];
        //         $total_advance = $total_advance + $advanceamt;
        //         $total_regular = $total_regular + $regularamt;
        //         $total_balance = $total_balance + ($netdue - $rpt_lvl1['total_paid_amount']);
        //         $total_arrear = $total_arrear + ($rpt_lvl1['arrear_amount']); //- ($rpt_lvl1['excemption_amount'] + $rpt_lvl1['concession_amount'])
        //     }
        // }
        // return $formatted_data;
        $super_formatted_data = array(
            'report_data' => $formatted_data,
            'summary' => array(
                'total_demand' => $total_demand,
                'total_concession' => $total_concession,
                'total_excemption' => $total_exxcemption,
                'total_net_due' => $total_net_due,
                //'total_payments' => $total_payments,
                'total_advance' => $total_advance,
                'total_regular' => $total_regular,
                'total_balance' => $total_balance,
                'total_arrear' => $total_arrear
            ),
            'student_data' => $student_data
        );
        return $super_formatted_data;
    }

    //BATCH WISE DCB
    public function get_dcb_report_batch_wise($params)
    {
        $apikey = $params['API_KEY'];

        if (!(isset($params['inst_id']) && !empty($params['inst_id']))) {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Inst code is required', 'data' => FALSE);
        } else {
            $inst_id = $params['inst_id'];
        }
        if (!(isset($params['acd_year_id']) && !empty($params['acd_year_id']))) {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Academic year data is required', 'data' => FALSE);
        } else {
            $acd_year_id = $params['acd_year_id'];
        }

        if (!(isset($params['batch_id']) && !empty($params['batch_id']))) {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Batch data is required', 'data' => FALSE);
        } else {
            $batch_id = $params['batch_id'];
        }
        $class_id = $params['class_id'];
        // $student_data = $this->MReport->get_students_with_batch_for_dcb_report($apikey, $inst_id, $acd_year_id, $batch_id, $class_id);
        // if (!(isset($student_data[0]) && !empty($student_data[0]))) {
        //     return array('data_status' => 0, 'error_status' => 1, 'message' => 'Student data is not available', 'data' => FALSE);
        // }
        // return array('data_status' => 1, 'data' => $student_data);
        $super_formatted_data = array();
        // foreach ($student_data as $students) {
        //     $report_data = $this->MReport->get_dcb_report_with_student($apikey, $inst_id, $acd_year_id, $students['student_id']);
        //     $formatted_report_data = $this->get_report_formatted_for_dcb_report_batch_wise($report_data, $students);
        //     $super_formatted_data[$students['student_id']] = $formatted_report_data;
        // }
        // return $super_formatted_data;
        $dcb_report_data = $this->MReport->batch_wise_dcb_report($apikey, $inst_id, $acd_year_id, $batch_id, $class_id);
        // return array('data_status' => 1, 'data' => $dcb_report_data);
        if (!empty($dcb_report_data)) {
            $super_formatted_data = $this->get_report_formatted_for_dcb_report_batch_wise($dcb_report_data);
        }
        // return $super_formatted_data;

        if (isset($super_formatted_data) && !empty($super_formatted_data) && count($super_formatted_data) > 0) {
            return array('data_status' => 1, 'data' => $super_formatted_data);
        } else {
            return array('data_status' => 0, 'message' => 'No data is available');
        }
    }
    private function get_report_formatted_for_dcb_report_batch_wise($report_data, $student_data = "")
    {
        $formatted_data = array();
        $formatted_data_st = array();
        $demand_month = array();
        $feecodes_demand_month = array();
        $super_formatted_data = array();
        $total_demand = 0;
        $total_concession = 0;
        $total_exxcemption = 0;
        $total_net_due = 0;
        //$total_payments = 0;
        $total_advance = 0;
        $total_regular = 0;
        $total_balance = 0;
        $total_arrear = 0;
        foreach ($report_data as $rpt_lvl1) {
            if ($rpt_lvl1['is_by_transfer'] == 1) {
                $advanceamt = $rpt_lvl1['total_paid_amount'];
                $regularamt = 0;
            } else {
                $advanceamt = 0;
                $regularamt = $rpt_lvl1['total_paid_amount'];
            }
            $netdue = ($rpt_lvl1['final_payable_amount'] - ($rpt_lvl1['concession_amount'] + $rpt_lvl1['excemption_amount']));
            $formatted_data[$rpt_lvl1['student_id']][$rpt_lvl1['demanded_month']]['feecode'][$rpt_lvl1['feeCode']]['feecode_desc']   = $rpt_lvl1['feecode_desc'];
            $formatted_data[$rpt_lvl1['student_id']][$rpt_lvl1['demanded_month']]['feecode'][$rpt_lvl1['feeCode']]['demand']         += $rpt_lvl1['demand_amount'];
            $formatted_data[$rpt_lvl1['student_id']][$rpt_lvl1['demanded_month']]['feecode'][$rpt_lvl1['feeCode']]['concession']     += $rpt_lvl1['concession_amount'];
            $formatted_data[$rpt_lvl1['student_id']][$rpt_lvl1['demanded_month']]['feecode'][$rpt_lvl1['feeCode']]['excemption']     += $rpt_lvl1['excemption_amount'];
            $formatted_data[$rpt_lvl1['student_id']][$rpt_lvl1['demanded_month']]['feecode'][$rpt_lvl1['feeCode']]['net_due']        += $netdue;
            $formatted_data[$rpt_lvl1['student_id']][$rpt_lvl1['demanded_month']]['feecode'][$rpt_lvl1['feeCode']]['advance']        += $advanceamt;
            $formatted_data[$rpt_lvl1['student_id']][$rpt_lvl1['demanded_month']]['feecode'][$rpt_lvl1['feeCode']]['regular']        += $regularamt;
            $formatted_data[$rpt_lvl1['student_id']][$rpt_lvl1['demanded_month']]['feecode'][$rpt_lvl1['feeCode']]['balance']        += ($netdue - $rpt_lvl1['total_paid_amount']);
            $formatted_data[$rpt_lvl1['student_id']][$rpt_lvl1['demanded_month']]['feecode'][$rpt_lvl1['feeCode']]['arrear']         += $rpt_lvl1['arrear_amount'];
            // Total Demand
            if (isset($formatted_data_st[$rpt_lvl1['student_id']]['summary_data']['total_demand']))
                $formatted_data_st[$rpt_lvl1['student_id']]['summary_data']['total_demand'] += $formatted_data[$rpt_lvl1['student_id']][$rpt_lvl1['demanded_month']]['feecode'][$rpt_lvl1['feeCode']]['demand'];
            else
                $formatted_data_st[$rpt_lvl1['student_id']]['summary_data']['total_demand'] = $formatted_data[$rpt_lvl1['student_id']][$rpt_lvl1['demanded_month']]['feecode'][$rpt_lvl1['feeCode']]['demand'];
            // Total Concession
            if (isset($formatted_data_st[$rpt_lvl1['student_id']]['summary_data']['total_concession']))
                $formatted_data_st[$rpt_lvl1['student_id']]['summary_data']['total_concession'] += $formatted_data[$rpt_lvl1['student_id']][$rpt_lvl1['demanded_month']]['feecode'][$rpt_lvl1['feeCode']]['concession'];
            else
                $formatted_data_st[$rpt_lvl1['student_id']]['summary_data']['total_concession'] = $formatted_data[$rpt_lvl1['student_id']][$rpt_lvl1['demanded_month']]['feecode'][$rpt_lvl1['feeCode']]['concession'];
            // Total Exemption
            if (isset($formatted_data_st[$rpt_lvl1['student_id']]['summary_data']['total_excemption']))
                $formatted_data_st[$rpt_lvl1['student_id']]['summary_data']['total_excemption'] += $formatted_data[$rpt_lvl1['student_id']][$rpt_lvl1['demanded_month']]['feecode'][$rpt_lvl1['feeCode']]['excemption'];
            else
                $formatted_data_st[$rpt_lvl1['student_id']]['summary_data']['total_excemption'] = $formatted_data[$rpt_lvl1['student_id']][$rpt_lvl1['demanded_month']]['feecode'][$rpt_lvl1['feeCode']]['excemption'];
            // Total Due
            if (isset($formatted_data_st[$rpt_lvl1['student_id']]['summary_data']['total_net_due']))
                $formatted_data_st[$rpt_lvl1['student_id']]['summary_data']['total_net_due'] += $formatted_data[$rpt_lvl1['student_id']][$rpt_lvl1['demanded_month']]['feecode'][$rpt_lvl1['feeCode']]['net_due'];
            else
                $formatted_data_st[$rpt_lvl1['student_id']]['summary_data']['total_net_due'] = $formatted_data[$rpt_lvl1['student_id']][$rpt_lvl1['demanded_month']]['feecode'][$rpt_lvl1['feeCode']]['net_due'];
            // Total Advance
            if (isset($formatted_data_st[$rpt_lvl1['student_id']]['summary_data']['total_advance']))
                $formatted_data_st[$rpt_lvl1['student_id']]['summary_data']['total_advance'] += $formatted_data[$rpt_lvl1['student_id']][$rpt_lvl1['demanded_month']]['feecode'][$rpt_lvl1['feeCode']]['advance'];
            else
                $formatted_data_st[$rpt_lvl1['student_id']]['summary_data']['total_advance'] = $formatted_data[$rpt_lvl1['student_id']][$rpt_lvl1['demanded_month']]['feecode'][$rpt_lvl1['feeCode']]['advance'];
            // Total Regular
            if (isset($formatted_data_st[$rpt_lvl1['student_id']]['summary_data']['total_regular']))
                $formatted_data_st[$rpt_lvl1['student_id']]['summary_data']['total_regular'] += $formatted_data[$rpt_lvl1['student_id']][$rpt_lvl1['demanded_month']]['feecode'][$rpt_lvl1['feeCode']]['regular'];
            else
                $formatted_data_st[$rpt_lvl1['student_id']]['summary_data']['total_regular'] = $formatted_data[$rpt_lvl1['student_id']][$rpt_lvl1['demanded_month']]['feecode'][$rpt_lvl1['feeCode']]['regular'];
            // Total Balance
            if (isset($formatted_data_st[$rpt_lvl1['student_id']]['summary_data']['total_balance']))
                $formatted_data_st[$rpt_lvl1['student_id']]['summary_data']['total_balance'] += $formatted_data[$rpt_lvl1['student_id']][$rpt_lvl1['demanded_month']]['feecode'][$rpt_lvl1['feeCode']]['balance'];
            else
                $formatted_data_st[$rpt_lvl1['student_id']]['summary_data']['total_balance'] = $formatted_data[$rpt_lvl1['student_id']][$rpt_lvl1['demanded_month']]['feecode'][$rpt_lvl1['feeCode']]['balance'];
            // Total Arrear
            if (isset($formatted_data_st[$rpt_lvl1['student_id']]['summary_data']['total_arrear']))
                $formatted_data_st[$rpt_lvl1['student_id']]['summary_data']['total_arrear'] += $formatted_data[$rpt_lvl1['student_id']][$rpt_lvl1['demanded_month']]['feecode'][$rpt_lvl1['feeCode']]['arrear'];
            else
                $formatted_data_st[$rpt_lvl1['student_id']]['summary_data']['total_arrear'] = $formatted_data[$rpt_lvl1['student_id']][$rpt_lvl1['demanded_month']]['feecode'][$rpt_lvl1['feeCode']]['arrear'];

            $super_formatted_data[$rpt_lvl1['student_id']] = array(
                'report_data' => $formatted_data[$rpt_lvl1['student_id']],
                'summary' => array(
                    'total_demand' => $formatted_data_st[$rpt_lvl1['student_id']]['summary_data']['total_demand'],
                    'total_concession' => $formatted_data_st[$rpt_lvl1['student_id']]['summary_data']['total_concession'],
                    'total_excemption' => $formatted_data_st[$rpt_lvl1['student_id']]['summary_data']['total_excemption'],
                    'total_net_due' => $formatted_data_st[$rpt_lvl1['student_id']]['summary_data']['total_net_due'],
                    'total_advance' => $formatted_data_st[$rpt_lvl1['student_id']]['summary_data']['total_advance'],
                    'total_regular' => $formatted_data_st[$rpt_lvl1['student_id']]['summary_data']['total_regular'],
                    //'total_payments' => $total_payments,
                    'total_balance' => $formatted_data_st[$rpt_lvl1['student_id']]['summary_data']['total_balance'],
                    'total_arrear' => $formatted_data_st[$rpt_lvl1['student_id']]['summary_data']['total_arrear']
                ),
                // 'student_data' => $student_data
                'student_data' => array(
                    'Admn_No' => $rpt_lvl1['Admn_No'],
                    'student_id' => $rpt_lvl1['student_id'],
                    'Cur_AcadYr' => $rpt_lvl1['Cur_AcadYr'],
                    'student_name' => $rpt_lvl1['student_name'],
                    'batch_name' => $rpt_lvl1['batch_name'],
                    'Cur_Batch' => $rpt_lvl1['Cur_Batch'],
                    'Cur_Class' => $rpt_lvl1['Cur_Class'],
                    'StatusFlag' => $rpt_lvl1['StatusFlag'],
                    'Priority' => $rpt_lvl1['Priority']
                )
            );
        }
        return $super_formatted_data;
    }

    //PAYBACK SUMMARY REPORT
    public function get_payback_summary_report($params)
    {
        $apikey = $params['API_KEY'];

        if (!(isset($params['inst_id']) && !empty($params['inst_id']))) {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Inst code is required', 'data' => FALSE);
        } else {
            $inst_id = $params['inst_id'];
        }
        if (!(isset($params['acd_year_id']) && !empty($params['acd_year_id']))) {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Academic year data is required', 'data' => FALSE);
        } else {
            $acd_year_id = $params['acd_year_id'];
        }

        if (!(isset($params['from_date']) && !empty($params['from_date']))) {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'From date data is required', 'data' => FALSE);
        } else {
            $from_date = $params['from_date'];
        }

        if (!(isset($params['to_date']) && !empty($params['to_date']))) {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'To date data is required', 'data' => FALSE);
        } else {
            $to_date = $params['to_date'];
        }
        $report_data = $this->MReport->get_payback_data_report($apikey, $inst_id, $acd_year_id, $from_date, $to_date);
        $report_pend_reject = $this->MReport->get_payback_data_report_pending_reject($apikey, $inst_id, $acd_year_id, $from_date, $to_date);

        if ((isset($report_data) && !empty($report_data) && count($report_data) > 0) || (isset($report_pend_reject) && !empty($report_pend_reject) && count($report_pend_reject) > 0)) {
            return array('data_status' => 1, 'data' => $report_data, 'other_data' => $report_pend_reject);
        } else {
            return array('data_status' => 0, 'message' => 'No data is available');
        }
    }

    //ONLINE PAY DETAILS REPORT
    public function get_online_pay_report($params)
    {
        $apikey = $params['API_KEY'];

        if (!(isset($params['inst_id']) && !empty($params['inst_id']))) {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Inst code is required', 'data' => FALSE);
        } else {
            $inst_id = $params['inst_id'];
        }
        if (!(isset($params['acd_year_id']) && !empty($params['acd_year_id']))) {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Academic year data is required', 'data' => FALSE);
        } else {
            $acd_year_id = $params['acd_year_id'];
        }

        if (!(isset($params['from_date']) && !empty($params['from_date']))) {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'From date data is required', 'data' => FALSE);
        } else {
            $from_date = $params['from_date'];
        }

        if (!(isset($params['to_date']) && !empty($params['to_date']))) {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'To date data is required', 'data' => FALSE);
        } else {
            $to_date = $params['to_date'];
        }
        $report_data = $this->MReport->get_online_pay_data_report($apikey, $inst_id, $acd_year_id, $from_date, $to_date);

        if (isset($report_data) && !empty($report_data) && count($report_data) > 0) {
            return array('data_status' => 1, 'data' => $report_data);
        } else {
            return array('data_status' => 0, 'message' => 'No data is available');
        }
    }
    //TRANSPORT LIST REPORT
    public function get_transport_due_list($params)
    {

        $apikey = $params['API_KEY'];

        if (!(isset($params['inst_id']) && !empty($params['inst_id']))) {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Inst code is required', 'data' => FALSE);
        } else {
            $inst_id = $params['inst_id'];
        }
        if (!(isset($params['acd_year_id']) && !empty($params['acd_year_id']))) {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Academic year data is required', 'data' => FALSE);
        } else {
            $acd_year_id = $params['acd_year_id'];
        }

        if (!(isset($params['batch_id']) && !empty($params['batch_id']))) {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Batch data is required', 'data' => FALSE);
        } else {
            $batch_id = $params['batch_id'];
        }
        if (!(isset($params['class_id']) && !empty($params['class_id']))) {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Class data required', 'data' => FALSE);
        } else {
            $class_id = $params['class_id'];
        }

        $report_data = $this->MReport->get_transport_due_list($apikey, $inst_id, $acd_year_id, $batch_id, $class_id);
        // return $report_data;
        $formatted_report_data = $this->get_report_formatted_for_arrear_list_report($report_data, $apikey, $inst_id, 'transport');
        // return $formatted_report_data;
        if (isset($formatted_report_data) && !empty($formatted_report_data) && count($formatted_report_data) > 0) {
            return array('data_status' => 1, 'data' => $formatted_report_data);
        } else {
            return array('data_status' => 0, 'message' => 'No data is available');
        }
    }

    //ARREAR LIST REPORT
    public function get_arrear_list_report_as_on_date_for_batch($params)
    {
        // return $params;
        $apikey = $params['API_KEY'];

        if (!(isset($params['inst_id']) && !empty($params['inst_id']))) {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Inst code is required', 'data' => FALSE);
        } else {
            $inst_id = $params['inst_id'];
        }
        if (!(isset($params['acd_year_id']) && !empty($params['acd_year_id']))) {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Academic year data is required', 'data' => FALSE);
        } else {
            $acd_year_id = $params['acd_year_id'];
        }

        if (!(isset($params['batch_id']) && !empty($params['batch_id']))) {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Batch data is required', 'data' => FALSE);
        } else {
            $batch_id = $params['batch_id'];
        }
        if (!(isset($params['class_id']) && !empty($params['class_id']))) {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Class data required', 'data' => FALSE);
        } else {
            $class_id = $params['class_id'];
        }

        $report_data = $this->MReport->get_report_data_for_arrear_list($apikey, $inst_id, $acd_year_id, $batch_id, $class_id);
        $formatted_report_data = $this->get_report_formatted_for_arrear_list_report($report_data, $apikey, $inst_id);
        // return $report_data;

        if (isset($formatted_report_data) && !empty($formatted_report_data) && count($formatted_report_data) > 0) {
            return array('data_status' => 1, 'data' => $formatted_report_data);
        } else {
            return array('data_status' => 0, 'message' => 'No data is available');
        }
    }
    private function get_report_formatted_for_arrear_list_report($report_data, $apikey, $inst_id, $reporttype = '')
    {
        $batch_name = '';
        $acd_year_sel = '';
        $formatted_data = array();
        $formatted_data_nd = array();

        $admn_no = array();
        $fee_code_data = array();
        $fee_code_student = array();
        $fee_code_student_nd = array();
        $demanded_month_student = array();
        $demanded_month_student_nd = array();
        $acdyear_array = array();
        foreach ($report_data as $rpt_data) {
            $batch_name = $rpt_data['Batch_Name'];
            $acd_year_sel = $rpt_data['acd_year'];
            if (!in_array($acd_year_sel, $acdyear_array)) {
                array_push($acdyear_array, $acd_year_sel);
            }
            if (!(in_array($rpt_data['feeCode'], $fee_code_data))) {
                //$fee_code_data[] = $rpt_data['feeCode'];
                $fee_code_data[$rpt_data['feeCode']] = $rpt_data['fee_shortcode'];
            }
            if (in_array($rpt_data['Admn_No'], $admn_no)) {
                if (in_array($rpt_data['demanded_month'], $demanded_month_student[$rpt_data['Admn_No']])) {
                    if (in_array($rpt_data['feeCode'], $fee_code_student[$rpt_data['Admn_No']]['arrear'][$rpt_data['demanded_month']])) {
                        if ($rpt_data['demandType'] == 1) {
                            if (isset($formatted_data[$acd_year_sel][$batch_name][$rpt_data['Admn_No']]['arrear'][$rpt_data['demanded_month']]['fee_data'][$rpt_data['feeCode']]['amount']))
                                $formatted_data[$acd_year_sel][$batch_name][$rpt_data['Admn_No']]['arrear'][$rpt_data['demanded_month']]['fee_data'][$rpt_data['feeCode']]['amount'] += $rpt_data['pending_payment'];
                            else
                                $formatted_data[$acd_year_sel][$batch_name][$rpt_data['Admn_No']]['arrear'][$rpt_data['demanded_month']]['fee_data'][$rpt_data['feeCode']]['amount'] = $rpt_data['pending_payment']; //$formatted_data[$acd_year_sel][$batch_name][$rpt_data['Admn_No']][$rpt_data['demanded_month']]['fee_data'][$rpt_data['feeCode']]['amount']
                        } else {
                            if (isset($formatted_data_nd[$batch_name][$rpt_data['Admn_No']]['arrear'][$rpt_data['demanded_month']]['fee_data'][$rpt_data['feeCode']]['amount']))
                                $formatted_data_nd[$acd_year_sel][$batch_name][$rpt_data['Admn_No']]['arrear'][$rpt_data['demanded_month']]['fee_data'][$rpt_data['feeCode']]['amount'] += $rpt_data['pending_payment'];
                            else
                                $formatted_data_nd[$acd_year_sel][$batch_name][$rpt_data['Admn_No']]['arrear'][$rpt_data['demanded_month']]['fee_data'][$rpt_data['feeCode']]['amount'] = $rpt_data['pending_payment'];

                            if (isset($formatted_data[$acd_year_sel][$batch_name][$rpt_data['Admn_No']]['arrear'][$rpt_data['demanded_month']]['fee_data']['OTH']['amount']))
                                $formatted_data[$acd_year_sel][$batch_name][$rpt_data['Admn_No']]['arrear'][$rpt_data['demanded_month']]['fee_data']['OTH']['amount'] += $rpt_data['pending_payment'];
                            else
                                $formatted_data[$acd_year_sel][$batch_name][$rpt_data['Admn_No']]['arrear'][$rpt_data['demanded_month']]['fee_data']['OTH']['amount'] = $rpt_data['pending_payment'];
                        }
                    } else {
                        if ($rpt_data['demandType'] == 1) {
                            $formatted_data[$acd_year_sel][$batch_name][$rpt_data['Admn_No']]['arrear'][$rpt_data['demanded_month']]['fee_data'][$rpt_data['feeCode']]['amount'] += $rpt_data['pending_payment'];
                            $formatted_data[$acd_year_sel][$batch_name][$rpt_data['Admn_No']]['arrear'][$rpt_data['demanded_month']]['fee_data'][$rpt_data['feeCode']]['fee_code'] = $rpt_data['feeCode'];
                            $formatted_data[$acd_year_sel][$batch_name][$rpt_data['Admn_No']]['arrear'][$rpt_data['demanded_month']]['fee_data'][$rpt_data['feeCode']]['feecode_desc'] = $rpt_data['feecode_desc'];
                            $formatted_data[$acd_year_sel][$batch_name][$rpt_data['Admn_No']]['arrear'][$rpt_data['demanded_month']]['fee_data'][$rpt_data['feeCode']]['fee_shortcode'] = $rpt_data['fee_shortcode'];
                            $formatted_data[$acd_year_sel][$batch_name][$rpt_data['Admn_No']]['arrear'][$rpt_data['demanded_month']]['fee_data'][$rpt_data['feeCode']]['demand_month'] = $rpt_data['demanded_month'];

                            // if (isset($formatted_data[$acd_year_sel][$batch_name][$rpt_data['Admn_No']]['arrear'][$rpt_data['demanded_month']]['fee_data'][$rpt_data['feeCode']]['amount'])) {
                            //     $formatted_data[$acd_year_sel][$batch_name][$rpt_data['Admn_No']]['arrear'][$rpt_data['demanded_month']]['fee_data'][$rpt_data['feeCode']]['amount'] += $rpt_data['pending_payment'];
                            // } else {
                            //     $formatted_data[$acd_year_sel][$batch_name][$rpt_data['Admn_No']]['arrear'][$rpt_data['demanded_month']]['fee_data'][$rpt_data['feeCode']] = array(
                            //         'fee_code' => $rpt_data['feeCode'],
                            //         'feecode_desc' => $rpt_data['feecode_desc'],
                            //         'fee_shortcode' => $rpt_data['fee_shortcode'],
                            //         'amount' => $rpt_data['pending_payment'],
                            //         'demand_month' => $rpt_data['demanded_month']
                            //     );
                            // }
                            $fee_code_student[$rpt_data['Admn_No']]['arrear'][$rpt_data['demanded_month']][] = $rpt_data['feeCode'];
                        } else {
                            $formatted_data_nd[$acd_year_sel][$batch_name][$rpt_data['Admn_No']]['arrear'][$rpt_data['demanded_month']]['fee_data'][$rpt_data['feeCode']]['amount'] += $rpt_data['pending_payment'];
                            $formatted_data_nd[$acd_year_sel][$batch_name][$rpt_data['Admn_No']]['arrear'][$rpt_data['demanded_month']]['fee_data'][$rpt_data['feeCode']]['fee_code'] = $rpt_data['feeCode'];
                            $formatted_data_nd[$acd_year_sel][$batch_name][$rpt_data['Admn_No']]['arrear'][$rpt_data['demanded_month']]['fee_data'][$rpt_data['feeCode']]['feecode_desc'] = $rpt_data['feecode_desc'];
                            $formatted_data_nd[$acd_year_sel][$batch_name][$rpt_data['Admn_No']]['arrear'][$rpt_data['demanded_month']]['fee_data'][$rpt_data['feeCode']]['fee_shortcode'] = $rpt_data['fee_shortcode'];
                            $formatted_data_nd[$acd_year_sel][$batch_name][$rpt_data['Admn_No']]['arrear'][$rpt_data['demanded_month']]['fee_data'][$rpt_data['feeCode']]['demand_month'] = $rpt_data['demanded_month'];


                            // if (isset($formatted_data_nd[$batch_name][$rpt_data['Admn_No']]['arrear'][$rpt_data['demanded_month']]['fee_data'][$rpt_data['feeCode']]['amount'])) {
                            //     $formatted_data_nd[$batch_name][$rpt_data['Admn_No']]['arrear'][$rpt_data['demanded_month']]['fee_data'][$rpt_data['feeCode']]['amount'] += $rpt_data['pending_payment'];
                            // } else {
                            //     $formatted_data_nd[$batch_name][$rpt_data['Admn_No']]['arrear'][$rpt_data['demanded_month']]['fee_data'][$rpt_data['feeCode']] = array(
                            //         'fee_code' => $rpt_data['feeCode'],
                            //         'feecode_desc' => $rpt_data['feecode_desc'],
                            //         'fee_shortcode' => $rpt_data['fee_shortcode'],
                            //         'amount' => $rpt_data['pending_payment'],
                            //         'demand_month' => $rpt_data['demanded_month']
                            //     );
                            // }
                            $fee_code_student_nd[$rpt_data['Admn_No']][$rpt_data['demanded_month']][] = $rpt_data['feeCode'];
                            $formatted_data[$acd_year_sel][$batch_name][$rpt_data['Admn_No']]['arrear'][$rpt_data['demanded_month']]['fee_data']['OTH']['amount'] += $rpt_data['pending_payment'];
                            $formatted_data[$acd_year_sel][$batch_name][$rpt_data['Admn_No']]['arrear'][$rpt_data['demanded_month']]['fee_data']['OTH']['fee_code'] = 'OTH';
                            $formatted_data[$acd_year_sel][$batch_name][$rpt_data['Admn_No']]['arrear'][$rpt_data['demanded_month']]['fee_data']['OTH']['feecode_desc'] = 'OTHERS';
                            $formatted_data[$acd_year_sel][$batch_name][$rpt_data['Admn_No']]['arrear'][$rpt_data['demanded_month']]['fee_data']['OTH']['fee_shortcode'] = 'OTH';
                            $formatted_data[$acd_year_sel][$batch_name][$rpt_data['Admn_No']]['arrear'][$rpt_data['demanded_month']]['fee_data']['OTH']['demand_month'] = $rpt_data['demanded_month'];

                            // if (isset($formatted_data[$acd_year_sel][$batch_name][$rpt_data['Admn_No']]['arrear'][$rpt_data['demanded_month']]['fee_data']['OTH']['amount'])) {
                            //     $formatted_data[$acd_year_sel][$batch_name][$rpt_data['Admn_No']]['arrear'][$rpt_data['demanded_month']]['fee_data']['OTH']['amount'] += $rpt_data['pending_payment'];
                            // } else {
                            //     $formatted_data[$acd_year_sel][$batch_name][$rpt_data['Admn_No']]['arrear'][$rpt_data['demanded_month']]['fee_data']['OTH'] = array(
                            //         'fee_code' => 'OTH',
                            //         'feecode_desc' => 'OTHERS',
                            //         'fee_shortcode' => 'OTH',
                            //         'amount' => $rpt_data['pending_payment'],
                            //         'demand_month' => $rpt_data['demanded_month']
                            //     );
                            // }
                            $fee_code_student[$rpt_data['Admn_No']]['arrear'][$rpt_data['demanded_month']][] = 'OTH';
                        }
                    }
                } else {
                    if ($rpt_data['demandType'] == 1) {
                        $formatted_data[$acd_year_sel][$batch_name][$rpt_data['Admn_No']]['arrear'][$rpt_data['demanded_month']]['fee_data'][$rpt_data['feeCode']]['amount'] += $rpt_data['pending_payment'];
                        $formatted_data[$acd_year_sel][$batch_name][$rpt_data['Admn_No']]['arrear'][$rpt_data['demanded_month']]['fee_data'][$rpt_data['feeCode']]['fee_code'] = $rpt_data['feeCode'];
                        $formatted_data[$acd_year_sel][$batch_name][$rpt_data['Admn_No']]['arrear'][$rpt_data['demanded_month']]['fee_data'][$rpt_data['feeCode']]['feecode_desc'] = $rpt_data['feecode_desc'];
                        $formatted_data[$acd_year_sel][$batch_name][$rpt_data['Admn_No']]['arrear'][$rpt_data['demanded_month']]['fee_data'][$rpt_data['feeCode']]['fee_shortcode'] = $rpt_data['fee_shortcode'];
                        $formatted_data[$acd_year_sel][$batch_name][$rpt_data['Admn_No']]['arrear'][$rpt_data['demanded_month']]['fee_data'][$rpt_data['feeCode']]['demand_month'] = $rpt_data['demanded_month'];


                        // if (isset($formatted_data[$acd_year_sel][$batch_name][$rpt_data['Admn_No']]['arrear'][$rpt_data['demanded_month']]['fee_data'][$rpt_data['feeCode']]['amount'])) {
                        //     $formatted_data[$acd_year_sel][$batch_name][$rpt_data['Admn_No']]['arrear'][$rpt_data['demanded_month']]['fee_data'][$rpt_data['feeCode']]['amount'] += $rpt_data['pending_payment'];
                        // } else {
                        //     $formatted_data[$acd_year_sel][$batch_name][$rpt_data['Admn_No']]['arrear'][$rpt_data['demanded_month']]['fee_data'][$rpt_data['feeCode']] = array(
                        //         'fee_code' => $rpt_data['feeCode'],
                        //         'feecode_desc' => $rpt_data['feecode_desc'],
                        //         'fee_shortcode' => $rpt_data['fee_shortcode'],
                        //         'amount' => $rpt_data['pending_payment'],
                        //         'demand_month' => $rpt_data['demanded_month']
                        //     );
                        // }
                        $demanded_month_student[$rpt_data['Admn_No']]['arrear'][] = $rpt_data['demanded_month'];
                    } else {
                        $formatted_data_nd[$acd_year_sel][$batch_name][$rpt_data['Admn_No']]['arrear'][$rpt_data['demanded_month']]['fee_data'][$rpt_data['feeCode']]['amount'] += $rpt_data['pending_payment'];
                        $formatted_data_nd[$acd_year_sel][$batch_name][$rpt_data['Admn_No']]['arrear'][$rpt_data['demanded_month']]['fee_data'][$rpt_data['feeCode']]['fee_code'] = $rpt_data['feeCode'];
                        $formatted_data_nd[$acd_year_sel][$batch_name][$rpt_data['Admn_No']]['arrear'][$rpt_data['demanded_month']]['fee_data'][$rpt_data['feeCode']]['feecode_desc'] = $rpt_data['feecode_desc'];
                        $formatted_data_nd[$acd_year_sel][$batch_name][$rpt_data['Admn_No']]['arrear'][$rpt_data['demanded_month']]['fee_data'][$rpt_data['feeCode']]['fee_shortcode'] = $rpt_data['fee_shortcode'];
                        $formatted_data_nd[$acd_year_sel][$batch_name][$rpt_data['Admn_No']]['arrear'][$rpt_data['demanded_month']]['fee_data'][$rpt_data['feeCode']]['demand_month'] = $rpt_data['demanded_month'];


                        // if (isset($formatted_data_nd[$batch_name][$rpt_data['Admn_No']]['arrear'][$rpt_data['demanded_month']]['fee_data'][$rpt_data['feeCode']]['amount'])) {
                        //     $formatted_data_nd[$batch_name][$rpt_data['Admn_No']]['arrear'][$rpt_data['demanded_month']]['fee_data'][$rpt_data['feeCode']]['amount'] += $rpt_data['pending_payment'];
                        // } else {
                        //     $formatted_data_nd[$batch_name][$rpt_data['Admn_No']]['arrear'][$rpt_data['demanded_month']]['fee_data'][$rpt_data['feeCode']] = array(
                        //         'fee_code' => $rpt_data['feeCode'],
                        //         'feecode_desc' => $rpt_data['feecode_desc'],
                        //         'fee_shortcode' => $rpt_data['fee_shortcode'],
                        //         'amount' => $rpt_data['pending_payment'],
                        //         'demand_month' => $rpt_data['demanded_month']
                        //     );
                        // }
                        $demanded_month_student_nd[$rpt_data['Admn_No']][] = $rpt_data['demanded_month'];
                        $formatted_data[$acd_year_sel][$batch_name][$rpt_data['Admn_No']]['arrear'][$rpt_data['demanded_month']]['fee_data']['OTH']['amount'] += $rpt_data['pending_payment'];
                        $formatted_data[$acd_year_sel][$batch_name][$rpt_data['Admn_No']]['arrear'][$rpt_data['demanded_month']]['fee_data']['OTH']['fee_code'] = 'OTH';
                        $formatted_data[$acd_year_sel][$batch_name][$rpt_data['Admn_No']]['arrear'][$rpt_data['demanded_month']]['fee_data']['OTH']['feecode_desc'] = 'OTHERS';
                        $formatted_data[$acd_year_sel][$batch_name][$rpt_data['Admn_No']]['arrear'][$rpt_data['demanded_month']]['fee_data']['OTH']['fee_shortcode'] = 'OTH';
                        $formatted_data[$acd_year_sel][$batch_name][$rpt_data['Admn_No']]['arrear'][$rpt_data['demanded_month']]['fee_data']['OTH']['demand_month'] = $rpt_data['demanded_month'];

                        // if (isset($formatted_data[$acd_year_sel][$batch_name][$rpt_data['Admn_No']]['arrear'][$rpt_data['demanded_month']]['fee_data']['OTH']['amount'])) {
                        //     $formatted_data[$acd_year_sel][$batch_name][$rpt_data['Admn_No']]['arrear'][$rpt_data['demanded_month']]['fee_data']['OTH']['amount'] += $rpt_data['pending_payment'];
                        // } else {
                        //     $formatted_data[$acd_year_sel][$batch_name][$rpt_data['Admn_No']]['arrear'][$rpt_data['demanded_month']]['fee_data']['OTH'] = array(
                        //         'fee_code' => 'OTH',
                        //         'feecode_desc' => 'OTHERS',
                        //         'fee_shortcode' => 'OTH',
                        //         'amount' => $rpt_data['pending_payment'],
                        //         'demand_month' => $rpt_data['demanded_month']
                        //     );
                        // }

                        $demanded_month_student[$rpt_data['Admn_No']]['arrear'][] = $rpt_data['demanded_month'];
                    }
                }
            } else {
                $formatted_data[$acd_year_sel][$batch_name][$rpt_data['Admn_No']]['student_data'] = array(
                    'admn_no' => $rpt_data['Admn_No'],
                    'student_name' => $rpt_data['First_Name'],
                    'batch_name' => $rpt_data['Batch_Name']
                );
                if ($rpt_data['demandType'] == 2) {
                    $formatted_data_nd[$acd_year_sel][$batch_name][$rpt_data['Admn_No']]['student_data'] = array(
                        'admn_no' => $rpt_data['Admn_No'],
                        'student_name' => $rpt_data['First_Name'],
                        'batch_name' => $rpt_data['Batch_Name']
                    );
                }
                if ($rpt_data['demandType'] == 1) {
                    $formatted_data[$acd_year_sel][$batch_name][$rpt_data['Admn_No']]['arrear'][$rpt_data['demanded_month']]['fee_data'][$rpt_data['feeCode']]['amount'] += $rpt_data['pending_payment'];
                    $formatted_data[$acd_year_sel][$batch_name][$rpt_data['Admn_No']]['arrear'][$rpt_data['demanded_month']]['fee_data'][$rpt_data['feeCode']]['fee_code'] = $rpt_data['feeCode'];
                    $formatted_data[$acd_year_sel][$batch_name][$rpt_data['Admn_No']]['arrear'][$rpt_data['demanded_month']]['fee_data'][$rpt_data['feeCode']]['feecode_desc'] = $rpt_data['feecode_desc'];
                    $formatted_data[$acd_year_sel][$batch_name][$rpt_data['Admn_No']]['arrear'][$rpt_data['demanded_month']]['fee_data'][$rpt_data['feeCode']]['fee_shortcode'] = $rpt_data['fee_shortcode'];
                    $formatted_data[$acd_year_sel][$batch_name][$rpt_data['Admn_No']]['arrear'][$rpt_data['demanded_month']]['fee_data'][$rpt_data['feeCode']]['demand_month'] = $rpt_data['demanded_month'];

                    // if (isset($formatted_data[$acd_year_sel][$batch_name][$rpt_data['Admn_No']]['arrear'][$rpt_data['demanded_month']]['fee_data'][$rpt_data['feeCode']]['amount'])) {
                    //     $formatted_data[$acd_year_sel][$batch_name][$rpt_data['Admn_No']]['arrear'][$rpt_data['demanded_month']]['fee_data'][$rpt_data['feeCode']]['amount'] += $rpt_data['pending_payment'];
                    // } else {
                    //     $formatted_data[$acd_year_sel][$batch_name][$rpt_data['Admn_No']]['arrear'][$rpt_data['demanded_month']]['fee_data'][$rpt_data['feeCode']] = array(
                    //         'fee_code' => $rpt_data['feeCode'],
                    //         'feecode_desc' => $rpt_data['feecode_desc'],
                    //         'fee_shortcode' => $rpt_data['fee_shortcode'],
                    //         'amount' => $rpt_data['pending_payment'],
                    //         'demand_month' => $rpt_data['demanded_month']
                    //     );
                    // }
                } else {
                    $formatted_data_nd[$acd_year_sel][$batch_name][$rpt_data['Admn_No']]['arrear'][$rpt_data['demanded_month']]['fee_data'][$rpt_data['feeCode']]['amount'] += $rpt_data['pending_payment'];
                    $formatted_data_nd[$acd_year_sel][$batch_name][$rpt_data['Admn_No']]['arrear'][$rpt_data['demanded_month']]['fee_data'][$rpt_data['feeCode']]['fee_code'] = $rpt_data['feeCode'];
                    $formatted_data_nd[$acd_year_sel][$batch_name][$rpt_data['Admn_No']]['arrear'][$rpt_data['demanded_month']]['fee_data'][$rpt_data['feeCode']]['feecode_desc'] = $rpt_data['feecode_desc'];
                    $formatted_data_nd[$acd_year_sel][$batch_name][$rpt_data['Admn_No']]['arrear'][$rpt_data['demanded_month']]['fee_data'][$rpt_data['feeCode']]['fee_shortcode'] = $rpt_data['fee_shortcode'];
                    $formatted_data_nd[$acd_year_sel][$batch_name][$rpt_data['Admn_No']]['arrear'][$rpt_data['demanded_month']]['fee_data'][$rpt_data['feeCode']]['demand_month'] = $rpt_data['demanded_month'];

                    // if (isset($formatted_data_nd[$batch_name][$rpt_data['Admn_No']]['arrear'][$rpt_data['demanded_month']]['fee_data'][$rpt_data['feeCode']]['amount'])) {
                    //     $formatted_data_nd[$batch_name][$rpt_data['Admn_No']]['arrear'][$rpt_data['demanded_month']]['fee_data'][$rpt_data['feeCode']]['amount'] += $rpt_data['pending_payment'];
                    // } else {
                    //     $formatted_data_nd[$batch_name][$rpt_data['Admn_No']]['arrear'][$rpt_data['demanded_month']]['fee_data'][$rpt_data['feeCode']] = array(
                    //         'fee_code' => $rpt_data['feeCode'],
                    //         'feecode_desc' => $rpt_data['feecode_desc'],
                    //         'fee_shortcode' => $rpt_data['fee_shortcode'],
                    //         'amount' => $rpt_data['pending_payment'],
                    //         'demand_month' => $rpt_data['demanded_month']
                    //     );
                    // }
                    $formatted_data[$acd_year_sel][$batch_name][$rpt_data['Admn_No']]['arrear'][$rpt_data['demanded_month']]['fee_data']['OTH']['amount'] += $rpt_data['pending_payment'];
                    $formatted_data[$acd_year_sel][$batch_name][$rpt_data['Admn_No']]['arrear'][$rpt_data['demanded_month']]['fee_data']['OTH']['fee_code'] = 'OTH';
                    $formatted_data[$acd_year_sel][$batch_name][$rpt_data['Admn_No']]['arrear'][$rpt_data['demanded_month']]['fee_data']['OTH']['feecode_desc'] = 'OTHERS';
                    $formatted_data[$acd_year_sel][$batch_name][$rpt_data['Admn_No']]['arrear'][$rpt_data['demanded_month']]['fee_data']['OTH']['fee_shortcode'] = 'OTH';
                    $formatted_data[$acd_year_sel][$batch_name][$rpt_data['Admn_No']]['arrear'][$rpt_data['demanded_month']]['fee_data']['OTH']['demand_month'] = $rpt_data['demanded_month'];

                    // if (isset($formatted_data[$batch_name][$rpt_data['Admn_No']]['arrear'][$rpt_data['demanded_month']]['fee_data']['OTH']['amount'])) {
                    //     $formatted_data[$batch_name][$rpt_data['Admn_No']]['arrear'][$rpt_data['demanded_month']]['fee_data']['OTH']['amount'] += $rpt_data['pending_payment'];
                    // } else {
                    //     $formatted_data[$batch_name][$rpt_data['Admn_No']]['arrear'][$rpt_data['demanded_month']]['fee_data']['OTH'] = array(
                    //         'fee_code' => 'OTH',
                    //         'feecode_desc' => 'OTHERS',
                    //         'fee_shortcode' => 'OTH',
                    //         'amount' => $rpt_data['pending_payment'],
                    //         'demand_month' => $rpt_data['demanded_month']
                    //     );
                    // }
                }

                $demanded_month_student[$rpt_data['Admn_No']][] = $rpt_data['demanded_month'];
                $demanded_month_student_nd[$rpt_data['Admn_No']][] = $rpt_data['demanded_month'];
                $fee_code_student[$rpt_data['Admn_No']][$rpt_data['demanded_month']][] = $rpt_data['feeCode'];
                $fee_code_student_nd[$rpt_data['Admn_No']][$rpt_data['demanded_month']][] = $rpt_data['feeCode'];
                if (!(in_array($rpt_data['feeCode'], $fee_code_data))) {
                    //$fee_code_data[] = $rpt_data['feeCode'];
                    $fee_code_data[$rpt_data['feeCode']] = $rpt_data['fee_shortcode'];
                }
            }
        }
        if ($reporttype == 'transport') {
            $primary_fee_code_data = array(
                'feeCode' => 'F002',
                'fee_shortcode' => 'BUS',
                'description' => 'BUS FEE',
                'editable'   => 1
            );
            $non_demandable_feecodes = NULL;
        } else {
            $primary_fee_code_data = $this->MReport->get_all_demandable_feecodes_available($apikey, $inst_id);
            $primary_fee_code_data[] = array(
                'feeCode' => 'OTH',
                'fee_shortcode' => 'OTH',
                'description' => 'OTHERS (NON DEMANDABLE FEES)',
                'editable'   => 1
            );
            $non_demandable_feecodes = $this->MReport->get_all_feecodes_non_demandable($apikey, $inst_id);
        }

        $super_formatted_array = array(
            'fee_code_data' => $primary_fee_code_data,
            'report_data' => $formatted_data,
            'report_data_nd' => $formatted_data_nd,
            'acdyear_array' => sort($acdyear_array),
            'non_demandable_feecodes' => $non_demandable_feecodes
        );

        return $super_formatted_array;
    }

    //LONG ABSENTEE ARREAR LIST REPORT
    public function get_arrear_list_longab_report_as_on_date_for_batch($params)
    {
        $apikey = $params['API_KEY'];

        if (!(isset($params['inst_id']) && !empty($params['inst_id']))) {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Inst code is required', 'data' => FALSE);
        } else {
            $inst_id = $params['inst_id'];
        }
        if (!(isset($params['acd_year_id']) && !empty($params['acd_year_id']))) {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Academic year data is required', 'data' => FALSE);
        } else {
            $acd_year_id = $params['acd_year_id'];
        }

        if (!(isset($params['batch_id']) && !empty($params['batch_id']))) {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Batch data is required', 'data' => FALSE);
        } else {
            $batch_id = $params['batch_id'];
        }
        if (!(isset($params['class_id']) && !empty($params['class_id']))) {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Class data required', 'data' => FALSE);
        } else {
            $class_id = $params['class_id'];
        }
        $feecode_rpthead = $this->MReport->get_all_feecodes_available($apikey, $inst_id);
        //        dev_export($feecode_rpthead);die;
        $fcode_format = array();
        foreach ($feecode_rpthead as $fval) {
            $fcode_format[] = $fval['feeCode'];
        }
        $report_data = $this->MReport->get_long_absentee_arrear_list($apikey, $inst_id, $acd_year_id, $batch_id, $class_id);
        //        dev_export($report_data);
        //        die;
        //$formatted_report_data = $this->get_report_formatted_for_arrear_list_longab_report($report_data, $fcode_format);
        $formatted_report_data = $this->get_report_formatted_for_arrear_list_report($report_data, $apikey, $inst_id);
        if (isset($formatted_report_data) && !empty($formatted_report_data) && count($formatted_report_data) > 0) {
            return array('data_status' => 1, 'data' => $formatted_report_data);
        } else {
            return array('data_status' => 0, 'message' => 'No data is available');
        }
    }
    private function get_report_formatted_for_arrear_list_longab_report($report_data, $fee_code_data)
    {
        $batch_name = '';
        $formatted_data = array();

        $admn_no = array();
        //        $fee_code_data = array();
        $fee_code_student = array();
        $demanded_month_student = array();
        foreach ($report_data as $rpt_data) {
            $batch_name = $rpt_data['Batch_Name'];

            //            if (!(in_array($rpt_data['feeCode'], $fee_code_data))) {
            //                $fee_code_data[] = $rpt_data['feeCode'];
            //                $fee_code_data[$rpt_data['feeCode']] = $rpt_data['fee_shortcode'];
            //            }
            if (in_array($rpt_data['Admn_No'], $admn_no)) {
                if (in_array($rpt_data['demanded_month'], $demanded_month_student[$rpt_data['Admn_No']])) {
                    if (in_array($rpt_data['feeCode'], $fee_code_student[$rpt_data['Admn_No']][$rpt_data['demanded_month']])) {
                        $formatted_data[$batch_name][$rpt_data['Admn_No']][$rpt_data['demanded_month']]['fee_data'][$rpt_data['feeCode']]['amount'] = $formatted_data[$batch_name][$rpt_data['Admn_No']][$rpt_data['demanded_month']]['fee_data'][$rpt_data['feeCode']]['amount'] + $rpt_data['pending_payment'];
                    } else {
                        $formatted_data[$batch_name][$rpt_data['Admn_No']]['arrear'][$rpt_data['demanded_month']]['fee_data'][$rpt_data['feeCode']] = array(
                            'fee_code' => $rpt_data['feeCode'],
                            'feecode_desc' => $rpt_data['feecode_desc'],
                            'amount' => $rpt_data['pending_payment'],
                            'demand_month' => $rpt_data['demanded_month']
                        );
                        $fee_code_student[$rpt_data['Admn_No']][$rpt_data['demanded_month']][] = $rpt_data['feeCode'];
                    }
                } else {
                    $formatted_data[$batch_name][$rpt_data['Admn_No']]['arrear'][$rpt_data['demanded_month']]['fee_data'][$rpt_data['feeCode']] = array(
                        'fee_code' => $rpt_data['feeCode'],
                        'feecode_desc' => $rpt_data['feecode_desc'],
                        'amount' => $rpt_data['pending_payment'],
                        'demand_month' => $rpt_data['demanded_month']
                    );
                    $demanded_month_student[$rpt_data['Admn_No']][] = $rpt_data['demanded_month'];
                }
            } else {
                $formatted_data[$batch_name][$rpt_data['Admn_No']]['student_data'] = array(
                    'admn_no' => $rpt_data['Admn_No'],
                    'student_name' => $rpt_data['First_Name'],
                    'batch_name' => $rpt_data['Batch_Name']
                );

                $formatted_data[$batch_name][$rpt_data['Admn_No']]['arrear'][$rpt_data['demanded_month']]['fee_data'][$rpt_data['feeCode']] = array(
                    'fee_code' => $rpt_data['feeCode'],
                    'feecode_desc' => $rpt_data['feecode_desc'],
                    'amount' => $rpt_data['pending_payment'],
                    'demand_month' => $rpt_data['demanded_month']
                );
                $demanded_month_student[$rpt_data['Admn_No']][] = $rpt_data['demanded_month'];
                $fee_code_student[$rpt_data['Admn_No']][$rpt_data['demanded_month']][] = $rpt_data['feeCode'];
                if (!(in_array($rpt_data['feeCode'], $fee_code_data))) {
                    //$fee_code_data[] = $rpt_data['feeCode'];
                    $fee_code_data[$rpt_data['feeCode']] = $rpt_data['fee_shortcode'];
                }
            }
        }
        $super_formatted_array = array(
            'fee_code_data' => $fee_code_data,
            'report_data' => $formatted_data
        );

        return $super_formatted_array;
    }

    //ARREAR SUMMARY

    public function get_arrear_summary($params)
    {
        $apikey = $params['API_KEY'];

        if (!(isset($params['inst_id']) && !empty($params['inst_id']))) {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Inst code is required', 'data' => FALSE);
        } else {
            $inst_id = $params['inst_id'];
        }
        if (!(isset($params['acd_year_id']) && !empty($params['acd_year_id']))) {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Academic year data is required', 'data' => FALSE);
        } else {
            $acd_year_id = $params['acd_year_id'];
        }

        if (!(isset($params['startdate']) && !empty($params['startdate']))) {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'From date data is required', 'data' => FALSE);
        } else {
            $startdate = $params['startdate'];
        }
        $backdate = $params['backdate'];
        $report_data = $this->MReport->get_arrear_summary($apikey, $inst_id, $acd_year_id, $startdate, $backdate);
        if ($backdate == 0) {
            $arrear_array = array();
            if (isset($report_data) && !empty($report_data) && count($report_data) > 0) {
                foreach ($report_data as $stdata) {
                    $dem_month = date('m-Y', strtotime($stdata['demanded_month']));
                    if (isset($arrear_array[$dem_month][$stdata['feeCode']])) {
                        $arrear_array[$dem_month][$stdata['feeCode']] += $stdata['pending_payment'];
                    } else {
                        $arrear_array[$dem_month][$stdata['feeCode']] = $stdata['pending_payment'];
                    }
                }
            }
        }

        $summary_array = array();
        $nd_summary_array = array();
        $feecode_array = array();
        if (isset($report_data) && !empty($report_data) && count($report_data) > 0) {
            if ($backdate == 1) $arrear_details = json_decode($report_data[0]['arrear_details'], TRUE);
            else $arrear_details = $arrear_array;
            $feecodes_available = $this->MReport->get_all_feecodes_available($apikey, $inst_id);
            $feecodes_available[] = array(
                'feeCode' => 'OTH',
                'fee_shortcode' => 'OTH',
                'description' => 'OTHERS'
            );
            // foreach ($feecodes_available as $fca) {
            //     array_push($feecode_array, $fca['feeCode']);
            // }
            foreach ($arrear_details as $ddate => $ar_details) {
                foreach ($ar_details as $key => $ad) {
                    foreach ($feecodes_available as $fc) {
                        if ($fc['editable'] == 1) {
                            if ($key == $fc['feeCode']) {
                                if ($fc['demandType'] == 1) {
                                    $summary_array[$ddate][$fc['feeCode']] =  $ad;
                                } else {
                                    if ($fc['demandType'] == 2) {
                                        $nd_summary_array[$ddate][$fc['feeCode']] = $ad;
                                        if (!isset($summary_array[$ddate][$fc['feeCode']]))
                                            $summary_array[$ddate]['OTH'] +=  $ad;
                                        else
                                            $summary_array[$ddate]['OTH'] =  $ad;
                                    }
                                }
                            } else {
                                if ($fc['demandType'] == 1) {
                                    if (!isset($summary_array[$ddate][$fc['feeCode']]))
                                        $summary_array[$ddate][$fc['feeCode']] =  0;
                                } else {
                                    if ($fc['demandType'] == 2) {
                                        if (!isset($nd_summary_array[$ddate][$fc['feeCode']]))
                                            $nd_summary_array[$ddate][$fc['feeCode']] = 0;
                                        if (!isset($summary_array[$ddate]['OTH']))
                                            $summary_array[$ddate]['OTH'] = 0;
                                    }
                                }
                            }
                        }
                    }
                }
            }
            $primary_fee_code_data = $this->MReport->get_all_demandable_feecodes_available($apikey, $inst_id);
            $primary_fee_code_data[] = array(
                'feeCode' => 'OTH',
                'fee_shortcode' => 'OTH',
                'description' => 'OTHERS (NON DEMANDABLE FEES)',
                'editable'   => 1
            );
            $non_demandable_feecodes = $this->MReport->get_all_feecodes_non_demandable($apikey, $inst_id);
            // return $arrear_array;;
            return array('data_status' => 1, 'data' => array("report" => $summary_array, "nd_report" => $nd_summary_array, "feecode_data" => $primary_fee_code_data, "non_demandable_feecodes" => $non_demandable_feecodes));
        } else {
            return array('data_status' => 0, 'message' => 'No data is available');
        }
    }

    //HEADWISE ARREAR REPORT
    public function get_head_wise_arrear($params)
    {
        $apikey = $params['API_KEY'];

        if (!(isset($params['inst_id']) && !empty($params['inst_id']))) {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Inst code is required', 'data' => FALSE);
        } else {
            $inst_id = $params['inst_id'];
        }
        if (!(isset($params['acd_year_id']) && !empty($params['acd_year_id']))) {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Academic year data is required', 'data' => FALSE);
        } else {
            $acd_year_id = $params['acd_year_id'];
        }

        if (!(isset($params['from_date']) && !empty($params['from_date']))) {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'From date data is required', 'data' => FALSE);
        } else {
            $from_date = $params['from_date'];
        }

        if (!(isset($params['to_date']) && !empty($params['to_date']))) {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'To date data is required', 'data' => FALSE);
        } else {
            $to_date = $params['to_date'];
        }
        $feecode_id = $params['feecode_id'];
        $report_data = $this->MReport->get_head_wise_arrear($apikey, $inst_id, $acd_year_id, $from_date, $to_date, $feecode_id);
        // return $report_data;
        $head_array = array();
        $transfer_amount = 0;
        $w_wdrw_amount = 0;
        if (is_array($report_data)) {
            foreach ($report_data as $rd) {
                $head_array[$rd['feecode_desc']][$rd['class_name']][$rd['Batch_Name']][] = array(
                    'batch_name' => $rd['Batch_Name'],
                    'Admn_No' => $rd['Admn_No'],
                    'First_Name' => $rd['First_Name'],
                    'demand_date' => $rd['demanded_month'],
                    'feeCode' => $rd['feeCode'],
                    'fee_code_description' => $rd['feecode_desc'],
                    'amt_paid' => $rd['pending_payment']
                );
            }
        }
        // return $head_array;

        $primary_fee_code_data = $this->MReport->get_all_feecodes_available($apikey, $inst_id);
        //return $primary_fee_code_data;
        if (isset($report_data) && !empty($report_data)) {
            return array('data_status' => 1, 'message' => 'Data extracted', 'data' => $head_array, 'excel_data' => $report_data, 'feecodes' => $primary_fee_code_data);
        } else {
            return array('data_status' => 0, 'message' => 'No data available', 'data' => NULL, 'feecodes' => $primary_fee_code_data);
        }
    }
    //REGFEE COLLECTION REPORT
    public function get_regfee_collection_report($params)
    {
        $apikey = $params['API_KEY'];

        if (!(isset($params['inst_id']) && !empty($params['inst_id']))) {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Inst code is required', 'data' => FALSE);
        } else {
            $inst_id = $params['inst_id'];
        }
        if (!(isset($params['acd_year_id']) && !empty($params['acd_year_id']))) {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Academic year data is required', 'data' => FALSE);
        } else {
            $acd_year_id = $params['acd_year_id'];
        }

        if (!(isset($params['from_date']) && !empty($params['from_date']))) {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'From date data is required', 'data' => FALSE);
        } else {
            $from_date = $params['from_date'];
        }

        if (!(isset($params['to_date']) && !empty($params['to_date']))) {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'To date data is required', 'data' => FALSE);
        } else {
            $to_date = $params['to_date'];
        }
        $report_data = $this->MReport->get_regfee_collection_report($apikey, $inst_id, $acd_year_id, $from_date, $to_date);
        // return $report_data;
        if (isset($report_data) && !empty($report_data)) {
            return array('data_status' => 1, 'message' => 'Data extracted', 'data' => $report_data);
        } else {
            return array('data_status' => 0, 'message' => 'No data available', 'data' => NULL);
        }
    }
    //REGFEE COLLECTION REPORT
    public function get_base_fee_educore_report($params)
    {
        $apikey = $params['API_KEY'];

        if (!(isset($params['inst_id']) && !empty($params['inst_id']))) {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Inst code is required', 'data' => FALSE);
        } else {
            $inst_id = $params['inst_id'];
        }
        if (!(isset($params['acd_year_id']) && !empty($params['acd_year_id']))) {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Academic year data is required', 'data' => FALSE);
        } else {
            $acd_year_id = $params['acd_year_id'];
        }

        if (!(isset($params['from_date']) && !empty($params['from_date']))) {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'From date data is required', 'data' => FALSE);
        } else {
            $from_date = $params['from_date'];
        }

        if (!(isset($params['to_date']) && !empty($params['to_date']))) {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'To date data is required', 'data' => FALSE);
        } else {
            $to_date = $params['to_date'];
        }
        $report_data = $this->MReport->get_base_fee_educore_report($apikey, $inst_id, $acd_year_id, $from_date, $to_date);
        // return $report_data;
        if (isset($report_data) && !empty($report_data)) {
            return array('data_status' => 1, 'message' => 'Data extracted', 'data' => $report_data);
        } else {
            return array('data_status' => 0, 'message' => 'No data available', 'data' => NULL);
        }
    }



    //Online COLLECTION REPORT
    public function get_online_collection_report($params)
    {
        $apikey = $params['API_KEY'];

        if (!(isset($params['inst_id']) && !empty($params['inst_id']))) {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Inst code is required', 'data' => FALSE);
        } else {
            $inst_id = $params['inst_id'];
        }
        if (!(isset($params['acd_year_id']) && !empty($params['acd_year_id']))) {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Academic year data is required', 'data' => FALSE);
        } else {
            $acd_year_id = $params['acd_year_id'];
        }

        if (!(isset($params['from_date']) && !empty($params['from_date']))) {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'From date data is required', 'data' => FALSE);
        } else {
            $from_date = $params['from_date'];
        }

        if (!(isset($params['to_date']) && !empty($params['to_date']))) {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'To date data is required', 'data' => FALSE);
        } else {
            $to_date = $params['to_date'];
        }
        $report_data = $this->MReport->get_online_collection_report($apikey, $inst_id, $acd_year_id, $from_date, $to_date);
        // return $report_data;
        if (isset($report_data) && !empty($report_data)) {
            return array('data_status' => 1, 'message' => 'Data extracted', 'data' => $report_data);
        } else {
            return array('data_status' => 0, 'message' => 'No data available', 'data' => NULL);
        }
    }
    //Fee Deallocated REPORT
    public function get_fee_deallocated_list($params)
    {
        $apikey = $params['API_KEY'];

        if (!(isset($params['inst_id']) && !empty($params['inst_id']))) {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Inst code is required', 'data' => FALSE);
        } else {
            $inst_id = $params['inst_id'];
        }
        if (!(isset($params['acd_year_id']) && !empty($params['acd_year_id']))) {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Academic year data is required', 'data' => FALSE);
        } else {
            $acd_year_id = $params['acd_year_id'];
        }

        if (!(isset($params['from_date']) && !empty($params['from_date']))) {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'From date data is required', 'data' => FALSE);
        } else {
            $from_date = $params['from_date'];
        }

        if (!(isset($params['to_date']) && !empty($params['to_date']))) {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'To date data is required', 'data' => FALSE);
        } else {
            $to_date = $params['to_date'];
        }
        $report_data = $this->MReport->get_fee_deallocated_list($apikey, $inst_id, $acd_year_id, $from_date, $to_date);
        // return $report_data;
        if (isset($report_data) && !empty($report_data)) {
            $data_array = array();
            foreach($report_data as $rdata){
                $data_array[$rdata['student_id']]['student_details']['Student_Name'] = $rdata['Student_Name'];
                $data_array[$rdata['student_id']]['student_details']['Admn_No'] = $rdata['Admn_No'];
                $data_array[$rdata['student_id']]['student_details']['reason'] = $rdata['reason'];
                $data_array[$rdata['student_id']]['fee_details'][] = $rdata;
            }
            return array('data_status' => 1, 'message' => 'Data extracted', 'data' => $data_array);
        } else {
            return array('data_status' => 0, 'message' => 'No data available', 'data' => NULL);
        }
    }
    public function get_student_search_list_for_reports($params = NULL)
    {
        $dbparams = array();
        $dbparams[0] = $params['API_KEY'];

        if (isset($params['admn_no']) && !empty($params['admn_no'])) {
            $dbparams[1] = $params['admn_no'];
        } else {
            $dbparams[1] = NULL;
        }
        $dbparams[2] = $params['searchtype'];

        $student_data_list = $this->MReport->get_student_search_list_for_reports($dbparams);
        if (!empty($student_data_list) && is_array($student_data_list)) {
            return array('data_status' => 1, 'error_status' => 0, 'message' => 'Data Loaded', 'data' => $student_data_list);
        } else {
            return array('data_status' => 0, 'error_status' => 0, 'message' => 'No data available', 'data' => FALSE);
        }
    }
    public function get_advancestudent_search_list_for_reports($params = NULL)
    {
        // dev_export($data);die;
        $dbparams = array();
        $dbparams[0] = $params['API_KEY'];
        if (isset($params['batch_id']) && !empty($params['batch_id'])) {
            $dbparams[1] = $params['batch_id'];
        } else {
            $dbparams[1] = NULL;
        }
        if (isset($params['stream_id']) && !empty($params['stream_id'])) {
            $dbparams[2] = $params['stream_id'];
        } else {
            $dbparams[2] = NULL;
        }
        if (isset($params['class_id']) && !empty($params['class_id'])) {
            $dbparams[3] = $params['class_id'];
        } else {
            $dbparams[3] = NULL;
        }
        if (isset($params['curent_acdyr']) && !empty($params['curent_acdyr'])) {
            $dbparams[4] = $params['curent_acdyr'];
        } else {
            $dbparams[4] = NULL;
        }
        if (isset($params['inst_id']) && !empty($params['inst_id'])) {
            $dbparams[5] = $params['inst_id'];
        } else {
            $dbparams[5] = NULL;
        }
        if (isset($params['searchname']) && !empty($params['searchname'])) {
            $dbparams[6] = $params['searchname'];
        } else {
            $dbparams[6] = NULL;
        }

        $dbparams[7] = $params['searchtype'];
        //        dev_export($dbparams);die;
        $student_data_list = $this->MReport->get_advancestudent_search_list_for_reports($dbparams);


        if (!empty($student_data_list) && is_array($student_data_list)) {
            return array('data_status' => 1, 'error_status' => 0, 'message' => 'Data Loaded', 'data' => $student_data_list);
        } else {
            return array('data_status' => 0, 'error_status' => 0, 'message' => 'No data available', 'data' => FALSE);
        }
    }
}
