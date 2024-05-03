<?php
$profile_image = "";
if (!empty(get_student_image($student_id))) {
    $profile_image = get_student_image($student_id);
} else
if (isset($student['profile_image']) && !empty($student['profile_image'])) {

    $profile_image = "data:image/png;base64," . $student['profile_image'];
} else {
    if (isset($student['profile_image_alternate']) && !empty($student['profile_image_alternate'])) {
        $profile_image = $student['profile_image_alternate'];
    } else {
        $profile_image = base_url('assets/img/a0.jpg');
    }
}
?>


<div class="ibox">

    <div class="ibox-title" style="border-bottom-color:#ffd300 !important;">
        <h5><i class="fa fa-print" style="padding-right:10px;"></i><?php echo isset($sub_title) ? $sub_title : "Voucher REPRINT" ?></h5>
        <div class="ibox-tools" id="add_type">
            <a href="javascript:void(0)" onclick="load_voucher_reprint();" id="close_button" data-toggle="tooltip" title="Back to Filter" style="float: right; color: #B22222;"><i class="fa fa-backward"></i></a>
        </div>
    </div>
    <div class="ibox-content" id="voucher_data_loader">
        <div class="sk-spinner sk-spinner-wave">
            <div class="sk-rect1"></div>
            <div class="sk-rect2"></div>
            <div class="sk-rect3"></div>
            <div class="sk-rect4"></div>
            <div class="sk-rect5"></div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-info">
                    <div class="panel-heading"> <!--circle-border m-b-md-->
                        <img src="<?php echo $profile_image; ?>" class="img-circle" alt="profile" style="width: 50px;height: 50px;">
                        <?php echo $student['student_name'] ?>
                        <?php if (isset($student['voucher_type']) && $student['voucher_type'] == 'APR') { ?>
                            <small style="float: right;">
                                <br>Student No : <?php echo $student['Admn_No'] ?>
                            </small>
                        <?php } else if (isset($student['voucher_type']) && $student['voucher_type'] == 'REGFEE') { ?>
                            <small style="float: right;">
                                <br>Student No : <?php echo $student['Admn_No'] ?>
                            </small>
                        <?php } else { ?>
                            <small style="float: right;">
                                <?php echo $student['Batch_Name'] ?>
                                <br> Status : <?php echo $student['stud_status'] ?>
                                <br> Admission No. : <?php echo $student['Admn_No'] ?></small>
                        <?php } ?>
                        <input type="hidden" id="student_id" name="student_id" value="<?php echo $student_id; ?>" />
                        <input type="hidden" id="student_name" name="student_name" value="<?php echo $student_name; ?>" />
                    </div>
                    <div class="panel-body">

                        <div class="">
                            <!-- row-new -->
                            <div class="row" id="item-data-container">
                                <!-- <h4>Search Results</h4>
                                <hr style="border-bottom:10px solid #333;"> -->
                                <?php
                                // dev_export($voucher_data);
                                //echo $voucher_id_from_search;
                                $vouchersearch = array();
                                $i = 0;
                                $ffflag = 0;
                                if (isset($voucher_data) && !empty($voucher_data) && is_array($voucher_data)) {
                                    if (isset($voucher_id_from_search)) {
                                        foreach ($voucher_data as $vv) {
                                            if ($voucher_id_from_search == $vv['id']) {
                                                $ffflag = 1;
                                                //$vouchersearch['selected'] = $vv;
                                                //$vouchercode = (isset($vv['cheque_reconciled_voucher']) ? $vv['cheque_reconciled_voucher'] : $vv['voucher_code']);
                                                $vouchercode = $vv['voucher_code'];
                                                $vdisplay = 1;

                                                if ($vv['is_cheque'] == 1) {
                                                    // echo "asdg";
                                                    $vdisplay = 1;
                                                    if ($vv['is_chq_recon'] == 1 && $vv['chq_recon_status'] == 0) {
                                                        $vdisplay = 0;
                                                        $errflag = 0;
                                                    } else {
                                                        $vdisplay = 1;
                                                    }
                                                }
                                                if ($vdisplay == 1) {
                                ?>
                                                    <div class="col-lg-6">
                                                        <div class="ibox float-e-margins">
                                                            <div class="ibox-title" style="padding: 5PX 15PX 2px 15px;min-height: 35px;">
                                                                <?php echo $vouchercode;
                                                                if ($vv['paytype'] == 'REGFEE') {
                                                                    $ptype = 'REGFEE';
                                                                } else {
                                                                    $ptype = substr($vouchercode, 0, 3);
                                                                }
                                                                ?>
                                                                <a href="javascript:void(0)" onclick="select_items('<?php echo $vv['id']; ?>', '<?php echo $vv['voucher_code']; ?>','<?php echo $ptype; ?>');">
                                                                    <span class="btn btn-xs btn-info pull-right">Show Voucher</span>
                                                                </a>
                                                            </div>
                                                            <div class="ibox-title" style="padding: 5PX 15PX 2px 15px;min-height: 65px;">
                                                                Transaction Type : <?php
                                                                                    if ($vv['is_cash'] == 1) {
                                                                                        echo 'Cash Transaction';
                                                                                    } else if ($vv['is_cheque'] == 1) {
                                                                                        echo 'Cheque Transaction';
                                                                                    } else if ($vv['is_card'] == 1) {
                                                                                        echo 'Card Transaction';
                                                                                    } else if ($vv['is_online'] == 1) {
                                                                                        echo 'Online Transaction';
                                                                                    } else if ($vv['is_wallet'] == 1) {
                                                                                        echo 'Wallet Transaction';
                                                                                    } else if ($vv['is_withdraw'] == 1 && $vv['is_payback'] == 1) {
                                                                                        echo 'Fee Payback';
                                                                                    } else if ($vv['is_withdraw'] == 1) {
                                                                                        echo 'Wallet Withdrawal';
                                                                                    } else if ($vv['is_dbt'] == 1) {
                                                                                        echo 'Direct Bank transfer';
                                                                                    } else {
                                                                                        echo 'Concession / Exemption';
                                                                                    }
                                                                                    ?>
                                                                <br />
                                                                <?php
                                                                if ($vv['is_cheque'] == 1) {
                                                                    echo 'Cheque Status : ' . ($vv['is_chq_recon'] == 1 ? 'Cheque Reconciled' : 'Pending Reconciliation');
                                                                    // echo '<br/>';
                                                                    // if ($vv['is_chq_recon'] == 1) {
                                                                    //     echo 'Recon Status : ' . ($vv['chq_recon_status'] == 1 ? 'Cheque Realized' : 'Cheque Bounced');
                                                                    // }
                                                                }
                                                                $servicecharge = ($vv['is_wallet_payment_only'] == 1 ? $vv['service_charge'] : 0);
                                                                ?>
                                                            </div>

                                                            <div class="ibox-content" style=" padding: 10px 15px 25px 15px;">
                                                                <span class="label label-warning pull-left" style="font-size: 14px;"><?php echo print_currency('#fff', '13'); ?> <?php echo my_money_format($vv['voucher_amount'] + $servicecharge); ?></span>
                                                                <div class="stat-percent font-bold text-info" data-toggle="tooltip" title="Voucher Type"><i class="fa fa-stack-overflow" aria-hidden="true" style="padding:0 5px 0 0;"></i><?php echo ($vv['is_payback'] == 1 ? 'FEE PAYBACK' : ($vv['is_wallet_payment_only'] == 1 ? 'WALLET PAYMENT' : 'FEE PAYMENT')); ?></div>

                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="clearfix"></div>
                                                    <!-- <hr style="border-bottom:1px solid #b1b0b0;"> -->
                                                <?php
                                                }
                                            }
                                        }
                                    }
                                    $voucher_display = 1;
                                    if ($ffflag == 0) {


                                        foreach ($voucher_data as $voucher) {
                                            if ($voucher_id_from_search != $voucher['id']) {
                                                $vouchercode = $voucher['voucher_code'];
                                                //if ($voucher_type == substr($voucher['voucher_code'], 0, 3)) {
                                                $vdisplay = 1;

                                                if ($voucher['is_cheque'] == 1) {
                                                    // echo "asdg";
                                                    $vdisplay = 1;
                                                    if ($voucher['is_chq_recon'] == 1 && $voucher['chq_recon_status'] == 0) {
                                                        $vdisplay = 0;
                                                        $errflag = 0;
                                                    } else {
                                                        $vdisplay = 1;
                                                    }
                                                }
                                                if ($vdisplay == 1) {
                                                ?>
                                                    <div class="col-lg-6">
                                                        <div class="ibox float-e-margins">
                                                            <div class="ibox-title" style="padding: 5PX 15PX 2px 15px;min-height: 35px;">
                                                                <?php echo $vouchercode;
                                                                if ($voucher['paytype'] == 'REGFEE') {
                                                                    $ptype = 'REGFEE';
                                                                } else {
                                                                    $ptype = substr($vouchercode, 0, 3);
                                                                }
                                                                ?>
                                                                <a href="javascript:void(0)" onclick="select_items('<?php echo $voucher['id']; ?>', '<?php echo $voucher['voucher_code']; ?>','<?php echo $ptype; ?>');">
                                                                    <span class="btn btn-xs btn-info pull-right">Show Voucher</span>
                                                                </a>
                                                            </div>
                                                            <div class="ibox-title" style="padding: 5PX 15PX 2px 15px;min-height: 65px;">
                                                                Transaction Type : <?php
                                                                                    if ($voucher['is_cash'] == 1) {
                                                                                        echo 'Cash Transaction';
                                                                                    } else if ($voucher['is_cheque'] == 1) {
                                                                                        echo 'Cheque Transaction';
                                                                                    } else if ($voucher['is_card'] == 1) {
                                                                                        echo 'Card Transaction';
                                                                                    } else if ($voucher['is_online'] == 1) {
                                                                                        echo 'Online Transaction';
                                                                                    } else if ($voucher['is_wallet'] == 1) {
                                                                                        echo 'Wallet Transaction';
                                                                                    } else if ($voucher['is_withdraw'] == 1 && $voucher['is_payback'] == 1) {
                                                                                        echo 'Fee Payback';
                                                                                    } else if ($voucher['is_withdraw'] == 1) {
                                                                                        echo 'Wallet Withdrawal';
                                                                                    } else if ($voucher['is_dbt'] == 1) {
                                                                                        echo 'Direct Bank transfer';
                                                                                    } else {
                                                                                        echo 'Concession / Exemption';
                                                                                    }
                                                                                    ?>
                                                                <br />
                                                                <?php
                                                                if ($voucher['is_cheque'] == 1) {
                                                                    echo 'Cheque Status : ' . ($voucher['is_chq_recon'] == 1 ? 'Cheque Reconciled' : 'Pending Reconciliation');
                                                                    // echo '<br/>';
                                                                    // if ($voucher['is_chq_recon'] == 1) {
                                                                    //     echo 'Recon Status : ' . ($voucher['chq_recon_status'] == 1 ? 'Cheque Realized' : 'Cheque Bounced');
                                                                    // }
                                                                }
                                                                $servicecharge = ($voucher['is_wallet_payment_only'] == 1 ? $voucher['service_charge'] : 0);
                                                                ?>
                                                            </div>

                                                            <div class="ibox-content" style=" padding: 10px 15px 25px 15px;">
                                                                <span class="label label-warning pull-left" style="font-size: 14px;"><?php echo print_currency('#fff', '13'); ?> <?php echo my_money_format($voucher['voucher_amount'] + $servicecharge); ?></span>
                                                                <!--+ $voucher['service_charge']-->
                                                                <div class="stat-percent font-bold text-info" data-toggle="tooltip" title="Voucher Type"><i class="fa fa-stack-overflow" aria-hidden="true" style="padding:0 5px 0 0;"></i><?php echo ($voucher['is_payback'] == 1 ? 'FEE PAYBACK' : ($voucher['is_wallet_payment_only'] == 1 ? 'WALLET PAYMENT' : 'FEE PAYMENT')); ?></div>

                                                            </div>
                                                        </div>
                                                    </div>

                                    <?php
                                                    //}
                                                }
                                            }
                                        }
                                    }
                                } else {
                                    ?>
                                    <div class="col-lg-12">
                                        <div class="contact-box text-center">
                                            No voucher is available
                                        </div>
                                    </div>
                                <?php
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-12">
                <div id="student-data-container"></div>
            </div>
        </div>

    </div>
</div>




<script>
    //    var input = document.getElementById("searchpack");
    //    input.addEventListener("keyup", function (event) {
    //        event.preventDefault();
    //        if (event.keyCode === 13) {
    //            document.getElementById("search_name_btn").click();
    //        }
    //    });



    function select_items(id, voucher_code, ptype) {
        $('#voucher_data_loader').addClass('sk-loading');
        var student_id = $('#student_id').val();
        var student_name = $('#student_name').val();
        if (ptype == 'APR') var vtype = 'regfee';
        if (ptype == 'REGFEE') var vtype = 'temp_regfee';
        var ops_url = baseurl + 'fees/show_fee_voucher_details_for_reprint';
        $.ajax({
            type: "POST",
            cache: false,
            async: false,
            url: ops_url,
            data: {
                "load": 1,
                "voucher_id": id,
                "voucher_code": voucher_code,
                "student_id": student_id,
                "student_name": student_name,
                "vtype": vtype
            },
            success: function(result) {
                $('#voucher_data_loader').removeClass('sk-loading');
                var data = JSON.parse(result)
                if (data.status == 1) {
                    $('#student-data-container').html('');
                    $('#student-data-container').html(data.view);
                    $('html, body').animate({
                        scrollTop: $("#student-data-container").offset().top - 70
                    }, 1000);
                } else {
                    alert('No data loaded');
                }
            }
        });
        $('#voucher_data_loader').removeClass('sk-loading');
    }


    //
    //    function search_item() {
    //        $('#student-data-container').html('');
    //        var searchpack = $("#searchpack").val();
    //        var std_id = $("#std_id").val();
    //        var ops_url = baseurl + 'substore/search-pack';
    //        $.ajax({
    //            type: "POST",
    //            cache: false,
    //            async: false,
    //            url: ops_url,
    //            data: {"load": 1, "searchpack": searchpack, "std_id": std_id},
    //            success: function (result) {
    //                var data = JSON.parse(result)
    //                if (data.status == 1) {
    //                    $('#item-data-container').html('');
    //                    $('#student-data-container').html('');
    //                    $('#item-data-container').html(data.view);
    //                    var animation = "fadeInDown";
    //                    $("#item-data-container").show();
    //                    $('#item-data-container').addClass('animated');
    //                    $('#item-data-container').addClass(animation);
    //                    $('#add_type').hide();
    //                } else {
    //                    alert('No data loaded');
    //                }
    //            }
    //        });
    //
    //
    //    }


    $(document).ready(function() {

        $('.ScrollStyle').slimscroll({
            height: '150px'
        })
        $('.i-checks').iCheck({
            checkboxClass: 'icheckbox_square-green',
            radioClass: 'iradio_square-green',
        });
    });
</script>