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
            echo '  <tr class="header"><td colspan="2" style="text-align:left;" class="col2" >&nbsp;Academic Year : ' . $acd . ' </td>'
                . '<td class="col5" colspan="2" style="text-align:right;">Date :  ' . $date . '&nbsp;   </td></tr>';
        } ?>
        <thead>
            <tr class="header">
                <td width="5%">Sl.No</td>
                <td width="20%">Admission No.</td>
                <td width="50%">Student Name</td>
                <td width="25%">Caste</td>
            </tr>
            <!--<hr>-->
        </thead>
        <tbody>
            <?php
            $prev_val = "";
            $sino = 1;
            if (isset($details_data) && !empty($details_data)) {
                foreach ($details_data as $row) {
                    if ($prev_val == $row['Batch']) { ?>

                        <tr class="bodyarea">
                            <td class="col1"><?php echo $sino; ?></td>
                            <td class="col2"><?php echo $row['Admn_No']; ?></td>
                            <td class="col3"><?php echo $row['student_name']; ?></td>
                            <td class="col4"><?php echo $row['caste_name']; ?></td>
                        </tr>
                    <?php } else { ?>
                        <tr class="header">
                            <td colspan="2" style="text-align:left;">
                                <h4>
                                   &nbsp; Class : <?php echo $row['Class']; ?>
                                </h4>

                            </td>
                            <td colspan="2" style="text-align:left;">
                                <h4>
                                   &nbsp; Batch : <?php echo $row['Batch']; ?></h4>
                            </td>
                        </tr>
                        <tr class="bodyarea">
                            <td><?php echo $sino; ?></td>
                            <td><?php echo $row['Admn_No']; ?></td>
                            <td><?php echo $row['student_name']; ?></td>
                            <td><?php echo $row['caste_name']; ?></td>
                        </tr>

                <?php
                            $prev_val = $row['Batch'];
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