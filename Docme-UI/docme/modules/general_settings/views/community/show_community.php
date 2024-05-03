
<div class="wrapper wrapper-content animated fadeInRight" style="padding-top: 1px !important;padding-left: 0px !important;padding-right: 0px !important;">
    <div class="row" style="margin-left: -29px !important; margin-right: -30px !important;">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                 <div class="ibox-title" style="border-bottom-color:#ffd300 !important;">
                    <h5><?php echo isset($sub_title) ? $sub_title : "NO TITLE PROVIDED" ?></h5>
                    <div class="ibox-tools" id="add_type">
                        <a data-toggle="modal" class="btn btn-primary btn-xs" data-toggle="tooltip" title="Add a Community" data-placement="left"href="javascript:void(0)" onclick="add_new_community();"><i class="fa fa-plus"></i>ADD COMMUNITY</a>
                    </div>
                </div>
                
               
                <div class="ibox-content"  id ="faculty_loader">

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
                                <table class="table table-striped table-bordered table-hover dataTables-example" id="tbl_community" >

                                    <thead>
                                        <tr>
                                            <th>Community Name</th>
                                            <th>Status</th>                                
                                            <th>Task</th>                                
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        if (isset($community_data) && !empty($community_data) && is_array($community_data)) {
                                            foreach ($community_data as $community) {
                                                ?>
                                                <tr>
                                                    <td> <?php echo $community['community_name']; ?></td>

                                                    <td data-toggle="tooltip" title="Slide for Enable/Disable">
                                                    <div class="switch">
                                                        <div class="onoffswitch">
                                                            <?php if ($community['isactive'] == 1) {
                                                                        $checked = "checked";
                                                                    } else {
                                                                        $checked = '';
                                                                    } ?>
                                                            <input type="checkbox" <?php echo $checked ?> class="onoffswitch-checkbox pick_status" 
                                                            onchange="change_status('<?php echo $community['community_id']; ?>',  this)" 
                                                            id="<?php echo $community['community_id']; ?>">
                                                            <label class="onoffswitch-label" for="<?php echo $community['community_id']; ?>">
                                                                <span class="onoffswitch-inner"></span>
                                                                <span class="onoffswitch-switch"></span>
                                                            </label>
                                                        </div>
                                                    </div>

                                                        <?php if ($community['isactive'] == 1) { ?>                  
                                                            <!-- <input type="checkbox"  class="js-switch" data-toggle="tooltip" title="Slide for Enable/Disable" onchange="change_status('<?php echo $community['community_id'] ?>', this)" checked  id="t1" />                                                         -->

                                                        <?php } else {
                                                            ?>
                                                                      
                                                            <!-- <input type="checkbox"  title="Slide for Enable/Disable" onchange="change_status('<?php echo $community['community_id'] ?>', this)"  id="" class="js-switch"  />                                                                                                             -->
                                                        <?php }
                                                        ?>
                                                    </td>
                                                    <td>   

                                                        <a href="javascript:void(0)" class="btn btn-xs btn-info" onclick="edit_community('<?php echo $community['community_id']; ?>', '<?php echo $community['community_name']; ?>');"  data-toggle="tooltip" data-placement="right" title="Edit <?php echo $community['community_name']; ?>" data-original-title="<?php echo $community['community_name']; ?>"  ><i class="fa fa-edit" ></i>Update</a>
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
    $('#tbl_community').dataTable({
        columnDefs: [
            {"width": "50%", className: "capitalize", "targets": 0},
            {"width": "25%", className: "capitalize", "targets": 1,"orderable": false},
            {"width": "25%", className: "capitalize", "targets": 2, "orderable": false},
        ],
        responsive: true,
        dom: '<"html5buttons"B>lTfgitp',
        buttons: [
            {extend: 'copy'},
            {extend: 'csv',exportOptions: {
                columns: [0]
            }},
            {extend: 'excel', title: 'Report',exportOptions: {
                columns: [0]
            }}
        ],
        "fnDrawCallback": function (ele) {
            activateSwitchery();

        }

    });
    $('#tbl_community tbody').on('click', function (e) {
        activateSwitchery()
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
//        var switchery = new Switchery(html, {color: '#a9318a', size: 'small'});
            list_switchery.push(switchery);
        });
    }

    function toggle_community_add() {
        if ($('#add_type').html() > 100) {
            $('#add_type').html('<a href="javascript:void(0)" onclick="toggle_subject_add();"><i class="fa fa-close" style="color:1ab394; font-size:30px;></i></a>');
            add_community();
        } else {
            $('#add_type').html('<button type="button" class="btn bg-teal waves-effect" onclick="toggle_community_add();">NEW COMMUNITY</button>');
            var animation = "fadeOutDown";
            $('#curd-content').addClass('animated');
            $('#curd-content').addClass(animation);
            $('#curd-content').html('');
            $('#curd-content').hide();
        }
    }

    function change_status(communityid, element) {
        $('#faculty_loader').addClass('sk-loading');
        var status_type = $(element).prop("checked");
        if (status_type == true)
            status = 1;
        else
            status = -1;
        var ops_url = baseurl + 'community/change_status/';
        $.ajax({
            type: "POST",
            cache: false,
            async: false,
            url: ops_url,
            data: {"load": 1, "community_id": communityid, "status": status},
            success: function (result) {
                var data = $.parseJSON(result);

                if (data.status == 1) {
                    if (status == -1) {
                        swal('Community Updated', 'Community Status Deactivated Successfully', 'success');
                        $('#faculty_loader').removeClass('sk-loading');
                           gs_count();  
                        return true;
                    } else {
                        if (status == 1) {
                            swal('Community Updated', 'Community Status Activated Successfully', 'success');
                            $('#faculty_loader').removeClass('sk-loading');
                               gs_count();  
                            return true;
                        }
                    }
                } else {
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
                            load_community();
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
                                load_community();
                            });
                        } else {
                            swal({
                                title: '',
                                text: 'Community Status Updation Failed',
                                type: 'info',
                                showCancelButton: false,
                                confirmButtonColor: '#3085d6',
                                cancelButtonColor: '#d33',
                                confirmButtonText: 'OK'
                            }, function (isConfirm) {
                                load_community();
                            });
                        }

                    }
                }
            }
        });
    }
    // $('.js-switch').change(function (e) {

    // });


    // $(".js-switch").click(function () {
    // });

    function add_new_community() {
        var ops_url = baseurl + 'community/add-community/';
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
        var ops_url = baseurl + 'community/add-community/';
        var community_name = $('#community_name').val().toUpperCase();
        if (community_name == '') {
            swal('', 'Community Name is required.', 'info');
            $('#faculty_loader').removeClass('sk-loading');
            return false;
        } else if (community_name.length > '30' || community_name.length < '2') {
            swal('', 'Community Name should contain minimum 2 and maximum 30', 'info');
            $('#faculty_loader').removeClass('sk-loading');
            return false;
        }

        var alphanumers = /^[a-zA-Z\/s ]+$/;
        if (!alphanumers.test($("#community_name").val())) {
            swal('', 'Community Name can have only alphabets', 'info');
            $('#faculty_loader').removeClass('sk-loading');
            return false;
        }

        $.ajax({
            type: "POST",
            cache: false,
            async: false,
            url: ops_url,
            data: $('#community_save').serialize(),
            success: function (result) {
                var data = $.parseJSON(result)
                if (data.status == 1) {
                    gs_count();  
                    $('#community_save').html('');
                    $('#community_save').html(data.view);
                    var community_data = [];
                    $.ajax({
                        type: "POST",
                        cache: false,
                        async: false,
                        url: baseurl + 'community/show-community/',
                        data: {'load_reset': '1'},
                        success: function (result) {
                            community_data = JSON.parse(result);
                        },
                        error: function () {
                            alert('error');
                        }
                    });
                    var datatable = $('#tbl_community').dataTable().api();
                    datatable.clear();
                    datatable.rows.add(community_data).draw();

                    $('#add_type').show();
                    swal('Success', 'New Community ' + community_name + ' created successfully.', 'success');
                     $('#faculty_loader').removeClass('sk-loading');
                    $("#curd-content").slideUp("slow", function () {
                        $("#curd-content").hide();
                    });
                    load_community();
                } else if (data.status == 2) {
                    $('#curd-content').html('');
                    $('#curd-content').html(data.view);
                    swal('', 'Community name already exists', 'info');
                    $('#faculty_loader').removeClass('sk-loading');
                } else if (data.status == 3) {
                    $('#curd-content').html('');
                    $('#curd-content').html(data.view);
                    //activate_toast(data.message, 'Error', 'error');
                    swal('', data.message, 'info');
                    $('#faculty_loader').removeClass('sk-loading');
                } else {
                    swal('', 'Connection Error. Please contact administrator', 'info');
                    $('#faculty_loader').removeClass('sk-loading');
                }

            }
        });
    }

    function submit_edit_save_data() {
        $('#faculty_loader').addClass('sk-loading');
        
        var ops_url = baseurl + 'community/edit-community';
        var community_name = $('#community_name').val().toUpperCase();

        if (community_name == '') {
            swal('', 'Community Name Required', 'info');
            $('#faculty_loader').removeClass('sk-loading');
            return false;
        } else if (community_name.length > '30' || community_name.length < '2') {
            swal('', 'Community Name should contain minimum 2 and maximum 30', 'info');
            $('#faculty_loader').removeClass('sk-loading');
            return false;
        }

        var alphanumers = /^[a-zA-Z\/s ]+$/;
        if (!alphanumers.test($("#community_name").val())) {
            swal('', 'Community Name can have only alphabets', 'info');
            $('#faculty_loader').removeClass('sk-loading');
            return false;
        }
        $.ajax({
            type: "POST",
            cache: false,
            async: false,
            url: ops_url,
            data: $('#community_save').serialize(),
            success: function (result) {
                var data = $.parseJSON(result)
                if (data.status == 1) {                   
                    $('#community_save').html('');
                    $('#community_save').html(data.view);
                    var community_data = [];
                    $.ajax({
                        type: "POST",
                        cache: false,
                        async: false,
                        url: baseurl + 'community/show-community',
                        data: {'load_reset': '1'},
                        success: function (result) {
                            community_data = JSON.parse(result);
                        },
                        error: function () {
                            alert('error');
                        }
                    });
                    var datatable = $('#tbl_community').dataTable().api();
                    datatable.clear();
                    datatable.rows.add(community_data).draw();
                    $('#add_type').show();
                    swal('Success', 'Community ' + community_name + ' updated successfully.', 'success');
                    $('#faculty_loader').removeClass('sk-loading');
                    $("#curd-content").slideUp("slow", function () {
                        $("#curd-content").hide();
                    });               
                    load_community();
                } else if (data.status == 2) {
                    $('#curd-content').html('');
                    $('#curd-content').html(data.view);
                    swal('', 'Community Already Exists', 'info');
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
    
    function refresh_add_panel() {
        $('#community_name').val('');
        $('#community_name').parent().removeAttr('class', 'has-error');
    }


    function close_add_community() {
        $('#add_type').show();
        $("#curd-content").slideUp("slow", function () {
            $("#curd-content").hide();
        });
    }

    function edit_community(communityid, name) {
        var ops_url = baseurl + 'community/edit-community/';
        $.ajax({
            type: "POST",
            cache: false,
            async: false,
            url: ops_url,
            data: {"load": 1, "community_id": communityid, "community_name": name},
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

</script>