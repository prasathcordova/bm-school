<link href="<?php echo base_url('assets/theme/plugins/select2/select2.css'); ?>" rel="stylesheet">
<link href="<?php echo base_url('assets/theme/plugins/select2/select2-bootstrap.css'); ?>" rel="stylesheet">
<!-- Select2 -->
<script src="<?php echo base_url('assets/theme/js/plugins/select2/select2.full.min.js'); ?>"></script>

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
                        <a class="btn btn-block btn-primary compose-mail" href="<?php echo base_url('uniform/substore/show-store'); ?>">Uniform store</a>
                        <div class="space-25"></div>
                        <?php
                        if ((check_permission(545) == 1) || (check_permission(546) == 1)) {
                        ?>
                            <h5>Store</h5>
                        <?php
                        }
                        ?>
                        <ul class="category-list" style="padding: 0">
                            <?php
                            if (check_permission(545, 1042)) {
                            ?>
                                <li><a href="javascript:void(0);" onclick="uniform_load_classpacking();"> <i class="fa fa-circle text-navy"></i> Student Packing</a></li>
                            <?php
                            }
                            if (check_permission(546, 1043)) {
                            ?>
                                <li><a href="javascript:void(0);" onclick="uniform_load_specimenpacking();"> <i class="fa fa-circle text-warning"></i> Specimen Packing</a></li>
                            <?php
                            }
                            ?>
                        </ul>
                        <?php
                        if ((check_permission(547) == 1)) {
                        ?>
                            <h5>Sales</h5>
                        <?php
                        }
                        ?>
                        <ul class="category-list" style="padding: 0">
                            <?php
                            if (check_permission(547)) {
                            ?>
                                <li><a href="javascript:void(0);" onclick="uniform_bill_test();"> <i class="fa fa-circle text-warning"></i> Billing</a></li>
                            <?php
                            }
                            ?>
                        </ul>
                        <?php
                        if ((check_permission(548) == 1) || (check_permission(549) == 1) || (check_permission(550) == 1) || (check_permission(551) == 1)) {
                        ?>
                            <h5>Delivery</h5>
                        <?php
                        }
                        ?>
                        <ul class="category-list" style="padding: 0">
                            <!--<li><a href="javascript:void(0);" onclick="uniform_load_delivery();"> <i class="fa fa-circle text-navy"></i> Delivery </a></li>-->
                            <?php
                            if (check_permission(548)) {
                            ?>
                                <li><a href="javascript:void(0);" onclick="uniform_delivery_student();"> <i class="fa fa-circle text-navy"></i> Delivery </a></li>

                            <?php
                            }
                            if (check_permission(548)) {
                            ?>
                                <li><a href="javascript:void(0);" onclick="uniform_online_billed_order();"> <i class="fa fa-circle text-navy"></i> Online Billed Order </a></li>
                            <?php
                            }
                            if (check_permission(549)) {
                            ?>
                                <li><a href="javascript:void(0);" onclick="uniform_deliveryreturn();"> <i class="fa fa-circle text-warning"></i> Delivery Return </a></li>
                            <?php
                            }

                            if (check_permission(550)) {
                            ?>
                                <li><a href="javascript:void(0);" onclick="uniform_specimen_delivery();"> <i class="fa fa-circle text-navy"></i> Specimen Delivery </a></li>
                            <?php
                            }

                            if (check_permission(551)) {
                            ?>
                                <li><a href="javascript:void(0);" onclick="uniform_specimen_return();"> <i class="fa fa-circle text-warning"></i> Specimen Return </a></li>
                            <?php
                            }
                            ?>
                        </ul>
                        <?php
                        if ((check_permission(552) == 1) || (check_permission(553) == 1) || (check_permission(554) == 1)) {
                        ?>
                            <h5>Open House</h5>
                        <?php
                        }
                        ?>
                        <ul class="category-list" style="padding: 0">
                            <?php
                            if (check_permission(552)) {
                            ?>
                                <li><a href="javascript:void(0);" onclick="uniform_load_ohtemplate();"> <i class="fa fa-circle text-navy"></i> OH Template </a></li>
                            <?php
                            }

                            if (check_permission(553)) {
                            ?>
                                <li><a href="javascript:void(0);" onclick="uniform_load_ohitempacking();"> <i class="fa fa-circle text-navy"></i> OH Item Assigning </a></li>
                            <?php
                            }

                            if (check_permission(554, 1056) || check_permission(540, 1057) || check_permission(540, 1058) || check_permission(540, 1059) || check_permission(540, 1060)) {
                            ?>
                                <li><a href="javascript:void(0);" onclick="uniform_load_openhouse();"> <i class="fa fa-circle text-warning"></i> Open House </a></li>
                            <?php
                            }

                            if (check_permission(554, 1061)) {
                            ?>
                                <li><a href="javascript:void(0);" onclick="uniform_load_ohitemgroupissue();"> <i class="fa fa-circle text-warning"></i> OH Student Assigning </a></li>
                            <?php
                            }

                            if (check_permission(554, 1063)) {
                            ?>
                                <li><a href="javascript:void(0);" onclick="uniform_remove_student_allotment();"> <i class="fa fa-circle text-warning"></i> OH Student De-Allocation </a></li>
                            <?php
                            }

                            if (check_permission(554, 1065)) {
                            ?>
                                <li><a href="javascript:void(0);" onclick="uniform_view_student_allotment();"> <i class="fa fa-circle text-warning"></i> OH Student List </a></li>
                            <?php
                            }
                            ?>
                        </ul>
                        <?php
                        if ((check_permission(555) == 1) || (check_permission(556) == 1)) {
                        ?>
                            <h5>Stock Manager</h5>
                        <?php
                        }
                        ?>
                        <ul class="category-list" style="padding: 0">
                            <?php
                            if (check_permission(555)) {
                            ?>
                                <li><a href="javascript:void(0);" onclick="uniform_stock_allotment_list();"> <i class="fa fa-circle text-primary"></i> Stock Allotment(From Main Store) </a></li>

                            <?php
                            }

                            if (check_permission(555)) {
                            ?>
                                <li><a href="javascript:void(0);" onclick="uniform_stock_allotment_Outword();"> <i class="fa fa-circle text-primary"></i> Stock Allotment(To Main Store) </a></li>
                            <?php
                            }

                            if (check_permission(556)) {
                            ?>
                                <li><a href="javascript:void(0);" onclick="uniform_livestock();"> <i class="fa fa-circle text-warning"></i> Stock</a></li>
                            <?php
                            }
                            ?>
                        </ul>
                        <?php
                        if ((check_permission(557) == 1)) {
                        ?>
                            <h5>Reports</h5>
                        <?php
                        }
                        ?>
                        <ul class="category-list" style="padding: 0">
                            <?php
                            if (check_permission(557, 1070)) {
                            ?>

                                <li><a href="javascript:void(0);" onclick="uniform_load_return_rpt();"> <i class="fa fa-circle text-navy"></i> Sales Return Report</a></li>
                            <?php
                            }

                            if (check_permission(557, 1071)) {
                            ?>
                                <li><a href="javascript:void(0);" onclick="uniform_load_sale_rpt();"> <i class="fa fa-circle text-navy"></i> Sales Report - Voucher wise</a></li>
                            <?php
                            }

                            if (check_permission(557, 1072)) {
                            ?>
                                <li><a href="javascript:void(0);" onclick="uniform_load_sale_item_rpt();"> <i class="fa fa-circle text-navy"></i> Sales Report - Item wise</a></li>
                            <?php
                            }

                            if (check_permission(557, 1073)) {
                            ?>
                                <li><a href="javascript:void(0);" onclick="uniform_load_sale_item_summary_rpt();"> <i class="fa fa-circle text-navy"></i> Item wise sale summary report</a></li>
                            <?php
                            }

                            if (check_permission(557, 1074)) {
                            ?>
                                <li><a href="javascript:void(0);" onclick="uniform_load_billed_not_delivered_rpt();"> <i class="fa fa-circle text-navy"></i> Billed but not delivered report</a></li>

                            <?php
                            }
                            if (check_permission(557, 1037)) {
                            ?>
                                <li><a href="javascript:void(0);" onclick="uniform_load_partial_collection_rpt();"> <i class="fa fa-circle text-navy"></i> Partial Collection report</a></li>
                            <?php
                            }
                            if (check_permission(557, 1075)) {
                            ?>
                                <li><a href="javascript:void(0);" onclick="uniform_load_collection_rpt();"> <i class="fa fa-circle text-navy"></i> Collection report</a></li>
                            <?php
                            }

                            if (check_permission(557, 1076)) {
                            ?>
                                <li><a href="javascript:void(0);" onclick="uniform_load_collection_userwise_rpt();"> <i class="fa fa-circle text-navy"></i> Collection report - user wise</a></li>
                            <?php
                            }

                            if (check_permission(557, 1078)) {
                            ?>
                                <li><a href="javascript:void(0);" onclick="uniform_load_summary_collection_userwise_rpt();"> <i class="fa fa-circle text-navy"></i> Summary collection report - user wise</a></li>
                            <?php
                            }

                            if (check_permission(557, 1077)) {
                            ?>
                                <li><a href="javascript:void(0);" onclick="uniform_load_stock_detail_report();"> <i class="fa fa-circle text-warning"></i> Detailed Stock Report</a></li>
                            <?php
                            }

                            if (check_permission(557, 1078)) {
                            ?>
                                <li><a href="javascript:void(0);" onclick="uniform_load_stock_summary_report();"> <i class="fa fa-circle text-warning"></i> Stock Summary Report</a></li>
                            <?php
                            }
                            ?>
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
    uniform_load_graph();

    function uniform_delivery_student() {
        var ops_url = baseurl + 'uniform/sales/substore-delivery-student/';
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
                $('html, body').stop().animate({
                    scrollTop: $($('.ibox-content')).offset().top - 55
                }, 500);
            }
        });
    }

    function uniform_online_billed_order() {
        var ops_url = baseurl + 'uniform/sales/substore-online-billing-order/';
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
                $('html, body').stop().animate({
                    scrollTop: $($('.ibox-content')).offset().top - 55
                }, 500);
            }
        });
    }

    function uniform_simpleLoad(btn, state) {
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

    function uniform_load_graph() {
        var ops_url = baseurl + 'uniform/initial/show-chart/';
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


    function uniform_load_supplier() {
        var ops_url = baseurl + 'supplier/show-supplier/';
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
                var list_switchery = [];
                $('#tbl_supplier').dataTable({
                    columnDefs: [{
                            "width": "16%",
                            className: "capitalize",
                            "targets": 0
                        },
                        {
                            "width": "16%",
                            className: "capitalize",
                            "targets": 1
                        },
                        {
                            "width": "16%",
                            className: "capitalize",
                            "targets": 2
                        },
                        {
                            "width": "16%",
                            className: "capitalize",
                            "targets": 3
                        },
                        {
                            "width": "16%",
                            className: "capitalize",
                            "targets": 3
                        },
                        {
                            "width": "10%",
                            className: "capitalize",
                            "targets": 3
                        },
                        {
                            "width": "10%",
                            className: "capitalize",
                            "targets": 4,
                            "orderable": false
                        }
                    ],
                    responsive: true,
                    iDisplayLength: 10,
                    dom: '<"html5buttons"B>lTfgitp',
                    buttons: [{
                            extend: 'copy'
                        },
                        {
                            extend: 'csv'
                        },
                        {
                            extend: 'excel',
                            title: 'Report'
                        }
                    ],
                    "fnDrawCallback": function(ele) {
                        activateSwitchery();
                    }
                });


                function uniform_activateSwitchery() {
                    for (var i = 0; i < list_switchery.length; i++) {
                        list_switchery[i].destroy();
                        list_switchery[i].switcher.remove();
                    }
                    var list_checkbox = Array.prototype.slice.call(document.querySelectorAll('.js-switch'));
                    list_checkbox.forEach(function(html) {
                        var switchery = new Switchery(html, {
                            color: '#23C6C8',
                            secondaryColor: '#F8AC59',
                            size: 'small'
                        });
                        //        var switchery = new Switchery(html, {color: '#a9318a', size: 'small'});
                        list_switchery.push(switchery);
                    });
                }
            }
        });

    }

    function uniform_load_student_sale() {
        var ops_url = baseurl + 'uniform/sales/student-live-sale/';
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

    function uniform_deliveryreturn() {
        var ops_url = baseurl + 'uniform/sales/search-delivery-return/';
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
                $('html, body').stop().animate({
                    scrollTop: $($('.ibox-content')).offset().top - 55
                }, 500);
            }
        });
    }

    function uniform_specimen_return() {
        var ops_url = baseurl + 'uniform/sales/search-specimen-return/';
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
                $('html, body').stop().animate({
                    scrollTop: $($('.ibox-content')).offset().top - 55
                }, 500);
            }
        });
    }
    //   function uniform_deliveryreturn() {
    //        var ops_url = baseurl + 'uniform/sales/student-delivery-return/';
    //        $.ajax({
    //            type: "POST",
    //            cache: false,
    //            async: false,
    //            url: ops_url,
    //            data: {"load": 1},
    //            success: function (result) {
    //                $('#data-view').html(result);
    //            }
    //        });
    //    }
    function uniform_load_employee_sales() {
        var ops_url = baseurl + 'uniform/sales/employee-live-sale/';
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

    function uniform_load_specimen_issue() {
        var ops_url = baseurl + 'uniform/itempacking/search-emp-advanced/';
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

    function uniform_load_items_list() {
        var ops_url = baseurl + 'uniform/substore/items-list/';
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

    function uniform_load_sale() {
        var ops_url = baseurl + 'sale/student-filter/';
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

                $(".select2_acdyear").select2({
                    placeholder: "Academic Year",
                    "theme": "bootstrap"
                });
                $(".select2_session").select2({
                    placeholder: "Session",
                    "theme": "bootstrap"
                });
                $(".select2_stream").select2({
                    placeholder: "Stream",
                    "theme": "bootstrap"
                });

            }
        });
    }

    function uniform_load_ohtemplate() {
        var ops_url = baseurl + 'uniform/substore/show-ohtemplate/';
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
                $('html, body').stop().animate({
                    scrollTop: $($('.ibox-content')).offset().top - 55
                }, 500);
            }
        });
    }

    function uniform_specimen_delivery() {
        var ops_url = baseurl + 'uniform/sales/substore-delivery-faculty/';
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
                $('html, body').stop().animate({
                    scrollTop: $($('.ibox-content')).offset().top - 55
                }, 500);
            }
        });
    }

    function uniform_load_openhouse() {
        var ops_url = baseurl + 'uniform/substore/list-openhouse/';
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
                $('html, body').stop().animate({
                    scrollTop: $($('.ibox-content')).offset().top - 55
                }, 500);
            }
        });
    }

    function uniform_load_template() {
        var ops_url = baseurl + 'key/show-key/';
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

    function uniform_load_opening_stock() {
        var ops_url = baseurl + 'uniform/substore/item-delivery-return/';
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

    function uniform_load_transfer_rqst() {
        var ops_url = baseurl + 'substock/stocktransferintend/';
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
                $('#select2_demo_1').select2({
                    "theme": "bootstrap"
                });
            }
        });

    }

    function uniform_stocktransfer_list() {
        var ops_url = baseurl + 'stock/stocktransferissue/';
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

    function uniform_stocktransfer() {
        var ops_url = baseurl + 'stock/stocktransferrecieve/';
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

    function uniform_livestock() {
        var ops_url = baseurl + 'uniform/stock/stock-status/';
        $.ajax({
            type: "POST",
            cache: false,
            async: false,
            url: ops_url,
            data: {
                "load": 1
            },
            success: function(result) {
                var data = JSON.parse(result);
                if (data.status == 1) {
                    $('#data-view').html(data.view);
                    $('html, body').stop().animate({
                        scrollTop: $($('.ibox-content')).offset().top - 55
                    }, 500);
                } else {
                    swal('', 'Stock info not available now. Please try again later', 'info');
                }
            }
        });
    }

    function uniform_student_bill() {
        var ops_url = baseurl + 'uniform/substore/bill-student/';
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

    function uniform_employee_bill() {
        var ops_url = baseurl + 'uniform/substore/bill-employee/';
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

    function uniform_bill_history() {
        var ops_url = baseurl + 'uniform/substore/bill-history/';
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

    function uniform_bill_test() {
        var ops_url = baseurl + 'uniform/substore/bill-test/';
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

    function uniform_load_ohitempacking() {
        var ops_url = baseurl + 'uniform/substore/item-ohpacking/';
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
                $('html, body').stop().animate({
                    scrollTop: $($('.ibox-content')).offset().top - 55
                }, 500);
            }
        });
    }

    function uniform_load_batchpacking() {
        var ops_url = baseurl + 'uniform/substore/item-batchpacking/';
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

    function uniform_load_classpacking() {
        var ops_url = baseurl + 'uniform/substore/item-classpacking/';
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
                $('html, body').stop().animate({
                    scrollTop: $($('.ibox-content')).offset().top - 55
                }, 500);
            }
        });
    }

    function uniform_load_specimenpacking() {
        var ops_url = baseurl + 'uniform/substore/item-specimenpacking/';
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
                $('html, body').stop().animate({
                    scrollTop: $($('.ibox-content')).offset().top - 55
                }, 500);
            }
        });
    }

    function uniform_load_ohitemissue() {
        var ops_url = baseurl + 'uniform/substore/item-ohissue/';
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

    function uniform_load_ohitemgroupissue() {
        var ops_url = baseurl + 'uniform/substore/item-templatepack/';
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
                $('html, body').stop().animate({
                    scrollTop: $($('.ibox-content')).offset().top - 55
                }, 500);
            }
        });
    }

    function uniform_load_specimen_issue() {
        var ops_url = baseurl + 'uniform/substore/show-sale/';
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

    function uniform_item_packing_sale() {
        var ops_url = baseurl + 'uniform/substore/item-packing/';
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

    function uniform_individual_loose_pack() {
        var ops_url = baseurl + 'uniform/substore/item-individualpacking/';
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

    function uniform_load_delivery() {
        var ops_url = baseurl + 'uniform/substore/item-delivery/';
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

    function uniform_load_itemadd() {
        var ops_url = baseurl + 'uniform/substore/item-add/';
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



    function uniform_create_template() {
        var ops_url = baseurl + 'uniform/oh/create-ohtemplate';
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

    function uniform_stock_allotment_list() {
        var ops_url = baseurl + 'uniform/stock/allot-list/';
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
                $('html, body').stop().animate({
                    scrollTop: $($('.ibox-content')).offset().top - 55
                }, 500);
            }
        });
    }


    function uniform_load_return_rpt() {
        var ops_url = baseurl + 'uniform/substore-report/sale-return-pre-load/';
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
                $('html, body').stop().animate({
                    scrollTop: $($('.ibox-content')).offset().top - 55
                }, 500);
            }
        });
    }

    function uniform_load_sale_rpt() {
        var ops_url = baseurl + 'uniform/substore-report/sale-pre-load/';
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
                $('html, body').stop().animate({
                    scrollTop: $($('.ibox-content')).offset().top - 55
                }, 500);
            }
        });
    }

    function uniform_load_sale_item_rpt() {
        var ops_url = baseurl + 'uniform/substore-report/sale-itemwise-pre-load/';
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
                $('html, body').stop().animate({
                    scrollTop: $($('.ibox-content')).offset().top - 55
                }, 500);
            }
        });
    }

    function uniform_load_sale_item_summary_rpt() {
        var ops_url = baseurl + 'uniform/substore-report/sale-itemwise-summary-pre-load/';
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
                $('html, body').stop().animate({
                    scrollTop: $($('.ibox-content')).offset().top - 55
                }, 500);
            }
        });
    }

    function uniform_load_billed_not_delivered_rpt() {
        var ops_url = baseurl + 'uniform/substore-report/bbnd-pre-load/';
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
                $('html, body').stop().animate({
                    scrollTop: $($('.ibox-content')).offset().top - 55
                }, 500);
            }
        });
    }


    function uniform_load_partial_collection_rpt() {
        var ops_url = baseurl + 'uniform/substore-report/partial-collection-load/';
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
                $('html, body').stop().animate({
                    scrollTop: $($('.ibox-content')).offset().top - 55
                }, 500);
            }
        });
    }

    function uniform_load_collection_rpt() {
        var ops_url = baseurl + 'uniform/substore-report/collection-load/';
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
                $('html, body').stop().animate({
                    scrollTop: $($('.ibox-content')).offset().top - 55
                }, 500);
            }
        });
    }

    function uniform_load_collection_userwise_rpt() {
        var ops_url = baseurl + 'uniform/substore-report/collection-userwise-load/';
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
                $('html, body').stop().animate({
                    scrollTop: $($('.ibox-content')).offset().top - 55
                }, 500);
            }
        });

    }

    function uniform_load_summary_collection_userwise_rpt() {
        var ops_url = baseurl + 'uniform/substore-report/summary-collection-userwise-load/';
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
                $('html, body').stop().animate({
                    scrollTop: $($('.ibox-content')).offset().top - 55
                }, 500);
            }
        });
    }

    function uniform_load_stock_detail_report() {
        var ops_url = baseurl + 'uniform/report/stock-detail/';
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
                $('html, body').stop().animate({
                    scrollTop: $($('.ibox-content')).offset().top - 55
                }, 500);
            }
        });
    }

    function uniform_load_stock_summary_report() {
        var ops_url = baseurl + 'uniform/report/stock-summary/';
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
                $('html, body').stop().animate({
                    scrollTop: $($('.ibox-content')).offset().top - 55
                }, 500);
            }
        });
    }


    function uniform_remove_student_allotment() {
        var ops_url = baseurl + 'uniform/substore/openhouse-change/';
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
                $('html, body').stop().animate({
                    scrollTop: $($('.ibox-content')).offset().top - 55
                }, 500);
            }
        });
    }

    function uniform_stock_allotment_Outword() {
        var ops_url = baseurl + 'uniform/stock/allot-list_out/';
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
                $('html, body').stop().animate({
                    scrollTop: $($('.ibox-content')).offset().top - 55
                }, 500);
            }
        });
    }

    function uniform_view_student_allotment() {
        var ops_url = baseurl + 'uniform/substore/openhouse-view/';
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
                $('html, body').stop().animate({
                    scrollTop: $($('.ibox-content')).offset().top - 55
                }, 500);
            }
        });
    }
</script>