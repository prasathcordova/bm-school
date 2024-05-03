<div class="wrapper wrapper-content animated fadeInRight" style="padding-top: 1px !important;padding-left: 0px !important;padding-right: 0px !important;">
    <div class="row" style="margin-left: -29px !important; margin-right: -30px !important;">
        <div class="col-lg-12">
            <div class="ibox float-e-margins" style="margin-bottom: 0;">
                <div class="ibox-title">
                    <h5><?php echo isset($sub_title) ? $sub_title : "NO TITLE PROVIDED" ?> </h5>
                    <a class="pull-right" href="javascript:void(0)" title="Back to Template List" onclick="load_fee_student_allotment_student_wise()"><i class="fa fa-backward" style="font-size:22px;"></i></a>
                </div>
                <input type="hidden" name="template_id" id="template_id" value="<?php echo $template_id; ?>" />
                <input type="hidden" name="template_name" id="template_name" value="<?php echo $template_name; ?>" />
                <div class="ibox-content" id="fee_code_loader">
                    <div class="sk-spinner sk-spinner-wave">
                        <div class="sk-rect1"></div>
                        <div class="sk-rect2"></div>
                        <div class="sk-rect3"></div>
                        <div class="sk-rect4"></div>
                        <div class="sk-rect5"></div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="ibox-content no-padding" id="item_list_detail" style="padding-bottom: 0px;">
                                <div class="row" id="">
                                    <div class="col-lg-12">
                                        <div class="panel panel-info">
                                            <div class="panel-heading" style="font-size: 14px;">
                                                FEE ALLOCATION DETAILS (<?php echo print_tax_vat(); ?> will be calculated at the time of collection)
                                            </div>
                                            <div class="panel-body no-padding">
                                                <div class="table-responsive">
                                                    <div class="scroll_content">
                                                        <table class="table table-hover margin bottom" id="allotted_fee_codes" id="table_body_for_fee_code_linked">
                                                            <thead>
                                                                <tr>
                                                                    <th>Fee Code</th>
                                                                    <th>Description</th>
                                                                    <th>Demand Frequency</th>
                                                                    <th><?php echo print_tax_vat(); ?></th>
                                                                    <th class="text-center">Fees Amount</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <?php
                                                                if (isset($fee_codes_already_linked) && !empty($fee_codes_already_linked)) {
                                                                    $counter = 0;
                                                                    $total_fee_amount = 0;
                                                                    foreach ($fee_codes_already_linked as $fee_codes) {
                                                                        $counter = $counter + 1;
                                                                        $total_fee_amount = $total_fee_amount + $fee_codes['fee_amount'];
                                                                ?>
                                                                        <tr>
                                                                            <td><?php echo $fee_codes['feeCode']; ?></td>
                                                                            <td><?php echo $fee_codes['description']; ?></td>
                                                                            <td><?php echo ($fee_codes['monthSpan'] == -2 ? 'One Time Fee' : ($fee_codes['monthSpan'] == -3 ? 'CUSTOM TERM' : ($fee_codes['monthSpan'] == 12 ? 'Yearly' : $fee_codes['monthSpan'] . " month/s"))); ?></td>
                                                                            <td><?php echo $fee_codes['vat'] . " %"; ?></td>
                                                                            <td class="text-center"><?php echo my_money_format($fee_codes['fee_amount']); ?> </td>
                                                                        </tr>
                                                                <?php
                                                                    }
                                                                }
                                                                ?>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!--                                    <div class="col-lg-4">
                                        <table class="table table-hover margin bottom">
                                            <thead>
                                                <tr>        
                                                    <th>Particulars</th>
                                                    <th class="text-center">Amount</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>Total Fee Codes   </td>
                                                    <td class="text-center" align="left" ><span class="label label-primary"><?php echo $counter; ?></span></td>
                                                </tr>                                                        
                                                <tr>
                                                    <td>Net Fee Total</td>
                                                    <td class="text-center"><span class="label label-primary"><?php echo $total_fee_amount ?></span></td>
                                                </tr>
                                            <div class="notes" style="padding-bottom:10px;padding-left: 10px;padding-top: 10px;margin-bottom: 10px;font-family: Tahoma;">
                                                *Notes:
                                                <span class="text-muted small">
                                                    VAT will be calculated at the time of collection.
                                                </span>
                                            </div>
                                            </tbody>
                                        </table>
                                    </div>-->
                                </div>
                            </div>
                            <div class="ibox">
                                <!-- float-e-margins -->
                                <div class="ibox-title">
                                    <h5>Student Filter</h5>
                                </div>
                                <div class="ibox-content" style="display:inline-block; width:100%;padding-bottom: 0px;">
                                    <div class="ibox-tools" id="add_type">
                                    </div>
                                    <div class="card">

                                        <div class="row" id="batch_div">
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
                                                            <select class="select2_registration form-control" id="batch_code" name="batch_code">
                                                                <option selected value="-1">Select </option>
                                                                <?php
                                                                ?>
                                                                <!-- <input type="hidden" name="acdyear_batch" id="acdyear_batch" value="<?php echo $batch['Acd_Year'] ?>"> multiple="multiple"
                                                                <input type="hidden" name="acdyear_stream" id="acdyear_stream" value="<?php echo $batch['Stream_ID'] ?>">
                                                                <input type="hidden" name="acdyear_class" id="acdyear_class" value="<?php echo $batch['Class_Det_ID'] ?>">
                                                                <input type="hidden" name="acdyear_session" id="acdyear_session" value="<?php echo $batch['Session_ID'] ?>"> -->
                                                                <?php
                                                                if (isset($batch_data) && !empty($batch_data)) {
                                                                    foreach ($batch_data as $batch) {
                                                                        echo '<option academic_year="' . $batch['Acd_Year'] . '" stream_id="' . $batch['Stream_ID'] . '" class_id="' . $batch['Class_Det_ID'] . '" session_id="' . $batch['Session_ID'] . '" value="' . $batch['BatchID'] . '">' . $batch['batch_code'] . '</option>';
                                                                    }
                                                                }
                                                                ?>
                                                            </select> <span class="input-group-btn">
                                                                <a title="Search" id="search_batch_btn" class="btn btn-primary" onclick="search_by_batch();"><i class="fa fa-search"></i></a>
                                                                <a title="Show Advanced Options" id="show_advanced_filter_btn" class="btn btn-warning show_advanced_filter_btn" style="margin-left: 10px;border-radius: 5px;"><i class="fa fa-filter"></i></a>
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row clearfix" id="advanced_search">
                                            <div class="col-md-12">
                                                <h3 id="advanced_search_h">Student Advanced Search
                                                    <a title="Hide Advanced Options" id="hide_advanced_filter_btn1" class="btn btn-warning hide_advanced_filter_btn pull-right" style="margin-left: 10px;border-radius: 5px;"><i class="fa fa-filter"></i></a>
                                                    <hr>
                                                </h3>
                                            </div>
                                            <div class="col-lg-4 col-xs-12 col-md-12">
                                                <div class="form-group ">
                                                    <label>Academic Year :</label>
                                                    <select class="select2_registration form-control" id="academic_year" name="academic_year" style="width: 100%" onchange="load_batch_data();">
                                                        <?php
                                                        if (isset($acdyr_data) && !empty($acdyr_data)) {
                                                            foreach ($acdyr_data as $acd) {

                                                                if (isset($acd['Acd_ID']) && !empty($acd['Acd_ID']) && $this->session->userdata('acd_year') == $acd['Acd_ID']) {
                                                                    echo '<option selected value="' . $acd['Acd_ID'] . '" data-fromyear="' . $acd['From_Year'] . '" data-toyear="' . $acd['To_Year'] . '" >' . $acd['Description'] . '</option>';
                                                                }
                                                                // else {
                                                                //     echo '<option value="' . $acd['Acd_ID'] . '" data-fromyear="' . $acd['From_Year'] . '" data-toyear="' . $acd['To_Year'] . '" >' . $acd['Description'] . '</option>';
                                                                // }
                                                            }
                                                        }
                                                        ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-lg-4 col-xs-12 col-md-12">
                                                <div class="form-group ">
                                                    <label>Stream :</label>
                                                    <select class="select2_registration form-control" id="stream_id" name="stream_id" onchange="load_batch_data();">
                                                        <?php
                                                        if (isset($stream_data) && !empty($stream_data)) {
                                                            echo '<option selected value="-1">Select a stream</option>';
                                                            foreach ($stream_data as $stream) {
                                                                echo '<option value="' . $stream['stream_id'] . '">' . $stream['description'] . '</option>';
                                                            }
                                                        }
                                                        ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-lg-4 col-xs-12 col-md-12">
                                                <div class="form-group ">
                                                    <label>Session :</label>
                                                    <select class="select2_registration form-control" id="session_id" name="session_id" onchange="load_batch_data();">
                                                        <?php
                                                        if (isset($session_data) && !empty($session_data)) {
                                                            echo '<option selected value="-1">Select a session</option>';
                                                            foreach ($session_data as $session) {
                                                                echo '<option value="' . $session['Session_ID'] . '">' . $session['Description'] . '</option>';
                                                            }
                                                        }
                                                        ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-lg-4 col-xs-12 col-md-12">
                                                <div class="form-group ">
                                                    <label> Class :</label>
                                                    <select class="select2_registration form-control" id="class_id" name="class_id" onchange="load_batch_data();">
                                                        <?php
                                                        if (isset($class_data) && !empty($class_data)) {
                                                            echo '<option selected value="-1">Select a class</option>';
                                                            foreach ($class_data as $class) {
                                                                echo '<option value="' . $class['Course_Det_ID'] . '" data-masterid="' . $class['Course_Master_ID'] . '"  >' . $class['Description'] . '</option>';
                                                            }
                                                        }
                                                        ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label> Batch :</label>
                                                    <div>
                                                        <select class="select2_registration form-control" id="batch_id" name="batch_id" multiple="multiple" style="width:100%;">
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-4 col-xs-12 col-md-12">
                                                <div class="form-group ">
                                                    <label> Nationality</label>
                                                    <select class="select2_registration form-control" id="nationality" name="nationality">
                                                        <option selected value="1">ALL Students</option>
                                                        <option value="2">INDIAN</option>
                                                        <option value="3">OTHERS</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div id="advanced_show" class="animated fadeInDown">
                                                    <div class="row clearfix" style="padding-bottom:0;">
                                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                            <div class="card">
                                                                <div class="header">
                                                                    <h2 style="padding-bottom: 10px;font-size: 16px;">More Options
                                                                        <span id="close_filter"><a href="javascript:void(0);"> <i style="font-size: 30px !important; float: right; color: #E91E63;" class="material-icons" data-toggle="tooltip" title="Close">close</i></a> </span>
                                                                    </h2>
                                                                </div>

                                                                <div class="row clearfix">
                                                                    <div class="col-md-4">
                                                                        <b>Admission No. :</b>
                                                                        <div class="form-group">
                                                                            <div>
                                                                                <input class="form-control text-uppercase admnNumberCheck" name="admissionno" id="admissionno" value="" type="text">
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-4">
                                                                        <b>Gender :</b>
                                                                        <div class="form-group">
                                                                            <div>
                                                                                <select name="gender" id="gender" class="form-control  select2_registration" style="width:100%;">
                                                                                    <option selected="" value="-1">Select</option>
                                                                                    <option value="M">Male</option>
                                                                                    <option value="F">Female</option>
                                                                                </select>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-4">
                                                                        <b>Religion :</b>
                                                                        <div class="form-group">
                                                                            <div>
                                                                                <select name="religion" id="religion" class="form-control select2_registration" style="width:100%;">
                                                                                    <?php
                                                                                    if (isset($class_data) && !empty($class_data)) {
                                                                                        echo '<option selected value="-1">Select a religion</option>';
                                                                                        foreach ($religion as $religion_val) {
                                                                                            echo '<option value="' . $religion_val['religion_id'] . '">' . $religion_val['religion_name'] . '</option>';
                                                                                        }
                                                                                    }
                                                                                    ?>
                                                                                </select>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <a href="javascript:void(0);" style="cursor:pointer;" onclick="search_student();" id="search_student" class="pull-right btn-md btn btn-primary" title="Search">Search <i class="fa fa-search"></i></a>
                                                        <a href="javascript:void(0);" style="cursor:pointer;" onclick="" id="advanced_filter" class="pull-right btn-md btn btn-primary" title="More Options"><i class="fa fa-filter"></i> More Options</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="ibox" style="margin-bottom: 0;">
                                <div id="curd-content" style="display: none;"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<style>
    .select2-container--bootstrap .select2-selection--multiple .select2-search--inline .select2-search__field {
        width: 100% !important;
    }

    .ui-state-highlight {
        background: #dbf6f6
    }

    .ibox-title {
        border-bottom: solid 2px #F3F3F4 !important
    }

    .panel-info>.panel-heading {
        font-size: 16px;
    }

    .panel-info>.panel-heading a {
        float: right;
        color: #fff;
        margin: 0 0 0 20px;
        position: relative;
    }

    .span-icon-2 {
        position: absolute;
        right: 9px;
        top: 2px;
    }

    .panel-info>.panel-heading a i {
        font-size: 22px;
    }

    .panel-info>.panel-heading a:hover {
        opacity: 0.8;
    }

    .ibox-new {
        background: #fff;
        min-height: 55px;
        border: solid 1px #EAEAEA;
        margin-bottom: 15px;
    }

    .stu-photo {
        display: inline-block;
        width: 55px;
        float: left;
        background: #14B6B8;
    }

    .stu-details {
        display: inline-block;
        padding: 8px 10px;
    }

    .stu-details p {
        margin: 0;
    }

    .stu-photo img {
        width: 100%;
    }

    .i-checks {
        float: right;
        padding: 0 10px;
        line-height: 50px;
    }

    .ibox-new-2 {
        padding: 15px !important;
    }

    .form-group-new input {
        border-radius: 3px;
        border: none;
    }

    .product-imitation {
        color: #898989;
        padding: 55px 0;
        margin: 0 0 15px 0;
    }

    .top-pad {
        padding: 15px 0 0 0;
    }

    .btn {
        margin: 0 0 0 10px;
    }

    .transfer-list {
        margin: 10px 0;
        position: relative;
    }

    .ibox-new {
        margin: 15px 0 0 0;
        border: solid 2px #F3F3F4;
    }

    .ibox-new-2 {
        padding: 15px !important;
    }

    .form-group-new input {
        border-radius: 3px;
        border: none;
    }

    div.dataTables_wrapper {

        margin: 0 auto;
    }

    #class_list,
    #curd-content {
        display: none;
    }

    .errdiv {
        text-align: left;
        display: inline-block;
        height: 50px;
        overflow-y: scroll;
    }

    .li {
        display: inline-block;
        padding: 0 0 15px 0;
    }
