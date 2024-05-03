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
            echo '  <tr class="header"><td class="col2" style="text-align:left;" colspan="2" >&nbsp;Academic Year :  ' . $acd . ' </td>'
                . '<td class="col5" colspan="2" style="text-align:right;">Date :    ' . $date . '&nbsp; </td></tr>';
        } ?>
        <thead>
            <tr class="header">
                <font weight="bold" font-size="60px">
                    <td class="col1" style="width:5%;">
                            <h3>Sl.No </h3>
                    </td>
                    <td class="col2" style="width:25%;">
                            <h3>Admission No.</h3>
                    </td>
                    <td class="col3" style="width:55%;">
                            <h3>Student Name</h3>
                    </td>
                    <td class="col4">
                            <h3>Gender</h3>
                    </td>
            </tr>
            <!--<hr>-->
        </thead>
        <tbody>
            <?php
            $prev_val = "";
            if (isset($details_data) && !empty($details_data)) {
                $arr = array();
                foreach ($details_data as $key => $item) {
                    if ($item['BatchID'] == '') {
                        $arr['NotBatch'][$key] = $item;
                    } else {
                        $arr['Batch'][$key] = $item;
                    }
                }
                ksort($arr, SORT_NUMERIC);
                if (isset($arr['NotBatch'])) {
                    foreach ($arr['NotBatch'] as $row) {
                        if ($isFirst) {
                            ?>
                            <tr class="header" >
                            <td colspan="2" ></td>
                                <td colspan="2" style="text-align:left">
                                    <h4>&nbsp;<?php echo $row['Batch']; ?></h4>
                                </td>
                            </tr>
                        <?php
                                        $isFirst = false;
                                    }
                                    ?>
                        <tr class="bodyarea">
                            <td class="col1"><?php echo $sino; ?></td>
                            <td class="col2"><?php echo $row['Admn_No']; ?></td>
                            <td class="col3"><?php echo $row['student_name']; ?></td>
                            <td class="col4"><?php echo $row['sex']; ?></td>
                        </tr>
                        <?php
                                    $sino++;
                                }
                            }
                            if (isset($arr['Batch'])) {
                                foreach ($arr['Batch'] as $row) {
                                    if ($prev_val == $row['Batch']) { ?>

                            <tr class="bodyarea">
                                <td class="col1"><?php echo $sino; ?></td>
                                <td class="col2"><?php echo $row['Admn_No']; ?></td>
                                <td class="col3"><?php echo $row['student_name']; ?></td>
                                <td class="col4"><?php echo $row['sex']; ?></td>
                            </tr>
                        <?php } else { ?>
                            <tr class="header">
                                <td colspan="2" style="text-align:left;">
                                    <h4>
                                        &nbsp;Class : <?php echo $row['Class']; ?>
                                    </h4>

                                </td>
                                <td colspan="2" style="text-align:left;">
                                    <h4>
                                        &nbsp;Batch : <?php echo $row['Batch']; ?></h4>
                                </td>
                            </tr>
                            <tr class="bodyarea">
                                <td class="col1"><?php echo $sino; ?></td>
                                <td class="col2"><?php echo $row['Admn_No']; ?></td>
                                <td class="col3"><?php echo $row['student_name']; ?></td>
                                <td class="col4"><?php echo $row['sex']; ?></td>
                            </tr>

                <?php
                                $prev_val = $row['Batch'];
                            }
                            $sino++;
                        }
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