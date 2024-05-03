<div class="wrapper wrapper-content animated fadeInRight" style="padding-top: 1px !important;padding-left: 0px !important;padding-right: 0px !important;">
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title" style="border-bottom-color:#ffd300 !important;">
                    <h5><?php echo isset($sub_title) ? $sub_title : "Arrear Alert" ?></h5>
                    <div class="ibox-tools" id="add_type">
                        <a href="javascript:void(0)" onclick="load_arrear_filter_account();" id="close_button" data-toggle="tooltip" title="Back to Filter" style="float: right; color: #B22222;"><i class="fa fa-backward"></i></a>
                    </div>
                </div>
                <div class="ibox-content">
                    <div class="row" id="admission_div">
                        <div class="col-md-12">
                            <h3 id="admission_div_h">Student Direct Search For Getting Account Details
                                <hr>
                            </h3>
                            <div class="form-group">
                                <label>Admission No. / Student Name </label>
                                <div class="form-line">
                                    <div class="input-group"><input type="text" id="searchname" name="searchname" placeholder="Enter Admission No. / Student Name" class="form-control admnNumberCheck"> <span class="input-group-btn">
                                            <button title="Search" type="button" id="search_name_btn" class="btn btn-primary" onclick="search_name();"><i class="fa fa-search"></i> </button> </span>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>

                    <div class="row" id="batch_div">
                        <div class="col-md-12">
                            <h3 id="batch_div_h">Search By Class
                                <hr>
                            </h3>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Class </label>
                                <div class="form-line">
                                    <div class="input-group">
                                        <select class="select2_registration form-control" id="batch_code" name="batch_code">
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
                                            <a title="Search" id="search_batch_btn" class="btn btn-primary" onclick="search_by_batch();"><i class="fa fa-search"></i></a>
                                            <a title="Show Advanced Options" id="show_advanced_filter_btn" class="btn btn-warning show_advanced_filter_btn" style="margin-left: 10px;border-radius: 5px;"><i class="fa fa-filter"></i></a>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div id="advanced_search" class="row">
                        <div class="col-md-12">
                            <h3 id="advanced_search_h">Student Advanced Search
                                <hr>
                            </h3>
                        </div>
                        <div class="col-lg-6 col-xs-12 col-md-12">
                            <div class="form-group ">
                                <label>Academic Year </label>
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
                                <label>Course</label><span class="mandatory"> *</span><br />

                                <select name="stream_id" id="stream_id" class="form-control " style="width:100%;" onchange="list_class_based_on_stream();">
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

                                <select name="class_id" id="class_id" class="form-control " style="width:100%;" onchange="changed_class();">
                                    <option selected value="-1">Select</option>
                                </select>
                                <?php echo form_error('class_id', '<div class="form-error">', '</div>'); ?>
                            </div>
                        </div>
                        <div class="col-lg-6 col-xs-12 col-md-12">
                            <div class="form-group">
                                <label>Batch</label>
                                <select class="select2_registration form-control" id="batch_id" name="batch_id" style="width:100%;">
                                    <option selected value="-1">Select </option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Student Name</label>
                                <div class="form-line">
                                    <div class="input-group"><input type="text" placeholder="Enter Student Name" id="sname" name="sname" class="form-control alpha max50"> <span class="input-group-btn">
                                            <button title="Search" id="btn_id_2" type="button" class="btn btn-primary" onclick="searchadvance_filtername();"><i class="fa fa-search"></i>
                                            </button> </span></div>
                                </div>
                            </div>

                        </div>
                    </div>
                    <input type="hidden"  name="function_name_for_reload" id="function_name_for_reload">

                    <div class="row" id="student-data-container"></div>

                </div>
            </div>
        </div>
    </div>
</div>


