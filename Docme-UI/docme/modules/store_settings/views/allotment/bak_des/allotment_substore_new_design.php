		<script src="<?php echo base_url('assets/theme/js/plugins/wizard/icheck.min.js'); ?>"></script>
		<script src="<?php echo base_url('assets/theme/js/plugins/wizard/jquery.mCustomScrollbar.min.js'); ?>"></script>
		<script src="<?php echo base_url('assets/theme/js/plugins/wizard/jquery.smartWizard-2.0.min.js'); ?>"></script>		
		
		<script src="<?php echo base_url('assets/theme/js/plugins/wizard/jquery.validate.js'); ?>"></script>
		<script src="<?php echo base_url('assets/theme/js/plugins/wizard/plugins.js'); ?>"></script>

<div class="wrapper wrapper-content animated fadeInRight" style="padding-top: 1px !important;padding-left: 0px !important;padding-right: 0px !important;">
        <div class="row" style="margin-left: -29px !important; margin-right: -30px !important;">
            <div class="col-lg-12">
                <div class="ibox float-e-margins">     
                    <div class="ibox-title">
                        <h5><?php echo isset($sub_title) ? $sub_title : "NO TITLE PROVIDED" ?></h5>

                    </div>
                    <div class="ibox-content">
                      <!--<div class="row">
                            <div class="wrapper wrapper-content animated fadeInRight" id="student-data-container">

                                <div class="row">

                                    <?php
                                    if (isset($substore_data) && !empty($substore_data) && is_array($substore_data)) {
                                    $breaker = 0;
                                        foreach ($substore_data as $substore) {
                                    ?>

                                    <div class="col-lg-4">
                                        <div class="contact-box center-version" style="min-height: 210px; min-width: 150px;">
                                            <a href="javascript:void(0);">

                                                <h3 class="m-b-xs"><strong><?php echo $substore['store_name']  ?></strong></h3>
                                            </a>
                                            <table class="table table-hover">
                                                <tbody >
                                                <div class="font-bold" style="padding-left: 30px;">Contact No : <?php echo $substore['phone']  ?></div>
                                                <div class="font-bold" style="padding-left: 30px;">Email ID : <?php echo $substore['email']  ?></div>
                                               

                                                </tbody>
                                            </table>

                                            <div class="contact-box-footer">
                                                <div class="m-t-xs btn-group">
                                                    <a href="javascript:void(0);" onclick="select_list('<?php echo $substore['store_id'];  ?>', '<?php echo $substore['store_name'];  ?>')" class="btn btn-xs btn-white"><i class="fa fa-user-plus"></i> Select</a>        
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                    <?php                               
                                        }
                                    }
                                    ?>
                                </div>
                            </div>
                        </div>-->
						
						

						
					<div class="row">
					<div class="col-sm-12">

                            <!-- START DEFAULT WIZARD -->
                            <div class="block">
                                <h4>Default Wizard</h4>
                                <div class="wizard">

                                    <ul>
                                        <li>
                                            <a href="#step-1">
                                                <span class="stepNumber">1</span>
                                                <span class="stepDesc">Step 1<br /><small>Step 1 description</small></span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#step-2">
                                                <span class="stepNumber">2</span>
                                                <span class="stepDesc">Step 2<br /><small>Step 2 description</small></span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#step-3">
                                                <span class="stepNumber">3</span>
                                                <span class="stepDesc">Step 3<br /><small>Step 3 description</small></span>                   
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#step-4">
                                                <span class="stepNumber">4</span>
                                                <span class="stepDesc">Step 4<br /><small>Step 4 description</small></span>                   
                                            </a>
                                        </li>
                                    </ul>
                                    <div id="step-1">
		                            	<div class="row">
		                                	<div class="col-sm-12">
		                                    	<h4 class="info-text"> Let's start with the basic details</h4>
		                                	</div>
	                                    <div class="col-lg-4">
                                        <div class="contact-box center-version" style="min-height: 210px; min-width: 150px;">
                                            <a href="javascript:void(0);">

                                                <h3 class="m-b-xs"><strong><?php echo $substore['store_name']  ?></strong></h3>
                                            </a>
                                            <table class="table table-hover">
                                                <tbody >
                                                <div class="font-bold" style="padding-left: 30px;">Contact No : <?php echo $substore['phone']  ?></div>
                                                <div class="font-bold" style="padding-left: 30px;">Email ID : <?php echo $substore['email']  ?></div>
                                               

                                                </tbody>
                                            </table>

                                            <div class="contact-box-footer">
                                                <div class="m-t-xs btn-group">
                                                    <a href="javascript:void(0);" onclick="select_list('<?php echo $substore['store_id'];  ?>', '<?php echo $substore['store_name'];  ?>')" class="btn btn-xs btn-white"><i class="fa fa-user-plus"></i> Select</a>        
                                                </div>
                                            </div>

                                        </div>
                                    </div>

		                            	</div>
									</div>
                                    <div id="step-2">
            <div class="row">
                <div class="col-lg-12">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>Basic Data Tables example with responsive plugin</h5>
                        <div class="ibox-tools">
                            <a class="collapse-link">
                                <i class="fa fa-chevron-up"></i>
                            </a>
                            <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                                <i class="fa fa-wrench"></i>
                            </a>
                            <ul class="dropdown-menu dropdown-user">
                                <li><a href="#">Config option 1</a>
                                </li>
                                <li><a href="#">Config option 2</a>
                                </li>
                            </ul>
                            <a class="close-link">
                                <i class="fa fa-times"></i>
                            </a>
                        </div>
                    </div>
                    <div class="ibox-content">

                        <div class="table-responsive">
                    <table class="table table-striped table-bordered table-hover dataTables-example" >
                    <thead>
                    <tr>
                        <th>Rendering engine</th>
                        <th>Browser</th>
                        <th>Platform(s)</th>
                        <th>Engine version</th>
                        <th>CSS grade</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr class="gradeX">
                        <td>Trident</td>
                        <td>Internet
                            Explorer 4.0
                        </td>
                        <td>Win 95+</td>
                        <td class="center">4</td>
                        <td class="center">X</td>
                    </tr>
                    <tr class="gradeC">
                        <td>Trident</td>
                        <td>Internet
                            Explorer 5.0
                        </td>
                        <td>Win 95+</td>
                        <td class="center">5</td>
                        <td class="center">C</td>
                    </tr>
                    <tr class="gradeA">
                        <td>Trident</td>
                        <td>Internet
                            Explorer 5.5
                        </td>
                        <td>Win 95+</td>
                        <td class="center">5.5</td>
                        <td class="center">A</td>
                    </tr>


                    </tbody>
                    <tfoot>
                    <tr>
                        <th>Rendering engine</th>
                        <th>Browser</th>
                        <th>Platform(s)</th>
                        <th>Engine version</th>
                        <th>CSS grade</th>
                    </tr>
                    </tfoot>
                    </table>
                        </div>

                    </div>
                </div>
            </div>
            </div>
									</div>                      
                                    <div id="step-3">
            <div class="row">
                <div class="col-lg-12">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>Basic Data Tables example with responsive plugin</h5>
                        <div class="ibox-tools">
                            <a class="collapse-link">
                                <i class="fa fa-chevron-up"></i>
                            </a>
                            <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                                <i class="fa fa-wrench"></i>
                            </a>
                            <ul class="dropdown-menu dropdown-user">
                                <li><a href="#">Config option 1</a>
                                </li>
                                <li><a href="#">Config option 2</a>
                                </li>
                            </ul>
                            <a class="close-link">
                                <i class="fa fa-times"></i>
                            </a>
                        </div>
                    </div>
                    <div class="ibox-content">

                        <div class="table-responsive">
                    <table class="table table-striped table-bordered table-hover dataTables-example" >
                    <thead>
                    <tr>
                        <th>Rendering engine</th>
                        <th>Browser</th>
                        <th>Platform(s)</th>
                        <th>Engine version</th>
                        <th>CSS grade</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr class="gradeX">
                        <td>Trident</td>
                        <td>Internet
                            Explorer 4.0
                        </td>
                        <td>Win 95+</td>
                        <td class="center">4</td>
                        <td class="center">X</td>
                    </tr>
                    <tr class="gradeC">
                        <td>Trident</td>
                        <td>Internet
                            Explorer 5.0
                        </td>
                        <td>Win 95+</td>
                        <td class="center">5</td>
                        <td class="center">C</td>
                    </tr>
                    <tr class="gradeA">
                        <td>Trident</td>
                        <td>Internet
                            Explorer 5.5
                        </td>
                        <td>Win 95+</td>
                        <td class="center">5.5</td>
                        <td class="center">A</td>
                    </tr>


                    </tbody>
                    <tfoot>
                    <tr>
                        <th>Rendering engine</th>
                        <th>Browser</th>
                        <th>Platform(s)</th>
                        <th>Engine version</th>
                        <th>CSS grade</th>
                    </tr>
                    </tfoot>
                    </table>
                        </div>

                    </div>
                </div>
            </div>
            </div>
									</div>
                                    <div id="step-4">
