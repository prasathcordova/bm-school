<html>

<head></head>

<body style="background: #fff !important;">
    <?php echo $this->load->view('report/pdf/header') ?>
    <table class="table table-bordered" width="100%">
        <?php
        $i = 1;
        $totcolamt = 0;
        if (isset($details_data) && !empty($details_data)) {
        ?>
            <tr class="header">
                <td style="width:5% !important;">Sl.No.</td>
                <th>Admn No.</th>
                <th>Student Name</th>
                <th>Class</th>
                <th>Batch</th>
                <th>Voucher Date</th>
                <th>Voucher Code</th>
                <th>Online Txn Date</th>
                <th>Online Txn Id</th>
                <th>Amount</th>
            </tr>

            <?php
            foreach ($details_data as $rptdata) {
            ?>
                <tr class="bodyarea">
                    <td><?php echo $i; ?></td>
                    <td><?php echo $rptdata['Admn_No'] ?></td>
                    <td><?php echo $rptdata['student_name'] ?></td>
                    <td><?php echo $rptdata['CLASS_NAME'] ?></td>
                    <td><?php echo $rptdata['Batch_Name'] ?></td>
                    <td><?php echo date('d-m-Y', strtotime($rptdata['voucher_date'])) ?></td>
                    <td style="text-align: center;padding:2px;"><?php echo $rptdata['voucher_code'] ?></td>
                    <td style="text-align: center;padding:2px;"><?php echo date('d-m-Y', strtotime($rptdata['transaction_date'])) ?></td>
                    <td style="text-align: center;padding:2px;"><?php echo $rptdata['online_transaction_id'] ?></td>
                    <td style="text-align: right; padding-right:5px;"><?php echo my_money_format($rptdata['amt_paid']);  ?></td>
                </tr>
            <?php
                $i++;
                $totcolamt = $totcolamt + $rptdata['amt_paid'];
            }
            ?>
        <?php
        }
        ?>
        <tr class="linetr">
            <td colspan="9"></td>
        </tr>
        <tr class="footer">
            <td style="text-align: right; padding-right:2px;" colspan="9">Total Amount&nbsp;&nbsp;</td>
            <td style="text-align: right; padding-right:5px;"><?php echo my_money_format($totcolamt); ?></td>
        </tr>
    </table>
</body>

</html>