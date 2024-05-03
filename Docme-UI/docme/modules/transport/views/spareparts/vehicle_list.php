<style>
    .cornerround {
        width: 170px;
        height: 170px;
        position: absolute;
        text-align: center;
        padding-top: 25px;
        border-radius: 50%;
        background: #fff;
        border: 1px solid #00b1ac;
        z-index: 2222;
    }

    .cornerround:after {
        content: '';
        position: absolute;
        top: -3px;
        right: 6px;
        border: 6px solid #00b1ac;
        border-left: 0;
        border-bottom-right-radius: 100px;
        border-top-right-radius: 100px;
        width: 90px;
        height: calc(100% + 13px);
        transform: rotate(340deg) translate(15px, -15px);
        -ms-transform: rotate(340deg) translate(15px, -15px);
        -moz-transform: rotate(340deg) translate(15px, -15px);
        -webkit-transform: rotate(340deg) translate(15px, -15px);
        -o-transform: rotate(340deg) translate(15px, -15px);
    }
</style>
<?php
$bus_img = base_url('assets/img/tourbus.jpg');
$car_img = base_url('assets/img/car.jpg');
$jeep_img = base_url('assets/img/jeep.jpg');
?>
<div class="col-lg-12">
    <div class="row">
        <?php
        if (isset($vehicle_data) && !empty($vehicle_data) && is_array($vehicle_data)) {
            $breaker = 0;
            foreach ($vehicle_data as $vehicles) {
        ?>
                <div class="col-lg-3">
                    <div class="contact-box center-version">
                        <!--<span class="label label-warning pull-right">Official</span>-->
                        <!--                       <div class="i-checks  pull-right" style="padding-top:10px!important;padding-right: 5px;"><label> 
                                                                <?php // if (isset($feedback_subject_data) && !empty($feedback_subject_data) && (in_array($subjectdata['subject_batch_id'], array_column($feedback_subject_data, 'submapid')))) { 
                                                                ?>
                                                                    <input data-toggle="tooltip" data-placement="right" class="data_part" data-confirmid="<?php echo $subjectdata['subject_batch_id']; ?>"  id="<?php echo $subjectdata['subject_batch_id']; ?>" type="checkbox" value="" checked=""> 
                                                                <?php // } else { 
                                                                ?>
                               <input data-toggle="tooltip" data-placement="right" class="checkbox" data-empid="<?php echo $vehicles['id']; ?>"id="<?php echo $vehicles['id']; ?>" type="checkbox" value="" > 
                               
                                                                    <?php
                                                                    //                                                                }
                                                                    ?>

                                                            </label>
                                                        </div>-->
                        <a href="javascript:void(0);" style="height:191px !important;">
                            <?php
                            $profile_image = "";
                            if (isset($vehicles['profile_image']) && !empty($vehicles['profile_image'])) {

                                $profile_image = "data:image/jpeg;base64," . $vehicles['profile_image'];
                            } else {
                                if (isset($student['profile_image_alternate']) && !empty($student['profile_image_alternate'])) {
                                    $profile_image = $student['profile_image_alternate'];
                                } else {
                                    $profile_image =  $bus_img;
                                }
                            }
                            ?>
                            <img alt="image" class="img-circle" src="<?php echo $profile_image; ?>">
                            <h3 class="m-b-xs"><strong><?php echo $vehicles['vehicleNum'] ?></strong></h3>

                            <div class="font-bold">Registration Num:<?php echo $vehicles['registrationNum'] ?></div>

                        </a>

                        <div class="ibox-content" style=" padding: 10px 15px 25px 15px;">
                            <span class="label label-info pull-left">Bus
                            </span>
                            <a>
                                <div class="stat-percent font-bold text-info" onclick="load_spareparts('<?php echo $vehicles['id']; ?>','<?php echo $vehicles['vehicleNum']; ?>');"><i class="fa fa-stack-overflow" aria-hidden="true" style="padding:1px 5px 0 0;"> </i> Add Spare Part
                                </div>

                        </div></a>
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
    function load_spareparts(id, vehicleNum) {
        var vehicle_id = id;
        var vehicleNum = vehicleNum;
        var ops_url = baseurl + 'transport/load-spareparts/';
        $.ajax({
            type: "POST",
            cache: false,
            async: false,
            url: ops_url,
            data: {
                "load": 1,
                "id": vehicle_id,
                "vehicleNum": vehicleNum
            },
            success: function(result) {
                $('#data-view').html(result);
            }
        });

    }
</script>