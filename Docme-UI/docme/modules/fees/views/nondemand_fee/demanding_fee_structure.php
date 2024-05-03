<?php
$profile_image = "";
if (isset($details_data[0]['profile_image']) && !empty($details_data[0]['profile_image'])) {
    $profile_image = "data:image/png;base64," . $details_data[0]['profile_image'];
} else {
    if (isset($details_data['profile_image_alternate']) && !empty($details_data['profile_image_alternate'])) {
        $profile_image = $details_data['profile_image_alternate'];
    } else {
        $profile_image = base_url('assets/img/a0.jpg');
    }
}
if (isset($details_data[0]) && !empty($details_data[0])) {
    $student = $details_data[0];
} else {
    $student = NULL;
}
?>

<div class="wrapper wrapper-content animated fadeInRight" style="padding-top: 1px !important;padding-left: 0px !important;padding-right: 0px !important;">
    <div class="row" style="margin-left: -29px !important; margin-right: -30px !important;">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5><?php echo isset($sub_title) ? $sub_title : "NO TITLE PROVIDED" ?></h5>
                </div>
                <div class="ibox-content" id="fee_loader">
                    <div class="sk-spinner sk-spinner-wave">
                        <div class="sk-rect1"></div>
                        <div class="sk-rect2"></div>
                        <div class="sk-rect3"></div>
                        <div class="sk-rect4"></div>
                        <div class="sk-rect5"></div>
                    </div>
                    <div class="clearfix"></div>

                    <div class="wrapper wrapper-content animated fadeInRight" id="student-data-container">

                        <div class="row" id="data-view-feecode">
                            <div class="ibox-content" id="item_list_detail">
                                <div class="row" id="">

                                    <div class="col-lg-12">
                                        <div class="panel panel-info">
                                            <div class="panel-heading">
                                                <img src="<?php echo $profile_image; ?>" class="img-circle circle-border m-b-md" alt="profile" style="width: 40px;">
                                                <?php echo $student['student_name'] ?> <small style="float: right;"> </small>
                                                <small style="float: right;"> <?php echo $student['Batch_Name'] ?>
                                                    <br> Status : <?php echo $student['stud_status'] ?>
                                                    <br> Admission No. : <?php echo $student['Admn_No'] ?></small>
                                                <input type="hidden" id="student_id" name="student_id" value="<?php echo $student['student_id'] ?>">
                                                <input type="hidden" id="student_name" name="student_name" value="<?php echo $student['student_name'] ?>">
                                            </div>
                                            <div class="panel-body">
                                                <div class="row">
                                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                        <div class="table-responsive">

                                                            <table class="table table-hover margin bottom" id="available_fee_codes">
                                                                <thead>
                                                                    <tr>
                                                                        <th>Fee Code</th>
                                                                        <th>Fee Description</th>
                                                                        <th>Fee Type</th>
                                                                        <th>VAT</th>
                                                                        <th class="text-center">Task</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    <?php
                                                                    if (isset($fee_codes_to_link) && !empty($fee_codes_to_link)) {

                                                                        foreach ($fee_codes_to_link as $codes) {
                                                                            ?>
                                                                    <tr>
                                                                        <td><?php echo $codes['feeCode'] ?></td>
                                                                        <td><?php echo $codes['description'] ?></td>
                                                                        <td><?php echo $codes['feeTypeName'] ?></td>
                                                                        <td><?php echo $codes['vat'] . " %"; ?></td>
                                                                        <td class="text-center"><a href="javascript:void(0)" data-toggle="tooltip" title="Select feecode <?php echo $codes['feeCode'] ?> for fee allocation" onclick="select_fee_code('<?php echo $codes['feeCode'] ?>', '<?php echo $codes['description'] ?>', '<?php echo $codes['feeTypeName'] ?>', '<?php echo $codes['monthSpan'] ?>', '<?php echo $codes['vat'] . " %"; ?>', '<?php echo $codes['id'] ?>')"><i class="fa fa-paper-plane"></i></a></td>
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
                                    <div class="clearfix"></div>
                                    <div class="col-lg-12">
                                        <div class="panel panel-info">
                                            <div class="panel-heading">
                                                FEE ALLOCATION DETAILS (VAT will be calculated at the time of collection)
                                                <span class="label label-info pull-right"><a href="javascript:void(0)" data-toggle="tooltip" title="Save fee allocation to the student" onclick="allot_fee_to_student()"><i class="fa fa-floppy-o" style="font-size:19px;"></i></a></span>

                                            </div>

                                            <div class="panel-body">
                                                <div class="row">
                                                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                                        <b>Fee Activation Month*</b>
                                                        <div class="form-group">
                                                            <div class="form-line <?php
                                                                                    if (form_error('datepicker')) {
                                                                                        echo 'has-error';
                                                                                    }
                                                                                    ?> ">
                                                                <input type="text" class="form-control" id="datepicker" readonly="" style="border-color: #23C6C8;background-color: #FFFFFF;" />
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                                        <b>Remarks about the current allotment*</b>
                                                        <div class="form-group">
                                                            <div class="form-line <?php
                                                                                    if (form_error('allotment_remarks')) {
                                                                                        echo 'has-error';
                                                                                    }
                                                                                    ?> ">
                                                                <input type="text" class="form-control" id="allotment_remarks" style="border-color: #23C6C8;background-color: #FFFFFF;" />
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="clearfix"></div>
                                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                        <div class="table-responsive">
                                                            <table class="table table-hover margin bottom" id="allotted_fee_codes">
                                                                <thead>
                                                                    <tr>
                                                                        <th>Fee code</th>
                                                                        <th>description</th>
                                                                        <th>Type</th>
                                                                        <th>Demand Frequency</th>
                                                                        <th>Vat</th>
                                                                        <th class="text-center">Fees Amount</th>
                                                                        <th>Task</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>

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


<script type="text/javascript">
    $('#freqid').select2({
        'theme': 'bootstrap'
    });
    $('#monthid').select2({
        'theme': 'bootstrap'
    });
    var table2 = $('#available_fee_codes').dataTable({
        responsive: false,
        iDisplayLength: 10,
        "ordering": true,
    });
    var table3 = $('#allotted_fee_codes').dataTable({
        responsive: false,
        iDisplayLength: 10,
        "ordering": true,
        //        "fnDrawCallback": function (ele) {
        //            activateicheck();
        //            $('.icheckbox_square-green').data('toggle', 'tooltip');
        //            $('.icheckbox_square-green').attr('title', 'Is the VAT is included in the fees amount or the VAT is extra.');
        //        }
    });
    $('#datepicker').datepicker({
        minViewMode: 1,
        autoclose: true,
        format: "MM - yyyy"
    });

    function select_fee_code(feecode, desc, fee_type, demand_freq, vat, fee_code_id) {
        var table = $('#allotted_fee_codes').DataTable();
        var data = table
            .rows()
            .data();
        var flag1 = 0;
        for (var i = 0; i < data.length; i++) {
            if (data[i][0] == feecode) {
                flag1 = 1;
            }
        }

        if (flag1 == 1) {
            swal('', 'Fee Code already added in list.', 'info');
            return false;
        } else {
            var demand_ferq_text = "";
            var dTable = $('#allotted_fee_codes').DataTable();
            if (parseInt(demand_freq) == -2) {
                demand_ferq_text = "One Time Fee";
            } else {
                demand_ferq_text = "" + demand_freq + " month/s";
            }
            var is_vat_incl_check = 'is_vat_incl_check_' + fee_code_id;
            var newrow = dTable.row.add([
                feecode,
                desc,
                fee_type,
                demand_ferq_text,
                vat,
                //                '<input type="checkbox" value="" name="is_vat_incl_check" id="' + is_vat_incl_check + '" class="i-checks" data-toggle="tooltip" title="Is the VAT is included in the fees amount or the VAT is extra." />',
                '<input type="textbox" style="width:100%;" onkeypress="return validateDec(event)" onpast="return false"  maxLength="6" class="form-control fee_codes" name ="fee_codes" id="fcode_' + feecode + '" data-feecode="' + feecode + '" data-feecodeid="' + fee_code_id + '" />',
                '<a href="javascript:void(0)" data-toggle="tooltip" title="Remove from fee allocation list"  onclick="delete_allotted_fee_code(this);"><i class="fa fa-trash" style="font-size:16px;"></i></a>'
            ]).draw();

        }
    }

    //Function to allow only Decimal values to textbox
    function validateDec(key) {
        //getting key code of pressed key
        var keycode = (key.which) ? key.which : key.keyCode;
        //comparing pressed keycodes
        if (!(keycode == 8 || keycode == 46) && (keycode < 48 || keycode > 57)) {
            return false;
        } else {
            var parts = key.srcElement.value.split('.');
            if (parts.length > 1 && keycode == 46)
                return false;
            return true;
        }
    }

    function delete_allotted_fee_code(ele) {
        var table = $('#allotted_fee_codes').DataTable();
        table
            .row($(ele).parents('tr'))
            .remove()
            .draw();
    }

    function allot_fee_to_student() {
        $('#fee_loader').addClass('sk-loading');

        if (moment($("#datepicker").data("datepicker").getDate()).isValid() === true) {
            var activation_date = moment($("#datepicker").data("datepicker").getDate()).format("YYYY-MM");
        } else {
            $('#fee_loader').removeClass('sk-loading');
            swal('', 'Select a valid activation date', 'info');
            return false;
        }

        if ($('#allotment_remarks').val().trim().length < 3) {
            swal('', 'Enter remarks for the current allotment', 'info');
            swal('', 'Select a valid activation date', 'info');
            return false;
        }

        var remarks = $('#allotment_remarks').val().trim();
        var student_id = $('#student_id').val();
        var student_name = $('#student_name').val();
        var dTable = $('#allotted_fee_codes').DataTable();
        var errflag = 0;
        var fee_code_data = [];
        dTable.$('.fee_codes').each(function(i, v) {
            var float = /^\s*(\+)?((\d+(\.\d+)?)|(\.\d+))\s*$/;
            var value_for_fee = $(this).val();
            var fee_code_id = $(this).data('feecodeid');
            var fee_code = $(this).data('feecode');

            if (float.test(value_for_fee)) {
                $(this).css('border-color', '#e5e6e7');
                var obj_data = {};
                obj_data['fee_code_id'] = fee_code_id;
                obj_data['fee_code'] = fee_code;
                obj_data['demand_type'] = 1;
                obj_data['value_for_fee'] = value_for_fee;
                fee_code_data.push(obj_data);
            } else {
                $(this).css('border-color', 'red');
                errflag = 1;
            }
        });
        if (errflag == 1) {
            swal('', 'Enter valid values for fees.', 'info');
            fee_code_data = [];
            $('#fee_loader').removeClass('sk-loading');
            return false;
        }
        var ops_url = baseurl + 'fees/save-periodic-fee-allocation/';
        $.ajax({
            type: "POST",
            cache: false,
            async: false,
            url: ops_url,
            data: {
                "fee_code_data": JSON.stringify(fee_code_data),
                "student_id": student_id,
                "student_name": student_name,
                "activation_date": activation_date,
                "remarks": remarks
            },
            success: function(result) {
                var data = $.parseJSON(result);
                if (data.status == 1) {
                    show_other_fee_allotment_student_search();
                    swal('Success', 'Other fees allocated to the student, ' + student_name + ' successfully.', 'success');
                    $('#fee_loader').removeClass('sk-loading');
                    $("html, body").animate({
                        scrollTop: 0
                    }, "slow");
                } else if (data.status == 2) {
                    $('#fee_loader').removeClass('sk-loading');
                    swal('', data.message, 'info');
                    $('#fee_loader').removeClass('sk-loading');
                } else if (data.status == 3) {
                    swal('', data.message, 'info');
                    $('#fee_loader').removeClass('sk-loading');
                } else {
                    swal('', 'Connection Error. Please contact administrator', 'info');
                    $('#fee_loader').removeClass('sk-loading');
                }

            }
        });
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