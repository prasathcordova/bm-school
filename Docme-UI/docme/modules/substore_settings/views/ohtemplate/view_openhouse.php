<div class="wrapper wrapper-content animated fadeInRight" style="padding-top: 1px !important;padding-left: 0px !important;padding-right: 0px !important;">
    <div class="row" style="margin-left: -29px !important; margin-right: -30px !important;">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5><?php echo isset($sub_title) ? $sub_title : "NO TITLE PROVIDED" ?></h5>
                    <div class="ibox-tools" id="add_type">
                        <span><a href="javascript:void(0);" onclick="load_openhouse();"> <i style="font-size: 30px !important; float: right; color: #E91E63;" class="material-icons" data-toggle="tooltip" title="Close">close</i></a> </span>

                    </div>
                </div>
                <div class="ibox-content" id="data_loader">
                    <div class="sk-spinner sk-spinner-wave">
                        <div class="sk-rect1"></div>
                        <div class="sk-rect2"></div>
                        <div class="sk-rect3"></div>
                        <div class="sk-rect4"></div>
                        <div class="sk-rect5"></div>
                    </div>


                    <div class="row">


                        <div class="mail-tools tooltip-demo m-t-md">


                            <h5>
                                <span class="font-normal"> Open House Name: </span><span class="font-normal"><?php echo $master_data['description'] ?></span>
                            </h5>

                            <h5>

                                <span class="font-normal">Kits Per Student: </span><span class="font-normal"><?php echo $master_data['kit_per_student'] ?></span>
                            </h5>

                            <h5>

                                <span class="font-normal">Open House Start Date And End Date: </span><span class="font-normal"><?php echo date('d/m/Y', strtotime($master_data['start_date'])) ?> - <?php echo date('d/m/Y', strtotime($master_data['end_date'])) ?></span>
                            </h5>
                            <h5>

                                <span class="font-normal">Discount: </span><span class="font-normal"><?php echo (isset($master_data['is_discount']) && $master_data['is_discount'] == 1) ? $master_data['discount'] : 0 ?> <?php echo CURRENCY  ?></span>
                            </h5>

                            <div class="progress progress-mini">
                                <div style="width: 100%;" class="progress-bar"></div>
                            </div>


                        </div><br>
                        <div class="clearfix"></div>
                        <div class="row">


                            <div class="col-lg-12">

                                <h5 class="text-navy font-normal">Template list</h5>

                                <div class="ibox-content">
                                    <table class="table table-hover no-margins">
                                        <thead>
                                            <tr>
                                                <th>Template Name</th>
                                                <th>Description</th>
                                                <th>Task</th>

                                            </tr>
                                        </thead>
                                        <tbody>

                                            <?php
                                            if (isset($oh_data) && !empty($oh_data) && is_array($oh_data)) {
                                                foreach ($oh_data as $oh) {
                                                    $flag = 0;
                                            ?>
                                                    <tr>

                                                        <?php
                                                        if (isset($detail_data) && !empty($detail_data) && is_array($detail_data)) {
                                                            foreach ($detail_data as $detail) {
                                                                if ($detail['template_id'] == $oh['id']) {
                                                                    $flag = 1;
                                                        ?>
                                                                    <td> <?php echo $oh['name']; ?></td>
                                                                    <td> <?php echo $oh['description']; ?></td>
                                                                    <td> <span id="Delivered" class="label label-danger pull-left">Confirmed</span></td>

                                                        <?php
                                                                }
                                                            }
                                                        }
                                                        ?>

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
                <input type="hidden" name="itemdata" id="itemdata" value="" />
            </div>
        </div>
    </div>
</div>



<script type="text/javascript">
    $(document).ready(function() {
        $("#no_temp_st").keydown(function(event) {
            if (event.shiftKey) {
                event.preventDefault();
            }

            if (event.keyCode == 46 || event.keyCode == 8) {} else {
                if (event.keyCode < 95) {
                    if (event.keyCode < 48 || event.keyCode > 57) {
                        event.preventDefault();
                    }
                } else {
                    if (event.keyCode < 96 || event.keyCode > 105) {
                        event.preventDefault();
                    }
                }
            }
        });

        $('input[name="daterange"]').daterangepicker();


        var table = $('#tbl_ohtemplate').dataTable({
            columnDefs: [{
                    "width": "30%",
                    className: "capitalize",
                    "targets": 0
                },
                {
                    "width": "30%",
                    className: "capitalize",
                    "targets": 1
                },
                {
                    "width": "30%",
                    className: "capitalize",
                    "targets": 2,
                    "orderable": false
                }
            ],
            responsive: true,
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
                $('.i-checks').iCheck({
                    checkboxClass: 'icheckbox_square-green',
                    radioClass: 'iradio_square-green',
                });
            }

        });




        $('.i-checks').iCheck({
            checkboxClass: 'icheckbox_square-green',
            radioClass: 'iradio_square-green',
        });

    });




    function submit_edit_data(master_id) {
        //        alert('hi');return false;

        $('#data_loader').addClass('sk-loading');


        var no_temp_st = $('#no_temp_st').val();
        var description = $('#description').val().toUpperCase();

        if (moment($('#daterange').data('daterangepicker').startDate).isValid()) {
            var start_date = moment($('#daterange').data('daterangepicker').startDate.format('YYYY-MM-DD')).format('YYYY-MM-DD'); //h:mm A');
        } else {
            swal('', 'Start Date is invalid', 'info');
            $('#data_loader').removeClass('sk-loading');
            return false;
        }
        if (moment($('#daterange').data('daterangepicker').endDate).isValid()) {
            var end_date = moment($('#daterange').data('daterangepicker').endDate.format('YYYY-MM-DD')).format('YYYY-MM-DD'); // h:mm A');
        } else {
            swal('', 'End Date is invalid', 'info');
            $('#data_loader').removeClass('sk-loading');
            return false;
        }

        if (no_temp_st == '') {
            swal('', 'No of template per student is required ', 'info');
            $('#data_loader').removeClass('sk-loading');
            return false;
        }


        var alphanumers = /^[a-zA-Z\s]+$/;
        if (alphanumers.test($('#no_temp_st').val())) {
            swal('', 'No of template per student can have only number', 'info');
            $('#data_loader').removeClass('sk-loading');
            return false;
        }

        if (description == '') {
            swal('', 'Description is required.', 'info');
            $('#data_loader').removeClass('sk-loading');
            return false;
        }
        var alphanumers = /^[a-zA-Z\s]+$/;
        if (!alphanumers.test($("#description").val())) {
            swal('', 'Description can have only alphabets', 'info');
            $('#data_loader').removeClass('sk-loading');
            return false;
        }
        var temp_data = [];
        var table = $('#tbl_ohtemplate').dataTable();
        var confirmid = ''
        table.$('input[type=checkbox]').each(function() {
            if (this.checked) {
                var temp_id = $(this).data('confirmid');
                //                console.log(id);
                temp_data.push({
                    temp_id: temp_id
                });
            }
        });

        //        console.log(JSON.stringify(temp_data))
        var formatted_template_id = JSON.stringify(temp_data);
        //       console.log(formatted_template_id.length);
        if (formatted_template_id.length == 2 || formatted_template_id.length < 2) {
            swal('', 'Atleast one OH Template should be selected.', 'info');
            $('#data_loader').removeClass('sk-loading');
            return false;
        }

        //return false;

        var ops_url = baseurl + 'substore/edit-openhouse/';
        $.ajax({
            type: "POST",
            cache: false,
            async: false,
            url: ops_url,
            data: {
                "load": 0,
                "no_temp_st": no_temp_st,
                "description": description,
                "formatted_template_id": formatted_template_id,
                "start_date": start_date,
                "end_date": end_date,
                "master_id": master_id
            },
            success: function(result) {
                var data = $.parseJSON(result);
                if (data.status == 1) {
                    swal('Success', 'Openhouse' + description + ' edited successfully.', 'success');
                    load_openhouse();
                    $('#data_loader').removeClass('sk-loading');
                    $("#curd-content").slideUp("slow", function() {
                        $("#curd-content").hide();
                    });
                } else if (data.status == 2) {
                    swal('', data.message, 'info');
                    load_openhouse();
                    $('#data_loader').removeClass('sk-loading');
                } else {
                    swal('', 'Connection Error. Please contact administrator', 'info');
                    $('#data_loader').removeClass('sk-loading');
                    //                    activate_toast("Connection Error", 'Error', 'error');
                }
            }
        });

    }
</script>