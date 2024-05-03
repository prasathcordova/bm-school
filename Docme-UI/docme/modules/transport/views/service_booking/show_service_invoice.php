<div class="wrapper wrapper-content animated fadeInRight" style="padding-top: 1px !important;padding-left: 0px !important;padding-right: 0px !important;">
    <div class="row" style="margin-left: -29px !important; margin-right: -30px !important;">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title" style="border-bottom-color:#23C6C8!important">
                    <h5 style="color: #1c84c6;"><?php echo isset($sub_title) ? $sub_title : "NO TITLE PROVIDED" ?></h5>
                    <div class="ibox-tools" id="add_type">
                        <a data-toggle="modal" class="btn btn-primary btn-xs" data-toggle="tooltip" title="Add a new Vehicle" data-placement="left" href="javascript:void(0)" onclick="add_new_invoice();">ADD NEW INVOICE</a>
                        <a href="javascript:void(0)" onclick="goto_previous();" class="btn btn btn-sm" data-toggle="tooltip" data-placement="top" title="Go to previous page"><i class="fa fa-reply"></i> Back</a>
                    </div>
                </div>
                <input type="hidden" name="servicebookingid" id="servicebookingid" value="<?php echo isset($servicebooking_id) && !empty($servicebooking_id) ? $servicebooking_id : ''; ?>" />
                <input type="hidden" name="vehicleid" id="vehicleid" value="<?php echo isset($vehicle_id) && !empty($vehicle_id) ? $vehicle_id : ''; ?>" />
                <input type="hidden" name="vehiclenum" id="vehiclenum" value="<?php echo isset($vehicle_num) && !empty($vehicle_num) ? $vehicle_num : ''; ?>" />
                <input type="hidden" name="servicecenter_id" id="servicecenter_id" value="<?php echo isset($serviceCenterId) && !empty($serviceCenterId) ? $serviceCenterId : ''; ?>" />
                <input type="hidden" name="servicecenter" id="servicecenter" value="<?php echo isset($ServiceCenter) && !empty($ServiceCenter) ? $ServiceCenter : ''; ?>" />
                <div class="ibox-content" id="faculty_loader">
                    <div class="sk-spinner sk-spinner-wave">
                        <div class="sk-rect1"></div>
                        <div class="sk-rect2"></div>
                        <div class="sk-rect3"></div>
                        <div class="sk-rect4"></div>
                        <div class="sk-rect5"></div>
                    </div>
                    <div class="clearfix"></div>
                    <div class="wrapper wrapper-content animated fadeInRight" id="student-data-container">
                        <div class="row">
                            <div class="col-lg-12">
                                <div id="curd-content" style="display: none;"></div>
                            </div>
                            <div class="col-lg-12">
                                <div class="table-responsive">
                                    <table class="table table-striped table-bordered table-hover dataTables-example" id="tbl_vehicle">

                                        <thead>
                                            <tr>
                                                <th>Vehicle Num</th>
                                                <th>Service Center</th>
                                                <th>Invoice Number</th>
                                                <th>Amount Total</th>
                                                <!--                                            <th>Status</th>                                
                                            <th>Task</th>                           -->
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            if (isset($invoice_data) && !empty($invoice_data) && is_array($invoice_data)) {
                                                foreach ($invoice_data as $invoicedata) {
                                            ?>
                                                    <tr>
                                                        <td> <?php echo $invoicedata['vehicleNum']; ?></td>
                                                        <td> <?php echo $invoicedata['ServiceCenter']; ?></td>
                                                        <td> <?php echo $invoicedata['invoiceNum']; ?></td>
                                                        <td> <?php echo my_money_format($invoicedata['amountTotal']); ?></td>


                                                        <!--                                                    <td  data-toggle="tooltip" title="Slide for Enable/Disable">
                                                        <?php if ($invoicedata['isActive'] == 1) { ?>                                                    
                                                            <input type="checkbox"  class="js-switch" data-toggle="tooltip" title="Slide for Enable/Disable" onchange="change_status('<?php echo $invoicedata['id'] ?>', this)" checked  id="t1" />                                                       


                                                        <?php } else {
                                                        ?>
                                                            <input type="checkbox"  class="js-switch" data-toggle="tooltip" title="Slide for Enable/Disable" onchange="change_status('<?php echo $invoicedata['id'] ?>', this)"  id="" class="js-switch"  />                                                                                                         

                                                        <?php }
                                                        ?>
                                                    </td>-->
                                                        <!--                                                    <td>
                                                        <a href="javascript:void(0);" onclick="edit_country('<?php echo $invoicedata['id']; ?>', '<?php echo $invoicedata['vehicleNum']; ?>', '<?php echo $invoicedata['vehicleNum']; ?>', '<?php echo $invoicedata['vehicleNum']; ?>', '<?php echo $invoicedata['vehicleNum']; ?>');"  data-toggle="tooltip" data-placement="right" title="Edit <?php echo $invoicedata['vehicleNum']; ?>" data-original-title="<?php echo $invoicedata['vehicleNum']; ?>"  ><i class="fa fa-pencil" style="font-size: 24px; color: #23C6C5; margin: 2%; "></i></a>                                                       
                                                    </td>-->
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
<script type="text/javascript">
    var list_switchery = [];
    var table = $('#tbl_vehicle').dataTable({

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
                "width": "30%",
                className: "capitalize",
                "targets": 2
            },
            {
                "width": "30%",
                className: "capitalize",
                "targets": 3
            },
            //            {"width": "10%", className: "capitalize", "targets": 4, "orderable": false},
            //            {"width": "10%", className: "capitalize", "targets": 5, "orderable": false}
        ],
        responsive: false,
        //        stateSave: true,
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
        "fnDrawCallback": function(ele) {
            activateSwitchery();
        },

    });
    $('#tbl_vehicle tbody').on('click', function(e) {
        activateSwitchery()
    });




    //NEW SCRIPT
    function add_new_invoice() {
        var servicebooking_id = $('#servicebookingid').val();
        var vehicle_id = $('#vehicleid').val();
        var vehicle_num = $('#vehiclenum').val();
        var servicecenterid = $('#servicecenter_id').val();
        var servicecenter_name = $('#servicecenter').val();
        var ops_url = baseurl + 'transport/create-new-vehicle-invoice-delivery/';

        $.ajax({
            type: "POST",
            cache: false,
            async: false,
            url: ops_url,
            data: {
                "load": 1,
                "servicebooking_id": servicebooking_id,
                "vehicle_id": vehicle_id,
                "vehicle_num": vehicle_num,
                "servicecenterid": servicecenterid,
                "servicecenter_name": servicecenter_name
            },
            success: function(data) {
                if (data) {
                    $('#curd-content').html(data);


                    var animation = "fadeInDown";
                    $("#curd-content").show();
                    $('#curd-content').addClass('animated');
                    $('#curd-content').addClass(animation);
                    $('#add_type').hide();

                } else {
                    alert('No data loaded');
                }
            }

        });

    }

    function goto_previous() {
        var ops_url = baseurl + 'transport/show-vehicle-service-invoice/';
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