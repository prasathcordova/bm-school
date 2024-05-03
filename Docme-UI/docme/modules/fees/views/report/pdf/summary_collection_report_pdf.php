<html>

<head></head>

<body style="background: #fff !important;">
    <?php echo $this->load->view('report/pdf/header') ?>
    <!-- <br>
    <h5 style="margin-bottom: 10px; margin-top:0px;font-family:arial;"><?php echo $collection_date; ?></h5> -->
    <table class="table table-bordered" width="100%">
        <thead>
            <tr class="header">
                <td width="3%">Sl.No</td>
                <td width="7%">Month</td>
                <?php
                $widthremain = 76;
                $tdcount = 4;
                $feecount = count($feecodes_data) - 1;
                foreach ($feecodes_data as $fcodes_hearder) {
                    if ($fcodes_hearder['fee_shortcode'] != 'BCH') {
                ?>
                        <td width="<?php echo ($widthremain / ($feecount)); ?>"><?php echo $fcodes_hearder['fee_shortcode']; ?></td>
                <?php
                        $tdcount++;
                    }
                }
                ?>
                <td width="10%">Total</td>
                <td width="4%">Pay Type</td>
            </tr>
        </thead>
        <tbody>
            <?php
            $i = 1;
            $totcolamt = 0;
            if (isset($details_data) && !empty($details_data)) {
                foreach ($details_data as $ddate => $rpt_data) {
                    foreach ($rpt_data as $pay_type => $rpt_lvl2) {
                        echo '<tr class="bodyarea">';
                        echo '<td>' . $i++ . '</td>';
                        echo '<td>' . date('M-Y', strtotime($ddate)) . '</td>';
                        $row_total_amt = 0;
                        foreach ($feecodes_data as $fcodes_hearder) {
                            if ($fcodes_hearder['fee_shortcode'] != 'BCH') {
                                $cash = (isset($rpt_data[$pay_type][$fcodes_hearder['feeCode']]['amt_paid']) ? $rpt_data[$pay_type][$fcodes_hearder['feeCode']]['amt_paid'] : 0);
                                echo '<td style="text-align:right;">' . my_money_format($cash) . '&nbsp;</td>';
                                $row_total_amt = $row_total_amt + $cash;
                            }
                        }
                        // foreach ($rpt_lvl2 as $fcodes => $rpt_actuals) {
                        //     echo '<td class="t-right">' . my_money_format($rpt_actuals['amt_paid']) . '&nbsp;</td>';
                        //     $row_total_amt = $row_total_amt + $rpt_actuals['amt_paid'];
                        // }
                        echo '<td class="t-right">' . my_money_format($row_total_amt) . '&nbsp;</td>';
                        echo '<td>' . $pay_type . '</td>';
                        $totcolamt = $totcolamt + $row_total_amt;
                        echo '</tr>';
                    }
                }
            }
            ?>
            <tr class="linetr">
                <td colspan="<?php echo $tdcount ?>"></td>
            </tr>
            <tr class="footer">
                <td style="text-align: right;" colspan="<?php echo ($tdcount - 2) ?>">Service Charge &nbsp;&nbsp;</td>
                <td style="text-align: right;"><?php echo my_money_format($sercharge_for_payments); ?>&nbsp;</td>
                <td>&nbsp;</td>
            </tr>
            <tr class="footer">
                <td style="text-align: right;" colspan="<?php echo ($tdcount - 2) ?>">Round Off &nbsp;&nbsp;</td>
                <td style="text-align: right;"><?php echo my_money_format($roundoff_for_payments); ?>&nbsp;</td>
                <td>&nbsp;</td>
            </tr>
            <tr class="footer">
                <td style="text-align: right;" colspan="<?php echo ($tdcount - 2) ?>">Total &nbsp;&nbsp;</td>
                <td style="text-align: right;"><?php echo my_money_format($totcolamt + $sercharge_for_payments + $roundoff_for_payments); ?>&nbsp;</td>
                <td>&nbsp;</td>
            </tr>
        </tbody>
    </table>
    <pagebreak />
    <!-- <br> -->
    <!-- <h3>Daily Total as follows</h3> -->
    <table class="table table-bordered" width="100%">
        <thead>
            <tr class="header">
                <td style="text-align:right; width:10%;">&nbsp;</td>
                <?php
                $widthremain = 80;
                $tdcount = 6;
                foreach ($feecodes_data as $fcodes_hearder) {
                    $widthofcol = 'styel=text-align:right; width:' . ($widthremain / (count($feecodes_data) - 1)) . '% !important';
                ?>
                    <td <?php echo $widthofcol ?>><?php echo $fcodes_hearder['fee_shortcode']; ?>&nbsp;</td>
                <?php
                    $tdcount++;
                }
                ?>
                <td style="text-align:right; width:10%;">Total&nbsp;</td>
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
                    $widthremain = 67;
                    $tdcount = 6;
                    foreach ($feecodes_data as $fcodes_hearder) {
                        if ($value == 'Round Off') $amt_display = '';
                        else $amt_display = my_money_format((isset($feesummary_data[$fcodes_hearder['feeCode']][$key]) ? $feesummary_data[$fcodes_hearder['feeCode']][$key] : 0));
                    ?>
                        <td style="text-align:right;<?php echo $bold; ?>"><?php echo $amt_display; ?>&nbsp;</td>
                    <?php
                        $tdcount++;
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
                    <td class="t-right"><?php echo my_money_format((isset($value['cash']) ? $value['cash'] : 0)); ?>&nbsp;</td>
                    <td class="t-right"><?php echo my_money_format((isset($value['cheque']) ? $value['cheque'] : 0)) ?>&nbsp;</td>
                    <td class="t-right"><?php echo my_money_format((isset($value['card']) ? $value['card'] : 0)) ?>&nbsp;</td>
                    <td class="t-right"><?php echo my_money_format((isset($value['online']) ? $value['online'] : 0)) ?>&nbsp;</td>
                    <td class="t-right"><?php echo my_money_format((isset($value['total']) ? $value['total'] : 0)) ?>&nbsp;</td>
                    <td class="t-right"><?php echo my_money_format((isset($value['transfer']) ? $value['transfer'] : 0)) ?>&nbsp;</td>
                    <td class="t-right"><?php echo my_money_format((isset($value['feetotal']) ? $value['feetotal'] : 0)) ?>&nbsp;</td>
                </tr>
            <?php
            }
            ?>
        </tbody>
    </table> -->
    <br>
    <!-- <h3>Summary</h3> -->
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
                <tr class="bodyarea">
                    <td class="t-right">Transfer (+)&nbsp;</td>
                    <td class="t-right"><?php echo my_money_format($minisummary_data['transfer']); ?>&nbsp;</td>
                </tr>
                <tr class="bodyarea">
                    <td class="t-right">Prospectus Fee&nbsp;<br><small>with service charge(if any)&nbsp;</small></td>
                    <td class="t-right"><?php echo my_money_format($minisummary_data['prospectus']); ?>&nbsp;</td>
                </tr>
                <tr class="bodyarea">
                    <td class="t-right">Registration Fee&nbsp;<br><small>with service charge(if any)&nbsp;</small></td>
                    <td class="t-right"><?php echo my_money_format($minisummary_data['regfee']); ?>&nbsp;</td>
                </tr>
                <!-- <tr class="bodyarea">
                    <td class="t-right">Service Charge&nbsp;</td>
                    <td class="t-right"><?php echo my_money_format($minisummary_data['surcharge']); ?>&nbsp;</td>
                </tr> -->
                <tr class="linetr">
                    <td colspan="2"></td>
                </tr>
                <tr class="bodyarea">
                    <td class="t-right"><b>Gross Amount</b>&nbsp;</td>
                    <td class="t-right"><b><?php echo my_money_format($minisummary_data['grossamount']); ?></b>&nbsp;</td>
                </tr>
                <tr class="bodyarea">
                    <td class="t-right">Round Off (+)&nbsp;</td>
                    <td class="t-right"><?php echo my_money_format($minisummary_data['round_off']); ?>&nbsp;</td>
                </tr>
                <!-- <tr class="bodyarea">
                    <td class="t-right">TAX (+)&nbsp;</td>
                    <td class="t-right"><?php echo my_money_format($minisummary_data['taxamount']); ?>&nbsp;</td>
                </tr> -->
                <tr class="bodyarea">
                    <td class="t-right">Transfer (-)&nbsp;<br><small>With <?php echo print_tax_vat(); ?>&nbsp;</small></td>
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
                        $bold = 'font-weight:bold;';
                    } else {
                        $bold = '';
                    }
                ?>
                    <tr class="bodyarea">
                        <td class="t-right" style="border-right:0px !important; border-bottom:0px !important;<?php echo $bold; ?>"><?php echo $key; ?>:&nbsp;</td>
                        <td class="t-right" style="border-bottom:0px !important;<?php echo $bold; ?>"><?php echo my_money_format($value['amount']); ?>&nbsp;</td>
                        <td class="t-right" style="border-bottom:0px !important;<?php echo $bold; ?>"><?php echo my_money_format($value['transfer']); ?>&nbsp;</td>
                        <td class="t-right" style="border-bottom:0px !important;<?php echo $bold; ?>"><?php echo my_money_format($value['vat']); ?>&nbsp;</td>
                        <td class="t-right" style="border-bottom:0px !important;<?php echo $bold; ?>"><?php echo my_money_format($value['total']); ?>&nbsp;</td>
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
    <!-- <br>
    <h5 style="margin-bottom: 10px; margin-top:0px;font-family:arial;"><?php echo $collection_date; ?></h5> -->
    <h3>OTHERS (OTH)</h3>
    <table class="table table-bordered" width="100%">
        <thead>
            <tr class="header">
                <td width="3%">Sl.No</td>
                <td width="7%">Month</td>
                <?php
                $widthremain = 76;
                $tdcount = 4;
                $ignore_array = ['F023', 'F101'];
                foreach ($non_demandable_feecodes as $nd_fcodes) {
                    if (!in_array($nd_fcodes['feeCode'], $ignore_array)) {
                ?>
                        <td width="<?php echo ($widthremain / (count($non_demandable_feecodes) - 2)); ?>"><?php echo $nd_fcodes['fee_shortcode']; ?></td>
                <?php
                        $tdcount++;
                    }
                }
                ?>
                <td width="10%">Total</td>
                <td width="4%">Pay Type</td>
            </tr>
        </thead>
        <tbody>
            <?php
            $i = 1;
            $totcolamt = 0;
            if (isset($ndmd_feedetails) && !empty($ndmd_feedetails)) {
                foreach ($ndmd_feedetails as $ddate => $rpt_data) {
                    foreach ($rpt_data as $pay_type => $rpt_lvl2) {
                        echo '<tr class="bodyarea">';
                        echo '<td>' . $i++ . '</td>';
                        echo '<td>' . date('M-Y', strtotime($ddate)) . '</td>';
                        $row_total_amt = 0;
                        foreach ($non_demandable_feecodes as $nd_fcodes2) {
                            if (!in_array($nd_fcodes2['feeCode'], $ignore_array)) {
                                $cash = (isset($rpt_data[$pay_type][$nd_fcodes2['feeCode']]['amt_paid']) ? $rpt_data[$pay_type][$nd_fcodes2['feeCode']]['amt_paid'] : 0);
                                echo '<td style="text-align:right;">' . my_money_format($cash) . '&nbsp;</td>';
                                $row_total_amt = $row_total_amt + $cash;
                            }
                        }
                        echo '<td class="t-right">' . my_money_format($row_total_amt) . '&nbsp;</td>';
                        echo '<td>' . $pay_type . '</td>';
                        $totcolamt = $totcolamt + $row_total_amt;
                        echo '</tr>';
                    }
                }
            }
            ?>
            <tr class="linetr">
                <td colspan="<?php echo $tdcount ?>"></td>
            </tr>
            <tr class="footer">
                <td style="text-align: right;" colspan="<?php echo ($tdcount - 2) ?>">Total &nbsp;&nbsp;</td>
                <td style="text-align: right;"><?php echo my_money_format($totcolamt); ?>&nbsp;</td>
                <td>&nbsp;</td>
            </tr>
        </tbody>
    </table>
    <pagebreak />
    <br>
    <div style="float:left; width:32%; margin-right:1%;">
        <h3>Fee Code Descriptions</h3>
        <table class="table table-bordered" width="100%">
            <tbody>
                <?php
                foreach ($feecodes_data as $fcodes_hearder) {
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
                foreach ($non_demandable_feecodes as $nd_fcodes1) {
                    if (($nd_fcodes1['feeCode'] != 'F023' && $nd_fcodes1['feeCode'] != 'F101') && $nd_fcodes1['editable'] == 1) {
                ?>
                        <tr class="bodyarea">
                            <td class="t-right"> <?php echo $nd_fcodes1['fee_shortcode']; ?>&nbsp;</td>
                            <td class="t-left">&nbsp; <?php echo $nd_fcodes1['description']; ?></td>
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