<div class="wrapper wrapper-content animated fadeInRight" style="padding-top: 1px !important;padding-left: 0px !important;padding-right: 0px !important;">
    <div class="row" style="margin-left: -29px !important; margin-right: -30px !important;">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5><?php echo isset($sub_title) ? $sub_title : "NO TITLE PROVIDED" ?></h5>

                </div>
                <div class="ibox-content">
                    <div class="body">
                        <?php
                        echo form_open('course/class-reportpdf');
                        ?>
                        <input type="hidden" name="save_flag" id="save_flag" value="1" />
                        <div class="row clearfix">
                            <div class="col-lg-6">
                                <div class="form-group <?php
                                                        if (form_error('acdyr_select')) {
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
                                                //  dev_export($acdyr_data);die;
                                                if (isset($acdyr_selected) && !empty($acdyr_selected) && $acdyr_selected == $acdyr['Acd_ID']) {
                                                    echo '<option selected value = "' . $acdyr['Description'] . '" >' . $acdyr['Description'] . "</option>";
                                                } else {
                                                    echo '<option value = "' . $acdyr['Description'] . '" >' . $acdyr['Description'] . "</option>";
                                                }
                                            }
                                        }
                                        ?>
                                    </select>
                                    <?php echo form_error('acd_year', '<div class="form-error">', '</div>'); ?>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <!-- <div class="form-group <?php
                                                            if (form_error('acdyr_select')) {
                                                                echo 'has-error';
                                                            }
                                                            ?>">
                                    <label>Class</label><span class="mandatory"> *</span><br />
                              
                                    <select name="class_select" id="class_select" class="form-control " style="width:100%;">
                                        <option selected value="-1">Select</option>
                                        <option value="2000">ALL</option>
                                        <?php
                                        if (isset($class_data) && !empty($class_data)) {
                                            foreach ($class_data as $class) {
                                                echo '<option value = "' . $class['Course_Det_ID'] . '" >' . $class['Description'] . "</option>";
                                            }
                                        }
                                        ?>
                                    </select>
                                    <?php echo form_error('class_select', '<div class="form-error">', '</div>'); ?>
                                </div> -->
                            </div>
                            <div class="clearfix"></div>
                            <div class="col-lg-12 col-md-12 col-xs-12">
                                <!-- <input type="checkbox" value="1" name="new_admission" id="new_admission" class="i-checks" />
                                <span class="m-l-xs">Newly Admitted Students</span>
                                <hr> -->
                                <a href="javascript:void(0);" class="btn btn-primary btn-sm" onclick="submit_data('<?php echo $acdyr['Acd_ID'] ?>');"> Report</a>
                            </div>

                            <a href="#" style="display:none" id="testpdf"></a>
                            <?php echo form_close(); ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script type='text/javascript'>
    $("#form_data").hide();
    $("#checkbox1").change(function() {
        if ($(this).prop('checked') == true) {
            $("#form_data").show();
        } else {
            $("#form_data").hide();
        }
    });

    $('#data_1 .input-group.date').datepicker({
        todayBtn: "linked",
        keyboardNavigation: false,
        forceParse: false,
        calendarWeeks: true,
        autoclose: true
    });

    $('.i-checks').iCheck({
        checkboxClass: 'icheckbox_square-green',
        radioClass: 'iradio_square-green',
    });

    $('#acd_year').select2({
        'theme': 'bootstrap'
    });
    $('#class_select').select2({
        'theme': 'bootstrap'
    });
    $('#division_select').select2({
        'theme': 'bootstrap'
    });


    function submit_data(Acd_ID) {

        // var new_admission = $("input[name='new_admission']:checked").val();
        // if (new_admission != 1) {
        //     new_admission = -1;
        // }

        var Acd_ID = $('#acd_year').val();
        // var class_ID = $('#class_select').val();
        if (Acd_ID == -1) {
            swal('', 'Academic Year is required.', 'info');
            return;
        }
        // if (class_ID == -1) {
        //     swal('', 'Class is required.', 'info');
        //     return;
        // }
        var ops_url = baseurl + 'course/class-reportpdf';
        $.ajax({
            type: "POST",
            cache: false,
            async: false,
            url: ops_url,
            data: {
                "load": 1,
                "acd_year": Acd_ID,
                // "class_id": class_ID,
                // "new_admission": new_admission,
            },
            success: function(data) {
                console.log(data);
                try {
                    var datas = JSON.parse(data);
                    console.log(data);
                    if (datas.status == 1) {
                        window.open(datas.message, '_blank');
                        $('#report_param_loader').removeClass('sk-loading');
                    } else {
                        if (datas.status == 3) {
                            if (datas.message) {
                                swal('', datas.message, 'info');
                                $('#report_param_loader').removeClass('sk-loading');
                                return false;
                            } else {
                                $('#report_param_loader').removeClass('sk-loading');
                                swal('', 'No Reports Available', 'info')
                            }
                        }
                    }
                } catch (e) {
                    $('#report_param_loader').removeClass('sk-loading');
                    swal('', 'An error encountered. Please try again later or contact administrator with the error code : DPRAPPUIJSNER10001', 'info');
                    return false;
                }
            }
        });
    }
</script>