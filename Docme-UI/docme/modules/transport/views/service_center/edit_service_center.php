<div class="ibox-title">
    <h5><?php echo isset($title) ? $title : "NO TITLE PROVIDED" ?></h5>
    <div class="clearfix"></div>
    <div class="ibox-tools" id="edit_type">
        <span><a href="javascript:void(0);" onclick="toggle_edit_panel();"> <i style="font-size: 30px !important; float: right; color: #E91E63;" class="material-icons" data-toggle="tooltip" title="Close">close</i></a> </span>
        <span><a href="javascript:void(0);" onclick="submit_edit_save_data();"> <i style="font-size: 30px !important; float: right; color: #23C6C5; padding-right: 10px;" class="material-icons" data-toggle="tooltip" title="Save">save</i></a> </span>
    </div>

</div>
<div class="ibox-content">
    <div class="row">
        <?php
        echo form_open('', array('id' => 'servicecenter_save', 'role' => 'form'));
        ?>
        <div class="row clearfix">
            <div class="col-md-6">
                <b>Name *</b>
                <div class="form-group">
                    <div class="form-line <?php
                                            if (form_error('service_center_name')) {
                                                echo 'has-error';
                                            }
                                            ?> ">
                        <input type="hidden" value="<?php echo $title; ?>" id="title_data" name="title_data" />
                        <input type="hidden" value="<?php echo set_value('service_center_id', isset($edit_data[0]['id']) ? $edit_data[0]['id'] : ''); ?>" id="service_center_id" name="service_center_id" />
                        <input type="text" maxlength="50" class="form-control" name="service_center_name" id="service_center_name" value="<?php echo set_value('service_center_name', isset($edit_data[0]['serviceCenterName']) ? $edit_data[0]['serviceCenterName'] : ''); ?>" placeholder="Name" />
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <b>Location *</b>
                <div class="form-group">
                    <div class="form-line <?php
                                            if (form_error('location')) {
                                                echo 'has-error';
                                            }
                                            ?> ">
                        <input type="text" maxlength="50" class="form-control" name="location" id="location" value="<?php echo set_value('location', isset($edit_data[0]['slocation']) ? $edit_data[0]['slocation'] : ''); ?>" placeholder="Location" />
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <b>Email Id *</b>
                <div class="form-group">
                    <div class="form-line <?php
                                            if (form_error('email')) {
                                                echo 'has-error';
                                            }
                                            ?> ">
                        <input type="email" placeholder="Enter email" class="form-control" required aria-required="true" name="email" id="email" value="<?php echo set_value('email', isset($edit_data[0]['emailId']) ? $edit_data[0]['emailId'] : ''); ?>" />
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <b>Contact Number *</b>
                <div class="form-group">
                    <div class="form-line <?php
                                            if (form_error('cnum')) {
                                                echo 'has-error';
                                            }
                                            ?> ">
                        <input type="text" maxlength="12" class="form-control numeric" name="cnum" id="cnum" value="<?php echo set_value('cnum', isset($edit_data[0]['contactNo']) ? $edit_data[0]['contactNo'] : ''); ?>" placeholder="Contact Number" style="text-align: left" />
                    </div>
                </div>
            </div>
            <?php echo form_close(); ?>
        </div>






        <?php echo form_close(); ?>
    </div>
</div>



<script type="text/javascript">
    function toggle_edit_panel() {
        if ($('#curd-content').is(":visible") == true) {
            $("#curd-content").slideUp("slow", function() {
                $("#curd-content").hide();
                $('#add_type').show();
                $('#search-feecode').show()
            });
        }
    }

    function clear_controls() {
        $('#feeTypeName').val('');

    }

    function submit_edit_save_data() {
        // $('#faculty_loader').addClass('sk-loading');

        var ops_url = baseurl + 'transport/updatesave-servicecenter/';
        var servicecenter_name = $('#service_center_name').val();
        var serv_location = $('#location').val();
        var email = $('#email').val();
        //        var serv_email = $('#email').val();
        var contact_num = $('#cnum').val();
        if (servicecenter_name == '') {
            swal('', 'Name is Required', 'info');
            $('#faculty_loader').removeClass('sk-loading');
            return false;
        } else if ((servicecenter_name.length > '50') || (servicecenter_name.length < '3')) {
            swal('', 'Name should contain letters or numbers 3 to 50', 'info');
            $('#faculty_loader').removeClass('sk-loading');
            return false;
        }
        var alphanumers = /^[a-zA-Z\s0-9]+$/;
        if (!alphanumers.test($("#service_center_name").val())) {
            swal('', 'Service Center Name can have only alphabets or numbers.', 'info');
            $('#faculty_loader').removeClass('sk-loading');
            return false;
        }


        if (serv_location == '') {
            swal('', 'Location is Required', 'info');
            $('#faculty_loader').removeClass('sk-loading');
            return false;
        } else if ((serv_location.length > '50') || (serv_location.length < '3')) {
            swal('', 'Location should contain letters or numbers 3 to 50', 'info');
            $('#faculty_loader').removeClass('sk-loading');
            return false;
        }
        var alphanumers = /^[a-zA-Z\s0-9]+$/;
        if (!alphanumers.test($("#location").val())) {
            swal('', 'Service Center Location can have only alphabets or numbers.', 'info');
            $('#faculty_loader').removeClass('sk-loading');
            return false;
        }
        if (email == '') {
            swal('', 'Email Id is required.', 'info');
            $('#faculty_loader').removeClass('sk-loading');
            return false;
        }
        if (IsEmail(email) == false) {
            swal('', 'Enter valid Email Id.', 'info');
            $('#faculty_loader').removeClass('sk-loading');
            return false;
        }
        if (contact_num == '') {
            swal('', 'Contact Number is required.', 'info');
            $('#faculty_loader').removeClass('sk-loading');
            return false;
        } else if ((contact_num.length > 12) || (contact_num.length < 9)) {
            swal('', 'Contac Number should be 9 to 12 digits.', 'info');
            $('#faculty_loader').removeClass('sk-loading');
            return false;
        }

        function IsEmail(email) {
            var regex = /^([a-zA-Z0-9_\.\-\+])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
            if (!regex.test(email)) {
                return false;
            } else {
                return true;
            }
        }

        function IsFone(contact_num) {
            var chkfone = /^\+?([0-9]{2})\)?[-. ]?([0-9]{4})[-. ]?([0-9]{4})$/;
            if (!chkfone.test(contact_num)) {
                return false;
            } else {
                return true;
            }
        }



        $.ajax({
            type: "POST",
            cache: false,
            async: false,
            url: ops_url,
            data: $('#servicecenter_save').serialize(),
            success: function(result) {
                var data = $.parseJSON(result);
                if (data.status == 1) {
                    load_servicecenter_on_show();
                    swal('Success', 'Service Center updated successfully.', 'success');
                    $('#faculty_loader').removeClass('sk-loading');
                    $("#curd-content").slideUp("slow", function() {
                        $("#curd-content").hide();
                        $('#add_type').show();
                    });
                } else if (data.status == 2) {
                    $('#curd-content').html('');
                    $('#curd-content').html(data.view);
                    swal('', data.message, 'info');
                    $('#faculty_loader').removeClass('sk-loading');
                } else if (data.status == 3) {
                    $('#curd-content').html('');
                    $('#curd-content').html(data.view);
                    swal('', data.message, 'info');
                    $('#faculty_loader').removeClass('sk-loading');
                } else {
                    swal('', 'Connection Error. Please contact administrator', 'info');
                    $('#faculty_loader').removeClass('sk-loading');
                }

            }
        });
    }
</script>