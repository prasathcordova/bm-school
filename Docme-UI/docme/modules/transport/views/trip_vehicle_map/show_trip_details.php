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
                        <div class="row">
                            <div class="col-lg-12 table-responsive">
                                <table class="table table-bordered table-condensed">
                                    <tr>
                                        <td colspan="2">
                                            <h3 style="margin-top: 10px; margin-bottom: 10px;">About <b class="text-uppercase"><?php echo $vehicle_data[0]['tripName']; ?></b></h3>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td width='40%'>Trip Name</td>
                                        <td width='60%'><b class="text-uppercase"><?php echo isset($vehicle_data[0]['tripName']) ? $vehicle_data[0]['tripName'] : "NIL"; ?></b></td>
                                    </tr>
                                    <tr>
                                        <td width='40%'>Trip Description</td>
                                        <td width='60%'><b class="text-uppercase"><?php echo isset($vehicle_data[0]['tripDescription']) ? $vehicle_data[0]['tripDescription'] : "NIL"; ?></b></td>
                                    </tr>
                                    <tr>
                                        <td width='40%'>Pickup Time</td>
                                        <td width='60%'>
                                            <b class="text-uppercase">
                                                <?php echo isset($vehicle_data[0]['pickStartTime']) ? date('h:i a', strtotime('10-10-2010 ' . $vehicle_data[0]['pickStartTime'])) : "NIL"; ?>-
                                                <?php echo isset($vehicle_data[0]['pickEndTime']) ? date('h:i a', strtotime('10-10-2010 ' . $vehicle_data[0]['pickEndTime'])) : "NIL"; ?>
                                            </b>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td width='40%'>Drop Time</td>
                                        <td width='60%'>
                                            <b class="text-uppercase">
                                                <?php echo isset($vehicle_data[0]['dropStartTime']) ? date('h:i a', strtotime('10-10-2010 ' . $vehicle_data[0]['dropStartTime'])) : "NIL"; ?>-
                                                <?php echo isset($vehicle_data[0]['dropEndTime']) ? date('h:i a', strtotime('10-10-2010 ' . $vehicle_data[0]['dropEndTime'])) : "NIL"; ?>
                                            </b>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="2">
                                            <p class="text-muted" style="margin-top: 3px; margin-bottom: 3px;">
                                                Currently active vehicle details for this trip
                                            </p>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td width='40%'>Vehicle Number</td>
                                        <td width='60%'><b class="text-uppercase"><?php echo isset($vehicle_data[0]['vehicleNum']) ? $vehicle_data[0]['vehicleNum'] : "NIL"; ?></b></td>
                                    </tr>
                                    <tr>
                                        <td width='40%'>Bus Number (School Provided)</td>
                                        <td width='60%'><b class="text-uppercase"><?php echo isset($vehicle_data[0]['schoolNum']) ? $vehicle_data[0]['schoolNum'] : "NIL"; ?></b></td>
                                    </tr>
                                    <tr>
                                        <td width='40%'>Vehicle link Start Date</td>
                                        <td width='60%'><b class="text-uppercase"><?php echo isset($vehicle_data[0]['vehicleLinkStartDate']) ? date('d-m-Y', strtotime($vehicle_data[0]['vehicleLinkStartDate'])) : "NIL"; ?></b></td>
                                    </tr>
                                    <tr>
                                        <td width='40%'>Seat Capacity</td>
                                        <td width='60%'><b class="text-uppercase"><?php echo isset($vehicle_data[0]['seatCapacity']) ? $vehicle_data[0]['seatCapacity'] : "NIL"; ?></b></td>
                                    </tr>
                                </table>
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
        var ops_url = baseurl + 'transport/tripsvehiclemap-show/';
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