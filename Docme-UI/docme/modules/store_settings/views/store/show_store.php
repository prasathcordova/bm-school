
<div class="wrapper wrapper-content animated fadeInRight" style="padding-top: 1px !important;padding-left: 0px !important;padding-right: 0px !important;">
    <div class="row" style="margin-left: -29px !important; margin-right: -30px !important;">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title" style="border-bottom: solid 2px #eee;">
                    <h5><?php echo isset($sub_title) ? $sub_title : "NO TITLE PROVIDED" ?></h5>
                    <div class="ibox-tools" id="add_type">
                        <!--<a data-toggle="modal" class="btn btn-primary btn-xs" data-toggle="tooltip" title="Add new purchase order" data-placement="left"href="javascript:void(0);" onclick="add_store();"><i class="fa fa-plus"></i> NEW STORE</a>-->
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
                            <!--<div class="table-responsive">-->
                            <table class="table table-striped table-bordered table-hover dataTables-example" id="table_store">
                                <thead>
                                    <tr>
                                        <th>Store Name</th>
                                        <th>Store Code</th>
                                        <th >Phone No</th>
                                        <th >Email</th>
                                        <th>Level</th>                                                                  
                                        <th >Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    if (isset($store_data) && !empty($store_data)) {
                                        foreach ($store_data as $store) {
                                            ?>
                                            <tr>
                                                <td><?php echo $store['store_name'] ?></td>
                                                <td><?php echo $store['store_code'] ?></td>
                                                <td><?php echo $store['phone'] ?></td>
                                                <td><?php echo $store['email'] ?></td>
                                                <td><?php if ($store['ismain'] == 1) { ?>
                                                        <span class="label label-warning"> MAIN STORE</span>
                                                    <?php } else {
                                                        ?> 
                                                        <span class="label label-warning"> SUB STORE</span>
                                                    <?php } ?>
                                                </td>
                                               

                                                <td>
                                                    <a href="javascript:void(0);" onclick="edit_store('<?php echo $store['store_id']; ?>', '<?php echo $store['store_name']; ?>', '<?php echo $store['store_code']; ?>', '<?php echo $store['address1']; ?>','<?php echo $store['address2']; ?>','<?php echo $store['address3']; ?>','<?php echo $store['phone']; ?>','<?php echo $store['email']; ?>','<?php echo $store['ismain']; ?>');"  data-toggle="tooltip" data-placement="right" title="View  <?php echo $store['store_name'];?> " data-original-title="<?php echo $store['store_name'];?>"  ><i class="fa fa-eye" style="font-size: 20px; color: #23C6C8; margin: 2%; "></i></a> 
                                                </td>
                                            </tr>
                                            <?php
                                        }
                                    }
                                    ?>
                                </tbody>                    
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    var list_switchery = [];

    $('#table_store').dataTable({

        columnDefs: [
            {"width": "20%", className: "capitalize", "targets": 0},
            {"width": "10%", className: "capitalize", "targets": 1},
            {"width": "10%", className: "capitalize", "targets": 2},
            {"width": "10%", className: "capitalize", "targets": 3},
            {"width": "10%", className: "capitalize", "targets": 4},            
            {"width": "10%", className: "capitalize", "targets": 5, "orderable": false}
        ],
        responsive: true,
        iDisplayLength: 10,
        dom: '<"html5buttons"B>lTfgitp',
        buttons: [
            {extend: 'copy'},
            {extend: 'csv'},
            {extend: 'excel', title: 'Report'}
        ],      
    });
    
//
//
//    function add_store() {
//        var ops_url = baseurl + 'store/add-store';
//        $.ajax({
//            type: "POST",
//            cache: false,
//            async: false,
//            url: ops_url,
//            data: {"load": 1},
//            success: function (data) {
//                if (data) {
//                    $('#curd-content').html(data);
//
//
//                    var animation = "fadeInDown";
//                    $("#curd-content").show();
//                    $('#curd-content').addClass('animated');
//                    $('#curd-content').addClass(animation);
//                    $('#add_type').hide();
//
//                } else {
//                    alert('No data loaded');
//                }
//            }
//        });
//    }


    function close_add_store() {
        $('#add_type').show();
        $("#curd-content").slideUp("slow", function () {
            $("#curd-content").hide();
        });

    }
    
    function refresh_add_panel() {
        $('#name').val('');
        $('#name').parent().removeAttr('class', 'has-error');
        $('#code').val('');
        $('#code').parent().removeAttr('class', 'has-error');
        $('#address1').val('');
        $('#address1').parent().removeAttr('class', 'has-error');
        $('#address2').val('');
        $('#address2').parent().removeAttr('class', 'has-error');
        $('#address3').val('');
        $('#address3').parent().removeAttr('class', 'has-error');
        $('#contact').val('');
        $('#contact').parent().removeAttr('class', 'has-error');
        $('#email').val('');
        $('#email').parent().removeAttr('class', 'has-error');
    }
    
