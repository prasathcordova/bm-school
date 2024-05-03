<html>

<head>
    <title style="color:hotpink"><?php echo $title; ?></title>
</head>

<body style="background: #fff !important;">
    <?php echo $this->load->view('report/pdf/header') ?>
    <table class="table table-bordered" width="100%">
        <thead>
            <tr class="header">
                <td style="width:3% !important;">Sl.No.</td>
                <td style="width:6% !important;">Admission No.</td>
                <td style="width:10% !important;">Student Name</td>
                <td style="width:6% !important;">Voucher</td>
                <?php
                $widthremain = 67;
                $tdcount = 6;
                foreach ($feecodesavailable as $fcodes_hearder) {
                    $widthofcol = 'styel=text-align:right; width:' . ($widthremain / (count($feecodesavailable) - 1)) . '% !important';
                ?>
                    <td <?php echo $widthofcol ?>><?php echo $fcodes_hearder['fee_shortcode']; ?>&nbsp;</td>
                <?php
                    $tdcount++;
                }
                ?>
                <td style="width:5% !important;text-align:right; ">Amount&nbsp;</td>
                <td style="width:3% !important;">Type</td>
            </tr>
        </thead>
        <tbody>
            <?php
            $i = 1;
            $totcolamt = 0;
            // test data
            if (isset($details_data) && !empty($details_data)) {
                foreach ($details_data as $vouchercode => $rpt_data) {
                    echo '<tr class="bodyarea">';
                    echo '<td>' . $i . '</td>';
                    echo '<td>' . $rpt_data['student_details']['Admn_No'] . '</td>';
                    echo '<td>' . $rpt_data['student_details']['First_Name'] . '</td>';
                    echo '<td>' . $rpt_data['student_details']['voucher_code'] . '</td>';
                    //echo '<td>' . $vouchercode . '</td>';
                    $row_total_amt = 0;
                    foreach ($feecodesavailable as $fcodes_hearder) {
                        $cash = (isset($rpt_data['fee_details'][$fcodes_hearder['feeCode']]['amt_paid']) ? $rpt_data['fee_details'][$fcodes_hearder['feeCode']]['amt_paid'] : 0);
                        echo '<td style="text-align:right;">' . my_money_format($cash) . '&nbsp;</td>';
                        $row_total_amt = $row_total_amt + $cash;
                    }
                    // foreach ($feecodesavailable as $fcodes_hearder) {

                    //     // }
                    //     // foreach ($rpt_data['fee_details'] as $asd =>  $rpt_lvl2) {
                    //     //foreach ($rpt_data['fee_details'] as $fcodes => $rpt_actuals) {
                    //     echo '<td>' . $rpt_data['fee_details'][$fcodes_hearder['feeCode']]['amt_paid'] . '</td>';
                    //     $row_total_amt = $row_total_amt + $rpt_data['fee_details'][$fcodes_hearder['feeCode']]['amt_paid'];
                    //     //}
                    //     echo '<td>' . $row_total_amt . '</td>';
                    //     echo '<td>' . $rpt_lvl2['trans_type'] . '</td>';
                    //     $totcolamt = $totcolamt + $row_total_amt;
                    // }
                    // echo '<td>' . $i . '</td>';
                    // echo '<td>' . $i . '</td>';
                    // echo '<td>' . $i . '</td>';
                    // echo '<td>' . $i . '</td>';
                    // echo '<td>' . $i . '</td>';
                    // echo '<td>' . $i . '</td>';
                    echo '<td class="t-right">' . my_money_format($row_total_amt) . '&nbsp;</td>';
                    echo '<td>' . $rpt_data['student_details']['trans_type'] . '</td>';
                    echo '</tr>';
                    $i++;
                }
            }
            // test data
            ?>
        </tbody>
    </table>
    <pagebreak />
    <h3>Daily Total as follows</h3>
    <table class="table table-bordered" width="100%">
        <thead>
            <tr class="header">
                <td style="text-align:right; width:8%;">&nbsp;</td>
                <?php
                $widthremain = 84;
                foreach ($feecodesavailable as $fcodes_hearder) {
                    $widthofcol = 'styel=text-align:right; width:' . ($widthremain / (count($feecodesavailable) - 1)) . '% !important';
                ?>
                    <td <?php echo $widthofcol ?>><?php echo $fcodes_hearder['fee_shortcode']; ?>&nbsp;</td>
                <?php

                }
                ?>
                <td style="text-align:right; width:8%;">TOTAL&nbsp;</td>
            </tr>
        </thead>
        <tbody>
            <?php
            foreach ($feesummary_data['TRANSTYPES'] as $key => $value) {
            ?>
                <tr class="bodyarea">
                    <th style="text-align:right;"><?php echo $value; ?>&nbsp;</th>
                    <?php
                    if ($value == 'Total' || $value == 'Fees Total') {
                        $bold = 'font-weight:bold;';
                    } else {
                        $bold = '';
                    }
                    foreach ($feecodesavailable as $fcodes_hearder) {
                    ?>
                        <td style="text-align:right;<?php echo $bold; ?>"><?php echo my_money_format((isset($feesummary_data[$fcodes_hearder['feeCode']][$key]) ? $feesummary_data[$fcodes_hearder['feeCode']][$key] : 0)); ?>&nbsp;</td>
                    <?php

                    }
                    ?>
                    <td style="text-align:right;<?php echo $bold; ?>">
                        <?php
                        //if ($key != 'feetotal') {
                        echo my_money_format((isset($feesummary_data['TOTAL'][$key]) ? $feesummary_data['TOTAL'][$key] : 0));
                        //}
                        ?>&nbsp;</td>
                </tr>
            <?php
            }
            ?>

        </tbody>
    </table>
    <!-- <table class="table table-bordered" width="100%">
        <thead>
            <tr class="header">
                <td style="text-align:right;">&nbsp;</td>
                <td style="text-align:right;">Cash&nbsp;</td>
                <td style="text-align:right;">Cheque&nbsp;</td>
                <td style="text-align:right;">Card&nbsp;</td>
                <td style="text-align:right;">Online&nbsp;</td>
                <td style="text-align:right;">Total&nbsp;</td>
                <td style="text-align:right;">Transfer(-)&nbsp;</td>
                <td style="text-align:right;">Fees Total&nbsp;</td>
            </tr>
        </thead>
        <tbody>
            <?php
            foreach ($feesummary_data as $key => $value) {
            ?>
                <tr class="bodyarea">
                    <td class="t-right"><?php echo $key ?>&nbsp;</td>
                    <td class="t-right"><?php echo ((isset($value['cash']) ? $value['cash'] : 0)); ?>&nbsp;</td>
                    <td class="t-right"><?php echo ((isset($value['cheque']) ? $value['cheque'] : 0)) ?>&nbsp;</td>
                    <td class="t-right"><?php echo ((isset($value['card']) ? $value['card'] : 0)) ?>&nbsp;</td>
                    <td class="t-right"><?php echo ((isset($value['online']) ? $value['online'] : 0)) ?>&nbsp;</td>
                    <td class="t-right"><?php echo ((isset($value['total']) ? $value['total'] : 0)) ?>&nbsp;</td>
                    <td class="t-right"><?php echo ((isset($value['transfer']) ? $value['transfer'] : 0)) ?>&nbsp;</td>
                    <td class="t-right"><?php echo ((isset($value['feetotal']) ? $value['feetotal'] : 0)) ?>&nbsp;</td>
                </tr>
            <?php
            }
            ?>
        </tbody>
    </table> -->
    <br>
    <h3>Summary</h3>
    <div style="float:left; width:25%;">
        <table class="table table-bordered" width="100%">
            <tbody>
                <tr class="bodyarea">
                    <td class="t-right">Cash&nbsp;</td>
                    <td class="t-right"><?php echo my_money_format($minisummary_data['cash']); ?>&nbsp;</td>
                </tr>
                <tr class="bodyarea">
                    <td class="t-right">Cheque&nbsp;</td>
                    <td class="t-right"><?php echo my_money_format($minisummary_data['cheque']); ?>&nbsp;</td>
                </tr>
                <tr class="bodyarea">
                    <td class="t-right">Card&nbsp;</td>
                    <td class="t-right"><?php echo my_money_format($minisummary_data['card']); ?>&nbsp;</td>
                </tr>
                <tr class="bodyarea">
                    <td class="t-right">DBT&nbsp;</td>
                    <td class="t-right"><?php echo my_money_format($minisummary_data['dbt']); ?>&nbsp;</td>
                </tr>
                <tr class="bodyarea">
                    <td class="t-right">Online&nbsp;</td>
                    <td class="t-right"><?php echo my_money_format($minisummary_data['online']); ?>&nbsp;</td>
                </tr>
                <!-- <tr class="bodyarea">
                    <td class="t-right">Round Off (+)&nbsp;</td>
                    <td class="t-right"><?php echo my_money_format($minisummary_data['round_off']); ?>&nbsp;</td>
                </tr> -->
                <tr class="bodyarea">
                    <td class="t-right">Transfer (+)&nbsp;</td>
                    <td class="t-right"><?php echo my_money_format($minisummary_data['transfer']); ?>&nbsp;</td>
                </tr>
                <!-- <tr class="bodyarea">
                    <td class="t-right">Penalty&nbsp;</td>
                    <td class="t-right"><?php echo my_money_format($minisummary_data['penalty']); ?>&nbsp;</td>
                </tr> -->
                <tr class="bodyarea">
                    <td class="t-right">Prospectus Fee&nbsp;<br><small>with service charge(if any)&nbsp;</small></td>
                    <td class="t-right"><?php echo my_money_format($minisummary_data['prospectus']); ?>&nbsp;</td>
                </tr>
                <tr class="bodyarea">
                    <td class="t-right">Registration Fee&nbsp;<br><small>with service charge(if any)&nbsp;</small></td>
                    <td class="t-right"><?php echo my_money_format($minisummary_data['regfee']); ?>&nbsp;</td>
                </tr>
                <tr class="linetr">
                    <td colspan="2"></td>
                </tr>
                <tr class="bodyarea">
                    <td class="t-right"><b>Gross Amount</b>&nbsp;</td>
                    <td class="t-right"><b><?php echo my_money_format($minisummary_data['grossamount']); ?></b>&nbsp;</td>
                </tr>
                <tr class="bodyarea">
                    <td class="t-right">Transfer (-)&nbsp;</td>
                    <td class="t-right"><?php echo my_money_format($minisummary_data['transferless']); ?>&nbsp;</td>
                </tr>
                <tr class="bodyarea">
                    <td class="t-right">Payback (-)&nbsp;</td>
                    <td class="t-right"><?php echo my_money_format($minisummary_data['paybackless']); ?>&nbsp;</td>
                </tr>
                <tr class="linetr">
                    <td colspan="2"></td>
                </tr>
                <tr class="bodyarea">
                    <td class="t-right"><b>Net Amount</b>&nbsp;</td>
                    <td class="t-right"><b><?php echo my_money_format($minisummary_data['netamount']); ?></b>&nbsp;</td>
                </tr>
            </tbody>
        </table>
    </div>
    <div style="float:left; width:46%; margin-left:2%; margin-right:2%;">
        <table class="table table-bordered" width="100%">
            <thead>
                <tr class="header">
                    <td style="text-align:right;" colspan="2">Cash / Cheque / Card / DBT (A)&nbsp;</td>
                    <td style="text-align:right;">Transfer&nbsp;<small><small><small>(with <?php echo print_tax_vat(); ?>)&nbsp;</small></small></small> (B)&nbsp;</td>
                    <td style="text-align:right;"><?php echo print_tax_vat(); ?> (C)&nbsp;</td>
                    <td style="text-align:right;">Total (A + C)&nbsp;</td>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($totalsummary_data as $key => $value) {
                    if ($key == 'Total') {
                        $st = 'style=font-weight:bold';
                    } else $st = '';
                ?>
                    <tr class="bodyarea">
                        <td class="t-right" style="border-right:0px !important; border-bottom:0px !important;" <?php echo $st; ?>><?php echo $key; ?>:&nbsp;</td>
                        <td class="t-right" style="border-bottom:0px !important;" <?php echo $st; ?>><?php echo my_money_format($value['amount']); ?>&nbsp;</td>
                        <td class="t-right" style="border-bottom:0px !important;" <?php echo $st; ?>><?php echo my_money_format($value['transfer']); ?>&nbsp;</td>
                        <td class="t-right" style="border-bottom:0px !important;" <?php echo $st; ?>><?php echo my_money_format($value['vat']); ?>&nbsp;</td>
                        <td class="t-right" style="border-bottom:0px !important; font-weight:bold;" <?php echo $st; ?>><?php echo my_money_format($value['total']); ?>&nbsp;</td>
                    </tr>
                <?php
                }
                ?>
            </tbody>
        </table>
    </div>
    <div style="float:right; width:25%;">
        <table class="table table-bordered" width="100%">
            <tbody>
                <?php
                foreach ($otherdetails_data as $key => $odd) {
                ?>
                    <tr class="bodyarea">
                        <td class="t-right"><?php echo $key; ?> :&nbsp;</td>
                        <td class="t-right"><?php echo my_money_format($odd) ?>&nbsp;</td>
                    </tr>
                <?php
                }
                ?>
                <!-- <tr class="bodyarea">
                    <td class="t-right" >Amount Subjected For Realization :&nbsp;</td>
                    <td class="t-right"><?php echo (0) ?>&nbsp;</td>
                </tr>
                <tr class="bodyarea">
                    <td class="t-right" >Non Demandable Fees Collected :&nbsp;</td>
                    <td class="t-right"><?php echo (0) ?>&nbsp;</td>
                </tr>
                <tr class="bodyarea">
                    <td class="t-right">(Transfer)Concession Given :&nbsp;</td>
                    <td class="t-right"><?php echo (0); ?>&nbsp;</td>
                </tr>
                <tr class="bodyarea">
                    <td class="t-right">(Transfer)Excemption Given :&nbsp;</td>
                    <td class="t-right"><?php echo (0); ?>&nbsp;</td>
                </tr>
                <tr class="bodyarea">
                    <td class="t-right">(Transfer)Fee Advance Adjusted :&nbsp;</td>
                    <td class="t-right"><?php echo (0); ?>&nbsp;</td>
                </tr> -->
            </tbody>
        </table>
    </div>
    <pagebreak />
    <h3>OTHERS (OTH)</h3>
    <table class="table table-bordered" width="100%">
        <thead>
            <tr class="header">
                <td style="width:3% !important;">Sl.No.</td>
                <td style="width:6% !important;">Admission No.</td>
                <td style="width:10% !important;">Student Name</td>
                <td style="width:6% !important;">Voucher</td>
                <?php
                $widthremain = 67;
                $tdcount = 6;
                $ignore_array = ['F023', 'F101', 'F025'];
                foreach ($non_demandable_feecodes as $nd_fcodes) {
                    if (!in_array($nd_fcodes['feeCode'], $ignore_array)) { //- 1
                        $widthofcol = 'styel=text-align:right; width:' . ($widthremain / (count($non_demandable_feecodes))) . '% !important';
                ?>
                        <td <?php echo $widthofcol ?>><?php echo $nd_fcodes['fee_shortcode']; ?>&nbsp;</td>
                <?php
                        $tdcount++;
                    }
                }
                ?>
                <td style="width:5% !important;text-align:right; ">Amount&nbsp;</td>
                <td style="width:3% !important;">Type</td>
            </tr>
        </thead>
        <tbody>
            <?php
            $i = 1;
            $totcolamt = 0;
            // test data
            if (isset($ndmd_feedetails) && !empty($ndmd_feedetails)) {
                foreach ($ndmd_feedetails as $vouchercode => $rpt_data) {
                    echo '<tr class="bodyarea">';
                    echo '<td>' . $i . '</td>';
                    echo '<td>' . $rpt_data['student_details']['Admn_No'] . '</td>';
                    echo '<td>' . $rpt_data['student_details']['First_Name'] . '</td>';
                    echo '<td>' . $rpt_data['student_details']['voucher_code'] . '</td>';
                    //echo '<td>' . $vouchercode . '</td>';
                    $row_total_amt = 0;
                    foreach ($non_demandable_feecodes as $nd_fcodes2) {
                        if (!in_array($nd_fcodes2['feeCode'], $ignore_array)) { //avoid Wallet from other fee
                            $cash = (isset($rpt_data['fee_details'][$nd_fcodes2['feeCode']]['amt_paid']) ? $rpt_data['fee_details'][$nd_fcodes2['feeCode']]['amt_paid'] : 0);
                            echo '<td style="text-align:right;">' . my_money_format($cash) . '&nbsp;</td>';
                            $row_total_amt = $row_total_amt + $cash;
                        }
                    }
                    echo '<td class="t-right">' . my_money_format($row_total_amt) . '&nbsp;</td>';
                    echo '<td>' . $rpt_data['student_details']['trans_type'] . '</td>';
                    echo '</tr>';
                    $i++;
                }
            }
            // test data
            ?>
        </tbody>
    </table>

    <pagebreak />
    <div style="float:left; width:33%; margin-right:1%;">
        <h3>FEE CODE DESCRIPTIONS</h3>
        <table class="table table-bordered" width="100%">
            <tbody>
                <?php
                foreach ($feecodesavailable as $fcodes_hearder) {
                ?>
                    <tr class="bodyarea">
                        <td class="t-right"> <?php echo $fcodes_hearder['fee_shortcode']; ?>&nbsp;</td>
                        <td class="t-left">&nbsp; <?php echo $fcodes_hearder['description']; ?></td>
                    </tr>
                <?php
                }
                ?>
            </tbody>
        </table>
    </div>
    <div style="float:left; width:32%; margin-left:1%;">
        <h3>OTHER FEE CODE DESCRIPTIONS</h3>
        <table class="table table-bordered" width="100%">
            <tbody>
                <?php
                foreach ($non_demandable_feecodes as $fcodes_hearder1) {
                    if (($fcodes_hearder1['feeCode'] != 'F023' && $fcodes_hearder1['feeCode'] != 'F101') && $fcodes_hearder1['editable'] == 1) {
                ?>
                        <tr class="bodyarea">
                            <td class="t-right"> <?php echo $fcodes_hearder1['fee_shortcode']; ?>&nbsp;</td>
                            <td class="t-left">&nbsp; <?php echo $fcodes_hearder1['description']; ?></td>
                        </tr>
                <?php
                    }
                }
                ?>
            </tbody>
        </table>
    </div>

</body>

</html>