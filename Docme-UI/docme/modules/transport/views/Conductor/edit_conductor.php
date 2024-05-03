<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
    <div class="card">
        <div class="header">
            <h2 style="padding-bottom: 10px;font-size: 16px;color: #1c84c6;"><?php echo isset($title) ? $title : "NO TITLE PROVIDED" ?>
                <span><a href="javascript:void(0);" onclick="close_panel();"> <i style="font-size: 30px !important; float: right; color: #E91E63;" class="material-icons" data-toggle="tooltip" title="Close">close</i></a> </span>
                <span><a href="javascript:void(0);" onclick="save_edit_conductor_details();"> <i style="font-size: 30px !important; float: right; color: #23C6C5; padding-right: 10px;" class="material-icons" data-toggle="tooltip" title="Save">save</i></a> </span>
                <span><a href="javascript:void(0);" onclick="clear_controls();"> <i style="font-size: 30px !important; float: right; color: #2196F3; padding-right: 10px;" class="material-icons " data-toggle="tooltip" title="Refresh">refresh</i></a> </span>
            </h2>
        </div>
        <div class="body">
            <?php
            echo form_open('', array('id' => 'conductor_save', 'role' => 'form'));
            $breaker = 0;
            ?>
            <div class="col-lg-12">
                <div id="curd-content" style="display: none;"></div>
                <div class="ibox-content">
                    <form method="post" id="myform">
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <input type="hidden" class="form-control" name="pid" id="pid" autocomplete="off" value="<?php echo set_value('pid', isset($edit_data['id']) ? $edit_data['id'] : ''); ?>">
                                    <label>Conductor Name *</label>
                                    <select class="form-control selectpicker" disabled data-live-search="true">
                                        <option value="-1">Select Employee</option>
                                        <option selected value="<?php echo $edit_data['Emp_id'] ?>"><?php echo  $edit_data['First_name'] . ' ' . $edit_data['Middle_name'] . ' ' . $edit_data['Last_name'] ?></option>
                                    </select>
                                    <input type="hidden" name="conductor_name" id="conductor_name" autocomplete="off" value="<?php echo $edit_data['Emp_id'] ?>">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label class="form-label">Mobile No *</label>
                                    <input type="text" class="form-control" name="mobile_no" id="mobile_no" maxlength="10" placeholder="Mobile No" autocomplete="off" value="<?php echo set_value('mobile_no', isset($edit_data['mobile_no']) ? $edit_data['mobile_no'] : ''); ?>" readonly>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label class="form-label">Password *</label>
                                    <input type="text" maxlength="4" class="form-control" placeholder="Password" name="password" id="password" autocomplete="password" value="<?php echo set_value('p_num', isset($edit_data['password']) ? $edit_data['password'] : ''); ?>">
                                </div>
                            </div>

                        </div>
                    </form>
                </div>
                <?php
                if ($breaker == 3) {
                    echo '<div class="clearfix"></div>';
                    $breaker = 0;
                } else {
                    $breaker++;
                }
                //                                    }
                //                                }
                ?>
            </div>
            <!--</div>-->
        </div>
        <!--</div>-->
    </div>
</div>



<script type="text/javascript">
    $(document).ready(function() {
        $('.form-control').focus(function() {
            $(this).parent().addClass('focused');
        });

        // On focusout event
        $('.form-control').change(function() {
            var $this = $(this);
            if ($this.parents('.form-group').hasClass('form-float')) {
                if ($this.val() == '') {
                    $this.parents('.form-line').removeClass('focused');
                }
            } else {
                $this.parents('.form-line').removeClass('focused');
            }
        });
    });

    function load_spareform() {
        var ops_url = baseurl + 'transport/show-conductor/';
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

    function save_edit_conductor_details() {
        $('#faculty_loader').addClass('sk-loading');
        var ops_url = baseurl + 'transport/update-conductor/';
        var conductor_name = $('#conductor_name').val();
        var mobile_no = $('#mobile_no').val();
        var password = $('#password').val();


        var alphanumers = /^[a-zA-Z\s]+$/;

        if (conductor_name == '-1') {
            swal('', 'Conductor Name is required.', 'info');
            $('#faculty_loader').removeClass('sk-loading');
            return false;
        } else if (mobile_no == '') {
            swal('', 'Mobile No is required.', 'info');
            $('#faculty_loader').removeClass('sk-loading');
            return false;
        } else if (password == '') {
            swal('', 'Password is required.', 'info');
            $('#faculty_loader').removeClass('sk-loading');
            return false;
        } else if (password.length < 4) {
            swal('', 'Password should contain 4 digits.', 'info');
            $('#faculty_loader').removeClass('sk-loading');
            return false;
        }
        // if (!alphanumers.test($("#conductor_name").val())) {
        //     swal('', 'Conductor Name can have only alphabets.', 'info');
        //     $('#faculty_loader').removeClass('sk-loading');
        //     return false;
        // }
        // if ((conductor_name.length > '50') || (conductor_name.length < '3')) {
        //     swal('', 'Conductor Name should contain letters 3 to 50', 'info');
        //     $('#faculty_loader').removeClass('sk-loading');
        //     return false;
        // }


        $.ajax({
            type: "POST",
            cache: false,
            async: false,
            url: ops_url,
            data: $('#conductor_save').serialize(),
            success: function(result) {
                var data = $.parseJSON(result);
                if (data.status == 1) {
                    load_spareform();
                    swal('Success', 'Conductor updated successfully.', 'success');
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

    function close_panel() {
        if ($('#curd-content').is(":visible") == true) {
            $("#curd-content").slideUp("slow", function() {
                $("#curd-content").hide();
                $('#add_type').show();
                $('#search-feecode').show()
            });
        }
    }

    $('.selectpicker').select2({
        "theme": "bootstrap",
        "width": "100%"
    });

    function clear_controls() {
        $('#pname').val('').focus();
        $('#desc').val('');
        $('#p_num').val('');
    }
</script>