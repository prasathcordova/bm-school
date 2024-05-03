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

                        <div class="input-group">
                            <input type="text" id="searchname" name="searchname" placeholder="Search Student by name..." class=" form-control">
                            <span class="input-group-btn">
                                <button type="button" class="btn btn-info" onclick="search_name('<?php echo $acdyr_id; ?>', '<?php echo $batch_id; ?>');"> Search</button>

                            </span>
                        </div>
                        <div class="row">
                            <input type="hidden" name="batchid" id="batchid" value="<?php echo isset($batchid) && !empty($batchid) ? $batchid : ''; ?>" />

                            <!--                            <div class="col-lg-12">
                                                            <div id="curd-content" style="display: none;"></div>
                                                        </div>-->
                            <div class="clearfix"></div>
                            <div class="wrapper wrapper-content animated fadeInRight" id="student-data-container">
                                <div class="row">
                                    <?php
                                    if (isset($details_data) && !empty($details_data) && is_array($details_data)) {
                                        $breaker = 0;
                                        foreach ($details_data as $student) {
                                    ?>
                                            <div class="col-lg-3">
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

                                                        <div class="font-bold">Admission num:<?php echo $student['Admn_No'] ?></div>

                                                    </a>
                                                    <!--                                                    <table class="table table-hover" style="margin-bottom: 0;">
                                                                <tbody>
                                                                    <tr>
                                                                        <td class="project-status">
                                                                            <span class="label label-primary"><?php // echo $student['stud_status']; 
                                                                                                                ?></span>
                                                                        </td>
                                                                    </tr>
                                                          
                                                                </tbody>-->
                                                    </table>
                                                    <div class="contact-box-footer" style="padding: 5px 5px;">
                                                        <div class="m-t-xs btn-group">
                                                            <a href="javascript:void(0);" onclick="oh_bill('<?php echo $student['student_id']; ?>')" class="btn btn-xs btn-white"><i class="fa fa-user-plus"></i>OH Billing</a>
                                                            <a href="javascript:void(0);" onclick="other_bill('<?php echo $student['student_id']; ?>')" class="btn btn-xs btn-white"><i class="fa fa-user-plus"></i>Other Billing</a>
                                                            <!--<a href="javascript:void(0);" onclick="send_personal_email('<?php echo $student['student_id']; ?>', '<?php echo $acdyr_id; ?>', '<?php // echo $batch_id; 
                                                                                                                                                                                                    ?>')" class="btn btn-xs btn-white "><i class="fa fa-billing"></i>Other Billing</a>-->
                                                            <!--<a href="javascript:void(0);" onclick="fees_detail('<?php echo $student['student_id']; ?>')" class="btn btn-xs btn-white"><i class="fa fa-user-plus"></i> Fee Details</a>-->
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

    function oh_bill() {
        //         alert('ds');
        var ops_url = baseurl + 'sale/ohbill/';
        $.ajax({
            type: "POST",
            cache: false,
            async: false,
            url: ops_url,
            data: {
                "load": 1
            },
            success: function(result) {
                $('#data-view').html(result);
            }
        });
    }

    function other_bill() {
        //         alert('ds');
        var ops_url = baseurl + 'sale/othbill/';
        $.ajax({
            type: "POST",
            cache: false,
            async: false,
            url: ops_url,
            data: {
                "load": 1
            },
            success: function(result) {
                $('#data-view').html(result);
            }
        });
    }
    //     function oh_bill(studentid) {
    //        var batchid = $('#batchid').val();
    //        var ops_url = baseurl + 'sale/ohbill/';
    //        $.ajax({
    //            type: "POST",
    //            cache: false,
    //            async: false,
    //            url: ops_url,
    //            data: {"load": 1, "studentid": studentid, "batchid": batchid},
    //            success: function (result) {
    //                $('#data-view').html(result);
    //            }
    //        });
    //    }
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

    function send_personal_email(student_id, acd_id, batchid) {
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
                $('#profile-detail-content').html('');
                $('#profile-detail-content').html(data);
                $('html, body').animate({
                    scrollTop: $("#profile-detail-content").offset().top
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
                    alert('No data loaded');
                }
            }
        });
    }
</script>