//    
//    
//    
//     function submit_data() {
//
//
//        var ops_url = baseurl + 'store/add-store';
//        var name = $('#name').val().toUpperCase();
//        var code = $('#code').val();
//        var address1 = $('#address1').val();
//        var address2 = $('#address2').val();
//        var address3 = $('#address3').val();
//        var contact = $('#contact').val();
//        var email = $('#email').val();
//
//
//        if (name == '') {
//            swal('', 'Name is required.', 'info');
//            $('#data_loader').removeClass('sk-loading');
//            return false;
//        } else if ((name.length > '30') || (name.length < '3')) {
//            swal('', 'Name should contain letters 3 to 30', 'info');
//            $('#data_loader').removeClass('sk-loading');
//            return false;
//        }
//        var alphanumers = /^[a-zA-Z\s]+$/;
//        if (!alphanumers.test($("#name").val())) {
//            swal('', 'Name can have only alphabets', 'info');
//            $('#data_loader').removeClass('sk-loading');
//            return false;
//        }
//
//        if (code == '') {
//            swal('', 'Code is required.', 'info');
//            $('#data_loader').removeClass('sk-loading');
//            return false;
//        } else if ((code.length > '15') || (code.length < '3')) {
//            swal('', 'Code should contain letters 3 to 15', 'info');
//            $('#data_loader').removeClass('sk-loading');
//            return false;
//        }
//        var alphanumers = /^[a-zA-Z]+$/;
//        if (!alphanumers.test($("#code").val())) {
//            swal('', 'Code can have only alphabets', 'info');
//            $('#data_loader').removeClass('sk-loading');
//            return false;
//        }
//        
//        if (address1 == '') {
//            swal('', 'Address1 is required.', 'info');
//            $('#data_loader').removeClass('sk-loading');
//            return false;
//        } 
//        if (address2 == '') {
//            swal('', 'Address2 is required.', 'info');
//            $('#data_loader').removeClass('sk-loading');
//            return false;
//        } 
//        if (address3 == '') {
//            swal('', 'Address3 is required.', 'info');
//            $('#data_loader').removeClass('sk-loading');
//            return false;
//        } 
//        if (contact == '') {
//            swal('', 'Contact is required.', 'info');
//            $('#data_loader').removeClass('sk-loading');
//            return false;
//        } 
//          var alphanumers = /^[0-9]+$/;
//        if (!alphanumers.test($("#contact").val())) {
//            swal('', 'Contact can have only numbers', 'info');
//            $('#data_loader').removeClass('sk-loading');
//            return false;
//        }
//        
//         if (email == '') {
//            swal('', 'E-mail is required.', 'info');
//            $('#data_loader').removeClass('sk-loading');
//            return false;
//        } 
//          var alphanumers = /^([\w-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([\w-]+\.)+))([a-zA-Z]{2,4}|[0-9]{1,3})(\]?)$/;
//        if (!alphanumers.test($("#email").val())) {
//            swal('', 'Invalid Email Id', 'info');
//            $('#data_loader').removeClass('sk-loading');
//            return false;
//        }
//      
//
//        $.ajax({
//            type: "POST",
//            cache: false,
//            async: false,
//            url: ops_url,
//            data: $('#store_save').serialize(),
//            success: function (result) {
//                var data = $.parseJSON(result);
//                if (data.status == 1) {
//                    active_count();
//                    $('#store_save').html('');
//                    $('#store_save').html(data.view);
//                    var store_data = [];
//                    $.ajax({
//                        type: "POST",
//                        cache: false,
//                        async: false,
//                        url: baseurl + 'store/show-store',
//                        data: {'load_reset': '1'},
//                        success: function (result) {
//                            store_data = JSON.parse(result);
//                        },
//                        error: function () {
//                            alert('error');
//                        }
//                    });
//                     var datatable = $('#table_store').dataTable().api();
//                    datatable.clear();
//                    datatable.rows.add(store_data).draw();
//                    
//                    
////                    location.reload();
//                    $('#add_type').show();
//                    
//                    swal('Success', 'New Store, ' + name + ' created successfully.', 'success');
//                    $('#data_loader').removeClass('sk-loading');
//                    $("#curd-content").slideUp("slow", function () {
//                        $("#curd-content").hide();
//                    });
//                } else if (data.status == 2) {
//                    $('#curd-content').html('');
//                    $('#curd-content').html(data.view);
//                    swal('', data.message, 'info');
//                    $('#data_loader').removeClass('sk-loading');
//                } else if (data.status == 3) {
//                    $('#curd-content').html('');
//                    $('#curd-content').html(data.view);
//                    swal('', data.message, 'info');
//                    $('#data_loader').removeClass('sk-loading');
////                    activate_toast(data.message, 'Error', 'error');
//                } else {
//                    swal('', 'Connection Error. Please contact administrator', 'info');
//                    $('#data_loader').removeClass('sk-loading');
////                    activate_toast("Connection Error", 'Error', 'error');
//                }
//
//            }
//        });
//    }
//    
//    
//    
     function edit_store(id, name, code, address1, address2, address3, contact, email,ismain) {
        var ops_url = baseurl + 'store/edit-store';
        $.ajax({
            type: "POST",
            cache: false,
            async: false,
            url: ops_url,
            data: {"load": 1, "store_id": id, "store_name": name, "store_code": code, "address1": address1, "address2" :address2, "address3":address3, "phone": contact, "email": email,"radio-inline":ismain},
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
                    
                } else {
                    alert('No data loaded');
                }
            }
        });
    }

