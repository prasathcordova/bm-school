<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" type="text/css">
<link href="<?php echo base_url("assets/theme/css/widget_style.css"); ?>" rel="stylesheet">
<!--Morris -->
<link href="<?php echo base_url('assets/theme/css/plugins/morris/morris-0.4.3.min.css'); ?>" rel="stylesheet">
<script src="<?php echo base_url("assets/theme/js/countUp.js"); ?>" type="text/javascript"></script>
<script src="<?php echo base_url('assets/theme/js/plugins/morris/raphael-2.1.0.min.js'); ?>"></script>
<script src="<?php echo base_url('assets/js/plugins/morris/morris.min.js'); ?>"></script>
<div class="wrapper wrapper-content animated fadeInRight" style="padding-top: 1px !important;padding-left: 0px !important;padding-right: 0px !important;">
    <div class="row" style="margin-left: -29px !important; margin-right: -30px !important;">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title" style="border-bottom-color:#ffd300 !important;">
                    <?php
                    $student_img = base_url('assets/img/a0.jpg');
                    ?>
                    <h5><?php echo isset($sub_title) ? $sub_title : "NO TITLE PROVIDED" ?></h5>
                    <span style="float:right;">

                    </span>
                    <!--                    <div class="ibox-tools" id="add_type">
                        <a data-toggle="modal" data-toggle="tooltip" title="Refresh Account Details of student,<?php echo $student_data['student_name']; ?> " data-placement="left"href="javascript:void(0)" onclick="refresh_student_account('<?php echo $student_data['student_id']; ?>','<?php echo $student_data['student_name']; ?>');"><i class="fa fa-refresh" style="font-size:20px;color:#23c6c8;font-weight: 1;"></i></a>
                    </div>-->
                </div>
                <div class="ibox-content" id="pay_loader">
                    <div class="sk-spinner sk-spinner-wave">
                        <div class="sk-rect1"></div>
                        <div class="sk-rect2"></div>
                        <div class="sk-rect3"></div>
                        <div class="sk-rect4"></div>
                        <div class="sk-rect5"></div>
                    </div>
                    <div class="clearfix"></div>

                    <div class="row">

                        <div class="clearfix"></div>

                        <?php //dev_export($transactions);
                        ?>
                        <div class="col-lg-12">
                            <div class="row clearfix">
                                <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                                    <h3>Credit Transactions</h3>
                                </div>
                                <div class="clearfix"></div>
                                <div class="col-lg-4 col-md-4 col-sm-6 col-xs-8">
                                    <div class="info-box bg-indigo hover-expand-effect hover-zoom-effect">
                                        <div class="icon">
                                            <i class="material-icons">attach_money</i>
                                        </div>
                                        <div class="content">
                                            <div class="text">CASH</div>
                                            <div class="number count-to" data-from="0" data-speed="1000" data-fresh-interval="20"><?php echo my_money_format($transactions['CASH']['cr']) ?></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                                    <div class="info-box bg-pink hover-expand-effect hover-zoom-effect">
                                        <div class="icon">
                                            <i class="material-icons">money_off</i>
                                        </div>
                                        <div class="content">
                                            <div class="text" style="margin-top: 7px;">CHEQUE <small>(RECONCILED)</small></div> <!-- VIA COUNTER -->
                                            <div class="number count-to" data-from="0" data-speed="1000" data-fresh-interval="20"><?php echo my_money_format($transactions['CHEQUE']['cr']) ?></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                                    <div class="info-box bg-blue hover-expand-effect hover-zoom-effect">
                                        <div class="icon">
                                            <i class="material-icons">account_balance_wallet</i>
                                        </div>
                                        <div class="content">
                                            <div class="text">CARD</div>
                                            <div class="number count-to" data-from="0" data-speed="1000" data-fresh-interval="20"><?php echo my_money_format($transactions['CARD']['cr']) ?></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                                    <div class="info-box bg-hotpink hover-expand-effect hover-zoom-effect">
                                        <div class="icon">
                                            <i class="material-icons">local_atm</i>
                                        </div>
                                        <div class="content">
                                            <div class="text">TRANSFER</div>
                                            <div class="number count-to" data-from="0" data-speed="1000" data-fresh-interval="20"><?php echo my_money_format($transactions['TRANSFER']['cr']) ?></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-6 col-xs-8">
                                    <div class="info-box bg-indigo hover-expand-effect hover-zoom-effect">
                                        <div class="icon">
                                            <i class="material-icons">attach_money</i>
                                        </div>
                                        <div class="content">
                                            <div class="text">DBT</div>
                                            <div class="number count-to" data-from="0" data-speed="1000" data-fresh-interval="20"><?php echo my_money_format((isset($transactions['DBT']['cr']) ? $transactions['DBT']['cr'] : 0)) ?></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                                    <div class="info-box bg-teal hover-expand-effect hover-zoom-effect">
                                        <div class="icon">
                                            <i class="material-icons">local_atm</i>
                                        </div>
                                        <div class="content">
                                            <div class="text">ONLINE</div>
                                            <div class="number count-to" data-from="0" data-speed="1000" data-fresh-interval="20"><?php echo my_money_format($transactions['ONLINE']['cr']) ?></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                                    <div class="info-box bg-teal hover-expand-effect hover-zoom-effect">
                                        <div class="icon">
                                            <i class="material-icons">local_atm</i>
                                        </div>
                                        <div class="content">
                                            <div class="text">SERVICE CHARGES</div>
                                            <div class="number count-to" data-from="0" data-speed="1000" data-fresh-interval="20"><?php echo my_money_format($transactions['CARD_SERVICE_CHARGE']['cr']) ?></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="clearfix"></div>
                                <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12" style="padding-top:30px;">
                                    <h3>Debit Transactions</h3>
                                </div>
                                <div class="clearfix"></div>
                                <div class="col-lg-4 col-md-4 col-sm-6 col-xs-8">
                                    <div class="info-box bg-indigo hover-expand-effect hover-zoom-effect">
                                        <div class="icon">
                                            <i class="material-icons">attach_money</i>
                                        </div>
                                        <div class="content">
                                            <div class="text">CASH</div>
                                            <div class="number count-to" data-from="0" data-speed="1000" data-fresh-interval="20"><?php echo my_money_format($transactions['CASH']['dr']) ?></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                                    <div class="info-box bg-pink hover-expand-effect hover-zoom-effect">
                                        <div class="icon">
                                            <i class="material-icons">money_off</i>
                                        </div>
                                        <div class="content">
                                            <div class="text">CHEQUE</small></div>
                                            <div class="number count-to" data-from="0" data-speed="1000" data-fresh-interval="20"><?php echo my_money_format($transactions['CHEQUE']['dr']) ?></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                                    <div class="info-box bg-blue hover-expand-effect hover-zoom-effect">
                                        <div class="icon">
                                            <i class="material-icons">account_balance_wallet</i>
                                        </div>
                                        <div class="content">
                                            <div class="text">CARD</div>
                                            <div class="number count-to" data-from="0" data-speed="1000" data-fresh-interval="20"><?php echo my_money_format($transactions['CARD']['dr']) ?></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                                    <div class="info-box bg-hotpink hover-expand-effect hover-zoom-effect">
                                        <div class="icon">
                                            <i class="material-icons">local_atm</i>
                                        </div>
                                        <div class="content">
                                            <div class="text">TRANSFER</div>
                                            <div class="number count-to" data-from="0" data-speed="1000" data-fresh-interval="20"><?php echo my_money_format($transactions['TRANSFER']['dr']) ?></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                                    <div class="info-box bg-teal hover-expand-effect hover-zoom-effect">
                                        <div class="icon">
                                            <i class="material-icons">local_atm</i>
                                        </div>
                                        <div class="content">
                                            <div class="text">ONLINE</div>
                                            <div class="number count-to" data-from="0" data-speed="1000" data-fresh-interval="20"><?php echo my_money_format($transactions['ONLINE']['dr']) ?></div>
                                        </div>
                                    </div>
                                </div>
                                <!-- Salahudheen October 1,2019 : Showing Exemption and Concession in Counter Collection Page-->
                                <div class="clearfix"></div>
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="padding-top:30px;">
                                    <h3>Others</h3>
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                                    <div class="info-box bg-green hover-expand-effect hover-zoom-effect">
                                        <div class="icon">
                                            <i class="fa fa-money"></i>
                                        </div>
                                        <div class="content">
                                            <div class="text">FEE EXEMPTION</div>
                                            <div class="number count-to" data-from="0" data-speed="1000" data-fresh-interval="20"><?php echo my_money_format($transactions['EXEMPTION']['cr']) ?></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                                    <div class="info-box bg-orange hover-expand-effect hover-zoom-effect">
                                        <div class="icon">
                                            <i class="fa fa-money"></i>
                                        </div>
                                        <div class="content">
                                            <div class="text">FEE CONCESSION</div>
                                            <div class="number count-to" data-from="0" data-speed="1000" data-fresh-interval="20"><?php echo my_money_format($transactions['CONCESSION']['cr']) ?></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                                    <div class="info-box bg-teal hover-expand-effect hover-zoom-effect">
                                        <div class="icon">
                                            <i class="material-icons">local_atm</i>
                                        </div>
                                        <div class="content">
                                            <div class="text">CHEQUE <small>(RECEIVED)</div>
                                            <div class="number count-to" data-from="0" data-speed="1000" data-fresh-interval="20"><?php echo my_money_format((isset($transactions['CHEQUE_TO_RECONCILE']['cr']) ? $transactions['CHEQUE_TO_RECONCILE']['cr'] : 0)) ?></div>
                                        </div>
                                    </div>
                                </div>
                                <!-- Salahudheen October 1,2019 : Showing Exemption and Concession in Counter Collection Page-->
                            </div>
                        </div>
                        <div class="clearfix"></div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<script type="text/javascript">
    $(function() {
        var countUp_elem = $('.count-to');
        var options = {
            useEasing: true,
            useGrouping: true,
            separator: ',',
            decimal: '.',
            prefix: '<i class="fa fa-inr" style="font-size:25px;"></i> '
        };
        //Syntax :  CountUp(id,startvalue.endvalue,decimal_points,Duration,Array of Options)            
        countUp_elem.each(function(index) {
            var counter_val = $(this).data('to');
            var countUp = new CountUp(countUp_elem[index], 0, counter_val, 2, 2, options);
            countUp.start();
        });
    });
    //    Morris.Donut({
    //        element: 'morris-donut-chart',
    //        data: [{label: "Cash", value: $('#cash').val()},
    //            {label: "Card", value: $('#card').val()},
    //            {label: "Cheque Reconciled", value: $('#cheque_recon').val()},
    //            {label: "Cheque Non Reconciled", value: $('#cheque_non_recon').val()},
    //            {label: "Wallet", value: $('#wallet').val()},
    //            {label: "online", value: $('#online').val()}
    //        ],
    //        resize: true,
    //        colors: ['#87d6c6', '#54cdb4', '#1ab394', '#1ab377'],
    //    });
    //    $('#tab1_header').click();



    function refresh_student_account(studentid, studentname) {
        var ops_url = baseurl + 'account/show-account';
        $.ajax({
            type: "POST",
            cache: false,
            async: false,
            url: ops_url,
            data: {
                "load": 1,
                "studentid": studentid,
                "studentname": studentname
            },
            success: function(result) {
                var data = JSON.parse(result);
                if (data.status == 1) {
                    $('#data-view').html('');
                    $('#data-view').html(data.view);
                    $('html, body').animate({
                        scrollTop: 0
                    }, 1000);
                } else {
                    if (data.message) {
                        swal('', data.message, 'info');
                        return false;
                    } else {
                        swal('', 'There was no data regarding the selected students. Please contact administrator for further assistance', 'info');
                        return false;
                    }
                }

            }
        });
    }
</script>