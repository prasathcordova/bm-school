<style>
    .pro-name{ height: 28px; }
</style>
<script src="<?php echo base_url('assets/plugins/validate/jquery.validate.min.js'); ?>"></script>
<div id="profile-detail-content">

    <div class="wrapper wrapper-content animated fadeInRight" style="padding-top: 1px !important;padding-left: 0px !important;padding-right: 0px !important;">
        <div class="row" style="margin-left: -29px !important; margin-right: -30px !important;">
            <div class="col-lg-12">
                <div class="ibox float-e-margins">    
                    <div class="ibox-title">
                        <h5>
                            <?php echo isset($title) ? $title : "NO TITLE PROVIDED" ?>
                        </h5>
                    </div>                    
                    <div class="ibox-content">

                        <div class="input-group">
                            <input type="text" id="searchname" name="searchname" placeholder="Search Staff by name..." class=" form-control">
                            <span class="input-group-btn"  >
                                <button type="button" id="button_id" class="btn btn-info" onclick="uniform_search_name();"> Search</button>      

                            </span>
                        </div>
                        <div class="row">


                            <div class="clearfix"></div>
                            <div class="wrapper wrapper-content animated fadeInRight" id="student-data-container">
                                <div class="row">
                                    <?php
                                    if (isset($user_data) && !empty($user_data) && is_array($user_data)) {
                                        $breaker = 0;
                                        foreach ($user_data as $staff) {
                                            ?>
                                            <div class="col-lg-3">
                                                <div class="contact-box center-version">                                                        
                                                    <a href="javascript:void(0);">
                                                        <?php
                                                        $profile_image = "";
                                                        if (isset($staff['profile_image']) && !empty($staff['profile_image'])) {

                                                            $profile_image = "data:image/jpeg;base64," . $staff['profile_image'];
                                                        } else {
                                                            if (isset($staff['profile_image_alternate']) && !empty($staff['profile_image_alternate'])) {
                                                                $profile_image = $staff['profile_image_alternate'];
                                                            } else {
                                                                $profile_image = base_url('assets/img/a0.jpg');
                                                            }
                                                        }
                                                        ?>
                                                        <img alt="image" class="img-circle" src="<?php echo $profile_image; ?>">
                                                        <h3 class="m-b-xs pro-name"><strong><?php echo $staff['Emp_Name'] ?></strong></h3>



                                                    </a>
                                                    <table class="table table-hover" style="margin-bottom: 0;">
                                                        <tbody>
                                                            <tr>
                                                                <td class="project-status" style="text-align: center;">
                                                                    <span class="label label-primary">Designation:<?php echo $staff['Designation'] ?></span>
                                                                </td>
                                                            </tr>

                                                        </tbody>
                                                    </table>
                                                    <div class="contact-box-footer" style="padding: 5px 5px;">
                                                        <div class="m-t-xs btn-group">
                                                            <a href="javascript:void(0);" title="Delivery return <?php echo $staff['Emp_Name'] ?>" onclick="uniform_delivery_return_faculty('<?php echo $staff['Emp_id']; ?>')" class="btn btn-xs btn-white"><i class="fa fa-user-plus"></i>Delivery return</a>        
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                            <?php
                                            if ($breaker == 3) {
                                                echo '<div class="clearfix"></div>';
                                                $breaker = 0;
                                            } else {
                                                $breaker ++;
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
    input.addEventListener("keyup", function (event) {
        event.preventDefault();
        if (event.keyCode === 13) {
            document.getElementById("button_id").click();
        }
    });
    $(document).ready(function () {

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
    function uniform_oh_bill() {

        var ops_url = baseurl + 'sale/specimen_issue/';
        $.ajax({
            type: "POST",
            cache: false,
            async: false,
            url: ops_url,
            data: {"load": 1},
            success: function (result) {
                $('#data-view').html(result);
            }
        });
    }
    function uniform_specimen_packing_bak() {
//         alert('ds');
        var ops_url = baseurl + 'uniform/sale/specimen_packing/';
        $.ajax({
            type: "POST",
            cache: false,
            async: false,
            url: ops_url,
            data: {"load": 1},
            success: function (result) {
                $('#data-view').html(result);
            }
        });
    }
    function uniform_delivery_return_faculty(Emp_id) {
//        var batchid = $('#batchid').val();
        var ops_url = baseurl + 'uniform/delivery/show-faculty_deliveryreturn/';
        $.ajax({
            type: "POST",
            cache: false,
            async: false,
            url: ops_url,
            data: {"load": 1, "Empid": Emp_id},
            success: function (result) {
                var data = JSON.parse(result);
                if (data.status == 1) {
                    $('#profile-detail-content').html('');
                    $('#profile-detail-content').html(data.view);
                    var animation = "fadeInDown";
                    $("#profile-detail-content").show();
                    $('#profile-detail-content').addClass('animated');
                    $('#profile-detail-content').addClass(animation);
                    $('html, body').animate({
                        scrollTop: $("#profile-detail-content").offset().top
                    }, 1000);
                }

//                $('html, body').animate({
//                    scrollTop: $("#data-view").offset().top
//                }, 1000);
            }
        });
    }
    function uniform_other_bill() {
//         alert('ds');
        var ops_url = baseurl + 'sale/othbill/';
        $.ajax({
            type: "POST",
            cache: false,
            async: false,
            url: ops_url,
            data: {"load": 1},
            success: function (result) {
                $('#data-view').html(result);
            }
        });
    }
//     function uniform_oh_bill(studentid) {
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
    function uniform_edit_profile(studentid) {
        var ops_url = baseurl + 'registration/edit-profile';
        $.ajax({
            type: "POST",
            cache: false,
            async: false,
            url: ops_url,
            data: {"load": 1, "studentid": studentid},
            success: function (result) {
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
            data: {"load": 1, "studentid": student_id, "batchid": batchid, "acd_id": acd_id},
            success: function (result) {

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
                    }, function (isConfirm) {
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
            data: {"load": 1, "studentid": studentid, "batchid": batchid},
            success: function (data) {
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
            data: {"load": 1, "studentid": studentid, "batchid": batchid},
            success: function (data) {
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


    function uniform_search_name() {
        var searchname = $('#searchname').val();
        var ops_url = baseurl + 'uniform/delivery/search-teachername';
        $.ajax({
            type: "POST",
            cache: false,
            async: false,
            url: ops_url,
            data: {"load": 1, "searchname": searchname},
            success: function (result) {
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

