<html>

<head></head>

<body style="background: #fff !important;">
    <?php echo $this->load->view('report/pdf/header') ?>
    <!-- <br>
         <h5 style="margin-bottom: 10px; margin-top:0px;font-family:arial;"><?php echo $collection_date; ?></h5> -->
    <table class="table table-bordered" width="100%">
        <tbody>
            <?php
            $totcolamt = 0;
            $totvatamt = 0;
            $netamount = 0;
            if (isset($details_data) && !empty($details_data)) {
                foreach ($details_data as $key1 => $feedata) {
            ?>

                    <tr class="header">
                        <th colspan="5" class="t-left" style="padding:7px 0px 7px 5px; ">FEE HEAD : <?php echo $key1 ?></th>
                    </tr>

                    <?php
                    foreach ($feedata as $key2 => $classdata) {
                        $classtotal = 0;
                    ?>

                        <tr class="header">
                            <th colspan="5" class="t-left" style="padding:7px 0px 7px 5px; ">CLASS : <?php echo $key2 ?></th>
                        </tr>

                        <?php
                        foreach ($classdata as $key3 => $collectiondata) {
                            $batchtotal = 0;
                        ?>

                            <tr class="header">
                                <th colspan="5" class="t-left" style="padding:7px 0px 7px 5px; ">BATCH : <?php echo $key3 ?></th>
                            </tr>


                            <tr class="header">
                                <td width="5%">Sl.No.</td>
                                <td width="12%">Admission No.</td>
                                <td style="text-align:left;" width="15%">&nbsp;Student Name</td>
                                <td width="12%">For Month</td>
                                <!-- <td width="13%">Received Date</td> -->
                                <td style=" text-align:right;" width="13%">Amount&nbsp;</td>
                            </tr>


                            <?php
                            $ic = 0;
                            if (isset($collectiondata) && !empty($collectiondata)) {
                                foreach ($collectiondata as $rptdata) {
                            ?>
                                    <tr class="bodyarea">
                                        <td><?php echo ++$ic; ?></td>
                                        <td><?php echo $rptdata['Admn_No'] ?></td>
                                        <td class="t-left"><?php echo $rptdata['First_Name'] ?></td>
                                        <td><?php echo date('M Y', strtotime($rptdata['demand_date'] . '-01')) ?></td>
                                        <!-- <td><?php echo date('d-m-Y', strtotime($rptdata['voucher_date'])) ?></td> -->
                                        <td class="t-right"><?php echo my_money_format($rptdata['amt_paid']); ?>&nbsp;</td>
                                    </tr>
                            <?php
                                    //$i++;
                                    // $totcolamt = $totcolamt + $rptdata['amt_paid'];
                                    //$totvatamt = $totvatamt + $rptdata['vat_amt'];
                                    $batchtotal += $rptdata['amt_paid'];
                                }
                            }
                            ?>
                            <tr class="bodyarea">
                                <td class="t-right" colspan="4"><b>Batch Total</b>&nbsp;</td>
                                <td class="t-right"><b><?php echo my_money_format($batchtotal); ?></b>&nbsp;</td>
                            </tr>
                            <tr class="linetr">
                                <td colspan="5"></td>
                            </tr>

                        <?php

                            $classtotal += $batchtotal;
                        }
                        $netamount += $classtotal; ?>
                        <tr class="bodyarea">
                            <td class="t-right" colspan="4"><b>Class Total</b>&nbsp;</td>
                            <td class="t-right"><b><?php echo my_money_format($classtotal); ?></b>&nbsp;</td>
                        </tr>
            <?php
                    }
                }
            }
            ?>
            <tr class="linetr">
                <td colspan="5"></td>
            </tr>
            <tr class="bodyarea">
                <td class="t-right" colspan="4"><b>Net Amount</b>&nbsp;</td>
                <td class="t-right"><b><?php echo my_money_format($netamount); ?></b>&nbsp;</td>
            </tr>
        </tbody>
    </table>
    <!-- <br>
    <div style="float:right; width:45%;">
        <table class="table table-bordered" width="100%">
            <tbody>
                <tr class="bodyarea">
                    <td class="t-right">Batch Total&nbsp;</td>
                    <td class="t-right"><b><?php echo my_money_format($batchtotal); ?></b>&nbsp;</td>
                </tr>
                <tr class="bodyarea">
                    <td class="t-right">Net Amount&nbsp;</td>
                    <td class="t-right"><b><?php echo my_money_format($netamount); ?></b>&nbsp;</td>
                </tr>
            </tbody>
        </table>
    </div> -->
</body>

</html>