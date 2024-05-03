
<link href="<?php echo base_url('assets/theme/css/plugins/morris/morris-0.4.3.min.css'); ?>" rel="stylesheet">
<script src="<?php echo base_url('assets/theme/js/plugins/morris/raphael-2.1.0.min.js'); ?>"></script>
<script src="<?php echo base_url('assets/theme/js/plugins/morris/morris.js'); ?>"></script>

<div class="wrapper wrapper-content animated fadeInRight" style="padding-top: 1px !important;padding-left: 0px !important;padding-right: 0px !important;">
    <div class="row" style="margin-left: -29px !important; margin-right: -30px !important;">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
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
                        <div class="col-lg-12">
                            <div id="morris-donut-chart" ></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>




<script>

    Morris.Donut({
        element: 'morris-donut-chart',
        data: [{label: "Batch", value: 12},
            {label: "Course", value: 30},
            {label: "Class", value: 20}],
        resize: true,
        colors: ['#87d6c6', '#54cdb4', '#1ab394'],
    });

</script>