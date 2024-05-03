<html>

<head></head>

<body style="background: #fff !important;">
    <?php echo $this->load->view('report/pdf/header') ?>
    <table class="table table-bordered" width="100%">
        <?php
        $i = 1;
        $totcolamt = 0;
        if (isset($details_data) && !empty($details_data)) {
        ?>
            <!-- <tr class="header">
                <td style="width:5% !important;">Sl.No.</td>
                <th>Admn No.</th>
                <th>Student Name</th>
                <th>Class</th>
                <th>Batch</th>
                <th>Voucher Date</th>
                <th>Voucher Code</th>
                <th>Amount</th>
            </tr> -->

            <?php
            foreach ($details_data as $student_id => $rptdata) {
            ?>
                <!-- <tr class="bodyarea">
                    <td><?php echo $i; ?></td>
                    <td><?php echo $rptdata['Admn_No'] ?></td>
                    <td><?php echo $rptdata['Student_Name'] ?></td>
                    <td><?php echo $rptdata['CLASS_NAME'] ?></td>
                    <td><?php echo $rptdata['Batch_Name'] ?></td>
                    <td><?php echo date('d-m-Y', strtotime($rptdata['voucher_date'])) ?></td>
                    <td style="text-align: right; padding-right:10px;"><?php echo $rptdata['voucher_code'] ?></td>
                    <td style="text-align: right; padding-right:10px;"><?php echo my_money_format($rptdata['amt_paid']);  ?></td>
                </tr> -->
                <tr class="header">
                    <td colspan="2" style="text-align: left;">&nbsp;Admn. No. : <?php echo $rptdata['student_details']['Admn_No'] ?></td>
                    <td colspan="3" style="text-align: left;">&nbsp;Student Name : <?php echo $rptdata['student_details']['Student_Name'] ?></td>
                </tr>
                <tr class="header">
                    <td colspan="5" style="text-align: left;">&nbsp;Reason : <?php echo $rptdata['student_details']['reason'] ?></td>
                </tr>
                <tr class="header">
                    <td style="width:5% !important;">Sl.No.</td>
                    <th style="width: 30%;">Fee Details</th>
                    <th style="width: 30%;">Demanded Month</th>
                    <th style="text-align: right; width:25%;">&nbsp;Demanded Amount</th>
                    <th style="text-align: center; width:10%;">&nbsp;Status</th>
                </tr>
                
            <?php
            $ccc= 1;
                foreach($rptdata['fee_details'] as $fdata){
                    ?>
                    <tr class="bodyarea">
                        <td><?php echo $ccc++; ?></td>
                        <td><?php echo $fdata['fee_name'] ?></td>
                        <td><?php echo date('M-Y', strtotime($fdata['demanded_on'])) ?></td>
                        <td style="text-align: right; padding-right:10px;"><?php echo my_money_format($fdata['demand_amount']);  ?></td>
                        <td><?php echo $fdata['status'] ?></td>
                    </tr>
                    <?php
                }
                $i++;
                // $totcolamt = $totcolamt + $rptdata['amt_paid'];
            }
            ?>
        <?php
        }
        ?>
        <tr class="linetr">
            <td colspan="5"></td>
        </tr>
        <!-- <tr class="footer">
            <td style="text-align: right; padding-right:10px;" colspan="7">Total Amount&nbsp;&nbsp;</td>
            <td style="text-align: right; padding-right:10px;"><?php echo my_money_format($totcolamt); ?></td>
        </tr> -->
    </table>
</body>

</html>