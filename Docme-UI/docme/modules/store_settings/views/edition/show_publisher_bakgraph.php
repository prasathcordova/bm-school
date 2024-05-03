      <link href="<?php echo base_url('assets/theme/css/bootstrap.min.css'); ?>" rel="stylesheet">
      <link href="<?php echo base_url('assets/theme/font-awesome/css/font-awesome.css'); ?>" rel="stylesheet">    

    <!-- orris -->
    <link href="<?php echo base_url('assets/theme/css/plugins/morris/morris-0.4.3.min.css'); ?>" rel="stylesheet">
     <link href="<?php echo base_url('assets/theme/css/animate.css'); ?>" rel="stylesheet">
      <link href="<?php echo base_url('assets/theme/css/style.css'); ?>" rel="stylesheet">


        <script src="<?php echo base_url('assets/theme/js/jquery-3.1.1.min.js'); ?>"></script>
        <script src="<?php echo base_url('assets/theme/js/bootstrap.min.js'); ?>"></script>

  <script src="<?php echo base_url('assets/theme/js/plugins/metisMenu/jquery.metisMenu.js'); ?>"></script>
   <script src="<?php echo base_url('assets/theme/js/plugins/slimscroll/jquery.slimscroll.min.js'); ?>"></script>

   <script src="<?php echo base_url('assets/theme/js/inspinia.js'); ?>"></script>
 <script src="<?php echo base_url('assets/theme/js/plugins/pace/pace.min.js'); ?>"></script>
 <script src="<?php echo base_url('assets/theme/js/plugins/morris/raphael-2.1.0.min.js'); ?>"></script>
 <script src="<?php echo base_url('assets/js/plugins/morris/morris.min.js'); ?>"></script>
 
 

    <!-- Morris demo data-->
    
<div class="wrapper wrapper-content animated fadeInRight" style="padding-top: 1px !important;padding-left: 0px !important;padding-right: 0px !important;">
    <div class="row" style="margin-left: -29px !important; margin-right: -30px !important;">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
<!--                <div class="ibox-title">
                    <h5><?php // echo isset($sub_title) ? $sub_title : "NO TITLE PROVIDED" ?></h5>
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
        data: [{ label: "Download Sales", value: 12 },
            { label: "In-Store Sales", value: 30 },
            { label: "Mail-Order Sales", value: 20 } ],
        resize: true,
        colors: ['#87d6c6', '#54cdb4','#1ab394'],
    });

    </script>