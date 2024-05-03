<script type="text/javascript" src="<?php echo base_url('assets/theme/plugins/MD5/MD5.js'); ?>"></script>

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
        <div class="col-lg-4">
            <div class="ibox">

                <div class="ibox-title">
                    <h5>Change Password</h5>
                </div>
                <div class="ibox-content col-lg-12" id="data_loader">
                    <div class="sk-spinner sk-spinner-wave">
                        <div class="sk-rect1"></div>
                        <div class="sk-rect2"></div>
                        <div class="sk-rect3"></div>
                        <div class="sk-rect4"></div>
                        <div class="sk-rect5"></div>
                    </div>
                    <div class="col-lg-12 col-md-12 col-xs-12 col-sm-12">
                        <div class="form-group">
                            <label class="control-label" for="name">Current Password *</label>
                            <input type="password" id="currentPassword" name="name" class="form-control" style="background-color: white" placeholder="Current Password" maxlength="15">
                        </div>
                    </div>
                    <div class="col-lg-12 col-md-12 col-xs-12 col-sm-12">
                        <div class="form-group">
                            <label class="control-label" for="name">New Password *</label>
                            <input type="password" id="newPassword" name="name" class="form-control" style="background-color: white" placeholder="New Password" maxlength="15">
                        </div>
                    </div>
                    <div class="col-lg-12 col-md-12 col-xs-12 col-sm-12">
                        <div class="form-group">
                            <label class="control-label" for="name">Confirm New Password *</label>
                            <input type="password" id="confirmNewPassword" name="name" class="form-control" style="background-color: white" placeholder="Confirm Password" maxlength="15">
                        </div>
                    </div>
                    <div class="col-lg-12 col-md-12 col-xs-12 col-sm-12">
                        <label class="control-label">Criteria</label>
                        <ul>
                            <li>Password must be a combination of alphabets and numbers. <br />Eg:abcd1234</li>
                            <li>Password length should be greater than or equal to 8 characters and less than or equal to 15 characters. </li>
                        </ul>
                    </div>

                    <div class="col-lg-12 col-md-12 col-xs-12 col-sm-12">
                        <button type="button" class="btn btn-primary btn-sm btn-block" onclick="change_password(<?php echo $userid ?>,'<?php echo $emailid ?>')"><i class="fa fa-save"></i> Change Password
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-4" id="data_preview_panel">

        </div>
    </div>
</div>

<script type="text/javascript">
    function change_password(Emp_id, email) {
        $('#data_loader').addClass('sk-loading');
        var currentPassword = $("#currentPassword").val();
        var newPassword = $("#newPassword").val();
        var confirmNewPassword = $("#confirmNewPassword").val();
        var passcode = /^(?=.*[0-9])(?=.*[a-z])([a-zA-Z0-9]{8,15})$/;
        if (currentPassword == '') {
            swal('', 'Current Password is required.', 'info');
            $('#data_loader').removeClass('sk-loading');
            return false;
        } else if (newPassword == '') {
            swal('', 'New Password is required.', 'info');
            $('#data_loader').removeClass('sk-loading');
            return false;
        } else if (confirmNewPassword == '') {
            swal('', 'Confirm Password is required.', 'info');
            $('#data_loader').removeClass('sk-loading');
            return false;
        } else if ((confirmNewPassword.length > '15') || (confirmNewPassword.length < '8')) {
            swal('', 'Password is too short, Password should be  greater than or equal to 8 characters and less than or equal to 15 characters.', 'info');
            $('#data_loader').removeClass('sk-loading');
            return false;
        } else if (newPassword != confirmNewPassword) {
            swal('', "Password doesn't match confirmation password.", 'info');
            $('#data_loader').removeClass('sk-loading');
            return false;
        } else if (currentPassword == newPassword) {
            swal('', 'New password should be different from old password.', 'info');
            $('#data_loader').removeClass('sk-loading');
            return false;
        } else if ((!passcode.test(newPassword)) || (!passcode.test(confirmNewPassword))) {
            swal('', 'Password must be a combination of alphabets and numbers.', 'info');
            $('#data_loader').removeClass('sk-loading');
            return false;
        }

        var encrypted_password = hex_md5(confirmNewPassword);
        var old_encrypted_password = hex_md5(currentPassword);
        var ops_url = baseurl + 'user/change-userpassword';

        $.ajax({
            type: "POST",
            cache: false,
            // async: false,
            url: ops_url,
            data: {
                "Emp_id": Emp_id,
                "email": email,
                "password": encrypted_password,
                "old_password": old_encrypted_password
            },
            success: function(result) {
                var data = JSON.parse(result);
                if (data.status == 0) {
                    swal('', 'Please verify the password and try again.', 'info');
                    $('#data_loader').removeClass('sk-loading');
                    return false;
                }
                if (data.status == 1) {
                    console.log(data.data.ErrorStatus);
                    if (data.data.ErrorStatus == 0) {

                        swal({
                            title: '',
                            text: 'Password changed successfully.Application will be logged out,Please login using new password.',
                            type: 'success',
                            showCancelButton: false,
                            confirmButtonColor: '#3085d6',
                            cancelButtonColor: '#d33',
                            confirmButtonText: 'OK',
                            closeOnConfirm: true
                        }, function(isConfirm) {
                            window.location = '<?php echo base_url('logout'); ?>'
                        });
                        // swal('', 'Password changed successfully.Application will be logged out,Please login using new Password.', 'success');
                        $('#data_loader').removeClass('sk-loading');
                        return false;
                    }
                    if (data.data.ErrorStatus == 3) {
                        swal('', 'Entered Current Password is wrong', 'error');
                        $('#data_loader').removeClass('sk-loading');
                        return false;
                    }
                }
                if (data.status == 2) {
                    swal('', 'Please contact the administrator.', 'error');
                    $('#data_loader').removeClass('sk-loading');
                    return false;
                }


            }
        });
    }
</script>