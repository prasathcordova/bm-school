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
                <input type="text" id="name" name="name" class="form-control" style="background-color: white">
            </div>
        </div>
        <div class="clearfix"></div>
        <div class="col-lg-12 col-md-12 col-xs-12 col-sm-12">
            <div class="form-group">
                <label class="control-label" for="description">Role Description :</label>
                <input type="text" id="description" name="description" class="form-control" style="background-color: white">
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
            <!--             <span><a href="javascript:void(0);"  onclick="submit_data();" > 
         <i style="font-size: 30px !important; float: right; color: #23C6C5; padding-right: 10px;" class="material-icons" data-toggle="tooltip" title="Save">save</i></a> </span>        -->

        </div>



    </div>
</div>
<script>
    $('.i-checks').iCheck({
        checkboxClass: 'icheckbox_square-green',
        radioClass: 'iradio_square-green'
    });

    //  function submit_data() {
    //     
    //
    //        var ops_url = baseurl + 'role/add-role/';
    //        var role_name = $('#name').val().toUpperCase();
    //        var description = $('#description').val();
    //        
    //      
    //        $.ajax({
    //            type: "POST",
    //            cache: false,
    //            async: false,
    //            url: ops_url,
    //            data: $('#country_save').serialize(),
    //            success: function (result) {
    //                var data = $.parseJSON(result);
    //                if (data.status == 1) {
    //                    gs_count();
    //                    $('#country_save').html('');
    //                    $('#country_save').html(data.view);
    //                    var country_data = [];
    //                    $.ajax({
    //                        type: "POST",
    //                        cache: false,
    //                        async: false,
    //                        url: baseurl + 'country/show-country/',
    //                        data: {'load_reset': '1'},
    //                        success: function (result) {
    //                            country_data = JSON.parse(result);
    //
    //                        },
    //                        error: function () {
    //                            alert('error');
    //                        }
    //                    });
    //                    var datatable = $('#tbl_country').dataTable().api();
    //                    datatable.clear();
    //                    datatable.rows.add(country_data).draw();
    //
    //                    $('#add_type').show();
    //                    swal('Success', 'New Country, ' + country_name + ' created successfully.', 'success');
    //                    $('#faculty_loader').removeClass('sk-loading');
    //                    $("#curd-content").slideUp("slow", function () {
    //                        $("#curd-content").hide();
    //                    });
    //                } else if (data.status == 2) {
    //                    $('#curd-content').html('');
    //                    $('#curd-content').html(data.view);
    //                    swal('', data.message, 'info');
    //                    $('#faculty_loader').removeClass('sk-loading');
    //                } else if (data.status == 3) {
    //                    $('#curd-content').html('');
    //                    $('#curd-content').html(data.view);
    //                    swal('', data.message, 'info');
    //                    $('#faculty_loader').removeClass('sk-loading');
    ////                    activate_toast(data.message, 'Error', 'error');
    //                } else {
    //                    swal('', 'Connection Error. Please contact administrator', 'info');
    //                    $('#faculty_loader').removeClass('sk-loading');
    ////                    activate_toast("Connection Error", 'Error', 'error');
    //                }
    //
    //            }
    //        });
    //    }
    //    

    function submit_data() {


        var role_name = $('#name').val().toUpperCase();
        var description = $('#description').val();
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
                    swal('Success', 'Roles Saved Successfully.', 'success');

                    $('#data_loader').removeClass('sk-loading');
                    $("#curd-content").slideUp("slow", function() {
                        $("#curd-content").hide();
                    });
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
</script>