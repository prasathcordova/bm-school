<html>

<head></head>

<body style="background: #fff !important;">
    <?php echo $this->load->view('report/pdf/header') ?>
    <table class="table table-bordered" width="100%">
        <?php
        $i = 1;
        $totcolamt = 0;
        $totbch = 0;
        if (isset($details_data) && !empty($details_data)) {
        ?>
            <tr class="header">
                <td style="width:5% !important;">Sl.No.</td>
                <th>Admn No.</th>
                <th>Student Name</th>
                <th>Class</th>
                <th>Voucher Date</th>
                <th>Voucher Code</th>
                <th>Trans. Type</th>
                <th>Online Txn Date</th>
                <th>Online Txn Id</th>
                <th>Amount</th>
            </tr>

            <?php
            foreach ($details_data as $rptdata) {
            ?>
                <tr class="bodyarea">
                    <td width="5%"><?php echo $i; ?></td>
                    <td width="10%"><?php echo $rptdata['admn_no'] ?></td>
                    <td width="20%"><?php echo $rptdata['student_name'] ?></td>
                    <td width="10%"><?php echo $rptdata['class'] ?></td>
                    <td><?php echo date('d-m-Y', strtotime($rptdata['voucher_date'])) ?></td>
                    <td style="text-align: center; padding-right:10px;"><?php echo $rptdata['voucher_code'] ?></td>
                    <td><?php echo $rptdata['trans_type'] ?></td>
                    <td><?php echo $rptdata['trans_type'] == 'O' ? date('d-m-Y', strtotime($rptdata['online_transaction_date'])) : '-' ?></td>
                    <td><?php echo $rptdata['trans_type'] == 'O' ? $rptdata['online_transaction_id'] : '-' ?></td>
                    <td style="text-align: right; padding-right:10px;"><?php echo my_money_format($rptdata['amount'] - $rptdata['service_charge']);  ?></td>
                </tr>
            <?php
                $i++;
                $totcolamt  = $totcolamt + $rptdata['amount'];
                $totbch     = $totbch + $rptdata['service_charge'];
            }
            ?>
        <?php
        }
        ?>
        <tr class="linetr">
            <td colspan="10"></td>
        </tr>
        <tr class="footer">
            <td style="text-align: right; padding-right:10px;" colspan="8">Total Amount&nbsp;&nbsp;</td>
            <td style="text-align: right; padding-right:10px;" colspan="2"><?php echo my_money_format($totcolamt); ?></td>
        </tr>
        <tr class="footer">
            <td style="text-align: right; padding-right:10px;" colspan="8">Service Charge&nbsp;&nbsp;</td>
            <td style="text-align: right; padding-right:10px;" colspan="2"><?php echo my_money_format($totbch); ?></td>
        </tr>
        <tr class="footer">
            <td style="text-align: right; padding-right:10px;" colspan="8">Net Total&nbsp;&nbsp;</td>
            <td style="text-align: right; padding-right:10px;" colspan="2"><?php echo my_money_format($totcolamt + $totbch); ?></td>
        </tr>
    </table>
</body>

</html>