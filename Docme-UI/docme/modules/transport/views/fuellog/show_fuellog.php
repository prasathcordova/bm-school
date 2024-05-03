<div class="wrapper wrapper-content animated fadeInRight" style="padding-top: 1px !important;padding-left: 0px !important;padding-right: 0px !important;">
    <div class="row" style="margin-left: -29px !important; margin-right: -30px !important;">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title" style="border-bottom-color:#23C6C8!important">
                    <h5 style="color: #1c84c6;"><?php echo isset($sub_title) ? $sub_title : "NO TITLE PROVIDED" ?></h5>
                    <div class="ibox-tools" id="add_type">
                        <a href="javascript:void(0)" onclick="goto_previous();" class="btn btn btn-sm" data-toggle="tooltip" data-placement="top" title="Go to previous page"><i class="fa fa-reply"></i> Back</a>
                        <?php if (isset($fuellog_data[0]['vehicle_status']) && $fuellog_data[0]['vehicle_status'] == 1 || $isActive == 1) { ?>
                            <a data-toggle="modal" class="btn btn-primary btn-xs" data-toggle="tooltip" title="Add a new Fuel Log" data-placement="left" href="javascript:void(0)" onclick="add_new_fuel_log();"><i class="fa fa-plus"></i>ADD FUEL LOG</a>
                        <?php } ?>

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
                                    <table class="table table-striped table-bordered table-hover dataTables-example" id="tbl_vehicle">

                                        <thead>
                                            <tr>
                                                <th>Fuel Type</th>
                                                <th>Fuel Price <br />(Per Litre)</th>
                                                <th>Fuel Quantity <br />(Litres)</th>
                                                <th>Odometer Reading</th>
                                                <th>Fuel Fill Date</th>
                                                <!--                                            <th>Status</th>                                
                                            <th>Task</th>                           -->
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $latest_fuel_log_odo = 0;
                                            $latest_fuel_log_date = $this->session->userdata('lock_start_date');
                                            if (isset($fuellog_data) && !empty($fuellog_data) && is_array($fuellog_data)) {
                                                $i = 0;
                                                foreach ($fuellog_data as $fuellogdata) {
                                                    if ($i == 0) {
                                                        $latest_fuel_log_date = $fuellogdata['fuelDate'];
                                                        $latest_fuel_log_odo = $fuellogdata['fuelFillKilometer'];
                                                        $i++;
                                                    }
                                            ?>
                                                    <tr>
                                                        <td> <?php echo $fuellogdata['fuelType']; ?></td>
                                                        <td align="right"> <?php echo my_money_format($fuellogdata['fuelPrice']); ?></td>
                                                        <td align="right"> <?php echo my_money_format($fuellogdata['fuelQty']); ?></td>
                                                        <td align="right"> <?php echo $fuellogdata['fuelFillKilometer']; ?></td>
                                                        <td align="center"> <?php echo $fuellogdata['fuelDate'] != '' ? date('d/m/Y', strtotime($fuellogdata['fuelDate'])) : ''; ?></td>


                                                        <!-- <td  data-toggle="tooltip" title="Slide for Enable/Disable">
                                                                                                     <?php if ($fuellogdata['isActive'] == 1) { ?>                                                    
                                                                                                                                                                                                            <input type="checkbox"  class="js-switch" data-toggle="tooltip" title="Slide for Enable/Disable" onchange="change_status('<?php echo $fuellogdata['id'] ?>', this)" checked  id="t1" />                                                       


                                                                                                                                                        <?php } else {
                                                                                                                                                        ?>
                                                                                                                                                                                                            <input type="checkbox"  class="js-switch" data-toggle="tooltip" title="Slide for Enable/Disable" onchange="change_status('<?php echo $fuellogdata['id'] ?>', this)"  id="" class="js-switch"  />                                                                                                         

                                                                                                                                                        <?php }
                                                                                                                                                        ?>
                                                                                                                                                    </td>-->
                                                        <!--                                                    <td>
                                                                                                                                                        <a href="javascript:void(0);" onclick="edit_country('<?php echo $fuellogdata['id']; ?>', '<?php echo $fuellogdata['fuelQty']; ?>', '<?php echo $fuellogdata['fuelPrice']; ?>', '<?php echo $fuellogdata['fuelFillKilometer']; ?>', '<?php echo $fuellogdata['fuelDate']; ?>');"  data-toggle="tooltip" data-placement="right" title="Edit <?php echo $fuellogdata['fuelDate']; ?>" data-original-title="<?php echo $fuellogdata['fuelDate']; ?>"  ><i class="fa fa-pencil" style="font-size: 24px; color: #23C6C5; margin: 2%; "></i></a>                                                       
                                                                                                                                                    </td>-->
                                                    </tr>
                                            <?php
                                                }
                                            }
                                            ?>

                                        </tbody>
                                    </table>
                                    <input type="hidden" name="latest_fuel_log_date" id="latest_fuel_log_date" value="<?php echo $latest_fuel_log_date ?>">
                                    <input type="hidden" name="latest_fuel_log_odo" id="latest_fuel_log_odo" value="<?php echo $latest_fuel_log_odo ?>">
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
    var table = $('#tbl_vehicle').dataTable({
        order: [
            [4, "desc"]
        ],
        columnDefs: [{
                "width": "20%",
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
                "width": "20%",
                className: "capitalize",
                "targets": 3
            },
            {
                "width": "20%",
                className: "capitalize",
                "targets": 4
            },
            //            {"width": "10%", className: "capitalize", "targets": 5, "orderable": false},
            //            {"width": "20%", className: "capitalize", "targets": 6, "orderable": false}
        ],
        responsive: false,
        stateSave: true,
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



    function refresh_add_panel() {
        $('#country_name').val('');
        $('#country_name').parent().removeAttr('class', 'has-error');
        $('#country_nation').val('');
        $('#country_nation').parent().removeAttr('class', 'has-error');
        $('#country_abbr').val('');
        $('#country_abbr').parent().removeAttr('class', 'has-error');
        $('#currency_select').select2('val', -1);
    }


    function close_add_country() {
        $('#add_type').show();
        $("#curd-content").slideUp("slow", function() {
            $("#curd-content").hide();
        });

    }

    //NEW SCRIPT
    function add_new_fuel_log() {
        var ops_url = baseurl + 'transport/create-new-fuel-log/';
        var vehicle_id = $('#vehicleid').val();
        var vehicleNum = $('#vehicleNum').val();
        $.ajax({
            type: "POST",
            cache: false,
            async: false,
            url: ops_url,
            data: {
                "load": 1,
                "vehicle_id": vehicle_id,
                "vehicleNum": vehicleNum
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

    function goto_previous() {
        var ops_url = baseurl + 'transport/show-vehicle-fuel/';
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