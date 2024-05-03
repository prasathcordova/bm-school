<script src="<?php echo base_url('assets/theme/js/plugins/dataTables/datatables.min.js'); ?>"></script>

<div class="wrapper wrapper-content animated fadeInRight" style="padding-top: 1px !important;padding-left: 0px !important;padding-right: 0px !important;">
    <div class="row" style="margin-left: -29px !important; margin-right: -30px !important;">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <!--                <div class="ibox-title">
                    <h5><?php echo isset($sub_title) ? $sub_title : "Employee Search" ?></h5>
                    <div class="ibox-tools" id="add_type">
                    </div>
                </div>-->


                <div class="ibox-content">
                    <span><a href="javascript:void(0);" onclick="close_advance_search();"> <i style="font-size: 30px !important; float: right; color: #E91E63;" class="material-icons" data-toggle="tooltip" title="Close">close</i></a> </span>
                    <div class="">
                        <!--<div class="ibox-content">-->





                        <!--<div id="emp_details" class="animated fadeInDown">-->
                        <div class="row row-bor" style="background:#F3F3F4;padding-bottom:15px;">
                            <!--<a href="javascript:void(0);" onclick="emp_close();" class="pull-right"> <i class="material-icons close" style="color:#E91E63; font-size:30px;opacity: 10;" data-toggle="tooltip" title="Close">close</i></a>-->
                            <div class="col-lg-3 col-md-3 col-sm-12">
                                <div class="m-b-lg"> <img src="<?php echo base_url('assets/img/a0.jpg'); ?>" class="img-circle circle-border" alt="profile"></div>
                            </div>

                            <div class="col-lg-4 col-md-4 col-sm-12">
                                <table class="table m-b-xs" style="margin:35px 0 0 0">
                                    <tbody>
                                        <tr>
                                            <td><strong>Employee Name :</strong></td>
                                            <td>xxxxxxxx</td>
                                        </tr>
                                        <tr>
                                            <td><strong>Designation </strong></td>
                                            <td>Teacher</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>

                            <div class="col-lg-4 col-md-4 col-sm-12">
                                <table class="table m-b-xs" style="margin:35px 0 0 0">
                                    <tbody>
                                        <tr>
                                            <td><strong>Employee Code :</strong></td>
                                            <td>15dg4646g</td>
                                        </tr>
                                        <!--                                        <tr>
                                            <td><strong>Batch : </strong></td>
                                            <td>VI/A/CBS/FN/ENG/2009-10</td>
                                        </tr>-->
                                    </tbody>
                                </table>
                            </div>

                        </div>
                    </div>
                </div>
            </div>


            <!--                            <div class="ibox">
                                            <div class="ibox-content">-->
            <div class="row">
                <div class="col-lg-8">
                    <div class="ibox purchase-sec">
                        <div class="ibox-title">
                            <h4>Items List</h4>
                        </div>
                        <div class=" input-group" style="margin-bottom:25px; margin-top:15px;">
                            <input type="text" placeholder="Search Item Code / Item " class="input form-control">
                            <span class="input-group-btn">
                                <button type="button" class="btn btn btn-primary"> <i class="fa fa-search"></i></button>
                            </span>
                        </div>
                        <div class="scroll_content">

                            <div class="ScrollStyle">
                                <div class="row row-new">

                                    <div class="col-lg-6">
                                        <div class="ibox float-e-margins">
                                            <div class="ibox-title" style="padding: 5PX 15PX 2px 15px;min-height: 35px;">
                                                <span class="label label-info pull-right">Add to list</span>
                                                <!--<span class="label label-info pull-right"><?php echo CURRENCY  ?> $87</span>-->
                                                Item Code:XXXX
                                            </div>
                                            <div class="ibox-title" style="padding: 5PX 15PX 2px 15px;min-height: 35px;">
                                                Physics Text</div>


                                            <div class="ibox-content" style=" padding: 10px 15px 25px 15px;">
                                                <span class="label label-warning pull-left"><?php echo CURRENCY  ?> $87</span>
                                                <!--                                <h5 class="no-margins">60</h5>
                                <small>Stock</small>-->
                                                <div class="stat-percent font-bold text-info"><i class="fa fa-stack-overflow" aria-hidden="true" style="padding:0 5px 0 0;"></i>20</div>

                                            </div>
                                        </div>
                                    </div>



                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="ibox">
                        <div class="ibox-content">
                            <div class="row ">
                                <div class="col-lg-12">
                                    <div class=" float-e-margins">
                                        <div class="">

                                            <div class="table-responsive">
                                                <!--<table class="table table-striped table-bordered table-hover dataTables-example" id="tbl_sale" >-->
                                                <table class="table table-striped table-bordered table-hover dataTables-example">
                                                    <thead>
                                                        <tr>
                                                            <th>Item Name</th>
                                                            <th>Qty</th>
                                                            <th>Price</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>

                                                        <tr>
                                                            <td><?php echo "fd" ?></td>
                                                            <td><input id="surname" name="surname" placeholder="" class="form-control" type="text"></td>
                                                            <td><?php echo "70" ?></td>
                                                        </tr>

                                                    </tbody>
                                                </table>
                                            </div>

                                            <div class="row">
                                                <div class="col-md-6">

                                                    <div class="form-group row">
                                                        <label for="inputEmail3" class="col-sm-12 col-form-label">Total</label>
                                                        <div class="col-sm-12">
                                                            <!--<input type="email" class="form-control disabled" id="inputEmail3"  placeholder="">-->
                                                            <input style="background-color: #FFFFFF;" class="form-control text-uppercase" disabled="" name="description" id="total_qty" value="" type="text">
                                                        </div>
                                                    </div>


                                                    <div class="row">
                                                        <label class="form-check-label col-sm-12 " style="font-weight:normal;">
                                                            <b>Discount</b>(-)
                                                            <input class="form-check-input" style="margin:0 0 0 15px;" name="gridRadios" id="gridRadios1" value="option1" checked="" type="radio">
                                                            Rate(%)
                                                            <input class="form-check-input" style="margin:0 0 0 15px;" name="gridRadios" id="gridRadios1" value="option1" checked="" type="radio">
                                                            Fixed
                                                        </label>
                                                        <div class="col-sm-12">
                                                            <input class="form-control" "="" id=" inputEmail3" placeholder="" type="email">
                                                            <p style="display:inline-block; padding: 0 0 0 5px"></p>
                                                        </div>
                                                    </div>

                                                    <div class="form-group row">
                                                        <label for="inputEmail3" class="col-sm-12 col-form-label"><?php echo TAXNAME  ?></label>
                                                        <div class="col-sm-12">
                                                            <input class="form-control" id="inputEmail3" placeholder="" type="email">
                                                        </div>
                                                    </div>


                                                </div>


                                                <div class="col-md-6">

                                                    <div class="form-group row">
                                                        <label for="inputEmail3" class="col-sm-12 col-form-label">Net Total</label>
                                                        <div class="col-sm-12">
                                                            <input style="background-color:#FFFFFF" class="form-control text-uppercase" disabled="" name="description" id="total_qty" value="" type="text">
                                                        </div>
                                                    </div>

                                                    <div class="form-group row">
                                                        <label for="inputEmail3" class="col-sm-12 col-form-label">Round Off</label>
                                                        <div class="col-sm-12">
                                                            <input class="form-control" id="inputEmail3" placeholder="" type="email">
                                                        </div>
                                                    </div>
                                                </div>



                                            </div>
                                            <div class="ibox-tools" id="add_type">
                                                <a data-toggle="modal" class="btn btn-primary btn-xs" data-toggle="tooltip" title="Invoice" data-placement="left" href="javascript:void(0)" onclick="show_invoice();">Generate Token</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>

                </div>
                <div class="col-lg-4">


                    <div class="ibox">
                        <div class="ibox-title">
                            <h5>Items Selected</h5>
                        </div>

                        <div class="ibox-content" style="padding-left:10px;">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="ibox float-e-margins">
                                        <div class="ibox-title" style="padding: 5PX 15PX 2px 15px;min-height: 35px;">
                                            <!--<span class="label label-info pull-right">Add to list</span>-->
                                            <!--<span class="label label-info pull-right"><?php echo CURRENCY  ?> $87</span>-->
                                            Item Code:XXXX
                                        </div>
                                        <div class="ibox-title" style="padding: 5PX 15PX 2px 15px;min-height: 35px;">
                                            Physics Text</div>


                                        <div class="ibox-content" style=" padding: 10px 15px 25px 15px;">
                                            <span class="label label-warning pull-left"><?php echo CURRENCY  ?> $87</span>
                                            <!--                                <h5 class="no-margins">60</h5>
                                <small>Stock</small>-->
                                            <div class="stat-percent font-bold text-info"><i class="fa fa-stack-overflow" aria-hidden="true" style="padding:0 5px 0 0;"></i>20</div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="panel-group payments-method" id="accordion" style="width: 225px;">
                                <div class="panel panel-default">

                                    <div id="collapseOne" class="panel-collapse collapse">
                                        <div class="panel-body">

                                            <div class="row">
                                                <!--<div class="col-md-3">-->
                                                <!--                                                    <h2>Summary</h2>
                                                                                                    <strong>Product:</strong>: Name of product <br/>
                                                                                                    <strong>Price:</strong>: <span class="text-navy">$452.90</span>-->

                                                <span style="margin-left:30px;">
                                                    Total
                                                </span>
                                                <h2 class="font-bold" style="margin-left:30px;">
                                                    Dhs 232
                                                </h2>

                                                <hr />
                                                <!--                            <span class="text-muted small">
                                                    *For United States, France and Germany applicable sales tax will be applied
                                                </span>-->

                                                <a class="btn btn-info" style="margin-left:30px;">
                                                    <i class="fa fa-money">
                                                        Make a payment!
                                                    </i>
                                                </a>

                                                <!--</div>-->

                                            </div>


                                        </div>
                                    </div>
                                </div>


                            </div>
                        </div>


                        <hr />

                    </div>
                </div>
            </div>
        </div>
    </div>




