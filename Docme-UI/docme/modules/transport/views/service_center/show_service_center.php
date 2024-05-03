<div class="wrapper wrapper-content animated fadeInRight" style="padding-top: 1px !important;padding-left: 0px !important;padding-right: 0px !important;">
    <div class="row" style="margin-left: -29px !important; margin-right: -30px !important;">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title" style="border-bottom-color:#23C6C8 !important;">
                    <h5><?php echo isset($sub_title) ? $sub_title : "NO TITLE PROVIDED" ?></h5>
                    <div class="ibox-tools" id="add_type">
                        <a data-toggle="modal" class="btn btn-primary btn-xs" data-toggle="tooltip" title="Add a new service center" data-placement="left" href="javascript:void(0)" onclick="add_service_center();"><i class="fa fa-plus"></i>ADD SERVICE CENTER</a>
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
                    <div class="clearfix"></div>
                    <div class="wrapper wrapper-content animated fadeInRight" id="student-data-container">

                        <div class="row">
                            <div class="col-lg-12">
                                <div id="curd-content" style="display: none;"></div>
                            </div>
                            <div class="col-lg-12">
                                <table id="servicecenter_tbl" style="width:100%">
                                    <?php
                                    $breaker = 0;
                                    if (isset($vehicle_servicecenter_data) && !empty($vehicle_servicecenter_data)) {
                                        foreach ($vehicle_servicecenter_data as $servicecenter) {
                                    ?>
                                            <tr>
                                                <td>
                                                    <div class="ibox-content" style="padding-bottom:5px;padding-top: 5px;">
                                                        <div>
                                                            <div class="chat-activity-list">
                                                                <div class="chat-element">
                                                                    <div class="media-body ">
                                                                        <p style="margin-bottom:12px;">
                                                                            <strong>Name :</strong>
                                                                            <?php echo $servicecenter['serviceCenterName']; ?>
                                                                            <a class="btn btn-xs btn-info pull-right" href="javascript:void(0);" onclick="edit_service_center('<?php echo $servicecenter['id']; ?>', '<?php echo $servicecenter['serviceCenterName']; ?>');" data-toggle="tooltip" data-placement="right" title="Edit <?php echo $servicecenter['serviceCenterName']; ?>" data-original-title="<?php echo $servicecenter['serviceCenterName']; ?>"> <i class="fa fa-edit"></i> Update</a>

                                                                        </p>

                                                                        <p>
                                                                            <div class="switch  pull-right">
                                                                                <div class="onoffswitch">
                                                                                    <?php if ($servicecenter['isActive'] == 1) { ?>
                                                                                        <input type="checkbox" checked class="onoffswitch-checkbox center_status" data-centerid="<?php echo $servicecenter['id']; ?>" id="service_center_<?php echo $servicecenter['id']; ?>">
                                                                                        <label class="onoffswitch-label" for="service_center_<?php echo $servicecenter['id']; ?>">
                                                                                            <span class="onoffswitch-inner"></span>
                                                                                            <span class="onoffswitch-switch"></span>
                                                                                        </label>
                                                                                    <?php } else { ?>
                                                                                        <input type="checkbox" class="onoffswitch-checkbox center_status" data-centerid="<?php echo $servicecenter['id']; ?>" id="service_center_<?php echo $servicecenter['id']; ?>">
                                                                                        <label class="onoffswitch-label" for="service_center_<?php echo $servicecenter['id']; ?>">
                                                                                            <span class="onoffswitch-inner"></span>
                                                                                            <span class="onoffswitch-switch"></span>
                                                                                        </label>
                                                                                    <?php } ?>
                                                                                </div>
                                                                            </div>
                                                                            <strong>Location :</strong>
                                                                            <?php echo $servicecenter['slocation']; ?>

                                                                        </p>
                                                                        <p>

                                                                            <strong>Contact Number :</strong>
                                                                            <?php echo $servicecenter['contactNo']; ?>
                                                                        </p>
                                                                        <p>

                                                                            <strong>Email Id :</strong>
                                                                            <?php echo $servicecenter['emailId']; ?>
                                                                        </p>
                                                                        <p>
                                                                            <strong>Created On : </strong>
                                                                            <?php echo date('d-m-Y', strtotime($servicecenter['createdOn'])) ?>
                                                                        </p>

                                                                    </div>



                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                            </div>
                            </td>
                            </tr>


                    <?php
                                        }
                                    }
                    ?>
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
    var table = $('#servicecenter_tbl').dataTable({
        columnDefs: [{
            "width": "100%",
            "targets": 0
        }, ],
        responsive: false,
        dom: '<"html5buttons"B>lTfgitp',
        buttons: [],
        iDisplayLength: 10,
        "ordering": false,
    });


    $('.i-checks').iCheck({
        checkboxClass: 'icheckbox_square-green',
        radioClass: 'iradio_square-green'
    });


    $(".fee_type_status").change(function() {
        setTimeout(change_status(this), 100);
    });



    $(document).on("change", ".center_status", function() {
        //$(".trip_status").change(function() {
        setTimeout(change_status(this), 100);
    });

    function change_status(element) {
        //        $('#faculty_loader').addClass('sk-loading');
        var id = "#" + $(element).attr('id');
        var center_id = $(id).data('centerid');
        var status_type = $(element).prop("checked");
        if (status_type == true)
            status = 1;
        else
            status = 0;
        var ops_url = baseurl + 'transport/servicecenter/change_status/';
        $.ajax({
            type: "POST",
            cache: false,
            async: false,
            url: ops_url,
            data: {
                "load": 1,
                "center_id": center_id,
                "status": status
            },
            success: function(result) {
                var data = $.parseJSON(result);
                if (data.status == 1) {
                    if (status == 0) {
                        swal('', 'Service Center deactivated successfully.', 'success');
                        $('#faculty_loader').removeClass('sk-loading');
                        return true;
                    } else {
                        if (status == 1) {
                            swal('', 'Service Center activated successfully.', 'success');
                            $('#faculty_loader').removeClass('sk-loading');
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
                        }, function(isConfirm) {
                            //                            window.location.href = baseurl + "country/show-country";
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
                                //                                window.location.href = baseurl + "country/show-country";
                            });
                        } else {
                            swal({
                                title: '',
                                text: 'Country Status Updation Failed',
                                type: 'info',
                                showCancelButton: false,
                                confirmButtonColor: '#3085d6',
                                cancelButtonColor: '#d33',
                                confirmButtonText: 'OK'
                            }, function(isConfirm) {
                                //                                window.location.href = baseurl + "country/show-country";
                            });
                        }

                    }
                }
            }
        });
    }




    function load_servicecenter_on_show() {
        var ops_url = baseurl + 'transport/show-vehicle-servicecenter/';
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



    function edit_service_center(service_center_id, service_center_name) {
        var title_data = $('#title_data').val();
        var ops_url = baseurl + 'transport/edit-servicecenter/';
        $.ajax({
            type: "POST",
            cache: false,
            async: false,
            url: ops_url,
            data: {
                "load": 1,
                "center_id": service_center_id,
                "center_name": service_center_name,
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
                    $('#month_span_select').select2({
                        'theme': 'bootstrap'
                    });
                    $('#payment_mode_select').select2({
                        'theme': 'bootstrap'
                    });
                    $('#feetype_select').select2({
                        'theme': 'bootstrap'
                    });
                    $(window).scrollTop(0);
                } else {
                    swal('', 'No data available associated with this fee type', 'info');
                    return false;
                }
            }
        });
    }




    //NEW SCRIPT
    function add_service_center() {
        var ops_url = baseurl + 'transport/add-servicecenter';
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
                    $('#search-feecode').hide();
                    $("#curd-content").show();
                    $('#curd-content').addClass('animated');
                    $('#curd-content').addClass(animation);
                    $('#add_type').hide();
                    $('#month_span_select').select2({
                        'theme': 'bootstrap'
                    });
                    $('#payment_mode_select').select2({
                        'theme': 'bootstrap'
                    });
                    $('#feetype_select').select2({
                        'theme': 'bootstrap'
                    });
                } else {
                    swal('', 'No data loaded', 'info');
                    return false;
                }
            }
        });
    }

    function submit_data() {
        $('#faculty_loader').addClass('sk-loading');

        var ops_url = baseurl + 'transport/addsave-servicecenter/';
        var servicecenter_name = $('#service_center_name').val();
        var serv_location = $('#location').val();
        var email = $('#email').val();
        //        var serv_email = $('#email').val();
        var contact_num = $('#cnum').val();
        if (servicecenter_name == '') {
            swal('', 'Name is required.', 'info');
            $('#faculty_loader').removeClass('sk-loading');
            return false;
        } else if ((servicecenter_name.length > '50') || (servicecenter_name.length < '3')) {
            swal('', 'Name should contain letters or numbers 3 to 50', 'info');
            $('#faculty_loader').removeClass('sk-loading');
            return false;
        }
        var alphanumers = /^[a-zA-Z\s0-9]+$/;
        if (!alphanumers.test($("#service_center_name").val())) {
            swal('', 'Name can have only alphabets or numbers.', 'info');
            $('#faculty_loader').removeClass('sk-loading');
            return false;
        }


        if (serv_location == '') {
            swal('', 'Location is required.', 'info');
            $('#faculty_loader').removeClass('sk-loading');
            return false;
        } else if ((serv_location.length > '50') || (serv_location.length < '3')) {
            swal('', 'Location should contain letters or numbers 3 to 50', 'info');
            $('#faculty_loader').removeClass('sk-loading');
            return false;
        }
        var alphanumers = /^[a-zA-Z\s0-9]+$/;
        if (!alphanumers.test($("#location").val())) {
            swal('', 'Service Center Location can have only alphabets or numbers.', 'info');
            $('#faculty_loader').removeClass('sk-loading');
            return false;
        }
        if (email == '') {
            swal('', 'Email Id is required.', 'info');
            $('#faculty_loader').removeClass('sk-loading');
            return false;
        }
        if (IsEmail(email) == false) {
            swal('', 'Enter valid Email Id.', 'info');
            $('#faculty_loader').removeClass('sk-loading');
            return false;
        }
        if (contact_num == '') {
            swal('', 'Contact Number is required.', 'info');
            $('#faculty_loader').removeClass('sk-loading');
            return false;
        } else if ((contact_num.length > 12) || (contact_num.length < 9)) {
            swal('', 'Contact Number should be 9 to 12 digits.', 'info');
            $('#faculty_loader').removeClass('sk-loading');
            return false;
        }

        function IsEmail(email) {
            var regex = /^([a-zA-Z0-9_\.\-\+])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
            if (!regex.test(email)) {
                return false;
            } else {
                return true;
            }
        }

        function IsFone(contact_num) {
            var chkfone = /^\+?([0-9]{2})\)?[-. ]?([0-9]{4})[-. ]?([0-9]{4})$/;
            if (!chkfone.test(contact_num)) {
                return false;
            } else {
                return true;
            }
        }


        $.ajax({
            type: "POST",
            cache: false,
            async: false,
            url: ops_url,
            data: $('#servicecenter_save').serialize(),
            success: function(result) {
                var data = $.parseJSON(result);
                if (data.status == 1) {
                    load_servicecenter_on_show();
                    swal('Success', 'Service Center, ' + servicecenter_name + ' created successfully.', 'success');
                    $('#faculty_loader').removeClass('sk-loading');
                    $("#curd-content").slideUp("slow", function() {
                        $("#curd-content").hide();
                        $('#add_type').show();
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
                } else {
                    swal('', 'Connection Error. Please contact administrator', 'info');
                    $('#faculty_loader').removeClass('sk-loading');
                }

            }
        });
    }
</script>