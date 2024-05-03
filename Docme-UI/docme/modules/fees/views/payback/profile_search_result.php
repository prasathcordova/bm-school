<div class="col-lg-12">
    <div class="row">
        <?php
        if (isset($details_data) && !empty($details_data) && is_array($details_data)) {
            $breaker = 0;
            foreach ($details_data as $student) {
        ?>
                <div class="col-lg-4">
                    <div class="contact-box center-version">
                        <!--<span class="label label-warning pull-right">Official</span>-->
                        <a href="javascript:void(0);" style="height:250px !important;">
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
                            if (trim($student['StatusFlag']) == 'L') {
                                $stud_status = '<div class="font-bold font12 text-danger"><b>Long Absentee</b></div>';
                            } else {
                                $stud_status = '<div class="font-bold font12 text-danger"><b>&nbsp;</b></div>';
                            }
                            ?>
                            <img alt="image" class="img-circle" src="<?php echo $profile_image; ?>">
                            <h3 class="m-b-xs" title="<?php echo $student['student_name']; ?>"><strong><?php echo substr($student['student_name'], 0, 20); ?></strong></h3>
                            <br>
                            <div class="font-bold"><b>Admission No. : </b><?php echo $student['Admn_No'] ?></div>
                            <div class="font-bold"><b>Class : </b><?php echo $student['classname'] ?></div>
                            <div class="font-bold font12"><b>Batch : </b><?php echo $student['batchname'] ?></div>

                        </a>

                        <div class="contact-box-footer">
                            <?php echo $stud_status; ?>
                            <div class="m-t-xs btn-group">
                                <a href="javascript:void(0);" title="Payback Request of student,  <?php echo $student['student_name'] ?> " onclick="payback_request('<?php echo $student['student_id']; ?>', '<?php echo $student['student_name'] ?>')" class="btn btn-md btn-info"><i class="fa fa-user-plus"></i> Payback Request</a>
                            </div>
                        </div>

                    </div>
                </div>
        <?php
                //                if ($breaker == 3) {
                //                    echo '<div class="clearfix"></div>';
                //                    $breaker = 0;
                //                } else {
                //                    $breaker ++;
                //                }
            }
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


    function payback_request(studentid, studentname) {
        var ops_url = baseurl + 'payback/show-add-new-payback-request';
        $.ajax({
            type: "POST",
            cache: false,
            async: false,
            url: ops_url,
            data: {
                "load": 1,
                "studentid": studentid,
                "student_name": studentname
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