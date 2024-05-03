<div class="wrapper wrapper-content animated fadeInRight" style="padding-top: 1px !important;padding-left: 0px !important;padding-right: 0px !important;">
    <div class="row" style="margin-left: -29px !important; margin-right: -30px !important;">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title" style="border-bottom-color:#ffd300 !important;">
                    <?php
                    //    $search_image = base_url('assets/img/searchicon.jpg');
                    //    $advancedsearch = base_url('assets/img/advancedsearch.jpg');
                    $student_img = base_url('assets/img/a8.jpg');
                    ?>
                    <!--                     <div class="image">
                                                                <img alt="image" class="img-responsive" src="<?php echo $img1; ?>">
                                                            </div>-->
                    <h5><?php echo isset($sub_title) ? $sub_title : "NO TITLE PROVIDED" ?></h5>

                </div>
                <div class="ibox-content" id="faculty_loader">
                    <div class="sk-spinner sk-spinner-wave">
                        <div class="sk-rect1"></div>
                        <div class="sk-rect2"></div>
                        <div class="sk-rect3"></div>
                        <div class="sk-rect4"></div>
                        <div class="sk-rect5"></div>
                    </div>
                    <div class="clearfix"></div>
                    <div class="row m-b-sm m-t-sm" id="search-feecode">


                    </div>
                    <div class="wrapper wrapper-content animated fadeInRight" id="student-data-container">
                        <div class="ibox-tools" id="add_type">
                            <a data-toggle="modal" class="btn btn-primary btn-xs" data-toggle="tooltip" title="submit fee concesion" data-placement="left" href="javascript:void(0)" onclick="add_new_template();">Submit fee concession</a>
                        </div>
                        <div class="row">
                            <div class="col-md-6">

                                <div class="profile-image">
                                    <img src="<?php echo $student_img; ?>" class="img-circle circle-border m-b-md" alt="profile">
                                </div>
                                <div class="profile-info">
                                    <div class="">
                                        <div>
                                            <h2 class="no-margins">
                                                <!--Adiba Aktar Eva Ibrahim-->
                                            </h2>
                                            <h4> Adiba Aktar Eva Ibrahim</h4>
                                            <!--<h4>40153/17</h4>-->
                                            <small>

                                                Admission No. : 40153/17
                                            </small><br>
                                            <small>

                                                Batch : KG1/A/CBS/FN/ENG/2017-18
                                            </small><br>
                                            <small>
                                                Class : KGI
                                            </small>

                                        </div>

                                    </div>

                                </div>

                            </div>
                            <!--                            <div class="col-lg-6 col-md-6 col-xs-12 col-sm-12">
                                                            <div class="col-lg-6">
                                                            <div class="form-group <?php
                                                                                    if (form_error('gender_select')) {
                                                                                        echo 'has-error';
                                                                                    }
                                                                                    ?>">
                                                                <label>Fee Code</label><span class="mandatory" > *</span><br/>
                            
                                                                <select name="acd_id" id="acd_id"  class="form-control " style="width:100%;" >                                
                            
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
                                                        </div>-->


                            <div class="row">
                                <div class="col-lg-12">
                                    <div id="curd-content" style="display: none;"></div>
                                </div>

                            </div>

                            <div class="well" style="height:170px;border-color:wheat;background-color: #ffff">
                                <div class="col-lg-4 text-center" style="margin-left:13px;">
                                    <ul class="sortable-list connectList agile-list" id="todo">
                                        <div class="i-checks pull-right" style="padding-top:6px;padding-right: 6px;"><label>
                                                <div class="icheckbox_square-green" style="position: relative;"><input data-toggle="tooltip" data-placement="right" class="data_part" data-confirmid="" type="checkbox" value="" style="position: absolute; opacity: 0;"><ins class="iCheck-helper" style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; background: rgb(255, 255, 255); border: 0px; opacity: 0;"></ins></div>
                                            </label>
                                        </div>
                                        <li class="danger-element" style="color:hotpink;" id="task1">
                                            Tution Fees .
                                            <div class="agile-detail">
                                                <input type="email" placeholder="Enter amount" class="form-control">
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                                <div class="col-lg-4 text-center" style="margin-left:13px;">
                                    <ul class="sortable-list connectList agile-list" id="todo">
                                        <div class="i-checks pull-right" style="padding-top:6px;padding-right: 6px;"><label>
                                                <div class="icheckbox_square-green" style="position: relative;"><input data-toggle="tooltip" data-placement="right" class="data_part" data-confirmid="" type="checkbox" value="" style="position: absolute; opacity: 0;"><ins class="iCheck-helper" style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; background: rgb(255, 255, 255); border: 0px; opacity: 0;"></ins></div>
                                            </label>
                                        </div>
                                        <li class="danger-element" style="color:hotpink;" id="task1">
                                            Tution Fees .
                                            <div class="agile-detail">
                                                <input type="email" placeholder="Enter amount" class="form-control">
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <?php
                        $breaker = 0;
                        //                                if (isset($feedback_subject_data) && !empty($feedback_subject_data)) {
                        //                                    foreach ($feedback_subject_data as $subject_data) {
                        ?>
                        <div class="col-lg-12">
                            <div id="curd-content" style="display: none;"></div>
                            <div class="ibox-content">

                                <div>

                                </div>

                            </div>

                        </div>
                        <?php
                        if ($breaker == 3) {
                            echo '<div class="clearfix"></div>';
                            $breaker = 0;
                        } else {
                            $breaker++;
                        }
                        //                                    }
                        //                                }
                        ?>
                    </div>
                    <!--</div>-->
                </div>
                <!--</div>-->
            </div>
        </div>
    </div>
