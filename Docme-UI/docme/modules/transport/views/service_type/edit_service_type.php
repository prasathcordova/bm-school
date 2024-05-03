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
        echo form_open('', array('id' => 'service_type_edit_save', 'role' => 'form'));
        ?>
        <div class="col-md-6">
            <b>Service Type Name </b>
            <!-- Added by SALAHUDHEEN May 29-->
            <span class="mandatory"> *</span>
            <div class="form-group">
                <div class="form-line <?php
                                        if (form_error('service_type')) {
                                            echo 'has-error';
                                        }
                                        ?> ">
                    <input type="hidden" value="<?php echo $title; ?>" id="title_data" name="title_data" />
                    <input type="hidden" value="<?php echo set_value('service_type_id', isset($edit_data[0]['id']) ? $edit_data[0]['id'] : ''); ?>" id="service_type_id" name="service_type_id" />
                    <input type="text" class="form-control " maxlength="20" name="service_type" id="service_type" value="<?php echo set_value('service_type', isset($edit_data[0]['serviceType']) ? $edit_data[0]['serviceType'] : ''); ?>" />
                </div>
            </div>
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
        var ops_url = baseurl + 'transport/updatesave-servicetype/';
        var servicetype = $('#service_type').val();
        if (servicetype == '') {
            swal('', 'Service Type Name is required.', 'info');
            $('#faculty_loader').removeClass('sk-loading');
            return false;
        } else if ((servicetype.length > '30') || (servicetype.length < '3')) {
            swal('', 'Name should contain letters 3 to 30', 'info');
            $('#faculty_loade r').removeClass('sk-loading');
            return false;
        }
        var alphanumers = /^[a-zA-Z\s]+$/;
        if (!alphanumers.test($("#service_type").val())) {
            swal('', 'Service Type Name can have only alphabets.', 'info');
            $('#faculty_loader').removeClass('sk-loading');
            return false;
        }


        $.ajax({
            type: "POST",
            cache: false,
            async: false,
            url: ops_url,
            data: $('#service_type_edit_save').serialize(),
            success: function(result) {
                var data = $.parseJSON(result);
                if (data.status == 1) {
                    load_servicetype_on_show();
                    swal('Success', 'Service Type updated successfully.', 'success');
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