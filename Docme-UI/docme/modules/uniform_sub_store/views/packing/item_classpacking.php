<script src="<?php echo base_url('assets/theme/js/plugins/iCheck/icheck.min.js'); ?>"></script>
<script src="<?php echo base_url('assets/theme/js/plugins/dataTables/datatables.min.js'); ?>"></script>


<div class="wrapper wrapper-content animated fadeInRight" style="padding-top: 1px !important;padding-left: 0px !important;padding-right: 0px !important;">
    <div class="row" style="margin-left: -29px !important; margin-right: -30px !important;">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5><?php echo $sub_title ?></h5>
                    <div class="ibox-tools" id="add_type">
                    </div>
                </div>
                <div class="ibox-content">
                    <div class="input-group" style="margin-bottom:26px">
                        <input type="text" id="searchname" name="searchname" placeholder="Search by student name / Admin no ..." class=" form-control">
                        <span class="input-group-btn">
                            <button type="button" id="search_name_btn" class="btn btn-info" onclick="uniform_search_name('<?php echo $this->session->userdata('acd_year'); ?>');"> Search</button>
                            <button type="button" class="btn btn-info" onclick="uniform_load_classpacking();"> Class</button>

                        </span>
                    </div>

                    <div id="content-search">

                        <div class="col-lg-6 col-xs-12 col-md-12 " style="display:none;">
                            <label for="male">Academic Year</label>
                            <div class="form-group ">
                                <select class="select2_demo_3 form-control " id="acd_year">
                                    <?php
                                    if (isset($acdyr_data) && !empty($acdyr_data)) {
                                        foreach ($acdyr_data as $acd) {
                                            if ($acd['Acd_ID'] == $this->session->userdata('acd_year')) {
                                                echo '<option selected value="' . $acd['Acd_ID'] . '">' . $acd['Description'] . "</option>";
                                            } else {
                                                echo '<option value="' . $acd['Acd_ID'] . '">' . $acd['Description'] . "</option>";
                                            }
                                        }
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class=" animated fadeInRight">
                            <div class="row scroll_content" style="margin-right:0px;">

                                <?php
                                if (isset($batch_data) && !empty($batch_data)) {
                                    $iflag = 0;
                                    foreach ($batch_data as $batch) {
                                ?>
                                        <div class="col-lg-4 col-md-12 col-sm-12">
                                            <div class="panel panel-info" style="padding-top: 1px;">
                                                <div class="panel-heading" style="height : 36px !important">
                                                    <h5 style="color:#fff"><?php echo $batch['class_details']['description'] ?></h5>
                                                </div>
                                                <div class="panel-body">
                                                    <div class="col-lg-12">
                                                        <div class="form-group">
                                                            <label class="control-label" for="customer">Batch :</label>
                                                            <select class="select2_batch_data form-control" id="batchid_<?php echo $batch['class_details']['class_id']; ?>">
                                                                <option selected value="-1">Select</option>
                                                                <?php
                                                                if (isset($batch['batch_details']) && !empty($batch['batch_details'])) {
                                                                ?>
                                                                    <!--<input type="hidden" id="batchidd" value="<?php // echo $batchlist['batchid'];                                 
                                                                                                                    ?>">-->
                                                                <?php
                                                                    $batch_details_for_loop = $batch['batch_details'];
                                                                    $batch_count = 0;
                                                                    $student_count = 0;
                                                                    foreach ($batch_details_for_loop as $batchlist) {
                                                                        echo '<option value ="' . $batchlist['batchid'] . '" >' . $batchlist['batch_name'] . '</option>';

                                                                        $batch_count++;
                                                                        $student_count = $student_count + $batchlist['packing_std_count'];
                                                                    }
                                                                }
                                                                ?>

                                                            </select>
                                                        </div>
                                                    </div>

                                                    <span class="label label-danger pull-left">Batch : <?php echo $batch_count; ?></span>
                                                    <span class="label label-success pull-right">Students : <?php echo $student_count; ?></span>
                                                </div>
                                                <div class="panel-footer" style="background-color : white;text-align: center;">
                                                    <a href="javascript:void(0);" onclick="uniform_load_students_after_filter('<?php echo $batch['class_details']['class_id']; ?>')" data-toggle="tooltip" title="List of students"><span class="label label-warning-light">Select <i class="fa fa-long-arrow-right"></i></span></a>
                                                </div>
                                            </div>
                                        </div>

                                <?php
                                        if ($iflag == 2) {
                                            echo '<div class="clearfix"></div>';
                                            $iflag = 0;
                                        } else {
                                            ++$iflag;
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



<style>
    .select2-container--bootstrap .select2-selection--single {
        line-height: 1;
        padding: 9px 15px;
    }

    .btn-info.btn-outline {
        color: #fff !important;
    }

    .fr {
        float: right;
    }

    .fl {
        float: left;
    }

    .list-item {
        border-radius: 6px;
        background: #74ddde;
        padding: 12px 5px !important;
        line-height: 25px;
    }

    .panel-info {
        display: inline-block;
        width: 100%;
    }
</style>

<script type="text/javascript">
    var input = document.getElementById("searchname");
    input.addEventListener("keyup", function(event) {
        event.preventDefault();
        if (event.keyCode === 13) {
            document.getElementById("search_name_btn").click();
        }
    });



    $(document).ready(function() {
        // Add slimscroll to element
        $('.scrollerdata').slimscroll({
            height: '100px'
        })
        $(".select2_batch_data").select2({
            "theme": "bootstrap",
            "width": "100%",
        });
    });

    function uniform_batch_list1(class_id) {
        var ops_url = baseurl + 'uniform/substore/class_batch_list/';
        $.ajax({
            type: "POST",
            cache: false,
            async: false,
            url: ops_url,
            data: {
                "load": 1
            },
            success: function(result) {
                $('#data-view').html(result);
            }
        });
    }

    function uniform_batch_list(class_id) {
        var ops_url = baseurl + 'uniform/substore/class_item_list/';
        $.ajax({
            type: "POST",
            cache: false,
            async: false,
            url: ops_url,
            data: {
                "load": 1,
                "classid": class_id
            },
            success: function(data) {
                $('#data-view').html(data);
            }
        });
    }


    function uniform_load_students_after_filter(class_id, acd_yr = 0) {

        if (acd_yr == 0) {
            acd_yr = $('#acd_year').val()
        }

        var batch_id = '#batchid_' + class_id;
        var batchid = $(batch_id).val();
        if (batchid == -1) {
            swal('', 'Select a batch', 'info');
            return false;
        }

        var ops_url = baseurl + 'uniform/sale/students_batch';
        $.ajax({
            type: "POST",
            cache: false,
            async: false,
            url: ops_url,
            data: {
                "load": 1,
                "batchid": batchid,
                "acd_year": acd_yr
            },
            success: function(result) {
                var data = JSON.parse(result);
                console.log(data);
                if (data.status == 1) {
                    $('#data-view').html('');
                    $('#data-view').html(data.view);
                    $('html, body').stop().animate({
                        scrollTop: $($('.ibox-content')).offset().top - 55
                    }, 500);
                } else {

                }
            },
            error: function() {}
        });
    }



    function uniform_search_name(acdyr_id) {
        var searchname = $('#searchname').val();
        if (searchname.length < 3) {
            swal('', 'Enter Student name or Admission No. (Atleast 3 letters) !', 'info');
            return false;
        }
        var ops_url = baseurl + 'uniform/substore/search-name';
        $.ajax({
            type: "POST",
            cache: false,
            async: false,
            url: ops_url,
            data: {
                "load": 1,
                "acdyr_id": acdyr_id,
                "searchname": searchname
            },
            success: function(result) {
                var data = JSON.parse(result)
                if (data.status == 1) {
                    $('#content-search').html('');
                    $('#content-search').html(data.view);
                    var animation = "fadeInDown";
                    $("#content-search").show();
                    $('#content-search').addClass('animated');
                    $('#content-search').addClass(animation);
                    $('#add_type').hide();
                    $('html, body').stop().animate({
                        scrollTop: $($('.ibox-content')).offset().top - 55
                    }, 500);
                } else {
                    alert('No data loaded');
                }
            }
        });
    }
</script>