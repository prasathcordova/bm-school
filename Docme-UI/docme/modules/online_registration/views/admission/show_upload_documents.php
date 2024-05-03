<link href="https://hayageek.github.io/jQuery-Upload-File/4.0.11/uploadfile.css" rel="stylesheet">
<script src="<?php echo base_url('assets/plugins/steps/jquery.steps.min.js'); ?>"></script>
<script src="https://hayageek.github.io/jQuery-Upload-File/4.0.11/jquery.uploadfile.min.js"></script>
<script src="<?php echo base_url('assets/theme/plugins/validate/jquery.validate.js') ?>"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.2/additional-methods.min.js"></script>

<style>
    .alignment {
        text-align: left !important
    }

    .label_tb {
        font-weight: bold;
    }

    label.error {
        float: left !important;
    }
</style>


<div id="profile-detail-content" style="display:none;"></div>
<!--div class="row wrapper border-bottom white-bg page-heading registration-view">
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
</div-->
<style>
    .input-group-prepend,
    .input-group-append {
        display: flex !important;
    }

    .btn {
        position: relative;
        z-index: 2;
    }
</style>
<style type="text/css">
    .form-control:focus {
        outline: auto;
        outline-color: #23c6c8;
    }

    .wizard a,
    .tabcontrol a {
        border: 2px solid transparent;
    }

    .wizard a:focus,
    .tabcontrol a:focus {
        outline: 0;
        /*outline-color: #23c6c8;*/
        border: 2px solid;
        /* border-color: #3F51B5; */
    }
</style>

