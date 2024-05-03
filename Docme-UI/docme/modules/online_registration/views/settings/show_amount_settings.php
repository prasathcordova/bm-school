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
                                            <th>Foreign Registration Fee</th>
                                            <th>Registration Fee</th>
                                            <!-- <th>Status</th> -->
                                            <th>Task</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $breaker = 0;
                                        if (isset($class_fee_data) && !empty($class_fee_data)) {
                                            foreach ($class_fee_data as $data) {
                                        ?>
                                                <tr>
                                                    <td><?php echo $data['Description']; ?></td>
                                                    <td style="text-align:right">
                                                        <div class="view_div class_div_<?php echo $data['class_id'] ?>">
                                                            <?php echo CURRENCY ?> <?php echo $data['foreign_registration_fees'] == "" ? "0.00" : my_money_format($data['foreign_registration_fees']); ?>
                                                        </div>
                                                        <div class="update_div class_update_div_<?php echo $data['class_id'] ?>" style="display:none">
                                                            <input maxlength="7" id="foreign_registration_fees_<?php echo $data['class_id'] ?>" type="text" style="text-align:right" value="<?php echo $data['foreign_registration_fees'] == "" ? "0.00" : $data['foreign_registration_fees'] ?>" placeholder="Foreign Registration Fees" class="form-control numeric">
                                                        </div>
                                                    </td>
                                                    <td style="text-align:right">
                                                        <div class="view_div class_div_<?php echo $data['class_id'] ?>">
                                                            <?php echo CURRENCY ?> <?php echo $data['registration_fees'] == "" ? "0.00" : my_money_format($data['registration_fees']); ?>
                                                        </div>
                                                        <div class="update_div class_update_div_<?php echo $data['class_id'] ?>" style="display:none">
                                                            <input maxlength="7" id="registration_fees_<?php echo $data['class_id'] ?>" type="text" style="text-align:right" value="<?php echo $data['registration_fees'] == "" ? "0.00" : $data['registration_fees'] ?>" placeholder="Registration Fees" class="form-control numeric">
                                                        </div>
                                                    </td>
                                                    <!-- <td data-toggle="tooltip" title="Click for Enable/Disable">
                                                        <div class="switch">
                                                            <div class="onoffswitch">
                                                                <?php if ($data['isactive'] == 1) { ?>
                                                                    <input type="checkbox" checked class="onoffswitch-checkbox fee_status" data-classid="<?php echo $data['class_id']; ?>" id="classid_<?php echo $data['class_id']; ?>">
                                                                    <label class="onoffswitch-label" for="classid_<?php echo $data['class_id']; ?>">
                                                                        <span class="onoffswitch-inner"></span>
                                                                        <span class="onoffswitch-switch"></span>
                                                                    </label>
                                                                <?php
                                                                } else { ?>
                                                                    <input type="checkbox" class="onoffswitch-checkbox fee_status" data-classid="<?php echo $data['class_id']; ?>" id="classid_<?php echo $data['class_id']; ?>">
                                                                    <label class="onoffswitch-label" for="classid_<?php echo $data['class_id']; ?>">
                                                                        <span class="onoffswitch-inner"></span>
                                                                        <span class="onoffswitch-switch"></span>
                                                                    </label>
                                                                <?php
                                                                } ?>
                                                            </div>
                                                        </div>
                                                    </td> -->
                                                    <td>
                                                        <div class="view_div class_div_<?php echo $data['class_id'] ?>">
                                                            <a class="btn btn-xs btn-info" href="javascript:void(0);" onclick="update_registration_fees('<?php echo $data['class_id']; ?>', '<?php echo $data['Description']; ?>');" data-toggle="tooltip" data-placement="right" title="Update <?php echo $data['Description']; ?>-Fees" data-original-title="<?php echo $data['Description']; ?>"> <i class="fa fa-edit"></i> Update</a>
                                                        </div>
                                                        <div class="update_div class_update_div_<?php echo $data['class_id'] ?>" style="display:none">
                                                            <a class="btn btn-xs btn-primary" href="javascript:void(0);" onclick="save_registration_fees('<?php echo $data['class_id']; ?>', '<?php echo $data['Description']; ?>');" data-toggle="tooltip" data-placement="right" title="Save <?php echo $data['Description']; ?>-Fees" data-original-title="<?php echo $data['Description']; ?>"> <i class="fa fa-edit"></i> Save</a>
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



    function update_registration_fees(class_id, Description) {
        $(".view_div").fadeIn();
        $(".update_div").hide();
        $(".class_div_" + class_id).hide();
        $(".class_update_div_" + class_id).fadeIn();
    }

    function discard_update() {
        $(".view_div").fadeIn();
        $(".update_div").hide();
    }

    function save_registration_fees(class_id, Description) {
        var title_data = $('#title_data').val();
        var registration_fees = $('#registration_fees_' + class_id).val();
        var foreign_registration_fees = $('#foreign_registration_fees_' + class_id).val();

        var dec_numbers = /^[0-9]+(\.[0-9]{2})?$/;
        if (registration_fees == '') {
            swal('', 'Registration fees  is required.', 'info');
            $('#faculty_loader').removeClass('sk-loading');
            return false;
        } else if (registration_fees < 0) {
            swal('', 'Registration fees should not be less than zero.', 'info');
            $('#faculty_loader').removeClass('sk-loading');
            return false;
        } else if (!dec_numbers.test(registration_fees)) {
            swal('', 'Registration fees can have decimal numbers with 2 decimal point.', 'info');
            $('#faculty_loader').removeClass('sk-loading');
            return false;
        }

        if (foreign_registration_fees == '') {
            swal('', 'Foreign Registration fees  is required.', 'info');
            $('#faculty_loader').removeClass('sk-loading');
            return false;
        } else if (registration_fees < 0) {
            swal('', 'Foreign Registration fees should not be less than zero.', 'info');
            $('#faculty_loader').removeClass('sk-loading');
            return false;
        } else if (!dec_numbers.test(registration_fees)) {
            swal('', 'Foreign Registration fees can have decimal numbers with 2 decimal point.', 'info');
            $('#faculty_loader').removeClass('sk-loading');
            return false;
        }


        var ops_url = baseurl + 'registration/save-registration-fees/';
        $.ajax({
            type: "POST",
            cache: false,
            async: false,
            url: ops_url,
            data: {
                "load": 1,
                "class_id": class_id,
                "registration_fees": registration_fees,
                "foreign_registration_fees": foreign_registration_fees,
                "flag": 1
            },
            success: function(result) {
                var data = JSON.parse(result);
                if (data.status == 1) {
                    swal('', 'Updated registration fees for ' + Description, 'success');
                    load_amount_settings();
                } else {
                    swal('', 'Updation failed,Please try again', 'info');
                    return false;
                }
            }
        });
    }
</script>