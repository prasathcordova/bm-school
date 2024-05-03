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
            <!--            <ol class="breadcrumb">
            <?php
            //                if (isset($bread_crump_data) && !empty($bread_crump_data)) {
            //                    echo $bread_crump_data;
            //                }
            //                 dev_export($details_data);die;
            ?>
                        </ol>        -->
        </div>
    </div>
    <div class="wrapper wrapper-content animated fadeInRight" style="padding-top: 1px !important;padding-left: 0px !important;padding-right: 0px !important;">
        <div class="row" style="margin-left: -29px !important; margin-right: -30px !important;">
            <div class="col-lg-12">
                <div class="ibox float-e-margins">
                    <div class="ibox-content">

                        <div class="input-group">
                            <input type="text" id="searchname" name="searchname" placeholder="Search Student by name..." class=" form-control">
                            <span class="input-group-btn">
                                <button type="button" id="search_name_btn" class="btn btn-info" onclick="uniform_search_name('<?php echo $acdyr_id; ?>', '<?php echo $batch_id; ?>');"> Search</button>
                            </span>
                        </div>
                        <div class="row">
                            <input type="hidden" name="batchid" id="batchid" value="<?php echo isset($batchid) && !empty($batchid) ? $batchid : ''; ?>" />
                            <div class="clearfix"></div>
                            <div class="wrapper wrapper-content animated fadeInRight" id="student-data-container">
                                <div class="row">
                                    <?php
                                    if (isset($details_data) && !empty($details_data) && is_array($details_data)) {
                                        $breaker = 0;
                                        foreach ($details_data as $student) {

                                            if ($student['stud_status'] == 'Official') {
                                    ?>
                                                <div class="col-lg-4">
                                                    <div class="contact-box center-version">
                                                        <a href="javascript:void(0);">
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
                                                            <h3 class="m-b-xs pro-name"><strong><?php echo $student['student_name'] ?></strong></h3>

                                                            <!--<div class="font-bold">Admission num:<?php echo $student['Admn_No'] ?></div>-->

                                                        </a>
                                                        <table class="table table-hover">
                                                            <tbody>
                                                                <tr>
                                                                    <td class="project-status" style="text-align:center;">
                                                                        <span class="label label-primary" style="font-size:12px;">Admission num:<?php echo $student['Admn_No'] ?></span>
                                                                    </td>
                                                                </tr>

                                                            </tbody>
                                                        </table>
                                                        <div class="contact-box-footer">
                                                            <div class="m-t-xs btn-group">
                                                                <a href="javascript:void(0);" title="Select <?php echo $student['student_name'] ?>" onclick="uniform_loose_packing('<?php echo $student['student_id']; ?>')" class="btn btn-xs btn-white"><i class="fa fa-user-plus"></i> Select</a>
                                                            </div>
                                                        </div>

                                                    </div>
                                                </div>
                                    <?php
                                                if ($breaker == 2) {
                                                    echo '<div class="clearfix"></div>';
                                                    $breaker = 0;
                                                } else {
                                                    $breaker++;
                                                }
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
<script>
    var input = document.getElementById("searchname");
    input.addEventListener("keyup", function(event) {
        event.preventDefault();
        if (event.keyCode === 13) {
            document.getElementById("search_name_btn").click();
        }
    });


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

    function uniform_edit_profile(studentid) {
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

    function uniform_send_personal_email(student_id, acd_id, batchid) {
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
                "acd_id": acd_id
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

    function uniform_profile_detail(studentid) {
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
                $('#profile-detail-content').html('');
                $('#profile-detail-content').html(data);
                $('html, body').animate({
                    scrollTop: $("#profile-detail-content").offset().top
                }, 1000);
            }
        });
    }

    function uniform_fees_detail(studentid) {
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

    function uniform_show_search() {
        $('#search_student').slideDown("slow");
    }

    function uniform_hide_search() {
        $('#search_student').slideUp("slow");
    }


    function uniform_search_name(acdyr_id, batch_id) {
        var searchname = $('#searchname').val();
        var ops_url = baseurl + 'uniform/packing/search-profilename';
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
                    alert('No data loaded');
                }
            }
        });
    }

    function uniform_loose_packing(std_id) {
        //        var batchid = $('#batchid').val();
        var ops_url = baseurl + 'uniform/sale/loose_packing/';
        $.ajax({
            type: "POST",
            cache: false,
            async: false,
            url: ops_url,
            data: {
                "load": 1,
                "std_id": std_id
            },
            success: function(data) {
                $('#data-view').html(data);
                //                $('#profile-detail-content').html('');
                //                $('#profile-detail-content').html('');
                //                $('#profile-detail-content').html(data);
                //                $('html, body').animate({
                //                    scrollTop: $("#profile-detail-content").offset().top
                //                }, 1000);
            }
        });
    }
</script>