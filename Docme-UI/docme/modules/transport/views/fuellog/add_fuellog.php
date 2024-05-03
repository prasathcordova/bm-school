<!-- <div class="wrapper wrapper-content animated fadeInRight" style="padding-top: 1px !important;padding-left: 0px !important;padding-right: 0px !important;"> -->
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="header">
                <h2 style="padding-bottom: 10px;font-size: 16px;color: #1c84c6;"><?php echo isset($sub_title) ? $sub_title : "NO TITLE PROVIDED" ?>
                    <span><a href="javascript:void(0);" onclick="close_add_country();"> <i style="font-size: 30px !important; float: right; color: #E91E63;" class="material-icons" data-toggle="tooltip" title="Close">close</i></a> </span>
                    <span><a href="javascript:void(0);" onclick="save_fuellog_details();"> <i style="font-size: 30px !important; float: right; color: #23C6C5; padding-right: 10px;" class="material-icons" data-toggle="tooltip" title="Save">save</i></a> </span>
                    <span><a href="javascript:void(0);" onclick="refresh_add_panel();"> <i style="font-size: 30px !important; float: right; color: #2196F3; padding-right: 10px;" class="material-icons " data-toggle="tooltip" title="Refresh">refresh</i></a> </span>
                </h2>

            </div> <input type="hidden" name="fuel_type" id="fuel_type" value="<?php echo isset($fuel_types) && !empty($fuel_types) ? $fuel_types : ''; ?>" />
        </div> <input type="hidden" name="fuel_type_id" id="fuel_type_id" value="<?php echo isset($fuel_type_id) && !empty($fuel_type_id) ? $fuel_type_id : ''; ?>" />

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
                    <?php
                    $breaker = 0;
                    ?>
                    <div class="col-lg-12">
                        <div id="curd-content" style="display: none;"></div>
                        <div class="ibox-content">
                            <input type="hidden" name="vehicleid" id="vehicleid" value="<?php echo isset($vehicle_id) && !empty($vehicle_id) ? $vehicle_id : ''; ?>" />
                            <input type="hidden" name="vehicleNum" id="vehicleNum" value="<?php echo isset($vehicleNum) && !empty($vehicleNum) ? $vehicleNum : ''; ?>" />
                            <form method="post" id="myform">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <!-- <div class="form-line"> -->
                                            <label class="form-label">Fuel Price (Per Litre) *</label>
                                            <input type="text" placeholder="Fuel Price (Per Litre)" maxlength="5" class="form-control numeric" name="fuel_price" id="fuel_price" autocomplete="off">

                                            <!-- </div> -->
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <!-- <div class="form-line"> -->
                                            <label class="form-label">Fuel Quantity (Litres) *</label>
                                            <input type="text" placeholder="Fuel Quantity (Litres)" maxlength="5" class="form-control numeric" name="fuel_qty" id="fuel_qty" autocomplete="off">

                                            <!-- </div> -->
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <!-- <div class="form-line"> -->
                                            <label class="form-label">Odometer Reading *</label>
                                            <input type="text" placeholder="Odometer Reading" maxlength="8" class="form-control digits" name="odometer_reading" id="odometer_reading" autocomplete="off">

                                            <!-- </div> -->
                                        </div>
                                    </div>

                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <!-- <div class="form-line"> -->
                                            <label class="form-label">Fuel Fill Date *</label>
                                            <input type="text" placeholder="Fuel Fill Date" class="form-control" name="fuel_fill_date" id="fuel_fill_date" autocomplete="off" readonly style="background:#fff">

                                            <!-- </div> -->
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
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- </div> -->



