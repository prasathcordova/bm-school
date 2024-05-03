<div class="wrapper wrapper-content animated fadeInRight" style="padding-top: 1px !important;padding-left: 0px !important;padding-right: 0px !important;">
    <div class="row" style="margin-left: -29px !important; margin-right: -30px !important;">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5><?php echo isset($sub_title) ? $sub_title : "NO TITLE PROVIDED" ?></h5>
                    <div class="ibox-tools" id="add_type">
                        <a data-toggle="modal" class="btn btn-primary btn-xs" data-toggle="tooltip" title="Create Document" data-placement="left" href="javascript:void(0)" onclick="add_new_documents();"><i class="fa fa-plus"></i>Create Document</a>
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
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover dataTables-example" id="tbl_documentshow">

                                    <thead>
                                        <tr>
                                            <th>Sl No.</th>
                                            <th>Document Name</th>
                                            <th>Active</th>
                                            <th>Task</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        if (isset($document_data) && !empty($document_data) && isset($document_data['data'][0])) {
                                            $i = 1;
                                            foreach ($document_data['data'] as $documents) {
                                        ?>
                                                <tr>
                                                    <td> <?php echo $i; ?></td>
                                                    <td> <?php echo $documents['document_Name']; ?></td>
                                                    <td data-toggle="tooltip" title="Slide for Enable/Disable">
                                                        <div class="switch">
                                                            <div class="onoffswitch">
                                                                <?php if ($documents['isactive'] == 1) {
                                                                    $checked = "checked";
                                                                } else {
                                                                    $checked = '';
                                                                } ?>
                                                                <input type="checkbox" <?php echo $checked ?> class="onoffswitch-checkbox pick_status" onchange="change_status('<?php echo $documents['document_id']; ?>',  this)" id="<?php echo $documents['document_id']; ?>">
                                                                <label class="onoffswitch-label" for="<?php echo $documents['document_id']; ?>">
                                                                    <span class="onoffswitch-inner"></span>
                                                                    <span class="onoffswitch-switch"></span>
                                                                </label>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <a href="javascript:void(0);" onclick="edit_documents('<?php echo $documents['document_id']; ?>', '<?php echo $documents['document_Name']; ?>');" data-toggle="tooltip" data-placement="right" title="Edit <?php echo $documents['document_Name']; ?>" data-original-title="<?php echo $documents['document_Name']; ?>"><i class="fa fa-pencil" style="font-size: 24px; color: #23C6C5; margin: 2%; "></i></a>
                                                    </td>
                                                    
                                                </tr>
                                            <?php
                                                $i++;
                                            }
                                        } else { ?>
                                            <tr>
                                                <td colspan="4" class="text-center">No Data Found</td>
                                            </tr>
                                        <?php } ?>

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

    $('#tbl_documentshow tbody').on('click', function(e) {
        activateSwitchery();
    });
    $(document).ready(function() {
        activateSwitchery();
    });

    function activateSwitchery() {
        for (var i = 0; i < list_switchery.length; i++) {
            list_switchery[i].destroy();
            list_switchery[i].switcher.remove();
        }
        var list_checkbox = Array.prototype.slice.call(document.querySelectorAll('.js-switch'));
        list_checkbox.forEach(function(html) {
            var switchery = new Switchery(html, {
                color: '#23C6C8',
                secondaryColor: '#F8AC59',
                size: 'small'
            });
            list_switchery.push(switchery);
        });
    }


    function change_status(document_id, element) {
        $('#faculty_loader').addClass('sk-loading');

        var status_type = $(element).prop("checked");
        if (status_type == true)
            status = 1;
        else
            status = -1;
        var ops_url = baseurl + 'online-registration/document-change-status';
        $.ajax({
            type: "POST",
            cache: false,
            async: false,
            url: ops_url,
            data: {
                "load": 1,
                "document_id": document_id,
                "status": status
            },
            success: function(result) {
                var data = $.parseJSON(result);
                if (data.status == 1) {
                    if (status == -1) {
                        swal('Document Updated', 'Document deactivated successfully.', 'success');
                        $('#faculty_loader').removeClass('sk-loading');
                        return true;
                    } else {
                        if (status == 1) {
                            swal('Document Updated', 'Document activated successfully.', 'success');
                            $('#faculty_loader').removeClass('sk-loading');
                            return true;
                        }
                    }
                }
            }
        });
    }

    function change_status_required(document_id, element) {
        $('#faculty_loader').addClass('sk-loading');

        var status_type = $(element).prop("checked");
        if (status_type == true)
            status = 1;
        else
            status = -1;
        var ops_url = baseurl + 'online-registration/document-change-isrequired';
        $.ajax({
            type: "POST",
            cache: false,
            async: false,
            url: ops_url,
            data: {
                "load": 1,
                "document_id": document_id,
                "isrequired": status
            },
            success: function(result) {
                var data = $.parseJSON(result);
                if (data.status == 1) {
                    if (status == -1) {
                        swal('Document Updated', 'Document deactivated successfully.', 'success');
                        $('#faculty_loader').removeClass('sk-loading');
                        return true;
                    } else {
                        if (status == 1) {
                            swal('Document Updated', 'Document activated successfully.', 'success');
                            $('#faculty_loader').removeClass('sk-loading');
                            return true;
                        }
                    }
                } else {
                    $('#faculty_loader').removeClass('sk-loading');
                    if (data.status == 0) {
                        swal({
                            title: '',
                            text: data.message,
                            type: 'info',
                            showCancelButton: false,
                            confirmButtonColor: '#3085d6',
                            cancelButtonColor: '#d33',
                            confirmButtonText: 'OK'
                        }, function(isConfirm) {
                            // window.location.href = baseurl + "course/show-course";
                            //  $('#curd-content').show();
                            load_batch();
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
                            }, function(isConfirm) {
                                //                                window.location.href = baseurl + "course/show-course";
                                load_batch();
                            });
                        } else {
                            if (data.status == 2) {
                                swal({
                                    title: '',
                                    text: data.message,
                                    type: 'info',
                                    showCancelButton: false,
                                    confirmButtonColor: '#3085d6',
                                    cancelButtonColor: '#d33',
                                    confirmButtonText: 'OK'
                                }, function(isConfirm) {
                                    //                                    window.location.href = baseurl + "course/show-course";

                                    load_batch();
                                });
                            }
                        }
                    }
                }
            }
        });
    }



    function refresh_add_panel() {
        $('#acdyr_select').select2('val', -1);
        $('#class_select').select2('val', -1);
        $('#stream_select').select2('val', -1);
        $('#session_select').select2('val', -1);
        $('#medium_select').select2('val', -1);


        $('#division').val('');
        $('#division').parent().removeAttr('batch', 'has-error');
        $('#Batch_Name').val('');
        $('#Batch_Name').parent().removeAttr('batch', 'has-error');

        $('#Girls').val('');
        $('#Girls').parent().removeAttr('batch', 'has-error');
        $('#Boys').val('');
        $('#Boys').parent().removeAttr('batch', 'has-error');
        $('#strength').val('0');
    }

    function submit_data() {
        $('#faculty_loader').addClass('sk-loading');

        var ops_url = baseurl + 'online-registration/add-needed-documents';
        var document_name = $('#document_name').val().toUpperCase();
        if (document_name == '') {
            swal('', 'Document Name is required.', 'info');
            $('#faculty_loader').removeClass('sk-loading');
            return false;
        } else if ((document_name.length > '30') || (document_name.length < '3')) {
            swal('', 'Document Name should contain 3 to 30 Characters', 'info');
            $('#faculty_loader').removeClass('sk-loading');
            return false;
        }
        var alphanumers = /^[a-zA-Z\s]+$/;
        if (!alphanumers.test($("#document_name").val())) {
            swal('', 'Document Name can have only alphabets', 'info');
            $('#faculty_loader').removeClass('sk-loading');
            return false;
        }

        $.ajax({
            type: "POST",
            cache: false,
            async: false,
            url: ops_url,
            data: $('#document_save').serialize(),
            success: function(result) {
                var data = $.parseJSON(result);
                if (data.status == 1) {
                    $('#document_save').html('');
                    $('#document_save').html(data.view);
                    load_needed_documents();

                    $('#add_type').show();
                    swal('Success', 'New Document, ' + document_name + ' created successfully.', 'success');
                    $("#curd-content").slideUp("slow", function() {
                        $("#curd-content").hide();
                    });
                    $('#faculty_loader').removeClass('sk-loading');

                } else if (data.status == 2) {
                    /* $('#curd-content').html('');
                    $('#curd-content').html(data.view); */
                    swal('', data.message, 'warning');
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
    function edit_submit_data() {
        $('#faculty_loader').addClass('sk-loading');

        var ops_url = baseurl + 'online-registration/edit-needed-documents';
        var document_name = $('#document_name').val().toUpperCase();
        if (document_name == '') {
            swal('', 'Document Name is required.', 'info');
            $('#faculty_loader').removeClass('sk-loading');
            return false;
        } else if ((document_name.length > '30') || (document_name.length < '3')) {
            swal('', 'Document Name should contain 3 to 30 Characters', 'info');
            $('#faculty_loader').removeClass('sk-loading');
            return false;
        }
        var alphanumers = /^[a-zA-Z\s]+$/;
        if (!alphanumers.test($("#document_name").val())) {
            swal('', 'Document Name can have only alphabets', 'info');
            $('#faculty_loader').removeClass('sk-loading');
            return false;
        }

        $.ajax({
            type: "POST",
            cache: false,
            async: false,
            url: ops_url,
            data: $('#document_save').serialize(),
            success: function(result) {
                var data = $.parseJSON(result);
                if (data.status == 1) {
                    $('#document_save').html('');
                    $('#document_save').html(data.view);
                    load_needed_documents();

                    $('#add_type').show();
                    swal('Success', 'Update Document, ' + document_name + ' updated successfully.', 'success');
                    $("#curd-content").slideUp("slow", function() {
                        $("#curd-content").hide();
                    });
                    $('#faculty_loader').removeClass('sk-loading');

                } else if (data.status == 2) {
                    /* $('#curd-content').html('');
                    $('#curd-content').html(data.view); */
                    swal('', data.message, 'warning');
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



    function close_add_document() {
        $('#add_type').show();
        $("#curd-content").slideUp("slow", function() {
            $("#curd-content").hide();
        });

    }

    //NEW SCRIPT
    function add_new_documents() {
        var ops_url = baseurl + 'online-registration/add-needed-documents';
        $.ajax({
            type: "POST",
            cache: false,
            async: false,
            url: ops_url,
            data: {
                "load": 1
            },
            success: function(data) {
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
    function edit_documents(document_id,document_name) {
        var ops_url = baseurl + 'online-registration/edit-needed-documents';
        $.ajax({
            type: "POST",
            cache: false,
            async: false,
            url: ops_url,
            data: {
                "load": 1,
                "document_id" : document_id,
                "document_name" : document_name
            },
            success: function(data) {
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