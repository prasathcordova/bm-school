<?php
$img_ind = base_url('assets/img/flags/32/India.png');
$img_arab = base_url('assets/img/flags/32/United-Arab-Emirates.png');
$img_uk = base_url('assets/img/flags/32/United-Kingdom.png');
?>
<div class="row wrapper border-bottom white-bg page-heading">
    <img alt="image" style="float: right;margin-right: 23px;width:26px;" src="<?php echo $img_ind; ?>">
    <span><img alt="image" style="float: right; width:26px;" src="<?php echo $img_arab; ?>"></span>
    <span><img alt="image" style="float: right; width:26px;" src="<?php echo $img_uk; ?>"></span>

    <div class="col-lg-10 col-md-8 col-sm-8 col-xs-12">
        <h2 style="font-size: 20px;">
            <?php echo isset($title) ? $title : "NO TITLE PROVIDED" ?>
        </h2>

        <ol class="breadcrumb">
            <?php
            if (isset($bread_crump_data) && !empty($bread_crump_data)) {
                echo $bread_crump_data;
            }
            ?>
        </ol>
    </div>
</div>
<div class="wrapper wrapper-content">
    <div class="row">
        <div class="col-lg-3">
            <div class="ibox float-e-margins">
                <div class="ibox-content mailbox-content" id="settings_loader">
                    <div class="sk-spinner sk-spinner-wave">
                        <div class="sk-rect1"></div>
                        <div class="sk-rect2"></div>
                        <div class="sk-rect3"></div>
                        <div class="sk-rect4"></div>
                        <div class="sk-rect5"></div>
                    </div>
                    <div class="file-manager">
                        <a class="btn btn-block btn-primary compose-mail" href="javascript:void(0);" onclick="load_fee_settings_view();">FEE SETTINGS</a>
                        <div class="space-25"></div>
                        <?php if (check_permission(519, 1135, 112) || check_permission(519, 1136, 112) || check_permission(519, 1137, 112) || check_permission(519, 1138, 112) || check_permission(519, 1139, 112)) { ?>
                            <h5>Basic Settings</h5>
                            <ul class="category-list" style="padding: 0">
                                <?php if (check_permission(519, 1135, 112)) { ?>
                                    <li><a class="sidemenulink" title="Account Code" href="javascript:void(0)" onclick="load_accountcode();"> <i class="fa fa-circle text-primary"></i> Account Code </a></li>
                                <?php }
                                if (check_permission(519, 1136, 112)) { ?>
                                    <li><a class="sidemenulink" title="Fee Type" href="javascript:void(0)" onclick="load_fee_type();"> <i class="fa fa-circle text-primary"></i> Fee Type </a></li>
                                <?php }
                                if (check_permission(519, 1137, 112)) { ?>
                                    <li><a class="sidemenulink" title="Demand Frequency" href="javascript:void(0)" onclick="load_demand_frequency();"> <i class="fa fa-circle text-primary"></i> Demand Frequency </a></li>
                                <?php }
                                if (check_permission(519, 1138, 112)) { ?>
                                    <li><a class="sidemenulink" title="Fee Code" href="javascript:void(0)" onclick="load_feecode();"> <i class="fa fa-circle text-primary"></i> Fee Code </a></li>
                                <?php }
                                if (check_permission(519, 1139, 112)) { ?>
                                    <li><a class="sidemenulink" title="Penalty Settings" href="javascript:void(0)" onclick="load_penalty();"> <i class="fa fa-circle text-primary"></i> Penalty Settings </a></li>
                                <?php } ?>
                            </ul>
                        <?php } ?>
                        <?php if (check_permission(519, 1140, 112) || check_permission(519, 1141, 112) || check_permission(519, 1142, 112) || check_permission(519, 1143, 112) || check_permission(519, 1144, 112) || check_permission(519, 1145, 112)) { ?>
                            <h5>Fee Allocation</h5>
                        <?php } ?>
                        <ul class="category-list" style="padding: 0">
                            <?php if (check_permission(519, 1140, 112)) { ?>
                                <li><a class="sidemenulink" title="Periodic Fees Template" href="javascript:void(0)" onclick="load_fee_templates();"> <i class="fa fa-circle text-info"></i> Periodic Fees Template </a></li>
                            <?php }
                            if (check_permission(519, 1141, 112)) { ?>
                                <li><a class="sidemenulink" title="Template - Fee Assignment" href="javascript:void(0)" onclick="load_fee_code_allotment();"> <i class="fa fa-circle text-info"></i> Fee Assignment </a></li>
                            <?php }
                            if (check_permission(519, 1142, 112)) { ?>
                                <li><a class="sidemenulink" title="Template - Student Assignment" href="javascript:void(0)" onclick="load_fee_student_allotment_student_wise();"> <i class="fa fa-circle text-info"></i> Student Assignment</a></li>
                            <?php }
                            if (check_permission(519, 1143, 112)) { ?>
                                <li><a class="sidemenulink" title="Student Allocation List" href="javascript:void(0)" onclick="load_fee_student_allotment_list();"> <i class="fa fa-circle text-info"></i> Student Allocation List </a></li>
                            <?php }
                            if (check_permission(519, 1144, 112)) { ?>
                                <li><a class="sidemenulink" title="Student Deallocation" href="javascript:void(0)" onclick="load_fee_student_deallocation();"> <i class="fa fa-circle text-info"></i> Student Deallocation </a></li>
                            <?php }
                            if (check_permission(519, 1232, 112)) { ?>
                                <li><a class="sidemenulink" title="Fee Enable / Disable" href="javascript:void(0)" onclick="load_fee_deallocation();"> <i class="fa fa-circle text-info"></i> Fee Enable / Disable </a></li>
                            <?php }
                            if (check_permission(519, 1145, 112)) { ?>
                                <li><a class="sidemenulink" title="Other Fee Allocation" href="javascript:void(0)" onclick="load_fee_nondemand();"> <i class="fa fa-circle text-info"></i> Other Fee Allocation </a></li>
                            <?php } ?>
                            <!--<li><a class="sidemenulink"title="Fee Adjustment One Time" href="javascript:void(0)" onclick="load_fee_adjustment_one_time();"> <i class="fa fa-circle text-info"></i> Fee Adjustment One Time </a></li>-->
                        </ul>

                        <?php if (check_permission(519, 1146, 112) || check_permission(519, 1147, 112) || check_permission(519, 1148, 112) || check_permission(519, 1149, 112) || check_permission(519, 1150, 112) || check_permission(519, 1151, 112) || check_permission(519, 1152, 112) || check_permission(519, 1153, 112)) { ?>
                            <h5>Collection</h5>
                        <?php } ?>
                        <ul class="category-list" style="padding: 0">
                            <?php if (check_permission(519, 1146, 112)) { ?>
                                <li><a class="sidemenulink" title="Fee Collection" href="javascript:void(0)" onclick="load_fee_student();"> <i class="fa fa-circle text-warning"></i> Fee Collection <span class="label label-danger pull-right" id="account_code"></span> </a></li>
                            <?php }
                            if (check_permission(519, 1146, 112)) { ?>
                                <!-- <li><a class="sidemenulink" title="Collect Failed Payment" href="javascript:void(0)" onclick="load_failed_payment();"> <i class="fa fa-circle text-warning"></i> Collect Failed Payment <span class="label label-danger pull-right" id="account_code"></span> </a></li> -->
                            <?php }
                            if (check_permission(519, 1147, 112)) { ?>
                                <li><a class="sidemenulink" title="Prospectus Fee" href="javascript:void(0)" onclick="registration_fee();"> <i class="fa fa-circle text-warning"></i> Prospectus Fee</a></li>
                            <?php }
                            //if (check_permission(519, 1147, 112)) { 
                            ?>
                            <li><a class="sidemenulink" title="Registration Fee" href="javascript:void(0)" onclick="temp_registration_fee();"> <i class="fa fa-circle text-warning"></i> Registration Fee</a></li>
                            <?php //}
                            if (check_permission(519, 1148, 112)) { ?>
                                <li><a class="sidemenulink" title="Docme Wallet" href="javascript:void(0)" onclick="load_wallet_student();"> <i class="fa fa-circle text-warning"></i> Docme Wallet <span class="label label-danger pull-right" id="account_code"></span> </a></li>
                                <?php //} 
                                ?>
                                <?php //if (check_permission(519, 1149, 112)) { 
                                ?>
                                <!--<li><a class="sidemenulink"title="Docme Wallet Statement" href="javascript:void(0)" onclick="load_wallet_statement();"> <i class="fa fa-circle text-warning"></i> Docme Wallet Statement <span class="label label-danger pull-right" id="wallet_statement"></span> </a></li>-->
                            <?php }
                            if (check_permission(519, 1149, 112)) { ?>
                                <li><a class="sidemenulink" title="Voucher Cancellation" href="javascript:void(0)" onclick="load_student_voucher_cancellation();"> <i class="fa fa-circle text-warning"></i> Voucher Cancellation <span class="label label-danger pull-right" id="account_code"></span> </a></li>
                            <?php }
                            if (check_permission(519, 1150, 112)) { ?>
                                <li><a class="sidemenulink" title="Voucher Reprint" href="javascript:void(0)" onclick="load_voucher_reprint();"> <i class="fa fa-circle text-warning"></i> Voucher Reprint <span class="label label-danger pull-right" id="account_code"></span> </a></li>
                                <?php //} 
                                ?>
                                <?php //if (check_permission(519, 1151, 112)) { 
                                ?>
                                <!--<li><a class="sidemenulink" href="javascript:void(0)" onclick="load_fee_staff();"> <i class="fa fa-circle text-warning"></i> Staff <span class="label label-warning pull-right" id="city_count"></span>  </a></li>-->
                                <!--<li><a class="sidemenulink" href="javascript:void(0)" onclick="load_fee_guest();"> <i class="fa fa-circle text-warning"></i> Guest <span class="label label-warning pull-right" id="city_count"></span>  </a></li>-->
                            <?php }
                            if (check_permission(519, 1151, 112)) { ?>
                                <li><a class="sidemenulink" title="Cheque Reconciliation" href="javascript:void(0)" onclick="load_cheque_reconciliation();"> <i class="fa fa-circle text-warning"></i> Cheque Reconciliation <span class="label label-info pull-right" id="city_count"></span> </a></li>
                            <?php }
                            if (check_permission(519, 1152, 112)) { ?>
                                <li><a class="sidemenulink" title="Blacklist Release" href="javascript:void(0)" onclick="load_blacklist_student();"> <i class="fa fa-circle text-warning"></i> Blacklist Release <span class="label label-info pull-right" id="city_count"></span> </a></li>
                            <?php }
                            if (check_permission(519, 1153, 112)) { ?>
                                <li><a class="sidemenulink" title="Counter Collection" href="javascript:void(0)" onclick="load_counter_collection();"> <i class="fa fa-circle text-warning"></i> Counter Collection <span class="label label-info pull-right" id="city_count"></span> </a></li>
                            <?php } ?>
                        </ul>
                        <?php if (check_permission(519, 1154, 112) || check_permission(519, 1155, 112)) { ?>
                            <h5>Account</h5>
                        <?php } ?>
                        <ul class="category-list" style="padding: 0">
                            <?php if (check_permission(519, 1154, 112)) { ?>
                                <li><a class="sidemenulink" title="Student Account" href="javascript:void(0)" onclick="load_student_account();"> <i class="fa fa-circle text-blue"></i> Student Account <span class="label label-danger pull-right" id="account_code"></span> </a></li>
                            <?php }
                            if (check_permission(519, 1155, 112)) { ?>
                                <li><a class="sidemenulink" title="Payback Management" href="javascript:void(0)" onclick="load_student_payback();"> <i class="fa fa-circle text-blue"></i> Payback Management<span class="label label-danger pull-right" id="account_code"></span> </a></li>
                            <?php } ?>
                        </ul>
                        <?php if (check_permission(519, 1156, 112) || check_permission(519, 1157, 112) || check_permission(519, 1158, 112) || check_permission(519, 1159, 112)) { ?>
                            <h5>Fee Concession</h5>
                        <?php } ?>
                        <ul class="category-list" style="padding: 0">
                            <?php if (check_permission(519, 1156, 112)) { ?>
                                <li><a class="sidemenulink" title="Concession Slabs" href="javascript:void(0)" onclick="load_priority();"> <i class="fa fa-circle text-danger"></i> Concession Slabs <span class="label label-warning pull-right" id="currency_count"></span> </a></li>
                                <!--<li><a class="sidemenulink"title="Staff Concession Slab" href="javascript:void(0)" onclick="load_staff_priority();"> <i class="fa fa-circle text-warning"></i> Staff Concession Slab <span class="label label-info pull-right" id="profession_count"></span> </a></li>-->
                            <?php }
                            if (check_permission(519, 1157, 112)) { ?>
                                <li><a class="sidemenulink" title="Concessions List" href="javascript:void(0)" onclick="load_student_priority_concession();"> <i class="fa fa-circle text-danger"></i> Concessions List <span class="label label-info pull-right" id="profession_count"></span> </a></li>
                            <?php }
                            if (check_permission(519, 1158, 112)) { ?>
                                <li><a class="sidemenulink" title="Fee Exemption" href="javascript:void(0)" onclick="load_excemptions();"> <i class="fa fa-circle text-danger"></i> Fee Exemption <span class="label label-info pull-right" id="profession_count"></span> </a></li>
                                <?php //} 
                                ?>
                                <?php //if (check_permission(519, 1159, 112)) { 
                                ?>
                                <!--<li><a class="sidemenulink" href="javascript:void(0)" onclick="load_excemptions_recommendation();"> <i class="fa fa-circle text-danger"></i>Fee Exemption Recommendation <span class="label label-info pull-right" id="profession_count"></span> </a></li>-->
                                <!-- Commented for Hiding Arrear section from SideMenu -->
                            <?php }
                            if (check_permission(519, 1159, 112)) { ?>
                                <li><a class="sidemenulink" title="Arrear Management" href="javascript:void(0)" onclick="load_student_arrear();"> <i class="fa fa-circle text-danger"></i> Arrear Management<span class="label label-info pull-right" id="profession_count"></span> </a></li>
                            <?php } ?>
                        </ul>
                        <div class="clearfix"></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-9 animated fadeInRight">
            <div class="" id="data-view">

            </div>
        </div>
    </div>
