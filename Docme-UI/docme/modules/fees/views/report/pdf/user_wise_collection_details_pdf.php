<html>

<head>

</head>

<body style="background: #fff !important;">
    <?php echo $this->load->view('report/pdf/header')
    ?><br>
    <table class="table table-bordered" width="100%">
        <thead>
            <tr class="header">
                <th class="t-left"><?php echo date('d-m-Y', strtotime($startdate)) ?></th>
            </tr>
            <tr class="header">
                <?php
                $colcount = count($pay_modes);
                echo '<th class="t-left" width="25%">Employee</th>';
                foreach ($pay_modes as $modes) {
                    echo '<td width="10%">' . $modes['payment_type_name'] . '</td>';
                }
                ?>
                <th width="15%">Total</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $i = 1;
            $totcolamt = 0;
            $surcharge = 0;
            $round_off_amount = 0;
            if (isset($details_data) && !empty($details_data) && !empty($details_data['collection'])) {
                foreach ($details_data['collection'] as $emp_name => $rpt_data) {
                    $total = 0;
                    echo '<tr class="bodyarea">';
                    echo '<td class="t-left">' . $emp_name . '</td>';
                    foreach ($rpt_data as $type_key => $trans_amt) {
                        echo '<td class="t-right">' . my_money_format($trans_amt['transaction_amt']) . '&nbsp;</td>';
                        $total = $total + $trans_amt['transaction_amt'];
                        $surcharge = $surcharge + $trans_amt['service_charge'];
                        $round_off_amount = $round_off_amount + $trans_amt['round_off_amount'];
                    }
                    echo '<td class="t-right">' . my_money_format(($total)) . '&nbsp;</td>';
                    $totcolamt = $totcolamt + $total;
                    echo '</tr>';
                }
            }
            $not_recon_amount = $details_data['common']['not_recon_amount'];
            $transfer_amount = $details_data['common']['transfer_amount'];
            $payback_amount = $details_data['common']['payback_amount'];
            ?>
            <tr class="linetr">
                <td colspan="<?php echo ($colcount + 2) ?>"></td>
            </tr>
            <tr class="footer">
                <td class="" style="text-align:right;" colspan="<?php echo ($colcount) ?>">Total &nbsp;&nbsp;</td>
                <td colspan="2" style="text-align:right;"><?php echo my_money_format(($totcolamt)); ?>&nbsp;&nbsp;</td>
            </tr>
            <tr class="bodyarea">
                <td class="" style="text-align:right;" colspan="<?php echo ($colcount) ?>">Service Charge &nbsp;&nbsp;</td>
                <td colspan="2" style="text-align:right;"><?php echo my_money_format(($surcharge)); ?>&nbsp;&nbsp;</td>
            </tr>
            <tr class="bodyarea">
                <td class="" style="text-align:right;" colspan="<?php echo ($colcount) ?>">Round Off &nbsp;&nbsp;</td>
                <td colspan="2" style="text-align:right;"><?php echo my_money_format(($round_off_amount)); ?>&nbsp;&nbsp;</td>
            </tr>
            <!-- <tr class="bodyarea">
                <td class="" style="text-align:right;" colspan="<?php echo ($colcount) ?>">Not Reconciled Cheque(-) &nbsp;&nbsp;</td>
                <td colspan="2" style="text-align:right;"><?php echo my_money_format(($not_recon_amount)); ?>&nbsp;&nbsp;</td>
            </tr> -->
            <tr class="bodyarea">
                <td class="" style="text-align:right;" colspan="<?php echo ($colcount) ?>">Transfer Amount(-) &nbsp;&nbsp;</td>
                <td colspan="2" style="text-align:right;"><?php echo my_money_format(($transfer_amount)); ?>&nbsp;&nbsp;</td>
            </tr>
            <tr class="bodyarea">
                <td class="" style="text-align:right;" colspan="<?php echo ($colcount) ?>">Payback Amount(-) &nbsp;&nbsp;</td>
                <td colspan="2" style="text-align:right;"><?php echo my_money_format(($payback_amount)); ?>&nbsp;&nbsp;</td>
            </tr>
            <tr class="footer">
                <td class="" colspan="2" style="text-align:right;">Amount Subjected For Realization &nbsp;&nbsp;</td>
                <td colspan="2" style="text-align:right;"><?php echo my_money_format($not_recon_amount); ?>&nbsp;&nbsp;</td>
                <td class="" style="text-align:right;" colspan="<?php echo ($colcount - 4) ?>">Grand Total &nbsp;&nbsp;</td>
                <!--//- $not_recon_amount-->
                <td colspan="2" style="text-align:right;"><?php echo my_money_format((($surcharge + $round_off_amount + ($totcolamt  - $transfer_amount - $payback_amount)))); ?>&nbsp;&nbsp;</td>
            </tr>
        </tbody>
    </table>
</body>

</html>