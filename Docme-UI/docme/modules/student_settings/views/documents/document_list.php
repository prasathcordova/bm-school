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
                <!--<div class="ibox">-->
                <div class="ibox-title">
                    <h5><?php echo $title ?></h5>
                    <span class="pull-right">
                        <a href="javascript:void(0);" id="new_doc" onclick="add_document('<?php echo $student_data['student_id']; ?>', '<?php echo $batch_id; ?>')" class="btn btn-primary btn-xs" data-toggle="tooltip" data-placement="left" title="Add a Document"><i class="fa fa-user-plus"></i> ADD New Document</a>
                        <a href="javascript:void(0);" style="display: none;" id="save_document" onclick="save_document('<?php echo $student_data['student_id']; ?>')" class="btn btn-primary btn-xs" data-toggle="tooltip" data-placement="left" title="Save Document"><i class="fa fa-save"></i> Save Document</a>
                        <a href="javascript:void(0);" style="display: none;" id="view_document_list" onclick="clear_to_documents_list()" class="btn btn-primary btn-xs" data-toggle="tooltip" data-placement="left" title="Return to Document list"><i class="fa fa-backward"></i> Back</a>
                    </span>
                </div>
                <!--</div>-->
                <div class="ibox-content" id="document_param_loader">
                    <div class="sk-spinner sk-spinner-wave">
                        <div class="sk-rect1"></div>
                        <div class="sk-rect2"></div>
                        <div class="sk-rect3"></div>
                        <div class="sk-rect4"></div>
                        <div class="sk-rect5"></div>
                    </div>
                    <div class="row">
                        <div class="col-md-3">
                            <button class="btn btn-white" data-toggle="tooltip" title="Back to profile of <?php echo $student_data['student_name']; ?>" style="width: 100%;margin-bottom: 10px;" onclick="profile_detail('<?php echo $student_data['student_id']; ?>')"><i class="fa fa-arrow-left"></i> Student Profile</button>
                            <div class="ibox">
                                <div class="ibox-content text-center">
                                    <div class="profile-image" style="width:100%">
                                        <?php
                                        $profile_image = "";
                                        if (!empty(get_student_image($student_data['student_id']))) {
                                            $profile_image = get_student_image($student_data['student_id']);
                                        } else if (isset($student_data['profile_image']) && !empty($student_data['profile_image'])) {

                                            $profile_image = "data:image/png;base64," . $student_data['profile_image'];
                                        } else {
                                            if (isset($student_data['profile_image_alternate']) && !empty($student_data['profile_image_alternate'])) {
                                                $profile_image = $student_data['profile_image_alternate'];
                                            } else {
                                                $profile_image = base_url('assets/img/a0.jpg');
                                            }
                                        }
                                        ?>
                                        <img src="<?php echo $profile_image; ?>" class="img-circle" alt="profile">
                                    </div>
                                    <div class="clearfix"></div><br />
                                    <h3 style="overflow: hidden"><?php echo $student_data['student_name']; ?></h3>
                                    <div class="clearfix"></div><br>

                                    <div class="font-bold"> Batch : <?php echo isset($student_data['Batch_Name']) && !empty($student_data['Batch_Name']) ? $student_data['Batch_Name'] : 'Un Assigned'; ?></div>
                                </div>
                            </div>
                            <div class="ibox">
                                <div class="ibox-title">
                                    <!--<h5>Documents Summary</h5>-->
                                    Documents Summary
                                </div>
                                <div class="ibox-content">
                                    <span>
                                        Total Documents
                                    </span>
                                    <h3 class="font-bold">
                                        <?php
                                        echo (isset($document_count) && !empty($document_count) && $document_count != 0) ? $document_count : '0';
                                        ?>
                                    </h3>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-9" id="document_data_holder">
                            <div id="document_list_scroller">
                                <div class="table-responsive">
                                    <table class="table shoping-cart-table">
                                        <tbody>
                                            <?php
                                            if (isset($document_list) && !empty($document_list)) {
                                                foreach ($document_list as $documents) {
                                            ?>

                                                    <tr>
                                                        <td class="desc" style="border-bottom: 1px;border-bottom-color: navy;">
                                                            <h3 class="text-navy">
                                                                <!--<a href="#" c>-->
                                                                <?php echo strtoupper($documents['Doc_name']); ?>
                                                                <!--</a>-->
                                                            </h3>
                                                            <div class="row">
                                                                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12" style="padding-top: 5px;">
                                                                    Document Type : <?php echo $documents['title_desc'] ?>
                                                                </div>
                                                                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12" style="padding-top: 5px;">
                                                                    Document Name : <?php echo $documents['Doc_name'] ?>
                                                                </div>
                                                                <div class="clearfix"></div>
                                                                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12" style="padding-top: 5px;">
                                                                    Document ID : <?php echo $documents['doc_id_no'] ?>
                                                                </div>
                                                                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12" style="padding-top: 5px;">
                                                                    Date of Issue : <?php echo date('d-m-Y', strtotime($documents['date_of_issue'])); ?>
                                                                </div>
                                                                <div class="clearfix"></div>
                                                                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12" style="padding-top: 5px;">
                                                                    Issuing Authority : <?php echo $documents['issueing_authority'] ?>
                                                                </div>
                                                                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12" style="padding-top: 5px;">
                                                                    Expiry/Renewal Date : <?php echo date('d-m-Y', strtotime($documents['expiry_date'])); ?>
                                                                </div>
                                                                <div class="clearfix"></div>
                                                                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12" style="padding-top: 5px;">
                                                                    Physical File Location : <?php echo $documents['data_storage_id'] ?>
                                                                </div>
                                                                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12" style="padding-top: 5px;">
                                                                    Current status of document : <?php echo $documents['status_name'] ?>
                                                                </div>
                                                                <div class="clearfix"></div>
                                                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="padding-top: 10px;">
                                                                    Other Details : <?php echo $documents['other_details'] ?>
                                                                </div>
                                                            </div>
                                                            <div class="m-t-sm" style="padding-top: 10px;">
                                                                <?php
                                                                if (isset($documents['file_list']) && !empty($documents['file_list']) && is_array(json_decode($documents['file_list'], TRUE)) == TRUE) {
                                                                    $file_list = json_decode($documents['file_list'], TRUE);
                                                                    $i = 0;
                                                                    foreach ($file_list as $files_uploaded) {
                                                                        if ($i != 0) {
                                                                            echo ' | ';
                                                                        }
                                                                        $i++;
                                                                ?>
                                                                        <a target="_blank" href="<?php echo base_url('assets/Uploads/documents/' . $files_uploaded['uploaded_file_name']) ?>" data-toggle="tooltip" title="View File" style="padding-right: 5px;padding-left: 5px;" class="text-muted"><i class="fa fa-cloud-download"></i> <?php echo $files_uploaded['orginal_file_name'] ?></a>
                                                                        <!-- onclick="view_file('<?php echo $files_uploaded['id'] ?>', '<?php echo $documents['Doc_id']; ?>', '<?php echo $files_uploaded['uploaded_file_name'] ?>', '<?php echo $documents['Student_id'] ?>')" -->
                                                                <?php
                                                                    }
                                                                }
                                                                ?>

                                                            </div>
                                                            <div class="m-t-md">
                                                                <a href="#" onclick="remove_document('<?php echo $documents['Doc_id']; ?>', '<?php echo $documents['Student_id'] ?>')" class="text-muted"><i class="fa fa-trash"></i> Remove Document</a>
                                                            </div>
                                                        </td>




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
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $('#document_list_scroller').slimscroll({
        "height": "450px"
    });

    function add_document(student_id, batch_id) {
        //     alert(student_id);die;
        $('#document_param_loader').addClass('sk-loading');
        var ops_url = baseurl + 'document/adddocument/';
        $.ajax({
            type: "POST",
            cache: false,
            async: false,
            url: ops_url,
            data: {
                "student_id": student_id,
                "batch_id": batch_id
            },
            success: function(result) {
                $('#document_param_loader').removeClass('sk-loading');
                $('#document_data_holder').html('');
                $('#document_data_holder').html(result);
                $('#new_doc').hide();
                $('#save_document').show();
                $('#view_document_list').show();
                $('html, body').animate({
                    scrollTop: $("#content").offset().top
                }, 1000);
                $('#doc_title').select2({
                    "theme": "bootstrap",
                    "width": "100%"
                });
            }
        });
        $('#document_param_loader').removeClass('sk-loading');
    }

    function view_file(file_id, doc_id, file_name, student_id) {
        var ops_url = baseurl + 'document/view-file/';
        $('#document_param_loader').addClass('sk-loading');
        $.ajax({
            type: "POST",
            cache: false,
            async: false,
            url: ops_url,
            data: {
                "file_id": file_id,
                "doc_id": doc_id,
                "file_name": file_name,
                "student_id": student_id
            },
            success: function(result) {
                try {
                    var data = JSON.parse(result);
                    $('#document_param_loader').removeClass('sk-loading');
                    if (data.status == 1) {
                        var $a = $("<a>");
                        $a.attr("href", data.link);
                        $("body").append($a);
                        $a.attr("download", file_name);
                        $a[0].click();
                        $a.remove();
                        setTimeout(
                            function() {
                                var ops_url = baseurl + 'document/view-file-remove/';
                                $.ajax({
                                    type: "POST",
                                    cache: false,
                                    async: false,
                                    url: ops_url,
                                    data: {
                                        "file_name": data.file_name
                                    },
                                    success: function(result) {
                                        return true;
                                    }
                                });
                            }, 20000
                        );
                    } else {
                        swal('', 'File information unavailable. Please try again later', 'info');
                        return false;
                    }

                } catch (e) {
                    $('#report_param_loader').removeClass('sk-loading');
                    swal('', 'An error encountered. Please try again later or contact administrator with the error code : DPRAPPUIJSNER10001', 'info');
                    return false;
                }
                $('#document_param_loader').removeClass('sk-loading');
            }

        });
        $('#document_param_loader').removeClass('sk-loading');
    }

    function remove_document(doc_id, student_id) {
        $('#document_param_loader').addClass('sk-loading');
        swal({
            title: "",
            text: "Are you sure you want to remove the document ?",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "Yes",
            cancelButtonText: "No",
            closeOnConfirm: false
        }, function(isconfirm) {
            if (isconfirm) {

                var ops_url = baseurl + 'document/remove-document/';
                $.ajax({
                    type: "POST",
                    cache: false,
                    async: false,
                    url: ops_url,
                    data: {
                        "student_id": student_id,
                        "doc_id": doc_id
                    },
                    success: function(result) {
                        $('#document_param_loader').removeClass('sk-loading');
                        try {
                            $('#document_param_loader').removeClass('sk-loading');
                            var data = JSON.parse(result);
                            if (data.status == 1) {
                                swal('', 'Document removed successfully.', 'success');
                                document_rest(student_id);
                            } else {
                                swal('', 'Document removal failed. Please try again later', 'info');
                                return false;
                            }
                        } catch (e) {
                            $('#document_param_loader').removeClass('sk-loading');
                        }

                    }
                });
            }
        });
        $('#document_param_loader').removeClass('sk-loading');
    }

    function document_rest(student_id) {
        var ops_url = baseurl + 'documents/show-documents/';
        $.ajax({
            type: "POST",
            cache: false,
            async: false,
            url: ops_url,
            data: {
                "student_id": student_id
            },
            success: function(result) {
                $('#content').html('');
                $('#content').html(result);
                $('html, body').animate({
                    scrollTop: $("#content").offset().top
                }, 1000);
            }
        });
    }

    function profile_detail(studentid) {
        var batchid = $('#batchid').val();
        var ops_url = baseurl + 'profilestudent/show-studentprofile/';
        $.ajax({
            type: "POST",
            cache: false,
            async: false,
            url: ops_url,
            data: {
                "load": 1,
                "studentid": studentid,
                "batchid": batchid
            },
            success: function(data) {
                $('#content').html('');
                $('#content').show();
                $('#content').html(data);
                $('.registration-view').hide();
                $('html, body').animate({
                    scrollTop: $("#content").offset().top
                }, 1000);
            }
        });
    }
</script>