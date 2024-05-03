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
                        echo form_open('report/stud-strengthrpt');
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
                        </div>
                        <div class="row">
                            <div class="col-lg-8" id="form_data">
                                <div class="checkbox checkbox-success">
                                    <input id="checkbox1" type="checkbox">
                                    <label for="checkbox1">
                                        &nbsp;From Date:</label>
                                </div>
                                <div class="form-group" id="data_1">
                                    <div class="input-group date">
                                        <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                        <input type="text" class="form-control" name="frmdt" id="frmdt" value="" disabled />
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-8" id="form_data">
                                <div class="checkbox checkbox-success">
                                    <input id="checkbox2" type="checkbox">
                                    <label for="checkbox2">
                                        &nbsp;To Date:</label>
                                </div>
                                <div class="form-group" id="data_1">
                                    <div class="input-group date">
                                        <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                        <input type="text" class="form-control" name="todt" id="todt" value="" disabled />
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6" align="center">
                                <a href="javascript:void(0);" class="btn btn-primary btn-sm" onclick="submit_data('<?php echo $acdyr['Acd_ID']  ?>');"> Submit</a>
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
    $('#checkbox1').change(function() {
        if ($('#checkbox1').is(":checked")) {
            $('#frmdt').attr('disabled', false);
        } else {
            $('#frmdt').attr('disabled', true);
            $('#frmdt').val('');
        }
    });
    $('#checkbox2').change(function() {
        if ($('#checkbox2').is(":checked")) {
            $('#todt').attr('disabled', false);
        } else {
            $('#todt').attr('disabled', true);
            $('#todt').val('');
        }
    });

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


    function canceldata() {
        $('#acd_year').select2('val', -1);
        $('#todt').attr('disabled', true);
        $('#frmdt').attr('disabled', true);
        $('#checkbox1').prop('checked', false);
        $('#checkbox2').prop('checked', false);
        $('#frmdt').val('');
        $('#todt').val('');
    }

    function submit_data(Acd_ID) {

        var Acd_ID = $('#acd_year').val();
        var frmdt = moment($('#frmdt').val()).format('YYYY-MM-DD');
        var todt = moment($('#todt').val()).format('YYYY-MM-DD');

        //        if (frmdt != "") {
        //            if (todt == "") {
        //                swal('', 'Enter To Date');
        //                return;
        //            }
        //        } else if (todt != "") {
        //            if (frmdt == "") {
        //                swal('','Enter From Date');
        //                return;
        //            }
        //        }
        //        if (frmdt == NULL || todt == NULL) {
        //            swal('','Enter valid Date');
        //            return;
        //        } else if (frmdt > todt) {
        //            swal('','To Date should be greater than From Date');
        //            return;
        //        }


        var ops_url = baseurl + 'report/stud-strengthrpt';
        $.ajax({
            type: "POST",
            cache: false,
            async: false,
            url: ops_url,
            data: {
                "load": 1,
                "acd_year": Acd_ID,
                "frmdt": frmdt,
                "todt": todt
            },
            success: function(data) {
                window.open(data, '_blank');
            }
        });
    }
</script>