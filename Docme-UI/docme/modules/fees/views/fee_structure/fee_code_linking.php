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

                    <input type="hidden" name="template_name" id="template_name" value="<?php echo $template_name; ?>" />
                    <input type="hidden" name="template_id" id="template_id" value="<?php echo $template_id; ?>" />

                    <div class="wrapper wrapper-content animated fadeInRight" id="student-data-container" style="padding-top:0px !important;">

                        <div class="row" id="data-view-feecode">
                            <div class="ibox-content" id="item_list_detail">
                                <div class="row" id="">

                                    <div class="clearfix"></div>
                                    <div class="col-lg-12">

                                        <div class="panel panel-primary">
                                            <div class="panel-heading">
                                                AVAILABE FEE CODES
                                                <a href="javascript:void(0)" class="pull-right" onclick="load_fee_code_allotment();" data-toggle="tooltip" title="Back to Templates"> <i class="fa fa-backward text-default"></i></a>
                                            </div>
                                            <div class="panel-body">
                                                <div class="table-responsive">

                                                    <table class="table table-hover margin bottom" id="available_fee_codes">
                                                        <thead>
                                                            <tr>
                                                                <th>Fee Code</th>
                                                                <th>Description</th>
                                                                <th>Fee Type</th>
                                                                <th>Demand Frequency</th>
                                                                <th><?php echo print_tax_vat(); ?></th>
                                                                <th class="text-center">Task</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <?php
                                                            //dev_export($fee_codes_to_link);
                                                            if (isset($fee_codes_to_link) && !empty($fee_codes_to_link)) {

                                                                foreach ($fee_codes_to_link as $codes) {
                                                                    if ($codes['feeCode'] != 'F002') { // Disallow Bus Fees to linked by Other templates, Only by BUS FEE TEMPLATE
                                                            ?>
                                                                        <tr>
                                                                            <td><?php echo $codes['feeCode'] ?></td>
                                                                            <td><?php echo $codes['description'] ?></td>
                                                                            <td><?php echo $codes['feeTypeName'] ?></td>
                                                                            <td><?php echo ($codes['monthSpan'] == -2 ? 'One Time Fee' : ($codes['monthSpan'] == -3 ? 'CUSTOM TERM' : ($codes['monthSpan'] == 12 ? 'Yearly' : $codes['monthSpan'] . " month/s"))); ?></td>
                                                                            <td><?php echo $codes['vat'] . " %"; ?></td>
                                                                            <td class="text-center">
                                                                                <?php
                                                                                if ($codes['is_recurring'] == 3 && $codes['terms'] == 0) { ?>
                                                                                    <a href="javascript:void(0)" data-toggle="tooltip" title="No terms were added for <?php echo $codes['description'] ?>" onclick="noterms_added();">
                                                                                        <i class="fa fa-paper-plane"></i>
                                                                                    </a>
                                                                                <?php } else { ?>
                                                                                    <a href="javascript:void(0)" data-toggle="tooltip" title="Click to add feecode with code <?php echo $codes['feeCode'] ?> and description <?php echo $codes['description'] ?>" onclick="select_fee_code('<?php echo $codes['feeCode'] ?>', '<?php echo $codes['description'] ?>', '<?php echo $codes['feeTypeName'] ?>', '<?php echo $codes['monthSpan'] ?>', '<?php echo $codes['vat'] . " %"; ?>', '<?php echo $codes['id'] ?>')">
                                                                                        <i class="fa fa-paper-plane"></i>
                                                                                    </a>
                                                                                <?php } ?>
                                                                            </td>
                                                                        </tr>
                                                            <?php
                                                                    }
                                                                }
                                                            }
                                                            ?>

                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="clearfix"></div>
                                    <div class="col-lg-12">

                                        <div class="panel panel-info">
                                            <div class="panel-heading">
                                                FEE ALLOCATION DETAILS (<?php echo print_tax_vat(); ?> will be calculated at the time of collection)
                                                <!-- Added title in below <a> by SALAHUDHEEN May 29, 2019 -->
                                                <span class="label label-info pull-right"><a title="Save" href="javascript:void(0)" onclick="save_fee_codes_to_template()"><i class="fa fa-floppy-o" style="font-size:19px;"></i></a></span>

                                            </div>

                                            <div class="panel-body">
                                                <div class="table-responsive">
                                                    <table class="table table-hover margin bottom" id="allotted_fee_codes">
                                                        <thead>
                                                            <tr>
                                                                <th>Fee Code</th>
                                                                <th>Description</th>
                                                                <th>Type</th>
                                                                <th>Demand Frequency</th>
                                                                <th><?php echo print_tax_vat(); ?></th>
                                                                <!--<th data-toggle="tooltip" title="Is the VAT is included in the fees amount or the VAT is extra.">Is VAT Included</th>-->
                                                                <th class="text-center">Fees Amount(For single installment)</th>
                                                                <th>Task</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <?php
                                                            if (isset($fee_codes_already_linked) && !empty($fee_codes_already_linked)) {
                                                                foreach ($fee_codes_already_linked as $fee_codes) {
                                                            ?>
                                                                    <tr>
                                                                        <td><?php echo $fee_codes['feeCode']; ?></td>
                                                                        <td><?php echo $fee_codes['description']; ?></td>
                                                                        <td><?php echo $fee_codes['feeTypeName']; ?></td>
                                                                        <td><?php echo ($fee_codes['monthSpan'] == -2 ? 'One Time Fee' : ($fee_codes['monthSpan'] == -3 ? 'CUSTOM TERM' : ($fee_codes['monthSpan'] == 12 ? 'Yearly' : $fee_codes['monthSpan'] . " month/s"))); ?></td>
                                                                        <td><?php echo $fee_codes['vat']; ?></td>
                                                                        <td><input type="textbox" onkeypress="return validateFloatKeyPress(this,event);" style="width:100%; text-align:right;" class="form-control fee_codes decimalCheck" maxlength="8" name="fee_codes" id="fcode_<?php echo $fee_codes['feeCode']; ?>" data-feecode="<?php echo $fee_codes['feeCode']; ?>" data-feecodeid="<?php echo $fee_codes['fee_codes_id']; ?>" value="<?php echo round($fee_codes['fee_amount'], 2); ?>" /></td>
                                                                        <!-- Added title in below <a> by SALAHUDHEEN May 29, 2019 -->
                                                                        <td><a title="Remove Fee from Template" href="javascript:void(0)" onclick="delete_allotted_fee_code(this);"><i class="fa fa-trash" style="font-size:16px;"></i></a></td>
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
    $('#freqid').select2({
        'theme': 'bootstrap'
    });
    $('#monthid').select2({
        'theme': 'bootstrap'
    });
    var table1 = $('#linked_fee_codes').dataTable({
        responsive: false,
        iDisplayLength: 10,
        "ordering": false,
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


    function activateicheck() {
        $('.i-checks').iCheck({
            checkboxClass: 'icheckbox_square-green',
            radioClass: 'iradio_square-green'
        });
    }

    function noterms_added() {
        swal('Terms Not Added', 'Please add Term Details for this Fee Code in Terms Settings', 'warning');
        return false;
    }

    function select_fee_code(feecode, desc, fee_type, demand_freq, vat, fee_code_id) {
        var table = $('#allotted_fee_codes').DataTable();
        var data = table
            .rows()
            .data();
        var flag1 = 0;
        for (var i = 0; i < data.length; i++) {
            if (data[i][0] == feecode.trim()) {
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
            } else if (parseInt(demand_freq) == -3) {
                demand_ferq_text = "CUSTOM TERM";
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
                '<input type="text" onkeypress = "return validateFloatKeyPress(this,event);" style="width:100%; text-align:right;" class="form-control fee_codes decimalCheck" maxlength="8" name ="fee_codes" id="fcode_' + feecode + '" data-feecode="' + feecode + '" data-feecodeid="' + fee_code_id + '" />',
                '<a title="Remove Fee from Template" href="javascript:void(0)" onclick="delete_allotted_fee_code(this);"><i class="fa fa-trash" style="font-size:16px;"></i></a>'
            ]).draw();

        }
    }

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

    function delete_allotted_fee_code(ele) {
        swal({
                title: "Remove Fee Code",
                text: "Are you sure to remove the Fee Code from the allocated list?",
                type: "info",
                showCancelButton: true,
                confirmButtonClass: "btn-primary",
                confirmButtonText: "Yes",
                cancelButtonText: "No",
                closeOnConfirm: false,
                closeOnCancel: true
            },
            function(state) {
                if (state) {
                    var table = $('#allotted_fee_codes').DataTable();
                    table
                        .row($(ele).parents('tr'))
                        .remove()
                        .draw();
                    swal('', 'Fee Code Removed', 'success');
                }

            });

    }

    // function delete_allotted_fee_code(ele) {
    //     var table = $('#allotted_fee_codes').DataTable();
    //     table
    //             .row($(ele).parents('tr'))
    //             .remove()
    //             .draw();
    // }


    function save_fee_codes_to_template() {
        $('#faculty_loader').addClass('sk-loading');
        var template_name = $('#template_name').val();
        var template_id = $('#template_id').val();
        var dTable = $('#allotted_fee_codes').DataTable();
        var errflag = 0;
        var fee_code_data = [];
        //
        dTable.$('.fee_codes').each(function(i, v) {
            var float = /^\s*(\+|-)?((\d+(\.\d+)?)|(\.\d+))\s*$/;
            var value_for_fee = $(this).val();
            var fee_code_id = $(this).data('feecodeid');
            var fee_code = $(this).data('feecode');
            //            var vat_include_id = '#' + 'is_vat_incl_check_' + fee_code_id;
            //            var is_vat_include = $(vat_include_id).prop("checked");
            if (float.test(value_for_fee)) {
                $(this).css('border-color', '#e5e6e7');
                var obj_data = {};
                if (value_for_fee >= 1) {
                    obj_data['fee_code_id'] = fee_code_id;
                    obj_data['fee_code'] = fee_code;
                    //                obj_data['is_vat_include'] = is_vat_include;
                    obj_data['value_for_fee'] = value_for_fee;
                    fee_code_data.push(obj_data);
                } else {
                    errflag = 3;
                }

            } else {
                $(this).css('border-color', 'red');
                errflag = 1;
            }
        });

        if (errflag == 1) {
            // swal('', 'Enter valid values for fees.', 'info');
            swal('', 'Enter Fees Amount.', 'info');
            fee_code_data = [];
            $('#faculty_loader').removeClass('sk-loading');
            return false;
        }
        if (errflag == 3) {
            swal('', 'All Fees Amount should be greater than or equal to 1.', 'info');
            $('#faculty_loader').removeClass('sk-loading');
            return false;
        }

        //Saving data
        var ops_url = baseurl + 'fees/save-link-fees-code/';
        $.ajax({
            type: "POST",
            cache: false,
            async: false,
            url: ops_url,
            data: {
                "fee_code_data": JSON.stringify(fee_code_data),
                "template_id": template_id,
                "template_name": template_name
            },
            success: function(result) {
                var data = $.parseJSON(result);
                if (data.status == 1) {
                    load_fee_code_allotment();
                    swal('Success', 'Fee Codes are linked to the template , ' + template_name + ' successfully.', 'success');
                    $('#faculty_loader').removeClass('sk-loading');
                    $("html, body").animate({
                        scrollTop: 0
                    }, "slow");
                } else if (data.status == 2) {
                    $('#faculty_loader').removeClass('sk-loading');
                    swal('', data.message, 'info');
                    $('#faculty_loader').removeClass('sk-loading');
                } else if (data.status == 3) {
                    swal('', data.message, 'info');
                    $('#faculty_loader').removeClass('sk-loading');
                } else {
                    swal('', 'Connection Error. Please contact administrator', 'info');
                    $('#faculty_loader').removeClass('sk-loading');
                }

            }
        });
    }

    function load_fee_code_allotment() {

        var ops_url = baseurl + 'fees/show-template-fees-code-list/';
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