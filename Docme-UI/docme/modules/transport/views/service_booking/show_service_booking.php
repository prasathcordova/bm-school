<div class="wrapper wrapper-content animated fadeInRight" style="padding-top: 1px !important;padding-left: 0px !important;padding-right: 0px !important;">
    <div class="row" style="margin-left: -29px !important; margin-right: -30px !important;">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title" style="border-bottom-color:#23C6C8!important">
                    <h5 style="color: #1c84c6;"><?php echo isset($sub_title) ? $sub_title : "NO TITLE PROVIDED" ?></h5>
                    <!--                    <div class="ibox-tools" id="add_type">
                                            <a data-toggle="modal" class="btn btn-primary btn-xs" data-toggle="tooltip" title="Add a new Vehicle" data-placement="left"href="javascript:void(0)" onclick="add_new_service();">ADD NEW SERVICE</a>
                                        </div>-->
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
                                <div class="table-responsive">
                                    <table class="table table-striped table-bordered table-hover dataTables-example" id="tbl_vehicle">
                                        <thead>
                                            <tr>
                                                <th>Vehicle Num</th>
                                                <th>Service Center Name</th>
                                                <th>Service Advisor Name </th>
                                                <th>Service Advisor Contact No.</th>
                                                <th>Service Date</th>
                                                <th>Expected Delivery Date</th>
                                                <th>Driver Name</th>
                                                <!--                                                <th>Task</th>                             
                                                <th>Status</th>                         -->
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            if (isset($service_data) && !empty($service_data) && is_array($service_data)) {
                                                foreach ($service_data as $servicedata) {
                                            ?>
                                                    <tr>
                                                        <td> <?php echo $servicedata['vehicleNum']; ?></td>
                                                        <td> <?php echo $servicedata['serviceCenterName']; ?></td>
                                                        <td> <?php echo $servicedata['serviceAdvisorName']; ?></td>
                                                        <td> <?php echo $servicedata['serviceAdvisorContactNum']; ?></td>
                                                        <td> <?php echo date('d-m-Y', strtotime($servicedata['serrviceDate']))   ?></td>
                                                        <td> <?php echo date('d-m-Y', strtotime($servicedata['expectedDeliveryDate'])); ?></td>
                                                        <td> <?php echo $servicedata['customerName']; ?></td>
                                                        <!--                                                        <td>
                                                            <a href="javascript:void(0);" onclick="edit_country('<?php echo $servicedata['id']; ?>', '<?php echo $servicedata['vehicleNum']; ?>', '<?php echo $servicedata['vehicleNum']; ?>', '<?php echo $servicedata['vehicleNum']; ?>', '<?php echo $servicedata['vehicleNum']; ?>');"  data-toggle="tooltip" data-placement="right" title="Edit <?php echo $servicedata['vehicleNum']; ?>" data-original-title="<?php echo $servicedata['vehicleNum']; ?>"  ><i class="fa fa-pencil" style="font-size: 24px; color: #23C6C5; margin: 2%; "></i></a>                                                       
                                                        </td>

                                                        <td  data-toggle="tooltip" title="Slide for Enable/Disable">
                                                            <?php if ($servicedata['isActive'] == 1) { ?>                                                    
                                                                <input type="checkbox"  class="js-switch" data-toggle="tooltip" title="Slide for Enable/Disable" onchange="change_status('<?php echo $servicedata['id'] ?>', this)" checked  id="t1" />                                                       


                                                            <?php } else {
                                                            ?>
                                                                <input type="checkbox"  class="js-switch" data-toggle="tooltip" title="Slide for Enable/Disable" onchange="change_status('<?php echo $servicedata['id'] ?>', this)"  id="" class="js-switch"  />                                                                                                         

                                                            <?php }
                                                            ?>
                                                        </td>-->

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
                "targets": 0,
                "orderable": false
            },
            {
                "width": "15%",
                className: "capitalize",
                "targets": 1,
                "orderable": false
            },
            {
                "width": "15%",
                className: "capitalize",
                "targets": 2,
                "orderable": false
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
            },
            {
                "width": "10%",
                className: "capitalize",
                "targets": 5
            },
            {
                "width": "20%",
                className: "capitalize",
                "targets": 6,
                "orderable": false
            },
            //            {"width": "5%", className: "capitalize", "targets": 7, "orderable": false},
            //            {"width": "5%", className: "capitalize", "targets": 8, "orderable": false}
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



    $('.js-switch').change(function(e) {

    });


    $(".js-switch").click(function() {});

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
        var ops_url = baseurl + 'transport/create-new-vehicle-servicebooking/';

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
</script>