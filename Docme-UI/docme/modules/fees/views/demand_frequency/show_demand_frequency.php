<div class="wrapper wrapper-content animated fadeInRight" style="padding-top: 1px !important;padding-left: 0px !important;padding-right: 0px !important;">
    <div class="row" style="margin-left: -29px !important; margin-right: -30px !important;">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title" style="border-bottom-color:#ffd300 !important;">
                    <h5><?php echo isset($sub_title) ? $sub_title : "NO TITLE PROVIDED" ?></h5>
                    <div class="ibox-tools" id="add_type">
                        <!-- Change by Salahudheen May 29, 2019 Title Changed in below <a> tag -->
                        <a data-toggle="modal" class="btn btn-primary btn-xs" data-toggle="tooltip" title="Add New Demand Frequency" data-placement="left" href="javascript:void(0)" onclick="add_new_demand_frequency();"><i class="fa fa-plus"></i>ADD DEMAND FREQUENCY</a>
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
                        <div class="row">
                            <div class="col-lg-12">
                                <div id="curd-content" style="display: none;"></div>
                            </div>
                            <div class="col-lg-12">
                                <table class="table table-bordered table-striped" id="fee_type_tbl" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>FREQUENCY NAME</th>
                                            <th style="text-align: center;">MONTH SPAN</th>
                                            <th style="text-align: center;">RECURRING STATUS</th>
                                            <th style="text-align: center;">CREATED ON</th>
                                            <th style="text-align: center;">ACTION</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        if (isset($demand_frequency) && !empty($demand_frequency)) {
                                            foreach ($demand_frequency as $frequency) {
                                        ?>
                                                <tr>
                                                    <td style="width:30%;"><?php echo $frequency['frequencyName'] ?></td>
                                                    <td style="width:18%; text-align: center;"><?php echo (isset($frequency['monthSpan']) && $frequency['monthSpan'] == -2) ? 'NA' : ($frequency['monthSpan'] == -3 ? 'CUSTOM TERM' : $frequency['monthSpan']); ?> </td>
                                                    <td style="width:17%; text-align: center;"><?php echo $frequency['is_recurring'] == 1 ? 'No' : (($frequency['is_recurring'] == 2 || $frequency['is_recurring'] == 3) ? 'Yes' : 'NA'); ?></td>
                                                    <td style="width:15%; text-align: center;"><?php echo date('d-M-Y', strtotime($frequency['createdOn'])) ?></td>
                                                    <td style="width:20%; text-align: center;">
                                                        <?php if ($frequency['editable'] == 1) { ?>
                                                            <div class="switch  pull-left" style="margin-left:10px; margin-top:5px;">
                                                                <div class="onoffswitch">
                                                                    <?php if ($frequency['isActive'] == 1) {
                                                                        $chkd = 'checked';
                                                                    } else {
                                                                        $chkd = '';
                                                                    } ?>
                                                                    <input type="checkbox" <?php echo $chkd; ?> class="onoffswitch-checkbox freq_status" data-freqid="<?php echo $frequency['id']; ?>" id="frequency_<?php echo $frequency['id']; ?>">
                                                                    <label class="onoffswitch-label" for="frequency_<?php echo $frequency['id']; ?>" title="Change Status of  <?php echo $frequency['frequencyName']; ?>">
                                                                        <span class="onoffswitch-inner"></span>
                                                                        <span class="onoffswitch-switch"></span>
                                                                    </label>
                                                                </div>
                                                            </div>
                                                            <a style="float:left; margin-top:5px;" href="javascript:void(0);" onclick="edit_demand_frequency('<?php echo $frequency['id'] ?>', '<?php echo $frequency['frequencyName'] ?>','<?php echo $frequency['monthSpan'] ?>');" data-toggle="tooltip" data-placement="right" title="Edit <?php echo $frequency['frequencyName']; ?>" data-original-title="<?php echo $frequency['frequencyName']; ?>">
                                                                <span class="pull-left label label-primary" style="font-size: 12px;margin-left: 10px;margin-top: 1px;"><i class="fa fa-edit"></i> Edit
                                                                </span>
                                                            </a>
                                                        <?php } ?>
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

<style>
    .onoffswitch-inner:before {
        padding-left: 0px !important;
    }
</style>
<script type="text/javascript">
    $(window).keydown(function(event) {
        if ((event.keyCode == 13)) {
            event.preventDefault();
            return false;
        }
    });

    var table = $('#fee_type_tbl').dataTable({
        columnDefs: [{
            "width": "100%",
            "targets": 0
        }, ],
        "order": [
            [0, "asc"]
        ],
        responsive: true,
        iDisplayLength: 10,
        "ordering": false,
        dom: '<"html5buttons"B>lTfgitp',
        buttons: [],
    });


    //$(".freq_status").change(function() {
    $(document).on("change", ".freq_status", function() {
        setTimeout(change_status(this), 100);
    });

    function change_status(element) {
        var id = "#" + $(element).attr('id');
        var demand_frequency_id = $(id).data('freqid');

        var status = -1;
        var status_type = $(id).prop("checked");
        if (status_type == true)
            status = 1;
        else
            status = -1;
        var ops_url = baseurl + 'fees/statuschange-feedemandfrequency/';
        $.ajax({
            type: "POST",
            cache: false,
            async: false,
            url: ops_url,
            data: {
                "load": 1,
                "demand_frequency_id": demand_frequency_id,
                "status": status
            },
            success: function(result) {
                var data = $.parseJSON(result);
                if (data.status == 1) {
                    if (status == -1) {
                        swal('Demand Frequency updated', 'Demand Frequency Status Deactivated Successfully', 'success');
                        $('#faculty_loader').removeClass('sk-loading');
                        return true;
                    } else {
                        if (status == 1) {
                            swal('Demand Frequency updated', 'Demand Frequency Status Activated Successfully', 'success');
                            $('#faculty_loader').removeClass('sk-loading');
                            return true;
                        }
                    }
                } else {
                    if (data.status == 0) {
                        swal({
                            title: '',
                            text: data.message,
                            type: 'info',
                            showCancelButton: false,
                            confirmButtonColor: '#3085d6',
                            cancelButtonColor: '#d33',
                            confirmButtonText: 'OK'
                        }, function(isConfirm) {
                            load_fee_demand_frequency_on_show();
                        });
                    } else {
                        if (data.status == 3) {
                            swal({
                                title: '',
                                text: data.message,
                                type: 'info',
                                showCancelButton: false,
                                confirmButtonColor: '#3085d6',
                                cancelButtonColor: '#d33',
                                confirmButtonText: 'OK'
                            }, function(isConfirm) {
                                load_fee_demand_frequency_on_show();
                            });
                        } else {
                            swal({
                                title: '',
                                text: 'Demand Frequency Status Updation Failed',
                                type: 'info',
                                showCancelButton: false,
                                confirmButtonColor: '#3085d6',
                                cancelButtonColor: '#d33',
                                confirmButtonText: 'OK'
                            }, function(isConfirm) {
                                load_fee_demand_frequency_on_show();
                            });
                        }

                    }
                }
            }
        });
    }

    function load_fee_demand_frequency_on_show() {
        var ops_url = baseurl + 'fees/show-demandfrequency/';
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


    function submit_data() {
        $('#faculty_loader').addClass('sk-loading');

        var ops_url = baseurl + 'fees/save-new-feedemandfrequency/';
        var fee_demand_freq_new = $('#frequency_name').val();

        if (fee_demand_freq_new == '') {
            swal('', 'Frequency Name is required.', 'info');
            $('#faculty_loader').removeClass('sk-loading');
            return false;
        } else if ((fee_demand_freq_new.length > '20') || (fee_demand_freq_new.length < '2')) {
            swal('', 'Frequency Name should contain letters or numbers 2 to 20.', 'info');
            $('#faculty_loader').removeClass('sk-loading');
            return false;
        }
        var alphanumers = /^[a-zA-Z\s0-9]+$/;
        if (!alphanumers.test($("#frequency_name").val())) {
            swal('', 'Frequency Name can have only alphabets or numbers.', 'info');
            $('#faculty_loader').removeClass('sk-loading');
            return false;
        }

        if ($('#frequency_type :selected').val() == -1) {
            swal('', 'Select Frequency Type', 'info');
            $('#faculty_loader').removeClass('sk-loading');
            return false;
        }

        if ($('#frequency_month_span :selected').val() == -1) {
            //swal('', 'Select the Month Span since the frequency type selected is recurring fees', 'info');
            swal('', 'Select Month Span', 'info');
            $('#faculty_loader').removeClass('sk-loading');
            return false;
        }

        $.ajax({
            type: "POST",
            cache: false,
            async: false,
            url: ops_url,
            data: $('#demand_frequency_save').serialize(),
            success: function(result) {
                var data = $.parseJSON(result);
                if (data.status == 1) {
                    load_fee_demand_frequency_on_show();
                    swal('Success.', 'Demand Frequency, ' + fee_demand_freq_new + ' created successfully.', 'success');
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

    function submit_edit_save_data() {
        $('#faculty_loader').addClass('sk-loading');
        var demand_freq_name_edit = $('#frequency_name').val();
        var ops_url = baseurl + 'fees/save-edit-feedemandfrequency/';

        var fee_demand_freq_new = $('#frequency_name').val();

        if (fee_demand_freq_new == '') {
            swal('', 'Frequency Name is required.', 'info');
            $('#faculty_loader').removeClass('sk-loading');
            return false;
        } else if ((fee_demand_freq_new.length > '20') || (fee_demand_freq_new.length < '2')) {
            swal('', 'Frequency Name should contain letters or numbers 2 to 20.', 'info');
            $('#faculty_loader').removeClass('sk-loading');
            return false;
        }
        var alphanumers = /^[a-zA-Z\s0-9]+$/;
        if (!alphanumers.test($("#frequency_name").val())) {
            swal('', 'Frequency Name can have only alphabets or numbers.', 'info');
            $('#faculty_loader').removeClass('sk-loading');
            return false;
        }

        if ($('#frequency_type :selected').val() == -1) {
            swal('', 'Select Frequency Type', 'info');
            $('#faculty_loader').removeClass('sk-loading');
            return false;
        }

        if ($('#frequency_month_span :selected').val() == -1) {
            swal('', 'Select the Month Span since the frequency type selected is recurring fees', 'info');
            $('#faculty_loader').removeClass('sk-loading');
            return false;
        }



        $.ajax({
            type: "POST",
            cache: false,
            async: false,
            url: ops_url,
            data: $('#demand_frequency_edit_save').serialize(),
            success: function(result) {
                var data = $.parseJSON(result);
                if (data.status == 1) {
                    load_fee_demand_frequency_on_show();
                    swal('Success.', 'Demand Frequency, ' + demand_freq_name_edit + ' updated successfully.', 'success');
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
                    $("#curd-content").slideUp("slow", function() {
                        $("#curd-content").hide();
                        $('#add_type').show();
                    });
                } else if (data.status == 3) {
                    $('#curd-content').html('');
                    $('#curd-content').html(data.view);
                    swal('', data.message, 'info');
                    $('#faculty_loader').removeClass('sk-loading');
                } else if (data.status == 4) {
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


    function edit_demand_frequency(demand_freq_id, freq_name, monthspan) {
        var title_data = $('#title_data').val();
        var ops_url = baseurl + 'fees/edit-feedemandfrequency/';
        $.ajax({
            type: "POST",
            cache: false,
            async: false,
            url: ops_url,
            data: {
                "load": 1,
                "demand_freq_id": demand_freq_id,
                "freq_name": freq_name,
                'title_data': title_data
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
                    $("#frequency_type").change();
                    $("#frequency_month_span").val(monthspan).trigger('change');
                    $(window).scrollTop(0);
                } else {
                    swal('', 'No data available associated with this fee type', 'info');
                    return false;
                }
            }
        });
    }



    //NEW SCRIPT
    function add_new_demand_frequency() {
        var ops_url = baseurl + 'fees/add-feedemandfrequency/';
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
                    swal('', 'No data available associated with this Demand Frequency', 'info');
                    return false;
                }
            }
        });
    }
</script>