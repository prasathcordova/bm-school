<div id="role_sve_form" class="tab-pane active">

    <div class="row row m-b-lg">
        <div class="col-lg-12 col-md-12 col-xs-12 col-sm-12" style="padding-bottom:20px;">
            <div id="head_data" style="border-bottom: 1px solid !important;
                 padding-bottom: 5px;
                 border-bottom-color: #23C6C8!important;">
                <h2> Add New Role</h2>
            </div>
        </div>
        <div class="clearfix"></div>
        <div class="col-lg-12 col-md-12 col-xs-12 col-sm-12">
            <div class="form-group">
                <label class="control-label" for="name">Role Name :</label>
                <input type="text" id="name" name="name" class="form-control" style="background-color: white" placeholder="Enter Role Name" maxlength="25">
            </div>
        </div>
        <div class="clearfix"></div>
        <div class="col-lg-12 col-md-12 col-xs-12 col-sm-12">
            <div class="form-group">
                <label class="control-label" for="description">Role Description :</label>
                <input type="text" id="description" name="description" class="form-control" style="background-color: white" placeholder="Enter Role Description" maxlength="25"> 
            </div>
        </div>
        <div class="clearfix"></div>
        <div class="col-lg-12 col-md-12 col-xs-12 col-sm-12">
            <div class="form-group">
                <label class="control-label" for="description">Activate Role :</label>



                <div class=" input-group" style="float:right;">


                    <input type="checkbox" value="" name="role_chk" id="role_chk" class="i-checks" />
                </div>


            </div>
        </div>

        <div class="col-lg-12 col-md-12 col-xs-12 col-sm-12">
            <button type="button" class="btn btn-primary btn-sm btn-block" onclick="submit_data();"><i class="fa fa-save"></i> Save Role
            </button>

        </div>



    </div>
</div>
<script>
    $('.i-checks').iCheck({
        checkboxClass: 'icheckbox_square-green',
        radioClass: 'iradio_square-green'
    });


    function submit_data() {


        var role_name = $('#name').val().toUpperCase();
        
        if (role_name == '') {
            swal('', 'Enter Role Name', 'info');
            return false;
        }
        if (role_name.length < 3) {
            swal('', 'Please enter atleast 3 characters', 'info');
            return false;
        }


        var description = $('#description').val();
        if (description == '') {
            swal('', 'Enter Role Description', 'info');
            return false;
        }
        if (description.length < 3) {
            swal('', 'Please enter atleast 3 characters', 'info');
            return false;
        }

        var role_status = $('#role_chk').prop('checked');
        if (role_status == true) {
            var isinrole = 1;
        } else {
            var isinrole = 0;
        }

        var ops_url = baseurl + 'role/add-role/';
        $.ajax({
            type: "POST",
            cache: false,
            async: false,
            url: ops_url,
            data: {
                "role_name": role_name,
                "description": description,
                'isinrole': isinrole
            },
            success: function(result) {
                var data = $.parseJSON(result);

                if (data.status == 1) {
                    swal('Success', 'Roles Saved Successfully', 'success');
                    $('#data_loader').removeClass('sk-loading');
                    $("#curd-content").slideUp("slow", function() {
                        $("#curd-content").hide();
                    });

                    role_data_load_added(data.id);
                    role_data_reloader();

                } else if (data.status == 2) {
                    swal('', data.message, 'info');
                    $('#data_loader').removeClass('sk-loading');
                } else {
                    swal('', 'Connection Error. Please contact administrator', 'info');
                    $('#data_loader').removeClass('sk-loading');

                }
            }
        });

    }

    function role_data_reloader() {
        var ops_url = baseurl + 'user/show-detail-role';
        $.ajax({
            type: "POST",
            cache: false,
            async: false,
            url: ops_url,
            data: {
                "load": 1
            },
            success: function(result) {
                var data = JSON.parse(result)
                if (data.status == 1) {
                    $('#tab-2').html(data.view);
                    $('.full-height-scrollbar').slimscroll({
                        height: '90%'
                    });
                } else {
                    alert('No data loaded');
                }
            }
        });

    }

    function role_data_load_added(roleid) {
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
                    $('.full-height-scrollbar').slimscroll({
                        height: '90%'
                    });
                } else {
                    alert('No data loaded');
                }
            }
        });

    }
</script>