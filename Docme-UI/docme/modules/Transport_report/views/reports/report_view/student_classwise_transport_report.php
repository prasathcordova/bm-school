<html>

<head>
</head>

<body>
    <?php
    echo $this->load->view('reports/report_view/header');
    ?>

    <table class="table table-bordered" width="100%" cellpadding="5">
        <thead>
            <tr class="header">
                <!-- <td align="center">
                <h3>Class</h3>
            </td> -->
                <!-- <td align="center">
                <h3>Batch</h3>
            </td> -->
                <td align="center">
                    <h3>Admn No.</h3>
                </td>
                <td align="center">
                    <h3>Name</h3>
                </td>
                <td align="center">
                    <h3>Pickup Trip</h3>
                </td>
                <td align="center">
                    <h3>Pickup Point</h3>
                </td>
                <td align="center">
                    <h3>Drop Trip</h3>
                </td>
                <td align="center">
                    <h3>Drop Point</h3>
                </td>
                <td align="center">
                    <h3>Effective Date</h3>
                </td>
                <td align="center">
                    <h3>Mobile</h3>
                </td>
            </tr>
        </thead>
        <tbody>
            <?php
            if (isset($report_data) && !empty($report_data)) {
                foreach ($report_data as $class_id => $class_data) {
                    $i = 1; ?>
                    <tr>
                        <td colspan="8" align="left" style="font-weight:bold">Class : <?php echo $class_data['class_name'] ?></td>
                    </tr>
                    <?php
                    foreach ($class_data['batch_details'] as $batch_id => $batch_data) {
                        $j = 1; ?>
                        <tr>
                            <td colspan="8" align="left" style="font-style:italic">Batch : <?php echo $batch_data['Batch_Name'] ?></td>
                        </tr>
                        <?php
                        foreach ($batch_data['student_data'] as $student_id => $student_data) { ?>

                            <tr>
                                <?php if ($i == 1) { ?>
                                    <!-- <td rowspan="<?php echo $span_size['total_span'][$class_id] ?>" align="left"><?php echo $class_data['class_name'] ?></td> -->
                                <?php } ?>
                                <?php if ($j == 1) { ?>
                                    <!-- <td rowspan="<?php echo $span_size['batch_span'][$class_id]['batch_span'][$batch_id] ?>" align="left"><?php echo $batch_data['Batch_Name'] ?></td> -->
                                <?php } ?>
                                <td align="left"><?php echo $student_data['Admn_No'] ?></td>
                                <td align="left"><?php echo $student_data['student_name'] ?></td>
                                <td align="left"><?php echo $student_data['pickup_tripName'] ?></td>
                                <td align="left"><?php echo $student_data['pickup_pickpointName'] ?></td>
                                <td align="left"><?php echo $student_data['drop_tripName'] ?></td>
                                <td align="left"><?php echo $student_data['drop_pickupName'] ?></td>
                                <td align="left"><?php echo $student_data['transport_dates'] ?></td>
                                <td align="left"><?php echo $student_data['phone'] ?></td>
                            </tr>
                    <?php
                            $i++;
                            $j++;
                        }
                    }
                    ?>


            <?php }
            } else {
                echo '<h5>No Report Found</h5>';
            } ?>

        </tbody>
    </table>
</body>

</html>