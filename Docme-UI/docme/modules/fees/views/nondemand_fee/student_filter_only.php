<div class="wrapper wrapper-content animated fadeInRight" style="padding: 1px 0 0 0 !important;">
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title" style="border-bottom-color:#ffd300 !important;">
                    <h5>Select Class</h5>
                </div>
                <div class="ibox-content no-padding11" id="faculty_loader" style="padding-bottom: 1px;">
                    <div class="row no-margins11">
                        <input type="hidden" value="<?php echo $feecode ?>" id="feecode_sel" name="feecode_sel">
                        <input type="hidden" value="<?php echo $feename ?>" id="feename_sel" name="feename_sel">
                        <input type="hidden" value="<?php echo $feedata ?>" id="feedata_sel" name="feedata_sel">
                        <div class="col-md-12">
                            <div class="row clearfix" style="padding-top: 10px;">
                                <div class="col-lg-12">
                                    <input type="hidden" value="<?php echo $feedata ?>" id="feedata_sel" name="feedata_sel">
                                    <?php //dev_export(explode('*', $studdata));
                                    $feedatadetails = explode('*', $feedata);
                                    ?>
                                    <table class="table table-bordered margin bottom" id="available_cheque_for_reconcile">
                                        <thead>
                                            <tr>
                                                <th>Fee Code</th>
                                                <th>Description</th>
                                                <th>Fee Type</th>
                                                <th style="text-align: center;">Tax</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td style="vertical-align:middle;"><?php echo $feedatadetails[0]; ?></td>
                                                <td style="vertical-align:middle;"><?php echo $feedatadetails[1]; ?></td>
                                                <td style="vertical-align:middle;"><?php echo $feedatadetails[2]; ?></td>
                                                <td style="vertical-align:middle; text-align:center;"><?php echo $feedatadetails[3]; ?>%</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row" id="batch_div_class">
                        <div class="col-md-12">
                            <h3 id="batch_div_h">Search By Class Name
                                <hr>
                            </h3>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Class Name </label>
                                <div class="form-line">
                                    <div class="input-group">
                                        <select class="select2_registration form-control" id="batch_code1" name="batch_code1">
                                            <option selected value="-1">Select </option>
                                            <?php
                                            if (isset($batch_data) && !empty($batch_data)) {
                                                foreach ($batch_data as $batch) {
                                                    echo '<option academic_year="' . $batch['Acd_Year'] . '" stream_id="' . $batch['Stream_ID'] . '" class_id="' . $batch['Class_Det_ID'] . '" value="' . $batch['BatchID'] . '">' . $batch['batch_code'] . '</option>';
                                                }
                                            }
                                            ?>
                                        </select>
                                        <span class="input-group-btn">
                                            <a title="Search" id="search_batch_btn" class="btn btn-primary" onclick="search_by_batch_class();"><i class="fa fa-search"></i></a>
                                            <a title="Show Advanced Options" id="show_advanced_filter_btn_c" class="btn btn-warning show_advanced_filter_btn_c" style="margin-left: 10px;border-radius: 5px;"><i class="fa fa-filter"></i></a>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="advanced_search_class" class="row">
                        <div class="col-lg-6 col-xs-12 col-md-12">
                            <div class="form-group ">
                                <label>Academic Year :</label>
                                <select onchange="changed_class();" class="select2_registration form-control" id="academic_year1" name="academic_year" style="width: 100%" onchange="load_batch_data();">
                                    <?php
                                    if (isset($acdyr_data) && !empty($acdyr_data)) {
                                        foreach ($acdyr_data as $acd) {

                                            if (isset($acd['Acd_ID']) && !empty($acd['Acd_ID']) && $this->session->userdata('acd_year') == $acd['Acd_ID']) {
                                                echo '<option selected value="' . $acd['Acd_ID'] . '" data-fromyear="' . $acd['From_Year'] . '" data-toyear="' . $acd['To_Year'] . '" >' . $acd['Description'] . '</option>';
                                            }
                                            // else {
                                            //     echo '<option value="' . $acd['Acd_ID'] . '" data-fromyear="' . $acd['From_Year'] . '" data-toyear="' . $acd['To_Year'] . '" >' . $acd['Description'] . '</option>';
                                            // }
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

                                <select name="stream_id" id="stream_id1" class="form-control " style="width:100%;">
                                    <!-- onchange="changed_class();" -->

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

                                <select name="class_id" id="class_id1" class="form-control " style="width:100%;" onchange="changed_class1();">
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
                                <label>Batch </label>
                                <div>
                                    <select class="select2_registration form-control" id="batch_id1" name="batch_id" style="width:100%;">
                                        <option selected value="-1">Select </option>
                                        <?php
                                        //                                if (isset($batch_data) && !empty($batch_data)) {
                                        //                                    echo '<option selected value="-1">All Selected</option>';
                                        //                                    foreach ($batch_data as $batch) {
                                        //                                        echo '<option value="' . $batch['BatchID'] . '">' . $batch['Batch_Name'] . '</option>';
                                        //                                    }
                                        //                                }
                                        ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <div class="form-line">
                                    <div class="input-group">
                                        <a title="Search" id="btn_id_2" class="btn btn-md btn-primary pull-right" onclick="searchadvance_filterclass();"><i class="fa fa-search"> Search</i>
                                        </a> </span></div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div id="class-data-container" style="margin-top: 15px;"></div>
<script type="text/javascript">
    $("#advanced_search_class").hide();
    $('#batch_code1').select2({
        'theme': 'bootstrap'
    });
    $('body').on('click', '.show_advanced_filter_btn_c', function() {
        $(this).removeClass('show_advanced_filter_btn_c').addClass('hide_advanced_filter_btn_c').attr('title', 'Hide Advanced Options');
        $("#advanced_search_class").show('slow');
    });
    $('body').on('click', '.hide_advanced_filter_btn_c', function() {
        $(this).removeClass('hide_advanced_filter_btn_c').addClass('show_advanced_filter_btn_c').attr('title', 'Show Advanced Options');
        $("#advanced_search_class").hide('slow');
    });
    $('#academic_year1').select2({
        'theme': 'bootstrap'
    });
    $('#stream_id1').select2({
        'theme': 'bootstrap'
    });
    $('#class_id1').select2({
        'theme': 'bootstrap'
    });
    $('#batch_id1').select2({
        'theme': 'bootstrap'
    });

    function searchadvance_filterclass() {
        var feedata_sel = $('#feedata_sel').val();
        var class_id1 = $('#class_id1').val();
        var batch_id1 = $('#batch_id1').val();
        var stream_id1 = $('#stream_id1').val();
        var academic_year1 = $('#academic_year1').val();
        var stream_id1 = $('#stream_id1').val();
        if (stream_id1 == -1) {
            swal('', 'Stream Required.', 'info');
            return false;
        } else if (class_id1 == -1) {
            swal('', 'Class Required.', 'info');
            return false;
        } else {
            $("#close_button").show();
            var ops_url = baseurl + 'fees/advancesearch-studentname-for-non-demand';
            $.ajax({
                type: "POST",
                cache: false,
                async: false,
                url: ops_url,
                //            data: {"load": 1, "searchname": searchname},
                data: {
                    "load": 1,
                    "stream_id": stream_id1,
                    "batch_id": batch_id1,
                    "class_id": class_id1,
                    "academic_year": academic_year1,
                    "type": "class_demand",
                    "feedata": feedata_sel
                },
                success: function(result) {
                    var data = JSON.parse(result)
                    if (data.status == 1) {
                        $('#class-data-container').html('');
                        $('#class-data-container').html(data.view);
                        $('html, body').animate({
                            scrollTop: $("#class-data-container").offset().top
                        }, 1000);
                        var animation = "fadeInDown";
                        $("#class-data-container").show();
                        $('#class-data-container').addClass('animated');
                        $('#class-data-container').addClass(animation);
                        $('#admission_div').html('');
                        $('#batch_div_class').html('');

                    } else {
                        alert('No data loaded');
                    }
                }
            });
        }
    }

    function search_by_batch_class() {
        var feecode_sel = $('#feecode_sel').val();
        var feedata_sel = $('#feedata_sel').val();
        var batch_id1 = $("#batch_code1 option:selected").val(); //$("#w3s").attr("href")

        //var class_id = $('#batch_code').attr("class_id"); 
        var class_id1 = $("#batch_code1 option:selected").attr("class_id");
        var stream_id1 = $("#batch_code1 option:selected").attr("stream_id");
        var academic_year1 = $("#batch_code1 option:selected").attr("academic_year");
        var searchname1 = '';
        if (batch_id1 == -1) {
            swal('', 'Select Class Name.', 'info');
            return false;
        } else {
            $("#close_button").show();
            //$("#show_advanced_filter_btn_c").hide();
            var ops_url = baseurl + 'fees/advancesearch-studentname-for-non-demand';
            $.ajax({
                type: "POST",
                cache: false,
                async: false,
                url: ops_url,
                //            data: {"load": 1, "searchname": searchname},
                data: {
                    "load": 1,
                    "stream_id": stream_id1,
                    "batch_id": batch_id1,
                    "class_id": class_id1,
                    "academic_year": academic_year1,
                    "type": "class_demand",
                    "feedata": feedata_sel,
                    "feecode_sel": feecode_sel
                },
                success: function(result) {
                    var data = JSON.parse(result)
                    if (data.status == 1) {
                        $('#class-data-container').html('');
                        $('#class-data-container').html(data.view);
                        $('html, body').animate({
                            scrollTop: $("#class-data-container").offset().top
                        }, 1000);
                        var animation = "fadeInDown";
                        $("#class-data-container").show();
                        $('#class-data-container').addClass('animated');
                        $('#class-data-container').addClass(animation);
                        $('#admission_div').html('');
                        //$('#advanced_search').html('');

                    } else {
                        alert('No data loaded');
                    }
                }
            });
        }
        //});

    }

    function changed_class1() {
        var academic_year = $('#academic_year1').val();
        var stream_id = $('#stream_id1').val();
        var session_id = $('#session_id1').val();
        var class_id = $('#class_id1').val();
        //        var class_data = JSON.stringify(class_id);
        var ops_url = baseurl + 'fees/get-batchdetails-for-non-demand/';
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
                    $('#batch_id1').empty().trigger("change");
                    var bit = 0;
                    $.each(batchdata, function(i, v) {
                        bit = bit + 1;
                        $('#batch_id1').append("<option value='" + v.BatchID + "' bitdata-data ='" + bit + "' >" + v.Batch_Name + "</option>");
                    });
                    $('#batch_id1').trigger('change');
                } else {
                    $('#batch_id1').empty().trigger("change");
                }
            }
        });
    }
</script>