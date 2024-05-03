<div class="wrapper wrapper-content animated fadeInRight" style="padding-top: 1px !important;padding-left: 0px !important;padding-right: 0px !important;">
    <div class="row" style="margin-left: -29px !important; margin-right: -30px !important;">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title" style="border-bottom-color:#ffd300 !important;">
                    <h5><?php echo isset($sub_title) ? $sub_title : "NO TITLE PROVIDED" ?></h5>
                    <div class="ibox-tools" id="add_type">
                        <a data-toggle="modal" class="btn btn-primary btn-xs" data-toggle="tooltip" title="Add new fee template" data-placement="left" href="javascript:void(0)" onclick="add_new_template();"><i class="fa fa-plus"></i> ADD FEE TEMPLATE</a>
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
                    <div class="wrapper wrapper-content animated fadeInRight" id="student-data-container">
                        <div class="row" id="data-view-feecode">
                            <div class="col-lg-12 col-md-12">
                                <div id="curd-content" style="display: none;"></div>
                            </div>
                            <div class="col-lg-12 col-md-12 col-xs-12 col-sm-12">
                                <table class="table table-striped table-bordered table-hover dataTables-example" id="fee_template_table" style="width: 100%">
                                    <thead>
                                        <tr>
                                            <th>Template Name</th>
                                            <th>Template Description</th>
                                            <th>Is Students Linked ?</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        if (isset($template_data) && !empty($template_data)) {
                                            foreach ($template_data as $template) {
                                        ?>
                                                <tr>
                                                    <td title="<?php echo $template['template_name']; ?>"><?php echo $template['template_name']; ?></td>
                                                    <td title="<?php echo $template['template_desc']; ?>"><?php echo $template['template_desc']; ?></td>
                                                    <td><?php echo $template['is_student_linked'] == 1 ? 'Students Linked' : 'No Students Linked'; ?></td>
                                                    <td>
                                                        <?php if ($template['createdby'] != 0) { ?>
                                                            <a href="javascript:void(0)" onclick="edit_fee_template('<?php echo $template['id']; ?>', '<?php echo $template['template_name'] ?>');" data-toggle="tooltip" data-placement="right" title="Edit <?php echo $template['template_name']; ?>" data-original-title=""><i class="fa fa-pencil" style="font-size: 20px; color: #23C6C8; margin: 2%; "></i></a>
                                                            <a href="javascript:void(0)" onclick="delete_template('<?php echo $template['id']; ?>', '<?php echo $template['template_name'] ?>', '<?php echo $template['is_student_linked'] ?>');" data-toggle="tooltip" data-placement="right" title="Remove <?php echo $template['template_name']; ?>" data-original-title=""><i class="fa fa-times text-danger" style="font-size: 20px; margin: 2%; "></i></a>
                                                        <?php } ?>
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
    var table = $('#fee_template_table').dataTable({
        columnDefs: [{
                "width": "25%",
                "targets": 0
            },
            {
                "width": "30%",
                "targets": 1
            },
            {
                "width": "25%",
                "targets": 2
            },
            {
                "width": "20%",
                "targets": 3
            },
        ],
        "order": [
            [0, "asc"]
        ],
        responsive: false,
        iDisplayLength: 100,
        "ordering": true,
        dom: '<"html5buttons"B>lTfgitp',
        buttons: [],
    });

    function load_fee_template_on_show() {
        var ops_url = baseurl + 'fees/show-fees-template/';
        $.ajax({
            type: "POST",
            cache: false,
            async: false,
            url: ops_url,
            data: {
                "load": 1
            },
            success: function(result) {
                $('#data-view').html(result);
            }
        });

    }

    function add_new_template() {
        var ops_url = baseurl + 'fees/add-fees-template/';
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
                    swal('', 'No data available.', 'info');
                    return false;
                }
            }
        });
    }

    function submit_data() {
        $('#faculty_loader').addClass('sk-loading');

        var ops_url = baseurl + 'fees/save-new-fees-template/';
        var template_name = $('#template_name').val();

        if (template_name == '') {
            swal('', 'Template Name is required.', 'info');
            $('#faculty_loader').removeClass('sk-loading');
            return false;
        } else if ((template_name.length > '40') || (template_name.length < '2')) { //changed 30 to 25 -> SALAHUDHEEN May 29,2019
            swal('', 'Template Name should contain 2 to 40 characters.', 'info');
            $('#faculty_loader').removeClass('sk-loading');
            return false;
        }
        //Commented by SALAHUDHEEN JUne 1, 2019
        //        else if ((template_name.length > '10') || (template_name.length < '2')) { //changed 30 to 10 -> SALAHUDHEEN May 29,2019
        //            swal('', 'Template name should contain letters or numbers 2 to 10.', 'info');
        //            $('#faculty_loader').removeClass('sk-loading');
        //            return false;
        //        }
        //        var alphanumers = /^[a-zA-Z\s0-9-/]+$/;
        //        if (!alphanumers.test($("#template_name").val())) {
        //            swal('', 'Template can have only alphabets or numbers.', 'info');
        //            $('#faculty_loader').removeClass('sk-loading');
        //            return false;
        //        }
        //Commented by SALAHUDHEEN JUne 1, 2019

        var description = $('#template_desc').val();

        if (description == '') {
            swal('', 'Template Description is required.', 'info');
            $('#faculty_loader').removeClass('sk-loading');
            return false; //(description.length > '25') || 
        } else if ((description.length < '2')) { //changed 30 to 25 -> SALAHUDHEEN May 29,2019
            swal('', 'Template Description should contain atleast 2 characters', 'info');
            $('#faculty_loader').removeClass('sk-loading');
            return false;
        }
        //        var alphanumers = /^[a-zA-Z\s0-9]+$/;
        //        if (!alphanumers.test($("#template_desc").val())) {
        //            swal('', 'Template description can have only alphabets or numbers.', 'info');
        //            $('#faculty_loader').removeClass('sk-loading');
        //            return false;
        //        }

        if ($('#class_selector').val().length == 0 || $('#class_selector').val().length < 0) {
            swal('', 'Select a class', 'info');
            $('#faculty_loader').removeClass('sk-loading');
            return false;
        }
        var class_selects = $('#class_selector').val();

        $.ajax({
            type: "POST",
            cache: false,
            async: false,
            url: ops_url,
            data: {
                "template_name": template_name,
                "template_desc": description,
                "classes": class_selects
            },
            success: function(result) {
                var data = $.parseJSON(result);
                if (data.status == 1) {
                    load_fee_template_on_show();
                    swal('Success.', 'New Fee Template, ' + template_name + ' created successfully.', 'success');
                    $('#faculty_loader').removeClass('sk-loading');
                    $("#curd-content").slideUp("slow", function() {
                        $("#curd-content").hide();
                        $('#add_type').show();
                    });
                } else if (data.status == 2) {
                    $('#faculty_loader').removeClass('sk-loading');
                    $('#curd-content').html('');
                    $('#curd-content').html(data.view);
                    swal('', data.message, 'info');
                    $('#faculty_loader').removeClass('sk-loading');
                    add_new_template();
                } else if (data.status == 3) {
                    $('#curd-content').html('');
                    $('#curd-content').html(data.view);
                    swal('', data.message, 'info');
                    $('#faculty_loader').removeClass('sk-loading');
                    add_new_template();
                } else {
                    swal('', 'Connection Error. Please contact administrator', 'info');
                    $('#faculty_loader').removeClass('sk-loading');
                }
                //load_fee_template_on_show();

            }
        });
        $('#faculty_loader').removeClass('sk-loading');
    }

    function edit_fee_template(fee_template_id, template_name) {
        var title_data = $('#title_data').val();
        var ops_url = baseurl + 'fees/edit-fees-template/';
        $.ajax({
            type: "POST",
            cache: false,
            async: false,
            url: ops_url,
            data: {
                "load": 1,
                "template_id": fee_template_id,
                "template_name": template_name,
                'title_data': title_data
            },
            success: function(result) {
                var data = JSON.parse(result);
                if (data.status == 1) {
                    $('#curd-content').html(data.view);
                    var animation = "fadeInDown";
                    $('#search-feecode').hide();
                    $("#curd-content").show();
                    $('#curd-content').addClass('animated');
                    $('#curd-content').addClass(animation);
                    $('#add_type').hide();
                    $(window).scrollTop(0);
                } else {
                    swal('', 'No data available associated with this Fee Template', 'info');
                    return false;
                }
            }
        });
    }

    function submit_edit_data() {
        $('#faculty_loader').addClass('sk-loading');

        var ops_url = baseurl + 'fees/save-edit-fees-template/';
        var template_name = $('#template_name').val();
        var template_name_actual = $('#template_name_actual').val();

        if (template_name == '') {
            swal('', 'Template Name is required.', 'info');
            $('#faculty_loader').removeClass('sk-loading');
            return false;
        } else if ((template_name.length > '40') || (template_name.length < '2')) {
            swal('', 'Template Name should contain 2 to 40 characters', 'info');
            $('#faculty_loader').removeClass('sk-loading');
            return false;
        }
        //        var alphanumers = /^[a-zA-Z\s0-9]+$/;
        //        if (!alphanumers.test($("#template_name").val())) {
        //            swal('', 'Template can have only alphabets or numbers.', 'info');
        //            $('#faculty_loader').removeClass('sk-loading');
        //            return false;
        //        }
        //        
        //        Commented by SALAHUDHEEN June 1, 2019

        var description = $('#template_desc').val();

        if (description == '') {
            swal('', 'Template Description is required.', 'info');
            $('#faculty_loader').removeClass('sk-loading');
            return false;
        } else if ((description.length < '2')) { //changed 30 to 25 -> SALAHUDHEEN May 29,2019
            swal('', 'Template Description should contain atleast two characters.', 'info');
            $('#faculty_loader').removeClass('sk-loading');
            return false;
        }
        //        var alphanumers = /^[a-zA-Z\s0-9]+$/;
        //        if (!alphanumers.test($("#template_desc").val())) {
        //            swal('', 'Template description can have only alphabets or numbers.', 'info');
        //            $('#faculty_loader').removeClass('sk-loading');
        //            return false;
        //        }

        if ($('#class_selector').val().length == 0 || $('#class_selector').val().length < 0) {
            swal('', 'Select a Class', 'info');
            $('#faculty_loader').removeClass('sk-loading');
            return false;
        }
        var class_selects = $('#class_selector').val();
        var current_classes = $('#current_classes').val();
        var template_id = $('#template_id').val();
        var title_data = $('#title_data').val();
        // alert(current_classes);
        // alert(class_selects);

        $.ajax({
            type: "POST",
            cache: false,
            async: false,
            url: ops_url,
            data: {
                "template_name": template_name,
                "template_desc": description,
                "classes": class_selects,
                "current_classes": current_classes,
                "template_id": template_id,
                "title_data": title_data
            },
            success: function(result) {
                var data = $.parseJSON(result);
                if (data.status == 1) {
                    load_fee_template_on_show();
                    swal('Success.', 'Fee Template, ' + template_name + ' updated successfully.', 'success');
                    $('#faculty_loader').removeClass('sk-loading');
                    $("#curd-content").slideUp("slow", function() {
                        $("#curd-content").hide();
                        $('#add_type').show();
                    });
                } else if (data.status == 2) {
                    $('#faculty_loader').removeClass('sk-loading');
                    $('#curd-content').html('');
                    //$('#curd-content').html(data.view);
                    swal('', data.message, 'info');
                    $('#faculty_loader').removeClass('sk-loading');
                    edit_fee_template(template_id, template_name_actual);

                    // $('#curd-content').html(data.view);
                    // swal('', data.message, 'info');
                    // $('#faculty_loader').removeClass('sk-loading');
                    // edit_fee_template(template_id, template_name_actual);

                } else if (data.status == 3) {
                    $('#curd-content').html('');
                    //$('#curd-content').html(data.view);
                    swal('', data.message, 'info');
                    $('#faculty_loader').removeClass('sk-loading');
                    edit_fee_template(template_id, template_name_actual);
                } else {
                    swal('', 'Connection Error. Please contact administrator', 'info');
                    $('#faculty_loader').removeClass('sk-loading');
                }

            }
        });
        $('#faculty_loader').removeClass('sk-loading');
    }

    function delete_template(template_id, template_name, is_student_linked) {
        if (is_student_linked == 1) {
            swal({
                title: template_name,
                text: 'This Fee Template cannot be deleted as it is linked with student',
                type: "info"
            });
        } else {
            var ops_url = baseurl + 'fees/delete-fees-template/';
            swal({
                title: "Are you sure?",
                text: 'Once deleted you will not be able to recover the template "' + template_name + '"',
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "Yes",
                closeOnConfirm: false
            }, function(isconfirm) {
                if (isconfirm) {
                    $('#faculty_loader').addClass('sk-loading');
                    $.ajax({
                        type: "POST",
                        cache: false,
                        async: false,
                        url: ops_url,
                        data: {
                            "load": 1,
                            "template_id": template_id
                        },
                        success: function(result) {
                            var data = $.parseJSON(result);
                            if (data.status == 1) {
                                load_fee_template_on_show();
                                swal('Success.', 'Fee Template, ' + template_name + ' deleted successfully.', 'success');
                                $('#faculty_loader').removeClass('sk-loading');
                            } else {
                                if (data.message) {
                                    $('#faculty_loader').removeClass('sk-loading');
                                    swal('', data.message, 'info');
                                    $('#faculty_loader').removeClass('sk-loading');
                                } else {
                                    $('#faculty_loader').removeClass('sk-loading');
                                    swal('', 'An error encountered. Please try again later.', 'info');
                                    $('#faculty_loader').removeClass('sk-loading');
                                }
                            }
                        }
                    });
                }
            });
        }
    }
</script>