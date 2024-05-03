<div class="wrapper wrapper-content animated fadeInRight" style="padding-top: 1px !important;padding-left: 0px !important;padding-right: 0px !important;">
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title" style="border-bottom-color:#ffd300 !important;">
                    <h5><?php echo isset($sub_title) ? $sub_title : "Fee  adjustment one time" ?></h5>
                    <div class="ibox-tools" id="add_type">
                        <a href="javascript:void(0)" onclick="load_fee_student();" id="close_button" data-toggle="tooltip" title="Close" style="float: right; color: #B22222;"><i class="fa fa-close"></i></a>
                    </div>
                </div>
                <div class="ibox-content">

                    <h3 id="advanced_search_h">Student Search
                        <hr>
                    </h3>

                    <div id="advanced_search" class="row">
                        <div class="col-lg-6 col-xs-12 col-md-12">
                            <div class="form-group ">
                                <label>Academic Year :</label>
                                <select onchange="changed_class();" class="select2_registration form-control" id="academic_year" name="academic_year" style="width: 100%" onchange="load_batch_data();">
                                    <?php
                                    if (isset($acdyr_data) && !empty($acdyr_data)) {
                                        foreach ($acdyr_data as $acd) {

                                            if (isset($acd['Acd_ID']) && !empty($acd['Acd_ID']) && $this->session->userdata('acd_year') == $acd['Acd_ID']) {
                                                echo '<option selected value="' . $acd['Acd_ID'] . '" data-fromyear="' . $acd['From_Year'] . '" data-toyear="' . $acd['To_Year'] . '" >' . $acd['Description'] . '</option>';
                                            } else {
                                                echo '<option value="' . $acd['Acd_ID'] . '" data-fromyear="' . $acd['From_Year'] . '" data-toyear="' . $acd['To_Year'] . '" >' . $acd['Description'] . '</option>';
                                            }
                                            //                                                            echo '<option value="' . $acd['Acd_ID'] . '" data-fromyear="' . $acd['From_Year'] . '" data-toyear="' . $acd['To_Year'] . '" >' . $acd['Description'] . '</option>';
                                        }
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>


                        <div class="col-lg-6 col-xs-12 col-md-12">
                            <div class="form-group <?php
                                                    if (form_error('stream_id')) {
                                                        echo 'has-error';
                                                    }
                                                    ?>">
                                <label>Stream</label><span class="mandatory"> *</span><br />

                                <select name="stream_id" id="stream_id" class="form-control " style="width:100%;" onchange="changed_class();">

                                    <option selected value="-1">Select</option>
                                    <?php
                                    if (isset($stream_data) && !empty($stream_data)) {
                                        foreach ($stream_data as $stream) {
                                            //                                    if (isset($stream['stream_id']) && !empty($stream['stream_id']) && 1 == $stream['stream_id']) {
                                            //                                        echo '<option selected value="' . $stream['stream_id'] . '">' . $stream['description'] . '</option>';
                                            //                                    } else {
                                            echo '<option value="' . $stream['stream_id'] . '">' . $stream['description'] . '</option>';
                                            //}
                                        }
                                    }
                                    ?>
                                </select>
                                <?php echo form_error('stream_id', '<div class="form-error">', '</div>'); ?>
                            </div>
                        </div>
                        <div class="col-lg-6 col-xs-12 col-md-12">
                            <div class="form-group <?php
                                                    if (form_error('class_id')) {
                                                        echo 'has-error';
                                                    }
                                                    ?>">
                                <label>Class</label><span class="mandatory"> *</span><br />

                                <select name="class_id" id="class_id" class="form-control " style="width:100%;" onchange="changed_class();">
                                    <!--<select name="class_id" id="class_id"  class="form-control " style="width:100%;" >-->

                                    <option selected value="-1">Select</option>
                                    <?php
                                    if (isset($class_data_for_registration) && !empty($class_data_for_registration)) {
                                        foreach ($class_data_for_registration as $class_for_dive) {

                                            echo '<option value="' . $class_for_dive['Course_Det_ID'] . '" data-masterid="' . $class_for_dive['Course_Master_ID'] . '"  >' . $class_for_dive['Description'] . '</option>';
                                        }
                                    }
                                    ?>
                                </select>
                                <?php echo form_error('class_id', '<div class="form-error">', '</div>'); ?>
                            </div>
                        </div>
                        <div class="col-lg-6 col-xs-12 col-md-12">
                            <div class="form-group">
                                <label>Batch</label>
                                <div>
                                    <select class="select2_registration form-control" id="batch_id" name="batch_id">
                                        <?php
                                        if (isset($batch_data) && !empty($batch_data)) {
                                            echo '<option selected value="-1">All Selected</option>';
                                            foreach ($batch_data as $batch) {
                                                echo '<option value="' . $batch['BatchID'] . '">' . $batch['Batch_Name'] . '</option>';
                                            }
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">

                            <div class="form-group">
                                <div class="form-line">
                                    <div class="input-group"> <span class="input-group-btn">
                                            <button id="btn_id_2" type="button" title="Search" class="btn btn-primary" onclick="searchadvance_filtername();"><i class="fa fa-search"></i> &nbsp;Search Students
                                            </button> </span></div>
                                </div>
                            </div>

                        </div>
                    </div>

                    <div class="row" id="student-data-container"></div>

                </div>
            </div>
        </div>
    </div>
</div>


<script type="text/javascript">
    $("#close_button").hide();

    $('#academic_year').select2({
        'theme': 'bootstrap'
    });
    $('#stream_id').select2({
        'theme': 'bootstrap'
    });
    $('#class_id').select2({
        'theme': 'bootstrap'
    });
    $('#batch_id').select2({
        'theme': 'bootstrap'
    });

    function searchadvance_filtername() {
        $("#close_button").show();
        var searchname = $('#sname').val();
        var class_id = $('#class_id').val();
        var batch_id = $('#batch_id').val();
        var academic_year = $('#academic_year').val();
        var stream_id = $('#stream_id').val();
        var batch_name = $('#batch_id :selected').text();
        if (class_id == -1) {
            swal('', 'Class is required.', 'info');
            return false;
        }
        var ops_url = baseurl + 'fees/onetimecol/advancesearch-studentname-for-collection';
        $.ajax({
            type: "POST",
            cache: false,
            async: false,
            url: ops_url,
            //            data: {"load": 1, "searchname": searchname},
            data: {
                "load": 1,
                "stream_id": stream_id,
                "batch_id": batch_id,
                "searchname": searchname,
                "class_id": class_id,
                "academic_year": academic_year,
                "batch_name": batch_name
            },
            success: function(result) {
                var data = JSON.parse(result)
                if (data.status == 1) {
                    $('#data-view').html('');
                    $('#data-view').html(data.view);
                    $('html, body').animate({
                        scrollTop: 0
                    }, 1000);

                } else {
                    alert('No data loaded');
                }
            }
        });
    }

    function changed_class() {
        var academic_year = $('#academic_year').val();
        var stream_id = $('#stream_id').val();
        var session_id = $('#session_id').val();
        var class_id = $('#class_id').val();
        //        var class_data = JSON.stringify(class_id);
        var ops_url = baseurl + 'fees/onetimecol/get-batchdetails-for-collection/';
        $.ajax({
            type: "POST",
            cache: false,
            async: false,
            url: ops_url,
            data: {
                "stream_id": stream_id,
                "academic_year": academic_year,
                "session_id": session_id,
                "class_id": class_id
            },
            success: function(result) {
                $('#batch_id').empty().trigger("change");
                var data = JSON.parse(result);
                if (data.status == 1) {
                    var batchdata = data.data;
                    $('#batch_id').empty().trigger("change");
                    var bit = 0;
                    $.each(batchdata, function(i, v) {
                        bit = bit + 1;
                        $('#batch_id').append("<option value='" + v.BatchID + "' bitdata-data ='" + bit + "' >" + v.Batch_Name + "</option>");
                    });
                    $('#batch_id').trigger('change');
                } else {
                    $('#batch_id').empty().trigger("change");
                }
            }
        });
    }
</script>