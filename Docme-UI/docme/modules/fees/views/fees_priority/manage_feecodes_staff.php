<div class="wrapper wrapper-content animated fadeInRight" style="padding-top: 1px !important;padding-left: 0px !important;padding-right: 0px !important;">
    <div class="row" style="margin-left: -29px !important; margin-right: -30px !important;">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5><?php echo isset($sub_title) ? $sub_title : "NO TITLE PROVIDED" ?></h5>
                </div>
                <div class="ibox-content" id="priority_loader">
                    <div class="sk-spinner sk-spinner-wave">
                        <div class="sk-rect1"></div>
                        <div class="sk-rect2"></div>
                        <div class="sk-rect3"></div>
                        <div class="sk-rect4"></div>
                        <div class="sk-rect5"></div>
                    </div>
                    <div class="clearfix"></div>

                    <div class="wrapper wrapper-content animated fadeInRight" id="priority-data-container">

                        <div class="row" id="data-view-feecode">
                            <div class="ibox-content" id="item_list_detail">
                                <div class="row" id="">
                                    <div class="col-lg-12">
                                        <div class="panel panel-info">
                                            <div class="panel-heading">
                                                Available Fee Codes
                                                <a href="javascript:void(0)" onclick="load_staff_priority();" id="close_button" data-toggle="tooltip" title="Back" style="float: right; color: #B22222;"><i class="fa fa-backward"></i></a>
                                            </div>
                                            <div class="panel-body">
                                                <input type="hidden" name="priority_number" id="priority_number" value="<?php echo $priority_number; ?>" />
                                                <input type="hidden" name="priority_id" id="priority_id" value="<?php echo $priority_number_id; ?>" />
                                                <div class="row">
                                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                        <div class="form-group <?php
                                                                                if (form_error('staff_id')) {
                                                                                    echo 'has-error';
                                                                                }
                                                                                ?>">
                                                            <label>Staff Type</label><span class="mandatory"> *</span><br />

                                                            <select name="staff_id" id="staff_id" class="form-control " style="width:100%;">
                                                                <option selected="" value="1">Own Staff</option>
                                                                <option value="2">Other Institution Staff</option>
                                                            </select>
                                                            <?php echo form_error('staff_id', '<div class="form-error">', '</div>'); ?>
                                                        </div>
                                                    </div>
                                                    <div class="clearfix"></div>
                                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                        <div class="table-responsive">
                                                            <table class="table table-hover margin bottom" id="available_fee_code">
                                                                <thead>
                                                                    <tr>
                                                                        <th>Fee Code</th>
                                                                        <th>Description</th>
                                                                        <th>Demand Type</th>
                                                                        <th>Is <?php echo print_tax_vat(); ?></th>
                                                                        <th><?php echo print_tax_vat(); ?> %</th>
                                                                        <th class="text-center">Task</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    <?php
                                                                    if (isset($new_feecode) && !empty($new_feecode)) {
                                                                        foreach ($new_feecode as $feecode) {
                                                                    ?>
                                                                            <tr>
                                                                                <td><?php echo $feecode['feeCode'] ?></td>
                                                                                <td><?php echo $feecode['description'] ?></td>
                                                                                <td><?php echo $feecode['demandType'] == 1 ? 'DEMANDABLE' : 'NON DEMANDABLE' ?></td>
                                                                                <td><?php echo $feecode['is_vat'] == 1 ? 'YES' : 'NO' ?></td>
                                                                                <td><?php echo $feecode['vat'] . " %"; ?></td>
                                                                                <td class="text-center"><a title="Assign Fee Code" href="javascript:void(0);" onclick="add_feecode('<?php echo $feecode['id'] ?>', '<?php echo $feecode['feeCode'] ?>', '<?php echo $feecode['description'] ?>');"><i class="fa fa-paper-plane" style="color: #1f84c6;"></i></a></td>

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
                                        <div class="panel panel-success">
                                            <div class="panel-heading">
                                                FEE CODES ASSIGNED FOR THE STUDENT PRIORITY - <?php echo $priority_number; ?>
                                                <!--<span  class="label label-info pull-right"><a herf="javascript:void(0);" onclick="save_feecode_priority_assignment();"> <i class="fa fa-floppy-o" style=" font-size:19px;"></i></a></span>-->
                                                <span><a href="javascript:void(0);" onclick="save_feecode_priority_assignment();"> <i style="font-size: 20px !important; float: right; color: #23C6C5; padding-right: 10px;" class="material-icons" data-toggle="tooltip" title="Save">save</i></a> </span>
                                            </div>
                                            <div class="panel-body">
                                                <div class="table-responsive">
                                                    <table class="table table-hover margin bottom" id="assigned_feecode">
                                                        <thead>
                                                            <tr>
                                                                <th>Fee Code</th>
                                                                <th>Description</th>
                                                                <th>Allocation Type</th>
                                                                <th>Type</th>
                                                                <th class="text-center">Concession %</th>
                                                                <th>Task</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <?php
                                                            if (isset($existing_feecode) && !empty($existing_feecode)) {
                                                                foreach ($existing_feecode as $feecode_existing) {
                                                            ?>

                                                                    <tr>
                                                                        <td><?php echo $feecode_existing['feeCode'] ?></td>
                                                                        <td><?php echo $feecode_existing['description'] ?></td>

                                                                        <td><?php echo $feecode_existing['staff_type'] == 1 ? 'OWN STAFF' : 'OTHER INSTITUTION STAFF' ?></td>
                                                                        <td><?php echo $feecode_existing['staff_type'] ?></td>
                                                                        <td>
                                                                            <div class="form-group">
                                                                                <div class="form-line">
                                                                                    <input type="text" placeholder="Enter Concession %" id="discount" name="discount" class="form-control discount_data  decimalCheck_perc text-right" onkeypress="return validateFloatKeyPress(this,event);" maxlength="3" value="<?php echo $feecode_existing['discount']; ?>" data-id="<?php echo $feecode_existing['fee_code_id']; ?>" data-feecode="<?php echo $feecode_existing['feeCode'] ?>" data-stafftype="<?php echo $feecode_existing['staff_type'] ?>" />
                                                                                </div>
                                                                            </div>
                                                                        </td>
                                                                        <td>
                                                                            <a title="Remove Feecode" href="javascript:void(0)" onclick="delete_allotted_fee_code(this);"><i class="fa fa-trash" style="font-size:16px;"></i></a>
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

<script type="text/javascript">
    // function allow2decimalOnly(el) {
    //     var val = $(el).val();
    //     var re = /^([0-9]+[\.]?[0-9]?[0-9]?|[0-9]+)$/g;
    //     var re1 = /^([0-9]+[\.]?[0-9]?[0-9]?|[0-9]+)/g;
    //     if (re.test(val)) {
    //         //do something here

    //     } else {
    //         val = re1.exec(val);
    //         if (val) {
    //             el.value = val[0];
    //         } else {
    //             el.value = "";
    //         }
    //     }
    // }
    /*** */
    //onkeypress = "return validateFloatKeyPress(this,event);" //Add to the textbox
    function validateFloatKeyPress(el, evt) {
        var charCode = (evt.which) ? evt.which : event.keyCode;
        var number = el.value.split('.');
        if (charCode != 46 && charCode > 31 && (charCode < 48 || charCode > 57)) {
            return false;
        }
        //just one dot
        if (number.length > 1 && charCode == 46) {
            return false;
        }
        //get the carat position
        var caratPos = getSelectionStart(el);
        var dotPos = el.value.indexOf(".");
        if (caratPos > dotPos && dotPos > -1 && (number[1].length > 1)) {
            return false;
        }
        return true;
    }

    function getSelectionStart(o) {
        if (o.createTextRange) {
            var r = document.selection.createRange().duplicate()
            r.moveEnd('character', o.value.length)
            if (r.text == '') return o.value.length
            return o.value.lastIndexOf(r.text)
        } else return o.selectionStart
    }
    /*** */

    $('#staff_id').select2({
        'theme': 'bootstrap'
    });
    $('#available_fee_code').dataTable({

        columnDefs: [{
                "width": "20%",
                "targets": 0
            },
            {
                "width": "30%",
                "targets": 1
            },
            {
                "width": "15%",
                "targets": 2
            },
            {
                "width": "10%",
                "targets": 3
            },
            {
                "width": "15%",
                "targets": 4
            },
            {
                "width": "10%",
                "targets": 5
            },
        ],
        responsive: false,
        iDisplayLength: 100,
        "ordering": false,
        dom: '<"html5buttons"B>lTfgitp',
        buttons: [],
    });
    $('#assigned_feecode').dataTable({

        columnDefs: [{
                "width": "20%",
                "targets": 0
            },
            {
                "width": "20%",
                "targets": 1
            },
            {
                "width": "20%",
                "targets": 2
            },
            {
                "width": "10%",
                "targets": 2
            },
            {
                "width": "20%",
                "targets": 2
            },
            {
                "width": "10%",
                "targets": 2
            },
        ],
        aoColumns: [
            null,
            null,
            null,
            {
                "bVisible": false
            },
            null,
            null
        ],
        responsive: false,
        iDisplayLength: 100,
        "ordering": false,
        dom: '<"html5buttons"B>lTfgitp',
        buttons: [],
    });


    function add_feecode(id, feecode, desc) {
        var table = $('#assigned_feecode').DataTable();
        var data = table
            .rows()
            .data();
        var staff_type = $('#staff_id').val();

        var flag1 = 0;
        var type;

        for (var i = 0; i < data.length; i++) {
            type = data[i][3];
            console.log(type)
            if (data[i][0] == feecode && type == staff_type) {
                flag1 = 1;
            }
        }


        var staff_title = '';
        if (flag1 == 1) {
            swal('', 'Fee Code already added in list.', 'info');
            return false;
        } else {
            var task = "";
            if (staff_type == 1) {
                staff_title = 'OWN STAFF';
            } else {
                staff_title = 'OTHER INSTITUTION STAFF';
            }
            var newrow = table.row.add([
                feecode,
                desc,
                staff_title,
                staff_type,
                '<div class="form-group"><div class="form-line"> <input type="text" placeholder="Enter Concession %" id="discount" name="discount"class="form-control discount_data  decimalCheck_perc text-right" onkeypress = "return validateFloatKeyPress(this,event);" maxlength="3" value="0" data-id="' + id + '" data-feecode ="' + feecode + '" data-stafftype="' + staff_type + '" />      </div> </div>',
                '<a title="Remove Feecode" href="javascript:void(0)" onclick="delete_allotted_fee_code(this);"><i class="fa fa-trash" style="font-size:16px;"></i></a>'
            ]).draw();

        }
    }

    function save_feecode_priority_assignment() {
        $('#priority_loader').addClass('sk-loading');
        var priority_number = $('#priority_number').val();
        var priority_id = $('#priority_id').val();

        var dTable = $('#assigned_feecode').DataTable();
        var errflag = 0;
        var excflag = 0;
        var fee_code_data = [];

        dTable.$('.discount_data').each(function(i, v) {
            var float = /^\s*(\+|-)?((\d+(\.\d+)?)|(\.\d+))\s*$/;
            var value_for_fee = $(this).val();
            var fee_code_id = $(this).data('id');
            var fee_code = $(this).data('feecode');
            var stafftype = $(this).data('stafftype');
            if (parseFloat(value_for_fee) > 100) {                
                $(this).css('border-color', 'red');
                excflag = 1;
            }
            if (float.test(value_for_fee) && parseFloat(value_for_fee) > 0 && parseFloat(value_for_fee) <= 100) {
                $(this).css('border-color', '#e5e6e7');
                var obj_data = {};
                obj_data['fee_code_id'] = fee_code_id;
                obj_data['discount_percent'] = value_for_fee;
                obj_data['staff_type'] = stafftype;
                fee_code_data.push(obj_data);
            } else {
                $(this).css('border-color', 'red');
                errflag = 1;
            }
        });
        if (excflag == 1) {
            swal('', 'Concession Percentage should not exceed 100', 'error');
            fee_code_data = [];
            $('#priority_loader').removeClass('sk-loading');
            return false;
        }
        if (fee_code_data.length == 0) {
            swal('', 'Select atleast one Fee Code', 'error');
            $('#priority_loader').removeClass('sk-loading');
            return false;
        }

        if (errflag == 1) {
            //swal('', 'Enter valid discount values for fee codes.', 'info');
            swal('', 'Enter Concession % as greater than Zero and less than or equal to 100', 'error');
            fee_code_data = [];
            $('#priority_loader').removeClass('sk-loading');
            return false;
        }
        var ops_url = baseurl + 'fees/save-manage-staff-priority/';
        $.ajax({
            type: "POST",
            cache: false,
            async: false,
            url: ops_url,
            data: {
                "fee_code_data": JSON.stringify(fee_code_data),
                "priority_number": priority_number
            },
            success: function(result) {
                var data = $.parseJSON(result);
                if (data.status == 1) {
                    load_student_priority();
                    //swal('Success', 'Discount on fee code for student priority , ' + priority_number + ' assigned successfully.', 'success');
                    swal('Success', 'Concession for fee code for Priority ' + priority_number + ' updated successfully.', 'success');
                    $('#priority_loader').removeClass('sk-loading');
                    $("html, body").animate({
                        scrollTop: 0
                    }, "slow");
                } else if (data.status == 2) {
                    $('#priority_loader').removeClass('sk-loading');
                    if (data.message) {
                        swal('', data.message, 'info');
                        return false;
                    } else {
                        swal('', 'An error encountered. Please contact administrator for further assistance', 'info');
                        return false
                    }
                } else {
                    swal('', 'Connection Error. Please contact administrator', 'info');
                    return false;
                    $('#priority_loader').removeClass('sk-loading');
                }

            }
        });

    }

    function load_student_priority() {
        var ops_url = baseurl + 'fees/fees-priority/';
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


    function delete_allotted_fee_code(ele) {
        var table = $('#assigned_feecode').DataTable();
        table
            .row($(ele).parents('tr'))
            .remove()
            .draw();
    }
</script>