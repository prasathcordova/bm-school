<style>
    .select2-container--bootstrap .select2-selection {
        border-radius: 0px !important;
        border: 1px solid #e5e6e7;
    }

    .select2-container--bootstrap.select2-container--open .select2-selection,
    .select2-container--bootstrap.select2-container--focus .select2-selection {
        -webkit-box-shadow: none !important;
        box-shadow: none !important;
    }
</style>
<div class="wrapper wrapper-content animated fadeInRight" style="padding-top: 1px !important;padding-left: 0px !important;padding-right: 0px !important;">
    <div class="row" style="margin-left: -29px !important; margin-right: -30px !important;">
        <div class="col-lg-12">
            <!--<div class="ibox float-e-margins">-->
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header">
                        <h2 style="padding-bottom: 10px;font-size: 16px;color: #1c84c6;"><?php echo isset($sub_title) ? $sub_title : "NO TITLE PROVIDED" ?>
                            <span><a href="javascript:void(0);" onclick="close_add_country();"> <i style="font-size: 30px !important; float: right; color: #E91E63;" class="material-icons" data-toggle="tooltip" title="Close">close</i></a> </span>
                            <span><a href="javascript:void(0);" onclick="update_vehicle_details();"> <i style="font-size: 30px !important; float: right; color: #23C6C5; padding-right: 10px;" class="material-icons" data-toggle="tooltip" title="Save">save</i></a> </span>
                            <!-- <span><a href="javascript:void(0);" onclick="refresh_add_panel();"> <i style="font-size: 30px !important; float: right; color: #2196F3; padding-right: 10px;" class="material-icons " data-toggle="tooltip" title="Refresh">refresh</i></a> </span> -->
                        </h2>
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

                        <div id="student-data-container">

                            <div class="row">


                                <!--<div class="row">-->

                                <?php
                                $breaker = 0;
                                ?>
                                <div class="col-lg-12">
                                    <div id="curd-content" style="display: none;"></div>
                                    <div class="ibox-content">
                                        <?php
                                        echo form_open('vehicle/vehicle-update', array('id' => 'vehicle_update', 'role' => 'form'));
                                        ?>
                                        <?php
                                        //dev_export($vehicle_data);
                                        ?>
                                        <input type="hidden" name="vehicle_id" id="vehicle_id" value=<?php echo set_value('vehicle_id', isset($vehicle_data['id']) ? $vehicle_data['id'] : ''); ?>>
                                        <!--<form  method="post" id="myform">-->
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label>Vehicle Registration Number *</label>
                                                    <input type="text" class="form-control alphanumeric" maxlength="15" value="<?php echo set_value('vehicleNum', isset($vehicle_data['vehicleNum']) ? $vehicle_data['vehicleNum'] : ''); ?>" placeholder="Vehicle Registration Number" name="vehicleNum" id="vehicleNum" autocomplete="off">
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label>Vehicle Number (Provided By School) *</label>
                                                    <input type="text" class="form-control alphanumeric" maxlength="8" placeholder="Vehicle Number (Provided By School)" value="<?php echo set_value('schoolNum', isset($vehicle_data['schoolNum']) ? $vehicle_data['schoolNum'] : ''); ?>" name="schoolNum" id="schoolNum" autocomplete="off">
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label>Chassis Number *</label>
                                                    <input type="text" class="form-control alphanumeric" maxlength="20" placeholder="Chassis Number" value="<?php echo set_value('chaisisNum', isset($vehicle_data['chaisisNum']) ? $vehicle_data['chaisisNum'] : ''); ?>" name="chaisisNum" id="chaisisNum" autocomplete="off">
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label>Engine Number *</label>
                                                    <input type="text" class="form-control alphanumeric" maxlength="20" placeholder="Engine Number" value="<?php echo set_value('EngineNum', isset($vehicle_data['EngineNum']) ? $vehicle_data['EngineNum'] : ''); ?>" name="EngineNum" id="EngineNum" autocomplete="off">
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label>GPS IMEI</label>
                                                    <input type="text" class="form-control numeric" maxlength="17" placeholder="GPS IMEI" value="<?php echo set_value('gps_imei', isset($vehicle_data['GpsImei']) ? $vehicle_data['GpsImei'] : ''); ?>" name="gps_imei" id="gps_imei" autocomplete="off">
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label>Seat Capacity *</label>
                                                    <input type="text" class="form-control numeric" maxlength="3" placeholder="Seat Capacity" value="<?php echo set_value('seatCapacity', isset($vehicle_data['seatCapacity']) ? $vehicle_data['seatCapacity'] : ''); ?>" name="seatCapacity" id="seatCapacity" autocomplete="off" ">
                                                </div>
                                            </div>
                                            <div class=" col-sm-6">
                                                    <div class="form-group">
                                                        <label>Vehicle Type *</label>
                                                        <select class="form-control show-tick selectpicker" name="vehicleType" id="vehicleType" data-live-search="true">
                                                            <option value="-1">Select Vehicle Type</option>
                                                            <option selected value="<?php echo $vehicle_data['vehicleType'] ?>"><?php echo  $vehicle_data['vehicleTypeName'] ?></option>
                                                            <?php
                                                            if (isset($vehicletype_data) && !empty($vehicletype_data)) {
                                                                foreach ($vehicletype_data as $vehicletype) {
                                                                    if ($vehicle_data['vehicleType'] != $vehicletype['id']) // For preventing double entry for Active Attribute
                                                                        echo '<option ' . set_select('vehicleType', $vehicletype['id'], isset($vehicle_data['vehicleType']) && $vehicle_data['vehicleType'] == $vehicletype['id'] ? TRUE : FALSE) . '  value ="' . $vehicletype['id'] . '" >' . $vehicletype['vehicleTypeName'] . '</option>';
                                                                }
                                                            }
                                                            ?>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <label>Vehicle Model Year *</label>
                                                        <select class="form-control show-tick selectpicker" name="vehicleModelId" id="vehicleModelId" data-live-search="true">
                                                            <option value="-1">Select Model Year</option>
                                                            <option selected value="<?php echo $vehicle_data['vehicleModelId'] ?>"><?php echo  $vehicle_data['vehiclemodelyear'] ?></option>
                                                            <?php
                                                            if (isset($modelyr_data) && !empty($modelyr_data)) {
                                                                foreach ($modelyr_data as $model) {
                                                                    if ($vehicle_data['vehicleModelId'] != $model['id']) // For preventing double entry for Active Attribute
                                                                        echo '<option ' . set_select('vehicleModelId', $model['id'], isset($vehicle_data['vehicleModelId']) && $vehicle_data['vehicleModelId'] == $model['id'] ? TRUE : FALSE) . '  value ="' . $model['id'] . '" >' . $model['vModel'] . '</option>';
                                                                }
                                                            }
                                                            ?>
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <label>Vehicle Make *</label>
                                                        <select class="form-control show-tick selectpicker" name="vehicleMake" id="vehicleMake" data-live-search="true">
                                                            <option value="-1">Select Vehicle Make</option>
                                                            <option selected value="<?php echo $vehicle_data['vehicleMake'] ?>"><?php echo  $vehicle_data['makeName'] ?></option>
                                                            <?php
                                                            if (isset($make_data) && !empty($make_data)) {
                                                                foreach ($make_data as $make) {
                                                                    if ($vehicle_data['vehicleMake'] != $make['id']) // For preventing double entry for Active Attribute
                                                                        echo '<option  ' . set_select('vehicleMake', $make['id'], isset($vehicle_data['vehicleMake']) && $vehicle_data['vehicleMake'] == $make['id'] ? TRUE : FALSE) . '  value ="' . $make['id'] . '" >' . $make['makeName'] . '</option>';
                                                                }
                                                            }
                                                            ?>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <label>Vehicle Model *</label>
                                                        <select class="form-control show-tick selectpicker" name="companyId" id="companyId" data-live-search="true">
                                                            <option value="-1">Select Vehicle Model</option>
                                                            <option selected value="<?php echo $vehicle_data['companyId'] ?>"><?php echo  $vehicle_data['companymodel'] ?></option>
                                                            <?php
                                                            if (isset($model_data) && !empty($model_data)) {
                                                                foreach ($model_data as $model) {
                                                                    if ($vehicle_data['companyId'] != $model['id']) // For preventing double entry for Active Attribute
                                                                        echo '<option  ' . set_select('companyId', $model['id'], isset($vehicle_data['companyId']) && $vehicle_data['companyId'] == $model['id'] ? TRUE : FALSE) . '   value ="' . $model['id'] . '" >' . $model['model_name'] . '</option>';
                                                                }
                                                            }
                                                            ?>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <label>Fuel Type *</label>
                                                        <?php if ($is_fuel_log == 1) {
                                                            $readonly = "disabled='true'";
                                                            echo "<input type='hidden' name='fuelTypeId' value='" . $vehicle_data['fuelTypeId'] . "'>";
                                                        } else {
                                                            $readonly = "";
                                                        } ?>
                                                        <select class="form-control show-tick selectpicker" name="fuelTypeId" id="fuelTypeId" data-live-search="true" <?php echo $readonly ?>>
                                                            <option value="-1">Select Fuel Type</option>
                                                            <option selected value="<?php echo $vehicle_data['fuelTypeId'] ?>"><?php echo  $vehicle_data['fuelTypeName'] ?></option>
                                                            <?php
                                                            if (isset($fueltype_data) && !empty($fueltype_data)) {
                                                                foreach ($fueltype_data as $fueltype) {
                                                                    if ($vehicle_data['fuelTypeId'] != $fueltype['id']) // For preventing double entry for Active Attribute
                                                                        echo '<option ' . set_select('fuelTypeId', $fueltype['id'], isset($vehicle_data['fuelTypeId']) && $vehicle_data['fuelTypeId'] == $fueltype['id'] ? TRUE : FALSE) . ' value ="' . $fueltype['id'] . '" >' . $fueltype['fuelTypeName'] . '</option>';
                                                                }
                                                            }
                                                            ?>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6 ">

                                                    <div class="form-group">
                                                        <label>Insurance Company *</label>
                                                        <select class="form-control show-tick selectpicker" name="InsuranceCompanyId" id="InsuranceCompanyId" data-live-search="true">
                                                            <option selected value="-1">Select Insurance Company</option>
                                                            <option selected value="<?php echo $vehicle_data['InsuranceCompanyId'] ?>"><?php echo  $vehicle_data['insuranceName'] ?></option>
                                                            <?php
                                                            if (isset($inscompanyname_data) && !empty($inscompanyname_data)) {
                                                                foreach ($inscompanyname_data as $inscompanyname) {
                                                                    if ($vehicle_data['InsuranceCompanyId'] != $inscompanyname['id']) // For preventing double entry for Active Attribute
                                                                        echo '<option ' . set_select('inscompanyname', $inscompanyname['id'], isset($vehicle_data['InsuranceCompanyId']) && $vehicle_data['InsuranceCompanyId'] == $inscompanyname['id'] ? TRUE : FALSE) . ' value ="' . $inscompanyname['id'] . '" >' . $inscompanyname['insuranceName'] . '</option>';
                                                                }
                                                            }
                                                            ?>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="form-group date">
                                                        <label>Insurance Date *</label>
                                                        <input type="text" class="form-control" placeholder="Insurance  Date" value="<?php echo set_value('insuranceDate', isset($vehicle_data['insuranceDate']) ? date('d/m/Y', strtotime($vehicle_data['insuranceDate'])) : ''); ?>" name="insuranceDate" id="insuranceDate" readonly="" style="background-color: #fff;">
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <label>Insurance Expiry Date *</label>
                                                        <input type="text" class="form-control" placeholder="Insurance Expiry Date" value="<?php echo set_value('insuranceExpiryDate', isset($vehicle_data['insuranceExpiryDate']) ? date('d/m/Y', strtotime($vehicle_data['insuranceExpiryDate'])) : ''); ?>" name="insuranceExpiryDate" id="insuranceExpiryDate" autocomplete="off" readonly="" style="background-color: #fff;">
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <label>Tax Date *</label>
                                                        <input type="text" class="form-control" placeholder="Tax Date" value="<?php echo set_value('taxDate', isset($vehicle_data['taxDate']) ? date('d/m/Y', strtotime($vehicle_data['taxDate'])) : ''); ?>" name="taxDate" id="taxDate" autocomplete="off" readonly="" style="background-color: #fff;">
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <label>Tax Expiry Date *</label>
                                                        <input type="text" class="form-control" placeholder="Tax Expiry Date" value="<?php echo set_value('taxExpiryDate', isset($vehicle_data['taxExpiryDate']) ? date('d/m/Y', strtotime($vehicle_data['taxExpiryDate'])) : ''); ?>" name="taxExpiryDate" id="taxExpiryDate" autocomplete="off" readonly="" style="background-color: #fff;">
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <label>Permit Date *</label>
                                                        <input type="text" class="form-control" placeholder="Permit Date" value="<?php echo set_value('permitDate', isset($vehicle_data['permitDate']) ? date('d/m/Y', strtotime($vehicle_data['permitDate'])) : ''); ?>" name="permitDate" id="permitDate" autocomplete="off" readonly="" style="background-color: #fff;">
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <label>Permit Expiry Date *</label>
                                                        <input type="text" class="form-control" placeholder="Permit Expiry Date" value="<?php echo set_value('permitExpiryDate', isset($vehicle_data['permitExpiryDate']) ? date('d/m/Y', strtotime($vehicle_data['permitExpiryDate'])) : ''); ?>" schoolNum name="permitExpiryDate" id="permitExpiryDate" autocomplete="off" readonly="" style="background-color: #fff;">
                                                    </div>
                                                </div>
                                            </div>
                                            </form>
                                        </div>
                                        <?php
                                        if ($breaker == 3) {
                                            echo '<div class="clearfix"></div>';
                                            $breaker = 0;
                                        } else {
                                            $breaker++;
                                        }
                                        //                                    }
                                        //                                }
                                        ?>
                                    </div>
                                    <!--</div>-->
                                </div>
                                <!--</div>-->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>



    <script type="text/javascript">
        function update_vehicle_details() {
            var vehicle_id = $('#vehicle_id').val();

            var vehicleNum = $('#vehicleNum').val();
            var schoolNum = $('#schoolNum').val();
            var EngineNum = $('#EngineNum').val();
            var gps_imei = $('#gps_imei').val();
            var chaisisNum = $('#chaisisNum').val();
            var vehicleModelId = $('#vehicleModelId').val();
            var companyId = $('#companyId').val();
            var vehicleMake = $('#vehicleMake').val();
            var seatCapacity = $('#seatCapacity').val();
            var vehicleType = $('#vehicleType').val();
            var fuelTypeId = $('#fuelTypeId').val();
            var InsuranceCompanyId = $('#InsuranceCompanyId').val();
            var insuranceDate = moment($("#insuranceDate").val(), "DD/MM/YYYY").format('YYYY-MM-DD');
            var insuranceExpiryDate = moment($("#insuranceExpiryDate").val(), "DD/MM/YYYY").format('YYYY-MM-DD');
            var taxDate = moment($("#taxDate").val(), "DD/MM/YYYY").format('YYYY-MM-DD');
            var taxExpiryDate = moment($("#taxExpiryDate").val(), "DD/MM/YYYY").format('YYYY-MM-DD');
            var permitDate = moment($("#permitDate").val(), "DD/MM/YYYY").format('YYYY-MM-DD');
            var permitExpiryDate = moment($("#permitExpiryDate").val(), "DD/MM/YYYY").format('YYYY-MM-DD');

            //        if (vehiclenum == '') {
            //            swal('', 'Vehicle Number is required.', 'info');
            //            $('#faculty_loader').removeClass('sk-loading');
            //            return false;
            //        }

            var numbers = /^[0-9]*$/;
            if (vehicle_id == '') {
                swal('', 'Something has gone wrong, Please try Again', 'info');
                $('#faculty_loader').removeClass('sk-loading');
                return false;
            }
            if (vehicleNum == '') {
                swal('', 'Vehicle Registration Number is required.', 'info');
                $('#faculty_loader').removeClass('sk-loading');
                return false;
            } else if ((vehicleNum.length > '20') || (vehicleNum.length < '3')) {
                swal('', 'Vehicle Registration Number should contain letters or numbers 3 to 20.', 'info');
                $('#faculty_loader').removeClass('sk-loading');
                return false;
            }
            if (schoolNum == '') {
                swal('', 'Vehicle Number (Provided By School) is required.', 'info');
                $('#faculty_loader').removeClass('sk-loading');
                return false;
            }
            if (chaisisNum == '') {
                swal('', 'Chassis Number is required.', 'info');
                $('#faculty_loader').removeClass('sk-loading');
                return false;
            } else if ((chaisisNum.length > '20') || (chaisisNum.length < '10')) {
                swal('', 'Chassis Number should contain letters or numbers 10 to 20.', 'info');
                $('#faculty_loader').removeClass('sk-loading');
                return false;
            }
            if (EngineNum == '') {
                swal('', 'Engine Number is required.', 'info');
                $('#faculty_loader').removeClass('sk-loading');
                return false;
            } else if ((EngineNum.length > '20') || (EngineNum.length < '10')) {
                swal('', 'Engine Number should contain letters or numbers 10 to 20.', 'info');
                $('#faculty_loader').removeClass('sk-loading');
                return false;
            }
            if (gps_imei != '') {
                if ((gps_imei.length > '17') || (gps_imei.length < '15')) {
                    swal('', 'GPS IMEI should contain numbers 15 to 17.', 'info');
                    $('#faculty_loader').removeClass('sk-loading');
                    return false;
                } else if (!numbers.test(gps_imei)) {
                    swal('', 'GPS IMEI can have only numbers.', 'info');
                    $('#faculty_loader').removeClass('sk-loading');
                    return false;
                }
            }
            if (seatCapacity == '') {
                swal('', 'Seat Capacity is required.', 'info');
                $('#faculty_loader').removeClass('sk-loading');
                return false;
            } else if ((seatCapacity.length > '3')) {
                swal('', 'Seat Capacity should contain 3 digit numbers .', 'info');
                $('#faculty_loader').removeClass('sk-loading');
                return false;
            } else if (!numbers.test(seatCapacity)) {
                swal('', 'Seat Capacity can have only numbers.', 'info');
                $('#faculty_loader').removeClass('sk-loading');
                return false;
            }
            if (vehicleType == -1) {
                swal('', 'Vehicle Type is required.', 'info');
                $('#faculty_loader').removeClass('sk-loading');
                return false;
            }
            if (vehicleModelId == -1) {
                swal('', 'Vehicle Model Year is required.', 'info');
                $('#faculty_loader').removeClass('sk-loading');
                return false;
            }

            if (vehicleMake == -1) {
                swal('', 'Vehicle Make is required.', 'info');
                $('#faculty_loader').removeClass('sk-loading');
                return false;
            }
            if (companyId == -1) {
                swal('', 'Vehicle Model is required.', 'info');
                $('#faculty_loader').removeClass('sk-loading');
                return false;
            }
            if (fuelTypeId == -1) {
                swal('', 'Fuel Type is required.', 'info');
                $('#faculty_loader').removeClass('sk-loading');
                return false;
            }
            if (InsuranceCompanyId == -1) {
                swal('', 'Insurance Company is required.', 'info');
                $('#faculty_loader').removeClass('sk-loading');
                return false;
            }
            if (insuranceDate == 'Invalid date') {
                swal('', 'Insurance date is required.', 'info');
                $('#faculty_loader').removeClass('sk-loading');
                return false;
            }
            if (insuranceExpiryDate == 'Invalid date') {
                swal('', 'Insurance Expiry Date is required.', 'info');
                $('#faculty_loader').removeClass('sk-loading');
                return false;
            }

            if (insuranceDate > insuranceExpiryDate) {
                swal('', 'Please ensure that the Insurance Expiry Date is greater than Insurance Start Date.', 'info');
                return false;
            }
            if (taxDate == 'Invalid date') {
                swal('', 'Tax Date is required.', 'info');
                $('#faculty_loader').removeClass('sk-loading');
                return false;
            }
            if (taxExpiryDate == 'Invalid date') {
                swal('', 'Tax  Expiry Date is required.', 'info');
                $('#faculty_loader').removeClass('sk-loading');
                return false;
            }
            if (taxDate > taxExpiryDate) {
                swal('', 'Please ensure that the Tax Expiry Date is greater than Tax Start Date.', 'info');
                return false;
            }
            if (permitDate == 'Invalid date') {
                swal('', 'Permit Date is required.', 'info');
                $('#faculty_loader').removeClass('sk-loading');
                return false;
            }
            if (permitExpiryDate == 'Invalid date') {
                swal('', 'Permit  Expiry Date is required.', 'info');
                $('#faculty_loader').removeClass('sk-loading');
                return false;
            }
            if (permitDate > permitExpiryDate) {
                swal('', 'Please ensure that the Permit Expiry Date is greater than Permit Start Date.', 'info');
                return false;
            }



            var register_vehicle = new Object();
            register_vehicle.vehicleNum = vehicleNum;
            register_vehicle.schoolNum = schoolNum;
            register_vehicle.EngineNum = EngineNum;
            register_vehicle.gps_imei = gps_imei;
            register_vehicle.chaisisNum = chaisisNum;
            register_vehicle.vehicleType = vehicleType;
            register_vehicle.vehicleModelId = vehicleModelId;
            register_vehicle.vehicleMake = vehicleMake;
            register_vehicle.seatCapacity = seatCapacity;
            register_vehicle.companyId = companyId;
            register_vehicle.fuelTypeId = fuelTypeId;
            register_vehicle.InsuranceCompanyId = InsuranceCompanyId;
            register_vehicle.insuranceDate = insuranceDate;
            register_vehicle.insuranceExpiryDate = insuranceExpiryDate;
            register_vehicle.taxDate = taxDate;
            register_vehicle.taxExpiryDate = taxExpiryDate;
            register_vehicle.permitDate = permitDate;
            register_vehicle.permitExpiryDate = permitExpiryDate;

            var vehicledata = JSON.stringify(register_vehicle);
            var ops_url = baseurl + 'transport/update-vehicleregistration-details';
            $.ajax({
                type: "POST",
                cache: false,
                async: false,
                url: ops_url,
                data: {
                    "load": 1,
                    "vehicle_id": vehicle_id,
                    "vehicledata": vehicledata
                },
                success: function(result) {
                    var data = JSON.parse(result);

                    if (data.status == 1) {

                        swal('Success', 'Vehicle, ' + schoolNum + ' updated successfully.', 'success');
                        $('#faculty_loader').removeClass('sk-loading');
                        $("#curd-content").slideUp("slow", function() {
                            $("#curd-content").hide();
                        });
                        load_vehicledata_list();

                    } else if (data.status == 0) {
                        swal('', data.message, 'info');
                        $('#faculty_loader').removeClass('sk-loading');
                    } else if (data.status == 3) {
                        swal('', data.message, 'info');
                        $('#faculty_loader').removeClass('sk-loading');
                    } else {
                        swal('', 'Connection Error. Please contact administrator', 'info');
                        $('#faculty_loader').removeClass('sk-loading');
                    }
                }
            });
        }

        $(document).ready(function() {
            $('.form-control').focus(function() {
                $(this).parent().addClass('focused');
            });


            // On focusout event
            $('.form-control').change(function() {
                var $this = $(this);
                if ($this.parents('.form-group').hasClass('form-float')) {
                    if ($this.val() == '') {
                        $this.parents('.form-line').removeClass('focused');
                    }
                } else {
                    $this.parents('.form-line').removeClass('focused');
                }
            });

            $('.selectpicker').select2({
                "theme": "bootstrap",
                "width": "100%"
            });

            $('#insuranceDate').datepicker({
                todayBtn: "linked",
                keyboardNavigation: false,
                forceParse: false,
                calendarWeeks: true,
                autoclose: true,
                format: 'dd/mm/yyyy',
                //startDate: '<?php echo $this->session->userdata('lock_start_date'); ?>',
                //endDate: '<?php echo $this->session->userdata('lock_end_date'); ?>'
            });
            $('#insuranceExpiryDate').datepicker({
                todayBtn: "linked",
                keyboardNavigation: false,
                forceParse: false,
                calendarWeeks: true,
                autoclose: true,
                format: 'dd/mm/yyyy',
                //startDate: '<?php echo $this->session->userdata('lock_start_date'); ?>',
                //endDate: '<?php echo $this->session->userdata('lock_end_date'); ?>'
            });
            $('#taxDate').datepicker({
                todayBtn: "linked",
                keyboardNavigation: false,
                forceParse: false,
                calendarWeeks: true,
                autoclose: true,
                format: 'dd/mm/yyyy',
                //startDate: '<?php echo $this->session->userdata('lock_start_date'); ?>',
                //endDate: '<?php echo $this->session->userdata('lock_end_date'); ?>'
            });
            $('#taxExpiryDate').datepicker({
                todayBtn: "linked",
                keyboardNavigation: false,
                forceParse: false,
                calendarWeeks: true,
                autoclose: true,
                format: 'dd/mm/yyyy',
                //startDate: '<?php echo $this->session->userdata('lock_start_date'); ?>',
                //endDate: '<?php echo $this->session->userdata('lock_end_date'); ?>'
            });
            $('#permitDate').datepicker({
                todayBtn: "linked",
                keyboardNavigation: false,
                forceParse: false,
                calendarWeeks: true,
                autoclose: true,
                format: 'dd/mm/yyyy',
                //startDate: '<?php echo $this->session->userdata('lock_start_date'); ?>',
                //endDate: '<?php echo $this->session->userdata('lock_end_date'); ?>'
            });
            $('#permitExpiryDate').datepicker({
                todayBtn: "linked",
                keyboardNavigation: false,
                forceParse: false,
                calendarWeeks: true,
                autoclose: true,
                format: 'dd/mm/yyyy',
                //startDate: '<?php echo $this->session->userdata('lock_start_date'); ?>',
                //endDate: '<?php echo $this->session->userdata('lock_end_date'); ?>'
            });
        });


        function refresh_add_panel() {
            $('#vehicleNum').val('');
            $('#schoolNum').val('');
            $('#chaisisNum').val('');
            $('#seatCapacity').val('');
            $('#vehicleType').val(-1).trigger('change');
            $('#vehicleModelId').val(-1).trigger('change');
            $('#vehicleMake').val(-1).trigger('change');
            $('#companyId').val(-1).trigger('change');
            $('#fuelTypeId').val(-1).trigger('change');
            $('#InsuranceCompanyId').val(-1).trigger('change');
            $('#EngineNum').val('');
            $('#insuranceDate').val('');
            $('#insuranceExpiryDate').val('');
            $('#taxDate').val('');
            $('#taxExpiryDate').val('');
            $('#permitDate').val('');
            $('#permitExpiryDate').val('');





        }
        $('.chosen-select').chosen({
            width: "100%"
        });

        $("#model_select").select2({
            "theme": "bootstrap",
            "width": "100%"
        });
        $(".select2_insurance").select2({
            "theme": "bootstrap",
            "width": "100%"
        });
        $(".select2_vehiclecmpny").select2({
            "theme": "bootstrap",
            "width": "100%"
        });
        $(".select2_make").select2({
            "theme": "bootstrap",
            "width": "100%"
        });
        $(".select2_model").select2({
            "theme": "bootstrap",
            "width": "100%"
        });
        $(".select2_vehiclemodel").select2({
            "theme": "bootstrap",
            "width": "100%"
        });
    </script>