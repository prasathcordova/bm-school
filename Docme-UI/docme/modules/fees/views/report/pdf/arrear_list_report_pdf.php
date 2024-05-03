<html>

<head></head>

<body style="background: #fff !important;">
    <?php echo $this->load->view('report/pdf/header') ?>
    <!-- <br>
    <h5 style="margin-top:0px;"><?php echo $collection_date; ?></h5> -->
    <?php
    $fee_code_base_data = $details_data['fee_code_data'];
    $fee_code_base_data_nd = $details_data['non_demandable_feecodes'];
    $report_student_data = $details_data['report_data'];
    $report_student_data_nd = $details_data['report_data_nd'];
    ?>
    <table class="table table-bordered" width="100%">
        <tbody>
            <?php
            $grand_arrear_total = 0;
            $i = 1;
            $totcolamt = 0;
            $totvatamt = 0;
            $batch_total = 0;
            $total_array = array();
            if (is_array($report_student_data) && !empty($report_student_data)) {
                foreach ($report_student_data as $acd_year => $acd_year_base_data) {
                    $row_total_amtt = 0;
                    echo '<tr class="bodyarea"><td colspan=' . count($fee_code_base_data) . ' style="text-align:left;"><b>&nbsp;Academic Year : ' . $acd_year . '</b></td></tr>';
                    foreach ($acd_year_base_data as $batch => $rpt_data) {
                        echo '<tr class="bodyarea"><td colspan=' . count($fee_code_base_data) . ' style="text-align:left;"><b>&nbsp;' . $batch . '</b></td></tr>';
            ?>
                        <!-- <thead> -->
                        <tr class="header">
                            <td width="5%">Sl.No</td>
                            <td width="8%">Admission No.</td>
                            <td width="20%">Student Name</td>
                            <td width="5%">Month</td>
                            <?php
                            $widthremain = 52;
                            $tdcount = 5;
                            foreach ($fee_code_base_data as $fcodes_temp) {
                                if ($fcodes_temp['editable'] == 1) {
                            ?>
                                    <td width="<?php echo ($widthremain / (count($fee_code_base_data))); ?>" style="text-align:right;"><?php echo $fcodes_temp['fee_shortcode']; ?>&nbsp;</td>
                            <?php
                                }
                            }
                            ?>
                            <td width="10%">Total</td>
                        </tr>
                        <!-- </thead> -->
                    <?php
                        foreach ($rpt_data as $admn_no => $rpt_lvl1_data) {
                            $student_data = $rpt_lvl1_data['student_data'];
                            foreach ($rpt_lvl1_data['arrear'] as $key_month => $rpt_arrear_data) {
                                echo '<tr class="bodyarea">';
                                echo '<td>' . $i++ . '</td>';
                                echo '<td>' . $student_data['admn_no'] . '</td>';
                                echo '<td>' . $student_data['student_name'] . '</td>';
                                echo '<td>' . date('M Y', strtotime($key_month)) . '</td>';
                                $fee_code_total = 0;
                                foreach ($fee_code_base_data as $fcodes_temp) {
                                    if ($fcodes_temp['editable'] == 1) {
                                        $flag = 1;
                                        foreach ($rpt_arrear_data['fee_data'] as $key => $value) {
                                            if ($key == $fcodes_temp['feeCode']) {
                                                $flag = 2;
                                                echo '<td style="text-align:right;">' . my_money_format($value['amount']) . '&nbsp;</td>';
                                                $fee_code_total = $fee_code_total + $value['amount'];
                                                $batch_total = $batch_total + $value['amount'];
                                                if (!isset($total_array[$acd_year][$fcodes_temp['feeCode']]['total']))
                                                    $total_array[$acd_year][$fcodes_temp['feeCode']]['total'] =  $value['amount'];
                                                else
                                                    $total_array[$acd_year][$fcodes_temp['feeCode']]['total'] +=  $value['amount'];
                                            }
                                        }
                                        if ($flag == 1) {
                                            echo '<td style="text-align:right;">' . my_money_format(0) . '&nbsp;</td>';
                                        }
                                    }
                                }
                                echo '<td style="text-align:right;"><b>' . my_money_format($fee_code_total) . '</b>&nbsp;</td>';
                                echo '</tr>';
                            }
                        }
                    }
                    ?>
                    <tr class="linetr">
                        <td colspan="<?php echo count($fee_code_base_data); ?>"></td>
                    </tr>
                    <tr class="bodyarea">
                        <td colspan="4" class="t-right">
                            <span style="font-weight:bold;">Total</span>&nbsp;
                        </td>
                        <?php
                        foreach ($fee_code_base_data as $fcodes_header4) {
                            if ($fcodes_header4['editable'] == 1) {
                                $cash_t = (isset($total_array[$acd_year][$fcodes_header4['feeCode']]['total']) ? $total_array[$acd_year][$fcodes_header4['feeCode']]['total'] : 0);
                                echo '<td style="text-align:right;font-weight:bold;">' . my_money_format($cash_t) . '&nbsp;</td>';
                                $row_total_amtt = $row_total_amtt + $cash_t;
                            }
                        }
                        echo '<td style="text-align:right;font-weight:bold;">' . my_money_format($row_total_amtt) . '&nbsp;</td>';
                        ?>
                    </tr>
                    <!-- <tr class="footer">
                    <td class="t-right" style="text-align:right;" colspan="4">Batch Total&nbsp;&nbsp;</td>
                    <td colspan="<?php echo count($fee_code_base_data); ?>" style="text-align:right;"><?php echo my_money_format($batch_total); ?>&nbsp;&nbsp;</td>
                </tr> -->
            <?php
                    $grand_arrear_total += $row_total_amtt;
                }
            }
            ?>
            <tr class="footer">
                <td class="t-right" style="text-align:right;" colspan="<?php echo (count($fee_code_base_data) - 1); ?>">Total Arrear (Current + Prev. Year(s))&nbsp;&nbsp;</td>
                <td style="text-align:right;"><?php echo my_money_format($grand_arrear_total); ?>&nbsp;&nbsp;</td>
            </tr>
            <!-- <tr class="footer">
                <td class="t-right" style="text-align:right;" colspan="6"><?php echo print_tax_vat(); ?> Collected&nbsp;&nbsp;</td>
                <td colspan="2" style="text-align:right;"><?php echo number_format(($totvatamt * 100) / 100, 4, '.', ''); ?>&nbsp;&nbsp;</td>
            </tr>
            <tr class="linetr">
                <td colspan="8"></td>
            </tr>
            <tr class="footer">
                <td class="t-right" style="text-align:right;" colspan="6">Grand Total &nbsp;&nbsp;</td>
                <td colspan="2" style="text-align:right;"><?php echo number_format((($totcolamt + $totvatamt) * 100) / 100, 4, '.', ''); ?>&nbsp;&nbsp;</td>
            </tr> -->
        </tbody>
    </table>
    <pagebreak />
    <!-- <br>
    <h5 style="margin-top:0px;"><?php echo $collection_date; ?></h5> -->
    <h3>OTHER (OTH)</h3>

    <table class="table table-bordered" width="100%">
        <tbody>
            <?php
            $i = 1;
            $totcolamt = 0;
            $totvatamt = 0;
            $batch_total = 0;
            $total_array = array();
            if (is_array($report_student_data_nd) && !empty($report_student_data_nd)) {
                foreach ($report_student_data_nd as $acd_year => $acd_year_base_data_nd) {
                    $row_total_amtt = 0;
                    echo '<tr class="bodyarea"><td colspan=' . count($fee_code_base_data_nd) . ' style="text-align:left;"><b>&nbsp;Academic Year : ' . $acd_year . '</b></td></tr>';
                    foreach ($acd_year_base_data_nd as $batch => $rpt_data_ar) {
                        // echo '<tr class="bodyarea"><td colspan=' . count($fee_code_base_data_nd) . ' style="text-align:left;"><b>&nbsp;' . $batch . '</b></td></tr>';
            ?>
                        <tr class="bodyarea">
                            <td colspan=<?php echo count($fee_code_base_data_nd) + 5 ?> style="text-align:left;"><b>&nbsp;<?php echo $batch ?></b></td>
                        </tr>
                        <thead>
                            <tr class="header">
                                <td width="3%">Sl.No</td>
                                <td width="8%">Admission No.</td>
                                <td width="9%">Student Name</td>
                                <td width="5%">Month</td>
                                <?php
                                $widthremain = 65;
                                $tdcount = 5;
                                foreach ($fee_code_base_data_nd as $fcodes_temp) {
                                    if ($fcodes_temp['editable'] == 1) {
                                ?>
                                        <td style="text-align:right; width:<?php echo ($widthremain / (count($fee_code_base_data_nd))); ?>% !important;"><?php echo $fcodes_temp['fee_shortcode']; ?>&nbsp;</td>
                                <?php
                                    }
                                }
                                ?>
                                <td width="10%">Total</td>
                            </tr>
                        </thead>
                <?php
                        foreach ($rpt_data_ar as $admn_no => $rpt_lvl1_data_ar) {
                            $student_data = $rpt_lvl1_data_ar['student_data'];
                            foreach ($rpt_lvl1_data_ar['arrear'] as $key_month => $rpt_arrear_data) {
                                echo '<tr class="bodyarea">';
                                echo '<td>' . $i++ . '</td>';
                                echo '<td>' . $student_data['admn_no'] . '</td>';
                                echo '<td>' . $student_data['student_name'] . '</td>';
                                echo '<td>' . date('M Y', strtotime($key_month)) . '</td>';
                                $fee_code_total = 0;
                                // $row_total_amtt = 0;
                                foreach ($fee_code_base_data_nd as $fcodes_temp) {
                                    if ($fcodes_temp['editable'] == 1) {
                                        $flag = 1;
                                        foreach ($rpt_arrear_data['fee_data'] as $key => $value) {
                                            if ($key == $fcodes_temp['feeCode']) {
                                                $flag = 2;
                                                echo '<td style="text-align:right;">' . my_money_format($value['amount']) . '&nbsp;</td>';
                                                $fee_code_total = $fee_code_total + $value['amount'];
                                                $batch_total = $batch_total + $value['amount'];
                                                if (!isset($total_array[$fcodes_temp['feeCode']]['total']))
                                                    $total_array[$fcodes_temp['feeCode']]['total'] =  $value['amount'];
                                                else
                                                    $total_array[$fcodes_temp['feeCode']]['total'] +=  $value['amount'];
                                            }
                                        }
                                        if ($flag == 1) {
                                            echo '<td style="text-align:right;">' . my_money_format(0) . '&nbsp;</td>';
                                        }
                                    }
                                }
                                echo '<td style="text-align:right;"><b>' . my_money_format($fee_code_total) . '</b>&nbsp;</td>';
                                echo '</tr>';
                            }
                        }
                    }
                }
                ?>
                <tr class="linetr">
                    <td colspan="<?php echo count($fee_code_base_data_nd) + 5; ?>"></td>
                </tr>
                <tr class="bodyarea">
                    <td colspan="4" class="t-right"><span style="font-size: 15px; font-weight:bold;">Total</span>&nbsp;</td>
                    <?php
                    foreach ($fee_code_base_data_nd as $fcodes_header4) {
                        if ($fcodes_header4['editable'] == 1) {
                            $cash_t = (isset($total_array[$fcodes_header4['feeCode']]['total']) ? $total_array[$fcodes_header4['feeCode']]['total'] : 0);
                            echo '<td style="text-align:right;font-size: 15px; font-weight:bold;">' . my_money_format($cash_t) . '&nbsp;</td>';
                            $row_total_amtt = $row_total_amtt + $cash_t;
                        }
                    }
                    echo '<td style="text-align:right;font-size: 15px; font-weight:bold;">' . my_money_format($row_total_amtt) . '&nbsp;</td>';
                    ?>
                </tr>
                <!-- <tr class="linetr">
                    <td colspan="7"></td>
                </tr>
                <tr class="footer">
                    <td class="t-right" style="text-align:right;" colspan="5">Batch Total&nbsp;&nbsp;</td>
                    <td colspan="2" style="text-align:right;"><?php echo my_money_format($batch_total); ?>&nbsp;&nbsp;</td>
                </tr> -->
            <?php
            } else {
            ?>
                <tr class="bodyarea">
                    <td colspan="<?php echo count($fee_code_base_data_nd) + 5; ?>">No Other Fees are Demanded for any Student Currently</td>
                </tr>
            <?php
            }
            ?>
            <!-- <tr class="footer">
                <td class="t-right" style="text-align:right;" colspan="6"><?php echo print_tax_vat(); ?> Collected&nbsp;&nbsp;</td>
                <td colspan="2" style="text-align:right;"><?php echo number_format(($totvatamt * 100) / 100, 4, '.', ''); ?>&nbsp;&nbsp;</td>
            </tr>
            <tr class="linetr">
                <td colspan="8"></td>
            </tr>
            <tr class="footer">
                <td class="t-right" style="text-align:right;" colspan="6">Grand Total &nbsp;&nbsp;</td>
                <td colspan="2" style="text-align:right;"><?php echo number_format((($totcolamt + $totvatamt) * 100) / 100, 4, '.', ''); ?>&nbsp;&nbsp;</td>
            </tr> -->
        </tbody>
    </table>
    <pagebreak />
    <!-- <br>
    <h5 style="margin-top:0px;"><?php echo $collection_date; ?></h5> -->
    <div style="float:left; width:24%; margin-right:1%;">
        <h3>Fee Code Descriptions</h3>
        <table class="table table-bordered" width="100%">
            <tbody>
                <?php
                foreach ($fee_code_base_data as $fcodes_header) {
                    if ($fcodes_header['editable'] == 1) {
                ?>
                        <tr class="bodyarea">
                            <td class="t-right"> <?php echo $fcodes_header['fee_shortcode']; ?>&nbsp;</td>
                            <td class="t-left">&nbsp; <?php echo $fcodes_header['description']; ?></td>
                        </tr>
                <?php
                    }
                }
                ?>
            </tbody>
        </table>
    </div>
    <div style="float:left; width:24%; margin-left:1%;">
        <h3>Other Fee Codes (OTH)</h3>
        <table class="table table-bordered" width="100%">
            <tbody>
                <?php
                foreach ($fee_code_base_data_nd as $fcodes_header3) {
                    if ($fcodes_header3['editable'] == 1) {
                ?>
                        <tr class="bodyarea">
                            <td class="t-right"> <?php echo $fcodes_header3['fee_shortcode']; ?>&nbsp;</td>
                            <td class="t-left">&nbsp; <?php echo $fcodes_header3['description']; ?></td>
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