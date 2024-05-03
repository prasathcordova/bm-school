<style>
    .pickup_time {
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
                        echo form_open('', array('id' => 'pickuppoint_edit_save', 'role' => 'form'));
                        ?>
        <input type="hidden" value="<?php echo $title; ?>" id="title_data" name="title_data" />
        <input type="hidden" value="<?php echo $pickuppoint_data['id']; ?>" name="pickuppoint_id" id="pickuppoint_id" />

        <div class="col-md-6" style="padding:0px">

            <div class="col-md-12">
                <b>Pickup Point Name *</b>
                <div class="form-group">
                    <div class="form-line <?php
                                            if (form_error('pickpointName')) {
                                                echo 'has-error';
                                            }
                                            ?> ">
                        <input type="hidden" value="<?php echo set_value('id', isset($pickuppoint_data['id']) ? $pickuppoint_data['id'] : ''); ?>" id="pickuppointId" name="pickuppointId" />
                        <input type="text" maxlength="25" class="form-control alphanumeric" name="pickpointName" id="pickpointName" value="<?php echo set_value('pickpointName', isset($pickuppoint_data['pickpointName']) ? $pickuppoint_data['pickpointName'] : ''); ?>" />
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
                        <input id="pickuppointLocation" type="text" class="form-control" name="pickuppointLocation" onblur="setRouteOnMap(this.value)" value="<?php echo set_value('pickuppointLocation', isset($pickuppoint_data['pickuppointLocation']) ? $pickuppoint_data['pickuppointLocation'] : ''); ?>" />
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
                        <input id="pickuppointLatitude" type="text" class="form-control" name="pickuppointLatitude" readonly value="<?php echo set_value('pickuppointLatitude', isset($pickuppoint_data['pickuppointLatitude']) ? $pickuppoint_data['pickuppointLatitude'] : ''); ?>" />
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
                        <input id="pickuppointLongitude" type="text" class="form-control" name="pickuppointLongitude" readonly value="<?php echo set_value('pickuppointLongitude', isset($pickuppoint_data['pickuppointLongitude']) ? $pickuppoint_data['pickuppointLongitude'] : ''); ?>" />
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <b>Description *</b>
            <div class="form-group">
                <div class="form-line <?php
                                        if (form_error('pickuppointDescription')) {
                                            echo 'has-error';
                                        }
                                        ?> ">
                    <textarea class="form-control alphanumeric" maxlength="80" style="height:170px;resize:none" name="pickuppointDescription" id="pickuppointDescription"><?php echo set_value('pickuppointDescription', isset($pickuppoint_data['pickuppointDescription']) ? $pickuppoint_data['pickuppointDescription'] : ''); ?>  </textarea>
                    <!-- <input type="textarea" row maxlength="80" class="form-control" name="description" id="description" value="<?php //echo set_value('description', isset($description) ? $description : ''); 
                                                                                                                                    ?>" /> -->
                </div>
            </div>
        </div>
        <?php
        $selected_trip_array = [];
        $html = '';
        // dev_export($trip_pickpoint_relation_data);
        // die;
        if (empty($trip_pickpoint_relation_data['ErrorStatus'])) {
            if (isset($trip_pickpoint_relation_data) && !empty($trip_pickpoint_relation_data)) {
                foreach ($trip_pickpoint_relation_data as $data) {
                    if (isset($data['tripId']))
                        $selected_trip_array[] = $data['tripId'];
                    $html .= '<div id="div_trip_fields_' . $data['tripId'] . '">
                                <div class="col-md-6"><b>' . $data['tripName'] .  ' *</b><br/> Pickup Time (' . $data['pickStartTime'] . '-' . $data['pickEndTime'] . ')
                                    <div class="form-group clockpicker" data-autoclose="true">
                                    <input type="text" placeholder="' . $data['tripName'] . '- Pickup Time (' . $data['pickStartTime'] . '-' . $data['pickEndTime'] . ')" class="form-control pickup_time" name="trip_pickup_time[' . $data['tripId'] . ']" id="trip_pickup_time_' . $data['tripId'] . '" value="' . $data['pickuptime'] . '" onblur="checkTime(&quot;' . $data['pickStartTime'] . '&quot;,&quot;' . $data['pickEndTime'] . '&quot;,this)" readonly>
                                </div>
                            </div>
                                <div class="col-md-6"><b>' . $data['tripName'] . ' *</b><br/> Drop Time (' . $data['dropStartTime'] . '-' . $data['dropEndTime'] . ')
                                    <div class="form-group clockpicker" data-autoclose="true">
                                        <input type="text" placeholder="' . $data['tripName'] . '- Drop Time (' . $data['dropStartTime'] . '-' . $data['dropEndTime'] . ')" class="form-control pickup_time" name="trip_drop_time[' . $data['tripId'] . ']" id="trip_pickup_time_' . $data['tripId'] . '" value="' . $data['droptime'] . '" onblur="checkTime(&quot;' . $data['dropStartTime'] . '&quot;,&quot;' . $data['dropEndTime'] . '&quot;,this)" readonly>
                                    </div>
                                </div>
                            </div>';
                }
            }
        }
        ?>
        <div class="col-sm-6" style="padding:0px">
            <div class="col-sm-12">
                <b>Choose Trips</b><br /><br />
                <div class="form-group">
                    <?php
                    if (isset($all_trips['data']) && !empty($all_trips['data'])) {
                        $all_trips_data = $all_trips['data'];
                        // dev_export($all_trips_data);
                        // die;
                        foreach ($all_trips_data as $trip_data) {
                            if (in_array($trip_data['id'], $selected_trip_array)) {
                                $checked = 'checked';
                            } else {
                                $checked = '';
                            }
                    ?>
                            <div style="height: 50px;" class="col-sm-6 i-checks"><label> <input type="checkbox" <?php echo $checked ?> class="trip_sel" data-trip-name="<?php echo $trip_data['tripName'] ?>" data-trip-p-start="<?php echo $trip_data['pickStartTime'] ?>" data-trip-p-end="<?php echo $trip_data['pickEndTime'] ?>" data-trip-d-start="<?php echo $trip_data['dropStartTime'] ?>" data-trip-d-end="<?php echo $trip_data['dropEndTime'] ?>" value="<?php echo $trip_data['id'] ?>"> <?php echo $trip_data['tripName'] ?> </label></div>
                    <?php }
                    } ?>
                </div>
            </div>
        </div>
        <div class="col-sm-6" id="point-fields" style="padding:0px">
            <div class="col-sm-12">
                <b>Trip Times</b><br /><br />
            </div>
            <?php echo $html ?>
        </div>
        <?php echo form_close(); ?>
    </div>
</div>



<script type="text/javascript">
    //var input_place = $('#pickup-point').val();
    var input_place = document.getElementById('pickuppointLocation');
    var autocomplete = new google.maps.places.Autocomplete(input_place);
    $('.clockpicker').clockpicker();

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

    function toggle_edit_panel() {
        if ($('#curd-content').is(":visible") == true) {
            $("#curd-content").slideUp("slow", function() {
                $("#curd-content").hide();
                $('#add_type').show();
                $('#search-feecode').show()
            });
        }
    }

    function clear_controls() {
        $('#pickuppoint_name').val('');
        $('#description').val('');
    }

    function submit_edit_save_data() {
        $('#faculty_loader').addClass('sk-loading');
        var ops_url = baseurl + 'transport/save-edit-pickuppoint';
        var pickuppoint_name_new = $('#pickpointName').val();
        var pickuppoint_desc_new = $('#pickuppointDescription').val();
        var pickuppointLocation = $('#pickuppointLocation').val();
        var error = 0


        if (pickuppoint_name_new == '') {
            swal('', 'Pickup Point Name is required.', 'info');
            $('#faculty_loader').removeClass('sk-loading');
            return false;
        } else if ((pickuppoint_name_new.length > '25') || (pickuppoint_name_new.length < '3')) {
            swal('', 'Pickup Point Name should contain letters or numbers 3 to 25.', 'info');
            $('#faculty_loader').removeClass('sk-loading');
            return false;
        }
        var alphanumers = /[\w]|\-|\s+?$/;
        if (!alphanumers.test(pickuppoint_name_new)) {
            swal('', 'Pickup Point Name can have only alphabets or numbers.', 'info');
            $('#faculty_loader').removeClass('sk-loading');
            return false;
        }

        if (pickuppoint_desc_new == '') {
            swal('', 'Description is required.', 'info');
            $('#faculty_loader').removeClass('sk-loading');
            return false;
        } else if ((pickuppoint_desc_new.length > '80') || (pickuppoint_desc_new.length < '3')) {
            swal('', 'Description should contain letters or numbers 3 to 80.', 'info');
            $('#faculty_loader').removeClass('sk-loading');
            return false;
        }
        var alphanumers = /^[a-zA-Z\s0-9]+$/;
        if (!alphanumers.test(pickuppoint_desc_new)) {
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
            data: $('#pickuppoint_edit_save').serialize(),
            success: function(result) {
                var data = $.parseJSON(result);
                if (data.status == 1) {
                    load_pickpoint_on_show();
                    swal('Success', 'Pickup Point, ' + pickuppoint_name_new + ' Updated Successfully.', 'success');
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
    });

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
            html_fields += "<b>" + trip_name + " *</b><br/> Pickup Time (" + trip_p_start + "-" + trip_p_end + ")";
            html_fields += "<div class='form-group clockpicker' data-autoclose='true'>";
            //html_fields += "<div class='form-line>";
            html_fields += "<input type='text' placeholder='" + trip_name + "- Pickup Time (" + trip_p_start + "-" + trip_p_end + ")' class='form-control pickup_time' name='trip_pickup_time[" + trip_id + "]' id='trip_pickup_time_" + trip_id + "' value='' onblur='checkTime(\"" + trip_p_start + "\",\"" + trip_p_end + "\",this)' readonly/>";
            //html_fields += "</div>";
            html_fields += "</div>";
            html_fields += "</div>";
            html_fields += "<div class='col-md-6'>";
            html_fields += "<b>" + trip_name + " *</b><br/> Drop Time (" + trip_d_start + "-" + trip_d_end + ")";
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
</script>