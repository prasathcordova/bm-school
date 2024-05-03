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
            // $totcolamt = 0;
            $service_charge = 0;
            $wallet_deposit = 0;
            $wallet_transfer = 0;
            $wallet_withdrawal = 0;
            if (isset($details_data) && !empty($details_data)) {
                foreach ($details_data  as $classname => $rptdata) {
            ?>
                    <tr class="header">
                        <th width="100%" colspan="4" class="t-left"><?php echo $classname; ?></th>
                        <!-- <th style="width:10%">Division</th> -->
                    </tr>
                    <?php
                    foreach ($rptdata as $batchname => $studentdata) {
                    ?>
                        <tr class="header">
                            <th width="100%" colspan="4" class="t-left"><?php echo $batchname; ?></th>
                            <!-- <th style="width:10%">Division</th> -->
                        </tr>
                        <?php
                        $ii = 0;
                        foreach ($studentdata as $stdata) {
                        ?>
                            <tr class="bodyarea">
                                <td colspan="2" class="t-left">Student Name : <?php echo $stdata['First_Name'] ?></td>
                                <td colspan="2" class="t-left">Admission No.: <?php echo $stdata['Admn_No'] ?></td>
                            </tr>
                            <tr class="header">
                                <td>Voucher</td>
                                <td>Voucher Date</td>
                                <td>Transaction</td>
                                <td>Amount</td>
                                <!-- <td>Ser. Charge(if any)</td> -->
                                <!-- <td>Non Relsd Amt</td> -->
                                <!-- <td>Amount</td> -->
                            </tr>
                            <?php
                            foreach ($stdata['voucher'] as $vocherid => $vchr) {
                            ?>
                                <tr class="bodyarea">
                                    <td width="15%"><?php echo $vchr['voucher_number'] ?></td>
                                    <td width="16%"><?php echo date('d-m-Y', strtotime($vchr['TRANSACTION_DATE'])) ?></td>
                                    <td width="15%">
                                        <?php
                                        $txn_type = '';
                                        if (substr($vchr['voucher_number'], 0, 3) == 'FAD') $txn_type = 'WALLET DEPOSIT';
                                        if (substr($vchr['voucher_number'], 0, 3) == 'FAP') $txn_type = 'WALLET PAYBACK';
                                        if (substr($vchr['voucher_number'], 0, 3) == 'ADJ') $txn_type = 'WALLET TRANSFER TO FEES';
                                        echo $txn_type;
                                        ?>&nbsp;
                                    </td>
                                    <td class="t-right" width="15%"><?php echo my_money_format($vchr['transaction_amount']) ?>&nbsp;</td>
                                    <!-- <td class="t-right" width="17%"><?php echo my_money_format($vchr['SERVICE_CHARGE']) ?>&nbsp;</td> -->
                                    <!-- <td class="t-right" width="17%"><?php echo my_money_format($vchr['NON_RELSD_AMT']) ?>&nbsp;</td> -->
                                    <!-- <td class="t-right" width="15%"><?php echo my_money_format($vchr['TOTAL_TRANSACTION_AMT']) ?>&nbsp;</td> -->
                                </tr>
                    <?php
                                if ($vchr['trans_type'] == 'WALLET AMOUNT CREDIT' || $vchr['trans_type'] == 'WALLET PAYBACK CREDIT') {
                                    $wallet_deposit += ($vchr['transaction_amount']); // + $vchr['SERVICE_CHARGE']);
                                }
                                if ($vchr['trans_type'] == 'WALLET AMOUNT DEBIT') {
                                    $wallet_transfer += $vchr['transaction_amount'];
                                }
                                if ($vchr['trans_type'] == 'WALLET AMOUNT WITHDRAWAL AUTHORIZED') {
                                    $wallet_withdrawal += $vchr['transaction_amount'];
                                }
                                $service_charge += $vchr['SERVICE_CHARGE'];
                            }
                        }
                    }
                    ?>

                    <tr class="linetr">
                        <td colspan="4"></td>
                    </tr>
            <?php
                }
            }
            $wallet_balance = $wallet_deposit - ($wallet_transfer + $wallet_withdrawal);
            ?>
            <!-- <tr class="linetr">
                <td colspan="4"></td>
            </tr> -->
            <tr class="footer">
                <td class="t-right" colspan="3">Wallet Deposit &nbsp;&nbsp;</td>
                <td colspan="1" class="t-right"><?php echo my_money_format($wallet_deposit) ?>&nbsp;</td>
            </tr>
            <tr class="footer">
                <td class="t-right" colspan="3">Transfer Amount &nbsp;&nbsp;</td>
                <td colspan="1" class="t-right"><?php echo my_money_format($wallet_transfer) ?>&nbsp;</td>
            </tr>
            <tr class="footer">
                <td class="t-right">Amount Pending&nbsp;&nbsp;</td>
                <td class="t-right"><?php echo my_money_format($w_rqst_placed);?> &nbsp;&nbsp;</td>
                <td class="t-right" >Wallet Payback &nbsp;&nbsp;</td>
                <td colspan="1" class="t-right"><?php echo my_money_format($wallet_withdrawal) ?>&nbsp;</td>
            </tr>
            <tr class="footer">
                <td class="t-right">Amount Rejected&nbsp;&nbsp;</td>
                <td class="t-right"><?php echo my_money_format($w_rqst_rejected);?> &nbsp;&nbsp;</td>
                <td class="t-right" >Service Charge &nbsp;&nbsp;</td>
                <td colspan="1" class="t-right"><?php echo my_money_format($service_charge) ?>&nbsp;</td>
            </tr>
            <!-- <tr class="footer">
                <td class="t-right" colspan="4">Wallet Balance &nbsp;&nbsp;</td>
                <td colspan="2" class="t-right"><?php echo my_money_format($wallet_balance) ?>&nbsp;</td>
            </tr> -->
        </tbody>
    </table>
</body>

</html>