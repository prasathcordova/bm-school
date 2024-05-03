<?php //echo convert_number_to_indian_words(10.5);?>
<div class="wrapper wrapper-content animated fadeInRight" style="padding-top: 1px !important;padding-left: 0px !important;padding-right: 0px !important;">
    <div class="row" style="margin-left: -29px !important; margin-right: -30px !important;">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title" style="border-bottom-color:#ffd300 !important;">
                    <h5><?php echo isset($sub_title) ? $sub_title : "NO TITLE PROVIDED" ?></h5>
                    <div class="ibox-tools" id="add_type">
                        <!-- Change by Salahudheen May 29, 2019 Title Changed in below <a> tag -->
                        <a data-toggle="modal" class="btn btn-primary btn-xs" data-toggle="tooltip" title="Add Penalty" data-placement="left" href="javascript:void(0)" onclick="add_penalty();"><i class="fa fa-plus"></i>ADD PENALTY</a>
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
                    <div id="curd-content" style="display: none;"></div>
                    <div class="wrapper wrapper-content animated fadeInRight" id="student-data-container">
                        <div class="row">
                            <div class="col-lg-12">
                                <table id="fee_code_tbl" style="width:100%" class="table table-bordered">
                                <thead style="display: none;"></thead>
                                <tbody>
                                    <?php
                                    //dev_export($penalty_data);
                                    if (isset($penalty_data) && !empty($penalty_data)) {
                                        foreach ($penalty_data as $key => $plda) {
                                    ?>
                                            <tr>
                                                <td>
                                                    <div class="ibox-content" style="padding-bottom:5px;padding-top: 5px; background:none; padding:0;">
                                                        <div>
                                                            <div class="chat-activity-list">
                                                                <div class="chat-element" style="border-bottom: 0px;">
                                                                    <a href="#" class="pull-left">
                                                                    </a>
                                                                    <div class="media-body ">
                                                                        <p class="m-b-xs" style="text-transform: uppercase;">
                                                                            <strong>Fee Code : </strong>
                                                                            <?php echo $plda['fee_name'] ?>
                                                                        </p>
                                                                        <p class="m-b-xs" style="text-transform: uppercase;">
                                                                            <strong>Penalty Type : </strong>
                                                                            <?php echo $plda['penalty_desc']; ?> (<?php echo trim($plda['penalty_type']); ?>)
                                                                        </p>
                                                                        <p class="m-b-xs" style="text-transform: uppercase;">
                                                                            <strong>Effect Date : </strong>
                                                                            <?php echo $plda['effectdate']; ?>
                                                                        </p>
                                                                        <hr>
                                                                        <?php
                                                                        if (!empty($plda['details'])) {
                                                                            foreach ($plda['details'] as $details) {
                                                                        ?>

                                                                                <p class="m-b-xs" style="text-transform: uppercase;">
                                                                                    <div class="row">
                                                                                        <div class="col-lg-4 col-md-4">
                                                                                            From Days : <?php echo $details['FromDays'] ?>
                                                                                        </div>
                                                                                        <div class="col-lg-4 col-md-4">
                                                                                            To Days : <?php echo $details['Todays'] ?>
                                                                                        </div>
                                                                                        <div class="col-lg-4 col-md-4">
                                                                                            Amount : <?php echo my_money_format($details['amount']) ?>
                                                                                        </div>
                                                                                    </div>
                                                                                </p>
                                                                        <?php
                                                                            }
                                                                        }
                                                                        ?>
                                                                        <!-- <a href="javascript:void(0);" onclick="edit_penalty('<?php echo $plda['penalty_id'] ?>','<?php echo $plda['fee_name'] ?>');" data-toggle="tooltip" data-placement="right" title="Edit Penalty settings of <?php echo $plda['fee_name']; ?>" data-original-title="<?php echo $plda['fee_name']; ?>">
                                                                            <span class="pull-right label label-primary" style="font-size: 12px;margin-left: 10px;margin-top: 1px;"><i class="fa fa-edit"></i> Edit
                                                                            </span>
                                                                        </a> -->
                                                                        <div class="switch  pull-right" style="margin-top: -25px;">
                                                                            <div class="onoffswitch">
                                                                                <?php if ($plda['status'] == 'Y') {
                                                                                    $chkd = 'checked';
                                                                                } else {
                                                                                    $chkd = '';
                                                                                } ?>
                                                                                <input type="checkbox" <?php echo $chkd; ?> class="onoffswitch-checkbox fee_penalty_status" data-fee_penalty_id="<?php echo $plda['penalty_id']; ?>" id="fee_code_<?php echo $plda['penalty_id']; ?>">
                                                                                <label class="onoffswitch-label" for="fee_code_<?php echo $plda['penalty_id']; ?>" title="Change Status of <?php echo $plda['fee_name']; ?>">
                                                                                    <span class="onoffswitch-inner"></span>
                                                                                    <span class="onoffswitch-switch"></span>
                                                                                </label>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>

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
    var table = $('#fee_code_tbl').dataTable({
        columnDefs: [{
            "width": "100%",
            "targets": 0
        }, ],
        "order": [
            [0, "asc"]
        ],
        responsive: false,
        iDisplayLength: 10,
        "ordering": false,
        dom: '<"html5buttons"B>lTfgitp',
        buttons: [],
    });

    $(".fee_penalty_status").change(function() {
        setTimeout(change_status(this), 100);
    });

    function change_status(element) {
        var id = "#" + $(element).attr('id');
        var fee_penalty_id = $(id).data('fee_penalty_id');

        var status = -1;
        var status_type = $(id).prop("checked");
        if (status_type == true)
            status = 1;
        else
            status = -1;
        var ops_url = baseurl + 'fees/change_penalty_status/';
        $.ajax({
            type: "POST",
            cache: false,
            async: false,
            url: ops_url,
            data: {
                "load": 1,
                "fee_penalty_id": fee_penalty_id,
                "status": status
            },
            success: function(result) {
                var data = $.parseJSON(result);
                if (data.status == 1) {
                    load_penalty();
                    if (status == 1)
                        swal('Success', 'Penalty activated successfully.', 'success');
                    else
                        swal('Success', 'Penalty deactivated successfully.', 'success');
                    $('#faculty_loader').removeClass('sk-loading');
                    $("#curd-content").slideUp("slow", function() {
                        $("#curd-content").hide();
                        $('#add_type').show();
                    });
                } else if (data.status == 2) {
                    $('#faculty_loader').removeClass('sk-loading');
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

    function load_penalty() {
        var ops_url = baseurl + 'fees/show_penalty/';
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
                $(window).scrollTop(0);
            }
        });

    }

    function add_penalty() {
        var ops_url = baseurl + 'fees/add_penalty/';
        $.ajax({
            type: "POST",
            cache: false,
            async: false,
            url: ops_url,
            data: {
                "load": 1
            },
            success: function(data) {
                if (data) {
                    $('#curd-content').html(data);
                    var animation = "fadeInDown";
                    $('#search-feecode').hide();
                    $("#curd-content").show();
                    $('#curd-content').addClass('animated');
                    $('#curd-content').addClass(animation);
                    $('#add_type').hide();
                } else {
                    swal('', 'No data available.', 'info');
                    return false;
                }
            }
        });
    }

    function submit_data() {
        var taxvat = '<?php echo print_tax_vat(); ?>'
        //$('#faculty_loader').addClass('sk-loading');
        // var termname = $('.term_name').val();
        // alert(termname);
        // return false;

        var ops_url = baseurl + 'fees/save_penalty/';

        if ($('#fee_code :selected').val() == -1) {
            swal('', 'Select Fee Code', 'info');
            $('#faculty_loader').removeClass('sk-loading');
            return false;
        }
        if ($('#penalty_type :selected').val() == -1) {
            swal('', 'Select Penalty Type', 'info');
            $('#faculty_loader').removeClass('sk-loading');
            return false;
        }
        //var effectdate = moment($('.effectdate').val(), 'DD-MM-YYYY').format('YYYY-MM-DD');
        var ddate = $('.effectdate').val();
        if (ddate == '') {
            // $('.effectdate').focus();
            swal('', 'Effective date is required.', 'info');
            $('#faculty_loader').removeClass('sk-loading');
            return false;
        }
        var arrayb = ddate.split("/");
        var repdate = arrayb[2] + '-' + arrayb[1] + '-' + arrayb[0]; // Formatted for dd/mm/yyyy
        var frmdt = moment(repdate).format('YYYY-MM-DD');
        var effectdate = frmdt;
        // var effectdate = $('.effectdate').val();
        // if (effectdate == '') {
        //     $('.effectdate').focus();
        //     swal('', 'Effect Date required.', 'info');
        //     $('#faculty_loader').removeClass('sk-loading');
        //     return false;
        // }
        var serial_data = $('#penalty_save').serialize() + '&effect_date=' + effectdate;

        var from_day1 = $('#from_day1').val();
        var to_day1 = $('#to_day1').val();
        var penalty_amount1 = $('#penalty_amount1').val();
        if (to_day1 == '') {
            swal('', 'Enter To Days', 'error');
            $('#faculty_loader').removeClass('sk-loading');
            return false;
        }
        if (penalty_amount1 == '') {
            swal('', 'Enter Amount', 'error');
            $('#faculty_loader').removeClass('sk-loading');
            return false;
        }

        $.ajax({
            type: "POST",
            cache: false,
            async: false,
            url: ops_url,
            data: serial_data,
            success: function(result) {
                var data = $.parseJSON(result);
                if (data.status == 1) {
                    load_penalty();
                    swal('Success', 'Penalty created successfully.', 'success');
                    $('#faculty_loader').removeClass('sk-loading');
                    $("#curd-content").slideUp("slow", function() {
                        $("#curd-content").hide();
                        $('#add_type').show();
                    });
                } else if (data.status == 2) {
                    $('#faculty_loader').removeClass('sk-loading');
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


    function edit_penalty(penalty_id, fee_name) {
        var ops_url = baseurl + 'fees/edit_penalty/';
        $.ajax({
            type: "POST",
            cache: false,
            async: false,
            url: ops_url,
            data: {
                "load": 1,
                "penalty_id": penalty_id,
                "fee_name": fee_name
            },
            success: function(result) {
                var data = JSON.parse(result);
                if (data.status == 1) {
                    $('#curd-content').html(data.view);
                    var animation = "fadeInDown";
                    $('#search-feecode').hide();
                    $("#curd-content").show();
                    $('#curd-content').addClass('animated');
                    $('#curd-content').addClass(animation);
                    $('#add_type').hide();

                    $(window).scrollTop(0);
                } else {
                    swal('', 'No data available associated with this fee type', 'info');
                    return false;
                }
            }
        });
    }

    function submit_edit_data() {

        $('#faculty_loader').addClass('sk-loading');

        var ops_url = baseurl + 'fees/update_penalty/';

        if ($('#fee_code :selected').val() == -1) {
            swal('', 'Select Fee Code', 'info');
            $('#faculty_loader').removeClass('sk-loading');
            return false;
        }
        if ($('#penalty_type :selected').val() == -1) {
            swal('', 'Select Penalty Type', 'info');
            $('#faculty_loader').removeClass('sk-loading');
            return false;
        }
        var ddate = $('.effectdate').val();
        var arrayb = ddate.split("/");
        var repdate = arrayb[2] + '-' + arrayb[1] + '-' + arrayb[0]; // Formatted for dd/mm/yyyy
        var frmdt = moment(repdate).format('YYYY-MM-DD');
        var effectdate = frmdt;

        var serial_data = $('#penalty_update').serialize() + '&effect_date=' + effectdate;

        var from_day1 = $('#from_day1').val();
        var to_day1 = $('#to_day1').val();
        var penalty_amount1 = $('#penalty_amount1').val();
        if (from_day1 == '' || to_day1 == '' || penalty_amount1 == '') {
            swal('', 'Enter atleast one row', 'error');
            $('#faculty_loader').removeClass('sk-loading');
            return false;
        }

        $.ajax({
            type: "POST",
            cache: false,
            async: false,
            url: ops_url,
            data: serial_data,
            success: function(result) {
                var data = $.parseJSON(result);
                if (data.status == 1) {
                    load_penalty();
                    swal('Success', 'Penalty updated successfully.', 'success');
                    $('#faculty_loader').removeClass('sk-loading');
                    $("#curd-content").slideUp("slow", function() {
                        $("#curd-content").hide();
                        $('#add_type').show();
                    });
                } else if (data.status == 2) {
                    $('#faculty_loader').removeClass('sk-loading');
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
</script>