<div class="login-body">
    <div class="login-title"><strong>Log In</strong> to your DocMe Account
        <img src="<?php echo base_url('assets/img/logo.png'); ?>" alt="DocMe-Cloud" style="width: 10%;float:right" />
    </div>
    <?php
    echo form_open('login', array('class' => 'form-horizontal', 'id' => 'login_user', 'role' => 'form'));
    ?>
    <div class="form-group">
        <div class="col-md-12">
            <input type="email" required="true" id="user_email" class="form-control" placeholder="E-mail" tabindex="100" />
        </div>
    </div>
    <div class="form-group">
        <input type="hidden" value="0" id="status_marker" />
        <div class="col-md-12">
            <input type="password" required="" id="user_passcode" class="form-control" placeholder="Password" tabindex="101" />
        </div>
    </div>
    <div class="form-group">
        <div class="col-md-5">
            <button class="btn btn-info btn-block" onclick="initiate_login();" tabindex="102">Log In <span class="login-spinner" style="float: right;display: none;"><i style="font-size: 20px;" class="fa fa-cog fa-spin fa-3x fa-fw"></i></span></button>
        </div>
        <div class="col-md-2" style="padding-left: 11px !important;">
            <div class="login-or">OR</div>
        </div>
        <div class="col-md-5">
            <button class="btn btn-info btn-block btn-google" tabindex="103" onclick="functionality_comming_soon();"><span class="fa fa-google-plus"></span> Google</button>
        </div>
    </div>

    <div class="form-group">
        <div class="col-md-6">
            <a href="javascript:void(0);" onclick="functionality_comming_soon();" class="btn btn-link btn-block">Forgot your password?</a>
        </div>
        <div class="col-md-6">

        </div>

    </div>

    </form>
</div>
<div class="login-footer">
    <div class="pull-left">
        &copy; 2017 Docme-Cloud
    </div>
    <div class="pull-right">
        <a href="javascript:void(0);" onclick="functionality_comming_soon();">About</a> |
        <a href="javascript:void(0);" onclick="functionality_comming_soon();">Privacy</a> |
        <a href="javascript:void(0);" onclick="functionality_comming_soon();">Contact Us</a>
    </div>
</div>

<script type="text/javascript">
    $('#login_user').submit(function(e) {
        e.preventDefault();
    });



    function initiate_login() {
        if ($('#status_marker').val() == 0) {
            $('#status_marker').val('1');
            $('.login-spinner').show();
            var plain_pass = $('#user_passcode').val();
            var password = hex_md5($('#user_passcode').val());
            var username = $('#user_email').val();

            if (username.length == 0) {
                $('#status_marker').val('0');
                $('.login-spinner').hide();
                return false;
            }
            if (plain_pass.length == 0) {
                $('#status_marker').val('0');
                $('.login-spinner').hide();
                return false;
            }

            var ops_url = baseurl + 'login/'

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
                    console.log(data);
                    if (data.status == 1) {
                        $('#status_marker').val('0');
                        $('.login-spinner').hide();
                        noty({
                            text: 'Login Successfull. Please wait while we take you to home...',
                            layout: 'topRight',
                            type: 'success'
                        });
                        setTimeout(function() {
                            window.location.href = data.redirect_url;
                        }, 2000);
                    } else {
                        $('.login-spinner').hide();
                        $('#status_marker').val('0');
                        swal('Login failed', 'Please check your credentials', 'warning');
                    }
                },
                error: function(data) {
                    $('#status_marker').val('0');
                    $('.login-spinner').hide();
                    swal('Login failed', 'Please check your login credentials or internet connection.', 'warning');
                }
            });
            $('#status_marker').val('0');
            $('.login-spinner').hide();
        } else {
            swal('Login', 'Please be Patient, We are Pluging you into the App.');
        }
    }
</script>