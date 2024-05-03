<html>

<head></head>

<body style="background: #fff !important;">
    <?php echo $this->load->view('report/pdf/header') ?>
    <!-- <br>
    <h5 style="margin-top:0px;"><?php echo $collection_date; ?></h5> -->
    <?php $date = date("d-m-Y"); ?>
    <?php
    if (isset($details_data) && !empty($details_data)) {
        foreach ($details_data as $vdate => $rptdata_a) {
            $admission_number = $rptdata_a[0]['Admn_No'];
            $student_name = $rptdata_a[0]['First_Name'];
            $batch_name = $rptdata_a[0]['Batch_Name'];
            $statusflag = $rptdata_a[0]['StatusFlag'];
            if (trim($statusflag) == 'L') $stud_status = '<span style="color:red"> - Long Absentee</span>';
            elseif (trim($statusflag) == 'T' || trim($statusflag) == 'TP') $stud_status = '<span style="color:blue"> - TC Issued</span>';
            else $stud_status = '<span style="color:green"> - Official</span>';
        }
    }
    else if (isset($details_ncr_data) && !empty($details_ncr_data)) {
        foreach ($details_ncr_data as $vdate => $rptdata_a) {
            $admission_number = $rptdata_a[0]['Admn_No'];
            $student_name = $rptdata_a[0]['First_Name'];
            $batch_name = $rptdata_a[0]['Batch_Name'];
            $statusflag = $rptdata_a[0]['StatusFlag'];
            if (trim($statusflag) == 'L') $stud_status = '<span style="color:red"> - Long Absentee</span>';
            elseif (trim($statusflag) == 'T' || trim($statusflag) == 'TP') $stud_status = '<span style="color:blue"> - TC Issued</span>';
            else $stud_status = '<span style="color:green"> - Official</span>';
        }
    }
    ?>

    <table class="table table-bordered" width="100%">
        <thead>
            <tr class="header">
                <td style="text-align:left;" colspan="2">&nbsp;<?php echo $admission_number; ?></td>
                <td style="text-align:left;" colspan="3">&nbsp;<?php echo $student_name; ?>
                    <?php echo $stud_status; ?></td>
                <td style="text-align:left;" colspan="2">&nbsp;<?php echo $batch_name; ?></td>
            </tr>
            
            <tr class="linetr">
                <td colspan="8"></td>
            </tr>
        </thead>
        <tbody>
            <?php
            $i = 1;
            $totcolamt = 0;
            $paidback_amt = 0;
            $sconcession_amt = 0;
            $fconcession_amt = 0;
            $exemption_amt = 0;
            if (isset($details_data) && !empty($details_data)) {
                foreach ($details_data as $vdate => $rptdata_a) {
            ?>
                    <tr class="header">
                        <td colspan="7" style="text-align: left;">&nbsp;Voucher Date : <?php echo date('d-m-Y', strtotime($vdate)); ?></td>
                    </tr>
                    <tr class="header">
                        <td width="5%">Sl.No</td>
                        <!-- <td>Voucher Date</td> -->
                        <td width="15%">Voucher Code</td>
                        <td width="15%">Demand Date</td>
                        <td width="36%">Description</td>
                        <td width="5%">Type</td>
                        <td width="12%">Collection</td>
                        <td width="12%">Payback</td>
                    </tr>
                    <?php
                    foreach ($rptdata_a as $rptdata) {
                        if (($rptdata['display'] == 1)) {
                            if ($rptdata['payment_mode_id'] == 5 && $rptdata['is_others'] == 1 && $rptdata['specify_others'] == 'FC') {
                                $conc_str = 'Family Concession - ';
                                $fconcession_amt += $rptdata['voucher_amount'];
                            } else if ($rptdata['payment_mode_id'] == 5 && $rptdata['is_others'] == 1 && $rptdata['specify_others'] == 'SC') {
                                $conc_str = 'Staff Concession - ';
                                $sconcession_amt += $rptdata['voucher_amount'];
                            } else if ($rptdata['payment_mode_id'] == 5 && $rptdata['is_others'] == 1 && $rptdata['specify_others'] == '') {
                                $conc_str = 'Exemption - ';
                                $exemption_amt += $rptdata['voucher_amount'];
                            } else $conc_str = '';
                    ?>
                            <tr class="bodyarea">
                                <td><?php echo $i; ?></td>
                                <!-- <td><?php echo date('d-m-Y', strtotime($rptdata['voucher_date'])) ?></td> -->
                                <td><?php echo $rptdata['voucher_code'] ?></td>
                                <td><?php echo date('M/Y', strtotime($rptdata['demand_date'])) ?></td>
                                <td class="t-left">&nbsp;<?php echo $conc_str . $rptdata['description'] ?></td>
                                <td><?php echo $rptdata['tran_type'] ?></td>
                                <td class="t-right"><?php if ($rptdata['is_wallet_withdrawal'] != 1) echo my_money_format($rptdata['voucher_amount']);
                                                    else echo my_money_format(0); ?>&nbsp;</td>
                                <td class="t-right"><?php if ($rptdata['is_wallet_withdrawal'] == 1) echo my_money_format($rptdata['voucher_amount']);
                                                    else echo my_money_format(0); ?>&nbsp;</td>
                            </tr>
            <?php
                            $i++;
                            if ($rptdata['is_wallet_withdrawal'] != 1)
                                $totcolamt = $totcolamt + $rptdata['voucher_amount'];
                        } //else {
                        //     $paidback_amt += $rptdata['voucher_amount'];
                        // }
                        if ($rptdata['is_wallet_withdrawal'] == 1 && $rptdata['is_payback_credit'] == 1) { // pay back
                            $paidback_amt += $rptdata['voucher_amount'];
                        }
                        if ($rptdata['is_wallet_withdrawal'] == 1 && $rptdata['is_payback_credit'] == 0) { // Wallet withdrawal
                            $paidback_amt += $rptdata['voucher_amount'];
                        }
                    }
                }
            }
            $gross_amount = $totcolamt;
            $less_transfer = $transfer_amount;
            //$net_amount = $totcolamt - $less_transfer;
            ?>
            <tr class="linetr">
                <td colspan="7"></td>
            </tr>
            <tr class="footer">
                <td class="t-right" colspan="5">Gross Collection Amount &nbsp;&nbsp;</td>
                <td class="t-right"><?php echo my_money_format($gross_amount); ?>&nbsp;</td>
                <td class="t-right"><?php echo my_money_format(0); ?>&nbsp;</td>
            </tr>
            <tr class="footer">
                <td class="t-right" colspan="5">Service Charge&nbsp;&nbsp;</td>
                <td class="t-right"><?php echo my_money_format($servicecharge); ?>&nbsp;</td>
                <td class="t-right"><?php echo my_money_format(0); ?>&nbsp;</td>
            </tr>
            <tr class="footer">
                <td class="t-right" colspan="5">Round Off&nbsp;&nbsp;</td>
                <td class="t-right"><?php echo my_money_format($roundoff); ?>&nbsp;</td>
                <td class="t-right"><?php echo my_money_format(0); ?>&nbsp;</td>
            </tr>
            <!-- <tr class="footer">
                <td class="t-right" colspan="5">Wallet Deposit (T) (-)&nbsp;&nbsp;</td>
                <td class="t-right"><?php echo my_money_format($wallet_deposit_tr); ?>&nbsp;</td>
            </tr> -->
            <tr class="footer">
                <td class="t-right" colspan="5">Transfer Amount (-)&nbsp;&nbsp;</td>
                <td class="t-right"><?php echo my_money_format($less_transfer); ?>&nbsp;</td>
                <td class="t-right"><?php echo my_money_format(0); ?>&nbsp;</td>
            </tr>
            <tr class="footer">
                <td class="t-right" colspan="5">Concession / Exemption (-)&nbsp;&nbsp;</td>
                <td class="t-right"><?php echo my_money_format($con_exm_amt = $fconcession_amt + $sconcession_amt + $exemption_amt); ?>&nbsp;</td>
                <td class="t-right"><?php echo my_money_format(0); ?>&nbsp;</td>
            </tr>
            <tr class="footer">
                <td class="t-right" colspan="5">Paidback Amount(-)&nbsp;&nbsp;</td>
                <td class="t-right"><?php echo my_money_format(0); ?>&nbsp;</td>
                <td class="t-right"><?php echo my_money_format($paidback_amt); ?>&nbsp;</td>
            </tr>
            <tr class="footer">
                <td class="t-right" colspan="3">Not Reconciled Amount : <?php echo my_money_format($ncr_chq_amount); ?>&nbsp;&nbsp;</td>
                <td class="t-right" colspan="3">Net Total Amount&nbsp;&nbsp;</td>
                <td class="t-right"><?php echo my_money_format(($gross_amount + $servicecharge + $roundoff) - $paidback_amt - $less_transfer - $con_exm_amt); ?>&nbsp;</td><!-- - $wallet_deposit_tr -->
            </tr>
            <!-- <tr class="footer">
                <td class="t-right" colspan="5">Net Amount &nbsp;&nbsp;</td>
                <td class="t-right"><?php echo my_money_format($net_amount); ?>&nbsp;</td>
            </tr> -->
        </tbody>
    </table>
    <br>
    <?php     
    $i = 1;
    $totcolamt = 0;
    if (isset($details_ncr_data) && !empty($details_ncr_data)) {
        ?>
    <table class="table table-bordered" width="100%">
        <tbody>
            <?php
                foreach ($details_ncr_data as $vdate => $rptdata_a_ncr) {
            ?>
                    <tr class="header">
                        <td colspan="5" style="text-align: left;">&nbsp;Voucher Date : <?php echo date('d-m-Y', strtotime($vdate)); ?></td>
                    </tr>
                    <tr class="header">
                        <td width="5%">Sl.No</td>
                        <td width="15%">Voucher Code</td>
                        <td width="15%">Demand Date</td>
                        <td width="36%">Description</td>
                        <td width="12%">Collection</td>
                    </tr>
                    <?php
                    foreach ($rptdata_a_ncr as $rptdata_ncr) {
                    ?>
                        <tr class="bodyarea">
                            <td><?php echo $i; ?></td>
                            <td><?php echo $rptdata_ncr['voucher_code'] ?></td>
                            <td><?php echo date('M/Y', strtotime($rptdata_ncr['demand_date'])) ?></td>
                            <td class="t-left">&nbsp;<?php echo $rptdata_ncr['description'] ?></td>
                            <td class="t-right"><?php echo my_money_format($rptdata_ncr['voucher_amount']); ?>&nbsp;</td>
                        </tr>
            <?php
                        $i++;
                        $totcolamt = $totcolamt + $rptdata_ncr['voucher_amount'];
                    }
                }
            $gross_amount = $totcolamt;
            //$net_amount = $totcolamt - $less_transfer;
            ?>
            <tr class="linetr">
                <td colspan="5"></td>
            </tr>
            <tr class="footer">
                <td class="t-right" colspan="4">Total Amount &nbsp;&nbsp;</td>
                <td class="t-right"><?php echo my_money_format($gross_amount); ?>&nbsp;</td>5
            </tr>
        </tbody>
    </table>
            <?php } ?>
</body>

</html>