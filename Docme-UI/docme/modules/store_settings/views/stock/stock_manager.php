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
                        <a class="btn btn-block btn-primary compose-mail" href="javascript:void(0)" onclick="load_purchase()" >Stock Management</a>
                        <div class="space-25"></div>
                        <h5>Purchase Manager</h5>

                        <ul class="category-list" style="padding: 0">
                            <li><a href="javascript:void(0);" onclick="load_purchase();"> <i class="fa fa-circle text-warning"></i> Purchase </a></li>
                            <!--<li><a href="javascript:void(0);" onclick="load_directpurchase();"> <i class="fa fa-circle text-primary"></i>New Direct Purchase  <span class="label label-warning pull-right">16</span> </a></li>-->
                            <!--<li><a href="javascript:void(0);" onclick="load_purchaseorder();"> <i class="fa fa-circle text-info"></i>New Purchase Order  <span class="label label-info pull-right">16</span> </a></li>-->
                            <li><a href="javascript:void(0);" onclick="purchase_return();"> <i class="fa fa-circle text-danger"></i> Purchase Return  </a></li>
                            <!--<li><a href="javascript:void(0);" onclick="return_request();"> <i class="fa fa-circle text-danger"></i> Purchase Return Request<span class="label label-danger pull-right">16</span> </a></li>-->
                            <!--<li><a href="javascript:void(0);" onclick="purchaseorder_recieve();"> <i class="fa fa-circle text-danger"></i> Purchase Order Recieve<span class="label label-danger pull-right">16</span> </a></li>-->
                            <!--<li><a href="javascript:void(0);" onclick="load_purchaseorderapproval();"> <i class="fa fa-circle text-warning"></i> Purchase Return Approval-->


