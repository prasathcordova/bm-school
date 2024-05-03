<html>

<head>
    <title style="color:hotpink"><?php echo $title; ?></title>
</head>

<body style="background: #fff !important;">
    <?php echo $this->load->view('report/pdf/header') ?>
    <!-- <br>
    <h5 style="margin-top:0px;"><?php echo $collection_date; ?></h5> -->
    <table class="table table-bordered" width="100%">
        <tbody>
            <?php
            $i = 1;
            $totcolamt = 0;
            $service_charge = 0;
            if (isset($details_data) && !empty($details_data)) {
                foreach ($details_data  as $classname => $rptdata) {
            ?>
                    <tr class="header">
                        <th width="100%" colspan="3" class="t-left"><?php echo $classname; ?></th>
                        <!-- <th style="width:10%">Division</th> -->
                    </tr>
                    <?php
                    foreach ($rptdata as $batchname => $studentdata) {
                    ?>
                        <tr class="header">
                            <th width="100%" colspan="3" class="t-left"><?php echo $batchname; ?></th>
                            <!-- <th style="width:10%">Division</th> -->
                        </tr>
                        <?php
                        $ii = 0;
                        foreach ($studentdata as $stdata) {
                        ?>
                            <tr class="bodyarea">
                                <td colspan="2" class="t-left">Student Name : <?php echo $stdata['First_Name'] ?></td>
                                <td colspan="1" class="t-left">Admission No.: <?php echo $stdata['Admn_No'] ?></td>
                            </tr>
                            <tr class="header">
                                <td>Voucher</td>
                                <td>Voucher Date</td>
                                <td>Amount</td>
                                <!-- <td>Non Relsd Amt</td> -->
                                <!-- <td>Total</td> -->
                            </tr>
                            <?php
                            foreach ($stdata['voucher'] as $vocherid => $vchr) {
                            ?>
                                <tr class="bodyarea">
                                    <td width="15%"><?php echo $vchr['voucher_number'] ?></td>
                                    <td width="16%"><?php echo date('d-m-Y', strtotime($vchr['TRANSACTION_DATE'])) ?></td>
                                    <td class="t-right" width="15%"><?php echo my_money_format($vchr['transaction_amount']) ?>&nbsp;</td>
                                    <!-- <td class="t-right" width="17%"><?php echo my_money_format($vchr['NON_RELSD_AMT']) ?>&nbsp;</td> -->
                                    <!-- <td class="t-right" width="15%"><?php echo my_money_format($vchr['TOTAL_TRANSACTION_AMT']) ?>&nbsp;</td> -->
                                </tr>
                    <?php
                                $service_charge += $vchr['SERVICE_CHARGE'];
                                $totcolamt = $totcolamt + $vchr['transaction_amount'];
                            }
                        }
                    }
                    ?>

                    <tr class="linetr">
                        <td colspan="3"></td>
                    </tr>
            <?php
                }
            }

            ?>
            <tr class="footer">
                <td class="t-right" colspan="2">Total &nbsp;&nbsp;</td>
                <td class="t-right"><?php echo my_money_format($totcolamt); ?>&nbsp;</td>
            </tr>
            <tr class="footer">
                <td class="t-right" colspan="2">Service Charge Collected &nbsp;&nbsp;</td>
                <td class="t-right"><?php echo my_money_format($service_charge); ?>&nbsp;</td>
            </tr>
        </tbody>
    </table>
</body>

</html>