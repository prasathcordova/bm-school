
<div class="wrapper wrapper-content animated fadeInRight" style="padding-top: 1px !important;padding-left: 0px !important;padding-right: 0px !important;">
    <div class="row" style="margin-left: -29px !important; margin-right: -30px !important;">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5> <?php echo $sub_title; ?></h5>
                   
                </div>            
                <div class="ibox-content">                    
                    <div class="panel-body panel-body-new">
                        <div class="panel panel-info">
                            <div class="panel-heading">
                                Stock Data - Item wise
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
                                                                <th>Item Name</th>
                                                                <th>Item Code</th>
                                                                <th>Barcode</th>             
                                                                <th>Item Type</th>             
                                                                <th>Quantity</th>             
                                                                <th>Price/Qty</th>       
                                                                <th>Stock Value</th>       
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <?php
                                                            if (isset($stock_data) && !empty($stock_data)) {
                                                                foreach ($stock_data as $stock) {
                                                                    ?>
                                                                    <tr>
                                                                        <td><?php echo $stock['item_name']; ?></td>
                                                                        <td><?php echo $stock['item_code']; ?></td>
                                                                        <td><?php echo $stock['barcode']; ?></td>
                                                                        <td><?php echo $stock['itemtype_name']; ?></td>
                                                                        <td><?php echo $stock['stock_qty']; ?></td>
                                                                        <td><?php echo $stock['selling_price']; ?></td>
                                                                        <td><?php echo $stock['stock_qty'] * $stock['selling_price']; ?></td>
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
                    

                </div>
            </div>
        </div>
    </div>

    <style>
        .panel-body-new{padding:0 !important;}
    </style>