<script type="text/javascript">
    $("#close_button").hide();
    $("#advanced_search").hide();
    $('body').on('click', '.show_advanced_filter_btn', function() {
        $(this).removeClass('show_advanced_filter_btn').addClass('hide_advanced_filter_btn').attr('title', 'Hide Advanced Options');
        $("#advanced_search").show('slow');
    });
    $('body').on('click', '.hide_advanced_filter_btn', function() {
        $(this).removeClass('hide_advanced_filter_btn').addClass('show_advanced_filter_btn').attr('title', 'Show Advanced Options');
        $("#advanced_search").hide('slow');
    });

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
    $('#batch_code').select2({
        'theme': 'bootstrap'
    });

    function search_name() {
        $('#function_name_for_reload').val("");
        $('#function_name_for_reload').val("search_name");
        var searchname = $('#searchname').val();
        if (searchname.length < 3) {
            swal('', 'Enter atleast three characters.', 'info');
            $('#student-data-container').html('');
            return false;
        } else {
            $("#close_button").show();
            var ops_url = baseurl + 'notification/search-studentname-for-account';
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

                        $('#batch_div').html('');
                        $('#advanced_search').html('');
                    } else {
                        alert('No data loaded');
                    }
                }
            });
        }
    }

    function search_by_batch() {
        $('#function_name_for_reload').val("");
        $('#function_name_for_reload').val("search_by_batch");
        var batch_id = $("#batch_code option:selected").val(); //$("#w3s").attr("href")

        //var class_id = $('#batch_code').attr("class_id"); 
        var class_id = $("#batch_code option:selected").attr("class_id");
        var stream_id = $("#batch_code option:selected").attr("stream_id");
        var academic_year = $("#batch_code option:selected").attr("academic_year");
        var searchname = '';
        if (batch_id == -1) {
            swal('', 'Select Class.', 'info');
            return false;
        } else {
            $("#close_button").show();
            var ops_url = baseurl + 'notification/advancesearch-studentname-for-account';
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
                        //$('#advanced_search').html('');

                    } else {
                        alert('No data loaded');
                    }
                }
            });
        }
        //});

    }

    function searchadvance_filtername() {
        $('#function_name_for_reload').val("");
        $('#function_name_for_reload').val("searchadvance_filtername");
        var searchname = $('#sname').val();
        //        alert(searchname);
        var class_id = $('#class_id').val();
        var batch_id = $('#batch_id').val();
        var stream_id = $('#stream_id').val();
        var academic_year = $('#academic_year').val();
        var stream_id = $('#stream_id').val();
        if (stream_id == -1) {
            swal('', 'Stream is required.', 'info');
            return false;
        } else if (class_id == -1) {
            swal('', 'Class is required.', 'info');
            return false;
        } else {
            $("#close_button").show();
            var ops_url = baseurl + 'notification/advancesearch-studentname-for-account';
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
                        $('#batch_div').html('');

                    } else {
                        alert('No data loaded');
                    }
                }
            });
        }
    }

    function changed_class() {
        var academic_year = $('#academic_year').val();
        var stream_id = $('#stream_id').val();
        var session_id = $('#session_id').val();
        var class_id = $('#class_id').val();
        //        var class_data = JSON.stringify(class_id);
        if (class_id == -1) {
            $('#batch_id').empty().trigger("change");
            var bit = 0;
            $('#batch_id').append("<option value='-1' selected>Select</option>");
            $('#batch_id').trigger('change');
        } else {
            var ops_url = baseurl + 'notification/get-batchdetails-for-account/';
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
    }

    function list_class_based_on_stream() {
        var academic_year = $('#academic_year').val();
        var stream_id = $('#stream_id').val();
        var session_id = $('#session_id').val();
        var class_id = $('#class_id').val();
        if (stream_id == -1) {
            $('#batch_id').empty().trigger("change");
            var bit = 0;
            $('#batch_id').append("<option value='-1' selected>Select</option>");
            $('#batch_id').trigger('change');

            $('#class_id').empty().trigger("change");
            var bit = 0;
            $('#class_id').append("<option value='-1' selected>Select</option>");
            $('#class_id').trigger('change');
        } else {
            //        var class_data = JSON.stringify(class_id);
            var ops_url = baseurl + 'notification/list_class_based_on_stream';
            $.ajax({
                type: "POST",
                cache: false,
                async: false,
                url: ops_url,
                data: {
                    "stream_id": stream_id,
                    "academic_year": academic_year,
                    "session_id": session_id
                },
                success: function(result) {
                    $('#batch_id').empty().trigger("change");
                    var data = JSON.parse(result);
                    if (data.status == 1) {
                        var classdata = data.data;
                        $('#class_id').empty().trigger("change");
                        var bit = 0;
                        $('#class_id').append("<option value='-1'>Select</option>");
                        $.each(classdata, function(i, v) {
                            bit = bit + 1;
                            $('#class_id').append("<option value='" + v.Course_Det_ID + "' bitdata-data ='" + bit + "' >" + v.Description + "</option>");
                        });
                        $('#class_id').trigger('change');
                    } else {
                        $('#class_id').empty().trigger("change");
                    }
                }
            });
        }
    }
    
</script>