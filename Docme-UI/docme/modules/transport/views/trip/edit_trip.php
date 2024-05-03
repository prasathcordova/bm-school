<style>
    .pick_time {
        background-color: #fff !important;
    }
</style>
<div class="ibox-title">
    <h2 style="padding-bottom: 10px;font-size: 16px;color: #1c84c6;"><?php echo isset($title) ? $title : "NO TITLE PROVIDED" ?></h2>

    <div class="clearfix"></div>
    <div class="ibox-tools" id="edit_type">
        <span><a href="javascript:void(0);" onclick="toggle_edit_panel();"> <i style="font-size: 30px !important; float: right; color: #E91E63;" class="material-icons" data-toggle="tooltip" title="Close">close</i></a> </span>
        <span><a href="javascript:void(0);" onclick="submit_edit_save_data();"> <i style="font-size: 30px !important; float: right; color: #23C6C5; padding-right: 10px;" class="material-icons" data-toggle="tooltip" title="Save">save</i></a> </span>
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
    <div class="row"> <?php
                        echo form_open('', array('id' => 'trip_edit_save', 'role' => 'form'));
                        ?>
        <input type="hidden" value="<?php echo $title; ?>" id="title_data" name="title_data" />
        <input type="hidden" value="<?php echo set_value('tripId', isset($trip_data['tripId']) ? $trip_data['tripId'] : ''); ?>" id="tripId" name="tripId" />
        <div class="row clearfix">
            <div class="col-sm-6">
                <div class="form-group ">
                    <label>Trip Name *</label>
                    <input type="text" class="form-control alphanumeric" maxlength="20" placeholder="Trip Name" name="tripName" id="tripName" value="<?php echo set_value('tripName', isset($trip_data['tripName']) ? $trip_data['tripName'] : ''); ?>" autocomplete="off">
                </div>
            </div>

            <div class="col-sm-6">
                <div class="form-group">
                    <label class="form-label">Trip Description *</label>
                    <input type="text" class="form-control alphanumeric" maxlength="50" placeholder="Trip Description" name="tripDescription" id="tripDescription" value="<?php echo set_value('tripDescription', isset($trip_data['tripDescription']) ? $trip_data['tripDescription'] : ''); ?>" autocomplete="off">
                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-group clockpicker" data-autoclose="true">
                    <label>Pickup Start Time *</label>
                    <input type="text" class="form-control trip_time" name="pickStartTime" id="pickStartTime" value="<?php echo set_value('pickStartTime', isset($trip_data['pickStartTime']) ? $trip_data['pickStartTime'] : ''); ?>" placeholder="Pickup Start Time" readonly="" style="background-color: #fff;">
                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-group clockpicker" data-autoclose="true">
                    <label>Pickup End Time *</label>
                    <input type="text" class="form-control trip_time" name="pickEndTime" id="pickEndTime" value="<?php echo set_value('pickEndTime', isset($trip_data['pickEndTime']) ? $trip_data['pickEndTime'] : ''); ?>" placeholder="Pickup End Time" readonly="" onblur="checkTripPickTime(this)" style="background-color: #fff;">
                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-group clockpicker" data-autoclose="true">
                    <label>Drop Start Time *</label>
                    <input type="text" class="form-control trip_time" name="dropStartTime" id="dropStartTime" value="<?php echo set_value('dropStartTime', isset($trip_data['dropStartTime']) ? $trip_data['dropStartTime'] : ''); ?>" placeholder="Drop Start Time" readonly="" onblur="checkTripPickDropTime(this)" style="background-color: #fff;">
                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-group clockpicker" data-autoclose="true">
                    <label>Drop End Time *</label>
                    <input type="text" class="form-control trip_time" name="dropEndTime" id="dropEndTime" value="<?php echo set_value('dropEndTime', isset($trip_data['dropEndTime']) ? $trip_data['dropEndTime'] : ''); ?>" placeholder="Drop End Time" readonly="" onblur="checkTripDropTime(this)" style="background-color: #fff;">
                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-group ">
                    <label>Trip Code *</label>
                    <input type="text" class="form-control alphanumeric" maxlength="5" placeholder="Trip Code" name="tripCode" id="tripCode" value="<?php echo set_value('tripCode', isset($trip_data['tripCode']) ? $trip_data['tripCode'] : ''); ?>" autocomplete="off">
                </div>
            </div>
        </div>
        <?php
        $selected_pickpoint_array = [];
        $html = '';

        if (empty($trip_pickpoint_relation_data['ErrorStatus'])) {
            foreach ($trip_pickpoint_relation_data as $data) {
                if (isset($data['pickupPointId']))
                    $selected_pickpoint_array[] = $data['pickupPointId'];
                $html .= '<div id="div_pick_fields_' . $data['pickupPointId'] . '">
                            <div class="col-md-6"><b>' . $data['pickpointName'] . ' *</b><br/> Pickup Time 
                                <div class="form-group clockpicker" data-autoclose="true">
                                <input type="text" placeholder="' . $data['pickpointName'] . '- Pickup Time" class="form-control pick_time" name="trip_pickup_time[' . $data['pickupPointId'] . ']" id="trip_pickup_time_' . $data['pickupPointId'] . '" value="' . $data['pickuptime'] . '" onblur="checkTimePick(this)" readonly>
                            </div>
                        </div>
                            <div class="col-md-6"><b>' . $data['pickpointName'] . ' *</b><br/> Drop Time
                                <div class="form-group clockpicker" data-autoclose="true">
                                    <input type="text" placeholder="' . $data['pickpointName'] . '- Drop Time" class="form-control pick_time" name="trip_drop_time[' . $data['pickupPointId'] . ']" id="trip_pickup_time_' . $data['pickupPointId'] . '" value="' . $data['droptime'] . '" onblur="checkTimeDrop(this)" readonly>
                                </div>
                            </div>
                        </div>';
            }
        }
        ?>
        <div class="row">
            <div class="col-sm-6" style="padding:0px">
                <div class="col-sm-12">
                    <b>Choose Pickup Points</b><br /><br />
                    <div class="form-group">
                        <?php
                        if (isset($all_pickpoints['data']) && !empty($all_pickpoints['data'])) {
                            $all_pickpoints_data = $all_pickpoints['data'];
                            foreach ($all_pickpoints_data as $pickuppoint_data) {
                                if (in_array($pickuppoint_data['id'], $selected_pickpoint_array)) {
                                    $checked = 'checked';
                                } else {
                                    $checked = '';
                                } ?>
                                <div style="height: 50px;" class="col-sm-6 i-checks"><label> <input type="checkbox" <?php echo $checked ?> class="pickup_sel" data-pickpoint-name="<?php echo $pickuppoint_data['pickpointName'] ?>" value="<?php echo $pickuppoint_data['id'] ?>"> <?php echo $pickuppoint_data['pickpointName'] ?> </label></div>
                        <?php }
                        } ?>
                    </div>
                </div>
            </div>
            <div class="col-sm-6" id="point-fields" style="padding:0px">
                <div class="col-sm-12">
                    <b>Pickup Point Times</b><br /><br />
                </div>
                <?php echo $html ?>
            </div>
        </div>

    </div>

    <?php echo form_close(); ?>
