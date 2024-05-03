 <link href="<?php echo base_url('assets/css/steps/jquery.steps.css'); ?>" rel="stylesheet">
 <!-- Steps -->

 <script src="<?php echo base_url('assets/plugins/metisMenu/jquery.metisMenu.js'); ?>"></script>
 <script src="<?php echo base_url('assets/plugins/steps/jquery.steps.min.js'); ?>"></script>
 <script src="<?php echo base_url('assets/plugins/validate/jquery.validate.min.js'); ?>"></script>
<script>
    $(document).ready(function() {
  $('#summernote').summernote();
});
    </script>
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

                 <div class="ibox-content">

                     <!--<div class="col-lg-12">-->
                     <div class="mail-box-header">
                         <div class="pull-right tooltip-demo">

                             <a href="javascript:void(0);" onclick="load_students_for_email_discard('<?php echo $batchid; ?>','<?php echo $acd_yrid; ?>','<?php echo $courseid; ?>')" class="btn btn-danger btn-sm" data-toggle="tooltip" data-placement="top" title="Discard email"><i class="fa fa-times"></i> Discard</a>
                         </div>
                         <h2>
                             Compose Email
                         </h2>
                     </div>
                     <div class="mail-box">

                        <form class="form-horizontal" method="post">
                         <div class="mail-body">

                            
                                 <input type="hidden" name="batchid" id="batchid" />
                                 <div class="form-group"><label class="col-sm-2 control-label">To:</label>
                                     <div class="col-sm-10"><input type="text" class="form-control" value="<?php echo (isset($parent_email[0]['EMAIL']) && !empty($parent_email[0]['EMAIL']) ? $parent_email[0]['EMAIL'] : ''); ?>" id="to_email"></div>
                                 </div>
                                 <div class="form-group"><label class="col-sm-2 control-label">Subject:</label>

                                     <div class="col-sm-10"><input type="text" class="form-control" value=""  maxlength="75" id="subject"></div>
                                 </div>

                         </div>

                         <div class="mail-text h-200">
                            <textarea id="summernote" name="editordata" class="summernote" maxlength="500">
                                <h4>Hello <span class=""><?php if(isset($parent_email[0]['Parent_Name']) && !empty($parent_email[0]['Parent_Name']))
                                                                                {
                                                                                  echo  $parent_email[0]['Parent_Name'].'
                                                                                    ,<br/>
                                                                                    <div class="col-lg-12">
                                                                                    <div class="widget p-md">
                                                                                        <table style="font-size:12px">
                                                                                                <tr><td>
                                                                                                <u>Student Details</u>
                                                                                            </td></tr>
                                                                                            <tr><td>
                                                                                                '.
                                                                                                $student_name
                                                                                                .'
                                                                                            </td></tr>
                                                                                            <tr>
                                                                                               <td> 
                                                                                               <label> Admission No:</label>
                                                                                                '.
                                                                                                $admn_no
                                                                                               .'
                                                                                               </td>
                                                                                            </tr>
                                                                                            <tr>
                                                                                                <td>
                                                                                               <label> Batch:</label>
                                                                                                '.
                                                                                                $batch_name
                                                                                               .'
                                                                                               </td>
                                                                                            </tr>
                                                                                            
                                                                                        </table>
                                                                
                                                                                    </div>';

                                                                                 } else{
                                                                                    '';
                                                                                }  ?></span> </h4>
                            </textarea>
                
                             <div class="clearfix"></div>
                         </div>
                         <div class="mail-body text-right tooltip-demo">
                             <input type="hidden" name="intial_text" id="intial_text" value="<h4>Hello <?php echo (isset($parent_email[0]['Parent_Name']) && !empty($parent_email[0]['Parent_Name'])) ? $parent_email[0]['Parent_Name'] : ''; ?></h4><br/><br/>" />
                             <a href="javascript:void(0);" onclick="submit_email_data();" class="btn btn-sm btn-primary" data-toggle="tooltip" data-placement="top" title="Send"><i class="fa fa-reply"></i> Send</a>

                         </div>
                         <div class="clearfix"></div>

                        </form>

                     </div>
                 </div>


             </div>
         </div>
     </div>
 </div>
 <!--</div>-->
 <script>
     $(document).ready(function() {

         //        $('.summernote').summernote();
         $('.summernote').summernote({
             toolbar: [
                 ["style", ["style"]],
                 ["font", ["bold", "underline", "clear"]],
                 ["fontname", ["fontname"]],
                 ["color", ["color"]],
                 ["para", ["ul", "ol", "paragraph"]],
                 //["table", ["table"]],
                 //                ["insert", ["link", "picture", "video"]],
                 ["insert", ["link", "picture"]],
                 //                ["view", ["fullscreen", "codeview", "help"]]
             ]
         });

     });


     function submit_email_data() {
         $('#faculty_loader').addClass('sk-loading');

         var to_email = $('#to_email').val();
         var subject = $('#subject').val();
         var body = $(".summernote").summernote("code");
         var testEmail = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
         if (to_email == '') {
             swal('', 'Enter To Email', 'info');
             return false;
         } else if (!testEmail.test(to_email)) {
             swal('', 'Enter a valid To email id.', 'info');
             return false;
         } else if (subject == '') {
             swal('', 'Enter subject', 'info');
             return false;
         } else {
             var ops_url = baseurl + 'registration/send-mail';
             $.ajax({
                 type: "POST",
                 cache: false,
                 async: false,
                 url: ops_url,
                 data: {
                     "to_email": to_email,
                     "subject": subject,
                     "email_body": body
                 },
                 dataType: 'html',
                 success: function(result) {
                     var data = JSON.parse(result);
                     if (data.status == 1) {
                         var intial_text = $('#intial_text').val().trim();
                         $(".summernote").summernote("code", intial_text);
                         $('#subject').val('');
                         swal('', 'Email sent successfully', 'success');
                     } else {
                         swal('', 'There is an issue with sending email. Please contact administrator');
                         return false;
                     }
                 }
             });
         }


     }

     function load_students_for_email_discard(batch_id, acdyear, courseid) {

         var ops_url = baseurl + 'profile/show-profile';
         $.ajax({
             type: "POST",
             cache: false,
             async: false,
             url: ops_url,
             data: {
                 "load": 1,
                 "batchid": batch_id,
                 "acd_year": acdyear,
                 "courseid": courseid
             },
             success: function(result) {
                 var data = JSON.parse(result);
                 console.log(data);
                 if (data.status == 1) {
                     $('#content').html('');
                     $('#content').html(data.view);
                 } else {

                 }
             },
             error: function() {}
         });
     }
 </script>