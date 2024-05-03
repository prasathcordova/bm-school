<script type="text/javascript" src="<?php echo base_url('assets/theme/plugins/MD5/MD5.js'); ?>"></script>

<div class="ibox " style="height: 662px !important;">
    <div class="ibox-content">
        <div class="tab-content">
            <div id="contact-1" class="tab-pane active">
                <div class="row m-b-lg">
                    <div class="col-lg-4 text-center">

                        <?php
                        $profile_image = "";
                        if (isset($user_data['profile_image']) && !empty($user_data['profile_image'])) {
                            $profile_image = "data:image/jpeg;base64," . $user_data['profile_image'];
                        } else {
                            if (isset($user_data['profile_image_alternate']) && !empty($user_data['profile_image_alternate'])) {
                                $profile_image = $user_data['profile_image_alternate'];
                            } else {
                                $profile_image = base_url('assets/img/a0.jpg');
                            }
                        }
                        ?>
                        <div class="m-b-sm">
                            <img alt="image" class="img-circle" src="<?php echo $profile_image; ?>" style="width: 62px">
                        </div>
                    </div>
                    <div class="col-lg-8">
                        <strong>
                            <h2><?php echo $user_data['Emp_Name'] ?></h2>
                        </strong>
                        <p>
                            <?php echo $user_data['Designation'] . "/" . $user_data['DepName']; ?>
                        </p>
                        <!--                        <button type="button" class="btn btn-primary btn-sm btn-block"><i
                                class="fa fa-envelope"></i> Send Email
                        </button>-->
                    </div>
                    <div class="clearfix"></div>
                    <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12" style="padding-top: 20px;">
                        <div class="ibox float-e-margins" style="margin-bottom: 0px;">
                            <div class="ibox-title" id="password_reset">
                                <h5>Change / Reset Password</h5>
                                <div class="ibox-tools">

                                </div>
                            </div>
                            <div class="ibox-content">
                                <div class="sk-spinner sk-spinner-wave">
                                    <div class="sk-rect1"></div>
                                    <div class="sk-rect2"></div>
                                    <div class="sk-rect3"></div>
                                    <div class="sk-rect4"></div>
                                    <div class="sk-rect5"></div>
                                </div>
                                <div class="row" id="pwd-container4">
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label for="password4">New Password</label>
                                            <input type="password" class="form-control example_type4" id="password" placeholder="Password">
                                        </div>
                                        <div class="form-group">
                                            <span class="font-bold pwstrength_viewport_verdict4"></span>
                                            <span class="pwstrength_viewport_progress4"></span>
                                        </div>
                                        <div class="user-button">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <button type="button" onclick="change_password('<?php echo $user_data['Emp_id'] ?>', '<?php echo $user_data['EMail'] ?>');" class="btn btn-primary btn-sm btn-block">Reset Password</button>
                                                </div>
                                                <div class="clearfix"></div>
                                                <div class="col-md-12">
                                                    <div class="notes" style="padding-bottom:10px;padding-left: 10px;padding-top: 10px;margin-bottom: 10px;font-family: Tahoma;">
                                                        *Notes:
                                                        <span class="text-muted small">
                                                            Password must contain atleast one small letter alphabet, atleast one numeric, password length should be greater than 8 characters and less than 15 characters
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                    <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12" style="padding-top: 20px;">
                        <div class="ibox float-e-margins" style="margin-bottom: 0px;">
                            <div class="ibox-title">
                                <h5>Access Role</h5>
                                <div class="ibox-tools">

                                </div>
                            </div>
                            <div class="ibox-content">
                                <div class="form-group">
                                    <label class="font-bold">Select an Access Role</label>
                                    <div>
                                        <select data-placeholder="Choose a Role" class="dataselecter" tabindex="2" name="user_role" id="user_role" multiple="">
                                            <option value="">Select</option>
                                            <?php
                                            if (isset($role_data) && !empty($role_data)) {
                                                foreach ($role_data as $role) {
                                                    $flag = 0;
                                                    if (isset($user_role) && !empty($user_role)) {
                                                        foreach ($user_role as $role_data_fac) {
                                                            if (isset($role['role_id']) && !empty($role['role_id']) && isset($role_data_fac['role_id']) && !empty($role_data_fac['role_id']) && $role['role_id'] == $role_data_fac['role_id']) {
                                                                $flag = 1;
                                                                break;
                                                            } else {
                                                                $flag = 0;
                                                            }
                                                        }
                                                    } else {
                                                        $flag = 0;
                                                    }
                                                    if (isset($role['role_id']) && !empty($role['role_id']) && isset($role['role_name']) && !empty($role['role_name']) && $flag == 1) {
                                                        echo '<option selected value="' . $role['role_id'] . '">' . $role['role_name'] . '</option>';
                                                    } else {
                                                        echo '<option value="' . $role['role_id'] . '">' . $role['role_name'] . '</option>';
                                                    }
                                                }
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="user-button">
                                    <div class="row">
                                        <div class="col-md-12 col-md-12 col-sm-12 col-xs-12">
                                            <button type="button" onclick="map_role('<?php echo $user_data['Emp_id'] ?>');" class="btn btn-primary btn-sm btn-block">Assign Access Role</button>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                    <div class="col-sm-12 col-xs-12 col-md-12 col-lg-12" style="padding-top: 25px;">
                        <strong>User Log</strong>
                        <div class="full-height-scroll-activity">
                            <table class="table table-stripped small m-t-md">

                                <tbody>
                                    <?php
                                    if (isset($activity_data) && !empty($activity_data) && is_array($activity_data)) {
                                    ?>
                                        <?php
                                        foreach ($activity_data as $activity) {
                                        ?>
                                            <tr>
                                                <td class="no-borders">
                                                    <i class="fa fa-circle text-danger"> </i>&nbsp;&nbsp;<?php echo $activity['DatePart'] ?>
                                                    &nbsp;&nbsp;&nbsp;&nbsp; <?php echo $activity['TimePart'] ?>
                                                </td>
                                                <td class="no-borders">

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
<script type="text/javascript">
    function map_role(Emp_id) {

        var roles = $('#user_role').val();
        var formatted_role = JSON.stringify(roles);
        if ((roles.length == '0')) {
            swal('', 'Select Atleast One Role', 'info');
            $('#data_loader').removeClass('sk-loading');
            return false;
        }

        var ops_url = baseurl + 'user/set-userrole';
        $.ajax({
            type: "POST",
            cache: false,
            async: false,
            url: ops_url,
            data: {
                "facultyid": Emp_id,
                "roleid": formatted_role
            },
            success: function(result) {
                var data = JSON.parse(result);

                if (data.status == 1) {
                    swal('', 'Access Role assgined successfully.', 'success');
                    user_data_load(Emp_id);
                    return true;
                }
                if (data.status == 2) {
                    swal('', 'Please contact the administrator.', 'info');
                    return false;
                }

            }
        });


    }

    function change_password(Emp_id, email) {

        var password = $("#password").val();
        if (password == '') {
            swal('', 'Password is required.', 'info');
            $('#data_loader').removeClass('sk-loading');
            return false;
        } else if ((password.length > '15') || (password.length < '8')) {
            swal('', 'Password must contain atleast one small letter alphabet, atleast one numeric, password length should be greater than 8 characters and less than 15 characters', 'info');
            $('#data_loader').removeClass('sk-loading');
            return false;
        }

        var passcode = /^(?=.*[0-9])(?=.*[a-z])([a-zA-Z0-9]{8,15})$/;
        if (!passcode.test(password)) {
            swal('', 'Password must contain atleast one small letter alphabet, atleast one numeric, password length should be greater than 8 characters and less than 15 characters','info');
            $('#data_loader').removeClass('sk-loading');
            return false;
        }

        var encrypted_password = hex_md5(password);

        var ops_url = baseurl + 'user/change-userpassword';


        $.ajax({
            type: "POST",
            cache: false,
            async: false,
            url: ops_url,
            data: {
                "Emp_id": Emp_id,
                "email": email,
                "password": encrypted_password
            },
            success: function(result) {
                var data = JSON.parse(result);
                if (data.status == 0) {
                    swal('', 'Please verify the password and try again.', 'info');
                    return false;
                }
                if (data.status == 1) {
                    swal('', 'Password changed successfully.', 'success');
                    user_data_load(Emp_id);

                }
                if (data.status == 2) {
                    swal('', 'Please contact the administrator..!!', 'info');
                    return false;
                }

            }
        });


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

    $('.full-height-scrollbar').slimscroll({
        height: '90%'
    });

    $('.full-height-scroll-activity').slimscroll({
        height: '150px'
    })
</script>