<style>
    .pick_time {
        background-color: #fff !important;
    }
</style>
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="header">
                <h2 style="padding-bottom: 10px;font-size: 16px;color: #1c84c6;"><?php echo isset($sub_title) ? $sub_title : "NO TITLE PROVIDED" ?>
                    <span><a href="javascript:void(0);" onclick="close_panel();"> <i style="font-size: 30px !important; float: right; color: #E91E63;" class="material-icons" data-toggle="tooltip" title="Close">close</i></a> </span>
                    <span><a href="javascript:void(0);" onclick="save_trip_data();"> <i style="font-size: 30px !important; float: right; color: #23C6C5; padding-right: 10px;" class="material-icons" data-toggle="tooltip" title="Save">save</i></a> </span>
                    <span><a href="javascript:void(0);" onclick="refresh_add_panel();"> <i style="font-size: 30px !important; float: right; color: #2196F3; padding-right: 10px;" class="material-icons " data-toggle="tooltip" title="Refresh">refresh</i></a> </span>
                </h2>
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
            <div class="body">
                <?php
                echo form_open('', array('id' => 'trip_form', 'role' => 'form'));
                ?>
                <input type="hidden" name="save_flag" id="save_flag" value="1" />
                <!-- <form method="post" id="myform"> -->
                <div class="row clearfix">
                    <div class="col-sm-6">
                        <div class="form-group ">
                            <label>Trip Name *</label>
                            <input type="text" class="form-control alphanumeric" maxlength="20" placeholder="Trip Name" name="tripName" id="tripName" autocomplete="off">
                            <!--onkeypress="return alphanumeric(event);"-->
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label class="form-label">Trip Description *</label>
                            <input type="text" class="form-control alphanumeric" maxlength="50" placeholder="Trip Description" name="tripDescription" id="tripDescription" autocomplete="off">
                            <!--onkeypress="return alphanumeric(event);"-->
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group clockpicker" data-autoclose="true">
                            <label>Pickup Start Time *</label>
                            <input type="text" class="form-control" name="pickStartTime" id="pickStartTime" placeholder="Pickup Start Time" readonly="" style="background-color: #fff;">
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group clockpicker" data-autoclose="true">
                            <label>Pickup End Time *</label>
                            <input type="text" class="form-control" name="pickEndTime" id="pickEndTime" placeholder="Pickup End Time" readonly="" onblur="checkTripPickTime(this)" style="background-color: #fff;">
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group clockpicker" data-autoclose="true">
                            <label>Drop Start Time *</label>
                            <input type="text" class="form-control" name="dropStartTime" id="dropStartTime" placeholder="Drop Start Time" readonly="" onblur="checkTripPickDropTime(this)" style="background-color: #fff;">
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group clockpicker" data-autoclose="true">
                            <label>Drop End Time *</label>
                            <input type="text" class="form-control" name="dropEndTime" id="dropEndTime" placeholder="Drop End Time" readonly="" onblur="checkTripDropTime(this)" style="background-color: #fff;">
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group ">
                            <label>Trip Code *</label>
                            <input type="text" class="form-control alphanumeric" maxlength="5" placeholder="Trip Code" name="tripCode" id="tripCode" autocomplete="off">
                            <!--onkeypress="return alphanumeric(event);"-->
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-6" style="padding:0px">
                        <div class="col-sm-12">
                            <b>Choose Pickup Points</b><br /><br />
                            <div class="form-group">
                                <?php
                                if (isset($all_pickpoints['data']) && !empty($all_pickpoints['data'])) {
                                    $all_pickpoints_data = $all_pickpoints['data'];
                                    // dev_export($all_trips_data);
                                    // die;
                                    foreach ($all_pickpoints_data as $pickuppoint_data) { ?>
                                        <div style="height: 50px;" class="col-sm-6 i-checks"><label> <input type="checkbox" class="pickup_sel" data-pickpoint-name="<?php echo $pickuppoint_data['pickpointName'] ?>" value="<?php echo $pickuppoint_data['id'] ?>"> <?php echo $pickuppoint_data['pickpointName'] ?> </label></div>
                                <?php }
                                } ?>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6" id="point-fields" style="padding:0px">
                        <div class="col-sm-12">
                            <b>Pickup Point Times</b><br /><br />
                        </div>
                    </div>

                </div>
                <?php echo form_close(); ?>
            </div>

        </div>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function() {
        // $('.form-control').focus(function() {
        //     $(this).parent().addClass('focused');
        // });

        // // On focusout event
        // $('.form-control').change(function() {
        //     var $this = $(this);
        //     if ($this.parents('.form-group').hasClass('form-float')) {
        //         if ($this.val() == '') {
        //             $this.parents('.form-line').removeClass('focused');
        //         }
        //     } else {
        //         $this.parents('.form-line').removeClass('focused');
        //     }
        // });
        $('.i-checks').iCheck({
            checkboxClass: 'icheckbox_square-green',
            radioClass: 'iradio_square-green',
        });

        $('.clockpicker').clockpicker();
    });


    function refresh_add_panel() {


    }

    function save_trip_data() {
        $('#faculty_loader').addClass('sk-loading');
        var tripName = $('#tripName').val();
        var tripCode = $('#tripCode').val();
        var tripDescription = $('#tripDescription').val();
        var pickStartTime = $('#pickStartTime').val();
        var pickEndTime = $('#pickEndTime').val();
        var dropStartTime = $('#dropStartTime').val();
        var dropEndTime = $('#dropEndTime').val();
        var formdata = $('#trip_form').serialize();

        var error = 0


        if (tripName == '') {
            swal('', 'Trip Name is required', 'info');
            $('#faculty_loader').removeClass('sk-loading');
            return false;
        } else if ((tripName.length > '20') || (tripName.length < '3')) {
            swal('', 'Trip Name should contain letters or numbers 3 to 20.', 'info');
            $('#faculty_loader').removeClass('sk-loading');
            return false;
        }
        if (tripCode == '') {
            swal('', 'Trip Code is required', 'info');
            $('#faculty_loader').removeClass('sk-loading');
            return false;
        } else if ((tripCode.length > '5') || (tripCode.length < '5')) {
            swal('', 'Trip Code should contain letters or numbers Minimum 5.', 'info');
            $('#faculty_loader').removeClass('sk-loading');
            return false;
        }
        if (tripDescription == '') {
            swal('', 'Trip Description is required', 'info');
            $('#faculty_loader').removeClass('sk-loading');
            return false;
        } else if ((tripDescription.length > '50') || (tripDescription.length < '3')) {
            swal('', 'Trip Description should contain letters or numbers 3 to 50.', 'info');
            $('#faculty_loader').removeClass('sk-loading');
            return false;
        }

        if (pickStartTime == '') {
            swal('', 'Pickup Start Time is required', 'info');
            $('#faculty_loader').removeClass('sk-loading');
            return false;
        }
        if (pickEndTime == '') {
            swal('', 'Pickup End time is required', 'info');
            $('#faculty_loader').removeClass('sk-loading');
            return false;
        }
        if (moment('12-12-2000 ' + pickStartTime) >= moment('12-12-2000 ' + pickEndTime)) {
            swal('', 'Pickup End time should be greater than Pickup Start Time', 'info');
            $('#faculty_loader').removeClass('sk-loading');
            return false;
        }

        if (dropStartTime == '') {
            swal('', 'Drop Start Time is required', 'info');
            $('#faculty_loader').removeClass('sk-loading');
            return false;
        }
        if (dropEndTime == '') {
            swal('', 'Drop End Time is required', 'info');
            $('#faculty_loader').removeClass('sk-loading');
            return false;
        }
        if (moment('12-12-2000 ' + dropStartTime) >= moment('12-12-2000 ' + dropEndTime)) {
            swal('', 'Drop End time should be greater than Drop Start Time', 'info');
            $('#faculty_loader').removeClass('sk-loading');
            return false;
        }

        if (moment('12-12-2000 ' + dropStartTime) <= moment('12-12-2000 ' + pickEndTime)) {
            swal('', 'Drop Start Time should be greater than Pickup End Time', 'info');
            $('#faculty_loader').removeClass('sk-loading');
            return false;
        }

        $('.pick_time').each(function() {

            if ($(this).val() == '') {
                error++;
            }
        });

        if (error != 0) {
            swal('', 'All Pickup Point Times are required', 'info');
            $('#faculty_loader').removeClass('sk-loading');
            return false;
        }


        var ops_url = baseurl + 'transport/save-trip-details';
        $.ajax({
            type: "POST",
            cache: false,
            async: false,
            url: ops_url,
            data: {
                "load": 1,
                "tripName": tripName,
                "tripCode": tripCode,
                "tripDescription": tripDescription,
                "pickStartTime": pickStartTime,
                "pickEndTime": pickEndTime,
                "dropStartTime": dropStartTime,
                "dropEndTime": dropEndTime,
                "formData": formdata
            },
            success: function(result) {
                var data = JSON.parse(result);
                if (data.status == 1) {
                    load_trip_form();
                    swal('Success', 'New Trip , ' + tripName + ' Saved successfully.', 'success');
                    $('#faculty_loader').removeClass('sk-loading');
                    $("#curd-content").slideUp("slow", function() {
                        $("#curd-content").hide();
                        $('#add_type').show();
                    });
                } else if (data.status == 2 || data.status == 3) {
                    swal('', data.message, 'info');
                    $('#faculty_loader').removeClass('sk-loading');
                } else {
                    swal('', 'Connection Error. Please contact administrator', 'info');
                    $('#faculty_loader').removeClass('sk-loading');
                }
            }
        });
    }

    $('.pickup_sel').on('ifChanged', function() {

        var data_pickpoint_name = $(this).attr('data-pickpoint-name');
        var pickpoint_id = $(this).val();
        var html_fields;
        if ($(this).is(":checked")) {
            html_fields = "<div id='div_pick_fields_" + pickpoint_id + "'><div class='col-md-6'>";
            html_fields += "<b>" + data_pickpoint_name + " *</b><br/> Pickup Time ";
            html_fields += "<div class='form-group clockpicker' data-autoclose='true'>";
            //html_fields += "<div class='form-line>";
            html_fields += "<input type='text' placeholder='" + data_pickpoint_name + "- Pickup Time' class='form-control pick_time' name='trip_pickup_time[" + pickpoint_id + "]' id='trip_pickup_time_" + pickpoint_id + "' value='' onblur='checkTimePick(this)' readonly/>";
            //html_fields += "</div>";
            html_fields += "</div>";
            html_fields += "</div>";
            html_fields += "<div class='col-md-6'>";
            html_fields += "<b>" + data_pickpoint_name + " *</b><br/> Drop Time ";
            html_fields += "<div class='form-group clockpicker' data-autoclose='true'>";
            //html_fields += "<div class='form-line >";
            html_fields += "<input type='text'  placeholder='" + data_pickpoint_name + "- Drop Time' class='form-control pick_time' name='trip_drop_time[" + pickpoint_id + "]' id='trip_pickup_time_" + pickpoint_id + "' value='' onblur='checkTimeDrop(this)' readonly/>";
            html_fields += "</div>";
            // html_fields += "</div>";
            html_fields += "</div></div>";
            $('#point-fields').append(html_fields);
        } else {
            $('#div_pick_fields_' + pickpoint_id).remove();
        }
        $('.clockpicker').clockpicker();
    });

    function checkTripPickTime(sel) {

        var pickStartTime = $('#pickStartTime').val();
        var EndTime = "99:99";


        if (checkTime(pickStartTime, EndTime, sel)) {
            return true;
        } else {
            swal('', 'Pickup End time should be greater than Pickup Start Time', 'info');
            return false;
        }

    }

    function checkTripDropTime(sel) {

        var dropStartTime = $('#dropStartTime').val();
        var EndTime = "99:99";

        if (checkTime(dropStartTime, EndTime, sel)) {
            return true;
        } else {
            swal('', 'Drop End time should be greater than Drop Start Time', 'info');
            return false;
        }

    }

    function checkTripPickDropTime(sel) {

        var pickEndTime = $('#pickEndTime').val();
        var EndTime = "99:99";
        if (checkTime(pickEndTime, EndTime, sel)) {
            return true;
        } else {
            swal('', 'Drop Start Time should be greater than Pickup End Time', 'info');
            return false;
        }

    }


    function checkTimePick(sel) {

        var pickStartTime = $('#pickStartTime').val();
        var pickEndTime = $('#pickEndTime').val();
        if (checkTime(pickStartTime, pickEndTime, sel)) {
            return true;
        } else {
            swal('', 'Please Enter a Time between Trip', 'info');
            return false;
        }

    }

    function checkTimeDrop(sel) {
        var dropStartTime = $('#dropStartTime').val();
        var dropEndTime = $('#dropEndTime').val();
        if (checkTime(dropStartTime, dropEndTime, sel)) {
            return true;
        } else {
            swal('', 'Please Enter a Time between Trip', 'info');
            return false;
        }
    }

    $('.trip_time').change(function() {
        $('.pick_time').val('');
    });



    function checkTime(start_time, end_time, sel) {
        var sel_time = sel.value;

        var dt = new Date();
        error = 0;
        //convert both time into timestamp

        var selt = new Date((dt.getMonth() + 1) + "/" + dt.getDate() + "/" + dt.getFullYear() + " " + sel_time);
        selt = selt.getTime();

        if (start_time != "99:99") {
            var stt = new Date((dt.getMonth() + 1) + "/" + dt.getDate() + "/" + dt.getFullYear() + " " + start_time);
            stt = stt.getTime();
            if (selt < stt) {
                error = 1;
            }
        }
        if (end_time != "99:99") {
            var endt = new Date((dt.getMonth() + 1) + "/" + dt.getDate() + "/" + dt.getFullYear() + " " + end_time);
            endt = endt.getTime();

            if (selt > endt) {
                error = 1;
            }
        }



        if (error == 1) {
            sel.value = '';
            return false
        } else {
            return true;
        }
    }
</script>