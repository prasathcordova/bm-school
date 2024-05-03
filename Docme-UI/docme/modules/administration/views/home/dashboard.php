<script src="<?php echo base_url('assets/theme/js/plugins/peity/jquery.peity.min.js'); ?>"></script>
<div class="wrapper wrapper-content">
    <div class="row   white-bg dashboard-header">
        <div class="col-lg-12">
            <?php
            $sales_till_yesterday = 0;
            $delivery_till_yesterday = 0;
            $deliverypending_till_yesterday = 0;
            $packing_not_billed = 0;
            ?>
            <div class="col-md-3">
                <?php $user_name = $this->session->userdata('user_name'); ?>
                <h3 class="font-normal">Welcome <?php echo isset($user_name) ? $user_name : "USER"; ?></h3>
                <ul class="list-group clear-list m-t">
                    <li class="list-group-item fist-item">
                        <span class="pull-right">
                            <?php echo (isset($count[0]['today_sales_billing']) && !empty($count[0]['today_sales_billing'])) ? $count[0]['today_sales_billing'] : '0'; ?>
                        </span>
                        <span class="label label-success">1</span> Today's Sales Bill Count
                    </li>
                    <li class="list-group-item">
                        <span class="pull-right">
                            <?php $packing_not_billed = $count[0]['packed'] - $count[0]['packed_billed']; ?>
                            <?php echo (isset($packing_not_billed) && !empty($packing_not_billed)) ? $packing_not_billed : '0'; ?>
                        </span>
                        <span class="label label-info">2</span> Packed Not Billed
                    </li>
                    <li class="list-group-item">
                        <span class="pull-right">
                            <?php $billed_not_delivered = $count[0]['billed'] - $count[0]['delivery']; ?>
                            <?php echo (isset($billed_not_delivered) && !empty($billed_not_delivered)) ? $billed_not_delivered : '0'; ?>
                        </span>
                        <span class="label label-primary">3</span> Delivery Pending
                    </li>
                    <li class="list-group-item">
                        <span class="pull-right">
                            <?php echo (isset($count[0]['OH_count']) && !empty($count[0]['OH_count'])) ? $count[0]['OH_count'] : '0'; ?>
                        </span>
                        <span class="label label-default">4</span> Today's Open House Events
                    </li>
                    <li class="list-group-item">
                        <span class="pull-right">
                            <?php echo (isset($count[0]['specimen_delivery_till_now']) && !empty($count[0]['specimen_delivery_till_now'])) ? $count[0]['specimen_delivery_till_now'] : '0'; ?>
                        </span>
                        <span class="label label-primary">5</span> Specimen Issue Count
                    </li>
                </ul>
            </div>
            <div class="col-md-6">
                <div>
                    <canvas id="barChart"></canvas>
                    <canvas id="lineChart" style="display:none;"></canvas>
                </div>
                <div class="row text-left">
                    <div class="col-xs-4">
                        <div class=" m-l-md">
                            <span class="h4 font-bold m-t block"><?php echo (isset($count[0]['stock']) && !empty($count[0]['stock'])) ? $count[0]['stock'] : '0'; ?></span>
                            <small class="text-muted m-b block">Stock report</small>
                        </div>
                    </div>
                    <div class="col-xs-4">
                        <span class="h4 font-bold m-t block"><?php echo CURRENCY  ?> <?php echo (isset($count[0]['Annual_sales_amount']) && !empty($count[0]['Annual_sales_amount'])) ? my_money_format($count[0]['Annual_sales_amount']) : '0'; ?> </span>
                        <small class="text-muted m-b block">Annual sales revenue</small>
                    </div>
                    <div class="col-xs-4">
                        <span class="h4 font-bold m-t block"><?php echo CURRENCY  ?> <?php echo (isset($count[0]['Daily_sales_amount']) && !empty($count[0]['Daily_sales_amount'])) ? my_money_format($count[0]['Daily_sales_amount']) : '0'; ?></span>
                        <small class="text-muted m-b block">Today Sales revenue</small>
                    </div>

                </div>
            </div>
            <div class="col-md-3">
                <div class="statistic-box">
                    <h4>
                        Store Summary
                    </h4>
                    <p>

                    </p>
                    <div class="row text-center">
                        <div class="col-lg-6">
                            <canvas id="doughnutChart2" width="90" height="90" style="margin: 18px auto 0"></canvas>
                            <h5>Open House</h5>
                        </div>
                        <div class="col-lg-6">
                            <canvas id="doughnutChart" width="90" height="90" style="margin: 18px auto 0"></canvas>
                            <h5>Loose Sale</h5>
                        </div>
                    </div>
                    <div class="row text-center">
                        <div class="col-lg-12">
                            <canvas id="doughnutChart3" width="90" height="90" style="margin: 18px auto 0"></canvas>
                            <h5>Specimen</h5>
                        </div>
                    </div>


                </div>
            </div>
        </div>
    </div>

    <div class="row white-bg dashboard-header">
        <div class="col-lg-4">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Packed but not billed</h5>
                    <div class="ibox-tools">
                        <span class="label label-warning-light pull-right">Last 10</span>
                    </div>
                </div>
                <div class="ibox-content no-padding">
                    <ul class="list-group">
                        <?php
                        if (isset($not_billed) && !empty($not_billed)) {
                            foreach ($not_billed as $not_billed) {


                                $profile_image = "";
                                if (!empty(get_student_image($not_billed['student_id']))) {
                                    $profile_image = get_student_image($not_billed['student_id']);
                                } else if (isset($not_billed['profile_image']) && !empty($not_billed['profile_image'])) {
                                    $profile_image = "data:image/jpeg;base64," . $not_billed['profile_image'];
                                } else {
                                    if (isset($not_billed['profile_image_alternate']) && !empty($not_billed['profile_image_alternate'])) {
                                        $profile_image = $not_billed['profile_image_alternate'];
                                    } else {
                                        $profile_image = base_url('assets/img/a0.jpg');
                                    }
                                }
                        ?>
                                <li class="list-group-item" style=" height: 120px">
                                    <img alt="image" class="img-circle pull-left" style="padding:10px;" height="90px;" src="<?php echo $profile_image; ?>">
                                    <p><span class="text-info" id="content_<?php echo $not_billed['student_id'] ?>" href="#"><?php echo $not_billed['student_name'] ?></span>
                                        <br>Admission No. : <span><?php echo $not_billed['Admn_No'] ?></span>
                                        <br><?php
                                            if ($not_billed['order_type_id'] == 3) {
                                                echo "OH Packing";
                                            } else {
                                                echo "Loose packing";
                                            }
                                            ?> of <?php echo $not_billed['total_qty'] ?> items</p>

                                    <small class="block text-muted pull-right"><?php echo $not_billed['date'] ?> </small>
                                    <small class="block text-muted"><i class="fa fa-clock-o"></i> <?php echo $not_billed['time'] ?> </small>
                                </li>
                        <?php
                            }
                        }
                        ?>

                    </ul>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5> Sales</h5>
                    <div class="ibox-tools">
                        <span class="label label-warning-light pull-right">Last 10 Sale</span>
                    </div>
                </div>
                <?php if (isset($sales) && !empty($sales)) { ?>
                    <div class="ibox-content">
                        <div>
                            <div class="feed-activity-list">
                                <?php
                                foreach ($sales as $sales) {
                                    $profile_image = "";
                                    if (!empty(get_student_image($sales['student_id']))) {
                                        $profile_image = get_student_image($sales['student_id']);
                                    } else
                                    if (isset($sales['profile_image']) && !empty($sales['profile_image'])) {

                                        $profile_image = "data:image/jpeg;base64," . $sales['profile_image'];
                                    } else {
                                        if (isset($sales['profile_image_alternate']) && !empty($sales['profile_image_alternate'])) {
                                            $profile_image = $sales['profile_image_alternate'];
                                        } else {
                                            $profile_image = base_url('assets/img/a0.jpg');
                                        }
                                    }
                                ?>


                                    <div class="feed-element" style=" height: 102px">
                                        <a href="javascript:void()" class="pull-left">
                                            <img alt="image" class="img-circle" src="<?php echo $profile_image; ?>">
                                        </a>
                                        <div class="media-body ">
                                            <strong><?php echo $sales['student_name'] ?></strong> billed amount <?php echo my_money_format($sales['final_pay_amount'], "<?php echo CURRENCY  ?>") ?> for <?php echo $sales['total_qty'] ?> items . <br>
                                            <small class="pull-right" style="color: #0000C0; margin-right: 10px;"><?php
                                                                                                                    if ($sales['order_type_id'] == 3) {

                                                                                                                        echo '<span class="label label-danger pull-right"> Open House Sale </span>';
                                                                                                                    } else {

                                                                                                                        echo '<span class="label label-primary pull-right"> Loose Sale </span>';
                                                                                                                    }
                                                                                                                    ?></small>
                                            <small class="text-muted">Bill Code : <?php echo $sales['billing_code'] ?> </small><br>
                                            <small>On <b><?php echo $sales['bill_date'] ?></b> by <b><?php echo $sales['Employe_name'] ?></b> </small>
                                        </div>
                                    </div>
                                <?php }
                                ?>
                            </div>
                        </div>
                    </div>
                <?php }
                ?>


            </div>
        </div>
        <div class="col-lg-4">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Billed but not delivered</h5>
                    <div class="ibox-tools">
                        <span class="label label-warning-light pull-right">Last 10</span>
                    </div>
                </div>
                <div class="ibox-content no-padding">
                    <ul class="list-group">
                        <?php
                        if (isset($not_delivered) && !empty($not_delivered)) {
                            foreach ($not_delivered as $not_delivered) {


                                $profile_image = "";
                                if (!empty(get_student_image($not_delivered['student_id']))) {
                                    $profile_image = get_student_image($not_delivered['student_id']);
                                } else
                                if (isset($not_delivered['profile_image']) && !empty($not_delivered['profile_image'])) {

                                    $profile_image = "data:image/jpeg;base64," . $not_delivered['profile_image'];
                                } else {
                                    if (isset($not_delivered['profile_image_alternate']) && !empty($not_delivered['profile_image_alternate'])) {
                                        $profile_image = $not_delivered['profile_image_alternate'];
                                    } else {
                                        $profile_image = base_url('assets/img/a0.jpg');
                                    }
                                }
                        ?>
                                <li class="list-group-item" style=" height: 120px">
                                    <img alt="image" class="img-circle pull-left" style="padding:10px;" height="70px;" src="<?php echo $profile_image; ?>">

                                    <p><span class="text-info" data-toggle="tooltip" title="" id="content_<?php echo $not_delivered['student_id'] ?>"><?php echo $not_delivered['student_name'] ?></span>
                                        <br>Admission No. : <span><?php echo isset($not_delivered['Admn_No']) ? $not_delivered['Admn_No'] : '' ?></span>
                                        <br> <?php echo $not_delivered['billing_code'] ?>
                                        <span class="label label-warning-light pull-right"> <?php echo CURRENCY  ?> <?php echo $not_delivered['final_pay_amount'] ?> </span>

                                        <?php // echo $not_delivered['total_qty']  
                                        ?> </p>
                                    <small class="block text-muted pull-right"><?php echo $not_delivered['date'] ?> </small>
                                    <small class="block text-muted"><i class="fa fa-clock-o"></i> <?php echo $not_delivered['time'] ?> </small>

                                </li>
                        <?php
                            }
                        }
                        ?>

                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<input type="hidden" class="input form-control" id="jan" name="jan" value="<?php echo (isset($graph_details[0][0]) && !empty($graph_details[0][0])) ? $graph_details[0][0] : '0'; ?>">
