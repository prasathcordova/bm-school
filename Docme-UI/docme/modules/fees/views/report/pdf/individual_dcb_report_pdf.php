<html>

<head></head>

<body style="background: #fff !important;">
    <?php echo $this->load->view('report/pdf/header') ?>
    <!-- <br> -->
    <table class="table table-bordered" width="100%">
        <thead>
            <?php $date = date("d-m-Y"); ?>
            <tr class="header">
                <?php
                $student_status = '';
                if (trim($details_data['student_data']['StatusFlag']) == 'L') $student_status = ' - <span style="text-wight:bold; float:right; color:#EF5352">Long Absentee&nbsp;</span>';
                elseif (trim($details_data['student_data']['StatusFlag']) == 'O') $student_status = ' - <span style="text-wight:bold; float:right;">Official&nbsp;</span>';
                elseif (trim($details_data['student_data']['StatusFlag']) == 'T') $student_status = ' - <span style="text-wight:bold; float:right;">TC Issued&nbsp;</span>';
                ?>
                <td style="text-align:left;" colspan="5"><span>&nbsp;Student Name</span> : <?php echo $details_data['student_data']['student_name']; ?> <?php echo $student_status ?></td>
                <td style="text-align:left;" colspan="5"><span>&nbsp;Admission Number</span> : <?php echo $details_data['student_data']['Admn_No']; ?></td>
            </tr>
            <tr class="header">
                <td style="text-align:left;" colspan="5"><span>&nbsp;Batch</span> : <?php echo $details_data['student_data']['batch_name']; ?></td>
                <td style="text-align:left;" colspan="5"><span>&nbsp;Date</span> : <?php echo $date; ?></td>
            </tr>
            <tr class="linetr">
                <td colspan="10"></td>
            </tr>
        </thead>
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
            foreach ($details_data['report_data'] as $month => $report_lvl1) {
            ?>
                <tr class="bodyarea">
                    <td colspan="10" class="t-left"><b>Month : </b><?php echo date('M Y', strtotime($month)); ?></td>
                </tr>
                <?php
                foreach ($report_lvl1['feecode'] as $fdata) {
                ?>
                    <tr class="bodyarea">
                        <td class="t-left"><?php echo $fdata['feecode_desc']; ?></td>
                        <td class="t-right"><?php echo my_money_format($fdata['demand']); ?>&nbsp;</td>
                        <td class="t-right"><?php echo my_money_format($fdata['concession']); ?>&nbsp;</td>
                        <td class="t-right"><?php echo my_money_format($fdata['excemption']); ?>&nbsp;</td>
                        <td class="t-right"><?php echo my_money_format($fdata['net_due']); ?>&nbsp;</td>
                        <td class="t-right"><?php echo my_money_format($fdata['advance']); ?>&nbsp;</td>
                        <td class="t-right"><?php echo my_money_format($fdata['regular']); ?>&nbsp;</td>
                        <td class="t-right"><?php echo my_money_format($fdata['balance']); ?>&nbsp;</td>
                        <td class="t-right"><?php echo my_money_format($fdata['arrear']); ?>&nbsp;</td>
                        <td class="t-right">&nbsp;&nbsp;</td>
                    </tr>
                <?php
                }
                ?>
            <?php
                $i++;
            }
            ?>
            <tr class="linetr">
                <td colspan="10"></td>
            </tr>
            <tr class="footer">
                <td class="t-right">Total &nbsp;&nbsp;</td>
                <td class="t-right"><?php echo my_money_format($details_data['summary']['total_demand']); ?>&nbsp;</td>
                <td class="t-right"><?php echo my_money_format($details_data['summary']['total_concession']); ?>&nbsp;</td>
                <td class="t-right"><?php echo my_money_format($details_data['summary']['total_excemption']); ?>&nbsp;</td>
                <td class="t-right"><?php echo my_money_format($details_data['summary']['total_net_due']); ?>&nbsp;</td>
                <td class="t-right"><?php echo my_money_format($details_data['summary']['total_advance']); ?>&nbsp;</td>
                <td class="t-right"><?php echo my_money_format($details_data['summary']['total_regular']); ?>&nbsp;</td>
                <td class="t-right"><?php echo my_money_format($details_data['summary']['total_balance']); ?>&nbsp;</td>
                <td class="t-right"><?php echo my_money_format($details_data['summary']['total_arrear']); ?>&nbsp;</td>
                <td class="t-right">&nbsp;&nbsp;</td>
            </tr>
        </tbody>
    </table>
</body>

</html>