<?php $batch_image = base_url('assets/img/classimgs.jpg'); ?>
<?php $class_image = base_url('assets/img/Class.jpg'); ?>

<div class="row" id="data-view-feecode" style="padding-left:20px !important;">
    <div class="ibox-content">

        <div>
            <div class="chat-activity-list">

                <div class="chat-element">
                    <div class="row clearfix">
                        <div class="col-lg-6">
                            <div class="form-group <?php
                                                    if (form_error('nationality')) {
                                                        echo 'has-error';
                                                    }
                                                    ?>">
                                <label>Nationality</label><span class="mandatory"> *</span><br />

                                <select name="nationality" id="nationality" class="form-control " style="width:100%;">

                                    <option selected value="-1">Select</option>
                                    <?php
                                    //                                if (isset($currency_data) && !empty($currency_data)) {
                                    //                                    foreach ($currency_data as $currency) {
                                    //                                        echo '<option value ="' . $currency['currency_id'] . '">' . $currency['currency_name'] . '</option>';
                                    //                                    }
                                    //                                }
                                    ?>
                                </select>
                                <?php echo form_error('nationality', '<div class="form-error">', '</div>'); ?>
                            </div>
                        </div>

                        <div class="col-lg-6 col-md-6 col-xs-12 col-sm-12">
                            <!--<div class="col-lg-6">-->
                            <div class="form-group <?php
                                                    if (form_error('gender_select')) {
                                                        echo 'has-error';
                                                    }
                                                    ?>">
                                <label>Gender</label><span class="mandatory"> *</span><br />

                                <select name="gender_select" id="gender_select" class="form-control " style="width:100%;">

                                    <option selected value="-1">Select</option>
                                    <?php
                                    //                                if (isset($currency_data) && !empty($currency_data)) {
                                    //                                    foreach ($currency_data as $currency) {
                                    //                                        echo '<option value ="' . $currency['currency_id'] . '">' . $currency['currency_name'] . '</option>';
                                    //                                    }
                                    //                                }
                                    ?>
                                </select>
                                <?php echo form_error('gender_select', '<div class="form-error">', '</div>'); ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="ibox-tools" id="add_type" style="padding-top:10px!important;">
                <a data-toggle="modal" class="btn btn-primary btn-xs" data-toggle="tooltip" title="Select All Class" data-placement="left" href="javascript:void(0)" onclick="add_new_account_code();">Select All</a>
                <a data-toggle="modal" class="btn btn-primary btn-xs" data-toggle="tooltip" title="Select All Class" data-placement="left" href="javascript:void(0)" onclick="add_new_account_code();">Remove All</a>
            </div>
            <!--<div class="row clearfix">-->
            <div class="col-lg-6 col-md-6 col-xs-12 col-sm-12">
                <div class="chat-element" style="margin: 11px;">
                    <!--                        <a href="#" class="pull-left">
                            <img alt="image" style="width:45px;" src="<?php echo $batch_image; ?>">
                        </a>-->
                    <div class="i-checks pull-right" <label>
                        <!--                                whole class-->
                        <input data-toggle="tooltip" data-placement="right" class="data_part" data-confirmid="<?php // echo $subject_data['subject_id'];   
                                                                                                                ?>" type="checkbox" value="" checked="">



                        </label>
                    </div>
                    <div class="media-body ">

                        <!--<small class="pull-right text-navy">Go</small>-->
                        <strong>First</strong>
                        <p></p>
                        <small class="text-muted">Total students - 857</small>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-md-6 col-xs-12 col-sm-12">
                <div class="chat-element" style="margin: 11px;">
                    <!--                        <a href="#" class="pull-left">
                            <img alt="image" style="width:45px;" src="<?php echo $batch_image; ?>">
                        </a>-->
                    <div class="media-body ">
                        <div class="i-checks pull-right" <label>

                            <input data-toggle="tooltip" data-placement="right" class="data_part" data-confirmid="<?php // echo $subject_data['subject_id'];   
                                                                                                                    ?>" type="checkbox" value="" checked="">



                            </label>
                        </div>
                        <strong>Second</strong>
                        <p></p>
                        <small class="text-muted">Total students - 857</small>
                    </div>
                </div>
            </div>

        </div>
        <div class="col-lg-6 col-md-6 col-xs-12 col-sm-12">
            <div class="chat-element" style="margin: 11px;">
                <!--                    <a href="#" class="pull-left">
                        <img alt="image" style="width:45px;" src="<?php echo $batch_image; ?>">
                    </a>-->
                <div class="media-body ">
                    <div class="i-checks pull-right" <label>

                        <input data-toggle="tooltip" data-placement="right" class="data_part" data-confirmid="<?php // echo $subject_data['subject_id'];   
                                                                                                                ?>" type="checkbox" value="">



                        </label>
                    </div>
                    <strong>Third</strong>
                    <p class="m-b-xs">

                    </p>
                    <small class="text-muted">Total students - 857</small>
                </div>
            </div>
        </div>
        <div class="col-lg-6 col-md-6 col-xs-12 col-sm-12">

            <div class="chat-element" style="margin: 11px;">
                <!--                    <a href="#" class="pull-left">
                        <img alt="image" style="width:45px;" src="<?php echo $batch_image; ?>">
                    </a>-->
                <div class="media-body ">
                    <div class="i-checks pull-right" <label>

                        <input data-toggle="tooltip" data-placement="right" title="check for whole class" class="data_part" data-confirmid="<?php // echo $subject_data['subject_id'];   
                                                                                                                                            ?>" type="checkbox" value="">



                        </label>
                    </div>
                    <strong>Fourth</strong>
                    <p class="m-b-xs">

                    </p>
                    <small class="text-muted">Total students - 857</small>
                </div>
            </div>
        </div>
        <div class="col-lg-6 col-md-6 col-xs-12 col-sm-12">
            <div class="chat-element" style="margin: 11px;">
                <!--                    <a href="#" class="pull-left">
                        <img alt="image" style="width:45px;" src="<?php echo $batch_image; ?>">
                    </a>-->
                <div class="i-checks pull-right" <label>

                    <input data-toggle="tooltip" data-placement="right" class="data_part" data-confirmid="<?php // echo $subject_data['subject_id'];   
                                                                                                            ?>" type="checkbox" value="">



                    </label>
                </div>
                <div class="media-body ">

                    <strong>Fifth</strong>
                    <p class="m-b-xs">

                    </p>
                    <small class="text-muted">Total students - 857</small>
                </div>
            </div>
        </div>



    </div>

</div>
</div>

</div>
</div>
<script src="<?php echo base_url('assets/theme/js/inspinia.js'); ?>"></script>

<script type="text/javascript">
    $('#nationality').select2({
        'theme': 'bootstrap'
    });
    $('#gender_select').select2({
        'theme': 'bootstrap'
    });
    $('.i-checks').iCheck({
        checkboxClass: 'icheckbox_square-green',
        radioClass: 'iradio_square-green'
    });
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

    $('.academic_year').select2({
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