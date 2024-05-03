<div class="row">
    <?php
    if (isset($details_data) && !empty($details_data) && is_array($details_data)) {
        $breaker = 0;
        foreach ($details_data as $student) {
    ?>
            <div class="col-lg-3">
                <div class="contact-box center-version">
                    <a href="javascript:void(0);" style="padding-bottom:5px !important;">
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
                        ?>
                        <img alt="image" class="img-circle" src="<?php echo $profile_image; ?>">
                        <h3 class="m-b-xs pro-name" style="overflow:hidden;height: 48px;"><strong><?php echo $student['student_name'] ?></strong></h3>
                        <!--write by vinoth 14-may-19 15:08 (start)-->
                        <div>
                            <p>Class : <?php
                                        if (isset($student['Description'])) {
                                            echo $student['Description'];
                                        } else {
                                            echo 'NIL';
                                        }
                                        ?></p>
                            <p style="height: 36px;">Batch : <?php
                                                                if (isset($student['Batch_Name'])) {
                                                                    echo $student['Batch_Name'];
                                                                } else {
                                                                    echo 'Un Assigned';
                                                                }
                                                                ?></p>
                        </div>
                    </a>
                    <div class="font-bold" style="text-align: center;padding-bottom: 6px;padding-top: 4px;">Admission No.:<?php echo $student['Admn_No'] ?></div>
                    <table class="table" style="margin-bottom:0px;">
                        <tbody>
                            <tr>
                                <td class="project-status">
                                    <span class="label" style="background-color:#999;color:#fff;"><?php echo $student['stud_status']; ?></span>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <div class="contact-box-footer">
                        <div class="m-t-xs btn-group">
                            <?php if (check_permission(503, 1096, 102)) { ?>
                                <a href="javascript:void(0);" onclick="profile_detail('<?php echo $student['student_id']; ?>')" class="btn btn-xs btn-white" title="Profile"><i class="fa fa-user"></i> Profile</a>
                                <!--a href="javascript:void(0);" onclick="send_personal_email('<?php echo $student['student_id']; ?>', '<?php echo $acdyr_id; ?>', '<?php echo $batch_id; ?>','<?php echo $student['Cur_Class']; ?>','<?php echo $student['student_name']; ?>','<?php echo $student['Batch_Name']; ?>','<?php echo $student['Admn_No'] ?>')" class="btn btn-xs btn-white " title="Email"><i class="fa fa-envelope"></i> Email</a-->
                            <?php }
                            if (check_permission(503, 1097, 102)) { ?>
                                <a href="javascript:void(0);" onclick="fees_detail('<?php echo $student['student_id']; ?>')" class="btn btn-xs btn-white" title="Fees"><i class="fa fa-rupee"></i> Fees</a>
                            <?php } ?>
                            <?php if (check_permission(503, 1095, 102) && in_array(trim($student['StatusFlag']), array('O', 'U', 'L'))) { ?>

                                <a href="javascript:void(0)" onclick="edit_profile(<?php echo $student['student_id']; ?>)" class="btn btn-xs btn-white" title="Profile Update"><i class="fa fa-edit"></i>Update</a>

                            <?php } ?>
                            <!-- <a href="javascript:void(0);" onclick="profile_detail('<?php echo $student['student_id']; ?>')" class="btn btn-xs btn-white" title="Profile"><i class="fa fa-user-plus"></i> Profile</a> -->
                            <!--a href="javascript:void(0);" onclick="send_personal_email('<?php echo $student['student_id']; ?>', '<?php echo $acdyr_id; ?>', '<?php echo $batch_id; ?>','<?php echo $student['Cur_Class']; ?>','<?php echo $student['student_name']; ?>','<?php echo $student['Batch_Name']; ?>','<?php echo $student['Admn_No'] ?>')" class="btn btn-xs btn-white " title="Email"><i class="fa fa-envelope"></i> Email</a-->
                            <!-- <a href="javascript:void(0);" onclick="fees_detail('<?php echo $student['student_id']; ?>')" class="btn btn-xs btn-white" title="Fees"><i class="fa fa-rupee"></i> Fees</a> -->
                        </div>
                    </div>

                </div>
            </div>
        <?php
            if ($breaker == 3) {
                echo '<div class="clearfix"></div>';
                $breaker = 0;
            } else {
                $breaker++;
            }
        }
    } else {
        ?>
        <div class="col-lg-12">
            No Data Available
        </div>
    <?php
    }
    ?>
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

    function edit_profile(studentid) {
        $('#faculty_loader').addClass('sk-loading');
        var ops_url = baseurl + 'registration/edit-profile';
        $.ajax({
            type: "POST",
            cache: false,
            //async: false,
            url: ops_url,
            data: {
                "load": 1,
                "studentid": studentid
            },
            success: function(result) {
                var data = JSON.parse(result)
                //                  alert(data.status);return;
                if (data.status == 1) {
                    //                     da alert('hi');return;

                    $('#content').html('');
                    $('#content').html(data.view);
                    var animation = "fadeInDown";
                    $("#content").show();
                    $('#content').addClass('animated');
                    $('#content').addClass(animation);
                    //                    $('#country_select').trigger('change')
                    //                    $('#add_type').hide();
                } else {
                    $('#faculty_loader').removeClass('sk-loading');
                    alert('No data loaded');
                }
            }
        });
    }

    function send_personal_email(student_id, acd_id, batchid, courseid, student_name, batch_name, admn_no) {
        var ops_url = baseurl + "emailstudent/composeemail";
        $.ajax({
            type: "POST",
            cache: false,
            async: false,
            url: ops_url,
            data: {
                "load": 1,
                "studentid": student_id,
                "batchid": batchid,
                "acd_id": acd_id,
                "courseid": courseid,
                "student_name": student_name,
                "batch_name": batch_name,
                "admn_no": admn_no
            },
            success: function(result) {

                var data = JSON.parse(result);
                if (data.status == 1) {
                    $('#content').html('');
                    $('#content').html(data.view);
                    $('html, body').animate({
                        scrollTop: $("#content").offset().top
                    }, 1000);
                } else {
                    swal('', 'An error encountered. Please try again later.', 'info');
                    return false;
                }

            }
        });
    }

    function profile_detail(studentid) {
        $('#faculty_loader').addClass('sk-loading');
        var batchid = $('#batchid').val();
        var ops_url = baseurl + 'profilestudent/show-studentprofile/';
        $.ajax({
            type: "POST",
            cache: false,
            //async: false,
            url: ops_url,
            data: {
                "load": 1,
                "studentid": studentid,
                "batchid": batchid
            },
            success: function(data) {
                $('#content').html('');
                $('#content').html(data);
                $('html, body').animate({
                    scrollTop: $("#content").offset().top - 50
                }, 1000);
            }
        });
    }

    function fees_detail(studentid) {
        $('#faculty_loader').addClass('sk-loading');
        var ops_url = baseurl + 'longabsentee/long-fees/';
        $.ajax({
            type: "POST",
            cache: false,
            //async: false,
            url: ops_url,
            data: {
                "load": 1,
                "studentid": studentid
            },
            success: function(data) {
                $('#content').html('');
                $('#content').html(data);
                $('html, body').animate({
                    scrollTop: $("#content").offset().top - 50
                }, 1000);
            }
        });
    }

    function show_search() {
        $('#search_student').slideDown("slow");
    }

    function hide_search() {
        $('#search_student').slideUp("slow");
    }


    function search_name(acdyr_id, batch_id) {
        $('#faculty_loader').addClass('sk-loading');
        var searchname = $('#searchname').val();
        var ops_url = baseurl + 'registration/search-profilename';
        $.ajax({
            type: "POST",
            cache: false,
            //async: false,
            url: ops_url,
            data: {
                "load": 1,
                "acdyr_id": acdyr_id,
                "batch_id": batch_id,
                "searchname": searchname
            },
            success: function(result) {
                var data = JSON.parse(result)
                if (data.status == 1) {
                    $('#student-data-container').html('');
                    $('#student-data-container').html(data.view);
                    var animation = "fadeInDown";
                    $("#student-data-container").show();
                    $('#student-data-container').addClass('animated');
                    $('#student-data-container').addClass(animation);
                    $('#add_type').hide();
                } else {
                    //alert change by vinothkumar k @ 14-05-2019 12:35
                    $('#faculty_loader').removeClass('sk-loading');
                    swal('', 'No data available', 'info');
                }
            }
        });
    }
</script>