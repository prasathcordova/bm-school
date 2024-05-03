<div class="wrapper wrapper-content animated fadeInRight" style="padding-top: 1px !important;padding-left: 0px !important;padding-right: 0px !important;">
    <div class="row" style="margin-left: -29px !important; margin-right: -30px !important;">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title" style="border-bottom-color:#23C6C8 !important;">
                    <h5><?php echo isset($sub_title) ? $sub_title : "NO TITLE PROVIDED" ?></h5>
                    <div class="ibox-tools" id="add_type">
                        <a data-toggle="modal" class="btn btn-primary btn-xs" data-toggle="tooltip" title="Add a new service type" data-placement="left" href="javascript:void(0)" onclick="add_service_type();"><i class="fa fa-plus"></i>ADD SERVICE TYPE</a>
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
                                <table id="servicetype_tbl" style="width:100%">
                                    <?php
                                    $breaker = 0;
                                    if (isset($vehicle_servicetype_data) && !empty($vehicle_servicetype_data)) {
                                        foreach ($vehicle_servicetype_data as $servicetype) {
                                    ?>
                                            <tr>
                                                <td>
                                                    <div class="ibox-content" style="padding-bottom:5px;padding-top: 5px;">
                                                        <div>
                                                            <div class="chat-activity-list">
                                                                <div class="chat-element">
                                                                    <div class="media-body ">
                                                                        <p style="margin-bottom:12px;">
                                                                            <strong> Service Type Name&nbsp; :</strong>
                                                                            <?php echo $servicetype['serviceType']; ?>
                                                                            <a class="btn btn-xs btn-info pull-right" href="javascript:void(0);" onclick="edit_service_type('<?php echo $servicetype['id']; ?>', '<?php echo $servicetype['serviceType']; ?>');" data-toggle="tooltip" data-placement="right" title="Edit <?php echo $servicetype['serviceType']; ?>" data-original-title="<?php echo $servicetype['serviceType']; ?>"> <i class="fa fa-edit"></i>Update</a>
                                                                        </p>
                                                                        <p>
                                                                            <div class="switch  pull-right">
                                                                                <div class="onoffswitch">
                                                                                    <?php if ($servicetype['isActive'] == 1) { ?>
                                                                                        <input type="checkbox" checked class="onoffswitch-checkbox service_type_status" data-servicetypeid="<?php echo $servicetype['id']; ?>" id="service_type_<?php echo $servicetype['id']; ?>">
                                                                                        <label class="onoffswitch-label" for="service_type_<?php echo $servicetype['id']; ?>">
                                                                                            <span class="onoffswitch-inner"></span>
                                                                                            <span class="onoffswitch-switch"></span>
                                                                                        </label>
                                                                                    <?php } else { ?>
                                                                                        <input type="checkbox" class="onoffswitch-checkbox service_type_status" data-servicetypeid="<?php echo $servicetype['id']; ?>" id="service_type_<?php echo $servicetype['id']; ?>">
                                                                                        <label class="onoffswitch-label" for="service_type_<?php echo $servicetype['id']; ?>">
                                                                                            <span class="onoffswitch-inner"></span>
                                                                                            <span class="onoffswitch-switch"></span>
                                                                                        </label>
                                                                                    <?php } ?>
                                                                                </div>
                                                                            </div>
                                                                            <strong>Created On :</strong>
                                                                            <?php echo date('d-m-Y', strtotime($servicetype['createdOn'])) ?>
                                                                        </p>





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
    var table = $('#servicetype_tbl').dataTable({
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


    $(".service_type_status").change(function() {
        setTimeout(change_status(this), 100);
    });

    function change_status(element) {
        //        $('#faculty_loader').addClass('sk-loading');
        var id = "#" + $(element).attr('id');
        var type_id = $(id).data('servicetypeid');
        var status_type = $(element).prop("checked");
        if (status_type == true)
            status = 1;
        else
            status = 0;
        var ops_url = baseurl + 'transport/servicetype/change_status';
        $.ajax({
            type: "POST",
            cache: false,
            async: false,
            url: ops_url,
            data: {
                "load": 1,
                "type_id": type_id,
                "status": status
            },
            success: function(result) {
                var data = $.parseJSON(result);
                if (data.status == 1) {
                    if (status == 0) {
                        swal('', 'Service Type deactivated successfully.', 'success');
                        $('#faculty_loader').removeClass('sk-loading');
                        return true;
                    } else {
                        if (status == 1) {
                            swal('', 'Service Type activated successfully.', 'success');
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




    function load_servicetype_on_show() {
        var ops_url = baseurl + 'transport/show-vehicle-servicetype/';
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



    //NEW SCRIPT
    function add_service_type() {
        var ops_url = baseurl + 'transport/add-servicetype';
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

    function edit_service_type(service_type_id, service_type_name) {
        var title_data = $('#title_data').val();
        var ops_url = baseurl + 'transport/edit-service-type/';
        $.ajax({
            type: "POST",
            cache: false,
            async: false,
            url: ops_url,
            data: {
                "load": 1,
                "service_type_id": service_type_id,
                "type_name": service_type_name,
                'title_data': title_data
            },
            success: function(result) {
                var data = JSON.parse(result);
                console.log(data);
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
                    swal('', 'No data available associated with this service type', 'info');
                    return false;
                }
            }
        });

    }

    function submit_data() {
        // $('#faculty_loader').addClass('sk-loading');

        var ops_url = baseurl + 'transport/addsave-servicetype/';
        var servicetype = $('#service_type').val();
        if (servicetype == '') {
            swal('', 'Service Type Name is required.', 'info');
            $('#faculty_loader').removeClass('sk-loading');
            return false;
        } else if ((servicetype.length > '30') || (servicetype.length < '3')) {
            swal('', 'Service Type Name should contain letters 3 to 30.', 'info');
            $('#faculty_loade r').removeClass('sk-loading');
            return false;
        }
        var alphanumers = /^[a-zA-Z\s]+$/;
        if (!alphanumers.test($("#service_type").val())) {
            swal('', 'Service Type Name can have only alphabets.', 'info');
            $('#faculty_loader').removeClass('sk-loading');
            return false;
        }


        $.ajax({
            type: "POST",
            cache: false,
            async: false,
            url: ops_url,
            data: $('#servicetype_save').serialize(),
            success: function(result) {
                var data = $.parseJSON(result);
                if (data.status == 1) {
                    load_servicetype_on_show();
                    swal('Success', 'Service Type, ' + servicetype + ' created successfully.', 'success');
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