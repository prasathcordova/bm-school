<div class="wrapper wrapper-content animated fadeInRight" style="padding-top: 1px !important;padding-left: 0px !important;padding-right: 0px !important;">
    <div class="row" style="margin-left: -29px !important; margin-right: -30px !important;">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title" style="border-bottom-color:#23C6C8!important">
                    <h5 style="color: #1c84c6;"><?php echo isset($sub_title) ? $sub_title : "NO TITLE PROVIDED" ?></h5>
                    <div class="ibox-tools" id="add_type">
                        <a href="javascript:void(0)" onclick="allotment_student_passenger();" class="btn btn btn-sm" data-toggle="tooltip" data-placement="top" title="Go to previous page"><i class="fa fa-reply"></i> Back</a>
                    </div>
                </div>
                <div class="ibox-content" id="faculty_loader">
                    <div class="sk-spinner sk-spinner-wave">
                        <div class="sk-rect1"></div>
                        <div class="sk-rect2"></div>
                        <div class="sk-rect3"></div>
                        <div class="sk-rect4"></div>
                        <div class="sk-rect5"></div>
                    </div>
                    <div class="clearfix"></div>
                    <div class="wrapper wrapper-content animated fadeInRight" id="student-data-container">

                        <div class="row">
                            <div class="col-lg-12">
                                <div id="curd-content" style="display: none;"></div>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label class="control-label" style="color:#1c84c6;">Trip:</label>
                                    <select name="attr_select" id="attr_select" class="form-control " style="width:100%;" onchange="list_student_allocation(1,this.value);">

                                        <option selected value="-1">Select</option>
                                        <!-- <option value="ALL">ALL</option> -->
                                        <?php
                                        if (isset($trip_details) && !empty($trip_details)) {
                                            foreach ($trip_details as $trip) {
                                                if ($trip['id'] == $selected_trip)
                                                    echo '<option selected value ="' . $trip['id'] . '">' . $trip['tripName'] . '</option>';
                                                else
                                                    echo '<option value ="' . $trip['id'] . '">' . $trip['tripName'] . '</option>';
                                            }
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <table id="data_tbl" class="table table-striped table-bordered table-hover dataTables-example">
                                    <thead>
                                        <tr>
                                            <th>Trip</th>
                                            <th>Travel Type</th>
                                            <th>Stop Name</th>
                                            <th>Student Name</th>
                                            <th>Batch</th>
                                            <th>Admission No</th>
                                            <!-- <th>Class </th> -->
                                            <th>With Effect From</th>
                                            <th>Task</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        // dev_export($span_size);
                                        // die;
                                        $breaker = 0;
                                        $i = 0;
                                        $k = 0;
                                        $j = 0;
                                        if (isset($trip_student_data) && !empty($trip_student_data)) {
                                            foreach ($trip_student_data as $trip_id => $data) {
                                                $i = 1;
                                        ?>
                                                <?php
                                                foreach ($data['travel_type'] as $travel_type => $data_travel) {
                                                    $j = 1;
                                                    if (isset($data['travel_type'][$travel_type])) {
                                                        foreach ($data['travel_type'][$travel_type] as $stop_id => $data_pick) {
                                                            $k = 1; ?>
                                                            <?php if (isset($data_pick['student_data'])) { ?>
                                                                <?php foreach ($data_pick['student_data'] as $stud_data) { ?>
                                                                    <tr>
                                                                        <?php if ($i == 1) { ?>
                                                                            <td title="<?php echo $data['trip_name'] ?>" rowspan=<?php echo $span_size['total_span'][$trip_id] ?>>
                                                                                <?php echo strlen($data['trip_name']) > 10 ? substr($data['trip_name'], 0, 7) . '...' : $data['trip_name'] ?>
                                                                            </td>
                                                                        <?php } ?>
                                                                        <?php if ($j == 1) {
                                                                            $travel_type_span = $span_size['travel_type_span'][$travel_type][$trip_id];
                                                                        ?>
                                                                            <td rowspan=<?php echo $travel_type_span  ?>><?php echo $travel_type ?></td>
                                                                        <?php } ?>
                                                                        <?php if ($k == 1) {
                                                                            $stop_span = $span_size['stop_span'][$trip_id][$travel_type][$stop_id]; ?>
                                                                            <?php if (isset($data_pick['pickup_name'])) {
                                                                                $stop_name = $data_pick['pickup_name'];
                                                                            } else {
                                                                                $stop_name = $data_pick['drop_pickupName'];
                                                                            } ?>
                                                                            <td title="<?php echo $stop_name ?>" rowspan=<?php echo $stop_span; ?>>
                                                                                <?php echo strlen($stop_name) > 10 ? substr($stop_name, 0, 7) . '...' : $stop_name ?>
                                                                            </td>
                                                                        <?php } ?>

                                                                        <td><?php echo $stud_data['student_name']; ?></td>
                                                                        <td>
                                                                            <?php
                                                                            if ($stud_data['batch_name'] != '') {
                                                                                $splitted_batch_array = explode('/', $stud_data['batch_name']);
                                                                                // dev_export($stud_data['batch_name']);exit;
                                                                                //echo substr($stud_data['batch_name'], 0, 10) . '<br/>' . substr($stud_data['batch_name'], 10);
                                                                                echo $splitted_batch_array[0] . '/' . $splitted_batch_array[1] . '/' . $splitted_batch_array[2] . '/' . $splitted_batch_array[3] . '<br/>' . '/' . $splitted_batch_array[4] . '/' . $splitted_batch_array[5];
                                                                            } else {
                                                                                echo $stud_data['class_name'];
                                                                            } ?>
                                                                        </td>
                                                                        <td><?php echo $stud_data['Admn_No']; ?></td>
                                                                        <!-- <td><?php echo $stud_data['class_name']; ?></td> -->
                                                                        <td><?php echo $stud_data['effect_from']; ?></td>
                                                                        <td>
                                                                            <?php if ($stud_data['is_update'] == 1) { ?>
                                                                                <a class="btn btn-xs btn-info" href="javascript:void(0);" onclick="transport_details('<?php echo $stud_data['student_id'] ?>', '<?php echo $stud_data['Admn_No'] ?>');" data-toggle="tooltip" data-placement="right" title="Edit Allocation for <?php echo $stud_data['student_name']; ?>" data-original-title="Edit Allocation for <?php echo $stud_data['student_name']; ?>"><i class="fa fa-edit"></i>Update</a>
                                                                            <?php } else {
                                                                                echo "Deallocated";
                                                                            }  ?>
                                                                        </td>
                                                                    </tr>
                                                                <?php
                                                                    $i++;
                                                                    $j++;
                                                                    $k++;
                                                                } ?>
                                                            <?php } ?>

                                                <?php }
                                                    }
                                                }



                                                ?>
                                                <!-- <td><a href="javascript:void(0);" onclick="update_pickuppoint_fees('<?php echo $data['id']; ?>', '<?php echo $data['pickpointName']; ?>');" data-toggle="tooltip" data-placement="right" title="Update <?php echo $data['pickpointName']; ?>-Fees" data-original-title="<?php echo $data['pickpointName']; ?>"> <small class="text-navy">Update Fees</small></a></td> -->
                                                <!-- </tr> -->
                                            <?php

                                            }
                                        } else { ?>
                                            <tr>
                                                <td align="center" colspan="8">No Data Found</td>
                                            </tr>
                                        <?php }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<script type="text/javascript">
    $('#attr_select').select2({
        'theme': 'bootstrap'
    });

    function transport_details(studentid, admn_no) {
        var ops_url = baseurl + 'transport/show-student-transport-details';
        $.ajax({
            type: "POST",
            cache: false,
            async: false,
            url: ops_url,
            data: {
                "load": 1,
                "studentid": studentid,
                "admn_no": admn_no
            },
            success: function(result) {
                var data = JSON.parse(result);
                if (data.status == 1) {
                    $('#data-view').html('');
                    $('#data-view').html(data.view);
                    $('html, body').animate({
                        scrollTop: 0
                    }, 1000);
                } else {
                    if (data.message) {
                        swal('', data.message, 'info');
                        return false;
                    } else {
                        swal('', 'There is no data regarding the selected students. Please contact administrator for further assistance', 'info');
                        return false;
                    }
                }

            }
        });
    }
</script>