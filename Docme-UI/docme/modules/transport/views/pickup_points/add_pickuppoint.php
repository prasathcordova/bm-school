<style>
    .pickup_time {
        background-color: #fff !important;
    }
</style>
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="header">
                <h2 style="padding-bottom: 10px;font-size: 16px;color: #1c84c6;"><?php echo isset($title) ? $title : "NO TITLE PROVIDED" ?>
                    <span><a href="javascript:void(0);" onclick="close_panel();"> <i style="font-size: 30px !important; float: right; color: #E91E63;" class="material-icons" data-toggle="tooltip" title="Close">close</i></a> </span>
                    <span><a href="javascript:void(0);" onclick="submit_data();"> <i style="font-size: 30px !important; float: right; color: #23C6C5; padding-right: 10px;" class="material-icons" data-toggle="tooltip" title="Save">save</i></a> </span>
                    <span><a href="javascript:void(0);" onclick="clear_controls();"> <i style="font-size: 30px !important; float: right; color: #2196F3; padding-right: 10px;" class="material-icons " data-toggle="tooltip" title="Refresh">refresh</i></a> </span>
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
            <div class="body">
                <?php
                echo form_open('', array('id' => 'pickuppoint_save', 'role' => 'form'));
                ?>
                <input type="hidden" name="save_flag" id="save_flag" value="1" />
                <div class="row clearfix">
                    <div class="col-md-6" style="padding:0px">
                        <div class="col-md-12">
                            <b>Pickup Point Name *</b>
                            <div class="form-group">
                                <div class="form-line <?php
                                                        if (form_error('pickuppoint')) {
                                                            echo 'has-error';
                                                        }
                                                        ?> ">
                                    <input type="text" maxlength="25" placeholder="Pickup Point Name" class="form-control alphanumeric" name="pickpointName" id="pickpointName" value="<?php echo set_value('pickpointName', isset($pickuppoint_data['pickpointName']) ? $pickuppoint_data['pickpointName'] : ''); ?>" />
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <b>Location *</b>
                            <div class="form-group">
                                <div class="form-line <?php
                                                        if (form_error('pickuppoint')) {
                                                            echo 'has-error';
                                                        }
                                                        ?> ">
                                    <input id="pickuppointLocation" placeholder="Location" type="text" class="form-control" name="pickuppointLocation" onblur="setRouteOnMap(this.value)" value="<?php echo set_value('pickuppointLocation', isset($pickuppoint_data['pickuppointLocation']) ? $pickuppoint_data['pickuppointLocation'] : ''); ?>" />
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <b>Latitude *</b>
                            <div class="form-group">
                                <div class="form-line <?php
                                                        if (form_error('pickuppointLatitude')) {
                                                            echo 'has-error';
                                                        }
                                                        ?> ">
                                    <input id="pickuppointLatitude" placeholder="Latitude" type="text" class="form-control" name="pickuppointLatitude" readonly value="<?php echo set_value('pickuppointLatitude', isset($pickuppoint_data['pickuppointLatitude']) ? $pickuppoint_data['pickuppointLatitude'] : ''); ?>" />
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <b>Longitude *</b>
                            <div class="form-group">
                                <div class="form-line <?php
                                                        if (form_error('pickuppoint')) {
                                                            echo 'has-error';
                                                        }
                                                        ?> ">
                                    <input id="pickuppointLongitude" placeholder="Longitude" type="text" class="form-control" name="pickuppointLongitude" readonly value="<?php echo set_value('pickuppointLongitude', isset($pickuppoint_data['pickuppointLongitude']) ? $pickuppoint_data['pickuppointLongitude'] : ''); ?>" />
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <b>Description *</b>
                        <div class="form-group">
                            <div class="form-line <?php
                                                    if (form_error('description')) {
                                                        echo 'has-error';
                                                    }
                                                    ?> ">
                                <textarea class="form-control alphanumeric" maxlength="80" placeholder="Description" style="height:170px;resize:none" name="pickuppointDescription" id="pickuppointDescription"><?php echo set_value('description', isset($pickuppointDescription) ? $pickuppointDescription : ''); ?></textarea>
                                <!-- <input type="textarea" row maxlength="80" class="form-control" name="description" id="description" value="<?php echo set_value('description', isset($description) ? $description : ''); ?>" /> -->
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6" style="padding:0px">
                        <div class="col-sm-12">
                            <b>Choose Trips</b><br /><br />
                            <div class="form-group">
                                <?php
                                if (isset($all_trips['data']) && !empty($all_trips['data'])) {
                                    $all_trips_data = $all_trips['data'];
                                    foreach ($all_trips_data as $trip_data) { ?>
                                        <div style="height: 50px;" class="col-sm-6 i-checks"><label> <input type="checkbox" class="trip_sel" data-trip-name="<?php echo $trip_data['tripName'] ?>" data-trip-p-start="<?php echo $trip_data['pickStartTime'] ?>" data-trip-p-end="<?php echo $trip_data['pickEndTime'] ?>" data-trip-d-start="<?php echo $trip_data['dropStartTime'] ?>" data-trip-d-end="<?php echo $trip_data['dropEndTime'] ?>" value="<?php echo $trip_data['id'] ?>"> <?php echo $trip_data['tripName'] ?> </label></div>
                                <?php }
                                } ?>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6" id="point-fields" style="padding:0px">
                        <div class="col-sm-12">
                            <b>Trip Times</b><br /><br />
                        </div>
                    </div>

                </div>
                <?php echo form_close(); ?>
            </div>
        </div>
    </div>
