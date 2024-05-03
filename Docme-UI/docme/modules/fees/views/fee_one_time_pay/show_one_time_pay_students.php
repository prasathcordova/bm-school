<div class="wrapper wrapper-content animated fadeInRight" style="padding-top: 1px !important;padding-left: 0px !important;padding-right: 0px !important;">
    <div class="row" style="margin-left: -29px !important; margin-right: -30px !important;">

        <input type="hidden" name="class_id" id="class_id" value="<?php echo $class_id ?>" />
        <input type="hidden" name="batch_id" id="batch_id" value="<?php echo $batch_id ?>" />
        <input type="hidden" name="stream_id" id="stream_id" value="<?php echo $stream_id ?>" />
        <input type="hidden" name="academic_year" id="academic_year" value="<?php echo $academic_year ?>" />
        <input type="hidden" name="sname" id="sname" value="" />
        <input type="hidden" name="batch_name" id="batch_name" value="<?php echo $batch_name ?>" />

        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title" style="border-bottom-color:#ffd300 !important;">

                    <h5><?php echo isset($sub_title) ? $sub_title : "NO TITLE PROVIDED" ?></h5>
                    <div class="ibox-tools">
                        <a href="javascript:void(0)" onclick="refresh_student_data();" id="refresh_data" class="pull-right"> <i class="fa fa-refresh" style="color:#E91E63; font-size:26px;opacity: 10;" data-toggle="tooltip" title="Refresh data"></i></a>
                        <!--<span><a href="javascript:void(0)"  onclick="save_payment_by_wallet()" > <i style="font-size: 26px !important;  float: right; padding-right: 10px;" class="fa fa-save text-info" data-toggle="tooltip" title="Save"></i></a> </span>-->
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

                            <div class="col-lg-12">
                                <div class="table-responsive">
                                    <table class="table table-hover margin bottom" id="available_students">
                                        <thead>
                                            <tr>
                                                <th>Admission No.</th>
                                                <th>Student Name</th>
                                                <!--<th>Total Demanded</th>-->
                                                <th>Wallet Clear Balance</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            if (isset($details_data) && !empty($details_data) && is_array($details_data)) {
                                                //                                                dev_export($details_data);die;
                                                foreach ($details_data as $student) {
                                            ?>
                                                    <tr>
                                                        <td><?php echo $student['Admn_No']; ?></td>
                                                        <td><?php echo $student['student_name']; ?></td>
                                                        <!--<td><?php echo $student['PENDING_PAYMENT'] == 0 ? 0.00 : $student['PENDING_PAYMENT']; ?></td>-->
                                                        <td><?php echo $student['WALLET_BALANCE'] == 0 ? 0.00 : $student['WALLET_BALANCE']; ?></td>
                                                        <td>
                                                            <a class="btn btn-success btn-xs" href="javascript:"><i class="fa fa-file-text"></i> Wallet Statement</a>

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

<script>
    $(document).ready(function() {

        var table2 = $('#available_students').dataTable({
            responsive: false,
            iDisplayLength: 100,
            //            "ordering": false,
            dom: '<"html5buttons"B>lTfgitp',
            buttons: [
                //                {text: 'SELECT ALL',
                //                    action: function (e, dt, node, config) {
                //
                //                        $('.student_selector').iCheck('check');
                //                        $('.student_selector').iCheck('update');
                //
                //                    }},
                //                {text: 'DESELECT ALL',
                //                    action: function (e, dt, node, config) {
                //
                //                        $('.student_selector').iCheck('uncheck');
                //                        $('.student_selector').iCheck('update');
                //
                //                    }},
            ],
            "fnDrawCallback": function(ele) {
                $('.i-checks').iCheck({
                    checkboxClass: 'icheckbox_square-green',
                    radioClass: 'iradio_square-green',
                });
            }

        });
        $('#search_student').hide();

        $('.i-checks').iCheck({
            checkboxClass: 'icheckbox_square-green',
            radioClass: 'iradio_square-green',
        });


    });

    function refresh_student_data() {
        $("#close_button").show();
        var searchname = $('#sname').val();
        var class_id = $('#class_id').val();
        var batch_id = $('#batch_id').val();
        var academic_year = $('#academic_year').val();
        var stream_id = $('#stream_id').val();
        var batch_name = $('#batch_id :selected').text();
        if (class_id == -1) {
            swal('', 'Class is required.', 'info');
            return false;
        }
        var ops_url = baseurl + 'fees/onetimecol/advancesearch-studentname-for-collection';
        $.ajax({
            type: "POST",
            cache: false,
            async: false,
            url: ops_url,
            //            data: {"load": 1, "searchname": searchname},
            data: {
                "load": 1,
                "stream_id": stream_id,
                "batch_id": batch_id,
                "searchname": searchname,
                "class_id": class_id,
                "academic_year": academic_year,
                "batch_name": batch_name
            },
            success: function(result) {
                var data = JSON.parse(result)
                if (data.status == 1) {
                    $('#data-view').html('');
                    $('#data-view').html(data.view);
                    $('html, body').animate({
                        scrollTop: 0
                    }, 1000);

                } else {
                    alert('No data loaded');
                }
            }
        });
    }


    function save_payment_by_wallet(studentid, studentname) {
        var ops_url = baseurl + 'fees/onetimecol/save-payment-by-wallet-for-students';
        $('#pay_loader').addClass('sk-loading');
        var batch_id = $('#batch_id').val();
        var student_data = [];
        var table = $('#available_students').dataTable();
        var amount_flag = 1;
        var error_students = [];
        table.$('input[type=checkbox]').each(function() {
            if (this.checked) {
                var student_id = $(this).data('student_id');
                var pending_amt = $(this).data('pendingpayment');
                var wallet_amt = $(this).data('walletbalance');
                var student_name = $(this).data('studentname');
                var admissionnumber = $(this).data('admissionnumber');

                if (wallet_amt == 0 || pending_amt == 0) {
                    amount_flag = 2;
                    //error_students.push(student_name)
                    error_students.push(admissionnumber)
                } else {
                    student_data.push({
                        student_id: student_id,
                        student_name: student_name,
                        pending_amt: pending_amt,
                        wallet_amt: wallet_amt
                    });
                }
            }
        });

        if (amount_flag == 2) {
            var error_format_students = error_students.join(', ');
            $('#pay_loader').removeClass('sk-loading');
            swal('', 'Please check the following students if wallet balance or pending payment is zero,\n' + error_format_students, 'info');
            return false;
        }

        var formatted_student_data = JSON.stringify(student_data);
        if (formatted_student_data.length == 2 || formatted_student_data.length < 2) {
            swal('', 'Select atleast one student.', 'info');
            $('#pay_loader').removeClass('sk-loading');
            return false;
        }

        $.ajax({
            type: "POST",
            cache: false,
            async: true,
            url: ops_url,
            data: {
                "load": 1,
                "student_data": formatted_student_data,
                "batch_id": batch_id
            },
            success: function(result) {
                $('#pay_loader').removeClass('sk-loading');
                var data = JSON.parse(result);
                if (data.status == 1) {
                    swal('', 'All adjustments completed successfully.', 'success');
                    reload_collection_detail();
                } else {
                    if (data.message) {
                        swal('', data.message, 'info');
                        return false;
                    } else {
                        swal('', 'There was aan error regarding the selected students. Please contact administrator for further assistance', 'info');
                        return false;
                    }
                }

            }
        });
    }

    function reload_collection_detail() {
        var ops_url = baseurl + 'fees/onetimecol/show-fees-student-collection/';
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