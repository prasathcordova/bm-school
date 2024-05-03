<div class="wrapper wrapper-content animated fadeInRight" style="padding-top: 1px !important;padding-left: 0px !important;padding-right: 0px !important;">
    <div class="row" style="margin-left: -29px !important; margin-right: -30px !important;">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5><?php echo isset($sub_title) ? $sub_title : "NO TITLE PROVIDED" ?></h5>
                    <div class="ibox-tools" id="add_type">
                        <!--<button type="button" class="btn bg-teal waves-effect"  onclick="add_subject();">NEW SUBJECT</button>-->
                        <!--<span style="padding-right: 9px;"><a href="javascript:void(0);"  onclick="add_new_class();" class="btn btn-primary btn-xs">ADD CLASS</a> </span>-->
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
                                <table class="table table-striped table-bordered table-hover dataTables-example" id="tbl_class">

                                    <thead>
                                        <tr>
                                            <td>ID</td>
                                            <th>Class Description</th>
                                            <th>Class Code</th>
                                            <th>Course</th>
                                            <!--                                            <th>Active</th>                                
                                            <th>Task</th>                           -->
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        if (isset($class_data) && !empty($class_data) && is_array($class_data)) {
                                            //                                            dev_export($class_data).'</pre>';
                                            foreach ($class_data as $class) {
                                        ?>
                                                <tr>
                                                    <td> <?php echo $class['Course_Det_ID']; ?></td>
                                                    <td> <?php echo $class['Description']; ?></td>
                                                    <td> <?php echo $class['Course_det_code']; ?></td>
                                                    <td> <?php echo $class['Course_Name']; ?></td>



                                                    <!--                                                    <td  data-toggle="tooltip" title="Slide for Enable/Disable">
                                                        <?php if ($class['isactive'] == 1) { ?>                                                    
                                                            <input type="checkbox"  class="js-switch" data-toggle="tooltip" title="Slide for Enable/Disable" onchange="change_status('<?php echo $class['Course_Det_ID'] ?>', this)" checked  id="t1" />                                                       


                                                        <?php } else {
                                                        ?>
                                                            <input type="checkbox"  title="Slide for Enable/Disable" onchange="change_status('<?php echo $class['Course_Det_ID'] ?>', this)"  id="" class="js-switch"  />                                                                                                         

                                                        <?php }
                                                        ?>
                                                    </td>
                                                    <td>
                                                        <a href="javascript:void(0);" onclick="edit_class('<?php echo $class['Course_Det_ID']; ?>', '<?php echo $class['Course_det_code']; ?>', '<?php echo $class['Description']; ?>', '<?php echo $class['Course_Name']; ?>');"  data-toggle="tooltip" data-placement="right" title="Edit <?php echo $class['Course_det_code']; ?>" data-original-title="<?php echo $class['Course_det_code']; ?>"  ><i class="fa fa-pencil" style="font-size: 24px; color: #23C6C5; margin: 2%; "></i></a>                                                       
                                                    </td>-->
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
    $('#tbl_class tbody').on('click', function(e) {
        activateSwitchery()
    });
    var list_switchery = [];
    var dtable = $('#tbl_class').dataTable({

        columnDefs: [{
                "width": "10%",
                className: "capitalize",
                "targets": 0,
                "visible": false,
                "orderable": true
            },
            {
                "width": "30%",
                className: "capitalize",
                "targets": 1,
                "orderable": false
            },
            {
                "width": "20%",
                className: "capitalize",
                "targets": 2,
                "orderable": false
            },
            {
                "width": "20%",
                className: "capitalize",
                "targets": 3,
                "orderable": false
            },
            //            {"width": "10%", className: "capitalize", "targets": 3},
            //            {"width": "20%", className: "capitalize", "targets": 4, "orderable": false}
        ],
        targets: 'no-sort',
        //        bSort: false,
        responsive: true,
        iDisplayLength: 10,
        dom: '<"html5buttons"B>lTfgitp',
        buttons: [{
                text: '<i style="font-size:12px;" class="fa fa-sort-amount-desc" title="Sort by descending "></i>',
                action: function(e, dt, node, config) {
                    dt.order([0, 'desc']).draw();
                }
            },
            {
                text: '<i style="font-size:12px;" class="fa fa-sort-amount-asc" title="Sort by ascending "></i>',
                action: function(e, dt, node, config) {
                    dt.order([0, 'asc']).draw();
                }
            }
        ],
        "fnDrawCallback": function(ele) {
            activateSwitchery();
        }


    });
    $(document).ready(function() {
        activateSwitchery();

    });

    function activateSwitchery() {
        for (var i = 0; i < list_switchery.length; i++) {
            list_switchery[i].destroy();
            list_switchery[i].switcher.remove();
        }
        var list_checkbox = Array.prototype.slice.call(document.querySelectorAll('.js-switch'));
        list_checkbox.forEach(function(html) {
            var switchery = new Switchery(html, {
                color: '#23C6C8',
                secondaryColor: '#F8AC59',
                size: 'small'
            });
            //        var switchery = new Switchery(html, {color: '#a9318a', size: 'small'});
            list_switchery.push(switchery);
        });
    }

    function toggle_class_add() {
        if ($('#add_type').html() > 100) {
            $('#add_type').html('<a href="javascript:void(0);" onclick="toggle_class_add();"><i class="fa fa-close" style="color:1ab394; font-size:30px;></i></a>');
            add_class();
        } else {
            $('#add_type').html('<button type="button" class="btn bg-teal waves-effect" onclick="toggle_class_add();">NEW CLASS</button>');
            var animation = "fadeOutDown";
            $('#curd-content').addClass('animated');
            $('#curd-content').addClass(animation);
            $('#curd-content').html('');
            $('#curd-content').hide();
        }
    }





    function change_status(course_det_id, element) {
        $('#faculty_loader').addClass('sk-loading');

        var status_type = $(element).prop("checked");
        if (status_type == true)
            status = 1;
        else
            status = -1;
        var ops_url = baseurl + 'class/change_status/';
        $.ajax({
            type: "POST",
            cache: false,
            async: false,
            url: ops_url,
            data: {
                "load": 1,
                "course_det_id": course_det_id,
                "status": status
            },
            success: function(result) {
                var data = $.parseJSON(result);
                if (data.status == 1) {
                    if (status == -1) {
                        swal('Class Updated', 'Class Status Deactivated Successfully', 'success');
                        $('#faculty_loader').removeClass('sk-loading');
                        return true;
                    } else {
                        if (status == 1) {
                            swal('Class Updated', 'Class Status Activated Successfully', 'success');
                            $('#faculty_loader').removeClass('sk-loading');
                            return true;
                        }
                    }
                } else {
                    if (data.status == 2) {
                        swal({
                            title: '',
                            text: 'Students has been Enrolled in this class/batch so Unable to EDIT/DISABLE',
                            type: 'info',
                            showCancelButton: false,
                            confirmButtonColor: '#3085d6',
                            cancelButtonColor: '#d33',
                            confirmButtonText: 'OK'
                        }, function(isConfirm) {
                            //                            window.location.href = baseurl + "course/show-course";
                            load_class();
                        });
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
                                //                                window.location.href = baseurl + "course/show-course";
                                load_class();
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
                                    //                                    window.location.href = baseurl + "course/show-course";
                                    load_class();
                                });
                            } else {
                                swal({
                                    title: '',
                                    text: 'Class Status Updation Failed',
                                    type: 'info',
                                    showCancelButton: false,
                                    confirmButtonColor: '#3085d6',
                                    cancelButtonColor: '#d33',
                                    confirmButtonText: 'OK'
                                }, function(isConfirm) {
                                    //                                    window.location.href = baseurl + "course/show-course";
                                    load_class();
                                });
                            }

                        }
                    }
                }
            }
        });
    }

    $('.js-switch').change(function(e) {

    });


    $(".js-switch").click(function() {});

    function submit_data() {
        $('#faculty_loader').addClass('sk-loading');

        var ops_url = baseurl + 'class/add-class/';
        var Course_det_code = $('#class_code').val();
        var Description = $("#Description").val();
        var course_select = $("#course_select").val();
        if (course_select == -1) {
            swal('', 'Course is required.', 'info');
            $('#faculty_loader').removeClass('sk-loading');
            return;
        }
        var alphanumers = /^[a-zA-Z]+$/;


        if (Course_det_code == '') {
            swal('', 'Class Code is required.', 'info');
            $('#faculty_loader').removeClass('sk-loading');
            return false;
        } else if ((Course_det_code.length > '15') || (Course_det_code.length < '1')) {
            swal('', 'Class Code should contain letters 1 to 15', 'info');
            $('#faculty_loader').removeClass('sk-loading');
            return false;
        }
        if (!alphanumers.test($("#class_code").val())) {
            swal('', ' Class Code can have only alphabets', 'info');
            $('#faculty_loader').removeClass('sk-loading');
            return false;
        }
        if (Description == '') {
            swal('', 'Class Description is required.', 'info');
            $('#faculty_loader').removeClass('sk-loading');
            return false;
        }
        if (!alphanumers.test($("#Description").val())) {
            swal('', ' Class Description can have only alphabets', 'info');
            $('#faculty_loader').removeClass('sk-loading');
            return false;
        }
        if (course_select == -1) {
            swal('', 'Course is required.', 'info');
            $('#faculty_loader').removeClass('sk-loading');
            return;
        }



        $.ajax({
            type: "POST",
            cache: false,
            async: false,
            url: ops_url,
            data: $('#class_save').serialize(),
            success: function(result) {
                var data = $.parseJSON(result);
                if (data.status == 1) {
                    $('#class_save').html('');
                    $('#class_save').html(data.view);
                    var class_data = [];
                    $.ajax({
                        type: "POST",
                        cache: false,
                        async: false,
                        url: baseurl + 'course/show-class/',
                        data: {
                            'load_reset': '1'
                        },
                        success: function(result) {
                            class_data = JSON.parse(result);

                        },
                        error: function() {
                            alert('error');
                        }
                    });
                    var datatable = $('#tbl_class').dataTable().api();
                    datatable.clear();
                    datatable.rows.add(class_data).draw();

                    $('#add_type').show();
                    swal('Success', 'New Class, ' + Course_det_code + ' created successfully.', 'success');
                    $('#faculty_loader').removeClass('sk-loading');
                    $("#curd-content").slideUp("slow", function() {
                        $("#curd-content").hide();
                    });
                    $('#course_select').select2({
                        'theme': 'bootstrap'
                    });
                    load_class();
                } else if (data.status == 2) {
                    $('#curd-content').html('');
                    $('#curd-content').html(data.view);
                    swal('', data.message, 'info');
                    $('#faculty_loader').removeClass('sk-loading');
                    load_class();
                } else if (data.status == 3) {
                    $('#curd-content').html('');
                    $('#curd-content').html(data.view);
                    swal('', data.message, 'info');
                    load_class();
                } else {
                    swal('', 'Connection Error. Please contact administrator', 'info');
                    load_class();

                }

            }
        });
    }

    function submit_edit_save_data() {
        $('#faculty_loader').addClass('sk-loading');

        var ops_url = baseurl + 'class/edit-class';
        var Course_det_code = $('#Course_det_code').val().toUpperCase();
        var Description = $('#Description').val();
        var course_select = $("#course_select").val();
        if (course_select == -1) {
            swal('', 'Course is required.', 'info');
            $('#faculty_loader').removeClass('sk-loading');
            return;
        }
        var alphanumers = /^[a-zA-Z]+$/;


        if (Course_det_code == '') {
            swal('', 'Class Code is required.', 'info');
            $('#faculty_loader').removeClass('sk-loading');
            return false;
        } else if ((Course_det_code.length > '15') || (Course_det_code.length < '1')) {
            swal('', 'Class Code should contain letters 1 to 15', 'info');
            $('#faculty_loader').removeClass('sk-loading');
            return false;
        }
        if (!alphanumers.test($("#class_code").val())) {
            swal('', ' Class Code can have only alphabets', 'info');
            $('#faculty_loader').removeClass('sk-loading');
            return false;
        }
        if (Description == '') {
            swal('', 'Class Description is required.', 'info');
            $('#faculty_loader').removeClass('sk-loading');
            return false;
        } else if ((Description.length > '15') || (Description.length < '3')) {
            swal('', 'Class Description should contain letters 3 to 15', 'info');
            $('#faculty_loader').removeClass('sk-loading');
            return false;
        }
        if (!alphanumers.test($("#Description").val())) {
            swal('', ' Class Description can have only alphabets', 'info');
            $('#faculty_loader').removeClass('sk-loading');
            return false;
        }
        if (course_select == -1) {
            swal('', 'Course is required.', 'info');
            $('#faculty_loader').removeClass('sk-loading');
            return;
        }




        $.ajax({
            type: "POST",
            cache: false,
            async: false,
            url: ops_url,
            data: $('#class_save').serialize(),

            success: function(result) {
                //                alert(data);
                var data = $.parseJSON(result)

                if (data.status == 1) {
                    $('#class_save').html('');
                    $('#class_save').html(data.view);
                    var class_data = [];
                    $.ajax({
                        type: "POST",
                        cache: false,
                        async: false,
                        url: baseurl + 'course/show-class',
                        data: {
                            'load_reset': '1'
                        },
                        success: function(result) {
                            class_data = JSON.parse(result);
                        },
                        error: function() {
                            alert('error');
                        }
                    });
                    var datatable = $('#tbl_class').dataTable().api();
                    datatable.clear();
                    datatable.rows.add(class_data).draw();
                    $('#add_type').show();
                    swal('Success', 'Class ' + Course_det_code + ' updated successfully.', 'success');
                    $('#faculty_loader').removeClass('sk-loading');
                    $("#curd-content").slideUp("slow", function() {
                        $("#curd-content").hide();
                    });
                    $('#course_select').select2({
                        'theme': 'bootstrap'
                    });
                    load_class();
                } else if (data.status == 2) {
                    $('#curd-content').html('');
                    $('#curd-content').html(data.view);
                    swal('', data.message, 'info');
                    $('#course_select').select2({
                        'theme': 'bootstrap'
                    });
                    $('#faculty_loader').removeClass('sk-loading');
                    load_class();
                } else if (data.status == 3) {
                    $('#curd-content').html('');
                    $('#curd-content').html(data.view);
                    swal('', data.message, 'info');
                    $('#course_select').select2({
                        'theme': 'bootstrap'
                    });
                    $('#faculty_loader').removeClass('sk-loading');
                    load_class();

                } else {
                    swal('', 'Connection Error. Please contact administrator', 'info');
                    $('#faculty_loader').removeClass('sk-loading');
                    load_class();
                }

            }
        });

    }

    function refresh_add_panel() {

        $('#class_code').val('');
        $('#class_code').parent().removeAttr('class', 'has-error');
        $('#class_description').val('');
        $('#class_description').parent().removeAttr('class', 'has-error');
        $('#course_select').select2('val', -1);

    }

    function edit_class(course_det_id, Course_det_code, Description, Course_Name) {
        var ops_url = baseurl + 'class/edit-class/';
        $.ajax({
            type: "POST",
            cache: false,
            async: false,
            url: ops_url,
            data: {
                "load": 1,
                "course_det_id": course_det_id,
                "Course_det_code": Course_det_code,
                "Description": Description,
                "course_select": Course_Name
            },
            success: function(result) {
                var data = JSON.parse(result);
                console.log(data);
                if (data.status == 1) {
                    $('#curd-content').html('');
                    $('#curd-content').html(data.view);
                    var animation = "fadeInDown";
                    $("#curd-content").show();
                    $('#curd-content').addClass('animated');
                    $('#curd-content').addClass(animation);
                    $('#add_type').hide();
                    $('#course_select').select2({
                        'theme': 'bootstrap'
                    });
                    $('#course_select').select2({
                        'theme': 'bootstrap'
                    });
                } else {
                    alert('No data loaded');
                }
            }
        });
    }

    function close_add_class() {
        $('#add_type').show();
        $("#curd-content").slideUp("slow", function() {
            $("#curd-content").hide();
        });

    }

    //NEW SCRIPT
    function add_new_class() {
        var ops_url = baseurl + 'class/add-class';
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
                    $('#course_select').select2({
                        'theme': 'bootstrap'
                    });
                } else {
                    alert('No data loaded');
                }
            }
        });
    }
</script>