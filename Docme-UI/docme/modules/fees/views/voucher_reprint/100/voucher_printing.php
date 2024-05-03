<?php
$divname = explode('/', $student_details['Batch_Name']);
if (is_array($divname) and !empty($divname)) {
    $division = $divname[1];
} else {
    $division = '-';
}
$inst_id = $this->session->userdata('inst_id');
$inst_name = $this->session->userdata('Institution_Name');
?>
<div class="print_element">
    <table class="table" border="0" style=" width: 195mm; font-size: 11px;font-weight: normal;font-family: Arial;border-spacing: 0;border-collapse: collapse;border: 1px solid #333;">
        <thead>
            <tr>
                <td colspan="4">
                    <div style="text-align:left;font-family:Arial;padding-bottom: 25px;width: 100%;">
                        <div style="margin:0px;width: 100%;">
                            <img src="<?php echo base_url('assets/dashboard_logos/' . $inst_id . '_dashboard.png'); ?>" alt="<?php echo $inst_name; ?>" style="width:125px;padding-top: 0px;margin-top: 0px;" />
                            <p style="text-align:center;margin-top:-40px;margin-left:10px;font-size: 12px;line-height: 18px;"><?php echo $inst_name; ?> <br />
                                <span style="font-size:12px; font-style: italic;">Karunagappally, Kollam, Ph: 7356971881 </span><br>
                                <span style="font-size:12px; font-style: italic;line-height: 25px;">Email: oxfordkids4@mhtrust.com, Website: www.oxfordkids.net </span>
                            </p>
                        </div>
                        <h5 style="text-align: center;margin:0px; text-decoration: underline;font-size: 15px;margin-top: -8px;"><?php echo isset($title) & !empty($title) ? $title : 'RECEIPT'; ?> </h5>
                    </div>
                </td>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td colspan="4">
                    <table style="font-size: 11px; width: 100%; ">
                        <tr>
                            <td width="15%">Admission No.</td>
                            <td width="20%">: <?php echo $student_details['Admn_No'] ?></td>
                            <td width="15%">Academic Year</td>
                            <td width="20%">: <?php echo $student_details['acdyr'] ?></td>
                            <td width="10%">Date</td>
                            <td width="20%">: <?php echo date('d-m-Y', strtotime($master_data[0]['created_on'])); ?></td>
                        </tr>
                        <tr>
                            <td width="10%">Name </td>
                            <td>: <?php echo $student_details['student_name'] ?></td>
                            <td width="10%">Class</td>
                            <td width="10%">: <?php echo $student_details['Description'] ?></td>
                            <td>Voucher No.</td>
                            <td>: <?php echo $master_data[0]['voucher_code']; ?></td>
                        </tr>
                    </table>
                </td>
            </tr>
            <tr>
                <th style="border: 1px solid #333;padding: 5px; width: 40%;">Description</th>
                <th style="text-align: right;border: 1px solid #333; width: 15%; padding-right: 5px;">Month</th>
                <th style="text-align: right;border: 1px solid #333; width: 15%; padding-right: 5px;">Amount</th>
                <th style="border: 1px solid #333; width: 30%;">Remarks</th>
            </tr>
            <?php
            $rcount = 6;
            $wallet_total = 0;
            $transaction_total = 0;
            $itr = 1;
            //if($ptype == 'fee'){
            if (isset($student_account) && !empty($student_account)) {
                foreach ($student_account as $account) {
                    ?>
                    <tr>
                        <td style="border-right: 1px solid #333;padding-top: 10px;">
                            <?php $arr = explode('paid', $account['transaction_desc'], 2);
                                    echo $first = $arr[0]; ?>
                        </td>
                        <td style="text-align:right;border-right: 1px solid #333;"><?php echo date('M Y', strtotime($account['demandmonth'])); ?></td>
                        <td style="text-align:right;border-right: 1px solid #333;"><?php echo my_money_format(round($account['transaction_amount'], 2, PHP_ROUND_HALF_UP)); ?></td>
                        <td style="border-right: 1px solid #333;">&nbsp;</td>
                    </tr>
                    <?php
                            $transaction_total += $account['transaction_amount'];
                            if ($itr >= 6) {
                                break;
                            } else {
                                $itr = $itr + 1;
                            }
                            $rcount--;
                        }

                        if ($rcount != 0) {
                            for ($i = 1; $i < $rcount; $i++) {
                                ?>
                        <tr style="vertical-align: initial;">
                            <td style="border-right: 1px solid #333;padding-top: 10px;">&nbsp;</td>
                            <td style="text-align:center;border-right: 1px solid #333;">&nbsp;</td>
                            <td style="text-align:center;border-right: 1px solid #333;">&nbsp;</td>
                            <td style="border-right: 1px solid #333;">&nbsp;</td>
                        </tr>
            <?php
                    }
                }
            }
            //}
            $grand_total = $transaction_total + $wallet_total;
            ?>
            <tr>
                <td style="text-align:right;border: 1px solid #333;padding: 5px;"><strong>Total Fees:</strong></td>
                <td style="border: 1px solid #333;">&nbsp;</td>
                <td style="text-align:right;border: 1px solid #333;">
                    <p id="tbl_total" style="font-weight: bold; margin-bottom: 0;"> <i class="fa fa-inr" aria-hidden="true" style="color:#676a6c; font-weight:bold; font-size:12px; "></i> <?php echo print_currency('#676a6c', '12'); ?> <?php echo my_money_format($grand_total); ?></p>
                </td>
                <td style="border: 1px solid #333;"></td>
            </tr>
            <tr>
                <td style="text-align:left;padding-bottom: 15px;"><strong>Collected By: <?php echo $user_name; ?></strong></td>
                <td colspan="3" style="text-align:left;font-size: 10px;">
                    <div style=""><i>*Note: 1. The fees once remitted will not be refunded on any circumstances.</i></div>
                    <div style="padding-left: 30px;"><i>2. Please keep the receipt for further cross checking.</i></div>
                </td>
            </tr>
        </tbody>
    </table>

    <?php
    if ($itr == 6) {
        //echo $this->load->view('voucher_printing_nxt_page', array('student_details' => $student_details, 'student_account' => $student_account, 'wallet_account' => $wallet_account, 'start_counter' => $itr, 'ptype' => $ptype, 'division' => $division, 'grand_total' => $grand_total), TRUE);
    }
    //        if (count($student_account) % 6 < 3) {
    //            echo $this->load->view('bill_summary_print', array('details_data' => $details_data, 'padding' => 2), TRUE);
    //        } else {
    //            echo $this->load->view('bill_summary_print', array('details_data' => $details_data, 'padding' => 75), TRUE);
    //        }
    ?>
</div>

<script type="text/javascript">
    //window.print();
    w = window.open();
    w.document.write($('.print_element').html());
    //w.print();
    //w.close();
</script>