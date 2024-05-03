<div class="wrapper wrapper-content animated fadeInRight" style="padding-top: 1px !important;padding-left: 0px !important;padding-right: 0px !important;">
    <div class="row" style="margin-left: -29px !important; margin-right: -30px !important;">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title" style="border-bottom-color:#23C6C8!important">
                    <h5 style="color: #1c84c6;"><?php echo isset($sub_title) ? $sub_title : "NO TITLE PROVIDED" ?></h5>

                    <div class="ibox-tools" id="add_type">
                        <a href="javascript:void(0)" onclick="goto_previous();" class="btn btn btn-sm" data-toggle="tooltip" data-placement="top" title="Go to previous page"><i class="fa fa-reply"></i> Back</a>
                        <a data-toggle="modal" class="btn btn-primary btn-xs" data-toggle="tooltip" title="Add a new spare part" data-placement="left"href="javascript:void(0)" onclick="add_new_sparepart();">ADD NEW SPARE PART</a>
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
                                <table class="table table-striped table-bordered table-hover dataTables-example" id="tbl_parts" >

                                    <thead>
                                        <tr>
                                            <th>Spare Part Name</th>
                                            <th>Description</th>
                                            <th>Vendor </th>                                                                           
                                            <th>Purchase Price</th>                                
                                            <th>Purchase Date</th>                                
                                            <th>Warranty</th>                                
                                            <th>Part Num</th>                                
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
                                                    <td> <?php echo $sparesdata['sparePartName']; ?></td>
                                                    <td> <?php echo $sparesdata['sparePartDescription']; ?></td>
                                                    <td> <?php echo $sparesdata['vendor']; ?></td>
                                                    <td> <?php echo $sparesdata['price']; ?></td>
                                                    <td> <?php echo $sparesdata['buyDate']; ?></td>
                                                    <td> <?php echo $sparesdata['spareWarranty']; ?></td>
                                                    <td> <?php echo $sparesdata['sparePartNum']; ?></td>


                                                    <td  data-toggle="tooltip" title="Slide for Enable/Disable">
                                                        <?php if ($sparesdata['isActive'] == 1) { ?>                                                    
                                                            <input type="checkbox"  class="js-switch" data-toggle="tooltip" title="Slide for Enable/Disable" onchange="change_status('<?php echo $sparesdata['id'] ?>', this)" checked  id="t1" />                                                       


                                                        <?php } else {
                                                            ?>
                                                            <input type="checkbox"  class="js-switch" data-toggle="tooltip" title="Slide for Enable/Disable" onchange="change_status('<?php echo $sparesdata['id'] ?>', this)"  id="" class="js-switch"  />                                                                                                         

                                                        <?php }
                                                        ?>
                                                    </td>
                                                    <td>
                                                        <a href="javascript:void(0);" onclick="edit_spares('<?php echo $sparesdata['id']; ?>', '<?php echo $sparesdata['sparePartName']; ?>', '<?php echo $sparesdata['sparePartDescription']; ?>', '<?php echo $sparesdata['vendor']; ?>', '<?php echo $sparesdata['price']; ?>');"  data-toggle="tooltip" data-placement="right" title="Edit <?php echo $sparesdata['buyDate']; ?>" data-original-title="<?php echo $sparesdata['spareWarranty']; ?>"  ><i class="fa fa-pencil" style="font-size: 24px; color: #23C6C5; margin: 2%; "></i></a>                                                       
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
<script type="text/javascript">
    var list_switchery = [];
