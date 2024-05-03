<div class="row clearfix" style="padding-bottom: 60px;">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="card">
            <div class="header">
                <h2 style="padding-bottom: 10px;font-size: 16px;"><?php echo isset($title) ? $title : "NO TITLE PROVIDED" ?>
                    <span><a href="javascript:void(0);"  onclick="uniform_close_advance_search();" > <i style="font-size: 30px !important; float: right; color: #E91E63;" class="material-icons" data-toggle="tooltip" title="Close">close</i></a> </span>
                    <span><a href="javascript:void(0);"  onclick="uniform_st_search_data();" > <i style="font-size: 30px !important; float: right; color: #23C6C5; padding-right: 10px;" class="fa fa-search" data-toggle="tooltip" title="Search"></i></a> </span>
                     <!--<span>  <a data-toggle="modal" class="btn btn-primary btn-xs" data-toggle="tooltip" title="Advanced search" data-placement="left"href="javascript:void(0)"style=" float: right;  padding-right: 10px;" onclick="load_st_search();">Search</a></span>-->
                    
                    <span><a href="javascript:void(0);" onclick="uniform_refresh_add_panel();"> <i style="font-size: 30px !important; float: right; color: #2196F3; padding-right: 10px;" class="material-icons " data-toggle="tooltip" title="Refresh">refresh</i></a> </span>
                </h2>
            </div>
            <div class="body"> 
               <div class="row" style="margin-left: -29px !important; margin-right: -30px !important;">
        <div class="col-lg-12">
            <!--<div class="ibox float-e-margins">-->
            <!--                <div class="ibox-title">
                                <h5><?php echo 'Hello' ?></h5>
                                <div class="ibox-tools" id="add_type">
                                </div>
                            </div>-->
            <div class="input-group" style="margin-bottom:26px">
                <input type="text" id="searchname" name="searchname" placeholder="Search by student name / Admin no ..." class=" form-control">
                <span class="input-group-btn">
                    <button type="button" class="btn btn-info" onclick="uniform_search_name('<?php echo $this->session->userdata('acd_year'); ?>');"> Search</button>      
                    <!--<button type="button" class="btn btn-info" onclick="load_classpacking();"> Class</button>-->      

                </span>
            </div>
            <!--</div>-->
        </div>

    </div>


    <div class="row" style="margin-left: -29px !important; margin-right: -30px !important;">
        <div class="col-lg-12" id="content-search">
            
            <div class="col-lg-6 col-xs-12 col-md-12 " style="display:none;">
                            <label for="male">Academic Year</label>
                            <div class="form-group ">
                                <select class="select2_demo_3 form-control " id="acd_year" >
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
            <div class=" animated fadeInRight">
                <div class="row scroll_content" style="margin-right:0px;">

                    <?php
                    if (isset($batch_data) && !empty($batch_data)) {
                        
                        foreach ($batch_data as $batch) {
                            ?>
                            <div class="col-lg-6">
                                <div class="ibox">
                                    <div class="ibox-title">
                                        <a href="javascript:void(0);" onclick="uniform_batch_list('<?php echo $batch['class_details']['class_id']; ?>');"><span class="label label-primary pull-right">Select</span></a> 

                                        <h5><?php echo $batch['class_details']['description'] ?></h5>
                                    </div>
                                    <div class="ibox-content">
                                        <div class="col-lg-12">
                                    <div class="panel panel-info">   
                                        <!--<div class="panel-heading"><strong><?php // echo $batch['class_details']['description'] ?> </strong></div>--> 
                                        <div class="ibox-content">
                                            <div class="row">
                                                <div class="clearfix"></div>
                                                <div class="scrollerdata">
                                                    <?php
                                                    if (isset($batch['batch_details']) && !empty($batch['batch_details'])) {
                                                        $batch_details_for_loop = $batch['batch_details'];
                                                        foreach ($batch_details_for_loop as $batchlist) {
                                                            ?>
                                                            <div class="col-lg-12">
                                                                <div class="scroll_content">

                                                                    <div class="contact-box list-item">

                                                                        <div class="col-lg-12">
                                                                            <div style="color:#676a6c;"> Batch : <strong><?php echo $batchlist['batch_name'] ?></strong></div>
                                                                            <div style="color:#676a6c;" class="fl"> Limit : <span class="label label-primary" style="background-color:#47d049"><?php echo $batchlist['total_strength']; ?></span>
                                                                            </div>
                                                                            <div style="color:#676a6c;" class="fl"> &nbsp;&nbsp;&nbsp;Strength : <span class="label label-primary" style="background-color:#47d049"><?php echo $batchlist['std_count']; ?></span>
                                                                            </div>
                                                                            <div class="fr"> 
                                                                                <a href="javascript:void(0);" onclick="uniform_load_students_after_filter('<?php echo $batchlist['batchid']; ?>')" class="btn btn-xs btn-outline btn-info pull-right" style="border-color:white;" class="material-icons" data-toggle="tooltip" title="List of students">List <i class="fa fa-long-arrow-right"></i> </a>
                                                                            </div>
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
                                </div>

<!--                                        <div>
                                            <span>Class Description</span>
                                            <div class="stat-percent"></div>
                                            <div class="progress progress-mini">
                                                <div style="width: 100%;" class="progress-bar"></div>
                                            </div>
                                        </div>-->
                                        <div class="row  m-t-sm">
                                            <div class="col-sm-6">
                                                <div class="font-bold">Batch</div>
                                                4
                                            </div>
                                            <!--                                <div class="col-sm-4">
                                                                                <div class="font-bold">  Count</div>
                                                                                14 
                                                                            </div>-->
                                            <div class="col-sm-6 text-right">
                                                <div class="font-bold">Students</div>
                                                913 <i class="fa fa-level-up text-navy"></i>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div> 
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

    </div>
</div>



<style>
    .select2-container--bootstrap .select2-selection--single {
        line-height: 1;
        padding:9px 15px;
    }

    .btn-info.btn-outline{color:#fff !important;}    

    .fr{float:right;}
    .fl{float:left;} 
    .list-item{border-radius:6px;background:#74ddde; padding:12px 5px !important; line-height:25px;}
    .panel-info{display:inline-block;width:100%;}

</style>
<script type="text/javascript">
    
    $(document).ready(function () {
// Add slimscroll to element
        $('.scrollerdata').slimscroll({
            height: '100px'
        })
         $(".select2_demo_3").select2({
            "theme": "bootstrap",
            "width": "100%",
            placeholder: "Academic Year ",
            allowClear: true,

        });
 });
 
 
     function uniform_st_search_data() {
        var ops_url = baseurl + 'uniform/delivery/search-st-data';
        $.ajax({
            type: "POST",
            cache: false,
            async: false,
            url: ops_url,
            data: {"load": 1},
            success: function (data) {
                if (data) {
                    $('#curd-content').html(data);


                    var animation = "fadeInDown";
                    $("#curd-content").show();
                    $('#curd-content').addClass('animated');
                    $('#curd-content').addClass(animation);
                    $('#add_type').hide();
                    $('#currency_select').select2({
                        'theme': 'bootstrap'
                    });
                } else {
                    alert('No data loaded');
                }
            }
        });
    }
    
    
    function uniform_load_students_after_filter(batchid, acd_yr = 0) {
//        var acd_yr_id = "#acd_year" + class_id;
        if (acd_yr == 0) {
            acd_yr = $('#acd_year').val()
        }

        var ops_url = baseurl + 'uniform/delivery/students_batch';
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
                    $('#data-view').html('');
                    $('#data-view').html(data.view);
                } else {

                }
            }, error: function () {
            }
        });
    }