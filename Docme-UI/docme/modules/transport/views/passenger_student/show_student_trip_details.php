<style>
    .pickup,
    .drop,
    .pickdrop {
        display: none;
    }
</style>
<?php
$droponly_style = $droponly_checked = $pickonly_style = $pickonly_checked = $pick_drop_style = $same_pick_drop_checked = $pick_drop_checked = $inactive_checked = '';
$deallocation_style = '';
$last_fee_paid_date = '01-2000'; // for setting a default date payment used in js
$last_fee_paid_fdate = '31-01-2000'; // for setting a default date payment used in PHP
if (isset($travel_data)) {
    $transaction_type = "Enable"; //PPEDIT
    if (
        $travel_data['dropStopId'] == $travel_data['pickStopId']
        && $travel_data['pickTripId'] == $travel_data['dropTripId']
        && $travel_data['dropStopId'] != 0
    ) {
        $pick_drop_style = "display:block";
        $same_pick_drop_checked = 'checked';
        $start_date = date('d-m-Y', strtotime($travel_data['transportStartDate']));
    } else {
        if ($travel_data['pickStopId'] == '' && $travel_data['dropStopId'] != 0) {
            $droponly_style = "display:block";
            $droponly_checked = 'checked';
            $start_date = date('d-m-Y', strtotime($travel_data['transportStartDate']));
        }
        if ($travel_data['dropStopId'] == '' && $travel_data['pickStopId'] != 0) {
            $pickonly_style = "display:block";
            $pickonly_checked = 'checked';
            $start_date = date('d-m-Y', strtotime($travel_data['transportStartDate']));
        }
        if ($travel_data['pickStopId'] == 0 && $travel_data['dropStopId'] == 0) {
            $inactive_checked = 'checked';
            if (strtotime(date('d-m-Y')) > strtotime($this->session->userdata('lock_start_date')))
                $start_date = date('d-m-Y');  //Will be assigning a new date after checking the last payment date , condition is at the end of html code
            else
                $start_date = $this->session->userdata('lock_start_date');
        }
    }
    if (
        $travel_data['dropStopId'] != '' && $travel_data['dropStopId'] != 0
        && $travel_data['pickStopId'] != '' && $travel_data['pickStopId'] != 0
        &&  $pick_drop_style == ''
    ) {
        $droponly_style = "display:block";
        $pickonly_style = "display:block";
        $pick_drop_checked = 'checked';
        $start_date = date('d-m-Y', strtotime($travel_data['transportStartDate']));
    }

    $pp_id = $travel_data['pickTripId'];
} else {
    $pickonly_checked = 'checked';
    $pickonly_style = "display:block";
    $deallocation_style = "display:none";
    $transaction_type = "Enable";
    $start_date = $this->session->userdata('lock_start_date');
    $pp_id = 0;
}

?>

