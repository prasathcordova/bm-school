<html>

<head></head>

<body style="background: #fff !important;">
    <?php echo $this->load->view('report/pdf/header') ?>
    <!-- <br>
    <h5 style="margin-top:0px;"><?php echo $collection_date; ?></h5> -->
    <table class="table table-bordered" width="100%">
        <thead>
            <tr class="header">
                <td width="5%">Sl.No</td>
                <td width="12%">Admission No.</td>
                <td width="24%">Name</td>
                <!-- <td width="12%">Batch</td> -->
                <td width="12%">Voucher Date</td>
                <td width="12%">Voucher Code</td>
                <!-- <td width="10%">Fee</td> -->
                <td width="20%">Cancel Reason</td>
                <td width="15%">Amount</td>
                <!-- <td width="8%"><?php echo print_tax_vat(); ?></td> -->
            </tr>
        </thead>
        <tbody>
            <?php
            $i = 1;
            $totcolamt = 0;
            if (isset($details_data) && !empty($details_data)) {
                foreach ($details_data as $rptdata) {
                    $amount = $rptdata['AMOUNT'];
                    // if ($rptdata['is_service_charge'] == 1) {
                    //     $amount = $rptdata['AMOUNT'];
                    //     $vat = 0;
                    // } else {
                    //     $amount = $rptdata['AMOUNT'] - $rptdata['VAT'];
                    //     $vat = $rptdata['VAT'];
                    // }
            ?>
                    <tr class="bodyarea">
                        <td><?php echo $i; ?></td>
                        <td><?php echo $rptdata['ADM_NO'] ?></td>
                        <td class="t-left"><?php echo $rptdata['STUDENT_NAME'] ?></td>
                        <!-- <td><?php echo $rptdata['BATCH'] ?></td> -->
                        <td><?php echo date('d-m-Y', strtotime($rptdata['VOUCHER_DATE'])) ?></td>
                        <td><?php echo $rptdata['VOUCHER_CODE'] ?></td>
                        <!-- <td><?php echo $rptdata['FEE_DETAILS'] ?></td> -->
                        <td class="t-left"><?php echo $rptdata['CANCEL_REASON'] ?></td>
                        <td style="text-align: right;"><?php echo my_money_format($amount) ?>&nbsp;</td>
                        <!-- <td style="text-align: right;"><?php echo my_money_format($vat) ?>&nbsp;</td> -->
                    </tr>
            <?php
                    $i++;
                    $totcolamt = $totcolamt + $rptdata['AMOUNT'];
                }
            }
            ?>
            <!-- <tr class="linetr">
                <td colspan="7"></td>
            </tr>
            <tr class="footer">
                <td style="text-align: right; padding-right:10px;" colspan="5">Total &nbsp;&nbsp;</td>
                <td colspan="2" style="text-align: right;"><?php echo my_money_format($totcolamt); ?>&nbsp;</td>
            </tr> -->
        </tbody>
    </table>
</body>

</html>