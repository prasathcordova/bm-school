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
                        <a class="btn btn-block btn-primary compose-mail" onclick="load_supplier();" href="javascript:void(0)">Store Settings</a>
                        <div class="space-25"></div>
                        <h5>Settings</h5>

                        <ul class="category-list" style="padding: 0">

                            <li><a href="javascript:void(0);" onclick="load_supplier();"> <i class="fa fa-circle text-primary"></i> Supplier<span class="label label-warning pull-right" id="supplier_count"><?php echo $count_data[0]['supplier_count']; ?></span> </a></li>
                            <li><a href="javascript:void(0);" onclick="load_publisher();"> <i class="fa fa-circle text-info"></i> Publisher  <span class="label label-danger pull-right" id="publisher_count"><?php echo $count_data[0]['publisher_count']; ?></span> </a></li>
                            <!--<li><a href="javascript:void(0);" onclick="load_rate();"> <i class="fa fa-circle text-warning"></i> Rates </a></li>--> 
                            <!--<li><a href="javascript:void(0);" onclick="load_store();"> <i class="fa fa-circle text-warning"></i> Store-->
                                    <li><a href="javascript:void(0);" onclick="load_store();"> <i class="fa fa-circle text-warning"></i> Stores </a></li> 

<!--<li><a href="<?php // echo base_url('course/batch-allocate');      ?>"> <i class="fa fa-circle text-warning"></i> District-->                                     
                        </ul>
                        <h5>Stock Settings</h5>
                        <ul class="category-list" style="padding: 0">
                            <!--<li><a href="javascript:void(0);" onclick="load_opening_stock();"> <i class="fa fa-circle text-navy"></i> Opening Stock <span class="label label-warning pull-right">16</span> </a></li>-->
                            <li><a href="javascript:void(0);" onclick="load_stockcategory();"> <i class="fa fa-circle text-primary"></i> Stock Category <span class="label label-danger pull-right" id="category_count"><?php echo $count_data[0]['category_count']; ?></span> </a></li>
                            <!--<li><a href="javascript:void(0);" onclick="load_allotment();"> <i class="fa fa-circle text-primary"></i> Stock Allotment <span class="label label-danger pull-right" id="category_count"><?php echo $count_data[0]['category_count']; ?></span> </a></li>-->

                        </ul>
                        <h5>Item Settings</h5>
                        <ul class="category-list" style="padding: 0">
                            <li><a href="javascript:void(0);" onclick="load_type();"> <i class="fa fa-circle text-navy"></i> Item Type <span class="label label-warning pull-right" id="itemtype_count"><?php echo $count_data[0]['itemtype_count']; ?></span> </a></li>
                            <li><a href="javascript:void(0);" onclick="load_edition();"> <i class="fa fa-circle text-primary"></i> Item Edition <span class="label label-danger pull-right" id="itemedition_count"><?php echo $count_data[0]['itemedition_count']; ?></span> </a></li>
                            <li><a href="javascript:void(0);" onclick="load_details();"> <i class="fa fa-circle text-warning"></i> Item Master  </a></li>

                        </ul>
                        <!--                        <h5 class="tag-title">Reports</h5>
                                                <ul class="tag-list" style="padding: 0">
                                                    <li><a href="javascript:void(0);"><i class="fa fa-tag"></i> Supplier List</a></li>
                                                    <li><a href="javascript:void(0);"><i class="fa fa-tag"></i> Publisher List</a></li>
                                                    <li><a href="javascript:void(0);"><i class="fa fa-tag"></i> Type List</a></li>
                                                    <li><a href="javascript:void(0);"><i class="fa fa-tag"></i> Edition List</a></li>
                                                    <li><a href="javascript:void(0);"><i class="fa fa-tag"></i> Details List</a></li>
                        
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
    load_supplier();
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

    function active_count() {
        var ops_url = baseurl + 'store/show-count/';
        $.ajax({
            type: "POST",
            cache: false,
            async: false,
            url: ops_url,
            success: function (result) {
                var data = JSON.parse(result);
                if (data.status == 1) {
                    var count_data = data.data[0];
                    $("#publisher_count").text(count_data['publisher_count']);
                    $("#category_count").text(count_data['category_count']);
                    $("#supplier_count").text(count_data['supplier_count']);
                    $("#itemtype_count").text(count_data['itemtype_count']);
                    $("#itemedition_count").text(count_data['itemedition_count']);
//                    $.each(count_data, function (i, v) {
//                        $("#publisher_count").text('+v.publisher_count+');
//                    });
                }
            }
        });
    }

    function load_supplier() {
        var ops_url = baseurl + 'suppliers/show-suppliers/';
        $.ajax({
            type: "POST",
            cache: false,
            async: false,
            url: ops_url,
            data: {"load": 1},
            success: function (result) {
                $('#data-view').html(result);
                var list_switchery = [];
                $('#tbl_supplier').dataTable({
                    columnDefs: [
                        {"width": "16%", className: "capitalize", "targets": 0},
                        {"width": "16%", className: "capitalize", "targets": 1},
                        {"width": "16%", className: "capitalize", "targets": 2},
                        {"width": "16%", className: "capitalize", "targets": 3},
                        {"width": "16%", className: "capitalize", "targets": 3},
                        {"width": "10%", className: "capitalize", "targets": 3},
                        {"width": "10%", className: "capitalize", "targets": 4, "orderable": false}
                    ],
                    responsive: true,
                    iDisplayLength: 10,
                    dom: '<"html5buttons"B>lTfgitp',
                    buttons: [
                        {extend: 'copy'},
                        {extend: 'csv'},
                        {extend: 'excel', title: 'Report'}
                    ],
                    "fnDrawCallback": function (ele) {
                        activateSwitchery();
                    }
                });


                function activateSwitchery() {
                    for (var i = 0; i < list_switchery.length; i++) {
                        list_switchery[i].destroy();
                        list_switchery[i].switcher.remove();
                    }
                    var list_checkbox = Array.prototype.slice.call(document.querySelectorAll('.js-switch'));
                    list_checkbox.forEach(function (html) {
                        var switchery = new Switchery(html, {color: '#23C6C8', secondaryColor: '#F8AC59', size: 'small'});
//        var switchery = new Switchery(html, {color: '#a9318a', size: 'small'});
                        list_switchery.push(switchery);
                    });
                }
            }
        });

    }

    function load_publisher() {
        var ops_url = baseurl + 'publisher/show-publisher/';
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
    function load_details() {
        var ops_url = baseurl + 'itemmaster/show-details/';
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
    function load_edition() {
        var ops_url = baseurl + 'itemedition/show-itemedition/';
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
    function load_rate() {
        var ops_url = baseurl + 'rate/show-storeselection/';
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
    function load_stockcategory() {
        var ops_url = baseurl + 'category/show-category/';
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
    function load_edition() {
        var ops_url = baseurl + 'itemedition/show-itemedition/';
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
    function load_type() {
        var ops_url = baseurl + 'itemtype/show-item';
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

//saranya 15-11-2017
function load_store() {
        var ops_url = baseurl + 'store/show-store/';
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

