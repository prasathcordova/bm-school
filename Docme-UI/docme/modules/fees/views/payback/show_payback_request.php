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
                                <div class="row">

                                    <div class="clearfix"></div>
                                    <div class="col-lg-12">
                                        <input type="hidden" name="student_name" id="student_name" value="<?php echo $student_name; ?>" />
                                        <input type="hidden" name="student_id" id="student_id" value="<?php echo $student_id; ?>" />
                                        <div class="panel panel-primary">
                                            <div class="panel-heading">
                                                AVAILABE FEE VOUCHERS
                                                <a href="javascript:void(0)" onclick="load_payback_request();" id="close_button" data-toggle="tooltip" title="Back" style="float: right; color: #B22222; font-size:15px;"><i class="fa fa-backward"></i></a>
                                            </div>

                                            <div class="panel-body">
                                                <div class="table-responsive">

                                                    <table class="table table-hover margin bottom" id="available_fee_vouchers">
                                                        <thead>
                                                            <tr>
                                                                <th>Voucher Date</th>
                                                                <th>Voucher Code</th>
                                                                <th>Voucher Type</th>
                                                                <th>Voucher Amount</th>
                                                                <th class="text-center">Task</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <?php
                                                            if (isset($fee_voucher_data) && !empty($fee_voucher_data)) {
                                                                //dev_export($fee_voucher_data);
                                                                foreach ($fee_voucher_data as $vouchers) {
                                                                    if ($vouchers['voucher_base_code'] == 'FRV' || $vouchers['voucher_base_code'] == 'ADJ') { // Added for filter FRV only => SALAH : OCT 22, 2019
                                                            ?>
                                                                        <tr>
                                                                            <td><?php echo date('d-m-Y', strtotime($vouchers['voucher_date'])); ?></td>
                                                                            <td><?php echo $vouchers['voucher_code'] ?></td>
                                                                            <td><?php echo $vouchers['voucher_name'] ?></td>
                                                                            <td class="text-right"><?php echo my_money_format($vouchers['voucher_amount']); ?>&nbsp;</td>
                                                                            <td class="text-center"><a href="javascript:void(0)" data-toggle="tooltip" title="Select voucher for payback" onclick="select_vouchers('<?php echo $vouchers['id'] ?>', '<?php echo $vouchers['voucher_code'] ?>')"><i class="fa fa-paper-plane"></i></a></td>
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
                                        <div id="fee_voucher_detail">
                                            <!-- <div class="panel panel-info">
                                                <div class="panel-heading">
                                                    FEE DETAILS PAID FOR THE VOUCHER                                                     

                                                </div>
                                                <div class="panel-body">
                                                    <div class="row" >
                                                        <div class="col-md-12 col-lg-12 col-xs-12 col-sm-12">                         
                                                            <b>Reason for payback <span style="color:red;">*</span></b>
                                                            <div class="form-group">
                                                                <div class="form-line <?php
                                                                                        if (form_error('reason')) {
                                                                                            echo 'has-error';
                                                                                        }
                                                                                        ?> ">
                                                                    <input type="text" tabindex="1" class="form-control" name="dummy_reason" id="dummy_reason" placeholder="Reason for Payback" />
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-12">
                                                            <div class="table-responsive">
                                                                <table class="table table-hover margin bottom"  id="available_fee_code_for_payback">
                                                                    <thead>
                                                                        <tr>                        
                                                                            <th>Fee Code</th>
                                                                            <th>Description</th>
                                                                            <th>Paid Amount</th>                                                                                                                                                                                    
                                                                            <th>Payback Approved</th>                                                                                                                                                                         
                                                                            <th>Payback Req. Amt</th>                                                                                                                                                                         
                                                                            <th>Available Amount</th>             
                                                                            <th>Possible Payback Amount</th>             
                                                                            <th>Amount for Current Transaction</th>
                                                                        </tr>
                                                                    </thead>                                                            
                                                                </table>
                                                            </div>                                                        
                                                        </div>
                                                    </div>
                                                </div>
                                            </div> -->
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
    var table1 = $('#available_fee_code_for_payback').dataTable({
        responsive: false,
        iDisplayLength: 10,
        "ordering": false,
        dom: '<"html5buttons"B>lTfgitp',
        buttons: [],
    });

    var table2 = $('#available_fee_vouchers').dataTable({
        responsive: false,
        iDisplayLength: 10,
        "ordering": true,
        dom: '<"html5buttons"B>lTfgitp',
        buttons: [],
    });


    function save_payback_request() {
        $('#faculty_loader').addClass('sk-loading');
        var student_id = $('#student_id').val();
        var master_id = $('#master_id').val();
        var student_name = $('#student_name').val();
        var reason = $('#reason').val();
        var total_payback_amount = 0;

        if (reason.length < 5) {
            swal('', 'Reason is mandatory and must contain atleast five characters', 'info');
            $('#faculty_loader').removeClass('sk-loading');
            return false;
        }

        var alphanumers = /^[a-zA-Z\s0-9]+$/;
        if (!alphanumers.test($("#reason").val())) {
            swal('', 'Reason can have only alphabets or numbers', 'info');
            $('#faculty_loader').removeClass('sk-loading');
            return false;
        }


        var dTable = $('#available_fee_code_for_payback').DataTable();
        var errflag = 0;
        var fee_code_data = [];
        dTable.$('.payback_payable_amount').each(function(i, v) {
            if ($(this).val().length > 0) {
                var float = /^\s*(\+|-)?((\d+(\.\d+)?)|(\.\d+))\s*$/;
                var value_for_fee = $(this).val();
                var fee_detail_id = $(this).data('feedetailid');
                var fee_code_id = $(this).data('feecodeid');
                var maxamount = $(this).data('maxamount');
                if (float.test(value_for_fee) && parseFloat(value_for_fee) > 0 && parseFloat(value_for_fee) <= parseFloat(maxamount)) {
                    $(this).css('border-color', '#e5e6e7');
                    total_payback_amount = total_payback_amount + parseFloat(value_for_fee);
                    var obj_data = {};
                    obj_data['fee_detail_id'] = fee_detail_id;
                    obj_data['fee_code_id'] = fee_code_id;
                    obj_data['value_for_fee'] = value_for_fee;
                    fee_code_data.push(obj_data);
                } else {
                    if ($(this).val() != '0') {
                        $(this).css('border-color', 'red');
                        errflag = 1;
                    }
                }
            }
        });

        if (errflag == 1) {
            //swal('', 'Enter valid values for payback.', 'info');Available Amount
            swal('', 'The amount should be less than or equal to the Possible Payback Amount.', 'info');
            fee_code_data = [];
            $('#faculty_loader').removeClass('sk-loading');
            return false;
        }

        if (fee_code_data.length == 0) {
            // swal('', 'Please add payback amount for atleast one feecode.', 'info');
            swal('', 'Enter Amount for Current Transaction', 'info');
            $('#faculty_loader').removeClass('sk-loading');
            return false;
        }
        //Saving data
        var ops_url = baseurl + 'payback/save-payback-request/';
        $.ajax({
            type: "POST",
            cache: false,
            async: false,
            url: ops_url,
            data: {
                "payback_data": JSON.stringify(fee_code_data),
                "master_id": master_id,
                "student_id": student_id,
                "total_payback_amount": total_payback_amount,
                "reason": reason
            },
            success: function(result) {
                var data = $.parseJSON(result);
                if (data.status == 1) {
                    load_fee_code_allotment();
                    swal('Success', 'Payback request placed successfully for the student, ' + student_name + '.', 'success');
                    $('#faculty_loader').removeClass('sk-loading');
                    load_student_payback();
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

    function select_vouchers(payment_id, voucher_code) {
        var student_id = $('#student_id').val();
        var ops_url = baseurl + 'payback/get-fee-data-for-voucher/';
        $.ajax({
            type: "POST",
            cache: false,
            async: false,
            url: ops_url,
            data: {
                "load": 1,
                "fee_payment_id": payment_id,
                "voucher_code": voucher_code,
                "student_id": student_id
            },
            success: function(result) {
                var data = JSON.parse(result);
                if (data.status == 1) {
                    $('#fee_voucher_detail').html(data.view);
                    $('html, body').animate({
                        scrollTop: $("#fee_voucher_detail").offset().top
                    }, 1500);
                } else {
                    swal('', 'An error encountered while fetching data. Please contact administrator for further assistance.')
                }

            }
        });

    }
</script>