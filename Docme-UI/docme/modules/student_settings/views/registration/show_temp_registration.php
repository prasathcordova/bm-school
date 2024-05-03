 <div id="profile-detail-content" style="display:none;"></div>
 <div class="row wrapper border-bottom white-bg page-heading registration-view">
     <div class="col-lg-10 col-md-8 col-sm-8 col-xs-12">
         <h2 style="font-size: 20px;">
             <?php echo isset($title) ? $title : "NO TITLE PROVIDED" ?>
         </h2>
         <ol class="breadcrumb">
             <?php
                if (isset($bread_crump_data) && !empty($bread_crump_data)) {
                    echo $bread_crump_data;
                }
                ?>
         </ol>
     </div>
 </div>

 <div class="wrapper wrapper-content animated fadeInRight registration-view" style="padding-top: 1px !important;padding-left: 0px !important;padding-right: 0px !important;">
     <div class="row" style="margin-left: -29px !important; margin-right: -30px !important;">
         <div class="col-lg-12">
             <div class="ibox float-e-margins">
                 <!--                    <div class="ibox-title">
                                            <h5><?php echo isset($sub_title) ? $sub_title : "NO TITLE PROVIDED" ?></h5>
                                        </div>-->
                 <div class="ibox-content" id="registration_loader">
                     <div class="sk-spinner sk-spinner-wave">
                         <div class="sk-rect1"></div>
                         <div class="sk-rect2"></div>
                         <div class="sk-rect3"></div>
                         <div class="sk-rect4"></div>
                         <div class="sk-rect5"></div>
                     </div>
                     <div class="row" id="student_profile_view">
                         <div class="col-lg-12 text-right m-b-sm">
                             <?php
                                $inst_id = base64_encode($this->session->userdata('inst_id'));
                                $base_url = base_url() . 'online-registration?c2Nob29sX2lk=' . $inst_id;
                                ?>
                             <?php if (check_permission(501, 1093, 102)) { ?>
                                 <button class="btn btn-info btn-xs" onclick="showreg('<?php echo $base_url; ?>')" title="New Temporary Registration"><i style="font-size: 15px;" class="material-icons">add</i> New Temporary Registration</button>
                             <?php } ?>
                         </div>
                         <div class="col-lg-6">
                             <div class="form-group">
                                 <div class="input-group">
                                     <input type="text" class="form-control" maxlength="10" placeholder="Search by temporary admission number" id="admission_no" />
                                     <span class="input-group-btn">
                                         <button class="btn btn-sm btn-primary" onclick="filterbyAdmno()" title="Search"><i style="font-size:17px;" class="material-icons">search</i></button>
                                     </span>
                                 </div>
                             </div>
                         </div>
                         <div class="col-lg-6">
                             <div class="form-group">
                                 <div class="input-group">
                                     <input type="text" class="form-control" maxlength="50" placeholder="Search by student name" id="sname" />
                                     <span class="input-group-btn">
                                         <button class="btn btn-sm btn-primary" onclick="filterbyname()" title="Search"><i style="font-size:17px;" class="material-icons">search</i></button>
                                     </span>
                                 </div>
                             </div>
                         </div>
                         <div class="col-lg-12">
                             <div class="row" id="filter_data">
                                 <?php
                                    if (isset($student_data) && is_array($student_data) && !empty($student_data)) {
                                        foreach ($student_data as $sdata) {
                                    ?>
                                         <div class="col-lg-3">
                                             <div class=" contact-box center-version">
                                                 <div class="text-center p-h-sm">
                                                     <h3 style="overflow:hidden;height: 48px;" class="text-uppercase"><strong><?php echo $sdata['fname'] . ' ' . $sdata['mname'] . ' ' . $sdata['lname']; ?></strong></h3>
                                                 </div>
                                                 <table class="table p-h-sm">
                                                     <tr>
                                                         <td>Class</td>
                                                         <td class="text-left">:
                                                             <b>
                                                                 <?php if (isset($sdata['class']) && !empty($sdata['class']))
                                                                        $class_name = $sdata['class'];
                                                                    else
                                                                        $class_name = 'NIL';
                                                                    ?>
                                                                 <span title="<?php echo $class_name ?>">
                                                                     <?php echo (strlen($class_name) > 15 ? substr($class_name, 0, 12) . '...' : $class_name); ?>
                                                                 </span>
                                                             </b>
                                                         </td>
                                                     </tr>
                                                     <tr>
                                                         <td>Temporary <br /> Admission No.</td>
                                                         <td class="text-left">: <b><?php echo $sdata['TempAdmn_No']; ?></b></td>
                                                     </tr>
                                                     <tr>
                                                         <td>Application Date</td>
                                                         <td class="text-left">: <b><?php echo $sdata['ApplicationDate']; ?></b></td>
                                                     </tr>
                                                     <tr>
                                                         <td>Document Status</td>
                                                         <td class="text-left">: <b>
                                                                 <?php if ($sdata['isverified'] == 2) {
                                                                        echo "Verified";
                                                                    } else {
                                                                        echo "Pending";
                                                                    } ?>

                                                             </b></td>
                                                     </tr>
                                                 </table>
                                                 <?php if (check_permission(501, 1094, 102)) { ?>
                                                     <div class=" contact-box-footer">
                                                         <button class="btn btn-xs btn-info" title="Take to Permanent" onclick="take_to_permanent('<?php echo $sdata['TempReg_ID']; ?>')"><i style="font-size:15px;" class="material-icons">how_to_reg</i> Take to Permanent</button>
                                                         <div class="clearfix"></div>
                                                         <!--button class="btn btn-xs btn-info pull-left" title="EDIT" onclick="get_student_data('<?php echo $sdata['TempReg_ID']; ?>')"><i style="font-size:15px;" class="material-icons">edit</i> EDIT</button-->
                                                         <button class="btn btn-xs btn-danger" title="Cancel" onclick="cancel_student_reg('<?php echo $sdata['TempReg_ID']; ?>', '<?php echo $sdata['TempAdmn_No']; ?>')"><i style="font-size:15px;" class="material-icons">close</i> Cancel</button>
                                                         <div class=" clearfix"></div>
                                                     </div>
                                                 <?php } ?>
                                             </div>
                                         </div>
                                     <?php
                                        }
                                    } else {
                                        ?>
                                     <div class="col-lg-12">
                                         <h3 class=" text-muted">No data available.</h3>
                                     </div>
                                 <?php
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
     function take_to_permanent(stud_id) {
         var ops_url = baseurl + 'registration/temporary-to-permanent';
         $.ajax({
             type: "POST",
             cache: false,
             async: false,
             url: ops_url,
             data: {
                 "load": 1,
                 "studentid": stud_id
             },
             success: function(result) {
                 var res = JSON.parse(result);
                 if (res.status == 1) {
                     $('#content').html(res.view);
                 } else if (res.status == 0) {
                     swal('', 'Something Went To Wrong. Please Contact Administrator !', 'warning');
                 }
             }
         });
     }

     function cancel_student_reg(stud_id, admn_no) {
         var dummy = new Object();
         dummy.Admission_no = admn_no;
         swal({
             title: '',
             text: 'Are you sure to cancel the temporary registered student ?',
             type: 'warning',
             showCancelButton: true,
             confirmButtonColor: '#3085d6',
             cancelButtonColor: '#d33',
             confirmButtonText: 'Yes',
             cancelButtonText: 'No',
             closeOnConfirm: false
         }, function(isConfirm) {
             if (isConfirm) {
                 var ops_url = baseurl + 'registration/save-student-temporary-reg';
                 $.ajax({
                     type: "POST",
                     cache: false,
                     async: false,
                     url: ops_url,
                     data: {
                         "load": 1,
                         "update_profile": 1,
                         "studentid": stud_id,
                         "studentdata": JSON.stringify(dummy),
                         "flag": 2
                     },
                     success: function(result) {
                         var data = JSON.parse(result);
                         if (data.status == 1) {
                             $('#admission_number_new').val(data.studentid);
                             swal({
                                 title: '',
                                 text: 'Temporary Registration cancelled successfully.',
                                 type: 'success',
                                 showCancelButton: false,
                                 confirmButtonColor: '#3085d6',
                                 cancelButtonColor: '#d33',
                                 confirmButtonText: 'OK',
                                 closeOnConfirm: false
                             }, function(isConfirm) {
                                 window.location.href = baseurl + "registration/temp-registration";
                             });
                         } else {
                             if (data.message) {
                                 swal('', data.message, 'info')
                             }
                             return false;
                         }
                     }
                 });
             }
         });
     }

     function showreg(baseurl) {
         window.open(baseurl, '_blank');
         //$('#student_profile_enter').show().addClass('animated fadeInRight');
         //$('#student_profile_view').hide();
     }

     function showview() {
         swal({
             title: '',
             text: 'Are you sure to cancel the Temporary Registration ?',
             type: 'warning',
             showCancelButton: true,
             confirmButtonColor: '#3085d6',
             cancelButtonColor: '#d33',
             confirmButtonText: 'Yes',
             cancelButtonText: 'No',
             closeOnConfirm: false
         }, function(isConfirm) {
             if (isConfirm) {
                 window.location.href = baseurl + "registration/temp-registration";
                 return true;
             }
         });
     }
     $('#admission_no').on('keypress', function(e) {
         if (e.keyCode == 13) {
             if ($('#admission_no').val().trim().length < 3) {
                 swal('', 'Enter atleast three characters.', 'info');
                 return false;
             } else {
                 filterbyAdmno();
                 return true;
             }
         }
         if (/[0-9a-zA-Z/]+$/.test(e.key)) {
             return true;
         } else {
             return false;
         }
     });

     $('#sname').on('keypress', function(e) {
         if (e.keyCode == 13) {
             if ($('#sname').val().trim().length < 3) {
                 swal('', 'Enter atleast three characters.', 'info');
                 return false;
             } else {
                 filterbyname();
                 return true;
             }
         }
         if (/[a-zA-Z\s]+$/.test(e.key)) {
             return true;
         } else {
             return false;
         }
     });

     function filterbyname() {
         if ($('#sname').val().trim().length < 3) {
             swal('', 'Enter atleast three characters.', 'info');
             return false;
         }
         if (!/[a-zA-Z\s]+$/.test($('#sname').val().trim())) {
             swal('', 'Alphabets Only Allowed', 'info');
             return false;
         }
         $('#filter_data').removeClass('animated fadeInRight');
         var sname = $('#sname').val();
         var ops_url = baseurl + 'registration/get-temporary-profile-byadmino/';
         $.ajax({
             type: "POST",
             cache: false,
             async: false,
             url: ops_url,
             data: {
                 "searchdata": sname,
                 "flag": 0
             },
             success: function(result) {
                 var data = JSON.parse(result);
                 if (data.status == 1) {
                     $('#filter_data').html(data.view);
                     $('#filter_data').addClass('animated fadeInRight');
                     $('#sname').val('');
                     return true;
                 } else {
                     swal('', 'No data available.', 'info');
                     return false;
                 }
             }
         });
     }

     function filterbyAdmno() {
         if ($('#admission_no').val().trim().length < 3) {
             swal('', 'Enter atleast three characters.', 'info');
             return false;
         }
         if (!/[0-9a-zA-Z/]+$/.test($('#admission_no').val().trim())) {
             swal('', 'Numbers, Alphabets And Slash(/) Only Allowed', 'info');
             return false;
         }
         var admino = $('#admission_no').val();
         $('#filter_data').removeClass('animated fadeInRight');
         var ops_url = baseurl + 'registration/get-temporary-profile-byadmino/';
         $.ajax({
             type: "POST",
             cache: false,
             async: false,
             url: ops_url,
             data: {
                 "searchdata": admino,
                 "flag": 1
             },
             success: function(result) {
                 var data = JSON.parse(result);
                 if (data.status == 1) {
                     $('#filter_data').html(data.view);
                     $('#filter_data').addClass('animated fadeInRight');
                     $('#admission_no').val('')
                     return true;
                 } else {
                     swal('', 'No data available.', 'info');
                     return false;
                 }
             }
         });
     }
 </script>