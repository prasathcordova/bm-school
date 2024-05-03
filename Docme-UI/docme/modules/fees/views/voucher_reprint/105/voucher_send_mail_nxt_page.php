<?php
$student_details = $student_details;
$student_account = $student_account;
$wallet_account  = $wallet_account;
$paydata         = $paydata;
$ptype           = $ptype;
$trantype        = $trantype;

$inst_id = $this->session->userdata('inst_id');
$inst_name = $this->session->userdata('Institution_Name');
$inst_place = $this->session->userdata('Institution_Place');
$inst_email = $this->session->userdata('Institution_Email');
$inst_phone = $this->session->userdata('Institution_Phone');
$inst_url = $this->session->userdata('Institution_Url');
//print_r($student_account);
//print_r($wallet_account);
?>
<div style="float:none; margin:0 auto; width: 597px;background: #ccc; ">
    <div style="float:left; padding-top:20mm; width:100%; font-size: 10px;font-weight: normal;font-family: Arial;">
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
        <table style="width:100%; border-spacing: 0;border-collapse: collapse;font-family: Roboto;font-size: 11px;border: 1px solid #333;">
            <tr>
                <td style="border: 1px solid #333; padding:5px 1px 5px 3px;">Admission No.: <?php echo $student_details['Admn_No'] ?></td>
                <td style="border: 1px solid #333; padding:5px 1px 5px 3px;">Academic Year: <?php echo $student_details['acdyr'] ?></td>
                <td style="border: 1px solid #333; padding:5px 1px 5px 3px;">Date: <?php echo date('d-m-Y', strtotime($master_data[0]['created_on'])); ?></td>
            </tr>
            <tr>
                <td style="border: 1px solid #333; padding:5px 1px 5px 3px;" colspan="3">Name: <?php echo $student_details['student_name'] ?></td>
            </tr>
            <tr>
                <td style="border: 1px solid #333; padding:5px 1px 5px 3px;">Class: <?php echo $student_details['Description'] ?></td>
                <td style="border: 1px solid #333; padding:5px 1px 5px 3px;">Batch: <?php echo $division ?></td>
                <td style="border: 1px solid #333; padding:5px 1px 5px 3px;">Voucher No.: <?php echo $vouchercode; ?></td>
            </tr>
        </table>
    </div>
    <div style="float:left; margin-top:2mm; width: 100%; background:white;">
        <table style="width:100%; border-spacing: 0;border-collapse: collapse;font-family: Roboto;font-size: 11px;border: 1px solid #333; margin-bottom:0px !Important; border-bottom:none !important;">
            <tbody>
                <tr>
                    <td style="width: 47px; text-align:center;padding-top: 5px;padding-bottom: 5px;;border: 1px solid #333;">SlNo</td>
                    <td style="width: 200px;;border: 1px solid #333;padding-left: 5px;">Particulars</td>
                    <td style="width: 75px;text-align:center;;border: 1px solid #333;">Month</td>
                    <td style="width: 75px;text-align:center;;border: 1px solid #333;">Amount</td>
                    <td style="width: 200px;;border: 1px solid #333;padding-left: 5px;">Remarks</td>
                </tr>
                <?php
                $itr = 0;
                ?> <?php
                    $dd  = 0;
                    $rcount = 4;
                    $wallet_total = 0;
                    $transaction_total = 0;
                    $counter = 1;
                    $end_counter = $start_counter + 4;
                    if (isset($wallet_account) && !empty($wallet_account)) {
                        $rcount = 4;
                        foreach ($wallet_account as $wallet) {
                            if ($counter > $start_counter && $counter <= $end_counter) {
                    ?>
                            <tr>
                                <td style="width: 48px; text-align:center;border: 1px solid #333 !important; border-bottom:0 !important;padding-top: 5px;padding-bottom: 5px;"><?php echo ++$dd; ?></td>
                                <td style="width: 200px;border: 1px solid #333 !important;padding-left: 6px; border-bottom:0 !important;">
                                    <?php echo $wallet['transaction_desc']; ?>
                                </td>
                                <td style="width: 75px; text-align:center;border: 1px solid #333 !important; border-bottom:0 !important;">&nbsp;</td>
                                <td style="width: 75px; text-align:right;border: 1px solid #333 !important; border-bottom:0 !important;"><?php echo my_money_format($wallet['transaction_amount']); ?>&nbsp;</td>
                                <td style="width: 200px;border: 1px solid #333 !important;padding-left: 7px; border-bottom:0 !important;">&nbsp;</td>
                            </tr>

                <?php
                                $wallet_total += $wallet['transaction_amount'];
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

    <div style="float:left; width:100%; background:#fff;">
        <div style="float: left;width: 98%;padding: 1%;font-family: arial;font-size: 12px;">Received Rs.
            <span style="border-bottom:1px dotted #ccc;text-transform: Capitalize;float: right;width: 86%;"><b><?php echo convert_number_to_indian_words($grand_total); ?></b> Only
                <span class="pull-right" style="float: right;">Amt / <b><?php echo my_money_format($grand_total); ?></b></span>
            </span>
        </div>
        <div style="float: left;width: 98%;padding: 1%;font-family: arial;font-size: 12px;">
            <span style="float:left; width:24%;"><?php echo $trantype ?></span>
            <span style="float:left; width:31%;border-bottom:1px dotted #ccc;text-align: center;font-weight: 600;"><?php echo (isset($pay_data['ch_number']) ? $pay_data['ch_number'] : '&nbsp;'); ?></span>
            <span style="float: left;width: 5%;">&nbsp;Dt</span>
            <span style="float:left; width:28%;border-bottom:1px dotted #ccc;text-align: center;font-weight: 600;"><?php echo (isset($pay_data['ch_date']) ? date('d-m-Y', strtotime($pay_data['ch_date'])) : '&nbsp;'); ?></span>
            <span style="float: right;width: 12%;text-align: right;">Drawn on</span>
        </div>
        <div style="float: left;width: 98%;padding: 1%;font-family: arial;font-size: 12px;">
            <span style="float:left; width:70%;border-bottom:1px dotted #ccc;text-align: center;font-weight: 600;"><?php echo (isset($pay_data['ch_bankname']) ? $pay_data['ch_bankname'] : '&nbsp;'); ?> - <?php echo (isset($pay_data['ch_bank_branch']) ? $pay_data['ch_bank_branch'] : ''); ?></span>
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