</div>

</div>





<style>
    .emp_details {
        display: none;
    }

    .row-bor {
        border-top: solid #eee 1px;
        padding-top: 15px;
    }

    .scroll_content-new {
        padding: 15px;
    }

    .transfer-list {
        margin: 0 0 15px 0;
    }

    .ibox-new {
        margin-top: 20px !important;
    }

    .ibox-content-new {
        min-height: 457px;
    }

    .panel-body {
        min-height: 373px;
    }

    .table-hig {
        background: #F3F3F4;
        font-size: 12px;
        box-shadow: 0 1px #ccc;
    }

    .m-b-lg,
    .img-circle {
        margin: 0 !important;
    }

    .table>thead>tr>th,
    .table>tbody>tr>th,
    .table>tfoot>tr>th,
    .table>thead>tr>td,
    .table>tbody>tr>td,
    .table>tfoot>tr>td {
        border-bottom: solid 1px #ddd !important;
    }

    .table>tbody>tr>td,
    .table>tbody>tr>th,
    .table>tfoot>tr>td,
    .table>tfoot>tr>th,
    .table>thead>tr>td,
    .table>thead>tr>th {
        border-top: none !important;
    }

    .row-eq-height {
        display: -webkit-box;
        display: -webkit-flex;
        display: -ms-flexbox;
        display: flex;
    }
