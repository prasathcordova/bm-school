<div class="col-lg-12">
    <div class="row">
        <?php
        $current_inst_acd_year = $this->session->userdata('acd_year');
        if (isset($details_data) && !empty($details_data) && is_array($details_data)) {
            $breaker = 0;
            foreach ($details_data as $student) {
        ?>
                <input type="hidden" id="inst_acd_year" value="<?php echo $current_inst_acd_year; ?>">
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
                            ?>
                            <img alt="image" class="img-circle" src="<?php echo $profile_image; ?>">
                            <h3 class="m-b-xs"><strong><?php echo $student['student_name'] ?></strong></h3>
                            <br>
                            <div class="font-bold"><b>Admission No. : </b><?php echo $student['Admn_No'] ?></div>
                            <div class="font-bold"><b>Class : </b><?php echo $student['classname'] ?></div>
                            <div class="font-bold font12"><b>Batch : </b><?php echo $student['batchname'] ?></div>
                        </a>

                        <div class="contact-box-footer">
                            <div class="m-t-xs btn-group">
                                <?php if (trim($student['StatusFlag']) == 'L') { ?>
                                    <a title="<?php echo $student['student_name'] ?> is Long Absentee" class="btn btn-md btn-danger"><i class="fa fa-user-plus"></i> Long Absentee</a>
                                <?php } else { ?>
                                    <a href="javascript:void(0);" title="Non periodic Allocation of Fee to <?php echo $student['student_name'] ?> " onclick="non_periodic_allocation_detail('<?php echo $student['student_id']; ?>','<?php echo $student['student_name'] ?>',<?php echo $student['Cur_AcadYr'] ?>)" class="btn btn-md btn-info"><i class="fa fa-user-plus"></i> Allocate Fee</a> <!-- Non Periodic -->
                                <?php } ?>
                                <!-- Changed by SALAHUDHEEN PA May 31, 2019-->

                                <!--<a style="padding-top: 5px;" href="javascript:void(0);" title="Periodic allocation of Fee to <?php echo $student['student_name'] ?> " onclick="periodic_allocation_detail('<?php echo $student['student_id']; ?>','<?php echo $student['student_name'] ?>')" class="btn btn-xs btn-white"><i class="fa fa-user-plus"></i>&nbsp Periodic&nbsp Allocation &nbsp Fee</a>-->
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
        } else {
            ?>
            <div class="col-lg-12">
                <div class="contact-box text-center">
                    No Data Found
                </div>
            </div>
        <?php  }  ?>
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


    function non_periodic_allocation_detail(studentid, studentname, acdyear_st) {
        var inst_acd_year = $('#inst_acd_year').val();
        if (inst_acd_year == acdyear_st) {
            var batchid = $('#batchid').val();
            var ops_url = baseurl + 'fees/show-nonperiodicfee-details';
            $.ajax({
                type: "POST",
                cache: false,
                async: false,
                url: ops_url,
                data: {
                    "load": 1,
                    "studentid": studentid,
                    "batchid": batchid,
                    "studentname": studentname
                },
                success: function(data) {
                    $('#data-view').html('');
                    $('#data-view').html(data);
                    $('html, body').animate({
                        scrollTop: $("#data-view").offset().top
                    }, 1000);
                }
            });
        } else {
            swal('', 'Please Do Promotion of ' + studentname + ' first', 'warning');
            return false;
        }
    }

    function periodic_allocation_detail(studentid, studentname) {
        var batchid = $('#batchid').val();
        var ops_url = baseurl + 'fees/show-periodicfee-details';
        $.ajax({
            type: "POST",
            cache: false,
            async: false,
            url: ops_url,
            data: {
                "load": 1,
                "studentid": studentid,
                "batchid": batchid,
                "studentname": studentname
            },
            success: function(data) {
                $('#data-view').html('');
                $('#data-view').html(data);
                $('html, body').animate({
                    scrollTop: $("#data-view").offset().top
                }, 1000);
            }
        });
    }
</script>