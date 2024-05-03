<div class="col-lg-12">
    <div class="row">
        <?php

        if (isset($details_data) && !empty($details_data) && is_array($details_data)) {
            $breaker = 0;
            foreach ($details_data as $student) {
        ?>
                <div class="col-lg-4">
                    <div class="contact-box center-version">
                        <?php
                        $profile_image = "";
                        if (!empty(get_student_image($student['student_id']))) {
                            $profile_image = get_student_image($student['student_id']);
                        } else
                                if (isset($student['profile_image']) && !empty($student['profile_image'])) {

                            $profile_image = "data:image/jpeg;base64," . $student['profile_image'];
                        } else {
                            if (isset($student['profile_image_alternate']) && !empty($student['profile_image_alternate'])) {
                                $profile_image = $student['profile_image_alternate'];
                            } else {
                                $profile_image = base_url('assets/img/a0.jpg');
                            }
                        }
                        ?>
                        <!--<span class="label label-warning pull-right">Official</span>-->
                        <a href="javascript:void(0);" style="height:380px">

                            <img alt="image" class="img-circle" src="<?php echo $profile_image; ?>">
                            <h3 class="m-b-xs"><strong><?php echo $student['student_name'] ?></strong></h3>

                            <div class="font-bold">Admission #:<?php echo $student['Admn_No'] ?></div>
                            <div class="font-bold">Batch #:<br /><?php echo $student['Batch_Name'] ?></div><br />
                            <div style="text-align:left">
                                <div class=""><span class="label label-warning">Pickup</span><br />
                                    <i class="fa fa-map-marker"></i> <?php echo  $student['pickup_pickpointName'] != NULL ? $student['pickup_pickpointName'] : 'N/A' ?><br />
                                    <i class="fa fa-car"></i> <?php echo $student['pickup_tripName'] != NULL ? $student['pickup_tripName'] : 'N/A' ?>
                                </div>
                                <br />
                                <div class=""><span class="label label-primary">Drop</span><br />
                                    <i class="fa fa-map-marker"></i> <?php echo $student['drop_pickupName'] != NULL ? $student['drop_pickupName'] : 'N/A' ?><br />
                                    <i class="fa fa-car"> </i> <?php echo $student['drop_tripName'] != NULL ? $student['drop_tripName'] : 'N/A' ?>
                                </div>
                            </div>
                        </a>
                        <div class="contact-box-footer">
                            <div class="m-t-xs btn-group">
                                <a href="javascript:void(0);" title="Transport Allotment of <?php echo $student['student_name'] ?> " onclick="transport_details('<?php echo $student['student_id']; ?>', '<?php echo $student['Admn_No'] ?>')" class="btn btn-xs btn-info"><i class="fa fa-edit"></i> Update Transport Details</a>
                            </div>
                        </div>

                    </div>
                </div>
        <?php
                // if ($breaker == 3) {
                //     echo '<div class="clearfix"></div>';
                //     $breaker = 0;
                // } else {
                //     $breaker++;
                // }
            }
        } else {
            echo '<div class="col-lg-4">No Student details found</div>';
        }
        ?>
    </div>
</div>

<script>
    $(document).ready(function() {

        $(".select2_demo_1").select2({
            "theme": "bootstrap",
            "width": "100%"

        });
        $(".select2_demo_2").select2({
            "theme": "bootstrap",
            "width": "100%"
        });
        $(".select2_demo_3").select2({
            "theme": "bootstrap",
            "width": "100%"
        });

        $('#data_1 .input-group.date').datepicker({
            todayBtn: "linked",
            keyboardNavigation: false,
            forceParse: false,
            calendarWeeks: true,
            autoclose: true
        });

        $('#search_student').hide();

        $('.i-checks').iCheck({
            checkboxClass: 'icheckbox_square-green',
            radioClass: 'iradio_square-green',
        });


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