<!--<li><a href="<?php // echo base_url('course/batch-allocate');           ?>"> <i class="fa fa-circle text-warning"></i> District-->                                     
                        </ul>
                        <!--                        <h5>Stock Transfer</h5>
                                                <ul class="category-list" style="padding: 0">
                                                    <li><a href="javascript:void(0);" onclick="load_religion();"> <i class="fa fa-circle text-navy"></i> Item Transfer <span class="label label-warning pull-right">16</span> </a></li>
                                                    <li><a href="javascript:void(0);" onclick="load_transferintend();"> <i class="fa fa-circle text-primary"></i> Stock Transfer-Intend <span class="label label-info pull-right">2</span> </a></li>
                                                    <li><a href="javascript:void(0);" onclick="stocktransfer_issue();"> <i class="fa fa-circle text-primary"></i> Stock Transfer-Issue <span class="label label-danger pull-right">2</span> </a></li>
                                                    <li><a href="javascript:void(0);" onclick="stocktransfer_recieve();"> <i class="fa fa-circle text-primary"></i> Stock Transfer-Recieve <span class="label label-warning pull-right">2</span> </a></li>
                        
                                                </ul>-->
                        <h5>Stock Manager</h5>
                        <ul class="category-list" style="padding: 0">
                            <li><a href="javascript:void(0);" onclick="load_rate();"> <i class="fa fa-circle text-warning"></i> Rates </a></li> 
                            <li><a href="javascript:void(0);" onclick="load_allotment();"> <i class="fa fa-circle text-primary"></i> Stock Allotment </a></li>
                            <li><a href="javascript:void(0);" onclick="load_opening_stock();"> <i class="fa fa-circle text-navy"></i> Opening Stock </a></li>
                            <li><a href="javascript:void(0);" onclick="load_item_stock();"> <i class="fa fa-circle text-navy"></i> Stock </a></li>
                        </ul>
                        <h5>Reports</h5>
                        <ul class="category-list" style="padding: 0">
                            <li><a href="javascript:void(0);" onclick="load_stock_detail_report();"> <i class="fa fa-circle text-warning"></i> Detailed Stock Report</a></li> 
                            <li><a href="javascript:void(0);" onclick="load_stock_summary_report();"> <i class="fa fa-circle text-warning"></i> Stock Summary Report</a></li>                             
                            <li><a href="javascript:void(0);" onclick="load_allotment_outward_report();"> <i class="fa fa-circle text-warning"></i> Allotment Outward Report</a></li> 
                            <li><a href="javascript:void(0);" onclick="load_allotment_inward_report();"> <i class="fa fa-circle text-warning"></i> Allotment Inward Report</a></li> 
                        </ul>
                        <!--                        <h5 class="tag-title">Reports</h5>
                                                <ul class="tag-list" style="padding: 0">
                                                    <li><a href="javascript:void(0);"><i class="fa fa-tag"></i> Purchase List</a></li>
                                                    <li><a href="javascript:void(0);"><i class="fa fa-tag"></i> Purchase Order List</a></li>
                                                    <li><a href="javascript:void(0);"><i class="fa fa-tag"></i> Stock Transfer Issue List</a></li>
                        
                                                </ul>-->
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
    load_purchase();
    function simpleLoad(btn, state) {
        if (state) {
            btn.children().addClass('fa-spin');
            btn.contents().last().replaceWith(" Loading");
        } else {
            setTimeout(function () {
                btn.children().removeClass('fa-spin');
                btn.contents().last().replaceWith(" Refresh");
            }, 2000);
        }
    }


    function load_purchase() {
        var ops_url = baseurl + 'purchase/show-purchase/';
        $.ajax({
            type: "POST",
            cache: false,
            async: false,
            url: ops_url,
            data: {"load": 1},
            success: function (result) {
                $('#data-view').html(result);
                $('#table_purchase_list').dataTable({
                    columnDefs: [
                        {"width": "20%", className: "capitalize", "targets": 0},
                        {"width": "10%", className: "capitalize", "targets": 1},
                        {"width": "20%", className: "capitalize", "targets": 2},
                        {"width": "20%", className: "capitalize", "targets": 3},
                        {"width": "10%", className: "capitalize", "targets": 4},
                        {"width": "10%", className: "capitalize", "targets": 5},
                        {"width": "10%", className: "capitalize", "targets": 6, "orderable": false}
                    ],
                    responsive: true,
                    iDisplayLength: 10,

                });
            }
        });

    }

    function load_transferintend() {
        var ops_url = baseurl + 'stock/stocktransferintend/';
        $.ajax({
            type: "POST",
            cache: false,
            async: false,
            url: ops_url,
            data: {"load": 1},
            success: function (result) {
                $('#data-view').html(result);
            }
        });

    }

    function load_purchaseorder() {
        var ops_url = baseurl + 'purchase/purchase-order/';
        $.ajax({
            type: "POST",
            cache: false,
            async: false,
            url: ops_url,
            data: {"load": 1},
            success: function (result) {
                $('#data-view').html(result);
            }
        });
    }
    function purchaseorder_recieve() {
        var ops_url = baseurl + 'purchase/purchase-orderrecieve/';
        $.ajax({
            type: "POST",
            cache: false,
            async: false,
            url: ops_url,
            data: {"load": 1},
            success: function (result) {
                $('#data-view').html(result);
            }
        });
    }
    function load_purchaseorderapproval() {
        var ops_url = baseurl + 'purchase/purchase-returnapproval/';
        $.ajax({
            type: "POST",
            cache: false,
            async: false,
            url: ops_url,
            data: {"load": 1},
            success: function (result) {
                $('#data-view').html(result);
            }
        });
    }
    function return_request() {
        var ops_url = baseurl + 'purchase/purchase-returnrequest/';
        $.ajax({
            type: "POST",
            cache: false,
            async: false,
            url: ops_url,
            data: {"load": 1},
            success: function (result) {
                $('#data-view').html(result);
            }
        });
    }
    function stocktransfer_issue() {
        var ops_url = baseurl + 'stock/stocktransferissue/';
        $.ajax({
            type: "POST",
            cache: false,
            async: false,
            url: ops_url,
            data: {"load": 1},
            success: function (result) {
                $('#data-view').html(result);
            }
        });
    }
    function stocktransfer_recieve() {
        var ops_url = baseurl + 'stock/stocktransferrecieve/';
        $.ajax({
            type: "POST",
            cache: false,
            async: false,
            url: ops_url,
            data: {"load": 1},
            success: function (result) {
                $('#data-view').html(result);
            }
        });
    }

    function load_district() {
        var ops_url = baseurl + 'city/show-city';
        $.ajax({
            type: "POST",
            cache: false,
            async: false,
            url: ops_url,
            data: {"load": 1},
            success: function (result) {
                $('#data-view').html(result);
            }
        });
    }
    function load_religion() {
        var ops_url = baseurl + 'religion/show-religion';
        $.ajax({
            type: "POST",
            cache: false,
            async: false,
            url: ops_url,
            data: {"load": 1},
            success: function (result) {
                $('#data-view').html(result);
            }
        });
    }
    function load_caste() {
        var ops_url = baseurl + 'caste/show-caste';
        $.ajax({
            type: "POST",
            cache: false,
            async: false,
            url: ops_url,
            data: {"load": 1},
            success: function (result) {
                $('#data-view').html(result);
            }
        });
    }
    function load_community() {
        var ops_url = baseurl + 'community/show-community';
        $.ajax({
            type: "POST",
            cache: false,
            async: false,
            url: ops_url,
            data: {"load": 1},
            success: function (result) {
                $('#data-view').html(result);
            }
        });
    }
    function load_currency() {
        var ops_url = baseurl + 'currency/show-currency';
        $.ajax({
            type: "POST",
            cache: false,
            async: false,
            url: ops_url,
            data: {"load": 1},
            success: function (result) {
                $('#data-view').html(result);
            }
        });
    }
    function load_language() {
        var ops_url = baseurl + 'language/show-language';
        $.ajax({
            type: "POST",
            cache: false,
            async: false,
            url: ops_url,
            data: {"load": 1},
            success: function (result) {
                $('#data-view').html(result);
            }
        });
    }
    function load_profession() {
        var ops_url = baseurl + 'profession/show-profession';
        $.ajax({
            type: "POST",
            cache: false,
            async: false,
            url: ops_url,
            data: {"load": 1},
            success: function (result) {
                $('#data-view').html(result);
            }
        });
    }

    //Saranyacode 14-11-2017 starts
    function purchase_return() {
        var ops_url = baseurl + 'purchase/show-purchase_return/';
        $.ajax({
            type: "POST",
            cache: false,
            async: false,
            url: ops_url,
            data: {"load": 1},
            success: function (result) {
                $('#data-view').html(result);
            }
        });
    }
    //Saranyacode 14-11-2017 ends
    function load_rate() {
//        var ops_url = baseurl + 'rate/show-storeselection/';   //store selection
        var ops_url = baseurl + 'rate/show-rate/';
        $.ajax({
            type: "POST",
            cache: false,
            async: false,
            url: ops_url,
            data: {"load": 1},
            success: function (result) {
                $('#data-view').html(result);
            }
        });
    }
    function load_allotment() {
        var ops_url = baseurl + 'allotment/show-allotment/';
        $.ajax({
            type: "POST",
            cache: false,
            async: false,
            url: ops_url,
            data: {"load": 1},
            success: function (result) {
                $('#data-view').html(result);
            }
        });
    }
    function load_opening_stock() {
        var ops_url = baseurl + 'stock/stock-details/';
        $.ajax({
            type: "POST",
            cache: false,
            async: false,
            url: ops_url,
            data: {"load": 1},
            success: function (result) {
                $('#data-view').html(result);
            }
        });
    }
    function load_item_stock() {
        var ops_url = baseurl + 'stock/item-stock-store/';
        $.ajax({
            type: "POST",
            cache: false,
            async: false,
            url: ops_url,
            data: {"load": 1},
            success: function (result) {
                $('#data-view').html(result);
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
            data: {"load": 1},
            success: function (result) {
                $('#data-view').html(result);
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
            data: {"load": 1},
            success: function (result) {
                $('#data-view').html(result);
            }
        });
    }
    
    function load_allotment_outward_report() {
        var ops_url = baseurl + 'report/stock-transfer-outward/';
        $.ajax({
            type: "POST",
            cache: false,
            async: false,
            url: ops_url,
            data: {"load": 1},
            success: function (result) {
                $('#data-view').html(result);
            }
        });
    }
    function load_allotment_inward_report() {
        var ops_url = baseurl + 'report/stock-transfer-inward/';
        $.ajax({
            type: "POST",
            cache: false,
            async: false,
            url: ops_url,
            data: {"load": 1},
            success: function (result) {
                $('#data-view').html(result);
            }
        });
    }

</script>

