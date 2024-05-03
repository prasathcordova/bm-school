<html>
<?php

use PhpOffice\PhpSpreadsheet\Shared\Date;

$total = 0;
$sino = 1;
$gTotal = 0;
$isFirst = TRUE;
?>

<head></head>

<body style="background: #fff !important;">
    <?php echo $this->load->view('report/header') ?>
    <br>
    <table class="table" width="100%">
        <?php
        if (!empty($Sd))
            echo '<tr class="header"><td class="col2">From Date: &nbsp;' . Date('d-m-Y', strtotime($Sd)) . '</td>';
        else echo '<tr><td></td>';
        if (!empty($Ed))
            echo '<td class="col5" style="text-align:right;">To Date: &nbsp;' . Date('d-m-Y', strtotime($Ed)) . '</td></tr>';
        else echo '<tr><td></td></tr>'; ?>
    </table>
    <!-- <span>From Date &nbsp;: <b><?php echo Date('d-m-Y', strtotime($Sd)); ?></b></span><br>
    <span>To Date&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; : <b><?php echo Date('d-m-Y', strtotime($Ed)); ?></b></span><br> -->
    <table class="table table-bordered" width="100%">
        <thead>
            <?php
            if (isset($details_data) && !empty($details_data)) {
                foreach ($details_data as $row) {
                    $acd = $row['Description'];
                    $divsnid = $row['division'];
                    $date = date("d-m-Y");
                }
                echo '  <tr class="header"><td class="col2" colspan="3" style="text-align:left;" >&nbsp;Academic Year : ' . $acd . ' </td>
                    </tr>';
            } ?>

            <?php
            /*if (isset($details_data) && !empty($details_data)) {
                foreach ($details_data as $row) {
                    $class = $row['Class'];
                }
                echo '  <tr class="header"><td><h4>Class : &nbsp;   ' . $class . ' </h4></td></tr>';
            }*/
            ?>
            <tr class="header">
                <td style="width:5%;">Sl.No</td>
                <td style="width:25%;">Admission No.</td>
                <td>Student Name</td>
            </tr>
        </thead>
        <tbody>
            <?php
            $prev_val = "";
            if (isset($details_data) && !empty($details_data)) {
                foreach ($details_data as $row) { ?>
                    <?php if ($prev_val == $row['Class'] . '_' . $row['division']) { ?>
                        <tr class="bodyarea">
                            <td class="col1"><?php echo $sino; ?>.</td>
                            <td class="col2"><?php echo $row['Admn_No']; ?></td>
                            <td class="col3"><?php echo $row['student_name']; ?></td>
                        </tr>
                    <?php } else { ?>
                        <tr class="header">
                            <td colspan="2" style="text-align:left;">
                                <h4>
                                    &nbsp;Class : <?php echo $row['Class']; ?>
                                </h4>

                            </td>
                            <td colspan="1" style="text-align:left;">
                                <h4>
                                    &nbsp;Division : <?php echo (null !== (trim($row['division'])) && !empty(trim($row['division']))) ? $row['division'] : 'No Division.';    ?> </h4>
                            </td>
                        </tr>
                        <tr class="bodyarea">
                            <td class="col1"><?php echo $sino; ?>.</td>
                            <td class="col2"><?php echo $row['Admn_No']; ?></td>
                            <td class="col3"><?php echo $row['student_name']; ?></td>
                        </tr>
                <?php
                        $prev_val = $row['Class'] . '_' . $row['division'];
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