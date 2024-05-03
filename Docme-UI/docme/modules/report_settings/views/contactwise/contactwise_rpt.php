<div class="wrapper wrapper-content animated fadeInRight" style="padding-top: 1px !important;padding-left: 0px !important;padding-right: 0px !important;">
    <div class="row" style="margin-left: -29px !important; margin-right: -30px !important;">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5><?php echo isset($sub_title) ? $sub_title : "NO TITLE PROVIDED" ?></h5>

                </div>
                <div class="ibox-content" id="Rptcontact_loader">
                    <div class="sk-spinner sk-spinner-wave">
                        <div class="sk-rect1"></div>
                        <div class="sk-rect2"></div>
                        <div class="sk-rect3"></div>
                        <div class="sk-rect4"></div>
                        <div class="sk-rect5"></div>
                    </div>
                    <div class="body">
                        <?php
                        echo form_open('report/stud-nationwisepdf');
                        ?>
                        <input type="hidden" name="save_flag" id="save_flag" value="1" />
                        <div class="row clearfix">
                            <div class="col-lg-6">
                                <div class="form-group <?php
                                                        if (form_error('acd_year')) {
                                                            echo 'has-error';
                                                        }
                                                        ?>">
                                    <label>Academic Year</label><span class="mandatory"> *</span><br />
                                    <!--<input type="hidden" value="<?php // echo set_value('Acd_ID', isset($Acd_ID) ? $Acd_ID : ''); 
                                                                    ?>" id="Acd_ID" name="Acd_ID" />-->
                                    <select id="acd_year" class="form-control " style="width:100%;">
                                        <option selected value="-1">Select</option>

                                        <?php
                                        if (isset($acdyr_data) && !empty($acdyr_data)) {
                                            foreach ($acdyr_data as $acdyr) {
                                                //                                                dev_export($acdyr_data);die;
                                                if (isset($acdyr_selected) && !empty($acdyr_selected) && $acdyr_selected == $acdyr['Acd_ID']) {
                                                    echo '<option selected value = "' . $acdyr['Acd_ID'] . '" >' . $acdyr['Description'] . "</option>";
                                                } else {
                                                    echo '<option value = "' . $acdyr['Acd_ID'] . '" >' . $acdyr['Description'] . "</option>";
                                                }
                                            }
                                        } ?>
                                    </select>
                                    <?php echo form_error('acd_year', '<div class="form-error">', '</div>'); ?>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group <?php
                                                        if (form_error('stream_select')) {
                                                            echo 'has-error';
                                                        }
                                                        ?>">
                                    <label>Stream</label><span class="mandatory"> *</span><br />

                                    <select name="stream_select" id="stream_select" class="form-control " style="width:100%;">

                                        <option selected value="-1">Select</option>
                                        <?php
                                        if (isset($stream_data) && !empty($stream_data)) {
                                            foreach ($stream_data as $stream) {
                                                echo '<option value ="' . $stream['stream_id'] . '">' . $stream['description'] . '</option>';
                                            }
                                        }
                                        ?>
                                    </select>
                                    <?php echo form_error('stream_select', '<div class="form-error">', '</div>'); ?>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group <?php
                                                        if (form_error('class_select')) {
                                                            echo 'has-error';
                                                        }
                                                        ?>">
                                    <label>Class</label><span class="mandatory"> *</span><br />

                                    <select name="class_select" id="class_select" class="form-control " style="width:100%;" onchange="change_class();">

                                        <option selected value="-1">Select</option>
                                        <option value="1000">ALL</option>
                                        <?php
                                        if (isset($class_data) && !empty($class_data)) {
                                            foreach ($class_data as $class) {
                                                echo '<option value ="' . $class['Course_Det_ID'] . '">' . $class['Description'] . '</option>';
                                            }
                                        }
                                        ?>
                                    </select>
                                    <?php echo form_error('class_select', '<div class="form-error">', '</div>'); ?>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group <?php
                                                        if (form_error('batch_select')) {
                                                            echo 'has-error';
                                                        }
                                                        ?>">
                                    <label>Batch</label><span class="mandatory"> *</span><br />

                                    <select name="batch_select" id="batch_select" class="form-control " style="width:100%;">

                                        <option selected value="-1">Select</option>
                                        <?php
                                        //                                                if (isset($batch_data) && !empty($batch_data)) {
                                        //                                                    foreach ($batch_data as $batch) {
                                        //                                                        echo '<option value ="' . $batch['BatchID'] . '">' . $batch['Batch_Name'] . '</option>';
                                        //                                                    }
                                        //                                                }
                                        ?>

                                    </select>
                                    <?php echo form_error('batch_select', '<div class="form-error">', '</div>'); ?>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group <?php
                                                        if (form_error('relation_select')) {
                                                            echo 'has-error';
                                                        }
                                                        ?>">
                                    <label>Relation</label><span class="mandatory"> *</span><br />

                                    <select name="relation_select" id="relation_select" class="form-control " style="width:100%;">

                                        <option selected value="-1">Select</option>
                                        <option value="F">Father</option>
                                        <option value="M">Mother</option>
                                        <option value="G">Guardian</option>


                                    </select>
                                    <?php echo form_error('relation_select', '<div class="form-error">', '</div>'); ?>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <a href="javascript:void(0);" class="btn btn-primary btn-sm" onclick="submit_data();"> Report</a>
                                <a class="btn btn-danger btn-sm" onclick="canceldata();"> Cancel</a>
                            </div>
                        </div>
                        <a href="#" style="display:none" id="testpdf"></a>
                        <?php echo form_close(); ?>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script type='text/javascript'>
    $('#data_1 .input-group.date').datepicker({
        todayBtn: "linked",
        keyboardNavigation: false,
        forceParse: false,
        calendarWeeks: true,
        autoclose: true
    });


    $('#acd_year').select2({
        'theme': 'bootstrap'
    });
    $('#class_select').select2({
        'theme': 'bootstrap'
    });
    $('#stream_select').select2({
        'theme': 'bootstrap'
    });
    $('#batch_select').select2({
        'theme': 'bootstrap'
    });
    $('#relation_select').select2({
        'theme': 'bootstrap'
    });


    function submit_data() {
        $('#Rptcontact_loader').addClass('sk-loading');
        var Acd_ID = $('#acd_year').val();
        var batch_ID = $('#batch_select').val();
        var class_ID = $('#class_select').val();
        var stream_ID = $('#stream_select').val();
        var relation_ID = $('#relation_select').val();
        var relation = $('#relation_select option:selected').text();


        if (Acd_ID == -1) {
            swal('', 'Academic Year is required.', 'info');
            $('#Rptcontact_loader').removeClass('sk-loading');
            return;
        }
        if (stream_ID == -1) {
            swal('', 'Stream is required.', 'info');
            $('#Rptcontact_loader').removeClass('sk-loading');
            return;
        }
        if (class_ID == -1) {
            swal('', 'Class is required.', 'info');
            $('#Rptcontact_loader').removeClass('sk-loading');
            return;
        }
        if (batch_ID == -1) {
            swal('', 'Batch is required.', 'info');
            $('#Rptcontact_loader').removeClass('sk-loading');
            return;
        }
        if (relation_ID == -1) {
            swal('', 'Relation  is required.', 'info');
            $('#Rptcontact_loader').removeClass('sk-loading');
            return;
        }

        var ops_url = baseurl + 'report/stud-contactwisepdf';
        $.ajax({
            type: "POST",
            cache: false,
            // async: false,
            url: ops_url,
            data: {
                "load": 1,
                "acd_year": Acd_ID,
                "batch_select": batch_ID,
                "class_select": class_ID,
                "stream_select": stream_ID,
                "relation_select": relation_ID
            },
            success: function(data) {
                try {
                    var datas = JSON.parse(data);
                    if (datas.status == 1) {
                        window.open(datas.message, '_blank');
                        $('#Rptcontact_loader').removeClass('sk-loading');
                    } else {
                        if (datas.status == 3) {
                            if (datas.message) {
                                swal('', datas.message, 'info');
                                $('#Rptcontact_loader').removeClass('sk-loading');
                                return false;
                            } else {
                                $('#Rptcontact_loader').removeClass('sk-loading');
                                swal('', 'No Reports Available', 'info')
                            }
                        }
                    }
                } catch (e) {
                    $('#Rptcontact_loader').removeClass('sk-loading');
                    swal('', 'An error encountered. Please try again later or contact administrator with the error code : DPRAPPUIJSNER10001', 'info');
                    return false;
                }
            }
        });
    }

    function canceldata() {
        $('#acd_year').select2('val', -1);
        $('#class_select').select2('val', -1);
        $('#batch_select').select2('val', -1);
        $('#stream_select').select2('val', -1);
        $('#relation_select').select2('val', -1);
    }

    function change_class() {
        var class_id = $('#class_select').val();
        var strem_id = $('#stream_select').val();
        var acd_id = $('#acd_year').val();
        var data = {};
        if (class_id == 1000) {
            data = {
                load: 1,
                "acd_year": acd_id,
                'stream_select': strem_id
            }
        } else {
            data = {
                "acd_year": acd_id,
                'class_select': class_id,
                'stream_select': strem_id
            };
        }
        var ops_url = baseurl + 'report/get-batch-details/';
        $.ajax({
            type: "POST",
            cache: false,
            async: false,
            url: ops_url,
            data: data,
            success: function(result) {
                $('#batch_select').empty().trigger("change");
                var data = JSON.parse(result);
                if (data.status == 1) {
                    var batch_data = data.data;
                    $('#batch_select').empty().trigger("change");
                    $('#batch_select').append("<option value='-1'>Select</option>");
                    if (class_id == 1000) {
                        $('#batch_select').append('<option value="1000">ALL</option>');
                    }
                    $.each(batch_data, function(i, v) {

                        $('#batch_select').append("<option value='" + v.BatchID + "' >" + v.Batch_Name + "</option>");
                    });
                    $('#batch_select').trigger('change');
                } else {
                    $('#batch_select').empty().trigger("change");
                }
            }
        });
    }
</script>