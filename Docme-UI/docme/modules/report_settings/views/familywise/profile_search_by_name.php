<div class="wrapper wrapper-content animated fadeInRight" id="student-data-container">
    <div class="row">
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
                                <a href="javascript:void(0);" title='Family Report' onclick="familyreport('<?php echo $student['student_id']; ?>')" class="btn btn-xs btn-info"><i class="fa fa-list"></i> Family Report</a>
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
        }
        ?>
    </div>
</div>
<script>
    $(document).ready(function() {

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


    function search_name(acdyr_id, batch_id) {
        var searchname = $('#searchname').val();
        var ops_url = baseurl + 'familyreport/search-profilename';
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