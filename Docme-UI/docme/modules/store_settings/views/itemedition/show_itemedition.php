
<div class="wrapper wrapper-content animated fadeInRight" style="padding-top: 1px !important;padding-left: 0px !important;padding-right: 0px !important;">
    <div class="row" style="margin-left: -29px !important; margin-right: -30px !important;">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                  <div class="ibox-title">
                    <h5><?php echo isset($sub_title) ? $sub_title : "NO TITLE PROVIDED" ?></h5>
                    <div class="ibox-tools" id="add_type">
                        <a data-toggle="modal" class="btn btn-primary btn-xs" data-toggle="tooltip" title="Add an Item Edition" data-placement="left"href="javascript:void(0);" onclick="add_new_itemediton();"><i class="fa fa-plus"></i>ADD ITEM EDITION</a>
                    </div>
                </div>
                
<!--                <div class="ibox-title">
                    <h5><?php // echo isset($sub_title) ? $sub_title : "NO TITLE PROVIDED" ?></h5>
                    <div class="ibox-tools" id="add_type">
                        <button type="button" class="btn bg-teal waves-effect"  onclick="add_subject();">NEW SUBJECT</button>
                        <span style="padding-right: 9px;"><a href="javascript:void(0);"  onclick="add_new_itemediton();" >ADD ITEM EDITION</a> </span>
                    </div>

                </div>-->
                <div class="ibox-content" id ="faculty_loader">
                    
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
                                <table class="table table-striped table-bordered table-hover dataTables-example" id="tbl_itemedition" >

                                    <thead>
                                        <tr>
                                            <th>Item Edition</th>
                                            <th>Status</th>                                
                                            <th>Task</th>                              
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        if (isset($itemedition_data) && !empty($itemedition_data) && is_array($itemedition_data)) {
                                            foreach ($itemedition_data as $itemedition) {
                                                ?>
                                                <tr>
                                                    <td><?php echo $itemedition['edition_name'] ?></td>


                                                    <td data-toggle="tooltip" title="Item Edition status">
                                                        <?php if ($itemedition['isactive'] == 1) { ?> 
                                                            <input type="checkbox"  class="js-switch" data-toggle="tooltip" title="Slide for Enable/Disable" onchange="change_status('<?php echo $itemedition['id'] ?>', this)" checked  id="t1" />                                                        

                                                        <?php } else {
                                                            ?>
                                                            <input type="checkbox"  title="Slide for Enable/Disable" onchange="change_status('<?php echo $itemedition['id'] ?>', this)"  id="" class="js-switch"  />                                                                                                            
                                                        <?php }
                                                        ?>
                                                    </td> 
                                                    <td>
                                                        <a href="javascript:void(0);" onclick="edit_itemedition('<?php echo $itemedition['id']; ?>', '<?php echo $itemedition['edition_name']; ?>');"  data-toggle="tooltip" data-placement="right" title="Edit <?php echo $itemedition['edition_name']; ?>" data-original-title="<?php echo $itemedition['edition_name']; ?>"  ><i class="fa fa-pencil" style="font-size: 24px; color: #23C6C8; margin: 2%; "></i></a>
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
    $('#tbl_itemedition').dataTable({
        columnDefs: [
            {"width": "50%", className: "capitalize", "targets": 0},
            {"width": "25%", className: "capitalize", "targets": 1, "orderable": false},
            {"width": "25%", className: "capitalize", "targets": 2, "orderable": false}
        ],
        responsive: true,
        iDisplayLength: 10,
        dom: '<"html5buttons"B>lTfgitp',
        buttons: [
            {extend: 'copy'},
            {extend: 'csv'},
            {extend: 'excel', title: 'Report'}
        ],
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


    function toggle_religion_add() {
        if ($('#add_type').html() > 100) {
            $('#add_type').html('<a href="javascript:void(0);" onclick="toggle_edition_add();"><i class="fa fa-close" style="color:1ab394; font-size:30px;></i></a>');
            add_religion();
        } else {
            $('#add_type').html('<button type="button" class="btn bg-teal waves-effect" onclick="toggle_edition_add();">NEW ITEM EDITION</button>');
            var animation = "fadeOutDown";
            $('#curd-content').addClass('animated');
            $('#curd-content').addClass(animation);
            $('#curd-content').html('');
            $('#curd-content').hide();
        }
    }


    function change_status(id, element) {
        $('#faculty_loader').addClass('sk-loading');
        var status_type = $(element).prop("checked");
            if (status_type == true)
                status = 1;
            else
                status = -1;
        var ops_url = baseurl + 'itemedition/change_status/';
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
                        swal('Item Edition Updated', 'Edition Status Deactivated Successfully', 'success');
                        $('#faculty_loader').removeClass('sk-loading');
                        active_count();
                        return true;
                    } else {
                        if (status == 1) {
                            swal('Item Edition Updated', 'Edition Status Activated Successfully', 'success');
                            $('#faculty_loader').removeClass('sk-loading');
                            active_count();
                            return true;
                        }
                    }
                }

                else {
                    if (data.status == 0) {
//                        swal('Error', data.message, 'error');
                        swal({
                            title: '',
                            text: data.message,
                            type: 'info',
                            showCancelButton: false,
                            confirmButtonColor: '#3085d6',
                            cancelButtonColor: '#d33',
                            confirmButtonText: 'OK'
                        }, function (isConfirm) {
                            window.location.href = baseurl + "itemedition/show-itemedition";
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
                                window.location.href = baseurl + "itemedition/show-itemedition";
                            });
                        } else {
                            swal({
                                title: '',
                                text: 'Item Edition Status Updation Failed',
                                type: 'info',
                                showCancelButton: false,
                                confirmButtonColor: '#3085d6',
                                cancelButtonColor: '#d33',
                                confirmButtonText: 'OK'
                            }, function (isConfirm) {
                                window.location.href = baseurl + "itemedition/show-itemedition";
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

    function add_new_itemediton() {
        var ops_url = baseurl + 'itemedition/add-itemedition/';
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

    function submit_data() {
        $('#faculty_loader').addClass('sk-loading');
        var ops_url = baseurl + 'itemedition/add-itemedition/';
        var edition_name = $('#edition_name').val().toUpperCase();
      if (edition_name == '') {
            swal('', 'Item Edition Required', 'info');
            $('#faculty_loader').removeClass('sk-loading');
            return false;
        }
        else if(edition_name.length > '50' || edition_name.length < '4'){
            swal('', 'Item Edition should contain minlength 4 and maxlength 50', 'info');
            $('#faculty_loader').removeClass('sk-loading');
            return false;
        }
        
        var alphanumers = /^[0-9]+$/;
            if(!alphanumers.test($("#edition_name").val())){    
                swal('', 'Item Edition can have only numbers', 'info');
                $('#faculty_loader').removeClass('sk-loading');
                return false;
            }
           
        $.ajax({
            type: "POST",
            cache: false,
            async: false,
            url: ops_url,
            data: $('#edition_save').serialize(),
            success: function (result) {
                var data = $.parseJSON(result)
                if (data.status == 1) {
                    active_count();
                    $('#edition_save').html('');
                    $('#edition_save').html(data.view);
                    var edition_data = [];
                    $.ajax({
                        type: "POST",
                        cache: false,
                        async: false,
                        url: baseurl + 'itemedition/show-itemedition',
                        data: {'load_reset': '1'},
                        success: function (result) {
                            edition_data = JSON.parse(result);
                        },
                        error: function () {
                            alert('error');
                        }
                    });
                    var datatable = $('#tbl_itemedition').dataTable().api();
                    datatable.clear();
                    datatable.rows.add(edition_data).draw();
                    $('#add_type').show();
                    swal('Success', 'New Item Edition, ' + edition_name + ' created successfully.', 'success');
                    $('#faculty_loader').removeClass('sk-loading');
                    $("#curd-content").slideUp("slow", function () {
                        $("#curd-content").hide();
                    });
                    
                } else if (data.status == 2) {
                    $('#curd-content').html('');
                    $('#curd-content').html(data.view);
                    swal('','Item Edition Already Exists','info');
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
        var ops_url = baseurl + 'itemedition/edit-itemedition';
        var edition_name = $('#edition_name').val().toUpperCase();
        if (edition_name == '') {
            swal('', 'Item Edition Required', 'info');
            $('#faculty_loader').removeClass('sk-loading');
            return false;
        }
         else if(edition_name.length > '50' || edition_name.length < '4'){
            swal('', 'Item Edition should contain minlength 4 and maxlength 50', 'info');
            $('#faculty_loader').removeClass('sk-loading');
            return false;
        }
        
         var alphanumers = /^[0-9]+$/;
            if(!alphanumers.test($("#edition_name").val())){    
                swal('', 'Item Edition can have only numbers', 'info');
                $('#faculty_loader').removeClass('sk-loading');
                return false;
            }
        $.ajax({
            type: "POST",
            cache: false,
            async: false,
            url: ops_url,
            data: $('#edition_save').serialize(),
            success: function (result) {
                var data = $.parseJSON(result)
                if (data.status == 1) {
                    $('#edition_save').html('');
                    $('#edition_save').html(data.view);
                    var edition_data = [];
                    $.ajax({
                        type: "POST",
                        cache: false,
                        async: false,
                        url: baseurl + 'itemedition/show-itemedition',
                        data: {'load_reset': '1'},
                        success: function (result) {
                            edition_data = JSON.parse(result);
                        },
                        error: function () {
                            alert('error');
                        }
                    });
                    var datatable = $('#tbl_itemedition').dataTable().api();
                    datatable.clear();
                    datatable.rows.add(edition_data).draw();
                    $('#add_type').show();
                    swal('Success', 'Item Edition , ' + edition_name + ' updated successfully.', 'success');
                    $('#faculty_loader').removeClass('sk-loading');
                    $("#curd-content").slideUp("slow", function () {
                        $("#curd-content").hide();
                    });
                  
                } else if (data.status == 2) {
                    $('#curd-content').html('');
                    $('#curd-content').html(data.view);
                    swal('','Item Edition Already Exists','info');
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


    function refresh_add_panel() {
        $('#edition_name').val('');
        $('#edition_name').parent().removeAttr('class', 'has-error');

    }

    function edit_itemedition(id, name) {
        var ops_url = baseurl + 'itemedition/edit-itemedition/';
        $.ajax({
            type: "POST", 
            cache: false,
            async: false,
            url: ops_url,
            data: {"load": 1, "id": id, "edition_name": name},
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

    function close_add_itemedition() {
        $('#add_type').show();
        $("#curd-content").slideUp("slow", function () {
            $("#curd-content").hide();
        });

    }
</script>

