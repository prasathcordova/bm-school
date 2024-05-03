
<!-- 
Description of show_suppliers

 @author Saranya kumar G
-->

<div class="wrapper wrapper-content animated fadeInRight" style="padding-top: 1px !important;padding-left: 0px !important;padding-right: 0px !important;">
    <div class="row" style="margin-left: -29px !important; margin-right: -30px !important;">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5><?php echo isset($sub_title) ? $sub_title : "NO TITLE PROVIDED" ?></h5>
                    <div class="ibox-tools" id="add_type">
                        <!--<button type="button" class="btn bg-teal waves-effect"  onclick="add_subject();">NEW SUBJECT</button>-->
                        <a data-toggle="modal" class="btn btn-primary btn-xs" data-toggle="tooltip" title="Add a supplier" data-placement="left" href="javascript:void(0);" onclick="add_new_suppliers();"><i class="fa fa-plus"></i>ADD SUPPLIER</a>
                        <!--<span style="padding-right: 9px;"><a href="javascript:void(0);"  onclick="add_new_suppliers();" >ADD SUPPLIER</a> </span>-->
                    </div>
                </div>
                <div class="ibox-content" id="data_loader">
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
                                <table class="table table-striped table-bordered table-hover dataTables-example" id="tbl_suppliers" >
                                    <thead>
                                        <tr>
                                            <th>Supplier Name</th>
                                            <th>Supplier Code</th>
                                            <!--<th>Address</th>-->                                
                                            <th>Contact</th>                                
                                            <th>Email Id</th>                                
                                            <th>Status</th>                                
                                            <th>Task</th>                           
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        if (isset($suppliers_data) && !empty($suppliers_data) && is_array($suppliers_data)) {
                                            foreach ($suppliers_data as $suppliers) {
                                                ?>
                                                <tr>
                                                    <td> <?php echo $suppliers['name']; ?></td>
                                                    <td> <?php echo $suppliers['code']; ?></td>
                                                    <!--<td> <?php echo address_formatter($suppliers['address1'], $suppliers['address2'], $suppliers['address3']); ?></td>-->

                                                    <td> <?php echo $suppliers['contact']; ?></td>
                                                    <td> <?php echo $suppliers['emailid']; ?></td>

                                                    <td  data-toggle="tooltip" title="Slide for Enable/Disable">
                                                        <?php if ($suppliers['isactive'] == 1) { ?>                                                    
                                                            <input type="checkbox"  class="js-switch" data-toggle="tooltip" title="Slide for Enable/Disable" onchange="change_status('<?php echo $suppliers['id'] ?>', this)" checked  id="t1" />                                                       


                                                        <?php } else {
                                                            ?>
                                                            <input type="checkbox"  title="Slide for Enable/Disable" onchange="change_status('<?php echo $suppliers['id'] ?>', this)"  id="" class="js-switch"  />                                                                                                         

                                                        <?php }
                                                        ?>
                                                    </td>
                                                    <td>
                                                        <a href="javascript:void(0);" onclick="edit_suppliers('<?php echo $suppliers['id']; ?>', '<?php echo $suppliers['name']; ?>', '<?php echo $suppliers['code']; ?>', '<?php echo $suppliers['address1']; ?>', '<?php echo $suppliers['address2']; ?>', '<?php echo $suppliers['address3']; ?>', '<?php echo $suppliers['contact']; ?>', '<?php echo $suppliers['emailid']; ?>', );"  data-toggle="tooltip" data-placement="right" title="Edit <?php echo $suppliers['name']; ?>" data-original-title="<?php echo $suppliers['name']; ?>"  ><i class="fa fa-pencil" style="font-size: 24px; color: #23C6C8; margin: 2%; "></i></a>                                                       
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
</div>


<script type="text/javascript">
    var list_switchery = [];
    $('#tbl_suppliers').dataTable({

        columnDefs: [
            {"width": "15%", className: "capitalize", "targets": 0},
            {"width": "15%", className: "capitalize", "targets": 1},
            {"width": "20%", className: "capitalize", "targets": 2},
            {"width": "10%", className: "capitalize", "targets": 3},
            {"width": "10%", className: "capitalize", "targets": 4, "orderable": false},
//            {"width": "15%", className: "capitalize", "targets": 5},
            {"width": "10%", className: "capitalize", "targets": 5, "orderable": false}
        ],
        responsive: true,
        iDisplayLength: 10,
        "fnDrawCallback": function (ele) {
            activateSwitchery();
        }


    });
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
            var switchery = new Switchery(html, {color: '#23c6c8', secondaryColor: '#F8AC59', size: 'small'});
            list_switchery.push(switchery);
        });
    }

    function toggle_suppliers_add() {
        if ($('#add_type').html() > 100) {
            $('#add_type').html('<a href="javascript:void(0);" onclick="toggle_suppliers_add();"><i class="fa fa-close" style="color:1ab394; font-size:30px;></i></a>');
            add_suppliers();
        } else {
            $('#add_type').html('<button type="button" class="btn bg-teal waves-effect" onclick="toggle_suppliers_add();">NEW SUPPLIER</button>');
            var animation = "fadeOutDown";
            $('#curd-content').addClass('animated');
            $('#curd-content').addClass(animation);
            $('#curd-content').html('');
            $('#curd-content').hide();
        }
    }

    function change_status(id, element) {
        $('#data_loader').addClass('sk-loading');

        var status_type = $(element).prop("checked");
        if (status_type == true)
            status = 1;
        else
            status = -1;
        var ops_url = baseurl + 'suppliers/change_status/';
        $.ajax({
            type: "POST",
            cache: false,
            async: false,
            url: ops_url,
            data: {"load": 1, "id": id, "status": status},
            success: function (result) {
                var data = $.parseJSON(result);
                if (data.status == 1) {
                    if (status == -1) {
                        swal('Supplier Updated', 'Supplier Status Deactivated Successfully', 'success');
                        $('#data_loader').removeClass('sk-loading');
                        active_count();
                        load_supplier()
                        return true;
                    } else {
                        if (status == 1) {
                            swal('Supplier Updated', 'Supplier Status Activated Successfully', 'success');
                            $('#data_loader').removeClass('sk-loading');
                            active_count();
                            load_supplier()
                            return true;
                        }
                    }
                } else {
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
                            window.location.href = baseurl + "suppliers/show-suppliers";
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
                                window.location.href = baseurl + "suppliers/show-suppliers";
                            });
                        } else {
                            swal({
                                title: '',
                                text: 'Supplier Status Updation Failed',
                                type: 'info',
                                showCancelButton: false,
                                confirmButtonColor: '#3085d6',
                                cancelButtonColor: '#d33',
                                confirmButtonText: 'OK'
                            }, function (isConfirm) {
                                window.location.href = baseurl + "suppliers/show-suppliers";
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
        $('#data_loader').addClass('sk-loading');

        var ops_url = baseurl + 'suppliers/add-suppliers/';
        var name = $('#name').val().toUpperCase();
        var code = $('#code').val();
        var address1 = $('#address1').val();
        var address2 = $('#address2').val();
        var address3 = $('#address3').val();
        var contact = $('#contact').val();
        var emailid = $('#emailid').val();



        if (name == '') {
            swal('', 'Supplier Name is required.', 'info');
            $('#data_loader').removeClass('sk-loading');
            return false;
        } else if ((name.length > '30') || (name.length < '3')) {
            swal('', 'Supplier Name should contain letters 3 to 30', 'info');
            $('#data_loader').removeClass('sk-loading');
            return false;
        }
        var alphanumers = /^[a-zA-Z\s]+$/;
        if (!alphanumers.test($("#name").val())) {
            swal('', 'Supplier Name can have only alphabets', 'info');
            $('#data_loader').removeClass('sk-loading');
            return false;
        }

        if (code == '') {
            swal('', 'Supplier Code is required.', 'info');
            $('#data_loader').removeClass('sk-loading');
            return false;
        } else if ((code.length > '15') || (code.length < '3')) {
            swal('', 'Supplier Code should contain letters 3 to 15', 'info');
            $('#data_loader').removeClass('sk-loading');
            return false;
        }
        var alphanumers = /^[a-zA-Z]+$/;
        if (!alphanumers.test($("#code").val())) {
            swal('', 'Supplier Code can have only alphabets', 'info');
            $('#data_loader').removeClass('sk-loading');
            return false;
        }
        if (address1 == '') {
            swal('', 'Address is required.', 'info');
            $('#data_loader').removeClass('sk-loading');
            return false;
        } else if ((address1.length > '100') || (address1.length < '3')) {
            swal('', 'Address should contain letters 3 to 100', 'info');
            $('#data_loader').removeClass('sk-loading');
            return false;
        }
        if (address2 == '') {
            swal('', 'Address is required.', 'info');
            $('#data_loader').removeClass('sk-loading');
            return false;
        } else if ((address2.length > '100') || (address2.length < '3')) {
            swal('', 'Address should contain letters 3 to 100', 'info');
            $('#data_loader').removeClass('sk-loading');
            return false;
        }
        if (address3 == '') {
            swal('', 'Address is required.', 'info');
            $('#data_loader').removeClass('sk-loading');
            return false;
        } else if ((address3.length > '100') || (address3.length < '3')) {
            swal('', 'Address should contain letters 3 to 100', 'info');
            $('#data_loader').removeClass('sk-loading');
            return false;
        }
        if (contact == '') {
            swal('', 'Contact is required.', 'info');
            $('#data_loader').removeClass('sk-loading');
            return false;
        } else if ((contact.length > '20') || (contact.length < '3')) {
            swal('', 'Contact should contain letters 3 to 20', 'info');
            $('#data_loader').removeClass('sk-loading');
            return false;
        }
        var numeric = /(^[0-9]+[-]*[0-9]+$)/;
        if (!numeric.test($("#contact").val())) {
            swal('', 'Contact can have only numbers', 'info');
            $('#data_loader').removeClass('sk-loading');
            return false;
        }
        if (emailid == '') {
            swal('', 'emailid is required.', 'info');
            $('#data_loader').removeClass('sk-loading');
            return false;
        }
        var alphanumers = /^([\w-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([\w-]+\.)+))([a-zA-Z]{2,4}|[0-9]{1,3})(\]?)$/;
        if (!alphanumers.test($("#emailid").val())) {
            swal('', 'Invalid Email Id', 'info');
            $('#data_loader').removeClass('sk-loading');
            return false;
        }




        $.ajax({
            type: "POST",
            cache: false,
            async: false,
            url: ops_url,
            data: $('#suppliers_save').serialize(),
            success: function (result) {
                var data = $.parseJSON(result);
                if (data.status == 1) {
                    active_count();
                    $('#suppliers_save').html('');
                    $('#suppliers_save').html(data.view);
                    var suppliers_data = [];
                    $.ajax({
                        type: "POST",
                        cache: false,
                        async: false,
                        url: baseurl + 'suppliers/show-suppliers/',
                        data: {'load_reset': '1'},
                        success: function (result) {
                            suppliers_data = JSON.parse(result);

                        },
                        error: function () {
                            alert('error');
                        }
                    });
                    var datatable = $('#tbl_suppliers').dataTable().api();
                    datatable.clear();
                    datatable.rows.add(suppliers_data).draw();

                    $('#add_type').show();
                    swal('Success', 'New Supplier, ' + name + ' created successfully.', 'success');
                    $('#data_loader').removeClass('sk-loading');
                    $("#curd-content").slideUp("slow", function () {
                        $("#curd-content").hide();
                    });
                } else if (data.status == 2) {
                    $('#curd-content').html('');
                    $('#curd-content').html(data.view);
                    swal('', data.message, 'info');
                    $('#data_loader').removeClass('sk-loading');
                } else if (data.status == 3) {
                    $('#curd-content').html('');
                    $('#curd-content').html(data.view);
                    swal('', data.message, 'info');
                    $('#data_loader').removeClass('sk-loading');
//                    activate_toast(data.message, 'Error', 'error');
                } else {
                    swal('', 'Connection Error. Please contact administrator', 'info');
                    $('#data_loader').removeClass('sk-loading');
//                    activate_toast("Connection Error", 'Error', 'error');
                }

            }
        });
    }

    function submit_edit_save_data() {
        $('#data_loader').addClass('sk-loading');

        var ops_url = baseurl + 'suppliers/edit-suppliers';
        var name = $('#name').val().toUpperCase();
        var code = $('#code').val();
        var address1 = $('#address1').val();
        var address2 = $('#address2').val();
        var address3 = $('#address3').val();
        var contact = $('#contact').val();
        var emailid = $('#emailid').val();
//        alert(ops_url);


        if (name == '') {
            swal('', 'Supplier Name is required.', 'info');
            $('#data_loader').removeClass('sk-loading');
            return false;
        } else if ((name.length > '30') || (name.length < '3')) {
            swal('', 'Supplier Name should contain letters 3 to 30', 'info');
            $('#data_loader').removeClass('sk-loading');
            return false;
        }
        var alphanumers = /^[a-zA-Z\s]+$/;
        if (!alphanumers.test($("#name").val())) {
            swal('', 'Supplier Name can have only alphabets', 'info');
            $('#data_loader').removeClass('sk-loading');
            return false;
        }

        if (code == '') {
            swal('', 'Supplier Code is required.', 'info');
            $('#data_loader').removeClass('sk-loading');
            return false;
        } else if ((code.length > '15') || (code.length < '3')) {
            swal('', 'Supplier Code should contain letters 3 to 15', 'info');
            $('#data_loader').removeClass('sk-loading');
            return false;
        }
        var alphanumers = /^[a-zA-Z]+$/;
        if (!alphanumers.test($("#code").val())) {
            swal('', 'Supplier Code can have only alphabets', 'info');
            $('#data_loader').removeClass('sk-loading');
            return false;
        }
        if (address1 == '') {
            swal('', 'Address is required.', 'info');
            $('#data_loader').removeClass('sk-loading');
            return false;
        }
        if (address2 == '') {
            swal('', 'Address is required.', 'info');
            $('#data_loader').removeClass('sk-loading');
            return false;
        }
        if (address3 == '') {
            swal('', 'Address is required.', 'info');
            $('#data_loader').removeClass('sk-loading');
            return false;
        }
        if (contact == '') {
            swal('', 'Contact is required.', 'info');
            $('#data_loader').removeClass('sk-loading');
            return false;
        }
        if (emailid == '') {
            swal('', 'emailid is required.', 'info');
            $('#data_loader').removeClass('sk-loading');
            return false;
        }



        $.ajax({
            type: "POST",
            cache: false,
            async: false,
            url: ops_url,
            data: $('#suppliers_save').serialize(),
            success: function (result) {
                var data = $.parseJSON(result)

                if (data.status == 1) {
                    $('#suppliers_save').html('');
                    $('#suppliers_save').html(data.view);
                    var suppliers_data = [];
                    $.ajax({
                        type: "POST",
                        cache: false,
                        async: false,
                        url: baseurl + 'suppliers/show-suppliers',
                        data: {'load_reset': '1'},
                        success: function (result) {
                            suppliers_data = JSON.parse(result);
//                            alert(suppliers_data);die;
                        },
                        error: function () {
                            alert('error');
                        }
                    });
                    var datatable = $('#tbl_suppliers').dataTable().api();
                    datatable.clear();
                    datatable.rows.add(suppliers_data).draw();
                    $('#add_type').show();
                    swal('Success', 'Supplier ' + name + ' updated successfully.', 'success');
                    $('#data_loader').removeClass('sk-loading');
                    $("#curd-content").slideUp("slow", function () {
                        $("#curd-content").hide();
                    });

                } else if (data.status == 2) {
                    $('#curd-content').html('');
                    $('#curd-content').html(data.view);
                    swal('', data.message, 'info');

                    $('#data_loader').removeClass('sk-loading');
                } else if (data.status == 3) {
                    $('#curd-content').html('');
                    $('#curd-content').html(data.view);
                    swal('', data.message, 'info');

                    $('#data_loader').removeClass('sk-loading');
//                    activate_toast(data.message, 'Error', 'error');
                } else {
                    swal('', 'Connection Error. Please contact administrator', 'info');
                    $('#data_loader').removeClass('sk-loading');
//                    activate_toast("Connection Error", 'Error', 'error');
                }

            }
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
        $('#emailid').val('');
        $('#emailid').parent().removeAttr('class', 'has-error');
    }

    function edit_suppliers(id, name, code, add1, add2, add3, contact, emailid) {
        var ops_url = baseurl + 'suppliers/edit-suppliers';
        $.ajax({
            type: "POST",
            cache: false,
            async: false,
            url: ops_url,
            data: {"load": 1, "s_id": id, "name": name, "code": code, "address1": add1, "address2": add2, "address3": add3, "contact": contact, "emailid": emailid},
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

    function close_add_suppliers() {
        $('#add_type').show();
        $("#curd-content").slideUp("slow", function () {
            $("#curd-content").hide();
        });

    }

//NEW SCRIPT
    function add_new_suppliers() {
        var ops_url = baseurl + 'suppliers/add-suppliers';
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
                        'theme': 'bootstrap'
                    });
                } else {
                    alert('No data loaded');
                }
            }
        });
    }



</script>