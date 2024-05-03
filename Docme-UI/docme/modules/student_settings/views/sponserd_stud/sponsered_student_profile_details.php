<style>
    td {
        word-break: break-word;
    }
</style>
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10 col-md-8 col-sm-8 col-xs-12">
        <h2 style="font-size: 20px;">
            <?php echo isset($title) ? $title : "NO TITLE PROVIDED" ?>
        </h2>
        <ol class="breadcrumb">
            <?php
            if (isset($bread_crump_data) && !empty($bread_crump_data)) {
                echo $bread_crump_data;
            }
            ?>


        </ol>
    </div>
</div>
<div class="wrapper wrapper-content animated fadeInRight" style="padding-top: 1px !important;padding-left: 0px !important;padding-right: 0px !important;">
    <div class="wrapper wrapper-content animated fadeInRight">


        <div class="row m-b-lg m-t-lg">
            <div class="col-md-6">

                <div class="profile-image">

                    <?php
                    $profile_image = "";
                    if (!empty(get_student_image($student_data['student_id']))) {
                        $profile_image = get_student_image($student_data['student_id']);
                    } else if (isset($student_data['profile_image']) && !empty($student_data['profile_image'])) {
                        $profile_image = "data:image/png;base64," . $student_data['profile_image'];
                    } else {
                        if (isset($student_data['profile_image_alternate']) && !empty($student_data['profile_image_alternate'])) {
                            $profile_image = $student_data['profile_image_alternate'];
                        } else {
                            $profile_image = base_url('assets/img/a0.jpg');
                        }
                    }
                    ?>


                    <img src="<?php echo $profile_image; ?>" class="img-circle circle-border m-b-md" alt="profile">
                </div>
                <div class="profile-info">
                    <div class="">
                        <div>
                            <h2 class="no-margins">

                                <?php echo isset($student_data['student_name']) && !empty($student_data['student_name']) ? $student_data['student_name'] : 'NO NAME'; ?>
                            </h2>
                            <h4 id="batch_name_display"><?php echo isset($student_data['Batch_Name']) && !empty($student_data['Batch_Name']) ? $student_data['Batch_Name'] : 'BATCH NOT ALLOTTED'; ?></h4>
                            <small style="word-break:break-all;">
                                <?php
                                if ($student_data['IDMark1'] == NULL || $student_data['IDMark2'] == NULL) {
                                    echo " Please Contact the Authority to Add Your Identification Marks!";
                                } else {
                                ?>
                                    <strong>Identification Marks </strong>
                                    <br>
                                    &nbsp;&nbsp;&nbsp;
                                    <span class="text-lowercase">
                                        <?php
                                        echo $student_data['IDMark1'];
                                        ?>
                                    </span>
                                    <br>
                                    &nbsp;&nbsp;&nbsp;
                                    <span class="text-lowercase">
                                        <?php
                                        echo $student_data['IDMark2'];
                                        ?>
                                    </span>
                                <?php
                                }
                                ?>
                            </small>
                        </div>
                    </div>
                </div>
            </div>



            <div class="col-md-3">
                <table class="table small m-b-xs">
                    <tbody>
                        <tr>
                            <td>
                                <strong>Admission No.</strong>
                            </td>
                            <td>
                                <?php echo $student_data['Admn_NO']; ?>
                            </td>

                        </tr>
                        <tr>
                            <td>
                                <strong>Admitted Academic Year</strong>
                            </td>
                            <td>
                                <?php echo $student_data['acdyr']; ?>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <strong>Class Name</strong>
                            </td>
                            <td>
                                <?php echo isset($student_data['Description']) && !empty($student_data['Description']) ? $student_data['Description'] : 'No Class Available'; ?>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <strong>Priority</strong>
                            </td>
                            <td>
                                <?php echo isset($student_data['Priority']) ? $student_data['Priority'] : 'Priority data is not availaable'; ?>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="ibox float-e-margins">
                    <div class="ibox-title" style="border-bottom-color:#ffd300 !important;">
                        <h5><?php echo isset($sub_title) ? $sub_title : "NO TITLE PROVIDED" ?></h5>
                        <div class="ibox-tools" id="add_type">
                            <a data-toggle="modal" class="btn btn-primary btn-xs" data-toggle="tooltip" title="Add a Sponsor" data-placement="left" href="javascript:void(0)" onclick="add_new_sponser(<?php echo $student_data['student_id']; ?>);"><i class="fa fa-plus"></i>ADD SPONSORS</a>
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
                                    <?php
                                    // dev_export($sponsers_data);
                                    // die;
                                    ?>
                                    <table class="table table-striped table-bordered table-hover dataTables-example" id="tbl_sponser">

                                        <thead>
                                            <tr>
                                                <th>Sponsor Name</th>
                                                <th>Sponsor Address</th>
                                                <th>Email</th>
                                                <th>Mobile No</th>
                                                <th>Task</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            if (isset($sponsers_data) && !empty($sponsers_data) && is_array($sponsers_data)) {
                                                foreach ($sponsers_data as $sponsers) {
                                            ?>
                                                    <tr>
                                                        <td> <?php echo $sponsers['Sponser_Name']; ?></td>
                                                        <td> <?php echo $sponsers['Sponser_Address']; ?></td>
                                                        <td> <?php echo $sponsers['Sponser_Email']; ?></td>
                                                        <td> <?php echo $sponsers['Sponser_Mobile']; ?></td>
                                                        <td>
                                                            <a href="javascript:void(0)" onclick="edit_sponsers('<?php echo $sponsers['s_id']; ?>', '<?php echo $sponsers['Sponser_Name']; ?>');" data-toggle="tooltip" data-placement="right" title="Edit <?php echo $sponsers['Sponser_Name']; ?>" data-original-title="<?php echo $sponsers['Sponser_Name']; ?>"><i class="fa fa-pencil" style="font-size: 24px; color: #23C6C5; margin: 2%; "></i></a>
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
</div>
</div>
<input type="hidden" name="batchid" id="batchid" value="<?php echo $batchid; ?>" />
<!-- MENU -->
<script src="<?php echo base_url('assets/theme/js/plugins/metisMenu/jquery.metisMenu.js'); ?>"></script>


<!-- Custom and plugin javascript -->
<script src="<?php echo base_url('assets/theme/js/inspinia.js'); ?>"></script>


<script>
    var list_switchery = [];
    var table = $('#tbl_sponser').dataTable({
        columnDefs: [{
                "width": "30%",
                className: "capitalize",
                "targets": 0
            },
            {
                "width": "20%",
                className: "capitalize",
                "targets": 1
            },
            {
                "width": "20%",
                className: "capitalize",
                "targets": 2
            },
            {
                "width": "10%",
                className: "capitalize",
                "targets": 3
            },
            {
                "width": "10%",
                className: "capitalize",
                "targets": 4,
                "orderable": false
            }
        ],
        responsive: false,
        stateSave: false,
        iDisplayLength: 10,
        dom: '<"html5buttons"B>lTfgitp',
        buttons: [{
                extend: 'copy'
            },
            {
                extend: 'csv',
                exportOptions: {
                    columns: [0, 1, 2, 3]
                }
            },
            {
                extend: 'excel',
                title: 'Report',
                exportOptions: {
                    columns: [0, 1, 2, 3]
                }
            }
        ],
        "fnDrawCallback": function(ele) {
            activateSwitchery();
        }

    });

    function typeNumberOnly(eve) {
        var e = (eve.which) ? eve.which : eve.keyCode;
        if (e != 8 && e != 0 && (e < 48 || e > 57)) {
            return false;
        }
    }
    $(document).ready(function() {
        activateSwitchery();

    });

    $('#tbl_sponser tbody').on('click', function(e) {
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

    function add_new_sponser(student_id) {
        var ops_url = baseurl + 'sponser/add-sponser/';
        $.ajax({
            type: "POST",
            cache: false,
            async: false,
            url: ops_url,
            data: {
                "load": 1,
                "student_id": student_id
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

    function submit_data(student_id) {
        $('#faculty_loader').addClass('sk-loading');
        var ops_url = baseurl + 'sponser/add-sponser/';
        var sponser_name = $('#sponser_name').val().toUpperCase();
        var sponser_add = $('#sponser_add').val();
        var s_email = $('#sponser_email').val();
        var s_mob = $('#sponser_mobile').val();
        if (sponser_name.length == '') {
            swal('', 'Sponsor Name is required.', 'info');
            $('#faculty_loader').removeClass('sk-loading');
            return false;
        } else if ((sponser_name.length > '30') || (sponser_name.length < '3')) {
            swal('', 'Sponsor Name should contain letters 3 to 30', 'info');
            $('#faculty_loader').removeClass('sk-loading');
            return false;
        }
        var alphanumers = /^[a-zA-Z\s]+$/;
        if (!alphanumers.test($("#sponser_name").val())) {
            swal('', 'Sponsor Name can have only alphabets', 'info');
            $('#faculty_loader').removeClass('sk-loading');
            return false;
        }

        if (sponser_add.length == '') {
            swal('', 'Sponsor Address is required.', 'info');
            $('#faculty_loader').removeClass('sk-loading');
            return false;
        } else if ((sponser_add.length > '15') || (sponser_add.length < '3')) {
            swal('', 'Sponsor Address should contain letters 3 to 15', 'info');
            $('#faculty_loader').removeClass('sk-loading');
            return false;
        }
        var alphanumers = /^[a-zA-Z\s]+$/;
        if (!alphanumers.test($("#sponser_add").val())) {
            swal('', 'Sponsor Address can have only alphabets', 'info');
            $('#faculty_loader').removeClass('sk-loading');
            return false;
        }
        if (s_email.length == '') {
            swal('', 'Sponsor Email is required.', 'info');
            $('#faculty_loader').removeClass('sk-loading');
            return false;
        }
        var regexp = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
        if (!regexp.test($('#sponser_email').val())) {
            swal('', 'Enter valid Email ID', 'info');
            $('#faculty_loader').removeClass('sk-loading');
            return false;

        }
        if (s_mob.length == '') {
            swal('', 'Sponsor mobile number is required.', 'info');
            $('#faculty_loader').removeClass('sk-loading');
            return false;
        }
        var sprData = $('#sponsers_save').serializeArray();
        sprData.push({
            name: "student_id",
            value: student_id
        });
        $.ajax({
            type: "POST",
            cache: false,
            async: false,
            url: ops_url,
            data: sprData,
            success: function(result) {
                var data = $.parseJSON(result)
                if (data.status == 1) {
                    $('#sponsers_save').html('');
                    $('#sponsers_save').html(data.view);
                    var sponser_data = [];
                    $.ajax({
                        type: "POST",
                        cache: false,
                        async: false,
                        url: baseurl + 'sponser/show-sponser/',
                        data: {
                            'load_reset': '1',
                            'student_id': student_id
                        },
                        success: function(result) {
                            //                            console.log(result);
                            sponser_data = JSON.parse(result);
                        },
                        error: function() {
                            alert('error');
                        }
                    });
                    var datatable = $('#tbl_sponser').dataTable().api();
                    datatable.clear();
                    datatable.rows.add(sponser_data).draw();
                    $('#add_type').show();
                    swal('Success', 'Sponser created successfully.', 'success');
                    $('#faculty_loader').removeClass('sk-loading');
                    $("#curd-content").slideUp("slow", function() {
                        $("#curd-content").hide();
                    });
                } else if (data.status == 2) {
                    $('#curd-content').html('');
                    $('#curd-content').html(data.view);
                    swal('', data.message, 'info');
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



    function edit_sponsers(sponserid, name) {
        var ops_url = baseurl + 'sponsers/edit-sponsers/';
        $.ajax({
            type: "POST",
            cache: false,
            async: false,
            url: ops_url,
            data: {
                "load": 1,
                "sponser_id": sponserid,
                "sponser_name": name
            },
            success: function(result) {
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

    function submit_edit_save_data() {
        $('#faculty_loader').addClass('sk-loading');
        var ops_url = baseurl + 'sponsers/edit-sponsers/';
        var sponser_name = $('#sponser_name').val().toUpperCase();
        var sponser_add = $('#sponser_add').val();
        var s_email = $('#sponser_email').val();
        var s_mob = $('#sponser_mobile').val();
        if (sponser_name.length == '') {
            swal('', 'Sponsor Name is required.', 'info');
            $('#faculty_loader').removeClass('sk-loading');
            return false;
        } else if ((sponser_name.length > '30') || (sponser_name.length < '3')) {
            swal('', 'Sponsor Name should contain letters 3 to 30', 'info');
            $('#faculty_loader').removeClass('sk-loading');
            return false;
        }
        var alphanumers = /^[a-zA-Z\s]+$/;
        if (!alphanumers.test($("#sponser_name").val())) {
            swal('', 'Sponsor Name can have only alphabets', 'info');
            $('#faculty_loader').removeClass('sk-loading');
            return false;
        }
        if (sponser_add.length == '') {
            swal('', 'Sponser Address is required.', 'info');
            $('#faculty_loader').removeClass('sk-loading');
            return false;
        } else if ((sponser_add.length > '15') || (sponser_add.length < '3')) {
            swal('', 'Currency Abbreviation should contain letters 3 to 15', 'info');
            $('#faculty_loader').removeClass('sk-loading');
            return false;
        }
        var alphanumers = /^[a-zA-Z\s]+$/;
        if (!alphanumers.test($("#sponser_add").val())) {
            swal('', 'Sponsor Address can have only alphabets', 'info');
            $('#faculty_loader').removeClass('sk-loading');
            return false;
        }
        if (s_email.length == '') {
            swal('', 'Sponsor Email is required.', 'info');
            $('#faculty_loader').removeClass('sk-loading');
            return false;
        }
        var regexp = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
        if (!regexp.test($('#sponser_email').val())) {
            swal('', 'Enter valid Email ID', 'info');
            $('#faculty_loader').removeClass('sk-loading');
            return false;
        }
        if (s_mob.length == '') {
            swal('', 'Sponsor mobile number is required.', 'info');
            $('#faculty_loader').removeClass('sk-loading');
            return false;
        }
        //            console.log($('#currency_save').serialize());

        $.ajax({
            type: "POST",
            cache: false,
            async: false,
            url: ops_url,
            data: $('#sponser_save').serialize(),
            success: function(result) {
                var data = $.parseJSON(result)
                if (data.status == 1) {
                    $('#sponser_save').html('');
                    $('#sponser_save').html(data.view);
                    var sponser_data = [];
                    $.ajax({
                        type: "POST",
                        cache: false,
                        async: false,
                        url: baseurl + 'sponser/show-sponser/',
                        data: {
                            'load_reset': '1'
                        },
                        success: function(result) {
                            sponser_data = JSON.parse(result);
                        },
                        error: function() {
                            alert('error');
                        }
                    });
                    var datatable = $('#tbl_sponser').dataTable().api();
                    datatable.clear();
                    datatable.rows.add(sponser_data).draw();
                    $('#add_type').show();
                    swal('Success', 'updated successfully.', 'success');
                    $('#faculty_loader').removeClass('sk-loading');
                    $("#curd-content").slideUp("slow", function() {
                        $("#curd-content").hide();
                    });
                } else if (data.status == 2) {
                    $('#curd-content').html('');
                    $('#curd-content').html(data.view);
                    swal('', data.message, 'info');
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



    function close_add_country() {
        $('#add_type').show();
        $("#curd-content").slideUp("slow", function() {
            $("#curd-content").hide();
        });

    }



    $('.scrollerdata').slimscroll({
        height: '225px'
    });
    //                            $('#leaving_date').datepicker('setDate', 'now');
    $(document).ready(function() {


        $("#sparkline1").sparkline([34, 43, 43, 35, 44, 32, 44, 48], {
            type: 'line',
            width: '100%',
            height: '50',
            lineColor: '#1ab394',
            fillColor: "transparent"
        });
        $('#leaving_date').datepicker({
            todayBtn: "linked",
            keyboardNavigation: false,
            forceParse: false,
            calendarWeeks: true,
            autoclose: true,
            startDate: '+0d',
            format: 'd/mm/yyyy'
        });
    });
    $('#batch_select_student').select2({
        "theme": "bootstrap"
    });

    function typeNumberOnly(eve) {
        var e = (eve.which) ? eve.which : eve.keyCode;
        if (e != 8 && e != 0 && (e < 48 || e > 57)) {
            return false;
        }
    }


    //function name change by vinoth @ 23-05-2019 12:47
    function enable_batch_change() {
        document.getElementById("batch_select_student").disabled = false;
        document.getElementById("batch_update_btn").disabled = false;
    }
    //                            function create by vinoth @ 23-05-2019 12:47
    function enable_edit_admno() {
        document.getElementById("edit_admno").disabled = false;
        document.getElementById("update_admno").disabled = false;
    }
    $('#batch_select').select2({
        'theme': 'bootstrap'
    });

    function batch_change_function(student_id, Cur_AcadYr) {
        var BatchID = $('#batch_select_student :selected').val();
        if (BatchID < 1) {
            swal('', 'Select a batch for allocation', 'info');
            return false;
        }

        $('#faculty_loader').addClass('sk-loading');
        var ops_url = baseurl + 'batch/change-batch';
        $.ajax({
            type: "POST",
            cache: false,
            async: false,
            url: ops_url,
            data: {
                "BatchID": BatchID,
                "student_id": student_id,
                "Cur_AcadYr": Cur_AcadYr
            },
            success: function(result) {
                var data = $.parseJSON(result)
                if (data.status == 1) {
                    $('#batch_name_display').html($('#batch_select_student :selected').text());
                    //                                            $('#batch_select_student: selected').text('');
                    $("#batch_select_student").attr("disabled", "true");
                    $("#batch_update_btn").attr("disabled", "true");
                    swal('', 'Batch changed successfully', 'success');

                } else {
                    if (data.message) {
                        swal('', data.message, 'info');
                        return false;
                    } else {
                        swal('', 'An error encountered while changing Batch. Please try again later or contact administrator.');
                        return false;
                    }
                }

            }
        });
    }

    //                            function create by vinoth @ 23-05-2019 12:52
    function edit_admno_function(student_id, Cur_AcadYr) {
        var admn_no = $('#edit_admno').val();
        if (admn_no == '') {
            swal('', 'Enter Admission No.', 'info');
            return false;
        }
        if (admn_no.length < 5) {
            swal('', 'Admission No. must have 5 digits', 'info');
            return false;
        }
        admn_no += $('#admn_suffix').text().trim();

        var ops_url = baseurl + 'admno/change-admno';
        $.ajax({
            type: "POST",
            cache: false,
            async: false,
            url: ops_url,
            data: {
                "admn_no": admn_no,
                "student_id": student_id,
                "Cur_AcadYr": Cur_AcadYr
            },
            success: function(result) {
                var data = $.parseJSON(result);
                if (data.status == 1) {
                    $("#edit_admno").attr("disabled", "true");
                    $("#update_admno").attr("disabled", "true");
                    swal('', 'Admission No. Updated Successfully.', 'success');
                } else {
                    if (data.message) {
                        swal('', data.message, 'info');
                        return false;
                    } else {
                        swal('', 'An error encountered while changing Admission No. Please try again later or contact administrator.');
                        return false;
                    }
                }

            }
        });
    }

    function profile_detail(studentid) {
        var batchid = $('#batchid').val();
        var ops_url = baseurl + 'profilestudent/show-studentprofile/';
        $.ajax({
            type: "POST",
            cache: false,
            async: false,
            url: ops_url,
            data: {
                "load": 1,
                "studentid": studentid,
                "batchid": batchid
            },
            success: function(data) {
                $('#content').html('');
                $('#content').show();
                $('#content').html(data);
                $('.registration-view').hide();
                $('html, body').animate({
                    scrollTop: $("#content").offset().top
                }, 1000);
            }
        });
    }

    function documents_detail(student_id, batch_id) {
        var ops_url = baseurl + 'documents/show-documents/';
        $.ajax({
            type: "POST",
            cache: false,
            async: false,
            url: ops_url,
            data: {
                "student_id": student_id,
                "batch_id": batch_id
            },
            success: function(result) {
                //                                        var data = $.parseJSON(result)
                //                                        $('#data-view').html(data.view);
                $('#content').html('');
                $('#content').html(result);
                $('html, body').animate({
                    scrollTop: $("#content").offset().top
                }, 1000);
            }
        });
    }

    function submit_email_data() {

        $('#faculty_loader').addClass('sk-loading');
        var to_email = $('#to_email').val();
        var subject = $('#subject').val();
        var message = $('#message').val();
        if (to_email == "") {
            swal('', 'To Mail is required.', 'info');
        }
        if (subject == "") {
            swal('', 'Subject is required.', 'info');
        }
        if (message == "") {
            swal('', 'Message is required.', 'info');
        }
        //        var body = $($(".summernote").summernote("code")).text();

        var ops_url = baseurl + 'registration/send-mail';
        $.ajax({
            type: "POST",
            cache: false,
            async: false,
            url: ops_url,
            data: {
                "to_email": to_email,
                "subject": subject,
                "email_body": message
            },
            success: function(result) {
                console.log(result);
                var data = JSON.parse(result);
                if (data.status == 1) {
                    swal('', 'Private message sent successfully.', 'success');
                    $('#subject').val('');
                    $('#message').val('');
                } else {
                    swal('', 'There is an issue with sending private message. Please contact administrator');
                    return false;
                }


            }
        });
    }

    function fees_detail(studentid) {
        var studtcstatus = $('#tcstatuscheck').attr('studtcstatus');
        if (studtcstatus == 'A') {
            swal('', 'TC Applied. Cancel TC application to mark the student as long Absentee.', 'info');
            return false;
        } else {
            var batchid = $('#batchid').val();
            var courseid = '<?php echo $student_data['Class_ID'] ?>';
            var ops_url = baseurl + 'longabsentee/long-fees/';
            $.ajax({
                type: "POST",
                cache: false,
                async: false,
                url: ops_url,
                data: {
                    "load": 1,
                    "studentid": studentid,
                    "batchid": batchid,
                    "courseid": courseid
                },
                success: function(data) {
                    $('#content').html('');
                    $('#content').html(data);
                    $('html, body').animate({
                        scrollTop: $("#content").offset().top
                    }, 1000);
                }
            });
        }
    }

    function load_students_after_filter_on_breadcrumb(batch_id, acdyear, courseid) {

        var ops_url = baseurl + 'profile/show-profile';
        $.ajax({
            type: "POST",
            cache: false,
            async: false,
            url: ops_url,
            data: {
                "load": 1,
                "batchid": batch_id,
                "acd_year": acdyear,
                "courseid": courseid
            },
            success: function(result) {
                var data = JSON.parse(result);
                console.log(data);
                if (data.status == 1) {
                    $('#content').html('');
                    $('#content').html(data.view);
                } else {

                }
            },
            error: function() {}
        });
    }

    function close_add_currency() {
        $("#curd-content").slideUp("slow", function() {
            $('#add_type').show();
            $("#curd-content").hide();
        });

    }

    function clear_controls() {
        $('.form-control').val('');
    }
</script>