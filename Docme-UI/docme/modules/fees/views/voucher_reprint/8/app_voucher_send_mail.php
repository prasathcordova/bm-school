<?php
$inst_id = $this->session->userdata('inst_id');
$inst_name = $this->session->userdata('Institution_Name');
$inst_place = $this->session->userdata('Institution_Place');
$inst_email = $this->session->userdata('Institution_Email');
$inst_phone = $this->session->userdata('Institution_Phone');
$inst_url = $this->session->userdata('Institution_Url');
$vouchercode = $voucher_code;
?>
<div class="print_element">
    <div style="float:none; margin:0 auto; width: 597px; background: #fff; ">
        <div style="float:left; padding-top:8mm; width:100%; font-size: 10px;font-weight: normal;font-family: Arial;">
            <table width="100%">
                <tr>
                    <td align="center" style="vertical-align:middle;">
                        <img src="<?php echo base_url('assets/inst_logos/' . $inst_id . '_logo.png'); ?>" alt="<?php echo $inst_name; ?>" style="width:80px;float: left;" />
                        <h3 style="margin-bottom:0px;"><?php echo $inst_name ?></h3>
                        <h5 style="margin-top:0px; margin-bottom:0px;">SENIOR SECONDARY SCHOOL</h5>
                        <p style="margin-top:0px;"><?php echo $inst_place ?> Ph: <?php echo $inst_phone ?></p>
                        <p style="margin-top:0px;text-align: right;font-size: 12px;font-weight: 600;"><?php echo isset($title) ? $title : "NO TITLE PROVIDED" ?></p>
                    </td>
                </tr>
            </table>
        </div>
        <div style="float:left; margin-top:1mm; width:100%; background:white;">
            <table style="width:100%; border-spacing: 0;border-collapse: collapse;font-family: Roboto;font-size: 11px;border: 1px solid #fff;">
                <tbody>
                    <tr>
                        <td style="padding-bottom: 0px;width: 50%;border: 1px solid #e5e5e5; padding:5px 1px 5px 3px;"" colspan=" 2" width="75%">Name: <?php echo $student_account[0]['ApplicantName'] ?></td>
                        <td style="padding-bottom: 0px;text-align: left;border: 1px solid #e5e5e5; padding:5px 1px 5px 3px;"" width=" 25%">Date: <?php echo date('d-m-Y', strtotime($master_data[0]['created_on'])); ?></td>
                    </tr>
                    <tr>
                        <td style="padding-top: 0px;padding-bottom: 0px;border: 1px solid #e5e5e5; padding:5px 1px 5px 3px;"" colspan=" 3">Address: <?php echo $student_account[0]['Address'] ?></td>
                    </tr>
                    <tr>
                        <td style="width:50%;border: 1px solid #e5e5e5; padding:5px 1px 5px 3px;"">Parent: <?php echo $student_account[0]['ParentName'] ?></td>
                        <td style=" width:25%;border: 1px solid #e5e5e5; padding:5px 1px 5px 3px;"">Phone: <?php echo $student_account[0]['Phone_No'] ?></td>
                        <td style="width:25%;border: 1px solid #e5e5e5; padding:5px 1px 5px 3px;" text-align:left;">Voucher No.: <?php echo $vouchercode; ?></td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div style="float:left; margin-top:2mm; width: 597px; background:white;">
            <table style="width:100%; border-spacing: 0;border-collapse: collapse;font-family: Roboto;font-size: 11px;border: 1px solid #fff;">
                <tbody>
                    <tr>
                        <td style="width: 47px; text-align:center;padding-top: 5px;padding-bottom: 5px;border: 1px solid #e5e5e5;">SlNo</td>
                        <td style="width: 200px;padding-left: 5px;border: 1px solid #e5e5e5;">Particulars</td>
                        <td style="width: 75px;text-align:center;border: 1px solid #e5e5e5;">Month</td>
                        <td style="width: 75px;text-align:center;border: 1px solid #e5e5e5;">Amount</td>
                        <td style="width: 200px;padding-left: 5px;border: 1px solid #e5e5e5;">Remarks</td>
                    </tr>
                    <?php
                    $cc  = 0;
                    $rcount = 4;
                    $wallet_total = 0;
                    $transaction_total = 0;
                    $itr = 0;
                    //if($ptype == 'fee'){
                    if (isset($student_account) && !empty($student_account)) {
                        foreach ($student_account as $account) {
                    ?>
                            <tr>
                                <td style="width: 48px;text-align:center;border: 1px solid #e5e5e5 !important;padding-top: 5px;padding-bottom: 5px;"><?php echo ++$cc; ?></td>
                                <td style="width: 200px;border: 1px solid #e5e5e5 !important;padding-left: 6px;">
                                    <?php echo $account['transaction_desc']; ?>
                                    <?php if (isset($account['vatpercent'])) {
                                        if ($account['vatpercent'] > 0) {
                                    ?> (<?php echo print_tax_vat(); ?> <?php echo $account['vatpercent']; ?>% - <?php echo my_money_format((($account['transaction_amount'] * $account['vatpercent']) / 100)); ?>)
                                    <?php
                                        }
                                    } ?>
                                </td>
                                <td style="width: 75px;text-align:center;border: 1px solid #e5e5e5 !important;">
                                    <?php if (isset($account['demandmonth'])) {
                                        echo date('M Y', strtotime($account['demandmonth']));
                                    } else {
                                        echo ' ';
                                    } ?>
                                </td>
                                <td style="width: 75px;text-align:right;border: 1px solid #e5e5e5 !important;"><?php echo my_money_format($account['transaction_amount']); ?>&nbsp;</td>
                                <td style="width: 200px;border: 1px solid #e5e5e5 !important;padding-left: 7px;">&nbsp;</td>
                            </tr>
                            <?php
                            $transaction_total += $account['transaction_amount'];
                            if (isset($account['service_charge']) && $account['service_charge'] > 0) {
                            ?>
                                <tr>
                                    <td style="width: 48px;text-align:center;border: 1px solid #e5e5e5 !important;padding-top: 5px;padding-bottom: 5px;"><?php echo ++$cc; ?></td>
                                    <td style="width: 200px;border: 1px solid #e5e5e5 !important;padding-left: 6px;">
                                        Service Charge</td>
                                    <td style="width: 75px;text-align:center;border: 1px solid #e5e5e5 !important;">-</td>
                                    <td style="width: 100px;text-align:right;border: 1px solid #e5e5e5 !important;"><?php echo my_money_format($account['service_charge']); ?>&nbsp;</td>
                                    <td style="width: 175px;border: 1px solid #e5e5e5 !important;padding-left: 7px;">&nbsp;</td>
                                </tr>
                    <?php
                                $transaction_total += $account['service_charge'];
                            }
                        }
                    }
                    $grand_total = $transaction_total + $wallet_total;
                    ?>
                    <tr>
                        <td colspan="2" style="border: 1px solid #e5e5e5 !important;padding-top: 2px;padding-bottom: 3px;">&nbsp;</td>
                        <td style="text-align:center;border: 1px solid #e5e5e5 !important;">TOTAL</td>
                        <td id="" style="text-align:right;border: 1px solid #e5e5e5 !important;">
                            <?php echo my_money_format($grand_total); ?>&nbsp;
                        </td>
                        <td style="border: 1px solid #e5e5e5 !important;"></td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div style="float:left; width:597px; background:#fff;">
            <div style="float: left;width: 98%;padding: 1%;font-family: arial;font-size: 12px;">Received Rs.
                <span style="border-bottom:1px dotted #ccc;text-transform: Capitalize;float: right;width: 86%;"><b><?php echo convert_number_to_indian_words($grand_total); ?></b> Only
                    <span class="pull-right" style="float: right;">Amt / <b><?php echo my_money_format($grand_total); ?></b></span>
                </span>
            </div>
            <div style="float: left;width: 98%;padding: 1%;font-family: arial;font-size: 12px;">
                <span style="float:left; width:24%;"><?php echo $trantype ?></span>
                <span style="float:left; width:31%;border-bottom:1px dotted #ccc;text-align: left;font-weight: 600;"><?php echo (isset($pay_data[0]['payment_reference']) ? $pay_data[0]['payment_reference'] : ''); ?>&nbsp;</span>
                <span style="float: left;width: 5%;">&nbsp;Dt</span>
                <span style="float:left; width:28%;border-bottom:1px dotted #ccc;text-align: center;font-weight: 600;"><?php echo (isset($pay_data[0]['payment_datetime']) ? date('d-m-Y',strtotime($pay_data[0]['payment_datetime'])) : ''); ?>&nbsp;</span>
                <span style="float: right;width: 12%;text-align: right;">Drawn on</span>
            </div>
            <div style="float: left;width: 98%;padding: 1%;font-family: arial;font-size: 12px;">
                <span style="float:left; width:70%;border-bottom:1px dotted #ccc;text-align: center;font-weight: 600;"><?php echo (isset($pay_data[0]['ch_bankname']) ? $pay_data[0]['ch_bankname'] : '&nbsp;'); ?> - <?php echo (isset($pay_data[0]['ch_bank_branch']) ? $pay_data[0]['ch_bank_branch'] : ''); ?></span>
                <span style="float: right;width: 30%;text-align: right;">Bank Subjected to realisation</span>
            </div>
            <div style="float: left;width: 98%;padding: 1%;font-family: arial;font-size: 12px;">Mailed By:
                <span style="float: right;width: 87%;">&nbsp; <b><?php echo $user_name; ?></b>
                    <span style="float:right;">
                        <small> <b>* All amounts are in INR</b></small>
                    </span>
                </span>
            </div>
        </div>
    </div>
</div>