</style>


<script>
    $("#advanced_search").hide();
    $('body').on('click', '.show_advanced_filter_btn', function() {
        $(this).removeClass('show_advanced_filter_btn').addClass('hide_advanced_filter_btn').attr('title', 'Hide Advanced Options');
        $('.show_advanced_filter_btn').removeClass('show_advanced_filter_btn').addClass('hide_advanced_filter_btn').attr('title', 'Hide Advanced Options');
        $("#advanced_search").show('slow');
        $("#batch_div").hide('slow');
    });
    $('body').on('click', '.hide_advanced_filter_btn', function() {
        $(this).removeClass('hide_advanced_filter_btn').addClass('show_advanced_filter_btn').attr('title', 'Show Advanced Options');
        $('.hide_advanced_filter_btn').removeClass('hide_advanced_filter_btn').addClass('show_advanced_filter_btn').attr('title', 'Show Advanced Options');
        $("#advanced_search").hide('slow');
        $("#batch_div").show('slow');
    });
    var input = document.getElementById("admissionno");
    input.addEventListener("keyup", function(event) {
        event.preventDefault();
        if (event.keyCode === 13) {
            document.getElementById("search_student").click();
        }
    });

    function item_list() {
        $('#item_list_detail').show();
        $('#item_list').hide();

    }
    $('#item_list').hide();
    $('.scroll_content').slimscroll({
        height: '150px',
        color: '#f8ac59'

    });
    $(document).ready(function() {
        $('#tbl_selected').dataTable({
            columnDefs: [{
                    "width": "30%",
                    className: "capitalize",
                    "targets": 0
                },
                {
                    "width": "30%",
                    className: "capitalize",
                    "targets": 1
                },
                {
                    "width": "30%",
                    className: "capitalize",
                    "targets": 2
                }
            ],
            responsive: true,
            stateSave: true,
            iDisplayLength: 5,
            bPaginate: false,
            buttons: [],

        });
    });
    $('.i-checks').iCheck({
        checkboxClass: 'icheckbox_square-green',
        radioClass: 'iradio_square-green'
    });

    $('.scrollerdata').slimscroll({
        height: '250px',
    });
    $("#advanced_show").hide();
    $("#tbl_id").hide();
    $("#advanced_filter").click(function() {
        $("#advanced_show").slideDown();
        $("#advanced_filter").hide();
    });
    $("#search_student").click(function() {
        $("#tbl_id").slideDown();
    });
    $("#close_filter").click(function() {
        $('#religion').val(-1);
        $('#gender').val(-1);
        $("#advanced_show").slideUp();
        $("#advanced_filter").show();
        $("#admissionno").val('');
    });

    $('.ScrollStyle').slimscroll({
        height: '150px'
    })

    $('.i-checks').iCheck({
        checkboxClass: 'icheckbox_square-green',
        radioClass: 'iradio_square-green'
    });
    $(".select2_registration").select2({
        "theme": "bootstrap",
        "width": "100%"
    });
    $("#batch_id").select2({
        placeholder: "Select a batch",
        "theme": "bootstrap",
        allowClear: true
    });

    function load_batch_data() {
        var academic_year = $('#academic_year').val();
        var stream_id = $('#stream_id').val();
        var session_id = $('#session_id').val();
        var class_id = $('#class_id').val();

        var ops_url = baseurl + 'fees/modify-batch-for-filter-data/';
        $.ajax({
            type: "POST",
            cache: false,
            async: false,
            url: ops_url,
            data: {
                "stream_id": stream_id,
                "academic_year": academic_year,
                "session_id": session_id,
                "class_data": class_id
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

    function search_by_batch() {
        var batch_id = $("#batch_code option:selected").val(); //$("#w3s").attr("href")
        //acdyear_batch acdyear_stream acdyear_class acdyear_session
        // var batch_id = $('#batch_code').val();

        // var class_id = $('#batch_code').attr("class_id"); 
        var class_id = $("#batch_code option:selected").attr("class_id");
        var stream_id = $("#batch_code option:selected").attr("stream_id");
        var academic_year = $("#batch_code option:selected").attr("academic_year");
        var session_id = $("#batch_code option:selected").attr("session_id");
        // var class_id = $("#acdyear_class").val();
        // var stream_id = $("#acdyear_stream").val();
        // var academic_year = $("#acdyear_batch").val();
        // var session_id = $("#acdyear_session").val();
        var searchname = '';
        var template_id = $('#template_id').val();

        var admissionno = '';
        var gender = -1;
        var religion = -1;
        var nationality = 1;

        if (batch_id == -1) {
            swal('', 'Select Class Name.', 'info');
            return false;
        }
        // if (batch_id == '') {
        //     swal('', 'Atleast one batch is required.', 'info');
        //     return false;
        // } 
        else {
            var bt_array = [batch_id];
            var batch_data = JSON.stringify(bt_array);
            var ops_url = baseurl + 'fees/search-student-for-fee-allocation/';
            $.ajax({
                type: "POST",
                cache: false,
                async: false,
                url: ops_url,
                data: {
                    "admissionno": admissionno,
                    "stream_id": stream_id,
                    "academic_year": academic_year,
                    "session_id": session_id,
                    "class_data": class_id,
                    "batch_data": batch_data,
                    "gender": gender,
                    "religion": religion,
                    "template_id": template_id,
                    "nationality": nationality
                },
                success: function(result) {
                    var data = JSON.parse(result);
                    if (data.status == 1) {
                        $("#curd-content").html('');
                        $("#curd-content").html(data.view);
                        //                                                            $('#item_list_detail').slideUp();
                        var animation = "fadeInDown";
                        $("#curd-content").show();
                        $('#curd-content').addClass('animated');
                        $('#curd-content').addClass(animation);

                        $('html, body').animate({
                            scrollTop: $("#curd-content").offset().top
                        }, 1000);

                    } else {
                        alert('No data loaded');
                        return false;
                    }
                }
            });
        }
        //});

    }

    function search_student() {

        $('#item_list').show();
        var admissionno = $('#admissionno').val();
        var academic_year = $('#academic_year').val();
        var stream_id = $('#stream_id').val();
        var session_id = $('#session_id').val();
        var class_id = $('#class_id').val();
        var batch_id = $('#batch_id').val();
        var gender = $('#gender').val();
        var religion = $('#religion').val();
        var template_id = $('#template_id').val();
        var nationality = $('#nationality').val();

        //if (admissionno == '') {

        if (stream_id == -1) {
            swal('', 'Stream is required.', 'info');
            return false;
        }
        if (session_id == -1) {
            swal('', 'Session is required.', 'info');
            return false;
        }
        if (session_id == -1) {
            swal('', 'Session is required.', 'info');
            return false;
        }
        if (class_id == -1) {
            swal('', 'Class is required.', 'info');
            return false;
        }
        if (batch_id == '') {
            swal('', 'Atleast one batch is required.', 'info');
            return false;
        }
        //}


        var batch_data = JSON.stringify(batch_id);
        var ops_url = baseurl + 'fees/search-student-for-fee-allocation/';
        $.ajax({
            type: "POST",
            cache: false,
            async: false,
            url: ops_url,
            data: {
                "admissionno": admissionno,
                "stream_id": stream_id,
                "academic_year": academic_year,
                "session_id": session_id,
                "class_data": class_id,
                "batch_data": batch_data,
                "gender": gender,
                "religion": religion,
                "template_id": template_id,
                "nationality": nationality
            },
            success: function(result) {
                var data = JSON.parse(result);
                if (data.status == 1) {
                    $("#curd-content").html('');
                    $("#curd-content").html(data.view);
                    //                                                            $('#item_list_detail').slideUp();
                    var animation = "fadeInDown";
                    $("#curd-content").show();
                    $('#curd-content').addClass('animated');
                    $('#curd-content').addClass(animation);

                    $('html, body').animate({
                        scrollTop: $("#curd-content").offset().top
                    }, 1000);

                } else {
                    alert('No data loaded');
                    return false;
                }
            }
        });
    }

    function load_fee_student_allotment_student_wise_with_template() {

        var ops_url = baseurl + 'fees/show-template-fees-code-list-for-student-link/';
        $.ajax({
            type: "POST",
            cache: false,
            async: false,
            url: ops_url,
            data: {
                "load": 1
            },
            success: function(result) {
                $('#data-view').html(result);
            }
        });

    }

    function allocate_fee_to_student() {
        $('#student_code_loader').addClass('sk-loading');
        var template_name = $("#template_name").val();
        var template_id = $("#template_id").val();
        var student_data = [];
        var student_data_one_time_pay = [];
        var table = $('#tbl_student').dataTable();
        table.$('input[type=checkbox]').not(":disabled").each(function() {
            if (this.checked) {
                var student_id = $(this).data('student_id');
                var batch_id = $(this).data('batch_id');
                var class_id = $(this).data('class_id');
                var pending_amt = $(this).data('pendingpayment');
                var wallet_amt = $(this).data('walletbalance');
                var student_name = $(this).data('studentname');
                student_data.push({
                    student_id: student_id,
                    batch_id: batch_id,
                    class_id: class_id
                });
                //if (wallet_amt > 0 && pending_amt > 0) {
                student_data_one_time_pay.push({
                    student_id: student_id,
                    student_name: student_name,
                    pending_amt: pending_amt,
                    wallet_amt: wallet_amt
                });
                //}
            }
        });
        var formatted_student_data = JSON.stringify(student_data);
        var formatted_student_data_one_time_pay = JSON.stringify(student_data_one_time_pay);
        if (formatted_student_data.length == 2 || formatted_student_data.length < 2) {
            swal('', 'Select atleast one student.', 'info');
            $('#student_code_loader').removeClass('sk-loading');
            return false;
        }
        if (moment($("#datepicker").data("datepicker").getDate()).isValid() === true) {
            var activation_date = moment($("#datepicker").data("datepicker").getDate()).format("YYYY-MM");
        } else {
            $('#student_code_loader').removeClass('sk-loading');
            swal('', 'Select a Fee Activation Month', 'info');
            return false;
        }


        var ops_url = baseurl + 'fees/save-template-with-student/';
        $.ajax({
            type: "POST",
            cache: false,
            async: true,
            url: ops_url,
            data: {
                "template_name": template_name,
                "template_id": template_id,
                "student_allocation_data": formatted_student_data,
                "student_data_one_time": formatted_student_data_one_time_pay,
                "activation_date": activation_date
            },
            success: function(result) {
                $('#student_code_loader').addClass('sk-loading');
                var data = JSON.parse(result);
                if (data.status == 1) {
                    swal('Success', 'Fees allocated as per the template, ' + template_name + ' with the selected student/s  successfully.', 'success');
                    load_fee_student_allotment_student_wise_with_template();
                    $('#student_code_loader').removeClass('sk-loading');
                    $("#curd-content").slideUp("slow", function() {
                        $("#curd-content").hide();
                    });
                } else if (data.status == 2) {
                    swal('', data.message, 'info');
                    $('#student_code_loader').removeClass('sk-loading');
                } else if (data.status == 3) {
                    swal({
                        title: 'Success with warnings',
                        text: 'The following students fees are not allocated as they may have allocated earlier.' + data.student_data,
                        type: 'success',
                        html: true,
                        showCancelButton: false,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'OK',
                        closeOnConfirm: true,
                        closeOnCancel: true,
                    });
                    $('.scroll_content').slimscroll({
                        height: '100px',
                        color: '#f8ac59'
                    });
                    $('#student_code_loader').removeClass('sk-loading');
                } else if (data.status == 4) {
                    if (data.message) {
                        swal('', data.message, 'info');
                        $('#student_code_loader').removeClass('sk-loading');
                        return false;
                    } else {
                        swal('', 'An error encountered. Please try again or contact administrator with the error code UITEMPASGFCOD003', 'info');
                        $('#student_code_loader').removeClass('sk-loading');
                        return false;
                    }
                } else {
                    swal('', 'Connection Error. Please contact administrator', 'info');
                    $('#student_code_loader').removeClass('sk-loading');
                }
            }
        });
        //        $('#fee_code_loader').addClass('sk-loading');
    }
</script>