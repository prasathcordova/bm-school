<div class="wrapper wrapper-content animated fadeInRight" style="padding-top: 1px !important;padding-left: 0px !important;padding-right: 0px !important;">
    <div class="row" style="margin-left: -29px !important; margin-right: -30px !important;">
        <div class="col-lg-12" style="z-index: 9999;">
            <div class="ibox float-e-margins">
                <div class="ibox-title" style="border-bottom-color:#23C6C8!important">
                    <h5 style="color: #1c84c6;"><?php echo isset($sub_title) ? $sub_title : "NO TITLE PROVIDED" ?></h5>
                    <div class="ibox-tools" id="add_type">
                        <a data-toggle="modal" class="btn btn-primary btn-xs" data-toggle="tooltip" title="Add a new incident" data-placement="left" href="javascript:void(0)" onclick="add_new_incident();"><i class="fa fa-plus"></i>ADD NEW INCIDENT</a>
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
                            <div class="col-lg-12" style="z-index:9999;">
                                <div id="curd-content" style="display: none;"></div>
                            </div>
                            <div class="col-lg-12">
                                <div class="table-responsive">

                                    <table class="table table-striped table-bordered table-hover dataTables-example" id="tbl_vehicle">

                                        <thead>
                                            <tr>
                                                <th>Vehicle No</th>
                                                <th>Trip</th>
                                                <th>Last Pickup From Incident</th>
                                                <th>Cause of Incident</th>
                                                <th>Place of Incident </th>
                                                <th>Date of Incident</th>
                                                <th>Incident Time</th>
                                                <th>Penalty Amount <b><i class="fa fa-inr"></i></b></th>
                                                <th>Incident Description</th>
                                                <th>Action Taken</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            // echo json_encode($vehicle_data);
                                            // return;
                                            if (isset($vehicle_data) && !empty($vehicle_data) && is_array($vehicle_data)) {
                                                foreach ($vehicle_data as $incidentdata) {
                                            ?>
                                                    <tr>
                                                        <td> <?php echo $incidentdata['vehicleNum']; ?></td>
                                                        <td> <?php echo $incidentdata['tripId']; ?></td>
                                                        <td> <?php echo $incidentdata['lastPickupFromIncident']; ?></td>
                                                        <td> <?php echo $incidentdata['causeOfIncident']; ?></td>
                                                        <td> <?php echo $incidentdata['placeOfIncident']; ?></td>
                                                        <td> <?php echo date('d-m-Y', strtotime($incidentdata['incidentDate']))  ?></td>
                                                        <td> <?php echo  date('h:i A', strtotime($incidentdata['incidentTime'])); ?></td>
                                                        <td style="text-align: right"> <?php echo my_money_format($incidentdata['penaltyAmount']); ?></td>
                                                        <td> <?php echo $incidentdata['incidentDesc']; ?></td>
                                                        <td> <?php echo $incidentdata['actionTaken']; ?></td>

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
                "width": "17%",
                className: "capitalize",
                "targets": 0,
                "orderable": false
            },
            {
                "width": "13%",
                className: "capitalize",
                "targets": 1
            },
            {
                "width": "10%",
                className: "capitalize",
                "targets": 2
            },
            {
                "width": "20%",
                className: "capitalize",
                "targets": 3
            },
            {
                "width": "10%",
                className: "capitalize",
                "targets": 4
            },
            {
                "width": "15%",
                className: "capitalize",
                "targets": 5
            },
            {
                "width": "10%",
                className: "capitalize",
                "targets": 6
            },
            {
                "width": "10%",
                className: "capitalize",
                "targets": 7
            },
            //            {"width": "10%", className: "capitalize", "targets": 4, "orderable": false},
            //            {"width": "20%", className: "capitalize", "targets": 5, "orderable": false}
        ],
        responsive: false,
        stateSave: true,
        iDisplayLength: 10,
        ordering: false,
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



    $('.js-switch').change(function(e) {

    });


    $(".js-switch").click(function() {});

    function save_vehicle_details() {
        var vehiclenum = $('#vehicle_num').val();
        var regnum = $('#reg_num').val();
        var engnum = $('#eng_num').val();
        var chasis_num = $('#chasisnum').val();
        var modelselect = $('#modelyr_select').val();
        var makeselect = $('#make_select').val();
        var seat_capcity = $('#seatcapcity').val();
        var vehiclemodel_select = $('#vehiclemodel_select').val();
        var fueltypeselect = $('#fueltype_select').val();
        var insurancecmpnyselect = $('#insurancecmpny_select').val();
        var ins_date = moment($("#ins_date").datepicker("getDate")).format('YYYY-MM-DD');
        var insexp_date = moment($("#insexp_date").datepicker("getDate")).format('YYYY-MM-DD');
        var tax_date = moment($("#tax_date").datepicker("getDate")).format('YYYY-MM-DD');
        var taxexpiry_date = moment($("#taxexpiry_date").datepicker("getDate")).format('YYYY-MM-DD');
        var permit_date = moment($("#permit_date").datepicker("getDate")).format('YYYY-MM-DD');
        var permitexpiry_date = moment($("#permitexpiry_date").datepicker("getDate")).format('YYYY-MM-DD');


        var register_vehicle = new Object();
        register_vehicle.vehiclenum = vehiclenum;
        register_vehicle.regnum = regnum;
        register_vehicle.engnum = engnum;
        register_vehicle.chasis_num = chasis_num;
        register_vehicle.modelselect = modelselect;
        register_vehicle.makeselect = makeselect;
        register_vehicle.seat_capcity = seat_capcity;
        register_vehicle.vehiclemodel_select = vehiclemodel_select;
        register_vehicle.fueltypeselect = fueltypeselect;
        register_vehicle.insurancecmpnyselect = insurancecmpnyselect;
        register_vehicle.ins_date = ins_date;
        register_vehicle.insexp_date = insexp_date;
        register_vehicle.tax_date = tax_date;
        register_vehicle.taxexpiry_date = taxexpiry_date;
        register_vehicle.permit_date = permit_date;
        register_vehicle.permitexpiry_date = permitexpiry_date;

        var vehicledata = JSON.stringify(register_vehicle);
        var ops_url = baseurl + 'transport/save-vehicleregistration-details';
        $.ajax({
            type: "POST",
            cache: false,
            async: false,
            url: ops_url,
            data: {
                "load": 1,
                "vehicledata": vehicledata
            },
            success: function(result) {
                var data = JSON.parse(result);

                if (data.status == 1) {

                    $('#vehicle_save').html('');
                    $('#vehicle_save').html(data.view);
                    var country_data = [];
                    $.ajax({
                        type: "POST",
                        cache: false,
                        async: false,
                        url: baseurl + 'transport/show-new-vehicle-registration/',
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
                    var datatable = $('#tbl_vehicle').dataTable().api();
                    datatable.clear();
                    datatable.rows.add(country_data).draw();

                    $('#add_type').show();
                    swal('Success', 'New Vehicle, ' + vehiclenum + ' created successfully.', 'success');
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
                } else {
                    swal('', 'Connection Error. Please contact administrator', 'info');
                    $('#faculty_loader').removeClass('sk-loading');
                }
            }
        });
    }

    function submit_data() {
        $('#faculty_loader').addClass('sk-loading');

        var ops_url = baseurl + 'country/add-country/';
        var country_name = $('#country_name').val().toUpperCase();
        var country_abbr = $('#country_abbr').val();
        var currency_name = $("#currency_select").val();
        var country_nation = $("#country_nation").val();



        if (country_name == '') {
            swal('', 'Country Name is Required', 'info');
            $('#faculty_loader').removeClass('sk-loading');
            return false;
        } else if ((country_name.length > '30') || (country_name.length < '3')) {
            swal('', 'Country Name should contain letters 3 to 30', 'info');
            $('#faculty_loader').removeClass('sk-loading');
            return false;
        }
        var alphanumers = /^[a-zA-Z\s]+$/;
        if (!alphanumers.test($("#country_name").val())) {
            swal('', 'Country Name can have only alphabets.', 'info');
            $('#faculty_loader').removeClass('sk-loading');
            return false;
        }

        if (country_abbr == '') {
            swal('', 'Country Abbreviation is Required', 'info');
            $('#faculty_loader').removeClass('sk-loading');
            return false;
        } else if ((country_abbr.length > '15') || (country_abbr.length < '2')) {
            swal('', 'Country Abbreviation should contain letters 2 to 15', 'info');
            $('#faculty_loader').removeClass('sk-loading');
            return false;
        }
        var alphanumers = /^[a-zA-Z]+$/;
        if (!alphanumers.test($("#country_abbr").val())) {
            swal('', 'Country Abbreviation can have only alphabets.', 'info');
            $('#faculty_loader').removeClass('sk-loading');
            return false;
        }

        if (currency_name == -1) {
            swal('', 'Currency is Required', 'info');
            $('#faculty_loader').removeClass('sk-loading');
            return;
        }

        if (country_nation == '') {
            swal('', 'Nationality is Required', 'info');
            $('#faculty_loader').removeClass('sk-loading');
            return false;
        } else if ((country_nation.length > '30') || (country_nation.length < '3')) {
            swal('', 'Nationality should contain letters 3 to 30', 'info');
            $('#faculty_loader').removeClass('sk-loading');
            return false;
        }
        var alphanumers = /^[a-zA-Z\s]+$/;
        if (!alphanumers.test($("#country_nation").val())) {
            swal('', 'Nationality can have only alphabets.', 'info');
            $('#faculty_loader').removeClass('sk-loading');
            return false;
        }



        $.ajax({
            type: "POST",
            cache: false,
            async: false,
            url: ops_url,
            data: $('#country_save').serialize(),
            success: function(result) {
                var data = $.parseJSON(result);
                if (data.status == 1) {
                    gs_count();
                    $('#country_save').html('');
                    $('#country_save').html(data.view);
                    var country_data = [];
                    $.ajax({
                        type: "POST",
                        cache: false,
                        async: false,
                        url: baseurl + 'country/show-country/',
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
                    var datatable = $('#tbl_vehicle').dataTable().api();
                    datatable.clear();
                    datatable.rows.add(country_data).draw();

                    $('#add_type').show();
                    swal('Success', 'New Country, ' + country_name + ' created successfully.', 'success');
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
                    //                    activate_toast("Connection Error!!!", 'Error', 'error');
                }

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
    function add_new_incident() {
        var ops_url = baseurl + 'transport/create-new-vehicle-incidents/';

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