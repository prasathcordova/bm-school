<html>

<head>
</head>

<body>
    <?php
    echo $this->load->view('reports/report_view/header');
    ?>

    <table class="table table-bordered" width="100%" cellpadding="5">
        <thead>
            <tr>
                <!-- <th>Pickup/Drop Point</th> -->
                <!-- <th>Travel Type</th> -->
                <!-- <th>Trip</th> -->
                <th>Student Name</th>
                <th>Admission No.</th>
                <th>Class </th>
                <th>Effective Date </th>
            </tr>
        </thead>
        <tbody>
            <?php
            // dev_export($trip_student_data);
            // die;
            $breaker = 0;
            $i = 0;
            $k = 0;
            $j = 0;
            if (isset($report_data) && !empty($report_data)) {
                foreach ($report_data as $stop_id => $data) {
                    $i = 1;
            ?>
                    <tr>
                        <td colspan="4" style="font-weight:bold"> Pickup/Drop Point : <?php echo $data['stop_name'] ?></td>
                    </tr>
                    <?php
                    foreach ($data['travel_type'] as $travel_type => $data_travel) {
                        $j = 1;
                        $size_pickuppoint = isset($data['travel_type']['Pickup']) ? sizeof($data['travel_type']['Pickup']) : 0;
                        $size_droppoint = isset($data['travel_type']['Drop']) ? sizeof($data['travel_type']['Drop']) : 0;
                        $trip_rowspan = $size_pickuppoint + $size_droppoint;  ?>
                        <tr>
                            <td colspan="4" style="font-style:italic">Travel Type : <?php echo $travel_type ?></td>
                        </tr>
                        <?php
                        if (isset($data['travel_type'][$travel_type])) {
                            foreach ($data['travel_type'][$travel_type] as $trip_id => $data_trip) {

                                $k = 1; ?>
                                <tr>
                                    <td colspan="4" style="font-style:italic">Trip : <?php echo isset($data_trip['pick_trip_name']) ? $data_trip['pick_trip_name'] : $data_trip['drop_trip_name']; ?></td>
                                </tr>
                                <?php foreach ($data_trip['student_data'] as $stud_data) {
                                ?>
                                    <tr>
                                        <?php if ($i == 1) { ?>
                                            <!-- <td rowspan=<?php echo $span_size['total_span'][$stop_id] ?>><?php echo $data['stop_name'] ?></td> -->
                                        <?php } ?>
                                        <?php if ($j == 1) {
                                            $travel_type_span = $span_size['travel_type_span'][$travel_type][$stop_id];
                                        ?>
                                            <!-- <td rowspan=<?php echo $travel_type_span ?>><?php echo $travel_type ?></td> -->
                                        <?php } ?>
                                        <?php if ($k == 1) {
                                            $trip_span = $span_size['trip_span'][$stop_id][$travel_type][$trip_id]; ?>
                                            <!-- <td rowspan=<?php echo $trip_span ?>><?php echo isset($data_trip['pick_trip_name']) ? $data_trip['pick_trip_name'] : $data_trip['drop_trip_name']; ?></td> -->
                                        <?php } ?>

                                        <td><?php echo $stud_data['student_name']; ?></td>
                                        <td><?php echo $stud_data['Admn_No']; ?></td>
                                        <td><?php echo $stud_data['class_name']; ?></td>
                                        <td><?php echo $stud_data['transport_dates']; ?></td>

                                    </tr>
                    <?php
                                    $i++;
                                    $j++;
                                    $k++;
                                }
                            }
                        }
                    }



                    ?>
                    <!-- <td><a href="javascript:void(0);" onclick="update_pickuppoint_fees('<?php echo $data['id']; ?>', '<?php echo $data['pickpointName']; ?>');" data-toggle="tooltip" data-placement="right" title="Update <?php echo $data['pickpointName']; ?>-Fees" data-original-title="<?php echo $data['pickpointName']; ?>"> <small class="text-navy">Update Fees</small></a></td> -->
                    <!-- </tr> -->
            <?php

                }
            }
            ?>
        </tbody>
    </table>
</body>

</html>