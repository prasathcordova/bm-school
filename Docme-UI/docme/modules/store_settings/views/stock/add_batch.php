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

<div class="wrapper wrapper-content">
    <div class="row">
        <div class="col-lg-3">
            <div class="ibox float-e-margins">
                <div class="ibox-content mailbox-content">
                    <div class="file-manager">
                        <a class="btn btn-block btn-primary compose-mail" href="mail_compose.html">Course Management</a>
                        <div class="space-25"></div>
                        <h5>Batch Management</h5>

                        <ul class="category-list" style="padding: 0">

                            <li><a href="<?php echo base_url('course/show-batch'); ?>"> <i class="fa fa-circle text-primary"></i> Batch Settings <span class="label label-warning pull-right">16</span> </a></li>
                            <li><a href="<?php echo base_url('course/batch-allocate'); ?>"> <i class="fa fa-circle text-info"></i> Batch Allocation<span class="label label-danger pull-right">2</span></a></li>
                            <li><a href="mailbox.html"> <i class="fa fa-circle text-warning"></i> Clone Batches</li>
                        </ul>
                        <h5>Course Maintenance</h5>
                        <ul class="category-list" style="padding: 0">
                            <li><a href="<?php echo base_url('course/show-course'); ?>"> <i class="fa fa-circle text-navy"></i> Course<span class="label label-warning pull-right">16</span> </a></li>
                            <li><a href="<?php echo base_url('course/show-class'); ?>"> <i class="fa fa-circle text-danger"></i> Class<span class="label label-danger pull-right">2</span></a></li>

                        </ul>

                        <h5 class="tag-title">Reports</h5>
                        <ul class="tag-list" style="padding: 0">
                            <li><a href="pdf_viewer.html"><i class="fa fa-tag"></i> Class List</a></li>
                            <li><a href="pdf_viewer.html"><i class="fa fa-tag"></i> Batch List</a></li>
                            <li><a href="pdf_viewer.html"><i class="fa fa-tag"></i> Newly Joined List</a></li>
                            <li><a href="pdf_viewer.html"><i class="fa fa-tag"></i> Student's List</a></li>
                            <li><a href="pdf_viewer.html"><i class="fa fa-tag"></i> Student's Parent List</a></li>
                            <li><a href="pdf_viewer.html"><i class="fa fa-tag"></i> Student's Contact List</a></li>
                            <li><a href="pdf_viewer.html"><i class="fa fa-tag"></i> Strength Report</a></li>

                        </ul>
                        <div class="clearfix"></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-9 animated fadeInRight">
            <div class="mail-box-header">

                <form method="get" action="index.html" class="pull-right mail-search">
                    <div class="input-group">
<!--                        <input type="text" class="form-control input-sm" name="search" placeholder="Search Batch ">-->
                        
                        <div class="ibox-tools" id="add_type">
                        <!--<button type="button" class="btn bg-teal waves-effect"  onclick="add_subject();">NEW SUBJECT</button>-->
                        <span style="padding-right: 9px;"><a href="javascript:void(0);" class="btn btn-primary btn-xs"   onclick="add_new_language();" >Save</a> </span>
                    </div>
                    </div>
                </form>
<!--                <h2 class="text-info">
                    Add New Batch
                </h2>-->
                <div class="mail-tools tooltip-demo m-t-md">
                  
                   
                    

                </div>
            </div>
            <div class="mail-box">


                <table class="table table-hover table-mail">
                    <tbody>
 <div class="col-md-6 col-xs-12 col-md-12">
      <label class="control-label" for="customer">Academic Year :</label>
<!--                                    <div class="clearfix"></div>-->
                                    <select class="select2_demo_1 form-control">
                                        <option></option>
                                       <option value="1">2016-17</option>
                                <option value="1">2016-17</option>
                                <option value="1">2016-17</option>
                                <option value="1">2016-17</option>
                                <option value="1">2016-17</option>
                                    </select>

                                </div> 
 <div class="col-md-6 col-xs-12 col-md-12">
      <label class="control-label" for="customer">Class :</label>
<!--                                    <div class="clearfix"></div>-->
                                    <select class="select2_demo_2 form-control">
                                        <option></option>
                                       <option value="1">Tiny Tots</option>
                                <option value="1">KG-1</option>
                                <option value="1">KG-2</option>
                                    </select>

                                </div> 
 <div class="col-md-6 col-xs-12 col-md-12">
      <label class="control-label" for="customer">Stream :</label>
<!--                                    <div class="clearfix"></div>-->
                                    <select class="select2_demo_2 form-control">
                                        <option></option>
                                        <option value="1">CBSE</option>
                                <option value="1">Kerala State</option>
                                    </select>

                                </div> 
                
                    <div class="col-lg-6 col-xs-12 col-md-12">
                        <div class="form-group">
                            <label class="control-label" for="customer">Session :</label>
                            <select class="select2_demo_4 form-control">
                                 <option></option>
                                <option value="1">Fore Noon</option>
                                <option value="1">After Noon</option>

                            </select>
                        </div>
                    </div>
                    <div class="col-lg-6 col-xs-12 col-md-12">
                        <div class="form-group">
                            <label class="control-label" for="customer">Medium :</label>
                            <select class="select2_demo_5 form-control">
                                 <option></option>
                                  <option value="1">English</option>
                                <option value="1">Malayalam</option>

                            </select>
                        </div>
                    </div>
                    <div class="col-lg-6 col-xs-12 col-md-12">
                        <div class="form-group">
                            <label class="control-label" for="customer">Gender :</label>
                            <select class="select2_demo_6 form-control">
                                 <option></option>
                                 <option value="1">Male</option>
                                <option value="1">Female</option>

                            </select>
                        </div>
                    </div>
                    

                    <div class="col-lg-6 col-xs-12 col-md-12">
                        <div class="form-group">
                            <label class="control-label" for="customer">Division :</label>
                            <input type="text" placeholder="Enter Division" class="form-control">
                        </div>

                    </div>
                    <div class="col-lg-6 col-xs-12 col-md-12">
                        <div class="form-group">
                            <label class="control-label" for="customer">Strength :</label>
                            <input type="text" placeholder="Enter Total Number Of Boys & Girls" class="form-control">
                        </div>

                    </div>
                    <div class="col-lg-6 col-xs-12 col-md-12">
                        <div class="form-group">
                            <label class="control-label" for="customer">Boys :</label>
                            <input type="text" placeholder="Enter Count Of Boys" class="form-control">
                        </div>

                    </div>
                    <div class="col-lg-6 col-xs-12 col-md-12">
                        <div class="form-group">
                            <label class="control-label" for="customer">Girls :</label>
                            <input type="text" placeholder="Enter Count Of Girls" class="form-control">
                        </div>

                    </div>






                    </tbody>
                </table>


            </div>
        </div>
    </div>
</div>

<script>
        $(document).ready(function(){
           
            $(".select2_demo_1").select2({
                placeholder: "Select  Academic Year",
                allowClear: true
            });
            $(".select2_demo_2").select2({
                placeholder: "Select  Class",
                allowClear: true
            });
            $(".select2_demo_3").select2({
                placeholder: "Select  Stream",
                allowClear: true
            });
            $(".select2_demo_4").select2({
                placeholder: "Select  Sesssion",
                allowClear: true
            });
            $(".select2_demo_5").select2({
                placeholder: "Select  Medium",
                allowClear: true
            });
            $(".select2_demo_6").select2({
                placeholder: "Select  Gender Type",
                allowClear: true
            });
        });
    </script>