</div>
</div>



<script type="text/javascript">
    function toggle_edit_panel() {
        if ($('#curd-content').is(":visible") == true) {
            $("#curd-content").slideUp("slow", function() {
                $("#curd-content").hide();
                $('#add_type').show();
                $('#search-feecode').show()
            });
        }
    }


    function submit_edit_save_data() {
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
            swal('', 'Trip name is required', 'info');
            $('#faculty_loader').removeClass('sk-loading');
            return false;
        } else if ((tripName.length > '20') || (tripName.length < '3')) {
            swal('', 'Trip Name should contain letters or numbers 3 to 20.', 'info');
            $('#faculty_loader').removeClass('sk-loading');
            return false;
        }
        if (tripCode == '') {
            swal('', 'Trip code is required', 'info');
            $('#faculty_loader').removeClass('sk-loading');
            return false;
        } else if ((tripCode.length > '5') || (tripCode.length < '5')) {
            swal('', 'Trip Code should contain letters or numbers minimum and maximum 5. ', 'info');
            $('#faculty_loader').removeClass('sk-loading');
            return false;
        }
        if (tripDescription == '') {
            swal('', 'Trip Description is required', 'info');
            $('#faculty_loader').removeClass('sk-loading');
            return false;
        } else if ((tripDescription.length > '50') || (tripDescription.length < '3')) {
            swal('', 'Trip Descriptipn should contain letters or numbers 3 to 50.', 'info');
            $('#faculty_loader').removeClass('sk-loading');
            return false;
        }

        if (pickStartTime == '') {
            swal('', 'Pickup Start Time is required', 'info');
            $('#faculty_loader').removeClass('sk-loading');
            return false;
        }
        if (pickEndTime == '') {
            swal('', 'Pickup End Time is required', 'info');
            $('#faculty_loader').removeClass('sk-loading');
            return false;
        }
        if (moment('12-12-2000 ' + pickStartTime) >= moment('12-12-2000 ' + pickEndTime)) {
            swal('', 'Pickup End Time should be greater than Pickup Start Time', 'info');
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
            swal('', 'Drop End Time should be greater than Drop Start Time ', 'info');
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
        var ops_url = baseurl + 'transport/save-trip-edit';
        $.ajax({
            type: "POST",
            cache: false,
            async: false,
            url: ops_url,
            data: $('#trip_edit_save').serialize(),
            success: function(result) {
                var data = $.parseJSON(result);
                if (data.status == 1) {
                    load_trip_form();
                    swal('Success', 'Trip, ' + tripName + ' Updated Successfully.', 'success');
                    $('#faculty_loader').removeClass('sk-loading');
                    $("#curd-content").slideUp("slow", function() {
                        $("#curd-content").hide();
                        $('#add_type').show();
                    });
                } else if (data.status == 2 || data.status == 3 || data.status == 4) {
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
        $('.i-checks').iCheck({
            checkboxClass: 'icheckbox_square-green',
            radioClass: 'iradio_square-green',
        });

        $('.clockpicker').clockpicker();
    });

    $('.pickup_sel').on('ifChanged', function() {

        var data_pickpoint_name = $(this).attr('data-pickpoint-name');
        var pickpoint_id = $(this).val();
        var html_fields;
        if ($(this).is(":checked")) {
            html_fields = "<div id='div_pick_fields_" + pickpoint_id + "'><div class='col-md-6'>";
            html_fields += "<b>" + data_pickpoint_name + " *</b><br/>Pickup Time ";
            html_fields += "<div class='form-group clockpicker' data-autoclose='true'>";
            //html_fields += "<div class='form-line>";
            html_fields += "<input type='text' placeholder='" + data_pickpoint_name + "- Pickup Time' class='form-control pick_time' name='trip_pickup_time[" + pickpoint_id + "]' id='trip_pickup_time_" + pickpoint_id + "' value='' onblur='checkTimePick(this)'/ readonly>";
            //html_fields += "</div>";
            html_fields += "</div>";
            html_fields += "</div>";
            html_fields += "<div class='col-md-6'>";
            html_fields += "<b>" + data_pickpoint_name + " *</b><br/>Drop Time ";
            html_fields += "<div class='form-group clockpicker' data-autoclose='true'>";
            //html_fields += "<div class='form-line >";
            html_fields += "<input type='text' placeholder='" + data_pickpoint_name + "- Drop Time' class='form-control pick_time' name='trip_drop_time[" + pickpoint_id + "]' id='trip_pickup_time_" + pickpoint_id + "' value='' onblur='checkTimeDrop(this)'readonly/>";
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