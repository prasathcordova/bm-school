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
                            <a class="btn btn-block btn-primary compose-mail" href="#">Course Management</a>
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
                <div class="pull-right tooltip-demo">
                    <!--<a href="mailbox.html" class="btn btn-white btn-sm" data-toggle="tooltip" data-placement="top" title="Move to draft folder"><i class="fa fa-pencil"></i> Filter</a>-->
                    <!--<a href="mailbox.html" class="btn btn-success btn-sm" data-toggle="tooltip" data-placement="top" title="Discard email"><i class="fa fa-pencil"></i> Filter</a>-->
                </div>
                <h2>
                    Batch Allocation
                </h2>
            </div>
              
           
                <div class="mail-box">
         

                <div class="mail-body">
 <!--<div class="clearfix"></div>-->
                    <form class="form-horizontal" method="get">
                        <div class="ibox-content">
                       <div class="col-md-6">
<!--                                    <div class="clearfix"></div>-->
                                    <select class="select2_demo_1 form-control">
                                        <option></option>
                                        <option value="Bahamas">2016-2017</option>
                                        <option value="Bahrain">2015-2016</option>
                                        <option value="Bangladesh">2014-2015</option>
                                        <option value="Barbados">2013-2014</option>
                                       
                                    </select>

                                </div> 
                       <div class="col-md-6">
<!--                                    <div class="clearfix"></div>-->
                                    <select class="select2_demo_2 form-control">
                                        <option></option>
                                        <option value="Bahamas">Bahamas</option>
                                        <option value="Bahrain">Bahrain</option>
                                        <option value="Bangladesh">Bangladesh</option>
                                        <option value="Barbados">Barbados</option>
                                        <option value="Belarus">Belarus</option>
                                        <option value="Belgium">Belgium</option>
                                        <option value="Belize">Belize</option>
                                        <option value="Benin">Benin</option>
                                    </select>

                                </div> 
                       
                       <div class="col-md-6">
<!--                                    <div class="clearfix"></div>-->
                                    <select class="select2_demo_3 form-control">
                                        <option></option>
                                        <option value="Bahamas">Bahamas</option>
                                        <option value="Bahrain">Bahrain</option>
                                        <option value="Bangladesh">Bangladesh</option>
                                        <option value="Barbados">Barbados</option>
                                        <option value="Belarus">Belarus</option>
                                        <option value="Belgium">Belgium</option>
                                        <option value="Belize">Belize</option>
                                        <option value="Benin">Benin</option>
                                    </select>

                                </div> 
                         
                       <div class="col-md-6">
                                   
                                    <select class="select2_demo_4 form-control">
                                        <option></option>
                                        <option value="Bahamas">Bahamas</option>
                                        <option value="Bahrain">Bahrain</option>
                                        <option value="Bangladesh">Bangladesh</option>
                                        <option value="Barbados">Barbados</option>
                                        <option value="Belarus">Belarus</option>
                                        <option value="Belgium">Belgium</option>
                                        <option value="Belize">Belize</option>
                                        <option value="Benin">Benin</option>
                                    </select>

                                </div> 
                                </div> 
                       
                    
                    
                    
                    
                    
                    </form>

                <!--</div>-->

                    <div class="mail-text h-200">

                      
<!--<div class="clearfix"></div>-->
                        </div>
                    <div class="mail-body text-right tooltip-demo">
                        <a href="mailbox.html" class="btn btn-sm btn-primary" data-toggle="tooltip" data-placement="top" title="Send"><i class="fa fa-reply"></i> Save</a>
                        
                    </div>
                    <div class="clearfix"></div>



                </div>
                </div>
          
               
            </div>
        </div>
        </div>









 <script>
        $(document).ready(function(){
           
            $(".select2_demo_1").select2({
                placeholder: "Select a Academic Year",
                allowClear: true
            });
            $(".select2_demo_2").select2({
                placeholder: "Select a batch",
                allowClear: true
            });
            $(".select2_demo_3").select2({
                placeholder: "Select a batch",
                allowClear: true
            });
            $(".select2_demo_4").select2({
                placeholder: "Select a batch",
                allowClear: true
            });
        });
    </script>

