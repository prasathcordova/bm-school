
<?php
//    $search_image = base_url('assets/img/searchicon.jpg');
//    $advancedsearch = base_url('assets/img/advancedsearch.jpg');
$student_img = base_url('assets/img/a8.jpg');
?>
<div class="row" id="data-view-feecode" style="padding-left:20px !important;">
    <h3 id="advanced_search_h" style="padding-bottom:10px!important;">Student Advanced Search
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
                <label>Stream</label><span class="mandatory" > *</span><br/>

                <select name="stream_id" id="stream_id"  class="form-control " style="width:100%;" onchange="changed_class();" >                                

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
                <label>Class</label><span class="mandatory" > *</span><br/>

                <select name="class_id" id="class_id"  class="form-control " style="width:100%;" onchange="changed_class();" >                                
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
                                                <div class="input-group"><input type="text" placeholder="Enter Student Name" id="sname" name="sname"class="form-control"> <span class="input-group-btn"> 
                                                        <button id="btn_id_2" type="button" class="btn btn-primary" onclick="search_load_students();"><i class="fa fa-search"></i>
                                                        </button> </span></div>     
                                            </div>                           
                                        </div>

                                    </div>
    </div>


</div>





<script type="text/javascript">
                    $('.i-checks').iCheck({
                        checkboxClass: 'icheckbox_square-green',
                        radioClass: 'iradio_square-green'
                    });
                    $('#academic_year').select2({
                        'theme': 'bootstrap'
                    });
                    $('#stream_id').select2({
                        'theme': 'bootstrap'
                    });
                    $('#class_id').select2({
                        'theme': 'bootstrap'
                    });
                    $('#batch_id').select2({
                        'theme': 'bootstrap'
                    });
                    
        function search_load_students() {
             var ops_url = baseurl + 'fees/student-periodic-configure/';
        $.ajax({
            type: "POST",
            cache: false,
            async: false,
            url: ops_url,
            data: {"load": 1},
            success: function (result) {
                $('#data-view-feecode').html(result);
            }
        });
        }            
                    

</script>