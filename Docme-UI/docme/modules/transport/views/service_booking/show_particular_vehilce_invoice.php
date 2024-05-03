<div class="wrapper wrapper-content animated fadeInRight" style="padding-top: 1px !important;padding-left: 0px !important;padding-right: 0px !important;" id="data-view">
    <div class="row" style="margin-left: -29px !important; margin-right: -30px !important;">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title" style="border-bottom-color:#23C6C8!important">
                    <h5 style="color: #1c84c6;"><?php echo isset($sub_title) ? $sub_title : "NO TITLE PROVIDED" ?></h5>
                    <div class="ibox-tools" id="add_type">
                        <!--<a data-toggle="modal" class="btn btn-primary btn-xs" data-toggle="tooltip" title="Add a new Vehicle" data-placement="left"href="javascript:void(0)" onclick="add_new_service();">ADD NEW SERVICE</a>-->
                        <a href="javascript:void(0)" onclick="goto_previous();" class="btn btn btn-sm" data-toggle="tooltip" data-placement="top" title="Go to previous page"><i class="fa fa-reply"></i> Back</a>
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
                    <input type="hidden" name="vehicle_id" id="vehicle_id" value="<?php echo isset($vehicle_id) && !empty($vehicle_id) ? $vehicle_id : ''; ?>" />
                    <input type="hidden" name="vehicleNum" id="vehicleNum" value="<?php echo isset($vehicleNum) && !empty($vehicleNum) ? $vehicleNum : ''; ?>" />
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
                                                <th>Service Date</th>
                                                <th>Delivery Date</th>
                                                <th>Service Center </th>
                                                <th>Service Advisor </th>
                                                <th>Customer/Driver Name</th>
                                                <th>Total Amount <b><i class="fa fa-inr"></i></b></th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            if (isset($service_data) && !empty($service_data) && is_array($service_data)) {
                                                foreach ($service_data as $servicedata) {
                                            ?>
                                                    <tr>

                                                        <td> <?php echo date('d-m-Y', strtotime($servicedata['serrviceDate'])) ?></td>
                                                        <td> <?php echo date('d-m-Y', strtotime($servicedata['expectedDeliveryDate'])) ?></td>
                                                        <td> <?php echo $servicedata['ServiceCenter']; ?></td>
                                                        <td> <?php echo $servicedata['serviceAdvisorName']; ?></td>
                                                        <td> <?php echo $servicedata['customerName']; ?></td>
                                                        <td style="text-align:right"> <?php echo my_money_format($servicedata['amountTotal']); ?></td>
                                                        <td style="vertical-align: middle;text-align:center">
                                                            <input id="invoice_details_<?php echo $servicedata['id']; ?>" type="hidden" value='<?php echo json_encode($servicedata); ?>'>
                                                            <a class="btn btn-xs btn-info" href="javascript:void(0);" onclick="view_invoice_deatils('<?php echo $servicedata['id']; ?>')" data-toggle="tooltip" data-placement="right" title="View More Details  "> <i class="fa fa-eye"></i></a></td>
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
    var table = $('#tbl_vehicle').dataTable({

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


    function view_invoice_deatils(id) {
        var id = $('#invoice_details_' + id).val();
        var route_id = id;
        var ops_url = baseurl + 'transport/view-invoice-deatils/';
        $.ajax({
            type: "POST",
            cache: false,
            async: false,
            url: ops_url,
            data: {
                "load": 1,
                "id": id
            },
            success: function(result) {
                $('#data-view').html(result);
            }
        });
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
    function add_new_service() {
        var vehicle_id = $('#vehicle_id').val();
        var vehiclenum = $('#vehicleNum').val();
        var ops_url = baseurl + 'transport/create-new-vehicle-servicebooking/';

        $.ajax({
            type: "POST",
            cache: false,
            async: false,
            url: ops_url,
            data: {
                "load": 1,
                "vehicle_id": vehicle_id,
                "vehicle_num": vehiclenum
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
        var ops_url = baseurl + 'transport/show-allvehicle-invoice/';
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