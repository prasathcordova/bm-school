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
                    <div class="ibox-content">
                        <div class="row">

                            <div class="col-lg-6">
                                <div class="input-group">
                                    <input type="text" id="searchname" name="searchname" placeholder="Search Student By Name" class="form-control">
                                    <span class="input-group-btn">
                                        <button type="button" id="search_name_btn" title="Search" class="btn btn-info btn-sm" onclick="searchbyname('<?php echo $acdyr_id; ?>', '<?php echo $batch_id; ?>');"><i style="font-size:17px;" class="material-icons">search</i> </button>
                                    </span>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="input-group">
                                    <input type="text" id="searchstudent_admission_no" name="searchstudent_admission_no" placeholder="Search Student By Admission Number" class=" form-control admnNumberCheck">
                                    <span class="input-group-btn">
                                        <button type="button" class="btn btn-info btn-sm" title="Search" onclick="searchstudent_admission_no('<?php echo $acdyr_id; ?>', '<?php echo $batch_id; ?>');"><i style="font-size:17px;" class="material-icons">search</i> </button>
                                    </span>
                                </div>
                            </div>

                        </div>
                        <div class="row">

                            <input type="hidden" name="batchid" id="batchid" value="<?php echo isset($batchid) && !empty($batchid) ? $batchid : ''; ?>" />

                            <!--                            <div class="col-lg-12">
                                                            <div id="curd-content" style="display: none;"></div>
                                                        </div>-->
                            <div class="clearfix"></div>
                            <div class="wrapper wrapper-content animated fadeInRight" id="student-data-container">
                                <div class="col-lg-12">
                                    <div class="row">
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
                                                        <div class="contact-box-footer">
                                                            <button class="btn btn-sm btn-info" title="Click to enter details" onclick="enter_sponsered_deatils(<?php echo $student['student_id']; ?>)">ADD SPONSORS</button>
                                                            <!--button class="btn btn-xs btn-info pull-right" title="Click to view details" onclick="view_sponsered_details()">View Details</button-->
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
        $('#searchname').on("keypress", function(e) {
            if (e.keyCode == 13) {
                if ($('#searchname').val().trim().length < 3) {
                    swal('', 'Enter atleast three characters.', 'info');
                    return false;
                } else {
                    searchbyname('<?php echo $acdyr_id; ?>', '<?php echo $batch_id; ?>');
                }
            }
            if (/[a-zA-Z\s]+$/.test(e.key)) {
                return true;
            } else {
                return false;
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
            if (/[0-9a-zA-Z/]+$/.test(e.key)) {
                return true;
            } else {
                return false;
            }
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

                    $('#profile-detail-content').html('');
                    $('#profile-detail-content').html(data.view);
                    var animation = "fadeInDown";
                    $("#profile-detail-content").show();
                    $('#profile-detail-content').addClass('animated');
                    $('#profile-detail-content').addClass(animation);
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

    //create function by vinoth @ 26-06-2019 15:26
    function enter_sponsered_deatils(studentid) {
        var batchid = $('#batchid').val();
        var ops_url = baseurl + 'profilestudent/show-profile-for-sponsered-stud/';
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
        var batchid = $('#batchid').val();
        var ops_url = baseurl + 'longabsentee/long-fees/';
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

    function show_search() {
        $('#search_student').slideDown("slow");
    }

    function hide_search() {
        $('#search_student').slideUp("slow");
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
                    //alert change by vinothkumar k @ 09-05-2019 11:35
                    swal('', 'No data available !', 'info');
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
        var ops_url = baseurl + 'profile/search-admission-no';
        $.ajax({
            type: "POST",
            cache: false,
            async: false,
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
                        swal('', data.message, 'info');
                        return false;
                    } else {
                        swal('', 'No data available', 'info');
                        return false;
                    }
                }
            }
        });
    }
</script>