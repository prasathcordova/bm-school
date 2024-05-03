<div class="ibox-title" style="border-bottom-color:#23C6C8!important">
    <h5 style="color: #1c84c6;">Temporary Registration List</h5>
    <!-- <div class="ibox-tools" id="add_type">
                                <a data-toggle="modal" class="btn btn-primary btn-xs" data-toggle="tooltip" title="Add a New Pickup Point" data-placement="left" href="javascript:void(0)" onclick="add_new_pickuppoint();">ADD NEW Pickup POINT</a>
                            </div> -->
</div>
<div class="ibox-content" id="faculty_loader1">
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
                <table id="registration_fees_tbl" class="table table-striped table-bordered table-hover dataTables-example">
                    <thead>
                        <tr>
                            <th>Temp.Admn No.</th>
                            <!--  <th>Temp.Reg ID</th> -->
                            <th>Student Name</th>
                            <th>Parent Name</th>
                            <th>Status</th>
                            <th>Task</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $breaker = 0;
                        $regid = 0;
                        if (isset($class_fee_data) && !empty($class_fee_data)) {
                            foreach ($class_fee_data as $data) {
                                if ($regid != $data['TempReg_ID']) {
                        ?>
                                    <tr>
                                        <td><?php echo $data['TempAdmn_No']; ?></td>
                                        <!--  <td><?php // echo $data['TempReg_ID']; 
                                                    ?></td> -->
                                        <td><?php echo $data['fname'] . ' ' . $data['lname']; ?></td>
                                        <td><?php echo $data['parentName'] ?></td>
                                        <td class="text-center" style="padding-top: 20px;">
                                            <?php if ($data['fileverified'] == 1) { ?>

                                                <dd class="mb-1 "><span class="label label-primary">Documents Uploaded </span></dd>
                                            <?php } else if ($data['fileverified'] == 3) { ?>
                                                <dd class="mb-1"><span class="label label-danger">Verification Rejected</span></dd>
                                                <?php } else if ($data['fileverified'] == 2) {
                                                $var = (isset($data['interview_date']) ? $data['interview_date'] : "");
                                                $intrvw = str_replace('/', '-', $var);
                                                if ($intrvw == "") { ?>
                                                    <dd class="mb-1"><span class="label label-success">Verification Completed</span></dd>
                                                <?php } else if (isset($data['interview_date'])) { ?>
                                                    <dd class="mb-1"><span class="label" style="background:green;color:white;"><?php echo "Scheduled on " . date('d/M/Y', strtotime($intrvw)); ?></span></dd>
                                                    <?php // } else {     
                                                    ?>
                                                <?php }      ?>
                                            <?php } else if ($data['fileverified'] == 4) { ?>
                                                <dd class="mb-1"><span class="label label-warning">Verification Resubmitted</span></dd> <br>
                                                <?php

                                               // $remarks = isset($data['remarks']) ? $data['remarks'] : "";
                                               // echo substr($remarks, 0, 40);
                                                ?>
                                            <?php } else { ?>
                                                Document Not Uploaded
                                            <?php } ?>
                                        </td>
                                        <td class="text-center" style="padding-top: 15px;">
                                            <?php if ($data['fileverified'] == 1) { ?>

                                                <a href="#" style="padding: 5px;" class="btn btn-info" title="Verify Now" onclick="verify_document(<?php echo $data['TempReg_ID'] ?>,1)">Verify Now</a>
                                            <?php } else if ($data['fileverified'] == 3) { ?>
                                                -
                                                <?php } else if ($data['fileverified'] == 2) {
                                                $var = (isset($data['interview_date']) ? $data['interview_date'] : "");
                                                $intrvw = str_replace('/', '-', $var);
                                                if ($intrvw == "") { ?>
                                                    <?php $nameforsch = "'" . $data['fname'] . ' ' . $data['lname'] . "'"; ?>
                                                    <a onclick="modalshow(<?php echo $data['TempReg_ID']; ?>,<?php echo $nameforsch; ?>)" style="padding: 5px;" class="btn btn-info" title="Schedule Interview"><span class="fa fa-comments-o"></span> Schedule Interview</a>
                                                <?php } else if (isset($data['interview_date'])) {

                                                    echo "-";
                                                ?>
                                                    <?php // } else {     
                                                    ?>
                                                <?php }      ?>
                                            <?php } else if ($data['fileverified'] == 4) { ?>
                                                <a href="#" class="btn btn-info" title="Verify Now" style="padding: 5px;" onclick="verify_document(<?php echo $data['TempReg_ID'] ?>,1)">Verify Now</a>
                                            <?php } else { ?>
                                                -
                                            <?php } ?>



                                        </td>
                                    </tr>
                        <?php
                                    $regid = $data['TempReg_ID'];
                                }
                            }
                        }
                        ?>
                    </tbody>
                </table>
                <div id="myModalinterview2" class="modal fade" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <h3 class="m-t-none m-b">Interview Schedule</h3>
                                        <form id="schedule_form" name="schedule_form" method="post" action="">

                                            <div class="form-group"><label>Schedule Date</label>
                                                <div class="input-group" data-autoclose="true">
                                                    <input type="text" class="form-control sch_date" readonly="" placeholder="Enter Schedule date" style="background-color:#fff;" id="sch_date" name="sch_date">
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
    var table = $('#registration_fees_tbl').dataTable({
        // columnDefs: [{
        //     "width": "100%",
        //     "targets": 0
        // }, ],
        responsive: false,
        //iDisplayLength: 10,
        "order": [
            [0, "desc"]
        ],
        dom: '<"html5buttons"B>lTfgitp',
        buttons: [{
                extend: 'copy'
            },
            {
                extend: 'csv',
                exportOptions: {
                    columns: [0, 1, 2, 3, 4]
                }
            },
            {
                extend: 'excel',
                title: 'Report',
                exportOptions: {
                    columns: [0, 1, 2, 3, 4]
                }
            },
        ],
    });

    function verify_document(temp_reg_id, isverified = 1) {
        $('#faculty_loader1').addClass('sk-loading');
        if (temp_reg_id == '') {
            swal('', 'Choose atleast 1  temporary registration.', 'info');
            $('#faculty_loader1').removeClass('sk-loading');
            return false;
        }
        var ops_url = baseurl + 'online-registration/allocate-registration-documents';
        $.ajax({
            type: "POST",
            cache: false,
            async: false,
            url: ops_url,
            data: {
                "load": 1,
                "checked_temp_ids": temp_reg_id,
                "flag": 3,
                "isverified": isverified,
            },
            success: function(result) {
                var data = JSON.parse(result);
                if (data.status == 1) {
                    $('#faculty_loader1').removeClass('sk-loading');
                    $('.registration-list').hide();
                    $('#close-main-content').hide();
                    $('#curd-content').html('');
                    $('#curd-content').html(data.view);
                    $("#curd-content").slideUp("slow", function() {
                        $("#curd-content").show();
                    });

                } else {
                    $('#curd-content').removeClass('sk-loading');
                    swal('', 'Document upload failed,Please try again.', 'error');
                }
            }
        });
        /* swal({
                title: "",
                text: "Once payment process initiated cannot be revert back , Make sure to continue?",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Yes",
                cancelButtonText: "No",
                closeOnConfirm: true,
            },
            function(isconfirm) {
                if (isconfirm) {
                    
                }
            }
        ); */


    }

    function modalshow(stud_id, stud_name) {

        $('#stud_id').val("");
        $('#sch_date').val("");
        $('#stud_name').val("");
        $('#stud_id').val(stud_id);
        $('#stud_name').val(stud_name);
        $('#myModalinterview2').modal('show'); // #myModal (id of modal box)
        $('.clockpicker').clockpicker(); // clockpicker js
        $("#sch_date").datepicker({
            format: 'dd/mm/yyyy',
            todayHighlight: 'TRUE',
            startDate: new Date(),
            autoOpen: false,
            autoclose: true
        })
    }

    function submit_schedule_data() {
        $('#faculty_loader1').addClass('sk-loading');

        var ops_url = baseurl + 'country/add-country/';
        var sch_date = $('#sch_date').val();
        var sch_time = $('#sch_time').val();
        var stud_id = $("#stud_id").val();
        var stud_name = $("#stud_name").val();
        if (sch_date == '') {
            swal('', 'Schedule Date is required.', 'info');
            $('#faculty_loader1').removeClass('sk-loading');
            return false;
        }
        if (sch_time == '') {
            swal('', 'Schedule Time is required.', 'info');
            $('#faculty_loader1').removeClass('sk-loading');
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
                //console.log(result);
                var data = $.parseJSON(result)
                if (data.status == 1) {
                    //$("#faculty_loader1").addClass("sk-loading"); 
                    $('#myModalinterview2').modal('hide');
                    $("#sch_date").attr("disabled", true);
                    $('.datepicker-dropdown').css("display", "none");
                    swal({
                        title: '',
                        text: data.message,
                        type: 'info',
                        showCancelButton: false,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'OK'
                    }, function(isConfirm) {
                        $("#sch_date").attr("disabled", false);
                        $('.datepicker-dropdown').css("display", "blobk");
                        get_data();


                    });

                    // $("#faculty_loader1").removeClass("sk-loading");
                } else if (data.status == 2) {
                    $("#faculty_loader1").removeClass("sk-loading");
                    swal('', data.message, 'info');

                } else if (data.status == 3) {
                    $("#faculty_loader1").removeClass("sk-loading");
                    swal('', data.message, 'info');

                } else {
                    $("#faculty_loader1").removeClass("sk-loading");
                    swal('', 'Connection Error. Please contact administrator', 'info');

                }

            }
        });
    }
</script>