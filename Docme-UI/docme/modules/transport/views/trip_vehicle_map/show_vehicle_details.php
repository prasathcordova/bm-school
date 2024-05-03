<div class="wrapper wrapper-content animated fadeInRight" style="padding-top: 1px !important;padding-left: 0px !important;padding-right: 0px !important;">
    <div class="row" style="margin-left: -29px !important; margin-right: -30px !important;">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title" style="border-bottom-color:#23C6C8!important">
                    <h5 style="color: #1c84c6;"><?php echo isset($sub_title) ? $sub_title : "NO TITLE PROVIDED" ?></h5>
                    <div class="ibox-tools" id="add_type">
                        <a href="javascript:void(0)" onclick="goto_previous();" class="btn btn btn-sm" data-toggle="tooltip" data-placement="top" title="Go to previous page"><i class="fa fa-reply"></i> Back</a>
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
                    <div class="wrapper wrapper-content animated fadeInRight" id="data-view">
                        <div class="wrapper wrapper-content animated fadeInRight">



                            <div class="row">
                                <?php
                                if (isset($vehicle_data[0]['tripname']) && !empty($vehicle_data[0]['tripname'])) {
                                    ?>
                                <div class="col-lg-12">
                                    <div class="ibox">
                                        <div class="ibox-content">
                                            <h4 class=" font-normal text-muted">This vehicle map with following trip(s),
                                                <b class="text-uppercase">
                                                    <ol style="margin: 10px 5%;color: #cc006a;">
                                                        <?php $json_array = json_decode($vehicle_data[0]['tripname'], true);
                                                            foreach ($json_array as $value) { ?>
                                                        <li style="margin-top:10px;">
                                                            <?php echo $value['tripName'] ?>
                                                        </li>
                                                        <?php } ?>
                                                    </ol>
                                                </b>
                                            </h4>
                                        </div>
                                    </div>
                                </div>
                                <?php
                                }
                                ?>
                                <div class="col-lg-4">

                                    <div class="ibox">
                                        <div class="ibox-content">
                                            <h3>About <?php echo $vehicle_data[0]['vehicleNum']; ?></h3>

                                            <p class="small">
                                                School Num : <?php echo isset($vehicle_data[0]['schoolNum']) ? $vehicle_data[0]['schoolNum'] : "NIL"; ?>
                                            </p>
                                            <p class="small">
                                                Vehicle Type : <?php echo isset($vehicle_data[0]['vehicleTypeName']) ? $vehicle_data[0]['vehicleTypeName'] : "NIL"; ?>
                                            </p>
                                            <p class="small">
                                                Make : <?php echo isset($vehicle_data[0]['makeName']) ? $vehicle_data[0]['makeName'] : "NIL"; ?>
                                            </p>
                                            <p class="small">
                                                Model : <?php echo isset($vehicle_data[0]['companymodel']) ? $vehicle_data[0]['companymodel'] : "NIL"; ?>
                                            </p>
                                            <p class="small">
                                                Vehicle Model Year : <?php echo isset($vehicle_data[0]['vehiclemodelyear']) ? $vehicle_data[0]['vehiclemodelyear'] : "NIL"; ?>
                                            </p>
                                            <p class="small">
                                                Fuel Type : <?php echo isset($vehicle_data[0]['fuelTypeName']) ? $vehicle_data[0]['fuelTypeName'] : "NIL"; ?>
                                            </p>
                                            <p class="small">
                                                Chassis Number : <?php echo isset($vehicle_data[0]['chaisisNum']) ? $vehicle_data[0]['chaisisNum'] : "NIL"; ?>
                                            </p>
                                            <p class="small">
                                                Engine Number : <?php echo isset($vehicle_data[0]['EngineNum']) ? $vehicle_data[0]['EngineNum'] : "NIL"; ?>
                                            </p>
                                            <p class="small">
                                                Seat Capacity : <?php echo isset($vehicle_data[0]['seatCapacity']) ? $vehicle_data[0]['seatCapacity'] : "NIL"; ?>
                                            </p>

                                            <p class="small font-bold">
                                                <span><i class="fa fa-circle text-navy"></i> Active</span>
                                            </p>

                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="ibox">
                                        <div class="ibox-content">
                                            <h3>Insurance Details</h3>
                                            <p class="small">
                                                Company : <?php echo isset($vehicle_data[0]['insuranceName']) ? $vehicle_data[0]['insuranceName'] : "NIL"; ?>
                                            </p>
                                            <p class="small">
                                                Insured Date : <?php echo isset($vehicle_data[0]['insuranceDate']) ? date("d-m-Y", strtotime($vehicle_data[0]['insuranceDate'])) : "NIL"; ?>
                                            </p>
                                            <p class="small">
                                                Expiry Date : <?php echo isset($vehicle_data[0]['insuranceExpiryDate']) ? date("d-m-Y", strtotime($vehicle_data[0]['insuranceExpiryDate'])) : "NIL"; ?>
                                            </p>

                                        </div>
                                    </div>
                                    <div class="ibox">
                                        <div class="ibox-content">
                                            <h3>Tax Details</h3>
                                            <p class="small">
                                                Tax Date : <?php echo isset($vehicle_data[0]['taxDate']) ?  date("d-m-Y", strtotime($vehicle_data[0]['taxDate'])) : "NIL"; ?>
                                            </p>
                                            <p class="small">
                                                Expiry Date : <?php echo isset($vehicle_data[0]['taxExpiryDate']) ?  date("d-m-Y", strtotime($vehicle_data[0]['taxExpiryDate']))  : "NIL"; ?>
                                            </p>


                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="ibox">
                                        <div class="ibox-content">
                                            <h3>Permit Details</h3>
                                            <p class="small">
                                                Permit Date : <?php echo isset($vehicle_data[0]['permitDate']) ? date("d-m-Y", strtotime($vehicle_data[0]['permitDate'])) : "NIL"; ?>
                                            </p>
                                            <p class="small">
                                                Expiry Date : <?php echo isset($vehicle_data[0]['permitExpiryDate']) ? date("d-m-Y", strtotime($vehicle_data[0]['permitExpiryDate'])) : "NIL"; ?>
                                            </p>


                                        </div>
                                    </div>

                                    <!-- <div class="ibox">
                                        <div class="ibox-content">
                                            <h3>Vehicle Documents</h3>
                                            <ul class="list-unstyled file-list">
                                                <li><a href=""><i class="fa fa-file"></i> Project_document.docx</a></li>
                                                <li><a href=""><i class="fa fa-file-picture-o"></i> Logo_zender_company.jpg</a></li>
                                                <li><a href=""><i class="fa fa-stack-exchange"></i> Email_from_Alex.mln</a></li>
                                                <li><a href=""><i class="fa fa-file"></i> Contract_20_11_2014.docx</a></li>
                                                <li><a href=""><i class="fa fa-file-powerpoint-o"></i> Presentation.pptx</a></li>
                                                <li><a href=""><i class="fa fa-file"></i> 10_08_2015.docx</a></li>
                                            </ul>
                                        </div>
                                    </div> -->
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
    function goto_previous() {
        var trip_id = '<?php echo $tripid; ?>';
        var ops_url = baseurl + 'transport/load-vehicle-map-page/';
        $.ajax({
            type: "POST",
            cache: false,
            async: false,
            url: ops_url,
            data: {
                "load": 1,
                "id": trip_id
            },
            success: function(result) {
                $('#data-view').html(result);
            }
        });
    }
</script>