//    var table = $('#tbl_parts').dataTable({
        var table = $('#tbl_parts').dataTable({

        columnDefs: [
            
            {"width": "10%", className: "capitalize", "targets": 0},
            {"width": "20%", className: "capitalize", "targets": 1},
            {"width": "10%", className: "capitalize", "targets": 2},
            {"width": "10%", className: "capitalize", "targets": 3},
            {"width": "10%", className: "capitalize", "targets": 4},
            {"width": "10%", className: "capitalize", "targets": 5},
            {"width": "10%", className: "capitalize", "targets": 6,"orderable": false},
            {"width": "10%", className: "capitalize", "targets": 7,"orderable": false}
            
            
        ],
        responsive: true,
//        stateSave: true,
        iDisplayLength: 10,
        dom: '<"html5buttons"B>lTfgitp',
        buttons: [
            {extend: 'copy'},
            {extend: 'csv', exportOptions: {
                    columns: [0, 1, 2, 3]
                }},
            {extend: 'excel', title: 'Report', exportOptions: {
                    columns: [0, 1, 2, 3]
                }}
        ],
        "fnDrawCallback": function (ele) {
            activateSwitchery();
        },
        
    });
    $('#tbl_vehicle tbody').on('click', function (e) {
        activateSwitchery()
    });

    $(document).ready(function () {
        activateSwitchery();

    });

    function activateSwitchery() {
        for (var i = 0; i < list_switchery.length; i++) {
            list_switchery[i].destroy();
            list_switchery[i].switcher.remove();
        }
        var list_checkbox = Array.prototype.slice.call(document.querySelectorAll('.js-switch'));
        list_checkbox.forEach(function (html) {
            var switchery = new Switchery(html, {color: '#23C6C8', secondaryColor: '#F8AC59', size: 'small'});
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

    function change_status(country_id, element) {
//        $('#faculty_loader').addClass('sk-loading');

        var status_type = $(element).prop("checked");
        if (status_type == true)
            status = 1;
        else
            status = -1;
        var ops_url = baseurl + 'country/change_status/';
        $.ajax({
            type: "POST",
            cache: false,
            async: false,
            url: ops_url,
            data: {"load": 1, "country_id": country_id, "status": status},
            success: function (result) {
                var data = $.parseJSON(result);
                if (data.status == 1) {
                    if (status == -1) {
                        swal('Country Updated', 'Country Status Deactivated Successfully', 'success');
                        $('#faculty_loader').removeClass('sk-loading');
                        gs_count();
                        return true;
                    } else {
                        if (status == 1) {
                            swal('Country Updated', 'Country Status Activated Successfully', 'success');
                            $('#faculty_loader').removeClass('sk-loading');
                            gs_count();
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
                        }, function (isConfirm) {
//                            window.location.href = baseurl + "country/show-country";
                            load_country();
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
                            }, function (isConfirm) {
//                                window.location.href = baseurl + "country/show-country";
                                load_country();
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
                            }, function (isConfirm) {
//                                window.location.href = baseurl + "country/show-country";
                                load_country();
                            });
                        }

                    }
                }
            }
        });
    }

    $('.js-switch').change(function (e) {

    });


    $(".js-switch").click(function () {
    });
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
            data: {"load": 1, "vehicledata": vehicledata},
            success: function (result) {
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
                        data: {'load_reset': '1'},
                        success: function (result) {
                            country_data = JSON.parse(result);

                        },
                        error: function () {
                            alert('error');
                        }
                    });
                    var datatable = $('#tbl_vehicle').dataTable().api();
                    datatable.clear();
                    datatable.rows.add(country_data).draw();

                    $('#add_type').show();
                   swal('Success', 'New Vehicle, ' + vehiclenum + ' created successfully.', 'success');
                    $('#faculty_loader').removeClass('sk-loading');
                    $("#curd-content").slideUp("slow", function () {
                        $("#curd-content").hide();
                    });                
                
                } 
                else if (data.status == 2) {
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
            success: function (result) {
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
                        data: {'load_reset': '1'},
                        success: function (result) {
                            country_data = JSON.parse(result);

                        },
                        error: function () {
                            alert('error');
                        }
                    });
                    var datatable = $('#tbl_vehicle').dataTable().api();
                    datatable.clear();
                    datatable.rows.add(country_data).draw();

                    $('#add_type').show();
                    swal('Success', 'New Country, ' + country_name + ' created successfully.', 'success');
                    $('#faculty_loader').removeClass('sk-loading');
                    $("#curd-content").slideUp("slow", function () {
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
        $("#curd-content").slideUp("slow", function () {
            $("#curd-content").hide();
        });

    }

//NEW SCRIPT
    function add_new_sparepart() {
       var ops_url = baseurl + 'transport/add-new-sparepart/';
     var vehicle_id = $('#vehicleid').val();
      var vehicleNum = $('#vehicleNum').val();
        $.ajax({
            type: "POST",
            cache: false,
            async: false,
            url: ops_url,
             data: {"load": 1,"vehicle_id":vehicle_id,"vehicleNum":vehicleNum},
            success: function (data) {
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
            var ops_url = baseurl + 'transport/Spareparts_controller/load_vehicle/';
            $.ajax({
                type: "POST",
                cache: false,
                async: false,
                url: ops_url,
                data: {"load": 1},
                success: function (result) {
                    $('#data-view').html(result);
                }
            });

        }
</script>