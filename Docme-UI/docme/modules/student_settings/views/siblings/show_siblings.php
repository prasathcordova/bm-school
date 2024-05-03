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
            ?>
        </ol>
    </div>
</div>

<div id="student-profile-content">
    <div class="wrapper wrapper-content animated fadeInRight" style="padding-top: 1px !important;padding-left: 0px !important;padding-right: 0px !important;">
        <div class="row" style="margin-left: -29px !important; margin-right: -30px !important;">
            <div class="col-lg-12">
                <div class="ibox float-e-margins">
                    <div class="ibox-content" id="faculty_loader">
                        <div class="sk-spinner sk-spinner-wave">
                            <div class="sk-rect1"></div>
                            <div class="sk-rect2"></div>
                            <div class="sk-rect3"></div>
                            <div class="sk-rect4"></div>
                            <div class="sk-rect5"></div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12">
                                <div id="curd-content" style="display: none;"></div>
                            </div>
                            <div class="wrapper wrapper-content animated fadeInRight" style="margin-left:15px;">
                                <div class="row" id="batchallocate">
                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                        <div class="form-group">
                                            <b>Admission No. / Student Name</b>
                                            <div class="form-line">
                                                <div class="input-group">
                                                    <input type="text" id="search_admno" name="search_admno" placeholder="Enter Admission Number / Student Name" class="form-control" maxlength="10" value="<?php echo (isset($searchdata) ? $searchdata : '') ?>">
                                                    <span class="input-group-btn">
                                                        <button class="btn btn-sm btn-primary" onclick="search_siblings_name()" title="Search"><i style="font-size:17px;" class="material-icons">search</i></button>
                                                    </span>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                        <div class="form-group">
                                            <b>Student Name</b>
                                            <div class="form-line">
                                                <div class="input-group"><input type="text" id="search_name" name="search_name" placeholder="Enter Student Name" class="form-control" maxlength="10"> <span class="input-group-btn">
                                                        <button type="button" id="search_st_name_btn" class="btn btn-primary btn-sm" title="Search" onclick="search_siblings_name();"><i class="fa fa-search"></i> </button> </span>
                                                </div>
                                            </div>
                                        </div>
                                    </div> -->
                                    <div class="clearfix"></div>
                                    <div class="wrapper wrapper-content animated fadeInRight" id="student-data-container">
                                        <div class="row">
                                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                <?php
                                                if (isset($sibilings_data) && !empty($sibilings_data) && is_array($sibilings_data)) {
                                                    $breaker = 0;
                                                    foreach ($sibilings_data as $sibilings) {
                                                ?>
                                                        <div class="col-lg-3">
                                                            <div class="contact-box center-version">
                                                                <a href="javascript:void(0);" style="padding:5px !important;">
                                                                    <?php
                                                                    $profile_image = "";
                                                                    if (!empty(get_student_image($sibilings['student_id']))) {
                                                                        $profile_image = get_student_image($sibilings['student_id']);
                                                                    } else if (isset($sibilings['profile_image']) && !empty($sibilings['profile_image'])) {

                                                                        $profile_image = "data:image/jpeg;base64," . $sibilings['profile_image'];
                                                                    } else {
                                                                        if (isset($sibilings['profile_image_alternate']) && !empty($sibilings['profile_image_alternate'])) {
                                                                            $profile_image = $sibilings['profile_image_alternate'];
                                                                        } else {
                                                                            $profile_image = base_url('assets/img/a0.jpg');
                                                                        }
                                                                    }
                                                                    ?>
                                                                    <img alt="image" class="img-circle" src="<?php echo $profile_image; ?>">
                                                                    <h3 class="m-b-xs pro-name" style="overflow:hidden;height: 48px;"><strong><?php echo $sibilings['student_name'] ?></strong></h3>
                                                                    <!--                                                        write by vinoth 14-may-19 15:08 (start) <?php echo isset($title) ? $title : "NO TITLE PROVIDED" ?> -->
                                                                    <div>
                                                                        <p>Class :
                                                                            <?php echo isset($sibilings['Description']) && !empty($sibilings['Description']) ? $sibilings['Description'] : 'NIL'; ?>
                                                                        </p>
                                                                        <p>Batch :
                                                                            <?php echo isset($sibilings['Batch_Name']) && !empty($sibilings['Batch_Name']) ? $sibilings['Batch_Name'] : 'Un Assigned'; ?>
                                                                        </p>
                                                                        <p>Priority :
                                                                            <?php echo isset($sibilings['stud_priority']) && !empty($sibilings['stud_priority']) ? $sibilings['stud_priority'] : '0'; ?>
                                                                        </p>

                                                                        <!-- <p>
                                                                            <span class="label" style="background-color:#999;color:#fff;"></span>
                                                                        </p> -->
                                                                    </div>


                                                                </a>
                                                                <div class="font-bold" style="text-align: center;padding-bottom: 15px;">Admission No.: <?php echo $sibilings['Admn_No'] ?></div>
                                                                <table class="table" style="margin-bottom:0px;">
                                                                    <tbody>
                                                                        <tr>
                                                                            <td class="project-status">
                                                                                <span class="label" style="background-color:#999;color:#fff;"><?php echo $sibilings['stud_status']; ?></span>
                                                                            </td>

                                                                        </tr>
                                                                    </tbody>
                                                                </table>
                                                                <div class="contact-box-footer">
                                                                    <div class="m-t-xs btn-group">
                                                                        <?php if ($flag == 0) {
                                                                            if (check_permission(504, 1098, 102)) { ?>
                                                                                <a href="javascript:void(0);" title="Show Siblings of <?php echo $sibilings['student_name'] ?> " onclick="search_siblings_admno('<?php echo $sibilings['Admn_No']; ?>')" class="btn btn-md btn-info"><i class="fa fa-user-plus"></i> View Siblings</a>
                                                                        <?php }
                                                                        } ?>
                                                                    </div>
                                                                </div>
                                                                <!--                                                    <table class="table" style="margin-bottom:0px;">
                                                        <tbody>
                                                            <tr>
                                                                <td class="project-status">
                                                                    
                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                    </table>-->
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
            </div>
        </div>
    </div>
</div>


<script type="text/javascript">
    $('#search_admno').focus();
    $('#search_admno').on("keypress", function(e) {
        if (e.keyCode == 13) {
            if ($('#search_admno').val().trim().length < 3) {
                swal('', 'Enter atleast three characters.', 'info');
                return false;
            } else {
                search_siblings_name();
            }
        }
        if (/[0-9a-zA-Z/]+$/.test(e.key)) {
            return true;
        } else {
            return false;
        }
    });

    function search_siblings_admno(search_admno) {
        var ops_url = baseurl + 'profile/search-siblings-admission-no';
        $.ajax({
            type: "POST",
            cache: false,
            async: false,
            url: ops_url,
            data: {
                "load": 1,
                "searchdata": search_admno,
                "searchby": 'byadmno',
                "flag": 1
            },
            success: function(result) {
                var data = JSON.parse(result);
                if (data.status == 1) {
                    $('#content').html('');
                    $('#content').html(data.view);
                    return true;
                } else {
                    swal('', 'No data available', 'info');
                    return false;

                }
            }
        });
    }

    function search_siblings_name() {
        $("#close_button").show();
        var search_name = $('#search_admno').val();

        if (search_name.trim().length < 3) {
            swal('', 'Enter atleast three characters.', 'info');
            return false;
        }
        if (!/[0-9a-zA-Z/]+$/.test(search_name)) {
            swal('', 'Numbers, alphabets and slash(/) only allowed', 'info');
            return false;
        }
        var ops_url = baseurl + 'profile/search-siblings-admission-no';
        $.ajax({
            type: "POST",
            cache: false,
            async: false,
            url: ops_url,
            data: {
                "load": 1,
                "searchdata": search_name,
                "searchby": 'search_current_student',
                "flag": 0
            },
            success: function(result) {
                var data = JSON.parse(result);
                if (data.status == 1) {
                    $('#content').html('');
                    $('#content').html(data.view);
                    return true;
                } else {
                    swal('', 'No data available', 'info');
                    return false;

                }
            }
        });
    }




    $(".select2_acdyear").select2({
        placeholder: "Select a Batch",
        "theme": "bootstrap",
        "width": "100%"
    });
    $(".select2_batch_data").select2({
        placeholder: "Select a Batch",
        "theme": "bootstrap",
        "width": "100%"
    });
</script>