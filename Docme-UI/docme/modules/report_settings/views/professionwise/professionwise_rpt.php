<div class="wrapper wrapper-content animated fadeInRight" style="padding-top: 1px !important;padding-left: 0px !important;padding-right: 0px !important;">
    <div class="row" style="margin-left: -29px !important; margin-right: -30px !important;">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5><?php echo isset($sub_title) ? $sub_title : "NO TITLE PROVIDED" ?></h5>

                </div>
                <div class="ibox-content" id="Rptreligion_loader">
                    <div class="sk-spinner sk-spinner-wave">
                        <div class="sk-rect1"></div>
                        <div class="sk-rect2"></div>
                        <div class="sk-rect3"></div>
                        <div class="sk-rect4"></div>
                        <div class="sk-rect5"></div>
                    </div>
                    <div class="body">
                        <?php
                        echo form_open('report/stud-religionwisepdf');
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
                            <div class="col-lg-6">
                                <div class="form-group <?php
                                                        if (form_error('religion_select')) {
                                                            echo 'has-error';
                                                        }
                                                        ?>">
                                    <label>Profession</label><span class="mandatory"> *</span><br />

                                    <select name="religion_select" id="religion_select" class="form-control" style="width:100%;">

                                        <option selected value="-1">Select</option>
                                        <?php
                                        if (isset($profession_data) && !empty($profession_data)) {
                                            foreach ($profession_data as $profession) {
                                                if (isset($religion_selected) && !empty($religion_selected) && $religion_selected == $profession['profession_id']) {
                                                    echo '<option selected value = "' . $profession['profession_id'] . '" >' . $profession['profession_name'] . "</option>";
                                                } else {
                                                    echo '<option value = "' . $profession['profession_id'] . '" >' . $profession['profession_name'] . "</option>";
                                                }
                                            }
                                        }
                                        ?>
                                    </select>
                                    <?php echo form_error('religion_select', '<div class="form-error">', '</div>'); ?>
                                </div>
                            </div>
                        </div>




                        <div class="row">
                            <div class="col-md-6">
                                <a href="javascript:void(0);" class="btn btn-primary btn-sm" onclick="submit_data('<?php echo $acdyr['Acd_ID']  ?>','<?php echo $profession['profession_name']  ?>');"> Report</a>
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
    $('#acd_year').select2({
        'theme': 'bootstrap'
    });
    $('#religion_select').select2({
        'theme': 'bootstrap'
    });

    function submit_data(Acd_ID) {
        $('#Rptreligion_loader').addClass('sk-loading');
        var Acd_ID = $('#acd_year').val();
        var religion_data = $('#religion_select').val();
        var religion_ID = $('#religion_select option:selected').text();

        if (Acd_ID == -1) {
            swal('', 'Academic Year is required.', 'info');
            $('#Rptreligion_loader').removeClass('sk-loading');
            return;
        }
        if (religion_data == -1) {
            swal('', 'Profession is required.', 'info');
            $('#Rptreligion_loader').removeClass('sk-loading');
            return;
        }

        var ops_url = baseurl + 'report/show-professionwiserptpdf';
        $.ajax({
            type: "POST",
            cache: false,
            // async: false,
            url: ops_url,
            data: {
                "load": 1,
                "acd_year": Acd_ID,
                "profession_select": religion_data
            },
            success: function(data) {
                try {
                    var datas = JSON.parse(data);
                    if (datas.status == 1) {
                        window.open(datas.message, '_blank');
                        $('#Rptreligion_loader').removeClass('sk-loading');
                    } else {
                        if (datas.status == 3) {
                            if (datas.message) {
                                swal('', datas.message, 'info');
                                $('#Rptreligion_loader').removeClass('sk-loading');
                                return false;
                            } else {
                                $('#Rptreligion_loader').removeClass('sk-loading');
                                swal('', 'No Reports Available', 'info')
                            }
                        }
                    }
                } catch (e) {
                    $('#Rptreligion_loader').removeClass('sk-loading');
                    swal('', 'An error encountered. Please try again later or contact administrator with the error code : DPRAPPUIJSNER10001', 'info');
                    return false;
                }
            }
        });
    }


    function canceldata() {
        $('#acd_year').select2('val', -1);
        $('#religion_select').select2('val', -1);

    }
</script>