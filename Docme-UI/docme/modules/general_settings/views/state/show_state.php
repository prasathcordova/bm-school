
<div class="wrapper wrapper-content animated fadeInRight" style="padding-top: 1px !important;padding-left: 0px !important;padding-right: 0px !important;">
    <div class="row" style="margin-left: -29px !important; margin-right: -30px !important;">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title" style="border-bottom-color:#ffd300 !important;">
                    <h5><?php echo isset($sub_title) ? $sub_title : "NO TITLE PROVIDED" ?></h5>
                    <div class="ibox-tools" id="add_type">
                        <a data-toggle="modal" class="btn btn-primary btn-xs" data-toggle="tooltip" title="Add a State" data-placement="left"href="javascript:void(0)" onclick="add_new_state();"><i class="fa fa-plus"></i>ADD STATE</a>
                    </div>
                </div>


                <div class="ibox-content" id ="faculty_loader">
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
                                <table class="table table-striped table-bordered table-hover dataTables-example" id="tbl_state" >

                                    <thead>
                                        <tr>
                                            <th>State Name</th>
                                            <th>State Abbreviation</th>
                                            <th>Country Name</th> 
                                            <th>Status</th>                                
                                            <th>Task</th>                              
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        if (isset($state_data) && !empty($state_data) && is_array($state_data)) {
//                                            dev_export($state_data);die;
                                            foreach ($state_data as $state) {
                                                ?>
                                                <tr>

                                                    <td> <?php echo $state['state_name']; ?></td>
                                                    <td> <?php echo $state['state_abbr']; ?></td>
                                                    <td> <?php echo $state['country_name']; ?></td>


                                                    <td data-toggle="tooltip" title="Slide for Enable/Disable">
                                                    <div class="switch">
                                                        <div class="onoffswitch">
                                                            <?php if ($state['isactive'] == 1) {
                                                                        $checked = "checked";
                                                                    } else {
                                                                        $checked = '';
                                                                    } ?>
                                                            <input type="checkbox" <?php echo $checked ?> class="onoffswitch-checkbox pick_status" 
                                                            onchange="change_status('<?php echo $state['state_id']; ?>',  this)" 
                                                            id="<?php echo $state['state_id']; ?>">
                                                            <label class="onoffswitch-label" for="<?php echo $state['state_id']; ?>">
                                                                <span class="onoffswitch-inner"></span>
                                                                <span class="onoffswitch-switch"></span>
                                                            </label>
                                                        </div>
                                                    </div>

                                                       
                                                    </td>
                                                    <td>
                                                        <a href="javascript:void(0);" class="btn btn-xs btn-info" onclick="edit_state('<?php echo $state['state_id']; ?>', '<?php echo $state['state_name']; ?>', '<?php echo $state['state_abbr']; ?>', '<?php echo $state['country_id']; ?>');"  data-toggle="tooltip" data-placement="right" title="Edit <?php echo $state['state_name']; ?>" data-original-title="<?php echo $state['state_name']; ?>"  ><i class="fa fa-edit" ></i>Update</a>
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
     $('#tbl_state tbody').on('click', function (e) {
        activateSwitchery()
    });
    var list_switchery = [];
    $('#tbl_state').dataTable({

        columnDefs: [
            {"width": "30%", className: "capitalize", "targets": 0},
            {"width": "20%", className: "capitalize", "targets": 1},
            {"width": "25%", className: "capitalize", "targets": 2},
            {"width": "10%", className: "capitalize", "targets": 3, "orderable": false},
            {"width": "15%", className: "capitalize", "targets": 4, "orderable": false}
        ],
        responsive: true,
        dom: '<"html5buttons"B>lTfgitp',
        buttons: [
            {extend: 'copy'},
            {extend: 'csv', exportOptions: {
                    columns: [0, 1, 3]
                }},
            {extend: 'excel', title: 'Report', exportOptions: {
                    columns: [0, 1, 3]
                }}
        ],
        "fnDrawCallback": function (ele) {
            activateSwitchery();
        }
    });

    $(document).ready(function () {
        activateSwitchery();

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

    function toggle_state_add() {
        if ($('#add_type').html() > 100) {
            $('#add_type').html('<a href="javascript:void(0)" onclick="toggle_state_add();"><i class="fa fa-close" style="color:1ab394; font-size:30px;></i></a>');
            add_state();
        } else {
            $('#add_type').html('<button type="button" class="btn bg-teal waves-effect" onclick="toggle_state_add();">NEW STATE</button>');
            var animation = "fadeOutDown";
            $('#curd-content').addClass('animated');
            $('#curd-content').addClass(animation);
            $('#curd-content').html('');
            $('#curd-content').hide();
        }
    }

    function change_status(state_id, element) {
        $('#faculty_loader').addClass('sk-loading');

//        console.log($(element).prop("checked"));
        var status_type = $(element).prop("checked");
        if (status_type == true)
            status = 1;
        else
            status = -1;
        var ops_url = baseurl + 'state/change_status/';
        $.ajax({
            type: "POST",
            cache: false,
            async: false,
            url: ops_url,
            data: {"load": 1, "state_id": state_id, "status": status},
            success: function (result) {
                var data = $.parseJSON(result);
                if (data.status == 1) {
                    if (status == -1) {
                        swal('State Updated', 'State Status Deactivated Successfully', 'success');
                        $('#faculty_loader').removeClass('sk-loading');
                        gs_count();
                        return true;
                    } else {
                        if (status == 1) {
                            swal('State Updated', 'State Status Activated Successfully', 'success');
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
//                            window.location.href = baseurl + "state/show-state";
                            load_state();
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
//                                window.location.href = baseurl + "state/show-state";
                                load_state();
                            });
                        } else {
                            swal({
                                title: '',
                                text: 'State Status Updation Failed',
                                type: 'info',
                                showCancelButton: false,
                                confirmButtonColor: '#3085d6',
                                cancelButtonColor: '#d33',
                                confirmButtonText: 'OK'
                            }, function (isConfirm) {
//                                window.location.href = baseurl + "state/show-state";
                                load_state();
                            });
                        }

                    }
                }
            }
        });
    }
    // $('.js-switch').change(function (e) {

    // });


    // $(".js-switch").click(function () {
    // });

    function submit_data() {
        $('#faculty_loader').addClass('sk-loading');

        var ops_url = baseurl + 'state/add-state/';
        var state_name = $('#state_name').val().toUpperCase();
        var state_abbr = $('#state_abbr').val().toUpperCase();
        var country_select = $('#country_select').val();
        if (country_select == -1) {
            swal('', 'Country is required.', 'info');
            $('#faculty_loader').removeClass('sk-loading');
            return false;
        }
        if (state_name == '') {
            swal('', 'State Name is required.', 'info');
            $('#faculty_loader').removeClass('sk-loading');
            return false;
        } else if (state_name.length > 30 || state_name.length < 3) {
            swal('', 'State Name should contain minimum 3 and maximum 30 characters', 'info');
            $('#faculty_loader').removeClass('sk-loading');
            return false;
        }
        if (state_abbr == '') {
            swal('', 'State Abbreviation Required', 'info');
            $('#faculty_loader').removeClass('sk-loading');
            return false;
        } else if (state_abbr.length > 15 || state_abbr.length < 2) {
            swal('', 'State Abbreviation should contain minimum 2 and maximum 15 characters', 'info');
            $('#faculty_loader').removeClass('sk-loading');
            return false;
        }
        var alphanumers = /^[a-zA-Z\s]+$/;
        if (!alphanumers.test($("#state_name").val())) {
            swal('', 'State Name can have only alphabets', 'info');
            $('#faculty_loader').removeClass('sk-loading');
            return false;
        } else if (!alphanumers.test($("#state_abbr").val())) {
            swal('', 'State Abbreviation can have only alphabets', 'info');
            $('#faculty_loader').removeClass('sk-loading');
            return false;
        }
        $.ajax({
            type: "POST",
            cache: false,
            async: false,
            url: ops_url,
            data: $('#state_save').serialize(),
            success: function (result) {
                var data = $.parseJSON(result)
                if (data.status == 1) {                   
                    gs_count();
                    $('#state_save').html('');
                    $('#state_save').html(data.view);
                    var state_data = [];
                    $.ajax({
                        type: "POST",
                        cache: false,
                        async: false,
                        url: baseurl + 'state/show-state',
                        data: {'load_reset': '1'},
                        success: function (result) {
                            state_data = JSON.parse(result);
                        },
                        error: function () {
                            alert('error');
                        }
                    });
                    var datatable = $('#tbl_state').dataTable().api();
                    datatable.clear();
                    datatable.rows.add(state_data).draw();

                    $('#add_type').show();
                    swal('Success', 'New State ' + state_name + ' created successfully.', 'success');
                    $('#faculty_loader').removeClass('sk-loading');
                    $("#curd-content").slideUp("slow", function () {
                        $("#curd-content").hide();
                    });
                    $('#country_select').select2({
                        'theme': 'bootstrap'
                    });
                    load_state();
                } else if (data.status == 2) {
                    $('#curd-content').html('');
                    $('#curd-content').html(data.view);
                    swal('', data.message, 'info');
                    $('#country_select').select2({
                        'theme': 'bootstrap'
                    });
                    $('#faculty_loader').removeClass('sk-loading');
                } else if (data.status == 3) {
                    $('#curd-content').html('');
                    $('#curd-content').html(data.view);
//                    activate_toast(data.message, 'Error', 'error');
                    $('#country_select').select2({
                        'theme': 'bootstrap'
                    });
                    $('#faculty_loader').removeClass('sk-loading');
                    
                } else {
                    activate_toast("Connection Error", 'Error', 'error');
                    $('#faculty_loader').removeClass('sk-loading');
                }

            }
        });
    }


    function refresh_add_panel() {
        $('#state_name').val('');
        $('#state_name').parent().removeAttr('class', 'has-error');
        $('#state_abbr').val('');
        $('#state_abbr').parent().removeAttr('class', 'has-error');
        $('#country_select').select2('val', -1);
    }


    function close_add_state() {
        $('#add_type').show();
        $("#curd-content").slideUp("slow", function () {
            $("#curd-content").hide();
        });

    }

    function submit_edit_save_data() {
        $('#faculty_loader').addClass('sk-loading');

        var ops_url = baseurl + 'state/edit-state';
        var state_name = $('#state_name').val().toUpperCase();
        var state_abbr = $('#state_abbr').val().toUpperCase();
        var country_select = $('#country_select').val();
        if (country_select == -1) {
            swal('', 'Country is required.', 'info');
            $('#faculty_loader').removeClass('sk-loading');
            return false;
        }
        if (state_name == '') {
            swal('', 'State Name Required', 'info');
            $('#faculty_loader').removeClass('sk-loading');
            return false;
        }
        if (state_abbr == '') {
            swal('', 'State Abbreviation Required', 'info');
            $('#faculty_loader').removeClass('sk-loading');
            return false;
        } else if (state_name.length > '30' || state_name.length < '3') {
            swal('', 'State Name should contain minimum 3 and maximum 30 characters', 'info');
            $('#faculty_loader').removeClass('sk-loading');
            return false;
        } else if (state_abbr.length > '15' || state_abbr.length < '2') {
            swal('', 'State Abbreviation should contain minimum 2 and maximum 15 characters', 'info');
            $('#faculty_loader').removeClass('sk-loading');
            return false;
        }
        var alphanumers = /^[a-zA-Z\s]+$/;
        if (!alphanumers.test($("#state_name").val())) {
            swal('', 'State Name can have only alphabets', 'info');
            $('#faculty_loader').removeClass('sk-loading');
            return false;
        } else if (!alphanumers.test($("#state_abbr").val())) {
            swal('', 'State Abbreviation can have only alphabets', 'info');
            $('#faculty_loader').removeClass('sk-loading');
            return false;
        }

        $.ajax({
            type: "POST",
            cache: false,
            async: false,
            url: ops_url,
            data: $('#state_save').serialize(),
            success: function (result) {
                var data = $.parseJSON(result)
                if (data.status == 1) {
                    $('#state_save').html('');
                    $('#state_save').html(data.view);
                    var state_data = [];
                    $.ajax({
                        type: "POST",
                        cache: false,
                        async: false,
                        url: baseurl + 'state/show-state',
                        data: {'load_reset': '1'},
                        success: function (result) {
                            state_data = JSON.parse(result);
                        },
                        error: function () {
                            alert('error');
                        }
                    });
                    var datatable = $('#tbl_state').dataTable().api();
                    datatable.clear();
                    datatable.rows.add(state_data).draw();
                    $('#add_type').show();
                    swal('Success', 'State ' + state_name + ' Updated successfully.', 'success');
                    $('#faculty_loader').removeClass('sk-loading');
                    $("#curd-content").slideUp("slow", function () {
                        $("#curd-content").hide();
                    });
                    $('#country_select').select2({
                        'theme': 'bootstrap'
                    });
                    load_state();
                } else if (data.status == 2) {
                    $('#curd-content').html('');
                    $('#curd-content').html(data.view);
                    swal('', data.message, 'info');
                    $('#country_select').select2({
                        'theme': 'bootstrap'
                    });
                    $('#faculty_loader').removeClass('sk-loading');
                } else if (data.status == 3) {
                    $('#curd-content').html('');
                    $('#curd-content').html(data.view);
                    swal('', data.message, 'info');
                    $('#country_select').select2({
                        'theme': 'bootstrap'
                    });
                    $('#faculty_loader').removeClass('sk-loading');
                    activate_toast(data.message, 'Error', 'error');
                } else {
                    swal('', 'Connection Error. Please contact administrator', 'info');
                    $('#faculty_loader').removeClass('sk-loading');
//                    activate_toast("Connection Error", 'Error', 'error');
                }

            }
        });
    }


    function edit_state(state_id, name, code, country) {
        var ops_url = baseurl + 'state/edit-state';
        $.ajax({
            type: "POST",
            cache: false,
            async: false,
            url: ops_url,
            data: {"load": 1, "state_id": state_id, "state_name": name, "state_abbr": code, "country_id": country},
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
                    $('#country_select').select2({
                        'theme': 'bootstrap'
                    });
                    $('html,body').animate({scrollTop:0}).slow();
                } else {
                    alert('No data loaded');
                }
            }
        });
    }

    function add_new_state() {
        var ops_url = baseurl + 'state/add-state';
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
                    $('#country_select').select2({
                        'theme': 'bootstrap'
                    });
                } else {
                    alert('No data loaded');
                }
            }
        });
    }



</script>


