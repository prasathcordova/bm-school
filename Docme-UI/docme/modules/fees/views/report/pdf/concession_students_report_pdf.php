<html>

<head></head>

<body style="background: #fff !important;">
    <?php echo $this->load->view('report/pdf/header') ?>
    <!-- <br>
    <h5 style="margin-top:0px;"><?php echo $collection_date; ?></h5> -->
    <table class="table table-bordered" width="100%">
        <thead>
            <tr class="header">
                <th>Sl.No.</th>
                <th>Admission No.</th>
                <th>Student</th>
                <th>Class</th>
                <th>Batch</th>
                <th>Priority</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $i = 1;
            $totcolamt = 0;
            $totcolamt1 = 0;
            if (isset($details_data) && !empty($details_data)) {
                foreach ($details_data as $rptdata) {
                    ?>
                    <tr class="bodyarea">
                        <td><?php echo $i; ?></td>
                        <td><?php echo $rptdata['Admn_No'] ?></td>
                        <td><?php echo $rptdata['student_name'] ?></td>
                        <td><?php echo $rptdata['class_name'] ?></td>
                        <td><?php echo $rptdata['Batch_Name'] ?></td>
                        <td><?php echo $rptdata['Priority'] ?></td>
                    </tr>
            <?php
                    $i++;
                }
            }
            ?>
            <tr class="linetr">
                <td colspan="9"></td>
            </tr>
            <tr class="footer">
                <td style="text-align: center; padding:10px;" colspan="6">
                    This List is Not Fixed.It may vary Under Conditions like LongAbsent , Tc and when student changes the Class.
                </td>
            </tr>
        </tbody>
    </table>

</body>

</html>