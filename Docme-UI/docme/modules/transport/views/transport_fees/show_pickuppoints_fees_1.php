<div class="wrapper wrapper-content animated fadeInRight" style="padding-top: 1px !important;padding-left: 0px !important;padding-right: 0px !important;">
    <div class="row" style="margin-left: -29px !important; margin-right: -30px !important;">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title" style="border-bottom-color:#23C6C8!important">
                    <h5 style="color: #1c84c6;"><?php echo isset($sub_title) ? $sub_title : "NO TITLE PROVIDED" ?></h5>                 
                    <span><a href="javascript:void(0);"  onclick="submit_data();" > <i style="font-size: 30px !important; float: right; color: #23C6C5; padding-right: 10px;" class="material-icons" data-toggle="tooltip" title="Save">save</i></a> </span>
                    <span><a href="javascript:void(0);" onclick="clear_controls();"> <i style="font-size: 30px !important; float: right; color: #2196F3; padding-right: 10px;" class="material-icons " data-toggle="tooltip" title="Refresh">refresh</i></a> </span>
                    <span><a href="javascript:void(0)" onclick="goto_previous();" class="btn btn btn-sm pull-right" data-toggle="tooltip" data-placement="top" title="Go to previous page"><i class="fa fa-reply"></i> Back</a></span>
                    <div class="ibox-tools" id="add_type">                        
                    </div>
                </div>
                <input type="hidden" name="feesdata" id="feesdata" value="<?php echo isset($feessetdata) && !empty($feessetdata) ? $feessetdata : ''; ?>" />
                <input type="hidden" name="routeid" id="routeid" value="<?php echo isset($routeid) && !empty($routeid) ? $routeid : ''; ?>" />
                <input type="hidden" name="routeName" id="routeName" value="<?php echo isset($routeName) && !empty($routeName) ? $routeName : ''; ?>" />

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

                            <?php
                            if (isset($vehicle_pickup_data) && !empty($vehicle_pickup_data) && is_array($vehicle_pickup_data)) {
                                $breaker = 0;
                                foreach ($vehicle_pickup_data as $pickdata) {
                                    ?>
                                    <div class="col-lg-3">
                                        <div class="ibox float-e-margins">
                                            <div class="ibox-title" style="padding: 5PX 15PX 2px 15px;min-height: 35px;">
                                                <span class="label label-primary pull-left"><?php echo $pickdata['pickpointName']; ?></span>                                                    
                                                <!--<div style="color:#008a32"><?php echo $pickdata['pickpointName']; ?></div>   <br>-->
                                            </div>
                                            <input type="hidden" name="pickuppointname" id="pickuppointname" value="<?php echo isset($pickdata['pickpointName']) && !empty($pickdata['pickpointName']) ? $pickdata['pickpointName'] : ''; ?>" />
                                            <input type="hidden" name="pickuppointid" id="pickuppointid" value="<?php echo isset($pickdata['id']) && !empty($pickdata['id']) ? $pickdata['id'] : ''; ?>" />

                                            <div class="ibox-title" style="margin-top: 5px; padding: 5PX 15PX 2px 15px;min-height: 35px;">
                                                <div class="form-group">
                                                    <div class="form-line <?php
                                                    if (form_error('vehiclemodel')) {
                                                        echo 'has-error';
                                                    }
                                                    ?> ">
                                                        <input type="text" maxlength="10" class="form-control pickfee" data-pickid="<?php echo $pickdata['id']; ?>" data-pickname="<?php echo $pickdata['pickpointName']; ?>" name="fees" id="fees" value="" placeholder="Enter Fees for  <?php echo $pickdata['pickpointName']; ?> " />
                                                    </div>
                                                </div>
                                            </div>

                                        </div> 
                                    </div>
                                    <?php
                                    if ($breaker == 3) {
                                        echo '<div class="clearfix"></div>';
                                        $breaker = 0;
                                    } else {
                                        $breaker ++;
                                    }
                                }
                            }
                            ?>
                        </div>                    
                    </div>                    
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    var table = $('#vehicle_make_tbl').dataTable({
        columnDefs: [
            {"width": "100%", "targets": 0},
        ],
        responsive: false,
        iDisplayLength: 10,
        "ordering": false,
    });


    function load_Routes_on_show() {
        var ops_url = baseurl + 'transport/Transport_fees_controller/show_route/';
        $.ajax({
            type: "POST",
            cache: false,
            async: false,
            url: ops_url,
            data: {"load": 1},
            success: function (result) {
                $('#data-view').html(result);
            }
        });

    }
    function show_pickuppoints(id) {
        var route_id = id;
        var ops_url = baseurl + 'transport/load-pickuppoint-page/';
        $.ajax({
            type: "POST",
            cache: false,
            async: false,
            url: ops_url,
            data: {"load": 1, "id": route_id},
            success: function (result) {
                $('#data-view').html(result);
            }
        });

    }
    function goto_previous() {
        var ops_url = baseurl + 'transport/Transport_fees_controller/show_route/';
        $.ajax({
            type: "POST",
            cache: false,
            async: false,
            url: ops_url,
            data: {"load": 1},
            success: function (result) {
                $('#data-view').html(result);
            }
        });

    }
    function submit_data() {
        $('#faculty_loader').addClass('sk-loading');
        var errflag = 0;
        var ops_url = baseurl + 'transport/save-pickuppointfees/';
        var fees_data = $('#feesdata').val();
        var pickuppointname = $('#pickuppointname').val();
        var pickuppointid = $('#pickuppointid').val();
        var routeid = $('#routeid').val();
        var routeName = $('#routeName').val();
        var feesdata = $('#feesdata').val();

        if (fees == '') {
            swal('', 'Pickup point Fees is Required', 'info');
            $('#faculty_loader').removeClass('sk-loading');
            return false;
        }
        var pick_fee_data = [];
        $('.pickfee').each(function (i, v) {
            var float = /^\s*(\+|-)?((\d+(\.\d+)?)|(\.\d+))\s*$/;
            var value_for_fee = $(this).val();
            var val_len = $(this).val().length;
            var pickid = $(this).data('pickid');
            var pickname = $(this).data('pickname');

            if (float.test(value_for_fee) && val_len > 0 && parseFloat(value_for_fee) > 0) {
                $(this).css('border-color', '#e5e6e7');
                var obj_data = {};
                obj_data['pickid'] = pickid;
                obj_data['pickname'] = pickname;
                obj_data['value_for_fee'] = value_for_fee;
                pick_fee_data.push(obj_data);
            } else {
                $(this).css('border-color', 'red');
                errflag = 1;
            }
        });
        if (errflag == 1) {
            swal('', 'Please input valid values for fees.', 'info');
            pick_fee_data = [];
            $('#faculty_loader').removeClass('sk-loading');
            return false;
        }






//alert(routeid);alert(routeName);alert(pickuppointid);alert(pickuppointname);alert(feesdata);alert(feesdata);
        $.ajax({
            type: "POST",
            cache: false,
            async: false,
            url: ops_url,
            data: {"load": 1, "routeid": routeid, "routeName": routeName, "pick_fee_data": JSON.stringify(pick_fee_data), "fees_entity": feesdata},
            success: function (result) {
                var data = $.parseJSON(result);
                if (data.status == 1) {
                    load_Routes_on_show();
                    swal('Success', 'Fees for Route [ ' + routeName + '] has been created successfully.', 'success');
                    $('#faculty_loader').removeClass('sk-loading');
                    $("#curd-content").slideUp("slow", function () {
                        $("#curd-content").hide();
                        $('#add_type').show();
                    });
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
                } else {
                    swal('', 'Connection Error. Please contact administrator', 'info');
                    $('#faculty_loader').removeClass('sk-loading');
                }

            }
        });
    }
</script>