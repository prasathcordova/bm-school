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
            $totcolamt = 0;
            $totvatamt = 0;
            $batch_total = 0;
            $total_array = array();
            $row_total_amtt = 0;
            if (is_array($report_student_data) && !empty($report_student_data)) {
                foreach ($report_student_data as $acd_year => $acd_year_base_data) {
                    $row_total_amtt = 0;
                    echo '<tr class="bodyarea"><td colspan="3" style="text-align:left;"><b>&nbsp;Academic Year : ' . $acd_year . '</b></td></tr>';
                    foreach ($acd_year_base_data as $batch => $rpt_data) {
                        $i = 1;
                        echo '<tr class="bodyarea"><td colspan="3" style="text-align:left;"><b>&nbsp;' . $batch . '</b></td></tr>';

                        foreach ($rpt_data as $admn_no => $rpt_lvl1_data) {
                            $student_total = 0;
                            $student_data = $rpt_lvl1_data['student_data'];
            ?>
                            <tr class="bodyarea">
                                <td class="t-left" width="3%" colspan="2">Student Name : <b><?php echo $student_data['student_name'] ?></td>
                                <td class="t-left" width="8%" colspan="1">Admission No. : <b><?php echo $student_data['admn_no'] ?></td>
                            </tr>
                            <tr class="header">
                                <td width="10%">Sl.No</td>
                                <td width="30%">Month</td>
                                <td width="30%">Fee Amount</td>
                            </tr>
                            <?php
                            foreach ($rpt_lvl1_data['arrear'] as $key_month => $rpt_arrear_data) {
                            ?>
                            <?php
                                echo '<tr class="bodyarea">';
                                echo '<td>' . $i++ . '</td>';
                                echo '<td>' . date('M Y', strtotime($key_month)) . '</td>';
                                $fee_code_total = 0;
                                $flag = 1;
                                foreach ($rpt_arrear_data['fee_data'] as $key => $value) {
                                    $flag = 2;
                                    echo '<td style="text-align:right;">' . my_money_format($value['amount']) . '&nbsp;</td>';
                                    $fee_code_total = $fee_code_total + $value['amount'];
                                    $row_total_amtt = $row_total_amtt + $fee_code_total;
                                    $student_total += $value['amount'];
                                }
                                echo '</tr>';
                            }
                            ?>
                            <tr class="bodyarea">
                                <td colspan="2" class="t-right">
                                    <span style="font-weight:bold;">Student Total</span>&nbsp;
                                </td>
                                <?php
                                echo '<td style="text-align:right;font-size: 15px; font-weight:bold;">' . my_money_format($student_total) . '&nbsp;</td>';
                                ?>
                            </tr>
                            <tr class="linetr">
                                <td colspan="3"></td>
                            </tr>
                    <?php
                        }
                    }
                    ?>
                    <!-- <tr class="linetr">
                    <td colspan="3"></td>
                </tr> -->
                    <tr class="bodyarea">
                        <td colspan="2" class="t-right">
                            <span style="font-size: 15px; font-weight:bold;">Total</span>&nbsp;
                        </td>
                        <?php
                        echo '<td style="text-align:right;font-size: 15px; font-weight:bold;">' . my_money_format($row_total_amtt) . '&nbsp;</td>';
                        ?>
                    </tr>
            <?php
                }
            }
            ?>
        </tbody>
    </table>
</body>

</html>