<script type="text/javascript">
    $(document).ready(function() {
        $('.form-control').focus(function() {
            $(this).parent().addClass('focused');
        });
        var latest_fuel_log_date = moment($('#latest_fuel_log_date').val(), "YYYY-MM-DD").format('DD-MM-YYYY');
        $('#fuel_fill_date').datepicker({
            todayBtn: "linked",
            keyboardNavigation: false,
            forceParse: false,
            calendarWeeks: true,
            autoclose: true,
            startDate: latest_fuel_log_date,
            endDate: '+0d',
            format: 'dd/mm/yyyy'
        });
        // On focusout event


        $('.selectpicker').selectpicker();
        $('#data_1 .input-group.date').datepicker({
            todayBtn: "linked",
            keyboardNavigation: false,
            forceParse: false,
            calendarWeeks: true,
            autoclose: true,
            startDate: '+1d'
        });

        $('.clockpicker').clockpicker();
    });


    function refresh_add_panel() {
        $('#fuel_price').val('');
        $('#fuel_qty').val('');
        $('#odometer_reading').val('');
        $('#fuel_fill_date').val('');

    }



    $(".select2_vehicle").select2({
        "theme": "bootstrap",
        "width": "100%"
    });
    $(".select2_trip").select2({
        "theme": "bootstrap",
        "width": "100%"
    });
    $(".select2_pickup").select2({
        "theme": "bootstrap",
        "width": "100%"
    });

    function load_vehiclelist_form() {
        var ops_url = baseurl + 'transport/show-vehicle-fuel/';
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

    function save_fuellog_details() {
        var vehicle_id = $('#vehicleid').val();
        var vehicleNum = $('#vehicleNum').val();
        var fueltype = $('#fuel_type').val();
        var fueltypeid = $('#fuel_type_id').val();
        //            var fueltypeselect = $("#fueltype option:selected").text();
        var fuel_price = $('#fuel_price').val();
        var fuel_qty = $('#fuel_qty').val();
        var fuelfill_km = $('#odometer_reading').val();
        //            var fuelfill_date = $('#fuel_fill_date').val();
        var fuelfill_dates = moment($("#fuel_fill_date").datepicker("getDate")).format('YYYY-MM-DD');
        var fuelfill_date = fuelfill_dates;
        var dec_numbers = /^[0-9]+(\.[0-9]+)?$/;

        var latest_fuel_log_odo = parseFloat($('#latest_fuel_log_odo').val());
        if (fueltype == -1) {
            swal('', 'Fuel Type is required.', 'info');
            $('#faculty_loader').removeClass('sk-loading');
            return false;
        }
        if (fuel_price == '') {
            swal('', 'Fuel Price is required.', 'info');
            $('#faculty_loader').removeClass('sk-loading');
            return false;
        } else if (!dec_numbers.test(fuel_price)) {
            swal('', 'Fuel Price can have only numbers.', 'info');
            $('#faculty_loader').removeClass('sk-loading');
            return false;
        } else if (fuel_price == 0) {
            swal('', 'Fuel Price should be greater than 0.', 'info');
            $('#faculty_loader').removeClass('sk-loading');
            return false;
        }
        if (fuel_qty == '') {
            swal('', 'Fuel Quantity is required.', 'info');
            $('#faculty_loader').removeClass('sk-loading');
            return false;
        } else if (!dec_numbers.test(fuel_qty)) {
            swal('', 'Fuel Quantity can have only numbers.', 'info');
            $('#faculty_loader').removeClass('sk-loading');
            return false;
        } else if (fuel_qty == 0) {
            swal('', 'Fuel Quantity should be greater than 0.', 'info');
            $('#faculty_loader').removeClass('sk-loading');
            return false;
        }
        if (fuelfill_km == '') {
            swal('', 'Odometer Reading is required.', 'info');
            $('#faculty_loader').removeClass('sk-loading');
            return false;
        } else if (!dec_numbers.test(fuelfill_km)) {
            swal('', 'Odometer Reading can have only numbers.', 'info');
            $('#faculty_loader').removeClass('sk-loading');
            return false;
        } else if (fuelfill_km <= latest_fuel_log_odo) {
            swal('', 'Odometer Reading should be greater than ' + latest_fuel_log_odo + 'km .', 'info');
            $('#faculty_loader').removeClass('sk-loading');
            return false;
        } else if (fuelfill_km == 0) {
            swal('', 'Odometer Reading should be greater than 0.', 'info');
            $('#faculty_loader').removeClass('sk-loading');
            return false;
        }

        if (fuelfill_date == '') {
            swal('', 'Fuel Fill Date is required.', 'info');
            $('#faculty_loader').removeClass('sk-loading');
            return false;
        }
        if (!moment(fuelfill_date, 'YYYY-MM-DD').isValid()) {
            swal('', 'Fuel Fill Date is required.', 'info');
            return false;
        }

        var fuel_log = new Object();
        fuel_log.vehicle_id = vehicle_id;
        fuel_log.vehiclenum = vehicleNum;
        fuel_log.fueltype = fueltypeid;
        fuel_log.fueltypeselect = fueltype;
        fuel_log.fuel_price = fuel_price;
        fuel_log.fuel_qty = fuel_qty;
        fuel_log.fuelfill_km = fuelfill_km;
        fuel_log.fuelfill_date = fuelfill_date;


        var fuellogdata = JSON.stringify(fuel_log);
        var ops_url = baseurl + 'transport/save-fuellog-details';
        $.ajax({
            type: "POST",
            cache: false,
            async: false,
            url: ops_url,
            data: {
                "load": 1,
                "fuellogdata": fuellogdata
            },
            success: function(result) {
                var data = JSON.parse(result);
                if (data.status == 1) {

                    swal('Success', 'New Fuel Log For Vehicle, ' + vehicleNum + ' Saved Successfully.', 'success');
                    load_vehiclelist_form();
                    $('#faculty_loader').removeClass('sk-loading');
                    $("#curd-content").slideUp("slow", function() {
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