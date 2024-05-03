 
<link href="<?php echo base_url('assets/css/steps/jquery.steps.css'); ?>" rel="stylesheet"> 
<!-- Steps -->   

<script src="<?php echo base_url('assets/plugins/metisMenu/jquery.metisMenu.js'); ?>"></script>
<script src="<?php echo base_url('assets/plugins/steps/jquery.steps.min.js'); ?>"></script>
<script src="<?php echo base_url('assets/plugins/validate/jquery.validate.min.js'); ?>"></script>
  <script src="<?php echo base_url('assets/theme/js/plugins/pace/pace.min.js'); ?>"></script>
        <script src="<?php echo base_url('assets/theme/js/plugins/slimscroll/jquery.slimscroll.min.js'); ?>"></script>
        <script src="<?php echo base_url('assets/theme/js/inspinia.js'); ?>"></script>
 <!--<link href="<?php //echo base_url('assets/plugins/steps/jquery.steps.min.js');                                    ?>" rel="stylesheet">-->
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10 col-md-8 col-sm-8 col-xs-12">
        <h2 style="font-size: 20px;">
            <?php echo isset($title) ? $title : "NO TITLE PROVIDED" ?>
        </h2>
        <ol class="breadcrumb">
            <?php
            if (isset($bread_crump_data) && !empty($bread_crump_data)) {
                echo $bread_crump_data;
            }
            // dev_export($subject_data);die;
            ?>
        </ol>        
    </div>    
</div>
        <div class="wrapper wrapper-content  animated fadeInRight" style="display: inline-block;">
<!--<div class="wrapper wrapper-content animated fadeInRight" style="padding-top: 1px !important;padding-left: 0px !important;padding-right: 0px !important;">-->
   <!--<div class="row">-->
                <div class="col-sm-8">
                    <div class="ibox">
                        <div class="ibox-content">
                            <span class="text-muted small pull-right">Last modification: <i class="fa fa-clock-o"></i> 2:10 pm - 12.06.2014</span>
                            <h2>TC Page</h2>
<!--                            <p>
                                All clients need to be verified before you can send email and set a project.
                            </p>-->
