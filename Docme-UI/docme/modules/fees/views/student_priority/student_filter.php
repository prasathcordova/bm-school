<div class="wrapper wrapper-content animated fadeInRight" style="padding-top: 1px !important;padding-left: 0px !important;padding-right: 0px !important;">
    <div class="row" style="margin-left: -29px !important; margin-right: -30px !important;">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">

                    <!--                     <div class="image">
                                                                <img alt="image" class="img-responsive" src="<?php echo $img1; ?>">
                                                            </div>-->
                    <h5><?php echo isset($sub_title) ? $sub_title : "NO TITLE PROVIDED" ?></h5>

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
                    <!--                    <div class="row m-b-sm m-t-sm" id="search-feecode">
                                            <div class="col-md-1">
                                                
                                            </div> 
                                           
                                        </div>-->
                    <div class="wrapper wrapper-content animated fadeInRight" id="student-data-container">

                        <div class="row" id="data-view-feecode">

                            <?php
                            //    $search_image = base_url('assets/img/searchicon.jpg');
                            //    $advancedsearch = base_url('assets/img/advancedsearch.jpg');
                            $student_img = base_url('assets/img/a8.jpg');
                            ?>
                            <div class="row" id="data-view-feecode" style="padding-left:20px !important;">

                                <h3 id="admission_div_h">Student Direct Search
                                    <!--<img alt="image" style="width:54px!important;" src="<?php echo $search_image; ?>">-->
                                </h3>
                                <!--<hr>-->

                                <div class="row" id="admission_div">
                                    <div class="col-md-12">
                                        <b>Admission No.</b>
                                        <div class="form-group">
                                            <div class="form-line">
                                                <div class="input-group"><input type="text" id="searchname" name="searchname" placeholder="Enter Admission Number" class="form-control"> <span class="input-group-btn">
                                                        <button type="button" id="search_name_btn" class="btn btn-primary" onclick="search_name();"><i class="fa fa-search"></i> </button> </span>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>

                                <h3 id="advanced_search_h">Student Advanced Search
                                    <!--<img alt="image" style="width:54px!important;" src="<?php echo $advancedsearch; ?>">-->
                                </h3>

                                <div id="advanced_search" class="row">
                                    <div class="col-lg-6 col-xs-8 col-md-8">
                                        <div class="form-group ">
                                            <label>Academic Year :</label>
                                            <select onchange="changed_class();" class="select2_registration form-control" id="academic_year" name="academic_year" style="width: 100%" onchange="load_batch_data();">
                                                <?php
                                                if (isset($acdyr_data) && !empty($acdyr_data)) {
                                                    foreach ($acdyr_data as $acd) {

                                                        if (isset($acd['Acd_ID']) && !empty($acd['Acd_ID']) && $this->session->userdata('acd_year') == $acd['Acd_ID']) {
                                                            echo '<option selected value="' . $acd['Acd_ID'] . '" data-fromyear="' . $acd['From_Year'] . '" data-toyear="' . $acd['To_Year'] . '" >' . $acd['Description'] . '</option>';
                                                        } else {
                                                            echo '<option value="' . $acd['Acd_ID'] . '" data-fromyear="' . $acd['From_Year'] . '" data-toyear="' . $acd['To_Year'] . '" >' . $acd['Description'] . '</option>';
                                                        }
                                                        //                                                            echo '<option value="' . $acd['Acd_ID'] . '" data-fromyear="' . $acd['From_Year'] . '" data-toyear="' . $acd['To_Year'] . '" >' . $acd['Description'] . '</option>';
                                                    }
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>


                                    <div class="col-lg-6 col-xs-8 col-md-8">
                                        <div class="form-group <?php
                                                                if (form_error('stream_id')) {
                                                                    echo 'has-error';
                                                                }
                                                                ?>">
                                            <label>Stream</label><span class="mandatory"> *</span><br />

                                            <select name="stream_id" id="stream_id" class="form-control " style="width:100%;" onchange="changed_class();">

                                                <option selected value="-1">Select</option>
                                                <?php
                                                if (isset($stream_data) && !empty($stream_data)) {
                                                    foreach ($stream_data as $stream) {
                                                        if (isset($stream['stream_id']) && !empty($stream['stream_id']) && 1 == $stream['stream_id']) {
                                                            echo '<option selected value="' . $stream['stream_id'] . '">' . $stream['description'] . '</option>';
                                                        } else {
                                                            echo '<option value="' . $stream['stream_id'] . '">' . $stream['description'] . '</option>';
                                                        }
                                                    }
                                                }
                                                ?>
                                            </select>
                                            <?php echo form_error('stream_id', '<div class="form-error">', '</div>'); ?>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-xs-8 col-md-8">
                                        <div class="form-group <?php
                                                                if (form_error('class_id')) {
                                                                    echo 'has-error';
                                                                }
                                                                ?>">
                                            <label>Class</label><span class="mandatory"> *</span><br />

                                            <select name="class_id" id="class_id" class="form-control " style="width:100%;" onchange="changed_class();">
                                                <!--<select name="class_id" id="class_id"  class="form-control " style="width:100%;" >-->

                                                <option selected value="-1">Select</option>
                                                <?php
                                                if (isset($class_data_for_registration) && !empty($class_data_for_registration)) {
                                                    foreach ($class_data_for_registration as $class_for_dive) {

                                                        echo '<option value="' . $class_for_dive['Course_Det_ID'] . '" data-masterid="' . $class_for_dive['Course_Master_ID'] . '"  >' . $class_for_dive['Description'] . '</option>';
                                                    }
                                                }
                                                ?>
                                            </select>
                                            <?php echo form_error('class_id', '<div class="form-error">', '</div>'); ?>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-xs-8 col-md-8">
                                        <b>Batch</b>
                                        <div class="form-group">
                                            <div>
                                                <select class="select2_registration form-control" id="batch_id" name="batch_id">
                                                    <?php
                                                    if (isset($batch_data) && !empty($batch_data)) {
                                                        echo '<option selected value="-1">All Selected</option>';
                                                        foreach ($batch_data as $batch) {
                                                            echo '<option value="' . $batch['BatchID'] . '">' . $batch['Batch_Name'] . '</option>';
                                                        }
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <b>Student Name</b>
                                        <div class="form-group">
                                            <div class="form-line">
                                                <div class="input-group"><input type="text" placeholder="Enter Student Name" id="sname" name="sname" class="form-control"> <span class="input-group-btn">
                                                        <button id="btn_id_2" type="button" class="btn btn-primary" onclick="searchadvance_filtername();"><i class="fa fa-search"></i>
                                                        </button> </span></div>
                                            </div>
                                        </div>

                                    </div>
                                </div>

                            </div>


                        </div>
                        <!--</div>-->
                    </div>
                    <!--</div>-->
                </div>
            </div>
        </div>
    </div>
</div>


<script type="text/javascript">
    function searchadvance_filtername() {
        var ops_url = baseurl + 'fees/show-studentpriority/';
        $.ajax({
            type: "POST",
            cache: false,
            async: false,
            url: ops_url,
            data: {
                "load": 1
            },
            success: function(result) {
                $('#data-view').html(result);
            }
        });
    }
</script>