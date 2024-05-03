<div class="ibox">
    <div class="ibox-content" id="parent_search_loader">
        <div class="sk-spinner sk-spinner-wave">
            <div class="sk-rect1"></div>
            <div class="sk-rect2"></div>
            <div class="sk-rect3"></div>
            <div class="sk-rect4"></div>
            <div class="sk-rect5"></div>
        </div>
        <div class="row clearfix" id="search_content">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header">
                        <h2 style="padding-bottom: 10px;font-size: 16px;"><?php echo isset($title) ? $title : "NO TITLE PROVIDED" ?>
                            <span><a href="javascript:void(0);" onclick="close_parent_search();"> <i style="font-size: 30px !important; float: right; color: #E91E63;" class="material-icons" data-toggle="tooltip" title="Close">close</i></a> </span>
                            <span><a href="javascript:void(0);" onclick="submit_data();"> <i style="font-size: 30px !important; float: right; color: #4CAF50; padding-right: 10px;" class="material-icons" data-toggle="tooltip" title="Search">search</i></a> </span>

                        </h2>
                    </div>
                    <div class="body">
                        <?php
                        echo form_open('registration/search-parent', array('id' => 'search_parent', 'role' => 'form'));
                        ?>
                        <input type="hidden" name="save_flag" id="save_flag" value="1" />
                        <div class="row clearfix" style="padding: 10px">
                            <div class="form-group col-lg-6 col-xs-12 col-md-12">
                                <label>Admission Number:</label>

                                <div class="form-line <?php
                                                        if (form_error('admn_no_for_parent_search')) {
                                                            echo 'has-error';
                                                        }
                                                        ?> ">
                                    <input type="text" class="form-control input-sm" placeholder="Enter Admission Number" name="admn_no_for_parent_search" id="admn_no_for_parent_search" value="<?php echo set_value('admn_no_for_parent_search ', isset($admn_no_for_parent_search) ? $admn_no_for_parent_search : ''); ?>" onkeypress="return numberSlashOnly(event)" maxlength="10" />
                                </div>
                            </div>
                            <div class="form-group col-lg-6 col-xs-12 col-md-12">
                                <label>Student First Name:</label>

                                <div class="form-line <?php
                                                        if (form_error('first_name')) {
                                                            echo 'has-error';
                                                        }
                                                        ?> ">
                                    <input type="text" class="form-control input-sm fname" placeholder="Enter Student First Name " name="first_name" id="first_name" value="<?php echo set_value('first_name ', isset($first_name) ? $first_name : ''); ?>" onkeypress="return alphaOnly(event)" maxlength="50" />
                                </div>

                            </div>
                            <div class="form-group col-lg-6 col-xs-12 col-md-12">
                                <label>Mobile No :</label>
                                <div class="form-line <?php
                                                        if (form_error('phn')) {
                                                            echo 'has-error';
                                                        }
                                                        ?> ">
                                    <input type="text" class="form-control input-sm" placeholder="Enter Mobile No " name="phn" id="phn" value="<?php echo set_value('phn', isset($phn) ? $phn : ''); ?>" onkeypress="return typeNumberOnly(event)" maxlength="12" />
                                </div>

                            </div>
                            <div class="form-group col-lg-6 col-xs-12 col-md-12">
                                <label>E-mail :</label>
                                <div class="form-line <?php
                                                        if (form_error('email')) {
                                                            echo 'has-error';
                                                        }
                                                        ?> ">
                                    <input type="text" class="form-control input-sm email" placeholder="Enter E-mail " name="email" id="email" value="<?php echo set_value('email', isset($email) ? $email : ''); ?>" onkeypress="return emailOnly(event)" />
                                </div>

                            </div>
                            <div class="form-group col-lg-6 col-xs-12 col-md-12">
                                <label>Parent Name:</label>

                                <div class="form-line <?php
                                                        if (form_error('pname')) {
                                                            echo 'has-error';
                                                        }
                                                        ?> ">
                                    <input type="text" class="form-control input-sm pname" placeholder="Enter Parent Name " name="pname" id="pname" value="<?php echo set_value('pname ', isset($pname) ? $pname : ''); ?>" onkeypress="return alphaOnly(event)" maxlength="50" />
                                </div>


                            </div>
                            <div class="form-group col-lg-6 col-xs-12 col-md-12">
                                <label>Match :</label>
                                <div class="form-line <?php
                                                        if (form_error('flag')) {
                                                            echo 'has-error';
                                                        }
                                                        ?> ">
                                    <select class="select2_demo_3 form-control" name="flag" id="flag">
                                        <option value="3">Anywhere</option>
                                        <option value="4">Exactly</option>
                                        <option value="1">Starts With</option>
                                        <option value="2">Ends With</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <?php echo form_close(); ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="row" id="results" style="display:none">
            <div class="body">
                <?php
                echo form_open('registration/search-parent', array('id' => 'search_parent1', 'role' => 'form'));
                ?>

                <div class="row" style="padding:10px">
                    <h2 style="padding:10px">Student Search Results
                    </h2>
                    <?php
                    if (isset($search_status) && !empty($search_status) && is_array($search_status)) {
                        $counter = 0;
                        foreach ($search_status as $search) {
                    ?>

                            <div class="col-lg-3" onclick="">
                                <div class="hide" id="Student_id" name="Student_id"> <?php echo $search['Student_id']; ?> </div>

                                <div class="contact-box center-version" style="min-height: 250px">

                                    <a href="javascript:void(0);" style="padding-bottom:5px !important;">
                                        <?php
                                        $profile_image = "";
                                        if (isset($search['profile_image']) && !empty($search['profile_image'])) {

                                            $profile_image = "data:image/png;base64," . $search['profile_image'];
                                        } else if (isset($search['profile_image_alternate']) && !empty($search['profile_image_alternate'])) {
                                            $profile_image = $search['profile_image_alternate'];
                                        } else {
                                            $profile_image = base_url('assets/img/a0.jpg');
                                        }
                                        ?>
                                        <img alt="image" class="img-circle" src="<?php echo $profile_image; ?>" />
                                        <h3 class="m-b-xs pro-name text-uppercase" style="overflow:hidden;height: 48px;"><strong><?php echo $search['First_Name'] . " " . $search['Middle_Name'] . " " . $search['Last_Name'] ?></strong></h3>
                                    </a>

                                    <div class="font-bold" style="text-align: center;padding-bottom: 6px;padding-top: 4px;">Admission No.:<?php echo $search['Admn_No'] ?></div>
                                    <table class="table" style="margin-bottom:0px;">
                                        <tbody>
                                            <tr>
                                                <td class="project-status">
                                                    <span class="label label-warning-light"><?php echo $search['stud_status']; ?></span>
                                                </td>
                                            </tr>

                                        </tbody>
                                    </table>
                                    <div class="contact-box-footer">
                                        <div class="m-t-xs btn-group">
                                            <a class="btn btn-xs btn-info " onclick="select_id('<?php echo $search['Student_id']; ?>');">SELECT</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php
                            if ($counter == 3) {
                                echo '<div class="clearfix"></div>';
                                $counter = 0;
                            } else {
                                $counter++;
                            }
                        }
                        if (count($search_status) == 0) {
                            ?>
                            <div class="col-lg-12">
                                <h3 class="text-muted font-normal">No related data found !</h3>
                            </div>
                        <?php
                        }
                    } else {
                        ?>
                        <div class="col-lg-12">
                            <h3 class="text-muted font-normal">No related data found !</h3>
                        </div>
                    <?php
                    }
                    ?>
                </div>
                <?php echo form_close(); ?>
            </div>
        </div>
    </div>
