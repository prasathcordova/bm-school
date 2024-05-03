<div class="wrapper wrapper-content animated fadeInRight" style="padding-top: 1px !important;padding-left: 0px !important;padding-right: 0px !important;">
    <div class="row" style="margin-left: -29px !important; margin-right: -30px !important;">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5><?php echo isset($sub_title) ? $sub_title : "NO TITLE PROVIDED" ?> </h5>

                    <div class="ibox-tools" id="add_type">
                        <a href="javascript:void(0);" onclick="item_list();" id="item_list" class="pull-right btn-xs btn btn-primary">Item list </a>

                    </div>
                </div>
                <input type="hidden" id="template_config_id" value="<?php echo $template_config_id ?>">
                <input type="hidden" id="template_id" value="<?php echo $template_id ?>">
                <div class="ibox-content">


                    <div class="row">

                        <div class="col-lg-12">

                            <!--<div class="row " >-->
                            <div class="ibox-content" id="item_list_detail">
                                <div class="row" id="">
                                    <?php
                                    if (isset($item_data) && !empty($item_data) && is_array($item_data)) {
                                        foreach ($item_data as $item) {
                                    ?>
                                            <div class="col-lg-8">
                                                <div class="ibox">

                                                    <div class="ibox-title">
                                                        KIT ITEMS
                                                        <!--<span class="label label-info pull-right">NEW</span>-->
                                                        <!--                                                            <h4 class="label label-info pull-right">KIT ITEMS</h4>-->
                                                    </div>
                                                    <div class="ibox-content">
                                                        <div class="table-responsive">
                                                            <div class="scroll_content">
                                                                <table class="table table-hover margin bottom">
                                                                    <thead>
                                                                        <tr>
                                                                            <!--                                                        <th style="width: 1%" class="text-center">No.</th>-->
                                                                            <th>Item Code</th>
                                                                            <th>Bar Code</th>
                                                                            <th class="text-center">Quantity</th>
                                                                            <th class="text-center">Rate</th>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                    <tbody>
                                                                        <?php
                                                                        foreach ($item['items_data'] as $value) {
                                                                        ?>
                                                                            <tr>
                                                                                <td><?php echo $value['item_code'] ?></td>
                                                                                <td><?php echo $value['barcode'] ?></td>
                                                                                <td class="text-right"><?php echo $value['qty'] ?></td>
                                                                                <td class="text-right"><?php echo (isset($value['rate']) && !empty($value['rate'])) ? $value['rate'] : $value['selling_price']; ?></td>

                                                                            </tr>
                                                                        <?php
                                                                        }
                                                                        ?>



                                                                    </tbody>
                                                                </table>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-4">
                                                <table class="table table-hover margin bottom">
                                                    <thead>
                                                        <tr>
                                                            <!--                                                        <th style="width: 1%" class="text-center">No.</th>-->
                                                            <th>Particulars</th>

                                                            <th class="text-center">Amount</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr>

                                                            <td>Sub Total
                                                            </td>

                                                            <td class="text-center" align="left"><span class="label label-primary"><?php echo $item['master_data']['sub_total'] ?></span></td>

                                                        </tr>

                                                        <tr>

                                                            <td> <?php echo TAXNAME  ?>
                                                            </td>

                                                            <td class="text-center"><span class="label label-warning"><?php echo $item['master_data']['tax_amount'] ?></span></td>

                                                        </tr>
                                                        <tr>

                                                            <td> Round Off</td>

                                                            <td class="text-center"><span class="label label-primary"><?php echo $item['master_data']['roundoff'] ?></span></td>
                                                        </tr>
                                                        <tr>

                                                            <td>Net Total</td>

                                                            <td class="text-center"><span class="label label-primary"><?php echo $item['master_data']['final_total_amount'] ?></span></td>
                                                        </tr>
                                                        <tr>
                                                            <td>Available Discount for this kit (%)</td>
                                                            <td class="text-center"><span class="label label-primary"><?php echo (isset($item['items_data'][0]['is_discount']) && $item['items_data'][0]['is_discount'] == 1) ? $item['items_data'][0]['discount'] : 0 ?></span></td>
                                                        </tr>
                                                        <div class="notes" style="padding-bottom:10px;padding-left: 10px;padding-top: 10px;margin-bottom: 10px;font-family: Tahoma;">
                                                            *Notes:
                                                            <span class="text-muted small">
                                                                Discount will be considered at the time of billing.
                                                            </span>
                                                        </div>

                                                    </tbody>
                                                </table>
                                            </div>

                                    <?php
                                        }
                                    }
                                    ?>
                                </div>
                            </div>
                            <!--</div>-->


                            <div class="ibox-content" style="display:inline-block; width:100%;">

                                <h3>Student Filter</h3>
                                <div class="ibox-tools" id="add_type">

                                </div>

                                <div class="card">
                                    <div class="row clearfix" id="pagetop">
                                        <div class="col-lg-4 col-xs-12 col-md-12">
                                            <div class="form-group ">
                                                <label>Academic Year</label>
                                                <select class="select2_registration form-control" id="academic_year" name="academic_year" style="width: 100%" onchange="load_batch_data();">
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

                                        <div class="col-lg-4 col-xs-12 col-md-12">
                                            <div class="form-group ">
                                                <label>Stream *</label>
                                                <select class="select2_registration form-control" id="stream_id" name="stream_id" onchange="load_batch_data();">
                                                    <?php
                                                    if (isset($stream_data) && !empty($stream_data)) {
                                                        //echo '<option selected value="-1">Select a stream</option>';
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
                                                <label>Session *</label>
                                                <select class="select2_registration form-control" id="session_id" name="session_id" onchange="load_batch_data();">
                                                    <?php
                                                    if (isset($session_data) && !empty($session_data)) {
                                                        //echo '<option selected value="-1">Select a session</option>';
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
                                                <label>Class *</label>
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
                                                <label>Batch *</label>
                                                <div>
                                                    <select class="select2_registration form-control" id="batch_id" name="batch_id" multiple="multiple">
                                                        <?php
                                                        //                                                        if (isset($batch_data) && !empty($batch_data)) {
                                                        ////                                            echo '<option selected value="-1">All Selected</option>';
                                                        //                                                            foreach ($batch_data as $batch) {
                                                        //                                                                echo '<option value="' . $batch['BatchID'] . '">' . $batch['Batch_Name'] . '</option>';
                                                        //                                                            }
                                                        //                                                        }
                                                        ?>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>



                                    </div>
                                </div>
                                <div id="advanced_show" class="animated fadeInDown">
                                    <div class="row clearfix" style="padding-bottom:0;">

                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <div class="card">
                                                <div class="header">
                                                    <h2 style="padding-bottom: 10px;font-size: 16px;">Advance Filter
                                                        <span id="close_filter"><a href="javascript:void(0);"> <i style="font-size: 30px !important; float: right; color: #E91E63;" class="material-icons" data-toggle="tooltip" title="Close">close</i></a> </span>
                                                    </h2>
                                                </div>

                                                <div class="row clearfix">
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label>Admission No.</label>
                                                            <div>
                                                                <input class="form-control text-uppercase" name="admissionno" id="admissionno" value="" type="text">
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label>Gender</label>
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
                                                        <div class="form-group">
                                                            <label>Religion</label>
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
                                        <a href="javascript:void(0);" onclick="search_student();" id="search_student" class="pull-right btn-xs btn btn-primary">Search <i class="fa fa-search"></i></a>
                                        <a href="javascript:void(0);" onclick="" id="advanced_filter" class="pull-right btn-xs btn btn-primary">Advanced Filter</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row" style="margin-left: -29px !important; margin-right: -30px !important;">



        <div class="col-lg-12">
            <div id="curd-content" style="display: none;"></div>
        </div>



    </div>
</div>

<script src="<?php echo base_url('assets/theme/js/plugins/peity/jquery.peity.min.js'); ?>"></script>
<style>
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
        height: '200px',
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
    $('.scroll_content').slimscroll({
        height: '300px'
    })
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
    //                                            $("#class_id").select2({
    //                                                placeholder: "Select a class",
    //                                                "theme": "bootstrap",
    //                                                allowClear: true
    //                                            });

    function load_batch_data() {
        var academic_year = $('#academic_year').val();
        var stream_id = $('#stream_id').val();
        var session_id = $('#session_id').val();
        var class_id = $('#class_id').val();

        var ops_url = baseurl + 'substore/batch-stud_item_attach/';
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

        if (admissionno == '') {

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
        }


        var batch_data = JSON.stringify(batch_id);
        var ops_url = baseurl + 'substore/search-stud_item_attach/';
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
                "religion": religion
            },
            success: function(result) {
                //                $('#batch_id').empty().trigger("change");
                var data = JSON.parse(result);
                if (data.status == 1) {
                    $("#curd-content").html('');
                    $("#curd-content").html(data.view);
                    $('#item_list_detail').slideUp();
                    //                    $('#curd-content').html(data);
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

    function save_data() {
        var template_config_id = $("#template_config_id").val();
        var template_id = $("#template_id").val();
        //        alert(template_config_id);

        var student_data = [];
        var table = $('#tbl_student').dataTable();
        var confirmid = ''
        table.$('input[type=checkbox]').each(function() {
            if (this.checked) {
                var student_id = $(this).data('student_id');
                var batch_id = $(this).data('batch_id');
                var class_id = $(this).data('class_id');
                //                console.log(id);
                student_data.push({
                    student_id: student_id,
                    batch_id: batch_id,
                    class_id: class_id
                });
            }
        });
        var formatted_student_data = JSON.stringify(student_data);
        //       console.log(formatted_template_id.length);
        if (formatted_student_data.length == 2 || formatted_student_data.length < 2) {
            swal('', 'No student is selected.', 'info');
            $('#data_loader').removeClass('sk-loading');
            return false;
        }

        var ops_url = baseurl + 'substore/save-stud_item_attach/';
        $.ajax({
            type: "POST",
            cache: false,
            async: false,
            url: ops_url,
            data: {
                "template_config_id": template_config_id,
                "template_id": template_id,
                "formatted_student_data": formatted_student_data
            },
            success: function(result) {

                var data = JSON.parse(result);
                if (data.status == 1) {
                    swal('Success', 'Student data saved successfully.', 'success');
                    load_ohitemgroupissue();
                    $('#data_loader').removeClass('sk-loading');
                    $("#curd-content").slideUp("slow", function() {
                        $("#curd-content").hide();
                    });
                } else if (data.status == 2) {
                    swal('', data.message, 'info');
                    $('#data_loader').removeClass('sk-loading');
                } else if (data.status == 3) {
                    swal({
                        title: 'Success with warnings',
                        text: 'The following students templates are not assigned as they reached maximum limit of the kits that can be assigned.' + data.student_data,
                        type: 'success',
                        html: true,
                        showCancelButton: false,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'OK',
                        closeOnConfirm: true,
                        closeOnCancel: true,
                    });
                    $('#data_loader').removeClass('sk-loading');
                    $('.scroll_content').slimscroll({
                        height: '100px',
                        color: '#f8ac59'

                    });
                } else {
                    swal('', 'Connection Error. Please contact administrator', 'info');
                    $('#data_loader').removeClass('sk-loading');
                }
            }
        });



    }
</script>