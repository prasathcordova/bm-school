<div class="wrapper wrapper-content animated fadeInRight" style="padding-top: 1px !important;padding-left: 0px !important;padding-right: 0px !important;">
    <div class="row" style="margin-left: -29px !important; margin-right: -30px !important;">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title" style="border-bottom-color:#ffd300 !important;">
                    <h5><?php echo isset($sub_title) ? $sub_title : "NO TITLE PROVIDED" ?></h5>
                    <div class="ibox-tools" id="add_type">
                        <!-- Change by Salahudheen May 29, 2019 Title Changed in below <a> tag -->
                        <a data-toggle="modal" class="btn btn-primary btn-xs" data-toggle="tooltip" title="Add New Fee Code" data-placement="left" href="javascript:void(0)" onclick="add_new_fee_code();"><i class="fa fa-plus"></i>ADD FEE CODE</a>
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
                            <div class="col-lg-4 col-md-4 col-sm-6 pull-left">
                                <label>Fee Allocation Type</label>
                                <select name="feecodetype" id="feecodetype" class="form-control" onchange="reload_feecodes(this);">
                                    <option selected value="-1">Select </option>
                                    <option <?php if ($feecodetype == 1) echo 'selected=selected' ?> value="1">Demandable</option>
                                    <option <?php if ($feecodetype == 2) echo 'selected=selected' ?> value="2">Non Demandable</option>
                                </select>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-lg-12">
                                <table id="fee_code_tbl" style="width:100%">
                                    <?php
                                    if (isset($fee_codes) && !empty($fee_codes)) {
                                        $ignore_array = array('F007');
                                        $editicon = 1;
                                        foreach ($fee_codes as $fee_code) {
                                            if ($fee_code['editable'] == 1) {
                                                if (in_array(trim($fee_code['feeCode']), $ignore_array)) $editicon = 0;
                                                else $editicon = 1;
                                                if ($fee_code['demandType'] == $feecodetype || !isset($feecodetype) || $feecodetype == -1) {
                                    ?>
                                                    <tr dem_type="<?php echo $fee_code['demandType'] ?>">
                                                        <td>
                                                            <div class="ibox-content" style="padding-bottom:5px;padding-top: 5px;">
                                                                <div>
                                                                    <div class="chat-activity-list">
                                                                        <div class="chat-element">
                                                                            <a href="#" class="pull-left">
                                                                            </a>
                                                                            <div class="media-body ">
                                                                                <p class="m-b-xs" style="text-transform: uppercase;">
                                                                                    <strong>Fee Code : </strong>
                                                                                    <?php echo $fee_code['feeCode'] ?>
                                                                                </p>
                                                                                <p class="m-b-xs" style="text-transform: uppercase;">
                                                                                    <strong>Description : </strong>
                                                                                    <?php echo $fee_code['description'] ?> (<?php echo $fee_code['fee_shortcode'] ?>)
                                                                                </p>
                                                                                <p class="m-b-xs" style="text-transform: uppercase;">
                                                                                    <strong><?php echo print_tax_vat(); ?> : </strong>
                                                                                    <?php if (isset($fee_code['is_vat']) && $fee_code['is_vat'] == 1 && isset($fee_code['vat']) && $fee_code['vat'] > 0) {
                                                                                        echo $fee_code['vat'] . ' %';
                                                                                    } else {
                                                                                        echo 'No ';
                                                                                        echo print_tax_vat();
                                                                                    } ?>
                                                                                </p>
                                                                                <p class="m-b-xs" style="text-transform: uppercase;">
                                                                                    <strong>Fee Type : </strong>
                                                                                    <?php echo $fee_code['feeTypeName']; ?>
                                                                                </p>
                                                                                <p class="m-b-xs" style="text-transform: uppercase;">
                                                                                    <strong>Account Code :</strong>
                                                                                    <?php echo $fee_code['accountCode'] ?>
                                                                                </p>
                                                                                <p class="m-b-xs" style="text-transform: uppercase;">
                                                                                    <strong>Frequency Type :</strong>
                                                                                    <?php echo $fee_code['frequencyName'] ?>
                                                                                </p>
                                                                                <p class="m-b-xs" style="text-transform: uppercase;">
                                                                                    <strong>Recurring Type:</strong>
                                                                                    <?php echo isset($fee_code['is_recurring']) && $fee_code['is_recurring'] == 1 ? 'One Time Fee' : ($fee_code['is_recurring'] == 3 ? 'CUSTOM TERM' : 'Reccuring , Month Span : ' . $fee_code['monthSpan']); ?>
                                                                                </p>
                                                                                <p class="m-b-xs" style="text-transform: uppercase;">
                                                                                    <strong>Fee Allocation Type :</strong>
                                                                                    <?php echo $fee_code['type_name'] ?>
                                                                                </p>
                                                                                <small class="text-muted" style="font-size: 13px;text-transform: uppercase;">Created On : <?php echo date('d-M-Y', strtotime($fee_code['createdOn'])) ?></small>
                                                                                <?php if ($editicon == 1) { ?>
                                                                                    <a href="javascript:void(0);" onclick="edit_fee_code('<?php echo $fee_code['id'] ?>','<?php echo $fee_code['feeCode'] ?>');" data-toggle="tooltip" data-placement="right" title="Edit <?php echo $fee_code['feeCode']; ?>" data-original-title="<?php echo $fee_code['feeCode']; ?>">
                                                                                        <span class="pull-right label label-primary" style="font-size: 12px;margin-left: 10px;margin-top: 1px;"><i class="fa fa-edit"></i> Edit
                                                                                        </span>
                                                                                    </a>
                                                                                    <div class="switch  pull-right">
                                                                                        <div class="onoffswitch">
                                                                                            <?php if ($fee_code['isActive'] == 1) {
                                                                                                $chkd = 'checked';
                                                                                            } else {
                                                                                                $chkd = '';
                                                                                            } ?>
                                                                                            <input type="checkbox" <?php echo $chkd; ?> class="onoffswitch-checkbox fee_code_status" data-fee_codeid="<?php echo $fee_code['id']; ?>" id="fee_code_<?php echo $fee_code['id']; ?>">
                                                                                            <label class="onoffswitch-label" for="fee_code_<?php echo $fee_code['id']; ?>" title="Change Status of <?php echo $fee_code['feeCode']; ?>">
                                                                                                <span class="onoffswitch-inner"></span>
                                                                                                <span class="onoffswitch-switch"></span>
                                                                                            </label>
                                                                                        </div>
                                                                                    </div>
                                                                                <?php } ?>
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
                                        }
                                    }
                                    ?>
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
    $('#feecodetype').select2({
        'theme': 'bootstrap'
    });
    //$(".fee_code_status").change(function() {
    $(document).on("change", ".fee_code_status", function() {
        setTimeout(change_status(this), 100);
    });

    function type_changed() {
        //nondemandselect
        var status_value = $('#demand_type :selected').val();
        if (status_value == -1) {
            $('#demandselect').hide();
            $('#nondemandselect').hide();
        } else if (status_value == 1) {
            $('#demandselect').show();
            $('#nondemandselect').hide();
        } else if (status_value == 2) {
            $('#demandselect').hide();
            $('#nondemandselect').show();
        }
    }
    //Salah : oCt12, 2019
    function view_term(ele) {
        $('#viewtermdetails').show('slow');
        var termdiv = $('#demand_frequency :selected').attr('data-recurring');
        if (termdiv == 3) $('#viewtermdetails').show('slow');
        else $('#viewtermdetails').hide();
    }
    //Salah : oCt12, 2019
    //SALAH
    function type_changed1() {
        var flags = 0;
        var ops_url = baseurl + 'fees/frequency_change/';
        var status_value = $('#demand_type :selected').val();
        if (status_value == 1) {
            flags = 1
        } else {
            flags = 2
        }
        $.ajax({
            type: "POST",
            cache: false,
            async: false,
            url: ops_url,
            data: {
                "load": 1,
                "flag": flags
            },
            success: function(data) {
                if (data) {
                    $('#viewdemandfrequency').html(data);
                    //                    var animation = "fadeInDown";
                    //                    $('#search-feecode').hide();
                    //                    $("#curd-content").show();
                    //                    $('#curd-content').addClass('animated');
                    //                    $('#curd-content').addClass(animation);
                    //                    $('#add_type').hide();
                } else {
                    swal('', 'No data available.', 'info');
                    return false;
                }
            }
        });
    }
    //SALAH
    function change_status(element) {
        var id = "#" + $(element).attr('id');
        var fee_code_id = $(id).data('fee_codeid');

        var status = -1;
        var status_type = $(id).prop("checked");
        if (status_type == true)
            status = 1;
        else
            status = -1;
        var ops_url = baseurl + 'fees/statuschange-feecode/';
        $.ajax({
            type: "POST",
            cache: false,
            async: false,
            url: ops_url,
            data: {
                "load": 1,
                "fee_code_id": fee_code_id,
                "status": status
            },
            success: function(result) {
                var data = $.parseJSON(result);
                if (data.status == 1) {
                    if (status == -1) {
                        swal('Fee Code updated', 'Fee Code Status Deactivated Successfully', 'success');
                        $('#faculty_loader').removeClass('sk-loading');
                        return true;
                    } else {
                        if (status == 1) {
                            swal('Fee Code updated', 'Fee Code Status Activated Successfully', 'success');
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
                            load_fee_code_on_show();
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
                                load_fee_code_on_show();
                            });
                        } else {
                            swal({
                                title: '',
                                text: 'Fee Code Status Updation Failed',
                                type: 'info',
                                showCancelButton: false,
                                confirmButtonColor: '#3085d6',
                                cancelButtonColor: '#d33',
                                confirmButtonText: 'OK'
                            }, function(isConfirm) {
                                load_fee_code_on_show();
                            });
                        }

                    }
                }
            }
        });
    }

    function reload_feecodes(el) {
        var feecodetype = $('#feecodetype :selected').val();
        var ops_url = baseurl + 'fees/show-feescode/';
        $.ajax({
            type: "POST",
            cache: false,
            async: false,
            url: ops_url,
            data: {
                "load": 1,
                "feecodetype": feecodetype
            },
            success: function(result) {
                $('#data-view').html(result);
            }
        });
    }

    function load_fee_code_on_show() {
        var ops_url = baseurl + 'fees/show-feescode/';
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

    function add_new_fee_code() {
        var ops_url = baseurl + 'fees/add-feescode/';
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
        $('#faculty_loader').addClass('sk-loading');
        // var termname = $('.term_name').val();
        // alert(termname);
        // return false;

        var ops_url = baseurl + 'fees/save-new-feescode/';

        if ($('#demand_type :selected').val() == -1) {
            swal('', 'Select Fee Allocation Type', 'info');
            $('#faculty_loader').removeClass('sk-loading');
            return false;
        }

        var fees_code = $('#fees_code').val();
        if (fees_code == '') {
            $('#fees_code').focus();
            swal('', 'Fee Code is required.', 'info');
            $('#faculty_loader').removeClass('sk-loading');
            return false;
        } else if ((fees_code.length > '10') || (fees_code.length < '2')) { //changed 30 to 10 -> SALAHUDHEEN May 29,2019
            $('#fees_code').focus();
            swal('', 'Fee Code should contain letters or numbers 2 to 10.', 'info');
            $('#faculty_loader').removeClass('sk-loading');
            return false;
        }
        var alphanumers = /^[a-zA-Z\s0-9]+$/;
        if (!alphanumers.test($("#fees_code").val())) {
            $('#fees_code').focus();
            swal('', 'Fee Code can have only alphabets or numbers.', 'info');
            $('#faculty_loader').removeClass('sk-loading');
            return false;
        }

        var description = $('#description').val();

        if (description == '') {
            $('#description').focus();
            swal('', 'Description is required.', 'info');
            $('#faculty_loader').removeClass('sk-loading');
            return false;
        } else if ((description.length > '20') || (description.length < '2')) { //changed 50 to 20 -> SALAHUDHEEN May 29,2019
            $('#description').focus();
            swal('', 'Description should contain letters or numbers 2 to 20.', 'info');
            $('#faculty_loader').removeClass('sk-loading');
            return false;
        }
        var alphanumers = /^[a-zA-Z\s0-9]+$/;
        if (!alphanumers.test($("#description").val())) {
            $('#description').focus();
            swal('', 'Description can have only alphabets or numbers', 'info');
            $('#faculty_loader').removeClass('sk-loading');
            return false;
        }
        var fee_shortcode = $('#fee_shortcode').val();
        if (fee_shortcode == '') {
            var str = $('#description').val();
            var res = str.substring(0, 3);
            fee_shortcode = res;
        }

        if ($('#is_vat :selected').val() == -2) {
            swal('', 'Select ' + taxvat + ' Applicable', 'info');
            $('#faculty_loader').removeClass('sk-loading');
            return false;
        }

        if ($('#is_vat :selected').val() == 1) {
            var vat_percent = $('#vat_percent').val();

            if (vat_percent == '') {
                $('#vat_percent').focus();
                swal('', taxvat + ' % required.', 'info');
                $('#faculty_loader').removeClass('sk-loading');
                return false;
            } else if (vat_percent == 0) {
                $('#vat_percent').focus();
                swal('', taxvat + ' % Should be more than 0.', 'info');
                $('#faculty_loader').removeClass('sk-loading');
                return false;
            } else if (!(parseFloat(vat_percent) > 0 && parseFloat(vat_percent) <= 100)) {
                $('#vat_percent').focus();
                $('#vat_percent').val('');
                swal('', taxvat + ' % Should not be more than 100.', 'info');
                $('#faculty_loader').removeClass('sk-loading');
                return false;
            }
            var alphanumers = /^\s*(\+|-)?((\d+(\.\d+)?)|(\.\d+))\s*$/;
            if (!alphanumers.test($("#vat_percent").val())) {
                $('#vat_percent').focus();
                swal('', taxvat + ' % can have only  numbers.', 'info');
                $('#faculty_loader').removeClass('sk-loading');
                return false;
            }
        }

        if ($('#feetype_select :selected').val() == -1) {
            swal('', 'Select Fee Type', 'info');
            $('#faculty_loader').removeClass('sk-loading');
            return false;
        }
        if ($('#account_code_data :selected').val() == -1) {
            swal('', 'Select Account Code', 'info');
            $('#faculty_loader').removeClass('sk-loading');
            return false;
        }
        if ($('#demand_frequency :selected').val() == -1) {
            swal('', 'Select Frequency Type', 'info');
            $('#faculty_loader').removeClass('sk-loading');
            return false;
        }

        $.ajax({
            type: "POST",
            cache: false,
            async: false,
            url: ops_url,
            data: $('#feecode_save').serialize(),
            success: function(result) {
                var data = $.parseJSON(result);
                if (data.status == 1) {
                    load_fee_code_on_show();
                    swal('Success', 'New Fee Code, ' + fees_code + ' created successfully.', 'success');
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


    function edit_fee_code(fee_code_id, fee_code) {
        var title_data = $('#title_data').val();
        var ops_url = baseurl + 'fees/edit-feescode/';
        $.ajax({
            type: "POST",
            cache: false,
            async: false,
            url: ops_url,
            data: {
                "load": 1,
                "fee_code_id": fee_code_id,
                "fee_code": fee_code,
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

        var ops_url = baseurl + 'fees/save-edit-feescode/';
        var fees_code = $('#fees_code').val();


        if (fees_code == '') {
            swal('', 'Fee Code is required.', 'info');
            $('#faculty_loader').removeClass('sk-loading');
            return false;
        } else if ((fees_code.length > '10') || (fees_code.length < '2')) {
            swal('', 'Fee Code should contain letters or numbers 2 to 10.', 'info');
            $('#faculty_loader').removeClass('sk-loading');
            return false;
        }
        var alphanumers = /^[a-zA-Z\s0-9]+$/;
        if (!alphanumers.test($("#fees_code").val())) {
            swal('', 'Fee Code can have only alphabets or numbers.', 'info');
            $('#faculty_loader').removeClass('sk-loading');
            return false;
        }

        var description = $('#description').val();

        if (description == '') {
            swal('', 'Description is required.', 'info');
            $('#faculty_loader').removeClass('sk-loading');
            return false;
        }
        // Changes by SALAHUDHEEN May 28, 2019 - Start
        else if ((description.length > '20') || (description.length < '2')) {
            swal('', 'Description should contain letters or numbers 2 to 20.', 'info');
            $('#faculty_loader').removeClass('sk-loading');
            return false;
        }
        // Changes by SALAHUDHEEN May 28, 2019 - End
        //        else if ((description.length > '20') || (description.length < '2')) {
        //            swal('', 'Fee Code description should contain letters or numbers 2 to 20', 'info');
        //            $('#faculty_loader').removeClass('sk-loading');
        //            return false;
        //        }
        var alphanumers = /^[a-zA-Z\s0-9]+$/;
        if (!alphanumers.test($("#description").val())) {
            swal('', 'Description can have only alphabets or numbers.', 'info');
            $('#faculty_loader').removeClass('sk-loading');
            return false;
        }
        var fee_shortcode = $('#fee_shortcode').val();
        if (fee_shortcode == '') {
            var str = $('#description').val();
            var res = str.substring(0, 3);
            fee_shortcode = res;
        }
        if ($('#is_vat :selected').val() == -2) {
            swal('', 'Select VAT Applicable', 'info');
            $('#faculty_loader').removeClass('sk-loading');
            return false;
        }

        if ($('#is_vat :selected').val() == 1) {
            var vat_percent = $('#vat_percent').val();

            if (vat_percent == '') {
                swal('', 'VAT % is required.', 'info');
                $('#faculty_loader').removeClass('sk-loading');
                return false;
            } else if (!(parseFloat(vat_percent) > 0 && parseFloat(vat_percent) <= 100)) {
                swal('', 'VAT % should contain numbers.', 'info');
                $('#faculty_loader').removeClass('sk-loading');
                return false;
            }
            var alphanumers = /^\s*(\+|-)?((\d+(\.\d+)?)|(\.\d+))\s*$/;
            if (!alphanumers.test($("#vat_percent").val())) {
                swal('', 'VAT % can have only numbers.', 'info');
                $('#faculty_loader').removeClass('sk-loading');
                return false;
            }
        }

        if ($('#feetype_select :selected').val() == -1) {
            swal('', 'Select a Fee Type', 'info');
            $('#faculty_loader').removeClass('sk-loading');
            return false;
        }
        if ($('#demand_frequency :selected').val() == -1) {
            swal('', 'Select a Frequency Type', 'info');
            $('#faculty_loader').removeClass('sk-loading');
            return false;
        }
        if ($('#account_code_data :selected').val() == -1) {
            swal('', 'Select an Account Code', 'info');
            $('#faculty_loader').removeClass('sk-loading');
            return false;
        }
        if ($('#demand_type :selected').val() == -1) {
            swal('', 'Select Fee Allocation Type', 'info');
            $('#faculty_loader').removeClass('sk-loading');
            return false;
        }

        $.ajax({
            type: "POST",
            cache: false,
            async: false,
            url: ops_url,
            data: $('#feecode_edit_save').serialize(),
            success: function(result) {
                var data = $.parseJSON(result);
                if (data.status == 1) {
                    load_fee_code_on_show();
                    swal('Success', 'Fee Code, ' + fees_code + ' updated successfully.', 'success');
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