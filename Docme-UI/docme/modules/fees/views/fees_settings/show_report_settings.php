<div class="row wrapper border-bottom white-bg page-heading">
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
                <div class="ibox-content mailbox-content">
                    <div class="file-manager">
                        <a class="btn btn-block btn-primary compose-mail" href="javascript:void(0)">Reports</a>
                        <div class="space-25"></div>
                        <?php if (
                            check_permission(520, 1160, 112) || check_permission(520, 1161, 112) || check_permission(520, 1162, 112) || check_permission(520, 1163, 112) || check_permission(520, 1164, 112)
                            || check_permission(520, 1165, 112) || check_permission(520, 1166, 112) || check_permission(520, 1167, 112) || check_permission(520, 1168, 112) || check_permission(520, 1169, 112)
                            || check_permission(520, 1170, 112) || check_permission(520, 1171, 112) || check_permission(520, 1172, 112)
                        ) { ?>
                            <h5>COLLECTION REPORT</h5>
                        <?php } ?>
                        <ul class="category-list" style="padding: 0">
                            <?php if (check_permission(520, 1160, 112)) { ?>
                                <li><a title="Daily Collection Report" class="sideanchor" href="javascript:void(0);" onclick="load_daily_collection();"> <i class="fa fa-circle text-primary"></i> Daily Collection Report</a></li>
                            <?php }
                            if (check_permission(520, 1161, 112)) { ?>
                                <li><a title="Received Non Demandable" class="sideanchor" href="javascript:void(0);" onclick="load_received_non_demandables();"> <i class="fa fa-circle text-danger"></i> Received Non Demandable</a></li>
                            <?php }
                            if (check_permission(520, 1162, 112)) { ?>
                                <li><a title="Individual Collection Report" class="sideanchor" href="javascript:void(0);" onclick="load_individual_collection_report();"> <i class="fa fa-circle text-info"></i> Individual Collection Report</a></li>
                            <?php }
                            if (check_permission(520, 1163, 112)) { ?>
                                <li><a title="Collection Class wise summary" class="sideanchor" href="javascript:void(0);" onclick="load_collection_class_wise_summary();"> <i class="fa fa-circle text-warning"></i> Collection Class wise summary</a></li>
                            <?php }
                            if (check_permission(520, 1164, 112)) { ?>
                                <li><a title="Collection Batch wise details" class="sideanchor" href="javascript:void(0);" onclick="load_collection_class_wise_details();"> <i class="fa fa-circle text-danger"></i> Collection Batch wise details</a></li>
                            <?php }
                            if (check_permission(520, 1165, 112)) { ?>
                                <li><a title="Head wise collection Report" class="sideanchor" href="javascript:void(0);" onclick="load_head_wise_collection_report();"> <i class="fa fa-circle text-default"></i> Head wise collection Report</a></li>
                            <?php }
                            if (check_permission(520, 1166, 112)) { ?>
                                <li><a title="Summary collection Report" class="sideanchor" href="javascript:void(0);" onclick="load_summary_collection_report();"> <i class="fa fa-circle text-primary"></i> Summary collection Report</a></li>
                            <?php }
                            if (check_permission(520, 1167, 112)) { ?>
                                <li><a title="User Collection Report" class="sideanchor" href="javascript:void(0);" onclick="load_user_collection_details();"> <i class="fa fa-circle text-info"></i> User Collection Report</a></li>
                            <?php }
                            if (check_permission(520, 1160, 112)) { ?>
                                <li><a title="Registration Fee Collection Report" class="sideanchor" href="javascript:void(0);" onclick="load_regfee_collection();"> <i class="fa fa-circle text-primary"></i> Reg.fee Collection Report</a></li>
                            <?php }
                            if (check_permission(520,  1160, 112)) { ?>
                                <!-- Online Collection Report -->
                                <li><a title="Online Collection Report" class="sideanchor" href="javascript:void(0);" onclick="load_online_pay_report();"> <i class="fa fa-circle text-default"></i> Online Collection Report</a></li>
                            <?php }
                            if (check_permission(520, 1168, 112)) { ?>
                                <li><a title="Cheque Received Ledger" class="sideanchor" href="javascript:void(0);" onclick="load_cheque_received_ledger();"> <i class="fa fa-circle text-info"></i> Cheque Received Ledger</a></li>
                            <?php }
                            if (check_permission(520, 1169, 112)) { ?>
                                <li><a title="<?php echo print_tax_vat(); ?> Collection Report" class="sideanchor" href="javascript:void(0);" onclick="load_tax_report();"> <i class="fa fa-circle text-danger"></i> <?php echo print_tax_vat(); ?> Collection Report</a></li>
                            <?php }
                            if (check_permission(520, 1170, 112)) { ?>
                                <li><a title="Voucher Cancellation Report" class="sideanchor" href="javascript:void(0);" onclick="load_voucher_cancellation_report();"> <i class="fa fa-circle text-danger"></i> Voucher Cancellation Report</a></li>
                            <?php }
                            if (check_permission(520, 1171, 112)) { ?>
                                <li><a title="Batch Wise DCB Report" class="sideanchor" href="javascript:void(0);" onclick="load_dcb_classwise_summary_report();"> <i class="fa fa-circle text-default"></i> Batch Wise DCB Report</a></li>
                            <?php }
                            if (check_permission(520, 1172, 112)) { ?>
                                <!-- DCB Batch wise summary -->
                                <li><a title="Individual DCB Report" class="sideanchor" href="javascript:void(0);" onclick="load_individual_dcb_report();"> <i class="fa fa-circle text-default"></i> Individual DCB Report</a></li>
                            <?php } ?>

                        </ul>
                        <?php if (check_permission(520, 1173, 112) || check_permission(520, 1174, 112) || check_permission(520, 1175, 112)) { ?>
                            <h5>WALLET REPORT</h5>
                        <?php } ?>
                        <ul class="category-list" style="padding: 0">
                            <?php if (check_permission(520, 1173, 112)) { ?>
                                <li><a title="Wallet Deposit Report" class="sideanchor" href="javascript:void(0);" onclick="load_wallet_deposit_details();"> <i class="fa fa-circle text-primary"></i> Wallet Deposit Report</a></li>
                            <?php }
                            if (check_permission(520, 1174, 112)) { ?>
                                <li><a title="Wallet Withdraw Report" class="sideanchor" href="javascript:void(0);" onclick="load_wallet_withdraw_details();"> <i class="fa fa-circle text-primary"></i> Wallet Withdraw Report</a></li>
                            <?php }
                            if (check_permission(520, 1175, 112)) { ?>
                                <li><a title="Wallet Account Statement" class="sideanchor" href="javascript:void(0);" onclick="load_wallet_statement_details();"> <i class="fa fa-circle text-primary"></i> Wallet Account Statement</a></li>
                            <?php }
                            if (check_permission(520, 1175, 112)) { ?>
                                <li><a title="Base fee for Educore Access" class="sideanchor" href="javascript:void(0);" onclick="load_base_fee_educore_details();"> <i class="fa fa-circle text-primary"></i> Base fee for Educore Access</a></li>
                            <?php } ?>
                        </ul>
                        <?php if (check_permission(520, 1176, 112)) { ?>
                            <h5>PAYBACK REPORT</h5>
                        <?php } ?>
                        <ul class="category-list" style="padding: 0">
                            <!-- <li><a class="sideanchor" href="javascript:void(0);" onclick="load_online_pay_report();"> <i class="fa fa-circle text-primary"></i>Online Payment summary</a></li> -->
                            <?php if (check_permission(520, 1176, 112)) { ?>
                                <li><a title="Payback summary" class="sideanchor" href="javascript:void(0);" onclick="load_payback_summary_report();"> <i class="fa fa-circle text-danger"></i> Payback summary</a></li>
                            <?php } ?>
                        </ul>
                        <?php if (check_permission(520, 1177, 112) || check_permission(520, 1178, 112) || check_permission(520, 1179, 112) || check_permission(520, 1180, 112) || check_permission(520, 1181, 112)) { ?>

                            <h5>ARREAR REPORT</h5>
                        <?php } ?>
                        <ul class="category-list" style="padding: 0">
                            <?php if (check_permission(520, 1177, 112)) { ?>
                                <li><a title="Arrear List" class="sideanchor" href="javascript:void(0);" onclick="load_arrear_list_show();"> <i class="fa fa-circle text-primary"></i> Arrear List</a></li>
                            <?php }
                            if (check_permission(520, 1178, 112)) { ?>
                                <li><a title="Long Absentee Arrear list" class="sideanchor" href="javascript:void(0);" onclick="load_long_absentee_arrear_list_show();"> <i class="fa fa-circle text-danger"></i> Long Absentee Arrear list</a></li>
                            <?php }
                            if (check_permission(520, 1179, 112)) { ?>
                                <li><a title="Arrear Summary" class="sideanchor" href="javascript:void(0);" onclick="load_arrear_summary(0);"> <i class="fa fa-circle text-info"></i> Arrear Summary</a></li>
                            <?php }
                            if (check_permission(520, 1180, 112)) { ?>
                                <li><a title="Back date arrear summary" class="sideanchor" href="javascript:void(0);" onclick="load_arrear_summary(1);"> <i class="fa fa-circle text-warning"></i> Back date arrear summary</a></li>
                            <?php }
                            if (check_permission(520, 1181, 112)) { ?>
                                <li><a title="Head wise arrear" class="sideanchor" href="javascript:void(0);" onclick="load_head_wise_arrear();"> <i class="fa fa-circle text-primary"></i> Head wise arrear</a></li>
                            <?php } ?>
                        </ul>
                        <!--<h5>CONCESSION / EXCEMPTION REPORT</h5>
                        <ul class="category-list" style="padding: 0">
                            <li><a class="sideanchor" href="javascript:void(0);" onclick="load_under_construction();"> <i class="fa fa-circle text-primary"></i>Excemption list</a></li>
                            <li><a class="sideanchor" href="javascript:void(0);" onclick="load_under_construction();"> <i class="fa fa-circle text-danger"></i>Family Concession list</a></li>                                                     
                        </ul>                        -->
                        <?php if (check_permission(520, 1182, 112) || check_permission(520, 1183, 112) || check_permission(520, 1184, 112) || check_permission(520, 1185, 112)) { ?>
                            <h5>OTHERS</h5>
                        <?php } ?>
                        <ul class="category-list" style="padding: 0">
                            <?php if (check_permission(520, 1182, 112)) { ?>
                                <li><a title="Fee Exemption Report" class="sideanchor" href="javascript:void(0);" onclick="load_fee_exemption_details();"> <i class="fa fa-circle text-primary"></i> Fee Exemption Report</a></li>
                            <?php }
                            if (check_permission(520, 1183, 112)) { ?>
                                <li><a title="Concession Enjoying Students" class="sideanchor" href="javascript:void(0);" onclick="load_concession_students();"> <i class="fa fa-circle text-primary"></i> Concession Enjoying Students</a></li>
                            <?php }
                            if (check_permission(520, 1184, 112)) { ?>
                                <li><a title="Fee Concession Report" class="sideanchor" href="javascript:void(0);" onclick="load_concession_details();"> <i class="fa fa-circle text-primary"></i> Fee Concession Report</a></li>
                            <?php }
                            if (check_permission(520, 1185, 112)) { ?>
                                <li><a title="Transport Due list" class="sideanchor" href="javascript:void(0);" onclick="load_transport_due_list();"> <i class="fa fa-circle text-default"></i> Transport Due list</a></li>
                            <?php }
                            if (check_permission(520, 1233, 112)) { ?>
                                <li><a title="Fee Enable / Disable Details" class="sideanchor" href="javascript:void(0);" onclick="load_fee_deallocated_list();"> <i class="fa fa-circle text-default"></i> Fee Enable / Disable Details</a></li>
                            <?php } ?>
                        </ul>
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
    $('body').on('click', '.sideanchor', function() {
        $('html, body').animate({
            scrollTop: $(".page-heading").offset().top - 50
        }, 1000);
    });

    function load_under_construction() {
        swal('', 'This functionlity is under construction. Please check later!!', 'info');
        return false;
    }


    function load_daily_collection() {
        var ops_url = baseurl + 'fees/preload/show-daily-collection';

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

    function load_regfee_collection() {
        var ops_url = baseurl + 'fees/preload/show-regfee-collection';

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

    function load_base_fee_educore_details() {
        var ops_url = baseurl + 'fees/preload/show_base_fee_educore_details';

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


    function load_received_non_demandables() {
        var ops_url = baseurl + 'fees/preload/show-non-demandables-received';

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

    function load_individual_collection_report() {
        var ops_url = baseurl + 'fees/preload/show-individual-collection';

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

    function load_collection_class_wise_summary() {
        var ops_url = baseurl + 'fees/preload/show-collection-class-wise-summary';

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

    function load_collection_class_wise_details() {
        var ops_url = baseurl + 'fees/preload/show-collection-class-wise-details';

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

    function load_user_collection_details() {
        var ops_url = baseurl + 'fees/preload/show-user-collection-details';

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

    function load_cheque_received_ledger() {
        var ops_url = baseurl + 'fees/preload/show-cheque-received-ledger';

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

    function load_wallet_deposit_details() {
        var ops_url = baseurl + 'fees/preload/show-wallet-deposit-details';

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

    function load_fee_exemption_details() {
        var ops_url = baseurl + 'fees/preload/show_exemption_details';

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

    function load_concession_students() {
        var ops_url = baseurl + 'fees/preload/show_concession_students';

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

    function load_concession_details() {
        var ops_url = baseurl + 'fees/preload/show_concession_details';

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

    function load_transport_due_list() {
        var ops_url = baseurl + 'fees/preload/load_transport_due_list';

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

    function load_fee_deallocated_list() {
        var ops_url = baseurl + 'fees/preload/load_fee_deallocated_list';

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

    function load_wallet_withdraw_details() {
        var ops_url = baseurl + 'fees/preload/show-wallet-withdraw-details';

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

    function load_wallet_statement_details() {
        var ops_url = baseurl + 'fees/preload/show-wallet-statement-details/';

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

    function load_arrear_list_show() {
        var ops_url = baseurl + 'fees/preload/show-report-preload-arrears-list/';

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

    function load_long_absentee_arrear_list_show() {
        var ops_url = baseurl + 'fees/preload/show-report-preload-arrears-longab-list/';

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

    function load_arrear_summary(backdate = 0) {
        var ops_url = baseurl + 'fees/preload/show_arrear_summary/';

        $.ajax({
            type: "POST",
            cache: false,
            async: false,
            url: ops_url,
            data: {
                "load": 1,
                "backdate": backdate
            },
            success: function(result) {
                $('#data-view').html(result);
            }
        });
    }

    function load_head_wise_arrear() {
        var ops_url = baseurl + 'fees/preload/show_head_wise_arrear/';

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

    function load_individual_dcb_report() {
        var ops_url = baseurl + 'fees/preload/show-individual-dcb/';

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

    function load_head_wise_collection_report() {
        var ops_url = baseurl + 'fees/preload/show-headwise-collection-details/';

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

    function load_summary_collection_report() {
        var ops_url = baseurl + 'fees/preload/show-summary-collection-report/';

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

    function load_tax_report() {
        var ops_url = baseurl + 'fees/preload/show_vat_collection_details/';

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

    function load_voucher_cancellation_report() {
        var ops_url = baseurl + 'fees/preload/voucher_cancellation_report/';

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

    function load_dcb_classwise_summary_report() {
        var ops_url = baseurl + 'fees/preload/show-dcb-classwise-summary-report/';

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

    function load_online_pay_report() {
        var ops_url = baseurl + 'fees/preload/show-online-pay-report/';

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

    function load_payback_summary_report() {
        var ops_url = baseurl + 'fees/preload/show-payback-summary-report/';

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