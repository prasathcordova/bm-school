<div class="ibox-title" style="border-bottom-color:#23C6C8!important">
    <h5 style="color: #1c84c6;">Temporary Registration List</h5>
    <!-- <div class="ibox-tools" id="add_type">
                                <a data-toggle="modal" class="btn btn-primary btn-xs" data-toggle="tooltip" title="Add a New Pickup Point" data-placement="left" href="javascript:void(0)" onclick="add_new_pickuppoint();">ADD NEW Pickup POINT</a>
                            </div> -->
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
    <div class="wrapper wrapper-content animated fadeInRight" id="student-data-container">

        <div class="row">

            <div class="col-lg-12">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group <?php
                                                if (form_error('staff_name')) {
                                                    echo 'has-error';
                                                }
                                                ?>">
                            <label>Staff Name</label><span class="mandatory"> *</span><br />

                            <select name="staff_name" id="staff_name" class="form-control " style="width:100%;">

                                <option selected value="-1">Select</option>

                                <?php
                                if (isset($staff_details) && !empty($staff_details)) {
                                    foreach ($staff_details as $staff) {
                                        echo '<option value ="' . $staff['Emp_id'] . '">' . $staff['empfirst'] . " " . $staff['emplast'] . '</option>';
                                    }
                                }
                                ?>
                            </select>
                            <?php echo form_error('staff_name', '<div class="form-error">', '</div>'); ?>
                        </div>
                    </div>
                    <div class="col-md-4" style="padding: 18px;">
                        <div class="form-group pull-right">
                            <button type="submit" class="btn btn-info" id="staff_assign" title="Assign Staff">Assign Staff</button>
                            <div id="selected_datas"></div>
                        </div>
                    </div>

                </div>
                <hr>
                </hr>
                <table id="registration_fees_tbl" class="table table-striped table-bordered table-hover dataTables-example">
                    <thead>
                        <tr>
                            <!--  <th>Temp.Id</th> -->
                            <th>Temp.Admn No.</th>
                            <th>Student Name</th>
                            <th>Class </th>
                            <th>Parent Name</th>
                            <th><input type="checkbox" class="checkall" /> Assign To</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $breaker = 0;
                        $regid = 0;
                        if (isset($class_fee_data) && !empty($class_fee_data)) {
                            foreach ($class_fee_data as $data) {
                                if ($regid != $data['TempReg_ID']) {
                                    if ($data['verify_by'] || $data['file_1']) {
                        ?>
                                        <tr>
                                            <!--  <td><?php // echo $data['TempReg_ID']; 
                                                        ?></td> -->
                                            <td><?php echo $data['TempAdmn_No']; ?></td>
                                            <td><?php echo $data['fname'] . ' ' . $data['lname']; ?></td>
                                            <td><?php echo $data['class'] ?></td>
                                            <td><?php echo $data['parentName'] ?></td>
                                            <td>
                                                <?php if ($data['verify_by']) { ?>
                                                    <dd class="mb-1 assign_staff"><span class="label label-primary staff_name"><?php echo $data['First_name'] . " " . $data['Last_name']; ?></span>
                                                    <a href="javascript:void(0);" class="staff_reassign" data-toggle="tooltip" data-placement="right" title="Reassign Staff" data-original-title="<?php echo $data['TempReg_ID']; ?>"><i class="fa fa-pencil" style="font-size: 14px; color: #23C6C5; margin: 2%; "></i></a></dd>
                                                    <dd class="mb-1 reassign_staff" style="display:none"><input type="checkbox" name="checked_item[]" class="dt_checkbox" checked value="<?php echo $data['TempReg_ID']; ?>" />
                                                    <a href="javascript:void(0);" class="staff_reassign_cancel" data-toggle="tooltip" data-placement="right" title="Reassign Staff Cancel" ><i class="fa fa-remove" style="font-size: 14px; color: #b30707; margin: 2%; "></i></a></dd>
                                                <?php } else if ($data['file_1']) { ?>
                                                    <input type="checkbox" name="checked_item[]" class="dt_checkbox" value="<?php echo $data['TempReg_ID']; ?>" />
                                                <?php } else { ?>
                                                    Document Not Uploaded
                                                <?php } ?>

                                            </td>

                                        </tr>
                        <?php
                                        $regid = $data['TempReg_ID'];
                                    }
                                }
                            }
                        }
                        ?>
                    </tbody>
                </table>
                <div id="myModalinterview" class="modal fade" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <h3 class="m-t-none m-b">Interview Schedule</h3>
                                        <form id="schedule_form" name="schedule_form" method="post" action="">

                                            <div class="form-group"><label>Schedule Date</label>
                                                <div class="input-group" data-autoclose="true">
                                                    <input type="text" class="form-control" readonly="" placeholder="Enter Schedule date" style="background-color:#fff;" id="sch_date" name="sch_date">
                                                    <span class="input-group-addon">
                                                        <span class="fa fa-calendar"></span>
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="form-group"><label>Schedule Time</label>
                                                <div class="input-group clockpicker" data-autoclose="true">
                                                    <input type="text" class="form-control" id="sch_time" name="sch_time" value="09:30" placeholder="Enter Schedule time">
                                                    <span class="input-group-addon">
                                                        <span class="fa fa-clock-o"></span>
                                                    </span>
                                                </div>
                                            </div>
                                            <input type="hidden" class="form-control" id="stud_id" name="stud_id" value="">
                                            <input type="hidden" class="form-control" id="stud_name" name="stud_name" value="">
                                            <div>
                                                <button type="button" class="btn btn-sm btn-white" data-dismiss="modal">Close</button>
                                                <a href="javascript:void(0)" onclick="submit_schedule_data();" class="btn btn-sm btn-primary float-right m-t-n-xs"> <i class="material-icons" data-toggle="tooltip" title="Save"></i>Schedule</a>
                                            </div>
                                        </form>
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

