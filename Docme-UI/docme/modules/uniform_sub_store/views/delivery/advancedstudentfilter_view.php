<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of advancedstudentfilter_view
 *
 * @author chandrajith.edsys
 */ ?>
<style>
    .pro-name {
        height: 28px;
    }
</style>


<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-info">
            <div class="panel-heading">
                <i class="fa fa-info-circle"></i>Student List
            </div>



            <div class="panel-body">

                <!-- <div class="input-group">
                    <input type="text" id="searchname" name="searchname" placeholder="Search Student by name..." class=" form-control">
                    <span class="input-group-btn">
                        <button type="button" class="btn btn-info" onclick="uniform_search_name('<?php // echo $acdyr_id; 
                                                                                                    ?>', '<?php // echo $batch_id; 
                                                                                                            ?>');"> Search</button>

                    </span>
                </div> -->

                <div class="row">
                    <!--<input type="hidden" name="batchid" id="batchid" value="<?php echo isset($batchid) && !empty($batchid) ? $batchid : ''; ?>" />-->

                    <!--                            <div class="col-lg-12">
                                                            <div id="curd-content" style="display: none;"></div>
                                                        </div>-->
                    <div class="clearfix"></div>
                    <div class="wrapper wrapper-content animated fadeInRight" id="student-data-container">
                        <div class="row" style="margin-left:4px;">
                            <?php
                            if (isset($details_data) && !empty($details_data) && is_array($details_data)) {
                                $breaker = 0;
                                foreach ($details_data as $student) {
                            ?>
                                    <div class="col-lg-3">
                                        <div class="contact-box center-version">
                                            <a href="javascript:void(0);">
                                                <?php
                                                $profile_image = "";
                                                if (!empty(get_student_image($student['student_id']))) {
                                                    $profile_image = get_student_image($student['student_id']);
                                                } else
                                                if (isset($student['profile_image']) && !empty($student['profile_image'])) {

                                                    $profile_image = "data:image/jpeg;base64," . $student['profile_image'];
                                                } else {
                                                    if (isset($student['profile_image_alternate']) && !empty($student['profile_image_alternate'])) {
                                                        $profile_image = $student['profile_image_alternate'];
                                                    } else {
                                                        $profile_image = base_url('assets/img/a0.jpg');
                                                    }
                                                }
                                                ?>
                                                <img alt="image" class="img-circle" src="<?php echo $profile_image; ?>">
                                                <h3 class="m-b-xs pro-name"><strong><?php echo $student['student_name'] ?></strong></h3>

                                                <div class="font-bold">Admission num:<?php echo $student['Admn_No'] ?></div>

                                            </a>
                                            <table class="table table-hover">
                                                <tbody>


                                                </tbody>
                                            </table>
                                            <div class="contact-box-footer">
                                                <div class="m-t-xs btn-group">
                                                    <a href="javascript:void(0);" onclick="uniform_bill_detail('<?php //echo $student['student_id']; 
                                                                                                                ?>')" class="btn btn-xs btn-white"><i class="fa fa-user-plus"></i> Pay Bill</a>

                                                </div>
                                            </div>

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
<script>
    $(document).ready(function() {

        $('#search_student').hide();



    });




    function uniform_show_search() {
        $('#search_student').slideDown("slow");
    }

    function uniform_hide_search() {
        $('#search_student').slideUp("slow");
    }


    function uniform_search_name(acdyr_id, batch_id) {
        var searchname = $('#searchname').val();
        var ops_url = baseurl + 'registration/search-profilename';
        $.ajax({
            type: "POST",
            cache: false,
            async: false,
            url: ops_url,
            data: {
                "load": 1,
                "acdyr_id": acdyr_id,
                "batch_id": batch_id,
                "searchname": searchname
            },
            success: function(result) {
                var data = JSON.parse(result)
                if (data.status == 1) {
                    $('#student-data-container').html('');
                    $('#student-data-container').html(data.view);
                    var animation = "fadeInDown";
                    $("#student-data-container").show();
                    $('#student-data-container').addClass('animated');
                    $('#student-data-container').addClass(animation);
                    $('#add_type').hide();
                } else {
                    alert('No data loaded');
                }
            }
        });
    }
</script>