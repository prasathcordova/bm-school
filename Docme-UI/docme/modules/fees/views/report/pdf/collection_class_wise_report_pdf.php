<html>

<head></head>

<body style="background: #fff !important;">
    <?php echo $this->load->view('report/pdf/header') ?>
    <!-- <br>
    <h5 style="margin-top:0px;"><?php echo $collection_date; ?></h5> -->
    <table class="table table-bordered" width="100%">
        <tbody>
            <?php
            $feecodedata = $fee_code_data;
            $i = 1;
            $totcolamt = 0;
            $grand_class_total = 0;
            $transfer_total_amount = 0;
            if (isset($details_data) && !empty($details_data)) {
                foreach ($details_data as $classname => $report_class) {
                    $class_total = 0;
            ?>
                    <tr class="bodyarea">
                        <td colspan="<?php echo (sizeof($feecodedata) + 2) ?>" class="t-left"><b><?php echo $classname; ?></b></td>
                    </tr>
                    <?php

                    foreach ($report_class as $batch_key => $report_batch) {
                        $batch_total_amount = 0;
                    ?>
                        <tr class="bodyarea">
                            <td colspan="<?php echo (sizeof($feecodedata) + 2) ?>" class="t-left"><b><?php echo $batch_key; ?></b></td>
                        </tr>
                        <thead>
                            <tr class="header">
                                <td width="10%">DATE</td>
                                <?php
                                foreach ($feecodedata as $fcodes) {
                                ?>
                                    <td width="<?php echo (75 / sizeof($feecodedata)) ?>%"><?php echo $fcodes['fee_shortcode']; ?></td>
                                <?php
                                } 
                                ?>
                                <td width="15%">Total</td>
                            </tr>
                        </thead>
                        <?php
                        foreach ($report_batch as $batch_date_key => $report_date) {
                            $total_row_amount = 0;
                        ?>
                            <tr class="bodyarea">
                                <td><?php echo date('d-m-Y', strtotime($batch_date_key)); ?></td>
                                <?php $ic = 0;
                                foreach ($feecodedata as $fcodes) {
                                    if (isset($report_date[$fcodes['feeCode']])) {
                                        $amt = $report_date[$fcodes['feeCode']];
                                    } else {
                                        $amt = 0;
                                    }
                                    $total_row_amount += $amt;
                                ?>
                                    <td class="t-right"><?php echo my_money_format($amt); ?>&nbsp;</td>
                                <?php } ?>

                                <td class="t-right"><?php echo my_money_format($total_row_amount); ?> &nbsp;</td>
                            </tr>
                        <?php
                            $transfer_total_amount = 0; //$report_date['fcode_summary']['transfer_total'];
                            $batch_total_amount += $total_row_amount;
                        }
                        ?>
                        <tr class="linetr">
                            <td colspan="<?php echo (sizeof($feecodedata) + 2) ?>"></td>
                        </tr>
                        <tr class="bodyarea">
                            <td colspan="<?php echo (sizeof($feecodedata) + 1) ?>" class="t-right">Batch Total &nbsp;</td>
                            <td class="t-right"><?php echo my_money_format($batch_total_amount); ?> &nbsp;</td>
                        </tr>
                    <?php
                        $class_total += $batch_total_amount;
                    } ?>

                    <?php
                    //$i++;
                    //$totcolamt = $totcolamt + $rptdata['voucher_amount'];
                    ?>
                    <tr class="linetr">
                        <td colspan="<?php echo (sizeof($feecodedata) + 2) ?>"></td>
                    </tr>
                    <tr class="bodyarea">
                        <td colspan="<?php echo (sizeof($feecodedata) + 1) ?>" class="t-right">Class Total &nbsp;</td>
                        <td class="t-right"><?php echo my_money_format($class_total) ?> &nbsp;</td>
                    </tr>
                <?php
                    $grand_class_total += $class_total;
                } ?>
                <tr class="linetr">
                    <td colspan="<?php echo (sizeof($feecodedata) + 2) ?>"></td>
                </tr>
                <tr class="bodyarea">
                    <td colspan="<?php echo (sizeof($feecodedata) + 1) ?>" class="t-right">All Class Total &nbsp;</td>
                    <td class="t-right"><?php echo my_money_format($grand_class_total); ?> &nbsp;</td>
                </tr>
                <tr class="bodyarea">
                    <?php
                    if ($include_transfer == 1) $transfer_total_amount = $common_data['transfer_total'];
                    else $transfer_total_amount = 0;
                    ?>
                    <td colspan="<?php echo (sizeof($feecodedata) + 1) ?>" class="t-right"><b>Transfer Amount (-)</b> &nbsp;</td>
                    <td class="t-right"><?php echo my_money_format($transfer_total_amount); ?> &nbsp;</td>
                </tr>
                <tr class="bodyarea">
                    <td colspan="<?php echo (sizeof($feecodedata) + 1) ?>" class="t-right">Service Charge &nbsp;</td>
                    <td class="t-right"><?php echo my_money_format($common_data['service_charge']); ?> &nbsp;</td>
                </tr>
                <tr class="bodyarea">
                    <td colspan="<?php echo (sizeof($feecodedata) + 1) ?>" class="t-right">Round off &nbsp;</td>
                    <td class="t-right"><?php echo my_money_format($common_data['round_off']); ?> &nbsp;</td>
                </tr>
                <tr class="bodyarea">
                    <td colspan="<?php echo (sizeof($feecodedata) + 1) ?>" class="t-right"><b>Paid Back (-)</b> &nbsp;</td>
                    <td class="t-right"><?php echo my_money_format($common_data['payback_amount']); ?> &nbsp;</td>
                </tr>
                <tr class="bodyarea">
                    <td colspan="<?php echo (sizeof($feecodedata) + 1) ?>" class="t-right"><b>GRAND TOTAL</b> &nbsp;</td>
                    <td class="t-right"><b><?php echo my_money_format(($grand_class_total - $transfer_total_amount) + ($common_data['service_charge'] + $common_data['round_off']) - ($common_data['payback_amount'])); ?></b> &nbsp;</td>
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
    <!-- <br>
    <h5 style="margin-top:0px;"><?php echo $collection_date; ?></h5> -->
    <h3>OTHERS (OTH)</h3>
    <table class="table table-bordered" width="100%">
        <tbody>
            <?php
            $nd_feecodedata = $nd_fee_code_data;
            $i = 1;
            $totcolamt = 0;
            $grand_class_total = 0;
            $transfer_total_amount = 0;
            if (isset($nd_details_data) && !empty($nd_details_data)) {
                foreach ($nd_details_data as $classname => $report_class) {
                    $class_total = 0;
            ?>
                    <tr class="bodyarea">
                        <td colspan="<?php echo (sizeof($nd_feecodedata) + 2) ?>" class="t-left"><b><?php echo $classname; ?></b></td>
                    </tr>
                    <?php
                    foreach ($report_class as $batch_key => $report_batch) {
                    ?>
                        <tr class="bodyarea">
                            <td colspan="<?php echo (sizeof($nd_feecodedata) + 2) ?>" class="t-left"><b><?php echo $batch_key; ?></b></td>
                        </tr>
                        <thead>
                            <tr class="header">
                                <td width="10%">DATE</td>
                                <?php
                                foreach ($nd_feecodedata as $fcodes) {
                                    if (($fcodes['feeCode'] != 'F023' && $fcodes['feeCode'] != 'F101')) {
                                ?>
                                        <td width="<?php echo (75 / sizeof($nd_feecodedata) - 2) ?>%"><?php echo $fcodes['fee_shortcode']; ?></td>
                                <?php
                                    }
                                } //$fcodes['fee_shortcode']
                                ?>
                                <td width="15%">Total</td>
                            </tr>
                        </thead>
                        <?php
                        $batch_total_amount = 0;
                        foreach ($report_batch as $batch_date_key => $report_date) {
                            $total_row_amount = 0;
                        ?>
                            <tr class="bodyarea">
                                <td><?php echo date('d-m-Y', strtotime($batch_date_key)); ?></td>
                                <?php $ic = 0;
                                foreach ($nd_feecodedata as $fcodes) {
                                    if (($fcodes['feeCode'] != 'F023' && $fcodes['feeCode'] != 'F101')) {
                                        if (isset($report_date[$fcodes['feeCode']])) {
                                            $amt = $report_date[$fcodes['feeCode']];
                                        } else {
                                            $amt = 0;
                                        }
                                        $total_row_amount += $amt;
                                ?>
                                        <td class="t-right"><?php echo my_money_format($amt); ?>&nbsp;</td>
                                <?php }
                                } ?>

                                <td class="t-right"><?php echo my_money_format($total_row_amount); ?> &nbsp;</td>
                            </tr>
                        <?php
                            $transfer_total_amount = 0; 
                            $batch_total_amount += $total_row_amount;
                        }
                        
                        ?>
                        <tr class="linetr">
                            <td colspan="<?php echo (sizeof($nd_feecodedata) + 2) ?>"></td>
                        </tr>
                        <tr class="bodyarea">
                            <td colspan="<?php echo (sizeof($nd_feecodedata) + 1) ?>" class="t-right">Batch Total &nbsp;</td>
                            <td class="t-right"><?php echo my_money_format($batch_total_amount); ?> &nbsp;</td>
                        </tr>
                    <?php
                        $class_total += $batch_total_amount;
                    } ?>

                    <?php
                    //$i++;
                    //$totcolamt = $totcolamt + $rptdata['voucher_amount'];
                    ?>
                    <tr class="linetr">
                        <td colspan="<?php echo (sizeof($nd_feecodedata) + 2) ?>"></td>
                    </tr>
                    <tr class="bodyarea">
                        <td colspan="<?php echo (sizeof($nd_feecodedata) + 1) ?>" class="t-right">Class Total &nbsp;</td>
                        <td class="t-right"><?php echo my_money_format($class_total) ?> &nbsp;</td>
                    </tr>
                <?php
                    $grand_class_total += $class_total;
                } ?>
                <tr class="linetr">
                    <td colspan="<?php echo (sizeof($nd_feecodedata) + 2) ?>"></td>
                </tr>
                <tr class="bodyarea">
                    <td colspan="<?php echo (sizeof($nd_feecodedata) + 1) ?>" class="t-right"><b>GRAND TOTAL</b> &nbsp;</td>
                    <td class="t-right"><b><?php echo my_money_format($grand_class_total); ?></b> &nbsp;</td>
                </tr>
                <!-- <tr class="bodyarea">
                    <td colspan="<?php echo (sizeof($nd_feecodedata) + 1) ?>" class="t-right"><b>Transfer Amount (-)</b> &nbsp;</td>
                    <td class="t-right"><?php echo $transfer_total_amount; ?> &nbsp;</td>
                </tr>
                <tr class="bodyarea">
                    <td colspan="<?php echo (sizeof($nd_feecodedata) + 1) ?>" class="t-right">Service Charge &nbsp;</td>
                    <td class="t-right"><?php echo $common_data['service_charge']; ?> &nbsp;</td>
                </tr>
                <tr class="bodyarea">
                    <td colspan="<?php echo (sizeof($nd_feecodedata) + 1) ?>" class="t-right">Round off &nbsp;</td>
                    <td class="t-right"><?php echo $common_data['round_off']; ?> &nbsp;</td>
                </tr>
                <tr class="bodyarea">
                    <td colspan="<?php echo (sizeof($nd_feecodedata) + 1) ?>" class="t-right">Grand Total &nbsp;</td>
                    <td class="t-right"><?php echo ($grand_class_total - $transfer_total_amount) + $common_data['service_charge'] + $common_data['round_off']; ?> &nbsp;</td>
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