</div>


<script>
    $(document).ready(
        function() {
            load_fee_settings_view();
        });


    function simpleLoad(btn, state) {
        if (state) {
            btn.children().addClass('fa-spin');
            btn.contents().last().replaceWith(" Loading");
        } else {
            setTimeout(function() {
                btn.children().removeClass('fa-spin');
                btn.contents().last().replaceWith(" Refresh");
            }, 2000);
        }
    }

    function load_fee_settings_view() {
        var ops_url = baseurl + 'fees/block_view/';
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

    function load_accountcode() {
        var ops_url = baseurl + 'fees/create-accountcode/';
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
                $(window).scrollTop(0);
            }
        });

    }

    function load_fee_type() {
        var ops_url = baseurl + 'fees/show-feetype/';
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
                $(window).scrollTop(0);
            }
        });

    }

    function load_demand_frequency() {
        var ops_url = baseurl + 'fees/show-demandfrequency/';
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
                $(window).scrollTop(0);
            }
        });

    }

    function load_feecode() {
        var ops_url = baseurl + 'fees/show-feescode/';
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
                $(window).scrollTop(0);
            }
        });

    }

    function load_penalty() {
        var ops_url = baseurl + 'fees/show_penalty/';
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
                $(window).scrollTop(0);
            }
        });

    }

    function load_priority() {


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
                $(window).scrollTop(0);
            }
        });

    }

    function load_staff_priority() {
        //  swal('', 'This functionality is under construction.', 'info');
        //        return false;

        var ops_url = baseurl + 'fees/staff-priority-list/';
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
                $(window).scrollTop(0);
            }
        });

    }

    function load_student_priority() {
        swal('', 'This functionality is under construction.', 'info');
        return false;


        var ops_url = baseurl + 'fees/view-studentpriority/';
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
                $(window).scrollTop(0);
            }
        });

    }



    function load_family_priority() {
        //  swal('', 'This functionality is under construction.', 'info');
        //        return false;

        var ops_url = baseurl + 'fees/view-family-priority/';
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
                $(window).scrollTop(0);
            }
        });

    }

    function functionality_under_construction() {
        swal('', 'This functionality is under construction.', 'info');
        return false;
    }


    function load_fee_templates() {

        var ops_url = baseurl + 'fees/show-fees-template/';
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
                $(window).scrollTop(0);
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
                $(window).scrollTop(0);
            }
        });

    }

    function load_fee_student_allotment_student_wise() {

        var ops_url = baseurl + 'fees/show-template-fees-code-list-for-student-link/';
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
                $(window).scrollTop(0);
            }
        });

    }

    function registration_fee() {

        var ops_url = baseurl + 'fees/registration_fee/';
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
                $(window).scrollTop(0);
            }
        });

    }

    function temp_registration_fee() {

        var ops_url = baseurl + 'fees/temp_registration_fee/';
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
                $(window).scrollTop(0);
            }
        });

    }


    function load_student_account() {


        var ops_url = baseurl + 'account/show-filter-student-account/';
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
                $(window).scrollTop(0);
            }
        });

    }

    function load_student_payback() {


        var ops_url = baseurl + 'payback/show-payback-list/';
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
                $(window).scrollTop(0);
            }
        });

    }




    function load_fee_nondemand() {
        //        swal('', 'This functionality is under construction.', 'info');
        //        return false;


        //     var ops_url = baseurl + 'fees/show-nondemand-fees-template/';
        //        var ops_url = baseurl + 'fees/nondemandfees_structure/';
        var ops_url = baseurl + 'fees/show-nonperiodicfee-student-filter/';
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
                $(window).scrollTop(0);
            }
        });

    }

    function load_fee_student() {
        //     var ops_url = baseurl + 'fees/show-nondemand-fees-template/';
        var ops_url = baseurl + 'fees/show-fees-student-collection/';
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
                $(window).scrollTop(0);
            }
        });

    }

    function load_failed_payment() {
        //     var ops_url = baseurl + 'fees/show-nondemand-fees-template/';
        var ops_url = baseurl + 'fees/show_collection_failed_payment/';
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
                $(window).scrollTop(0);
            }
        });

    }

    function load_student_voucher_cancellation() {
        //     var ops_url = baseurl + 'fees/show-nondemand-fees-template/';
        var ops_url = baseurl + 'fees/show-student-filter-voucher-cancel/';
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
                $(window).scrollTop(0);
            }
        });
    }

    function load_voucher_reprint() {
        //     var ops_url = baseurl + 'fees/show-nondemand-fees-template/';
        var ops_url = baseurl + 'fees/show_voucher_reprint/';
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
                $(window).scrollTop(0);
            }
        });
    }

    function load_wallet_student() {
        var ops_url = baseurl + 'fees/show-wallet-student-collection/';
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
                $(window).scrollTop(0);
            }
        });

    }

    function load_wallet_statement() {

        var ops_url = baseurl + 'fees/show-wallet-student-collection/';
        $.ajax({
            type: "POST",
            cache: false,
            async: false,
            url: ops_url,
            data: {
                "load": 1,
                "show": "statement"
            },
            success: function(result) {
                $('#data-view').html(result);
                $(window).scrollTop(0);
            }
        });

    }

    function load_cheque_reconciliation() {
        //     var ops_url = baseurl + 'fees/show-nondemand-fees-template/';
        var ops_url = baseurl + 'fees/show-cheque-reconciliation/';
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
                $(window).scrollTop(0);
            }
        });

    }

    function load_blacklist_student() {
        var ops_url = baseurl + 'fees/show-blacklisted-students/';
        $.ajax({
            type: "POST",
            cache: false,
            async: false,
            url: ops_url,
            data: {
                "load": 1
            },
            success: function(result) {
                if (result) {
                    var data = JSON.parse(result)
                    if (data.data_status == 1) {
                        $('#data-view').html(data.view);
                        $(window).scrollTop(0);
                    } else {
                        swal('', 'An error encountered. Please contact administrator for further assistance')
                        return false;
                    }
                } else {
                    swal('', 'An error encountered. Please contact administrator for further assistance')
                    return false;
                }
            }
        });

    }

    function load_counter_collection() {
        var ops_url = baseurl + 'fees/show-counter-collection/';
        $.ajax({
            type: "POST",
            cache: false,
            async: false,
            url: ops_url,
            data: {
                "load": 1
            },
            success: function(result) {
                if (result) {
                    var data = JSON.parse(result)
                    if (data.status == 1) {
                        $('#data-view').html(data.view);
                        $(window).scrollTop(0);
                    } else {
                        swal('', 'An error encountered. Please contact administrator for further assistance')
                        return false;
                    }
                } else {
                    swal('', 'An error encountered. Please contact administrator for further assistance')
                    return false;
                }
            }
        });

    }

    function load_excemptions() {
        var ops_url = baseurl + 'fees/show_fees_student_exemption/';
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
                $(window).scrollTop(0);
            }
        });
    }

    function load_excemptions_approvals() {
        var ops_url = baseurl + 'fees/show_exemption_approvals/';
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
                $(window).scrollTop(0);
            }
        });
    }

    function load_concession() {
        swal('', 'This functionality is under construction.', 'info');
        return false;

        var ops_url = baseurl + 'fees/show-fees-student-concession/';
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
                $(window).scrollTop(0);
            }
        });

    }

    function load_scholarships() {
        swal('', 'This functionality is under construction.', 'info');
        return false;

        //     var ops_url = baseurl + 'fees/show-nondemand-fees-template/';
        var ops_url = baseurl + 'fees/show-fees-student-scholarships/';
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
                $(window).scrollTop(0);
            }
        });

    }

    function student_filter() {
        swal('', 'This functionality is under construction.', 'info');
        return false;


        //     var ops_url = baseurl + 'fees/show-nondemand-fees-template/';
        var ops_url = baseurl + 'fees/student-filter-student-scholarships/';
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
                $(window).scrollTop(0);
            }
        });

    }

    function load_fee_staff() {
        swal('', 'This functionality is under construction.', 'info');
        return false;


        //     var ops_url = baseurl + 'fees/show-nondemand-fees-template/';
        var ops_url = baseurl + 'fees/show-fees-staff-collection/';
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
                $(window).scrollTop(0);
            }
        });

    }

    function load_fee_student_allotment_list() {
        var ops_url = baseurl + 'fees/fees-student-allotment/';
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
                $(window).scrollTop(0);
            }
        });

    }

    function load_fee_student_deallocation() {
        //     var ops_url = baseurl + 'fees/show-nondemand-fees-template/';
        var ops_url = baseurl + 'fees/fees-student-deallocation-load-template/';
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
                $(window).scrollTop(0);
            }
        });

    }

    function load_fee_deallocation() {
        var ops_url = baseurl + 'fees/load_fee_deallocation/';
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
                $(window).scrollTop(0);
            }
        });
    }

    function load_fee_demand() {
        swal('', 'This functionality is under construction.', 'info');
        return false;


        var ops_url = baseurl + 'fees/show-fees-template/';
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
                $(window).scrollTop(0);
            }
        });

    }

    function load_student_priority_concession() {
        //        swal('', 'This functionality is under construction.', 'info');
        //        return false;


        var ops_url = baseurl + 'fees/student_priority_concession/';
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
                $(window).scrollTop(0);
            }
        });

    }

    function load_fee_adjustment_one_time() {

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
                $(window).scrollTop(0);
            }
        });

    }

    function load_student_arrear() {
        //        swal('', 'This functionality is under construction.', 'info');
        //        return false;

        $('#settings_loader').addClass('sk-loading');
        var ops_url = baseurl + 'fees/fees-arrear-preload/';
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
                $('#settings_loader').removeClass('sk-loading');
                $(window).scrollTop(0);
            }
        });

    }
</script>
<style>
    .font12 {
        font-size: 12px !important;
    }

    .input-group>.select2-container--bootstrap {
        width: 100% !important;
    }
</style>