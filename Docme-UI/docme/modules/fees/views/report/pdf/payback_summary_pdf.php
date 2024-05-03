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
            if (isset($details_data) && !empty($details_data)) {
                foreach ($details_data  as $classname => $rptdata) {
            ?>
                    <tr class="header">
                        <th width="100%" colspan="5" class="t-left"><?php echo $classname; ?></th>
                        <!-- <th style="width:10%">Division</th> -->
                    </tr>
                    <?php
                    foreach ($rptdata as $batchname => $studentdata) {
                    ?>
                        <tr class="header">
                            <th width="100%" colspan="5" class="t-left"><?php echo $batchname; ?></th>
                            <!-- <th style="width:10%">Division</th> -->
                        </tr>
                        <?php
                        $ii = 0;
                        foreach ($studentdata as $stdata) {
                        ?>
                            <tr class="bodyarea">
                                <td colspan="3" class="t-left">Student Name : <?php echo $stdata['First_Name'] ?></td>
                                <td colspan="2" class="t-left">Admission No.: <?php echo $stdata['Admn_No'] ?></td>
                            </tr>
                            <tr class="header">
                                <td width="25%">Payback Status</td>
                                <td width="15%">Requested Date</td>
                                <td width="15%">Approved Date</td>
                                <td width="30%">Comments</td>
                                <td width="15%">Amount</td>
                            </tr>
                            <?php
                            foreach ($stdata['voucher'] as $vocherid => $vchr) {
                            ?>
                                <tr class="bodyarea">
                                    <td><?php echo $vchr['status_name'] ?></td>
                                    <td><?php echo date('d-m-Y', strtotime($vchr['payback_request_date'])) ?></td>
                                    <td><?php echo ($vchr['approved_on'] <> 0 ? date('d-m-Y', strtotime($vchr['approved_on'])) : '-') ?></td>
                                    <td class="t-left"><?php echo $vchr['approve_comments'] ?></td>
                                    <td class="t-right"><?php echo my_money_format($vchr['PAYBACK_AMT']) ?>&nbsp;</td>
                                </tr>
                    <?php
                                $totcolamt = $totcolamt + $vchr['PAYBACK_AMT'];
                            }
                        }
                    }
                    ?>

                    <!-- <tr class="linetr">
                        <td colspan="5"></td>
                    </tr> -->
                <?php
                }
                ?>
                <tr class="linetr">
                    <td colspan="5"></td>
                </tr>
            <?php
            }
            ?>
                <tr class="footer">
                    <td class="t-right" colspan="4">Direct Payback &nbsp;&nbsp;</td>
                    <td class="t-right"><?php echo my_money_format($direct_payback); ?>&nbsp;&nbsp;</td>
                </tr>
                <tr class="footer">
                    <td class="t-right">Pending Amount &nbsp;&nbsp;</td>
                    <td class="t-right"><?php echo my_money_format($request_placed); ?> &nbsp;&nbsp;</td>
                    <td class="t-right" colspan="2">Wallet Payback &nbsp;&nbsp;</td>
                    <td class="t-right"><?php echo my_money_format($wallet_payback); ?>&nbsp;&nbsp;</td>
                </tr>
                <tr class="footer">
                    <td class="t-right">Amount Rejected &nbsp;&nbsp;</td>
                    <td class="t-right"><?php echo my_money_format($request_rejected); ?> &nbsp;&nbsp;</td>
                    <td class="t-right" colspan="2">Amount Encashed &nbsp;&nbsp;</td>
                    <td class="t-right"><?php echo my_money_format($request_encashed); ?>&nbsp;&nbsp;</td>
                </tr>
        </tbody>
    </table>
</body>

</html>