</div>

<script>
    $(".select2_demo_1").select2({
        "theme": "bootstrap",
        "width": "100%"

    });
    $(".select2_demo_2").select2({
        "theme": "bootstrap",
        "width": "100%"
    });
    $(".select2_demo_3").select2({
        "theme": "bootstrap",
        "width": "100%"
    });

    $('#results').hide();

    function typeNumberOnly(eve) {
        var e = (eve.which) ? eve.which : eve.keyCode;
        if (e != 8 && e != 0 && (e < 48 || e > 57)) {
            return false;
        }
    }
    $('.pname,.fname').keyup(function(e) {
        $(this).val($(this).val().toUpperCase());
    });

    function alphaOnly(e) {
        if (!/[a-zA-Z]|\-|\s+?$/.test(e.key)) {
            return false;
        }


    }

    function emailOnly(e) {
        var regex = /^[ A-Za-z0-9_@.]*$/;
        if (!regex.test(e.key)) {
            return false;
        }


    }

    function numberSlashOnly(e) {
        if (!/[0-9a-zA-Z/]+$/.test(e.key)) {
            return false;
        }
    }

    function submit_data() {
        $('#parent_search_loader').addClass('sk-loading');
        var ops_url = baseurl + 'registration/search-parent';
        var flag = $("#flag").val();

        if (flag == -1) {
            swal('', 'flag is required.', 'info');
            $('#parent_search_loader').removeClass('sk-loading');
            return;
        }
        if ($('#phn').val() == '' && $('#email').val() == '' && $('#pname').val() == '' && $('#first_name').val() == '' && $('#admn_no_for_parent_search').val() == '') {
            swal('', 'Enter any field', 'info');
            $('#parent_search_loader').removeClass('sk-loading');
            return false;
        } else {
            $.ajax({
                type: "POST",
                cache: false,
                async: false,
                url: ops_url,
                data: $('#search_parent').serialize(),
                success: function(result) {
                    $('#curd-content').html(result);
                    $('#results').show();
                    $('#parent_search_loader').removeClass('sk-loading');
                }
            });
            $('#parent_search_loader').removeClass('sk-loading');
        }
    }

    function select_id(Student_id) {

        var Student_id = Student_id;
        var ops_url = baseurl + 'registration/pass-stdid/';
        $.ajax({
            type: "POST",
            cache: false,
            async: false,
            url: ops_url,
            data: {
                "Student_id": Student_id
            },
            success: function(result) {
                var data = JSON.parse(result);
                fill_out_parent_details(data.parent_data);
            }
        });
    }

    function fill_out_parent_details(parent_data) {
        if (parent_data) {
            $('.checkbox').hide();
            $('#sibling_student_data_id').val(parent_data.student_id);
            $('#father_id').val(parent_data.father_id);
            $('#fname').val(parent_data.Father);
            $('#fname').prop('readonly', true);
            $('#f_unique_identity').val(parent_data.f_adhar);
            if (parent_data.f_adhar != null)
                $('#f_unique_identity').prop('readonly', true);

            $("#fprofession").select2("val", parent_data.F_profession_id);
            // $('#fprofession').trigger('change');

            $('#fprofession').attr('disabled', true);

            $("#fprofession option[value='-1']").remove();
            $('#fprofession option:not(:selected)').attr('disabled', true);

            $('#fadd1').val(parent_data.F_C_address1);
            if (parent_data.F_C_address1 != null)
                $('#fadd1').prop('readonly', true);

            $('#fadd2').val(parent_data.F_C_address2);
            if (parent_data.F_C_address2 != null)
                $('#fadd2').prop('readonly', true);

            $('#fadd3').val(parent_data.F_C_address3);
            if (parent_data.F_C_address3 != null)
                $('#fadd3').prop('readonly', true);

            $('#fzip').val(parent_data.F_C_ZIP_CODE);
            if (parent_data.F_C_ZIP_CODE != 0)
                $('#fzip').prop('readonly', true);

            $('#fphone').val(parent_data.F_C_Phone1);
            if (parent_data.F_C_Phone1 != null)
                $('#fphone').prop('readonly', true);

            $('#fmobile').val(parent_data.F_C_Phone3);
            if (parent_data.F_C_Phone3 != null)
                $('#fmobile').prop('readonly', true);

            $('#fmail').val(parent_data.Email);
            if (parent_data.Email != null)
                $('#fmail').prop('readonly', true);


            $('#foadd1').val(parent_data.F_O_address1);
            if (parent_data.F_O_address1 != null)
                $('#foadd1').prop('readonly', true);

            $('#foadd2').val(parent_data.F_O_address2);
            if (parent_data.F_O_address2 != null)
                $('#foadd2').prop('readonly', true);

            $('#foadd3').val(parent_data.F_O_address3);
            if (parent_data.F_O_address3 != null)
                $('#foadd3').prop('readonly', true);

            $('#fozip').val(parent_data.F_O_ZIP_CODE);
            if (parent_data.F_O_ZIP_CODE != 0)
                $('#fozip').prop('readonly', true);

            $('#fophone').val(parent_data.F_O_Phone1);
            if (parent_data.F_O_Phone1 != null)
                $('#fophone').prop('readonly', true);

            $('#fomobile').val(parent_data.F_O_Phone3);
            if (parent_data.F_O_Phone3 != null)
                $('#fomobile').prop('readonly', true);

            $('#fomail').val(parent_data.OEmail);
            if (parent_data.OEmail != null)
                $('#fomail').prop('readonly', true);


            $('#fcadd1').val(parent_data.F_H_address1);
            if (parent_data.F_H_address1 != null)
                $('#fcadd1').prop('readonly', true);

            $('#fcadd2').val(parent_data.F_H_address2);
            if (parent_data.F_H_address2 != null)
                $('#fcadd2').prop('readonly', true);

            $('#fcadd3').val(parent_data.F_H_address3);
            if (parent_data.F_H_address3 != null)
                $('#fcadd3').prop('readonly', true);

            $('#fczip').val(parent_data.F_H_ZIP_CODE);
            if (parent_data.F_H_ZIP_CODE != 0)
                $('#fczip').prop('readonly', true);

            $('#fcphone').val(parent_data.F_H_Phone1);
            if (parent_data.F_H_Phone1 != null)
                $('#fcphone').prop('readonly', true);

            $('#fcmobile').val(parent_data.F_H_Phone3);
            if (parent_data.F_H_Phone3 != null)
                $('#fcmobile').prop('readonly', true);

            $('#fcmail').val(parent_data.HEmail);
            if (parent_data.HEmail != null)
                $('#fcmail').prop('readonly', true);


            $('#mother_id').val(parent_data.mother_id);

            $('#mname').val(parent_data.Mother);
            if (parent_data.Mother != null)
                $('#mname').prop('readonly', true);

            $('#m_unique_identity').val(parent_data.m_adhar);
            if (parent_data.m_adhar != null)
                $('#m_unique_identity').prop('readonly', true);


            $("#mprofession").select2("val", parent_data.M_profession_id);
            $('#mprofession').trigger('change');
            $('#mprofession').attr('disabled', true);

            $("#mprofession option[value='-1']").remove();
            $('#mprofession option:not(:selected)').attr('disabled', true);

            $('#madd1').val(parent_data.M_C_address1);
            if (parent_data.M_C_address1 != null)
                $('#madd1').prop('readonly', true);

            $('#madd2').val(parent_data.M_C_address2);
            if (parent_data.M_C_address2 != null)
                $('#madd2').prop('readonly', true);

            $('#madd3').val(parent_data.M_C_address3);
            if (parent_data.M_C_address3 != null)
                $('#madd3').prop('readonly', true);

            $('#mzip').val(parent_data.M_C_ZIP_CODE);
            if (parent_data.M_C_ZIP_CODE != 0)
                $('#mzip').prop('readonly', true);

            $('#mphone').val(parent_data.M_C_Phone1);
            if (parent_data.M_C_Phone1 != null)
                $('#mphone').prop('readonly', true);

            $('#mmobile').val(parent_data.M_C_Phone3);
            if (parent_data.M_C_Phone3 != null)
                $('#mmobile').prop('readonly', true);

            $('#mmail').val(parent_data.M_C_Email);
            if (parent_data.M_C_Email != null)
                $('#mmail').prop('readonly', true);


            $('#moadd1').val(parent_data.M_O_address1);
            if (parent_data.M_O_address1 != null)
                $('#moadd1').prop('readonly', true);

            $('#moadd2').val(parent_data.M_O_address2);
            if (parent_data.M_O_address2 != null)
                $('#moadd2').prop('readonly', true);

            $('#moadd3').val(parent_data.M_O_address3);
            if (parent_data.M_O_address3 != null)
                $('#moadd3').prop('readonly', true);

            $('#mozip').val(parent_data.M_O_ZIP_CODE);
            if (parent_data.M_O_ZIP_CODE != 0)
                $('#mozip').prop('readonly', true);

            $('#mophone').val(parent_data.M_O_Phone1);
            if (parent_data.M_O_Phone1 != null)
                $('#mophone').prop('readonly', true);

            $('#momobile').val(parent_data.M_O_Phone3);
            if (parent_data.M_O_Phone3 != null)
                $('#momobile').prop('readonly', true);

            $('#momail').val(parent_data.M_O_Email);
            if (parent_data.M_O_Email != null)
                $('#momail').prop('readonly', true);



            $('#mcadd1').val(parent_data.M_H_address1);
            if (parent_data.M_H_address1 != null)
                $('#mcadd1').prop('readonly', true);

            $('#mcadd2').val(parent_data.M_H_address2);
            if (parent_data.M_H_address2 != null)
                $('#mcadd2').prop('readonly', true);

            $('#mcadd3').val(parent_data.M_H_address3);
            if (parent_data.M_H_address3 != null)
                $('#mcadd3').prop('readonly', true);

            $('#mczip').val(parent_data.M_H_ZIP_CODE);
            if (parent_data.M_H_ZIP_CODE != 0)
                $('#mczip').prop('readonly', true);

            $('#mcphone').val(parent_data.M_H_Phone1);
            if (parent_data.F_C_Phone3 != null)
                $('#mcphone').prop('readonly', true);

            $('#mcmobile').val(parent_data.M_H_Phone3);
            if (parent_data.M_H_Phone3 != null)
                $('#mcmobile').prop('readonly', true);

            $('#mcmail').val(parent_data.M_H_Email);
            if (parent_data.M_H_Email != null)
                $('#mcmail').prop('readonly', true);


            // $('#guardian_id').val(parent_data.guardian_id);
            // if (typeof(parent_data.guardian_id) != "undefined" && parent_data.guardian_id !== null) {
            //     var guardId = $('#guardian_id').val(parent_data.guardian_id);
            // } else {
            var guardId = 0;
            $('#guardian_id').val(parent_data.guardian_id);
            $('#gname').val(parent_data.Guardian);
            //if (parent_data.Guardian != null)
                $('#gname').prop('readonly', true);

            $('#g_unique_identity').val(parent_data.g_adhar);
            //if (parent_data.g_adhar != null)
                $('#g_unique_identity').prop('readonly', true);

            $("#ggender").select2("val", parent_data.Gender);
            $('#ggender').trigger('change');
            //if (parent_data.Gender != null)
            $('#ggender').attr('disabled', true);
            $('#ggender option:not(:selected)').attr('disabled', true);

            $("#gprofession").select2("val", parent_data.G_profession_id);
            $('#gprofession').trigger('change');
           // if (parent_data.G_profession_id != null)
                $('#gprofession').attr('disabled', true);

            $("#gprofession option[value='-1']").remove();
            $('#gprofession option:not(:selected)').attr('disabled', true);

            $('#gadd1').val(parent_data.G_C_address1);
            //if (parent_data.G_C_address1 != null)
                $('#gadd1').prop('readonly', true);

            $('#gadd2').val(parent_data.G_C_address2);
            //if (parent_data.G_C_address2 != null)
                $('#gadd2').prop('readonly', true);

            $('#gadd3').val(parent_data.G_C_address3);
            //if (parent_data.G_C_address3 != null)
                $('#gadd3').prop('readonly', true);

            $('#gzip').val(parent_data.G_C_ZIP_CODE);
           // if (parent_data.G_C_ZIP_CODE == 0 || parent_data.G_C_ZIP_CODE == null)
               // $('#gzip').prop('readonly', false);
           // else
                $('#gzip').prop('readonly', true);

            $('#gphone').val(parent_data.G_C_Phone1);
           // if (parent_data.G_C_Phone1 != null)
                $('#gphone').prop('readonly', true);

            $('#gmobile').val(parent_data.G_C_Phone3);
            //if (parent_data.G_C_Phone3 != null)
                $('#gmobile').prop('readonly', true);

            $('#gmail').val(parent_data.G_C_Email);
            //if (parent_data.G_C_Email != null)
                $('#gmail').prop('readonly', true);


            $('#goadd1').val(parent_data.G_O_address1);
           // if (parent_data.G_O_address1 != null)
                $('#goadd1').prop('readonly', true);

            $('#goadd2').val(parent_data.G_O_address2);
           // if (parent_data.G_O_address2 != null)
                $('#goadd2').prop('readonly', true);

            $('#goadd3').val(parent_data.G_O_address3);
            //if (parent_data.G_O_address3 != null)
                $('#goadd3').prop('readonly', true);

            $('#gozip').val(parent_data.G_O_ZIP_CODE);
            //if (parent_data.G_O_ZIP_CODE == 0 || parent_data.G_O_ZIP_CODE == null)
               // $('#gozip').prop('readonly', false);
           // else
                $('#gozip').prop('readonly', true);

            $('#gophone').val(parent_data.G_O_Phone1);
            //if (parent_data.G_O_Phone1 != null)
                $('#gophone').prop('readonly', true);

            $('#gomobile').val(parent_data.G_O_Phone1);
            //if (parent_data.G_O_Phone1 != null)
                $('#gomobile').prop('readonly', true);

            $('#gomail').val(parent_data.G_O_Email);
            //if (parent_data.G_O_Email != null)
                $('#gomail').prop('readonly', true);



            $('#gcadd1').val(parent_data.G_H_address1);
            //if (parent_data.G_H_address1 != null)
                $('#gcadd1').prop('readonly', true);

            $('#gcadd2').val(parent_data.G_H_address2);
           // if (parent_data.G_H_address2 != null)
                $('#gcadd2').prop('readonly', true);

            $('#gcadd3').val(parent_data.G_H_address3);
           // if (parent_data.G_H_address3 != null)
                $('#gcadd3').prop('readonly', true);


            $('#gczip').val(parent_data.G_H_ZIP_CODE);
           // if (parent_data.G_H_ZIP_CODE == 0 || parent_data.G_H_ZIP_CODE == null)
               // $('#gczip').prop('readonly', false);
            //else
                $('#gczip').prop('readonly', true);


            $('#gcphone').val(parent_data.G_H_Phone1);
            //if (parent_data.G_H_Phone1 != null)
                $('#gcphone').prop('readonly', true);


            $('#gcmobile').val(parent_data.G_H_Phone3);
            //if (parent_data.G_H_Phone3 != null)
                $('#gcmobile').prop('readonly', true);


            $('#gcmail').val(parent_data.G_H_Email);
           // if (parent_data.G_H_Email != null)
                $('#gcmail').prop('readonly', true);

            $('#is_parent_update').val('1');
            $('#curd-content').html('');
            $('.error').html('');
            $('.form-control').focusout();
            $('#staff_concession').hide();
            //}
        }
    }

    function close_parent_search() {
        $('#add_type').show();
        $("#curd-content").slideUp("slow", function() {
            $("#curd-content").hide();
        });

    }
</script>