<html>

<head></head>
<?php
$g_total_demand = 0;
$g_total_concession = 0;
$g_total_excemption = 0;
$g_total_net_due = 0;
$g_total_advance = 0;
$g_total_regular = 0;
$g_total_balance = 0;
$g_total_arrear = 0;
?>

<body style="background: #fff !important;">
    <?php echo $this->load->view('report/pdf/header') ?>
    <!-- <br> -->
    <?php
    $rowcount = count($details_data);
    $cc = 0;
    foreach ($details_data as $report_data) {
    ?>
        <table class="table table-bordered" width="100%" style="font-size: 10px;">
            <?php $date = date("d-m-Y"); ?>
            <tr class="header">
                <?php
                $student_status = '';
                if (trim($report_data['student_data']['StatusFlag']) == 'L') $student_status = ' - <span style="text-wight:bold; float:right; color:#EF5352">Long Absentee&nbsp;</span>';
                elseif (trim($report_data['student_data']['StatusFlag']) == 'O') $student_status = ' - <span style="text-wight:bold; float:right;">Official&nbsp;</span>';
                ?>
                <td style="text-align:left;" colspan="5"><span>&nbsp;Student Name</span> : <?php echo $report_data['student_data']['student_name']; ?><?php echo $student_status ?></td>
                <td style="text-align:left;" colspan="5"><span>&nbsp;Admission Number</span> : <?php echo $report_data['student_data']['Admn_No']; ?></td>
            </tr>
            <tr class="header">
                <td style="text-align:left;" colspan="5"><span>&nbsp;Batch</span> : <?php echo $report_data['student_data']['batch_name']; ?></td>
                <td style="text-align:left;" colspan="5"><span>&nbsp;Date</span> : <?php echo $date; ?></td>
            </tr>
            <tr class="linetr">
                <td colspan="10"></td>
            </tr>
            <thead>
                <tr class="header">
                    <td rowspan="2" width="10%">Fee Details</td>
                    <td rowspan="2" width="10%">Demanded Fees</td>
                    <td colspan="2" width="20%">Adjustments</td>
                    <td rowspan="2" width="8%">Net Due</td>
                    <td colspan="2" width="20%">Receipts</td>
                    <td rowspan="2" width="8%">Balance</td>
                    <td rowspan="2" width="8%">Arrear</td>
                    <td rowspan="2" width="16%">Remarks</td>
                </tr>
                <tr class="header">
                    <td>Concession</td>
                    <td>Exemption</td>
                    <td>Advance</td>
                    <td>Regular</td>
                </tr>
            </thead>
            <tbody>
                <?php
                $i = 1;
                foreach ($report_data['report_data'] as $month => $report_lvl1) {
                ?>
                    <tr class="bodyarea">
                        <td colspan="10" class="t-left"><b>Month : </b><?php echo date('M Y', strtotime($month)); ?></td>
                    </tr>
                    <?php
                    foreach ($report_lvl1['feecode'] as $fdata) {
                    ?>
                        <tr class="bodyarea">
                            <td class="t-left"><?php echo $fdata['feecode_desc']; ?></td>
                            <td style="text-align:right;"><?php echo my_money_format($fdata['demand']); ?>&nbsp;</td>
                            <td style="text-align:right;"><?php echo my_money_format($fdata['concession']); ?>&nbsp;</td>
                            <td style="text-align:right;"><?php echo my_money_format($fdata['excemption']); ?>&nbsp;</td>
                            <td style="text-align:right;"><?php echo my_money_format($fdata['net_due']); ?>&nbsp;</td>
                            <td style="text-align:right;"><?php echo my_money_format($fdata['advance']); ?>&nbsp;</td>
                            <td style="text-align:right;"><?php echo my_money_format($fdata['regular']); ?>&nbsp;</td>
                            <td style="text-align:right;"><?php echo my_money_format($fdata['balance']); ?>&nbsp;</td>
                            <td style="text-align:right;"><?php echo my_money_format($fdata['arrear']); ?>&nbsp;</td>
                            <td style="text-align:right;">&nbsp;&nbsp;</td>
                        </tr>
                    <?php
                    }
                    ?>
                <?php
                    $i++;
                }
                ?>
                <!--<tr class="linetr"><td colspan="10"></td></tr>-->
                <tr class="footer">
                    <td class="t-right">Total &nbsp;&nbsp;</td>
                    <td style="text-align:right;"><?php echo my_money_format($report_data['summary']['total_demand']);
                                                    $g_total_demand += $report_data['summary']['total_demand']; ?>&nbsp;</td>
                    <td style="text-align:right;"><?php echo my_money_format($report_data['summary']['total_concession']);
                                                    $g_total_concession += $report_data['summary']['total_concession']; ?>&nbsp;</td>
                    <td style="text-align:right;"><?php echo my_money_format($report_data['summary']['total_excemption']);
                                                    $g_total_excemption += $report_data['summary']['total_excemption']; ?>&nbsp;</td>
                    <td style="text-align:right;"><?php echo my_money_format($report_data['summary']['total_net_due']);
                                                    $g_total_net_due += $report_data['summary']['total_net_due']; ?>&nbsp;</td>
                    <td style="text-align:right;"><?php echo my_money_format($report_data['summary']['total_advance']);
                                                    $g_total_advance += $report_data['summary']['total_advance']; ?>&nbsp;</td>
                    <td style="text-align:right;"><?php echo my_money_format($report_data['summary']['total_regular']);
                                                    $g_total_regular += $report_data['summary']['total_regular']; ?>&nbsp;</td>
                    <td style="text-align:right;"><?php echo my_money_format($report_data['summary']['total_balance']);
                                                    $g_total_balance += $report_data['summary']['total_balance']; ?>&nbsp;</td>
                    <td style="text-align:right;"><?php echo my_money_format($report_data['summary']['total_arrear']);
                                                    $g_total_arrear += $report_data['summary']['total_arrear']; ?>&nbsp;</td>
                    <td style="text-align:right;">&nbsp;&nbsp;</td>
                </tr>
                <tr class="linetr">
                    <td colspan="10">&nbsp;&nbsp;</td>
                </tr>
                <?php
                ++$cc;
                if ($cc == $rowcount) {
                ?>
                    <tr class="footer">
                        <td class="t-right">Grand Total &nbsp;&nbsp;</td>
                        <td style="text-align:right;"><?php echo my_money_format($g_total_demand); ?>&nbsp;</td>
                        <td style="text-align:right;"><?php echo my_money_format($g_total_concession); ?>&nbsp;</td>
                        <td style="text-align:right;"><?php echo my_money_format($g_total_excemption); ?>&nbsp;</td>
                        <td style="text-align:right;"><?php echo my_money_format($g_total_net_due); ?>&nbsp;</td>
                        <td style="text-align:right;"><?php echo my_money_format($g_total_advance); ?>&nbsp;</td>
                        <td style="text-align:right;"><?php echo my_money_format($g_total_regular); ?>&nbsp;</td>
                        <td style="text-align:right;"><?php echo my_money_format($g_total_balance); ?>&nbsp;</td>
                        <td style="text-align:right;"><?php echo my_money_format($g_total_arrear); ?>&nbsp;</td>
                        <td style="text-align:right;">&nbsp;&nbsp;</td>
                    </tr>
                <?php
                }
                ?>
            </tbody>
        </table>
    <?php
    }
    ?>
</body>

</html>