<!--                            <div class="input-group">
                                <input type="text" placeholder="Search Student " class="input form-control">
                                <span class="input-group-btn">
                                        <button type="button" class="btn btn btn-primary"> <i class="fa fa-search"></i> Search</button>
                                </span>
                            </div>-->
                            <div class="clients-list">
                            <ul class="nav nav-tabs">
                                <span class="pull-right small text-muted">3 Students</span>
                                <li class="active"><a data-toggle="tab" href="#tab-1"><i class="fa fa-user"></i> TC Applied List</a></li>
                                <li class=""><a data-toggle="tab" href="#tab-2"><i class="fa fa-briefcase"></i> TC Prepare List</a></li>
                            </ul>
                            <div class="tab-content">
                                 <?php
                                if (isset($details_data) && !empty($details_data) && is_array($details_data)) {
//                                    $breaker = 0;
                                   
                                        ?>
                                <div id="tab-1" class="tab-pane active">
                                    <div class="full-height-scroll">
                                        <div class="table-responsive">
                                            <table class="table table-striped table-hover">
                                                <thead>
<!--                                        <tr>
                                            
                                                <th>Image</th>
                                                <th>Name</th>
                                                <th>Admission No.</th>                                
                                                <th>Batch</th>                                
                                                <th>Applied Date</th>                           
                                        </tr>-->
                                    </thead>
                                                <tbody>
                                                     <tr class="client-link">
                                                   
                                                         <td >Image</td>
                                                    <td>Name</td>
                                                    <td>Admission No.</td>
                                                    <td>Batch</td>
                                                    <td>Applied Date</td>
                                                    
                                                </tr>
                                                    <?php
                                               
                                                     foreach ($details_data as $student) {?>
                                                <tr>
                                                    <td class="client-avatar">
                                                         <?php
                                                    $profile_image = "";
                                                    if (isset($student['profile_image']) && !empty($student['profile_image'])) {

                                                        $profile_image = "data:image/png;base64," . $student['profile_image'];
                                                    } else {
                                                        $profile_image = base_url('assets/img/a2.jpg');
                                                    }
                                                    ?>
                                                        
                                                        <img alt="image" src="<?php echo $profile_image; ?>"> 
                                                    
                                                    </td>
                                                    <td><?php echo $student['name'] ?></</td>
                                                    <td> <?php echo $student['admn_no'] ?></td>
                                                    <!--<td class="contact-type"><i class="fa fa-envelope"> </i></td>-->
                                                    <td> <?php echo $student['batch_name'] ?></td>
                                                    <td class="client-status"><span class="label label-primary"><?php echo date('d-m-Y', strtotime($student['entry_date'])); ?></span></td>
                                                </tr>
                                               
                                               
                                                 <?php
                                        
                                    }
                                }
                                ?>
                                               
                                               
                                               
                                                </tbody>
                                                 
                                               
                                               
                                            </table>
                                           
                                        </div>
                                    </div>
                                </div>
                                
                                <div id="tab-2" class="tab-pane">
                                    <div class="full-height-scroll">
                                        <div class="table-responsive">
                                            <table class="table table-striped table-hover">
                                                <tbody>
                                                <tr>
                                                    <td><a data-toggle="tab" href="#company-1" class="client-link">Tellus Institute</a></td>
                                                    <td>Rexton</td>
                                                    <td><i class="fa fa-flag"></i> Angola</td>
                                                    <td class="client-status"><span class="label label-primary">Active</span></td>
                                                </tr>
                                                <tr>
                                                    <td><a data-toggle="tab" href="#company-2" class="client-link">Velit Industries</a></td>
                                                    <td>Maglie</td>
                                                    <td><i class="fa fa-flag"></i> Luxembourg</td>
                                                    <td class="client-status"><span class="label label-primary">Active</span></td>
                                                </tr>
                                                <tr>
                                                    <td><a data-toggle="tab" href="#company-3" class="client-link">Art Limited</a></td>
                                                    <td>Sooke</td>
                                                    <td><i class="fa fa-flag"></i> Philippines</td>
                                                    <td class="client-status"></td>
                                                </tr>
                                                <tr>
                                                    <td><a data-toggle="tab" href="#company-1" class="client-link">Tempor Arcu Corp.</a></td>
                                                    <td>Eisden</td>
                                                    <td><i class="fa fa-flag"></i> Korea, North</td>
                                                    <td class="client-status"><span class="label label-warning">Waiting</span></td>
                                                </tr>
                                                <tr>
                                                    <td><a data-toggle="tab" href="#company-2" class="client-link">Penatibus Consulting</a></td>
                                                    <td>Tribogna</td>
                                                    <td><i class="fa fa-flag"></i> Montserrat</td>
                                                    <td class="client-status"></td>
                                                </tr>
                                                <tr>
                                                    <td><a data-toggle="tab" href="#company-3" class="client-link"> Ultrices Incorporated</a></td>
                                                    <td>Basingstoke</td>
                                                    <td><i class="fa fa-flag"></i> Tunisia</td>
                                                    <td class="client-status"><span class="label label-primary">Active</span></td>
                                                </tr>
                                                <tr>
                                                    <td><a data-toggle="tab" href="#company-2" class="client-link">Et Arcu Inc.</a></td>
                                                    <td>Sioux City</td>
                                                    <td><i class="fa fa-flag"></i> Burundi</td>
                                                    <td class="client-status"><span class="label label-primary">Active</span></td>
                                                </tr>
                                                <tr>
                                                    <td><a data-toggle="tab" href="#company-1" class="client-link">Tellus Institute</a></td>
                                                    <td>Rexton</td>
                                                    <td><i class="fa fa-flag"></i> Angola</td>
                                                    <td class="client-status"><span class="label label-primary">Active</span></td>
                                                </tr>
                                                <tr>
                                                    <td><a data-toggle="tab" href="#company-2" class="client-link">Velit Industries</a></td>
                                                    <td>Maglie</td>
                                                    <td><i class="fa fa-flag"></i> Luxembourg</td>
                                                    <td class="client-status"></td>
                                                </tr>
                                                <tr>
                                                    <td><a data-toggle="tab" href="#company-3" class="client-link">Art Limited</a></td>
                                                    <td>Sooke</td>
                                                    <td><i class="fa fa-flag"></i> Philippines</td>
                                                    <td class="client-status"></td>
                                                </tr>
                                                <tr>
                                                    <td><a data-toggle="tab" href="#company-1" class="client-link">Tempor Arcu Corp.</a></td>
                                                    <td>Eisden</td>
                                                    <td><i class="fa fa-flag"></i> Korea, North</td>
                                                    <td class="client-status"><span class="label label-warning">Waiting</span></td>
                                                </tr>
                                                <tr>
                                                    <td><a data-toggle="tab" href="#company-2" class="client-link">Penatibus Consulting</a></td>
                                                    <td>Tribogna</td>
                                                    <td><i class="fa fa-flag"></i> Montserrat</td>
                                                    <td class="client-status"></td>
                                                </tr>
                                                <tr>
                                                    <td><a data-toggle="tab" href="#company-3" class="client-link"> Ultrices Incorporated</a></td>
                                                    <td>Basingstoke</td>
                                                    <td><i class="fa fa-flag"></i> Tunisia</td>
                                                    <td class="client-status"><span class="label label-primary">Active</span></td>
                                                </tr>
                                                <tr>
                                                    <td><a data-toggle="tab" href="#company-2" class="client-link">Et Arcu Inc.</a></td>
                                                    <td>Sioux City</td>
                                                    <td><i class="fa fa-flag"></i> Burundi</td>
                                                    <td class="client-status"><span class="label label-primary">Active</span></td>
                                                </tr>
                                                <tr>
                                                    <td><a data-toggle="tab" href="#company-1" class="client-link">Tellus Institute</a></td>
                                                    <td>Rexton</td>
                                                    <td><i class="fa fa-flag"></i> Angola</td>
                                                    <td class="client-status"><span class="label label-primary">Active</span></td>
                                                </tr>
                                                <tr>
                                                    <td><a data-toggle="tab" href="#company-2" class="client-link">Velit Industries</a></td>
                                                    <td>Maglie</td>
                                                    <td><i class="fa fa-flag"></i> Luxembourg</td>
                                                    <td class="client-status"></td>
                                                </tr>
                                                <tr>
                                                    <td><a data-toggle="tab" href="#company-3" class="client-link">Art Limited</a></td>
                                                    <td>Sooke</td>
                                                    <td><i class="fa fa-flag"></i> Philippines</td>
                                                    <td class="client-status"></td>
                                                </tr>
                                                <tr>
                                                    <td><a data-toggle="tab" href="#company-1" class="client-link">Tempor Arcu Corp.</a></td>
                                                    <td>Eisden</td>
                                                    <td><i class="fa fa-flag"></i> Korea, North</td>
                                                    <td class="client-status"><span class="label label-warning">Waiting</span></td>
                                                </tr>
                                                <tr>
                                                    <td><a data-toggle="tab" href="#company-2" class="client-link">Penatibus Consulting</a></td>
                                                    <td>Tribogna</td>
                                                    <td><i class="fa fa-flag"></i> Montserrat</td>
                                                    <td class="client-status"></td>
                                                </tr>
                                                <tr>
                                                    <td><a data-toggle="tab" href="#company-3" class="client-link"> Ultrices Incorporated</a></td>
                                                    <td>Basingstoke</td>
                                                    <td><i class="fa fa-flag"></i> Tunisia</td>
                                                    <td class="client-status"><span class="label label-primary">Active</span></td>
                                                </tr>
                                                <tr>
                                                    <td><a data-toggle="tab" href="#company-2" class="client-link">Et Arcu Inc.</a></td>
                                                    <td>Sioux City</td>
                                                    <td><i class="fa fa-flag"></i> Burundi</td>
                                                    <td class="client-status"><span class="label label-primary">Active</span></td>
                                                </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="ibox ">

                        <div class="ibox-content">
                            <div class="tab-content">
                                <div id="contact-1" class="tab-pane active">
                                    <div class="row m-b-lg">
                                        <div class="col-lg-4 text-center">
                                            <h2>Nicki Smith</h2>

                                            <div class="m-b-sm">
                                                <img alt="image" class="img-circle" src="img/a2.jpg"
                                                     style="width: 62px">
                                            </div>
                                        </div>
                                        <div class="col-lg-8">
                                            <strong>
                                                About me
                                            </strong>

                                            <p>
                                                Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                                                tempor incididunt ut labore et dolore magna aliqua.
                                            </p>
                                            <button type="button" class="btn btn-primary btn-sm btn-block"><i
                                                    class="fa fa-envelope"></i> Send Message
                                            </button>
                                        </div>
                                    </div>
                                    <div class="client-detail">
                                    <div class="full-height-scroll">

                                        <strong>Last activity</strong>

                                        <ul class="list-group clear-list">
                                            <li class="list-group-item fist-item">
                                                <span class="pull-right"> 09:00 pm </span>
                                                Please contact me
                                            </li>
                                            <li class="list-group-item">
                                                <span class="pull-right"> 10:16 am </span>
                                                Sign a contract
                                            </li>
                                            <li class="list-group-item">
                                                <span class="pull-right"> 08:22 pm </span>
                                                Open new shop
                                            </li>
                                            <li class="list-group-item">
                                                <span class="pull-right"> 11:06 pm </span>
                                                Call back to Sylvia
                                            </li>
                                            <li class="list-group-item">
                                                <span class="pull-right"> 12:00 am </span>
                                                Write a letter to Sandra
                                            </li>
                                        </ul>
                                        <strong>Notes</strong>
                                        <p>
                                            Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                                            tempor incididunt ut labore et dolore magna aliqua.
                                        </p>
                                        <hr/>
                                        <strong>Timeline activity</strong>
                                        <div id="vertical-timeline" class="vertical-container dark-timeline">
                                            <div class="vertical-timeline-block">
                                                <div class="vertical-timeline-icon gray-bg">
                                                    <i class="fa fa-coffee"></i>
                                                </div>
                                                <div class="vertical-timeline-content">
                                                    <p>Conference on the sales results for the previous year.
                                                    </p>
                                                    <span class="vertical-date small text-muted"> 2:10 pm - 12.06.2014 </span>
                                                </div>
                                            </div>
                                            <div class="vertical-timeline-block">
                                                <div class="vertical-timeline-icon gray-bg">
                                                    <i class="fa fa-briefcase"></i>
                                                </div>
                                                <div class="vertical-timeline-content">
                                                    <p>Many desktop publishing packages and web page editors now use Lorem.
                                                    </p>
                                                    <span class="vertical-date small text-muted"> 4:20 pm - 10.05.2014 </span>
                                                </div>
                                            </div>
                                            <div class="vertical-timeline-block">
                                                <div class="vertical-timeline-icon gray-bg">
                                                    <i class="fa fa-bolt"></i>
                                                </div>
                                                <div class="vertical-timeline-content">
                                                    <p>There are many variations of passages of Lorem Ipsum available.
                                                    </p>
                                                    <span class="vertical-date small text-muted"> 06:10 pm - 11.03.2014 </span>
                                                </div>
                                            </div>
                                            <div class="vertical-timeline-block">
                                                <div class="vertical-timeline-icon navy-bg">
                                                    <i class="fa fa-warning"></i>
                                                </div>
                                                <div class="vertical-timeline-content">
                                                    <p>The generated Lorem Ipsum is therefore.
                                                    </p>
                                                    <span class="vertical-date small text-muted"> 02:50 pm - 03.10.2014 </span>
                                                </div>
                                            </div>
                                            <div class="vertical-timeline-block">
                                                <div class="vertical-timeline-icon gray-bg">
                                                    <i class="fa fa-coffee"></i>
                                                </div>
                                                <div class="vertical-timeline-content">
                                                    <p>Conference on the sales results for the previous year.
                                                    </p>
                                                    <span class="vertical-date small text-muted"> 2:10 pm - 12.06.2014 </span>
                                                </div>
                                            </div>
                                            <div class="vertical-timeline-block">
                                                <div class="vertical-timeline-icon gray-bg">
                                                    <i class="fa fa-briefcase"></i>
                                                </div>
                                                <div class="vertical-timeline-content">
                                                    <p>Many desktop publishing packages and web page editors now use Lorem.
                                                    </p>
                                                    <span class="vertical-date small text-muted"> 4:20 pm - 10.05.2014 </span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    </div>
                                </div>
                                <div id="contact-2" class="tab-pane">
                                    <div class="row m-b-lg">
                                        <div class="col-lg-4 text-center">
                                            <h2>Edan Randall</h2>

                                            <div class="m-b-sm">
                                                <img alt="image" class="img-circle" src="img/a3.jpg"
                                                     style="width: 62px">
                                            </div>
                                        </div>
                                        <div class="col-lg-8">
                                            <strong>
                                                About me
                                            </strong>

                                            <p>
                                                Many desktop publishing packages and web page editors now use Lorem Ipsum as their default tempor incididunt model text.
                                            </p>
                                            <button type="button" class="btn btn-primary btn-sm btn-block"><i
                                                    class="fa fa-envelope"></i> Send Message
                                            </button>
                                        </div>
                                    </div>
                                    <div class="client-detail">
                                        <div class="full-height-scroll">

                                            <strong>Last activity</strong>

                                            <ul class="list-group clear-list">
                                                <li class="list-group-item fist-item">
                                                    <span class="pull-right"> 09:00 pm </span>
                                                    Lorem Ipsum available
                                                </li>
                                                <li class="list-group-item">
                                                    <span class="pull-right"> 10:16 am </span>
                                                    Latin words, combined
                                                </li>
                                                <li class="list-group-item">
                                                    <span class="pull-right"> 08:22 pm </span>
                                                    Open new shop
                                                </li>
                                                <li class="list-group-item">
                                                    <span class="pull-right"> 11:06 pm </span>
                                                    The generated Lorem Ipsum
                                                </li>
                                                <li class="list-group-item">
                                                    <span class="pull-right"> 12:00 am </span>
                                                    Content here, content here
                                                </li>
                                            </ul>
                                            <strong>Notes</strong>
                                            <p>
                                                There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words.
                                            </p>
                                            <hr/>
                                            <strong>Timeline activity</strong>
                                            <div id="vertical-timeline" class="vertical-container dark-timeline">
                                                <div class="vertical-timeline-block">
                                                    <div class="vertical-timeline-icon gray-bg">
                                                        <i class="fa fa-briefcase"></i>
                                                    </div>
                                                    <div class="vertical-timeline-content">
                                                        <p>Many desktop publishing packages and web page editors now use Lorem.
                                                        </p>
                                                        <span class="vertical-date small text-muted"> 4:20 pm - 10.05.2014 </span>
                                                    </div>
                                                </div>
                                                <div class="vertical-timeline-block">
                                                    <div class="vertical-timeline-icon gray-bg">
                                                        <i class="fa fa-bolt"></i>
                                                    </div>
                                                    <div class="vertical-timeline-content">
                                                        <p>There are many variations of passages of Lorem Ipsum available.
                                                        </p>
                                                        <span class="vertical-date small text-muted"> 06:10 pm - 11.03.2014 </span>
                                                    </div>
                                                </div>
                                                <div class="vertical-timeline-block">
                                                    <div class="vertical-timeline-icon navy-bg">
                                                        <i class="fa fa-warning"></i>
                                                    </div>
                                                    <div class="vertical-timeline-content">
                                                        <p>The generated Lorem Ipsum is therefore.
                                                        </p>
                                                        <span class="vertical-date small text-muted"> 02:50 pm - 03.10.2014 </span>
                                                    </div>
                                                </div>
                                                <div class="vertical-timeline-block">
                                                    <div class="vertical-timeline-icon gray-bg">
                                                        <i class="fa fa-coffee"></i>
                                                    </div>
                                                    <div class="vertical-timeline-content">
                                                        <p>Conference on the sales results for the previous year.
                                                        </p>
                                                        <span class="vertical-date small text-muted"> 2:10 pm - 12.06.2014 </span>
                                                    </div>
                                                </div>
                                                <div class="vertical-timeline-block">
                                                    <div class="vertical-timeline-icon gray-bg">
                                                        <i class="fa fa-briefcase"></i>
                                                    </div>
                                                    <div class="vertical-timeline-content">
                                                        <p>Many desktop publishing packages and web page editors now use Lorem.
                                                        </p>
                                                        <span class="vertical-date small text-muted"> 4:20 pm - 10.05.2014 </span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div id="contact-3" class="tab-pane">
                                    <div class="row m-b-lg">
                                        <div class="col-lg-4 text-center">
                                            <h2>Jasper Carson</h2>

                                            <div class="m-b-sm">
                                                <img alt="image" class="img-circle" src="img/a4.jpg"
                                                     style="width: 62px">
                                            </div>
                                        </div>
                                        <div class="col-lg-8">
                                            <strong>
                                                About me
                                            </strong>

                                            <p>
                                                Latin professor at Hampden-Sydney College in Virginia, looked  embarrassing hidden in the middle.
                                            </p>
                                            <button type="button" class="btn btn-primary btn-sm btn-block"><i
                                                    class="fa fa-envelope"></i> Send Message
                                            </button>
                                        </div>
                                    </div>
                                    <div class="client-detail">
                                        <div class="full-height-scroll">

                                            <strong>Last activity</strong>

                                            <ul class="list-group clear-list">
                                                <li class="list-group-item fist-item">
                                                    <span class="pull-right"> 09:00 pm </span>
                                                    Aldus PageMaker including
                                                </li>
                                                <li class="list-group-item">
                                                    <span class="pull-right"> 10:16 am </span>
                                                    Finibus Bonorum et Malorum
                                                </li>
                                                <li class="list-group-item">
                                                    <span class="pull-right"> 08:22 pm </span>
                                                    Write a letter to Sandra
                                                </li>
                                                <li class="list-group-item">
                                                    <span class="pull-right"> 11:06 pm </span>
                                                    Standard chunk of Lorem
                                                </li>
                                                <li class="list-group-item">
                                                    <span class="pull-right"> 12:00 am </span>
                                                    Open new shop
                                                </li>
                                            </ul>
                                            <strong>Notes</strong>
                                            <p>
                                                Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source.
                                            </p>
                                            <hr/>
                                            <strong>Timeline activity</strong>
                                            <div id="vertical-timeline" class="vertical-container dark-timeline">
                                                <div class="vertical-timeline-block">
                                                    <div class="vertical-timeline-icon gray-bg">
                                                        <i class="fa fa-coffee"></i>
                                                    </div>
                                                    <div class="vertical-timeline-content">
                                                        <p>Conference on the sales results for the previous year.
                                                        </p>
                                                        <span class="vertical-date small text-muted"> 2:10 pm - 12.06.2014 </span>
                                                    </div>
                                                </div>
                                                <div class="vertical-timeline-block">
                                                    <div class="vertical-timeline-icon gray-bg">
                                                        <i class="fa fa-briefcase"></i>
                                                    </div>
                                                    <div class="vertical-timeline-content">
                                                        <p>Many desktop publishing packages and web page editors now use Lorem.
                                                        </p>
                                                        <span class="vertical-date small text-muted"> 4:20 pm - 10.05.2014 </span>
                                                    </div>
                                                </div>
                                                <div class="vertical-timeline-block">
                                                    <div class="vertical-timeline-icon gray-bg">
                                                        <i class="fa fa-bolt"></i>
                                                    </div>
                                                    <div class="vertical-timeline-content">
                                                        <p>There are many variations of passages of Lorem Ipsum available.
                                                        </p>
                                                        <span class="vertical-date small text-muted"> 06:10 pm - 11.03.2014 </span>
                                                    </div>
                                                </div>
                                                <div class="vertical-timeline-block">
                                                    <div class="vertical-timeline-icon navy-bg">
                                                        <i class="fa fa-warning"></i>
                                                    </div>
                                                    <div class="vertical-timeline-content">
                                                        <p>The generated Lorem Ipsum is therefore.
                                                        </p>
                                                        <span class="vertical-date small text-muted"> 02:50 pm - 03.10.2014 </span>
                                                    </div>
                                                </div>
                                                <div class="vertical-timeline-block">
                                                    <div class="vertical-timeline-icon gray-bg">
                                                        <i class="fa fa-coffee"></i>
                                                    </div>
                                                    <div class="vertical-timeline-content">
                                                        <p>Conference on the sales results for the previous year.
                                                        </p>
                                                        <span class="vertical-date small text-muted"> 2:10 pm - 12.06.2014 </span>
                                                    </div>
                                                </div>
                                                <div class="vertical-timeline-block">
                                                    <div class="vertical-timeline-icon gray-bg">
                                                        <i class="fa fa-briefcase"></i>
                                                    </div>
                                                    <div class="vertical-timeline-content">
                                                        <p>Many desktop publishing packages and web page editors now use Lorem.
                                                        </p>
                                                        <span class="vertical-date small text-muted"> 4:20 pm - 10.05.2014 </span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div id="contact-4" class="tab-pane">
                                    <div class="row m-b-lg">
                                        <div class="col-lg-4 text-center">
                                            <h2>Reuben Pacheco</h2>

                                            <div class="m-b-sm">
                                                <img alt="image" class="img-circle" src="img/a5.jpg"
                                                     style="width: 62px">
                                            </div>
                                        </div>
                                        <div class="col-lg-8">
                                            <strong>
                                                About me
                                            </strong>

                                            <p>
                                                Finibus Bonorum et Malorum" (The Extremes of Good and Evil) by Cicero,written in 45 BC. This book is a treatise on.
                                            </p>
                                            <button type="button" class="btn btn-primary btn-sm btn-block"><i
                                                    class="fa fa-envelope"></i> Send Message
                                            </button>
                                        </div>
                                    </div>
                                    <div class="client-detail">
                                        <div class="full-height-scroll">

                                            <strong>Last activity</strong>

                                            <ul class="list-group clear-list">
                                                <li class="list-group-item fist-item">
                                                    <span class="pull-right"> 09:00 pm </span>
                                                    The point of using
                                                </li>
                                                <li class="list-group-item">
                                                    <span class="pull-right"> 10:16 am </span>
                                                    Lorem Ipsum is that it has
                                                </li>
                                                <li class="list-group-item">
                                                    <span class="pull-right"> 08:22 pm </span>
                                                    Text, and a search for 'lorem ipsum'
                                                </li>
                                                <li class="list-group-item">
                                                    <span class="pull-right"> 11:06 pm </span>
                                                    Passages of Lorem Ipsum
                                                </li>
                                                <li class="list-group-item">
                                                    <span class="pull-right"> 12:00 am </span>
                                                    If you are going
                                                </li>
                                            </ul>
                                            <strong>Notes</strong>
                                            <p>
                                                Lorem Ipsum which looks reasonable. The generated Lorem Ipsum is therefore always free from repetition, injected humour, or non-characteristic words etc.
                                            </p>
                                            <hr/>
                                            <strong>Timeline activity</strong>
                                            <div id="vertical-timeline" class="vertical-container dark-timeline">
                                                <div class="vertical-timeline-block">
                                                    <div class="vertical-timeline-icon gray-bg">
                                                        <i class="fa fa-coffee"></i>
                                                    </div>
                                                    <div class="vertical-timeline-content">
                                                        <p>Conference on the sales results for the previous year.
                                                        </p>
                                                        <span class="vertical-date small text-muted"> 2:10 pm - 12.06.2014 </span>
                                                    </div>
                                                </div>
                                                <div class="vertical-timeline-block">
                                                    <div class="vertical-timeline-icon gray-bg">
                                                        <i class="fa fa-briefcase"></i>
                                                    </div>
                                                    <div class="vertical-timeline-content">
                                                        <p>Many desktop publishing packages and web page editors now use Lorem.
                                                        </p>
                                                        <span class="vertical-date small text-muted"> 4:20 pm - 10.05.2014 </span>
                                                    </div>
                                                </div>
                                                <div class="vertical-timeline-block">
                                                    <div class="vertical-timeline-icon gray-bg">
                                                        <i class="fa fa-bolt"></i>
                                                    </div>
                                                    <div class="vertical-timeline-content">
                                                        <p>There are many variations of passages of Lorem Ipsum available.
                                                        </p>
                                                        <span class="vertical-date small text-muted"> 06:10 pm - 11.03.2014 </span>
                                                    </div>
                                                </div>
                                                <div class="vertical-timeline-block">
                                                    <div class="vertical-timeline-icon navy-bg">
                                                        <i class="fa fa-warning"></i>
                                                    </div>
                                                    <div class="vertical-timeline-content">
                                                        <p>The generated Lorem Ipsum is therefore.
                                                        </p>
                                                        <span class="vertical-date small text-muted"> 02:50 pm - 03.10.2014 </span>
                                                    </div>
                                                </div>
                                                <div class="vertical-timeline-block">
                                                    <div class="vertical-timeline-icon gray-bg">
                                                        <i class="fa fa-coffee"></i>
                                                    </div>
                                                    <div class="vertical-timeline-content">
                                                        <p>Conference on the sales results for the previous year.
                                                        </p>
                                                        <span class="vertical-date small text-muted"> 2:10 pm - 12.06.2014 </span>
                                                    </div>
                                                </div>
                                                <div class="vertical-timeline-block">
                                                    <div class="vertical-timeline-icon gray-bg">
                                                        <i class="fa fa-briefcase"></i>
                                                    </div>
                                                    <div class="vertical-timeline-content">
                                                        <p>Many desktop publishing packages and web page editors now use Lorem.
                                                        </p>
                                                        <span class="vertical-date small text-muted"> 4:20 pm - 10.05.2014 </span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div id="company-1" class="tab-pane">
                                    <div class="m-b-lg">
                                            <h2>Tellus Institute</h2>

                                            <p>
                                                Finibus Bonorum et Malorum" (The Extremes of Good and Evil) by Cicero,written in 45 BC. This book is a treatise on.
                                            </p>
                                            <div>
                                                <small>Active project completion with: 48%</small>
                                                <div class="progress progress-mini">
                                                    <div style="width: 48%;" class="progress-bar"></div>
                                                </div>
                                            </div>
                                    </div>
                                    <div class="client-detail">
                                        <div class="full-height-scroll">

                                            <strong>Last activity</strong>

                                            <ul class="list-group clear-list">
                                                <li class="list-group-item fist-item">
                                                    <span class="pull-right"> <span class="label label-primary">NEW</span> </span>
                                                    The point of using
                                                </li>
                                                <li class="list-group-item">
                                                    <span class="pull-right"> <span class="label label-warning">WAITING</span></span>
                                                    Lorem Ipsum is that it has
                                                </li>
                                                <li class="list-group-item">
                                                    <span class="pull-right"> <span class="label label-danger">BLOCKED</span> </span>
                                                    If you are going
                                                </li>
                                            </ul>
                                            <strong>Notes</strong>
                                            <p>
                                                Lorem Ipsum which looks reasonable. The generated Lorem Ipsum is therefore always free from repetition, injected humour, or non-characteristic words etc.
                                            </p>
                                            <hr/>
                                            <strong>Timeline activity</strong>
                                            <div id="vertical-timeline" class="vertical-container dark-timeline">
                                                <div class="vertical-timeline-block">
                                                    <div class="vertical-timeline-icon gray-bg">
                                                        <i class="fa fa-coffee"></i>
                                                    </div>
                                                    <div class="vertical-timeline-content">
                                                        <p>Conference on the sales results for the previous year.
                                                        </p>
                                                        <span class="vertical-date small text-muted"> 2:10 pm - 12.06.2014 </span>
                                                    </div>
                                                </div>
                                                <div class="vertical-timeline-block">
                                                    <div class="vertical-timeline-icon gray-bg">
                                                        <i class="fa fa-briefcase"></i>
                                                    </div>
                                                    <div class="vertical-timeline-content">
                                                        <p>Many desktop publishing packages and web page editors now use Lorem.
                                                        </p>
                                                        <span class="vertical-date small text-muted"> 4:20 pm - 10.05.2014 </span>
                                                    </div>
                                                </div>
                                                <div class="vertical-timeline-block">
                                                    <div class="vertical-timeline-icon gray-bg">
                                                        <i class="fa fa-bolt"></i>
                                                    </div>
                                                    <div class="vertical-timeline-content">
                                                        <p>There are many variations of passages of Lorem Ipsum available.
                                                        </p>
                                                        <span class="vertical-date small text-muted"> 06:10 pm - 11.03.2014 </span>
                                                    </div>
                                                </div>
                                                <div class="vertical-timeline-block">
                                                    <div class="vertical-timeline-icon navy-bg">
                                                        <i class="fa fa-warning"></i>
                                                    </div>
                                                    <div class="vertical-timeline-content">
                                                        <p>The generated Lorem Ipsum is therefore.
                                                        </p>
                                                        <span class="vertical-date small text-muted"> 02:50 pm - 03.10.2014 </span>
                                                    </div>
                                                </div>
                                                <div class="vertical-timeline-block">
                                                    <div class="vertical-timeline-icon gray-bg">
                                                        <i class="fa fa-coffee"></i>
                                                    </div>
                                                    <div class="vertical-timeline-content">
                                                        <p>Conference on the sales results for the previous year.
                                                        </p>
                                                        <span class="vertical-date small text-muted"> 2:10 pm - 12.06.2014 </span>
                                                    </div>
                                                </div>
                                                <div class="vertical-timeline-block">
                                                    <div class="vertical-timeline-icon gray-bg">
                                                        <i class="fa fa-briefcase"></i>
                                                    </div>
                                                    <div class="vertical-timeline-content">
                                                        <p>Many desktop publishing packages and web page editors now use Lorem.
                                                        </p>
                                                        <span class="vertical-date small text-muted"> 4:20 pm - 10.05.2014 </span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div id="company-2" class="tab-pane">
                                    <div class="m-b-lg">
                                        <h2>Penatibus Consulting</h2>

                                        <p>
                                            There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some.
                                        </p>
                                        <div>
                                            <small>Active project completion with: 22%</small>
                                            <div class="progress progress-mini">
                                                <div style="width: 22%;" class="progress-bar"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="client-detail">
                                        <div class="full-height-scroll">

                                            <strong>Last activity</strong>

                                            <ul class="list-group clear-list">
                                                <li class="list-group-item fist-item">
                                                    <span class="pull-right"> <span class="label label-warning">WAITING</span> </span>
                                                    Aldus PageMaker
                                                </li>
                                                <li class="list-group-item">
                                                    <span class="pull-right"><span class="label label-primary">NEW</span> </span>
                                                    Lorem Ipsum, you need to be sure
                                                </li>
                                                <li class="list-group-item">
                                                    <span class="pull-right"> <span class="label label-danger">BLOCKED</span> </span>
                                                    The generated Lorem Ipsum
                                                </li>
                                            </ul>
                                            <strong>Notes</strong>
                                            <p>
                                                Lorem Ipsum which looks reasonable. The generated Lorem Ipsum is therefore always free from repetition, injected humour, or non-characteristic words etc.
                                            </p>
                                            <hr/>
                                            <strong>Timeline activity</strong>
                                            <div id="vertical-timeline" class="vertical-container dark-timeline">
                                                <div class="vertical-timeline-block">
                                                    <div class="vertical-timeline-icon gray-bg">
                                                        <i class="fa fa-coffee"></i>
                                                    </div>
                                                    <div class="vertical-timeline-content">
                                                        <p>Conference on the sales results for the previous year.
                                                        </p>
                                                        <span class="vertical-date small text-muted"> 2:10 pm - 12.06.2014 </span>
                                                    </div>
                                                </div>
                                                <div class="vertical-timeline-block">
                                                    <div class="vertical-timeline-icon gray-bg">
                                                        <i class="fa fa-briefcase"></i>
                                                    </div>
                                                    <div class="vertical-timeline-content">
                                                        <p>Many desktop publishing packages and web page editors now use Lorem.
                                                        </p>
                                                        <span class="vertical-date small text-muted"> 4:20 pm - 10.05.2014 </span>
                                                    </div>
                                                </div>
                                                <div class="vertical-timeline-block">
                                                    <div class="vertical-timeline-icon gray-bg">
                                                        <i class="fa fa-bolt"></i>
                                                    </div>
                                                    <div class="vertical-timeline-content">
                                                        <p>There are many variations of passages of Lorem Ipsum available.
                                                        </p>
                                                        <span class="vertical-date small text-muted"> 06:10 pm - 11.03.2014 </span>
                                                    </div>
                                                </div>
                                                <div class="vertical-timeline-block">
                                                    <div class="vertical-timeline-icon navy-bg">
                                                        <i class="fa fa-warning"></i>
                                                    </div>
                                                    <div class="vertical-timeline-content">
                                                        <p>The generated Lorem Ipsum is therefore.
                                                        </p>
                                                        <span class="vertical-date small text-muted"> 02:50 pm - 03.10.2014 </span>
                                                    </div>
                                                </div>
                                                <div class="vertical-timeline-block">
                                                    <div class="vertical-timeline-icon gray-bg">
                                                        <i class="fa fa-coffee"></i>
                                                    </div>
                                                    <div class="vertical-timeline-content">
                                                        <p>Conference on the sales results for the previous year.
                                                        </p>
                                                        <span class="vertical-date small text-muted"> 2:10 pm - 12.06.2014 </span>
                                                    </div>
                                                </div>
                                                <div class="vertical-timeline-block">
                                                    <div class="vertical-timeline-icon gray-bg">
                                                        <i class="fa fa-briefcase"></i>
                                                    </div>
                                                    <div class="vertical-timeline-content">
                                                        <p>Many desktop publishing packages and web page editors now use Lorem.
                                                        </p>
                                                        <span class="vertical-date small text-muted"> 4:20 pm - 10.05.2014 </span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div id="company-3" class="tab-pane">
                                    <div class="m-b-lg">
                                        <h2>Ultrices Incorporated</h2>

                                        <p>
                                            Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text.
                                        </p>
                                        <div>
                                            <small>Active project completion with: 72%</small>
                                            <div class="progress progress-mini">
                                                <div style="width: 72%;" class="progress-bar"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="client-detail">
                                        <div class="full-height-scroll">

                                            <strong>Last activity</strong>

                                            <ul class="list-group clear-list">
                                                <li class="list-group-item fist-item">
                                                    <span class="pull-right"> <span class="label label-danger">BLOCKED</span> </span>
                                                    Hidden in the middle of text
                                                </li>
                                                <li class="list-group-item">
                                                    <span class="pull-right"><span class="label label-primary">NEW</span> </span>
                                                    Non-characteristic words etc.
                                                </li>
                                                <li class="list-group-item">
                                                    <span class="pull-right">  <span class="label label-warning">WAITING</span> </span>
                                                    Bonorum et Malorum
                                                </li>
                                            </ul>
                                            <strong>Notes</strong>
                                            <p>
                                                There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour.
                                            </p>
                                            <hr/>
                                            <strong>Timeline activity</strong>
                                            <div id="vertical-timeline" class="vertical-container dark-timeline">
                                                <div class="vertical-timeline-block">
                                                    <div class="vertical-timeline-icon gray-bg">
                                                        <i class="fa fa-briefcase"></i>
                                                    </div>
                                                    <div class="vertical-timeline-content">
                                                        <p>Many desktop publishing packages and web page editors now use Lorem.
                                                        </p>
                                                        <span class="vertical-date small text-muted"> 4:20 pm - 10.05.2014 </span>
                                                    </div>
                                                </div>
                                                <div class="vertical-timeline-block">
                                                    <div class="vertical-timeline-icon gray-bg">
                                                        <i class="fa fa-bolt"></i>
                                                    </div>
                                                    <div class="vertical-timeline-content">
                                                        <p>There are many variations of passages of Lorem Ipsum available.
                                                        </p>
                                                        <span class="vertical-date small text-muted"> 06:10 pm - 11.03.2014 </span>
                                                    </div>
                                                </div>
                                                <div class="vertical-timeline-block">
                                                    <div class="vertical-timeline-icon navy-bg">
                                                        <i class="fa fa-warning"></i>
                                                    </div>
                                                    <div class="vertical-timeline-content">
                                                        <p>The generated Lorem Ipsum is therefore.
                                                        </p>
                                                        <span class="vertical-date small text-muted"> 02:50 pm - 03.10.2014 </span>
                                                    </div>
                                                </div>
                                                <div class="vertical-timeline-block">
                                                    <div class="vertical-timeline-icon gray-bg">
                                                        <i class="fa fa-coffee"></i>
                                                    </div>
                                                    <div class="vertical-timeline-content">
                                                        <p>Conference on the sales results for the previous year.
                                                        </p>
                                                        <span class="vertical-date small text-muted"> 2:10 pm - 12.06.2014 </span>
                                                    </div>
                                                </div>
                                                <div class="vertical-timeline-block">
                                                    <div class="vertical-timeline-icon gray-bg">
                                                        <i class="fa fa-briefcase"></i>
                                                    </div>
                                                    <div class="vertical-timeline-content">
                                                        <p>Many desktop publishing packages and web page editors now use Lorem.
                                                        </p>
                                                        <span class="vertical-date small text-muted"> 4:20 pm - 10.05.2014 </span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
