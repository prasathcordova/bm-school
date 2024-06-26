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
                    <div class="ibox-content " id="faculty_loader">
                        <div class="sk-spinner sk-spinner-wave">
                            <div class="sk-rect1"></div>
                            <div class="sk-rect2"></div>
                            <div class="sk-rect3"></div>
                            <div class="sk-rect4"></div>
                            <div class="sk-rect5"></div>
                        </div>
                        <div class="row student_search_result">
                            <div class="col-lg-12">
                                <div id="curd-content" style="display: none;"></div>
                            </div>
                            <div class="wrapper wrapper-content animated fadeInRight" style="margin-left:15px;">

                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

                                    <div class="form-group">
                                        <div class="form-line">
                                            <!--                                                add autofocus attribute by vinoth @28-05-2019 17:06-->
                                            <div class="input-group"><input type="text" id="search_with_name_or_admission" name="search_with_name_or_admission" placeholder="Search student by Admission Number/Name" class="form-control" autofocus="">
                                                <span class="input-group-btn">
                                                    <button class="btn btn-sm btn-primary" onclick="search_with_name_or_admission()" title="Search"><i style="font-size:17px;" class="material-icons">search</i></button>
                                                    <!-- <button type="button" id="search_name_btn" title="Search" class="btn btn-primary btn-sm" onclick="search_name();"><i class="fa fa-search"></i> </button> -->
                                                </span>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                                <!-- <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <div class="input-group">
                                                    <input type="text" id="searchname" name="searchname" maxlength="10" placeholder="Search by Admission Number" class="form-control admnNumberCheck" autofocus="">
                                                    <span class="input-group-btn">
                                                        <button class="btn btn-sm btn-primary" onclick="search_admn_no()" title="Search"><i style="font-size:17px;" class="material-icons">search</i></button>
                                                    </span>
                                                    <!- <span class="input-group-btn">
                                                        <button type="button" id="search_name_btn" class="btn btn-primary btn-sm" onclick="search_admn_no();" title="Search"><i class="fa fa-search"></i> </button>
                                                    </span> ->
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                                        <div class="input-group">
                                            <input type="text" id="search_name" name="search_name" placeholder="Search by Student Name" maxlength="50" class="form-control">
                                            <span class="input-group-btn">
                                                <button class="btn btn-sm btn-primary" onclick="searchbyname()" title="Search"><i style="font-size:17px;" class="material-icons">search</i></button>
                                            </span>
                                            <!- <span class="input-group-btn">
                                                <button type="button" id="search_name_btn" class="btn btn-info btn-sm" onclick="searchbyname();" title="Search"><i class="fa fa-search"></i> </button>
                                            </span> ->
                                        </div>
                                    </div>
                                </div> -->

                                <div class="clearfix"></div>
                                <?php
                                if (isset($class_data) && !empty($class_data) && is_array($class_data)) {
                                    $breaker = 0;
                                    foreach ($class_data as $class) {
                                        //                                        dev_export($class);die;
                                ?>
                                        <div class="col-lg-3">
                                            <div class="contact-box center-version">
                                                <!--<span class="label label-warning pull-right">Official</span>-->
                                                <a href="javascript:void(0);">

                                                    <h4 class="m-b-xs"><strong><?php echo $class['Description']; ?></strong></h4>
                                                    <input type='hidden' id='classid' name='classid' value="<?php echo $class['Course_Det_ID'] ?>">
                                                </a>
                                                <div class="col-lg-12 col-xs-12 col-md-12">
                                                    <div class="form-group">
                                                        <label class="control-label" for="customer">Academic Year :</label>
                                                        <select class="select2_acdyear form-control input-sm " onchange="load_stud_batch(<?php echo $class['Course_Det_ID'] ?>);" style="width:100%" name="acdyear" id="acdyear_<?php echo $class['Course_Det_ID']; ?>">
                                                            <option value="-1" selected>Select</option>
                                                            <?php
                                                            if (isset($acdyear_data) && !empty($acdyear_data)) {
                                                                foreach ($acdyear_data as $acdyear) {
                                                                    if (isset($acdyear['Acd_ID']) && !empty($acdyear['Acd_ID'])) {
                                                                        if ($this->session->userdata('acd_year') == $acdyear['Acd_ID']) {
                                                                            echo '<option selected value="' . $acdyear['Acd_ID'] . '">' . $acdyear['Description'] . '</option>';
                                                                        } else {
                                                                            echo '<option value ="' . $acdyear['Acd_ID'] . '" >' . $acdyear['Description'] . '</option>';
                                                                        }
                                                                    }
                                                                }
                                                            }
                                                            ?>
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="col-lg-12 col-xs-12 col-md-12">
                                                    <div class="form-group">
                                                        <label class="control-label" for="customer">Batch :</label>
                                                        <select class="select2_batch_data form-control" id="batch_<?php echo $class['Course_Det_ID']; ?>">
                                                            <option selected value="-1">Select</option>
                                                            <?php
                                                            if (isset($batch_data) && !empty($batch_data)) {

                                                                foreach ($batch_data as $value) {
                                                                    //                                                                        dev_export($value);
                                                                    if ($value['Class_Det_ID'] == $class['Course_Det_ID']) {
                                                                        echo '<option value ="' . $value['BatchID'] . '" >' . $value['Batch_Name'] . '</option>';
                                                                    }
                                                                }
                                                            }
                                                            ?>

                                                        </select>
                                                    </div>
                                                </div>

                                                <table class="table table-hover">
                                                    <tbody>
                                                        <tr>
                                                            <td class="text-center">
                                                                <div class="m-t-xs btn-group" style="text-align:center">
                                                                    <a href="javascript:void(0);" onclick="load_students_after_filter(<?php echo $class['Course_Det_ID']; ?>);" class="btn btn-xs btn-info" title="SELECT">SELECT</a>
                                                                </div>
                                                            </td>
                                                        </tr>


                                                    </tbody>
                                                </table>


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


<script type="text/javascript">
    $('#searchname').on("keypress", function(e) {
        if (e.keyCode == 13) {
            if ($('#searchname').val().trim().length < 3) {
                swal('', 'Enter atleast three characters', 'info');
                return false;
            } else {
                search_admn_no();
                //		search_name();
            }
        }
        if (/[0-9]+$/.test(e.key)) {
            return true;
        } else {
            return false;
        }
    });
    $('#search_name').on("keypress", function(e) {
        if (e.keyCode == 13) {
            if ($('#search_name').val().trim().length < 3) {
                swal('', 'Enter atleast three characters', 'info');
                return false;
            } else {
                searchbyname();
            }
        }
        if (/[a-zA-Z\s]+$/.test(e.key)) {
            return true;
        } else {
            return false;
        }
    });


    $('#search_with_name_or_admission').on("keypress", function(e) {
        if (e.keyCode == 13) {
            if ($('#search_with_name_or_admission').val().trim().length < 3) {
                swal('', 'Enter atleast three characters.', 'info');
                return false;
            } else {
                search_with_name_or_admission();
            }
        }
    });


    function search_admn_no() { //search_name()
        $("#close_button").show();
        var searchname = $('#searchname').val();
        if (searchname.trim().length < 3) {
            swal('', 'Enter atleast three characters.', 'info');
            return false;
        }
        if (!/[0-9a-zA-Z/]+$/.test(searchname)) {
            swal('', 'Numbers, alphabets and slash(/) only allowed', 'info');
            return false;
        }
        var ops_url = baseurl + 'profile/search-admission-no';
        $.ajax({
            type: "POST",
            cache: false,
            async: false,
            url: ops_url,
            data: {
                "load": 1,
                "searchdata": searchname
            },
            success: function(result) {
                var data = JSON.parse(result)
                if (data.status == 1) {
                    $('#content').html('');
                    $('#content').html(data.view);

                } else {
                    if (data.message) {
                        swal('', data.message, 'info');
                        $('#searchname').val('');
                        return false;
                    } else {
                        swal('', 'No data available', 'info');
                        $('#searchname').val('');
                        return false;
                    }
                }
            }
        });
    }

    //create function by vinoth @ 30-05-2019 11:46
    function searchbyname() {
        $("#close_button").show();
        var searchname = $('#search_name').val();
        if (searchname.trim().length < 3) {
            swal('', 'Enter atleast three characters.', 'info');
            return false;
        }
        var ops_url = baseurl + 'profile/search-name';
        $.ajax({
            type: "POST",
            cache: false,
            async: false,
            url: ops_url,
            data: {
                "load": 1,
                "searchdata": searchname
            },
            success: function(result) {
                var data = JSON.parse(result)
                if (data.status == 1) {
                    $('#content').html('');
                    $('#content').html(data.view);

                } else {
                    if (data.message) {
                        swal('', data.message, 'info');
                        $('#search_name').val('');
                        return false;
                    } else {
                        swal('', 'No data available', 'info');
                        $('#search_name').val('');
                        return false;
                    }
                }
            }
        });
    }


    function search_with_name_or_admission() {
        var searchname = $('#search_with_name_or_admission').val();
        if (searchname.trim().length < 3) {
            swal('', 'Enter atleast three characters.', 'info');
            return false;
        }

        // if (!/[a-zA-Z\s]+$/.test(searchname)) {
        //     swal('', 'Alphabets only allowed', 'info');
        //     return false;
        // }
        var ops_url = baseurl + 'profile/search_with_name_or_admission';
        $.ajax({
            type: "POST",
            cache: false,
            //async: false,
            url: ops_url,
            data: {
                "load": 1,
                "searchname": searchname
            },
            success: function(result) {
                var data = JSON.parse(result)
                if (data.status == 1) {
                    $('.student_search_result').html('');
                    $('.student_search_result').html('<div class="col-lg-12">' + data.view + '</div>');

                } else {
                    if (data.message) {
                        swal('', data.message, 'info');
                        $('#search_name').val('');
                        return false;
                    } else {
                        swal('', 'No data available', 'info');
                        $('#search_name').val('');
                        return false;
                    }
                }
            }
        });
    }


    function load_stud_batch(courseid) {
        var acdid = '#acdyear_' + courseid;
        var batchid = '#batch_' + courseid;
        var acdyear_id = $(acdid).val();

        var ops_url = baseurl + 'profile/get-batch-by-acdyear';
        $.ajax({
            type: "POST",
            cache: false,
            async: false,
            url: ops_url,
            data: {
                "load": 1,
                "courseid": courseid,
                "acdyear_id": acdyear_id
            },
            success: function(result) {
                $(batchid).empty().trigger("change");
                var data = JSON.parse(result);
                if (data.status == 1) {
                    var batch_data = data.data;
                    $(batchid).append("<option value='-1' >Select</option>");
                    $.each(batch_data, function(i, v) {
                        $(batchid).append("<option value='" + v.BatchID + "' >" + v.Batch_Name + "</option>");
                    });
                    $(batchid).trigger('change');
                } else {
                    $(batchid).empty().trigger("change");
                    $(batchid).append("<option value='-1' >Select</option>");
                    $(batchid).trigger('change');
                }
            }
        });
    }

    function load_students_after_filter(courseid) {

        var acdid = '#acdyear_' + courseid;
        var batchid = '#batch_' + courseid;
        //        var batchname = $(batchid).find('option:selected').text();
        var acdyear = $(acdid).val();
        var batch_id = $(batchid).val();
        //write if condition by vinoth @ 28-05-2019 13:52
        if (batch_id === '-1') {
            swal('', 'Select a Batch.', 'info');
            return false;
        }

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
                //                console.log(data);
                if (data.status == 1) {
                    $('#content').html('');
                    $('#content').html(data.view);
                } else {

                }
            },
            error: function() {}
        });
    }

    function load_students_after_filter_on_breadcrumb(batch_id, acdyear, courseid) {

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
                //                console.log(data);
                if (data.status == 1) {
                    $('#content').html('');
                    $('#content').html(data.view);
                } else {

                }
            },
            error: function() {}
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
    $(document).ready(function() {

        //        $('.select2_acdyear').trigger('change');

    });
</script>