<div class="row">
            <div class="col-lg-3">
                <div class="contact-box center-version">
				<a href="#">
                        <h3 class="m-b-xs"><strong>Michael Zimber</strong></h3>

                        <div class="font-bold">Sales manager</div>
                        <address class="m-t-md">
                            <strong>Twitter, Inc.</strong><br>
                            795 Folsom Ave, Suite 600<br>
                            San Francisco, CA 94107<br>
                            <abbr title="Phone">P:</abbr> (123) 456-7890
                        </address>
						</a>

                </div>
            </div>
            <div class="col-lg-3">
                <div class="contact-box center-version">
					<a href="#">
                        <h3 class="m-b-xs"><strong>Michael Zimber</strong></h3>

                        <div class="font-bold">Sales manager</div>
                        <address class="m-t-md">
                            <strong>Twitter, Inc.</strong><br>
                            795 Folsom Ave, Suite 600<br>
                            San Francisco, CA 94107<br>
                            <abbr title="Phone">P:</abbr> (123) 456-7890
                        </address></a>

                </div>
            </div>
            <div class="col-lg-3">
                <div class="contact-box center-version">
					<a href="#">
                        <h3 class="m-b-xs"><strong>Michael Zimber</strong></h3>

                        <div class="font-bold">Sales manager</div>
                        <address class="m-t-md">
                            <strong>Twitter, Inc.</strong><br>
                            795 Folsom Ave, Suite 600<br>
                            San Francisco, CA 94107<br>
                            <abbr title="Phone">P:</abbr> (123) 456-7890
                        </address>
						</a>

                </div>
            </div>
            <div class="col-lg-3">
                <div class="contact-box center-version">
					<a href="#">
                        <h3 class="m-b-xs"><strong>Michael Zimber</strong></h3>

                        <div class="font-bold">Sales manager</div>
                        <address class="m-t-md">
                            <strong>Twitter, Inc.</strong><br>
                            795 Folsom Ave, Suite 600<br>
                            San Francisco, CA 94107<br>
                            <abbr title="Phone">P:</abbr> (123) 456-7890
                        </address>
						</a>

                </div>
            </div>

        </div>
									</div>                           

                                </div>
                            </div>                                       
                            <!-- END DEFAULT WIZARD -->
					
					</div>
					</div>	
						
						
						
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function () {

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

    function select_list(id, name) {
        var storeid = id
        var storename = name
        var ops_url = baseurl + 'allotment/add-allotment/';
        $.ajax({
            type: "POST",
            cache: false,
            async: false,
            url: ops_url,
            data: {"load": 1, "storeid": storeid, "storename": storename},
            success: function (result) {
                $('#data-view').html(result);
            }
        });

    }

</script>