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
                <div class="ibox-content" id="hiddenbutton"> 
                    <button class="btn btn-default btn-xs"><a href="<?php echo base_url('profile/show-class-for-students'); ?>"> <i class="fa fa-arrow-left" aria-hidden="true"></i> Student Profile</a></button>
                </div>
                <input type="hidden" name="acd_year_data" id="acd_year_data" value="<?php echo $this->session->userdata('acd_year'); ?>" />
                <div class="ibox-content" id="student-search-filter">
                    <div class="row">
                        <div class="col-lg-6 col-xs-12 col-md-12 ">
<!--                            <label for="male">Academic Year</label>
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
                            </div>-->
                        </div>

                        <div class="col-lg-6 col-xs-12 col-md-12 ">
                            <div class="form-group text-right" id="search_filter_btn">
                                <button type="button" onclick="advanced_search();" class="btn btn-primary btn-sm" data-toggle="tooltip" title="Search Students">Advanced Search</button>
                                <button type="button" onclick="search_student();" class="btn btn-primary btn-sm" data-toggle="tooltip" title="Search Students">Filter Students</button>
                        </div>
                        </div>
                        <div class="col-lg-12">
                            <div id="curd-content" style="display: none;"></div>
                        </div> 
                        <div class="col-lg-6">
                            <div class="panel panel-info">
                                <div class="panel-heading"><strong>UNCATEGORIZED</strong></div> 
                                <div class="ibox-content">
                                    <div class="row">
                                        <div class="scrollerdata">                                        
                                            <div class="col-lg-12">
                                                <div class="scroll_content">
                                                    <div class="contact-box list-item">
                                                        <div class="col-lg-12">
                                                            <div style="color:#676a6c;"> Batch : <strong>STUDENTS WITH NO BATCH</strong></div>
                                                            <div style="color:#676a6c;" class="fl"> Strength : <span class="label label-primary" style="background-color:#47d049"><?php echo $batch_count_no_batch ?></span>
                                                            </div>
                                                            <div class="fr"> 
                                                                <a href="javascript:void(0);" onclick="load_students_after_filter('-1')" class="btn btn-xs btn-outline btn-info pull-right" style="border-color:white;" class="material-icons" data-toggle="tooltip" title="List of students">List <i class="fa fa-long-arrow-right"></i> </a>
                                                            </div>
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
                        </div>
                        <?php
                        if (isset($batch_data) && !empty($batch_data)) {
                            $i = 1;
                            foreach ($batch_data as $batch) {
                                ?>
                                <div class="col-lg-6">
                                    <div class="panel panel-info">   
                                        <div class="panel-heading"><strong><?php echo $batch['class_details']['description'] ?> </strong></div> 
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
                                                                                <a href="javascript:void(0);" onclick="load_students_after_filter('<?php echo $batchlist['batchid']; ?>')" class="btn btn-xs btn-outline btn-info pull-right" style="border-color:white;" class="material-icons" data-toggle="tooltip" title="List of students">List <i class="fa fa-long-arrow-right"></i> </a>
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

                                <?php
                                if ($i == 1) {
                                    echo '<div class="clearfix"></div>';
                                    $i = 0;
                                } else {
                                    $i++;
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
<script>

    $(document).ready(function () {

        // Add slimscroll to element
        $('.scrollerdata').slimscroll({
            height: '75px'
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

    function load_students_after_filter(batchid, acd_yr = -1) {
//        var acd_yr_id = "#acd_year" + class_id;
        if (acd_yr < 0 ) {
            acd_yr = $('#acd_year_data').val()
        }

        var ops_url = baseurl + 'profile/show-profile';
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
     function advanced_search() {
                var ops_url = baseurl + 'advanced_search/profile_initial_page/';
                $.ajax({
                    type: "POST",
                    cache: false,
                    async: false,
                    url: ops_url,
                    data: {"load": 1},
                    success: function (result) {
                        $('#curd-content').html(result);
                         var animation = "SlideDown";
                    $("#curd-content").show();
                    $('#curd-content').addClass('animated');
                    $('#curd-content').addClass(animation);
                    $('#add_type').hide();
                    $('#search_filter_btn').hide();
                    }
                });
            }
    function search_student() {

        var acd_year=$("#acd_year").val();

        var ops_url = baseurl + 'profile/show-filter';
        $.ajax({
            type: "POST",
            cache: false,
            async: false,
            url: ops_url,
            data: {"load": 1, "acd_year":acd_year},
            success: function (data) {
                if (data) {
                    $('#curd-content').html(data);
                    var animation = "SlideDown";
                    $("#curd-content").show();
                    $('#curd-content').addClass('animated');
                    $('#curd-content').addClass(animation);
                    $('#add_type').hide();
                    $('#search_filter_btn').hide();
                } else {
                    alert('No data loaded');
                }
            }
        });
    }
     $("#hiddenbutton").hide();

</script>