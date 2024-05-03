<div class="wrapper wrapper-content animated fadeInRight" style="padding-top: 1px !important;padding-left: 0px !important;padding-right: 0px !important;">
    <div class="row" style="margin-left: -29px !important; margin-right: -30px !important;">
        <input type="hidden" name="amt_distribute_ops" id="amt_distribute_ops" value="0" />
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title" style="border-bottom-color:#ffd300 !important;">
                    <?php
                    $student_img = base_url('assets/img/a0.jpg');
                    ?>
                    <h5><?php echo isset($sub_title) ? $sub_title : "NO TITLE PROVIDED" ?></h5>
                    <div class="ibox-tools" id="add_type">
                        <a href="javascript:void(0)" onclick="show_approve_request_list();" class="btn btn btn-sm" data-toggle="tooltip" data-placement="top" title="Go to previous page"><i class="fa fa-reply"></i> Back</a>
                        <!-- <a data-toggle="modal" class="btn btn-primary btn-xs" data-toggle="tooltip" title="Save Payback Approval / Rejection" data-placement="left" href="javascript:void(0)" onclick="save_payback_approve();"><i class="fa fa-floppy-o"></i> SAVE </a> -->
                    </div>
                </div>
                <div class="ibox-content" id="pay_loader">
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
                            <div class="col-md-6">
                                <div class="profile-image">
                                    <?php
                                    //dev_export($payback_data);
                                    $profile_image = "";
                                    if (!empty(get_student_image($payback_data['student_id']))) {
                                        $profile_image = get_student_image($payback_data['student_id']);
                                    } else
                                    if (isset($payback_data['profile_image']) && !empty($payback_data['profile_image'])) {

                                        $profile_image = "data:image/jpeg;base64," . $payback_data['profile_image'];
                                    } else {
                                        if (isset($payback_data['profile_image_alternate']) && !empty($payback_data['profile_image_alternate'])) {
                                            $profile_image = $payback_data['profile_image_alternate'];
                                        } else {
                                            $profile_image = base_url('assets/img/a0.jpg');
                                        }
                                    }


                                    ?>
                                    <img src="<?php echo $profile_image; ?>" class="img-circle circle-border m-b-md" alt="profile" style="margin-top: 0px;border-top-width: 0px;" />
                                </div>
                                <div class="profile-info">
                                    <input type="hidden" name="student_id" id="student_id" value="<?php echo $payback_data['student_id']; ?>" />
                                    <input type="hidden" name="student_name" id="student_name" value="<?php echo $payback_data['student_name']; ?>" />
                                    <input type="hidden" name="master_id" id="master_id" value="<?php echo $master_id; ?>" />


                                    <div class="">
                                        <div>
                                            <h4><?php echo $payback_data['student_name']; ?></h4>
                                            <small>
                                                Admission No. : <?php echo $payback_data['Admn_No']; ?>
                                            </small><br>
                                            <small>
                                                Batch : <?php echo $payback_data['Batch_Name']; ?>
                                            </small><br>

                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!--                            <div class="col-md-4" style="padding-top:5px; float: right;">
                                                            <div class="widget lazur-bg no-padding" style="margin-top:0px;">                                   
                                                                <div class="p-m" style="padding:3px !important; display: inline-block">
                                                                    <h1 class="m-xs"style="text-align:center"><span class="fa fa-inr" aria-hidden="true" style="color:#FFF "></span>  <?php echo isset($e_wallet) && !empty($e_wallet) ? my_money_format($e_wallet) : 0; ?></h1>
                            
                                                                    <h3 class="font-bold no-margins" style="text-align:center;padding-top:10px !important; padding-bottom: 10px !important;font-size: 12px;">
                                                                        Docme Wallet
                                                                        <input type="hidden" name="total_e_wallet_amount" id="total_e_wallet_amount" value="<?php echo $e_wallet; ?>" />
                                                                    </h3>                                        
                                                                </div>
                            
                                                            </div>
                                                        </div>-->
                            <div class="clearfix"></div>
                            <div class="col-lg-12 col-md-12 col-xs-12 col-sm-12">
                                <div class="ibox-content" style=" padding-right: 1%;" id="fees_summary">
                                    <div class="row clearfix">
                                        <div class="col-md-6">
                                            <b>Total Payback Amount</b>
                                            <div class="form-group">
                                                <div class="form-line <?php
                                                                        if (form_error('total_amt_payback')) {
                                                                            echo 'has-error';
                                                                        }
                                                                        ?> ">
                                                    <input type="text" maxlength="20" style="background-color: #FFFFFF" readonly="" class="form-control allownumericwithdecimal" name="total_amt_payback" id="total_amt_payback" value="<?php echo set_value('total_amt_payback', isset($payback_data['total_transaction_amount']) ? my_money_format($payback_data['total_transaction_amount']) : '0'); ?>" />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <b>Reason to Payback</b>
                                            <div class="form-group">
                                                <div class="form-line <?php
                                                                        if (form_error('reason')) {
                                                                            echo 'has-error';
                                                                        }
                                                                        ?> ">
                                                    <input type="text" style="background-color: #FFFFFF" readonly="" maxlength="60" class="form-control alpha" name="reason" id="reason" value="<?php echo set_value('reason', isset($payback_data['reason']) ? $payback_data['reason'] : ''); ?>" />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12" style="padding-bottom:10px;padding-top: 10px;">
                                            <div class="radio radio-info radio-inline ">
                                                <input type="radio" id="inlineRadio1" value="Encash" name="radioInline" checked="" class="approve-radio" onchange="setpayment();">
                                                <label for="inlineRadio1"> Approve &amp; Encash</label>
                                            </div>
                                            <!-- <div class="radio radio-warning radio-inline ">
                                                <input type="radio" id="inlineRadio2" value="Approve" name="radioInline" class="approve-radio" onchange="setpayment();">
                                                <label for="inlineRadio2"> Approve &amp; Move to Wallet</label>
                                            </div> -->
                                            <div class="radio radio-danger radio-inline">
                                                <input type="radio" id="inlineRadio3" value="Reject" name="radioInline" class="approve-radio" onchange="setpayment();">
                                                <label for="inlineRadio3"> Reject </label>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <b>Comments</b>&nbsp;<span class="text-danger">*</span>
                                            <div class="form-group">
                                                <input type="text" style="background-color: #FFFFFF" class="form-control text-uppercase alpha" maxlength="60" name="approval_c" id="approval_c" value="" placeholder="Enter Comment" />
                                            </div>
                                        </div>

                                        <div class="clearfix"></div>
                                        <div class="col-lg-12 col-md-12 col-xs-12 col-sm-12 payment_div">
                                            <!-- <p>Amount moved to wallet and return to parent</p> -->
                                            <p>Amount return to parent</p>
                                            <div class="row clearfix">
                                                <div class="col-lg-12" id="pay_panel" style="padding-top: 10px;">
                                                    <div class="panel panel-info">
                                                        <div class="panel-heading">
                                                            <i class="fa fa-info-circle"></i> Transaction Types
                                                        </div>
                                                        <div class="panel-body">
                                                            <div class="panel-group payments-method" id="accordion">
                                                                <div class="panel panel-default">
                                                                    <div class="panel-heading">
                                                                        <div class="pull-right">
                                                                            <i class="fa fa-money text-info"></i>
                                                                        </div>
                                                                        <h5 class="panel-title">
                                                                            <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne">Cash Payment</a>
                                                                        </h5>
                                                                    </div>
                                                                    <div id="collapseOne" class="panel-collapse collapse in">
                                                                        <div class="panel-body">
                                                                            <div class="row">
                                                                                <div class="form-group " style="padding-left: 30px;padding-right: 30px;">
                                                                                    <label>Amount Total</label>
                                                                                    <input type="text" style="background-color: #FFFFFF; text-align:right;" class="form-control" disabled="" name="pay_amount" id="pay_amount" value="<?php echo set_value('total_amt_payback', isset($payback_data['total_transaction_amount']) ? my_money_format($payback_data['total_transaction_amount']) : '0'); ?>">
                                                                                </div>
                                                                                <hr>
                                                                                <a class="btn btn-info" id="cash_pay_btn" style="margin-left:30px;" href="javascript:void(0);" onclick="save_withdraw_cash();">
                                                                                    <i class="fa fa-money">
                                                                                        Make Payment
                                                                                    </i>
                                                                                </a>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="panel panel-default">
                                                                    <div class="panel-heading">
                                                                        <div class="pull-right">
                                                                            <i class="fa fa-money text-sucess"></i>
                                                                        </div>
                                                                        <h5 class="panel-title">
                                                                            <a data-toggle="collapse" data-parent="#accordion" href="#collapse3">Cheque Payment</a>
                                                                        </h5>
                                                                    </div>
                                                                    <div id="collapse3" class="panel-collapse collapse">
                                                                        <div class="panel-body">
                                                                            <div class="row">

                                                                                <div class="col-md-6 col-lg-6">
                                                                                    <div class="form-group">
                                                                                        <label>Cheque Number</label>&nbsp;<span class="text-danger">*</span>
                                                                                        <input type="text" class="form-control" maxlength="10" name="ChequeNumber" id="ChequeNumber" placeholder="Enter Cheque Number">
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-md-6 col-lg-6">
                                                                                    <div class="form-group">
                                                                                        <label>Cheque Date</label>&nbsp;<span class="text-danger">*</span>
                                                                                        <input type="text" class="form-control" name="ChequeDate" readonly="" style="background-color:white;" id="ChequeDate" placeholder="Enter Cheque Date">
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-md-6 col-lg-6">
                                                                                    <div class="form-group">
                                                                                        <label>Name of Receiver</label>&nbsp;<span class="text-danger">*</span>
                                                                                        <input type="text" class="form-control" name="issue_name" maxlength="100" id="issue_name" placeholder="Enter Name of Receiver">
                                                                                    </div>
                                                                                </div>

                                                                                <div class="col-md-6 col-lg-6">
                                                                                    <div class="form-group">
                                                                                        <label>Name of Bank (Of Cheque)</label>&nbsp;<span class="text-danger">*</span>
                                                                                        <div>
                                                                                            <select class="select2_registration form-control" id="NameofBank" name="NameofBank" placeholder="Select a bank" style="width:100%;">
                                                                                                <?php
                                                                                                if (isset($bank_details) && !empty($bank_details)) {
                                                                                                    echo '<option selected value="-1">Select a bank</option>';
                                                                                                    foreach ($bank_details as $bank) {
                                                                                                        echo '<option value="' . $bank['id'] . '">' . $bank['bank_name'] . ' ( ' . $bank['bank_abbr'] . ' )' . '</option>';
                                                                                                    }
                                                                                                }
                                                                                                ?>
                                                                                            </select>
                                                                                        </div>

                                                                                    </div>
                                                                                </div>

                                                                                <div class="clearfix"></div>
                                                                                <div class="col-lg-12 col-md-12">
                                                                                    <div class="form-group ">
                                                                                        <label>Amount Total</label>
                                                                                        <input type="text" style="background-color: #FFFFFF; text-align:right;" class="form-control" disabled="" name="pay_amount1" id="pay_amount1" value="<?php echo set_value('total_amt_payback', isset($payback_data['total_transaction_amount']) ? my_money_format($payback_data['total_transaction_amount']) : '0'); ?>">
                                                                                    </div>
                                                                                </div>
                                                                                <div class="clearfix"></div>

                                                                                <div class="col-xs-12">
                                                                                    <div class="row">
                                                                                        <a class="btn btn-info" id="cheque_pay_btn" style="margin-left:30px;" href="javascript:void(0)" onclick="save_withdraw_cheque();">
                                                                                            <i class="fa fa-money">
                                                                                                Make Payment
                                                                                            </i>
                                                                                        </a>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                                <hr>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="clearfix"></div>
                                        <div class="col-lg-12 col-md-12 col-xs-12 col-sm-12 wallet_div hidden">
                                            <p>Amount moved to wallet and will be used for fee payment or withdraw from wallet later</p>
                                            <a data-toggle="modal" class="btn btn-warning btn-large" data-toggle="tooltip" title="Approve &amp; Move to Wallet" data-placement="left" href="javascript:void(0)" onclick="save_payback_approve();"><i class="fa fa-google-wallet"></i> Approve &amp; Move to Wallet</a>
                                        </div>
                                        <div class="clearfix"></div>
                                        <div class="col-lg-12 col-md-12 col-xs-12 col-sm-12 reject_div hidden">
                                            <p>Request will be cancelled</p>
                                            <a data-toggle="modal" class="btn btn-danger btn-large" data-toggle="tooltip" title="Reject Payback Request" data-placement="left" href="javascript:void(0)" onclick="save_payback_approve();"><i class="fa fa-times"></i> REJECT PAYBACK REQUEST</a>
                                        </div>
                                        <div class="clearfix"></div>
                                        <hr>
                                        <div class="clearfix"></div>
                                        <div class="col-lg-12">
                                            <!--<div class="table-responsive"> dataTables-example" id="table_payback_detail_list-->
                                            <table class="table table-striped table-bordered table-hover">
                                                <thead>
                                                    <tr>
                                                        <th>Fee Code</th>
                                                        <th>Fee Description</th>
                                                        <th>Details</th>
                                                        <th>Amount</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    // dev_export($payback_detail_data);
                                                    if (isset($payback_detail_data) && !empty($payback_detail_data)) {
                                                        foreach ($payback_detail_data as $payback) {
                                                    ?>
                                                            <tr>
                                                                <td><?php echo $payback['FEECODE'] ?></td>
                                                                <td><?php echo $payback['FEE_CODE_DESC'] ?></td>
                                                                <td><?php echo ($payback['is_penalty'] == 1 ? 'Penalty ' : '') . $payback['ACCOUNT_DESC'] ?></td>
                                                                <td align="right"><?php echo my_money_format($payback['transaction_amount']) ?></td>

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
<input type="hidden" name="minimum_wallet_amt" id="minimum_wallet_amt" value="10" />
<div id="student-print-container"></div>
<script type="text/javascript">
    $(".allownumericwithdecimal").on("keypress keyup blur", function(event) {
        $(this).val($(this).val().replace(/[^0-9\.]/g, ''));
        if ((event.which != 46 || $(this).val().indexOf('.') != -1) && (event.which < 48 || event.which > 57)) {
            event.preventDefault();
        }
    });

    $('#NameofBank').select2({
        'theme': 'bootstrap'
    });
    $('#ChequeDate').datepicker({
        format: 'dd/mm/yyyy',
        startDate: '-80d',
        autoclose: true
    });

    function setpayment() {
        var status = $('input[name=radioInline]:checked').val();
        if (status == 'Approve') {
            $('.wallet_div').removeClass('hidden');
            $('.payment_div').addClass('hidden');
            $('.reject_div').addClass('hidden');
        } else if (status == 'Encash') {
            $('.payment_div').removeClass('hidden');
            $('.wallet_div').addClass('hidden');
            $('.reject_div').addClass('hidden');
        } else if (status == 'Reject') {
            $('.reject_div').removeClass('hidden');
            $('.payment_div').addClass('hidden');
            $('.wallet_div').addClass('hidden');
        }
    }
    var table = $('#table_payback_detail_list').dataTable({
        responsive: false,
        stateSave: false,
        "lengthMenu": [
            [10, 100, 250, 500, -1],
            [10, 100, 250, 500, "All"]
        ],
        iDisplayLength: 10,
        "bFilter": true,
        dom: '<"html5buttons"B>lTfgitp',
        buttons: [],

    });

    function save_payback_approve() {
        var status = $('input[name=radioInline]:checked').val();
        var master_id = $('#master_id').val();
        var comments = btoa($('#approval_c').val());
        var student_id = $('#student_id').val();
        var student_name = $('#student_name').val();
        if ($('#approval_c').val().length < 5) {
            swal('', 'Comment is mandatory and require atleast 5 characters. Please fill in comments', 'warning');
            return false;
        } //Reject
        if (status == 'Reject') {
            swal({
                    title: "Payback Request",
                    text: "Are you sure to reject the payback request?",
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
                        payback_approve_reject(status, master_id, comments, student_id, student_name);
                    }
                });
        } else {
            payback_approve_reject(status, master_id, comments, student_id, student_name);
        }
    }

    function payback_approve_reject(status, master_id, comments, student_id, student_name) {
        var ops_url = baseurl + 'payback/save-payback-approval';
        $.ajax({
            type: "POST",
            cache: false,
            async: false,
            url: ops_url,
            data: {
                "student_id": student_id,
                "student_name": student_name,
                "remarks": comments,
                "master_id": master_id,
                "approve_type": status
            },
            success: function(result) {
                var data = JSON.parse(result);
                if (data.status == 1) {
                    if (status == 'Approve') {

                        var wallet_voucher = data.wallet_voucher;
                        var wallet_voucher_id = data.wallet_voucher_id;
                        swal('', 'Request approved for the student ' + student_name + ' and amount transferred to Docme Wallet with voucher number : ' + wallet_voucher + '.', 'success');
                        print_voucher(wallet_voucher_id, wallet_voucher); //PRINT VOUCHER                        
                    } else {
                        swal('', 'Request rejected for the student ' + student_name + '.', 'success');
                    }
                    show_approve_request_list();
                } else if (data.status == 2) {
                    if (data.message) {
                        swal('', data.message, 'info');
                        return false;
                    } else {
                        swal('', 'Please contact administrator for further assistance', 'info');
                        return false;
                    }
                } else {
                    if (data.message) {
                        swal('', data.message, 'info');
                        return false;
                    } else {
                        swal('', 'There was error regarding the selected student. Please contact administrator for further assistance', 'info');
                        return false;
                    }
                }

            }
        });
    }

    function save_withdraw_cash() {

        var status = $('input[name=radioInline]:checked').val();
        var comments = btoa($('#approval_c').val());
        if ($('#approval_c').val().length < 5) {
            swal('', 'Comment is mandatory and require atleast 5 characters. Please fill in comments', 'warning');
            return false;
        }
        var master_id = $('#master_id').val();

        var student_id = $('#student_id').val();
        var student_name = $('#student_name').val();

        var ops_url = baseurl + 'payback/save-payback-approval';
        $.ajax({
            type: "POST",
            cache: false,
            async: false,
            url: ops_url,
            data: {
                "student_id": student_id,
                "student_name": student_name,
                "remarks": comments,
                "master_id": master_id,
                "approve_type": status
            },
            success: function(result) {
                var data = JSON.parse(result);
                if (data.status == 1) {
                    var voucher = data.wallet_voucher;
                    var voucher_id = data.wallet_voucher_id;
                    swal('', 'Encashment of fee payback for the student ' + student_name + ' completed successfully with voucher number : ' + voucher + '.', 'success');
                    print_voucher(voucher_id, voucher, 'fee');
                    show_approve_request_list(); //show_withdraw_request_list();
                } else if (data.status == 2) {
                    if (data.message) {
                        swal('', data.message, 'info');
                        return false;
                    } else {
                        swal('', 'Please contact administrator for further assistance', 'info');
                        return false;
                    }
                } else {
                    if (data.message) {
                        swal('', data.message, 'info');
                        return false;
                    } else {
                        swal('', 'There was error regarding the selected student. Please contact administrator for further assistance', 'info');
                        return false;
                    }
                }

            }
        });
    }

    function save_withdraw_cheque() {

        var status = $('input[name=radioInline]:checked').val();
        var comments = btoa($('#approval_c').val());
        if ($('#approval_c').val().length < 5) {
            swal('', 'Comment is mandatory and require atleast 5 characters. Please fill in comments', 'warning');
            return false;
        }
        var master_id = $('#master_id').val();
        var student_id = $('#student_id').val();
        var student_name = $('#student_name').val();

        var regx = /^[A-Za-z0-9 _.-]+$/;
        if (!(regx.test($('#ChequeNumber').val()) && $('#ChequeNumber').val().length <= 10 && $('#ChequeNumber').val().length > 4)) {
            swal('', 'Enter valid cheque number for payment', 'info');
            return false;
        }
        var cheque_number = $('#ChequeNumber').val();

        if (moment($('#ChequeDate').val(), 'DD-MM-YYYY').isValid() == false) {
            swal('', 'Cheque date is required for cheque payment', 'info');
            return false
        }
        var cheque_date = moment($('#ChequeDate').val(), 'DD-MM-YYYY').format('YYYY-MM-DD');

        var regx_alpha = /^[A-Za-z _.-]+$/;
        if (!(regx_alpha.test($('#issue_name').val()) && $('#issue_name').val().length <= 100 && $('#issue_name').val().length > 4)) {
            swal('', 'Enter valid Name of Receiver', 'info');
            return false;
        }
        var issued_name = $('#issue_name').val();


        if ($('#NameofBank').val() == -1) {
            swal('', 'Enter valid Name of Bank', 'info');
            return false;
        }
        var bank_id = $('#NameofBank').val();

        var ops_url = baseurl + 'payback/save-payback-approval';
        $.ajax({
            type: "POST",
            cache: false,
            async: false,
            url: ops_url,
            data: {
                "student_id": student_id,
                "student_name": student_name,
                "remarks": comments,
                "master_id": master_id,
                "approve_type": status,
                "is_cheque": 1,
                "cheque_number": cheque_number,
                "cheque_date": cheque_date,
                "issued_name": issued_name,
                "bank_id": bank_id
            },
            success: function(result) {
                var data = JSON.parse(result);
                if (data.status == 1) {
                    var voucher = data.wallet_voucher;
                    var voucher_id = data.wallet_voucher_id;
                    swal('', 'Encashment of fee payback for the student ' + student_name + ' completed successfully with voucher number : ' + voucher + '.', 'success');
                    print_voucher(voucher_id, voucher, 'fee');
                    show_approve_request_list(); //show_withdraw_request_list();
                } else if (data.status == 2) {
                    if (data.message) {
                        swal('', data.message, 'info');
                        return false;
                    } else {
                        swal('', 'Please contact administrator for further assistance', 'info');
                        return false;
                    }
                } else {
                    if (data.message) {
                        swal('', data.message, 'info');
                        return false;
                    } else {
                        swal('', 'There was error regarding the selected student. Please contact administrator for further assistance', 'info');
                        return false;
                    }
                }

            }
        });
    }

    function show_approve_request_list() {

        var ops_url = baseurl + 'payback/show-payback-list';
        $.ajax({
            type: "POST",
            cache: false,
            async: false,
            url: ops_url,
            data: {
                "load": 1
            },
            success: function(result) {

                $('#data-view').html('');
                $('#data-view').html(result);
                $('html, body').animate({
                    scrollTop: 0
                }, 1000);


            }
        });
    }

    function print_voucher(voucher_id, voucher_code) {
        var student_id = $('#student_id').val();
        var student_name = $('#student_name').val();
        var ops_url = baseurl + 'fees/print_voucher_reprint/';

        $.ajax({
            type: "POST",
            cache: false,
            async: false,
            url: ops_url,
            data: {
                "load": 1,
                "voucher_id": voucher_id,
                "voucher_code": voucher_code,
                "student_name": student_name,
                "student_id": student_id,
                "issue": "print"
            }, //, "ptype" : ptype
            success: function(result) {
                $('#voucher_data_loader').removeClass('sk-loading');
                var data = JSON.parse(result)
                if (data.status == 1) {
                    $('#student-print-container').html('');
                    $('#student-print-container').html(data.view);
                } else {
                    alert('No data loaded');
                }

                //select_items(voucher_id,voucher_code);
            }
        });

    }
</script>