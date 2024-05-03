<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of delivery_student_search
 *
 * @author chandrajith
 */
?>

<div class="row">
    <!--<div class="col-lg-12">-->
    <div class="panel panel-info">
        <div class="panel-heading">
            <i class="fa fa-info-circle"></i>Student Items Delivery Return
            <a href="javascript:void(0)" onclick="uniform_deliveryreturn();" id="close_button" data-toggle="tooltip" title="Close" style="float: right; color: #B22222;"><i class="fa fa-close"></i></a>
        </div>



        <div class="panel-body">

            <h3 id="direct_search_h">Student Direct Search
                <hr>
            </h3>
            <div class="row">

                <div class="col-md-12" id="direct_search">
                    <b>Admission No.</b>
                    <div class="form-group">
                        <div class="form-line">
                            <div class="input-group"><input type="text" id="searchname" name="searchname" placeholder="Enter Admission Number" class="form-control"> <span class="input-group-btn">
                                    <button type="button" id="button_id_1" class="btn btn-primary" onclick="uniform_search_name();"><i class="fa fa-search"></i></button> </span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12" id="voucher_search">
                    <b>Voucher No</b>
                    <div class=" input-group" style="padding-bottom: 5%;">
                        <input type="text" placeholder="Enter Voucher Number" class="input form-control" id="searchvoucher" name="searchvoucher">

                        <span class="input-group-btn">
                            <button type="button" id="button_id_2" class="btn btn btn-primary" onclick="uniform_search_voucher();"> <i class="fa fa-search"></i></button>
                            <input type="hidden" class="input form-control" id="store_idd" name="store_idd" value="<?php // echo $store_idd                     
                                                                                                                    ?>">
                        </span>
                    </div>
                </div>
            </div>
            <div class="clearfix"></div>

            <h3 id="advanced_search_h">Student Advanced Search
                <hr>
            </h3>

            <!--<div class="ibox-content">-->
            <div class="row" id="advanced_search">
                <div class="col-lg-6 col-xs-12 col-md-12">
                    <div class="form-group ">
                        <label>Academic Year</label>
                        <select onchange="uniform_changed_class();" class="select2_registration form-control" id="academic_year" name="academic_year" style="width: 100%" onchange="load_batch_data();">
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
                        <label>Stream</label><br />

                        <select name="stream_id" id="stream_id" class="form-control " style="width:100%;" onchange="uniform_changed_class();">

                            <!-- <option selected value="-1">Select</option> -->
                            <?php
                            if (isset($stream_data) && !empty($stream_data)) {
                                foreach ($stream_data as $stream) {
                                    if (isset($stream['stream_id']) && !empty($stream['stream_id']) && 1 == $stream['stream_id']) {
                                        echo '<option selected value="' . $stream['stream_id'] . '">' . $stream['description'] . '</option>';
                                    } else {
                                        echo '<option value="' . $stream['stream_id'] . '">' . $stream['description'] . '</option>';
                                    }
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
                        <label>Class</label><br />

                        <select name="class_id" id="class_id" class="form-control " style="width:100%;" onchange="uniform_changed_class();">
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
                        <label>Batch *</label>
                        <div>
                            <select class="select2_registration form-control" id="batch_id" name="batch_id">
                                <?php
                                if (isset($batch_data) && !empty($batch_data)) {
                                    echo '<option selected value="-1">Select</option>';
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
                        <label>Student Name</label>
                        <div class="form-line">
                            <div class="input-group"><input type="text" placeholder="Enter Student Name" id="sname" name="sname" class="form-control">
                                <span class="input-group-btn"> <button id="button_id_3" type="button" class="btn btn-primary" onclick="uniform_searchadvance_filtername();"> <i class="fa fa-search"></i>
                                    </button> </span></div>
                        </div>
                    </div>

                </div>
            </div>
            <div id="student-data-container"></div>
        </div>
    </div>
    <!--</div>-->
</div>



<!-- Custom and plugin javascript -->
<script src="<?php echo base_url('assets/theme/js/inspinia.js'); ?>"></script>
<script type="text/javascript">
    $("#close_button").hide();
    var input = document.getElementById("searchname");
    input.addEventListener("keyup", function(event) {
        event.preventDefault();
        if (event.keyCode === 13) {
            document.getElementById("button_id_1").click();
        }
    });
    var input = document.getElementById("searchvoucher");
    input.addEventListener("keyup", function(event) {
        event.preventDefault();
        if (event.keyCode === 13) {
            document.getElementById("button_id_2").click();
        }
    });
    var input = document.getElementById("sname");
    input.addEventListener("keyup", function(event) {
        event.preventDefault();
        if (event.keyCode === 13) {
            document.getElementById("button_id_3").click();
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

    function uniform_search_name() {
        $("#close_button").show();
        var searchname = $('#searchname').val();
        if (searchname.length < 3) {
            swal('', 'Enter atleast three character..', 'info');
            return false;
        }
        var ops_url = baseurl + 'uniform/sales/search-student-deliveryReturn';
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
                    $('#voucher_search').html('');
                    $('#advanced_search_h').html('');
                    $('#advanced_search').html('');
                    $('#student-data-container').html('');
                    $('#student-data-container').html(data.view);
                    //                                                    $('html, body').animate({
                    //                                                        scrollTop: $("#student-data-container").offset().top
                    //                                                    }, 1000);
                } else {
                    alert('No data loaded');
                }
            }
        });
    }

    function uniform_search_voucher() {
        $("#close_button").show();
        var searchvoucher = $('#searchvoucher').val();

        if (searchvoucher.length < 3) {
            swal('', 'Enter atleast three character..', 'info');
            return false;
        }
        var ops_url = baseurl + 'uniform/sales/search-voucher-deliveryReturn';
        $.ajax({
            type: "POST",
            cache: false,
            async: false,
            url: ops_url,
            data: {
                "load": 1,
                "searchvoucher": searchvoucher
            },
            success: function(result) {
                var data = JSON.parse(result)

                if (data.status == 1) {
                    $('#student-data-container').html('');
                    $('#student-data-container').html(data.view);
                    $('#direct_search').html('');
                    $('#advanced_search_h').html('');
                    $('#advanced_search').html('');
                    //                                                $('html, body').animate({
                    //                                                    scrollTop: $("#student-data-container").offset().top
                    //                                                }, 1000);
                } else {
                    alert('No data loaded');
                }
            }
        });
    }

    function uniform_searchadvance_filtername() {
        $("#close_button").show();

        var searchname = $('#sname').val();
        //        alert(searchname);
        var class_id = $('#class_id').val();
        var batch_id = $('#batch_id').val();
        var stream_id = $('#stream_id').val();
        var academic_year = $('#academic_year').val();
        var stream_id = $('#stream_id').val();

        if (batch_id == -1) {
            swal('', 'Batch is required.', 'info');
            return false;
        }


        var ops_url = baseurl + 'uniform/deliveryrtn/advancesearch-studentname';
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
                    $('#voucher_search').html('');
                    $('#direct_search_h').html('');
                    $('#direct_search').html('');

                    var animation = "fadeInDown";
                    $("#student-data-container").show();
                    $('#student-data-container').addClass('animated');
                    $('#student-data-container').addClass(animation);
                    $('#add_type').hide();
                } else {
                    alert('No data loaded');
                }
            }
        });
    }

    function uniform_changed_class1111() {
        //        var nationality = $("#country_select :selected").data('nationality');
        var class_id = $('#class_select').val();
        //        $('#nationality').val(nationality);
        var ops_url = baseurl + 'uniform/substore/get-bill-batchdetails/';
        $.ajax({
            type: "POST",
            cache: false,
            async: false,
            url: ops_url,
            data: {
                "class_id": class_id
            },
            success: function(result) {
                $('#class_select').empty().trigger("change");
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


    function uniform_changed_class() {
        var academic_year = $('#academic_year').val();
        var stream_id = $('#stream_id').val();
        var session_id = $('#session_id').val();
        var class_id = $('#class_id').val();
        //        var class_data = JSON.stringify(class_id);
        var ops_url = baseurl + 'uniform/substore/get-bill-batchdetails/';
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
                    $.each(batchdata, function(i, v) {
                        $('#batch_id').append("<option value='" + v.BatchID + "'  >" + v.Batch_Name + "</option>");
                    });
                    $('#batch_id').trigger('change');
                } else {
                    $('#batch_id').empty().trigger("change");
                }
            }
        });
    }
</script>