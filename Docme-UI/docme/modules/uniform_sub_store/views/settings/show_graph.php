<!-- <link href="<?php echo base_url('assets/theme/css/bootstrap.min.css'); ?>" rel="stylesheet"> -->
<link href="<?php echo base_url('assets/theme/font-awesome/css/font-awesome.css'); ?>" rel="stylesheet">

<!-- orris -->
<link href="<?php echo base_url('assets/theme/css/plugins/morris/morris-0.4.3.min.css'); ?>" rel="stylesheet">
<link href="<?php echo base_url('assets/theme/css/animate.css'); ?>" rel="stylesheet">
<link href="<?php echo base_url('assets/theme/css/style.css'); ?>" rel="stylesheet">


<!--<script src="<?php echo base_url('assets/theme/js/jquery-3.1.1.min.js'); ?>"></script>-->
<script src="<?php echo base_url('assets/theme/js/bootstrap.min.js'); ?>"></script>

<script src="<?php echo base_url('assets/theme/js/plugins/metisMenu/jquery.metisMenu.js'); ?>"></script>
<script src="<?php echo base_url('assets/theme/js/plugins/slimscroll/jquery.slimscroll.min.js'); ?>"></script>

<!--<script src="<?php echo base_url('assets/theme/js/inspinia.js'); ?>"></script>-->
<script src="<?php echo base_url('assets/theme/js/plugins/pace/pace.min.js'); ?>"></script>
<script src="<?php echo base_url('assets/theme/js/plugins/morris/raphael-2.1.0.min.js'); ?>"></script>
<script src="<?php echo base_url('assets/js/plugins/morris/morris.min.js'); ?>"></script>



<!-- Morris demo data-->

<div class="wrapper wrapper-content animated fadeInRight" style="padding-top: 1px !important;padding-left: 0px !important;padding-right: 0px !important;">
    <div class="row" style="margin-left: -29px !important; margin-right: -30px !important;">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <?php // echo  $count[0]['sales_packing']; 
                ?>
                <!--                <div class="ibox-title">
                                    <h5><?php // echo isset($sub_title) ? $sub_title : "NO TITLE PROVIDED"   
                                        ?></h5>
                                    <div class="ibox-tools" id="add_type">
                                        <button type="button" class="btn bg-teal waves-effect"  onclick="add_subject();">NEW SUBJECT</button>
                                        <span style="padding-right: 9px;"><a href="javascript:void(0);"  onclick="add_new_publisher();" >ADD PUBLISHER</a> </span>
                                    </div>
                                </div>-->
                <div class="ibox-content" id="faculty_loader">
                    <div class="sk-spinner sk-spinner-wave">
                        <div class="sk-rect1"></div>
                        <div class="sk-rect2"></div>
                        <div class="sk-rect3"></div>
                        <div class="sk-rect4"></div>
                        <div class="sk-rect5"></div>
                    </div>


                    <div class="row">
                        <div class="col-lg-12">
                            <div id="curd-content" style="display: none;"></div>
                        </div>
                        <div class="col-lg-4">
                            <h3>Loose Sales Data</h3>
                            <div id="morris-donut-chart"></div>
                        </div>
                        <div class="col-lg-4">
                            <h3>OH Packing Data</h3>
                            <div id="morris-donut-chart1"></div>
                        </div>
                        <div class="col-lg-4">
                            <h3>Specimen Data</h3>
                            <div id="morris-donut-chart2"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<input type="hidden" class="input form-control" id="sales_packing" name="sales_packing" value="<?php echo (isset($count[0]['sales_packing']) && !empty($count[0]['sales_packing'])) ? $count[0]['sales_packing'] : '0'; ?>">