<!--</div>-->


<script>

    function tc_preparation(student_id) {
        var ops_url = baseurl + 'tc/tc-preparation/';
        $.ajax({
            type: "POST",
            cache: false,
            async: false,
            url: ops_url,
//            data: {"load": 1, "studentid": student_id},
             data: {"student_id": student_id},
            success: function (data) {
                $('#tc-content').html('');
                $('#tc-content').html(data);

            }
        });
    }
    function tc_issue(student_id) {
        var ops_url = baseurl + 'tc/issue-tc/';
        $.ajax({
            type: "POST",
            cache: false,
            async: false,
            url: ops_url,
//            data: {"load": 1, "studentid": student_id},
             data: {"student_id": student_id},
            success: function (data) {
                $('#tc-content').html('');
                $('#tc-content').html(data);

            }
        });
    }
   

    function tc_issue1() {
        document.location.href = " <?php echo base_url('tc/tc-issue') ?>";

    }

    function search_filter() {
        var ops_url = baseurl + 'tc/search-filter';
        $.ajax({
            type: "POST",
            cache: false,
            async: false,
            url: ops_url,
            data: {"load": 1},
            success: function (data) {
                if (data) {
                    $('#curd-content').html(data);


                    var animation = "fadeInDown";
                    $("#curd-content").show();
                    $('#curd-content').addClass('animated');
                    $('#curd-content').addClass(animation);
                } else {
                    alert('No data loaded');
                }
            }
        });
    }
</script>