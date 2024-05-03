<script src="<?php echo base_url('assets/theme/js/plugins/iCheck/icheck.min.js'); ?>"></script>
<script src="<?php echo base_url('assets/theme/js/plugins/dataTables/datatables.min.js'); ?>"></script>


<div class="wrapper wrapper-content animated fadeInRight" style="padding-top: 1px !important;padding-left: 0px !important;padding-right: 0px !important;">
    <div class="row" style="margin-left: -29px !important; margin-right: -30px !important;">
        <div class="col-lg-12">
            <!--<div class="ibox float-e-margins">-->
            <!--                <div class="ibox-title">
                                <h5><?php echo 'Hello' ?></h5>
                                <div class="ibox-tools" id="add_type">
                                </div>
                            </div>-->
            <div class="input-group" style="margin-bottom:26px">
                <input type="text" id="searchname" name="searchname" placeholder="Search Class by name..." class=" form-control">
                <span class="input-group-btn">
                    <button type="button" class="btn btn-info" onclick="search_name('', '<?php // echo AEDbatch_id;  ?>');"> Search</button>      

                </span>
            </div>
            <!--</div>-->
        </div>

    </div>


    <div class="row" style="margin-left: -29px !important; margin-right: -30px !important;">
        <div class="col-lg-12">
            <div class=" animated fadeInRight">
                <div class="row scroll_content" style="margin-right:0px;">

                    <?php
                    if (isset($batch_data) && !empty($batch_data)) {
                        
                        foreach ($batch_data as $batch) {
                            ?>
                            <div class="col-lg-4">
                                <div class="ibox">
                                    <div class="ibox-title">
                                        <a href="javascript:void(0);" onclick="batch_list('<?php echo $batch['class_details']['class_id']; ?>');"><span class="label label-primary pull-right">Select</span></a> 

                                        <h5><?php echo $batch['class_details']['description'] ?></h5>
                                    </div>
                                    <div class="ibox-content">

                                        <div>
                                            <span>Class Description</span>
                                            <div class="stat-percent"></div>
                                            <div class="progress progress-mini">
                                                <div style="width: 100%;" class="progress-bar"></div>
                                            </div>
                                        </div>
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













<script type="text/javascript">

    function batch_list1(class_id) {
        var ops_url = baseurl + 'substore/class_batch_list/';
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
function batch_list(class_id) {
//        var batchid = $('#batchid').val();
        var ops_url = baseurl + 'substore/class_batch_list/';
        $.ajax({
            type: "POST",
            cache: false,
            async: false,
            url: ops_url,
            data: {"load": 1, "classid": class_id},
            success: function (data) {
                $('#data-view').html(data);
//                $('#profile-detail-content').html('');
//                $('#profile-detail-content').html('');
//                $('#profile-detail-content').html(data);
//                $('html, body').animate({
//                    scrollTop: $("#profile-detail-content").offset().top
//                }, 1000);
            }
        });
    }
  
  


</script>