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
                            <span><a href="javascript:void(0);" onclick="save_vehicle_details();"> <i style="font-size: 30px !important; float: right; color: #23C6C5; padding-right: 10px;" class="material-icons" data-toggle="tooltip" title="Save">save</i></a> </span>
                            <span><a href="javascript:void(0);" onclick="refresh_add_panel();"> <i style="font-size: 30px !important; float: right; color: #2196F3; padding-right: 10px;" class="material-icons " data-toggle="tooltip" title="Refresh">refresh</i></a> </span>
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
                                        echo form_open('vehicle/add-vehicle', array('id' => 'vehicle_save', 'role' => 'form'));
                                        ?>
                                        <!--<form  method="post" id="myform">-->
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label>Vehicle Registration Number *</label>
                                                    <input type="text" class="form-control alphanumeric" maxlength="15" placeholder="Vehicle Registration Number" name="reg_num" id="reg_num" autocomplete="off">
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label>Vehicle Number (Provided By School) *</label>
                                                    <input type="text" class="form-control alphanumeric" maxlength="8" placeholder="Vehicle Number (Provided By School)" name="vehicle_num" id="vehicle_num" autocomplete="off">
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label>Chassis Number *</label>
                                                    <input type="text" class="form-control alphanumeric" maxlength="20" placeholder="Chassis Number" name="chasisnum" id="chasisnum" autocomplete="off">
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label>Engine Number *</label>
                                                    <input type="text" class="form-control alphanumeric" maxlength="20" placeholder="Engine Number" name="eng_num" id="eng_num" autocomplete="off">
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label>GPS IMEI</label>
                                                    <input type="text" class="form-control numeric" maxlength="17" placeholder="GPS IMEI" name="gps_imei" id="gps_imei" autocomplete="off">
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label>Seat Capacity *</label>
                                                    <input type="text" class="form-control numeric" maxlength="3" placeholder="Seat Capacity" name="seatcapcity" id="seatcapcity" autocomplete="off">
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label>Vehicle Type *</label>
                                                    <select class="form-control selectpicker" name="vtype_select" id="vtype_select" data-live-search="true">
                                                        <option selected value="-1">Select Vehicle Type</option>
                                                        <?php
                                                        if (isset($vehicletype_data) && !empty($vehicletype_data)) {
                                                            foreach ($vehicletype_data as $vehicletype) {
                                                                echo '<option value ="' . $vehicletype['id'] . '" >' . $vehicletype['vehicleTypeName'] . '</option>';
                                                            }
                                                        }
                                                        ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <!-- <div class="clearfix"></div> -->
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label>Vehicle Model Year *</label>
                                                    <select class="form-control show-tick selectpicker" name="modelyr_select" id="modelyr_select" data-live-search="true">
                                                        <option selected value="-1">Select Model Year</option>
                                                        <?php
                                                        if (isset($modelyr_data) && !empty($modelyr_data)) {
                                                            foreach ($modelyr_data as $model) {
                                                                echo '<option value ="' . $model['id'] . '" >' . $model['vModel'] . '</option>';
                                                            }
                                                        }
                                                        ?>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label>Vehicle Make *</label>
                                                    <select class="form-control show-tick selectpicker" name="make_select" id="make_select" data-live-search="true">
                                                        <option selected value="-1">Select Vehicle Make</option>
                                                        <?php
                                                        if (isset($make_data) && !empty($make_data)) {
                                                            foreach ($make_data as $make) {
                                                                echo '<option value ="' . $make['id'] . '" >' . $make['makeName'] . '</option>';
                                                            }
                                                        }
                                                        ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label>Vehicle Model *</label>
                                                    <select class="form-control show-tick selectpicker" name="vehiclemodel_select" id="vehiclemodel_select" data-live-search="true">
                                                        <option selected value="-1">Select Vehicle Model</option>
                                                        <?php
                                                        if (isset($model_data) && !empty($model_data)) {
                                                            foreach ($model_data as $model) {
                                                                echo '<option value ="' . $model['id'] . '" >' . $model['model_name'] . '</option>';
                                                            }
                                                        }
                                                        ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label>Fuel Type *</label>
                                                    <select class="form-control show-tick selectpicker" name="fueltype_select" id="fueltype_select" data-live-search="true">
                                                        <option selected value="-1">Select Fuel Type</option>
                                                        <?php
                                                        if (isset($fueltype_data) && !empty($fueltype_data)) {
                                                            foreach ($fueltype_data as $fueltype) {
                                                                echo '<option value ="' . $fueltype['id'] . '" >' . $fueltype['fuelTypeName'] . '</option>';
                                                            }
                                                        }
                                                        ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-sm-6 ">

                                                <div class="form-group">
                                                    <label>Insurance Company *</label>
                                                    <select class="form-control show-tick selectpicker" name="insurancecmpny_select" id="insurancecmpny_select" data-live-search="true">
                                                        <option selected value="-1">Select Insurance Company</option>
                                                        <?php
                                                        if (isset($inscompanyname_data) && !empty($inscompanyname_data)) {
                                                            foreach ($inscompanyname_data as $inscompanyname) {
                                                                echo '<option value ="' . $inscompanyname['id'] . '" >' . $inscompanyname['insuranceName'] . '</option>';
                                                            }
                                                        }
                                                        ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="form-group date">
                                                    <label>Insurance Date *</label>
                                                    <input type="text" class="form-control" placeholder="Insurance  Date" name="ins_date" id="ins_date" readonly="" style="background-color: #fff;">
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label>Insurance Expiry Date *</label>
                                                    <input type="text" class="form-control" placeholder="Insurance Expiry Date" name="insexp_date" id="insexp_date" autocomplete="off" readonly="" style="background-color: #fff;">
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label>Tax Date *</label>
                                                    <input type="text" class="form-control" placeholder="Tax Date" name="tax_date" id="tax_date" autocomplete="off" readonly="" style="background-color: #fff;">
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label>Tax Expiry Date *</label>
                                                    <input type="text" class="form-control" placeholder="Tax Expiry Date" name="taxexpiry_date" id="taxexpiry_date" autocomplete="off" readonly="" style="background-color: #fff;">
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label>Permit Date *</label>
                                                    <input type="text" class="form-control" placeholder="Permit Date" name="permit_date" id="permit_date" autocomplete="off" readonly="" style="background-color: #fff;">
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label>Permit Expiry Date *</label>
                                                    <input type="text" class="form-control" placeholder="Permit Expiry Date" name="permitexpiry_date" id="permitexpiry_date" autocomplete="off" readonly="" style="background-color: #fff;">
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

        $('#permitexpiry_date').datepicker({
            todayBtn: "linked",
            keyboardNavigation: false,
            forceParse: false,
            calendarWeeks: true,
            autoclose: true,
            format: 'dd/mm/yyyy',
            //startDate: '<?php echo $this->session->userdata('lock_start_date'); ?>',
            //endDate: '<?php echo $this->session->userdata('lock_end_date'); ?>'
        });
        $('#permit_date').datepicker({
            todayBtn: "linked",
            keyboardNavigation: false,
            forceParse: false,
            calendarWeeks: true,
            autoclose: true,
            format: 'dd/mm/yyyy',
            //startDate: '<?php echo $this->session->userdata('lock_start_date'); ?>',
            //endDate: '<?php echo $this->session->userdata('lock_end_date'); ?>'
        });
        $('#taxexpiry_date').datepicker({
            todayBtn: "linked",
            keyboardNavigation: false,
            forceParse: false,
            calendarWeeks: true,
            autoclose: true,
            format: 'dd/mm/yyyy',
            //startDate: '<?php echo $this->session->userdata('lock_start_date'); ?>',
            //endDate: '<?php echo $this->session->userdata('lock_end_date'); ?>'
        });
        $('#tax_date').datepicker({
            todayBtn: "linked",
            keyboardNavigation: false,
            forceParse: false,
            calendarWeeks: true,
            autoclose: true,
            format: 'dd/mm/yyyy',
            //startDate: '<?php echo $this->session->userdata('lock_start_date'); ?>',
            //endDate: '<?php echo $this->session->userdata('lock_end_date'); ?>'
        });
        $('#insexp_date').datepicker({
            todayBtn: "linked",
            keyboardNavigation: false,
            forceParse: false,
            calendarWeeks: true,
            autoclose: true,
            format: 'dd/mm/yyyy',
            //startDate: '<?php echo $this->session->userdata('lock_start_date'); ?>',
            //endDate: '<?php echo $this->session->userdata('lock_end_date'); ?>'
        });
        $('#ins_date').datepicker({
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
        $('#vehicle_num').val('');
        $('#reg_num').val('');
        $('#chasisnum').val('');
        $('#seatcapcity').val('');
        $('#eng_num').val('');
        $('#gps_imei').val('');
        $('#ins_date').val('');
        $('#insexp_date').val('');
        $('#tax_date').val('');
        $('#taxexpiry_date').val('');
        $('#permit_date').val('');
        $('#permitexpiry_date').val('');
        $('#vtype_select').val(-1).trigger('change');
        $('#vehiclemodel_select').val(-1).trigger('change');
        $('#fueltype_select').val(-1).trigger('change');
        $('#insurancecmpny_select').val(-1).trigger('change');
        $('#modelyr_select').val(-1).trigger('change');
        $('#make_select').val(-1).trigger('change');

    }
    $('.chosen-select').chosen({
        width: "100%"
    });

    // $("#model_select").select2({
    //     "theme": "bootstrap",
    //     "width": "100%"
    // });
    // $(".select2_insurance").select2({
    //     "theme": "bootstrap",
    //     "width": "100%"
    // });
    // $(".select2_vehiclecmpny").select2({
    //     "theme": "bootstrap",
    //     "width": "100%"
    // });
    // $(".select2_make").select2({
    //     "theme": "bootstrap",
    //     "width": "100%"
    // });
    // $(".select2_model").select2({
    //     "theme": "bootstrap",
    //     "width": "100%"
    // });
    // $(".select2_vehiclemodel").select2({
    //     "theme": "bootstrap",
    //     "width": "100%"
    // });

    function save_vehicle_details() {
        var regnum = $('#reg_num').val();
        var vehiclenum = $('#vehicle_num').val();
        var engnum = $('#eng_num').val();
        var gps_imei = $('#gps_imei').val();
        var chasis_num = $('#chasisnum').val();
        var modelselect = $('#modelyr_select').val();
        var makeselect = $('#make_select').val();
        var seat_capcity = $('#seatcapcity').val();
        var vtype_select = $('#vtype_select').val();
        var vehiclemodel_select = $('#vehiclemodel_select').val();
        var fueltypeselect = $('#fueltype_select').val();
        var insurancecmpnyselect = $('#insurancecmpny_select').val();
        var ins_date = moment($("#ins_date").datepicker("getDate")).format('YYYY-MM-DD');
        var insexp_date = moment($("#insexp_date").datepicker("getDate")).format('YYYY-MM-DD');
        var tax_date = moment($("#tax_date").datepicker("getDate")).format('YYYY-MM-DD');
        var taxexpiry_date = moment($("#taxexpiry_date").datepicker("getDate")).format('YYYY-MM-DD');
        var permit_date = moment($("#permit_date").datepicker("getDate")).format('YYYY-MM-DD');
        var permitexpiry_date = moment($("#permitexpiry_date").datepicker("getDate")).format('YYYY-MM-DD');

        var numbers = /^[0-9]*$/;

        if (regnum == '') {
            swal('', 'Vehicle Registration Number is required.', 'info');
            $('#faculty_loader').removeClass('sk-loading');
            return false;
        } else if ((regnum.length > '20') || (regnum.length < '3')) {
            swal('', 'Vehicle Registration Number should contain letters or numbers 3 to 20.', 'info');
            $('#faculty_loader').removeClass('sk-loading');
            return false;
        }
        if (vehiclenum == '') {
            swal('', 'Vehicle Number (Provided By School) is required.', 'info');
            $('#faculty_loader').removeClass('sk-loading');
            return false;
        }
        if (chasis_num == '') {
            swal('', 'Chassis Number is required.', 'info');
            $('#faculty_loader').removeClass('sk-loading');
            return false;
        } else if ((chasis_num.length > '20') || (chasis_num.length < '10')) {
            swal('', 'Chassis Number should contain letters or numbers 10 to 20.', 'info');
            $('#faculty_loader').removeClass('sk-loading');
            return false;
        }
        if (engnum == '') {
            swal('', 'Engine Number is required.', 'info');
            $('#faculty_loader').removeClass('sk-loading');
            return false;
        } else if ((engnum.length > '20') || (engnum.length < '10')) {
            swal('', 'Engine Number should contain letters or numbers 10 to 20.', 'info');
            $('#faculty_loader').removeClass('sk-loading');
            return false;
        }
        if (gps_imei != '') {
            if ((gps_imei.length > '17') || (gps_imei.length < '15')) {
                swal('', 'GPS IMEI should contain numbers 15 to 17..', 'info');
                $('#faculty_loader').removeClass('sk-loading');
                return false;
            } else if (!numbers.test(gps_imei)) {
                swal('', 'GPS IMEI can have only numbers.', 'info');
                $('#faculty_loader').removeClass('sk-loading');
                return false;
            }
        }

        if (seat_capcity == '') {
            swal('', 'Seat Capacity is required.', 'info');
            $('#faculty_loader').removeClass('sk-loading');
            return false;
        } else if ((seat_capcity.length > '3')) {
            swal('', 'Seat Capacity should contain 3 digit numbers .', 'info');
            $('#faculty_loader').removeClass('sk-loading');
            return false;
        } else if (!numbers.test(seat_capcity)) {
            swal('', 'Seat Capacity can have only numbers.', 'info');
            $('#faculty_loader').removeClass('sk-loading');
            return false;
        }

        if (vtype_select == -1) {
            swal('', 'Vehicle Type is required.', 'info');
            $('#faculty_loader').removeClass('sk-loading');
            return false;
        }
        if (modelselect == -1) {
            swal('', 'Vehicle Model Year is required.', 'info');
            $('#faculty_loader').removeClass('sk-loading');
            return false;
        }
        if (makeselect == -1) {
            swal('', 'Vehicle Make is required.', 'info');
            $('#faculty_loader').removeClass('sk-loading');
            return false;
        }
        if (vehiclemodel_select == -1) {
            swal('', 'Vehicle Model is required.', 'info');
            $('#faculty_loader').removeClass('sk-loading');
            return false;
        }
        if (fueltypeselect == -1) {
            swal('', 'Fuel Type is required.', 'info');
            $('#faculty_loader').removeClass('sk-loading');
            return false;
        }
        if (insurancecmpnyselect == -1) {
            swal('', 'Insurance Company is required.', 'info');
            $('#faculty_loader').removeClass('sk-loading');
            return false;
        }
        if (ins_date == 'Invalid date') {
            swal('', 'Insurance date is required.', 'info');
            $('#faculty_loader').removeClass('sk-loading');
            return false;
        }
        if (insexp_date == 'Invalid date') {
            swal('', 'Insurance Expiry Date is required.', 'info');
            $('#faculty_loader').removeClass('sk-loading');
            return false;
        }

        if (ins_date > insexp_date) {
            swal('', 'Please ensure that the Insurance Expiry Date is greater than Insurance Start Date.', 'info');
            return false;
        }
        if (tax_date == 'Invalid date') {
            swal('', 'Tax Date is required.', 'info');
            $('#faculty_loader').removeClass('sk-loading');
            return false;
        }
        if (taxexpiry_date == 'Invalid date') {
            swal('', 'Tax  Expiry Date is required.', 'info');
            $('#faculty_loader').removeClass('sk-loading');
            return false;
        }
        if (tax_date > taxexpiry_date) {
            swal('', 'Please ensure that the Tax Expiry Date is greater than Tax Start Date.', 'info');
            return false;
        }
        if (permit_date == 'Invalid date') {
            swal('', 'Permit Date is required.', 'info');
            $('#faculty_loader').removeClass('sk-loading');
            return false;
        }
        if (permitexpiry_date == 'Invalid date') {
            swal('', 'Permit  Expiry Date is required.', 'info');
            $('#faculty_loader').removeClass('sk-loading');
            return false;
        }
        if (permit_date > permitexpiry_date) {
            swal('', 'Please ensure that the Permit Expiry Date is greater than Permit Start Date.', 'info');
            return false;
        }



        var register_vehicle = new Object();
        register_vehicle.vehiclenum = regnum;
        register_vehicle.schoolnum = vehiclenum;
        register_vehicle.engnum = engnum;
        register_vehicle.gps_imei = gps_imei;
        register_vehicle.chasis_num = chasis_num;
        register_vehicle.vehicletypeselect = vtype_select;
        register_vehicle.modelselect = modelselect;
        register_vehicle.makeselect = makeselect;
        register_vehicle.seat_capcity = seat_capcity;
        register_vehicle.vehiclemodel_select = vehiclemodel_select;
        register_vehicle.fueltypeselect = fueltypeselect;
        register_vehicle.insurancecmpnyselect = insurancecmpnyselect;
        register_vehicle.ins_date = ins_date;
        register_vehicle.insexp_date = insexp_date;
        register_vehicle.tax_date = tax_date;
        register_vehicle.taxexpiry_date = taxexpiry_date;
        register_vehicle.permit_date = permit_date;
        register_vehicle.permitexpiry_date = permitexpiry_date;

        var vehicledata = JSON.stringify(register_vehicle);
        var ops_url = baseurl + 'transport/save-vehicleregistration-details';
        $.ajax({
            type: "POST",
            cache: false,
            async: false,
            url: ops_url,
            data: {
                "load": 1,
                "vehicledata": vehicledata
            },
            success: function(result) {
                var data = JSON.parse(result);

                if (data.status == 1) {

                    swal('Success', 'Vehicle, ' + vehiclenum + ' created successfully.', 'success');
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
</script>