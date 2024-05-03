<div id="content-data" class="wrapper wrapper-content animated fadeInRight" style="padding-top: 1px !important;padding-left: 0px !important;padding-right: 0px !important;">
    <div class="row" style="margin-left: -29px !important; margin-right: -30px !important;">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5><?php echo isset($sub_title) ? $sub_title : "NO TITLE PROVIDED" ?></h5>
                    <div class="ibox-tools" id="add_type">
                        <?php
                        if (check_permission(554, 1056, 0)) {
                        ?>
                            <a data-toggle="modal" class="btn btn-primary btn-xs" title="Add a new open house" data-placement="left" href="javascript:void(0)" onclick="uniform_add_openhouse();"><i class="fa fa-plus"></i>CREATE NEW OPEN HOUSE</a>
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

                    <div class="clearfix"></div>
                    <div class="row">

                        <div class="col-lg-12">
                            <div class="table">
                                <table class="table table-striped table-bordered table-hover dataTables-example" id="tbl_ohtemplate">

                                    <thead>
                                        <tr>

                                            <th>Description</th>
                                            <th>Start Date</th>
                                            <th>End Date</th>
                                            <th>Kit per Student</th>
                                            <th>Task</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        if (isset($oh_data) && !empty($oh_data) && is_array($oh_data)) {
                                            foreach ($oh_data as $oh) {
                                        ?>
                                                <tr>
                                                    <td> <?php echo $oh['description']; ?></td>
                                                    <td><?php echo date('d-m-Y', strtotime($oh['start_date'])) ?></td>
                                                    <td><?php echo date('d-m-Y', strtotime($oh['end_date'])) ?></td>
                                                    <td> <?php echo $oh['kit_per_student']; ?></td>
                                                    <td>
                                                        <?php if (!isset($oh['template_config_id']) && empty($oh['template_config_id'])) { ?>
                                                            <?php if ((date('Y-m-d', strtotime($oh['start_date'])) <= date('Y-m-d')) && (date('Y-m-d', strtotime($oh['end_date'])) >= date('Y-m-d'))) { ?>
                                                                <?php
                                                                if (check_permission(554, 1057, 0)) {
                                                                ?>
                                                                    <a href="javascript:void(0);" onclick="uniform_uniform_edit_openhouse('<?php echo $oh['id']; ?>');" data-toggle="tooltip" data-placement="right" title="Edit <?php echo $oh['description']; ?>" data-original-title="<?php echo $oh['description']; ?>"><i class="fa fa-pencil" style="font-size: 24px; color: #23C6C5; margin: 2%; "></i></a> &nbsp;&nbsp;

                                                                <?php
                                                                }
                                                                if (check_permission(554, 1058, 0)) {
                                                                ?>
                                                                    <a href="javascript:void(0);" onclick="uniform_uniform_delete_openhouse('<?php echo $oh['id']; ?>', '<?php echo $oh['description']; ?>');" data-toggle="tooltip" data-placement="right" title="Delete <?php echo $oh['description']; ?>" data-original-title="<?php echo $oh['description']; ?>"><i class="fa fa-trash-o" style="font-size: 24px; color: #f8ac59; margin: -9px !important; "></i></a>
                                                                <?php
                                                                }
                                                            } else {
                                                                if (check_permission(554, 1059, 0)) {
                                                                ?>
                                                                    <a href="javascript:void(0);" onclick="uniform_view_openhouse('<?php echo $oh['id']; ?>', '<?php echo $oh['description']; ?>');" data-toggle="tooltip" data-placement="right" title="view <?php echo $oh['description']; ?>,(Not in date range)" data-original-title="<?php echo $oh['description']; ?>"> <i class="fa fa-file" style="font-size: 20px; color: #f8ac59; margin: 2%; "></i></a>
                                                            <?php
                                                                }
                                                            }
                                                            ?>
                                                        <?php } else { ?>


                                                            <?php if ((date('Y-m-d', strtotime($oh['start_date'])) <= date('Y-m-d')) && (date('Y-m-d', strtotime($oh['end_date'])) >= date('Y-m-d'))) { ?>
                                                                <?php
                                                                if (check_permission(554, 1059, 0)) {
                                                                ?>
                                                                    <a href="javascript:void(0);" onclick="uniform_view_openhouse('<?php echo $oh['id']; ?>', '<?php echo $oh['description']; ?>');" data-toggle="tooltip" data-placement="right" title="View <?php echo $oh['description']; ?>" data-original-title="<?php echo $oh['description']; ?>"> <i class="fa fa-file" style="font-size: 20px; color: #23C6C8; margin: 2%; "></i></a>
                                                                <?php
                                                                }
                                                                if (check_permission(554, 1060, 0)) {
                                                                ?>
                                                                    <a href="javascript:void(0);" onclick="uniform_add_temp_openhouse('<?php echo $oh['id']; ?>');" data-toggle="tooltip" data-placement="right" title="Add new template to <?php echo $oh['description']; ?>" data-original-title="<?php echo $oh['description']; ?>"> <i class="fa fa-edit" style="font-size: 22px; color: #23C6C8;margin-left: 3px;"></i></a>
                                                                <?php
                                                                }
                                                            } else {
                                                                if (check_permission(554, 1059, 0)) {
                                                                ?>

                                                                    <a href="javascript:void(0);" onclick="uniform_view_openhouse('<?php echo $oh['id']; ?>', '<?php echo $oh['description']; ?>');" data-toggle="tooltip" data-placement="right" title="view <?php echo $oh['description']; ?>,(Not in date range)" data-original-title="<?php echo $oh['description']; ?>"> <i class="fa fa-file" style="font-size: 20px; color: #f8ac59; margin: 2%; "></i></a>
                                                            <?php
                                                                }
                                                            }
                                                            ?>
                                                        <?php } ?>
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
                        <input type="hidden" name="itemdata" id="itemdata" value="" />
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<script type="text/javascript">
    $(document).ready(function() {


        var table = $('#tbl_ohtemplate').dataTable({

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
                    "targets": 2,
                    "orderable": false
                },
                {
                    "width": "10%",
                    className: "capitalize",
                    "targets": 3,
                    "orderable": false
                },
                {
                    "width": "30%",
                    className: "capitalize",
                    "targets": 4,
                    "orderable": false
                },
                //                {"width": "30%", className: "capitalize", "targets": 2, "orderable": false}
            ],
            //            responsive: true,
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
                $('.i-checks').iCheck({
                    checkboxClass: 'icheckbox_square-green',
                    radioClass: 'iradio_square-green',
                });
            }

        });




        $('.i-checks').iCheck({
            checkboxClass: 'icheckbox_square-green',
            radioClass: 'iradio_square-green',
        });

    });

    function uniform_add_openhouse() {
        var ops_url = baseurl + 'uniform/substore/show-openhouse/';
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

    function uniform_uniform_edit_openhouse(id) {
        var ops_url = baseurl + 'uniform/substore/edit-openhouse/';
        $.ajax({
            type: "POST",
            cache: false,
            async: false,
            url: ops_url,
            data: {
                "load": 1,
                "id": id
            },
            success: function(result) {
                $('#data-view').html(result);
            }
        });

    }

    function uniform_add_temp_openhouse(id) {
        var ops_url = baseurl + 'uniform/substore/add_temp-openhouse/';
        $.ajax({
            type: "POST",
            cache: false,
            async: false,
            url: ops_url,
            data: {
                "load": 1,
                "id": id
            },
            success: function(result) {
                $('#data-view').html(result);
                $('html, body').stop().animate({
                    scrollTop: $($('.ibox-content')).offset().top - 55
                }, 500);
            }
        });

    }

    function uniform_view_openhouse(id) {
        var ops_url = baseurl + 'uniform/substore/view-openhouse/';
        $.ajax({
            type: "POST",
            cache: false,
            async: false,
            url: ops_url,
            data: {
                "load": 1,
                "id": id
            },
            success: function(result) {
                $('#data-view').html(result);
                $('html, body').stop().animate({
                    scrollTop: $($('.ibox-content')).offset().top - 55
                }, 500);
            }
        });

    }

    function uniform_uniform_delete_openhouse(id, description) {
        var desc = description;
        swal({
            title: '',
            text: 'Do you want to delete Open House - ' + desc + ' ?',
            type: 'info',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            cancelButtonText: 'Cancel',
            confirmButtonText: 'Delete',
            closeOnConfirm: true
        }, function(isConfirm) {
            if (isConfirm) {
                var ops_url = baseurl + 'uniform/substore/delete-openhouse/';
                $.ajax({
                    type: "POST",
                    cache: false,
                    async: false,
                    url: ops_url,
                    data: {
                        "load": 1,
                        "id": id
                    },
                    success: function(result) {

                        var data = $.parseJSON(result);

                        if (data.status == 1) {
                            swal('Success', 'Openhouse' + desc + ' deleted successfully.', 'success');
                            $('#data_loader').removeClass('sk-loading');
                            uniform_load_openhouse();
                            $("#curd-content").slideUp("slow", function() {
                                $("#curd-content").hide();
                            });
                        }
                        if (data.status == 2) {

                            swal('', data.message, 'info');

                            load_openhouse();
                            $('#data_loader').removeClass('sk-loading');
                        } else {
                            swal('', 'Connection Error. Please contact administrator', 'info');
                            $('#data_loader').removeClass('sk-loading');

                        }

                    }
                });
            } else {
                load_openhouse();
            }

        });



    }
</script>