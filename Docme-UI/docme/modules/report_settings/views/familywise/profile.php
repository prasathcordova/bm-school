<script src="<?php echo base_url('assets/plugins/validate/jquery.validate.min.js'); ?>"></script>

<div class="wrapper wrapper-content animated fadeInRight" style="padding-top: 1px !important;padding-left: 0px !important;padding-right: 0px !important;">
    <div class="row" style="margin-left: -29px !important; margin-right: -30px !important;">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-content">
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <div class="input-group">
                                <input type="text" id="searchname" name="searchname" placeholder="Search student by Name/Admission Number" class=" form-control">
                                <span class="input-group-btn">
                                    <button type="button" class="btn btn-info" onclick="searchbyname('<?php echo $acdyr_id; ?>', '<?php echo $batch_id; ?>');" title="Search"> Search</button>

                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <input type="hidden" name="batchid" id="batchid" value="<?php echo isset($batchid) && !empty($batchid) ? $batchid : ''; ?>" />

                        <!--                            <div class="col-lg-12">
                                                        <div id="curd-content" style="display: none;"></div>
                                                    </div>-->
                        <div class="clearfix"></div>
                        <div class="wrapper wrapper-content animated fadeInRight" id="student-data-container">
                            <!-- <div class="row"> -->
                            <?php
                            if (isset($details_data) && !empty($details_data) && is_array($details_data)) {
                                $breaker = 0;
                                foreach ($details_data as $student) {
                            ?>
                                    <div class="col-lg-4">
                                        <div class="contact-box center-version">
                                            <!--<span class="label label-warning pull-right">Official</span>-->
                                            <a href="javascript:void(0)" style="overflow: hidden;cursor: default;">
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
                                                <h3 class="m-b-xs profile-name"><?php echo $student['student_name'] ?></h3>

                                                <div>
                                                    <p>Class :
                                                        <?php echo isset($student['Description']) && !empty($student['Description']) ? $student['Description'] : 'NIL'; ?>
                                                    </p>
                                                    <p>Batch :
                                                        <?php echo isset($student['Batch_Name']) && !empty($student['Batch_Name']) ? $student['Batch_Name'] : 'Un Assigned'; ?>
                                                    </p>
                                                </div>
                                                <div class="font-bold">Admission No.:<?php echo $student['Admn_No'] ?></div>
                                            </a>

                                            <div class="contact-box-footer">
                                                <div class="m-t-xs btn-group">
                                                    <a href="javascript:void(0);" onclick="familyreport('<?php echo $student['student_id']; ?>')" class="btn btn-xs btn-info" title="Family Report"><i class="fa fa-list"></i> Family Report</a>
                                                    <!--                                                            <a href="javascript:void(0);" onclick="send_personal_email('<?php echo $student['student_id']; ?>','<?php echo $acdyr_id; ?>','<?php echo $batch_id; ?>')" class="btn btn-xs btn-white "><i class="fa fa-envelope"></i> Email</a>
                                                        <a href="javascript:void(0);" onclick="fees_detail('<?php echo $student['student_id']; ?>')" class="btn btn-xs btn-white"><i class="fa fa-user-plus"></i> Fee Details</a> -->
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                <?php
                                    if ($breaker == 2) {
                                        echo '<div class="clearfix"></div>';
                                        $breaker = 0;
                                    } else {
                                        $breaker++;
                                    }
                                }
                            } else {
                                ?>

                                <div class="col-lg-12">
                                    <h3 class=" text-muted">No data available.</h3>
                                </div>

                            <?php
                            }
                            ?>
                            <!-- </div> -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
<script>
    $(document).ready(function() {

        $('#searchname').on("keypress", function(e) {
            if (e.keyCode == 13) {
                if ($('#searchname').val().trim().length < 3) {
                    swal('', 'Enter atleast three character..!', 'info');
                    return false;
                } else {
                    searchbyname('<?php echo $acdyr_id; ?>', '<?php echo $batch_id; ?>');
                }
            }
        });

        $(".select2_demo_1").select2({
            "theme": "bootstrap",
            "width": "100%"

        });
        $(".select2_demo_2").select2({
            "theme": "bootstrap",
            "width": "100%"
        });
        $(".select2_demo_3").select2({
            "theme": "bootstrap",
            "width": "100%"
        });

        $('#data_1 .input-group.date').datepicker({
            todayBtn: "linked",
            keyboardNavigation: false,
            forceParse: false,
            calendarWeeks: true,
            autoclose: true
        });

        $('#search_student').hide();

        $('.i-checks').iCheck({
            checkboxClass: 'icheckbox_square-green',
            radioClass: 'iradio_square-green',
        });


    });


    function familyreport(studentid) {
        var batchid = $('#batchid').val();
        var ops_url = baseurl + 'familyreport/show-familyreport/';
        $.ajax({
            type: "POST",
            cache: false,
            async: false,
            url: ops_url,
            data: {
                "load": 1,
                "studentid": studentid,
                "batchid": batchid
            },
            success: function(data) {
                try {
                    var datas = JSON.parse(data);
                    if (datas.status == 1) {
                        window.open(datas.message, '_blank');
                        $('#report_param_loader').removeClass('sk-loading');
                    } else {
                        if (datas.status == 3) {
                            if (datas.message) {
                                swal('', datas.message, 'info');
                                $('#report_param_loader').removeClass('sk-loading');
                                return false;
                            } else {
                                $('#report_param_loader').removeClass('sk-loading');
                                swal('', 'No Reports Available', 'info')
                            }
                        }
                    }
                } catch (e) {
                    $('#report_param_loader').removeClass('sk-loading');
                    swal('', 'An error encountered. Please try again later or contact administrator with the error code : DPRAPPUIJSNER10001', 'info');
                    return false;
                }
            }
        });
    }

    function show_search() {
        $('#search_student').slideDown("slow");
    }

    function hide_search() {
        $('#search_student').slideUp("slow");
    }


    function searchbyname(acdyr_id, batch_id) {
        if ($('#searchname').val() == '' || $('#searchname').val().trim().length < 3) {
            console.log('its work');
            swal('', 'Enter atleast three characters', 'info');
            return false;
        } else {
            const searchname = $('#searchname').val();
            const ops_url = baseurl + 'familyreport/search-profilename';
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
                    const data = JSON.parse(result)
                    if (data.status == 1) {
                        $('#student-data-container').html('');
                        $('#student-data-container').html(data.view);
                        var animation = "fadeInDown";
                        $("#student-data-container").show();
                        $('#student-data-container').addClass('animated');
                        $('#student-data-container').addClass(animation);
                        $('#add_type').hide();
                    } else {
                        swal('', 'No data available', 'info');
                        return false;
                    }
                }
            });
        }
    }
</script>