<div class="ibox-title" style="border-bottom-color:#ffd300 !important;">
    <h5><i class="fa fa-file-text-o" style="padding-right:10px;"></i>EXEMPTION DETAILS</h5>
    <div class="ibox-tools" id="add_type">
    </div>
</div>
<div class="ibox-content" id="reconcile_loader">
    <?php //dev_export(explode('*', $studdata));
    $studdetails = explode('*', $studdata);
    if ($details_data) $remarks = $details_data[0]['exmp_remarks'];
    else $remarks = 'No Comments';
    ?>
    <table class="table table-bordered margin bottom" id="available_cheque_for_reconcile">
        <thead>
            <tr>
                <th>Student Name</th>
                <th>Admission No.</th>
                <th>Request Date</th>
                <th style="text-align:right;">Requested Amount</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td><?php echo $studdetails[0]; ?></td>
                <td><?php echo $studdetails[1]; ?></td>
                <td><?php echo $studdetails[2]; ?></td>
                <th style="text-align:right;"><?php echo my_money_format($studdetails[3]); ?></td>
                <td><?php echo $studdetails[4]; ?></td>
            </tr>
            <tr>
                <td colspan="5"><?php echo $remarks; ?></td>
            </tr>
        </tbody>
    </table>
    <input type="hidden" id="student_name" value="<?php echo $studdetails[0]; ?>">
    <table class="table table-striped table-bordered">
        <thead>
            <tr>
                <th width="26%">Fee Code</th>
                <th width="20%" class="text-center">Month</th>
                <th width="20%" class="text-center">Approved Date</th>
                <!-- <th width="10%" class="text-center">Status</th> -->
                <th width="17%" class="text-center">Requested Amount</th>
                <th width="17%" class="text-center">Approved Amount</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $i = 0;
            $total_amt_exempt = 0;
            $total_amt_approved = 0;
            $flag = 0;
            if ($details_data) {
                // dev_export($details_data);
                foreach ($details_data as $details) {
            ?>
                    <tr id="stud_row_<?php echo $i; ?>">
                        <!-- <input type="hidden" id="exmp_id_<?php echo $i; ?>" value="<?php echo $details['exmp_id']; ?>">
                        <input type="hidden" id="feecode_id_<?php echo $i; ?>" value="<?php echo $details['feecode_id']; ?>">
                        <input type="hidden" id="student_id_<?php echo $i; ?>" value="<?php echo $details['student_id']; ?>">
                        <input type="hidden" id="account_id_<?php echo $i; ?>" value="<?php echo $details['account_id']; ?>">
                        <input type="hidden" id="transaction_details_id_<?php echo $i; ?>" value="<?php echo $details['transaction_details_id']; ?>">
                        <input type="hidden" id="amount_applied_<?php echo $i; ?>" value="<?php echo $details['amount_applied']; ?>"> -->
                        <td style="vertical-align:middle;"><?php echo $details['fee_head']; ?></td>
                        <td class="text-center" style="vertical-align:middle"><?php echo date('M Y', strtotime($details['demanded_date'])); ?></td>
                        <td class="text-center" style="vertical-align:middle;">
                            <!-- ExApp_RIMS_dt -->
                            <?php echo (isset($details['app_reject_date']) ? date('d-m-Y', strtotime($details['app_reject_date'])) : 'PENDING'); ?></td>
                        <td class="text-right " style="vertical-align:middle;"><?php echo my_money_format($details['amount_applied']); ?></td>
                        <td class="text-right"><?php echo my_money_format($details['amount_approved']); ?></td>
                    </tr>
                <?php
                    $total_amt_exempt += $details['amount_applied'];
                    $total_amt_approved += $details['amount_approved'];
                    $i++;
                } ?>
                <input type="hidden" id="master_id" value="<?php echo $master_id; ?>">
                <input type="hidden" id="student_id" value="<?php echo $student_id; ?>">
            <?php
            }
            ?>

            <input type="hidden" value="<?php echo $i ?>" id="iter_count">
            <tr>
                <th class="text-right" style="vertical-align:middle;" colspan="3">Total Amount</th>
                <th class="text-right" style="vertical-align:middle;"><?php echo print_currency(); ?> <?php echo my_money_format($total_amt_exempt); ?></th>
                <td class="text-right" style="vertical-align:middle;">
                    <!-- <input type="text" class="form-control allownumericwithdecimal" readonly name="tot_exp_amount" id="tot_exp_amount" value="<?php echo $total_amt_exempt; ?>"> -->
                    <?php echo my_money_format($total_amt_approved); ?>
                </td>
            </tr>
            <?php if ($status == 'PENDING') { ?>
                <!-- <tr>
                    <td class="text-right" colspan="4">
                        <input type="text" class="form-control" name="md_comment" id="md_comment" value="" placeholder="Enter Remarks">
                    </td>
                    <td class="text-right" colspan="2">
                        <a data-toggle="tooltip" title="Approve Exemption Request" href="javascript:void(0)" onclick="approve_request(<?php echo $master_id ?>,<?php echo $student_id ?>);" class="btn btn-success btn-md" style="color: #fff;">
                            <i class="fa fa-check"></i> Approve
                        </a>
                        <a data-toggle="tooltip" title="Reject Exemption Request" href="javascript:void(0)" onclick="reject_request(<?php echo $master_id ?>,<?php echo $student_id ?>);" class="btn btn-danger btn-md" style="color: #fff;">
                            <i class="fa fa-times"></i> Reject
                        </a>
                    </td>
                </tr> -->
            <?php } ?>
        </tbody>
    </table>

