<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.2.0/basic.css" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.2.0/dropzone.css" />
<div class="tab-content">
    <div id="contact-1" class="tab-pane active">
        <div class="form">
            <div class="row">
                <div class="col-lg-12 col-xs-12 col-md-12" style="margin-top: 5px">
                    <small class="text-danger"><b>* You can add 4 files by clicking below box or dragging files</b></small>
                    <form action="#" class="dropzone" id="dropzoneForm" title="Upload upto 4 files" style=" border: 1px dashed #1ab394;">
                        <div class="fallback">
                            <input name="file" type="file" />
                        </div>
                    </form>

                </div>
                <div class="col-lg-6 col-xs-12 col-md-12" style="margin-top: 18px">
                    <div class="form-group">
                        <label class="control-label" for="doc_name">Document Name </label> <span class="mandatory"> *</span>
                        <input type="text" maxlength="25" placeholder="Enter Document Name" id="doc_name" name="doc_name" value="" class="form-control input-sm">
                    </div>
                </div>
                <div class="col-lg-6 col-xs-12 col-md-12" style="margin-top: 18px">
                    <div class="form-group">
                        <label class="control-label" for="doc_id">Document ID </label> <span class="mandatory"> *</span>
                        <input type="text" maxlength="20" placeholder="Enter Document ID" id="doc_id" name="doc_id" value="" class="form-control input-sm">
                    </div>
                </div>
                <div class="col-lg-6 col-xs-12 col-md-12">
                    <div class="form-group">
                        <label class="control-label" for="issue_date">Date of Issue </label> <span class="mandatory"> *</span>
                        <input type="text" readonly="" id="issue_date" name="issue_date" value="" class="form-control input-sm">
                    </div>
                </div>
                <div class="col-lg-6 col-xs-12 col-md-12">
                    <div class="form-group">
                        <label class="control-label" for="issue_autho">Issuing Authority </label> <span class="mandatory"> *</span>
                        <input type="text" maxlength="30" placeholder="Enter Issuing Authority" id="issue_autho" name="issue_autho" value="" class="form-control input-sm">
                    </div>
                </div>
                <div class="col-lg-6 col-xs-12 col-md-12">
                    <div class="form-group">
                        <label class="control-label" for="renew_date">Expiry/Renewal Date </label> <span class="mandatory"> *</span>
                        <input type="text" readonly="" id="renew_date" name="renew_date" value="" class="form-control input-sm">
                    </div>
                </div>
                <div class="col-lg-6 col-xs-12 col-md-12">
                    <div class="form-group">
                        <label class="control-label" for="purpose">Document Type </label> <span class="mandatory"> *</span>
                        <select class="select2_combo" name="doc_title" id="doc_title">
                            <option value="-1">Select Document Type</option>
                            <?php
                            if (isset($document_title) && !empty($document_title)) {
                                foreach ($document_title as $title) {
                                    echo '<option value = "' . $title['id'] . '">' . $title['title_desc'] . '</option>';
                                }
                            }
                            ?>
                        </select>
                    </div>
                </div>
                <div class="col-lg-6 col-xs-12 col-md-12">
                    <div class="form-group">
                        <label class="control-label" for="other_details">Other Details </label> <span class="mandatory"> *</span>
                        <input type="text" maxlength="50" placeholder="Enter Other Details" id="other_details" name="other_details" value="" class="form-control input-sm">
                    </div>
                </div>
                <div class="col-lg-6 col-xs-12 col-md-12">
                    <div class="form-group">
                        <label class="control-label" for="data_strg_id">Physical File Location </label> <span class="mandatory"> *</span>
                        <input type="text" maxlength="15" placeholder="Enter File Location" id="data_strg_id" name="data_strg_id" value="" class="form-control input-sm">
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
<input type="hidden" name="uploadedFiles" id="uploadedFiles" value="" />
<input type="hidden" name="student_id" id="student_id" value="<?php echo $student_id; ?>" />
<input type="hidden" name="batch_id" id="batch_id" value="<?php echo $batch_id; ?>" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.2.0/dropzone.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.2.0/dropzone-amd-module.js"></script>
<style>
    .dz-max-files-reached {
        background-color: red
    }

    ;
