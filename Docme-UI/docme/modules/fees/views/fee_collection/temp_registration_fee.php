<div class="wrapper wrapper-content animated fadeInRight" style="padding-top: 1px !important;padding-left: 0px !important;padding-right: 0px !important;">
    <div class="row" style="margin-left: -29px !important; margin-right: -30px !important;">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title" style="border-bottom-color:#23C6C8!important">
                    <h5 style="color: #1c84c6;"><?php echo isset($sub_title) ? $sub_title : "NO TITLE PROVIDED" ?></h5>
                    <!-- <div class="ibox-tools" id="add_type">
                        <a data-toggle="modal" class="btn btn-primary btn-xs" data-toggle="tooltip" title="Add a New Pickup Point" data-placement="left" href="javascript:void(0)" onclick="add_new_pickuppoint();">ADD NEW Pickup POINT</a>
                    </div> -->
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
                    <div class="wrapper wrapper-content animated fadeInRight" id="student-data-container">

                        <div class="row">
                            <div class="col-lg-12">
                                <div id="curd-content" style="display: none;"></div>
                            </div>
                            <div class="col-lg-12">
                                <div class="col-lg-6 col-xs-12 col-md-12">
                                    <div class="form-group ">
                                        <label>Academic Year *</label>
                                        <select class="select2_registration form-control" id="academic_year" name="academic_year" style="width: 100%">
                                            <?php
                                            if (isset($acdyr_data) && !empty($acdyr_data)) {
                                                foreach ($acdyr_data as $acd) {
                                                    echo '<option value="' . $acd['Acd_ID'] . '" data-fromyear="' . $acd['From_Year'] . '" data-toyear="' . $acd['To_Year'] . '" >' . $acd['Description'] . '</option>';
                                                }
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-xs-12 col-md-12">
                                    <div class="form-group ">
                                        <label>Class *</label><span class="mandatory"> </span><br />

                                        <select name="class_id" id="class_id" class="form-control " style="width:100%;">
                                            <!--<select name="class_id" id="class_id"  class="form-control " style="width:100%;" >-->

                                            <option selected value="-1">Select</option>
                                            <option selected value="1000">All</option>
                                            <?php
                                            if (isset($class_data_for_registration) && !empty($class_data_for_registration)) {
                                                foreach ($class_data_for_registration as $class_for_dive) {

                                                    echo '<option value="' . $class_for_dive['Course_Det_ID'] . '" data-masterid="' . $class_for_dive['Course_Master_ID'] . '"  >' . $class_for_dive['Description'] . '</option>';
                                                }
                                            }
                                            ?>
                                        </select>

                                    </div>
                                </div>
                                <div class="col-lg-12 col-md-12 col-xs-12">
                                    <a href="javascript:void(0);" class="btn btn-primary btn-sm" onclick="get_data();" title="Show Payments">Show Payments</a>
                                    <!--<a class="btn btn-danger btn-sm" onclick="canceldata();"> Cancel</a>-->
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
                <div class="registration-list">

                </div>
            </div>
        </div>
    </div>
</div>


<script type="text/javascript">
    $('#academic_year').select2({
        'theme': 'bootstrap'
    });
    $('#class_id').select2({
        'theme': 'bootstrap'
    });
    get_data();

    function get_data() {
        $('.registration-list').show();
        var acd_yr = $('#academic_year').val();
        var class_id = $('#class_id').val();
        if (acd_yr == -1) {
            swal('', 'Academic Year id required.', 'info');
            $('#faculty_loader').removeClass('sk-loading');
            return false;
        }
        if (class_id == -1) {
            swal('', 'Class is required.', 'info');
            $('#faculty_loader').removeClass('sk-loading');
            return false;
        }
        var ops_url = baseurl + 'fees/get_temp_payment_status/';
        $.ajax({
            type: "POST",
            cache: false,
            async: false,
            url: ops_url,
            data: {
                "load": 1,
                "acd_yr": acd_yr,
                "class_id": class_id,
                "flag": 2
            },
            success: function(result) {
                var data = JSON.parse(result);
                if (data.status == 1) {
                    $('.registration-list').html(data.view);
                } else {
                    swal('', 'No Data Found.', 'success');
                }
            }
        });
    }
</script>