<!--<div class="ibox " style="height: 452px !important;">-->
<div class="ibox ">
    <div class="ibox-content" style="height: 100% !important;">
        <div class="tab-content" id="role_data_content">
            <div id="role_display_<?php echo $role['role_id']; ?>" class="tab-pane active">
                <div class="row">
                    <div class="text-right" style="padding-right: 15px;"><a href="javascript:void(0);" onclick="add_new_role();" title="Add New Role" class="btn btn-primary btn-xs">Add New Role</a>
                        <span style="padding-top: 0px;"><a href="javascript:void(0);" onclick="Edit_role();" title="Edit Role" class="btn btn-primary btn-xs">Edit Role</a></span></div>
                </div>
                <div id="roleview">
                    <ul class="list-group clear-list m-t">
                        <li class="list-group-item fist-item">
                            <span class="pull-right">
                                <?php echo $role['role_name']; ?>
                            </span>
                            <span class="label label-info"> Role Name</span> 
                        </li>
                        <li class="list-group-item">
                            <span class="pull-right">
                                <?php echo $role['role_description']; ?>
                            </span>
                            <span class="label label-info"> Role Description</span> 
                        </li>
                        <li class="list-group-item">
                            <span class="pull-right">
                                <?php
                                if ($role['isactive'] > 0)
                                    echo 'Active';
                                else
                                    echo 'Disabled';
                                ?>
                            </span>
                            <span class="label label-info"> Role Status</span>
                        </li>
                        <li class="list-group-item">
                            <span class="pull-right">

                            </span>
                            <span class="label label-primary"></span>
                        </li>
                    </ul>
                </div>
                <div id="roleedit">
                    <div class="col-lg-12 col-md-12 col-xs-12 col-sm-12">
                        <div class="form-group">
                            <label class="control-label" for="name">Role Name :</label>
                            <input type="text" id="name" name="name" class="form-control alphanumeric" value="<?php echo $role['role_name']; ?>" style="background-color: white" maxlenth="20">
                        </div>  
                    </div>
                    <div class="clearfix"></div>
                    <div class="col-lg-12 col-md-12 col-xs-12 col-sm-12">
                        <div class="form-group">
                            <label class="control-label" for="description">Role Description :</label>
                            <input type="text" id="description" name="description" class="form-control alphanumeric" value="<?php echo $role['role_description']; ?>"style="background-color: white" maxlength="25">
                        </div>  
                    </div>
                    <div class="clearfix"></div>
                    <div class="col-lg-12 col-md-12 col-xs-12 col-sm-12">
                        <div class="form-group">
                            <input type="hidden" value="<?php echo $role['role_id']; ?>" id="role_id" name="role_id" />
                            <label class="control-label" for="description"> Role Status :</label>
                            <div class=" input-group" style="float:right;">

                                <?php
                                if ($role['isactive'] == 1) {
                                    echo ' <input type="checkbox" value="" checked="" name="role_chks" id="role_chks" class="i-checks"/>';
                                } else {
                                    echo ' <input type="checkbox" value=""  name="role_chks" id="role_chks" class="i-checks"/>  ';
                                }
                                ?>
                            </div>


                        </div>
                    </div>

                    <div class="col-lg-12 col-md-12 col-xs-12 col-sm-12">

                        <button type="button" class="btn btn-primary btn-sm btn-block" onclick="update_data('<?php echo $role['role_id']; ?>');"><i class="fa fa-save"></i> Update Role </button>

                    </div>
                </div>
                <div class="row row m-b-lg">
                    <div class="full-height-scrollbar" id="user_list_data">
                        <div class="clearfix"></div>
                        <div class="col-lg-12">
                            <span class="text-right" style="width: 100%;padding-top: 10px; float:right !important;" ><a href="javascript:void(0);" title='Permission Settings' onclick="reset_permission('<?php echo $role['role_id']; ?>');" class="btn btn-primary btn-xs">Permission Settings</a></span>
                        </div>
                        <div class="col-lg-12 col-md-12 col-xs-12 col-sm-12" style="padding-top:15px;">
                            <strong>Available Permissions</strong>


                            <?php
                            if (isset($permissiondata) && !empty($permissiondata) && is_array($permissiondata)) {
                            ?>
                                <div class="permission_data">
                                    <ul class="list-group clear-list permission-list">
                                        <?php
                                        foreach ($permissiondata as $permissions) {
                                        ?>
                                            <li class="list-group-item">
                                                <?php echo $permissions['available_permissions']; ?>
                                            </li>
                                        <?php
                                        }
                                        ?>
                                    </ul>
                                </div>
                            <?php } else { ?>
                                <ul class="list-group clear-list">

                                    <div class="widget lazur-bg p-xl text-center" style="width:100%;">
                                        <h2>
                                            No  Permission Available !
                                        </h2>
                                    </div>
                                </ul>
                            <?php }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        $('#roleedit').hide();
    });
    $('.i-checks').iCheck({
        checkboxClass: 'icheckbox_square-green',
        radioClass: 'iradio_square-green'
    });


    function Edit_role() {
        $('#roleview').hide();
        $('#roleedit').show();

    }

    function update_data(role_id) {
        var role_name = $('#name').val().toUpperCase();
        var role_desc = $('#description').val();
        var roleid = role_id;
        var role_status = $('#role_chks').prop('checked');
        if (role_status == true) {
            var isinrole = 1;
        } else {
            var isinrole = 2;
        }
        if(role_name == ''){
            swal('','Enter Role Name','info');
            return false;

        }else if(role_name.length < 3) {
            swal('','Enter Atleast 3 Characters','info');
            return false;
        }               
        if(role_desc == ''){
            swal('','Enter Role Description','info');
            return false;

        }else if(role_desc.length < 3) {
            swal('','Enter Atleast 3 Characters','info');
            return false;
        }
        

        var ops_url = baseurl + 'role/update-role/';
        $.ajax({
            type: "POST",
            cache: false,
            async: false,
            url: ops_url,
            data: {
                "role_id": roleid,
                "role_name": role_name,
                "description": role_desc,
                'isinrole': isinrole
            },
            success: function(result) {
                var data = $.parseJSON(result);
                if (data.status == 1) {
                    swal('Success', 'Role Updated Successfully.', 'success');

                    $('#data_loader').removeClass('sk-loading');
                    $("#curd-content").slideUp("slow", function() {
                        $("#curd-content").hide();
                    });
                    role_data_reloader();
                    role_data_load_added(data.id);
                    //window.location.reload();
                   

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

    function role_data_reloader() {
        var ops_url = baseurl + 'user/show-detail-role';
        $.ajax({
            type: "POST",
            cache: false,
            async: false,
            url: ops_url,
            data: {
                "load": 1
            },
            success: function(result) {
                var data = JSON.parse(result)
                if (data.status == 1) {
                    $('#tab-2').html(data.view);
                    $('.full-height-scrollbar').slimscroll({
                        height: '90%'
                    });
                } else {
                    alert('No data loaded');
                }
            }
        });

    }

    function role_data_load_added(roleid) {
        var ops_url = baseurl + 'user/show-role-data-detail';
        $.ajax({
            type: "POST",
            cache: false,
            async: false,
            url: ops_url,
            data: {
                "load": 1,
                "roleid": roleid
            },
            success: function(result) {
                var data = JSON.parse(result)
                if (data.status == 1) {
                    $('#data_preview_panel').html(data.view);
                    $('.full-height-scrollbar').slimscroll({
                        height: '90%'
                    });
                } else {
                    alert('No data loaded');
                }
            }
        });

    }
</script>
