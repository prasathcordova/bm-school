<div class="middle-box text-center loginscreen   animated fadeInDown">
    <div>
        <div id="data-view"></div>
        <div>

            <!--<h1 class="logo-name">ACE</h1>-->

        </div>
        <h3>Register to ACE</h3>
        <p>Create account to see it in action.</p>
        <?php
        echo form_open('parent_registration', array('id' => 'parentreg_save', 'role' => 'form'));
        ?>

        <!--<form class="m-t" role="form" action="login.html" id="form">-->


        <div class="form-group">
            <input type="email" id=pemail name=pemail placeholder="Enter email" class="form-control" required>
        </div>
    </div>
    <div class="form-group">
        <input type="text" id=pmobile name=pmobile class="form-control" placeholder="Mobile" required="">
    </div>

    <div class="form-group">
        <input type="password" id=passcode name=passcode class="form-control" placeholder="Password" required="">
    </div>
    <div class="form-group">
        <div class="checkbox i-checks"><label> <input type="checkbox"><i></i> Agree the terms and policy </label></div>
    </div>
    <button type="submit" onclick="register_parent();" class="btn btn-info block full-width m-b">Register</button>

    <p class="text-muted text-center"><small>Already have an account?</small></p>
    <a class="btn btn-sm btn-white btn-block" href="login.html">Login</a>
    <?php echo form_close(); ?>
    <p class="m-t"> <small><strong> DocMe </strong>&copy; <?php echo date('Y') . " - " . (date('Y') + 1); ?> <?php echo APP_VERSION; ?><?php echo ENVIRONMENT == 'production' ? '' : '-Development' ?> </small> </p>

</div>
<!--</div>-->
<!-- Jquery Validate -->
<script src="<?php echo base_url('assets/plugins/validate/jquery.validate.min.js'); ?>"></script>

<script>
    $(document).ready(function() {

        $("#form").validate({
            rules: {
                password: {
                    required: true,
                    minlength: 3
                },
                url: {
                    required: true,
                    url: true
                },
                number: {
                    required: true,
                    number: true
                },
                min: {
                    required: true,
                    minlength: 6
                },
                max: {
                    required: true,
                    maxlength: 4
                }
            }
        });
    });

    function register_parent() {

        var ops_url = baseurl + 'fees/fee-parent-registration/';
        var parent_email = pemail.value;
        var parent_mobile = pmobile.value;
        var parent_passcode = passcode.value;


        if (parent_email == '') {
            swal('', 'Email is Required', 'info');

            return false;
        }


        if (parent_mobile == '') {
            swal('', 'Parent Mobile is Required', 'info');
            $('#faculty_loader').removeClass('sk-loading');
            return false;
        }


        if (parent_passcode == '') {
            swal('', 'Password is Required', 'info');
            $('#faculty_loader').removeClass('sk-loading');
            return false;
        }

        $.ajax({
            type: "POST",
            cache: false,
            async: false,
            url: ops_url,
            data: {
                "parent_mobile": parent_mobile,
                "parent_email": parent_email,
                "parent_passcode": parent_passcode
            },
            success: function(result) {
                var data = $.parseJSON(result);
                if (data.status == 1) {
                    swal({
                        title: 'Registration Successfull',
                        text: 'Parent registered successfully. Please login with provided email and password to activate account',
                        type: 'success',
                        showCancelButton: false,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'OK',
                        closeOnConfirm: false
                    }, function(isConfirm) {
                        window.location.href = baseurl + 'portal/parent-login';
                    });
                    return true;

                } else {
                    swal('', 'Connection Error. Please contact administrator', 'info');

                }

            }
        });
    }