</div>


<!-- <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBkDLA8MD77ueEwwxMgxadTBtzjgU0fJE0&libraries=places"></script> -->
<script type="text/javascript">
    //var input_place = $('#pickup-point').val();
    var input_place = document.getElementById('pickuppointLocation');
    var autocomplete = new google.maps.places.Autocomplete(input_place);

    function setRouteOnMap(place) {
        console.log(place);
        if (place != '') {
            $.ajax({
                url: "https://maps.google.com/maps/api/geocode/json?address=" + place + "&sensor=false&key=AIzaSyBkDLA8MD77ueEwwxMgxadTBtzjgU0fJE0",
                type: "post",
                datatype: "json",
                cache: false,
                async: false,
                success: function(res) {
                    var lat = 8.437566;
                    var lng = 76.966286;
                    if (res.results.length > 0) {
                        lat = res.results[0].geometry.location.lat;
                        lng = res.results[0].geometry.location.lng;
                        var address = res.results[0].formatted_address;
                        $("#pickuppointLatitude").val(lat);
                        $("#pickuppointLongitude").val(lng);
                    } else {
                        swal('', 'Please Enter a valid  Location Name', 'info')
                        $("#pickuppointLatitude,#pickuppointLongitude").val("");
                        $("#pickuppointLocation").val("");
                    }
                }
            });
        } else {
            $("#pickuppointLatitude,#pickuppointLongitude").val("");
        }

    }

    function clear_controls() {
        $('#pickpointName').val('');
        $('#pickuppointDescription').val('');
        $('#pickuppointLocation').val('');
        $('#pickuppointLatitude').val('');
        $('#pickuppointLongitude').val('');
    }

    function submit_data() {
        $('#faculty_loader').addClass('sk-loading');

        var ops_url = baseurl + 'transport/save-new-pickuppoint/';
        var pickpointName = $('#pickpointName').val();
        var pickuppointDescription = $('#pickuppointDescription').val();
        var pickuppointLocation = $('#pickuppointLocation').val();
        var error = 0;
        if (pickpointName == '') {
            swal('', 'Pickup Point Name is required.', 'info');
            $('#faculty_loader').removeClass('sk-loading');
            return false;
        } else if ((pickpointName.length > '25') || (pickpointName.length < '3')) {
            swal('', 'Pickup Point Name should contain letters or numbers 3 to 25.', 'info');
            $('#faculty_loader').removeClass('sk-loading');
            return false;
        }
        var alphanumers = /[\w]|\-|\s+?$/;
        if (!alphanumers.test(pickpointName)) {
            swal('', 'Pickup Point Name can have only alphabets or numbers.', 'info');
            $('#faculty_loader').removeClass('sk-loading');
            return false;
        }

        if (pickuppointDescription == '') {
            swal('', 'Description is required.', 'info');
            $('#faculty_loader').removeClass('sk-loading');
            return false;
        } else if ((pickuppointDescription.length > '80') || (pickuppointDescription.length < '3')) {
            swal('', 'Description should contain letters or numbers 3 to 80.', 'info');
            $('#faculty_loader').removeClass('sk-loading');
            return false;
        }
        var alphanumers = /^[a-zA-Z\s0-9]+$/;
        if (!alphanumers.test(pickuppointDescription)) {
            swal('', 'Description can have only alphabets or numbers.', 'info');
            $('#faculty_loader').removeClass('sk-loading');
            return false;
        }

        if (pickuppointLocation == '') {
            swal('', 'Location is required.', 'info');
            $('#faculty_loader').removeClass('sk-loading');
            return false;
        }

        if ($("#pickuppointLatitude").val() == '') {
            swal('', 'Latitude is required, Try entering a valid Location.', 'info');
            $('#faculty_loader').removeClass('sk-loading');
            return false;
        }
        if ($("#pickuppointLongitude").val() == '') {
            swal('', 'Longitude is required,Try entering a valid Location.', 'info');
            $('#faculty_loader').removeClass('sk-loading');
            return false;
        }

        $('.pickup_time').each(function() {

            if ($(this).val() == '') {
                error++;
            }
        });

        if (error != 0) {
            swal('', 'All Trip Times are required', 'info');
            $('#faculty_loader').removeClass('sk-loading');
            return false;
        }

        $.ajax({
            type: "POST",
            cache: false,
            async: false,
            url: ops_url,
            data: $('#pickuppoint_save').serialize(),
            success: function(result) {
                var data = $.parseJSON(result);
                if (data.status == 1) {
                    load_pickpoint_on_show();
                    swal('Success', 'New Pickup Point, ' + pickpointName + ' created successfully.', 'success');
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


    $('.trip_sel').on('ifChanged', function() {

        var trip_name = $(this).attr('data-trip-name');
        var trip_p_start = $(this).attr('data-trip-p-start');
        var trip_p_end = $(this).attr('data-trip-p-end');
        var trip_d_start = $(this).attr('data-trip-d-start');
        var trip_d_end = $(this).attr('data-trip-d-end');
        var trip_id = $(this).val();
        var html_fields;
        if ($(this).is(":checked")) {
            html_fields = "<div id='div_trip_fields_" + trip_id + "'><div class='col-md-6'>";
            html_fields += "<b>" + trip_name + " *</b><br/> Pickup Time (" + trip_p_start + "-" + trip_p_end + ") ";
            html_fields += "<div class='form-group clockpicker' data-autoclose='true'>";
            //html_fields += "<div class='form-line>";
            html_fields += "<input type='text' placeholder='" + trip_name + "- Pickup Time (" + trip_p_start + "-" + trip_p_end + ")' class='form-control pickup_time' name='trip_pickup_time[" + trip_id + "]' id='trip_pickup_time_" + trip_id + "' value='' onblur='checkTime(\"" + trip_p_start + "\",\"" + trip_p_end + "\",this)' readonly/>";
            //html_fields += "</div>";
            html_fields += "</div>";
            html_fields += "</div>";
            html_fields += "<div class='col-md-6'>";
            html_fields += "<b>" + trip_name + " *</b><br/> Drop Time (" + trip_d_start + "-" + trip_d_end + ") ";
            html_fields += "<div class='form-group clockpicker' data-autoclose='true'>";
            //html_fields += "<div class='form-line >";
            html_fields += "<input type='text' placeholder='" + trip_name + "- Drop Time (" + trip_d_start + "-" + trip_d_end + ")' class='form-control pickup_time' name='trip_drop_time[" + trip_id + "]' id='trip_pickup_time_" + trip_id + "' value='' onblur='checkTime(\"" + trip_d_start + "\",\"" + trip_d_end + "\",this)' readonly/>";
            html_fields += "</div>";
            // html_fields += "</div>";
            html_fields += "</div></div>";
            $('#point-fields').append(html_fields);
        } else {
            $('#div_trip_fields_' + trip_id).remove();
        }
        $('.clockpicker').clockpicker();
    });

    function checkTime(start_time, end_time, sel) {
        var sel_time = sel.value;

        var dt = new Date();

        //convert both time into timestamp
        var stt = new Date((dt.getMonth() + 1) + "/" + dt.getDate() + "/" + dt.getFullYear() + " " + start_time);
        stt = stt.getTime();

        var endt = new Date((dt.getMonth() + 1) + "/" + dt.getDate() + "/" + dt.getFullYear() + " " + end_time);
        endt = endt.getTime();

        var selt = new Date((dt.getMonth() + 1) + "/" + dt.getDate() + "/" + dt.getFullYear() + " " + sel_time);
        selt = selt.getTime();

        error = 0;
        if (selt < stt) {
            error = 1;
        }
        if (selt > endt) {
            error = 1;
        }
        if (error == 1) {
            swal('', 'Please Enter a Time between Trip', 'info');
            sel.value = '';
        }
    }

    $(document).ready(function() {
        $('.i-checks').iCheck({
            checkboxClass: 'icheckbox_square-green',
            radioClass: 'iradio_square-green',
        });
    });
</script>