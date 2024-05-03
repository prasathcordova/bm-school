<div class="wrapper wrapper-content animated fadeInRight" style="padding-top: 1px !important;padding-left: 0px !important;padding-right: 0px !important;">
    <div class="row" style="margin-left: -29px !important; margin-right: -30px !important;">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5><?php echo isset($sub_title) ? $sub_title : "NO TITLE PROVIDED" ?></h5>
                    <div class="ibox-tools" id="add_type">
                        <a data-toggle="modal" class="btn btn-primary btn-xs" data-toggle="tooltip" title="Add a Batch" data-placement="left" href="javascript:void(0)" onclick="add_new_batch();"><i class="fa fa-plus"></i>CREATE BATCH</a>
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
                                <table class="table table-striped table-bordered table-hover dataTables-example" id="tbl_batchshow">

                                    <thead>
                                        <tr>
                                            <th>Academic Year</th>
                                            <th>Class</th>
                                            <th>Batch Name</th>
                                            <th>Strength</th>
                                            <th>Boys</th>
                                            <th>Girls</th>
                                            <th>Active</th>
                                            <th>Task</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        //dev_export($batch_data);
                                        if (isset($batch_data) && !empty($batch_data) && is_array($batch_data)) {
                                            foreach ($batch_data as $batch) {
                                                //                                                dev_export($batch);die;
                                        ?>
                                                <tr>
                                                    <td> <?php echo $batch['academic_year']; ?></td>
                                                    <td> <?php echo $batch['Class']; ?>(<?php echo $batch['batch_code']; ?>)</td>
                                                    <td> <?php echo $batch['Batch_Name']; ?></td>
                                                    <td> <?php echo $batch['strength']; ?></td>
                                                    <td> <?php echo $batch['Boys']; ?></td>
                                                    <td> <?php echo $batch['Girls']; ?></td>


                                                    <td data-toggle="tooltip" title="Slide for Enable/Disable">
                                                        <div class="switch">
                                                            <div class="onoffswitch">
                                                                <?php if ($batch['isactive'] == 1) {
                                                                    $checked = "checked";
                                                                } else {
                                                                    $checked = '';
                                                                } ?>
                                                                <input type="checkbox" <?php echo $checked ?> class="onoffswitch-checkbox pick_status" onchange="change_status('<?php echo $batch['BatchID']; ?>',  this)" id="<?php echo $batch['BatchID']; ?>">
                                                                <label class="onoffswitch-label" for="<?php echo $batch['BatchID']; ?>">
                                                                    <span class="onoffswitch-inner"></span>
                                                                    <span class="onoffswitch-switch"></span>
                                                                </label>
                                                            </div>
                                                        </div>

                                                        <?php if ($batch['isactive'] == 1) { ?>
                                                            <!-- <input type="checkbox" class="js-switch" data-toggle="tooltip" title="Slide for Enable/Disable" onchange="change_status('<?php echo $batch['BatchID'] ?>', this)" checked id="t1" /> -->

                                                        <?php } else {
                                                        ?>
                                                            <!-- <input type="checkbox" title="Slide for Enable/Disable" onchange="change_status('<?php echo $batch['BatchID'] ?>', this)" id="" class="js-switch" /> -->

                                                        <?php }
                                                        ?>
                                                    </td>
                                                    <td>
                                                        <a href="javascript:void(0);" class="btn btn-xs btn-info" onclick="edit_batch('<?php echo $batch['BatchID']; ?>', '<?php echo $batch['academic_year']; ?>', '<?php echo $batch['Class']; ?>', '<?php echo $batch['Batch_Name']; ?>', '<?php echo $batch['Boys']; ?>', '<?php echo $batch['Girls']; ?>', '<?php echo $batch['strength']; ?>');" data-toggle="tooltip" data-placement="right" title="Update <?php echo $batch['Batch_Name']; ?>" data-original-title="<?php echo $batch['class']; ?>"><i class="fa fa-edit"></i>Update</a>
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

    $('#tbl_batchshow tbody').on('click', function(e) {
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

    function change_status(BatchID, element) {
        $('#faculty_loader').addClass('sk-loading');

        var status_type = $(element).prop("checked");
        if (status_type == true)
            status = 1;
        else
            status = -1;
        var ops_url = baseurl + 'batch/change_status/';
        $.ajax({
            type: "POST",
            cache: false,
            async: false,
            url: ops_url,
            data: {
                "load": 1,
                "BatchID": BatchID,
                "status": status
            },
            success: function(result) {
                var data = $.parseJSON(result);
                if (data.status == 1) {
                    if (status == -1) {
                        swal('Batch Updated', 'Batch Status Deactivated Successfully', 'success');
                        $('#faculty_loader').removeClass('sk-loading');
                        return true;
                    } else {
                        if (status == 1) {
                            swal('Batch Updated', 'Batch Status Activated Successfully', 'success');
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
                            } else {
                                swal({
                                    title: '',
                                    text: 'Batch Status Updation Failed',
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

    // $('.js-switch').change(function(e) {

    // });


    // $(".js-switch").click(function() {});

    function submit_data() {
        $('#faculty_loader').addClass('sk-loading');
        $('#division').css("border-color", "#ccc");
        var ops_url = baseurl + 'batch/add-batch/';
        var Boys = $('#Boys').val().trim();
        var Girls = $('#Girls').val().trim();
        var division = $("#division").val().trim();
        var strength = $("#strength").val().trim();
        var classs = $("#class_select :selected").text().trim();
        var divisn = $("#division").val().trim();
        var batch_code = $("#batch_code").val().trim();
        //         var stream = $("#stream_select :selected").data('streamselect');
        //          var session = $("#session_select :selected").data('sessionselect');
        //          var medium = $("#medium_select :selected").data('mediumselect');
        //        
        var stream = $("#stream_select :selected").text().trim();
        var session = $("#session_select :selected").text().trim();
        var medium = $("#medium_select :selected").text().trim();

        var acdyr = $("#acdyr_select :selected").text().trim();
        //        var batch_name = classs +'/'+ divisn +'/'+ stream +'/'+ session +'/'+ medium +'/'+ acdyr;


        var acdyr_select = $("#acdyr_select").val().trim();
        var class_select = $("#class_select").val().trim();
        var class_select = $("#class_select").val().trim();
        var stream_select = $("#stream_select").val().trim();
        var session_select = $("#session_select").val().trim();
        var medium_select = $("#medium_select").val().trim();

        var alphanumers = /^[a-zA-Z\s]+$/;

        if (acdyr_select == -1) {
            swal('', 'Academic Year is required.', 'info');
            $('#faculty_loader').removeClass('sk-loading');
            return;
        }
        if (class_select == -1) {
            swal('', 'Class is required.', 'info');
            $('#faculty_loader').removeClass('sk-loading');
            return;
        }
        if (stream_select == -1) {
            swal('', 'Stream is required.', 'info');
            $('#faculty_loader').removeClass('sk-loading');
            return;
        }
        if (session_select == -1) {
            swal('', 'Session is required.', 'info');
            $('#faculty_loader').removeClass('sk-loading');
            return;
        }
        if (medium_select == -1) {
            swal('', 'Medium is required.', 'info');
            $('#faculty_loader').removeClass('sk-loading');
            return;
        }
        //        create division condition by vinoth @ 25-05-2019 14:52
        if (division == '') {
            swal('', 'Division is required.', 'info');
            $('#faculty_loader').removeClass('sk-loading');
            return false;
        } else if ((division.length > '3') || (division.length < '1')) {
            swal('', 'Division should contain letters 1 to 3', 'info');
            $('#faculty_loader').removeClass('sk-loading');
            return false;
        }
        /*if (!alphanumers.test($("#division").val())) {
            swal('', 'Division can have only alphabets', 'info');
            $('#faculty_loader').removeClass('sk-loading');
            return false;
        }*/

        if (Boys == '') {
            swal('', 'Boys count is required.', 'info');
            $('#faculty_loader').removeClass('sk-loading');
            return false;
        } else if ((Boys.length > '3') || (Boys.length < '1')) {
            swal('', 'Boys count should contain 1 to 3 digit numbers', 'info');
            $('#faculty_loader').removeClass('sk-loading');
            return false;
        }
        if (alphanumers.test($("#Boys").val())) {
            swal('', 'Boys count can only have number', 'info');
            $('#faculty_loader').removeClass('sk-loading');
            return false;
        }
        if (Girls == '') {
            swal('', 'Girls count is required.', 'info');
            $('#faculty_loader').removeClass('sk-loading');
            return false;
        } else if ((Girls.length > '3') || (Girls.length < '1')) {
            swal('', 'Girls count should contain 1 to 3 digit numbers', 'info');
            $('#faculty_loader').removeClass('sk-loading');
            return false;
        }
        if (alphanumers.test($("#Girls").val())) {
            swal('', 'Girls count can only have number', 'info');
            $('#faculty_loader').removeClass('sk-loading');
            return false;
        }
        if (Boys == 0 && Girls == 0) {
            swal('', 'Boys and Girls count should not be zero', 'info');
            $('#faculty_loader').removeClass('sk-loading');
            return false;
        }
        if (batch_code == '') {
            swal('', 'Short Code is required.', 'info');
            $('#faculty_loader').removeClass('sk-loading');
            return false;
        }




        $.ajax({
            type: "POST",
            cache: false,
            async: false,
            url: ops_url,
            data: $('#batch_save').serialize(),
            success: function(result) {
                var data = $.parseJSON(result);
                var batch = data.message;

                if (data.status == 1) {
                    $('#batch_save').html('');
                    $('#batch_save').html(data.view);
                    var batch_data = [];
                    $.ajax({
                        type: "POST",
                        cache: false,
                        async: false,
                        url: baseurl + 'course/show-batch',
                        data: {
                            'load_reset': '1'
                        },
                        success: function(result) {
                            batch_data = JSON.parse(result);

                        },
                        error: function() {
                            alert('error');
                        }
                    });


                    $('#add_type').show();
                    swal('Success', 'New Batch ,' + batch + '  created successfully.', 'success');


                    $('#faculty_loader').removeClass('sk-loading');
                    $('#curd-content').slideUp("slow", function() {
                        $('#curd-content').hide();
                    });
                    load_batch();
                } else if (data.status == 2) {
                    if (data.message == 'Division Already Exists') {
                        $('#division').val('');
                        $('#division').css("border-color", "red");
                    } else {
                        //  $('#curd-content').html('');
                        //  $('#curd-content').html(data.view);                      
                        // load_batch();                       
                    }
                    // $('#curd-content').show();
                    swal('', data.message, 'info');
                    $('#faculty_loader').removeClass('sk-loading');
                } else if (data.status == 3) {
                    $('#curd-content').html('');
                    $('#curd-content').html(data.view);
                    //  $('#curd-content').show();                 
                    swal('', data.message, 'info');
                    $('#faculty_loader').removeClass('sk-loading');

                    //                    load_batch();
                } else {
                    swal('', 'Connection Error. Please contact administrator', 'info');
                    $('#faculty_loader').removeClass('sk-loading');

                    //                    load_batch();

                }

            }
        });
    }

    function submit_edit_save_data() {
        $('#faculty_loader').addClass('sk-loading');
        var ops_url = baseurl + 'batch/edit-batch';
        var Boys = $('#Boys').val().trim();
        var Girls = $('#Girls').val().trim();
        var division = $("#division").val().trim();
        var strength = $("#strength").val().trim();
        var classs = $("#class_select :selected").text().trim();
        var divisn = $("#division").val().trim();
        var batch_code = $("#batch_code").val().trim();
        var stream = $("#stream_select :selected").text().trim();
        var session = $("#session_select :selected").text().trim();
        var medium = $("#medium_select :selected").text().trim();
        var acdyr = $("#acdyr_select :selected").text().trim();
        //        var batch_name = classs + '/' + divisn + '/' + stream + '/' + session + '/' + medium + '/' + acdyr;

        var acdyr_select = $("#acdyr_select").val().trim();
        var class_select = $("#class_select").val().trim();
        var class_select = $("#class_select").val().trim();
        var stream_select = $("#stream_select").val().trim();
        var session_select = $("#session_select").val().trim();
        var medium_select = $("#medium_select").val().trim();

        var alphanumers = /^[a-zA-Z\s]+$/;

        if (acdyr_select == -1) {
            swal('', 'Academic Year is required.', 'info');
            $('#faculty_loader').removeClass('sk-loading');
            return;
        }
        if (class_select == -1) {
            swal('', 'Class is required.', 'info');
            $('#faculty_loader').removeClass('sk-loading');
            return;
        }
        if (stream_select == -1) {
            swal('', 'Stream is required.', 'info');
            $('#faculty_loader').removeClass('sk-loading');
            return;
        }
        if (session_select == -1) {
            swal('', 'Session is required.', 'info');
            $('#faculty_loader').removeClass('sk-loading');
            return;
        }
        if (medium_select == -1) {
            swal('', 'Medium is required.', 'info');
            $('#faculty_loader').removeClass('sk-loading');
            return;
        }
        if (Boys == 0 && Girls == 0) {
            swal('', 'Boys and Girls count should not be zero', 'info');
            $('#faculty_loader').removeClass('sk-loading');
            return false;
        }
        if (Boys == '') {
            swal('', 'Boys count is required.', 'info');
            $('#faculty_loader').removeClass('sk-loading');
            return false;
        } else if ((Boys.length > '3') || (Boys.length < '1')) {
            swal('', 'Boys count should contain 1 to 3 digit numbers', 'info');
            $('#faculty_loader').removeClass('sk-loading');
            return false;
        }
        if (alphanumers.test($("#Boys").val())) {
            swal('', 'Boys count can only have number', 'info');
            $('#faculty_loader').removeClass('sk-loading');
            return false;
        }
        if (Girls == '') {
            swal('', 'Girls count is required.', 'info');
            $('#faculty_loader').removeClass('sk-loading');
            return false;
        } else if ((Girls.length > '3') || (Girls.length < '1')) {
            swal('', 'Girls count should contain 1 to 3 digit numbers', 'info');
            $('#faculty_loader').removeClass('sk-loading');
            return false;
        }
        if (alphanumers.test($("#Girls").val())) {
            swal('', 'Girls count can only have number', 'info');
            $('#faculty_loader').removeClass('sk-loading');
            return false;
        }
        if (batch_code == '') {
            swal('', 'Short Code is required.', 'info');
            $('#faculty_loader').removeClass('sk-loading');
            return false;
        }
        if (division == '') {
            swal('', 'Division is required.', 'info');
            $('#faculty_loader').removeClass('sk-loading');
            return false;
        } else if ((division.length > '3') || (division.length < '1')) {
            swal('', 'Division should contain letters 1 to 3', 'info');
            $('#faculty_loader').removeClass('sk-loading');
            return false;
        }

        $.ajax({
            type: "POST",
            cache: false,
            async: false,
            url: ops_url,
            data: $('#batch_save').serialize(),
            success: function(result) {
                var data = $.parseJSON(result)
                var batch = data.message;
                if (data.status == 1) {
                    $('#batch_save').html('');
                    $('#batch_save').html(data.view);
                    var country_data = [];
                    $.ajax({
                        type: "POST",
                        cache: false,
                        async: false,
                        url: baseurl + 'batch/show-batch',
                        data: {
                            'load_reset': '1'
                        },
                        success: function(result) {
                            country_data = JSON.parse(result);
                        },
                        error: function() {
                            alert('error');
                        }
                    });

                    $('#add_type').show();
                    swal('Success', 'Batch ' + batch + ' updated successfully.', 'success');
                    $('#faculty_loader').removeClass('sk-loading');
                    $("#curd-content").slideUp("slow", function() {
                        $("#curd-content").hide();
                    });
                    load_batch();

                } else if (data.status == 2) {
                    // 
                    if (data.message == 'Division Already Exists') {
                        $('#division').val('');
                        $('#division').css("border-color", "red");
                    } else {
                        // $('#curd-content').html('');
                        // $('#curd-content').html(data.view);
                        // load_batch();
                    }
                    swal('', data.message, 'info');
                    $('#faculty_loader').removeClass('sk-loading');
                } else if (data.status == 3) {
                    $('#curd-content').html('');
                    $('#curd-content').html(data.view);
                    swal('', data.message, 'info');

                    $('#faculty_loader').removeClass('sk-loading');

                    load_batch();
                } else {
                    swal('', 'Connection Error. Please contact administrator', 'info');
                    $('#faculty_loader').removeClass('sk-loading');

                    load_batch();
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

    function edit_batch(id, acdyr, classs, batch, boys, girls, strength) {
        var ops_url = baseurl + 'batch/edit-batch/';
        $.ajax({
            type: "POST",
            cache: false,
            async: false,
            url: ops_url,
            data: {
                "load": 1,
                "BatchID": id,
                "Acd_Year": acdyr,
                "Class_Det_ID": classs,
                "Batch_Name": batch,
                "Boys": boys,
                "Girls": girls,
                "strength": strength
            },
            success: function(result) {
                var data = JSON.parse(result);
                //                console.log(data);
                if (data.status == 1) {
                    $('#curd-content').html('');
                    $('#curd-content').html(data.view);
                    var animation = "fadeInDown";
                    $("#curd-content").show();
                    $('#curd-content').addClass('animated');
                    $('#curd-content').addClass(animation);
                    $('#add_type').hide();

                    $("#acdyr_select").select2({
                        "theme": "bootstrap"
                    });
                    $("#class_select").select2({
                        "theme": "bootstrap"
                    });
                    $("#stream_select").select2({
                        "theme": "bootstrap"
                    });
                    $("#session_select").select2({
                        "theme": "bootstrap"
                    });
                    $("#medium_select").select2({
                        "theme": "bootstrap"
                    });

                } else {
                    alert('No data loaded');
                }
            }
        });
    }

    function close_add_batch() {
        $('#add_type').show();
        $("#curd-content").slideUp("slow", function() {
            $("#curd-content").hide();
        });

    }

    //NEW SCRIPT
    function add_new_batch() {
        var ops_url = baseurl + 'batch/add-batch';
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
                    $("#acdyr_select").select2({
                        "theme": "bootstrap"
                    });
                    $("#class_select").select2({
                        "theme": "bootstrap"
                    });
                    $("#stream_select").select2({
                        "theme": "bootstrap"
                    });
                    $("#session_select").select2({
                        "theme": "bootstrap"
                    });
                    $("#medium_select").select2({
                        "theme": "bootstrap"
                    });

                } else {
                    alert('No data loaded');
                }
            }
        });
    }
</script>