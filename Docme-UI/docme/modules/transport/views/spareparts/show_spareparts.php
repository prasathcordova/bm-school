<div class="wrapper wrapper-content animated fadeInRight" style="padding-top: 1px !important;padding-left: 0px !important;padding-right: 0px !important;">
    <div class="row" style="margin-left: -29px !important; margin-right: -30px !important;">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title" style="border-bottom-color:#23C6C8!important">
                    <h5 style="color: #1c84c6;"><?php echo isset($sub_title) ? $sub_title : "NO TITLE PROVIDED" ?></h5>

                    <div class="ibox-tools" id="add_type">
                        <!-- <a href="javascript:void(0)" onclick="goto_previous();" class="btn btn btn-sm" data-toggle="tooltip" data-placement="top" title="Go to previous page"><i class="fa fa-reply"></i> Back</a> -->
                        <a data-toggle="modal" class="btn btn-primary btn-xs" data-toggle="tooltip" title="Add a new spare part" data-placement="left" href="javascript:void(0)" onclick="add_new_sparepart();"> <i class="fa fa-plus"></i> ADD NEW SPARE PART</a>
                    </div>
                </div>
                <input type="hidden" name="vehicleid" id="vehicleid" value="<?php echo isset($vehicle_id) && !empty($vehicle_id) ? $vehicle_id : ''; ?>" />
                <input type="hidden" name="vehicleNum" id="vehicleNum" value="<?php echo isset($vehicleNum) && !empty($vehicleNum) ? $vehicleNum : ''; ?>" />
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
                                <div class="table-responsive">
                                    <table class="table table-striped table-bordered table-hover dataTables-example" id="tbl_parts">

                                        <thead>
                                            <tr>
                                                <th>Name</th>
                                                <th>Description</th>
                                                <th>Part Number </th>
                                                <th>Status</th>
                                                <th>Task</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            if (isset($spares_data) && !empty($spares_data) && is_array($spares_data)) {
                                                foreach ($spares_data as $sparesdata) {
                                            ?>
                                                    <tr>
                                                        <td> <?php echo $sparesdata['partName']; ?></td>
                                                        <td> <?php echo $sparesdata['partDescription']; ?></td>
                                                        <td> <?php echo $sparesdata['partNumber']; ?></td>


                                                        <!-- <td data-toggle="tooltip" title="Slide for Enable/Disable">
                                                            <?php if ($sparesdata['isActive'] == 1) { ?>
                                                                <input type="checkbox" class="js-switch" data-toggle="tooltip" title="Slide for Enable/Disable" onchange="change_status('<?php echo $sparesdata['id'] ?>', this)" checked id="t1" />


                                                            <?php } else {
                                                            ?>
                                                                <input type="checkbox" class="js-switch" data-toggle="tooltip" title="Slide for Enable/Disable" onchange="change_status('<?php echo $sparesdata['id'] ?>', this)" id="" class="js-switch" />

                                                            <?php }
                                                            ?>
                                                        </td> -->
                                                        <td data-toggle="tooltip" title="Slide for Enable/Disable">
                                                            <div class="switch">
                                                                <div class="onoffswitch">
                                                                    <?php if ($sparesdata['isActive'] == 1) { ?>
                                                                        <input type="checkbox" checked class="onoffswitch-checkbox spareparts_status" data-spareid="<?php echo $sparesdata['id']; ?>" id="sparepart_<?php echo $sparesdata['id']; ?>">
                                                                        <label class="onoffswitch-label" for="sparepart_<?php echo $sparesdata['id']; ?>">
                                                                            <span class="onoffswitch-inner"></span>
                                                                            <span class="onoffswitch-switch"></span>
                                                                        </label>
                                                                    <?php
                                                                    } else { ?>
                                                                        <input type="checkbox" class="onoffswitch-checkbox spareparts_status" data-spareid="<?php echo $sparesdata['id']; ?>" id="sparepart_<?php echo $sparesdata['id']; ?>">
                                                                        <label class="onoffswitch-label" for="sparepart_<?php echo $sparesdata['id']; ?>">
                                                                            <span class="onoffswitch-inner"></span>
                                                                            <span class="onoffswitch-switch"></span>
                                                                        </label>
                                                                    <?php
                                                                    } ?>
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <a class="btn btn-xs btn-info" href="javascript:void(0);" onclick="edit_spares('<?php echo $sparesdata['id']; ?>', '<?php echo $sparesdata['partName']; ?>', '<?php echo $sparesdata['partDescription']; ?>');" data-toggle="tooltip" data-placement="right" title="Edit"> <i class="fa fa-edit"></i>Update</a>
                                                        </td>
                                                        <!-- <td>
                                                            <a href="javascript:void(0);" onclick="edit_spares('<?php echo $sparesdata['id']; ?>', '<?php echo $sparesdata['partName']; ?>', '<?php echo $sparesdata['partDescription']; ?>');" data-toggle="tooltip" data-placement="right" title="Edit <?php // echo $sparesdata['buyDate']; 
                                                                                                                                                                                                                                                                                                            ?>" data-original-title="<?php // echo $sparesdata['spareWarranty']; 
                                                                                                                                                                                                                                                                                                                                        ?>"><i class="fa fa-pencil" style="font-size: 24px; color: #23C6C5; margin: 2%; "></i></a>
                                                        </td> -->
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
<script type="text/javascript">
    var list_switchery = [];
    //    var table = $('#tbl_parts').dataTable({
    var table = $('#tbl_parts').dataTable({

        columnDefs: [

            {
                "width": "30%",
                className: "capitalize",
                "targets": 0
            },
            {
                "width": "25%",
                className: "capitalize",
                "targets": 1
            },
            {
                "width": "25%",
                className: "capitalize",
                "targets": 2
            },
            {
                "width": "10%",
                className: "capitalize",
                "targets": 3,
                "orderable": false
            },
            {
                "width": "10%",
                className: "capitalize",
                "targets": 4,
                "orderable": false
            }


        ],
        responsive: false,
        //        stateSave: true,
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
        },

    });
    $('#tbl_vehicle tbody').on('click', function(e) {
        activateSwitchery()
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

    $(document).on("change", ".spareparts_status", function() {
        //$(".trip_status").change(function() {
        setTimeout(change_status(this), 100);
    });

    function change_status(element) {
        //        $('#faculty_loader').addClass('sk-loading');
        var id = "#" + $(element).attr('id');
        var spare_id = $(id).data('spareid');
        var status_type = $(element).prop("checked");
        if (status_type == true)
            status = 1;
        else
            status = 0;
        var ops_url = baseurl + 'transport/parts/change_status/';
        $.ajax({
            type: "POST",
            cache: false,
            async: false,
            url: ops_url,
            data: {
                "load": 1,
                "spare_id": spare_id,
                "status": status
            },
            success: function(result) {
                var data = $.parseJSON(result);
                if (data.status == 1) {
                    if (status == 0) {
                        swal('', 'Spare Part deactivated successfully.', 'success');
                        $('#faculty_loader').removeClass('sk-loading');
                        return true;
                    } else {
                        if (status == 1) {
                            swal('', 'Spare Part activated successfully.', 'success');
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
                                text: 'Spare Part updation failed.',
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

    function close_add_country() {
        $('#add_type').show();
        $("#curd-content").slideUp("slow", function() {
            $("#curd-content").hide();
        });

    }

    //NEW SCRIPT
    function add_new_sparepart() {
        var ops_url = baseurl + 'transport/create-new-parts-spare/';

        $.ajax({
            type: "POST",
            cache: false,
            async: false,
            url: ops_url,
            data: {
                "load": 1,
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

    function edit_spares(spid, spname) {
        var ops_url = baseurl + 'transport/edit-parts-spare/';

        $.ajax({
            type: "POST",
            cache: false,
            async: false,
            url: ops_url,
            data: {
                "id": spid,
                "sp_name": spname
            },
            success: function(result) {
                if (result) {
                    var data = JSON.parse(result);
                    $('#curd-content').html(data.view);
                    var animation = "fadeInDown";
                    $("#curd-content").show();
                    $('#curd-content').addClass('animated');
                    $('#curd-content').addClass(animation);
                    $('#add_type').hide();
                    $('.form-line').addClass('focused');

                } else {
                    alert('No data loaded');
                }
            }

        });

    }

    function goto_previous() {
        var ops_url = baseurl + 'transport/Spareparts_controller/load_vehicle/';
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
</script>