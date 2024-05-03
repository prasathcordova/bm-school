
<div class="wrapper wrapper-content animated fadeInRight" style="padding-top: 1px !important;padding-left: 0px !important;padding-right: 0px !important;">
    <div class="row" style="margin-left: -29px !important; margin-right: -30px !important;">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5><?php echo isset($sub_title) ? $sub_title : "NO TITLE PROVIDED" ?></h5>
                    <div class="ibox-tools" id="add_type">
                        <a data-toggle="modal" class="btn btn-primary btn-xs" data-toggle="tooltip" title="Add a Batch" data-placement="left"href="javascript:void(0);" onclick="add_new_category();"><i class="fa fa-plus"></i>ADD NEW CATEGORY</a>
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
                        <div class="clearfix"> </div>
                        <div class="col-lg-12">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover dataTables-example" id="tbl_category" >

                                    <thead>
                                        <tr>
                                            <th> Name</th>
                                            <th>Description</th>
                                            <th>Status</th>                                
                                            <th>Task</th>                           
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        if (isset($category_data) && !empty($category_data) && is_array($category_data)) {
                                            foreach ($category_data as $category) {
                                                ?>
                                                <tr>
                                                    <td> <?php echo $category['cate_name']; ?></td>
                                                    <td> <?php echo $category['cate_description']; ?></td>


                                                    <td  data-toggle="tooltip" title="Slide for Enable/Disable">
                                                        <?php if ($category['isactive'] == 1) { ?>                                                    
                                                            <input type="checkbox"  class="js-switch" data-toggle="tooltip" title="Slide for Enable/Disable" onchange="change_status('<?php echo $category['cate_id'] ?>', this)" checked  id="t1" />                                                       


                                                        <?php } else {
                                                            ?>
                                                            <input type="checkbox"  title="Slide for Enable/Disable" onchange="change_status('<?php echo $category['cate_id'] ?>', this)"  id="" class="js-switch"  />                                                                                                         

                                                        <?php }
                                                        ?>
                                                    </td>
                                                    <td>
                                                        <a href="javascript:void(0);" onclick="edit_category('<?php echo $category['cate_id']; ?>', '<?php echo $category['cate_name']; ?>', '<?php echo $category['cate_description']; ?>');"  data-toggle="tooltip" data-placement="right" title="Edit <?php echo $category['cate_name']; ?>" data-original-title="<?php echo $category['cate_name']; ?>"  ><i class="fa fa-pencil" style="font-size: 24px; color: #23C6C8; margin: 2%; "></i></a>                                                       
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
    $('#tbl_category').dataTable({

        columnDefs: [
            {"width": "40%", className: "capitalize", "targets": 0},
            {"width": "30%", className: "capitalize", "targets": 1},
            {"width": "10%", className: "capitalize", "targets": 2},
            {"width": "20%", className: "capitalize", "targets": 3, "orderable": false}
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
            var switchery = new Switchery(html, {color: '#23C6C8', secondaryColor: '#F8AC59', size: 'small'});
            list_switchery.push(switchery);
        });
    }

    function toggle_category_add() {
        if ($('#add_type').html() > 100) {
            $('#add_type').html('<a href="javascript:void(0);" onclick="toggle_category_add();"><i class="fa fa-close" style="color:1ab394; font-size:30px;></i></a>');
            add_category();
        } else {
            $('#add_type').html('<button type="button" class="btn bg-teal waves-effect" onclick="toggle_category_add();">NEW ITEM TYPE</button>');
            var animation = "fadeOutDown";
            $('#curd-content').addClass('animated');
            $('#curd-content').addClass(animation);
            $('#curd-content').html('');
            $('#curd-content').hide();
        }
    }

    function change_status(cate_id, element) {
        $('#data_loader').addClass('sk-loading');

        var status_type = $(element).prop("checked");
        if (status_type == true)
            status = 1;
        else
            status = -1;
        var ops_url = baseurl + 'category/change_status/';
        $.ajax({
            type: "POST",
            cache: false,
            async: false,
            url: ops_url,
            data: {"load": 1, "cate_id": cate_id, "status": status},
            success: function (result) {
                var data = $.parseJSON(result);
                if (data.status == 1) {
                    if (status == -1) {
                        swal('Category Updated', 'Category Status Deactivated Successfully', 'success');
                        $('#data_loader').removeClass('sk-loading');
                        active_count();
                        return true;
                    } else {
                        if (status == 1) {
                            swal('Category Updated', 'Category Status Activated Successfully', 'success');
                            $('#data_loader').removeClass('sk-loading');
                            active_count();
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
                            window.location.href = baseurl + "category/show-category";
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
                                window.location.href = baseurl + "category/show-category";
                            });
                        } else {
                            swal({
                                title: '',
                                text: 'Categorty Status Updation Failed',
                                type: 'info',
                                showCancelButton: false,
                                confirmButtonColor: '#3085d6',
                                cancelButtonColor: '#d33',
                                confirmButtonText: 'OK'
                            }, function (isConfirm) {
                                window.location.href = baseurl + "category/show-category";
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

        var ops_url = baseurl + 'category/add-category';
        var cate_name = $('#cate_name').val().toUpperCase();
        var cate_description = $('#cate_description').val();
//        alert(cate_description)
//        var currency_name = $("#currency_select").val();
//         if(currency_name == -1){
//           swal('', 'Currency is required.', 'info');
//            $('#data_loader').removeClass('sk-loading');
//            return;
//        }
        if (cate_name == '') {
            swal('', 'Category Name is required.', 'info');
            $('#data_loader').removeClass('sk-loading');
            return false;
        } else if ((cate_name.length > '30') || (cate_name.length < '3')) {
            swal('', 'Category Name should contain letters 3 to 30', 'info');
            $('#data_loader').removeClass('sk-loading');
            return false;
        }
        var alphanumers = /^[a-zA-Z\s]+$/;
        if (!alphanumers.test($("#category_name").val())) {
            swal('', 'Category Name can have only alphabets', 'info');
            $('#data_loader').removeClass('sk-loading');
            return false;
        }
        if (cate_description == '') {
            swal('', 'Category Description is required.', 'info');
            $('#data_loader').removeClass('sk-loading');
            return false;
        } else if ((cate_description.length > '100') || (cate_description.length < '3')) {
            swal('', 'Category Description should contain letters 3 to 15', 'info');
            $('#data_loader').removeClass('sk-loading');
            return false;
        }
        var alphanumers = /^[a-zA-Z]+$/;
        if (!alphanumers.test($("#category_code").val())) {
            swal('', 'Category Description can have only alphabets', 'info');
            $('#data_loader').removeClass('sk-loading');
            return false;
        }



        $.ajax({
            type: "POST",
            cache: false,
            async: false,
            url: ops_url,
            data: $('#category_save').serialize(),
            success: function (result) {
                var data = $.parseJSON(result);
                if (data.status == 1) {
                    active_count();
                    $('#category_save').html('');
                    $('#category_save').html(data.view);
                    var category_data = [];
                    $.ajax({
                        type: "POST",
                        cache: false,
                        async: false,
                        url: baseurl + 'category/show-category/',
                        data: {'load_reset': '1'},
                        success: function (result) {
                            category_data = JSON.parse(result);

                        },
                        error: function () {
                            alert('error');
                        }
                    });
                    var datatable = $('#tbl_category').dataTable().api();
                    datatable.clear();
                    datatable.rows.add(category_data).draw();

                    $('#add_type').show();
                    swal('Success', 'New Category, ' + cate_name + ' created successfully.', 'success');
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

        var ops_url = baseurl + 'category/edit-category';
        var cate_name = $('#cate_name').val().toUpperCase();
        var cate_description = $('#cate_description').val();
//        alert(cate_description)
//        var currency_name = $("#currency_select").val();
//         if(currency_name == -1){
//           swal('', 'Currency is required.', 'info');
//            $('#data_loader').removeClass('sk-loading');
//            return;
//        }
        if (cate_name == '') {
            swal('', 'Category Name is required.', 'info');
            $('#data_loader').removeClass('sk-loading');
            return false;
        } else if ((cate_name.length > '30') || (cate_name.length < '3')) {
            swal('', 'Category Name should contain letters 3 to 30', 'info');
            $('#data_loader').removeClass('sk-loading');
            return false;
        }
        var alphanumers = /^[a-zA-Z\s]+$/;
        if (!alphanumers.test($("#category_name").val())) {
            swal('', 'Category Name can have only alphabets', 'info');
            $('#data_loader').removeClass('sk-loading');
            return false;
        }
        if (cate_description == '') {
            swal('', 'Category Description is required.', 'info');
            $('#data_loader').removeClass('sk-loading');
            return false;
        } else if ((cate_description.length > '100') || (cate_description.length < '3')) {
            swal('', 'Category Description should contain letters 3 to 15', 'info');
            $('#data_loader').removeClass('sk-loading');
            return false;
        }
        var alphanumers = /^[a-zA-Z]+$/;
        if (!alphanumers.test($("#category_code").val())) {
            swal('', 'Category Description can have only alphabets', 'info');
            $('#data_loader').removeClass('sk-loading');
            return false;
        }


        $.ajax({
            type: "POST",
            cache: false,
            async: false,
            url: ops_url,
            data: $('#category_save').serialize(),
            success: function (result) {
                var data = $.parseJSON(result)

                if (data.status == 1) {
                    $('#category_save').html('');
                    $('#category_save').html(data.view);
                    var category_data = [];
                    $.ajax({
                        type: "POST",
                        cache: false,
                        async: false,
                        url: baseurl + 'category/show-category',
                        data: {'load_reset': '1'},
                        success: function (result) {
                            category_data = JSON.parse(result);
                        },
                        error: function () {
                            alert('error');
                        }
                    });
                    var datatable = $('#tbl_category').dataTable().api();
                    datatable.clear();
                    datatable.rows.add(category_data).draw();
                    $('#add_type').show();
                    swal('Success', 'Category ' + cate_name + ' updated successfully.', 'success');
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
        $('#cate_name').val('');
        $('#cate').parent().removeAttr('class', 'has-error');
        $('#cate_description').val('');
        $('#cate_description').parent().removeAttr('class', 'has-error');
//        $('#currency_select').select2('val',-1);
    }

    function edit_category(cate_id, cate_name, cate_description) {
        var ops_url = baseurl + 'category/edit-category';
        $.ajax({
            type: "POST",
            cache: false,
            async: false,
            url: ops_url,
            data: {"load": 1, "cate_id": cate_id, "cate_name": cate_name, "cate_description": cate_description},
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

    function close_add_category() {
        $('#add_type').show();
        $("#curd-content").slideUp("slow", function () {
            $("#curd-content").hide();
        });

    }

//NEW SCRIPT
    function add_new_category() {
        var ops_url = baseurl + 'category/add-category';
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