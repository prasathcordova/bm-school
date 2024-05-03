<div class="row wrapper border-bottom white-bg page-heading" style="padding-top: 6px !important;">
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
        <div class="col-sm-12">
            <div class="ibox">

                <div class="ibox-content">
                    <div class="row">
                        <div class="col-lg-6 col-xs-12 col-md-12 ">
                            <div class="row" style="width:100%;">
                                <div class="col-lg-8 col-md-8 col-xs-12 col-sm-12" style="float:right;">
                                    <div class="form-group ">
                                        <select class="select2_demo_3 form-control pull-right" id="acd_year" >
                                            <?php
                                            if (isset($acdyr_data) && !empty($acdyr_data)) {
                                                foreach ($acdyr_data as $acd) {
                                                    if ($acd['Acd_ID'] == $this->session->userdata('acd_year')) {
                                                        echo '<option selected value="' . $acd['Acd_ID'] . '">' . $acd['Description'] . "</option>";
                                                    } else {
                                                        echo '<option value="' . $acd['Acd_ID'] . '">' . $acd['Description'] . "</option>";
                                                    }
                                                }
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="col-lg-12">
                            <div class="contact-box">                                        
                                <div class="row">
                                    <div class="col-lg-12 col-xs-12 col-md-12">
                                        <div class="col-lg-6 col-xs-12 col-md-12">
                                            <!--<strong class="text-navy">UNCATEGORIZED</strong>-->
                                            <strong class="label label-warning pull-right">UNCATEGORIZED</strong>
                                        </div>                                        
                                    </div>
                                    <div class="clearfix"></div>
                                    <div class="scrollerdata">                                        
                                        <div class="col-lg-6">
                                            <div class="scroll_content">

                                                <div class="contact-box" style="background-color: #23c6c8;">

                                                    <div class="col-lg-12">
                                                        <div style="color:white;"> Batch : <strong>STUDENTS WITH NO BATCH</strong></div>
                                                        <div style="color:white;"> Strength : <span class="label label-primary" >NA</span>
                                                        </div>
                                                    </div>

                                                    <div> 

                                                        <a href="javascript:void(0);" onclick="load_students_after_filter('-1')" class="btn btn-xs  btn-info pull-right" style="border-color:white;" >List <i class="fa fa-long-arrow-right"></i> </a>

                                                    </div>
                                                    <div class="clearfix"></div>

                                                </div>

                                            </div>
                                        </div>

                                    </div>
                                    <div class="clearfix"></div>                                            
                                </div>
                            </div>
                        </div>
                        <?php
                        if (isset($batch_data) && !empty($batch_data)) {
                            foreach ($batch_data as $batch) {
                                ?>
                                <div class="col-lg-12">
                                    <div class="contact-box">                                        
                                        <div class="row">
                                            <div class="col-lg-12 col-xs-12 col-md-12">
                                                <div class="col-lg-6 col-xs-12 col-md-12">
                                                    <!--<strong class="text-navy"><?php echo $batch['class_details']['description'] ?> </strong>-->
                                                    <strong class="label label-warning pull-right"><?php echo $batch['class_details']['description'] ?> </strong>
                                                </div>

                                            </div>
                                            <div class="clearfix"></div>
                                            <div class="scrollerdata">
                                                <?php
                                                if (isset($batch['batch_details']) && !empty($batch['batch_details'])) {
                                                    $batch_details_for_loop = $batch['batch_details'];
                                                    foreach ($batch_details_for_loop as $batchlist) {
                                                        ?>
                                                        <div class="col-lg-6">
                                                            <div class="scroll_content">

                                                                <div class="contact-box" style="background-color: #23c6c8;">

                                                                    <div class="col-lg-12">
                                                                        <div style="color:white;"> Batch : <strong><?php echo $batchlist['batch_name'] ?></strong></div>
                                                                        <div style="color:white;"> Strength : <span class="label label-primary" ><?php echo $batchlist['total_strength']; ?></span>
                                                                        </div>
                                                                    </div>

                                                                    <div> 

                                                                        <a href="javascript:void(0);" onclick="load_students_after_filter('<?php echo $batchlist['batchid']; ?>')" class="btn btn-xs  btn-info pull-right" style="border-color:white;" >List <i class="fa fa-long-arrow-right"></i> </a>

                                                                    </div>
                                                                    <div class="clearfix"></div>

                                                                </div>

                                                            </div>
                                                        </div>
                                                        <?php
                                                    }
                                                }
                                                ?>
                                            </div>
                                            <div class="clearfix"></div>                                            
                                        </div>
                                    </div>
                                </div>
                                <div class="clearfix"></div>   
                                <?php
                            }
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>




<style>
    .select2-container--bootstrap .select2-selection--single {
        height: 25px;
        line-height: 1;
        padding: 5px 24px 6px 12px;
    }

</style>
<script>

    $(document).ready(function () {

        // Add slimscroll to element
        $('.scrollerdata').slimscroll({
            height: '130px'
        })

        $(".select2_demo_3").select2({
            "theme": "bootstrap",
            "width": "100%",
            placeholder: "Academic Year ",
            allowClear: true,

        });
        $('#data_1 .input-group.date').datepicker({
            todayBtn: "linked",
            keyboardNavigation: false,
            forceParse: false,
            calendarWeeks: true,
            autoclose: true
        });


    });

    function load_students_after_filter(batchid, acd_yr = 0) {
//        var acd_yr_id = "#acd_year" + class_id;
        if (acd_yr == 0) {
            acd_yr = $('#acd_year').val()
        }

        var ops_url = baseurl + 'tcprep/show-studenttcpreplist';
        $.ajax({
            type: "POST",
            cache: false,
            async: false,
            url: ops_url,
            data: {"load": 1, "batchid": batchid, "acd_year": acd_yr},
            success: function (result) {
                var data = JSON.parse(result);
                console.log(data);
                if (data.status == 1) {
                    $('#content').html('');
                    $('#content').html(data.view);
                } else {

                }
            }, error: function () {
            }
        });
    }

</script>
