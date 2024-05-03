<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
    <div class="card">
        <div class="header">
            <h2 style="padding-bottom: 10px;font-size: 16px;color: #1c84c6;"><?php echo isset($sub_title) ? $sub_title : "NO TITLE PROVIDED" ?>
                <span><a href="javascript:void(0);" onclick="close_panel();"> <i style="font-size: 30px !important; float: right; color: #E91E63;" class="material-icons" data-toggle="tooltip" title="Close">close</i></a> </span>
                <span><a href="javascript:void(0);" onclick="save_servicecenter_details();"> <i style="font-size: 30px !important; float: right; color: #23C6C5; padding-right: 10px;" class="material-icons" data-toggle="tooltip" title="Save">save</i></a> </span>
                <span><a href="javascript:void(0);" onclick="clear_controls();"> <i style="font-size: 30px !important; float: right; color: #2196F3; padding-right: 10px;" class="material-icons " data-toggle="tooltip" title="Refresh">refresh</i></a> </span>
            </h2>
        </div>
        <div class="body">


            <!--<div class="row">-->

            <?php
            $breaker = 0;
            ?>
            <div class="col-lg-12">
                <div id="curd-content" style="display: none;"></div>
                <div class="ibox-content">
                    <form method="post" id="myform">
                        <div class="row">
                            <input type="hidden" name="vehicle_id" id="vehicle_id" value="<?php echo isset($vehicle_id) && !empty($vehicle_id) ? $vehicle_id : ''; ?>" />
                            <input type="hidden" name="vehicleNum" id="vehicleNum" value="<?php echo isset($vehicleNum) && !empty($vehicleNum) ? $vehicleNum : ''; ?>" />
                            <div class="col-sm-6">
                                <!--                                                <p>
                                    <b>With Search Bar</b>
                                </p>-->
                                <div class="form-group">
                                    <label class="form-label">Service Center *</label>
                                    <select class="form-control show-tick selectpicker" name="servicecenter_select" id="servicecenter_select" data-live-search="true">
                                        <option selected value="-1">Select</option>
                                        <?php
                                        if (isset($servicecenter_data) && !empty($servicecenter_data)) {
                                            foreach ($servicecenter_data as $servicecenter) {
                                                echo '<option value ="' . $servicecenter['id'] . '" >' . $servicecenter['serviceCenterName'] . '</option>';
                                            }
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <!--                                                <p>
                                    <b>With Search Bar</b>
                                </p>-->
                                <div class="form-group">
                                    <label class="form-label">Service Type *</label>
                                    <select class="form-control show-tick selectpicker" name="servicetype_select" id="servicetype_select" data-live-search="true">
                                        <option selected value="-1">Select</option>
                                        <?php
                                        if (isset($servicetypes_data) && !empty($servicetypes_data)) {
                                            foreach ($servicetypes_data as $servicetype) {
                                                echo '<option value ="' . $servicetype['id'] . '" >' . $servicetype['serviceType'] . '</option>';
                                            }
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>

                            <div class="col-sm-6">
                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <label class="form-label">Service Advisor Name *</label>
                                        <input type="text" class="form-control alpha nofocusitem" name="cperson" id="cperson" placeholder="Service Advisor Name" autocomplete="off" maxlength="25">
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <label class="form-label">Service Advisor Contact No. *</label>
                                        <input type="text" maxlength="10" class="form-control digits" name="c_num" id="c_num" placeholder="Service Advisor Contact No." autocomplete="off" style="text-align: left">
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-6">
                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <label class="form-label">Date Of Service *</label>
                                        <input type="text" class="form-control" name="booking_date" id="booking_date" placeholder="Date Of Service" autocomplete="off" readonly style="background: #fff">
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <label class="form-label">Expected Delivery Date *</label>
                                        <input type="text" class="form-control" name="expecteddelivery_date" id="expecteddelivery_date" placeholder="Expected Delivery Date" autocomplete="off" readonly style="background: #fff">
                                    </div>
                                </div>
                            </div>


                            <div class="col-sm-6">
                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <label class="form-label">Additional Informations </label>
                                        <input type="text" class="form-control" name="addition_info" id="addition_info" placeholder="Additional Informations" autocomplete="off" maxlength="25">
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <label class="form-label">Driver Name *</label>
                                        <select class="form-control selectpicker" name="cust_name" id="cust_name" data-live-search="true" onchange="get_emp_phone()">
                                            <option value="-1">Select</option>
                                            <?php
                                            if (isset($emp_data) && !empty($emp_data)) {
                                                foreach ($emp_data as $emp) {
                                                    if ($select_driver_data == $emp['Emp_id'])
                                                        $selected = 'selected';
                                                    else
                                                        $selected = '';
                                                    echo '<option ' . $selected . '  value ="' . $emp['Emp_Name'] . '" data-empid="' . $emp['Emp_id'] . '">' . $emp['Emp_Name'] . ' - ' . $emp['Emp_code'] . '</option>';
                                                }
                                            }
                                            ?>
                                        </select>
                                        <!-- <input type="text" class="form-control alpha" name="cust_name" id="cust_name" placeholder="Driver Name" autocomplete="off" maxlength="25"> -->
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <label class="form-label">Driver Contact No. *</label>
                                        <input type="text" maxlength="10" class="form-control digits" name="cust_cnum" id="cust_cnum" placeholder="Driver Contact No." autocomplete="off" style="text-align: left">
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <label class="form-label">Odometer Reading (at the time of service booking)</label>
                                        <input type="text" class="form-control digits" name="kmreading" id="kmreading" placeholder="Odometer Reading (at the time of service booking)" autocomplete="off" style="text-align: left" maxlength="8">
                                    </div>
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



<script type="text/javascript">
    $(document).ready(function() {
        // $('.form-control').focus(function() {
        //     $(this).parent().addClass('focused');
        // });
        $('#booking_date').datepicker({
            //todayBtn: "linked",
            keyboardNavigation: false,
            forceParse: false,
            calendarWeeks: true,
            autoclose: true,
            format: 'dd-mm-yyyy',
            startDate: '+0d'
        });

        $('#expecteddelivery_date').datepicker({
            //todayBtn: "linked",
            keyboardNavigation: false,
            forceParse: false,
            calendarWeeks: true,
            autoclose: true,
            format: 'dd-mm-yyyy',
            startDate: '+0d'
        });

        $('.selectpicker').selectpicker();
        $('#data_1 .input-group.date').datepicker({
            //todayBtn: "linked",
            keyboardNavigation: false,
            forceParse: false,
            calendarWeeks: true,
            autoclose: true,
            startDate: '+1d'
        });
        get_emp_phone();

    });


    function refresh_add_panel() {
        $('#country_name').val('');
        $('#country_name').parent().removeAttr('class', 'has-error');
        $('#country_nation').val('');
        $('#country_nation').parent().removeAttr('class', 'has-error');
        $('#country_abbr').val('');
        $('#country_abbr').parent().removeAttr('class', 'has-error');
        $('#currency_select').select2('val', -1);
    }



    $(".select2_vehicle").select2({
        "theme": "bootstrap",
        "width": "100%"
    });

    $('.selectpicker').select2({
        "theme": "bootstrap",
        "width": "100%"
    });
    $(".select2_serviceattend").select2({
        "theme": "bootstrap",
        "width": "100%"
    });


    function load_vehicleservice_booking_form() {
        var ops_url = baseurl + 'transport/show-new-vehicle-servicebooking/';
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

    function save_servicecenter_details() {
        // $('#faculty_loader').addClass('sk-loading');
        var vehicle_id = $('#vehicle_id').val();
        var vehicleselects = $('#vehicleNum').val();
        var servicecenter_select = $('#servicecenter_select').val();
        var cperson = $('#cperson').val();
        var c_num = $('#c_num').val();
        var serv_type_select = $('#servicetype_select').val();
        //        var serv_type = $('#serv_type').val();        
        var booking_date = moment($("#booking_date").datepicker("getDate")).format('YYYY-MM-DD');
        var expecteddelivery_date = moment($("#expecteddelivery_date").datepicker("getDate")).format('YYYY-MM-DD');
        var addition_info = $('#addition_info').val();
        var cust_name = $('#cust_name').val();
        var cust_cnum = $('#cust_cnum').val();
        var km_readind = $('#kmreading').val();

        if (servicecenter_select == -1) {
            swal('', 'Select a Service Center', 'info');
            $('#faculty_loader').removeClass('sk-loading');
            return;
        }
        if (serv_type_select == -1) {
            swal('', 'Select a Service Type', 'info');
            $('#faculty_loader').removeClass('sk-loading');
            return;
        }
        var alphanumers = /^[a-zA-Z\s]+$/;
        if (cperson == '') {
            swal('', 'Service Advisor Name is required.', 'info');
            $('#faculty_loader').removeClass('sk-loading');
            return false;
        }
        if (!alphanumers.test($("#cperson").val())) {
            swal('', 'Service Advisor Name can have only alphabets.', 'info');
            $('#faculty_loader').removeClass('sk-loading');
            return false;
        }
        if ((cperson.length > '25') || (cperson.length < '2')) {
            swal('', 'Service Advisor Name should be 2 to 25 characters.', 'info');
            $('#faculty_loader').removeClass('sk-loading');
            return false;
        }
        if (c_num == '') {
            swal('', 'Service Advisor Contact No. is required.', 'info');
            $('#faculty_loader').removeClass('sk-loading');
            return false;
        } else if (IsFone(c_num) == false) {
            swal('', 'Service Advisor Contact Number should be 9 to 12 digits.', 'info');
            $('#faculty_loader').removeClass('sk-loading');
            return false;
        }

        if (booking_date == 'Invalid date') {
            swal('', 'Date of service is required.', 'info');
            $('#faculty_loader').removeClass('sk-loading');
            return false;
        }
        if (expecteddelivery_date == 'Invalid date') {
            swal('', 'Expected Delivery Date is required.', 'info');
            $('#faculty_loader').removeClass('sk-loading');
            return false;
        }

        if (booking_date > expecteddelivery_date) {
            swal('', 'Expected Date of Delivery should be greater than the date of Service.', 'info');
            return false;
        }
        // if (addition_info == '') {
        //     swal('', 'Additional Informations is required.', 'info');
        //     $('#faculty_loader').removeClass('sk-loading');
        //     return false;
        // }

        if (cust_name == '') {
            swal('', 'Driver Name is required.', 'info');
            $('#faculty_loader').removeClass('sk-loading');
            return false;
        } else if ((cust_name.length > '25') || (cust_name.length < '2')) {
            swal('', 'Driver Name should be 2 to 25 characters.', 'info');
            $('#faculty_loader').removeClass('sk-loading');
            return false;
        }
        if (!alphanumers.test($("#cust_name").val())) {
            swal('', 'Customer Name can have only alphabets.', 'info');
            $('#faculty_loader').removeClass('sk-loading');
            return false;
        }
        if (cust_cnum == '') {
            swal('', 'Driver Contact No. is required.', 'info');
            $('#faculty_loader').removeClass('sk-loading');
            return false;
        } else if (IsFone(cust_cnum) == false) {
            swal('', 'Driver Contact No. should be 9 to 12 digits.', 'info');
            $('#faculty_loader').removeClass('sk-loading');
            return false;
        }

        function IsFone(cust_cnum) {
            var chkfone = /^\+?([0-9]{2})\)?[-. ]?([0-9]{4})[-. ]?([0-9]{4})$/;
            if (!chkfone.test(cust_cnum)) {
                return false;
            } else {
                return true;
            }
        }

        function IsFone(c_num) {
            var chkfone = /^\+?([0-9]{2})\)?[-. ]?([0-9]{4})[-. ]?([0-9]{4})$/;
            if (!chkfone.test(c_num)) {
                return false;
            } else {
                return true;
            }
        }

        var servicedetails_vehicle = new Object();
        servicedetails_vehicle.vehicleselect = vehicle_id;
        servicedetails_vehicle.servicecenter_select = servicecenter_select;
        servicedetails_vehicle.cperson = cperson;
        servicedetails_vehicle.c_num = c_num;
        servicedetails_vehicle.serv_type = serv_type_select;
        servicedetails_vehicle.booking_date = booking_date;
        servicedetails_vehicle.expecteddelivery_date = expecteddelivery_date;
        servicedetails_vehicle.addition_info = addition_info;
        servicedetails_vehicle.cust_name = cust_name;
        servicedetails_vehicle.cust_cnum = cust_cnum;
        servicedetails_vehicle.km_reding = km_readind;


        var servicebooking_details_data = JSON.stringify(servicedetails_vehicle);
        var ops_url = baseurl + 'transport/save-servicebooking-details/';
        $.ajax({
            type: "POST",
            cache: false,
            async: false,
            url: ops_url,
            data: {
                "load": 1,
                "servicebooking_details_data": servicebooking_details_data
            },
            success: function(result) {

                var data = JSON.parse(result);
                $('#faculty_loader').removeClass('sk-loading');
                if (data.status == 1) {
                    load_vehicleservice_booking_form();
                    swal('Success', 'New Vehicle Service Booking for vehicle ' + vehicleselects + ' saved successfully.', 'success');
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

    function close_panel() {
        if ($('#curd-content').is(":visible") == true) {
            $("#curd-content").slideUp("slow", function() {
                $("#curd-content").hide();
                $('#add_type').show();
                $('#search-feecode').show()
            });
        }
    }

    function clear_controls() {
        $('#vehicleNum').val('');
        $('#servicecenter_select').val('-1').trigger('change');
        $('#cperson').val('');
        $('#c_num').val('');
        $('#servicetype_select').val('-1').trigger('change');
        $("#booking_date").val('');
        $("#expecteddelivery_date").val('');
        $('#addition_info').val('');
        $('#cust_name').val('');
        $('#cust_cnum').val('');
        $('#kmreading').val('');
    }


    function get_emp_phone() {
        var emp_id = $("#cust_name :selected").data('empid');
        if (emp_id == -1) {
            $('#mobile_no').val('');
        } else {
            var ops_url = baseurl + 'transport/get_select_emp_data/';
            $.ajax({
                type: "POST",
                cache: false,
                async: false,
                url: ops_url,
                data: {
                    "load": 1,
                    "cid": emp_id
                },
                success: function(result) {
                    var data = JSON.parse(result);
                    var d = data.emp_data;
                    $('#cust_cnum').val(d[0].Mobile);

                }
            });
        }
    }
</script>