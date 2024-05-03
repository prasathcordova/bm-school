<?php
if (null !== ($this->session->userdata('payment_status_message')) && $this->session->userdata('payment_status_message') == 1) {
?>
    <script type="text/javascript">
        activate_toast_login('Payment Success', 'Fee payment success. Please check Online Payment History tab for more information', 'success', 500);
    </script>
<?php
    $this->session->unset_userdata('payment_status_message');
} else if (null !== ($this->session->userdata('payment_status_message')) && $this->session->userdata('payment_status_message') == 2) {
?>
    <script type="text/javascript">
        activate_toast_login_for_error('Payment failed please check the payment info for more details', 'Payment Failed', 'error', 500);
    </script>
<?php
    $this->session->unset_userdata('payment_status_message');
}
?>
<style>
    dt {
        padding-bottom: 10px;
        font-weight: 700;
    }

    .nav-tabs>li a:hover,
    .nav-tabs>li a:focus {
        background: #FFF !important;
        /*Modified for tab color*/
        /*background: #23C6C5;*/

    }

    .p-m {
        padding: 15px
    }
</style>

<?php

$profile_image = base_url('assets/images/a5.jpg');

if (!empty(get_student_image($sdetails_data[0]['student_id']))) {
    $profile_image = get_student_image($sdetails_data[0]['student_id']);
} else {
    $profile_image = base_url('assets/images/a5.jpg');
}

// dev_export($parent_address);


$collegelogo_image = base_url('assets/images/100_logo.png');
if ($PAID_OR_NOT == 1) {
    $amt_to_pay = 1;
} else {
    $amt_to_pay = ($min_wallet > 0 ? $min_wallet : $FIST_TERM_FEE);
}

?>
<div class="ibox">
    <?php if ($this->session->userdata('is_parent') == 1) { ?>
        <div class="ibox-title" style="border-bottom-color:#ffd300 !important;">
            <h5>&nbsp;</h5>
            <span style="float:right;">
                <a href="<?php echo base_url(); ?>" title="Portal Home"><i class="fa fa-home" style="font-size: 20px; padding-right:10px;"></i></a>
            </span>
        </div>
    <?php } ?>

    <div class="ibox-content" id="loader">
        <div class="sk-spinner sk-spinner-wave">
            <div class="sk-rect1"></div>
            <div class="sk-rect2"></div>
            <div class="sk-rect3"></div>
            <div class="sk-rect4"></div>
            <div class="sk-rect5"></div>
        </div>
        <div class="wrapper wrapper-content animated fadeInRight">
            <input type="hidden" name="matdiw" id="matdiw" value="<?php echo $amt_to_pay ?>">

            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            Student Profile
                        </div>
                        <div class="panel-body no-padding">
                            <div class="contact-box" style="margin-bottom:0px;">
                                <input type="hidden" name="tatpiapg" id="tatpiapg" value="0">
                                <a href="javascript:void(0)">

                                    <div class="col-sm-2">
                                        <div class="text-center">
                                            <img alt="image" class="img-circle img-md img-responsive" src="<?php echo $profile_image; ?>" />
                                            <div class="m-t-xs font-bold"> </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <strong style="color:#24537D;"><?php echo $sdetails_data[0]['Student_Name'] ?></strong>
                                        <p style="color:#24537D;">Admission Number : <?php echo isset($sdetails_data[0]['Reg_No']) ? $sdetails_data[0]['Reg_No'] : "No Register Number" ?></p>
                                        <p style="color:#24537D;">Batch : <?php echo isset($sdetails_data[0]['Batch_Name']) ? $sdetails_data[0]['Batch_Name'] : "No Batch" ?></p>
                                        <!-- <p style="color:#24537D;">Fee due date : <?php echo isset($details_data[0]['dem_date']) ? date('d-m-Y', strtotime($details_data[0]['dem_date'])) : date('10-m-Y') ?></p> -->

                                    </div>
                                    <div class="col-sm-4">
                                        <div class="text-center">
                                            Wallet Balance<br>
                                            <h4><?php print_currency('hotpink', '', $inst_id); ?> &nbsp;<?php echo my_money_format($e_wallet) ?></h4>
                                        </div>
                                    </div>
                                    <div class="clearfix"></div>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-12">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            Wallet Deposit
                        </div>
                        <div class="panel-body no-padding">
                            <div class="widget " style="border-radius:0px;">
                                <div class="row">
                                    <?php if ($PAID_OR_NOT == 0) {
                                        $label = 'Amount Fixed by Principal for educore Access'; ?>
                                        <div class="col-md-12">
                                            <h5>First Installment Fee : <?php echo my_money_format($FIST_TERM_FEE) ?></h5>
                                            <h5><?php echo $label ?> : <?php echo my_money_format($min_wallet) ?></h5>
                                            <hr>
                                        </div>
                                    <?php } else {
                                        $label = 'Amount to Wallet';
                                    } ?>
                                    <div class="col-md-12">
                                        <label><?php echo $label ?> :</label>
                                        <div class="input-group m-b" style="margin-bottom: 0px;">
                                            <input type="text" maxlength="6" style="background-color: #FFFFFF; text-align:right; height:39px !important;" class="form-control" onkeypress="return isNumber(event)" name="wallet_deposit_amount" id="wallet_deposit_amount" value="<?php echo round($amt_to_pay, 2); ?>">
                                            <span class="input-group-addon">
                                                <?php print_currency('hotpink', '', $inst_id); ?>
                                            </span>
                                        </div>
                                        <hr>
                                        <a class="btn btn-danger pull-right" id="card_pay_btn" style="margin-left:0px;" href="javascript:void(0);" onclick="pay_wallet_atom('<?php echo $sdetails_data[0]['Reg_No']; ?>')">
                                            <i class="fa fa-money"></i> Add to Wallet
                                        </a>
                                    </div>
                                </div>
                                <!-- <div class="row">
                                    <div class="col-md-8">
                                        <h5>First Installment Fee : <?php echo $FIST_TERM_FEE ?></h5>
                                        <h5>Amount Fixed by Principal for educore Access : <?php echo $min_wallet ?></h5>
                                    </div>
                                    <div class="col-md-4 text-center">
                                    <input type="text" style="width:90%;color:#000;background-color: #FFFFFF; text-align:right;" class="form-control" onkeypress="return isNumber(event)" maxlength="8" name="wallet_deposit_amount" id="wallet_deposit_amount" value="<?php echo $amt_to_pay; ?>">
                                    <a class="btn btn-danger" id="card_pay_btn" href="javascript:void(0);" onclick="pay_wallet_atom('<?php echo $sdetails_data[0]['Reg_No']; ?>')">
                                                <i class="fa fa-money"></i> Add to Wallet
                                            </a>
                                    </div>
                                </div> -->
                                <!-- <div class="p-m">
                                    <div class="row">
                                        <div class="col-xs-2">
                                            <h2 class="m-xs" class="pull-right">
                                                <span style="color:#FFF ">
                                                    <?php print_currency('white', '', $inst_id); ?>
                                                </span>

                                            </h2>
                                        </div>
                                        <div class="col-xs-10">
                                            <div class="pull-left">
                                                <strong>
                                                    <input type="text" style="width:90%;color:#000;background-color: #FFFFFF; text-align:right;" class="form-control" onkeypress="return isNumber(event)" maxlength="8" name="wallet_deposit_amount" id="wallet_deposit_amount" value="<?php echo $amt_to_pay; ?>">
                                                </strong>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row" style="margin-top:10px">
                                        <div class="col-lg-12" style="text-align:center">
                                            <a class="btn btn-danger" id="card_pay_btn" href="javascript:void(0);" onclick="pay_wallet_atom('<?php echo $sdetails_data[0]['Reg_No']; ?>')">
                                                <i class="fa fa-money"></i> Add to Wallet
                                            </a>
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
<input type="hidden" name="student_id" id="student_id" value="<?php echo $sdetails_data[0]['student_id'] ?>" />
<input type="hidden" value="<?php echo $cur_acd_year_id ?>" id="cur_acd_year_id">
<style>
    .icheckbox_square-green.checked.disabled {
        background-position: -48px 0;
    }
