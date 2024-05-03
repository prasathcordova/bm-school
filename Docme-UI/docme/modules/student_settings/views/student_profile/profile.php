<style>
    .pro-name {
        height: 28px;
    }
</style>
<script src="<?php echo base_url('assets/plugins/validate/jquery.validate.min.js'); ?>"></script>
<div id="profile-detail-content">
    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10 col-md-8 col-sm-8 col-xs-12">
            <h2 style="font-size: 20px;">
                <?php echo isset($title) ? $title : "NO TITLE PROVIDED" ?>
            </h2>
            <ol class="breadcrumb">
                <?php
                if (isset($bread_crump_data) && !empty($bread_crump_data)) {
                    echo $bread_crump_data;
                }
                //                 dev_export($details_data);die;
                ?>
            </ol>
        </div>
    </div>
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
                            <div class="col-lg-12">
                                <div id="curd-content" style="display: none;"></div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12">
                                    <input type="hidden" name="batchid" id="batchid" value="<?php echo isset($batchid) && !empty($batchid) ? $batchid : ''; ?>" />
                                    <div class="clearfix"></div>
                                    <div class="wrapper wrapper-content animated fadeInRight" id="student-data-container" style="margin-left:15px;">
                                        <div class="row">
                                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                <div class="form-group">
                                                    <div class="form-line">
                                                        <!--                                                add autofocus attribute by vinoth @28-05-2019 17:06-->
                                                        <div class="input-group">
                                                            <input type="text" id="search_with_name_or_admission" name="search_with_name_or_admission" placeholder="Search student by Admission Number/Name" class=" form-control">
                                                            <span class="input-group-btn">
                                                                <button type="button" class="btn btn-info btn-sm" title="Search" onclick="search_with_name_or_admission('<?php echo $acdyr_id; ?>', '<?php echo $batch_id; ?>');"><i style="font-size:17px;" class="material-icons">search</i> </button>
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <?php
                                            if (isset($details_data) && !empty($details_data) && is_array($details_data)) {
                                                $breaker = 0;
                                            ?>
                                                <div class="col-lg-12">
                                                    <h5 class="text-muted">Total number of Students: <?php echo count($details_data); ?></h5>
                                                </div>
                                                <?php
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
                                                                <!--                                                        write by vinoth 14-may-19 15:08 (start) <?php echo isset($title) ? $title : "NO TITLE PROVIDED" ?> -->
                                                                <div>
                                                                    <p>Class :
                                                                        <?php echo isset($student['Description']) && !empty($student['Description']) ? $student['Description'] : 'NIL'; ?>
                                                                    </p>
                                                                    <p>Batch :
                                                                        <?php echo isset($student['Batch_Name']) && !empty($student['Batch_Name']) ? $student['Batch_Name'] : 'Un Assigned'; ?>
                                                                    </p>
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
                                                                    <!-- <?php //if (check_permission(503, 1095, 102)) { 
                                                                            ?>
                                                                        <tr>
                                                                            <td class="project-status">
                                                                                <a href="javascript:void(0)" onclick="edit_profile(<?php echo $student['student_id']; ?>)" title="Click Here For Profile Updation">
                                                                                    <span class="label label-primary"><?php echo 'Click Here For Profile Updation'; ?></span></a>
                                                                            </td>
                                                                        </tr>
                                                                    <?php //} 
                                                                    ?> -->
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
                                                    <h3 class=" text-muted">No data available.</h3>
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
        // This function Written by Vinoth Kumar K @ 09-05-2019 @ 11:02
        $('#search_with_name_or_admission').on("keypress", function(e) {
            if (e.keyCode == 13) {
                if ($('#search_with_name_or_admission').val().trim().length < 3) {
                    swal('', 'Enter atleast three characters.', 'info');
                    return false;
                } else {
                    search_with_name_or_admission('<?php echo $acdyr_id; ?>', '<?php echo $batch_id; ?>');
                }
            }
        });
        $('#searchstudent_admission_no').on("keypress", function(e) {
            if (e.keyCode == 13) {
                if ($('#searchstudent_admission_no').val().trim().length < 3) {
                    swal('', 'Enter atleast three characters.', 'info');
                    return false;
                } else {
                    searchstudent_admission_no('<?php echo $acdyr_id; ?>', '<?php echo $batch_id; ?>');
                }
            }
            if (/[0-9\s]+$/.test(e.key)) {
                return true;
            } else {
                return false;
            }
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

                    $('#profile-detail-content').html('');
                    $('#profile-detail-content').html(data.view);
                    var animation = "fadeInDown";
                    $("#profile-detail-content").show();
                    $('#profile-detail-content').addClass('animated');
                    $('#profile-detail-content').addClass(animation);
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
                    $('#profile-detail-content').html('');
                    $('#profile-detail-content').html(data.view);
                    $('html, body').animate({
                        scrollTop: $("#profile-detail-content").offset().top
                    }, 1000);
                } else {
                    swal({
                        title: "Mail id is not available",
                        text: "Still want to continue ?",
                        type: "warning",
                        showCancelButton: true,
                        confirmButtonColor: "#DD6B55",
                        confirmButtonText: "Continue",
                        closeOnConfirm: true
                    }, function(isConfirm) {
                        if (isConfirm) {
                            $('#profile-detail-content').html('');
                            $('#profile-detail-content').html(data.view);
                            $('html, body').animate({
                                scrollTop: $("#profile-detail-content").offset().top
                            }, 1000);
                        }
                    });
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
                $('#profile-detail-content').html('');
                $('#profile-detail-content').html(data);
                $('html, body').animate({
                    scrollTop: $("#profile-detail-content").offset().top - 50
                }, 1000);
            }
        });
    }

    function fees_detail(studentid) {
        $('#faculty_loader').addClass('sk-loading');
        var batchid = $('#batchid').val();
        var ops_url = baseurl + 'longabsentee/long-fees/';
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

    function show_search() {
        $('#search_student').slideDown("slow");
    }

    function hide_search() {
        $('#search_student').slideUp("slow");
    }

    function search_with_name_or_admission(acdyr_id, batch_id) {
        var searchname = $('#search_with_name_or_admission').val();
        if (searchname.trim().length < 3) {
            swal('', 'Enter atleast three characters.', 'info');
            return false;
        }
        //$('#faculty_loader').addClass('sk-loading');
        // if (!/[a-zA-Z\s]+$/.test(searchname)) {
        //     swal('', 'Alphabets only allowed', 'info');
        //     return false;
        // }
        var ops_url = baseurl + 'profile/search_with_name_or_admission';
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
                    //alert change by vinothkumar k @ 09-05-2019 11:35
                    //$('#faculty_loader').removeClass('sk-loading');
                    swal('', 'No data available', 'info');
                }
            }
        });
    }

    function searchbyname(acdyr_id, batch_id) {
        var searchname = $('#searchname').val();
        if (searchname.trim().length < 3) {
            swal('', 'Enter atleast three characters.', 'info');
            return false;
        }
        if (!/[a-zA-Z\s]+$/.test(searchname)) {
            swal('', 'Alphabets only allowed', 'info');
            return false;
        }
        $('#faculty_loader').addClass('sk-loading');
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
                    //alert change by vinothkumar k @ 09-05-2019 11:35
                    $('#faculty_loader').removeClass('sk-loading');
                    swal('', 'No data available', 'info');
                }
            }
        });
    }

    function searchstudent_admission_no(acdyr_id, batch_id) {
        $("#close_button").show();
        var searchstudent_admission_no = $('#searchstudent_admission_no').val();
        if (searchstudent_admission_no.trim().length < 3) {
            swal('', 'Enter atleast three characters.', 'info');
            return false;
        }
        if (!/[0-9a-zA-Z/]+$/.test(searchstudent_admission_no)) {
            swal('', 'Numbers, alphabets and slash(/) only allowed', 'info');
            return false;
        }
        $('#faculty_loader').addClass('sk-loading');
        var ops_url = baseurl + 'profile/search-admission-no';
        $.ajax({
            type: "POST",
            cache: false,
            //async: false,
            url: ops_url,
            data: {
                "load": 1,
                "searchdata": searchstudent_admission_no,
                "acdyr_id": acdyr_id,
                "batch_id": batch_id
            },
            success: function(result) {
                var data = JSON.parse(result)
                if (data.status == 1) {
                    $('#content').html('');
                    $('#content').html(data.view);
                } else {
                    if (data.message) {
                        $('#faculty_loader').removeClass('sk-loading');
                        swal('', data.message, 'info');
                        return false;
                    } else {
                        $('#faculty_loader').removeClass('sk-loading');
                        swal('', 'No data available', 'info');
                        return false;
                    }
                }
            }
        });
    }
</script>