//
//
// function submit_edit_save_data() {
////        $('#data_loader').addClass('sk-loading');
//
//        var ops_url = baseurl + 'store/edit-store';
//        var name = $('#store_name').val().toUpperCase();
//        var code = $('#store_code').val();
//        var address1 = $('#address1').val();
//        var address2 = $('#address2').val();
//        var address3 = $('#address3').val();
//        var contact = $('#phone').val();
//        var email = $('#email').val();
//        var ismain = $('#radio-inline').val();
//
//
//        if (name == '') {
//            swal('', 'Name is required.', 'info');
//            $('#data_loader').removeClass('sk-loading');
//            return false;
//        } else if ((name.length > '30') || (name.length < '3')) {
//            swal('', 'Name should contain letters 3 to 30', 'info');
//            $('#data_loader').removeClass('sk-loading');
//            return false;
//        }
//        var alphanumers = /^[a-zA-Z\s]+$/;
//        if (!alphanumers.test($("#name").val())) {
//            swal('', 'Name can have only alphabets', 'info');
//            $('#data_loader').removeClass('sk-loading');
//            return false;
//        }
//
//        if (code == '') {
//            swal('', 'Code is required.', 'info');
//            $('#data_loader').removeClass('sk-loading');
//            return false;
//        } 
//
//        var alphanumers = /^[a-zA-Z]+$/;
//        if (!alphanumers.test($("#code").val())) {
//            swal('', 'Code can have only alphabets', 'info');
//            $('#data_loader').removeClass('sk-loading');
//            return false;
//        }
//        
//        if (address1 == '') {
//            swal('', 'Address1 is required.', 'info');
//            $('#data_loader').removeClass('sk-loading');
//            return false;
//        } 
//        if (address2 == '') {
//            swal('', 'Address2 is required.', 'info');
//            $('#data_loader').removeClass('sk-loading');
//            return false;
//        } 
//        if (address3 == '') {
//            swal('', 'Address3 is required.', 'info');
//            $('#data_loader').removeClass('sk-loading');
//            return false;
//        } 
//        if (contact == '') {
//            swal('', 'Contact is required.', 'info');
//            $('#data_loader').removeClass('sk-loading');
//            return false;
//        } 
//         if (email == '') {
//            swal('', 'E-mail is required.', 'info');
//            $('#data_loader').removeClass('sk-loading');
//            return false;
//        } 
//
//        $.ajax({
//            type: "POST",
//            cache: false,
//            async: false,
//            url: ops_url,
//            data: $('#store_save').serialize(),
//            success: function (result) {
//                var data = $.parseJSON(result)
//
//                if (data.status == 1) {
//                    $('#store_save').html('');
//                    $('#store_save').html(data.view);
//                    var store_data = [];
//                    $.ajax({
//                        type: "POST",
//                        cache: false,
//                        async: false,
//                        url: baseurl + 'store/show-store',
//                        data: {'load_reset': '1'},
//                        success: function (result) {
//                            store_data = JSON.parse(result);
//                        },
//                        error: function () {
//                            alert('error');
//                        }
//                    });
//                    var datatable = $('#table_store').dataTable().api();
//                    datatable.clear();
//                    datatable.rows.add(store_data).draw();
//                    
//                    $('#add_type').show();
//                    swal('Success', 'Store ' + name + ' updated successfully.', 'success');
//                    $('#data_loader').removeClass('sk-loading');
//                    $("#curd-content").slideUp("slow", function () {
//                        $("#curd-content").hide();
//                    });
//                    
//                } else if (data.status == 2) {
//                    $('#curd-content').html('');
//                    $('#curd-content').html(data.view);
//                    swal('', data.message, 'info');
//                    
//                    $('#data_loader').removeClass('sk-loading');
//                } else if (data.status == 3) {
//                    $('#curd-content').html('');
//                    $('#curd-content').html(data.view);
//                    swal('', data.message, 'info');
//                    
//                    $('#data_loader').removeClass('sk-loading');
////                    activate_toast(data.message, 'Error', 'error');
//                } else {
//                    swal('', 'Connection Error. Please contact administrator', 'info');
//                    $('#data_loader').removeClass('sk-loading');
////                    activate_toast("Connection Error", 'Error', 'error');
//                }
//
//            }
//        });
//    }
//    
//    function change_status(id, element) {
//        $('#data_loader').addClass('sk-loading');
//
//        var status_type = $(element).prop("checked");
//        if (status_type == true)
//            status = 1;
//        else
//            status = -1;
//       
//        var ops_url = baseurl + 'store/change_status';
//        $.ajax({
//            type: "POST",
//            cache: false,
//            async: false,
//            url: ops_url,
//            data: {"load": 1, "store_id": id, "status": status},
//            success: function (result) {
//                var data = $.parseJSON(result);
////                alert(data);return;
//                if (data.status == 1) {
//                    if (status == -1) {
//                        swal('Store Updated', 'Store Status Deactivated Successfully', 'success');
//                        $('#data_loader').removeClass('sk-loading');
//                        active_count();
//                        return true;
//                    } else {
//                        if (status == 1) {
//                            swal('Store Updated', 'Store Status Activated Successfully', 'success');
//                            $('#data_loader').removeClass('sk-loading');
//                            active_count();
//                            return true;
//                        }
//                    }
//                } else {
//                    if (data.status == 0) {
//                        swal({
//                            title: '',
//                            text: data.message,
//                            type: 'info',
//                            showCancelButton: false,
//                            confirmButtonColor: '#3085d6',
//                            cancelButtonColor: '#d33',
//                            confirmButtonText: 'OK'
//                        }, function (isConfirm) {
//                            window.location.href = baseurl + "store/show-store";
//                        });
//                    } else {
//                        if (data.status == 3) {
//                            swal({
//                                title: '',
//                                text: data.message,
//                                type: 'info',
//                                showCancelButton: false,
//                                confirmButtonColor: '#3085d6',
//                                cancelButtonColor: '#d33',
//                                confirmButtonText: 'OK'
//                            }, function (isConfirm) {
//                                window.location.href = baseurl + "store/show-store";
//                            });
//                        } else {
//                            swal({
//                                title: '',
//                                text: 'Publisher Status Updation Failed',
//                                type: 'info',
//                                showCancelButton: false,
//                                confirmButtonColor: '#3085d6',
//                                cancelButtonColor: '#d33',
//                                confirmButtonText: 'OK'
//                            }, function (isConfirm) {
//                                window.location.href = baseurl + "store/show-store";
//                            });
//                        }
//
//                    }
//                }
//            }
//        });
//    }
</script>