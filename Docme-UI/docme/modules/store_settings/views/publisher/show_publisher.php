



<div class="wrapper wrapper-content animated fadeInRight" style="padding-top: 1px !important;padding-left: 0px !important;padding-right: 0px !important;">
    <div class="row" style="margin-left: -29px !important; margin-right: -30px !important;">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5><?php echo isset($sub_title) ? $sub_title : "NO TITLE PROVIDED" ?></h5>
                    <div class="ibox-tools" id="add_type">
                        <!--<button type="button" class="btn bg-teal waves-effect"  onclick="add_subject();">NEW SUBJECT</button>-->
                       <a data-toggle="modal" class="btn btn-primary btn-xs" data-toggle="tooltip" title="Add Publisher" data-placement="left"href="javascript:void(0);" onclick="add_new_publisher();"><i class="fa fa-plus"></i>ADD PUBLISHER</a>
                        <!--<span style="padding-right: 9px;"  class="btn btn-primary btn-xs"><a href="javascript:void(0);"  onclick="add_new_publisher();" ><i class="fa fa-plus"></i>ADD PUBLISHER</a> </span>-->
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
                                <table class="table table-striped table-bordered table-hover dataTables-example" id="tbl_publisher" >

                                    <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>Code</th>
                                            <!--<th >Address</th>-->                        
                                            <th>Contact</th>                                
                                            <th>E-mail</th>                                
                                            <th>Status</th>                                
                                            <th>Task</th>                           
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        if (isset($publisher_data) && !empty($publisher_data) && is_array($publisher_data)) {
                                            foreach ($publisher_data as $publisher) {
                                                ?>
                                                <tr>
                                                    <td> <?php echo $publisher['pub_name']; ?></td>
                                                    <td> <?php echo $publisher['pub_code']; ?></td>
                                                    <!--<td> <?php // echo address_formatter($publisher['pub_address1'], $publisher['pub_address2'],$publisher['pub_address3']); ?></td>-->
                                                    <td> <?php echo $publisher['pub_contact']; ?></td>
                                                    <td> <?php echo $publisher['pub_email']; ?></td>
                                                   

                                                    <td  data-toggle="tooltip" title="Slide for Enable/Disable">
                                                        <?php if ($publisher['isactive'] == 1) { ?>                                                    
                                                            <input type="checkbox"  class="js-switch" data-toggle="tooltip" title="Slide for Enable/Disable" onchange="change_status('<?php echo $publisher['pub_id'] ?>', this)" checked  id="t1" />                                                       


                                                        <?php } else {
                                                            ?>
                                                            <input type="checkbox"  title="Slide for Enable/Disable" onchange="change_status('<?php echo $publisher['pub_id'] ?>', this)"  id="" class="js-switch"  />                                                                                                         

                                                        <?php }
                                                        ?>
                                                    </td>
                                                    <td>
                                                        <a href="javascript:void(0);" onclick="edit_publisher('<?php echo $publisher['pub_id']; ?>', '<?php echo $publisher['pub_name']; ?>', '<?php echo $publisher['pub_code']; ?>', '<?php echo $publisher['pub_address1']; ?>','<?php echo $publisher['pub_address2']; ?>','<?php echo $publisher['pub_address3']; ?>','<?php echo $publisher['pub_contact']; ?>','<?php echo $publisher['pub_email']; ?>');"  data-toggle="tooltip" data-placement="right" title="Edit <?php echo $publisher['pub_name']; ?>" data-original-title="<?php echo $publisher['pub_name']; ?>"  ><i class="fa fa-pencil" style="font-size: 24px; color: #23C6C5; margin: 2%; "></i></a>                                                       
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
    $('#tbl_publisher').dataTable({

        columnDefs: [
           {"width": "10%", className: "capitalize", "targets": 0},
            {"width": "10%", className: "capitalize", "targets": 1},
            {"width": "10%", className: "capitalize", "targets": 2},
            {"width": "10%", className: "capitalize", "targets": 3},
            {"width": "10%", className: "capitalize", "targets": 4, "orderable": false},
//            {"width": "10%", className: "capitalize", "targets": 5},
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
            var switchery = new Switchery(html, {color: '#23C6C8',secondaryColor: '#F8AC59', size: 'small'});
            list_switchery.push(switchery);
        });
    }

    function toggle_publisher_add() {
        if ($('#add_type').html() > 100) {
            $('#add_type').html('<a href="javascript:void(0);" onclick="toggle_publisher_add();"><i class="fa fa-close" style="color:1ab394; font-size:30px;></i></a>');
            add_publisher();
        } else {
            $('#add_type').html('<button type="button" class="btn bg-teal waves-effect" onclick="toggle_publisher_add();">NEW PUBLISHER</button>');
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
//        alert(status_type);
        if (status_type == true)
            status = 1;
        else
            status = -1;
       
        var ops_url = baseurl + 'publisher/change_status';
        $.ajax({
            type: "POST",
            cache: false,
            async: false,
            url: ops_url,
            data: {"load": 1, "pub_id": id, "status": status},
            success: function (result) {
                var data = $.parseJSON(result);
//                alert(data);return;
                if (data.status == 1) {
                    if (status == -1) {
                        swal('Publisher Updated', 'Publisher Status Deactivated Successfully', 'success');
                        $('#data_loader').removeClass('sk-loading');
                        active_count();
                        load_publisher();
                        return true;
                    } else {
                        if (status == 1) {
                            swal('Publisher Updated', 'Publisher Status Activated Successfully', 'success');
                            $('#data_loader').removeClass('sk-loading');
                            active_count();
                            load_publisher();
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
                            window.location.href = baseurl + "publisher/show-publisher";
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
                                window.location.href = baseurl + "publisher/show-publisher";
                            });
                        } else {
                            swal({
                                title: '',
                                text: 'Publisher Status Updation Failed',
                                type: 'info',
                                showCancelButton: false,
                                confirmButtonColor: '#3085d6',
                                cancelButtonColor: '#d33',
                                confirmButtonText: 'OK'
                            }, function (isConfirm) {
                                window.location.href = baseurl + "publisher/show-publisher";
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
//        $('#data_loader').addClass('sk-loading');

        var ops_url = baseurl + 'publisher/add-publisher';
        var name = $('#name').val().toUpperCase();
//        alert(name);die;
        var code = $('#code').val();
        var address1 = $('#address1').val();
        var address2 = $('#address2').val();
        var address3 = $('#address3').val();
        var contact = $('#contact').val();
        var email = $('#email').val();


        if (name == '') {
            swal('', 'Name is required.', 'info');
            $('#data_loader').removeClass('sk-loading');
            return false;
        } else if ((name.length > '30') || (name.length < '3')) {
            swal('', 'Name should contain letters 3 to 30', 'info');
            $('#data_loader').removeClass('sk-loading');
            return false;
        }
        var alphanumers = /^[a-zA-Z\s]+$/;
        if (!alphanumers.test($("#name").val())) {
            swal('', 'Name can have only alphabets', 'info');
            $('#data_loader').removeClass('sk-loading');
            return false;
        }

        if (code == '') {
            swal('', 'Code is required.', 'info');
            $('#data_loader').removeClass('sk-loading');
            return false;
        } else if ((code.length > '15') || (code.length < '3')) {
            swal('', 'Code should contain letters 3 to 15', 'info');
            $('#data_loader').removeClass('sk-loading');
            return false;
        }
        var alphanumers = /^[a-zA-Z]+$/;
        if (!alphanumers.test($("#code").val())) {
            swal('', 'Code can have only alphabets', 'info');
            $('#data_loader').removeClass('sk-loading');
            return false;
        }
        
        if (address1 == '') {
            swal('', 'Address1 is required.', 'info');
            $('#data_loader').removeClass('sk-loading');
            return false;
        } 
        if (address2 == '') {
            swal('', 'Address2 is required.', 'info');
            $('#data_loader').removeClass('sk-loading');
            return false;
        } 
        if (address3 == '') {
            swal('', 'Address3 is required.', 'info');
            $('#data_loader').removeClass('sk-loading');
            return false;
        } 
        if (contact == '') {
            swal('', 'Contact is required.', 'info');
            $('#data_loader').removeClass('sk-loading');
            return false;
        } 
          var alphanumers = /^[0-9]+$/;
        if (!alphanumers.test($("#contact").val())) {
            swal('', 'Contact can have only numbers', 'info');
            $('#data_loader').removeClass('sk-loading');
            return false;
        }
        
         if (email == '') {
            swal('', 'E-mail is required.', 'info');
            $('#data_loader').removeClass('sk-loading');
            return false;
        } 
          var alphanumers = /^([\w-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([\w-]+\.)+))([a-zA-Z]{2,4}|[0-9]{1,3})(\]?)$/;
        if (!alphanumers.test($("#email").val())) {
            swal('', 'Invalid Email Id', 'info');
            $('#data_loader').removeClass('sk-loading');
            return false;
        }
      

        $.ajax({
            type: "POST",
            cache: false,
            async: false,
            url: ops_url,
            data: $('#publisher_save').serialize(),
            success: function (result) {
                var data = $.parseJSON(result);
                if (data.status == 1) {
                    active_count();
                    $('#publisher_save').html('');
                    $('#publisher_save').html(data.view);
                    var publisher_data = [];
                    $.ajax({
                        type: "POST",
                        cache: false,
                        async: false,
                        url: baseurl + 'publisher/show-publisher/',
                        data: {'load_reset': '1'},
                        success: function (result) {
                            publisher_data = JSON.parse(result);

                        },
                        error: function () {
                            alert('error');
                        }
                    });
                    var datatable = $('#tbl_publisher').dataTable().api();
                    datatable.clear();
                    datatable.rows.add(publisher_data).draw();

                    $('#add_type').show();
                    swal('Success', 'New Publisher, ' + name + ' created successfully.', 'success');
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
//        $('#data_loader').addClass('sk-loading');

        var ops_url = baseurl + 'publisher/edit-publisher';
        var name = $('#pub_name').val().toUpperCase();
        var code = $('#pub_code').val();
        var address1 = $('#pub_address1').val();
        var address2 = $('#pub_address2').val();
        var address3 = $('#pub_address3').val();
        var contact = $('#pub_contact').val();
        var email = $('#pub_email').val();


        if (name == '') {
            swal('', 'Name is required.', 'info');
            $('#data_loader').removeClass('sk-loading');
            return false;
        } else if ((name.length > '30') || (name.length < '3')) {
            swal('', 'Name should contain letters 3 to 30', 'info');
            $('#data_loader').removeClass('sk-loading');
            return false;
        }
        var alphanumers = /^[a-zA-Z\s]+$/;
        if (!alphanumers.test($("#name").val())) {
            swal('', 'Name can have only alphabets', 'info');
            $('#data_loader').removeClass('sk-loading');
            return false;
        }

        if (code == '') {
            swal('', 'Code is required.', 'info');
            $('#data_loader').removeClass('sk-loading');
            return false;
        } else if ((code.length > '15') || (code.length < '3')) {
            swal('', 'Code should contain letters 3 to 15', 'info');
            $('#data_loader').removeClass('sk-loading');
            return false;
        }
        var alphanumers = /^[a-zA-Z]+$/;
        if (!alphanumers.test($("#code").val())) {
            swal('', 'Code can have only alphabets', 'info');
            $('#data_loader').removeClass('sk-loading');
            return false;
        }
        
        if (address1 == '') {
            swal('', 'Address1 is required.', 'info');
            $('#data_loader').removeClass('sk-loading');
            return false;
        } 
        if (address2 == '') {
            swal('', 'Address2 is required.', 'info');
            $('#data_loader').removeClass('sk-loading');
            return false;
        } 
        if (address3 == '') {
            swal('', 'Address3 is required.', 'info');
            $('#data_loader').removeClass('sk-loading');
            return false;
        } 
        if (contact == '') {
            swal('', 'Contact is required.', 'info');
            $('#data_loader').removeClass('sk-loading');
            return false;
        } 
         if (email == '') {
            swal('', 'E-mail is required.', 'info');
            $('#data_loader').removeClass('sk-loading');
            return false;
        } 

//alert(id);return;
        $.ajax({
            type: "POST",
            cache: false,
            async: false,
            url: ops_url,
            data: $('#publisher_save').serialize(),
            success: function (result) {
                var data = $.parseJSON(result)

                if (data.status == 1) {
                    $('#publisher_save').html('');
                    $('#publisher_save').html(data.view);
                    var publisher_data = [];
                    $.ajax({
                        type: "POST",
                        cache: false,
                        async: false,
                        url: baseurl + 'publisher/show-publisher',
                        data: {'load_reset': '1'},
                        success: function (result) {
                            publisher_data = JSON.parse(result);
                        },
                        error: function () {
                            alert('error');
                        }
                    });
                    var datatable = $('#tbl_publisher').dataTable().api();
                    datatable.clear();
                    datatable.rows.add(publisher_data).draw();
                    
                    $('#add_type').show();
                    swal('Success', 'Publisher ' + name + ' updated successfully.', 'success');
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
        $('#email').val('');
        $('#email').parent().removeAttr('class', 'has-error');
    }

    function edit_publisher(id, name, code, address1, address2, address3, contact, email) {
        var ops_url = baseurl + 'publisher/edit-publisher';
        $.ajax({
            type: "POST",
            cache: false,
            async: false,
            url: ops_url,
            data: {"load": 1, "pub_id": id, "pub_name": name, "pub_code": code, "pub_address1": address1, "pub_address2" :address2, "pub_address3":address3, "pub_contact": contact, "pub_email": email},
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

    function close_add_publisher() {
        $('#add_type').show();
        $("#curd-content").slideUp("slow", function () {
            $("#curd-content").hide();
        });

    }

//NEW SCRIPT
    function add_new_publisher() {
        var ops_url = baseurl + 'publisher/add-publisher';
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
                   
                } else {
                    alert('No data loaded');
                }
            }
        });
    }



</script>