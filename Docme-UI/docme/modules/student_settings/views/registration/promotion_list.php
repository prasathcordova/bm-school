<div id="promotion-content">
    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10 col-md-8 col-sm-8 col-xs-12">
            <h2 style="font-size: 20px;">
                <?php echo isset($title) ? $title : "NO TITLE PROVIDED" ?>
            </h2>
            <ol class="breadcrumb">
                <?php
                if (isset($bread_crump_data) && !empty($bread_crump_data)) {
                    echo $bread_crump_data;
                }
                ?>
            </ol>
        </div>
    </div>


    <div class="wrapper wrapper-content animated fadeInRight" style="padding-top: 1px !important;padding-left: 0px !important;padding-right: 0px !important;">
        <div class="row" style="margin-left: -29px !important; margin-right: -30px !important;">
            <div class="col-lg-12">
                <div class="ibox float-e-margins">
                    <div class="ibox-content" id="faculty_loader">
                        <div class="sk-spinner sk-spinner-wave">
                            <div class="sk-rect1"></div>
                            <div class="sk-rect2"></div>
                            <div class="sk-rect3"></div>
                            <div class="sk-rect4"></div>
                            <div class="sk-rect5"></div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12">
                                <div id="curd-content" style="display: none;"></div>
                            </div>
                            <div class="col-lg-12">
                                <div class="wrapper wrapper-content animated fadeInRight">
                                    <div class="row" id="batchallocate">
                                        <?php
                                        if (isset($class_data) && !empty($class_data) && is_array($class_data)) {
                                            $breaker = 0;
                                            foreach ($class_data as $class) {
                                                //                                        dev_export($class);die;
                                        ?>
                                                <div class="col-lg-3">
                                                    <div class="contact-box center-version">
                                                        <!--<span class="label label-warning pull-right">Official</span>-->
                                                        <a href="javascript:void(0);">

                                                            <h4 class="m-b-xs"><strong><?php echo $class['Description'] ?></strong></h4>
                                                            <!--<input type='hidden' id='classid' name='classid' value="<?php echo $class['Course_Det_ID'] ?>">-->
                                                        </a>
                                                        <div class="col-lg-12 col-xs-12 col-md-12">
                                                            <div class="form-group">
                                                                <label class="control-label" for="customer">From Academic Year :</label>
                                                                <select class="select2_acdyear form-control input-sm " onchange="load_stud_batch(<?php echo $class['Course_Det_ID'] ?>);" style="width:100%" name="acdyear" id="acdyear_<?php echo $class['Course_Det_ID']; ?>">
                                                                    <option value="-1" selected>Select</option>
                                                                    <?php
                                                                    if (isset($acdyear_data) && !empty($acdyear_data)) {
                                                                        foreach ($acdyear_data as $acdyear) {
                                                                            if (isset($acdyear['Acd_ID']) && !empty($acdyear['Acd_ID']) && $this->session->userdata('acd_year') == $acdyear['Acd_ID']) {
                                                                                echo '<option selected value="' . $acdyear['Acd_ID'] . '">' . $acdyear['Description'] . '</option>';
                                                                            } else {
                                                                                echo '<option value ="' . $acdyear['Acd_ID'] . '" >' . $acdyear['Description'] . '</option>';
                                                                            }
                                                                        }
                                                                    }
                                                                    ?>
                                                                </select>
                                                            </div>
                                                        </div>

                                                        <div class="col-lg-12 col-xs-12 col-md-12">
                                                            <div class="form-group">
                                                                <label class="control-label" for="customer">From Batch :</label>
                                                                <select class="select2_batch_data form-control" id="batch_<?php echo $class['Course_Det_ID']; ?>">
                                                                    <option selected value="-1">Select</option>
                                                                    <?php
                                                                    if (isset($batch_data) && !empty($batch_data)) {

                                                                        foreach ($batch_data as $value) {
                                                                            //                                                                        dev_export($value);
                                                                            if ($value['Class_Det_ID'] == $class['Course_Det_ID']) {
                                                                                echo '<option value ="' . $value['BatchID'] . '" >' . $value['Batch_Name'] . '</option>';
                                                                            }
                                                                        }
                                                                    }
                                                                    ?>

                                                                </select>
                                                            </div>
                                                        </div>

                                                        <table class="table table-hover">
                                                            <tbody>
                                                                <tr>
                                                                    <td class="text-center">
                                                                        <div class="m-t-xs btn-group">
                                                                            <a href="javascript:void(0);" onclick="load_promotion(<?php echo $class['Course_Det_ID']; ?>);" class="btn btn-xs btn-info">SELECT</a>
                                                                        </div>
                                                                    </td>
                                                                </tr>


                                                            </tbody>
                                                        </table>


                                                    </div>
                                                </div>
                                        <?php
                                                if ($breaker == 3) {
                                                    echo '<div class="clearfix"></div>';
                                                    $breaker = 0;
                                                } else {
                                                    $breaker++;
                                                }
                                            }
                                        }
                                        ?>

                                    </div>
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
    //
    function load_stud_batch(courseid) {
        var acdid = '#acdyear_' + courseid;
        var batchid = '#batch_' + courseid;
        var acdyear_id = $(acdid).val();

        var ops_url = baseurl + 'profile/get-batch-by-acdyear';
        $.ajax({
            type: "POST",
            cache: false,
            async: false,
            url: ops_url,
            data: {
                "load": 1,
                "courseid": courseid,
                "acdyear_id": acdyear_id
            },
            success: function(result) {
                console.log(result);
                $(batchid).empty().trigger("change");
                var data = JSON.parse(result);
                if (data.status == 1) {
                    var batch_data = data.data;
                    $(batchid).append("<option value='-1' >Select</option>");
                    $.each(batch_data, function(i, v) {
                        $(batchid).append("<option value='" + v.BatchID + "' >" + v.Batch_Name + "</option>");
                    });
                    $(batchid).trigger('change');
                } else {
                    $(batchid).empty().trigger("change");
                    $(batchid).append("<option value='-1' >Select</option>");
                    $(batchid).trigger('change');
                }
            }
        });
    }
    //
    //
    function load_promotion(courseid) {
        var acdid = '#acdyear_' + courseid;
        var batchid = '#batch_' + courseid;
        var batchname = $(batchid).find('option:selected').text();
        var acdyear = $(acdid).val();
        var batch_id = $(batchid).val();

        if (acdyear < 0) {
            swal('', 'Academic Year is required.', 'info');
            return;
        }
        if (batch_id < 0) {
            swal('', 'Batch is required.', 'info');
            return;
        }

        var ops_url = baseurl + 'registration/student-promotion-preloader';
        $.ajax({
            type: "POST",
            cache: false,
            async: false,
            url: ops_url,
            data: {
                "load": 1,
                "courseid": courseid,
                "acdyear": acdyear,
                "batchid": batch_id,
                "batchname": batchname
            },
            success: function(result) {
                var data = JSON.parse(result)
                $('#promotion-content').html(data.view);
                $("#promoted_year").select2({
                    "theme": "bootstrap",
                    "width": "100%"
                });
                $("#detained_year").select2({
                    "theme": "bootstrap",
                    "width": "100%"
                });
                $("#detained_batch").select2({
                    "theme": "bootstrap",
                    "width": "100%"
                });
                $("#promoted_batch").select2({
                    "theme": "bootstrap",
                    "width": "100%"
                });
                $("#promoted_class").select2({
                    "theme": "bootstrap",
                    "width": "100%"
                });
                $("#detained_class").select2({
                    "theme": "bootstrap",
                    "width": "100%"
                });
            }
        });
    }


    $(".select2_acdyear").select2({
        placeholder: "Select a Batch",
        "theme": "bootstrap",
        "width": "100%"
    });
    $(".select2_batch_data").select2({
        placeholder: "Select a Batch",
        "theme": "bootstrap",
        "width": "100%"
    });
</script>