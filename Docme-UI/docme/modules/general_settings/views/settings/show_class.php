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

                <form method="get" action="index.html" class="pull-right mail-search">
                    <div class="input-group">
                        <input type="text" class="form-control input-sm" name="search" placeholder="Search Class ">
                        <div class="input-group-btn">
                            <button type="submit" class="btn btn-sm btn-primary">
                                Search
                            </button>
                        </div>
                    </div>
                </form>
                <h2>
                   Class Details
                </h2>
                <div class="mail-tools tooltip-demo m-t-md">
                    <div class="btn-group pull-right">
                        <button class="btn btn-white btn-sm"><i class="fa fa-arrow-left"></i></button>
                        <button class="btn btn-white btn-sm"><i class="fa fa-arrow-right"></i></button>

                    </div>
                    <button class="btn btn-primary btn-xs" data-toggle="tooltip" data-placement="left" title="Refresh Batch"><i class="fa fa-refresh"></i> REFRESH</button>
                    <button class="btn btn-primary btn-xs" data-toggle="tooltip" data-placement="left" title="Add a Batch"><i class="fa fa-plus"></i> ADD</button>
                    <button class="btn btn-primary btn-xs" data-toggle="tooltip" data-placement="left" title="Edit a Batch"><i class="fa fa-edit"></i> EDIT</button>
<!--                    <button class="btn btn-white btn-sm" data-toggle="tooltip" data-placement="top" title="Mark as read"><i class="fa fa-eye"></i> </button>
                    <button class="btn btn-white btn-sm" data-toggle="tooltip" data-placement="top" title="Mark as important"><i class="fa fa-exclamation"></i> </button>
                    <button class="btn btn-white btn-sm" data-toggle="tooltip" data-placement="top" title="Move to trash"><i class="fa fa-trash-o"></i> </button>-->

                </div>
            </div>
                <div class="mail-box">

                <table class="table table-hover table-mail">
                <tbody>
                <tr class="read">
                   
                        <td ><strong>Status</strong></td>
                   
                    <td class="mail-ontact"><strong>Course</strong></td>
                    <td class="mail-subject"><strong>Class</strong></td>
                    <td class="mail-subject"><strong>Description</strong></td>
                   
                   
                </tr>
                <tr class="read">
                    <td class="check-mail">
                        <input type="checkbox" class="i-checks">
                    </td>
                    <td class="mail-ontact"><a href="mail_detail.html">School Classes</a></td>
                    <td class="mail-subject"><a href="mail_detail.html">I</a></td>
                    <td class="mail-subject"><a href="mail_detail.html">First</a></td>
                    
                </tr>
                <tr class="read">
                    <td class="check-mail">
                        <input type="checkbox" class="i-checks">
                    </td>
                    <td class="mail-ontact"><a href="mail_detail.html">School Classes</a></td>
                    <td class="mail-subject"><a href="mail_detail.html">II</a></td>
                    <td class="mail-subject"><a href="mail_detail.html">Second</a></td>
                  
                </tr>
                <tr class="read">
                    <td class="check-mail">
                        <input type="checkbox" class="i-checks">
                    </td>
                    <td class="mail-ontact"><a href="mail_detail.html">School Classes</a></td>
                    <td class="mail-subject"><a href="mail_detail.html">III</a></td>
                    <td class="mail-subject"><a href="mail_detail.html">Third</a></td>
                  
                   
                </tr>
                <tr class="read">
                    <td class="check-mail">
                        <input type="checkbox" class="i-checks">
                    </td>
                      <td class="mail-ontact"><a href="mail_detail.html">School Classes</a></td>
                    <td class="mail-subject"><a href="mail_detail.html">IV</a></td>
                    <td class="mail-subject"><a href="mail_detail.html">Fourth</a></td>
                  
                   
                </tr>
                <tr class="read">
                    <td class="check-mail">
                        <input type="checkbox" class="i-checks">
                    </td>
                    <td class="mail-ontact"><a href="mail_detail.html">School Classes</a></td>
                    <td class="mail-subject"><a href="mail_detail.html">V</a></td>
                    <td class="mail-subject"><a href="mail_detail.html">Fifth</a></td>
                   
                   
                </tr>
                <tr class="read">
                    <td class="check-mail">
                        <input type="checkbox" class="i-checks">
                    </td>
                    <td class="mail-ontact"><a href="mail_detail.html">School Classes</a></td>
                    <td class="mail-subject"><a href="mail_detail.html">VI</a></td>
                    <td class="mail-subject"><a href="mail_detail.html">Sixth</a></td>
                   
                   
                </tr>
              
              
                
              
                </tbody>
                </table>


                </div>
            </div>
        </div>
        </div>









 <script>
        $(document).ready(function(){
            $('.i-checks').iCheck({
                checkboxClass: 'icheckbox_square-green',
                radioClass: 'iradio_square-green',
            });
        });
    </script>

