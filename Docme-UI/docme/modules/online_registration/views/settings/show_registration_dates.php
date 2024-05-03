<div class="wrapper wrapper-content animated fadeInRight" style="padding-top: 1px !important;padding-left: 0px !important;padding-right: 0px !important;">
    <div class="row" style="margin-left: -29px !important; margin-right: -30px !important;">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title" style="border-bottom-color:#23C6C8!important">
                    <h5 style="color: #1c84c6;"><?php echo isset($sub_title) ? $sub_title : "NO TITLE PROVIDED" ?></h5>
                    <!-- <div class="ibox-tools" id="add_type">
                        <a data-toggle="modal" class="btn btn-primary btn-xs" data-toggle="tooltip" title="Add a New Pickup Point" data-placement="left" href="javascript:void(0)" onclick="add_new_pickuppoint();">ADD NEW Pickup POINT</a>
                    </div> -->
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
                            <div class="col-lg-12">
                                <div id="curd-content" style="display: none;"></div>
                            </div>
                            <div class="col-lg-12">
                                <table id="registration_fees_tbl" class="table table-striped table-bordered table-hover dataTables-example">
                                    <thead>
                                        <tr>
                                            <th>Class</th>
                                            <th>Opening Date</th>
                                            <th>Closing Date</th>
                                            <th>Status</th>
                                            <th>Task</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $breaker = 0;
                                        if (isset($reg_date_data) && !empty($reg_date_data)) {
                                            foreach ($reg_date_data as $data) {
                                        ?>
                                                <tr>
                                                    <td><?php echo $data['class_name']; ?></td>
                                                    <td>
                                                        <div class="view_div class_div_<?php echo $data['class_id'] ?>">
                                                            <?php echo $data['opening_date'] == "" ? "Not Set" : date('d-m-Y', strtotime($data['opening_date'])); ?>
                                                        </div>
                                                        <div class="update_div class_update_div_<?php echo $data['class_id'] ?>" style="display:none">
                                                            <input id="registration_odate_<?php echo $data['class_id'] ?>" type="text" value="<?php echo  $data['opening_date'] == "" ? "" : date('d-m-Y', strtotime($data['opening_date'])); ?>" placeholder="Opening Date" class="form-control registration-date nofocusitem" readonly style="background-color: #fff;">
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="view_div class_div_<?php echo $data['class_id'] ?>">
                                                            <?php echo $data['closing_date'] == "" ? "Not Set" : date('d-m-Y', strtotime($data['closing_date'])); ?>
                                                        </div>
                                                        <div class="update_div class_update_div_<?php echo $data['class_id'] ?>" style="display:none">
                                                            <input id="registration_cdate_<?php echo $data['class_id'] ?>" type="text" value="<?php echo  $data['closing_date'] == "" ? "" : date('d-m-Y', strtotime($data['closing_date'])); ?>" placeholder="Closing Date" class="form-control registration-date nofocusitem" readonly style="background-color: #fff;">
                                                        </div>
                                                    </td>
                                                    <td data-toggle="tooltip" title="Click for Enable/Disable">
                                                        <div class="switch">
                                                            <div class="onoffswitch">
                                                                <?php if ($data['isactive'] == 1) { ?>
                                                                    <input type="checkbox" checked class="onoffswitch-checkbox " data-classid="<?php echo $data['class_id']; ?>" id="classid_<?php echo $data['class_id']; ?>" onchange="change_status(<?php echo $data['class_id']; ?>,this,'<?php echo $data['class_name']; ?>')">
                                                                    <label class="onoffswitch-label" for="classid_<?php echo $data['class_id']; ?>">
                                                                        <span class="onoffswitch-inner"></span>
                                                                        <span class="onoffswitch-switch"></span>
                                                                    </label>
                                                                <?php
                                                                } else { ?>
                                                                    <input type="checkbox" class="onoffswitch-checkbox " data-classid="<?php echo $data['class_id']; ?>" id="classid_<?php echo $data['class_id']; ?>" onchange="change_status(<?php echo $data['class_id']; ?>,this,'<?php echo $data['class_name']; ?>')">
                                                                    <label class="onoffswitch-label" for="classid_<?php echo $data['class_id']; ?>">
                                                                        <span class="onoffswitch-inner"></span>
                                                                        <span class="onoffswitch-switch"></span>
                                                                    </label>
                                                                <?php
                                                                } ?>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="view_div class_div_<?php echo $data['class_id'] ?>">
                                                            <a class="btn btn-xs btn-info" href="javascript:void(0);" onclick="update_registration_dates('<?php echo $data['class_id']; ?>', '<?php echo $data['class_name']; ?>');" data-toggle="tooltip" data-placement="right" title="Update <?php echo $data['class_name']; ?>-Registration Dates" data-original-title="<?php echo $data['class_name']; ?>"> <i class="fa fa-edit"></i> Update</a>
                                                        </div>
                                                        <div class="update_div class_update_div_<?php echo $data['class_id'] ?>" style="display:none">
                                                            <a class="btn btn-xs btn-primary" href="javascript:void(0);" onclick="save_registration_dates('<?php echo $data['class_id']; ?>', '<?php echo $data['class_name']; ?>');" data-toggle="tooltip" data-placement="right" title="Save <?php echo $data['class_name']; ?>-Registration Dates" data-original-title="<?php echo $data['class_name']; ?>"> <i class="fa fa-edit"></i> Save</a>
                                                            <a style="display:block" href="javascript:void(0);" onclick="discard_update();" data-toggle="tooltip" data-placement="right" title="Discard"> <i class="fa fa-close"></i> Discard</a>
                                                        </div>


                                                    </td>
                                                </tr>
                                        <?php

                                            }
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<script type="text/javascript">
    $('.registration-date').datepicker({
        format: 'dd-mm-yyyy',
        //startDate: '<?php echo date('d-m-Y', strtotime($this->session->userdata('acd_year_start'))) ?>',
        endDate: '<?php echo date('d-m-Y', strtotime($this->session->userdata('acd_year_end'))) ?>',
        autoclose: true,
    });

    var table = $('#registration_fees_tbl').dataTable({
        // columnDefs: [{
        //     "width": "100%",
        //     "targets": 0
        // }, ],
        responsive: false,
        iDisplayLength: 50,
        "ordering": false,
        dom: '<"html5buttons"B>lTfgitp',
        buttons: [{
                extend: 'copy'
            },
            {
                extend: 'csv',
                exportOptions: {
                    columns: [0, 1, 2, 3]
                }
            },
            {
                extend: 'excel',
                title: 'Report',
                exportOptions: {
                    columns: [0, 1, 2, 3]
                }
            }
        ],
    });



    function update_registration_dates(class_id, Description) {
        $(".view_div").fadeIn();
        $(".update_div").hide();
        $(".class_div_" + class_id).hide();
        $(".class_update_div_" + class_id).fadeIn();
    }

    function discard_update() {
        $(".view_div").fadeIn();
        $(".update_div").hide();
    }

    function save_registration_dates(class_id, Description) {
        var title_data = $('#title_data').val();
        var registration_open = $('#registration_odate_' + class_id).val();
        var registration_close = $('#registration_cdate_' + class_id).val();

        if (moment(registration_open, 'DD-MM-YYYY') == 'Invalid date' || moment(registration_close, 'DD-MM-YYYY') == 'Invalid date') {
            swal('', 'Enter valid Dates.', 'info');
            $('#faculty_loader').removeClass('sk-loading');
            return false;
        }

        if (moment(registration_open, 'DD-MM-YYYY') >= moment(registration_close, 'DD-MM-YYYY')) {
            swal('', 'Registration Close Date should be greater than Registration Open Date.', 'info');
            $('#faculty_loader').removeClass('sk-loading');
            return false;
        }

        var registration_open_formatted = moment(registration_open, 'DD-MM-YYYY').format('YYYY-MM-DD');
        var registration_close_formatted = moment(registration_close, 'DD-MM-YYYY').format('YYYY-MM-DD');


        var ops_url = baseurl + 'registration/save-registration-date/';
        $.ajax({
            type: "POST",
            cache: false,
            async: false,
            url: ops_url,
            data: {
                "load": 1,
                "class_id": class_id,
                "registration_open": registration_open_formatted,
                "registration_close": registration_close_formatted,
                "flag": 1
            },
            success: function(result) {
                var data = JSON.parse(result);
                if (data.status == 1) {
                    swal('', 'Updated registration dates for ' + Description, 'success');
                    load_registration_dates();
                } else {
                    swal('', 'Updation failed,Please try again', 'info');
                    load_registration_dates();
                    return false;
                }
            }
        });
    }

    function change_status(class_id, element, Description) {
        $('#faculty_loader').addClass('sk-loading');

        var status_type = $(element).prop("checked");
        if (status_type == true)
            status = 1;
        else
            status = 0;
        var ops_url = baseurl + 'registration/save-registration-date/';
        $.ajax({
            type: "POST",
            cache: false,
            async: false,
            url: ops_url,
            data: {
                "load": 1,
                "class_id": class_id,
                "status": status,
                "flag": 2
            },
            success: function(result) {
                var data = JSON.parse(result);
                if (data.status == 1) {
                    if (status == 1)
                        swal('', 'Activated registration dates for ' + Description, 'success');
                    else
                        swal('', 'Deactivated registration dates for ' + Description, 'success');
                    load_registration_dates();
                } else {
                    swal('', 'Updation failed,Please try again', 'info');
                    load_registration_dates();
                    return false;

                }
            }
        });
    }
</script>