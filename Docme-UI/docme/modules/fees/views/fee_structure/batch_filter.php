<?php $batch_image = base_url('assets/img/ebatch.jpg'); ?>

<div class="row" id="data-view-feecode" style="padding-left:20px !important;">
    <div class="ibox-content">

        <div>
            <div class="chat-activity-list">
                <div class="col-lg-6 col-xs-8 col-md-8">
                    <div class="form-group ">
                        <label>Nationality :</label>
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
                <div class="col-lg-6 col-xs-8 col-md-8">
                    <div class="form-group ">
                        <label>Gender :</label>
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
                <div class="chat-element">
                    <a href="#" class="pull-left">
                        <img alt="image" style="width:85px;" src="<?php echo $batch_image; ?>">
                    </a>
                    <div class="media-body ">
                        <small class="pull-right text-navy">Go</small>
                        <strong>Batch</strong>
                        <p class="m-b-xs">
                            KG1/A/CBS/FN/ENG/2017
                        </p>
                        <small class="text-muted">Total students - 857</small>
                    </div>
                </div>
                <div class="chat-element">
                    <a href="#" class="pull-left">
                        <img alt="image" style="width:85px;" src="<?php echo $batch_image; ?>">
                    </a>
                    <div class="media-body ">
                        <small class="pull-right text-navy">Go</small>
                        <strong>Batch</strong>
                        <p class="m-b-xs">
                            KG1/A/CBS/FN/ENG/2017
                        </p>
                        <small class="text-muted">Total students - 857</small>
                    </div>
                </div>
                <div class="chat-element">
                    <a href="#" class="pull-left">
                        <img alt="image" style="width:85px;" src="<?php echo $batch_image; ?>">
                    </a>
                    <div class="media-body ">
                        <small class="pull-right text-navy">Go</small>
                        <strong>Batch</strong>
                        <p class="m-b-xs">
                            KG1/A/CBS/FN/ENG/2017
                        </p>
                        <small class="text-muted">Total students - 857</small>
                    </div>
                </div>
                <div class="chat-element">
                    <a href="#" class="pull-left">
                        <img alt="image" style="width:85px;" src="<?php echo $batch_image; ?>">
                    </a>
                    <div class="media-body ">
                        <small class="pull-right text-navy">Go</small>
                        <strong>Batch</strong>
                        <p class="m-b-xs">
                            KG1/A/CBS/FN/ENG/2017
                        </p>
                        <small class="text-muted">Total students - 857</small>
                    </div>
                </div>
                <div class="chat-element">
                    <a href="#" class="pull-left">
                        <img alt="image" style="width:85px;" src="<?php echo $batch_image; ?>">
                    </a>
                    <div class="media-body ">
                        <small class="pull-right text-navy">Go</small>
                        <strong>Batch</strong>
                        <p class="m-b-xs">
                            KG1/A/CBS/FN/ENG/2017
                        </p>
                        <small class="text-muted">Total students - 857</small>
                    </div>
                </div>




            </div>
        </div>

    </div>
</div>
<script src="<?php echo base_url('assets/theme/js/inspinia.js'); ?>"></script>

<script type="text/javascript">
    $("#close_button").hide();
    var input = document.getElementById("searchname");
    input.addEventListener("keyup", function(event) {
        event.preventDefault();
        if (event.keyCode === 13) {
            document.getElementById("search_name_btn").click();
        }

    });
    var input = document.getElementById("sname");
    input.addEventListener("keyup", function(event) {
        event.preventDefault();
        if (event.keyCode === 13) {
            document.getElementById("btn_id_2").click();
        }

    });

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

    function search_name() {
        $("#close_button").show();
        var searchname = $('#searchname').val();
        if (searchname.length < 3) {
            swal('', 'Enter atleast three character ', 'info');
            return false;
        }
        var ops_url = baseurl + 'bill/search-studentname';
        $.ajax({
            type: "POST",
            cache: false,
            async: false,
            url: ops_url,
            data: {
                "load": 1,
                "searchname": searchname
            },
            success: function(result) {
                var data = JSON.parse(result)
                if (data.status == 1) {
                    $('#student-data-container').html('');
                    $('#student-data-container').html(data.view);

                    $('#advanced_search_h').html('');
                    $('#advanced_search').html('');

                    //                    var animation = "fadeInDown";
                    //                    $("#student-data-container").show();
                    //                    $('#student-data-container').addClass('animated');
                    //                    $('#student-data-container').addClass(animation);
                    //                    $('#add_type').hide();
                } else {
                    alert('No data loaded');
                }
            }
        });
    }

    function searchadvance_filtername() {
        $("#close_button").show();
        var searchname = $('#sname').val();
        //        alert(searchname);
        var class_id = $('#class_id').val();
        var batch_id = $('#batch_id').val();
        var stream_id = $('#stream_id').val();
        var academic_year = $('#academic_year').val();
        var stream_id = $('#stream_id').val();
        if (class_id == -1) {
            swal('', 'Class is required.', 'info');
            return false;
        }
        var ops_url = baseurl + 'bill/advancesearch-studentname';
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
                "academic_year": academic_year
            },
            success: function(result) {
                var data = JSON.parse(result)
                if (data.status == 1) {
                    $('#student-data-container').html('');
                    $('#student-data-container').html(data.view);
                    var animation = "fadeInDown";
                    $("#student-data-container").show();
                    $('#student-data-container').addClass('animated');
                    $('#student-data-container').addClass(animation);
                    $('#admission_div').html('');
                    $('#admission_div_h').html('');

                } else {
                    alert('No data loaded');
                }
            }
        });
    }

    function changed_class1111() {
        //        var nationality = $("#country_select :selected").data('nationality');
        var class_id = $('#class_id').val();
        //        $('#nationality').val(nationality);
        var ops_url = baseurl + 'substore/get-bill-batchdetails/';
        $.ajax({
            type: "POST",
            cache: false,
            async: false,
            url: ops_url,
            data: {
                "class_id": class_id
            },
            success: function(result) {
                $('#class_id').empty().trigger("change");
                $('#batch_select').empty().trigger("change");
                var data = JSON.parse(result);
                if (data.status == 1) {
                    var batch_data = data.data;
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

    function changed_class() {
        var academic_year = $('#academic_year').val();
        var stream_id = $('#stream_id').val();
        var session_id = $('#session_id').val();
        var class_id = $('#class_id').val();
        //        var class_data = JSON.stringify(class_id);
        var ops_url = baseurl + 'substore/get-bill-batchdetails/';
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