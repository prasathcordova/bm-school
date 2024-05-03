<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
    <div class="card">
        <div class="header">
            <h2 style="padding-bottom: 10px;font-size: 16px;color: #1c84c6;"><?php echo isset($sub_title) ? $sub_title : "NO TITLE PROVIDED" ?>
                <span><a href="javascript:void(0);" onclick="close_panel();"><i style="font-size: 30px !important; float: right; color: #E91E63;" class="material-icons" data-toggle="tooltip" title="Close">close</i></a> </span>
                <span><a href="javascript:void(0);" onclick="save_driver_details();"><i style="font-size: 30px !important; float: right; color: #23C6C5; padding-right: 10px;" class="material-icons" data-toggle="tooltip" title="Save">save</i></a> </span>
                <span><a href="javascript:void(0);" onclick="clear_controls();"><i style="font-size: 30px !important; float: right; color: #2196F3; padding-right: 10px;" class="material-icons " data-toggle="tooltip" title="Refresh">refresh</i></a> </span>
            </h2>
        </div>
        <div class="body">
            <?php
            echo form_open('', array('id' => 'driver_save', 'role' => 'form'));
            ?>
            <?php
            $breaker = 0;
            ?>
            <div class="col-lg-12">
                <div id="curd-content" style="display: none;"></div>
                <div class="ibox-content">
                    <form method="post" id="myform">
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Name *</label>
                                    <select class="form-control selectpicker" name="driver_name" id="driver_name" data-live-search="true">
                                        <option selected value="-1">Select</option>
                                        <?php
                                        if (isset($emp_data) && !empty($emp_data)) {
                                            foreach ($emp_data as $emp) {
                                                echo '<option value ="' . $emp['Emp_id'] . '" >' . $emp['Emp_Name'] . ' - ' . $emp['Emp_code'] . '</option>';
                                            }
                                        }
                                        ?>
                                    </select>
                                </div>
                                <!-- <div class="form-group">
                                        <label>Conductor Name *</label>
                                        <input type="text" class="form-control alpha" maxlength="50" placeholder="Conductor Name" name="conductor_name" id="conductor_name" autocomplete="off">
                                    </div> -->
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Vehicle *</label>
                                    <select class="form-control selectpicker" name="vehicle_no" id="vehicle_no" data-live-search="true">
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
                                <!-- <div class="form-group">
                                        <label>Conductor Name *</label>
                                        <input type="text" class="form-control alpha" maxlength="50" placeholder="Conductor Name" name="conductor_name" id="conductor_name" autocomplete="off">
                                    </div> -->
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group date">
                                    <label class="form-label">Start Date *</label>
                                    <input type="text" class="form-control" name="start_date" placeholder="Start Date" id="start_date" autocomplete="off" readonly style="background: #fff" />
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group date1">
                                    <label class="form-label">End Date *</label>
                                    <input type="text" class="form-control" name="end_date" placeholder="End Date" id="end_date" autocomplete="off" readonly style="background: #fff" />
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


    });

    $('#conductor_name').on('change', function() {
        var conductor_name = $('#conductor_name').val();
        var ops_url = baseurl + 'transport/get_select_emp_data/';
        $.ajax({
            type: "POST",
            cache: false,
            async: false,
            url: ops_url,
            data: {
                "load": 1,
                "cid": conductor_name
            },
            success: function(result) {
                var data = JSON.parse(result);
                var d = data.emp_data;
                $('#mobile_no').val(d[0].Mobile);

            }
        });
    });

    function load_driver() {
        var ops_url = baseurl + 'transport/show-driver/';
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

    function save_driver_details() {
        // $('#faculty_loader').addClass('sk-loading');
        var ops_url = baseurl + 'transport/add-driver/';
        var driver_name = $('#driver_name').val();
        var vehicle_no = $('#vehicle_no').val();
        var start_date = moment($("#start_date").datepicker("getDate")).format('YYYY-MM-DD');
        var end_date = moment($("#end_date").datepicker("getDate")).format('YYYY-MM-DD');


        var alphanumers = /^[a-zA-Z\s]+$/;

        if (driver_name == -1) {
            swal('', 'Name is required.', 'info');
            $('#faculty_loader').removeClass('sk-loading');
            return false;
        } else if (vehicle_no == -1) {
            swal('', 'Vehicle No is required.', 'info');
            $('#faculty_loader').removeClass('sk-loading');
            return false;
        } else if ($("#start_date").val() == '') {
            swal('', 'Start Date is required.', 'info');
            return false;
        } else if ($("#end_date").val() == '') {
            swal('', 'End Date is required.', 'info');
            return false;
        }

        if (!moment(start_date).isValid()) {
            swal('', 'Enter valid Start date.', 'info');
            return false;
        }
        if (!moment(end_date).isValid()) {
            swal('', 'Enter valid End date.', 'info');
            return false;
        }

        if (start_date > end_date) {
            swal('', 'End date should be Greater than or equal to Start date.', 'info');
            return false;
        }


        $.ajax({
            type: "POST",
            cache: false,
            async: false,
            url: ops_url,
            data: $('#driver_save').serialize(),
            success: function(result) {
                var data = $.parseJSON(result);
                if (data.status == 1) {
                    load_driver();
                    swal('Success', 'Driver created successfully.', 'success');
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
    // $('#conductor_name').val('-1');

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
        $('#driver_name').val('-1').trigger('change');
        $('#vehicle_no').val('-1').trigger('change');
        $('#start_date').val('');
        $('#end_date').val('');
    }
</script>