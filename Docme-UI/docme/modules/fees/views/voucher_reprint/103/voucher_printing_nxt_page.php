<?php
$student_details = $student_details;
$student_account = $student_account;
$wallet_account  = $wallet_account;
$paydata         = $paydata;
$ptype           = $ptype;
$pagecount       = $pagecount;
$totpage         = $totpage;
$instcode        = $instcode;
$trantype        = $trantype;

$inst_id = $this->session->userdata('inst_id');
$inst_name = $this->session->userdata('Institution_Name');
$inst_place = $this->session->userdata('Institution_Place');
$inst_email = $this->session->userdata('Institution_Email');
$inst_phone = $this->session->userdata('Institution_Phone');
$inst_url = $this->session->userdata('Institution_Url');
//print_r($student_account);
//print_r($wallet_account); style="page-break-before: always;"
?>
<p class="pagebreak" style="float:left;page-break-before: always !important;background: #d22f2f;width: 100%;"></p>
<div class="break_page" style="float:left;width: 158mm; height:119mm !important; padding-left:11mm; padding-right:11mm;background: #fff;  ">
    <div style="float:left; height:25mm; margin-top:6mm; width:100%; font-size: 10px;font-weight: normal;font-family: Arial;">
        <table width="100%">
            <tr>
                <td align="center" style="vertical-align:middle;">
                    <img src="<?php echo base_url('assets/inst_logos/' . $inst_id . '_logo.png'); ?>" alt="<?php echo $inst_name; ?>" style="width:80px;float: left;" />
                    <h3 style="margin-bottom:0px;"><?php echo $inst_name ?></h3>
                    <h5 style="margin-top:0px; margin-bottom:0px;">SENIOR SECONDARY SCHOOL</h5>
                    <p style="margin-top:0px;"><?php echo $inst_place ?> Ph: <?php echo $inst_phone ?></p>
                    <p style="margin-top:0px;text-align: right;font-size: 12px;font-weight: 600;"> <?php echo isset($title) ? $title : "NO TITLE PROVIDED" ?></p>
                </td>
            </tr>
        </table>
    </div>
    <div style="float:left; height:15mm; margin-top:1mm; width:100%; background:white;">
        <table class="table" border="0" style="border: 1px solid #333; width:100%; font-size: 12px;font-weight: normal;font-family: Arial;">
            <tr>
                <td style="padding-bottom: 0px;">Admission No.: <?php echo $student_details['Admn_No'] ?></td>
                <td style="padding-bottom: 0px;">Academic Year: <?php echo $student_details['acdyr'] ?></td>
                <td style="padding-bottom: 0px;">Date: <?php echo date('d-m-Y', strtotime($master_data[0]['created_on'])); ?></td>
            </tr>
            <tr>
                <td style="padding-top: 0px;padding-bottom: 0px;" colspan="3">Name: <?php echo $student_details['student_name'] ?></td>
            </tr>
            <tr>
                <td>Class: <?php echo $student_details['Description'] ?></td>
                <td>Batch: <?php echo $division ?></td>
                <td>Voucher No.: <?php echo $vouchercode; ?></td>
            </tr>
        </table>
    </div>
    <div style="float:left; height:38mm; margin-top:1mm; width: 597px; background:white;">
        <table width="100%" style="border-spacing: 0; border-collapse: collapse; font-family: arial;font-size: 11px;width: 100%; border: 1px solid #333; border-bottom: none;">
            <tr>
                <td style="width: 47px; text-align:center;padding-top: 5px;padding-bottom: 5px;border-bottom: 1px solid #333;">SlNo</td>
                <td style="width: 200px;border-left: 1px solid #333 !important;padding-left: 5px;border-bottom: 1px solid #333;">Particulars</td>
                <td style="width: 75px;text-align:center;border-left: 1px solid #333 !important;border-bottom: 1px solid #333;">Month</td>
                <td style="width: 75px;text-align:center;border-left: 1px solid #333 !important;border-bottom: 1px solid #333;">Amount</td>
                <td style="width: 200px;border-left: 1px solid #333 !important;padding-left: 5px;border-bottom: 1px solid #333;">Remarks</td>
            </tr>
            <tbody>
                <?php
                $itr = 0;
                ?> <?php
                    $dd  = 0;
                    $rcount = 4;
                    $wallet_total = 0;
                    $transaction_total = 0;
                    $counter = 1;
                    $end_counter = $start_counter + 4;
                    if ($wallet_account == 0) {
                        if (isset($student_account) && !empty($student_account)) {
                            foreach ($student_account as $account) {
                                if ($counter > $start_counter && $counter <= $end_counter) {
                    ?>
                                <tr style="font-size: 10px;">
                                    <td style="width: 48px; text-align:center;border-right: 1px solid #333 !important; border-bottom:0 !important;padding-top: 5px;padding-bottom: 5px;"><?php echo ++$dd; ?></td>
                                    <td style="width: 200px;border-right: 1px solid #333 !important;padding-left: 6px; border-bottom:0 !important;">
                                        <?php echo $account['transaction_desc']; ?>
                                        <?php if (isset($account['vat_percent']) && $account['is_service_charge'] == 0) {
                                            if ($account['vat_percent'] > 0) {
                                        ?> (<?php echo print_tax_vat(); ?> - <?php echo $account['vat_percent']; ?>% - <?php echo $account['vat_amount']; ?>)
                                        <?php
                                            }
                                        } ?>
                                    </td>
                                    <td style="width: 75px; text-align:center;border-right: 1px solid #333 !important; border-bottom:0 !important;">
                                        <?php if (isset($account['demandmonth'])) {
                                            echo date('M Y', strtotime($account['demandmonth']));
                                        } else {
                                            echo ' ';
                                        } ?>
                                    </td>
                                    <td style="width: 75px; text-align:right;border-right: 1px solid #333 !important; border-bottom:0 !important;"><?php echo my_money_format($account['transaction_amount']); ?>&nbsp;</td>
                                    <td style="width: 200px;border-right: 1px solid #333 !important;padding-left: 7px;border-bottom:0 !important;">&nbsp;</td>
                                </tr>
                            <?php
                                    $transaction_total += $account['transaction_amount'];
                                    $counter = $counter + 1;
                                    $rcount--;
                                } else if ($counter > $end_counter) {
                                    break;
                                } else {
                                    $counter = $counter + 1;
                                }
                            }

                            if ($rcount != 0) {
                                for ($i = 1; $i <= $rcount; $i++) {
                            ?>
                                <tr>
                                    <td style="border-right: 1px solid #333 !important;padding-top: 5px;padding-bottom: 5px;">&nbsp;</td>
                                    <td style="border-right: 1px solid #333 !important;">&nbsp;</td>
                                    <td style="border-right: 1px solid #333 !important;">&nbsp;</td>
                                    <td style="border-right: 1px solid #333 !important;">&nbsp;</td>
                                    <td style="border-right: 1px solid #333 !important;">&nbsp;</td>
                                </tr>
                            <?php
                                }
                            }
                        }
                    }
                    if ($student_account == 0) {
                        if (isset($wallet_account) && !empty($wallet_account)) {
                            $rcount = 4;
                            foreach ($wallet_account as $wallet) {
                                if ($counter > $start_counter && $counter <= $end_counter) {
                            ?>
                                <tr style="font-size: 10px;">
                                    <td style="width: 48px; text-align:center;border-right: 1px solid #333 !important; border-bottom:0 !important;padding-top: 5px;padding-bottom: 5px;"><?php echo ++$dd; ?></td>
                                    <td style="width: 200px;border-right: 1px solid #333 !important;padding-left: 6px; border-bottom:0 !important;">
                                        <?php echo $wallet['transaction_desc']; ?>
                                    </td>
                                    <td style="width: 75px; text-align:center;border-right: 1px solid #333 !important; border-bottom:0 !important;">
                                        <?php if (isset($account['demandmonth'])) {
                                            echo date('M Y', strtotime($account['demandmonth']));
                                        } else {
                                            echo ' ';
                                        } ?>
                                    </td>
                                    <td style="width: 75px; text-align:right;border-right: 1px solid #333 !important; border-bottom:0 !important;"><?php echo my_money_format($wallet['transaction_amount']); ?>&nbsp;</td>
                                    <td style="width: 200px;border-right: 1px solid #333 !important;padding-left: 7px;border-bottom:0 !important;">&nbsp;</td>
                                </tr>

                            <?php
                                    $wallet_total += $wallet['transaction_amount'];
                                    $counter = $counter + 1;
                                    $rcount--;
                                } else if ($counter > $end_counter) {
                                    break;
                                } else {
                                    $counter = $counter + 1;
                                }
                            }
                            if ($rcount != 0) {
                                for ($i = 1; $i <= $rcount; $i++) {
                            ?>
                                <tr>
                                    <td style="border-right: 1px solid #333 !important;padding-top: 5px;padding-bottom: 5px;">&nbsp;</td>
                                    <td style="border-right: 1px solid #333 !important;">&nbsp;</td>
                                    <td style="border-right: 1px solid #333 !important;">&nbsp;</td>
                                    <td style="border-right: 1px solid #333 !important;">&nbsp;</td>
                                    <td style="border-right: 1px solid #333 !important;">&nbsp;</td>
                                </tr>
                <?php
                                }
                            }
                        }
                    }
                    $grand_total = $transaction_total + $wallet_total; //$grand_total + 
                ?>
                <tr>
                    <td colspan="2" style="border: 1px solid #333 !important;padding-top: 2px;padding-bottom: 3px;">&nbsp;</td>
                    <td style="text-align:center;border: 1px solid #333 !important;">TOTAL</td>
                    <td id="" style="text-align:right;border: 1px solid #333 !important;">
                        <?php echo print_currency('#676a6c', '12'); ?> <?php echo my_money_format($grand_total); ?>&nbsp;
                    </td>
                    <td style="border: 1px solid #333 !important;"></td>
                </tr>
            </tbody>
        </table>
    </div>

    <div style="float:left; height:30mm; width:100%; background:#fff;">
        <div style="float: left;width: 98%;padding: 1%;font-family: arial;font-size: 12px;">Received Rs.
            <span style="border-bottom:1px dotted #ccc;text-transform: Capitalize;float: right;width: 86%;"><b><?php echo convert_number_to_indian_words($grand_total); ?></b> Only
                <span class="pull-right" style="float: right;">Amt / <b><?php echo my_money_format($grand_total); ?></b></span>
            </span>
        </div>
        <div style="float: left;width: 98%;padding: 1%;font-family: arial;font-size: 12px;">
            <span style="float:left; width:24%;"><?php echo $trantype ?></span>
            <span style="float:left; width:31%;border-bottom:1px dotted #ccc;text-align: center;font-weight: 600;"><?php echo (isset($pay_data[0]['ch_number']) ? $pay_data[0]['ch_number'] : '&nbsp;'); ?></span>
            <span style="float: left;width: 5%;">&nbsp;Dt</span>
            <span style="float:left; width:28%;border-bottom:1px dotted #ccc;text-align: center;font-weight: 600;"><?php echo (isset($pay_data[0]['ch_date']) ? date('d-m-Y', strtotime($pay_data[0]['ch_date'])) : '&nbsp;'); ?></span>
            <span style="float: right;width: 12%;text-align: right;">Drawn on</span>
        </div>
        <div style="float: left;width: 98%;padding: 1%;font-family: arial;font-size: 12px;">
            <span style="float:left; width:70%;border-bottom:1px dotted #ccc;text-align: center;font-weight: 600;"><?php echo (isset($pay_data[0]['ch_bankname']) ? $pay_data[0]['ch_bankname'] : '&nbsp;'); ?> - <?php echo (isset($pay_data[0]['ch_bank_branch']) ? $pay_data[0]['ch_bank_branch'] : ''); ?></span>
            <span style="float: right;width: 30%;text-align: right;">Bank Subjected to realisation</span>
        </div>
        <div style="float: left;width: 98%;padding: 1%;font-family: arial;font-size: 12px;">Printed By:
            <span style="float: right;width: 87%;">&nbsp; <b><?php echo $user_name; ?></b>
                <span style="float:right;">
                    <small style="color: #f8f8f8"><?php echo $instcode . $pagecount . '/' . $totpage . ')'; ?></small>
                    <small> <b>* All amounts are in INR</b></small>
                </span>
            </span>
        </div>
    </div>
</div>


<!--</div>-->

<?php

//if ($counter >= ($start_counter + 5)) {
if ($counter > ($end_counter) && sizeof($student_account) > ($end_counter)) {
    echo $this->load->view('voucher_printing_nxt_page', array('student_details' => $student_details, 'student_account' => $student_account, 'wallet_account' => $wallet_account, 'start_counter' => $end_counter, 'ptype' => $ptype, 'division' => $division, 'grand_total' => $grand_total, 'vouchercode' => $vouchercode, 'paydata' => $pay_data, 'pagecount' => $pagecount + 1, 'totpage' => $totpage, 'instcode' => $instcode, 'trantype' => $trantype), TRUE);
}
?>