<input type="hidden" class="input form-control" id="billing_sales" name="billing_sales" value="<?php echo (isset($count[0]['billing_sales']) && !empty($count[0]['billing_sales'])) ? $count[0]['billing_sales'] : '0'; ?>">
<input type="hidden" class="input form-control" id="delivery_sales" name="delivery_sales" value="<?php echo (isset($count[0]['delivery_sales']) && !empty($count[0]['delivery_sales'])) ? $count[0]['delivery_sales'] : '0'; ?>">
<input type="hidden" class="input form-control" id="delivery_return" name="delivery_return" value="<?php echo (isset($count[0]['delivery_return']) && !empty($count[0]['delivery_return'])) ? $count[0]['delivery_return'] : '0'; ?>">
<input type="hidden" class="input form-control" id="OH_packing" name="OH_packing" value="<?php echo (isset($count[0]['OH_packing']) && !empty($count[0]['OH_packing'])) ? $count[0]['OH_packing'] : '0'; ?>">
<input type="hidden" class="input form-control" id="billing_OH" name="billing_OH" value="<?php echo (isset($count[0]['billing_OH']) && !empty($count[0]['billing_OH'])) ? $count[0]['billing_OH'] : '0'; ?>">
<input type="hidden" class="input form-control" id="delivery_OH" name="delivery_OH" value="<?php echo (isset($count[0]['delivery_OH']) && !empty($count[0]['delivery_OH'])) ? $count[0]['delivery_OH'] : '0'; ?>">
<input type="hidden" class="input form-control" id="delivery_OH_return" name="delivery_OH_return" value="<?php echo (isset($count[0]['delivery_OH_return']) && !empty($count[0]['delivery_OH_return'])) ? $count[0]['delivery_OH_return'] : '0'; ?>">
<input type="hidden" class="input form-control" id="spec_packing" name="spec_packing" value="<?php echo (isset($count[0]['spec_packing']) && !empty($count[0]['spec_packing'])) ? $count[0]['spec_packing'] : '0'; ?>">
<input type="hidden" class="input form-control" id="billing_spec" name="billing_spec" value="<?php echo (isset($count[0]['billing_spec']) && !empty($count[0]['billing_spec'])) ? $count[0]['billing_spec'] : '0'; ?>">
<input type="hidden" class="input form-control" id="delivery_spec" name="delivery_spec" value="<?php echo (isset($count[0]['delivery_spec']) && !empty($count[0]['delivery_spec'])) ? $count[0]['delivery_spec'] : '0'; ?>">
<input type="hidden" class="input form-control" id="delivery_spec_return" name="delivery_spec_return" value="<?php echo (isset($count[0]['delivery_spec_return']) && !empty($count[0]['delivery_spec_return'])) ? $count[0]['delivery_spec_return'] : '0'; ?>">

<script>
    Morris.Donut({
        element: 'morris-donut-chart',
        data: [{
                label: "Packed",
                value: $('#sales_packing').val()
            },
            {
                label: "Billed",
                value: $('#billing_sales').val()
            },
            {
                label: "Delivered",
                value: $('#delivery_sales').val()
            },
            {
                label: " Returned",
                value: $('#delivery_return').val()
            }
        ],
        resize: true,
        colors: ['#87d6c6', '#54cdb4', '#1ab394', '#1ab377'],
    });
    Morris.Donut({
        element: 'morris-donut-chart1',
        data: [{
                label: "Packed",
                value: $('#OH_packing').val()
            },
            {
                label: "Billed",
                value: $('#billing_OH').val()
            },
            {
                label: "Delivered",
                value: $('#delivery_OH').val()
            },
            {
                label: " Returned",
                value: $('#delivery_OH_return').val()
            }
        ],
        resize: true,
        colors: ['#87d6c6', '#54cdb4', '#1ab394', '#1ab377'],
    });
    Morris.Donut({
        element: 'morris-donut-chart2',
        data: [{
                label: "Packed",
                value: $('#spec_packing').val()
            },
            //            {label: "Billed", value: $('#billing_spec').val()},
            {
                label: "Delivered",
                value: $('#delivery_spec').val()
            },
            {
                label: " Returned",
                value: $('#delivery_spec_return').val()
            }
        ],
        resize: true,
        colors: ['#87d6c6', '#54cdb4', '#1ab394', '#1ab377'],
    });
</script>