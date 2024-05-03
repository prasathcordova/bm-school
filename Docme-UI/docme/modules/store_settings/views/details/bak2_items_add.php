<link href="<?php echo base_url('assets/theme/css/plugins/datapicker/datepicker3.css'); ?>" rel="stylesheet">
<link href="<?php echo base_url('assets/theme/css/plugins/summernote/summernote.css'); ?>" rel="stylesheet">
<link href="<?php echo base_url('assets/theme/css/plugins/summernote/summernote-bs3.css'); ?>" rel="stylesheet">


<!-- Data picker -->
<script src="<?php echo base_url('assets/theme/js/plugins/datapicker/bootstrap-datepicker.js'); ?>"></script>
<!-- SUMMERNOTE -->
<script src="<?php echo base_url('assets/theme/js/plugins/summernote/summernote.min.js'); ?>"></script>
<script src="<?php echo base_url('assets/theme/plugins/barcode128/JsBarcode.code128.min.js'); ?>"></script>

<div class="wrapper wrapper-content animated fadeInRight ecommerce " style="padding: 0px;">
    <div class="row" style="margin-left: -29px !important; margin-right: -30px !important;">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title" style="border-bottom:solid 2px #F3F3F4;">
                    <h5><?php echo isset($sub_title) ? $sub_title : "NO TITLE PROVIDED" ?></h5>
                    <div class="ibox-tools" id="add_type">

                    </div>
                </div>
                <div class="ibox-content">

                    <div class="tabs-container">
                        <span><a href="javascript:void(0);" onclick="submit_data();"> <i style="font-size: 30px !important; float: right; color: #23C6C5; padding-right: 10px;" class="material-icons" data-toggle="tooltip" title="Save">save</i></a> </span>
                        <?php
                        echo form_open('details/add-item', array('id' => 'item_save', 'role' => 'form'));
                        ?>
                        <ul class="nav nav-tabs">
                            <li class="active"><a data-toggle="tab" href="#tab-1"> Item info</a></li>
                            <li class=""><a data-toggle="tab" href="#tab-2"> Item Settings</a></li>
                            <li class=""><a data-toggle="tab" href="#tab-3"> Barcode</a></li>
                            <li class=""><a data-toggle="tab" href="#tab-4"> Images</a></li>
                        </ul>
                        <div class="tab-content">
                            <div id="tab-1" class="tab-pane active">
                                <div class="panel-body">

                                    <fieldset class="form-horizontal">
                                        <div class="form-group"><label class="col-sm-2 control-label">Name:</label>
                                            <div class="col-sm-10"><input type="text" name="item_name" id="item_name" class="form-control" placeholder="Item name" value="<?php echo set_value('item_name', isset($item_name) ? $item_name : '');  ?>"></div>
                                        </div>



                                        <div class="form-group"><label class="col-sm-2 control-label">Item Code:</label>
                                            <div class="col-sm-10"><input type="text" class="form-control" placeholder="Item Code" name="item_code" id="item_code" value="<?php echo set_value('item_code', isset($item_code) ? $item_code : '');  ?>"></div>
                                        </div>
                                        <div class="form-group"><label class="col-sm-2 control-label">Description:</label>
                                            <div class="col-sm-10">
                                                <textarea class="form-control summernote" value="" id="item_description" name="item_description" value="<?php echo set_value('item_description ', isset($item_description) ? $item_description : ''); ?>"></textarea>
                                                <!--                                                <div class="summernote" id="item_description" name="item_description" >                                                    
                                                   
                                                    Item 
                                                    <br/>
                                                    <br/>
                                                    <br/>
                                                    <br/>

                                                </div>-->
                                            </div>
                                        </div>
                                    </fieldset>
                                </div>
                            </div>
                            <div id="tab-2" class="tab-pane">
                                <div class="panel-body">

                                    <fieldset class="form-horizontal">
                                        <div class="form-group"><label class="col-sm-2 control-label">Publisher</label>
                                            <div class="col-sm-10">
                                                <select class="form-control" name="publisher" id="publisher">
                                                    <?php
                                                    if (isset($publisher) && !empty($publisher)) {
                                                        foreach ($publisher as $pubs) {
                                                            echo '<option value="' . $pubs['pub_id'] . '">' . $pubs['pub_name'] . '(Code:' . $pubs['pub_code'] . ')</option>';
                                                        }
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group"><label class="col-sm-2 control-label">Item Type:</label>
                                            <div class="col-sm-10">
                                                <select class="form-control" name="itemtype" id="itemtype">
                                                    <?php
                                                    if (isset($itemtype) && !empty($itemtype)) {
                                                        foreach ($itemtype as $itemtypedata) {
                                                            echo '<option value="' . $itemtypedata['itemtype_id'] . '">' . $itemtypedata['itemtype_name'] . '(Code:' . $itemtypedata['itemtype_code'] . ')</option>';
                                                        }
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group"><label class="col-sm-2 control-label">Item Edition:</label>
                                            <div class="col-sm-10">
                                                <select class="form-control" name="itemedition" id="itemedition">
                                                    <?php
                                                    if (isset($item_edition) && !empty($item_edition)) {
                                                        foreach ($item_edition as $item_editiondata) {
                                                            echo '<option value="' . $item_editiondata['id'] . '">' . $item_editiondata['edition_name'] . '</option>';
                                                        }
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="form-group"><label class="col-sm-2 control-label">Stock Category</label>
                                            <div class="col-sm-10">
                                                <select class="form-control" name="stock_category" id="stock_category">
                                                    <?php
                                                    if (isset($stock_category) && !empty($stock_category)) {
                                                        foreach ($stock_category as $category) {
                                                            echo '<option value="' . $category['cate_id'] . '">' . $category['cate_name'] . '</option>';
                                                        }
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group "><label class="col-sm-2 control-label">Purchase Price:</label>
                                            <div class="col-sm-10">
                                                <div class="input-group m-b">
                                                    <span class="input-group-addon"><?php echo CURRENCY  ?></span>
                                                    <input type="text" name="purchase_price" id="purchase_price" class="form-control" placeholder="Item Purchase Price" value="<?php echo set_value('purchase_price', isset($purchase_price) ? $purchase_price : '');  ?>">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group "><label class="col-sm-2 control-label">Selling Price:</label>
                                            <div class="col-sm-10">
                                                <div class="input-group m-b">
                                                    <span class="input-group-addon"><?php echo CURRENCY  ?></span>
                                                    <input type="text" name="selling_price" id="selling_price" class="form-control" placeholder="Item Selling Price" value="<?php echo set_value('purchase_price', isset($purchase_price) ? $purchase_price : '');  ?>">
                                                </div>
                                            </div>
                                        </div>

                                        <!--                                        <div class="form-group"><label class="col-sm-2 control-label">Status:</label>
                                            <div class="col-sm-10">
                                                <input type="checkbox"  class="js-switch" data-toggle="tooltip" title="Item Status" name="item_status" checked  id="item_status" value="<?php // echo set_value('purchase_price', isset($purchase_price)?$purchase_price:'');  
                                                                                                                                                                                        ?>" />

                                            </div>
                                        </div>-->
                                    </fieldset>


                                </div>
                            </div>
                            <div id="tab-3" class="tab-pane">
                                <div class="panel-body">

                                    <div class="table-responsive">
                                        <table class="table table-stripped table-bordered">

                                            <thead>
                                                <tr>
                                                    <th style="width: 15%">
                                                        Barcode
                                                    </th>
                                                    <th>
                                                        Data
                                                    </th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>
                                                        <svg id="barcodedata"></svg>
                                                    </td>
                                                    <td>
                                                        <input type="text" class="form-control" placeholder="Barcode will be generated automatically once item is saved" id="barcodedata_data" readonly name="barcodedata_data">
                                                    </td>

                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <div id="tab-4" class="tab-pane">
                                <div class="panel-body">

                                    <div class="table-responsive">
                                        <table class="table table-bordered table-stripped">
                                            <thead>
                                                <tr>
                                                    <th>
                                                        Image preview
                                                    </th>

                                                    <th>
                                                        Actions
                                                    </th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>
                                                        <img src="<?php echo base_url('assets/img/bookstore/books1.jpg'); ?>">
                                                    </td>

                                                    <td>
                                                        <button class="btn btn-white"><i class="fa fa-trash"></i> </button>
                                                    </td>
                                                </tr>

                                            </tbody>
                                        </table>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <?php echo form_close(); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function() {

        $('.summernote').summernote();

        $('.input-group.date').datepicker({
            todayBtn: "linked",
            keyboardNavigation: false,
            forceParse: false,
            calendarWeeks: true,
            autoclose: true
        });

    });


    function show_barcode(barcode) {
        JsBarcode("#barcodedata", barcode, {
            width: 1,
            height: 40,
            displayValue: true,
            font: "Roboto",
            textAlign: "center",
            textPosition: "bottom",
            background: "#fff"
        });

    }

    function submit_data() {
        $('#faculty_loader').addClass('sk-loading');

        var ops_url = baseurl + 'details/add-item/';
        var item_name = $('#item_name').val().toUpperCase();
        var item_code = $('#item_code').val();
        var item_description = $($(".summernote").summernote("code")).text();
        //        var item_description = $("#item_description").val();
        var publisher = $("#publisher").val();
        var itemtype = $("#itemtype").val();
        var itemedition = $("#itemedition").val();
        var stock_category = $("#stock_category").val();
        var purchase_price = $("#purchase_price").val();
        var selling_price = $("#selling_price").val();


        if (item_name == '') {
            swal('', 'Item Name is required.', 'info');
            $('#faculty_loader').removeClass('sk-loading');
            return false;
        } else if ((item_name.length > '30') || (item_name.length < '3')) {
            swal('', 'Item Name should contain letters 3 to 30', 'info');
            $('#faculty_loader').removeClass('sk-loading');
            return false;
        }
        if (item_code == '') {
            swal('', 'Item code is required.', 'info');
            $('#faculty_loader').removeClass('sk-loading');
            return false;
        } else if ((item_code.length > '10') || (item_code.length < '3')) {
            swal('', 'Item Code should contain letters 3 to 10', 'info');
            $('#faculty_loader').removeClass('sk-loading');
            return false;
        }
        if (item_description == '') {
            swal('', 'Item Description is required.', 'info');
            $('#faculty_loader').removeClass('sk-loading');
            return false;
        } else if ((item_description.length > '200') || (item_description.length < '3')) {
            swal('', 'Item Description should contain atleast 3 letters', 'info');
            $('#faculty_loader').removeClass('sk-loading');
            return false;
        }
        if (purchase_price == '') {
            swal('', 'Purchase Price is required.', 'info');
            $('#faculty_loader').removeClass('sk-loading');
            return false;
        }
        var numbers = /^[0-9]+$/;
        if (!numbers.test($("#purchase_price").val())) {
            swal('', 'Purchase Price can have only numbers', 'info');
            $('#faculty_loader').removeClass('sk-loading');
            return false;
        }

        if (selling_price == '') {
            swal('', 'Selling price is required.', 'info');
            $('#faculty_loader').removeClass('sk-loading');
            return false;
        }
        var numbers = /^[0-9]+$/;
        if (!numbers.test($("#selling_price").val())) {
            swal('', 'Selling price can have only numbers', 'info');
            $('#faculty_loader').removeClass('sk-loading');
            return false;
        }


        $.ajax({
            type: "POST",
            cache: false,
            async: false,
            url: ops_url,
            //            data: $('#item_save').serialize(),
            data: {
                "item_name": item_name,
                "item_code": item_code,
                "item_description": item_description,
                "stock_category": stock_category,
                "itemtype": itemtype,
                "itemedition": itemedition,
                "publisher": publisher,
                "purchase_price": purchase_price,
                "selling_price": selling_price
            },
            success: function(result) {

                var data = $.parseJSON(result);
                if (data.status == 1) {
                    swal('Success', 'New item, ' + item_name + ' created successfully.', 'success');
                    $('#data-view').html('');
                    $('#data-view').html(data.view);
                    var item_data = [];
                    $.ajax({
                        type: "POST",
                        cache: false,
                        async: false,
                        url: baseurl + 'itemmaster/show-details/',
                        data: {
                            'load_reset': '1'
                        },
                        success: function(result) {
                            item_data = JSON.parse(result);

                        },
                        error: function() {
                            alert('error');
                        }
                    });
                    var datatable = $('#tbl_item_details').dataTable().api();
                    datatable.clear();
                    datatable.rows.add(item_data).draw();
                    $('#faculty_loader').removeClass('sk-loading');
                } else if (data.status == 2) {
                    $('#curd-content').html('');
                    $('#curd-content').html(data.view);
                    swal('', data.message, 'info');
                    $('#faculty_loader').removeClass('sk-loading');
                } else if (data.status == 3) {
                    $('#curd-content').html('');
                    $('#curd-content').html(data.view);
                    swal('', data.message, 'info');
                    $('#faculty_loader').removeClass('sk-loading');
                    //                    activate_toast(data.message, 'Error', 'error');
                } else {
                    swal('', 'Connection Error. Please contact administrator', 'info');
                    $('#faculty_loader').removeClass('sk-loading');
                    //                    activate_toast("Connection Error", 'Error', 'error');
                }

            }
        });
    }
</script>