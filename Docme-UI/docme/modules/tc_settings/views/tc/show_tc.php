 <link href="<?php echo base_url('assets/css/steps/jquery.steps.css'); ?>" rel="stylesheet">
 <!-- Steps -->

 <script src="<?php echo base_url('assets/plugins/metisMenu/jquery.metisMenu.js'); ?>"></script>
 <script src="<?php echo base_url('assets/plugins/steps/jquery.steps.min.js'); ?>"></script>
 <script src="<?php echo base_url('assets/plugins/validate/jquery.validate.min.js'); ?>"></script>
 <!--<link href="<?php //echo base_url('assets/plugins/steps/jquery.steps.min.js');                                    
                    ?>" rel="stylesheet">-->
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
 <div class="wrapper wrapper-content animated fadeInRight" style="padding-top: 1px !important;padding-left: 0px !important;padding-right: 0px !important;">
     <div class="row" style="margin-left: -29px !important; margin-right: -30px !important;">


         <div class="col-lg-12">
             <div class="ibox float-e-margins">
                 <!--                <div class="ibox-title">
                                    <h5><?php //echo isset($sub_title) ? $sub_title : "NO TITLE PROVIDED"       
                                        ?></h5>
                                </div>-->

                 <div class="ibox-content" id="tc-content">
                     <div class="input-group">
                         <input type="text" placeholder="Search Student by name..." class=" form-control">
                         <!--                        <span class="input-group-btn">
                            <button type="button" class="btn btn-info"> Search</button>
                        </span>-->
                         <span class="input-group-btn">
                             <button type="button" class="btn btn-info" style="margin-right: 4px; border-radius: 4px"> Search</button>
                             <button type="button" class="btn btn-info" style="border-radius:4px" onclick="search_filter()"> &nbsp;Filter&nbsp;</button>

                         </span>
                     </div>
                     <div class="row">
                         <div class="col-lg-12">
                             <div id="curd-content" style="display: none;"></div>
                         </div>
                         <div class="clearfix"></div>
                         <div class="wrapper wrapper-content animated fadeInRight">
                             <div class="row">
                                 <?php
                                    if (isset($app_details_data) && !empty($app_details_data) && is_array($app_details_data)) {
                                        $breaker = 0;
                                        foreach ($app_details_data as $student) {
                                    ?>
                                         <div class="col-lg-3">
                                             <div class="contact-box center-version">

                                                 <a href="javascript:void(0);">
                                                     <?php
                                                        $profile_image = "";
                                                        if (isset($student['profile_image']) && !empty($student['profile_image'])) {

                                                            $profile_image = "data:image/png;base64," . $student['profile_image'];
                                                        } else {
                                                            $profile_image = base_url('assets/img/a2.jpg');
                                                        }
                                                        ?>
                                                     <img alt="image" class="img-circle" src="<?php echo $profile_image; ?>">
                                                     <h3 class="m-b-xs"><strong><?php echo $student['name'] ?></strong></h3>



                                                 </a>
                                                 <table class="table table-stripped small m-t-md " style="border-top: 0px; text-align: left; ">
                                                     <tbody>
                                                         <tr>
                                                             <td width="25%">
                                                                 Admission No.
                                                             </td>
                                                             <td>
                                                                 :<b> <?php echo $student['admn_no'] ?></b>
                                                             </td>
                                                         </tr>
                                                         <tr>
                                                             <td>
                                                                 Batch Name
                                                             </td>
                                                             <td>
                                                                 :<b> <?php echo $student['batch_name'] ?></b>
                                                             </td>
                                                         </tr>
                                                         <tr>
                                                             <td>
                                                                 Parent Name
                                                             </td>
                                                             <td>
                                                                 : <b> <?php echo $student['name_of_guardian_in_application'] ?></b>
                                                             </td>
                                                         </tr>
                                                         <tr>
                                                             <td>
                                                                 Contact No.
                                                             </td>
                                                             <td>
                                                                 : <b> <?php echo $student['mob'] ?></b>
                                                             </td>
                                                         </tr>
                                                         <tr>
                                                             <td>
                                                                 TC Applied Date
                                                             </td>
                                                             <td>
                                                                 : <b> <?php echo date('d-m-Y', strtotime($student['entry_date'])); ?> </b>
                                                             </td>
                                                         </tr>



                                                     </tbody>
                                                 </table>
                                                 <div class="contact-box-footer">
                                                     <div class="m-t-md ">
                                                         <a class="btn btn-xs btn-info" onclick="tc_cancellation('<?php echo $student['student_id']; ?>','<?php echo $student['name']; ?>');"> Cancel</a>
                                                         <a class="btn btn-xs btn-info" onclick="tc_preparation('<?php echo $student['student_id']; ?>');"> Prepare</a>
                                                         <!--<a class="btn btn-xs btn-info" onclick="tc_issue('<?php echo $student['student_id']; ?>');"> Issue</a>-->
                                                     </div>
                                                 </div>
                                             </div>
                                         </div>


                                 <?php
                                            if ($breaker == 3) {
                                                echo '<div class="clearfix"></div>';
                                                $breaker = 0;
                                            } else {
                                                $breaker++;
                                            }
                                        }
                                    }
                                    ?>



                             </div>
                         </div>


                     </div>
                 </div>
             </div>

         </div>
     </div>
 </div>


 <script>
     function tc_preparation(student_id) {
         var ops_url = baseurl + 'tc/tc-preparation/';
         $.ajax({
             type: "POST",
             cache: false,
             async: false,
             url: ops_url,
             //            data: {"load": 1, "studentid": student_id},
             data: {
                 "student_id": student_id
             },
             success: function(data) {
                 $('#tc-content').html('');
                 $('#tc-content').html(data);

             }
         });
     }

     function tc_cancellation(student_id, name) {
         var ops_url = baseurl + 'tc/tc-cancel/';
         $.ajax({
             type: "POST",
             cache: false,
             async: false,
             url: ops_url,
             //            data: {"load": 1, "studentid": student_id},
             data: {
                 "student_id": student_id,
                 "name": name
             },
             success: function(result) {
                 var data = JSON.parse(result);
                 if (data.status == 1) {
                     swal('Success', 'TC cancelled successfully', 'success');
                     //Pass batch id to view and then to function, then actvate below code with batchid variable        
                     //load_students_after_filter('406')

                     return true;
                 }

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
             data: {
                 "student_id": student_id
             },
             success: function(data) {
                 $('#tc-content').html('');
                 $('#tc-content').html(data);

             }
         });
     }



     function search_filter() {
         var ops_url = baseurl + 'tc/search-filter';
         $.ajax({
             type: "POST",
             cache: false,
             async: false,
             url: ops_url,
             data: {
                 "load": 1
             },
             success: function(data) {
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