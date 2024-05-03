<html>

<head></head>

<body style="background: #fff !important;">
    <?php echo $this->load->view('report/pdf/header') ?>
    <table class="table table-bordered" width="100%">
        <?php
        $i = 1;
        $totcolamt = 0;
        $totcolamt1 = 0;
        if (isset($details_data) && !empty($details_data)) {
            foreach ($details_data as $key1 => $feedata) {
        ?>

                <tr class="header">
                    <th colspan="2" class="t-left" style="padding:7px 0px 7px 5px;">Admission No. : <?php echo $feedata['studentdetails']['Admn_No'] ?></th>
                    <th colspan="3" class="t-left" style="padding:7px 0px 7px 5px;">Name : <?php echo $feedata['studentdetails']['First_Name'] ?></th>
                    <th colspan="3" class="t-left" style="padding:7px 0px 7px 5px;">Batch : <?php echo $feedata['studentdetails']['Batch_Name'] ?></th>

                </tr>
                <tr class="header">
                    <td style="width:5% !important;">Sl.No.</td>
                    <th>Fee Name</th>
                    <th>Month</th>
                    <th>Req. Date</th>
                    <th>Req. Amount</th>
                    <th>Status</th>
                    <th>Appr./Rej. Date</th>
                    <th>Appr. Amount</th>
                </tr>

                <?php

                foreach ($feedata['exemptions'] as $rptdata) {
                    $ex_pending = 0;
                    $exm_users = explode("*", $rptdata['ex_users']);
                    if (!is_array($exm_users)) $exm_users = array($exm_users);
                    $exm_status = explode("*", $rptdata['ex_status']);
                    if (!is_array($exm_status)) $exm_status = array($exm_status);

                    if ($exm_status[0] == 'N') $pending_from = 'PRINCIPAL';
                    else if ($exm_users[1] == '3' && $exm_status[1] == 'N') $pending_from = 'FD';
                    else if ($exm_users[2] == '2' && $exm_status[2] == 'N') $pending_from = 'MD';

                    if ($exm_status[0] == 'N' || $exm_status[1] == 'N' || $exm_status[2] == 'N') {
                        $ex_pending = 1;
                    }
                ?>
                    <tr class="bodyarea">
                        <td><?php echo $i; ?></td>
                        <td><?php echo $rptdata['fee_code_description'] ?></td>
                        <td><?php echo date('M-Y', strtotime($rptdata['demanded_date'])) ?></td>
                        <td><?php echo date('d-m-Y', strtotime($rptdata['requested_date'])) ?></td>
                        <td style="text-align: right; padding-right:10px;"><?php echo my_money_format($rptdata['amount_applied']) ?></td>
                        <td><?php echo (($rptdata['is_approved'] == 1) ? 'APPROVED' : (($rptdata['is_rejected'] == 1) ? 'REJECTED' : 'PENDING'));
                            if ($ex_pending == 1) echo ' <b>(' . $pending_from . ')</b>'; ?></td>
                        <td><?php echo (isset($rptdata['app_rej_date']) ? date('d-m-Y', strtotime($rptdata['app_rej_date'])) : '-') ?></td>
                        <td style="text-align: right; padding-right:10px;"><?php echo my_money_format($rptdata['amount_approved']);  ?></td>
                    </tr>
                <?php
                    $i++;
                    $totcolamt = $totcolamt + $rptdata['amount_applied'];
                    $totcolamt1 = $totcolamt1 + $rptdata['amount_approved'];
                }
                ?>
        <?php
            }
        }
        ?>
        <tr class="linetr">
            <td colspan="8"></td>
        </tr>
        <tr class="footer">
            <td style="text-align: right; padding-right:10px;" colspan="7">Total Applied&nbsp;&nbsp;</td>
            <td style="text-align: right; padding-right:10px;"><?php echo my_money_format($totcolamt); ?></td>
        </tr>
        <tr class="footer">
            <td style="text-align: right; padding-right:10px;" colspan="7">Total Approved&nbsp;&nbsp;</td>
            <td style="text-align: right; padding-right:10px;"><?php echo my_money_format($totcolamt1); ?></td>
        </tr>

    </table>
</body>

</html>