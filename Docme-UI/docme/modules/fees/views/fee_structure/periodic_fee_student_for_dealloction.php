<div class="wrapper wrapper-content animated fadeInRight" style="padding-top: 1px !important;padding-left: 0px !important;padding-right: 0px !important;">
    <div class="row" style="margin-left: -29px !important; margin-right: -30px !important;">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5><?php echo isset($sub_title) ? $sub_title : "NO TITLE PROVIDED" ?></h5>
                </div>
                <div class="ibox-content" id="faculty_loader">
                    <div class="sk-spinner sk-spinner-wave">
                        <div class="sk-rect1"></div>
                        <div class="sk-rect2"></div>
                        <div class="sk-rect3"></div>
                        <div class="sk-rect4"></div>
                        <div class="sk-rect5"></div>
                    </div>
                    <div class="clearfix"></div>
                    <div class="wrapper wrapper-content animated fadeInRight" id="student-data-container" style="padding-top:0px !important;">

                        <div class="row" id="data-view-feecode">
                            <div class="ibox-content" id="item_list_detail">
                                <div class="row" id="">

                                    <div class="clearfix"></div>
                                    <div class="col-lg-12">
                                        <div class="panel panel-primary">
                                            <div class="panel-heading">
                                                STUDENTS ALLOCATED WITH PERIODIC FEE TEMPLATE <?php echo strtoupper($template_name); ?>

                                                <span class="label label-info pull-right"><a data-toggle="tooltip" title="Deallocate selected students" href="javascript:void(0)" onclick="save_template_deallocation()"><i class="fa fa-floppy-o" style="font-size:19px;"></i></a></span>
                                                <input type="hidden" name="tempalte_name_for_show" id="tempalte_name_for_show" value="<?php echo $template_name; ?>" />
                                                <input type="hidden" name="template_id" id="template_id" value="<?php echo $template_id; ?>" />
                                            </div>
                                            <div class="panel-body">
                                                <div class=" animated fadeInDown" id="tbl_id">
                                                    <h3>Student List</h3>
                                                    <div class="table-responsive">
                                                        <div class="">
                                                            <table class="table table-hover dataTables-example" id="tbl_student" style="width:100%;">
                                                                <thead>
                                                                    <tr>

                                                                        <th>Student Name</th>
                                                                        <th>Admission Number</th>
                                                                        <th>Class</th>
                                                                        <th>Batch</th>
                                                                        <th>Task</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    <?php
                                                                    if (isset($student_data) && !empty($student_data) && is_array($student_data)) {
                                                                        $student_id = 0;
                                                                        $flag = 1;
                                                                        foreach ($student_data as $student) {

                                                                            if ($student_id == $student['student_id']) {
                                                                                $flag = $flag + 1;
                                                                            } else {
                                                                                $flag = 1;
                                                                            }
                                                                            $student_id = $student['student_id'];
                                                                    ?>

                                                                            <tr>
                                                                                <td>
                                                                                    <b title="Student Name">
                                                                                        <?php echo $student['student_name']; ?>
                                                                                    </b>
                                                                                </td>
                                                                                <td>

                                                                                    <p title="Student Admission Number">
                                                                                        <?php echo $student['Admn_No']; ?>
                                                                                    </p>
                                                                                </td>
                                                                                <td data-toggle="tooltip" title="Class"><?php echo $student['class_description']; ?></td>
                                                                                <td>
                                                                                    <div title="Batch" class="label label-warning"> <?php echo $student['Batch_Name']; ?></div>

                                                                                </td>
                                                                                <td title="Select to remove from fee template">
                                                                                    <input data-template_id="<?php echo $template_id; ?>" data-student_id="<?php echo $student['student_id'] ?>" class="student_selector" type="checkbox" />
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
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>



<script>
    $('.student_selector').iCheck({
        checkboxClass: 'icheckbox_square-green',
        radioClass: 'iradio_square-green',
    });
    var table = $('#tbl_student').dataTable({

        columnDefs: [{
                "width": "40%",
                className: "capitalize",
                "targets": 0
            },
            {
                "width": "20%",
                className: "capitalize",
                "targets": 1
            },
            {
                "width": "20%",
                className: "capitalize",
                "targets": 2
            }, //, "orderable": false
            {
                "width": "20%",
                className: "capitalize",
                "targets": 3
            } //, "orderable": false
        ],
        "aaSorting": [],

        bPaginate: true,
        //        stateSave: true,
        "lengthMenu": [
            [250, 500, 750, -1],
            [250, 500, 750, "All"]
        ],
        pageLength: 250,
               dom: '<"html5buttons"B>lTfgitp',
               buttons: [
        
               ],
        "fnDrawCallback": function(ele) {
            $('.student_selector').iCheck({
                checkboxClass: 'icheckbox_square-green',
                radioClass: 'iradio_square-green',
            });
        }

    });

    function save_template_deallocation() {
        $('#faculty_loader').addClass('sk-loading');
        var template_name = $('#tempalte_name_for_show').val();
        var template_id = $('#template_id').val();
        var dTable = $('#tbl_student').DataTable();
        var errflag = 1;
        var student_data = [];
        dTable.$('.student_selector').each(function(i, v) {
            if ($(this).prop("checked") === true) {
                var student_id = $(this).data('student_id');
                student_data.push({
                    student_id: student_id
                });

                errflag = 0
            }
        });

        if (errflag == 1) {
            swal('', 'Select atleast one student for deallocation.', 'info');
            fee_code_data = [];
            $('#faculty_loader').removeClass('sk-loading');
            return false;
        }
        //*********
        swal({
                title: "Deallocate Student",
                text: "Are you sure you want to deallocate the students from this template " + template_name + "?",
                type: "info",
                showCancelButton: true,
                confirmButtonClass: "btn-primary",
                confirmButtonText: "Deallocate",
                cancelButtonText: "Cancel",
                closeOnConfirm: false,
                closeOnCancel: true
            },
            function(isConfirm) {
                if (isConfirm) {
                    var ops_url = baseurl + 'fees/save-students-to-detach/';
                    $.ajax({
                        type: "POST",
                        cache: false,
                        async: false,
                        url: ops_url,
                        data: {
                            "student_data": JSON.stringify(student_data),
                            "template_id": template_id,
                            "template_name": template_name
                        },
                        success: function(result) {
                            var data = $.parseJSON(result);
                            if (data.status == 1) {
                                load_template_deallocation();
                                swal('Success', 'Students are deallocated from the template , ' + template_name + ' successfully.', 'success');
                                $('#faculty_loader').removeClass('sk-loading');
                                $("html, body").animate({
                                    scrollTop: 0
                                }, "slow");
                            } else if (data.status == 2) {
                                $('#faculty_loader').removeClass('sk-loading');
                                swal('Failed', data.message, 'error');
                                $('#faculty_loader').removeClass('sk-loading');
                            } else if (data.status == 3) {
                                swal('Failed', data.message, 'warning');
                                $('#faculty_loader').removeClass('sk-loading');
                            } else {
                                swal('Failed', 'Connection Error. Please contact administrator.', 'info');
                                $('#faculty_loader').removeClass('sk-loading');
                            }

                        }
                    });
                }
            });
        $('#faculty_loader').removeClass('sk-loading');
        //*********
        //Saving data

    }

    function load_template_deallocation() {
        var template_name = $('#tempalte_name_for_show').val();
        var template_id = $('#template_id').val();
        var ops_url = baseurl + 'fees/view-students-to-detach/';
        $.ajax({
            type: "POST",
            cache: false,
            async: false,
            url: ops_url,
            data: {
                "load": 1,
                "template_id": template_id,
                "template_name": template_name
            },
            success: function(result) {
                var data = JSON.parse(result);
                if (data.status == 1) {
                    $('#data-view').html(data.view);
                    var animation = "fadeInDown";
                    $('#search-feecode').hide();
                    $("#curd-content").show();
                    $('#curd-content').addClass('animated');
                    $('#curd-content').addClass(animation);
                    $('#add_type').hide();
                    $("html, body").animate({
                        scrollTop: 0
                    }, "slow");
                } else {
                    var ops_url = baseurl + 'fees/fees-student-deallocation-load-template/';
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
                            $("html, body").animate({
                                scrollTop: 0
                            }, "slow");
                        }
                    });
                }

            }
        });

    }
</script>