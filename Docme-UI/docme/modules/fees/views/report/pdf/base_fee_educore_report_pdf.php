<html>

<head></head>

<body style="background: #fff !important;">
    <?php echo $this->load->view('report/pdf/header') ?>
    <table class="table table-bordered" width="100%">
        <?php
        $i = 1;
        if (isset($details_data) && !empty($details_data)) {
        ?>
                    <tr class="header">
                        <td style="width:5% !important;">Sl.No.</td>
                        <th>Admn No.</th>
                        <th>Student Name</th>
                        <th>Class</th>
                        <th>Set Date</th>
                        <th>Set Amount</th>
                        <th>Paid Amount</th>
                    </tr>

                    <?php
                    foreach ($details_data as $rptdata) {
                    ?>
                        <tr class="bodyarea">
                            <td width="5%"><?php echo $i; ?></td>
                            <td width="10%"><?php echo $rptdata['Admn_No'] ?></td>
                            <td width="20%"><?php echo $rptdata['student_name'] ?></td>
                            <td width="10%"><?php echo $rptdata['class'] ?></td>
                            <td width="15%"><?php echo date('d-m-Y', strtotime($rptdata['set_date'])) ?></td>
                            <td width="15%" style="text-align: right; padding-right:10px;"><?php echo my_money_format($rptdata['amount_limit']);  ?></td>
                            <td width="15%" style="text-align: right; padding-right:10px;"><?php echo my_money_format($rptdata['paid_amount']);  ?></td>
                        </tr>
                    <?php
                        $i++;
                    }
                    ?>
            <?php
        }
            ?>            
    </table>
</body>

</html>