<input type="hidden" class="input form-control" id="feb" name="feb" value="<?php echo (isset($graph_details[1][0]) && !empty($graph_details[1][0])) ? $graph_details[1][0] : '0'; ?>">
<input type="hidden" class="input form-control" id="march" name="march" value="<?php echo (isset($graph_details[2][0]) && !empty($graph_details[2][0])) ? $graph_details[2][0] : '0'; ?>">
<input type="hidden" class="input form-control" id="april" name="april" value="<?php echo (isset($graph_details[3][0]) && !empty($graph_details[3][0])) ? $graph_details[3][0] : '0'; ?>">
<input type="hidden" class="input form-control" id="may" name="may" value="<?php echo (isset($graph_details[4][0]) && !empty($graph_details[4][0])) ? $graph_details[4][0] : '0'; ?>">
<input type="hidden" class="input form-control" id="june" name="june" value="<?php echo (isset($graph_details[5][0]) && !empty($graph_details[5][0])) ? $graph_details[5][0] : '0'; ?>">
<input type="hidden" class="input form-control" id="july" name="july" value="<?php echo (isset($graph_details[6][0]) && !empty($graph_details[6][0])) ? $graph_details[6][0] : '0'; ?>">
<input type="hidden" class="input form-control" id="aug" name="aug" value="<?php echo (isset($graph_details[7][0]) && !empty($graph_details[7][0])) ? $graph_details[7][0] : '0'; ?>">
<input type="hidden" class="input form-control" id="sep" name="sep" value="<?php echo (isset($graph_details[8][0]) && !empty($graph_details[8][0])) ? $graph_details[8][0] : '0'; ?>">
<input type="hidden" class="input form-control" id="oct" name="oct" value="<?php echo (isset($graph_details[9][0]) && !empty($graph_details[9][0])) ? $graph_details[9][0] : '0'; ?>">
<input type="hidden" class="input form-control" id="nov" name="nov" value="<?php echo (isset($graph_details[10][0]) && !empty($graph_details[10][0])) ? $graph_details[10][0] : '0'; ?>">
<input type="hidden" class="input form-control" id="dec" name="dec" value="<?php echo (isset($graph_details[11][0]) && !empty($graph_details[11][0])) ? $graph_details[11][0] : '0'; ?>">
<script>
    $(document).ready(function() {
        var barData = {
            labels: ["Jan", "Feb", "Mar", "Apr", "May", "June", "July", "Aug", "Sept", "Oct", "Nov", "Dec"],
            datasets: [

                {
                    label: "Revenue",
                    backgroundColor: 'rgba(26,179,148,0.5)',
                    borderColor: "rgba(26,179,148,0.7)",
                    pointBackgroundColor: "rgba(26,179,148,1)",
                    pointBorderColor: "#fff",
                    data: [$('#jan').val(), $('#feb').val(), $('#march').val(), $('#april').val(), $('#may').val(), $('#june').val(), $('#july').val(), $('#aug').val(), $('#sep').val(), $('#oct').val(), $('#nov').val(), $('#dec').val()]
                }
            ]
        };

        var barOptions = {
            responsive: true
        };


        var ctx2 = document.getElementById("barChart").getContext("2d");
        new Chart(ctx2, {
            type: 'bar',
            data: barData,
            options: barOptions
        });



        var doughnutData = {
            labels: ["Packed", " Billed", "Delivered"],
            datasets: [{
                data: ['<?php echo (isset($count[0]['today_sales_packing']) && !empty($count[0]['today_sales_packing'])) ? $count[0]['today_sales_packing'] : '0'; ?>', '<?php echo (isset($count[0]['today_billing_sales']) && !empty($count[0]['today_billing_sales'])) ? $count[0]['today_billing_sales'] : '0'; ?>', '<?php echo (isset($count[0]['today_delivery_sales']) && !empty($count[0]['today_delivery_sales'])) ? $count[0]['today_delivery_sales'] : '0'; ?>'],
                backgroundColor: ["#a3e1d4", "#dedede", "#9CC3DA"]
            }]
        };


        var doughnutOptions = {
            responsive: false,

            legend: {
                display: false
            },
            tooltips: {
                callbacks: {
                    title: function(tooltipItem, doughnutData) {
                        return doughnutData['labels'][tooltipItem[0]['index']];
                    },
                    label: function(tooltipItem, doughnutData) {
                        return doughnutData['datasets'][0]['data'][tooltipItem['index']];
                    }
                },
                backgroundColor: '#000',
                titleFontSize: 12,
                titleFontColor: '#fff',
                bodyFontColor: '#fff',
                bodyFontSize: 14,
                displayColors: false
            }
        };


        var ctx4 = document.getElementById("doughnutChart").getContext("2d");
        new Chart(ctx4, {
            type: 'doughnut',
            data: doughnutData,
            options: doughnutOptions
        });

        var doughnutData = {
            labels: ["Packed", " Billed", "Delivered"],
            datasets: [{
                data: ['<?php echo (isset($count[0]['today_OH_packing']) && !empty($count[0]['today_OH_packing'])) ? $count[0]['today_OH_packing'] : '0'; ?>', '<?php echo (isset($count[0]['today_billing_OH']) && !empty($count[0]['today_billing_OH'])) ? $count[0]['today_billing_OH'] : '0'; ?>', '<?php echo (isset($count[0]['today_delivery_OH']) && !empty($count[0]['today_delivery_OH'])) ? $count[0]['today_delivery_OH'] : '0'; ?>'],
                backgroundColor: ["#a3e1d4", "#dedede", "#9CC3DA"]
            }]
        };


        var doughnutOptions = {
            responsive: false,
            legend: {
                display: false
            },
            tooltips: {
                callbacks: {
                    title: function(tooltipItem, doughnutData) {
                        return doughnutData['labels'][tooltipItem[0]['index']];
                    },
                    label: function(tooltipItem, doughnutData) {
                        return doughnutData['datasets'][0]['data'][tooltipItem['index']];
                    }
                },
                backgroundColor: '#000',
                titleFontSize: 12,
                titleFontColor: '#fff',
                bodyFontColor: '#fff',
                bodyFontSize: 14,
                displayColors: false
            }
        };


        var ctx4 = document.getElementById("doughnutChart2").getContext("2d");
        new Chart(ctx4, {
            type: 'doughnut',
            data: doughnutData,
            options: doughnutOptions
        });
        var doughnutData = {
            labels: ["Packed", "Delivered"],
            datasets: [{
                data: ['<?php echo (isset($count[0]['today_spec_packing']) && !empty($count[0]['today_spec_packing'])) ? $count[0]['today_spec_packing'] : '0'; ?>', '<?php echo (isset($count[0]['today_delivery_spec']) && !empty($count[0]['today_delivery_spec'])) ? $count[0]['today_delivery_spec'] : '0'; ?>'],
                backgroundColor: ["#a3e1d4", "#dedede", "#9CC3DA"]
            }]
        };


        var doughnutOptions = {
            responsive: false,
            legend: {
                display: false
            },
            tooltips: {
                callbacks: {
                    title: function(tooltipItem, doughnutData) {
                        return doughnutData['labels'][tooltipItem[0]['index']];
                    },
                    label: function(tooltipItem, doughnutData) {
                        return doughnutData['datasets'][0]['data'][tooltipItem['index']];
                    }
                },
                backgroundColor: '#000',
                titleFontSize: 12,
                titleFontColor: '#fff',
                bodyFontColor: '#fff',
                bodyFontSize: 14,
                displayColors: false
            }
        };


        var ctx4 = document.getElementById("doughnutChart3").getContext("2d");
        new Chart(ctx4, {
            type: 'doughnut',
            data: doughnutData,
            options: doughnutOptions
        });



        setInterval(function() {
            window.location.reload();
        }, 300000);










    });
</script>