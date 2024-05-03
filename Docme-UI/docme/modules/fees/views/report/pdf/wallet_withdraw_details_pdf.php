<html>

<head>
    <title style="color:hotpink"><?php echo $title; ?></title>
</head>

<body style="background: #fff !important;">
    <?php echo $this->load->view('report/pdf/header') ?>
    <!-- <br>
    <h5 style="margin-top:0px;"><?php echo $collection_date; ?></h5> -->
    <table class="table table-bordered" width="100%">
        <thead>
            <tr class="header">
                <td>Sl.No.</td>
                <td>Admission No.</td>
                <td>Student Name</td>
                <td>Voucher</td>
                <td>Voucher Date</td>
                <td>Amount</td>
                <!-- <td>Ser. Charge(if any)</td> -->
                <!-- <td>Total</td> -->
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
                        <td width="5%"><?php echo $i; ?></td>
                        <td width="10%"><?php echo $rptdata['Admn_No'] ?></td>
                        <td width="25%"><?php echo $rptdata['First_Name'] ?></td>
                        <td width="20%"><?php echo $rptdata['voucher_number'] ?></td>
                        <td width="20%"><?php echo date('d-m-Y', strtotime($rptdata['TRANSACTION_DATE'])) ?></td>
                        <td width="20%" class="t-right"><?php echo my_money_format($rptdata['transaction_amount']) ?>&nbsp;</td>
                        <!-- <td width="5%"><?php echo my_money_format($rptdata['SERVICE_CHARGE']) ?></td> -->
                        <!-- <td width="15%" class="t-right"><?php echo my_money_format($rptdata['TOTAL_TRANSACTION_AMT']) ?>&nbsp;</td> -->
                    </tr>
            <?php
                    $i++;
                    $totcolamt = $totcolamt + $rptdata['transaction_amount'];
                }
            }
            ?>
            <tr class="linetr">
                <td colspan="7"></td>
            </tr>
            <tr class="footer">
                <td class="t-right" colspan="5">Total &nbsp;&nbsp;</td>
                <td class="t-right" colspan="2"><?php echo my_money_format($totcolamt); ?>&nbsp;</td> <!-- floor-->
            </tr>
        </tbody>
    </table>
</body>

</html>