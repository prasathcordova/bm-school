
<div class="wrapper wrapper-content animated fadeInRight" style="padding-top: 1px !important;padding-left: 0px !important;padding-right: 0px !important;">
    <div class="row" style="margin-left: -29px !important; margin-right: -30px !important;">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title" style="border-bottom-color:#ffd300 !important;">
                    <h5><?php echo isset($sub_title) ? $sub_title : "NO TITLE PROVIDED" ?></h5>
                    <div class="ibox-tools" id="add_type">
                        <a data-toggle="modal" class="btn btn-primary btn-xs" data-toggle="tooltip" title="Add a District" data-placement="left"href="javascript:void(0)" onclick="add_new_city();"><i class="fa fa-plus"></i>ADD DISTRICT</a>
                    </div>
                </div>

                <div class="ibox-content" id="faculty_loader">
                    <div class="sk-spinner sk-spinner-wave">
                        <div class="sk-rect1"></div>
                        <div class="sk-rect2"></div>
                        <div class="sk-rect3"></div>
                        <div class="sk-rect4"></div>
                        <div class="sk-rect5"></div>
                    </div>

                    <div class="row">
                        <div class="col-lg-12">
                            <div id="curd-content" style="display: none;"></div>
                        </div>
                        <div class="col-lg-12">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover dataTables-example" id="tbl_city" >

                                    <thead>
                                        <tr>
                                            <th>District Name</th>
                                            <th>District Code</th>
                                            <th>State Name</th>                                
                                            <th>Status</th>                                
                                            <th>Task</th>                                
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        if (isset($city_data) && !empty($city_data) && is_array($city_data)) {
                                            foreach ($city_data as $city) {
                                               // echo $city['city_id'];
                                                ?>
                                                <tr>
                                                    <td> <?php echo $city['city_name']; ?></td>
                                                    <td> <?php echo $city['city_abbr']; ?></td>
                                                    <td> <?php echo $city['state_name']; ?></td>

                                                    <td data-toggle="tooltip" title="Slide for Enable/Disable">
                                                    <div class="switch">
                                                        <div class="onoffswitch">
                                                            <?php if ($city['isactive'] == 1) {
                                                                        $checked = "checked";
                                                                    } else {
                                                                        $checked = '';
                                                                    } ?>
                                                            <input type="checkbox" <?php echo $checked ?> class="onoffswitch-checkbox pick_status" 
                                                            onchange="change_status('<?php echo $city['city_id']; ?>', this)" 
                                                            id="<?php echo $city['city_id']; ?>">
                                                            <label class="onoffswitch-label" for="<?php echo $city['city_id']; ?>">
                                                                <span class="onoffswitch-inner"></span>
                                                                <span class="onoffswitch-switch"></span>
                                                            </label>
                                                        </div>
                                                    </div>

                                                        <?php if ($city['isactive'] == 1) { ?>                                                    
                                                            <!-- <input type="checkbox"  class="js-switch" data-toggle="tooltip" title="Slide for Enable/Disable" 
                                                            onchange="change_status('<?php echo $city['city_id'] ?>', this)" checked  id="t1" /> -->
                                                        <?php } else {
                                                            ?>
                                                            <!-- <input type="checkbox"  class="js-switch" data-toggle="tooltip" title="Slide for Enable/Disable" onchange="change_status('<?php echo $city['city_id'] ?>', this)"  id="" class="js-switch"  /> -->
                                                        <?php }
                                                        ?>
                                                    </td>
                                                    <td>
                                                        <a href="javascript:void(0)" class="btn btn-xs btn-info" onclick="edit_city('<?php echo $city['city_id']; ?>', '<?php echo $city['city_name']; ?>', '<?php echo $city['city_abbr']; ?>', '<?php echo $city['state_name']; ?>');" data-toggle="tooltip" data-placement="right" title="Edit <?php echo $city['city_name']; ?>" data-original-title="<?php echo $city['city_name']; ?>" ><i class="fa fa-edit" ></i>Update</a>                                                        
                                                    </td>
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
        </div>
    </div>
</div>


<script type="text/javascript">
    var list_switchery = [];
    $('#tbl_city').dataTable({

        columnDefs: [
            {"width": "25%", className: "capitalize", "targets": 0},
            {"width": "20%", className: "capitalize", "targets": 1},
            {"width": "25%", className: "capitalize", "targets": 2},
            {"width": "15%", className: "capitalize", "targets": 3, "orderable": false},
            {"width": "15%", className: "capitalize", "targets": 4, "orderable": false},
        ],
        responsive: true,
        dom: '<"html5buttons"B>lTfgitp',
        buttons: [
            {extend: 'copy'},
            {extend: 'csv', exportOptions: {
                    columns: [0, 1]
                }},
            {extend: 'excel', title: 'Report', exportOptions: {
                    columns: [0, 1]
                }}
        ],
        "fnDrawCallback": function (ele) {
            activateSwitchery();
        }


    });
    $('#tbl_city tbody').on('click', function (e) {
        activateSwitchery()
    });
    function activateSwitchery() {
        for (var i = 0; i < list_switchery.length; i++) {
            list_switchery[i].destroy();
            list_switchery[i].switcher.remove();
        }
        var list_checkbox = Array.prototype.slice.call(document.querySelectorAll('.js-switch'));
        list_checkbox.forEach(function (html) {
            var switchery = new Switchery(html, {color: '#23C6C8', secondaryColor: '#F8AC59', size: 'small'});
//        var switchery = new Switchery(html, {color: '#a9318a', size: 'small'});
            list_switchery.push(switchery);
        });
    }
    function toggle_city_add() {
        if ($('#add_type').html() > 100) {
            $('#add_type').html('<a href="javascript:void(0)" onclick="toggle_city_add();"><i class="fa fa-close" style="color:1ab394; font-size:30px;></i></a>');
            add_subject();
        } else {
            $('#add_type').html('<button type="button" class="btn bg-teal waves-effect" onclick="toggle_city_add();">NEW CITY</button>');
            var animation = "fadeOutDown";
            $('#curd-content').addClass('animated');
            $('#curd-content').addClass(animation);
            $('#curd-content').html('');
            $('#curd-content').hide();
        }
    }

    function change_status(city_id, element) {

        console.log($(element).prop("checked"));
        var status_type = $(element).prop("checked");
        if (status_type == true)
            status = 1;
        else
            status = -1;
        var ops_url = baseurl + 'city/status-edit-city/';
        $.ajax({
            type: "POST",
            cache: false,
            async: false,
            url: ops_url,
            data: {"load": 1, "city_id": city_id, "status": status},
            success: function (result) {
                var data = $.parseJSON(result);
                if (data.status == 1) {
                    if (status == -1) {
                        swal('District Updated', 'District Status Deactivated Successfully', 'success');
                        $('#faculty_loader').removeClass('sk-loading');
                        gs_count();
                        return true;
                    } else {
                        if (status == 1) {
                            swal('District Updated', 'District Status Activated Successfully', 'success');
                            $('#faculty_loader').removeClass('sk-loading');
                            gs_count();
                            return true;
                        }
                    }
                } else {

                    if (data.status == 0) {
                        swal({
                            title: '',
                            text: data.message,
                            type: 'info',
                            showCancelButton: false,
                            confirmButtonColor: '#3085d6',
                            cancelButtonColor: '#d33',
                            confirmButtonText: 'OK'
                        }, function (isConfirm) {
                            load_district();
//                               window.location.href = baseurl + "city/show-city";
                        });
                    } else {
                        if (data.status == 3) {
                            swal({
                                title: '',
                                text: data.message,
                                type: 'info',
                                showCancelButton: false,
                                confirmButtonColor: '#3085d6',
                                cancelButtonColor: '#d33',
                                confirmButtonText: 'OK'
                            }, function (isConfirm) {
//                                window.location.href = baseurl + "city/show-city";
                                load_district();
                            });
                        } else {
                            swal({
                                title: '',
                                text: 'District Status Updation Failed',
                                type: 'info',
                                showCancelButton: false,
                                confirmButtonColor: '#3085d6',
                                cancelButtonColor: '#d33',
                                confirmButtonText: 'OK'
                            }, function (isConfirm) {
//                                window.location.href = baseurl + "city/show-city";
                                load_district();
                            });
                        }

                    }
                }
            }
        });
    }
    $('.js-switch').change(function (e) {

    });


    $(".js-switch").click(function () {
    });



    function submit_data() {
        $('#faculty_loader').addClass('sk-loading');
        var ops_url = baseurl + 'city/add-city';
        var city_name = $('#city_name').val().toUpperCase();
        var city_abbr = $('#city_abbr').val().toUpperCase();
        var state_select = $('#state_select').val();
        if (city_name == '') {
            swal('', 'District Name is required.', 'info');
            $('#faculty_loader').removeClass('sk-loading');
            return false;
        }
        if (city_abbr == '') {
            swal('', 'District Abbreviation is required.', 'info');
            $('#faculty_loader').removeClass('sk-loading');
            return false;
        } else if (city_name.length > '30' || city_name.length < '3') {
            swal('', 'District Name should contain minimum 3 and maximum 30', 'info');
            $('#faculty_loader').removeClass('sk-loading');
            return false;
        } else if (city_abbr.length > '15' || city_abbr.length < '2') {
            swal('', 'District Abbreviations should contain minimum 2 and maximum 15', 'info');
            $('#faculty_loader').removeClass('sk-loading');
            return false;
        }
        var alphanumers = /^[a-zA-Z\s]+$/;
        if (!alphanumers.test($("#city_name").val())) {
            swal('', 'District Name can have only alphabets', 'info');
            $('#faculty_loader').removeClass('sk-loading');
            return false;
        } else if (!alphanumers.test($("#city_abbr").val())) {
            swal('', 'District Abbreviations can have only alphabets', 'info');
            $('#faculty_loader').removeClass('sk-loading');
            return false;
        }
        if (state_select == -1) {
            swal('', 'State is required.', 'info');
            $('#faculty_loader').removeClass('sk-loading');
            return false;
        }
        $.ajax({
            type: "POST",
            cache: false,
            async: false,
            url: ops_url,
            data: $('#city_save').serialize(),
            success: function (result) {
                var data = $.parseJSON(result)
                if (data.status == 1) {                    
                    gs_count();
                    $('#city_save').html('');
                    $('#city_save').html(data.view);
                    var city_data = [];
                    $.ajax({
                        type: "POST",
                        cache: false,
                        async: false,
                        url: baseurl + 'city/show-city',
                        data: {'load_reset': '1'},
                        success: function (result) {
                            city_data = JSON.parse(result);
                        },
                        error: function () {
                            alert('error');
                        }
                    });
                    var datatable = $('#tbl_city').dataTable().api();
                    datatable.clear();
                    datatable.rows.add(city_data).draw();

                    $('#add_type').show();
                    swal('Success', 'New District ' + city_name + ' created successfully.', 'success');
                    $('#faculty_loader').removeClass('sk-loading');
                    $("#curd-content").slideUp("slow", function () {
                        $("#curd-content").hide();
                    });
                    load_district();
                } else if (data.status == 2) {
                    $('#curd-content').html('');
                    $('#curd-content').html(data.view);
                    swal('', data.message, 'info');
                    $('#faculty_loader').removeClass('sk-loading');
                } else if (data.status == 3) {
                    $('#curd-content').html('');
                    $('#curd-content').html(data.view);
                    
                    $('#faculty_loader').removeClass('sk-loading');
                } else {
                    
                    $('#faculty_loader').removeClass('sk-loading');
                }

            }
        });
    }

    function submit_edit_save_data() {
        $('#faculty_loader').addClass('sk-loading');

        var ops_url = baseurl + 'city/edit-city';
        var city_name = $('#city_name').val().toUpperCase();
        var city_abbr = $('#city_abbr').val().toUpperCase();
        var state_select = $('#state_select').val();
        if (city_name == '') {
            swal('', 'District Name is required.', 'info');
            $('#faculty_loader').removeClass('sk-loading');
            return false;
        }
        if (city_abbr == '') {
            swal('', 'District Abbreviation is required.', 'info');
            $('#faculty_loader').removeClass('sk-loading');
            return false;
        } else if (city_name.length > '30' || city_name.length < '3') {
            swal('', 'District Name should contain minimum 3 and maximum 30', 'info');
            $('#faculty_loader').removeClass('sk-loading');
            return false;
        } else if (city_abbr.length > '15' || city_abbr.length < '2') {
            swal('', 'District Abbreviations should contain minimum 2 and maximum 15', 'info');
            $('#faculty_loader').removeClass('sk-loading');
            return false;
        }
        var alphanumers = /^[a-zA-Z\s]+$/;
        if (!alphanumers.test($("#city_name").val())) {
            swal('', 'District Name can have only alphabets', 'info');
            $('#faculty_loader').removeClass('sk-loading');
            return false;
        } else if (!alphanumers.test($("#city_abbr").val())) {
            swal('', 'District Abbreviations can have only alphabets', 'info');
            $('#faculty_loader').removeClass('sk-loading');
            return false;
        }
        if (state_select == -1) {
            swal('', 'State is required.', 'info');
            $('#faculty_loader').removeClass('sk-loading');
            return false;
        }

        $.ajax({
            type: "POST",
            cache: false,
            async: false,
            url: ops_url,
            data: $('#city_save').serialize(),
            success: function (result) {
                var data = $.parseJSON(result)
                if (data.status == 1) {
                    $('#city_save').html('');
                    $('#city_save').html(data.view);
                    var city_data = [];
                    $.ajax({
                        type: "POST",
                        cache: false,
                        async: false,
                        url: baseurl + 'city/show-city',
                        data: {'load_reset': '1'},
                        success: function (result) {
                            city_data = JSON.parse(result);
                        },
                        error: function () {
                            alert('error');
                        }
                    });
                    var datatable = $('#tbl_city').dataTable().api();
                    datatable.clear();
                    datatable.rows.add(city_data).draw();
                    $('#add_type').show();
                    swal('Success', 'District ' + city_name + ' Updated successfully.', 'success');
                    $('#faculty_loader').removeClass('sk-loading');
                    $('#state_select').select2({
                        'theme': 'bootstrap'
                    });
                    $("#curd-content").slideUp("slow", function () {
                        $("#curd-content").hide();
                    });
                    load_district();
                } else if (data.status == 2) {
                    $('#curd-content').html('');
                    $('#curd-content').html(data.view);
                    swal('', data.message, 'info');
                    $('#state_select').select2({
                        'theme': 'bootstrap'
                    });
                    $('#faculty_loader').removeClass('sk-loading');
                } else if (data.status == 3) {
                    $('#curd-content').html('');
                    $('#curd-content').html(data.view);
                    swal('', data.message, 'info');
                    $('#state_select').select2({
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
        $('#city_name').val('');
        $('#city_name').parent().removeAttr('class', 'has-error');
        $('#city_abbr').val('');
        $('#city_abbr').parent().removeAttr('class', 'has-error');
        $('#state_select').select2('val', -1);
    }


    function close_add_city() {
        $('#add_type').show();
        $("#curd-content").slideUp("slow", function () {
            $("#curd-content").hide();
        });

    }

    function add_new_city() {
        var ops_url = baseurl + 'city/add-city';
        $.ajax({
            type: "POST",
            cache: false,
            async: false,
            url: ops_url,
            data: {"load": 1},
            success: function (data) {
                if (data) {
                    $('#curd-content').html(data);
                    var animation = "fadeInDown";
                    $("#curd-content").show();
                    $('#curd-content').addClass('animated');
                    $('#curd-content').addClass(animation);
                    $('#add_type').hide();
                    $('#state_select').select2({
                        'theme': 'bootstrap'
                    });
                } else {
                    alert('No data loaded');
                }
            }
        });
    }

    function edit_city(city_id, name, code, state) {
        var ops_url = baseurl + 'city/edit-city';
        $.ajax({
            type: "POST",
            cache: false,
            async: false,
            url: ops_url,
            data: {"load": 1, "city_id": city_id, "city_name": name, "city_abbr": code, "state_select": state},
            success: function (result) {
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
                    $('#state_select').select2({
                        'theme': 'bootstrap'
                    });
                    $("html,body").animate({scrollTop:0}).slow();
                } else {
                    alert('No data loaded');
                }
            }
        });
    }
</script>