<script type="text/javascript">
    $("#staff_name").select2({
        "theme": "bootstrap"
    });
    var table = $('#registration_fees_tbl').dataTable({
        // columnDefs: [{
        //     "width": "100%",
        //     "targets": 0
        // }, ],
        aoColumnDefs: [{
            bSortable: false,
            aTargets: [-1]
        }],
        responsive: false,
        //iDisplayLength: 10,
        "order": [
            [1, "desc"]
        ],
        dom: '<"html5buttons"B>lTfgitp',
        buttons: [{
                extend: 'copy'
            },
            {
                extend: 'csv',
                exportOptions: {
                    columns: [0, 1, 2, 3,4]
                }
            },
            {
                extend: 'excel',
                title: 'Report',
                exportOptions: {
                    columns: [0, 1, 2, 3,4]
                }
            },
        ],
    });

    $(".staff_reassign").click(function() {
        $('.assign_staff').hide();
        $('.reassign_staff').show();
    });
    $(".staff_reassign_cancel").click(function() {
        $('.reassign_staff').hide();
        $('.assign_staff').show();
       
    });
    
    $(".checkall").click(function() {
        $('.dt_checkbox').prop('checked', $(this).prop("checked"));
    });
    $(document).on('click', '#staff_assign', function(e) {
        var staff_assign = $(this).val()
        var staff_name = $("#staff_name").val()
        if ($("#registration_fees_tbl input:checkbox:checked").length > 0) {
            e.preventDefault();
            var seleted_field = [];
            $("#selected_datas").html('');
            $('input[name^="checked_item"]:checked').each(function(i) {
                seleted_field[i] = $(this).val();
                $("#selected_datas").append('<input type="hidden" name="checked_item[]" class="staff_assign_check" value="' + $(this).val() + '" checked="checked" >');

            });
        } else {
            swal("", "Select atleast one temporary registration.", "warning");
            //$('#export_report_pdf').val(0);
            return false;
        }
        if (staff_name == -1) {
            swal('', 'Select Staff', 'warning');
            return false;
        }
        assign_staff(seleted_field, staff_name);
        //  $('#form_orders').submit();
    });

    function assign_staff(temp_reg_id, staff_name) {
        $('#faculty_loader').addClass('sk-loading');
        if (staff_name == -1) {
            swal('', 'Select Staff.', 'warning');
            $('#faculty_loader').removeClass('sk-loading');
            return false;
        }
        if (temp_reg_id == '') {
            swal('', 'Select atleast one temporary registration.', 'warning');
            $('#faculty_loader').removeClass('sk-loading');
            return false;
        }

        var ops_url = baseurl + 'online-registration/allocate-staff';
        $.ajax({
            type: "POST",
            cache: false,
            async: false,
            url: ops_url,
            data: {
                "load": 1,
                "checked_temp_ids": temp_reg_id,
                "staff_id": staff_name
            },
            success: function(result) {
                var data = JSON.parse(result);
                if (data.status == 1) {
                    $("#faculty_loader").addClass("sk-loading");
                    get_data();
                    swal('', data.message, 'info');

                } else {
                    $('#curd-content').removeClass('sk-loading');
                    swal('', 'Staff Assigned failed,Please try again.', 'error');
                }
            }
        });
        

    }

    function modalshow(stud_id, stud_name) {
        $('#stud_id').val("");
        $('#sch_date').val("");
        $('#stud_name').val("");
        $('#stud_id').val(stud_id);
        $('#stud_name').val(stud_name);
        $('#myModalinterview').modal('show'); // #myModal (id of modal box)
        $('.clockpicker').clockpicker(); // clockpicker js
        $('#sch_date').datepicker({
            format: 'dd/mm/yyyy',
            todayHighlight: 'TRUE',
            autoclose: true
        })
    }

    function submit_schedule_data() {
        $('#faculty_loader').addClass('sk-loading');

        var ops_url = baseurl + 'country/add-country/';
        var sch_date = $('#sch_date').val();
        var sch_time = $('#sch_time').val();
        var stud_id = $("#stud_id").val();
        var stud_name = $("#stud_name").val();
        if (sch_date == '') {
            swal('', 'Schedule Date is required.', 'info');
            $('#faculty_loader').removeClass('sk-loading');
            return false;
        }
        if (sch_time == '') {
            swal('', 'Schedule Time is required.', 'info');
            $('#faculty_loader').removeClass('sk-loading');
            return false;
        }
        var ops_url = baseurl + 'online-registration/add-interview-schedule';
        $.ajax({
            type: "POST",
            cache: false,
            async: false,
            url: ops_url,
            data: {
                sch_date: sch_date,
                sch_time: sch_time,
                temp_id: stud_id,
                stud_name: stud_name
            },
            success: function(result) {
                console.log(result);
                var data = $.parseJSON(result)
                if (data.status == 1) {
                    $("#faculty_loader").removeClass("sk-loading");
                    swal('', data.message, 'info');
                    $('#myModalinterview').modal('hide');
                } else if (data.status == 2) {
                    $("#faculty_loader").removeClass("sk-loading");
                    swal('', data.message, 'info');

                } else if (data.status == 3) {
                    $("#faculty_loader").removeClass("sk-loading");
                    swal('', data.message, 'info');

                } else {
                    $("#faculty_loader").removeClass("sk-loading");
                    swal('', 'Connection Error. Please contact administrator', 'info');

                }

            }
        });
    }
</script>