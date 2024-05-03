<html>

<head></head>

<body style="background: #fff !important;">
    <?php echo $this->load->view('report/pdf/header') ?>
    <!-- <br>
    <h5 style="margin-top:0px;"><?php echo $collection_date; ?></h5> -->
    <table class="table table-bordered" width="100%">
        <thead>
            <tr class="header">
                <th>Sl.No</th>
                <th>Voucher Code</th>
                <th>Voucher Date</th>
                <th>Amount</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $i = 1;
            $totcolamt = 0;
            if (isset($details_data) && !empty($details_data)) {
                foreach ($details_data as $rptdata) {
            ?>
                    <tr class="bodyarea">
                        <td><?php echo $i; ?></td>
                        <td><?php echo $rptdata['voucher_code'] ?></td>
                        <td><?php echo date('d-m-Y', strtotime($rptdata['voucher_date'])) ?></td>
                        <td style="text-align: right; padding-right:10px;"><?php echo my_money_format($rptdata['amount']); ?></td>
                    </tr>
            <?php
                    $i++;
                    $totcolamt = $totcolamt + $rptdata['amount'];
                }
            }
            ?>
            <tr class="linetr">
                <td colspan="4"></td>
            </tr>
            <tr class="footer">
                <td style="text-align: right; padding-right:10px;" colspan="3">Total &nbsp;&nbsp;</td>
                <td style="text-align: right; padding-right:10px;"><?php echo my_money_format($totcolamt); ?></td>
            </tr>
        </tbody>
    </table>

</body>

</html>