<div class="wrapper wrapper-content animated fadeInRight" style="padding-top: 1px !important;padding-left: 0px !important;padding-right: 0px !important;">
    <div class="row" style="margin-left: -29px !important; margin-right: -30px !important;">
        <div class="col-lg-12" style="z-index: 9999;">
            <div class="ibox float-e-margins">
                <div class="ibox-title" style="border-bottom-color:#23C6C8!important">
                    <h5 style="color: #1c84c6;"><?php echo isset($sub_title) ? $sub_title : "NO TITLE PROVIDED" ?></h5>
                    <div class="ibox-tools" id="add_type">
                        <a href="javascript:void(0)" onclick="list_student_allocation(1,<?php echo $pp_id  ?>);" class="btn btn btn-sm" data-toggle="tooltip" data-placement="top" title="Go to previous page"><i class="fa fa-reply"></i> Back</a>
                        <?php if (($student_data['Cur_Batch'] != '' || $student_data['Cur_Batch'] != NULL) && $student_data['Cur_AcadYr'] == $this->session->userdata('acd_year')) { ?>
                            <a data-toggle="modal" class="btn btn-primary btn-xs" data-toggle="tooltip" title="Save" data-placement="left" href="javascript:void(0)" onclick="return save_student_trip_allotment();"><i class="fa fa-save"></i>Save</a>
                        <?php } ?>
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
                    <div class="wrapper wrapper-content animated fadeInRight" id="student-data-container">

                        <?php
                        echo form_open('', array('id' => 'student_trip_allocation', 'role' => 'form'));
                        ?>
                        <div class="row">
                            <div class="col-md-6">
                                <div id="like_button_container"></div>
                                <?php
                                $profile_image = "";
                                if (!empty(get_student_image($student_data['student_id']))) {
                                    $profile_image = get_student_image($student_data['student_id']);
                                } else
                                if (isset($student['profile_image']) && !empty($student_data['profile_image'])) {

                                    $profile_image = "data:image/jpeg;base64," . $student_data['profile_image'];
                                } else {
                                    if (isset($student_data['profile_image_alternate']) && !empty($student_data['profile_image_alternate'])) {
                                        $profile_image = $student_data['profile_image_alternate'];
                                    } else {
                                        $profile_image = base_url('assets/img/a0.jpg');
                                    }
                                }
                                ?>

                                <div class="profile-image">
                                    <img src="<?php echo $profile_image; ?>" class="img-circle circle-border m-b-md" alt="profile" style="margin-top: 0px;border-top-width: 0px;" />
                                </div>
                                <div class="profile-info">
                                    <input type="hidden" name="transaction_type" id="transaction_type" value="<?php echo $transaction_type ?>">
                                    <input type="hidden" name="student_id" id="student_id" value="<?php echo $student_data['student_id'] ?>">
                                    <input type="hidden" name="student_name" id="student_name" value="<?php echo $student_data['student_name'] ?>">
                                    <input type="hidden" name="transport_already_ass_date" id="transport_already_ass_date" value="<?php echo $travel_data['transportStartDate'] ?>">

                                    <div class="">
                                        <div>
                                            <h4><?php echo $student_data['student_name'] ?></h4>
                                            <small>Admission num : <?php echo $student_data['Admn_No'] ?> </small><br>
                                            <small>Batch : <?php echo $student_data['Batch_Name'] ?></small><br>
                                            <small>Class : <?php echo $student_data['Description'] ?> </small><br>
                                            <small>Current Demanded Fee :<?php echo $travel_data['demanded_fee'] == '' ? 'NA' : my_money_format($travel_data['demanded_fee']) ?> </small> </small><br>
                                            <small>With Effect From : <?php echo  $travel_data['transportStartDate'] == '' ? 'NA' : date('d-m-Y', strtotime($travel_data['transportStartDate'])) ?> </small> </small>
                                        </div>
                                    </div>
                                </div>
                            </div><br>
                            <div class="col-md-3">
                                <div class="widget yellow-bg" style="margin-top:0px;">
                                    <div class="">
                                        <h3 class="m-xs" style="text-align:center">Pickup</h1><br />
                                            <i class="fa fa-map-marker"></i> <?php echo isset($travel_data['pickup_pickpointName']) ? $travel_data['pickup_pickpointName'] : 'N/A'; ?><br>
                                            <i class="fa fa-clock-o"></i> <?php echo isset($travel_data['pickuptime']) ? $travel_data['pickuptime'] : 'N/A'; ?><br>
                                            <i class="fa fa-car"></i> <?php echo isset($travel_data['pickup_tripName']) ? $travel_data['pickup_tripName'] : 'N/A'; ?>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="widget lazur-bg" style="margin-top:0px;">
                                    <div class="">
                                        <h3 class="m-xs" style="text-align:center">Drop</h1><br />
                                            <i class="fa fa-map-marker"></i> <?php echo isset($travel_data['drop_pickupName']) ? $travel_data['drop_pickupName'] : 'N/A'; ?><br>
                                            <i class="fa fa-clock-o"></i> <?php echo isset($travel_data['droptime']) ? $travel_data['droptime'] : 'N/A'; ?><br>
                                            <i class="fa fa-car"></i> <?php echo isset($travel_data['drop_tripName']) ? $travel_data['drop_tripName'] : 'N/A'; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php if (($student_data['Cur_Batch'] != '' || $student_data['Cur_Batch'] != NULL) && $student_data['Cur_AcadYr'] == $this->session->userdata('acd_year')) { ?>


                            <div class="row">

                                <div class="col-sm-12">
                                    <b>Choose Travel Type</b><br /><br />
                                    <div class="form-group">
                                        <div style="height: 50px;" class="col-sm-2 i-checks"><label> <input type="radio" <?php echo $pickonly_checked ?> class="transport_type" value="1" name="transport_type"> Only Pickup </label></div>
                                        <div style="height: 50px;" class="col-sm-2 i-checks"><label> <input type="radio" <?php echo $droponly_checked ?> class="transport_type" value="2" name="transport_type"> Only Drop </label></div>
                                        <div style="height: 50px;" class="col-sm-3 i-checks"><label> <input type="radio" <?php echo $pick_drop_checked ?> class="transport_type" value="3" name="transport_type"> Pickup and Drop </label></div>
                                        <div style="height: 50px;" class="col-sm-3 i-checks"><label> <input type="radio" <?php echo $same_pick_drop_checked ?> class="transport_type" value="4" name="transport_type"> Same Pickup and Drop </label></div>
                                        <div style="height: 50px;<?php echo $deallocation_style ?>" class="col-sm-2 i-checks"><label> <input type="radio" <?php echo $inactive_checked ?> class="transport_type" value="5" name="transport_type"> Deallocate </label></div>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <b>With Effect From</b>
                                    <div class="form-group">
                                        <div class="form-line <?php
                                                                if (form_error('transport_start_date')) {
                                                                    echo 'has-error';
                                                                }
                                                                ?> ">
                                            <input type="text" class="form-control is-datepicker" id="transport_start_date" value="" readonly style="background-color: #fff;" />
                                            <!--<php echo $travel_data['transportStartDate'] == '' ? '' : date('d/m/Y', strtotime($travel_data['transportStartDate'])) ?>-->
                                            <input type="hidden" name="transport_start_date" id="with_effec_from_formated" />
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-4 pickup" style="<?php echo $pickonly_style ?>">
                                    <div class="ibox float-e-margins">
                                        <div class="ibox-title">
                                            <h5>Pickup</h5>
                                        </div>
                                        <div class="ibox-content">
                                            <div class="form-group ">
                                                <label>Pickup Point</label><span class="mandatory"> *</span><br>
                                                <select name="pickStopId" id="pickStopId" class="form-control pickpoints" style="width:100%;">
                                                    <option value="-1">Select</option>
                                                    <?php foreach ($all_pickpoints as $data) {
                                                        if ($travel_data['pickStopId'] == $data['id']) {
                                                            $selected = 'selected';
                                                        } else {
                                                            $selected = '';
                                                        }
                                                    ?>
                                                        <option <?php echo $selected ?> value="<?php echo $data['id'] ?>"><?php echo $data['pickpointName'] ?></option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                            <div class="form-group ">
                                                <label>Trip</label><span class="mandatory"> *</span><br>

                                                <select name="pickTripId" id="pickTripId" class="form-control trips" style="width:100%;">
                                                    <option selected="" value="-1">Select</option>
                                                    <?php if (isset($travel_data['pickTripId']) && $travel_data['pickTripId'] != 0) { ?>
                                                        <option selected value="<?php echo $travel_data['pickTripId'] ?>"><?php echo $travel_data['pickup_tripName'] ?></option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4 drop" style="<?php echo $droponly_style ?>">
                                    <div class="ibox float-e-margins">
                                        <div class="ibox-title">
                                            <h5>Drop</h5>
                                        </div>
                                        <div class="ibox-content">
                                            <div class="form-group ">
                                                <label>Drop Point</label><span class="mandatory"> *</span><br>

                                                <select name="dropStopId" id="dropStopId" class="form-control droppoint" style="width:100%;">
                                                    <option value="-1">Select</option>
                                                    <?php foreach ($all_pickpoints as $data) {
                                                        if ($travel_data['dropStopId'] == $data['id']) {
                                                            $selected = 'selected';
                                                        } else {
                                                            $selected = '';
                                                        }
                                                    ?>
                                                        <option <?php echo $selected ?> value="<?php echo $data['id'] ?>"><?php echo $data['pickpointName'] ?></option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                            <div class="form-group ">
                                                <label>Trip</label><span class="mandatory"> *</span><br>

                                                <select name="dropTripId" id="dropTripId" class="form-control droptrips" style="width:100%;">
                                                    <option selected="" value="-1">Select</option>
                                                    <?php if (isset($travel_data['dropTripId']) && $travel_data['dropTripId'] != 0) { ?>
                                                        <option selected value="<?php echo $travel_data['dropTripId'] ?>"><?php echo $travel_data['drop_tripName'] ?></option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4 pickdrop" style="<?php echo $pick_drop_style ?>">
                                    <div class="ibox float-e-margins">
                                        <div class="ibox-title">
                                            <h5>Pickup & Drop</h5>
                                        </div>
                                        <div class="ibox-content">
                                            <div class="form-group ">
                                                <label>Pick & Drop Point</label><span class="mandatory"> *</span><br>
                                                <select name="pickdropStopId" id="pickdropSmaintainlisttopId" class="form-control pickdroppoints" style="width:100%;">
                                                    <option value="-1">Select</option>
                                                    <?php foreach ($all_pickpoints as $data) {
                                                        if ($travel_data['dropStopId'] == $data['id']) {
                                                            $selected = 'selected';
                                                        } else {
                                                            $selected = '';
                                                        }
                                                    ?>
                                                        <option <?php echo $selected ?> value="<?php echo $data['id'] ?>"><?php echo $data['pickpointName'] ?></option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                            <div class="form-group ">
                                                <label>Trip</label><span class="mandatory"> *</span><br>
                                                <select name="pickdropTripId" id="pickdropTripId" class="form-control pickdroptrips" style="width:100%;">
                                                    <option selected="" value="-1">Select</option>
                                                    <?php if (isset($travel_data['dropTripId']) && $travel_data['dropTripId'] != 0) { ?>
                                                        <option selected value="<?php echo $travel_data['dropTripId'] ?>"><?php echo $travel_data['drop_tripName'] ?></option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php echo form_close(); ?>

                    </div>
                    <div class="row">
                        <div class="col-md-12">

                            <b>Demanded Fee Details</b><br /><br />
                            <table class="table table-striped table-bordered table-hover dataTables-example" id="tbl_trip">

                                <thead>
                                    <tr>
                                        <th style="text-align:center">Demanded Month</th>
                                        <th style="text-align:center">Amount</th>
                                        <th style="text-align:center">Balance</th>
                                        <th style="text-align:center">Payment Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    if (isset($fee_details) && !empty($fee_details) && is_array($fee_details)) {
                                        $display_checkbox = "";
                                        $checked = "";
                                        foreach ($fee_details as $data) {
                                            if ($data['balance'] != $data['dem_amount']) {
                                                $last_fee_paid_date = date('m-Y', strtotime(str_replace('/', '-', $data['dem_date'])));
                                                $last_fee_paid_fdate = date('t-m-Y', strtotime(str_replace('/', '-', $data['dem_date'])));
                                            }

                                            if ($data['status'] == 'A') { ?>
                                                <tr>

                                                    <td style="text-align:center">

                                                        <?php
                                                        //$date_data = explode('/', $data['dem_date']);
                                                        echo date('M Y', strtotime($data['dem_date'])); //$date_data[1] . '-', $date_data[2] 
                                                        ?>
                                                    </td>
                                                    <td style="text-align:right"> <?php echo my_money_format($data['dem_amount']) ?></td>
                                                    <td style="text-align:right"> <?php echo my_money_format($data['balance']) ?></td>
                                                    <td style="text-align:center"> <?php echo $data['balance'] == $data['dem_amount'] ? 'Not Paid' : ($data['balance'] == 0 ? 'Fully Paid' : 'Partially Paid') ?></td>
                                                </tr>
                                            <?php } ?>

                                        <?php
                                        }
                                    } else {
                                        $display_checkbox = "style=display:none";
                                        $checked = "checked" ?>
                                        <tr>
                                            <td colspan=7 style="text-align:center">No Fee Demanded </td>
                                        <?php }
                                        ?>
                                </tbody>
                            </table>
                            <input type="hidden" name="last_payment_date" id="last_payment_date" value="<?php echo $last_fee_paid_date ?>">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <b>Travel History</b><br /><br />
                            <table class="table table-striped table-bordered table-hover dataTables-example" id="tbl_trip">

                                <thead>
                                    <tr>
                                        <th style="text-align:center">Pickup Point</th>
                                        <th style="text-align:center">Pickup Trip</th>
                                        <th style="text-align:center">Drop Point</th>
                                        <th style="text-align:center">Drop Trip</th>
                                        <th style="text-align:center">Start Date</th>
                                        <th style="text-align:center">End/Deallocation <br /> Date</th>
                                        <!-- <th style="text-align:center">Demanded Fees</th> -->
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    if (isset($travel_history) && !empty($travel_history) && is_array($travel_history)) {
                                        $display_checkbox = "";
                                        $checked = "";
                                        foreach ($travel_history as $data) {
                                            if ($data['pickStopId'] == 0 && $data['dropStopId'] == 0) { ?>
                                                <tr>
                                                    <td colspan=4 style="text-align:center"> Deallocated</td>
                                                    <td> <?php echo date('d/m/Y', strtotime($data['transportStartDate']))  ?></td>
                                                    <td> <?php echo date('d/m/Y', strtotime($data['transportEndDate']))  ?></td>
                                                    <!-- <td> NA<?php echo $data['id'] ?></td> -->
                                                </tr>
                                            <?php } else { ?>
                                                <tr>
                                                    <td> <?php echo $data['pickup_pickpointName'] == '' || $data['pickup_pickpointName'] == NULL ? '--' : $data['pickup_pickpointName']; ?></td>
                                                    <td> <?php echo $data['pickup_tripName'] == '' || $data['pickup_tripName'] == NULL ? '--' : $data['pickup_tripName']; ?></td>
                                                    <td> <?php echo $data['drop_pickupName'] == '' || $data['drop_pickupName'] == NULL ? '--' : $data['drop_pickupName']; ?></td>
                                                    <td> <?php echo $data['drop_tripName'] == '' || $data['drop_tripName'] == NULL ? '--' : $data['drop_tripName']; ?></td>
                                                    <td> <?php echo date('d/m/Y', strtotime($data['transportStartDate']))  ?></td>
                                                    <td> <?php echo date('d/m/Y', strtotime($data['transportEndDate']))  ?></td>
                                                </tr>
                                            <?php }
                                            ?>

                                        <?php
                                        }
                                    } else {
                                        $display_checkbox = "style=display:none";
                                        $checked = "checked" ?>
                                        <tr>
                                            <td colspan=6 style="text-align:center">No History </td>
                                        <?php }
                                        ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                <?php } else { ?>
                    <div class="row">
                        <div class="col-md-12">
                            <br />
                            <?php if ($student_data['Cur_AcadYr'] != $this->session->userdata('acd_year')) { ?>
                                <h3>Student not in Current Academic Year</h3>
                            <?php } else { ?>
                                <h3>No Batch Allocated,Allocate batch for allocating the transport.</h3>
                                <br /> <?php } ?>
                        </div>
                    </div>
                <?php } ?>
                </div>

                <?php //dev_export($fee_details)
                ?>
            </div>

        </div>
    </div>
</div>
<?php
if ($inactive_checked == 'checked') {
    //condition for checking the payment till date is greater than todays date. 
    //to disable the deallocation for already paid date
    if (strtotime($last_fee_paid_fdate) > strtotime(date('d-m-Y'))) {
        $start_date = date("01-m-Y", strtotime("30 DAYS", strtotime($last_fee_paid_fdate))); //used in datepickers
    }
} ?>
<script>
    $(document).ready(function() {
        $('select').select2({
            'theme': 'bootstrap'
        });
        var cur_acd_start_date = moment(moment('<?php echo  $this->session->userdata('lock_start_date') ?>', "DD-MM-YYYY").format('DD/MM/YYYY'), 'DD/MM/YYYY');
        var start_date = moment(moment('<?php echo  $start_date; ?>', "DD-MM-YYYY").format('DD/MM/YYYY'), 'DD/MM/YYYY');
        if (start_date < cur_acd_start_date) {
            start_date = moment('<?php echo  $this->session->userdata('lock_start_date') ?>', "DD-MM-YYYY").format('DD-MM-YYYY');
        } else {
            start_date = moment('<?php echo  $start_date; ?>', 'DD-MM-YYYY').format('DD-MM-YYYY');
        }
        $("#transport_start_date").blur();
        $('#transport_start_date').datepicker({
            //todayBtn: "linked",
            keyboardNavigation: false,
            forceParse: false,
            calendarWeeks: true,
            autoclose: true,
            format: 'dd/mm/yyyy',
            startDate: start_date,
            endDate: '<?php echo $this->session->userdata('lock_end_date'); ?>'
        });

        $('.i-checks').iCheck({
            checkboxClass: 'icheckbox_square-green',
            radioClass: 'iradio_square-green',
        });

        $('.transport_type').on('ifChanged', function() {
            //alert($(this).val());
            $('select').val(-1);
            $('#transport_start_date').val('');
            $('select').select2({
                'theme': 'bootstrap'
            });
            if ($(this).is(":checked") && $(this).val() == 1) {
                $('.pickup').show();
                $('.drop').hide();
                $('.pickdrop').hide();
            }
            if ($(this).is(":checked") && $(this).val() == 2) {
                $('.pickup').hide();
                $('.drop').show();
                $('.pickdrop').hide();
            }
            if ($(this).is(":checked") && $(this).val() == 3) {
                $('.pickup').show();
                $('.drop').show();
                $('.pickdrop').hide();
            }
            if ($(this).is(":checked") && $(this).val() == 4) {
                $('.pickup').hide();
                $('.drop').hide();
                $('.pickdrop').show();
            }
            if ($(this).is(":checked") && $(this).val() == 5) {
                $('.pickup').hide();
                $('.drop').hide();
                $('.pickdrop').hide();

                var last_payment_date = moment(moment($('#last_payment_date').val(), "MM-YYYY").format('01/MM/YYY'), 'DD/MM/YYYY');
                var current_date = moment(moment().format('01/MM/YYYY'), 'DD/MM/YYYY');
                if (current_date < last_payment_date) {
                    var cur_acd_start_date = moment(moment('<?php echo  $this->session->userdata('lock_start_date') ?>', "DD-MM-YYYY").format('DD/MM/YYYY'), 'DD/MM/YYYY');
                    if (last_payment_date < cur_acd_start_date)
                        var start_date = moment('<?php echo  $this->session->userdata('lock_start_date') ?>', "DD-MM-YYYY").format('DD-MM-YYYY');
                    else
                        var start_date = moment($('#last_payment_date').val(), "MM-YYYY").add(1, 'M').format('01-MM-YYYY');

                } else {
                    var cur_acd_start_date = moment(moment('<?php echo  $this->session->userdata('lock_start_date') ?>', "DD-MM-YYYY").format('DD/MM/YYYY'), 'DD/MM/YYYY');
                    var start_date = moment(moment().format('DD/MM/YYYY'), 'DD/MM/YYYY');
                    if (start_date < cur_acd_start_date) {
                        start_date = moment('<?php echo  $this->session->userdata('lock_start_date') ?>', "DD-MM-YYYY").format('DD-MM-YYYY');
                    } else {
                        start_date = moment().format('DD-MM-YYYY');
                    }

                }

                $('#transport_start_date').datepicker('remove');
                $('#transport_start_date').datepicker({
                    //todayBtn: "linked",
                    keyboardNavigation: false,
                    forceParse: false,
                    calendarWeeks: true,
                    autoclose: true,
                    format: 'dd/mm/yyyy',
                    startDate: start_date,
                    endDate: '<?php echo $this->session->userdata('lock_end_date'); ?>'
                });

            } else {
                var cur_acd_start_date = moment(moment('<?php echo  $this->session->userdata('lock_start_date') ?>', "DD-MM-YYYY").format('DD/MM/YYYY'), 'DD/MM/YYYY');
                var start_date = moment(moment('<?php echo !isset($travel_data['transportStartDate']) ? $this->session->userdata('lock_start_date') : date('d-m-Y', strtotime($travel_data['transportStartDate'])) ?>', "DD-MM-YYYY").format('DD/MM/YYYY'), 'DD/MM/YYYY');
                if (start_date < cur_acd_start_date) {
                    start_date = moment('<?php echo  $this->session->userdata('lock_start_date') ?>', "DD-MM-YYYY").format('DD-MM-YYYY');
                } else {
                    start_date = moment('<?php echo !isset($travel_data['transportStartDate']) ? $this->session->userdata('lock_start_date') : date('d-m-Y', strtotime($travel_data['transportStartDate'])) ?>', "DD-MM-YYYY").format('DD-MM-YYYY')
                }
                $('#transport_start_date').datepicker('remove');
                $('#transport_start_date').datepicker({
                    //todayBtn: "linked",
                    keyboardNavigation: false,
                    forceParse: false,
                    calendarWeeks: true,
                    autoclose: true,
                    format: 'dd/mm/yyyy',
                    startDate: start_date,
                    endDate: '<?php echo $this->session->userdata('lock_end_date'); ?>'
                });
            }
        });

        $('.pickdroppoints').change(function() {

            if ($(this).val() != -1) {
                var sel = $(this);
                var trip_sel = sel.parent().parent().find('.pickdroptrips');
                var pick_point_id = $(this).val();
                var ops_url = baseurl + 'transport/get-pickpoint-trips';

                $.ajax({
                    type: "POST",
                    cache: false,
                    async: false,
                    url: ops_url,
                    data: {
                        "load": 1,
                        "pick_point_id": pick_point_id,
                    },
                    success: function(result) {
                        var data = JSON.parse(result);
                        console.log(data);
                        trip_sel.html("<option value='-1' >Select</option>");
                        if (data.status == 1) {
                            var tripdata = data.data;
                            //trip_sel.trigger("change");
                            $.each(tripdata, function(i, v) {
                                if (tripdata.ErrorStatus != 1) {
                                    trip_sel.append("<option value='" + v.tripId + "' >" + v.tripName + "</option>");
                                }
                            });

                        } else {
                            //trip_sel.empty().trigger("change");
                        }
                        trip_sel.select2({
                            'theme': 'bootstrap'
                        });

                    }
                });
            }
        });

        $('.droppoint').change(function() {

            if ($(this).val() != -1) {
                var sel = $(this);
                var trip_sel = sel.parent().parent().find('.droptrips');
                var pick_point_id = $(this).val();
                var ops_url = baseurl + 'transport/get-pickpoint-trips';

                $.ajax({
                    type: "POST",
                    cache: false,
                    async: false,
                    url: ops_url,
                    data: {
                        "load": 1,
                        "pick_point_id": pick_point_id,
                    },
                    success: function(result) {
                        var data = JSON.parse(result);
                        console.log(data);
                        trip_sel.html("<option value='-1' >Select</option>");
                        if (data.status == 1) {
                            var tripdata = data.data;
                            //trip_sel.trigger("change");
                            $.each(tripdata, function(i, v) {
                                if (tripdata.ErrorStatus != 1) {
                                    trip_sel.append("<option value='" + v.tripId + "' >" + v.tripName + "</option>");
                                }
                            });
                            //trip_sel.trigger('change');
                        } else {
                            //trip_sel.empty().trigger("change");
                        }
                        trip_sel.select2({
                            'theme': 'bootstrap'
                        });

                    }
                });
            }
        });

        $('.pickpoints').change(function() {

            if ($(this).val() != -1) {
                var sel = $(this);
                var trip_sel = sel.parent().parent().find('.trips');
                var pick_point_id = $(this).val();
                var ops_url = baseurl + 'transport/get-pickpoint-trips';

                $.ajax({
                    type: "POST",
                    cache: false,
                    async: false,
                    url: ops_url,
                    data: {
                        "load": 1,
                        "pick_point_id": pick_point_id,
                    },
                    success: function(result) {
                        var data = JSON.parse(result);
                        console.log(data);
                        trip_sel.html("<option value='-1' >Select</option>");
                        if (data.status == 1) {
                            var tripdata = data.data;
                            //trip_sel.trigger("change");
                            $.each(tripdata, function(i, v) {
                                if (tripdata.ErrorStatus != 1) {
                                    trip_sel.append("<option value='" + v.tripId + "' >" + v.tripName + "</option>");
                                }
                            });
                            //trip_sel.trigger('change');
                        } else {
                            //trip_sel.empty().trigger("change");
                        }
                        trip_sel.select2({
                            'theme': 'bootstrap'
                        });

                    }
                });
            }
        });
    });

    function save_student_trip_allotment() {
        $('#faculty_loader').addClass('sk-loading');
        var student_id = $('#student_id').val();


        if ($("#transport_start_date").val() == '') {
            swal('', 'With effect from is required.', 'info');
            $('#faculty_loader').removeClass('sk-loading');
            return false;
        }

        var acd_start_date = moment('<?php echo  $this->session->userdata('lock_start_date') ?>', "DD-MM-YYYY");
        var acd_end_date = moment('<?php echo  $this->session->userdata('lock_end_date') ?>', "DD-MM-YYYY");
        var with_effect_from_obj = moment($('#transport_start_date').val(), "DD/MM/YYYY");
        if (with_effect_from_obj < acd_start_date) {
            swal('', 'With effect date should be greater than or equal to academic year start date.', 'info');
            $('#faculty_loader').removeClass('sk-loading');
            return false;
        }
        if (with_effect_from_obj > acd_end_date) {
            swal('', 'With effect date should be less than or equal to academic year end date.', 'info');
            $('#faculty_loader').removeClass('sk-loading');
            return false;
        }

        var last_payment_date = moment($('#last_payment_date').val(), "MM-YYYY").format('YYYYMM');
        var with_effect_month = moment($('#transport_start_date').val(), "DD/MM/YYYY").format('YYYYMM');

        var with_effect_from = moment($("#transport_start_date").val(), "DD/MM/YYYY").format('YYYY-MM-DD');

        $('#with_effec_from_formated').val(with_effect_from);

        if (with_effect_from == 'Invalid date') {
            swal('', 'Enter a valid Date.', 'info');
            $('#faculty_loader').removeClass('sk-loading');
            return false;
        }



        if ($('.pickpoints:visible').val() == -1) {
            swal('', 'Select a Pickup Point.', 'info');
            $('#faculty_loader').removeClass('sk-loading');
            return false;
        }

        if ($('.trips:visible').val() == -1) {
            swal('', 'Select a Trip.', 'info');
            $('#faculty_loader').removeClass('sk-loading');
            return false;
        }

        if ($('.droppoint:visible').val() == -1) {
            swal('', 'Select a Drop Point.', 'info');
            $('#faculty_loader').removeClass('sk-loading');
            return false;
        }

        if ($('.droptrips:visible').val() == -1) {
            swal('', 'Select a Trip.', 'info');
            $('#faculty_loader').removeClass('sk-loading');
            return false;
        }

        if ($('.transport_type').val() == '') {
            swal('', 'Choose a Trip Type.', 'info');
            //alert('hi');
            $('#faculty_loader').removeClass('sk-loading');
            return false;
        }

        if ($('.pickdroppoints:visible').val() == -1) {
            swal('', 'Select a Pick & Drop Point.', 'info');
            $('#faculty_loader').removeClass('sk-loading');
            return false;
        }

        if ($('.pickdroptrips:visible').val() == -1) {
            swal('', 'Select a Trip.', 'info');
            $('#faculty_loader').removeClass('sk-loading');
            return false;
        }

        if ($('.transport_type:checked').val() == 5) {
            $('#faculty_loader').removeClass('sk-loading');
            swal({
                    title: '',
                    text: "Are you sure you want to deallocate the transport for the student from " + $("#transport_start_date").val() + " ?",
                    type: "warning",
                    showCancelButton: true,
                    closeOnConfirm: false,
                    closeOnCancel: true
                },
                function(isConfirm) {
                    if (isConfirm) {
                        var last_payment_date = moment($('#last_payment_date').val(), "MM-YYYY").format('YYYYMM');
                        var with_effect_month = moment($('#transport_start_date').val(), "DD/MM/YYYY").format('YYYYMM');
                        if (with_effect_month <= last_payment_date) {
                            swal({
                                    title: '',
                                    text: "Fees already paid , Adjustments in fees only done as payback if new fees is less than the paid fees.",
                                    type: "warning",
                                    showCancelButton: true,
                                    closeOnConfirm: false,
                                    closeOnCancel: true
                                },
                                function(isConfirm2) {
                                    if (isConfirm2) {
                                        ajax_function();

                                    } else {
                                        return false;
                                    }
                                });
                            return false;

                        } else {
                            ajax_function();
                        }

                    } else {
                        return false;
                    }
                });
            return false;
        }

        if (with_effect_month <= last_payment_date) {
            $('#faculty_loader').removeClass('sk-loading');
            swal({
                    title: '',
                    text: "Fees already paid , Adjustments in fees only done as payback if new fees is less than the paid fees.",
                    type: "warning",
                    showCancelButton: true,
                    closeOnConfirm: false,
                    closeOnCancel: true
                },
                function(isConfirm) {
                    if (isConfirm) {
                        ajax_function();

                    } else {
                        return false;
                    }
                });
            return false;

        } else {
            ajax_function();
        }


    }

    function ajax_function() {
        var ops_url = baseurl + 'transport/save-trip-allotment';
        $.ajax({
            type: "POST",
            cache: false,
            async: true,
            url: ops_url,
            data: $('#student_trip_allocation').serialize(),
            success: function(result) {
                var data = JSON.parse(result);
                if (data.status == 1) {
                    //load_trip_form();
                    if ($('.transport_type:checked').val() == 5) {
                        swal('Success', 'Transport Deallocated Successfully.', 'success');
                    } else {
                        swal('Success', 'Transport Allocated Successfully.', 'success');
                    }

                    $('#faculty_loader').removeClass('sk-loading');
                    $('#data-view').html(data.view);

                } else if (data.status == 2) {
                    $('#data-view').html(data.view);
                    swal('', data.message, 'info');
                    $('#faculty_loader').removeClass('sk-loading');
                } else if (data.status == 3) {
                    $('#data-view').html(data.view);
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