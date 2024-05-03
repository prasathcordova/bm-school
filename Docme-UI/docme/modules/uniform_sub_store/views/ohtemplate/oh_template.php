<div class="wrapper wrapper-content animated fadeInRight" style="padding-top: 1px !important;padding-left: 0px !important;padding-right: 0px !important;">
    <div class="row" style="margin-left: -29px !important; margin-right: -30px !important;">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5><?php echo isset($sub_title) ? $sub_title : "NO TITLE PROVIDED" ?></h5>
                    <div class="ibox-tools" id="add_type">
                        <?php
                        if (check_permission(552, 1051, 0)) {
                        ?>
                            <a data-toggle="modal" class="btn btn-primary btn-xs" data-toggle="tooltip" title="Add a new template" data-placement="left" href="javascript:void(0)" onclick="uniform_add_new_template();"><i class="fa fa-plus"></i>CREATE NEW TEMPLATE</a>
                        <?php
                        }
                        ?>
                    </div>
                </div>
                <div class="ibox-content" id="data_loader">
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
                            <div class="table">
                                <table class="table table-striped table-bordered table-hover dataTables-example" id="tbl_ohtemplate">

                                    <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>Description</th>
                                            <th>Task</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        if (isset($oh_data) && !empty($oh_data) && is_array($oh_data)) {
                                            foreach ($oh_data as $oh) {
                                        ?>
                                                <tr>
                                                    <td> <?php echo $oh['name']; ?></td>
                                                    <td> <?php echo $oh['description']; ?></td>
                                                    <td>
                                                        <?php
                                                        if (check_permission(552, 1052, 0)) {
                                                        ?>
                                                            <a href="javascript:void(0)" onclick="uniform_edit_ohtemplate('<?php echo $oh['id']; ?>', '<?php echo $oh['name']; ?>', '<?php echo $oh['description']; ?>');" data-toggle="tooltip" data-placement="right" title="Edit <?php echo $oh['name']; ?>" data-original-title="<?php echo $oh['name']; ?>"><i class="fa fa-pencil" style="font-size: 24px; color: #23C6C5; margin: 2%; "></i></a>
                                                        <?php
                                                        }
                                                        ?>
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
    var table = $('#tbl_ohtemplate').dataTable({

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
                "targets": 2,
                "orderable": false
            }
        ],


        iDisplayLength: 10,
        dom: '<"html5buttons"B>lTfgitp',
        buttons: [{
                extend: 'copy'
            },
            {
                extend: 'csv',
                exportOptions: {
                    columns: [0, 1]
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

    });


    function uniform_submit_data() {
        $('#data_loader').addClass('sk-loading');


        var oh_name = $('#oh_name').val().toUpperCase();
        var oh_description = $('#oh_description').val().toUpperCase();



        if (oh_name == '') {
            swal('', 'Name is required.', 'info');
            $('#data_loader').removeClass('sk-loading');
            return false;
        }


        var alphanumers = /^[a-zA-Z0-9\s]+$/;
        if (!alphanumers.test($("#oh_name").val())) {
            swal('', 'Name can have only alphabets and numbers', 'info');
            $('#data_loader').removeClass('sk-loading');
            return false;
        }

        if (oh_description == '') {
            swal('', 'Description is required.', 'info');
            $('#data_loader').removeClass('sk-loading');
            return false;
        }
        var alphanumers = /^[a-zA-Z0-9\s]+$/;
        if (!alphanumers.test($("#oh_description").val())) {
            swal('', 'Description can have only alphabets and numbers', 'info');
            $('#data_loader').removeClass('sk-loading');
            return false;
        }


        var ops_url = baseurl + 'uniform/substore/add-ohtemplate/';
        $.ajax({
            type: "POST",
            cache: false,
            async: false,
            url: ops_url,
            data: {
                "oh_name": oh_name,
                "oh_description": oh_description
            },
            success: function(result) {
                var data = $.parseJSON(result);
                if (data.status == 1) {
                    swal('Success', 'OH Template, ' + oh_name + ' created successfully.', 'success');
                    uniform_load_ohtemplate();
                    $('#data_loader').removeClass('sk-loading');
                    $("#curd-content").slideUp("slow", function() {
                        $("#curd-content").hide();
                    });
                } else if (data.status == 2) {
                    swal('', data.message, 'info');
                    $('#data_loader').removeClass('sk-loading');
                } else {
                    swal('', 'Connection Error. Please contact administrator', 'info');
                    $('#data_loader').removeClass('sk-loading');

                }
            }
        });

    }

    function uniform_submit_edit_data() {
        $('#data_loader').addClass('sk-loading');

        var ops_url = baseurl + 'uniform/substore/add-ohtemplate/';
        var oh_name = $('#oh_name').val().toUpperCase();
        var oh_description = $('#oh_description').val().toUpperCase();
        var id = $('#oh_id').val();



        if (oh_name == '') {
            swal('', 'Name is required.', 'info');
            $('#data_loader').removeClass('sk-loading');
            return false;
        }


        var alphanumers = /^[a-zA-Z0-9\s]+$/;
        if (!alphanumers.test($("#oh_name").val())) {
            swal('', 'Name can have only alphabets and numbers', 'info');
            $('#data_loader').removeClass('sk-loading');
            return false;
        }

        if (oh_description == '') {
            swal('', 'Description is required.', 'info');
            $('#data_loader').removeClass('sk-loading');
            return false;
        }
        var alphanumers = /^[a-zA-Z0-9\s]+$/;
        if (!alphanumers.test($("#oh_description").val())) {
            swal('', 'Description can have only alphabets and numbers', 'info');
            $('#data_loader').removeClass('sk-loading');
            return false;
        }

        var ops_url = baseurl + 'uniform/substore/edit-ohtemplate/';
        $.ajax({
            type: "POST",
            cache: false,
            async: false,
            url: ops_url,
            data: {
                "id": id,
                "name": oh_name,
                "oh_description": oh_description
            },
            success: function(result) {
                var data = $.parseJSON(result);
                if (data.status == 1) {
                    swal('Success', 'OH Template, ' + oh_name + ' edited successfully.', 'success');
                    uniform_load_ohtemplate();
                    $('#data_loader').removeClass('sk-loading');
                    $("#curd-content").slideUp("slow", function() {
                        $("#curd-content").hide();
                    });
                } else if (data.status == 2) {

                    swal('', data.message, 'info');
                    $('#data_loader').removeClass('sk-loading');
                } else {
                    swal('', 'Connection Error. Please contact administrator', 'info');
                    $('#data_loader').removeClass('sk-loading');

                }
            }
        });

    }

    function uniform_refresh_add_panel() {
        $('#oh_name').val('');
        $('#oh_name').parent().removeAttr('class', 'has-error');
        $('#oh_description').val('');
        $('#oh_description').parent().removeAttr('class', 'has-error');
    }

    function uniform_edit_ohtemplate(id, name, description) {
        var ops_url = baseurl + 'uniform/substore/edit-ohtemplate/';
        $.ajax({
            type: "POST",
            cache: false,
            async: false,
            url: ops_url,
            data: {
                "load": 1,
                "id": id,
                "name": name,
                "description": description
            },
            success: function(data) {
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

    function uniform_close_add_ohtemplate() {
        $('#add_type').show();
        $("#curd-content").slideUp("slow", function() {
            $("#curd-content").hide();
        });

    }

    //NEW SCRIPT
    function uniform_add_new_template() {
        var ops_url = baseurl + 'uniform/substore/add-ohtemplate';
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
                } else {
                    alert('No data loaded');
                }
            }
        });
    }
</script>