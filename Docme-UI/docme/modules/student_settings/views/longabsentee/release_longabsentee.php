
<link href="<?php echo base_url('assets/css/steps/jquery.steps.css'); ?>" rel="stylesheet"> 

<script src="<?php echo base_url('assets/plugins/metisMenu/jquery.metisMenu.js'); ?>"></script>
<script src="<?php echo base_url('assets/plugins/steps/jquery.steps.min.js'); ?>"></script>
<script src="<?php echo base_url('assets/plugins/validate/jquery.validate.min.js'); ?>"></script>
<!--<link href="<?php //echo base_url('assets/plugins/steps/jquery.steps.min.js');  ?>" rel="stylesheet">-->
<div class="row wrapper border-bottom white-bg page-heading" >
    <div class="col-lg-10 col-md-8 col-sm-8 col-xs-12">
        <h2 style="font-size: 20px;">
            <?php echo isset($title) ? $title : "NO TITLE PROVIDED" ?>
        </h2>
        <ol class="breadcrumb">
            <?php
            if (isset($bread_crump_data) && !empty($bread_crump_data)) {
                echo $bread_crump_data;
            }
            //                                                                           dev_export($subject_data);die;
            ?>
        </ol>        
    </div>    
</div>
<div class="wrapper wrapper-content animated fadeInRight" >
    <div class="row">
        <div class=" col-md-3 col-lg-3 col-sm-12 col-xs-12">
            <div class="ibox">
                <div class="ibox-content text-center" >

                    <div class="profile-image">
                         <?php
                                                    $profile_image = "";
                                                    if (isset($student_data['profile_image']) && !empty($student_data['profile_image'])) {

                                                        $profile_image = "data:image/png;base64," . $student_data['profile_image'];
                                                    } else {
                                                        $profile_image = base_url('assets/img/a0.jpg');
                                                    }
                                                    ?>
                                                  
                    
                   
                        <img src="<?php echo $profile_image; ?>" class="img-circle" alt="profile">
                    </div>
                    <h2>  <?php echo $student_data['student_name']; ?></h2>
                    <table class="table table-stripped small m-t-md  "  style="border-top:0px !important; text-align: left; ">
                        <tbody>
                            <tr>
                                <td>
                                    Admission No. 
                                </td>
                                <td>
                                    :<b>  <?php echo $student_data['Admn_NO']; ?></b>      
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    Batch Name 
                                </td>
                                <td>
                                    :<b><?php echo $student_data['Batch_Name']; ?></b>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    Class 
                                </td>
                                <td>
                                    :<b> <?php  echo $student_data['Description']; ?></b>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    Roll No 
                                </td>
                                <td>
                                    :<b> 58</b>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            
        </div>
        <div class="col-sm-12 col-xs-12 col-md-9 col-lg-9">
            <div class="ibox">
                
                <div class="ibox-content">
                    <div class="col-lg-12">
                            <dl class="dl-horizontal">
                                <dt>Completed:</dt>
                                <dd>
                                    <div class="progress progress-striped active m-b-sm">
                                        <div style="width: 60%;" class="progress-bar"></div>
                                    </div>
                                    <small>Fee completed  <strong>60%</strong>. Remaining close the project, sign a contract and invoice.</small>
                                </dd>
                            </dl>
                        </div>
                      <div class="ibox float-e-margins">
