<div class="row wrapper border-bottom white-bg page-heading" style="padding-top: 6px !important;">
    <div class="col-lg-10 col-md-8 col-sm-8 col-xs-12">
        <h2 style="font-size: 20px;">
            <?php echo isset($title) ? $title : "NO TITLE PROVIDED" ?>
        </h2>
        <ol class="breadcrumb">
            <?php
            if (isset($bread_crump_data) && !empty($bread_crump_data)) {
                echo $bread_crump_data;
            }
            ?>
        </ol>
    </div>
</div>
<div id="student-profile-content">
    <div class="wrapper wrapper-content animated fadeInRight" style="padding-top: 1px !important;padding-left: 0px !important;padding-right: 0px !important;">
        <div class="row" style="margin-left: -29px !important; margin-right: -30px !important;">
            <div class="col-lg-12">
                <div class="ibox float-e-margins">
                    <div class="ibox-content" id="faculty_loader">
                        <div class="sk-spinner sk-spinner-wave">
                            <div class="sk-rect1"></div>
                            <div class="sk-rect2"></div>
                            <div class="sk-rect3"></div>
                            <div class="sk-rect4"></div>
                            <div class="sk-rect5"></div>
                        </div>
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
                                            <div class="contact-box-footer">
                                                <button class="btn btn-xs btn-info pull-left" title="Click to enter details" onclick="enter_sponsered_deatils(<?php echo $student['student_id']; ?>)">Enter Details</button>
                                                <button class="btn btn-xs btn-info pull-right" title="Click to view details" >View Details</button>
                                                <div class="clearfix"></div>
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
                                    No data available
                                </div>
                            <?php
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
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

    function edit_profile(studentid) {
        var ops_url = baseurl + 'registration/edit-profile';
        $.ajax({
            type: "POST",
            cache: false,
            async: false,
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
                    alert('No data loaded');
                }
            }
        });
    }

    function send_personal_email(student_id, acd_id, batchid, courseid) {
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
                "courseid": courseid
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

    //create function by vinoth @ 26-06-2019 15:26
    function enter_sponsered_deatils(studentid) {
        var batchid = $('#batchid').val();
        var ops_url = baseurl + 'profilestudent/show-profile-for-sponsered-stud';
        $.ajax({
            type: "POST",
            cache: false,
            async: false,
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
                    scrollTop: $("#content").offset().top
                }, 1000);
            }
        });
    }

    function profile_detail(studentid) {
        var batchid = $('#batchid').val();
        var ops_url = baseurl + 'profilestudent/show-studentprofile/';
        $.ajax({
            type: "POST",
            cache: false,
            async: false,
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
                    scrollTop: $("#content").offset().top
                }, 1000);
            }
        });
    }

    function fees_detail(studentid) {
        var ops_url = baseurl + 'longabsentee/long-fees/';
        $.ajax({
            type: "POST",
            cache: false,
            async: false,
            url: ops_url,
            data: {
                "load": 1,
                "studentid": studentid
            },
            success: function(data) {
                $('#content').html('');
                $('#content').html(data);
                $('html, body').animate({
                    scrollTop: $("#content").offset().top
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
        var searchname = $('#searchname').val();
        var ops_url = baseurl + 'registration/search-profilename';
        $.ajax({
            type: "POST",
            cache: false,
            async: false,
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
                    //alert change by vinothkumar k @ 14-05-2019 11:35
                    swal('', 'No data available !', 'info');
                }
            }
        });
    }
</script>