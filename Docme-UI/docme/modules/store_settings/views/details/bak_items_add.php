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
                                            <div class="col-sm-10"><input type="text" class="form-control" placeholder="Item name"></div>
                                        </div>



                                        <div class="form-group"><label class="col-sm-2 control-label">Item Code:</label>
                                            <div class="col-sm-10"><input type="text" class="form-control" placeholder="Item Code" name="itemcode" id="itemcode"></div>
                                        </div>
                                        <div class="form-group"><label class="col-sm-2 control-label">Description:</label>
                                            <div class="col-sm-10">
                                                <div class="summernote">
                                                    <br />
                                                    Enter item description
                                                    <br />
                                                    <br />
                                                    <br />
                                                    <br />

                                                </div>
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
                                                    <input type="text" class="form-control" placeholder="Item Purchase Price">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group "><label class="col-sm-2 control-label">Selling Price:</label>
                                            <div class="col-sm-10">
                                                <div class="input-group m-b">
                                                    <span class="input-group-addon"><?php echo CURRENCY  ?></span>
                                                    <input type="text" class="form-control" placeholder="Item Selling Price">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group"><label class="col-sm-2 control-label">Status:</label>
                                            <div class="col-sm-10">
                                                <input type="checkbox" class="js-switch" data-toggle="tooltip" title="Item Status" name="item_status" checked id="item_status" />

                                            </div>
                                        </div>
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
                                                        <input type="text" class="form-control" placeholder="10" id="barcodedata_data" name="barcodedata_data">
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
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
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
</script>