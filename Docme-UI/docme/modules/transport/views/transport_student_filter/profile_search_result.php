<div class="col-lg-12">
    <div class="row">
        <?php
        if (isset($details_data) && !empty($details_data) && is_array($details_data)) {
            $breaker = 0;
            foreach ($details_data as $student) {
        ?>
                <div class="col-lg-3">
                    <div class="contact-box center-version">
                        <!--<span class="label label-warning pull-right">Official</span>-->
                        <div class="i-checks  pull-right" style="padding-top:10px!important;padding-right: 5px;"><label>
                                <?php // if (isset($feedback_subject_data) && !empty($feedback_subject_data) && (in_array($subjectdata['subject_batch_id'], array_column($feedback_subject_data, 'submapid')))) { 
                                ?>
                                <!--<input data-toggle="tooltip" data-placement="right" class="data_part" data-confirmid="<?php echo $subjectdata['subject_batch_id']; ?>"  id="<?php echo $subjectdata['subject_batch_id']; ?>" type="checkbox" value="" checked="">-->
                                <?php // } else { 
                                ?>
                                <input data-toggle="tooltip" data-placement="right" class="data_part" data-studentid="<?php echo $student['student_id']; ?>" data-studentname="<?php echo $student['student_name'] ?>" data-admnno="<?php echo $student['Admn_No'] ?>" id="<?php echo $student['student_id']; ?>" type="checkbox" value="">
                                <?php
                                //                                                                }
                                ?>

                            </label>
                        </div>
                        <a href="javascript:void(0);" style="height:220px !important;">
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
                            <h3 class="m-b-xs"><strong><?php echo $student['student_name'] ?></strong></h3>

                            <div class="font-bold">Admission No:<?php echo $student['Admn_No'] ?></div>

                        </a>



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
</script>