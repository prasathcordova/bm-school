<?php
$profile_image = "";
if (!empty(get_student_image($student['student_id']))) {
    $profile_image = get_student_image($student['student_id']);
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
        <h5><i class="fa fa-info-circle" style="padding-right:10px;"></i><?php echo isset($sub_title) ? $sub_title : "Voucher Cancellation" ?></h5>
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

                        <?php echo $student['student_name'] ?> <small style="float: right;"> <?php //echo $student['Designation'] 
                                                                                                ?></small>
                        <small style="float: right;"> <?php echo $student['Batch_Name'] ?>
                            <br> Status : <?php echo $student['stud_status'] ?>
                            <br> Admission No. : <?php echo $student['Admn_No'] ?></small>

                        <input type="hidden" id="student_id" name="student_id" value="<?php echo $student_id; ?>" />
                        <input type="hidden" id="student_name" name="student_name" value="<?php echo $student_name; ?>" />
                    </div>
                    <div class="panel-body">
                        <!--                        <div class=" input-group" style="padding-bottom: 5%;">
                                                    <input type="text" placeholder="Enter Packing ID" class="input form-control" id="searchpack" name="searchpack">
                        
                                                    <span class="input-group-btn" >
                                                        <button type="button"id="search_name_btn" class="btn btn btn-primary" onclick="search_item();"> <i class="fa fa-search" ></i></button>
                                                        <input type="hidden" class="input form-control" id="store_idd" name="store_idd" value="<?php // echo $store_idd                  
                                                                                                                                                ?>">
                                                    </span>
                                                </div>-->

                        <!-- <div class="ScrollStyle">  row-new-->
                        <div class="row" id="item-data-container">
                            <?php
                            // dev_export($voucher_data);
                            $i = 0;
                            $errflag = 0;
                            if (isset($voucher_id_selected) && $voucher_id_selected > 0) {
                                if (isset($voucher_data) && !empty($voucher_data) && is_array($voucher_data)) {
                                    $voucher_display = 1;
                                    foreach ($voucher_data as $voucher) {
                                        if ($voucher_id_selected == $voucher['id']) {
                                            // if (substr($voucher['voucher_code'], 0, 3) == 'FRV' || substr($voucher['voucher_code'], 0, 3) == 'CRV') {
                                            $errflag++;
                                            $vdisplay = 1;
                                            if ($voucher['is_cheque'] == 1) {
                                                $vdisplay = 1;
                                                $errflag++;
                                                if ($voucher['is_chq_recon'] == 1 && $voucher['chq_recon_status'] == 0) {
                                                    $vdisplay = 0;
                                                } else {
                                                    $vdisplay = 1;
                                                    $errflag++;
                                                }
                                            }
                                            if ($vdisplay == 1) { ?>
                                                <div class="col-lg-6">
                                                    <div class="ibox float-e-margins">
                                                        <div class="ibox-title" style="padding: 5PX 15PX 2px 15px;min-height: 35px;">
                                                            <?php echo $voucher['voucher_code']; ?>
                                                            <?php if (substr($voucher['voucher_code'], 0, 3) == 'FRV' || substr($voucher['voucher_code'], 0, 3) == 'CRV') { ?>
                                                                <a href="javascript:void(0)" onclick="select_items('<?php echo $voucher['id']; ?>', '<?php echo $voucher['voucher_code']; ?>');">
                                                                    <span class="btn btn-xs btn-info pull-right">Show Voucher</span>
                                                                </a>
                                                            <?php } ?>
                                                        </div>
                                                        <div class="ibox-title" style="padding: 5PX 15PX 2px 15px;min-height: 65px;">
                                                            Transaction Type :
                                                            <?php
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
                                                            } else if ($voucher['is_dbt'] == 1) {
                                                                echo 'Direct Bank Transfer';
                                                            } else if ($voucher['is_withdraw'] == 1 && $voucher['is_payback'] == 1) {
                                                                echo 'Fee Payback';
                                                            } else if ($voucher['is_withdraw'] == 1) {
                                                                echo 'Wallet Withdrawal';
                                                            } else {
                                                                echo 'Concession / Exemption';
                                                            }
                                                            ?>
                                                            <br />
                                                            <?php
                                                            if ($voucher['is_cheque'] == 1) {
                                                                echo 'Cheque Status : ' . ($voucher['is_chq_recon'] == 1 ? 'Cheque Reconciled' : 'Pending Reconciliation');
                                                            }
                                                            ?>
                                                        </div>

                                                        <div class="ibox-content" style=" padding: 10px 15px 25px 15px;">
                                                            <span class="label label-warning pull-left" style="font-size: 14px;"><?php echo print_currency('#fff', '13'); ?> <?php echo my_money_format($voucher['voucher_amount']); ?></span>
                                                            <div class="stat-percent font-bold text-info" data-toggle="tooltip" title="Voucher Type"><i class="fa fa-stack-overflow" aria-hidden="true" style="padding:0 5px 0 0;"></i><?php echo ($voucher['is_payback'] == 1 ? 'FEE PAYBACK' : ($voucher['is_wallet_payment_only'] == 1 ? 'WALLET PAYMENT' : 'FEE PAYMENT')); ?></div>
                                                        </div>
                                                    </div>
                                                </div>
                                            <?php

                                            }
                                            //}
                                        }
                                    }
                                }
                            } else {
                                if (isset($voucher_data) && !empty($voucher_data) && is_array($voucher_data)) {
                                    $voucher_display = 1;
                                    foreach ($voucher_data as $voucher) {
                                        // if (substr($voucher['voucher_code'], 0, 3) == 'FRV' || substr($voucher['voucher_code'], 0, 3) == 'CRV') {
                                        $errflag++;
                                        $vdisplay = 1;
                                        // if (isset($voucher_id_selected) && $voucher_id_selected == $voucher['id']) {
                                        //     $vdisplay = 1;
                                        // } else {
                                        //     $vdisplay = 1;
                                        // }

                                        if ($voucher['is_cheque'] == 1) {
                                            $vdisplay = 1;
                                            $errflag++;
                                            if ($voucher['is_chq_recon'] == 1 && $voucher['chq_recon_status'] == 0) {
                                                $vdisplay = 0;
                                            } else {
                                                $vdisplay = 1;
                                                $errflag++;
                                            }
                                        }
                                        if ($vdisplay == 1) { ?>
                                            <div class="col-lg-6">
                                                <div class="ibox float-e-margins">
                                                    <div class="ibox-title" style="padding: 5PX 15PX 2px 15px;min-height: 35px;">
                                                        <?php echo $voucher['voucher_code']; ?>
                                                        <?php if (substr($voucher['voucher_code'], 0, 3) == 'FRV' || substr($voucher['voucher_code'], 0, 3) == 'CRV') { ?>
                                                            <a href="javascript:void(0)" onclick="select_items('<?php echo $voucher['id']; ?>', '<?php echo $voucher['voucher_code']; ?>');">
                                                                <span class="btn btn-xs btn-info pull-right">Show Voucher</span>
                                                            </a>
                                                        <?php } ?>
                                                    </div>
                                                    <div class="ibox-title" style="padding: 5PX 15PX 2px 15px;min-height: 65px;">
                                                        Transaction Type :
                                                        <?php
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
                                                        } else if ($voucher['is_dbt'] == 1) {
                                                            echo 'Direct Bank Transfer';
                                                        } else if ($voucher['is_withdraw'] == 1 && $voucher['is_payback'] == 1) {
                                                            echo 'Fee Payback';
                                                        } else if ($voucher['is_withdraw'] == 1) {
                                                            echo 'Wallet Withdrawal';
                                                        } else {
                                                            echo 'Concession / Exemption';
                                                        }
                                                        ?>
                                                        <br />
                                                        <?php
                                                        if ($voucher['is_cheque'] == 1) {
                                                            echo 'Cheque Status : ' . ($voucher['is_chq_recon'] == 1 ? 'Cheque Reconciled' : 'Pending Reconciliation');
                                                        }
                                                        ?>
                                                    </div>

                                                    <div class="ibox-content" style=" padding: 10px 15px 25px 15px;">
                                                        <span class="label label-warning pull-left" style="font-size: 14px;"><?php echo print_currency('#fff', '13'); ?> <?php echo my_money_format($voucher['voucher_amount']); ?></span>
                                                        <div class="stat-percent font-bold text-info" data-toggle="tooltip" title="Voucher Type"><i class="fa fa-stack-overflow" aria-hidden="true" style="padding:0 5px 0 0;"></i><?php echo ($voucher['is_payback'] == 1 ? 'FEE PAYBACK' : ($voucher['is_wallet_payment_only'] == 1 ? 'WALLET PAYMENT' : 'FEE PAYMENT')); ?></div>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php

                                        }
                                        // if ($i == 2) {
                                        //     echo '<div class="clearfix"></div>';
                                        //     $i = 0;
                                        // } else {
                                        //     $i = $i + 1;
                                        // }
                                        ?>
                                <?php

                                        //}
                                    }
                                }
                            }
                            if ($errflag == 0) {
                                ?>
                                <div class="col-lg-12">
                                    <div class="contact-box text-center">
                                        No current day voucher is available for cancellation
                                    </div>
                                </div>
                            <?php
                            }
                            ?>
                        </div>
                        <!-- </div> -->
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



    function select_items(id, voucher_code) {
        $('#voucher_data_loader').addClass('sk-loading');
        var student_id = $('#student_id').val();
        var student_name = $('#student_name').val();
        var ops_url = baseurl + 'fees/show-fee-voucher-details-for-cancel';
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
                "student_name": student_name
            },
            success: function(result) {
                $('#voucher_data_loader').removeClass('sk-loading');
                var data = JSON.parse(result)
                if (data.status == 1) {
                    $('#student-data-container').html('');
                    $('#student-data-container').html(data.view);
                    $('html, body').animate({
                        scrollTop: $("#student-data-container").offset().top
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