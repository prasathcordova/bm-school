<div class="wrapper wrapper-content animated fadeInRight" style="padding-top: 1px !important;padding-left: 0px !important;padding-right: 0px !important;">
    <div class="row" style="margin-left: -29px !important; margin-right: -30px !important;">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5><?php echo isset($sub_title) ? $sub_title : "NO TITLE PROVIDED" ?></h5>
                    <div class="ibox-tools" id="add_type">
                        <a data-toggle="modal" class="btn btn-primary btn-xs" data-toggle="tooltip" title="Add a Course" data-placement="left" href="javascript:void(0);" onclick="add_new_course();"><i class="fa fa-plus"></i>CREATE COURSE</a>
                    </div>
                </div>
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
                        <div class="col-lg-12">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover dataTables-example" id="tbl_course">

                                    <thead>
                                        <tr>
                                            <th>Course</th>
                                            <th>Category</th>
                                            <th>Duration</th>
                                            <th>Active</th>
                                            <th>Task</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        if (isset($course_data) && !empty($course_data) && is_array($course_data)) {
                                            foreach ($course_data as $course) {
                                        ?>
                                                <tr>
                                                    <td> <?php echo $course['Description']; ?></td>
                                                    <td> <?php echo $course['Category']; ?></td>
                                                    <td> <?php echo $course['Duration']; ?></td>


                                                    <td data-toggle="tooltip" title="Slide for Enable/Disable">
                                                    <div class="switch">
                                                        <div class="onoffswitch">
                                                            <?php if ($course['isactive'] == 1) {
                                                                        $checked = "checked";
                                                                    } else {
                                                                        $checked = '';
                                                                    } ?>
                                                            <input type="checkbox" <?php echo $checked ?> class="onoffswitch-checkbox pick_status" 
                                                            onchange="change_status('<?php echo $course['Course_Det_ID']; ?>',  this)" 
                                                            id="<?php echo $course['Course_Det_ID']; ?>">
                                                            <label class="onoffswitch-label" for="<?php echo $course['Course_Det_ID']; ?>">
                                                                <span class="onoffswitch-inner"></span>
                                                                <span class="onoffswitch-switch"></span>
                                                            </label>
                                                        </div>
                                                    </div>
                                                        <?php if ($course['isactive'] == 1) { ?>
                                                            <!-- <input type="checkbox" class="js-switch" data-toggle="tooltip" title="Slide for Enable/Disable" onchange="change_status('<?php echo $course['Course_Det_ID'] ?>', this)" checked id="t1" /> -->
                                                        <?php } else {
                                                        ?>
                                                            <!-- <input type="checkbox" title="Slide for Enable/Disable" onchange="change_status('<?php echo $course['Course_Det_ID'] ?>', this)" id="" class="js-switch" /> -->
                                                        <?php }
                                                        ?>
                                                    </td>
                                                    <td>
                                                        <a href="javascript:void(0);" onclick="edit_course('<?php echo $course['Course_Det_ID']; ?>', '<?php echo $course['Description']; ?>', '<?php echo $course['Category']; ?>', '<?php echo $course['Duration']; ?>');" data-toggle="tooltip" data-placement="right" title="Edit <?php echo $course['Description']; ?>" data-original-title="<?php echo $course['Description']; ?>"><i class="fa fa-pencil" style="font-size: 24px; color: #23C6C5; margin: 2%; "></i></a>
                                                    </td>
                                                </tr>
                                        <?php
                                            }
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<script type="text/javascript">
    function change_status(course_id, element) {
        $('#faculty_loader').addClass('sk-loading');

        var status_type = $(element).prop("checked");
        if (status_type == true)
            status = 1;
        else
            status = -1;
        var ops_url = baseurl + 'course/change_status/';
        $.ajax({
            type: "POST",
            cache: false,
            async: false,
            url: ops_url,
            data: {
                "load": 1,
                "Course_Det_ID": course_id,
                "status": status
            },
            success: function(result) {
                var data = $.parseJSON(result);
                if (data.status == 1) {
                    if (status == -1) {
                        swal('Course Updated', 'Course Status Deactivated Successfully', 'success');
                        $('#faculty_loader').removeClass('sk-loading');
                        return true;
                    } else {
                        if (status == 1) {
                            swal('Course Updated', 'Course Status Activated Successfully', 'success');
                            $('#faculty_loader').removeClass('sk-loading');
                            return true;
                        }
                    }
                } else {
                    if (data.status == 0) {
                        swal({
                            title: '',
                            text: data.message,
                            type: 'info',
                            showCancelButton: false,
                            confirmButtonColor: '#3085d6',
                            cancelButtonColor: '#d33',
                            confirmButtonText: 'OK'
                        }, function(isConfirm) {
                            window.location.href = baseurl + "course/show-course";
                        });
                    } else {
                        if (data.status == 3) {
                            swal({
                                title: '',
                                text: data.message,
                                type: 'info',
                                showCancelButton: false,
                                confirmButtonColor: '#3085d6',
                                cancelButtonColor: '#d33',
                                confirmButtonText: 'OK'
                            }, function(isConfirm) {
                                window.location.href = baseurl + "course/show-course";
                            });
                        } else {
                            swal({
                                title: '',
                                text: 'Course Status Updation Failed',
                                type: 'info',
                                showCancelButton: false,
                                confirmButtonColor: '#3085d6',
                                cancelButtonColor: '#d33',
                                confirmButtonText: 'OK'
                            }, function(isConfirm) {
                                window.location.href = baseurl + "course/show-course";
                            });
                        }

                    }
                }
            }
        });
    }



    function submit_data() {
        //        $('#faculty_loader').addClass('sk-loading');

        var ops_url = baseurl + 'course/add-course/';
        var course_name = $('#Description').val().toUpperCase();
        var category = $('#category_select').val();
        var duration = $("#Duration").val();



        if (course_name == '') {
            swal('', 'Course Name is required.', 'info');
            //            $('#faculty_loader').removeClass('sk-loading');
            return false;
        } else if ((course_name.length > '30') || (course_name.length < '3')) {
            swal('', 'Course Name should contain letters 3 to 30', 'info');
            //            $('#faculty_loader').removeClass('sk-loading');
            return false;
        }
        var alphanumers = /^[a-zA-Z\s]+$/;
        if (!alphanumers.test($("#course_name").val())) {
            swal('', 'Course Name can have only alphabets', 'info');
            //                $('#faculty_loader').removeClass('sk-loading');
            return false;
        }

        if (category == -1) {
            swal('', 'Category is required.', 'info');
            //            $('#faculty_loader').removeClass('sk-loading');
            return false;
        }

        if (duration == '') {
            swal('', 'Duration is required.', 'info');
            //            $('#faculty_loader').removeClass('sk-loading');
            return false;
        } else if ((duration.length > '4') || (course_name.length < '1')) {
            swal('', 'Durationshould contain letters 1 to 4', 'info');
            //            $('#faculty_loader').removeClass('sk-loading');
            return false;
        }
        var alphanumers = /^[0-9]+$/;
        if (!alphanumers.test($("#Duration").val())) {
            swal('', 'Duration can have only numbers', 'info');
            //                $('#faculty_loader').removeClass('sk-loading');
            return false;
        }


        $.ajax({
            type: "POST",
            cache: false,
            async: false,
            url: ops_url,
            data: $('#course_save').serialize(),
            success: function(result) {
                var data = $.parseJSON(result);
                if (data.status == 1) {
                    $('#course_save').html('');
                    $('#course_save').html(data.view);
                    var course_data = [];
                    $.ajax({
                        type: "POST",
                        cache: false,
                        async: false,
                        url: baseurl + 'course/show-courses/',
                        data: {
                            'load_reset': '1'
                        },
                        success: function(result) {
                            course_data = JSON.parse(result);

                        },
                        error: function() {
                            alert('error');
                        }
                    });
                    var datatable = $('#tbl_course').dataTable().api();
                    datatable.clear();
                    datatable.rows.add(course_data).draw();

                    $('#add_type').show();
                    swal('Success', 'New Course, ' + course_name + ' created successfully.', 'success');
                    $("#curd-content").slideUp("slow", function() {
                        $("#curd-content").hide();
                    });
                } else if (data.status == 2) {
                    $('#curd-content').html('');
                    $('#curd-content').html(data.view);
                    swal('', data.message, 'info');
                } else if (data.status == 3) {
                    $('#curd-content').html('');
                    $('#curd-content').html(data.view);
                    swal('', data.message, 'info');
                } else {
                    swal('', 'Connection Error. Please contact administrator', 'info');
                }

            }
        });
    }

    function submit_edit_save_data() {
        $('#faculty_loader').addClass('sk-loading');

        var ops_url = baseurl + 'course/edit-course';
        var course_name = $('#Description').val().toUpperCase();
        var category = $('#category_select').val();
        var duration = $("#Duration").val();



        if (course_name == '') {
            swal('', 'Course Name is required.', 'info');
            //            $('#faculty_loader').removeClass('sk-loading');
            return false;
        } else if ((course_name.length > '30') || (course_name.length < '3')) {
            swal('', 'Course Name should contain letters 3 to 30', 'info');
            //            $('#faculty_loader').removeClass('sk-loading');
            return false;
        }
        var alphanumers = /^[a-zA-Z\s]+$/;
        if (!alphanumers.test($("#course_name").val())) {
            swal('', 'Course Name can have only alphabets', 'info');
            //                $('#faculty_loader').removeClass('sk-loading');
            return false;
        }

        if (category == -1) {
            swal('', 'Category is required.', 'info');
            //            $('#faculty_loader').removeClass('sk-loading');
            return false;
        }

        //         if (duration == '') {
        //            swal('', 'Duration is required.', 'info');
        ////            $('#faculty_loader').removeClass('sk-loading');
        //            return false;
        //        }
        //        else if ((duration.length > '4') || (course_name.length < '1'))  {
        //            swal('', 'Durationshould contain letters 1 to 4', 'info');
        ////            $('#faculty_loader').removeClass('sk-loading');
        //            return false;
        //        }
        //        var alphanumers = /^[0-9]+$/;
        //            if(!alphanumers.test($("#Duration").val())){    
        //                swal('', 'Duration can have only numbers', 'info');
        ////                $('#faculty_loader').removeClass('sk-loading');
        //                return false;
        //            }


        $.ajax({
            type: "POST",
            cache: false,
            async: false,
            url: ops_url,
            data: $('#course_save').serialize(),
            success: function(result) {
                var data = $.parseJSON(result)

                if (data.status == 1) {
                    $('#course_save').html('');
                    $('#course_save').html(data.view);
                    var course_data = [];
                    $.ajax({
                        type: "POST",
                        cache: false,
                        async: false,
                        url: baseurl + 'course/show-courses/',
                        data: {
                            'load_reset': '1'
                        },
                        success: function(result) {
                            course_data = JSON.parse(result);
                            //                            alert(course_data);die;
                        },
                        error: function() {
                            alert('error');
                        }
                    });
                    var datatable = $('#tbl_course').dataTable().api();
                    datatable.clear();
                    datatable.rows.add(course_data).draw();
                    $('#add_type').show();
                    swal('Success', 'Course ' + course_name + ' updated successfully.', 'success');
                    $('#faculty_loader').removeClass('sk-loading');
                    $("#curd-content").slideUp("slow", function() {
                        $("#curd-content").hide();
                    });
                    $('#category_select').select2({
                        'theme': 'bootstrap'
                    });
                } else if (data.status == 2) {
                    $('#curd-content').html('');
                    $('#curd-content').html(data.view);
                    swal('', data.message, 'info');
                    $('#category_select').select2({
                        'theme': 'bootstrap'
                    });
                    $('#faculty_loader').removeClass('sk-loading');
                } else if (data.status == 3) {
                    $('#curd-content').html('');
                    $('#curd-content').html(data.view);
                    swal('', data.message, 'info');
                    $('#category_select').select2({
                        'theme': 'bootstrap'
                    });
                    $('#faculty_loader').removeClass('sk-loading');
                    //                    activate_toast(data.message, 'Error', 'error');
                } else {
                    swal('', 'Connection Error. Please contact administrator', 'info');
                    $('#faculty_loader').removeClass('sk-loading');
                    //                    activate_toast("Connection Error", 'Error', 'error');
                }

            }
        });
    }

    function refresh_add_panel() {
        $('#Description').val('');
        $('#Description').parent().removeAttr('class', 'has-error');
        $('#Duration').val('');
        $('#Duration').parent().removeAttr('class', 'has-error');
        $('#category_select').select2('val', -1);
    }

    function edit_course(Course_ID, Description, Category, Duration) {
        var ops_url = baseurl + 'course/edit-course/';
        $.ajax({
            type: "POST",
            cache: false,
            async: false,
            url: ops_url,
            data: {
                "load": 1,
                "Course_Det_ID": Course_ID,
                "Description": Description,
                "category_select": Category,
                "Duration": Duration
            },
            success: function(result) {
                var data = JSON.parse(result);
                //                alert(data);return;
                console.log(data);
                if (data.status == 1) {
                    $('#curd-content').html('');
                    $('#curd-content').html(data.view);
                    var animation = "fadeInDown";
                    $("#curd-content").show();
                    $('#curd-content').addClass('animated');
                    $('#curd-content').addClass(animation);
                    $('#add_type').hide();
                    $('#category_select').select2({
                        'theme': 'bootstrap'
                    });
                } else {
                    alert('No data loaded');
                }
            }
        });
    }

    function close_add_course() {
        $('#add_type').show();
        $("#curd-content").slideUp("slow", function() {
            $("#curd-content").hide();
        });

    }

    //NEW SCRIPT
    function add_new_course() {
        var ops_url = baseurl + 'course/add-course';
        $.ajax({
            type: "POST",
            cache: false,
            async: false,
            url: ops_url,
            data: {
                "load": 1
            },
            success: function(data) {
                if (data) {
                    $('#curd-content').html(data);


                    var animation = "fadeInDown";
                    $("#curd-content").show();
                    $('#curd-content').addClass('animated');
                    $('#curd-content').addClass(animation);
                    $('#add_type').hide();
                    $('#category_select').select2({
                        'theme': 'bootstrap'
                    });
                } else {
                    alert('No data loaded');
                }
            }
        });
    }

    function add_new_batch() {
        var ops_url = baseurl + 'batch/add-batch';
        $.ajax({
            type: "POST",
            cache: false,
            async: false,
            url: ops_url,
            data: {
                "load": 1
            },
            success: function(data) {
                if (data) {
                    $('#curd-content').html(data);


                    var animation = "fadeInDown";
                    $("#curd-content").show();
                    $('#curd-content').addClass('animated');
                    $('#curd-content').addClass(animation);
                    $('#add_type').hide();


                } else {
                    alert('No data loaded');
                }
            }
        });
    }
</script>