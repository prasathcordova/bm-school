
<div class="wrapper wrapper-content animated fadeInRight" style="padding-top: 1px !important;padding-left: 0px !important;padding-right: 0px !important;">
    <div class="row" style="margin-left: -29px !important; margin-right: -30px !important;">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title" style="border-bottom-color:#ffd300 !important;">
                    <h5><?php echo isset($sub_title) ? $sub_title : "NO TITLE PROVIDED" ?></h5>
                    <div class="ibox-tools" id="add_type">
                        <a data-toggle="modal" class="btn btn-primary btn-xs" data-toggle="tooltip" title="Add a Language" data-placement="left"href="javascript:void(0)" onclick="add_new_language();"><i class="fa fa-plus"></i>ADD LANGUAGE</a>
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
                                <table class="table table-striped table-bordered table-hover dataTables-example" id="tbl_language" >

                                    <thead>
                                        <tr>
                                            <th>Language</th>
                                            <th>Status</th>                                
                                            <th>Task</th>                              
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        if (isset($language_data) && !empty($language_data) && is_array($language_data)) {
                                            foreach ($language_data as $language) {
                                                ?>
                                                <tr>
                                                    <td><?php echo $language['language_name'] ?></td>


                                                    <td data-toggle="tooltip" title="Slide for Enable/Disable">
                                                    <div class="switch">
                                                        <div class="onoffswitch">
                                                            <?php if ($language['isactive'] == 1) {
                                                                        $checked = "checked";
                                                                    } else {
                                                                        $checked = '';
                                                                    } ?>
                                                            <input type="checkbox" <?php echo $checked ?> class="onoffswitch-checkbox pick_status" 
                                                            onchange="change_status('<?php echo $language['language_id']; ?>',  this)" 
                                                            id="<?php echo $language['language_id']; ?>">
                                                            <label class="onoffswitch-label" for="<?php echo $language['language_id']; ?>">
                                                                <span class="onoffswitch-inner"></span>
                                                                <span class="onoffswitch-switch"></span>
                                                            </label>
                                                        </div>
                                                    </div>

                                                        <?php if ($language['isactive'] == 1) { ?> 
                                                            <!-- <input type="checkbox"  class="js-switch" data-toggle="tooltip" title="Slide for Enable/Disable" onchange="change_status('<?php echo $language['language_id'] ?>', this)" checked  id="t1" />                                                         -->

                                                        <?php } else {
                                                            ?>
                                                            <!-- <input type="checkbox"  class="js-switch" data-toggle="tooltip" title="Slide for Enable/Disable" onchange="change_status('<?php echo $language['language_id'] ?>', this)"  id="" class="js-switch"  />                                                                                                             -->
                                                        <?php }
                                                        ?>
                                                    </td> 
                                                    <td>
                                                        <a href="javascript:void(0)" class="btn btn-xs btn-info" onclick="edit_language('<?php echo $language['language_id']; ?>', '<?php echo $language['language_name']; ?>');"  data-toggle="tooltip" data-placement="right" title="Edit <?php echo $language['language_name']; ?>" data-original-title="<?php echo $language['language_name']; ?>"  ><i class="fa fa-edit" ></i>Update</a>
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
   $('#tbl_language tbody').on('click', function (e) {
        activateSwitchery()
    });
    var list_switchery = [];
    $('#tbl_language').dataTable({
        columnDefs: [
            {"width": "50%", className: "capitalize", "targets": 0},
            {"width": "25%", className: "capitalize", "targets": 1, "orderable": false},
            {"width": "25%", className: "capitalize", "targets": 2, "orderable": false},
//            {"width": "15%", className: "capitalize", "targets": 3, "orderable": false}
        ],
        responsive: true,
        iDisplayLength: 10,
        dom: '<"html5buttons"B>lTfgitp',
        buttons: [
            {extend: 'copy'},
            {extend: 'csv',
                exportOptions: {
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


    function toggle_language_add() {
        if ($('#add_type').html() > 100) {
            $('#add_type').html('<a href="javascript:void(0)" onclick="toggle_language_add();"><i class="fa fa-close" style="color:1ab394; font-size:30px;></i></a>');
            add_language();
        } else {
            $('#add_type').html('<button type="button" class="btn bg-teal waves-effect" onclick="toggle_language_add();">NEW LANGUAGE</button>');
            var animation = "fadeOutDown";
            $('#curd-content').addClass('animated');
            $('#curd-content').addClass(animation);
            $('#curd-content').html('');
            $('#curd-content').hide();
        }
    }

    function change_status(languageid, element) {
        $('#faculty_loader').addClass('sk-loading');
        var status_type = $(element).prop("checked");
        if (status_type == true)
            status = 1;
        else
            status = -1;
        var ops_url = baseurl + 'language/change_status/';
        $.ajax({
            type: "POST",
            cache: false,
            async: false,
            url: ops_url,
            data: {"load": 1, "language_id": languageid, "status": status},
            success: function (result) {
                var data = $.parseJSON(result);

                if (data.status == 1) {
                    if (status == -1) {
                        swal('Language Updated', 'Language Status Deactivated Successfully', 'success');
                        $('#faculty_loader').removeClass('sk-loading');
                        gs_count();
                        return true;
                    } else {
                        if (status == 1) {
                            swal('Language Updated', 'Language Status Activated Successfully', 'success');
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
                            load_language();
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
                                load_language();
                            });
                        } else {
                            swal({
                                title: '',
                                text: 'Language Status Updation Failed',
                                type: 'info',
                                showCancelButton: false,
                                confirmButtonColor: '#3085d6',
                                cancelButtonColor: '#d33',
                                confirmButtonText: 'OK'
                            }, function (isConfirm) {
                                load_language();
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

    function add_new_language() {
        var ops_url = baseurl + 'language/add-language/';
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
        var ops_url = baseurl + 'language/add-language';
        var language_name = $('#language_name').val().toUpperCase();

        if (language_name == '') {
            swal('', 'Language is required.', 'info');
            $('#faculty_loader').removeClass('sk-loading');
            return false;
        } else if ((language_name.length > '30') || (language_name.length < '3')) {
            swal('', 'Language should contain letters 3 to 30', 'info');
            $('#faculty_loader').removeClass('sk-loading');
            return false;
        }
        var alphanumers = /^[a-zA-Z]+$/;
        if (!alphanumers.test($("#language_name").val())) {
            swal('', 'Language can have only alphabets', 'info');
            $('#faculty_loader').removeClass('sk-loading');
            return false;
        }

        $.ajax({
            type: "POST",
            cache: false,
            async: false,
            url: ops_url,
            data: $('#language_save').serialize(),
            success: function (result) {
                var data = $.parseJSON(result)
                if (data.status == 1) {                    
                    gs_count();
                    $('#language_save').html('');
                    $('#language_save').html(data.view);
                    var language_data = [];
                    $.ajax({
                        type: "POST",
                        cache: false,
                        async: false,
                        url: baseurl + 'language/show-language',
                        data: {'load_reset': '1'},
                        success: function (result) {
                            language_data = JSON.parse(result);
                        },
                        error: function () {
                            alert('error');
                        }
                    });
                    var datatable = $('#tbl_language').dataTable().api();
                    datatable.clear();
                    datatable.rows.add(language_data).draw();
                    $('#add_type').show();
                    swal('Success', 'New Language, ' + language_name + ' created successfully.', 'success');
                    $('#faculty_loader').removeClass('sk-loading');
                    $("#curd-content").slideUp("slow", function () {
                        $("#curd-content").hide();
                    });
                    load_language();
                } else if (data.status == 2) {
                    $('#curd-content').html('');
                    $('#curd-content').html(data.view);
                    swal('', data.message, 'info');
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
        var ops_url = baseurl + 'language/edit-language';
        var language_name = $('#language_name').val().toUpperCase();

        if (language_name == '') {
            swal('', 'Language is required.', 'info');
            $('#faculty_loader').removeClass('sk-loading');
            return false;
        } else if ((language_name.length > '30') || (language_name.length < '3')) {
            swal('', 'Language should contain letters 3 to 30', 'info');
            $('#faculty_loader').removeClass('sk-loading');
            return false;
        }
        var alphanumers = /^[a-zA-Z]+$/;
        if (!alphanumers.test($("#language_name").val())) {
            swal('', 'Language can have only alphabets', 'info');
            $('#faculty_loader').removeClass('sk-loading');
            return false;
        }

        $.ajax({
            type: "POST",
            cache: false,
            async: false,
            url: ops_url,
            data: $('#language_save').serialize(),
            success: function (result) {
                var data = $.parseJSON(result)
                if (data.status == 1) {
                    $('#language_save').html('');
                    $('#language_save').html(data.view);
                    var language_data = [];
                    $.ajax({
                        type: "POST",
                        cache: false,
                        async: false,
                        url: baseurl + 'language/show-language',
                        data: {'load_reset': '1'},
                        success: function (result) {
                            language_data = JSON.parse(result);
                        },
                        error: function () {
                            alert('error');
                        }
                    });
                    var datatable = $('#tbl_language').dataTable().api();
                    datatable.clear();
                    datatable.rows.add(language_data).draw();
                    $('#add_type').show();
                    swal('Success', 'Language ' + language_name + ' updated successfully.', 'success');
                    $('#faculty_loader').removeClass('sk-loading');
                    $("#curd-content").slideUp("slow", function () {
                        $("#curd-content").hide();
                    });
                    load_language();
                } else if (data.status == 2) {
                    $('#curd-content').html('');
                    $('#curd-content').html(data.view);
                    swal('', data.message, 'info');
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
        $('#language_name').val('');
        $('#language_name').parent().removeAttr('class', 'has-error');

    }

    function edit_language(languageid, name) {
        var ops_url = baseurl + 'language/edit-language/';
        $.ajax({
            type: "POST",
            cache: false,
            async: false,
            url: ops_url,
            data: {"load": 1, "language_id": languageid, "language_name": name},
            success: function (result) {
                var data = JSON.parse(result);
//                console.log(data);
                if (data.status == 1) {
                    $('#curd-content').html('');
                    $('#curd-content').html(data.view);
                    var animation = "fadeInDown";
                    $("#curd-content").show();
                    $('#curd-content').addClass('animated');
                    $('#curd-content').addClass(animation);
                    $('#add_type').hide();
                    $("html, body").animate({ scrollTop: 0 }, "slow"); 
                    $('#language_name').focus();
                } else {
                    alert('No data loaded');
                }
            }
        });
    }

    function close_add_language() {
        $('#add_type').show();
        $("#curd-content").slideUp("slow", function () {
            $("#curd-content").hide();
        });

    }
</script>

