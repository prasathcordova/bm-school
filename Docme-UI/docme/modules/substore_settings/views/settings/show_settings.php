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
                        <a class="btn btn-block btn-primary compose-mail" href="<?php echo base_url('substore/show-bookstore'); ?>">Book store</a>
                        <div class="space-25"></div>
                        <?php
                        if ((check_permission(531) == 1) || (check_permission(532) == 1)) {
                        ?>
                            <h5>Store</h5>
                        <?php
                        }
                        ?>
                        <ul class="category-list" style="padding: 0">
                            <?php
                            if (check_permission(531, 1004)) {
                            ?>
                                <li><a href="javascript:void(0);" onclick="load_classpacking();"> <i class="fa fa-circle text-navy"></i> Student Packing</a></li>
                            <?php
                            }
                            if (check_permission(532, 1005)) {
                            ?>
                                <li><a href="javascript:void(0);" onclick="load_specimenpacking();"> <i class="fa fa-circle text-warning"></i> Specimen Packing</a></li>
                            <?php
                            }
                            ?>
                        </ul>
                        <?php
                        if ((check_permission(533) == 1)) {
                        ?>
                            <h5>Sales</h5>
                        <?php
                        }
                        ?>
                        <ul class="category-list" style="padding: 0">
                            <?php
                            if (check_permission(533)) {
                            ?>
                                <li><a href="javascript:void(0);" onclick="bill_test();"> <i class="fa fa-circle text-warning"></i> Billing</a></li>
                            <?php
                            }
                            ?>
                        </ul>
                        <?php
                        if ((check_permission(534) == 1) || (check_permission(535) == 1) || (check_permission(536) == 1) || (check_permission(537) == 1)) {
                        ?>
                            <h5>Delivery</h5>
                        <?php
                        }
                        ?>
                        <ul class="category-list" style="padding: 0">
                            <!--<li><a href="javascript:void(0);" onclick="load_delivery();"> <i class="fa fa-circle text-navy"></i> Delivery </a></li>-->
                            <?php
                            if (check_permission(534)) {
                            ?>
                                <li><a href="javascript:void(0);" onclick="delivery_student();"> <i class="fa fa-circle text-navy"></i> Delivery </a></li>
                            <?php
                            }
                            if (check_permission(534)) {
                            ?>
                                <li><a href="javascript:void(0);" onclick="online_billed_order();"> <i class="fa fa-circle text-navy"></i> Online Billed Order </a></li>
                            <?php
                            }
                            if (check_permission(535)) {
                            ?>
                                <li><a href="javascript:void(0);" onclick="deliveryreturn();"> <i class="fa fa-circle text-warning"></i> Delivery Return </a></li>
                            <?php
                            }

                            if (check_permission(536)) {
                            ?>
                                <li><a href="javascript:void(0);" onclick="specimen_delivery();"> <i class="fa fa-circle text-navy"></i> Specimen Delivery </a></li>
                            <?php
                            }

                            if (check_permission(537)) {
                            ?>
                                <li><a href="javascript:void(0);" onclick="specimen_return();"> <i class="fa fa-circle text-warning"></i> Specimen Return </a></li>
                            <?php
                            }
                            ?>
                        </ul>
                        <?php
                        if ((check_permission(538) == 1) || (check_permission(539) == 1) || (check_permission(540) == 1)) {
                        ?>
                            <h5>Open House</h5>
                        <?php
                        }
                        ?>
                        <ul class="category-list" style="padding: 0">
                            <?php
                            if (check_permission(538)) {
                            ?>
                                <li><a href="javascript:void(0);" onclick="load_ohtemplate();"> <i class="fa fa-circle text-navy"></i> OH Template </a></li>
                            <?php
                            }

                            if (check_permission(539)) {
                            ?>
                                <li><a href="javascript:void(0);" onclick="load_ohitempacking();"> <i class="fa fa-circle text-navy"></i> OH Item Assigning </a></li>
                            <?php
                            }

                            if (check_permission(540, 1018) || check_permission(540, 1019) || check_permission(540, 1020) || check_permission(540, 1021) || check_permission(540, 1022)) {
                            ?>
                                <li><a href="javascript:void(0);" onclick="load_openhouse();"> <i class="fa fa-circle text-warning"></i> Open House </a></li>
                            <?php
                            }

                            if (check_permission(540, 1023)) {
                            ?>
                                <li><a href="javascript:void(0);" onclick="load_ohitemgroupissue();"> <i class="fa fa-circle text-warning"></i> OH Student Assigning </a></li>
                            <?php
                            }

                            if (check_permission(540, 1025)) {
                            ?>
                                <li><a href="javascript:void(0);" onclick="remove_student_allotment();"> <i class="fa fa-circle text-warning"></i> OH Student De-Allocation </a></li>
                            <?php
                            }

                            if (check_permission(540, 1027)) {
                            ?>
                                <li><a href="javascript:void(0);" onclick="view_student_allotment();"> <i class="fa fa-circle text-warning"></i> OH Student List </a></li>
                            <?php
                            }
                            ?>
                        </ul>
                        <?php
                        if ((check_permission(541) == 1) || (check_permission(542) == 1)) {
                        ?>
                            <h5>Stock Manager</h5>
                        <?php
                        }
                        ?>
                        <ul class="category-list" style="padding: 0">
                            <?php
                            if (check_permission(541)) {
                            ?>
                                <li><a href="javascript:void(0);" onclick="stock_allotment_list();"> <i class="fa fa-circle text-primary"></i> Stock Allotment(From Main Store) </a></li>

                            <?php
                            }

                            if (check_permission(541)) {
                            ?>
                                <li><a href="javascript:void(0);" onclick="stock_allotment_Outword();"> <i class="fa fa-circle text-primary"></i> Stock Allotment(To Main Store) </a></li>
                            <?php
                            }

                            if (check_permission(542)) {
                            ?>
                                <li><a href="javascript:void(0);" onclick="livestock();"> <i class="fa fa-circle text-warning"></i> Stock</a></li>
                            <?php
                            }
                            ?>
                        </ul>
                        <?php
                        if ((check_permission(533) == 1)) {
                        ?>
                            <h5>Reports</h5>
                        <?php
                        }
                        ?>
                        <ul class="category-list" style="padding: 0">
                            <?php
                            if (check_permission(543, 1032)) {
                            ?>

                                <li><a href="javascript:void(0);" onclick="load_return_rpt();"> <i class="fa fa-circle text-navy"></i> Sales Return Report</a></li>
                            <?php
                            }

                            if (check_permission(543, 1033)) {
                            ?>
                                <li><a href="javascript:void(0);" onclick="load_sale_rpt();"> <i class="fa fa-circle text-navy"></i> Sales Report - Voucher wise</a></li>
                            <?php
                            }

                            if (check_permission(543, 1034)) {
                            ?>
                                <li><a href="javascript:void(0);" onclick="load_sale_item_rpt();"> <i class="fa fa-circle text-navy"></i> Sales Report - Item wise</a></li>
                            <?php
                            }

                            if (check_permission(543, 1035)) {
                            ?>
                                <li><a href="javascript:void(0);" onclick="load_sale_item_summary_rpt();"> <i class="fa fa-circle text-navy"></i> Item wise sale summary report</a></li>
                            <?php
                            }

                            if (check_permission(543, 1036)) {
                            ?>
                                <li><a href="javascript:void(0);" onclick="load_billed_not_delivered_rpt();"> <i class="fa fa-circle text-navy"></i> Billed but not delivered report</a></li>

                            <?php
                            }

                            if (check_permission(543, 1037)) {
                            ?>
                                <li><a href="javascript:void(0);" onclick="load_partial_collection_rpt();"> <i class="fa fa-circle text-navy"></i> Partial Collection report</a></li>
                            <?php
                            }
                            if (check_permission(543, 1037)) {
                            ?>
                                <li><a href="javascript:void(0);" onclick="load_collection_rpt();"> <i class="fa fa-circle text-navy"></i> Collection report</a></li>
                            <?php
                            }

                            if (check_permission(543, 1038)) {
                            ?>
                                <li><a href="javascript:void(0);" onclick="load_collection_userwise_rpt();"> <i class="fa fa-circle text-navy"></i> Collection report - user wise</a></li>
                            <?php
                            } ?>
                            <?php if (check_permission(543, 1079)) {
                            ?>
                                <li><a href="javascript:void(0);" onclick="load_summary_collection_userwise_rpt();"> <i class="fa fa-circle text-danger"></i> Summary collection report - user wise</a></li>
                            <?php
                            } ?>

                            <?php if (check_permission(543, 1039)) {
                            ?>
                                <li><a href="javascript:void(0);" onclick="load_stock_detail_report();"> <i class="fa fa-circle text-warning"></i> Detailed Stock Report</a></li>
                            <?php
                            }

                            if (check_permission(543, 1040)) {
                            ?>
                                <li><a href="javascript:void(0);" onclick="load_stock_summary_report();"> <i class="fa fa-circle text-warning"></i> Stock Summary Report</a></li>
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
    load_graph();

    function delivery_student() {
        var ops_url = baseurl + 'sales/substore-delivery-student/';
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

    function online_billed_order() {
        var ops_url = baseurl + 'sales/substore-online-billing-order/';
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

    function load_graph() {
        var ops_url = baseurl + 'initial/show-chart/';
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


    function load_supplier() {
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


                function activateSwitchery() {
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

    function load_student_sale() {
        var ops_url = baseurl + 'sales/student-live-sale/';
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

    function deliveryreturn() {
        var ops_url = baseurl + 'sales/search-delivery-return/';
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

    function specimen_return() {
        var ops_url = baseurl + 'sales/search-specimen-return/';
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
    //   function deliveryreturn() {
    //        var ops_url = baseurl + 'sales/student-delivery-return/';
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
    function load_employee_sales() {
        var ops_url = baseurl + 'sales/employee-live-sale/';
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

    function load_specimen_issue() {
        var ops_url = baseurl + 'itempacking/search-emp-advanced/';
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

    function load_items_list() {
        var ops_url = baseurl + 'substore/items-list/';
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

    function load_sale() {
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

    function load_ohtemplate() {
        var ops_url = baseurl + 'substore/show-ohtemplate/';
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

    function specimen_delivery() {
        var ops_url = baseurl + 'sales/substore-delivery-faculty/';
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

    function load_openhouse() {
        var ops_url = baseurl + 'substore/list-openhouse/';
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

    function load_template() {
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

    function load_opening_stock() {
        var ops_url = baseurl + 'substore/item-delivery-return/';
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

    function load_transfer_rqst() {
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

    function stocktransfer_list() {
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

    function stocktransfer() {
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

    function livestock() {
        var ops_url = baseurl + 'stock/stock-status/';
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

    function student_bill() {
        var ops_url = baseurl + 'substore/bill-student/';
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

    function employee_bill() {
        var ops_url = baseurl + 'substore/bill-employee/';
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

    function bill_history() {
        var ops_url = baseurl + 'substore/bill-history/';
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

    function bill_test() {
        var ops_url = baseurl + 'substore/bill-test/';
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

    function load_ohitempacking() {
        var ops_url = baseurl + 'substore/item-ohpacking/';
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

    function load_batchpacking() {
        var ops_url = baseurl + 'substore/item-batchpacking/';
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

    function load_classpacking() {
        var ops_url = baseurl + 'substore/item-classpacking/';
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

    function load_specimenpacking() {
        var ops_url = baseurl + 'substore/item-specimenpacking/';
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

    function load_ohitemissue() {
        var ops_url = baseurl + 'substore/item-ohissue/';
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

    function load_ohitemgroupissue() {
        var ops_url = baseurl + 'substore/item-templatepack/';
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

    function load_specimen_issue() {
        var ops_url = baseurl + 'substore/specimen-issue/';
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

    function item_packing_sale() {
        var ops_url = baseurl + 'substore/item-packing/';
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

    function individual_loose_pack() {
        var ops_url = baseurl + 'substore/item-individualpacking/';
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

    function load_delivery() {
        var ops_url = baseurl + 'substore/item-delivery/';
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

    function load_itemadd() {
        var ops_url = baseurl + 'substore/item-add/';
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



    function create_template() {
        var ops_url = baseurl + 'oh/create-ohtemplate';
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

    function stock_allotment_list() {
        var ops_url = baseurl + 'stock/allot-list/';
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


    function load_return_rpt() {
        var ops_url = baseurl + 'substore-report/sale-return-pre-load/';
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

    function load_sale_rpt() {
        var ops_url = baseurl + 'substore-report/sale-pre-load/';
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

    function load_sale_item_rpt() {
        var ops_url = baseurl + 'substore-report/sale-itemwise-pre-load/';
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

    function load_sale_item_summary_rpt() {
        var ops_url = baseurl + 'substore-report/sale-itemwise-summary-pre-load/';
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

    function load_billed_not_delivered_rpt() {
        var ops_url = baseurl + 'substore-report/bbnd-pre-load/';
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

    function load_partial_collection_rpt() {
        var ops_url = baseurl + 'substore-report/partial-collection-load/';
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

    function load_collection_rpt() {
        var ops_url = baseurl + 'substore-report/collection-load/';
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

    function load_collection_userwise_rpt() {
        var ops_url = baseurl + 'substore-report/collection-userwise-load/';
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

    function load_summary_collection_userwise_rpt() {
        var ops_url = baseurl + 'substore-report/Summary-collection-userwise-load/';
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

    function load_stock_detail_report() {
        var ops_url = baseurl + 'report/stock-detail/';
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

    function load_stock_summary_report() {
        var ops_url = baseurl + 'report/stock-summary/';
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


    function remove_student_allotment() {
        var ops_url = baseurl + 'substore/openhouse-change/';
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

    function stock_allotment_Outword() {
        var ops_url = baseurl + 'stock/allot-list_out/';
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

    function view_student_allotment() {
        var ops_url = baseurl + 'substore/openhouse-view/';
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