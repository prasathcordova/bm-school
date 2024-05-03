<div class="row clearfix" style="padding-bottom: 60px;">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="card">
            <div class="header">
                <h2 style="padding-bottom: 10px;font-size: 16px;"><?php echo isset($sub_title) ? $sub_title : "NO TITLE PROVIDED" ?>
                    <span><a href="javascript:void(0)" onclick="close_add_document();"> <i style="font-size: 30px !important; float: right; color: #E91E63;" class="material-icons" data-toggle="tooltip" title="Close">close</i></a> </span>
                    <span><a href="javascript:void(0)" onclick="submit_data();"> <i style="font-size: 30px !important; float: right; color: #23C6C5; padding-right: 10px;" class="material-icons" data-toggle="tooltip" title="Save">save</i></a> </span>
                    <span><a href="javascript:void(0)" onclick="refresh_add_panel();"> <i style="font-size: 30px !important; float: right; color: #2196F3; padding-right: 10px;" class="material-icons " data-toggle="tooltip" title="Refresh">refresh</i></a> </span>
                </h2>
            </div>

            <div class="row clearfix">
            </div>
            <div class="body">
                <?php
                echo form_open('notification/add-notification', array('id' => 'notification_save', 'role' => 'form'));
                ?>
                <input type="hidden" name="save_flag" id="save_flag" value="1" />
                <div class="row" style="padding-top:20px;padding-left:10px;">
                    <div class="row">
                        <div class="col-md-6">
                            <b>Template Name</b><span class="mandatory"> *</span>
                            <div class="form-group">
                                <div class="form-line <?php
                                                        if (form_error('notification_name')) {
                                                            echo 'has-error';
                                                        }
                                                        ?> ">
                                    <input type="text" class="form-control" placeholder="Enter Template name" name="notification_name" id="notification_name" value="<?php echo set_value('notification_name', isset($notification_name) ? $notification_name : '');  ?>" maxlength="30" />
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group" style="padding-top: 21px;padding-right: 21px;">
                                <div class="form-line  ">


                                    <label> <input type="radio" name="email_status" value="sms_message" checked="" id="sms_status"> <b> SMS </b> </label>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group" style="padding-top: 21px;padding-right: 21px;">
                                <div class="form-line  ">
                                    <label> <input type="radio" name="email_status" value="" id="email_status">
                                        <b> Email </b> </label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row sms_message">
                        <div class="col-md-10">
                            <b>SMS Content</b><span class="mandatory"> *</span>
                            <div class="form-group">
                                <div class="form-line <?php
                                                        if (form_error('sms_message')) {
                                                            echo 'has-error';
                                                        }
                                                        ?> ">
                                    <textarea class="form-control charscal_sms" placeholder="Enter SMS Message" name="sms_message" id="sms_message" maxlength="160" style="width: 650px; height: 95px; resize: none;"></textarea>
                                    <span id="smschars">160</span> Character(s) Remaining
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="row email_message" style="display: none;">
                        <div class="col-md-10">
                            <b>Email Content</b><span class="mandatory"> *</span>
                            <div class="form-group">
                                <div class="form-line <?php
                                                        if (form_error('email_message')) {
                                                            echo 'has-error';
                                                        }
                                                        ?> ">
                                    <textarea class="form-control d-none charscal_email" placeholder="Enter Email Message" name="email_message" id="email_message" maxlength="350" style="width: 650px; height: 95px; resize: none;"></textarea>
                                    <span id="emailchars">350</span> Character(s) Remaining
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php echo form_close(); ?>
            </div>
        </div>
        <div class="row" style="padding-left:20px">

            <h3>Notable Fields :- </h3>
            <h5 class="mb-0">Admission No. : <button href="#" type="button" class="typochar" id="admissionno" value="{admissionno}">#admissionno</button> , Student Name : <button href="#" type="button" class="typochar" id="admissionno" value="{studentname}">#studentname</button> , Date : <button href="#" type="button" class="typochar" id="currentdate" value="{currentdate}">#currentdate</button> , Arrear
                Amount : <button href="#" type="button" class="typochar" id="amount" value="{amount}">#amount</button> </h5>
        </div>
    </div>

</div>

<hr />
<script>
    $(document).on("keyup change click", "#sms_message", function(e) {
        var maxLength = 160;
        var textlen = maxLength - $(this).val().length;
        $('#smschars').text(textlen);
    });
    $(document).on("keyup change click", "#email_message", function(e) {
        var maxLength = 350;
        var textlen = maxLength - $(this).val().length;
        $('#emailchars').text(textlen);
    });
    $('#sms_status').change(function() {
        $('#email_status').prop('checked', false);
        $(this).attr('value', this.checked ? "sms_message" : "");
        $("#email_status").val("")
        if ($("#sms_status").val() == "sms_message") {
            $(".sms_message").show();
            $(".email_message").hide();
        } else {
            $(".sms_message").hide();
        }

    });
    $('#email_status').change(function() {
        $('#sms_status').prop('checked', false);
        $(this).attr('value', this.checked ? "email_message" : "");
        $("#sms_status").val("")
        if ($("#email_status").val() == "email_message") {
            $(".email_message").show();
            $(".sms_message").hide();
        } else {
            $(".email_message").hide();
        }

    });
    $(document).ready(function() {
        $(".typochar").click(function() {

            if ($('input[type=radio][name=email_status]:checked').val() == "sms_message") {
                $('.charscal_email').text("");
                var txt = $.trim($(this).val());
                var box = $('.charscal_email');
                box.val(box.val() + txt);
                $("#sms_message").trigger("click");
            } else {
                $('.charscal_sms').text("");
                var txt = $.trim($(this).val());
                var box = $('.charscal_sms');
                box.val(box.val() + txt);
                $("#email_message").trigger("click");
            }

        });
    });
</script>