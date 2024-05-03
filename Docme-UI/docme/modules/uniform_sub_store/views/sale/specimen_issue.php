<script src="<?php echo base_url('assets/theme/js/plugins/dataTables/datatables.min.js'); ?>"></script>

<div class="wrapper wrapper-content animated fadeInRight" style="padding-top: 1px !important;padding-left: 0px !important;padding-right: 0px !important;">
    <div class="row" style="margin-left: -29px !important; margin-right: -30px !important;">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5><?php echo isset($sub_title) ? $sub_title : "NO TITLE PROVIDED" ?></h5>
                    <div class="ibox-tools" id="add_type">
                    </div>
                </div>


                <div class="ibox-content">
                    <div class="ibox">
                        <div class="ibox-content">

                            <div class="row">
                                <div class="form-group col-lg-2 col-xs-12 col-md-2">
                                    <p>Empolyee Code</p>
                                </div>

                                <div class="form-group col-lg-4 col-xs-12 col-md-4">
                                    <input id="surname" name="surname" placeholder="" class="form-control" type="text"></div>
                                <div class="form-group col-lg-4 col-xs-12 col-md-4"><a href="javascript:void(0);" onclick="get_emp_code();" class="btn btn-info pull-left"><i class="fa fa-arrow-right" aria-hidden="true"></i>
                                    </a><a href="javascript:void(0);" onclick="get_filter();" class="btn btn-info pull-left" style="margin-left:15px;"><i class="fa fa-plus" aria-hidden="true"></i></i>
                                    </a></div>
                            </div>


                            <div class="panel panel-info animated fadeInDown" id="filter_details" style="display: block;">
                                <div class="panel-heading">Filter
                                    <a href="javascript:void(0);" onclick="filter_close();"> <i class="material-icons close" data-toggle="tooltip" style="color:#fff; font-size:22px;opacity: 10;" title="Close">close</i></a>
                                </div>

                                <div class="ibox-content">
                                    <div class="row">
                                        <div class="col-lg-4 col-xs-12 col-md-12">
                                            <div class="form-group">
                                                <label class="control-label" for="firstname">First Name :</label>
                                                <input id="firstname" name="firstname" value="" placeholder="Enter First Name" class="form-control" type="text">
                                            </div>
                                        </div>
                                        <div class="col-lg-4 col-xs-12 col-md-4">
                                            <div class="form-group">
                                                <label class="control-label" for="customer">Gender</label>
                                                <select class="select2_demo_1 form-control">
                                                    <option value="1">option 1</option>
                                                    <option value="2">option 2</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-lg-4 col-xs-12 col-md-4">
                                            <div class="form-group">
                                                <label class="control-label" for="customer" style="height:40px;"></label>
                                                <a href="#" class="btn btn-info">Ok</a>
                                            </div>
                                        </div>
                                    </div>

                                </div>

                            </div>

                            <div id="emp_details" class="animated fadeInDown">
                                <div class="row row-bor" style="background:#F3F3F4;padding-bottom:15px;">
                                    <a href="javascript:void(0);" onclick="emp_close();" class="pull-right"> <i class="material-icons close" style="color:#E91E63; font-size:30px;opacity: 10;" data-toggle="tooltip" title="Close">close</i></a>
                                    <div class="col-lg-3 col-md-3 col-sm-12">
                                        <div class="m-b-lg"> <img src="http://10.10.5.172:90/docme/Docme-UI/assets/img/a4.jpg" class="img-circle circle-border" alt="profile"></div>
                                    </div>

                                    <div class="col-lg-4 col-md-4 col-sm-12">
                                        <table class="table m-b-xs" style="margin:35px 0 0 0">
                                            <tbody>
                                                <tr>
                                                    <td><strong>Employee Name :</strong></td>
                                                    <td>Chandrajith</td>
                                                </tr>
                                                <tr>
                                                    <td><strong>Employee Id : </strong></td>
                                                    <td>099</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>

                                    <div class="col-lg-4 col-md-4 col-sm-12">
                                        <table class="table m-b-xs" style="margin:35px 0 0 0">
                                            <tbody>
                                                <tr>
                                                    <td><strong>Employee Name :</strong></td>
                                                    <td>Chandrajith</td>
                                                </tr>
                                                <tr>
                                                    <td><strong>Employee Id : </strong></td>
                                                    <td>099</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>

                                </div>

                                <div class="row" style="padding-top:15px;">
                                    <div class="form-group col-lg-2 col-xs-12 col-md-2">
                                        <p>Item Code</p>
                                    </div>

                                    <div class="form-group col-lg-4 col-xs-12 col-md-4">
                                        <input id="surname" name="surname" placeholder="" class="form-control" type="text"></div>
                                    <div class="form-group col-lg-2 col-xs-12 col-md-2"><a href="javascript:void(0);" onclick="" class="btn btn-info pull-left">Add</a></div>
                                </div>

                                <div class="row row-bor">
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

                                            </div>
                                        </div>
                                    </div>

                                </div>

                            </div>
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
</script>

<script type="text/javascript">
    $(document).ready(function() {

        // Add slimscroll to element
        $('.scroll_content').slimscroll({
            height: '250px'
        })

    });

    $(".select2_demo_1").select2({
        "theme": "bootstrap",
        width: "100%",
        placeholder: "Select  staff"
    });
</script>