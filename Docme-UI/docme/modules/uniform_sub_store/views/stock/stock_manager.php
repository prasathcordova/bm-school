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
                        <a class="btn btn-block btn-primary compose-mail" href="mail_compose.html">Stock Management</a>
                        <div class="space-25"></div>
                        <h5>Purchase Manager</h5>

                        <ul class="category-list" style="padding: 0">
                            <li><a href="javascript:void(0);" onclick="load_district();"> <i class="fa fa-circle text-warning"></i> Purchase List<span class="label label-warning pull-right">16</span> </a></li>
                                    <li><a href="javascript:void(0);" onclick="uniform_load_supplier();"> <i class="fa fa-circle text-primary"></i> Direct Purchase  <span class="label label-warning pull-right">16</span> </a></li>
                                    <li><a href="javascript:void(0);" onclick="uniform_load_publisher();"> <i class="fa fa-circle text-info"></i> Purchase Order  <span class="label label-warning pull-right">16</span> </a></li>

                                    <li><a href="javascript:void(0);" onclick="load_district();"> <i class="fa fa-circle text-warning"></i> Purchase Return Request
                                            <li><a href="javascript:void(0);" onclick="load_district();"> <i class="fa fa-circle text-warning"></i> Purchase Return Approval


<!--<li><a href="<?php // echo base_url('course/batch-allocate');  ?>"> <i class="fa fa-circle text-warning"></i> District-->                                     
                                                    </ul>
                                                    <h5>Stock Transfer</h5>
                                                    <ul class="category-list" style="padding: 0">
                            <!--                            <li><a href="javascript:void(0);" onclick="load_religion();"> <i class="fa fa-circle text-navy"></i> Item Transfer <span class="label label-warning pull-right">16</span> </a></li>-->
                                                        <li><a href="javascript:void(0);" onclick="load_caste();"> <i class="fa fa-circle text-primary"></i> Stock Transfer-Intend <span class="label label-danger pull-right">2</span> </a></li>
                                                        <li><a href="javascript:void(0);" onclick="load_caste();"> <i class="fa fa-circle text-primary"></i> Stock Transfer-Issue <span class="label label-danger pull-right">2</span> </a></li>
                                                        <li><a href="javascript:void(0);" onclick="load_caste();"> <i class="fa fa-circle text-primary"></i> Stock Transfer-Recieve <span class="label label-danger pull-right">2</span> </a></li>

                                                    </ul>
                                                    <h5>Sale Settings</h5>
                                                    <ul class="category-list" style="padding: 0">
                                                        <li><a href="javascript:void(0);" onclick="uniform_sale();"> <i class="fa fa-circle text-navy"></i> Sale <span class="label label-warning pull-right">2</span> </a></li>
                                                        <li><a href="javascript:void(0);" onclick="load_language();"> <i class="fa fa-circle text-primary"></i> Edition <span class="label label-danger pull-right">2</span> </a></li>
                                                        <li><a href="javascript:void(0);" onclick="load_profession();"> <i class="fa fa-circle text-warning"></i> Item Master <span class="label label-info pull-right">2</span> </a></li>
                                                        <li><a href="javascript:void(0);" onclick="load_profession();"> <i class="fa fa-circle text-warning"></i> Category <span class="label label-info pull-right">2</span> </a></li>
                                                        <li><a href="javascript:void(0);" onclick="load_profession();"> <i class="fa fa-circle text-warning"></i> Sub Category <span class="label label-info pull-right">2</span> </a></li>

                                                    </ul>
                                                    <!--                        <h5 class="tag-title">Reports</h5>
                                                                            <ul class="tag-list" style="padding: 0">
                                                                                <li><a href="pdf_viewer.html"><i class="fa fa-tag"></i> Country List</a></li>
                                                                                <li><a href="pdf_viewer.html"><i class="fa fa-tag"></i> State List</a></li>
                                                                                <li><a href="pdf_viewer.html"><i class="fa fa-tag"></i> Language List</a></li>
                                                                                <li><a href="pdf_viewer.html"><i class="fa fa-tag"></i> Profession List</a></li>
                                                                                <li><a href="pdf_viewer.html"><i class="fa fa-tag"></i> Caste List</a></li>
                                                                                <li><a href="pdf_viewer.html"><i class="fa fa-tag"></i> Community List</a></li>
                                                                                <li><a href="pdf_viewer.html"><i class="fa fa-tag"></i> District List</a></li>
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
                                                        uniform_load_publisher();
                                                        function uniform_simpleLoad(btn, state) {
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

                                                        function uniform_load_supplier() {
                                                            var ops_url = baseurl + 'supplier/show-supplier/';
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

                                                        function uniform_load_publisher() {
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
                                                        function uniform_sale() {
                                                            var ops_url = baseurl + 'sale/sales/';
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

                                                        function uniform_load_district() {
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
                                                        function uniform_load_religion() {
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
                                                        function uniform_load_caste() {
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
                                                        function uniform_load_community() {
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
                                                        function uniform_load_currency() {
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
                                                        function uniform_load_language() {
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
                                                        function uniform_load_profession() {
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


                                                    </script>

