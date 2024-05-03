
<div class="wrapper wrapper-content animated fadeInRight" style="padding-top: 1px !important;padding-left: 0px !important;padding-right: 0px !important;">
    <div class="row" style="margin-left: -29px !important; margin-right: -30px !important;">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5><?php echo isset($sub_title) ? $sub_title : "NO TITLE PROVIDED" ?></h5>
                    <div class="ibox-tools" id="add_type">
                        <a data-toggle="modal" class="btn btn-primary btn-xs" data-toggle="tooltip" title="Add a Batch" data-placement="left"href="javascript:void(0);" onclick="add_new_country();"><i class="fa fa-plus"></i>ADD SUPPLIER</a>
                    </div>
                </div>
                <div class="ibox-content" id="faculty_loader">
                    <div class="sk-spinner sk-spinner-wave">
                            <div class="sk-rect1"></div>
                            <div class="sk-rect2"></div>
                            <div class="sk-rect3"></div>
                            <div class="sk-rect4"></div>
                            <div class="sk-rect5"></div>
                    </div>


                    <div class="row">
                        <div class="col-lg-12">
                            <div id="curd-content" style="display: none;"></div>
                        </div>
                        <div class="col-lg-12">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover dataTables-example" id="tbl_supplier" >

                                    <thead>
                                        <tr>
                                                <th>Code</th>
                                                <th>Name</th>
                                                <th>Contact No</th>                                
                                                <th>Email</th>                                
                                                <th>Address</th>                           
                                                <th>Status</th>                           
                                                <th>Action</th>                           
                                        </tr>
                                    </thead>
                                    <tbody>
                                       
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<script type="text/javascript">
  
  
    $(document).ready(function () {
        activateSwitchery();

    });
    
    function activateSwitchery() {
        for (var i = 0; i < list_switchery.length; i++) {
            list_switchery[i].destroy();
            list_switchery[i].switcher.remove();
        }
        var list_checkbox = Array.prototype.slice.call(document.querySelectorAll('.js-switch'));
        list_checkbox.forEach(function (html) {
           var switchery = new Switchery(html, {color: '#23C6C8',secondaryColor: '#F8AC59', size: 'small'});
//        var switchery = new Switchery(html, {color: '#a9318a', size: 'small'});
            list_switchery.push(switchery);
        });
    }

    function toggle_country_add() {
        if ($('#add_type').html() > 100) {
            $('#add_type').html('<a href="javascript:void(0);" onclick="toggle_country_add();"><i class="fa fa-close" style="color:1ab394; font-size:30px;></i></a>');
            add_country();
        } else {
            $('#add_type').html('<button type="button" class="btn bg-teal waves-effect" onclick="toggle_country_add();">NEW COUNTRY</button>');
            var animation = "fadeOutDown";
            $('#curd-content').addClass('animated');
            $('#curd-content').addClass(animation);
            $('#curd-content').html('');
            $('#curd-content').hide();
        }
    }

   function change_status(country_id, element) {
        $('#faculty_loader').addClass('sk-loading');
   
        var status_type = $(element).prop("checked");
        if (status_type == true)
            status = 1;
        else
            status = -1;
        var ops_url = baseurl + 'country/change_status/';
        $.ajax({
            type: "POST",
            cache: false,
            async: false,
            url: ops_url,
            data: {"load": 1, "country_id": country_id, "status": status},
            success: function (result) {
                var data = $.parseJSON(result);
                if (data.status == 1) {
                    if (status == -1) {
                        swal('Country Updated', 'Country Status Deactivated Successfully', 'success');
                        $('#faculty_loader').removeClass('sk-loading');
                        return true;
                    } else {
                        if (status == 1) {
                            swal('Country Updated', 'Country Status Activated Successfully', 'success');
                            $('#faculty_loader').removeClass('sk-loading');
                            return true;
                        }
                    }
                }

                else {
                    if (data.status == 0) {
                        swal({
                            title: '',
                            text: data.message,
                            type: 'info',
                            showCancelButton: false,
                            confirmButtonColor: '#3085d6',
                            cancelButtonColor: '#d33',
                            confirmButtonText: 'OK'
                        }, function (isConfirm) {
                            window.location.href = baseurl + "country/show-country";
                        });
                    } else {
                        if (data.status == 3) {
                            swal({
                                title: '',
                                text: data.message,
                                type: 'info',
                                showCancelButton: false,
                                confirmButtonColor: '#3085d6',
                                cancelButtonColor: '#d33',
                                confirmButtonText: 'OK'
                            }, function (isConfirm) {
                                window.location.href = baseurl + "country/show-country";
                            });
                        } else {
                            swal({
                                title: '',
                                text: 'Country Status Updation Failed',
                                type: 'info',
                                showCancelButton: false,
                                confirmButtonColor: '#3085d6',
                                cancelButtonColor: '#d33',
                                confirmButtonText: 'OK'
                            }, function (isConfirm) {
                                window.location.href = baseurl + "country/show-country";
                            });
                        }

                    }
                }
            }
        });
    }
   
    $('.js-switch').change(function (e) {

    });


    $(".js-switch").click(function () {
    });

    function submit_data() { 
        $('#faculty_loader').addClass('sk-loading');
        
        var ops_url = baseurl + 'country/add-country/';
        var country_name = $('#country_name').val().toUpperCase();
        var country_abbr = $('#country_abbr').val();
        var currency_name = $("#currency_select").val();
        
      
        if (country_name == '') {
            swal('', 'Country Name is required.', 'info');
            $('#faculty_loader').removeClass('sk-loading');
            return false;
        }
        else if ((country_name.length > '30') || (country_name.length < '3'))  {
            swal('', 'Country Name should contain letters 3 to 30', 'info');
            $('#faculty_loader').removeClass('sk-loading');
            return false;
        }
        var alphanumers = /^[a-zA-Z\s]+$/;
            if(!alphanumers.test($("#country_name").val())){    
                swal('', 'Country Name can have only alphabets', 'info');
                $('#faculty_loader').removeClass('sk-loading');
                return false;
            }
           
        if (country_abbr == '') {
            swal('', 'Country Abbreviation is required.', 'info');
            $('#faculty_loader').removeClass('sk-loading');
            return false;
        }
        else if ((country_abbr.length > '15') || (country_abbr.length < '3'))  {
            swal('', 'Country Abbreviation should contain letters 3 to 15', 'info');
            $('#faculty_loader').removeClass('sk-loading');
            return false;
        }
        var alphanumers = /^[a-zA-Z]+$/;
            if(!alphanumers.test($("#country_abbr").val())){    
                swal('', 'Country Abbreviation can have only alphabets', 'info');
                $('#faculty_loader').removeClass('sk-loading');
                return false;
            }
            
         if(currency_name == -1){
           swal('', 'Currency is required.', 'info');
           $('#faculty_loader').removeClass('sk-loading');
           return;
        } 
       
          
        $.ajax({
            type: "POST",
            cache: false,
            async: false,
            url: ops_url,
            data: $('#country_save').serialize(),
            success: function (result) {
                var data = $.parseJSON(result);
                if (data.status == 1) {
                    $('#country_save').html('');
                    $('#country_save').html(data.view);
                    var country_data = [];
                    $.ajax({
                        type: "POST",
                        cache: false,
                        async: false,
                        url: baseurl + 'country/show-country/',
                        data: {'load_reset': '1'},
                        success: function (result) {
                            country_data = JSON.parse(result);
                            
                        },
                        error: function () {
                            alert('error');
                        }
                    });
                    var datatable = $('#tbl_country').dataTable().api();
                    datatable.clear();
                    datatable.rows.add(country_data).draw();

                    $('#add_type').show();
                    swal('Success', 'New Country, ' + country_name + ' created successfully.', 'success');
                    $('#faculty_loader').removeClass('sk-loading');
                    $("#curd-content").slideUp("slow", function () {
                        $("#curd-content").hide();
                    });
                } else if (data.status == 2) {
                    $('#curd-content').html('');
                    $('#curd-content').html(data.view);
                    swal('',data.message,'info');
                    $('#faculty_loader').removeClass('sk-loading');
                } else if (data.status == 3) {
                    $('#curd-content').html('');
                    $('#curd-content').html(data.view);
                     swal('', data.message, 'info');
                     $('#faculty_loader').removeClass('sk-loading');
//                    activate_toast(data.message, 'Error', 'error');
                } else {
                    swal('', 'Connection Error. Please contact administrator', 'info');
                    $('#faculty_loader').removeClass('sk-loading');
//                    activate_toast("Connection Error", 'Error', 'error');
                }

            }
        });
    }

   function submit_edit_save_data() {
        $('#faculty_loader').addClass('sk-loading');
        
        var ops_url = baseurl + 'country/edit-country';
        var country_name = $('#country_name').val().toUpperCase();
        var country_abbr = $('#country_abbr').val();
        var currency_name = $("#currency_select").val();
         if(currency_name == -1){
           swal('', 'Currency is required.', 'info');
            $('#faculty_loader').removeClass('sk-loading');
            return;
        }
         if (country_name == '') {
            swal('', 'Country Name is required.', 'info');
            $('#faculty_loader').removeClass('sk-loading');
            return false;
        }
        else if ((country_name.length > '30') || (country_name.length < '3'))  {
            swal('', 'Country Name should contain letters 3 to 30', 'info');
            $('#faculty_loader').removeClass('sk-loading');
            return false;
        }
        var alphanumers = /^[a-zA-Z\s]+$/;
            if(!alphanumers.test($("#country_name").val())){    
                swal('', 'Country Name can have only alphabets', 'info');
                $('#faculty_loader').removeClass('sk-loading');
                return false;
            }
        if (country_abbr == '') {
            swal('', 'Country Abbreviation is required.', 'info');
            $('#faculty_loader').removeClass('sk-loading');
            return false;
        }
         else if ((country_abbr.length > '15') || (country_abbr.length < '3'))  {
            swal('', 'Country Abbreviation should contain letters 3 to 15', 'info');
            $('#faculty_loader').removeClass('sk-loading');
            return false;
        }
        var alphanumers = /^[a-zA-Z]+$/;
            if(!alphanumers.test($("#country_abbr").val())){    
                swal('', 'Country Abbreviation can have only alphabets', 'info');
                $('#faculty_loader').removeClass('sk-loading');
                return false;
            }
         

        $.ajax({
            type: "POST",
            cache: false,
            async: false,
            url: ops_url,
            data: $('#country_save').serialize(),
            success: function (result) {
                var data = $.parseJSON(result)
                
                if (data.status == 1) {
                    $('#country_save').html('');
                    $('#country_save').html(data.view);
                    var country_data = [];
                    $.ajax({
                        type: "POST",
                        cache: false,
                        async: false,
                        url: baseurl + 'country/show-country',
                        data: {'load_reset': '1'},
                        success: function (result) {
                            country_data = JSON.parse(result);
                        },
                        error: function () {
                            alert('error');
                        }
                    });
                    var datatable = $('#tbl_country').dataTable().api();
                    datatable.clear();
                    datatable.rows.add(country_data).draw();
                    $('#add_type').show();
                    swal('Success', 'Country ' + country_name + ' updated successfully.', 'success');
                    $('#faculty_loader').removeClass('sk-loading');
                    $("#curd-content").slideUp("slow", function () {
                        $("#curd-content").hide();
                    });
                    $('#currency_select').select2({
                        'theme':'bootstrap'
                    });
                } else if (data.status == 2) {
                    $('#curd-content').html('');
                    $('#curd-content').html(data.view);
                    swal('',data.message,'info');
                    $('#currency_select').select2({
                        'theme':'bootstrap'
                    });
                    $('#faculty_loader').removeClass('sk-loading');
                } else if (data.status == 3) {
                    $('#curd-content').html('');
                    $('#curd-content').html(data.view);
                    swal('', data.message, 'info');
                    $('#currency_select').select2({
                        'theme':'bootstrap'
                    });
                    $('#faculty_loader').removeClass('sk-loading');
//                    activate_toast(data.message, 'Error', 'error');
                } else {
                    swal('', 'Connection Error. Please contact administrator', 'info');
                    $('#faculty_loader').removeClass('sk-loading');
//                    activate_toast("Connection Error", 'Error', 'error');
                }

            }
        });
    }

    function refresh_add_panel() {
        $('#country_name').val('');
        $('#country_name').parent().removeAttr('class', 'has-error');
        $('#country_abbr').val('');
        $('#country_abbr').parent().removeAttr('class', 'has-error');
        $('#currency_select').select2('val',-1);
    }

    function edit_country(countryid, name, code, currency) {
        var ops_url = baseurl + 'country/edit-country/';
        $.ajax({
            type: "POST",
            cache: false,
            async: false,
            url: ops_url,
            data: {"load": 1, "country_id": countryid, "country_name": name, "country_abbr":code, "currency_select":currency},
            success: function (result) {
                var data = JSON.parse(result);
                console.log(data);
                if (data.status == 1) {
                    $('#curd-content').html('');
                    $('#curd-content').html(data.view);
                    var animation = "fadeInDown";
                    $("#curd-content").show();
                    $('#curd-content').addClass('animated');
                    $('#curd-content').addClass(animation);
                    $('#add_type').hide();
                    $('#currency_select').select2({
                        'theme':'bootstrap'
                    });
                    $('#currency_select').select2({
                        'theme':'bootstrap'
                    });
                } else {
                    alert('No data loaded');
                }
            }
        });
    }

    function close_add_country() {
        $('#add_type').show();
        $("#curd-content").slideUp("slow", function () {
            $("#curd-content").hide();
        });

    }
   
//NEW SCRIPT
function add_new_country() {
        var ops_url = baseurl + 'country/add-country';
        $.ajax({
            type: "POST",
            cache: false,
            async: false,
            url: ops_url,
            data: {"load": 1},
            success: function (data) {
                if (data) {
                    $('#curd-content').html(data);


                    var animation = "fadeInDown";
                    $("#curd-content").show();
                    $('#curd-content').addClass('animated');
                    $('#curd-content').addClass(animation);
                    $('#add_type').hide();
                    $('#currency_select').select2({
                        'theme':'bootstrap'
                    });
                } else {
                    alert('No data loaded');
                }
            }
        });
    }


    
</script>