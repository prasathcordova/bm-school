<div class="wrapper wrapper-content animated fadeInRight" style="padding-top: 1px !important;padding-left: 0px !important;padding-right: 0px !important;">
    <div class="row" style="margin-left: -29px !important; margin-right: -30px !important;">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title" style="border-bottom-color:#ffd300 !important;">
                    <h5><?php echo isset($sub_title) ? $sub_title : "NO TITLE PROVIDED" ?></h5>
                    <div class="ibox-tools" id="add_type">
                        <a data-toggle="modal" class="btn btn-primary btn-xs" data-toggle="tooltip" title="Add a Caste" data-placement="left" href="javascript:void(0)" onclick="add_new_caste();"><i class="fa fa-plus"></i>ADD CASTE</a>
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
                                <table class="table table-striped table-bordered table-hover dataTables-example" id="tbl_caste">

                                    <thead>
                                        <tr>
                                            <th>Caste Name</th>
                                            <th>Religion Name</th>
                                            <th>Community Name</th>
                                            <th>Status</th>
                                            <th>Task</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        if (isset($caste_data) && !empty($caste_data) && is_array($caste_data)) {
                                            foreach ($caste_data as $caste) {
                                                //                                                dev_export($caste);die;
                                        ?>
                                                <tr>
                                                    <td> <?php echo $caste['caste_name']; ?></td>
                                                    <td> <?php echo $caste['religion_name']; ?></td>
                                                    <td> <?php echo $caste['community_name']; ?></td>

                                                    <td data-toggle="tooltip" title="Slide for Enable/Disable">
                                                        <?php if ($caste['isactive'] == 1) { ?>
                                                            <input type="checkbox" class="js-switch" data-toggle="tooltip" title="Slide for Enable/Disable" onchange="change_status('<?php echo $caste['caste_id'] ?>', '<?php echo $caste['community_id'] ?>', this)" checked id="t1" />
                                                        <?php } else {
                                                        ?>
                                                            <input type="checkbox" class="js-switch" data-toggle="tooltip" title="Slide for Enable/Disable" onchange="change_status('<?php echo $caste['caste_id'] ?>', '<?php echo $caste['community_id'] ?>', this)" id="" class="js-switch" />
                                                        <?php }
                                                        ?>
                                                    </td>
                                                    <td>
                                                        <a href="javascript:void(0)" onclick="edit_caste('<?php echo $caste['caste_id']; ?>', '<?php echo $caste['caste_name']; ?>', '<?php echo $caste['religion_name']; ?>', '<?php echo $caste['community_name']; ?>');" data-toggle="tooltip" data-placement="right" title="Edit <?php echo $caste['caste_name']; ?>" data-original-title="<?php echo $caste['caste_name']; ?>"><i class="fa fa-pencil" style="font-size: 24px; color: #23C6C5; margin: 2%; "></i></a>
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
    $('#tbl_caste').dataTable({
        columnDefs: [{
                "width": "30%",
                className: "capitalize",
                "targets": 0
            },
            {
                "width": "20%",
                className: "capitalize",
                "targets": 1
            },
            {
                "width": "30%",
                className: "capitalize",
                "targets": 2
            },
            {
                "width": "10%",
                className: "capitalize",
                "targets": 3,
                "orderable": false
            },
            {
                "width": "10%",
                className: "capitalize",
                "targets": 4,
                "orderable": false
            },
        ],
        responsive: false,
        dom: '<"html5buttons"B>lTfgitp',
        buttons: [{
                extend: 'copy'
            },
            {
                extend: 'csv',
                exportOptions: {
                    columns: [0, 1, 2]
                }
            },
            {
                extend: 'excel',
                title: 'Report',
                exportOptions: {
                    columns: [0, 1, 2]
                }
            }
        ],
        "fnDrawCallback": function(ele) {
            activateSwitchery();
        }


    });
    $('#tbl_caste tbody').on('click', function(e) {
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


    function toggle_subject_add() {
        if ($('#add_type').html() > 100) {
            $('#add_type').html('<a href="javascript:void(0)" onclick="toggle_caste_add();"><i class="fa fa-close" style="color:1ab394; font-size:30px;></i></a>');
            add_subject();
        } else {
            $('#add_type').html('<button type="button" class="btn bg-teal waves-effect" onclick="toggle_caste_add();">NEW CASTE</button>');
            var animation = "fadeOutDown";
            $('#curd-content').addClass('animated');
            $('#curd-content').addClass(animation);
            $('#curd-content').html('');
            $('#curd-content').hide();
        }
    }

    function change_status(casteid, communityid, element) {
        $('#faculty_loader').addClass('sk-loading');

        var status_type = $(element).prop("checked");
        if (status_type == true)
            status = 1;
        else
            status = -1;
        var ops_url = baseurl + 'caste/change_status/';
        $.ajax({
            type: "POST",
            cache: false,
            async: false,
            url: ops_url,
            data: {
                "load": 1,
                "caste_id": casteid,
                "community_id": communityid,
                "status": status
            },
            success: function(result) {
                var data = $.parseJSON(result);
                if (data.status == 1) {
                    if (status == -1) {
                        swal('Caste Updated', 'Caste Status Deactivated Successfully', 'success');
                        $('#faculty_loader').removeClass('sk-loading');
                        gs_count();
                        return true;
                    } else {
                        if (status == 1) {
                            swal('Caste Updated', 'Caste Status Activated Successfully', 'success');
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
                        }, function(isConfirm) {
                            //                            window.location.href = baseurl + "caste/show-caste";
                            load_caste();
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
                            }, function(isConfirm) {
                                //                                window.location.href = baseurl + "caste/show-caste";
                                load_caste();
                            });
                        } else {
                            swal({
                                title: '',
                                text: 'Caste Status Updation Failed',
                                type: 'info',
                                showCancelButton: false,
                                confirmButtonColor: '#3085d6',
                                cancelButtonColor: '#d33',
                                confirmButtonText: 'OK'
                            }, function(isConfirm) {
                                //                                window.location.href = baseurl + "caste/show-caste";
                                load_caste();
                            });
                        }

                    }
                }
            }
        });
    }
    $('.js-switch').change(function(e) {

    });


    $(".js-switch").click(function() {});



    function submit_data() {
        $('#faculty_loader').addClass('sk-loading');

        var ops_url = baseurl + 'caste/add-caste';
        var caste_name = $('#caste_name').val().toUpperCase();
        var relegion = $('#religion_select').val();
        var community = $('#community_select').val();
        if (relegion == -1) {
            swal('', 'Religion Name Required', 'info');
            $('#faculty_loader').removeClass('sk-loading');
            return false;
        }
        if (community == -1) {
            swal('', 'Community Name Required', 'info');
            $('#faculty_loader').removeClass('sk-loading');
            return false;
        }
        if (caste_name == '') {
            swal('', 'Caste Name is required.', 'info');
            $('#faculty_loader').removeClass('sk-loading');
            return false;
        } else if (caste_name.length > '30' || caste_name.length < '3') {
            swal('', 'Caste Name should contain minimum 3 and maximum 30', 'info');
            $('#faculty_loader').removeClass('sk-loading');
            return false;
        }
        var alphanumers = /^[a-zA-Z\s]+$/;
        if (!alphanumers.test($("#caste_name").val())) {
            swal('', 'Caste Name can have only alphabets', 'info');
            $('#faculty_loader').removeClass('sk-loading');
            return false;
        }
        $.ajax({
            type: "POST",
            cache: false,
            async: false,
            url: ops_url,
            data: $('#caste_save').serialize(),
            success: function(result) {
                var data = $.parseJSON(result)
                if (data.status == 1) {
                    gs_count();
                    $('#caste_save').html('');
                    $('#caste_save').html(data.view);
                    var caste_data = [];
                    $.ajax({
                        type: "POST",
                        cache: false,
                        async: false,
                        url: baseurl + 'caste/show-caste',
                        data: {
                            'load_reset': '1'
                        },
                        success: function(result) {
                            caste_data = JSON.parse(result);
                        },
                        error: function() {
                            alert('error');
                        }
                    });
                    var datatable = $('#tbl_caste').dataTable().api();
                    datatable.clear();
                    datatable.rows.add(caste_data).draw();

                    $('#add_type').show();
                    swal('Success', 'New Caste, ' + caste_name + ' created successfully.', 'success');
                    $('#faculty_loader').removeClass('sk-loading');
                    $("#curd-content").slideUp("slow", function() {
                        $("#curd-content").hide();
                    });
                } else if (data.status == 2) {
                    $('#curd-content').html('');
                    $('#curd-content').html(data.view);
                    swal('', 'Caste Name Already Exists', 'info');
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

        var ops_url = baseurl + 'caste/edit-caste';
        var caste_name = $('#caste_name').val().toUpperCase();
        var relegion = $('#religion_select').val();
        var community = $('#community_select').val();
        if (relegion == -1) {
            swal('', 'Religion Name Required', 'info');
            $('#faculty_loader').removeClass('sk-loading');
            return false;
        }
        if (community == -1) {
            swal('', 'Community Name Required', 'info');
            $('#faculty_loader').removeClass('sk-loading');
            return false;
        }
        if (caste_name == '') {
            swal('', 'Caste Name Required', 'info');
            $('#faculty_loader').removeClass('sk-loading');
            return false;
        } else if (caste_name.length > '30' || caste_name.length < '3') {
            swal('', 'Caste Name should contain minlength 3 and maxlength 20', 'info');
            $('#faculty_loader').removeClass('sk-loading');
            return false;
        }
        var alphanumers = /^[a-zA-Z\s]+$/;
        if (!alphanumers.test($("#caste_name").val())) {
            swal('', 'Caste Name can have only alphabets', 'info');
            $('#faculty_loader').removeClass('sk-loading');
            return false;
        }

        $.ajax({
            type: "POST",
            cache: false,
            async: false,
            url: ops_url,
            data: $('#caste_save').serialize(),
            success: function(result) {
                var data = $.parseJSON(result)
                if (data.status == 1) {
                    $('#caste_save').html('');
                    $('#caste_save').html(data.view);
                    var caste_data = [];
                    $.ajax({
                        type: "POST",
                        cache: false,
                        async: false,
                        url: baseurl + 'caste/show-caste',
                        data: {
                            'load_reset': '1'
                        },
                        success: function(result) {
                            caste_data = JSON.parse(result);
                        },
                        error: function() {
                            alert('error');
                        }
                    });
                    var datatable = $('#tbl_caste').dataTable().api();
                    datatable.clear();
                    datatable.rows.add(caste_data).draw();
                    $('#add_type').show();
                    swal('Success', 'Caste, ' + caste_name + ' Updated successfully.', 'success');
                    $('#religion_select').select2({
                        'theme': 'bootstrap'
                    });
                    $('#community_select').select2({
                        'theme': 'bootstrap'
                    });
                    $('#faculty_loader').removeClass('sk-loading');
                    $("#curd-content").slideUp("slow", function() {
                        $("#curd-content").hide();
                    });
                } else if (data.status == 2) {
                    $('#curd-content').html('');
                    $('#curd-content').html(data.view);
                    swal('', 'Caste Name Already Exists', 'info');
                    $('#religion_select').select2({
                        'theme': 'bootstrap'
                    });
                    $('#community_select').select2({
                        'theme': 'bootstrap'
                    });
                    $('#faculty_loader').removeClass('sk-loading');
                } else if (data.status == 3) {
                    $('#curd-content').html('');
                    $('#curd-content').html(data.view);
                    swal('', data.message, 'info');
                    $('#religion_select').select2({
                        'theme': 'bootstrap'
                    });
                    $('#community_select').select2({
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

    function edit_caste(casteid, name, religion, community) {
        var ops_url = baseurl + 'caste/edit-caste';
        $.ajax({
            type: "POST",
            cache: false,
            async: false,
            url: ops_url,
            data: {
                "load": 1,
                "caste_id": casteid,
                "caste_name": name,
                "religion_select": religion,
                "community_select": community
            },
            success: function(result) {
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
                    $('#religion_select').select2({
                        'theme': 'bootstrap'
                    });
                    $('#community_select').select2({
                        'theme': 'bootstrap'
                    });
                    $("html, body").animate({
                        scrollTop: 0
                    }, "slow");
                } else {
                    alert('No data loaded');
                }
            }
        });
    }

    function refresh_add_panel() {
        $('#caste_name').val('');
        $('#caste_name').parent().removeAttr('class', 'has-error');
        $('#religion_select').select2('val', -1);
        $('#community_select').select2('val', -1);
    }


    function close_add_caste() {
        $('#add_type').show();
        $("#curd-content").slideUp("slow", function() {
            $("#curd-content").hide();
        });

    }


    function add_new_caste() {
        var ops_url = baseurl + 'caste/add-caste';
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
                    $("#curd-content").show();
                    $('#curd-content').addClass('animated');
                    $('#curd-content').addClass(animation);
                    $('#add_type').hide();
                    $('#religion_select').select2({
                        'theme': 'bootstrap'
                    });
                    $('#community_select').select2({
                        'theme': 'bootstrap'
                    });
                } else {
                    alert('No data loaded');
                }
            }
        });
    }
</script>