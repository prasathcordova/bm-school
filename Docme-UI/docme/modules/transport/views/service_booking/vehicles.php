<div class="wrapper wrapper-content animated fadeInRight" style="padding-top: 1px !important;padding-left: 0px !important;padding-right: 0px !important;">
    <div class="row" style="margin-left: -29px !important; margin-right: -30px !important;">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title" style="border-bottom-color:#23C6C8!important">
                    <h5 style="color: #1c84c6;"><?php echo isset($sub_title) ? $sub_title : "NO TITLE PROVIDED" ?></h5>
                    <div class="ibox-tools" id="add_type" style="top: -9px;left:-19px">
                        <div class="input-group" style="float: right">
                            <input type="text" placeholder="Search Registration Number" id="search_user_data" name="search_user_data" class="form-control" style="width: 205px;
    float: right;">
                            <!-- <span class="input-group-btn">
                                <button type="button" class="btn btn-sm btn-primary" onclick="load_search_user_data();"> <i class="fa fa-search"></i> Search</button>
                            </span> -->
                        </div>
                        <!--<a data-toggle="modal" class="btn btn-primary btn-xs" data-toggle="tooltip" title="Add a Fee Type" data-placement="left"href="javascript:void(0)" onclick="add_new_vehicle_make();"><i class="fa fa-plus"></i>ADD VEHICLE MAKE</a>-->
                    </div>
                </div>
                <div class="ibox-content" id="faculty_loader">
                    <div class="sk-spinner sk-spinner-wave">
                        <div class="sk-rect1"></div>
                        <div class="sk-rect2"></div>
                        <div class="sk-rect3"></div>
                        <div class="sk-rect4"></div>
                        <div class="sk-rect5"></div>
                    </div>
                    <div class="clearfix"></div>
                    <!--<div class="wrapper wrapper-content animated fadeInRight" id="student-data-container">-->
                    <div class="wrapper wrapper-content animated fadeInRight" id="data-view">
                        <div class="row arraydata">
                            <?php
                            if (isset($invoice_data) && !empty($invoice_data) && is_array($invoice_data)) {
                                $breaker = 0;
                                foreach ($invoice_data as $invoicedata) {
                            ?>
                                    <div class="col-lg-4">
                                        <div class="ibox float-e-margins">
                                            <div class="ibox-title" style="color: #1c84c6;">
                                                <span><b><?php echo $invoicedata['vehicleNum']; ?></b></span>
                                                <!-- <?php echo 'Route:TVM-KLM'; ?><br> -->
                                                <div class="ibox-tools pull-right" style="padding: 8px ">
                                                    <span class="label label-danger pull-left" title="<?php echo $invoicedata['vehicleTypeName'] ?>">
                                                        Type:<?php echo strlen($invoicedata['vehicleTypeName']) > 5 ? substr($invoicedata['vehicleTypeName'], 0, 5) . '...' : $invoicedata['vehicleTypeName']; ?>
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="ibox-title" style="padding: 5PX 15PX 2px 15px;min-height: 80px">
                                                <span class="pull-left">School Vehicle No&nbsp;:&nbsp;<b><?php echo $invoicedata['schoolNum']; ?></b></span><br>
                                                <span class="pull-left">Registration No&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:&nbsp;<b><?php echo $invoicedata['vehicleNum']; ?></b></span>
                                                <span class="pull-left" title="<?php echo $invoicedata['serviceCenterName'] ?>">Service Center&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:&nbsp;<b><?php echo strlen($invoicedata['serviceCenterName']) > 13 ? substr($invoicedata['serviceCenterName'], 0, 10) . '...' : $invoicedata['serviceCenterName']; ?></b></span><br>
                                                <span class="pull-left">Contact No&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:&nbsp;<b><?php echo $invoicedata['serviceAdvisorContactNum']; ?></b></span><br>
                                                <!--style="padding: 5px 15px 2px 15px;min-height: 140px;"-->
                                                <!-- <table width="100%">
                                                    <tr>
                                                        <td style="width: 60%">School Vehicle No.</td>
                                                        <td style="width: 1%">:</td>
                                                        <td><b><?php echo $invoicedata['schoolNum']; ?></b></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Registration No.</td>
                                                        <td>:</td>
                                                        <td><b><?php echo $invoicedata['vehicleNum']; ?></b></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Service Center</td>
                                                        <td>:</td>
                                                        <td style="text-transform: uppercase;" title="<?php echo $invoicedata['serviceCenterName'] ?>"><b><?php echo strlen($invoicedata['serviceCenterName']) > 20 ? substr($invoicedata['serviceCenterName'], 0, 17) . '...' : $invoicedata['serviceCenterName']; ?></b></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Contact No.</td>
                                                        <td>:</td>
                                                        <td><b><?php echo $invoicedata['serviceAdvisorContactNum']; ?></b></td>
                                                    </tr>

                                                </table> -->

                                            </div>

                                            <div class="ibox-title">
                                                <a title="Add Invoice">
                                                    <div class="stat-percent font-bold text-info pull-left" onclick="add_invoice('<?php echo $invoicedata['id']; ?>','<?php echo $invoicedata['vehicleId']; ?>','<?php echo $invoicedata['vehicleNum']; ?>','<?php echo $invoicedata['serviceCenterId']; ?>','<?php echo $invoicedata['serviceCenterName']; ?>','<?php echo $invoicedata['schoolNum']; ?>','<?php echo $invoicedata['serviceAdvisorContactNum']; ?>','<?php echo $invoicedata['serrviceDate']; ?>','<?php echo $invoicedata['expectedDeliveryDate']; ?>','<?php echo $invoicedata['kmreading']; ?>');"><i class="fa fa-stack-overflow" aria-hidden="true" style="padding:0 5px 0 0;"></i>Add Invoice</div>
                                                </a>

                                            </div>
                                        </div>




                                    </div>
                                <?php
                                    if ($breaker == 2) {
                                        echo '<div class="clearfix"></div>';
                                        $breaker = 0;
                                    } else {
                                        $breaker++;
                                    }
                                }
                            } else { ?>
                                <div class="col-lg-4">
                                    No serivce booking found.
                                </div>
                            <?php } ?>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<script type="text/javascript">
    $("#search_user_data").on("keyup", function() {
        var value = $(this).val().toLowerCase();
        var filter = $(this).val(),
            count = 0;
        $(".arraydata .ibox").each(function() {

            var current = $('.ibox').attr('data-name');
            if ($(this).text().search(new RegExp(filter, "i")) < 0) {
                $(this).parent().fadeOut();
            } else {
                $(this).parent().show();
                count++;
            }
        });
    });

    var table = $('#vehicle_make_tbl').dataTable({
        columnDefs: [{
            "width": "100%",
            "targets": 0
        }, ],
        responsive: false,
        iDisplayLength: 10,
        "ordering": false,
    });


    $('.i-checks').iCheck({
        checkboxClass: 'icheckbox_square-green',
        radioClass: 'iradio_square-green'
    });




    function add_invoice(id, vehicleId, vehicleNum, serviceCenterId, serviceCenterName, schoolnum, adivicontno, servicedate, deliverdate, odometerread) {
        var servicebooking_id = id;
        var bus_id = vehicleId;
        var vehiclenum = vehicleNum;
        var serviceCenterId = serviceCenterId;
        var ServiceCenter = serviceCenterName;
        var schoolnum = schoolnum;
        var advisorcontactnum = adivicontno;
        var servicedate = servicedate;
        var deliverydate = deliverdate;
        var odometerread = odometerread;
        var ops_url = baseurl + 'transport/load-service-invoice-vehicle-particular/';
        $.ajax({
            type: "POST",
            cache: false,
            async: false,
            url: ops_url,
            data: {
                "load": 1,
                "servicebooking_id": servicebooking_id,
                "id": bus_id,
                "vehiclenum": vehiclenum,
                "serviceCenterId": serviceCenterId,
                "ServiceCenter": ServiceCenter,
                'schoolnum': schoolnum,
                'advisorcontno': advisorcontactnum,
                'servicedate': servicedate,
                'deliverydate': deliverdate,
                'odometer': odometerread

            },
            success: function(result) {
                $('#data-view').html(result);
            }
        });

    }
</script>