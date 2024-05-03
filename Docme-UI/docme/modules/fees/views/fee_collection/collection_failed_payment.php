<!-- SALAHUDHEEn SEPTEMBER : REGISTRATION / PROSPECTUS FEE From Students -->
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
                                <div class="form-group">
                                    <label>Json String from Atom</label><span class="mandatory"> *</span>
                                    <div class="form-line <?php
                                                            if (form_error('json_string')) {
                                                                echo 'has-error';
                                                            }
                                                            ?> ">
                                        <textarea class="form-control" maxlength="100" placeholder="Enter Json String" name="json_string" id="json_string" rows="5" style="resize: none;"></textarea>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-12 col-sm-12 col-xs-12 col-md-12">
                            <a href="javascript:" style="background:hotpink !important;border-color: hotpink !important; cursor:pointer" onclick="validate_json_string();" class="btn btn-primary">Make Payment
                                                        </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div id="student-print-container"></div>

<script type="text/javascript">
    $(".allownumericwithdecimal").on("keypress keyup blur", function(event) {
        $(this).val($(this).val().replace(/[^0-9\.]/g, ''));
        if ((event.which != 46 || $(this).val().indexOf('.') != -1) && (event.which < 48 || event.which > 57)) {
            event.preventDefault();
        }
    });

    $('#amt_distribute').change(function() {
        $('#amt_distribute_ops').val('0');
    });

    function validate_json_string() {
        var json_string = $('#json_string').val();

        //Basic validation starts
        if (json_string.length <= 0) {
            $('#json_string').focus();
            swal('', 'Enter Json String', 'info');
            $('#pay_loader').removeClass('sk-loading');
            return false;
        }
        var jsonstatus = IsValidJSONString(json_string);
        if(jsonstatus == false){
            $('#json_string').focus();
            swal('', 'Enter Valid Json String', 'info');
            $('#pay_loader').removeClass('sk-loading');
            return false;
        }

        $('#pay_loader').removeClass('sk-loading');
        make_payment();
        //Basic Validation Ends
    }
    function IsValidJSONString(str) {
        try {
            JSON.parse(str);
        } catch (e) {
            return false;
        }
        return true;
    }

    function make_payment() {
        var amt_pay_raw = $('#pay_amount').val();

        var amt_pay = parseFloat(amt_pay_raw);
        var j = 0;
        var limit = $('#iter_count').val();
        var idname = '';
        var value = 0;
        var table = $('#tbl_fee_allocation_data').DataTable();
        var pay_data = [];
        var total_voucher_amount = 0
        var total_vat_amount_paid = 0
        var total_wallet_amount = 0
        var nonrealized = 0;
        var is_paid_full = 0;
        var is_paid_partial = 1;
        var pending_payment_without_tax = 0
        var desc = "";

        var json_string = $('#json_string').val();
        var ops_url = baseurl + 'fees/make_failed_payment';
        var datatosave = [];
        datatosave = {
            "json_string": json_string
        };
        
        //alert(JSON.stringify(datatosave));
        $.ajax({
            type: "POST",
            cache: false,
            async: false,
            url: ops_url,
            //amt_pay_raw
            data: datatosave,
            success: function(result) {

                var data = JSON.parse(result);
                if (data.status == 1) {
                    var voucher = data.voucher_no;
                    var voucher_id = data.voucher_id;
                    swal('', 'Payment of ' + amt_pay_raw + " /- for the student " + student_name + " is completed successfully with voucher number : " + voucher + ".", 'success');
                    print_voucher(voucher_id, voucher, 'regfee'); //PRINT VOUCHER
                    registration_fee();
                } else if (data.status == 5) {
                    if (data.message) {
                        swal('', data.message, 'info');

                        registration_fee()
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
                        swal('', 'There was no data regarding the selected students. Please contact administrator for further assistance', 'info');
                        return false;
                    }
                }

            }
        });
        $('#pay_loader').removeClass('sk-loading');

    }

</script>