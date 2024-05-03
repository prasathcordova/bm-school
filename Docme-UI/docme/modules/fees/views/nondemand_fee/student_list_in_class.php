<?php
$acdstartdate = $_SESSION['acd_year_start'];
$acdenddate = $_SESSION['acd_year_end'];
?>
<div class="wrapper wrapper-content animated fadeInRight" id="tbl_id" style="padding: 1px 0 0 0 !important;">
    <div class="row">
        <div class="col-lg-12">
            <!--<div class="col-sm-12">-->
            <div class="ibox float-e-margins" style="margin-bottom: 0;">
                <div class="ibox-title" style="border-bottom-color:#ffd300 !important;">
                    <h5>Student List</h5>
                    <div class="ibox-tools">
                        <a href="javascript:void(0)" id="close_table" class="pull-right"> <i class="material-icons close" style="color:#E91E63; font-size:30px;opacity: 10;" data-toggle="tooltip" title="Close">close</i></a>
                        <span><a href="javascript:void(0)" onclick="allocate_fee_to_student()"> <i style="font-size: 30px !important;  float: right;color: #23C6C5;" class="material-icons" data-toggle="tooltip" title="Save">save</i></a> </span>
                    </div>
                </div>
                <div class="ibox-content no-margin" id="student_code_loader">
                    <div class="sk-spinner sk-spinner-wave">
                        <div class="sk-rect1"></div>
                        <div class="sk-rect2"></div>
                        <div class="sk-rect3"></div>
                        <div class="sk-rect4"></div>
                        <div class="sk-rect5"></div>
                    </div>
                    <div class="row clearfix" style="padding-top: 10px;">
                        <div class="col-lg-12">

                            <div class="form-group">
                                <label>Demand Date *</label>
                                <div class="form-line">
                                    <input type="text" class="form-control" name="activation_date" readonly="" style="background-color:white;" id="reportdate" placeholder="Enter Demanding Date">
                                </div>
                            </div>
                            <hr />
                            <input type="hidden" value="<?php echo $feedata ?>" id="feedata_sel" name="feedata_sel">
                            <?php //dev_export(explode('*', $feedata));
                            $feedatadetails = explode('*', $feedata);
                            ?>
                            <input type="hidden" id="feedesc" value="<?php echo $feedatadetails[1]; ?>">
                            <table class="table table-bordered margin bottom" id="available_cheque_for_reconcile">
                                <thead>
                                    <tr>
                                        <th>Fee Code</th>
                                        <th>Description</th>
                                        <th>Fee Type</th>
                                        <th style="text-align: center;">Tax</th>
                                        <th>Fee Amount</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td style="vertical-align:middle;"><?php echo $feedatadetails[0]; ?></td>
                                        <td style="vertical-align:middle;"><?php echo $feedatadetails[1]; ?></td>
                                        <td style="vertical-align:middle;"><?php echo $feedatadetails[2]; ?></td>
                                        <td style="vertical-align:middle; text-align:center;"><?php echo $feedatadetails[3]; ?>%</td>
                                        <td style="text-align:right;"><input type="text" class="form-control decimalCheck text-right" placeholder="Enter Fee Amount" id="feeamount" maxlength="10" style="border-color: #23C6C8;background-color: #FFFFFF;" /></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="clearfix"></div>
                        <div class="col-lg-12 col-md-12 col-xs-12 col-sm-12">



                            <div class="table-responsive">
                                <div class="">
                                    <table class="table table-hover issue-tracker dataTables-example" id="tbl_student" style="width:100%;">
                                        <thead>
                                            <tr>
                                                <th>Student Name</th>
                                                <th>Admission No.</th>
                                                <th>Batch</th>
                                                <th>Class</th>
                                                <th>Task</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            // dev_export($details_data);
                                            if (isset($details_data) && !empty($details_data) && is_array($details_data)) {
                                                //echo ($student_data[0]['already_in_list']);
                                                $already_list = explode(",", $already_in_list);
                                                if (!is_array($already_list)) $already_list = array($already_list);
                                                // print_r($already_list);

                                                foreach ($details_data as $student) {
                                                    if (trim($student['StatusFlag']) == 'L') {
                                                        $chk = 'disabled';
                                                        $bgc = 'style = background:#f3f3f3';
                                                        $rowtitle = $student['student_name'] . ' is Long Absentee';
                                                    } else if (in_array($student['student_id'], $already_list) && $feedatadetails[0] == 'F007') {
                                                        $chk = 'disabled';
                                                        $bgc = 'style = background:#f1f1f1';
                                                        $rowtitle = $feedatadetails[1] . ' already demanded for ' . $student['student_name'];
                                                    } else {
                                                        $chk = '';
                                                        $bgc = '';
                                                        $rowtitle = '';
                                                    }

                                                    // if (in_array($student['student_id'], $already_list)) {
                                                    //     $chk = 'disabled';
                                                    //     $bgc = 'style = background:#f1f1f1';
                                                    //     $rowtitle = $feedatadetails[1] . ' already demanded for ' . $student['student_name'];
                                                    // } else {
                                                    //     $chk = '';
                                                    //     $bgc = '';
                                                    //     $rowtitle = '';
                                                    // }

                                            ?>
                                                    <tr <?php echo $bgc; ?> title="<?php echo $rowtitle; ?>">
                                                        <td>
                                                            <b title="Student Name">
                                                                <?php echo $student['student_name'] ?>
                                                            </b>
                                                        </td>
                                                        <td>
                                                            <b title="Student Admission Number">
                                                                <?php echo $student['Admn_No'] ?>
                                                            </b>
                                                        </td>
                                                        <td title="Batch Name"> <?php echo $student['batchname'] ?></td>
                                                        <td title="Class"> <?php echo $student['classname'] ?></td>
                                                        <td>
                                                            <div class="i-checks pull-left" title="Select/Deselect  <?php echo $student['student_name'] ?>"><label> <input class="student_selector" data-toggle="tooltip" data-placement="right" data-batch_id="<?php echo $student['Cur_Batch'] ?>" data-class_id="<?php echo $student['Cur_Class'] ?>" data-student_id="<?php echo $student['student_id'] ?>" data-studentname="<?php echo $student['student_name']; ?>" data-admissionnumber="<?php echo $student['Admn_No']; ?>" title="Confirm item" data-original-title="" id="<?php echo $student['student_id'] ?>" type="checkbox" value="" <?php echo $chk; ?>> <i></i> </label></div>
                                                        </td>
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

<script>
    $('.i-checks').iCheck({
        checkboxClass: 'icheckbox_square-green',
        radioClass: 'iradio_square-green',
    });
    $('.scroll_content').slimscroll({
        height: '500px',
        color: '#f8ac59'

    })

    $(document).ready(function() {

        $('#reportdate').datepicker({
            format: 'dd/mm/yyyy',
            autoclose: true,
            startDate: '<?php echo date('d/m/Y', strtotime($acdstartdate)); ?>',
            endDate: '<?php echo date('d/m/Y', strtotime($acdenddate)); ?>'

        });

        // $('#datepicker').datepicker({
        //     minViewMode: 1,
        //     autoclose: true,
        //     format: "MM - yyyy",
        //     startDate: '<?php echo date('M/Y', strtotime($acdstartdate)); ?>',
        //     endDate: '<?php echo date('M/Y', strtotime($acdenddate)); ?>'

        // });


        //     
        //$('#datepicker').datepicker({
        //    format: "mm/yyyy",
        //    startView: "year", 
        //    minViewMode: "months"
        //})

        $("#close_table").click(function() {

            $("#tbl_id").slideUp();
        });
        var table = $('#tbl_student').dataTable({

            columnDefs: [{
                    "width": "30%",
                    className: "capitalize",
                    "targets": 0
                },
                {
                    "width": "15%",
                    className: "capitalize",
                    "targets": 1
                },
                {
                    "width": "25%",
                    className: "capitalize",
                    "targets": 2
                },
                {
                    "width": "20%",
                    className: "capitalize",
                    "targets": 3,
                },
                {
                    "width": "10%",
                    className: "capitalize",
                    "targets": 4,
                    "orderable": false
                }
            ],
            responsive: false,
            bPaginate: false,
            stateSave: false,
            showNEntries: false,
            lengthChange: false,
            //            iDisplayLength: 100,
            dom: '<"html5buttons"B>lTfgitp',
            buttons: [{
                    text: 'SELECT ALL',
                    action: function(e, dt, node, config) {

                        $('.student_selector').not(":disabled").iCheck('check');
                        $('.student_selector').iCheck('update');

                    }
                },
                {
                    text: 'DESELECT ALL',
                    action: function(e, dt, node, config) {

                        $('.student_selector').iCheck('uncheck');
                        $('.student_selector').iCheck('update');

                    }
                },
            ],
            "fnDrawCallback": function(ele) {
                $('.i-checks').iCheck({
                    checkboxClass: 'icheckbox_square-green',
                    radioClass: 'iradio_square-green',
                });
            }

        });
    });


    function allocate_fee_to_student() {
        $('#student_code_loader').addClass('sk-loading');
        var feecode_id = $("#feecode_sel").val();
        var feename = $("#feename_sel").val();
        var feeamount = $("#feeamount").val();

        var feedesc = $("#feedesc").val();

        if ($('#reportdate').val() == "") {
            $('#fee_loader').removeClass('sk-loading');
            swal('', 'Demand Date Required', 'warning');
            return false;
        }
        //
        var ddate = $('#reportdate').val();
        var arrayb = ddate.split("/");
        var repdate = arrayb[2] + '-' + arrayb[1] + '-' + arrayb[0]; // Formatted for dd/mm/yyyy
        var frmdt = moment(repdate).format('YYYY-MM-DD');
        var activation_date = frmdt;

        if (feeamount == '' || feeamount <= 0) {
            swal('', 'Fee Amount Required.', 'warning');
            $('#student_code_loader').removeClass('sk-loading');
            return false;
        }

        var fee_code_data = [];
        var obj_data = {};
        obj_data['fee_code_id'] = feecode_id;
        obj_data['fee_code'] = feename;
        obj_data['value_for_fee'] = feeamount;
        fee_code_data.push(obj_data);

        var student_data = [];
        var table = $('#tbl_student').dataTable();
        table.$('input[type=checkbox]').not(":disabled").each(function() {
            if (this.checked) {
                var student_id = $(this).data('student_id');
                var batch_id = $(this).data('batch_id');
                var class_id = $(this).data('class_id');
                var student_name = $(this).data('studentname');
                student_data.push({
                    student_id: student_id,
                    batch_id: batch_id,
                    class_id: class_id
                });
            }
        });
        var formatted_student_data = JSON.stringify(student_data);
        if (formatted_student_data.length == 2 || formatted_student_data.length < 2) {
            swal('', 'No Student(s) Selected.', 'warning');
            $('#student_code_loader').removeClass('sk-loading');
            return false;
        }

        var ops_url = baseurl + 'fees/save-other-fee-allocation/';
        $.ajax({
            type: "POST",
            cache: false,
            async: true,
            url: ops_url,
            data: {
                "fee_code_data": JSON.stringify(fee_code_data),
                "feecode_id": feecode_id,
                "feeamount": feeamount,
                "student_allocation_data": formatted_student_data,
                "type": "class_demand",
                "activation_date": activation_date
            },
            success: function(result) {
                $('#student_code_loader').addClass('sk-loading');
                var data = JSON.parse(result);
                if (data.status == 1) {
                    //swal('Success', 'Fees allocated for the fee ' + feename + ' with the selected student/s  successfully.', 'success');
                    swal('Success', feedesc + ' allocated for the selected student(s) successfully.', 'success');
                    show_other_fee_allotment_student_search();
                    $('#student_code_loader').removeClass('sk-loading');
                    $("#curd-content").slideUp("slow", function() {
                        $("#curd-content").hide();
                    });
                } else if (data.status == 2) {
                    swal('', data.message, 'info');
                    $('#student_code_loader').removeClass('sk-loading');
                } else if (data.status == 3) {
                    swal({
                        title: 'Success with warnings',
                        text: 'The following students fees are not allocated as they may have allocated earlier.' + data.student_data,
                        type: 'success',
                        html: true,
                        showCancelButton: false,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'OK',
                        closeOnConfirm: true,
                        closeOnCancel: true,
                    });
                    $('.scroll_content').slimscroll({
                        height: '100px',
                        color: '#f8ac59'
                    });
                    $('#student_code_loader').removeClass('sk-loading');
                } else if (data.status == 4) {
                    if (data.message) {
                        swal('', data.message, 'info');
                        $('#student_code_loader').removeClass('sk-loading');
                        return false;
                    } else {
                        swal('', 'An error encountered. Please try again or contact administrator with the error code UITEMPASGFCOD003', 'info');
                        $('#student_code_loader').removeClass('sk-loading');
                        return false;
                    }
                } else {
                    swal('', 'Connection Error. Please contact administrator', 'info');
                    $('#student_code_loader').removeClass('sk-loading');
                }
            }
        });
        $('#student_code_loader').removeClass('sk-loading');
    }

    function show_other_fee_allotment_student_search() {
        var ops_url = baseurl + 'fees/show-nonperiodicfee-student-filter/';
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
</script>