</div>
</div>


<script type="text/javascript">
    var list_switchery = [];
    var table = $('#tbl_country').dataTable({
        columnDefs: [{
                "width": "20%",
                className: "capitalize",
                "targets": 0
            },
            {
                "width": "20%",
                className: "capitalize",
                "targets": 1
            },
            {
                "width": "20%",
                className: "capitalize",
                "targets": 2
            },
            {
                "width": "20%",
                className: "capitalize",
                "targets": 3
            },
            {
                "width": "20%",
                className: "capitalize",
                "targets": 4
            },
            //            {"width": "20%", className: "capitalize", "targets": 5, "orderable": false}
        ],
        responsive: true,
        stateSave: true,
        iDisplayLength: 10,
        dom: '<"html5buttons"B>lTfgitp',
        buttons: [{
                extend: 'copy'
            },
            {
                extend: 'csv',
                exportOptions: {
                    columns: [0, 1, 2, 3]
                }
            },
            {
                extend: 'excel',
                title: 'Report',
                exportOptions: {
                    columns: [0, 1, 2, 3]
                }
            }
        ],
        "fnDrawCallback": function(ele) {
            activateSwitchery();
        },
    });
    $('#tbl_country tbody').on('click', function(e) {
        activateSwitchery()
    });

    $(document).ready(function() {
        activateSwitchery();

    });

    function activateSwitchery() {
        for (var i = 0; i < list_switchery.length; i++) {
            list_switchery[i].destroy();
            list_switchery[i].switcher.remove();
        }
        var list_checkbox = Array.prototype.slice.call(document.querySelectorAll('.js-switch'));
        list_checkbox.forEach(function(html) {
            var switchery = new Switchery(html, {
                color: '#23C6C8',
                secondaryColor: '#F8AC59',
                size: 'small'
            });
            //        var switchery = new Switchery(html, {color: '#a9318a', size: 'small'});
            list_switchery.push(switchery);
        });
    }

    function toggle_country_add() {
        if ($('#add_type').html() > 100) {
            $('#add_type').html('<a href="javascript:void(0);" onclick="toggle_country_add();"><i class="fa fa-close" style="color:1ab394; font-size:30px;></i></a>');
            add_country();
        } else {
            $('#add_type').html('<button type="button" class="btn bg-teal waves-effect" onclick="toggle_country_add();">NEW COUNTRY</button>');
            var animation = "fadeOutDown";
            $('#curd-content').addClass('animated');
            $('#curd-content').addClass(animation);
            $('#curd-content').html('');
            $('#curd-content').hide();
        }
    }


    $('.js-switch').change(function(e) {

    });


    $(".js-switch").click(function() {});

    $('#acd_id').select2({
        'theme': 'bootstrap'
    });

    function submit_edit_save_data() {
        $('#faculty_loader').addClass('sk-loading');

        var ops_url = baseurl + 'country/edit-country';
        var country_name = $('#country_name').val().toUpperCase();
        var country_abbr = $('#country_abbr').val();
        var currency_name = $("#currency_select").val();
        var country_nation = $("#country_nation").val();
        if (currency_name == -1) {
            swal('', 'Currency is required.', 'info');
            $('#faculty_loader').removeClass('sk-loading');
            return;
        }
        if (country_name == '') {
            swal('', 'Country Name is required.', 'info');
            $('#faculty_loader').removeClass('sk-loading');
            return false;
        } else if ((country_name.length > '30') || (country_name.length < '3')) {
            swal('', 'Country Name should contain letters 3 to 30', 'info');
            $('#faculty_loader').removeClass('sk-loading');
            return false;
        }
        var alphanumers = /^[a-zA-Z\s]+$/;
        if (!alphanumers.test($("#country_name").val())) {
            swal('', 'Country Name can have only alphabets', 'info');
            $('#faculty_loader').removeClass('sk-loading');
            return false;
        }
        if (country_abbr == '') {
            swal('', 'Country Abbreviation is required.', 'info');
            $('#faculty_loader').removeClass('sk-loading');
            return false;
        } else if ((country_abbr.length > '15') || (country_abbr.length < '2')) {
            swal('', 'Country Abbreviation should contain letters 2 to 15', 'info');
            $('#faculty_loader').removeClass('sk-loading');
            return false;
        }
        var alphanumers = /^[a-zA-Z]+$/;
        if (!alphanumers.test($("#country_abbr").val())) {
            swal('', 'Country Abbreviation can have only alphabets', 'info');
            $('#faculty_loader').removeClass('sk-loading');
            return false;
        }

        if (country_nation == '') {
            swal('', 'Nationality is required.', 'info');
            $('#faculty_loader').removeClass('sk-loading');
            return false;
        } else if ((country_nation.length > '30') || (country_nation.length < '3')) {
            swal('', 'Nationality should contain letters 3 to 30', 'info');
            $('#faculty_loader').removeClass('sk-loading');
            return false;
        }
        var alphanumers = /^[a-zA-Z\s]+$/;
        if (!alphanumers.test($("#country_nation").val())) {
            swal('', 'Nationality can have only alphabets', 'info');
            $('#faculty_loader').removeClass('sk-loading');
            return false;
        }


        $.ajax({
            type: "POST",
            cache: false,
            async: false,
            url: ops_url,
            data: $('#country_save').serialize(),
            success: function(result) {
                var data = $.parseJSON(result)

                if (data.status == 1) {
                    $('#country_save').html('');
                    $('#country_save').html(data.view);
                    var country_data = [];
                    $.ajax({
                        type: "POST",
                        cache: false,
                        async: false,
                        url: baseurl + 'country/show-country',
                        data: {
                            'load_reset': '1'
                        },
                        success: function(result) {
                            country_data = JSON.parse(result);
                        },
                        error: function() {
                            alert('error');
                        }
                    });
                    var datatable = $('#tbl_country').dataTable().api();
                    datatable.clear();
                    datatable.rows.add(country_data).draw();
                    $('#add_type').show();
                    swal('Success', 'Country ' + country_name + ' updated successfully.', 'success');
                    $('#faculty_loader').removeClass('sk-loading');
                    $("#curd-content").slideUp("slow", function() {
                        $("#curd-content").hide();
                    });
                    $('#currency_select').select2({
                        'theme': 'bootstrap'
                    });
                } else if (data.status == 2) {
                    $('#curd-content').html('');
                    $('#curd-content').html(data.view);
                    swal('', data.message, 'info');
                    $('#currency_select').select2({
                        'theme': 'bootstrap'
                    });
                    $('#faculty_loader').removeClass('sk-loading');
                } else if (data.status == 3) {
                    $('#curd-content').html('');
                    $('#curd-content').html(data.view);
                    swal('', data.message, 'info');
                    $('#currency_select').select2({
                        'theme': 'bootstrap'
                    });
                    $('#faculty_loader').removeClass('sk-loading');
                    //                    activate_toast(data.message, 'Error', 'error');
                } else {
                    swal('', 'Connection Error. Please contact administrator', 'info');
                    $('#faculty_loader').removeClass('sk-loading');
                    //                    activate_toast("Connection Error", 'Error', 'error');
                }

            }
        });
    }

    function refresh_add_panel() {
        $('#country_name').val('');
        $('#country_name').parent().removeAttr('class', 'has-error');
        $('#country_nation').val('');
        $('#country_nation').parent().removeAttr('class', 'has-error');
        $('#country_abbr').val('');
        $('#country_abbr').parent().removeAttr('class', 'has-error');
        $('#currency_select').select2('val', -1);
    }

    function edit_fee_code1() {
        var ops_url = baseurl + 'fees/edit-feescode/';
        $.ajax({
            type: "POST",
            cache: false,
            async: false,
            url: ops_url,
            data: {
                "load": 1
            },
            success: function(result) {
                var data = JSON.parse(result);
                console.log(data);
                if (data.status == 1) {
                    $('#curd-content').html('');
                    $('#curd-content').html(data.view);
                    var animation = "fadeInDown";
                    $("#curd-content").show();
                    $('#curd-content').addClass('animated');
                    $('#curd-content').addClass(animation);
                    $('#add_type').hide();
                    $('#paymentmode_select').select2({
                        'theme': 'bootstrap'
                    });
                    $('#month_span_select').select2({
                        'theme': 'bootstrap'
                    });
                } else {
                    alert('No data loaded');
                }
            }
        });
    }

    function edit_fee_type() {
        var ops_url = baseurl + 'fees/edit-feetype/';
        $.ajax({
            type: "POST",
            cache: false,
            async: false,
            url: ops_url,
            data: {
                "load": 1
            },
            success: function(data) {
                if (data) {
                    $('#curd-content').html(data);
                    var animation = "fadeInDown";
                    $('#search-feecode').hide();
                    $("#curd-content").show();
                    $('#curd-content').addClass('animated');
                    $('#curd-content').addClass(animation);
                    $('#add_type').hide();
                    $('#month_span_select').select2({
                        'theme': 'bootstrap'
                    });
                    $('#payment_mode_select').select2({
                        'theme': 'bootstrap'
                    });
                    $('#feetype_select').select2({
                        'theme': 'bootstrap'
                    });
                } else {
                    alert('No data loaded');
                }
            }
        });
    }

    function close_add_country() {
        $('#search-feecode').show();
        $('#add_type').show();
        $("#curd-content").slideUp("slow", function() {
            $("#curd-content").hide();
        });

    }

    //NEW SCRIPT
    function add_new_fee_type() {
        var ops_url = baseurl + 'fees/add-feetype';
        $.ajax({
            type: "POST",
            cache: false,
            async: false,
            url: ops_url,
            data: {
                "load": 1
            },
            success: function(data) {
                if (data) {
                    $('#curd-content').html(data);
                    var animation = "fadeInDown";
                    $('#search-feecode').hide();
                    $("#curd-content").show();
                    $('#curd-content').addClass('animated');
                    $('#curd-content').addClass(animation);
                    $('#add_type').hide();
                    $('#month_span_select').select2({
                        'theme': 'bootstrap'
                    });
                    $('#payment_mode_select').select2({
                        'theme': 'bootstrap'
                    });
                    $('#feetype_select').select2({
                        'theme': 'bootstrap'
                    });
                } else {
                    alert('No data loaded');
                }
            }
        });
    }

    $('.i-checks').iCheck({
        checkboxClass: 'icheckbox_square-green',
        radioClass: 'iradio_square-green'
    });
</script>