</style>



<script src="js/plugins/chosen/chosen.jquery.js"></script>

<script type="text/javascript">
    $(document).ready(function() {
        $('.dataTables-example').DataTable({
            pageLength: 25,
            responsive: true,
            dom: '<"html5buttons"B>lTfgitp',
            buttons: [{
                    extend: 'copy'
                },
                {
                    extend: 'csv'
                },
                {
                    extend: 'excel',
                    title: 'ExampleFile'
                },
                {
                    extend: 'pdf',
                    title: 'ExampleFile'
                },
                {
                    extend: 'print',
                    customize: function(win) {
                        $(win.document.body).addClass('white-bg');
                        $(win.document.body).css('font-size', '10px');

                        $(win.document.body).find('table')
                            .addClass('compact')
                            .css('font-size', 'inherit');
                    }
                }
            ]

        });

    });

    $('document').ready(function() {
        $('#emp_details').css("display", "none");
        $('#filter_details').css("display", "none");

    });



    function get_emp_code() {
        var element = document.getElementById("emp_details");

        $('#emp_details').css("display", "block");
        //#Detail_pack{display:block;}
    }


    function emp_close() {
        var element = document.getElementById("emp_details");

        $('#emp_details').css("display", "none");
        //#Detail_pack{display:block;}
    }

    function item_close_2() {
        var element = document.getElementById("template-list");

        $('#template-list').css("display", "block");
        //#Detail_pack{display:block;}
    }

    function get_filter() {
        var element = document.getElementById("filter_details");

        $('#filter_details').css("display", "block");
        //#Detail_pack{display:block;}
    }

    function filter_close() {
        var element = document.getElementById("filter_details");

        $('#filter_details').css("display", "none");
    }

    function show_invoice() {
        var ops_url = baseurl + 'substore/generate-invoice/';
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

<script type="text/javascript">
    $(document).ready(function() {

        // Add slimscroll to element
        $('.scroll_content').slimscroll({
            height: '250px',
            color: '#f8ac59'
        })

    });

    $(".select2_demo_1").select2({
        "theme": "bootstrap",
        width: "100%",
        placeholder: "Select  staff"
    });
</script>