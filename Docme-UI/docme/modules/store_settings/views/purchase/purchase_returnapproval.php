
<div class="wrapper wrapper-content animated fadeInRight" style="padding-top: 1px !important;padding-left: 0px !important;padding-right: 0px !important;">
    <div class="row" style="margin-left: -29px !important; margin-right: -30px !important;">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5> <?php echo $sub_title; ?></h5>
                    <div class="ibox-tools" id="add_type">
                        <span><a href="javascript:void(0);"  onclick="purchase_return_approve();" > <i style="font-size: 35px !important;  float: right;color: #23c6c8;" class="material-icons">save</i></a> </span>
                    </div>
                </div>            
                <div class="ibox-content">
                    <div class="">
                        <div class="form">
                            <div class="panel-body panel-body-new">
                                <div class="panel panel-info">
                                    <div class="panel-heading">
                                        Purchase Return Request Details
                                    </div>
                                    <div class="ibox-content">
                                        <div class="row">                                            
                                            <div class="col-lg-6 col-xs-12 col-md-12" ><br>
                                                <div class="form-group">
                                                    <label for="title">Return Request No:</label>
                                                    <input id="title" type="text" class="form-control" placeholder="" value="<?php echo $master_data['purchase_return_code'] ?>" disabled style="background-color : #ffffff;" />
                                                </div>
                                            </div>                                            
                                            <div class="col-lg-6 col-xs-12 col-md-12" ><br>
                                                <div class="form-group">
                                                    <label for="title">Request Created By :</label>
                                                    <input id="title" type="text" class="form-control" placeholder="" value="<?php echo $master_data['created_by_name'] ?>" disabled style="background-color : #ffffff;" />
                                                </div>
                                            </div>
                                            <div class="col-lg-12 col-xs-12 col-md-12" ><br>
                                                <div class="form-group">
                                                    <label for="title">Supplier Data :</label>
                                                    <input id="title" type="text" class="form-control" placeholder="" value="<?php echo $master_data['supplier_data'] ?>" disabled style="background-color : #ffffff;" />
                                                </div>
                                            </div>
                                            <div class="clearfix"></div>
                                            <div class="col-lg-6 col-xs-12 col-md-12" ><br>
                                                <div class="form-group">
                                                    <label for="title">Total Return Value:</label>
                                                    <input id="title" type="text" class="form-control" placeholder="" value="<?php echo $master_data['final_order_value'] ?>" disabled style="background-color : #ffffff;" />
                                                </div>
                                            </div>

                                            <div class="col-lg-6 col-xs-12 col-md-12" ><br>
                                                <div class="form-group">
                                                    <label for="title">Return Order Status:</label>
                                                    <div class="clearfix" style="padding-bottom: 10px;"></div>
                                                    <div class="radio radio-info radio-inline">
                                                        <input type="radio" id="inlineRadio1" value="Approve" name="radioInline" checked="">
                                                        <label for="inlineRadio1"> Approve </label>
                                                    </div>
                                                    <div class="radio radio-inline">
                                                        <input type="radio" id="inlineRadio2" value="Reject" name="radioInline">
                                                        <label for="inlineRadio2"> Reject </label>
                                                    </div>
                                                    <div class="radio radio-inline">
                                                        <input type="radio" id="inlineRadio3" value="Review" name="radioInline">
                                                        <label for="inlineRadio3"> Review </label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-12 col-xs-12 col-md-12" ><br>
                                                <div class="form-group">
                                                    <label for="title">Comments*:</label>
                                                    <input id="approval_c" name="approval_c" type="text" class="form-control" placeholder="" value=""  style="background-color : #ffffff;" />
                                                </div>
                                            </div>
                                        </div>  
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="panel-body panel-body-new">
                        <div class="panel panel-info">
                            <div class="panel-heading">
                                Purchase Return Item Details
                            </div>
                            <div class="ibox-content">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="ibox">                                            
                                            <div class="ibox-content"> 
                                                <div class="table-responsive">
                                                    <table class="table table-striped table-bordered table-hover dataTables-example" id="tbl_selected" >
                                                        <thead>
                                                            <tr>
                                                                <th>Item Code</th>
                                                                <th>Item Name</th>
                                                                <th>Barcode</th>             
                                                                <th>Item Type</th>             
                                                                <th>Quantity</th>             
                                                                <th>Price/Qty</th>       
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <?php
                                                            if (isset($detail_data) && !empty($detail_data)) {
                                                                foreach ($detail_data as $details) {
                                                                    ?>
                                                                    <tr>
                                                                        <td><?php echo $details['item_code']; ?></td>
                                                                        <td><?php echo $details['item_name']; ?></td>
                                                                        <td><?php echo $details['barcode']; ?></td>
                                                                        <td><?php echo $details['itemtype_name']; ?></td>
                                                                        <td><?php echo $details['quantity']; ?></td>
                                                                        <td><?php echo $details['order_price_per_qty']; ?></td>
                                                                    </tr>
                                                                    <?php
                                                                }
                                                            }
                                                            ?>                                                            
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
                    <div class="panel-body panel-body-new">
                        <div class="panel panel-info">
                            <div class="panel-heading">
                                Purchase Return Comment & Status History
                            </div>
                            <div class="ibox-content">
                                <div class="table-responsive">
                                    <table class="table table-striped table-bordered table-hover dataTables-example" id="tbl_comment_system" >
                                        <thead>
                                            <tr>
                                                <th>Date</th>
                                                <th>Commented By</th>                                                                                             
                                                <th>Comment</th>                  
                                                <th>Status</th> 
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            if (isset($comment_data) && !empty($comment_data)) {
                                                foreach ($comment_data as $comments) {
                                                    ?>
                                                    <tr>
                                                        <td><?php echo isset($comments['createdon']) ? date('d-m-Y', strtotime($comments['createdon'])) : ""; ?></td>
                                                        <td><?php echo isset($comments['Emp_Name']) ? $comments['Emp_Name'] : ""; ?></td>
                                                        <td><?php echo isset($comments['comment']) ? base64_decode($comments['comment']) : ""; ?></td>                                                                            
                                                        <td><?php echo isset($comments['status_description']) ? $comments['status_description'] : ""; ?></td>
                                                    </tr>
                                                    <?php
                                                }
                                            }
                                            ?>                                                               
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

    <input type="hidden" name="return_id" id="return_id" value="<?php echo $return_id; ?>" />
    <input type="hidden" name="return_order" id="return_order" value="<?php echo $master_data['purchase_return_code']; ?>" />
    <script>
        
        </script>
    <style>
        .panel-body-new{padding:0 !important;}
    </style>