
<div class="wrapper wrapper-content animated fadeInRight" style="padding-top: 1px !important;padding-left: 0px !important;padding-right: 0px !important;">
    <div class="row" style="margin-left: -29px !important; margin-right: -30px !important;">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title" style="border-bottom-color:#ffd300 !important;">
                    <h5><?php echo isset($sub_title) ? $sub_title : "NO TITLE PROVIDED" ?></h5>
                    <div class="ibox-tools" id="add_type">
                        <a data-toggle="modal" class="btn btn-primary btn-xs" data-toggle="tooltip" title="Add a Religion" data-placement="left"href="javascript:void(0)" onclick="add_new_religion();"><i class="fa fa-plus"></i>ADD RELIGION</a>
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
                                <table class="table table-striped table-bordered table-hover dataTables-example" id="tbl_religion" >

                                    <thead>
                                        <tr>
                                            <th>Religion Name</th>
                                            <th>Status</th>                                
                                            <th>Task</th>                              
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        if (isset($religion_data) && !empty($religion_data) && is_array($religion_data)) {
                                            foreach ($religion_data as $religion) {
                                                ?>
                                                <tr>
                                                    <td><?php echo $religion['religion_name'] ?></td>


                                                    <td data-toggle="tooltip" title="Slide for Enable/Disable">
                                                    <div class="switch">
                                                        <div class="onoffswitch">
                                                            <?php if ($religion['isactive'] == 1) {
                                                                        $checked = "checked";
                                                                    } else {
                                                                        $checked = '';
                                                                    } ?>
                                                            <input type="checkbox" <?php echo $checked ?> class="onoffswitch-checkbox pick_status" 
                                                            onchange="change_status('<?php echo $religion['religion_id']; ?>',  this)" 
                                                            id="<?php echo $religion['religion_id']; ?>">
                                                            <label class="onoffswitch-label" for="<?php echo $religion['religion_id']; ?>">
                                                                <span class="onoffswitch-inner"></span>
                                                                <span class="onoffswitch-switch"></span>
                                                            </label>
                                                        </div>
                                                    </div>

                                                        <?php if ($religion['isactive'] == 1) { ?> 
                                                            <!-- <input type="checkbox"  class="js-switch" data-toggle="tooltip" title="Slide for Enable/Disable" onchange="change_status('<?php echo $religion['religion_id'] ?>', this)" checked  id="t1" />                                                         -->

                                                        <?php } else {
                                                            ?>
                                                            <!-- <input type="checkbox"  class="js-switch" data-toggle="tooltip" title="Slide for Enable/Disable" onchange="change_status('<?php echo $religion['religion_id'] ?>', this)"  id="" class="js-switch"  />                                                                                                             -->
                                                        <?php }
                                                        ?>
                                                    </td> 
                                                    <td>
                                                        <a href="javascript:void(0)" class="btn btn-xs btn-info" onclick="edit_religion('<?php echo $religion['religion_id']; ?>', '<?php echo $religion['religion_name']; ?>');"  data-toggle="tooltip" data-placement="right" title="Edit <?php echo $religion['religion_name']; ?>" data-original-title="<?php echo $religion['religion_name']; ?>"  ><i class="fa fa-edit" ></i>Update</a>
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

      $('#tbl_religion tbody').on('click', function (e) {
        activateSwitchery()
    });
    var list_switchery = [];
    $('#tbl_religion').dataTable({
        columnDefs: [
            {"width": "50%", className: "capitalize", "targets": 0},
            {"width": "25%", className: "capitalize", "targets": 1, "orderable": false},
            {"width": "25%", className: "capitalize", "targets": 2, "orderable": false}
        ],
        responsive: true,
        iDisplayLength: 10,
        dom: '<"html5buttons"B>lTfgitp',
        buttons: [
            {extend: 'copy'},
            {extend: 'csv', exportOptions: {
                    columns: [0]
                }},
            {extend: 'excel', title: 'Report', exportOptions: {
                    columns: [0]
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


    function toggle_religion_add() {
        if ($('#add_type').html() > 100) {
            $('#add_type').html('<a href="javascript:void(0)" onclick="toggle_religion_add();"><i class="fa fa-close" style="color:1ab394; font-size:30px;></i></a>');
            add_religion();
        } else {
            $('#add_type').html('<button type="button" class="btn bg-teal waves-effect" onclick="toggle_religion_add();">NEW RELIGION</button>');
            var animation = "fadeOutDown";
            $('#curd-content').addClass('animated');
            $('#curd-content').addClass(animation);
            $('#curd-content').html('');
            $('#curd-content').hide();
        }
    }


    function change_status(religion_id, element) {
        $('#faculty_loader').addClass('sk-loading');
        var status_type = $(element).prop("checked");
        if (status_type == true)
            status = 1;
        else
            status = -1;
        var ops_url = baseurl + 'religion/change_status/';
        $.ajax({
            type: "POST",
            cache: false,
            async: false,
            url: ops_url,
            data: {"load": 1, "religion_id": religion_id, "status": status},
            success: function (result) {
                var data = $.parseJSON(result);
                if (data.status == 1) {
                    if (status == -1) {
                        swal('Religion Updated', 'Religion Status Deactivated Successfully', 'success');
                        $('#faculty_loader').removeClass('sk-loading');
                        gs_count();
                        return true;
                    } else {
                        if (status == 1) {
                            swal('Religion Updated', 'Religion Status Activated Successfully', 'success');
                            $('#faculty_loader').removeClass('sk-loading');
                            gs_count();
                            return true;
                        }
                    }
                } else {
                    if (data.status == 0) {
//                        swal('Error', data.message, 'error');
                        swal({
                            title: '',
                            text: data.message,
                            type: 'info',
                            showCancelButton: false,
                            confirmButtonColor: '#3085d6',
                            cancelButtonColor: '#d33',
                            confirmButtonText: 'OK'
                        }, function (isConfirm) {
//                            window.location.href = baseurl + "religion/show-religion";
                            load_religion();
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
//                                window.location.href = baseurl + "religion/show-religion";
                                load_religion();
                            });
                        } else {
                            swal({
                                title: '',
                                text: 'Religion Status Updation Failed',
                                type: 'info',
                                showCancelButton: false,
                                confirmButtonColor: '#3085d6',
                                cancelButtonColor: '#d33',
                                confirmButtonText: 'OK'
                            }, function (isConfirm) {
//                                window.location.href = baseurl + "religion/show";
                                load_religion();
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

    function add_new_religion() {
        var ops_url = baseurl + 'religion/add-religion/';
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
                } else {
                    alert('No data loaded');
                }
            }
        });
    }

    function submit_data() {
        $('#faculty_loader').addClass('sk-loading');
        var ops_url = baseurl + 'religion/add-religion';
        var religion_name = $('#religion_name').val().toUpperCase();
        if (religion_name == '') {
            swal('', 'Religion Name is required.', 'info');
            $('#faculty_loader').removeClass('sk-loading');
            return false;
        } else if (religion_name.length > '30' || religion_name.length < '3') {
            swal('', 'Religion Name should contain minimum 3 and maximum 30 characters', 'info');
            $('#faculty_loader').removeClass('sk-loading');
            return false;
        }

        var alphanumers = /^[a-zA-Z\s]+$/;
        if (!alphanumers.test($("#religion_name").val())) {
            swal('', 'Religion Name can have only alphabets', 'info');
            $('#faculty_loader').removeClass('sk-loading');
            return false;
        }

        $.ajax({
            type: "POST",
            cache: false,
            async: false,
            url: ops_url,
            data: $('#religion_save').serialize(),
            success: function (result) {
                var data = $.parseJSON(result)
                if (data.status == 1) {                 
                    gs_count();
                    $('#religion_save').html('');
                    $('#religion_save').html(data.view);
                    var religion_data = [];
                    $.ajax({
                        type: "POST",
                        cache: false,
                        async: false,
                        url: baseurl + 'religion/show-religion',
                        data: {'load_reset': '1'},
                        success: function (result) {
                            religion_data = JSON.parse(result);
                        },
                        error: function () {
                            alert('error');
                        }
                    });
                    var datatable = $('#tbl_religion').dataTable().api();
                    datatable.clear();
                    datatable.rows.add(religion_data).draw();
                    $('#add_type').show();
                    swal('Success', 'New Religion, ' + religion_name + ' created successfully.', 'success');
                    $('#faculty_loader').removeClass('sk-loading');
                    $("#curd-content").slideUp("slow", function () {
                        $("#curd-content").hide();
                    });
                    load_religion();
                } else if (data.status == 2) {
                    $('#curd-content').html('');
                    $('#curd-content').html(data.view);
                    swal('', 'Religion Name Already Exists', 'info');
                    $('#faculty_loader').removeClass('sk-loading');
                } else if (data.status == 3) {
                    $('#curd-content').html('');
                    $('#curd-content').html(data.view);
                    swal('', data.message, 'info');
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

    function submit_edit_save_data() {
        $('#faculty_loader').addClass('sk-loading');
        var ops_url = baseurl + 'religion/edit-religion';
        var religion_name = $('#religion_name').val().toUpperCase();
        if (religion_name == '') {
            swal('', 'Religion Name Required', 'info');
            $('#faculty_loader').removeClass('sk-loading');
            return false;
        } else if (religion_name.length > '30' || religion_name.length < '3') {
            swal('', 'Religion Name should contain minimum 3 and maximum 30 characters', 'info');
            $('#faculty_loader').removeClass('sk-loading');
            return false;
        }

        var alphanumers = /^[a-zA-Z\s]+$/;
        if (!alphanumers.test($("#religion_name").val())) {
            swal('', 'Religion Name can have only alphabets', 'info');
            $('#faculty_loader').removeClass('sk-loading');
            return false;
        }
        $.ajax({
            type: "POST",
            cache: false,
            async: false,
            url: ops_url,
            data: $('#religion_save').serialize(),
            success: function (result) {
                var data = $.parseJSON(result)
                if (data.status == 1) {
                    $('#religion_save').html('');
                    $('#religion_save').html(data.view);
                    var religion_data = [];
                    $.ajax({
                        type: "POST",
                        cache: false,
                        async: false,
                        url: baseurl + 'religion/show-religion',
                        data: {'load_reset': '1'},
                        success: function (result) {
                            religion_data = JSON.parse(result);
                        },
                        error: function () {
                            alert('error');
                        }
                    });
                    var datatable = $('#tbl_religion').dataTable().api();
                    datatable.clear();
                    datatable.rows.add(religion_data).draw();
                    $('#add_type').show();
                    swal('Success', 'Religion, ' + religion_name + ' updated successfully.', 'success');
                    $('#faculty_loader').removeClass('sk-loading');
                    $("#curd-content").slideUp("slow", function () {
                        $("#curd-content").hide();
                    });
                    load_religion();
                } else if (data.status == 2) {
                    $('#curd-content').html('');
                    $('#curd-content').html(data.view);
                    swal('', 'Religion Name Already Exists', 'info');
                    $('#faculty_loader').removeClass('sk-loading');
                } else if (data.status == 3) {
                    $('#curd-content').html('');
                    $('#curd-content').html(data.view);
                    swal('', data.message, 'info');
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
        $('#religion_name').val('');
        $('#religion_name').parent().removeAttr('class', 'has-error');

    }

    function edit_religion(religion_id, name) {
        var ops_url = baseurl + 'religion/edit-religion/';
        $.ajax({
            type: "POST",
            cache: false,
            async: false,
            url: ops_url,
            data: {"load": 1, "religion_id": religion_id, "religion_name": name},
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
                } else {
                    alert('No data loaded');
                }
            }
        });
    }

    function close_add_religion() {
        $('#add_type').show();
        $("#curd-content").slideUp("slow", function () {
            $("#curd-content").hide();
        });

    }
</script>
