<div class="wrapper wrapper-content animated fadeInRight" style="padding-top: 1px !important;padding-left: 0px !important;padding-right: 0px !important;">
    <div class="row" style="margin-left: -29px !important; margin-right: -30px !important;">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title" style="border-bottom-color:#23C6C8!important">
                    <h5 style="color: #1c84c6;"><?php echo isset($sub_title) ? $sub_title : "NO TITLE PROVIDED" ?></h5>
                    <!-- <div class="ibox-tools" id="add_type">
                        <a data-toggle="modal" class="btn btn-primary btn-xs" data-toggle="tooltip" title="Add a New Pickup Point" data-placement="left" href="javascript:void(0)" onclick="add_new_pickuppoint();">ADD NEW Pickup POINT</a>
                    </div> -->
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
                    <div class="wrapper wrapper-content animated fadeInRight" id="student-data-container">

                        <div class="row">
                            <div class="col-lg-12">
                                <div id="curd-content" style="display: none;"></div>
                            </div>
                            <div class="col-lg-12">
                                <table id="system_parameter_tbl" class="table table-striped table-bordered table-hover dataTables-example">
                                    <thead>
                                        <tr>
                                            <th>Description</th>
                                            <th>Parameter</th>
                                            <th>Value</th>
                                            <th>Task</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $breaker = 0;
                                        if (isset($sys_parameters) && !empty($sys_parameters)) {
                                            foreach ($sys_parameters as $data) {
                                        ?>
                                                <tr>
                                                    <td><?php echo $data['Description']; ?></td>
                                                    <td><?php echo $data['Code']; ?></td>
                                                    <td>
                                                        <div class="view_div class_div_<?php echo $data['id'] ?>">
                                                            <?php echo $data['Code_Value']; ?>
                                                        </div>
                                                        <div class="update_div class_update_div_<?php echo $data['id'] ?>" style="display:none">
                                                            <input maxlength="10" id="code_value_<?php echo $data['id'] ?>" type="text" value="<?php echo $data['Code_Value'] ?>" placeholder="Code Value" class="form-control" style="width:100%">
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <?php if ($data['editable'] == 'Y') { ?>
                                                            <div class="view_div class_div_<?php echo $data['id'] ?>">
                                                                <a class="btn btn-xs btn-info" href="javascript:void(0);" onclick="update_code_value('<?php echo $data['id']; ?>');" data-toggle="tooltip" data-placement="right" title="Update <?php echo $data['Description']; ?>-Fees" data-original-title="<?php echo $data['Description']; ?>"> <i class="fa fa-edit"></i> Update</a>
                                                            </div>
                                                            <div class="update_div class_update_div_<?php echo $data['id'] ?>" style="display:none">
                                                                <a class="btn btn-xs btn-primary" href="javascript:void(0);" onclick="save_code_value('<?php echo $data['id']; ?>', '<?php echo $data['Code']; ?>');" data-toggle="tooltip" data-placement="right" title="Save <?php echo $data['Description']; ?>-Fees" data-original-title="<?php echo $data['Description']; ?>"> <i class="fa fa-edit"></i> Save</a>
                                                                <a style="display:block" href="javascript:void(0);" onclick="discard_update();" data-toggle="tooltip" data-placement="right" title="Discard"> <i class="fa fa-close"></i> Discard</a>
                                                            </div>
                                                        <?php } else {
                                                            echo 'No Update';
                                                        } ?>


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
    var table = $('#system_parameter_tbl').dataTable({

        responsive: false,
        iDisplayLength: 100,
        "ordering": false,
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
    });



    function update_code_value(sys_param_id) {
        $(".view_div").fadeIn();
        $(".update_div").hide();
        $(".class_div_" + sys_param_id).hide();
        $(".class_update_div_" + sys_param_id).fadeIn();
    }

    function discard_update() {
        $(".view_div").fadeIn();
        $(".update_div").hide();
    }

    function save_code_value(sys_param_id, Description) {
        var title_data = $('#title_data').val();
        var code_value = $('#code_value_' + sys_param_id).val();

        if (code_value == '') {
            swal('', 'Code Value is required.', 'info');
            $('#faculty_loader').removeClass('sk-loading');
            return false;
        }


        var ops_url = baseurl + 'settings/save-code-value/';
        $.ajax({
            type: "POST",
            cache: false,
            async: false,
            url: ops_url,
            data: {
                "load": 1,
                "system_parameter_id": sys_param_id,
                "code_value": code_value,
                "flag": 1
            },
            success: function(result) {
                var data = JSON.parse(result);
                if (data.status == 1) {
                    swal('', 'Updated code value for ' + Description, 'success');
                    load_system_parameters();
                } else {
                    swal('', 'Updation failed,Please try again', 'info');
                    return false;
                }
            }
        });
    }
</script>