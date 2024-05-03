<html>
<?php
$total = 0;
$sino = 1;
$gTotal = 0;
$isFirst = TRUE;
?>

<head></head>

<body style="background: #fff !important;">
    <?php echo $this->load->view('report/header') ?>
    <br>
    <table class="table table-bordered" width="100%">
        <?php
        if (isset($details_data) && !empty($details_data)) {
            foreach ($details_data as $row) {
                $acd = $row['Description'];
                $date = date("d-m-Y");
            }
            echo '  <tr class="header"><td colspan="3" style="text-align:left;" class="col2" >&nbsp;Academic Year :  ' . $acd . ' </td>'
                . '<td class="col5" colspan="2" style="text-align:right;">Date :   ' . $date . ' &nbsp; </td></tr>';
        } ?>
        <thead>
            <tr class="header">
                <td style="width:5%;">Sl.No</td>
                <td style="width:20%;">Admission No.</td>
                <td style="width:35%;">Student Name</td>
                <td style="width:20%;">Last Date of Attendance</td>
                <td>Issued Date</td>
            </tr>
        </thead>
        <tbody>
            <?php
            $prev_val = "";
            $prev_val1 = "";
            $sino = 1;
            if (isset($details_data) && !empty($details_data)) {
                foreach ($details_data as $row) {
                    if (($prev_val1 == $row['Batch'])) {
                        //                            if($prev_val1 == $row['Batch']){
                        ?>

                        <tr class="bodyarea">
                            <td class="col1"><?php echo $sino; ?></td>
                            <td class="col2"><?php echo $row['admn_no']; ?></td>
                            <td class="col3"><?php echo $row['student_name']; ?></td>
                            <td class="col4"><?php echo isset($row['last_date_of_attendance']) && !empty($row['last_date_of_attendance']) ? date('d-m-Y', strtotime($row['last_date_of_attendance'])) : 'NA'; ?></td>
                            <td class="col5"><?php echo isset($row['date_of_issued']) && !empty($row['date_of_issued']) ? date('d-m-Y', strtotime($row['date_of_issued'])) : 'NA'; ?></td>
                        </tr>
                    <?php } else { ?>
                        <tr class="header">
                            <td colspan="2" style="text-align:left;">
                                <h4>
                                    &nbsp;Class : <?php echo $row['Class']; ?>
                                </h4>

                            </td>
                            <td colspan="3" style="text-align:left;">
                                <h4>
                                    &nbsp;Batch : <?php echo $row['Batch']; ?></h4>
                            </td>
                        </tr>
                        <tr class="bodyarea">
                            <td class="col1"><?php echo $sino; ?></td>
                            <td class="col2"><?php echo $row['admn_no']; ?></td>
                            <td class="col3"><?php echo $row['student_name']; ?></td>
                            <td class="col4"><?php echo date('d-m-Y', strtotime($row['last_date_of_attendance'])); ?></td>
                            <td class="col5"><?php echo date('d-m-Y', strtotime($row['date_of_issued'])); ?></td>
                        </tr>

                <?php
                            //                        $prev_val = $row['Class'];
                            $prev_val1 = $row['Batch'];
                        }
                        $sino++;
                    }
                } else {  ?>
                <tr class="bodyarea">
                    <td colspan="3" align="center"> No Data Available </td>
                </tr>
            <?php  }
            ?>
        </tbody>
    </table>
</body>

</html>