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
    <?php
    if (isset($details_data) && !empty($details_data)) {
        foreach ($details_data as $row) {
            $relation = $row['Relation'];
            //            dev_export($relation);die;
        }
    }
    if ($relation == 'F') {
        $info = "Father";
    } else if ($relation == 'M') {
        $info = "Mother";
    } else {
        $info = "Guardian";
    }

    ?>

    <table class="table table-bordered" width="100%">
        <thead>
            <?php
            $cls = 0;
            if (isset($details_data) && !empty($details_data)) {
                foreach ($details_data as $row) {
                    $acd = $row['Description'];
                    $class = '';
                    if ($batch_id == 1000 && $class_id == 1000) {
                        $class = 'ALL';
                    } else {
                        $class = $row['Class'];
                    }
                    // $class = $cls == 1000 ? 'ALL' : $row['Class'];
                    $date = date("d-m-Y");
                } ?>
                <tr class="header">
                    <td colspan="6" style="text-align:left; padding:5px 0 5px 5px;">Academic Year : <?php echo $acd ?> </td>
                    <td colspan="2" style="text-align:right; padding:5px 5px 5px 0px;">Date : <?php echo $date ?> </td>
                </tr>
                <tr class="header">
                    <td colspan="8" style="text-align:left; padding:5px 0 5px 5px;">Class : <?php echo $class ?> </td>
                </tr>
                <tr class="header">
                    <td colspan="8" style="text-align:left; padding:5px 0 5px 5px;">This report based on <b style="font-size:15px;"><?php echo $info ?></b> relation.</td>
                </tr>
            <?php }
            ?>
            <tr class="header">
                <td style="width:5%;">Sl.No.</td>
                <td style="width:10%;">Admission No.</td>
                <td style="width:13%;">Student Name</td>
                <td style="width:12%;">Mobile</td>
                <td style="width:15%;"><?php echo $uuid_name; ?></td>
                <td style="width:15%;"><?php echo $info; ?> Name</td>
                <td style="width:15%;">Contact Address</td>
                <td style="width:15%;">Email</td>
            </tr>
            <!--<hr>-->
        </thead>
        <tbody>
            <?php
            $prev_val = "";
            $sino = 1;
            $class = "";
            if (isset($details_data) && !empty($details_data)) {
                foreach ($details_data as $row) {
                    if ($prev_val == $row['Batch']) { ?>
                        <tr class="bodyarea">
                            <td><?php echo $sino; ?>.</td>
                            <td><?php echo $row['Admn_No']; ?></td>
                            <td style="text-transform: uppercase;"><?php echo $row['student_name']; ?></td>
                            <td><?php echo $row['Phone3']; ?></td>
                            <td><?php echo $row['Adhar_No']; ?></td>
                            <td style="text-transform: uppercase;"><?php echo $row['Parent_Name']; ?></td>
                            <td style="text-transform: uppercase;"><?php echo $row['Addresss']; ?></td>
                            <td><?php echo $row['EMAIL']; ?></td>
                        </tr>
                        <?php } else {


                        if ($class != $row['Class']) {
                            $class = $row['Class'];
                        ?>
                            <tr class="header">
                                <td colspan="8">
                                    <h4>Class: <?php echo $row['Class']; ?></h4>
                                </td>
                            </tr>
                        <?php   } ?>
                        <tr class="header">
                            <td colspan="8">
                                <h4>Batch : <?php echo $row['Batch']; ?></h4>
                            </td>
                        </tr>
                        <tr class="bodyarea">
                            <td><?php echo $sino; ?>.</td>
                            <td><?php echo $row['Admn_No']; ?></td>
                            <td><?php echo $row['student_name']; ?></td>
                            <td><?php echo $row['Phone3']; ?></td>
                            <td><?php echo $row['Adhar_No']; ?></td>
                            <td><?php echo $row['Parent_Name']; ?></td>
                            <td><?php echo $row['Addresss']; ?></td>
                            <td><?php echo $row['EMAIL']; ?></td>
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