<div class="wrapper wrapper-content animated fadeInRight registration-view" style="padding-top: 20px !important;padding-left: 0px !important;padding-right: 0px !important;">
    <div class="row" style="margin-left: -29px !important; margin-right: -30px !important;">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <?php
                $reg_open = 1;
                if (isset($reg_date_data) && !empty($reg_date_data)) {
                    foreach ($reg_date_data as $regrow) {
                        if (strtotime($regrow['closing_date']) >= strtotime(date('Y-m-d'))) {
                            $reg_open++;
                        }
                    }
                }
                if ($reg_open == 0) { ?>
                    <div class='alert alert-danger' style='margin-top:150px;'>
                        <h1 style="text-align:center">DOCUMENTS VERIFICATION CLOSED</h1>
                    </div>
                <?php } else if (($user_data['fileverified'] == 1) || ($user_data['fileverified'] == 2)) { ?>

                    <div class='alert alert-success' style='margin-top:150px;'>
                        <h1 style="text-align:center"> DOCUMENTS UPLOADED SUCCESSFULLY</h1>
                        <h4 style="text-align:center"></h4>
                    </div>
                <?php } else if ($user_data['fileverified'] == 3) { ?>
                    <div class='alert alert-danger' style='margin-top:150px;'>
                        <h1 style="text-align:center">DOCUMENTS VERIFICATION REJECTED.</h1>
                    </div>
                <?php } else { ?>
                    <div class="ibox-title" style="text-align :left">
                        <h2> Upload Document </h2>
                    </div>
                    <div class="ibox-content" id="registration_loader">
                        <div class="sk-spinner sk-spinner-wave">
                            <div class="sk-rect1"></div>
                            <div class="sk-rect2"></div>
                            <div class="sk-rect3"></div>
                            <div class="sk-rect4"></div>
                            <div class="sk-rect5"></div>
                        </div>

                        <div class="row" id="student_profile_enter">
                            <div class="col-lg-12">
                                <div class="ibox" style="text-align :left">
                                    <div class="ibox-content">
                                        <?php
                                        if (isset($user_data) && !empty($user_data)) { ?>
                                            <div class="row">
                                                <div class="col-lg-6">
                                                    <dl class="row mb-0">
                                                        <div class="col-sm-4 text-sm-left">
                                                            <dt>Student Name</dt>
                                                        </div>
                                                        <div class="col-sm-8 text-sm-left">
                                                            <dd class="mb-1">:&nbsp;<span class="label label-primary"><?php echo $user_data['fname'] . " " . $user_data['lname']; ?></span></dd>
                                                        </div>
                                                    </dl>
                                                    <dl class="row mb-0">
                                                        <div class="col-sm-4 text-sm-left">
                                                            <dt>Class</dt>
                                                        </div>
                                                        <div class="col-sm-8 text-sm-left">
                                                            <dd class="mb-1">:&nbsp;<?php echo $user_data['class']; ?></dd>
                                                        </div>
                                                    </dl>
                                                    <dl class="row mb-0">
                                                        <div class="col-sm-4 text-sm-left">
                                                            <dt>DOB</dt>
                                                        </div>
                                                        <div class="col-sm-8 text-sm-left">
                                                            <dd class="mb-1"> :&nbsp;<?php echo $user_data['dob']; ?></dd>
                                                        </div>
                                                    </dl>
                                                    <dl class="row mb-0">
                                                        <div class="col-sm-4 text-sm-left">
                                                            <dt>Parent Name</dt>
                                                        </div>
                                                        <div class="col-sm-8 text-sm-left">
                                                            <dd class="mb-1">:&nbsp;<?php echo $user_data['parentName']; ?></dd>
                                                        </div>
                                                    </dl>
                                                    
                                                </div>
                                                <div class="col-lg-6" id="cluster_info">
                                                    <dl class="row mb-0">
                                                        <div class="col-sm-4 text-sm-left">
                                                            <dt>Email ID</dt>
                                                        </div>
                                                        <div class="col-sm-8 text-sm-left">
                                                            <dd class="mb-1"> :&nbsp;<?php echo $user_data['L_mail']; ?></dd>
                                                        </div>
                                                    </dl>
                                                    <dl class="row mb-0">
                                                        <div class="col-sm-4 text-sm-left">
                                                            <dt>Registered On</dt>
                                                        </div>
                                                        <div class="col-sm-8 text-sm-left">
                                                            <dd class="mb-1"> :&nbsp;<?php echo date('d-M-Y', strtotime($user_data['createdon'])); ?></dd>
                                                        </div>
                                                    </dl>
                                                    <dl class="row mb-0">
                                                        <div class="col-sm-4 text-sm-left">
                                                            <dt>Payment Status</dt>
                                                        </div>
                                                        <div class="col-sm-8 text-sm-left">

                                                            <dd class="mb-1">:&nbsp;<span class="label label-warning"><?php  echo (($user_data['payment_status'])==1) ? "Paid" : "Unpaid" ?></span></dd>
                                                        </div>
                                                    </dl>
                                                    <dl class="row mb-0">
                                                        <div class="col-sm-4 text-sm-left">
                                                            <dt>Address</dt>
                                                        </div>
                                                        <div class="col-sm-8 text-sm-left">
                                                            <dd class="mb-1">
                                                                :&nbsp;<?php echo $user_data['O_Address1'];
                                                                        echo "</br>"; ?>
                                                            </dd>
                                                            <dd class="mb-1">
                                                                &nbsp;&nbsp;<?php echo $user_data['O_Address2'];
                                                                            echo "</br>"; ?>
                                                            </dd>
                                                            <dd class="mb-1">
                                                                &nbsp;&nbsp;<?php echo  $user_data['O_Address3']; ?>
                                                            </dd>
                                                        </div>
                                                    </dl>

                                                </div>
                                            </div>

                                        <?php
                                        }
                                        ?>
                                        <hr>
                                        <?php
                                        $j = 1;
                                        if (isset($image_data) && !empty($image_data) && is_array($image_data)) {

                                            foreach ($image_data as $images) {
                                                if ($images['isverified'] == 2) {
                                                    // print_r($images);
                                                    $block_box_[$images['file_name_uploaded']] =  $images['file_1'];
                                                    $block_type_[$images['file_name_uploaded']] =  $images['file_1_type'];
                                                    $block_check[$images['file_name_uploaded']] =  $images['file_name_uploaded'];
                                                    $block_dis_[$images['file_name_uploaded']] =  "disabled";
                                                }

                                                $j++;
                                            }
                                        }
                                        ?>
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <div class="m-b-md">
                                                    <h2> Documents</h2>
                                                    <hr>
                                                </div>

                                            </div>
                                            <?php $attributes = array('name' => 'submit_data', 'id' => 'submit_data', 'method' => 'POST', 'enctype' => 'multipart/form-data'); //To enable CSRF protection
                                            echo form_open('online-registration/uploaded-documents', $attributes);  ?>

                                            <?php $i = 1;
                                            if (isset($document_data) && !empty($document_data) && is_array($document_data) && ($document_data['error_status'] == 0)) {
                                                foreach ($document_data['data'] as $documents) {
                                                    $blockname =  'block_box' . $i. '_image';
                                                    $blockname_1 =  'block_box' . $i . '_name';
                                            ?>
                                                    <div class="row text-center">
                                                        <div class="col-md-4 text-left" style="padding-left: 15%;padding-top:16px;">
                                                            <div class="form-group">
                                                                <label for="files" class="label-control mb-0 labeLfont"><?php echo $documents['document_Name']; ?> <?php if ($documents['isrequired'] == 1) {
                                                                                                                                                                        echo "*";
                                                                                                                                                                    } else {
                                                                                                                                                                    }  ?> </label>

                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="form-group"></div>
                                                            <?php

                                                            if (isset($block_check[$documents['document_Name']])) {
                                                                if ($block_dis_[$documents['document_Name']] == "disabled") {
                                                                    if ($block_type_[$documents['document_Name']] == ".pdf") {
                                                            ?>
                                                                        <a class="btn btn-primary text-center" target="_blank" href="<?php echo base_url(); ?>/uploads/documents/temp_registration/<?php echo (isset($block_box_[$documents['document_Name']])) ? $block_box_[$documents['document_Name']] : set_value(''); ?>">
                                                                            <i class="fa fa-file-pdf-o"></i>Show PDF</a>
                                                                        <i class="fa fa-check-circle" style="color:green;font-size:20px;padding-left: 20px;" aria-hidden="true"></i>

                                                                    <?php } else { ?>
                                                                        <img src="<?php echo base_url(); ?>/uploads/documents/temp_registration/<?php echo (isset($block_box_[$documents['document_Name']])) ? $block_box_[$documents['document_Name']] : set_value(''); ?>" width="300px" height="120px">
                                                                        <i class="fa fa-check-circle" style="color:green;font-size:20px;padding-left: 20px;" aria-hidden="true"></i>
                                                                    <?php } ?>
                                                                    <input type="file" style="display:none" <?php echo $block_dis_[$documents['document_Name']] ?> onchange="ValidateSize(this)" class="form-control image_name" id="<?php echo $blockname; ?>" name="<?php echo $blockname; ?>" data-required="<?php echo $documents['isrequired']; ?>" value="<?php echo (isset($block_box_[$documents['document_id']])) ? $block_box_[$documents['document_id']] : set_value(''); ?>" <?php echo (isset($block_dis_[$documents['document_Name']])) ? $block_dis_[$documents['document_Name']] : set_value(''); ?> multiple accept='image/*,.pdf'>
                                                                <?php  } else { ?>
                                                                    <input type="file" onchange="ValidateSize(this)" class="form-control image_name" id="<?php echo $blockname; ?>" name="<?php echo $blockname; ?>" data-required="<?php echo $documents['isrequired']; ?>" <?php echo (isset($block_dis_[$documents['document_Name']])) ? $block_dis_[$documents['document_Name']] : set_value(''); ?> multiple accept='image/*,.pdf'>

                                                                <?php }
                                                            } else { ?>
                                                                <input type="file" onchange="ValidateSize(this)" class="form-control image_name text-right" id="<?php echo $blockname; ?>" name="<?php echo $blockname; ?>" data-required="<?php echo $documents['isrequired']; ?>" multiple accept='image/*,.pdf'>

                                                            <?php } ?>

                                                            <input type="hidden" class="file_name" name="<?php echo $blockname_1; ?>" id="<?php echo $blockname_1; ?>" value="<?php echo $documents['document_Name']; ?>">
                                                            <input type="hidden" class="fileverified" name="fileverified" value="<?php echo (isset($user_data['fileverified'])) ? $user_data['fileverified'] : set_value('0'); ?>">
                                                            <span class="error"><?php echo form_error("<?php echo $blockname; ?>"); ?></span>
                                                            <div class="clearfix"></div>
                                                        </div>
                                                        <div class="col-md-4 text-left">
                                                            <span style="font-size:10px;display:block;padding-top:25px;font-weight: 800;">* Allowed Files : pdf , jpg , png with size less than 2MB</span>
                                                        </div>
                                                    </div>
                                            <?php
                                                    $i++;
                                                }
                                            }
                                            ?>
                                            <input type="hidden" class="row_count_inputs" value="<?php echo ($i - 1); ?>">
                                            <input type="hidden" class="temp_id" value="<?php echo $temp_id; ?>">
                                            <input type="hidden" class="inst_id" value="<?php echo $inst_id; ?>">
                                            <div class="form-actions text-center" style="padding:10px;">
                                                <button type="submit" id="submitblock2" value="submit" name="submit" class="btn btnTabLeft btn-primary">
                                                    <i class="ft-check"></i>
                                                    Submit
                                                </button>
                                            </div>
                                            <?php echo form_close(); ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div id="curd-content" style="display: none;"></div>
                            </div>

                        </div>
                    </div>
            </div>
        </div>
    </div>
</div>
<!-- </fieldset>
</div>
</div>
</div> -->
<?php } ?>
<!-- </div>
</div>
</div>
</div> -->


