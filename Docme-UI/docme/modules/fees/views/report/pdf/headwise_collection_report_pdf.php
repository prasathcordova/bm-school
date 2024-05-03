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
            if (isset($details_data) && !empty($details_data)) {
                foreach ($details_data as $key1 => $feedata) {
            ?>

                    <tr class="header">
                        <th colspan="6" class="t-left" style="padding:7px 0px 7px 5px;">FEE HEAD : <?php echo $key1 ?></th>
                    </tr>

                    <?php
                    foreach ($feedata as $key2 => $classdata) {
                    ?>

                        <tr class="header">
                            <th colspan="6" class="t-left" style="padding:7px 0px 7px 5px;">CLASS : <?php echo $key2 ?></th>
                        </tr>

                        <?php
                        foreach ($classdata as $key3 => $collectiondata) {
                        ?>

                            <tr class="header">
                                <th colspan="6" class="t-left" style="padding:7px 0px 7px 5px;">BATCH : <?php echo $key3 ?></th>
                            </tr>


                            <tr class="header">
                                <td width="5%">Sl.No </td>
                                <td width="20%">Admission No.</td>
                                <td width="25%">Student Name</td>
                                <td width="15%">For Month</td>
                                <td width="20%">Received Date</td>
                                <td width="15%">Amount</td>
                            </tr>


                            <?php
                            $ic = 1;
                            if (is_array($collectiondata) && !empty($collectiondata)) {
                                foreach ($collectiondata as $rptdata) {
                            ?>
                                    <tr class="bodyarea">
                                        <td><?php echo $ic++; ?></td>
                                        <td><?php echo $rptdata['Admn_No'] ?></td>
                                        <td><?php echo $rptdata['First_Name'] ?></td>
                                        <td><?php echo date('M Y', strtotime($rptdata['demand_date'])) ?></td>
                                        <td><?php echo date('d-m-Y', strtotime($rptdata['voucher_date'])) ?></td>
                                        <td class="t-right">
                                            <?php
                                            if ($rptdata['is_penalty'] == 1) echo '(Penalty) ';
                                            echo my_money_format($rptdata['amt_paid']);
                                            ?>&nbsp;
                                        </td>
                                    </tr>

                            <?php
                                    //$i++;
                                    $totcolamt = $totcolamt + $rptdata['amt_paid'];
                                    //$totvatamt = $totvatamt + $rptdata['vat_amt'];
                                }
                            }
                            ?>
                            <tr class="linetr">
                                <td colspan="6"></td>
                            </tr>

            <?php
                        }
                    }
                }
            }
            $netamount = $totcolamt - $common_data['transfer_amount'] - $common_data['withdrawal_amount'];
            ?>
        </tbody>
    </table>
    <br>
    <div style="float:left; width:45%;">
        <table class="table table-bordered" width="100%">
            <tbody>
                <tr class="bodyarea">
                    <td class="t-right">Concession Amount&nbsp;</td>
                    <td class="t-right"><b><?php echo my_money_format($common_data['concession_amount']); ?></b>&nbsp;</td>
                </tr>
                <tr class="bodyarea">
                    <td class="t-right">Exemption Amount&nbsp;</td>
                    <td class="t-right"><b><?php echo my_money_format($common_data['exemption_amount']); ?></b>&nbsp;</td>
                </tr>
            </tbody>
        </table>
    </div>
    <div style="float:right; width:45%;">
        <table class="table table-bordered" width="100%">
            <tbody>
                <tr class="bodyarea">
                    <td class="t-right">Total Amount&nbsp;</td>
                    <td class="t-right"><b><?php echo my_money_format($totcolamt); ?></b>&nbsp;</td>
                </tr>
                <tr class="bodyarea">
                    <td class="t-right">Service Charge&nbsp;</td>
                    <td class="t-right"><?php echo my_money_format($common_data['service_charge']); ?>&nbsp;</td>
                </tr>
                <tr class="bodyarea">
                    <td class="t-right">Round Off&nbsp;</td>
                    <td class="t-right"><?php echo my_money_format($common_data['round_off']); ?>&nbsp;</td>
                </tr>
                <tr class="bodyarea">
                    <td class="t-right">Transfer (-)&nbsp;</td>
                    <td class="t-right"><b><?php echo my_money_format($common_data['transfer_amount']); ?></b>&nbsp;</td>
                </tr>
                <tr class="bodyarea">
                    <td class="t-right">Paidback Amount (-)&nbsp;</td>
                    <td class="t-right"><b><?php echo my_money_format($common_data['withdrawal_amount']); ?></b>&nbsp;</td>
                </tr>
                <tr class="bodyarea">
                    <td class="t-right">Net Amount&nbsp;</td>
                    <td class="t-right"><b><?php echo my_money_format($netamount + $common_data['service_charge'] + $common_data['round_off']); ?></b>&nbsp;</td>
                </tr>
            </tbody>
        </table>
    </div>
</body>

</html>