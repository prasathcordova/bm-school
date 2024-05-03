<html>

<head></head>

<body style="background: #fff !important;">
    <?php echo $this->load->view('report/pdf/header') ?>
    <table class="table table-bordered" width="100%">
        <tbody>
            <?php
            // dev_export($nd_details_data);
            $feecodedata = $fee_code_data;
            $i = 1;
            $totcolamt = 0;
            $transfer_amount = 0;
            $classtotal = 0;
            if (isset($details_data) && !empty($details_data)) {
                foreach ($details_data as $batch_key => $report_batch) {
                    $batch_total = 0;
            ?>
                    <tr class="bodyarea">
                        <td colspan="<?php echo (sizeof($feecodedata) + 2) ?>" class="t-left"><b><?php echo $batch_key; ?></b></td>
                    </tr>
                    <?php
                    foreach ($report_batch as $admn_key => $report_student) {
                        $stud_total = 0;
                    ?>
                        <tr class="bodyarea">
                            <td colspan="3" class="t-left">Admission No.:&nbsp;<?php echo $report_student['student_data']['Admn_no']; ?></td>
                            <td colspan="<?php echo (sizeof($feecodedata) - 1) ?>" class="t-left"><?php echo $report_student['student_data']['Student_name']; ?></td>
                        </tr>
                        <tr class="header">
                            <td width="6%">MONTH</td>
                            <td width="6%">DATE</td>
                            <td width="6%">VOUCHER</td>
                            <?php

                            foreach ($feecodedata as $fcodes) {
                                if ($fcodes['fee_shortcode'] != 'BCH' && $fcodes['fee_shortcode'] != 'RND') {
                            ?>
                                    <td width="<?php echo (72 / sizeof($feecodedata)) ?>%"><?php echo $fcodes['fee_shortcode']; ?></td>
                            <?php
                                }
                            }
                            ?>
                            <td width="10%">TOTAL</td>
                        </tr>
                        <?php
                        foreach ($report_student['voucher_details'] as $rpt_demdate) {
                            foreach ($rpt_demdate as $rpt_voucher) {
                                $voucher_code = $rpt_voucher['voucher_code'];
                                $voucher_date = date('d-m-Y', strtotime($rpt_voucher['voucher_date']));
                                $dm_date_fcode_total = 0;
                        ?>
                                <tr class="bodyarea">
                                    <td><?php echo date('M-Y', strtotime($rpt_voucher['demand_date'])); ?></td>
                                    <td><?php echo $voucher_date; ?></td>
                                    <td><?php echo $voucher_code; ?></td>
                                    <?php
                                    // foreach ($report_student['fee_details'] as $feecode => $rpt_voucher1) {
                                    foreach ($feecodedata as $fcodes) {
                                        if ($fcodes['fee_shortcode'] != 'BCH' && $fcodes['fee_shortcode'] != 'RND') {
                                            // if ($rpt_voucher['payment_mode_id'] == 5 && $rpt_voucher['is_others'] == 0) {
                                            //     $transfer_amount += $rpt_voucher['fee_details'][$fcodes['feeCode']]; //$rpt_voucher['amt_paid'];
                                            // }
                                            if (isset($rpt_voucher['fee_details'][$fcodes['feeCode']])) {
                                                // if ($fcodes['feeCode'] == $rpt_voucher['fee_details'][$fcodes['feeCode']]) {
                                                $amt = $rpt_voucher['fee_details'][$fcodes['feeCode']];
                                                // $dm_date_fcode_total = $dm_date_fcode_total + $amt;
                                            } else {
                                                $amt = 0;
                                            }

                                            if ($fcodes['feeCode'] == 'F103' && (isset($rpt_voucher['vat_paid']) && $rpt_voucher['vat_paid'] > 0)) {
                                                $amt += $rpt_voucher['vat_paid'];
                                            }
                                            // if ($fcodes['feeCode'] == 'F025' && (isset($rpt_voucher['ser_charge']) && $rpt_voucher['ser_charge'] > 0)) {
                                            //     $amt += $rpt_voucher['ser_charge'];
                                            // }
                                            // if ($fcodes['feeCode'] == 'F102' && (isset($rpt_voucher['round_off']))) { //&& $rpt_voucher['round_off'] > 0
                                            //     $amt += $rpt_voucher['round_off'];
                                            // }
                                            if ($fcodes['feeCode'] == 'F104' && (isset($rpt_voucher['penalty_paid']) && $rpt_voucher['penalty_paid'] > 0)) {
                                                $amt += $rpt_voucher['penalty_paid'];
                                            }
                                            $dm_date_fcode_total = $dm_date_fcode_total + $amt;
                                    ?>
                                            <td class="t-right"><?php echo my_money_format($amt); ?>&nbsp;</td>
                                    <?php
                                        }
                                    }
                                    // }
                                    ?>

                                    <td class="t-right">
                                        <?php echo my_money_format($dm_date_fcode_total);
                                        $stud_total += $dm_date_fcode_total; ?> &nbsp;
                                    </td>
                                </tr>
                        <?php

                            }
                        }

                        ?>
                        <tr class="linetr">
                            <td colspan="<?php echo (sizeof($feecodedata) + 2) ?>"></td>
                        </tr>
                        <tr class="bodyarea">
                            <td colspan="<?php echo (sizeof($feecodedata) + 1) ?>" class="t-right"><b>TOTAL</b> &nbsp;</td>
                            <td class="t-right"><?php echo my_money_format($stud_total);
                                                $batch_total += $stud_total;
                                                ?> &nbsp;</td>
                        </tr>
                    <?php
                    } ?>

                    <?php
                    $classtotal += $batch_total;
                    //$i++;
                    //$totcolamt = $totcolamt + $rptdata['voucher_amount'];
                    ?>
                    <tr class="linetr">
                        <td colspan="<?php echo (sizeof($feecodedata) + 2) ?>"></td>
                    </tr>
                    <tr class="bodyarea">
                        <td colspan="<?php echo (sizeof($feecodedata) + 1) ?>" class="t-right"><b>BATCH TOTAL</b> &nbsp;</td>
                        <td class="t-right"><?php echo my_money_format($batch_total);
                                            ?> &nbsp;</td>
                    </tr>
                <?php
                } ?>
                <tr class="linetr">
                    <td colspan="<?php echo (sizeof($feecodedata) + 2) ?>"></td>
                </tr>
                <tr class="bodyarea">
                    <td colspan="<?php echo (sizeof($feecodedata) + 1) ?>" class="t-right"><b>Service Charge</b> &nbsp;</td>
                    <td class="t-right"><?php echo my_money_format($common_data['service_charge']); ?> &nbsp;</td>
                </tr>
                <tr class="bodyarea">
                    <td colspan="<?php echo (sizeof($feecodedata) + 1) ?>" class="t-right"><b>Round off</b> &nbsp;</td>
                    <td class="t-right"><?php echo my_money_format($common_data['round_off']); ?> &nbsp;</td>
                </tr>
                <tr class="bodyarea">
                    <!-- <td colspan="2" class="t-right"><b>Service Charge</b> &nbsp;</td>
                    <td colspan="2" class="t-right"><?php echo my_money_format($common_data['service_charge']); ?> &nbsp;</td> -->
                    <td colspan="<?php echo (sizeof($feecodedata) + 1) ?>" class="t-right"><b>Net Amount</b> &nbsp;</td>
                    <td class="t-right"><?php echo my_money_format($classtotal + ($common_data['service_charge'] + $common_data['round_off'])); ?> &nbsp;</td>
                </tr>
                <tr class="bodyarea">
                    <!-- <td colspan="2" class="t-right"><b>Round off</b> &nbsp;</td>
                    <td colspan="2" class="t-right"><?php echo my_money_format($common_data['round_off']); ?> &nbsp;</td> -->
                    <td colspan="<?php echo (sizeof($feecodedata) + 1) ?>" class="t-right"><b>Transfer Amount (-)</b> &nbsp;</td>
                    <!-- <td class="t-right"><?php echo my_money_format($transfer_amount); ?> &nbsp;</td> -->
                    <td class="t-right"><?php echo my_money_format($common_data['transfer_amount']); ?> &nbsp;</td>
                </tr>
                <tr class="bodyarea">
                    <td colspan="<?php echo (sizeof($feecodedata) + 1) ?>" class="t-right"><b>Paid Back (-)</b> &nbsp;</td>
                    <td class="t-right"><?php echo my_money_format($common_data['payback_amount']); ?> &nbsp;</td>
                </tr>
                <tr class="bodyarea">
                    <td colspan="<?php echo (sizeof($feecodedata) + 1) ?>" class="t-right"><b>GRAND TOTAL</b> &nbsp;</td>
                    <td class="t-right" style="font-size: 13px;"><b><?php echo my_money_format(($classtotal + ($common_data['service_charge'] + $common_data['round_off']) - $common_data['transfer_amount'])  - ($common_data['payback_amount'])); ?></b> &nbsp;</td>
                    <!-- + ($common_data['service_charge'] + $common_data['round_off'])-->
                </tr>
            <?php
            }
            ?>
            <!-- <tr class="footer">
                <td class="t-right" colspan="5">Total &nbsp;&nbsp;</td>
                <td><?php echo my_money_format($totcolamt); ?></td>
            </tr> -->
        </tbody>
    </table>
    <pagebreak />
    <h3>OTHERS (OTH)</h3>
    <table class="table table-bordered" width="100%">
        <tbody>
            <?php
            $nd_feecodedata = $nd_fee_code_data;
            $i = 1;
            $totcolamt = 0;
            $transfer_amount = 0;
            $classtotal = 0;
            if (isset($nd_details_data) && !empty($nd_details_data)) {
                foreach ($nd_details_data as $batch_key => $report_batch) {
                    $batch_total = 0;
            ?>
                    <tr class="bodyarea">
                        <td colspan="<?php echo (sizeof($nd_feecodedata) + 4) ?>" class="t-left"><b><?php echo $batch_key; ?></b></td>
                    </tr>
                    <?php
                    foreach ($report_batch as $admn_key => $report_student) {
                        $stud_total = 0;
                    ?>
                        <tr class="bodyarea">
                            <td colspan="3" class="t-left">Admission No.:&nbsp;<?php echo $report_student['student_data']['Admn_no']; ?></td>
                            <td colspan="<?php echo (sizeof($nd_feecodedata) + 1) ?>" class="t-left"><?php echo $report_student['student_data']['Student_name']; ?></td>
                        </tr>
                        <!-- <thead> -->
                        <tr class="header">
                            <td width="6%">MONTH</td>
                            <td width="6%">DATE</td>
                            <td width="6%">VOUCHER</td>
                            <?php

                            foreach ($nd_feecodedata as $fcodes) {
                                if (($fcodes['feeCode'] != 'F023' && $fcodes['feeCode'] != 'F101')) {
                            ?>
                                    <td width="<?php echo (72 / sizeof($nd_feecodedata)) ?>%"><?php echo $fcodes['fee_shortcode']; ?></td>
                            <?php
                                }
                            }
                            ?>
                            <td width="10%">TOTAL</td>
                        </tr>
                        <!-- </thead> -->
                        <?php
                        // foreach ($report_student['voucher_details'] as $rpt_frv_key => $rpt_voucher) {
                        foreach ($report_student['voucher_details'] as $rpt_demdate) {
                            foreach ($rpt_demdate as $rpt_voucher) {
                                $voucher_code = $rpt_voucher['voucher_code'];
                                $voucher_date = $rpt_voucher['voucher_date'];
                                // if ($rpt_voucher['payment_mode_id'] == 5 && $rpt_voucher['is_others'] == 0) {
                                //     $transfer_amount += $rpt_voucher['amt_paid'];
                                // }
                                //foreach ($report_student['demand_details'] as $rpt_demand_data) {
                                $dm_date_fcode_total = 0;
                        ?>
                                <tr class="bodyarea">
                                    <td><?php echo date('M-Y', strtotime($rpt_voucher['demand_date'])); ?></td>
                                    <td><?php echo $voucher_date; ?></td>
                                    <td><?php echo $voucher_code; ?></td>
                                    <?php
                                    foreach ($nd_feecodedata as $fcodes) {
                                        // if ($rpt_voucher['payment_mode_id'] == 5 && $rpt_voucher['is_others'] == 0) {
                                        //     $transfer_amount += $rpt_voucher['fee_details'][$fcodes['feeCode']];
                                        // }
                                        if (($fcodes['feeCode'] != 'F023' && $fcodes['feeCode'] != 'F101')) {
                                            // if ($fcodes['feeCode'] == $rpt_voucher['feeCode']) {
                                            //     $amt = $rpt_voucher['amt_paid'];
                                            //     $dm_date_fcode_total = $dm_date_fcode_total + $amt;
                                            // } else {
                                            //     $amt = 0;
                                            // }
                                            if (isset($rpt_voucher['fee_details'][$fcodes['feeCode']])) {
                                                // if ($fcodes['feeCode'] == $rpt_voucher['fee_details'][$fcodes['feeCode']]) {
                                                $amt = $rpt_voucher['fee_details'][$fcodes['feeCode']];
                                                $dm_date_fcode_total = $dm_date_fcode_total + $amt;
                                                // $dm_date_fcode_total = $dm_date_fcode_total + $amt;
                                            } else {
                                                $amt = 0;
                                            }
                                    ?>
                                            <td class="t-right"><?php echo my_money_format($amt); ?>&nbsp;</td>
                                    <?php
                                        }
                                    }
                                    ?>

                                    <td class="t-right">
                                        <?php echo my_money_format($dm_date_fcode_total);
                                        $stud_total += $dm_date_fcode_total; ?> &nbsp;
                                    </td>
                                </tr>
                        <?php

                            }
                        }

                        ?>
                        <tr class="linetr">
                            <td colspan="<?php echo (sizeof($nd_feecodedata) + 4) ?>"></td>
                        </tr>
                        <tr class="bodyarea">
                            <td colspan="<?php echo (sizeof($nd_feecodedata) + 3) ?>" class="t-right"><b>TOTAL</b> &nbsp;</td>
                            <td class="t-right"><?php echo my_money_format($stud_total);
                                                $batch_total += $stud_total;
                                                ?> &nbsp;</td>
                        </tr>
                    <?php
                    } ?>

                    <?php
                    $classtotal += $batch_total;
                    //$i++;
                    //$totcolamt = $totcolamt + $rptdata['voucher_amount'];
                    ?>
                    <tr class="linetr">
                        <td colspan="<?php echo (sizeof($nd_feecodedata) + 4) ?>"></td>
                    </tr>
                    <tr class="bodyarea">
                        <td colspan="<?php echo (sizeof($nd_feecodedata) + 3) ?>" class="t-right"><b>BATCH TOTAL</b> &nbsp;</td>
                        <td class="t-right"><?php echo my_money_format($batch_total);
                                            ?> &nbsp;</td>
                    </tr>
                <?php
                } ?>
                <tr class="linetr">
                    <td colspan="<?php echo (sizeof($nd_feecodedata) + 4) ?>"></td>
                </tr>
                <tr class="bodyarea">
                    <td colspan="<?php echo (sizeof($nd_feecodedata) + 3) ?>" class="t-right"><b>GRAND TOTAL</b> &nbsp;</td>
                    <td class="t-right" style="font-size: 13px;"><b><?php echo my_money_format($classtotal); ?></b> &nbsp;</td>
                </tr>
                <!-- <tr class="bodyarea">
                    <td colspan="<?php echo (sizeof($nd_feecodedata) + 3) ?>" class="t-right"><b>Transfer Amount (-)</b> &nbsp;</td>
                    <td class="t-right"><?php echo my_money_format($transfer_amount); ?> &nbsp;</td>
                </tr>
                <tr class="bodyarea">
                    <td colspan="<?php echo (sizeof($nd_feecodedata) + 3) ?>" class="t-right"><b>Service Charge</b> &nbsp;</td>
                    <td class="t-right"><?php echo my_money_format($common_data['service_charge']); ?> &nbsp;</td>
                </tr>
                <tr class="bodyarea">
                    <td colspan="<?php echo (sizeof($nd_feecodedata) + 3) ?>" class="t-right"><b>Round off</b> &nbsp;</td>
                    <td class="t-right"><?php echo my_money_format($common_data['round_off']); ?> &nbsp;</td>
                </tr>
                <tr class="bodyarea">
                    <td colspan="<?php echo (sizeof($nd_feecodedata) + 3) ?>" class="t-right"><b>GRAND TOTAL</b> &nbsp;</td>
                    <td class="t-right"><?php echo my_money_format(($classtotal - $transfer_amount) + $common_data['service_charge'] + $common_data['round_off']); ?> &nbsp;</td>
                </tr> -->
            <?php
            }
            ?>
            <!-- <tr class="footer">
                <td class="t-right" colspan="5">Total &nbsp;&nbsp;</td>
                <td><?php echo my_money_format($totcolamt); ?></td>
            </tr> -->
        </tbody>
    </table>
    <pagebreak />
    <br>
    <div style="float:left; width:33%; margin-right:1%;">
        <h3>FEE CODE DESCRIPTIONS</h3>
        <table class="table table-bordered" width="100%">
            <tbody>
                <?php
                foreach ($feecodedata as $fcodes_hearder) {
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
                foreach ($nd_feecodedata as $fcodes) {
                    if (($fcodes['feeCode'] != 'F023' && $fcodes['feeCode'] != 'F101') && $fcodes['editable'] == 1) {
                ?>
                        <tr class="bodyarea">
                            <td class="t-right"> <?php echo $fcodes['fee_shortcode']; ?>&nbsp;</td>
                            <td class="t-left">&nbsp; <?php echo $fcodes['description']; ?></td>
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