<script>
    //Address fill functionality Ends here

    //Code written by Elavarasan S @ May,9 2019 2:42
    $.validator.addMethod("synchronousRemote", function(value, element, param) {
        if (value == -1) {
            return false;
        } else {
            return true;
        }
    }, "Select the field");
    
    function typeNumberOnly(eve) {
        var e = (eve.which) ? eve.which : eve.keyCode;
        if (e != 8 && e != 0 && (e < 48 || e > 57)) {
            return false;
        }
    }


    function showview() {
        swal({
            title: '',
            text: 'Need Confirmation, Do you want to cancel this process ?',
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

    
    function ValidateSize(file) {
        var FileSize = file.files[0].size / 1024 / 1024; // in MB
        if (FileSize > 2) {
            swal({
                title: '',
                text: 'File size exceeds 2 MB',
                type: 'warning',
                showCancelButton: false,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'OK'
            }, function(isConfirm) {
                $(file).val('');
            });
            //for clearing with Jquery
        } else  {
             $('input[name^="block_box"]').each(function() {
                if ($(this).val() == $('#'+file.id).val() && $(this).attr('id') != file.id)
                {
                    swal({
                    title: '',
                    text: 'File name must not be same.',
                    type: 'warning',
                    showCancelButton: false,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'OK'
                }, function(isConfirm) {
                    $(file).val('');
                });
                }

            });
        }
    }
    $('#submitblock2').click(function() {
        //set global rules & messages array to use in validator
        var rules = {};
        var messages = {};
        //get input, select, textarea of form
        $('#submit_data').find('input, select, textarea').each(function() {
            var name = $(this).attr('name');
            var isrequired = $(this).attr('data-required');
            var file_name = $("#"+name).val();
            // if(isrequired == 1){
            rules[name] = {};
            messages[name] = {
                accept: "Allowed Types pdf, jpeg, png ."
            };
            rules[name] = {
                required: true,
                accept: "application/pdf,image/jpeg,image/png"
            }; // set required true against every name

            // }
            if (isrequired == 0) {
                rules[name].required = false;
                //messages[name].email = "Please provide valid email";
            }
            
        });
        $('#submit_data').submit(function(e) {
            e.preventDefault();
        }).validate({
            rules: rules,
            messages: messages,
            submitHandler: function(form) {
                //     console.log("validation success");
                $('#registration_loader').addClass('sk-loading');
                save_temp_file_details();
            }
        });
    });

    
    function save_temp_file_details() {
        row_count_inputs = $(".row_count_inputs").val();
        fileverified = $(".fileverified").val();
        temp_id = $(".temp_id").val();
        inst_id = $(".inst_id").val();
        var form_data = new FormData();
        form_data.append('temp_id', temp_id)
        form_data.append('inst_id', inst_id)
        form_data.append('totoal_count_row', row_count_inputs)
        form_data.append('fileverified', fileverified)
        for (j = 1; j <= row_count_inputs; j++) {
            form_data.append('block_box' + j + '_image', $('#block_box' + j + '_image').prop('files')[0])
            form_data.append('block_box' + j + '_name', $('#block_box' + j + '_name').val())
        }


        var ops_url = baseurl + 'online-registration/uploaded-documents';
        $.ajax({
            url: ops_url, // point to server-side PHP script 
            dataType: 'text', // what to expect back from the PHP script, if anything
            cache: false,
            async: false,
            contentType: false,
            processData: false,
            data: form_data,
            type: 'post',
            success: function(result) {
                var data = JSON.parse(result);
                $('#registration_loader').removeClass('sk-loading');
                if (data.status == 1) {
                    swal({
                        title: '',
                        text: data.message,
                        type: 'success',
                        showCancelButton: false,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'OK'
                    }, function(isConfirm) {
                        $('#registration_loader').addClass('sk-loading');
                        location.reload();
                    });
                } else {
                    if (data.message) {
                        swal('', data.message, 'info')
                    }
                    flag = 0;
                }
            },
            error: function() {
                flag = 0;
            }
        });
        /*  $('#otp_verification').val('');
         return flag === 1; */

    }



    $("select").on("select2:close", function(e) {
        $(this).valid();
    });
</script>