<html>
<?php
$sino = 1;
$isFirst = TRUE;
?>

<head></head>

<body style="background: #fff !important;">
    <?php echo $this->load->view('report/header') ?>
    <br>
    <table class="table table-bordered" width="100%">
        <?php
        if (isset($details_data) && !empty($details_data)) {
            //                     dev_export($details_data);die;
            foreach ($details_data as $row) {
                $acd = $row['acdyr'];
                $date = date("d-m-Y");
            }
            echo '  <tr class="header"><td class="col2" colspan="3" style="text-align:left;">&nbsp;Academic Year :  ' . $acd . ' </td>'
                . '<td class="col5" colspan="4" style="text-align:right;">Date :   ' . $date . '&nbsp; </td></tr>';
        } ?>
        <thead>
            <tr class="header">
                <td width="5%">Sl.No.</td>
                <td width="25%">Batch</td>
                <td width="10%">Admission No.</td>
                <td width="25%">Student Name</td>
                <td width="10%">Applied Date</td>
                <td width="15%">Reason for leaving</td>
                <td width="10%">Status</td>
            </tr>
        </thead>
        <tbody>
            <?php
            $classid = "";
            if (isset($details_data) && !empty($details_data)) {
                foreach ($details_data as $row) {
                    if ($classid != $row['class_name']) {

                        $classid = $row['class_name'];
            ?>
                        <tr class="bodyarea">
                            <td colspan="7" style="text-align:left">
                                <h4>&nbsp;Class : <?php echo $row['class_name']; ?></h4>
                            </td>
                        </tr>


                    <?php
                    }
                    ?>
                    <tr class="bodyarea">
                        <td><?php echo $sino; ?>.</td>
                        <td class="t-center"><?php echo $row['batch_name'] ?></td>
                        <td><?php echo $row['Admn_No'] ?></td>
                        <td class="t-center"><?php echo $row['student_name'] ?></td>
                        <td><?php echo date('d-m-Y', strtotime($row['applied_date'])) ?></td>
                        <td class="t-center"><?php echo $row['reason_for_leaveving'] ?></td>
                        <td><?php echo $row['app_status'] ?></td>
                    </tr>
                <?php
                    $sino++;
                }
                ?>
            <?php } else { ?>
                <tr class="bodyarea">
                    <td colspan="3" align="center"> No Data Available </td>
                </tr>
            <?php }
            ?>
        </tbody>

    </table>
</body>

</html>