<!--                        <div class="ibox-title">
                            <h5>Fee Structure  </h5>
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
                        </div>-->
                        <div class="ibox-content">

                            <table class="table table-hover">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Data</th>
                                    <th>User</th>
                                    <th>Value</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td>1</td>
                                    <td><span class="pie">0.52,1.041</span></td>
                                    <td>Samantha</td>
                                    <td class="text-navy"> <i class="fa fa-level-up"></i> 40% </td>
                                </tr>
                                <tr>
                                    <td>2</td>
                                    <td><span class="pie">226,134</span></td>
                                    <td>Jacob</td>
                                    <td class="text-warning"> <i class="fa fa-level-down"></i> -20% </td>
                                </tr>
                                <tr>
                                    <td>3</td>
                                    <td><span class="pie">0.52/1.561</span></td>
                                    <td>Damien</td>
                                    <td class="text-navy"> <i class="fa fa-level-up"></i> 26% </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="ibox float-e-margins">
                        <div class="ibox-content ">
                            <div class="row">
                                <div class="col-lg-4 col-sm-8 col-xs-12 col-md-6">
                                    <div class="form-group" id="data_1">
                                        <label class="font-noraml">Fee Enable Date :</label>
                                        <div class="input-group date" style="width: 122%">
                                            <span class="input-group-addon"><i class="fa fa-calendar"></i></span><input type="text" class="form-control" value="03/04/2014">
                                        </div>
                                    </div>
                                </div>  
                                <div class="col-lg-2 col-xs-12 col-sm-4 col-md-6">
                                    <button style="margin-top: 25px;margin-left: 30px;" type="button" class="btn btn-info btn-sm">Submit</button>
                                </div>  

                                <div class="col-lg-4 col-xs-12 col-sm-8 col-md-6">
                                    <div class="form-group" id="data_1">
                                        <label class="font-noraml">Long Absentee Release :</label>
                                        <div class="input-group date" style="width: 122%">
                                            <span class="input-group-addon"><i class="fa fa-calendar"></i></span><input type="text" class="form-control" value="03/04/2014">
                                        </div>
                                    </div>
                                </div>  
                                <div class="col-lg-2 col-xs-12 col-md-6 col-sm-4">
                                   
                                    <button style="margin-top: 25px;margin-left: 30px;" type="button" class="btn btn-info btn-sm">Submit</button>
                                </div>  
                            </div>
                            
                        </div>
                    </div>
<!--                    <div class="row">
                        <div class="col-lg-12">
                            <div class="m-b-md">
                                <a href="#" class="btn btn-white btn-xs pull-right">Edit project</a>
                                <h2>&nbsp;</h2>
                            </div>
                            <dl class="dl-horizontal">
                                <dt>Status:</dt> <dd><span class="label label-primary">Active</span></dd>
                            </dl>
                        </div>
                    </div>-->
                    
<!--                    <div class="row">
                        <div class="col-lg-5">
                            <dl class="dl-horizontal">

                                <dt>Created by:</dt> <dd>Alex Smith</dd>
                                <dt>Messages:</dt> <dd>  162</dd>
                                <dt>Client:</dt> <dd><a href="#" class="text-navy"> Zender Company</a> </dd>
                                <dt>Version:</dt> <dd> 	v1.4.2 </dd>
                                <dt>Last Updated:</dt> <dd>16.08.2014 12:15:57</dd>
                                <dt>Created:</dt> <dd> 	10.07.2014 23:36:57 </dd>
                            </dl>
                        </div>
                             <div class="col-lg-7" id="cluster_info">
                                                    <dl class="dl-horizontal" >
                                                        <dt>Last Updated:</dt> <dd>16.08.2014 12:15:57</dd>
                                                        <dt>Created:</dt> <dd> 	10.07.2014 23:36:57 </dd>
                                                <dt>Participants:</dt>
                                                                                            <dd class="project-people">
                                                                                                <a href=""><img alt="image" class="img-circle" src="img/a3.jpg"></a>
                                                                                                <a href=""><img alt="image" class="img-circle" src="img/a1.jpg"></a>
                                                                                                <a href=""><img alt="image" class="img-circle" src="img/a2.jpg"></a>
                                                                                                <a href=""><img alt="image" class="img-circle" src="img/a4.jpg"></a>
                                                                                                <a href=""><img alt="image" class="img-circle" src="img/a5.jpg"></a>
                                                                                            </dd>
                                                    </dl>
                                                    <a href="document.php"></a>
                                                </div>
                    </div>-->
                    <div class="row">
                        
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>




<script>

</script>