</style>
<script>
    $('.i-checks').iCheck({
        checkboxClass: 'icheckbox_square-green',
        radioClass: 'iradio_square-green',
    });

    function isNumber(evt) {
        evt = (evt) ? evt : window.event;
        var charCode = (evt.which) ? evt.which : evt.keyCode;
        if (charCode > 31 && (charCode < 48 || charCode > 57)) {
            return false;
        }
        return true;
    }

    function pay_wallet_atom(admn_no) {
        var ops_url = baseurl + 'fees/pay_wallet_atom/';
        var matdiw = $('#matdiw').val();
        var paid_amt = parseInt($('#wallet_deposit_amount').val());

        if (paid_amt < matdiw) {
            swal('', 'Minimum Amount you should pay : ' + parseFloat(matdiw).toFixed(2), 'info');
            return false;
        }
        var student_id = $('#student_id').val();
        var cur_acd_year_id = $('#cur_acd_year_id').val();

        var reg = /[\d\.]/g;
        if (!reg.test(($('#wallet_deposit_amount').val()))) {
            swal('', 'Enter valid amount', 'info');
            return false;
        }

        if (paid_amt < 1) {
            swal('', 'Wallet Money should be atleast 1', 'info');
            return false;
        }


        $.ajax({
            type: "POST",
            cache: false,
            async: false,
            url: ops_url,
            data: {
                "load": 1,
                "admn_no": admn_no,
                "paid_amt": paid_amt,
                "matdiw": matdiw,
                "student_id": student_id,
                "cur_acd_year_id": cur_acd_year_id
            },
            success: function(result) {
                var data = JSON.parse(result);
                if (data.status == 1) {
                    window.location.href = data.link;
                    return true;
                } else if (data.status == 2) {
                    swal('', data.message, 'info');
                    return false;
                } else {
                    swal('', 'An error occured while configure Criteria . Please try again later or contact administrator with error code : DPRDTAER10003', 'info');
                    return false;
                }


            }
        });
    }
</script>