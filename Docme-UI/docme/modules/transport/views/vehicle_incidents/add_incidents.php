<div class="wrapper wrapper-content animated fadeInRight" style="padding-top: 1px !important;padding-left: 0px !important;padding-right: 0px !important;">
    <div class="row" style="margin-left: -29px !important; margin-right: -30px !important;">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header">
                        <h2 style="padding-bottom: 10px;font-size: 16px;color: #1c84c6;"><?php echo isset($sub_title) ? $sub_title : "NO TITLE PROVIDED" ?>
                            <span><a href="javascript:void(0);" onclick="close_add_country();"> <i style="font-size: 30px !important; float: right; color: #E91E63;" class="material-icons" data-toggle="tooltip" title="Close">close</i></a> </span>
                            <span><a href="javascript:void(0);" onclick="save_incident_details();"> <i style="font-size: 30px !important; float: right; color: #23C6C5; padding-right: 10px;" class="material-icons" data-toggle="tooltip" title="Save">save</i></a> </span>
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

                        <div class="wrapper wrapper-content animated fadeInRight" id="student-data-container">

                            <div class="row">


                                <!--<div class="row">-->

                                <?php
                                $breaker = 0;
                                ?>
                                <div class="col-lg-12">
                                    <div id="curd-content" style="display: none;"></div>
                                    <div class="ibox-content">
                                        <form method="post" id="myform">
                                            <div class="row">
                                                <div class="col-sm-6">
                                                    <!--                                                <p>
                                                    <b>With Search Bar</b>
                                                </p>-->
                                                    <div class="form-group">
                                                        <label>Vehicle Number *</label>
                                                        <select class="form-control show-tick selectpicker" name="vehicle_select" id="vehicle_select" data-live-search="true">
                                                            <option selected value="-1">Select</option>
                                                            <?php
                                                            if (isset($vehicles_data) && !empty($vehicles_data)) {
                                                                foreach ($vehicles_data as $vehicles) {
                                                                    echo '<option value ="' . $vehicles['id'] . '" >' . $vehicles['vehicleNum'] . '</option>';
                                                                }
                                                            }
                                                            ?>
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <label>Cause Of Incident *</label>
                                                        <input type="text" class="form-control" name="cause_incident" id="cause_incident" autocomplete="off" maxlength="30" placeholder="Cause Of Incident">
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <label>Incident Description *</label>
                                                        <input type="text" class="form-control" name="idesc" id="idesc" autocomplete="off" maxlength="30" placeholder="Incident Description">
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <label>Place Of Incident *</label>
                                                        <input type="text" class="form-control" name="place_inc" id="place_inc" autocomplete="off" maxlength="30" placeholder="Place Of Incident">
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">

                                                    <div class="form-group clockpicker" data-autoclose="true">
                                                        <label>Incident Time *</label>
                                                        <input type="text" class="form-control pickup_time" name="inc_time" id="inc_time" autocomplete="off" placeholder="Incident Time" readonly style="background: #fff">
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <label class="form-label">Date Of Incident *</label>
                                                        <input type="text" class="form-control" name="incident_date" id="incident_date" autocomplete="off" placeholder="Date Of Incident" readonly style="background: #fff">
                                                    </div>
                                                </div>

                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <label>Trip *</label>
                                                        <select class="form-control show-tick selectpicker" name="trip_select" id="trip_select" data-live-search="true">
                                                            <option selected value="-1">Select</option>
                                                            <option value="-2">Others</option>
                                                            <?php
                                                            if (isset($vehicles_trip_data) && !empty($vehicles_trip_data)) {
                                                                foreach ($vehicles_trip_data as $vehicles_trip) {
                                                                    echo '<option value ="' . $vehicles_trip['id'] . '" >' . $vehicles_trip['tripName'] . '</option>';
                                                                }
                                                            }
                                                            ?>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <label>Last Pickup From Incident *</label>
                                                        <select class="form-control show-tick selectpicker selectpickuppoint" name="pickup_select" id="pickup_select" data-live-search="true">
                                                            <option selected value="-1">Select</option>
                                                        </select>
                                                    </div>
                                                    <!-- <div class="form-group other_incident">
                                                        <label>Incident *</label>
                                                        <select class="form-control show-tick selectpicker" name="pickup_select" id="pickup_select" data-live-search="true">
                                                            <option selected value="-1">Other</option>
                                                        </select>
                                                    </div> -->
                                                </div>

                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <label>Penalty Amount *</label>
                                                        <input type="text" class="form-control numeric numericDecimal" name="penalty_amt" id="penalty_amt" autocomplete="off" onkeypress="return numsOnly(event);" placeholder="Penalty Amount" maxlength="9">
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <label>Action Taken *</label>
                                                        <input type="text" class="form-control" name="action_taken" id="action_taken" autocomplete="off" placeholder="Action Taken" maxlength="30">
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



    <script type="text/javascript">
        function numsOnly(e) {
            if (/[^0-9.]+$/.test(e.key)) {
                return false;
            } else {
                return true;
            }
        }
        $(document).ready(function() {
            $('.other_incident').hide();
            $('.pickup_incident').show();
            $('#trip_select').change(function() {
                if ($(this).val()) {
                    $('#pickup_select').val('-1');
                    // $('#otherincident').val('other');
                    $('.other_incident').show();
                    $('.pickup_incident').hide();
                } else {
                    // $('#otherincident').val('NULL');
                    $('.other_incident').hide();
                    $('.pickup_incident').show();
                }
            });

            $('#trip_select').change(function() {
                var trip_id = $(this).val();
                if (trip_id == -2) {
                    var sel = $(this);
                    var sel_pickup = sel.parent().parent().parent().find('.selectpickuppoint');
                    sel_pickup.trigger("change");
                    sel_pickup.empty().append("<option value='-1'>Select</option><option value='other'>Other</option>");
                } else {
                    var sel = $(this);
                    var sel_pickup = sel.parent().parent().parent().find('.selectpickuppoint');
                    // console.log(maintain_sel);
                    var ops_url = baseurl + 'transport/get_pickupointlist_list';
                    $.ajax({
                        type: "POST",
                        cache: false,
                        async: false,
                        url: ops_url,
                        data: {
                            "load": 1,
                            "trip_id": trip_id
                        },
                        success: function(result) {
                            var data = JSON.parse(result);
                            console.log(data);
                            sel_pickup.html("<option value='-1' >Select</option>");
                            if (data.pickup_list) {

                                var pickuplist = data.pickup_list;
                                sel_pickup.trigger("change");
                                $.each(pickuplist, function(i, v) {
                                    if (pickuplist) {
                                        sel_pickup.append("<option value='" + v.id + "' >" + v.pickpointName + "</option>");
                                    }
                                });

                            } else {
                                //trip_sel.empty().trigger("change");
                            }



                        }
                    });
                }
            });
            $('.form-control').focus(function() {
                $(this).parent().addClass('focused');
            });

            $('#incident_date').datepicker({
                todayBtn: "linked",
                keyboardNavigation: false,
                forceParse: false,
                calendarWeeks: true,
                autoclose: true,
                //                startDate: '+0d'
                format: 'dd-mm-yyyy',
                endDate: '+0d',
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
            // $('.selectpicker').selectpicker();
            $('.selectpicker').select2({
                "theme": "bootstrap",
                "width": "100%"
            });
            $('#data_1 .input-group.date').datepicker({
                todayBtn: "linked",
                keyboardNavigation: false,
                forceParse: false,
                calendarWeeks: true,
                autoclose: true,
                //                startDate: '+0d'
            });

            $('.clockpicker').clockpicker();
        });


        function refresh_add_panel() {
            $('#cause_incident').val('');
            $('#idesc').val('');
            $('#place_inc').val('');
            $('#inc_time').val('');
            $('#incident_date').val('');
            $('#penalty_amt').val('');
            $('#action_taken').val('');
            $("#vehicle_select").val('-1').trigger('change')
            $("#trip_select").val('-1').trigger('change')
            $("#pickup_select").val('-1').trigger('change')
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

        function load_vehicleincident_form() {
            var ops_url = baseurl + 'transport/show-new-vehicle-incidents/';
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

        function save_incident_details() {
            // console.log($('.other_incident').is('hidden'))
            var vehicleselect = $('#vehicle_select').val();
            var vehicleselects = $("#vehicle_select option:selected").text();
            var causeincident = $('#cause_incident').val();
            var idesc = $('#idesc').val();
            var place_inc = $('#place_inc').val();
            var inc_time = $('#inc_time').val();
            var incident_date = moment($("#incident_date").datepicker("getDate")).format('YYYY-MM-DD');
            var trip_select = $('#trip_select option:selected').text();
            var pickup_select = $('#pickup_select option:selected').text();
            var penalty_amt = $('#penalty_amt').val();
            var action_taken = $('#action_taken').val();
            if (vehicleselect == '-1') {
                swal('', 'Select a Vehicle Number.', 'info');
                return false;
            }
            if (causeincident == '') {
                swal('', 'Cause Of Incident is required.', 'info');
                return false;
            } else if ((causeincident.length > '30') || (causeincident.length < '5')) {
                swal('', 'Cause Of Incident  should contain letters 5 to 30.', 'info');
                $('#faculty_loader').removeClass('sk-loading');
                return false;
            }
            if (idesc == '') {
                swal('', 'Incident Description is required.', 'info');
                return false;
            } else if ((idesc.length > '30') || (idesc.length < '5')) {
                swal('', 'Incident Description  should contain letters 5 to 30.', 'info');
                $('#faculty_loader').removeClass('sk-loading');
                return false;
            }
            if (place_inc == '') {
                swal('', 'Place of Incident is required.', 'info');
                return false;
            } else if ((place_inc.length > '30') || (place_inc.length < '3')) {
                swal('', 'Place of Incident  should contain letters 5 to 30.', 'info');
                $('#faculty_loader').removeClass('sk-loading');
                return false;
            }
            if (inc_time == '') {
                swal('', 'Incident Time is required.', 'info');
                return false;
            } else if (!moment('12-12-2010 ' + inc_time).isValid()) {
                swal('', 'Incident Time is required.', 'info');
                return false;
            }
            if ($("#incident_date").val() == '') {
                swal('', 'Date Of Incident is required.', 'info');
                return false;
            } else if (!moment(incident_date).isValid()) {
                swal('', 'Enter valid date Of incident.', 'info');
                return false;
            }
            if (trip_select == 'Select') {
                swal('', 'Select a Trip.', 'info');
                return false;
            }

            if (pickup_select == 'Select') {
                swal('', 'Last Pickup From Incident is required.', 'info');
                return false;
            }
            if (penalty_amt == '') {
                swal('', 'Panalty Amount is required.', 'info');
                return false;
            } else if (!/^[\d]+([\.][\d]{1,2})?$/.test(penalty_amt)) {
                swal('', 'Enter valid Panalty Amount', 'info');
                return false;
            }
            if (action_taken == '') {
                swal('', 'Action Taken is required.', 'info');
                return false;
            }
            var incident_vehicle = new Object();
            incident_vehicle.vehicleselect = vehicleselect;
            incident_vehicle.causeincident = causeincident;
            incident_vehicle.idesc = idesc;
            incident_vehicle.place_inc = place_inc;
            incident_vehicle.inc_time = inc_time;
            incident_vehicle.incident_date = incident_date;
            incident_vehicle.trip_select = trip_select;
            incident_vehicle.pickup_select = pickup_select;
            incident_vehicle.penalty_amt = penalty_amt;
            incident_vehicle.action_taken = action_taken;

            var incidentdata = JSON.stringify(incident_vehicle);
            // console.log(incidentdata);
            // return;
            var ops_url = baseurl + 'transport/save-vehicleincident-details';
            $.ajax({
                type: "POST",
                cache: false,
                async: false,
                url: ops_url,
                data: {
                    "load": 1,
                    "incidentdata": incidentdata
                },
                success: function(result) {
                    var data = JSON.parse(result);
                    if (data.status == 1) {
                        load_vehicleincident_form();
                        swal('Success', 'New Incident For Vehicle, ' + vehicleselects + ' Saved Successfully.', 'success');
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