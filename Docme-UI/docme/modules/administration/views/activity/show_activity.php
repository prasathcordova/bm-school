<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10 col-md-8 col-sm-8 col-xs-12">
        <h2 style="font-size: 20px;">
            <?php echo isset($title) ? $title : "NO TITLE PROVIDED" ?>
        </h2>
        <ol class="breadcrumb">
            <?php
            if (isset($bread_crump_data) && !empty($bread_crump_data)) {
                echo $bread_crump_data;
            }
            ?>
        </ol>
    </div>
</div>

<div class="wrapper wrapper-content  animated fadeInRight">
    <div class="row" id="on_edit">
        <div class="col-sm-8">
            <div class="ibox">
                <div class="ibox-content">
                    <h2>User Management</h2>

                    <div class="clients-list">
                        <ul class="nav nav-tabs">

                            <li class="active" id="user_data_view"><a data-toggle="tab" href="#tab-1"><i class="fa fa-user"></i> Users</a></li>
                            <li class="" id="role_permission_data"><a data-toggle="tab" href="#tab-2"><i class="fa fa-briefcase"></i> Roles</a></li>
                        </ul>
                        <div class="tab-content">
                            <div id="tab-1" class="tab-pane active" style="    height: 662px !important;">
                                <div id="search-tab" style="    padding-bottom: 20px;    padding-top: 20px;">
                                    <div class="input-group">
                                        <input type="text" placeholder="Search available user's name " id="search_user_data" name="search_user_data" class="input form-control">
                                        <span class="input-group-btn">
                                            <button type="button" class="btn btn btn-primary" onclick="load_search_user_data();"> <i class="fa fa-search"></i> Search</button>
                                        </span>
                                    </div>
                                    <?php $page = 1; ?>
                                    <input type="hidden" name="user_next" id="user_next" value="<?php echo $page; ?>">
                                    <div id="search-tab" style="    padding-bottom: 20px;    padding-top: 20px;">
                                        <span class="input-group-btn pull-right " style="padding-right: 65px">
                                            <button type="button" style="display:none;" id="previous" class="btn btn btn-primary" data-toggle="tooltip" title="Previous" onclick="user_pre();"> <i class="fa fa-angle-left"></i> </button>
                                            <button type="button" class="btn btn btn-primary" id="next" data-toggle="tooltip" title="Next" onclick="user_next();"> <i class="fa fa-angle-right"></i> </button>
                                        </span>
                                    </div>


                                </div>
                                <div class="full-height-scrollbar" id="user_list_data">

                                    <div class="table-responsive">
                                        <table class="table table-striped table-hover">
                                            <thead>
                                                <tr>
                                                    <th class="client-avatar">Img</th>
                                                    <th>User Name</th>
                                                    <th>Department</td>
                                                    <th colspan="2">Email</th>

                                                    <th>Status</th>
                                                </tr>
                                            </thead>
                                            <tbody>

                                                <?php
                                                if (isset($user_data) && !empty($user_data)) {
                                                    $i = 0;

                                                    foreach ($user_data as $user) {
                                                        if ($i == 0) {
                                                            echo '<input type="hidden" name="user_intial_load" id="user_intial_load" value="' . $user['Emp_id'] . '" />';
                                                            $i++;
                                                        }
                                                        $profile_image = "";
                                                        if (isset($user['profile_image']) && !empty($user['profile_image'])) {
                                                            $profile_image = "data:image/jpeg;base64," . $user['profile_image'];
                                                        } else {
                                                            if (isset($user['profile_image_alternate']) && !empty($user['profile_image_alternate'])) {
                                                                $profile_image = $user['profile_image_alternate'];
                                                            } else {
                                                                $profile_image = base_url('assets/img/a0.jpg');
                                                            }
                                                        }
                                                ?>
                                                        <tr>
                                                            <td class="client-avatar"><img alt="image" src="<?php echo $profile_image ?>"> </td>
                                                            <td><a onclick="user_data_load('<?php echo $user['Emp_id'] ?>')" class="client-link"><?php echo $user['Emp_Name'] ?></a></td>
                                                            <td> <?php echo $user['DepName'] ?></td>
                                                            <td class="contact-type"><i class="fa fa-envelope"> </i></td>
                                                            <td> <?php echo $user['EMail']; ?></td>
                                                            <td class="client-status"><span class="label label-primary">Active</span></td>
                                                        </tr>
                                                <?php
                                                    }
                                                    if ($i == 0) {
                                                        echo '<input type="hidden" name="user_intial_load" id="user_intial_load" value="0" />';
                                                    }
                                                }
                                                ?>
                                            </tbody>
                                        </table>


                                    </div>

                                </div>



                            </div>
                            <div id="tab-2" class="tab-pane" style="    height: 322px !important;">
                                <div id="search-tab" style="    padding-bottom: 20px;    padding-top: 20px;">
                                    <div class="input-group">
                                        <input type="text" placeholder="Search for available roles" id="search_user_role_data" name="search_user_data" class="input form-control">
                                        <span class="input-group-btn">
                                            <button type="button" class="btn btn btn-primary" onclick="load_search_role_data();"> <i class="fa fa-search"></i> Search</button>
                                        </span>
                                    </div>
                                </div>
                                <div class="full-height-scrollbar" id="role_list_data">

                                    <div class="table-responsive">
                                        <table class="table table-striped table-hover">
                                            <thead>
                                                <tr>
                                                    <th>Role</th>
                                                    <th>Description</th>
                                                    <th>Status</th>

                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                if (isset($role_data) && !empty($role_data) && is_array($role_data)) {
                                                    $i = 0;

                                                    foreach ($role_data as $role) {
                                                        if ($i == 0) {
                                                            echo '<input type="hidden" name="role_intial_load" id="role_intial_load" value="' . $role['role_id'] . '" />';
                                                            $i++;
                                                        }
                                                ?>
                                                        <tr>
                                                            <td><a href="javascript:void(0);" onclick="role_data_load('<?php echo $role['role_id']; ?>');" class="client-link"><?php echo $role['role_name']; ?></a></td>
                                                            <td><?php echo $role['role_description']; ?></td>
                                                            <td data-toggle="tooltip" title="Role Status">
                                                                <?php if ($role['isactive'] == 1) { ?>
                                                                    <!--<input type="checkbox"  class="js-switch" data-toggle="tooltip" title="Slide for Enable/Disable" onchange="change_status('<?php echo $role['role_id'] ?>', this)" checked  id="t1" />-->

                                                                    <span class=" label label-primary">Active</span>
                                                                <?php } else {
                                                                ?>
                                                                    <!--<input type="checkbox"  class="js-switch" data-toggle="tooltip" title="Slide for Enable/Disable" onchange="change_status('<?php echo $role['role_id'] ?>', this)"  id="" class="js-switch"  />-->
                                                                    <span class="label label-warning">Disabled</span>
                                                                <?php }
                                                                ?>
                                                            </td>
                                                        </tr>
                                                <?php
                                                    }
                                                    if ($i == 0) {
                                                        echo '<input type="hidden" name="role_intial_load" id="role_intial_load" value="0" />';
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
        <div class="col-sm-4" id="data_preview_panel">

        </div>
    </div>
</div>









<script type="text/javascript">
    function change_status(role_id, element) {

        var status_type = $(element).prop("checked");
        if (status_type == true)
            status = 1;
        else
            status = -1;
        var ops_url = baseurl + 'activity/change_status/';
        $.ajax({
            type: "POST",
            cache: false,
            async: false,
            url: ops_url,
            data: {
                "load": 1,
                "role_id": role_id,
                "status": status
            },
            success: function(result) {
                var data = $.parseJSON(result);
                if (data.status == 1) {
                    if (status == -1) {
                        swal('Role Updated', 'Role status deactivated successfully.', 'success');
                        $('#faculty_loader').removeClass('sk-loading');
                        gs_count();
                        return true;
                    } else {
                        if (status == 1) {
                            swal('Role Updated', 'Role status activated successfully.', 'success');
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
                            //                            window.location.href = baseurl + "country/show-country";
                            load_country();
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
                                //                                window.location.href = baseurl + "country/show-country";
                                load_country();
                            });
                        } else {
                            swal({
                                title: '',
                                text: 'Country Status Updation Failed',
                                type: 'info',
                                showCancelButton: false,
                                confirmButtonColor: '#3085d6',
                                cancelButtonColor: '#d33',
                                confirmButtonText: 'OK'
                            }, function(isConfirm) {
                                //                                window.location.href = baseurl + "country/show-country";
                                load_country();
                            });
                        }

                    }
                }
            }
        });
    }



    function load_search_role_data() {
        var search_role = $('#search_user_role_data').val();
        var ops_url = baseurl + 'user/show-search';
        $.ajax({
            type: "POST",
            cache: false,
            async: false,
            url: ops_url,
            data: {
                "load": 1,
                "search_role": search_role
            },
            success: function(result) {
                var data = JSON.parse(result);
                console.log(data);
                if (data.status == 1) {
                    $('#role_list_data').html(data.view);
                    $('.permission-list').slimscroll({
                        height: '100%'
                    });
                } else {
                    alert('No data loaded');
                }
            }
        });
    }

    $(document).ready(function() {



        $('.full-height-scroll').slimscroll({
            height: '100%'
        });

        user_intial_load();
        $('.dataselecter').select2({
            'width': '100%',
            'theme': 'bootstrap'
        })
    });


    function user_intial_load() {
        $('#previous').show();
        $('#previous').prop('disabled', true);
        var intial_id = $('#user_intial_load').val();

        if (intial_id == 0) {
            swal('', 'There are no user available to preview', 'info');
            alert(intial_id)
            return false;
        } else {
            var ops_url = baseurl + 'user/show-user-data-detail';
            $.ajax({
                type: "POST",
                cache: false,
                async: false,
                url: ops_url,
                data: {
                    "load": 1,
                    "userid": intial_id
                },
                success: function(result) {
                    var data = JSON.parse(result);
                    if (data.status == 1) {
                        $('#data_preview_panel').html(data.view);
                        $('.dataselecter').select2({
                            'theme': 'bootstrap',
                            'width': '100%'
                        });
                    } else {
                        alert('No data loaded');
                    }
                }
            });
        }

    }

    function user_data_load(userid) {

        var ops_url = baseurl + 'user/show-user-data-detail';
        $.ajax({
            type: "POST",
            cache: false,
            async: false,
            url: ops_url,
            data: {
                "load": 1,
                "userid": userid
            },
            success: function(result) {
                var data = JSON.parse(result);
                if (data.status == 1) {
                    $('#data_preview_panel').html(data.view);
                    $('.dataselecter').select2({
                        'theme': 'bootstrap',
                        'width': '100%'
                    });
                } else {
                    alert('No data loaded');
                }
            }
        });

    }

    function user_next() {
        $('#search_user_data').val('');
        $('#previous').show();
        $('#previous').prop('disabled', false);
        var user_pre = $('#user_next').val();
        var user_next = parseFloat(user_pre) + 1;
        $('#user_next').val(user_next);
        var ops_url = baseurl + 'user/show-activity';
        $.ajax({
            type: "POST",
            cache: false,
            async: false,
            url: ops_url,
            data: {
                "load": 1,
                "page": user_next
            },
            success: function(result) {
                var data = JSON.parse(result);
                console.log(data);
                if (data.status == 1) {
                    $('#user_list_data').html(data.view);
                    $('.dataselecter').select2({
                        'theme': 'bootstrap',
                        'width': '100%'
                    });
                } else {
                    swal('', 'No more users found.', 'info');
                    $('#next').prop('disabled', true);
                }
            }
        });

    }

    function user_pre() {
        $('#next').prop('disabled', false);
        var user_pre = $('#user_next').val();
        var user_next = parseFloat(user_pre) - 1;
        $('#user_next').val(user_next);
        if (user_pre == 2) {
            $('#previous').prop('disabled', true);
        }
        var ops_url = baseurl + 'user/show-activity';
        $.ajax({
            type: "POST",
            cache: false,
            async: false,
            url: ops_url,
            data: {
                "load": 1,
                "page": user_next
            },
            success: function(result) {
                var data = JSON.parse(result);
                if (data.status == 1) {
                    $('#user_list_data').html(data.view);
                    $('.dataselecter').select2({
                        'theme': 'bootstrap',
                        'width': '100%'
                    });
                } else {
                    swal('', 'No more users found.', 'info');
                }
            }
        });

    }

    function load_search_user_data() {

        var search = $('#search_user_data').val();
        var ops_url = baseurl + 'user/show-search-user';
        $.ajax({
            type: "POST",
            cache: false,
            async: false,
            url: ops_url,
            data: {
                "load": 1,
                "search": search
            },
            success: function(result) {
                var data = JSON.parse(result);
                if (data.status == 1) {
                    $('#user_list_data').html(data.view);
                    $('.dataselecter').select2({
                        'theme': 'bootstrap',
                        'width': '100%'
                    });
                } else {
                    alert('No data loaded');
                }
            }
        });

    }
    $('#role_permission_data').on('click', function() {
        $('#data_preview_panel').html('');
        role_intial_load();
    });

    $('#user_data_view').on('click', function() {
        $('#data_preview_panel').html('');
        user_intial_load();
    });



    function role_intial_load() {
        var intial_id = $('#role_intial_load').val();

        if (intial_id == 0) {
            swal('', 'There are no role available to preview', 'info');
            alert(intial_id)
            return false;
        } else {
            var ops_url = baseurl + 'user/show-role-data-detail';
            $.ajax({
                type: "POST",
                cache: false,
                async: false,
                url: ops_url,
                data: {
                    "load": 1,
                    "roleid": intial_id
                },
                success: function(result) {
                    var data = JSON.parse(result)
                    if (data.status == 1) {
                        $('#data_preview_panel').html(data.view);
                        $('.permission-list').slimscroll({
                            height: '100%'
                        });
                    } else {
                        alert('No data loaded');
                    }
                }
            });
        }

    }

    function role_data_load(roleid) {
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
                    $('.permission-list').slimscroll({
                        height: '100%'
                    });
                } else {
                    alert('No data loaded');
                }
            }
        });

    }

    function add_new_role() {
        var ops_url = baseurl + 'user/add-new-role';
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
                if (data.status == 1) {
                    $('#role_data_content').html(data.view);
                    $('.dataselecter').select2({
                        'theme': 'bootstrap',
                        'width': '100%'
                    });
                } else {
                    alert('No data loaded');
                }
            }
        });

    }

    function reset_permission(roleid) {
        var ops_url = baseurl + 'user/set-role-permission';
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
                var data = JSON.parse(result);
                if (data.status == 1) {
                    $('#on_edit').html('');
                    $('#on_edit').html(data.view);

                } else {
                    alert('No data loaded');
                }
            }
        });

    }
</script>