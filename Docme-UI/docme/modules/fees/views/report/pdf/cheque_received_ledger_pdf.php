<html>

<head></head>

<body style="background: #fff !important;">
    <?php echo $this->load->view('report/pdf/header') ?>
    <!-- <br>
    <h5 style="margin-top:0px;"><?php echo $collection_date; ?></h5> -->
    <table class="table table-bordered" width="100%">
        <thead>
            <tr class="header">
                <td width="10%">Admn. No.</td>
                <td width="15%">Name</td>
                <!-- <td width="16%">Class</td> -->
                <!-- <td width="9%">Division</td> -->
                <!-- <td width="13%">Tran. Date<sup>**</sup></td> -->
                <td width="15%">Voucher</td>
                <td width="14%">Cheque No</td>
                <td width="6%">Status</td>
                <td width="25%" style="text-align: left;">&nbsp;Remarks</td>
                <td width="15%" style="text-align: right;">Amount&nbsp;</td>
            </tr>
        </thead>
        <tbody>
            <?php
            $i = 1;
            $totcolamt = 0;
            $recon_amount = 0;
            $not_recon_amount = 0;
            $bounce_amount = 0;
            $cancelled_amount = 0;
            if (isset($details_data) && !empty($details_data)) {
                foreach ($details_data as $ch_date => $chqdetails) {
            ?>
                    <tr class="header">
                        <td colspan="7" style="text-align: left;">&nbsp;Cheque Received Date : <?php echo date('d-m-Y', strtotime($ch_date)) ?></td>
                    </tr>
                    <?php
                    foreach ($chqdetails as $classname => $classdetails) {
                        foreach ($classdetails as $division => $report_details) {
                    ?>
                            <tr class="header">
                                <td colspan="7" style="text-align: left;">&nbsp;Class : <?php echo $classname . ' ' . $division ?></td>
                            </tr>
                            <?php

                            foreach ($report_details as $rpt_data) {
                                if ($rpt_data['CHQ_STATUS'] == 'R') {
                                    $recon_amount += $rpt_data['voucher_total'];
                                }
                                if ($rpt_data['CHQ_STATUS'] == 'B') {
                                    $bounce_amount += $rpt_data['voucher_total'];
                                }
                                if ($rpt_data['CHQ_STATUS'] == 'NR') {
                                    $not_recon_amount += $rpt_data['voucher_total'];
                                }
                                if ($rpt_data['CHQ_STATUS'] == 'X') {
                                    $cancelled_amount += $rpt_data['voucher_total'];
                                }
                            ?>
                                <tr class="bodyarea">
                                    <td><?php echo $rpt_data['Admn_No']; ?></td>
                                    <td><?php echo $rpt_data['First_Name'] ?></td>
                                    <!-- <td><?php echo $rpt_data['class_desc'] ?>&nbsp;<?php echo $rpt_data['Division'] ?></td> -->
                                    <!-- <td><?php echo ($rpt_data['transaction_date'] == '1900-01-01' ? '' : date('d-m-Y', strtotime($rpt_data['transaction_date']))) ?></td> -->
                                    <td><?php echo $rpt_data['voucher_code'] ?></td>
                                    <td><?php echo $rpt_data['ch_number'] ?></td>
                                    <td><?php echo $rpt_data['CHQ_STATUS'] ?></td>
                                    <td class="t-left"><?php echo $rpt_data['CHQ_REMARKS'] ?></td>
                                    <td class="t-right"><?php echo my_money_format($rpt_data['voucher_total']) ?>&nbsp;</td>
                                </tr>
            <?php
                                $i++;
                                $totcolamt = $totcolamt + $rpt_data['voucher_total'];
                            }
                        }
                    }
                }
            }
            ?>
            <tr class="linetr">
                <td colspan="7"></td>
            </tr>
            <tr class="footer">
                <td class="t-right" colspan="6">Reconciled Amount (R)&nbsp;&nbsp;</td>
                <td class="t-right" colspan="1"><?php echo my_money_format($recon_amount); ?>&nbsp;</td>
            </tr>
            <tr class="footer">
                <td class="t-right" colspan="6">Not Reconciled Amount (NR)&nbsp;&nbsp;</td>
                <td class="t-right" colspan="1"><?php echo my_money_format($not_recon_amount); ?>&nbsp;</td>
            </tr>
            <tr class="footer">
                <td class="t-right" colspan="6">Bounced Amount (B)&nbsp;&nbsp;</td>
                <td class="t-right" colspan="1"><?php echo my_money_format($bounce_amount); ?>&nbsp;</td>
            </tr>
            <tr class="footer">
                <td class="t-right" colspan="6">Cancelled Amount (X)&nbsp;&nbsp;</td>
                <td class="t-right" colspan="1"><?php echo my_money_format($cancelled_amount); ?>&nbsp;</td>
            </tr>
        </tbody>
    </table>
    <!-- <p style="margin-top:5px; font-size: 10px;">* Cheque Date : Cheque received Date&nbsp; ** Tran. Date : Cheque reconciled Date</p> -->
</body>

</html>