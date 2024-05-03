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
<?php if (null !== ($this->session->userdata('isgoogle_no_access_rights')) && $this->session->userdata('isgoogle_no_access_rights') == 1) { ?>
    <script type="text/javascript">
        activate_toast_login_for_error('No access rights are associated with your account. Please contact administrator to activate user roles to your account', 'Login Failed!!', 'error', 500);
    </script>
<?php
    $this->session->unset_userdata('isgoogle_no_access_rights');
    $this->session->unset_userdata('token');
}
?>

<div>
    <h1 class="logo-name"><img src="<?php echo base_url('assets/images/logo.png'); ?>" style="width: 100px;height: auto;" /></h1>
</div>
<h3>Welcome to Parent Portal</h3>

<p>Login to see the action.</p>
<div id="login_otp_requisation">
    <?php
    echo form_open('login', array('class' => 'form-horizontal', 'id' => 'login_user', 'role' => 'form'));
    ?>
    <div class="form-group">
        <input type="phone" class="form-control digits" maxlength="12" placeholder="Registered Mobile Number" id="user_phone_no" name="user_phone_no" required="">
    </div>
    <div class="form-group">
        <input type="text" class="form-control" placeholder="Admission Number" id="admn_no" name="admn_no" required="">
    </div>
    <button type="submit" class="btn btn-info block full-width m-b" onclick="initiate_login();">Send OTP</button>
    <?php
    echo form_close();
    ?>
</div>

<p class="m-t">
    <small><strong> DocMe </strong>&copy; <?php echo date('Y') . " - " . (date('Y') + 1); ?> <?php echo APP_VERSION; ?><?php echo ENVIRONMENT == 'production' ? '' : '-Development' ?> </small>
</p>

<script>
    $(document).on("keypress", ".digits", function(e) {
        var dec_numbers = /[0-9]+?$/;
        if (!dec_numbers.test(e.key)) {
            return false;
        } else {
            return true;
        }
    });

    function load_account() {
        var ops_url = baseurl + 'fees/fee-register-account/';
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
    //    function forgot_password() {
    //        var ops_url = baseurl + 'fees/fee-forgot-password/';
    //        $.ajax({
    //            type: "POST",
    //            cache: false,
    //            async: false,
    //            url: ops_url,
    //            data: {"load": 1},
    //            success: function (result) {
    //                $('#data-view').html(result);
    //            }
    //        });
    //    }
</script>

<script type="text/javascript">
    $('#login_user').submit(function(e) {
        e.preventDefault();
        //        initiate_login();
    });


    $('#login_user_otp').submit(function(e) {
        e.preventDefault();
        //        initiate_login();
    });




    function initiate_login() {
        if ($("#login_user")[0].checkValidity()) {
            //            var plain_pass = $('#user_passcode').val();            
            //            var password = hex_md5($('#user_passcode').val());
            var user_phone_no = $('#user_phone_no').val();
            var admn_no = $('#admn_no').val();
            if (user_phone_no.length == 0) {
                $('#status_marker').val('0');
                $('.login-spinner').hide();
                return false;
            }
            if (admn_no.length == 0) {
                $('#status_marker').val('0');
                $('.login-spinner').hide();
                return false;
            }

            var ops_url = baseurl + 'portal/parent-user-login-send-otp/'

            $.ajax({
                type: "POST",
                cache: false,
                async: false,
                dataType: 'json',
                url: ops_url,
                data: {
                    "user_phone_no": user_phone_no,
                    "admn_no": admn_no
                },
                success: function(data) {
                    //                    var data = JSON.parse(result);
                    if (data.status == 1) {
                        $('#status_marker').val('0');
                        $('.login-spinner').hide();
                        $('#login_otp_requisation').html(data.view);

                        $('#login_user_otp').submit(function(e) {
                            e.preventDefault();
                            //                            initiate_login();
                        });
                        //                        activate_toast_login('Please wait while we take you to home...', 'Login Successfull!!', 'success')
                        ////                        noty({text: 'Login Successfull!! Please wait while we take you to home...', layout: 'topRight', type: 'success'});
                        //                        setTimeout(function () {
                        //                            window.location.href = data.redirect_url;
                        //                        }, 50);

                    } else if (data.status == 2) {
                        $('.login-spinner').hide();
                        $('#status_marker').val('0');
                        swal('', 'There are no data linked to your account. Please contact administrator for more details.', 'warning');
                    } else {
                        $('.login-spinner').hide();
                        $('#status_marker').val('0');
                        swal('Login failed', 'Please check your credentials!!!!', 'warning');
                    }
                },
                error: function(data) {
                    $('#status_marker').val('0');
                    $('.login-spinner').hide();
                    swal('Login failed', 'Please check your credentials or internet connection.!!!!', 'warning');
                }
            });
            $('#status_marker').val('0');
            $('.login-spinner').hide();
            //            } else {
            //                swal('', 'Please be patient, we are pluging you into the app.', 'info');
            //            }
        }

    }


    function initiate_OTP_login() {
        if ($("#login_user_otp")[0].checkValidity()) {
            //            var plain_pass = $('#user_passcode').val();            
            //            var password = hex_md5($('#user_passcode').val());
            var otp = $('#otp').val();

            if (otp.length == 0) {
                $('#status_marker').val('0');
                $('.login-spinner').hide();
                swal('', 'Enter OTP to proceed', 'info');
                return false;
            }


            var ops_url = baseurl + 'portal/parent-user-otp-verification/'

            $.ajax({
                type: "POST",
                cache: false,
                async: false,
                dataType: 'json',
                url: ops_url,
                data: {
                    "otp_data": otp
                },
                success: function(data) {
                    //                    var data = JSON.parse(result);
                    if (data.status == 1) {
                        $('#status_marker').val('0');
                        $('.login-spinner').hide();
                        //                        $('#login_otp_requisation').html(data.view);

                        activate_toast_login('Please wait while we take you to home...', 'Login Successfull!!', 'success')
                        ////                        noty({text: 'Login Successfull!! Please wait while we take you to home...', layout: 'topRight', type: 'success'});
                        setTimeout(function() {
                            window.location.href = data.redirect_url;
                        }, 50);
                        load_otp_verification_page();
                    } else if (data.status == 2) {
                        $('.login-spinner').hide();
                        $('#status_marker').val('0');
                        swal('', 'There are no data linked to your account. Please contact administrator for more details.', 'warning');
                    } else {
                        $('.login-spinner').hide();
                        $('#status_marker').val('0');
                        swal('Login failed', 'Please check your credentials!!!!', 'warning');
                    }
                },
                error: function(data) {
                    $('#status_marker').val('0');
                    $('.login-spinner').hide();
                    swal('Login failed', 'Please check your credentials or internet connection.!!!!', 'warning');
                }
            });
            $('#status_marker').val('0');
            $('.login-spinner').hide();
            //            } else {
            //                swal('', 'Please be patient, we are pluging you into the app.', 'info');
            //            }
        }

    }
</script>