<html>

<head></head>

<body style="background: #fff !important;">
    <?php echo $this->load->view('report/pdf/header') ?>
    <!--        <table class="table2" cellsapcing="0" cellpadding="0" style="font-size: 11px" width="100%">
            <?php
            //            if (isset($details_data) && !empty($details_data)) {
            //                foreach ($details_data as $row) {
            //                    $acd = $row['Description'];
            //$date = date("d-m-Y");
            //                }
            //echo'  <tr class="header"><td class="col2" > &nbsp;    </td>'
            //. '<td class="col5" style="text-align:right;">Date : &nbsp;   ' . $date . ' </td></tr>';
            //            }
            ?>
        </table>     -->
    <table class="table table-bordered" width="100%">
        <thead>
            <tr class="header">
                <td width="5%">Sl.No.</td>
                <td width="13%">Admission No.</td>
                <td width="15%">Student Name</td>
                <td width="15%">Voucher Code</td>
                <td width="15%">Voucher Date</td>
                <td width="15%">Description</td>
                <td width="14%">Amount</td>
                <td width="8%"><?php echo print_tax_vat(); ?></td>
                <!-- <td>Type</td> -->
            </tr>
        </thead>
        <tbody>
            <?php
            $i = 1;
            $totcolamt = 0;
            $totvatamt = 0;
            if (isset($details_data) && !empty($details_data)) {
                foreach ($details_data as $rptdata) {
            ?>
                    <tr class="bodyarea">
                        <td><?php echo $i; ?></td>
                        <td><?php echo $rptdata['Admn_No'] ?></td>
                        <td><?php echo $rptdata['First_Name'] ?></td>
                        <td><?php echo $rptdata['voucher_code'] ?></td>
                        <td><?php echo date('d-m-Y', strtotime($rptdata['voucher_date'])) ?></td>
                        <td><?php echo $rptdata['feeCode'] ?></td>
                        <td class="t-right"><?php echo my_money_format($rptdata['amt_paid']) ?>&nbsp;</td>
                        <td class="t-right"><?php if ($rptdata['vat_amt'] > 0) echo  my_money_format($rptdata['vat_amt']);
                                            else echo my_money_format(0); ?>&nbsp;</td>
                        <!-- <td><?php echo $rptdata['trans_type'] ?></td> -->
                    </tr>
            <?php
                    $i++;
                    $totcolamt = $totcolamt + $rptdata['amt_paid'];
                    $totvatamt = $totvatamt + $rptdata['vat_amt'];
                }
            }
            ?>
            <tr class="linetr">
                <td colspan="8"></td>
            </tr>
            <tr class="footer">
                <td class="t-right" style="text-align:right;" colspan="6">Fee Total without <?php echo print_tax_vat(); ?>&nbsp;&nbsp;</td>
                <td colspan="2" style="text-align:right;"><?php echo my_money_format($totcolamt); ?>&nbsp;&nbsp;</td>
            </tr>
            <tr class="footer">
                <td class="t-right" style="text-align:right;" colspan="6"><?php echo print_tax_vat(); ?> Collected&nbsp;&nbsp;</td>
                <td colspan="2" style="text-align:right;"><?php echo my_money_format($totvatamt); ?>&nbsp;&nbsp;</td>
            </tr>
            <tr class="linetr">
                <td colspan="8"></td>
            </tr>
            <tr class="footer">
                <td class="t-right" style="text-align:right;" colspan="6">Grand Total &nbsp;&nbsp;</td>
                <td colspan="2" style="text-align:right;"><?php echo my_money_format(($totcolamt + $totvatamt)); ?>&nbsp;&nbsp;</td>
            </tr>
        </tbody>
    </table>

</body>

</html>