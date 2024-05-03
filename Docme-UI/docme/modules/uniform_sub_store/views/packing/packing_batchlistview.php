<?php
if (isset($batch_data) && !empty($batch_data)) {
    foreach ($batch_data as $batch) {
    }
}
?>
<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-info">
            <div class="panel-heading">
                <i class="fa fa-info-circle"></i> <?php echo $batch['Class'] ?>
            </div>



            <div class="panel-body">

                <div class="ScrollStyle">
                    <div class="row row-new" style="padding-left: 5px; padding-top: 5px;">
                        <?php
                        if (isset($batch_data) && !empty($batch_data)) {

                            foreach ($batch_data as $batch) {
                        ?>

                                <div class="col-lg-4">
                                    <div class="ibox float-e-margins">
                                        <div class="ibox-title" style="padding: 5PX 15PX 2px 15px;min-height: 35px;">
                                            <span class="label label-info pull-right">Advanced filter</span>
                                            <!--<span class="label label-info pull-right"><?php echo CURRENCY  ?> $87</span>-->
                                            <input type="checkbox" class="i-checks">
                                        </div>
                                        <div class="ibox-title" style="padding: 5PX 15PX 2px 15px;min-height: 35px;">
                                            <?php echo $batch['Batch_Name'] ?></div>


                                        <div class="ibox-content" style=" padding: 10px 15px 25px 15px;">
                                            <span class="label label-warning pull-left"><?php echo CURRENCY  ?> $87</span>
                                            <!--                                <h5 class="no-margins">60</h5>
                                                                            <small>Stock</small>-->
                                            <div class="stat-percent font-bold text-info"><i class="fa fa-stack-overflow" aria-hidden="true" style="padding:0 5px 0 0;"></i><?php echo $batch['strength'] ?></div>

                                        </div>
                                    </div>
                                </div>

                        <?php
                            }
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<!--<div id="wrapper">-->

<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-info">
            <div class="panel-heading">
                <i class="fa fa-info-circle"></i> <?php echo 'ITEMS'; ?>
            </div>



            <div class="panel-body">
                <div class=" input-group" style="padding-bottom: 5%;">
                    <input type="text" placeholder="Enter Item Code/Name/" class="input form-control">
                    <span class="input-group-btn">
                        <button type="button" class="btn btn btn-primary"> <i class="fa fa-search"></i></button>
                    </span>
                </div>

                <div class="ScrollStyle">
                    <div class="row row-new">

                        <div class="col-lg-4">
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
                        <div class="col-lg-4">
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
                        <div class="col-lg-4">
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
                        <div class="col-lg-4">
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
                        <div class="col-lg-4">
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
                        <div class="col-lg-4">
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
                        <div class="col-lg-4">
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
                        <div class="col-lg-4">
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
                        <div class="col-lg-4">
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
    </div>


</div>

<!--<div id="wrapper">-->


<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-info">
            <div class="panel-heading">
                <i class="fa fa-info-circle"></i> Items Selected
            </div>



            <div class="panel-body">


                <div class="table-responsive">
                    <table class="table table-striped table-bordered table-hover dataTables-example" id="tbl_class_item">

                        <thead>
                            <tr>
                                <th>Item Code</th>
                                <th>Item Name</th>
                                <!--<th>Bar Code </th>-->
                                <th>Item Type</th>
                                <th>Quantity</th>
                                <th>Price</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            //                                        if (isset($country_data) && !empty($country_data) && is_array($country_data)) {
                            //                                            foreach ($country_data as $country) {
                            ?>
                            <tr>
                                <td> <?php echo 'xxxxxx'; ?></td>
                                <td> <?php echo 'Pencil'; ?></td>
                                <td> <?php echo 'Stationary'; ?></td>
                                <td> <input type="text" class="form-control" name="qty" id="qty" value="" /></td>
                                <td> <?php echo '<?php echo CURRENCY  ?> 10'; ?></td>



                                <td>
                                    <span class="label label-warning pull-left">Remove</span>
                                    <!--<a href="javascript:void(0);" onclick="edit_country('<?php // echo $country['country_id'];    
                                                                                                ?>', '<?php // echo $country['country_name'];    
                                                                                                                                            ?>', '<?php //echo $country['country_abbr'];    
                                                                                                                                                                                                ?>', '<?php // echo $country['country_nation'];    
                                                                                                                                                                                                                                                ?>', '<?php // echo $country['currency_name'];    
                                                                                                                                                                                                                                                                                                ?>');"  data-toggle="tooltip" data-placement="right" title="Edit <?php //echo $country['country_name'];    
                                                                                                                                                                                                                                                                                                                                                                                                                ?>" data-original-title="<?php // echo $country['country_name'];    
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                ?>"  ><i class="fa fa-pencil" style="font-size: 24px; color: #23C6C5; margin: 2%; "></i></a>-->
                                </td>
                            </tr>

                        </tbody>
                    </table>
                </div>









            </div>

        </div>
    </div>


</div>










<script>
    $(document).ready(function() {

        $('.ScrollStyle').slimscroll({
            height: '150px'
        })
        $('.i-checks').iCheck({
            checkboxClass: 'icheckbox_square-green',
            radioClass: 'iradio_square-green',
        });
    });

    var table = $('#tbl_class_item').dataTable({
        columnDefs: [{
                "width": "20%",
                className: "capitalize",
                "targets": 0
            },
            {
                "width": "20%",
                className: "capitalize",
                "targets": 1
            },
            {
                "width": "20%",
                className: "capitalize",
                "targets": 2
            },
            {
                "width": "10%",
                className: "capitalize",
                "targets": 3
            },
            {
                "width": "10%",
                className: "capitalize",
                "targets": 4
            },
            {
                "width": "20%",
                className: "capitalize",
                "targets": 5,
                "orderable": false
            }
        ],
        responsive: true,
        stateSave: true,
        iDisplayLength: 10,
        dom: '<"html5buttons"B>lTfgitp',
        buttons: [{
                extend: 'copy'
            },
            {
                extend: 'csv',
                exportOptions: {
                    columns: [0, 1, 2, 3]
                }
            },
            {
                extend: 'excel',
                title: 'Report',
                exportOptions: {
                    columns: [0, 1, 2, 3]
                }
            }
        ],
    });
</script>
</body>

</html>