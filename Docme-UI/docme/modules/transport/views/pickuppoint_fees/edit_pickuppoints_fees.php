<div class="ibox-title">
    <h2 style="padding-bottom: 10px;font-size: 16px;color: #1c84c6;"><?php echo isset($title) ? $title : "NO TITLE PROVIDED" ?></h2>

    <div class="clearfix"></div>
    <div class="ibox-tools" id="edit_type">
        <span><a href="javascript:void(0);" onclick="toggle_edit_panel();"> <i style="font-size: 30px !important; float: right; color: #E91E63;" class="material-icons" data-toggle="tooltip" title="Close">close</i></a> </span>
        <span><a href="javascript:void(0);" onclick="submit_edit_save_data();"> <i style="font-size: 30px !important; float: right; color: #23C6C5; padding-right: 10px;" class="material-icons" data-toggle="tooltip" title="Save">save</i></a> </span>
    </div>

</div>
<div class="ibox-content">
    <div class="row"> <?php
                        echo form_open('', array('id' => 'pickuppoint_fees_edit_save', 'role' => 'form'));
                        ?>
        <input type="hidden" value="<?php echo $title; ?>" id="title_data" name="title_data" />
        <input type="hidden" value="<?php echo set_value('pickuppointId', isset($pickup_point_fees_data['pickuppointId']) ? $pickup_point_fees_data['pickuppointId'] : ''); ?>" name="pickuppointId" id="pickuppointId" />
        <div class="col-md-6">
            <b>One Side Fees *</b>
            <div class="form-group">
                <div class="form-line <?php
                                        if (form_error('fee_amt')) {
                                            echo 'has-error';
                                        }
                                        ?> ">
                    <input type="text" class="form-control digits" maxlength="8" placeholder="One side Fees" name="fee_amt" id="fee_amt" value="<?php echo set_value('fee_amt', isset($pickup_point_fees_data['fee_amt']) ? $pickup_point_fees_data['fee_amt'] : ''); ?>" />
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <b>Two Side Fees *</b>
            <div class="form-group">
                <div class="form-line <?php
                                        if (form_error('fee_amt_2')) {
                                            echo 'has-error';
                                        }
                                        ?> ">
                    <input type="text" class="form-control digits" maxlength="8" placeholder="Two side Fees" name="fee_amt_2" id="fee_amt_2" value="<?php echo set_value('fee_amt_2', isset($pickup_point_fees_data['fee_amt_2']) ? $pickup_point_fees_data['fee_amt_2'] : ''); ?>" />
                </div>
            </div>
        </div>
        <div class="col-sm-6">
            <b>With Effect From</b>
            <div class="form-group">
                <div class="form-line <?php
                                        if (form_error('activation_date')) {
                                            echo 'has-error';
                                        }
                                        ?> ">
                    <input type="text" class="form-control is-datepicker" id="StartDate" value="" readonly style="background-color: #fff;" />
                    <input type="hidden" id="startdate_formatted" name="StartDate">
                </div>
            </div>
        </div>

        <div class="col-lg-12">
            <table class="table table-striped table-bordered table-hover dataTables-example" id="tbl_trip">

                <thead>
                    <tr>
                        <th style="text-align:center">Student Name</th>
                        <th style="text-align:center">Batch</th>
                        <th style="text-align:center">Admission No</th>
                        <th style="text-align:center">Transport Dates</th>
                        <th style="text-align:center">Fees Type</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if (isset($pickup_student_details) && !empty($pickup_student_details) && is_array($pickup_student_details)) {
                        $display_checkbox = "";
                        $checked = "";
                        foreach ($pickup_student_details as $data) {
                            $end_date_value = $data['transportEndDate'] == '' ? date('d/m/Y', strtotime($this->session->userdata('lock_end_date'))) : date('d/m/Y', strtotime($data['transportEndDate']));
                    ?>
                            <tr>
                                <td> <?php echo $data['student_name']; ?></td>
                                <td> <?php echo $data['Batch_Name']; ?></td>
                                <td> <?php echo $data['Admn_No']; ?></td>
                                <td> <?php echo date('d/m/Y', strtotime($data['transportStartDate'])) . ' to ' . $end_date_value; ?></td>
                                <td> <?php echo $data['pickStopId'] == $data['dropStopId'] ? 'Two Side Fees' : 'One Side Fees' ?></td>
                            </tr>
                        <?php
                        }
                    } else {
                        $display_checkbox = "style=display:none"; 
                        $checked = "checked" ?>
                        <tr>
                            <td colspan=5 style="text-align:center">No Students Alloted</td>
                        <?php }
                        ?>
                </tbody>
            </table>
            <?php
            //dev_export($pickup_student_details);
            //die; 
            ?>
            <div <?php echo $display_checkbox ?>>
                <div class="form-group">
                    <div style="height: 50px;" class="col-sm-12 i-checks"><label> <input type="checkbox" id="check1" <?php echo $checked ?>> <span style="font-size:11px">Confirmed and verified the students in the pickup point. </span></label></div>
                </div>
                <div class="form-group">
                    <div style="height: 50px;" class="col-sm-12 i-checks"><label> <input type="checkbox" id="check2" <?php echo $checked ?>> <span style="font-size:11px">Confirmed that if the new pickup point fees is lesser than demanded fee , then fee change will not be reflected in full/partial payments. </span></label></div>
                </div>
            </div>
            <?php echo form_close(); ?>
        </div>
    </div>
    <script type="text/javascript">
     var mindate = new Date('<?php echo $this->session->userdata('acd_year_start'); ?>');
        $('#StartDate').datepicker({
            todayBtn: "linked",
            keyboardNavigation: false,
            forceParse: false,
            calendarWeeks: true,
            autoclose: true,
            format: 'dd/mm/yyyy',
            startDate: mindate,
            //endDate: '<?php echo $this->session->userdata('lock_end_date'); ?>'
        });
        $('.i-checks').iCheck({
            checkboxClass: 'icheckbox_square-green',
            radioClass: 'iradio_square-green',
        });

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
            var ops_url = baseurl + 'transport/save-update-pickuppoint-fees';
            var pickuppointId = $('#pickuppointId').val();
            var fee_amt = $('#fee_amt').val();
            var fee_amt_2 = $('#fee_amt_2').val();


            if (pickuppointId == '') {
                swal('', 'Pickuppoint  is required.', 'info');
                $('#faculty_loader').removeClass('sk-loading');
                return false;
            }
            var dec_numbers = /[0-9]+?$/; // /^[0-9]+(\.[0-9]+)?$/;
            if (fee_amt == '') {
                swal('', 'One Side Fees  is required.', 'info');
                $('#faculty_loader').removeClass('sk-loading');
                return false;
            } else if (fee_amt < 0) {
                swal('', 'One side Fees Amount should not be less than zero.', 'info');
                $('#faculty_loader').removeClass('sk-loading');
                return false;
            } else if (!dec_numbers.test(fee_amt)) {
                swal('', 'One Side Fee  can have only numbers.', 'info');
                $('#faculty_loader').removeClass('sk-loading');
                return false;
            }
            if (fee_amt_2 == '') {
                swal('', 'Two Side Fees is required.', 'info');
                $('#faculty_loader').removeClass('sk-loading');
                return false;
            } else if (!dec_numbers.test(fee_amt_2)) {
                swal('', 'Two Side Fees can have only numbers.', 'info');
                $('#faculty_loader').removeClass('sk-loading');
                return false;
            }

            if (parseFloat(fee_amt_2) <= parseFloat(fee_amt)) {
                swal('', 'Two Side Fees should be greater than One Side Fees.', 'info');
                $('#faculty_loader').removeClass('sk-loading');
                return false;
            }
            var startdate = moment($("#StartDate").val(), "DD/MM/YYYY").format('YYYY-MM-DD');


            $('#startdate_formatted').val(startdate);

            if (startdate == 'Invalid date') {
                swal('', 'With effect from is required.', 'info');
                $('#faculty_loader').removeClass('sk-loading');
                return false;
            }

            if (!$('#check1').is(':checked')) {
                swal('', 'Please tick all the checkboxes.', 'info');
                $('#faculty_loader').removeClass('sk-loading');
                return false;
            }
            if (!$('#check2').is(':checked')) {
                swal('', 'Please tick all the checkboxes.', 'info');
                $('#faculty_loader').removeClass('sk-loading');
                return false;
            }

            $.ajax({
                type: "POST",
                cache: false,
                async: false,
                url: ops_url,
                data: $('#pickuppoint_fees_edit_save').serialize(),
                success: function(result) {
                    var data = $.parseJSON(result);
                    if (data.status == 1) {
                        load_pickupoint_fees();
                        swal('Success', 'Pickup Point Fees  Updated Successfully.', 'success');
                        $('#faculty_loader').removeClass('sk-loading');
                        $("#curd-content").slideUp("slow", function() {
                            $("#curd-content").hide();
                            $('#add_type').show();
                        });
                    } else if (data.status == 2) {
                        // $('#curd-content').html('');
                        // $('#curd-content').html(data.view);
                        swal('', data.message, 'info');
                        $('#faculty_loader').removeClass('sk-loading');
                    } else if (data.status == 3) {
                        // $('#curd-content').html('');
                        // $('#curd-content').html(data.view);
                        swal('', data.message, 'info');
                        $('#faculty_loader').removeClass('sk-loading');
                    } else if (data.status == 4) {
                        // $('#curd-content').html('');
                        // $('#curd-content').html(data.view);
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