</div>


<script type="text/javascript">
    $(".allownumericwithdecimal").on("keypress keyup blur", function(event) {
        $(this).val($(this).val().replace(/[^0-9\.]/g, ''));
        if ((event.which != 46 || $(this).val().indexOf('.') != -1) && (event.which < 48 || event.which > 57)) {
            event.preventDefault();
        }
    });
    $('.exp_amount').on("blur", function(event) {
        var feeamount = $(this).attr('feeamount');
        //alert(feeamount);
        if ($(this).val() > feeamount) {
            $(this).val(feeamount);
        }
        var ttotal = 0; //$('#tot_exp_amount').val();
        var tamt = 0;
        $('.exp_amount').each(function() {
            tamt = (tamt * 1) + ($(this).val() * 1);
        });
        $('#tot_exp_amount').val(tamt);
    });

    function reject_request(id, student_id) {
        var md_comment = $('#md_comment').val();
        var master_id = $('#master_id').val();

        if (md_comment.length == 0) {
            $('#md_comment').focus();
            $('#pay_loader').removeClass('sk-loading');
            swal('Remarks Needed', '', 'warning');
            return false;
        }

        var status = 0;
        var data;
        var ops_url = baseurl + 'fees/reject_exemption';
        $.ajax({
            type: "POST",
            cache: false,
            async: false,
            url: ops_url,
            data: {
                "load": 1,
                "master_id": master_id,
                "remarks": md_comment,
                "studentid": student_id
            },
            success: function(result) {
                data = JSON.parse(result)
                if (data.status == 1) {
                    swal("Exemption Rejected Successfully", "", "success");
                    //view_data(id, student_id, 'REJECTED'); //view_data(id);
                    load_excemptions_approvals();
                    return false;
                } else {
                    swal("Exemption Rejection Failed", "", "info");
                    return false;
                }
            }
        });
    }

    function approve_request(id, student_id) {
        var j = 0;
        var limit = $('#iter_count').val();
        var md_comment = $('#md_comment').val();
        var master_id = $('#master_id').val();

        if (md_comment.length == 0) {
            $('#md_comment').focus();
            $('#pay_loader').removeClass('sk-loading');
            swal('Remarks Needed', '', 'warning');
            return false;
        }

        var pay_data = [];

        for (j = 0; j < limit; j++) {
            //idname = "#stud_row_" + j + "";
            pay_data.push({
                exmp_id: $('#exmp_id_' + j).val(),
                feecode_id: $('#feecode_id_' + j).val(),
                student_id: $('#student_id_' + j).val(),
                account_id: $('#account_id_' + j).val(),
                transaction_details_id: $('#transaction_details_id_' + j).val(),
                amount_applied: $('#amount_applied_' + j).val(),
                amount_approved: $('#exp_amount_' + j).val()
            });


        }
        //alert(JSON.stringify(pay_data));
        //alert(limit);
        var status = 0;
        var data;
        var ops_url = baseurl + 'fees/approve_exemption';
        $.ajax({
            type: "POST",
            cache: false,
            async: false,
            url: ops_url,
            data: {
                "load": 1,
                "master_id": master_id,
                "student_id": student_id,
                "pay_data": JSON.stringify(pay_data),
                "md_comment": md_comment,
                "approve": 1
            },
            success: function(result) {
                data = JSON.parse(result)
                if (data.status == 1) {
                    var voucher = data.voucher_no;
                    var voucher_id = data.voucher_id;
                    swal("", "Exemption Approval Success with voucher number : " + voucher + ".", "success");
                    print_voucher(voucher_id, voucher, student_id, ''); //PRINT VOUCHER
                    //view_data(id, student_id, 'APPROVED'); //view_data(id);
                    load_excemptions_approvals();
                    return false;
                } else {
                    swal("Exemption Approval Failed", "", "info");
                    return false;
                }
            }
        });
    }

    function print_voucher(voucher_id, voucher_code, student_id, ptype) {
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
                "issue": "print",
                "ptype": ptype
            },
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

    // function approve_requesta(id, studentid) {
    //     swal({
    //             title: "Exemption Approval",
    //             text: "",
    //             type: "info",
    //             showCancelButton: true,
    //             confirmButtonClass: "btn-primary",
    //             confirmButtonText: "Approve",
    //             cancelButtonText: "Reject",
    //             closeOnConfirm: false,
    //             closeOnCancel: false
    //         },
    //         function(state) {
    //             if (state) {
    //                 var recon_state = approve_exemption(id, studentid); //1;//
    //                 if (recon_state.status == 1) {
    //                     swal("Exemption Approval Success", "", "success");
    //                     view_data(id);
    //                     return false;
    //                 } else {
    //                     swal("Exemption Approval Failed", "", "info"); //+ recon_state.message
    //                     return false;
    //                 }

    //             } else {

    //                 swal({
    //                         title: "Exemption Rejected",
    //                         text: "Are you sure you want to reject the request?.",
    //                         type: "info",
    //                         showCancelButton: true,
    //                         confirmButtonClass: "btn-primary",
    //                         confirmButtonText: "Yes",
    //                         cancelButtonText: "Cancel",
    //                         closeOnConfirm: false,
    //                         closeOnCancel: true,
    //                         type: "input",
    //                         inputPlaceholder: "Should Enter Reject Reason"
    //                     },
    //                     function(isConfirm) {
    //                         if (isConfirm) {
    //                             if (isConfirm.length > 2) {
    //                                 var recon_state = reject_exemption(id, isConfirm, studentid); //
    //                                 if (recon_state.status == 1) {
    //                                     swal("Exemption Request Rejected.", "", "success");
    //                                     view_data(id);
    //                                     return false;
    //                                 } else {
    //                                     swal("Exemption Request not Rejected.", "", "info");
    //                                     return false;
    //                                 }
    //                             } else {
    //                                 alert("Remarks should contain more than 2 characters", "info"); // Changed By Salahudheen May 29, 2019
    //                             }
    //                         }

    //                     });
    //             }

    //         });
    // }

    // function approve_exemption(master_id, studentid) {
    //     var status = 0;
    //     var data;
    //     var ops_url = baseurl + 'fees/approve_exemption';
    //     $.ajax({
    //         type: "POST",
    //         cache: false,
    //         async: false,
    //         url: ops_url,
    //         data: {
    //             "load": 1,
    //             "master_id": master_id,
    //             "studentid": studentid
    //         },
    //         success: function(result) {
    //             data = JSON.parse(result)
    //             if (data.status == 1) {
    //                 status = 1;
    //             } else {
    //                 status = 0;
    //             }
    //         }
    //     });
    //     if (status == 1) {
    //         return data
    //     } else {
    //         return false;
    //     }
    // }

    // function reject_exemption(master_id, remarks, studentid) {
    //     var status = 0;
    //     var data;
    //     var ops_url = baseurl + 'fees/reject_exemption';
    //     $.ajax({
    //         type: "POST",
    //         cache: false,
    //         async: false,
    //         url: ops_url,
    //         data: {
    //             "load": 1,
    //             "master_id": master_id,
    //             "remarks": remarks,
    //             "studentid": studentid
    //         },
    //         success: function(result) {
    //             data = JSON.parse(result)
    //             if (data.status == 1) {
    //                 status = 1;
    //             } else {
    //                 status = 0;
    //             }
    //         }
    //     });
    //     if (status == 1) {
    //         return data
    //     } else {
    //         return false;
    //     }
    // }

    // function re_print_voucher(voucher_id, voucher_code) {
    //     var student_id = $('#student_id').val();
    //     var student_name = $('#student_name').val();
    //     var ops_url = baseurl + 'fees/print_voucher_reprint/';
    //     $.ajax({
    //         type: "POST",
    //         cache: false,
    //         async: false,
    //         url: ops_url,
    //         data: {
    //             "load": 1,
    //             "voucher_id": voucher_id,
    //             "voucher_code": voucher_code,
    //             "student_name": student_name,
    //             "student_id": student_id,
    //             "issue": "reprint"
    //         },
    //         success: function(result) {
    //             $('#voucher_data_loader').removeClass('sk-loading');
    //             var data = JSON.parse(result)
    //             if (data.status == 1) {
    //                 $('.printing-area').html('');
    //                 $('.printing-area').html(data.view);
    //             } else {
    //                 alert('No data loaded');
    //             }
    //             //success: function (data) {
    //             //window.open(result, '_blank');
    //             //$('#report_param_loader').removeClass('sk-loading');
    //             //}
    //             select_items(voucher_id, voucher_code);
    //         }
    //     });

    // }

    // function cancellation_detail(studentid, studentname) {
    //     var ops_url = baseurl + 'fees/show-fee-voucher-cancel';
    //     $.ajax({
    //         type: "POST",
    //         cache: false,
    //         async: false,
    //         url: ops_url,
    //         data: {
    //             "load": 1,
    //             "student_id": studentid,
    //             "student_name": studentname
    //         },
    //         success: function(result) {
    //             var data = JSON.parse(result);
    //             if (data.status == 1) {
    //                 $('#data-view').html('');
    //                 $('#data-view').html(data.view);
    //                 $('html, body').animate({
    //                     scrollTop: 0
    //                 }, 1000);
    //             } else {
    //                 if (data.message) {
    //                     swal('', data.message, 'info');
    //                     return false;
    //                 } else {
    //                     swal('', 'There was no data regarding the selected students. Please contact administrator for further assistance', 'info');
    //                     return false;
    //                 }
    //             }

    //         }
    //     });
    // }
</script>