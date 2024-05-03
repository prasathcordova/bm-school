<div class="wrapper wrapper-content animated fadeInRight" style="padding-top: 1px !important;padding-left: 0px !important;padding-right: 0px !important;">
    <div class="row" style="margin-left: -29px !important; margin-right: -30px !important;">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5><?php echo isset($sub_title) ? $sub_title : "NO TITLE PROVIDED" ?></h5>
                    <div class="ibox-tools" id="add_type">
                        <span><a href="javascript:void(0);" onclick="uniform_load_openhouse();"> <i style="font-size: 30px !important; float: right; color: #E91E63;" class="material-icons" data-toggle="tooltip" title="Close">close</i></a> </span>
                        <span><a href="javascript:void(0);" id="save_button" onclick="uniform_submit_add_new_temps('<?php echo $master_data['id'] ?>');"> <i style="font-size: 30px !important; float: right; color: #23C6C5; padding-right: 10px;" class="material-icons" data-toggle="tooltip" title="Save">save</i></a> </span>
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
                                    <table class="table table-hover no-margins" id="tbl_ohtemplate">
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
                                                    <tr style="height : 20px">
                                                        <td> <?php echo $oh['name']; ?></td>
                                                        <td> <?php echo $oh['description']; ?></td>
                                                        <td>
                                                            <?php
                                                            if (isset($detail_data) && !empty($detail_data) && is_array($detail_data)) {
                                                                foreach ($detail_data as $detail) {
                                                                    if ($detail['template_id'] == $oh['id']) {
                                                                        $flag = 1;
                                                            ?>
                                                                        <span id="Delivered" class="label label-danger pull-left">Confirmed</span>
                                                                <?php
                                                                    }
                                                                }
                                                            }
                                                            if ($flag == 0) {
                                                                ?>
                                                                <div class="i-checks"><label> <input class="template_id" data-toggle="tooltip" data-placement="right" data-confirmid="<?php echo $oh['id']; ?>" title="Confirm item" data-original-title="" id="<?php echo $oh['id']; ?>" type="checkbox" value=""> <i></i> </label></div>
                                                            <?php
                                                            }
                                                            ?>

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
                <input type="hidden" name="itemdata" id="itemdata" value="" />
            </div>
        </div>
    </div>
</div>



<script type="text/javascript">
    $(document).ready(function() {
        $('.i-checks').iCheck({
            checkboxClass: 'icheckbox_square-green',
            radioClass: 'iradio_square-green',
        });
    });




    function uniform_submit_add_new_temps(master_id) {

        var temp_data = [];
        var table = $('#tbl_ohtemplate').dataTable();
        var confirmid = '';
        table.$('input[type=checkbox]').each(function() {
            if (this.checked) {
                var temp_id = $(this).data('confirmid');
                temp_data.push({
                    temp_id: temp_id
                });
            }
        });


        var formatted_template_id = JSON.stringify(temp_data);

        if (formatted_template_id.length == 2 || formatted_template_id.length < 2) {
            swal('', 'Atleast one OH Template should be selected.', 'info');
            $('#data_loader').removeClass('sk-loading');
            return false;
        }


        $("#save_button").hide();
        var ops_url = baseurl + 'uniform/substore/add_temp-openhouse/';
        $.ajax({
            type: "POST",
            cache: false,
            async: false,
            url: ops_url,
            data: {
                "load": 0,
                "formatted_template_id": formatted_template_id,
                "master_id": master_id
            },
            success: function(result) {
                var data = $.parseJSON(result);
                if (data.status == 1) {
                    swal('Success', 'Templates added successfully.', 'success');
                    uniform_load_openhouse();
                    $('#data_loader').removeClass('sk-loading');
                    $("#curd-content").slideUp("slow", function() {
                        $("#curd-content").hide();
                    });
                } else if (data.status == 2) {
                    swal('', data.message, 'info');
                    uniform_load_openhouse();
                    $('#data_loader').removeClass('sk-loading');
                    $("#save_button").show();
                } else {
                    swal('', 'Connection Error. Please contact administrator', 'info');
                    $('#data_loader').removeClass('sk-loading');
                    $("#save_button").show();
                }
            }
        });

    }
</script>