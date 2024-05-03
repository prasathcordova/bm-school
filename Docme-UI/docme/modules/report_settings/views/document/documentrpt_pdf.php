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
            $admn_no = '';
            $count = 1;
            foreach ($details_data as $row) {
                if ($admn_no != $row['Admn_No']) {
                    ?>

                    <tr class="bodyarea">
                        <td colspan="2" class="t-left">
                            <h4><?php echo $row['student_name'] . ' - (' . $row['Admn_No'] . ')'; ?></h4>
                        </td>
                    </tr>
                <?php
                            $admn_no = $row['Admn_No'];
                            $count = 1;
                        }
                        ?>
                <tr class="bodyarea">
                    <td colspan="2" class="t-left">
                        <span style="padding:5px; color:#f00;"><?php echo $count . '.'; ?></span> Document Type : <?php echo $row['Description'] . " ( " . $row['Certi_Name'] . " ) "; ?>
                    </td>
                </tr>
                <!--                        <tr>
                            <td class="col2" colspan="2">
                                Admission No. : <?php echo $row['Admn_No']; ?>
                            </td>
                        </tr>-->
                <tr class="bodyarea">
                    <td colspan="2" class="t-left">
                        &nbsp;&nbsp;&nbsp;&nbsp;Document No: <?php echo $row['Certi_No']; ?>
                    </td>
                </tr>

            <?php
                    $count++;
                }
            } else {
                ?>
            <thead>
                <tr class="bodyarea">
                    <td colspan="3" align="center"> No Data Available </td>
                </tr>
            </thead>
        <?php }
        ?>
    </table>
</body>

</html>