</style>
<script>
    $('#issue_date').datepicker({
        format: 'dd-mm-yyyy',
        //        endDate: '5000d', //This line commented by elavarasan s @ 10-05-2019 12:47
        endDate: '+0d',
        todayBtn: "linked",
        autoclose: true,
    });

    $('#renew_date').datepicker({
        format: 'dd-mm-yyyy',
        autoclose: true,

    });
    var upload_link = baseurl + "document/upload-file";
    Dropzone.prototype.isFileExist = function(file) {
        var i;
        if (this.files.length > 0) {
            for (i = 0; i < this.files.length; i++) {
                if (this.files[i].name === file.name &&
                    this.files[i].size === file.size &&
                    this.files[i].lastModifiedDate.toString() === file.lastModifiedDate.toString()) {
                    return true;
                }
            }
        }
        return false;
    };

    Dropzone.prototype.addFile = function(file) {
        file.upload = {
            progress: 0,
            total: file.size,
            bytesSent: 0
        };
        if (this.options.preventDuplicates && this.isFileExist(file)) {
            //alert(this.options.dictDuplicateFile);
            swal('Duplicate File', this.options.dictDuplicateFile, 'error');
            return;
        }
        this.files.push(file);
        file.status = Dropzone.ADDED;
        this.emit("addedfile", file);
        this._enqueueThumbnail(file);
        return this.accept(file, (function(_this) {
            return function(error) {
                if (error) {
                    file.accepted = false;
                    _this._errorProcessing([file], error);
                } else {
                    file.accepted = true;
                    if (_this.options.autoQueue) {
                        _this.enqueueFile(file);
                    }
                }
                return _this._updateMaxFilesReachedClass();
            };
        })(this));
    };
    var myDropzone = new Dropzone("#dropzoneForm", {
        url: upload_link,
        maxFilesize: 20,
        maxFiles: 4,
        parallelUploads: 1,
        acceptedFiles: "image/*,application/pdf",
        addRemoveLinks: true,
        dictCancelUpload: "Do you want to cancel the upload",
        dictCancelUploadConfirmation: "The upload is cancelled.",
        dictRemoveFileConfirmation: "Are you sure you want to remove the uploaded file ?",
        dictDuplicateFile: "Duplicate files cannot be uploaded.",
        preventDuplicates: true
    });

    //    myDropzone.on("addedfile", function (file) {
    //        console.log(file);
    //        console.log(file.accepted)
    //
    //    });

    myDropzone.on("complete", function(file) {

        if (file.accepted == false) {
            myDropzone.removeFile(file);
            swal('', 'This file is not permitted to uploaded.', 'info');
        }
    });

    myDropzone.on("sending", function(file, xhr, formData) {
        // Will send the filesize along with the file as POST data.
        formData.append("uploadHistory", $('#uploadedFiles').val());
        formData.append("student_id", $('#student_id').val());
        formData.append("upload_master", "Documents");

    });

    myDropzone.on("success", function(file, data) {

        var response = JSON.parse(data);

        if (typeof response == 'object') {
            if (response.status == 1) {
                $('#uploadedFiles').val(response.data);
                swal('File upload', 'File uploaded successfully.', 'success');
                return false;
            } else if (response.status == 44) {
                swal('', response.message, 'info');
                //    this.removeFile(file);
                return false;
            } else if (response.status == 12) {
                swal('', response.message, 'info');
                // this.removeFile(file);
                return false;
            } else {
                swal('', response.message, 'info');
                this.removeFile(file);
                return false;
            }
        } else {
            if (response === false) {
                swal('', 'An error encountered while uploading file.', 'info');
                return false;
            } else {
                swal('', 'An error encountered while uploading file.', 'info');
                return false;
            }
        }

    });


    myDropzone.on("removedfile", function(file) {

        //previously commented code un-commented by elavarasan s @ 1:07
        //        swal({
        //            title: "",
        //            text: "Are you sure you want to remove the uploaded file ?",
        //            type: "warning",
        //            showCancelButton: true,
        //            confirmButtonColor: "#DD6B55",
        //            confirmButtonText: "Yes",
        //            cancelButtonText: "No",
        //            closeOnConfirm: false,
        //            closeOnCancel: false
        //        }, function (isconfirm) {
        //            var isconfirm = confirm('Are you sure you want to remove the uploaded file ?');
        //            if (!isconfirm) {
        //                return false;
        //            } else {
        var uploadHistory = $('#uploadedFiles').val();
        // console.log(uploadHistory);
        // console.log($(this).file.name);
        // return;
        var ops_url = baseurl + 'document/delete-uploaded-file/';
        $.ajax({
            type: "POST",
            cache: false,
            async: false,
            url: ops_url,
            data: {
                "file_to_delete": file.name,
                "uploadHistory": uploadHistory
            },
            success: function(result) {
                var data = JSON.parse(result);
                if (data.status == 1) {
                    if (data.message) {
                        $('#uploadedFiles').val(data.upload_history);
                        swal('', data.message, 'info');
                        return false;
                    } else {
                        if (data.status == 2) {
                            $('#uploadedFiles').val(data.upload_history);
                        }
                        swal('', 'File removed successfully.', 'info');
                        return false;
                    }

                } else {
                    if (data.status == 2) {
                        $('#uploadedFiles').val(data.upload_history);
                    }
                    swal('', 'File removed successfully.', 'info');
                    return false;
                }
            }
        });
        //            } 
        //            else {
        //                return false;
        //            }
        //        });
    });

    myDropzone.on("maxfilesexceeded", function(file) {
        myDropzone.removeFile(file);
        swal('', 'Max file upload count reached.', 'info');
    });

    myDropzone.on("addedfile", function() {
        if (this.files[4] != null) {
            this.removeFile(this.files[4]);
            swal('', 'Max file upload count reached.', 'info');
        }
    });

    function save_document(student_id) {
        var doc_name = $('#doc_name').val();
        var doc_id = $('#doc_id').val();
        var alphanumers = /^[a-zA-Z\s0-9]+$/;
        if ($('#doc_name').val().trim().length == 0) {
            swal('', 'Document Name is required.', 'info');
            return false;
        }
        if (!alphanumers.test($("#doc_name").val())) {
            swal('', 'Document name can have only alphabets or numbers.', 'info');
            return false;
        }
        if ($('#doc_id').val().trim().length == 0) {
            swal('', 'Document ID is required.', 'info');
            return false;
        }
        if (!alphanumers.test($("#doc_id").val())) {
            swal('', 'Document ID can have only alphabets or numbers.', 'info');
            return false;
        }

        if (moment($('#issue_date').val(), "DD-MM-YYYY").isValid() == false) {
            swal('', 'Select a valid Date of Issue.', 'info');
            return false;
        }
        if ($('#issue_autho').val().trim().length == 0) {
            swal('', 'Issuing Authority is required.', 'info');
            return false;
        }
        if (!alphanumers.test($("#issue_autho").val())) {
            swal('', 'Issue Authority can have only alphabets or numbers.', 'info');
            return false;
        }
        if (moment($('#renew_date').val(), "DD-MM-YYYY").isValid() == false) {
            swal('', 'Select a valid Expiry/Renewal Date.', 'info');
            return false;
        }
        if ($('#doc_title').val() == -1) {
            swal('', 'Select a Document Type.', 'info');
            return false;
        }
        var issue_autho = $('#issue_autho').val();
        if ($('#other_details').val().trim().length == 0) {
            swal('', 'Other Details is required.', 'info');
            return false;
        }
        if (!alphanumers.test($("#other_details").val())) {
            swal('', 'Other Details can have only alphabets or numbers.', 'info');
            return false;
        }
        if ($('#data_strg_id').val().trim().length == 0) {
            swal('', 'Physical File Location is required.', 'info');
            return false;
        }
        if (!alphanumers.test($("#data_strg_id").val())) {
            swal('', 'Physical storage location can have only alphabets or numbers.', 'info');
            return false;
        }
        if ($('#uploadedFiles').val().trim().length == 0) {
            swal('', 'Atleast one file is required.', 'info');
            return false;
        }

        var issue_date_validate = moment($('#issue_date').val(), "DD-MM-YYYY");
        var renew_date_validate = moment($('#renew_date').val(), "DD-MM-YYYY");

        if (renew_date_validate < issue_date_validate) {
            swal('', 'Date of Expiry/Renewal is less than Issue Date.', 'info');
            return false;
        }

        var issue_date = moment($('#issue_date').val(), "DD-MM-YYYY").format('YYYY-MM-DD');
        var renew_date = moment($('#renew_date').val(), "DD-MM-YYYY").format('YYYY-MM-DD');


        var type = $('#doc_title').val();
        var other_details = $('#other_details').val();
        var data_strg_id = $('#data_strg_id').val();
        var files_to_be_uploaded = $('#uploadedFiles').val();
        // console.log(files_to_be_uploaded);
        // return;

        var ops_url = baseurl + 'document/save_document_uploaded/';
        $.ajax({
            type: "POST",
            cache: false,
            async: false,
            url: ops_url,
            data: {
                "student_id": student_id,
                "files_to_be_uploaded": files_to_be_uploaded,
                "doc_name": doc_name,
                "doc_id": doc_id,
                "issue_date": issue_date,
                "issue_autho": issue_autho,
                "renew_date": renew_date,
                "type": type,
                "other_details": other_details,
                "data_strg_id": data_strg_id
            },
            success: function(result) {
                try {
                    var data = JSON.parse(result);
                    //                    console.log(data)
                    if (data.status == 1) {
                        swal('Success', 'Document uploaded successfully.', 'success');
                        reset_to_document(student_id);
                    } else {
                        if (data.message.length > 0) {
                            swal('', data.message, 'info');
                            return false;
                        } else {
                            swal('', 'There was an error while updating document upload. Please try again later.', 'info');
                            return false;
                        }
                    }
                } catch (e) {
                    swal('', 'An error encountered while uploading document. Please try again later or contact administrator.', 'info');
                    return false;
                }

            }
        });
    }

    function reset_to_document(student_id) {
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

    function clear_to_documents_list() {
        var student_id = $('#student_id').val();
        var batch_id = $('#batch_id').val();
        var ops_url = baseurl + 'documents/show-documents/';
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
                //                                        var data = $.parseJSON(result)
                //                                        $('#data-view').html(data.view);
                $('#content').html('');
                $('#content').html(result);
                $('html, body').animate({
                    scrollTop: $("#content").offset().top
                }, 1000);
            }
        });
    }
</script>