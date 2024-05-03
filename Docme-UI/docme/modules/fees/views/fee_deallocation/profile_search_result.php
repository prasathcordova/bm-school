<hr>
<div class="col-lg-12">
    <div class="row">
        <?php
        // dev_export($details_data);
        if (isset($details_data) && !empty($details_data) && is_array($details_data)) {
            $breaker = 0;
            foreach ($details_data as $student) {
        ?>
                <div class="col-lg-4">
                    <div class="contact-box center-version">
                        <a href="javascript:void(0);" style="height:260px !important;">
                        <?php
                            $profile_image = "";
                            if (!empty(get_student_image($student['student_id']))) {
                                $profile_image = get_student_image($student['student_id']);
                            } else if (isset($student['profile_image']) && !empty($student['profile_image'])) {
                                $profile_image = "data:image/jpeg;base64," . $student['profile_image'];
                            } else {
                                if (isset($student['profile_image_alternate']) && !empty($student['profile_image_alternate'])) {
                                    $profile_image = $student['profile_image_alternate'];
                                } else {
                                    $profile_image = base_url('assets/img/a0.jpg');
                                }
                            }
                            if (trim($student['StatusFlag']) == 'L') {
                                $stud_status = '<div class="font-bold font12 text-danger"><b>Long Absentee</b></div>';
                            } else {
                                $stud_status = '<div class="font-bold font12 text-danger"><b>&nbsp;</b></div>';
                            }
                            ?>
                            <img alt="image" class="img-circle" src="<?php echo $profile_image; ?>">
                            <h3 class="m-b-xs" title="<?php echo $student['student_name']; ?>"><strong><?php echo substr($student['student_name'], 0, 20); ?></strong></h3>

                            <div class="font-bold"><b>Admission No. : </b><?php echo $student['Admn_No'] ?></div>
                            <div class="font-bold"><b>Class : </b><?php echo $student['classname'] ?></div>
                            <div class="font-bold font12"><b>Batch : </b><?php echo $student['batchname'] ?></div>
                        </a>

                        <div class="contact-box-footer">
                            <?php echo $stud_status; ?>
                            <div class="m-t-xs btn-group">
                                <?php if (trim($student['StatusFlag']) == 'L') { ?>
                                    <a href="javascript:void(0);" title="Enable / Disable Fee for <?php echo $student['student_name'] ?> " class="btn btn-md btn-danger disabled"><i class="fa fa-adjust"></i> Deallocate Fees</a>
                                <?php } else { ?>
                                    <!-- <a href="javascript:void(0);" title="Enable / Disable Fee for <?php echo $student['student_name'] ?> " onclick="view_payment_plan('<?php echo $student['student_id']; ?>', '<?php echo $student['student_name'] ?>')" class="btn btn-md btn-danger"><i class="fa fa-adjust"></i> Deallocate Fees</a> -->
                                    <a href="javascript:void(0);" title="Enable / Disable Fee for <?php echo $student['student_name'] ?> " onclick="get_fees_demnaded_for_student('<?php echo $student['student_id']; ?>', '<?php echo $student['student_name'] ?>')" class="btn btn-md btn-danger"><i class="fa fa-adjust"></i> Enable / Disable Fees</a>
                                <?php } ?>
                            </div>
                        </div>

                    </div>
                </div>
            <?php
            }
        } else {
            ?>
            <div class="col-lg-12">
                <div class="contact-box text-center">
                    No Data Found
                </div>
            </div>
        <?php
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


    function view_payment_plan(studentid, studentname) {
        var searchby = $('#searchby').val();
        var search_elements = $('#search_elements').val();

        var ops_url = baseurl + 'fees/view_payment_plan';
        $.ajax({
            type: "POST",
            cache: false,
            async: false,
            url: ops_url,
            data: {
                "load": 1,
                "studentid": studentid,
                "studentname": studentname,
                "searchby": searchby,
                "search_elements": search_elements,
                "feeid": -1
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
                        swal('', 'There was no data regarding the selected students. Please contact administrator for further assistance', 'info');
                        return false;
                    }
                }

            }
        });
    }

    function get_fees_demnaded_for_student(studentid, studentname) {
        var searchby = $('#searchby').val();
        var search_elements = $('#search_elements').val();

        var ops_url = baseurl + 'fees/get_fees_demnaded_for_student';
        $.ajax({
            type: "POST",
            cache: false,
            async: false,
            url: ops_url,
            data: {
                "load": 1,
                "studentid": studentid,
                "studentname": studentname,
                "searchby": searchby,
                "search_elements": search_elements,
                "feeid": -1
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
                        swal('', 'There was no data regarding the selected students. Please contact administrator for further assistance', 'info');
                        return false;
                    }
                }

            }
        });
    }
</script>