<script type="text/javascript" src="<?php echo base_url('assets/theme/plugins/MD5/MD5.js'); ?>"></script>

<?php if (null !== ($this->session->userdata('isgoogle_login_failed')) && $this->session->userdata('isgoogle_login_failed') == 1) { ?>
    <script type="text/javascript">
        activate_toast_login_for_error('Your google account is not linked with docme.Please contact administrator for futher assistance.', 'Login Failed!!', 'error', 500);
    </script>
<?php
    $this->session->unset_userdata('isgoogle_login_failed');
    $this->session->unset_userdata('token');
}
?>


<?php
echo form_open('login', array('class' => 'form-horizontal', 'id' => 'login_user', 'role' => 'form'));
?>
<input type="hidden" value="0" id="status_marker" />
<div class="form-group">
    <div class="col-lg-12">
        <input type="text" class="form-control" placeholder="Email" id="user_email" name="user_email">
    </div>
</div>
<div class="form-group">
    <div class="col-lg-12">
        <input type="password" class="form-control" placeholder="Password" id="user_passcode" name="user_passcode">
    </div>
</div>
<button type="submit" class="btn btn-primary block full-width m-b" onclick="initiate_login();">Login</button>
<?php
echo form_close();
?>

<!-- <a class="btn btn-sm btn-white btn-block" href="<?php echo isset($authUrl) ? $authUrl : 'javascript:void(0);'; ?>">Login With Google Account</a> -->


<script type="text/javascript">
    $('#login_user').submit(function(e) {
        e.preventDefault();
    });



    function initiate_login() {
        $('#faculty_loader').addClass('sk-loading');
        if ($("#login_user")[0].checkValidity()) {
            if ($('#status_marker').val() == 0) {
                $('#status_marker').val('1');

                var plain_pass = $('#user_passcode').val();
                var password = hex_md5($('#user_passcode').val());
                var username = $('#user_email').val();

                if (username.length == 0) {
                    swal('', 'Email is required.', 'info');
                    $('#status_marker').val('0');
                    $('#faculty_loader').removeClass('sk-loading');
                    return false;
                }
                if (plain_pass.length == 0) {
                    swal('', 'Password is required.', 'info');
                    $('#status_marker').val('0');
                    $('#faculty_loader').removeClass('sk-loading');
                    return false;
                }

                var ops_url = baseurl + 'login/';

                $.ajax({
                    type: "POST",
                    cache: false,
                    //async: false,
                    dataType: 'json',
                    url: ops_url,
                    data: {
                        "username": username,
                        "passcode": password
                    },
                    success: function(data) {
                        if (data.status == 1) {
                            $('#status_marker').val('0');
                            activate_toast_login('Please wait while we take you to home...', 'Login Successfull', 'success')
                            setTimeout(function() {
                                window.location.href = data.redirect_url;
                            }, 50);
                            //$('#faculty_loader').removeClass('sk-loading');
                        } else if (data.status == 2) {
                            $('#status_marker').val('0');
                            swal('', 'There are no roles assigned for you. Please contact administrator for role assignement.', 'warning');
                        } else {
                            $('#status_marker').val('0');
                            swal('Login failed', 'Please check your credentials.', 'warning');
                            $('#faculty_loader').removeClass('sk-loading');
                        }
                    },
                    error: function(data) {
                        $('#status_marker').val('0');
                        swal('Login failed', 'Please check your credentials or internet connection.', 'warning');
                        $('#faculty_loader').removeClass('sk-loading');
                    }
                });
                $('#status_marker').val('0');
            } else {
                swal('', 'Please be Patient, We are Pluging you into the App.', 'info');
                $('#faculty_loader').removeClass('sk-loading');
            }
        } else {
            $('#faculty_loader').removeClass('sk-loading');
        }

    }
</script>