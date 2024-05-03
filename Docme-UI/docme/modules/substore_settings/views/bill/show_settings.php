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
                        <a class="btn btn-block btn-primary compose-mail" href="mail_compose.html">Techno Alliance store</a>
                        <div class="space-25"></div>
                      
                         <h5>Book Store Billing</h5>
                        <ul class="category-list" style="padding: 0">


                           
                            <li><a href="javascript:void(0);" onclick="bill_test();"> <i class="fa fa-circle text-navy"></i> Bill-Student<span class="label label-info pull-right">2</span> </a></li>
                            <li><a href="javascript:void(0);" onclick="bill_test();"> <i class="fa fa-circle text-warning"></i> Bill-Employee<span class="label label-info pull-right">2</span> </a></li>
                            <li><a href="javascript:void(0);" onclick="bill_test();"> <i class="fa fa-circle text-danger"></i> OH-Student<span class="label label-info pull-right">2</span> </a></li>
                          

                        </ul>
                         <h5>Uniform Store Billing</h5>
                        <ul class="category-list" style="padding: 0">


                           
                            <li><a href="javascript:void(0);" onclick="bill_test();"> <i class="fa fa-circle text-navy"></i> Bill-Student<span class="label label-info pull-right">2</span> </a></li>
                            <li><a href="javascript:void(0);" onclick="bill_test();"> <i class="fa fa-circle text-warning"></i> Bill-Student<span class="label label-info pull-right">2</span> </a></li>
                            <li><a href="javascript:void(0);" onclick="bill_test();"> <i class="fa fa-circle text-primary"></i> OH-Billing<span class="label label-info pull-right">2</span> </a></li>
                          

                        </ul>
                        <h5 class="tag-title">Reports</h5>
                        <ul class="tag-list" style="padding: 0">
                            <li><a href="javascript:void(0);"><i class="fa fa-tag"></i> Bill List</a></li>
                            <li><a href="javascript:void(0);"><i class="fa fa-tag"></i> Bill History</a></li>
                            <li><a href="javascript:void(0);"><i class="fa fa-tag"></i> Bill Pending</a></li>
                            <li><a href="javascript:void(0);"><i class="fa fa-tag"></i> Bill Paid</a></li>
                            <!--<li><a href="javascript:void(0);"><i class="fa fa-tag"></i> Details List</a></li>-->

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
//    load_supplier();
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
    function load_graph() {
        var ops_url = baseurl + 'initial/show-chart/';
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


    function load_supplier() {
        var ops_url = baseurl + 'supplier/show-supplier/';
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

   function load_student_sale() {
        var ops_url = baseurl + 'sales/student-live-sale/';
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
   function deliveryreturn() {
        var ops_url = baseurl + 'sales/search-delivery-return/';
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
            data: {"load": 1},
            success: function (result) {
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
            data: {"load": 1},
            success: function (result) {
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
            data: {"load": 1},
            success: function (result) {
                $('#data-view').html(result);
            }
        });
    }
//    function load_sale() {
//        var ops_url = baseurl + 'substore/show-sale/';
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
    function load_sale() {
        var ops_url = baseurl + 'sale/student-filter/';
        $.ajax({
            type: "POST",
            cache: false,
            async: false,
            url: ops_url,
            data: {"load": 1},
            success: function (result) {
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
            data: {"load": 1},
            success: function (result) {
                $('#data-view').html(result);
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
            data: {"load": 1},
            success: function (result) {
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
            data: {"load": 1},
            success: function (result) {
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
            data: {"load": 1},
            success: function (result) {
                $('#data-view').html(result);
                $('#select2_demo_1').select2({
                    "theme" : "bootstrap"
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
            data: {"load": 1},
            success: function (result) {
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
            data: {"load": 1},
            success: function (result) {
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
            data: {"load": 1},
            success: function (result) {
                $('#data-view').html(result);
            }
        });
    }
    function student_bill(){
        var ops_url = baseurl + 'substore/bill-student/';
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
    function employee_bill(){
        var ops_url = baseurl + 'substore/bill-employee/';
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
    function bill_history(){
        var ops_url = baseurl + 'substore/bill-history/';
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
    function bill_test(){
        var ops_url = baseurl + 'substore/bill-test/';
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

    function load_ohitempacking() {
        var ops_url = baseurl + 'substore/item-ohpacking/';
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
    function load_batchpacking() {
        var ops_url = baseurl + 'substore/item-batchpacking/';
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
    function load_classpacking() {
        var ops_url = baseurl + 'substore/item-classpacking/';
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
    function load_specimenpacking() {
        var ops_url = baseurl + 'substore/item-specimenpacking/';
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
    function load_ohitemissue() {
        var ops_url = baseurl + 'substore/item-ohissue/';
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
    function load_ohitemgroupissue() {
        var ops_url = baseurl + 'substore/item-templatepack/';
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
     function load_specimen_issue() {
        var ops_url = baseurl + 'substore/specimen-issue/';
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
    function item_packing_sale() {
        var ops_url = baseurl + 'substore/item-packing/';
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
    function individual_loose_pack() {
        var ops_url = baseurl + 'substore/item-individualpacking/';
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
    function load_delivery() {
        var ops_url = baseurl + 'substore/item-delivery/';
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
    function load_itemadd() {
        var ops_url = baseurl + 'substore/item-add/';
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



 function create_template() {
        var ops_url = baseurl + 'oh/create-ohtemplate';
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

