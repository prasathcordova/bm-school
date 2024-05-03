<div class="row clearfix" style="padding-bottom: 60px;">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="card">
            <div class="header">
                <h2 style="padding-bottom: 10px;font-size: 16px;"><?php echo isset($title) ? $title : "NO TITLE PROVIDED" ?>
                    <span><a href="javascript:void(0);" onclick="uniform_close_advance_search();"> <i style="font-size: 30px !important; float: right; color: #E91E63;" class="material-icons" data-toggle="tooltip" title="Close">close</i></a> </span>
                    <!--<span><a href="javascript:void(0);"  onclick="submit_data();" > <i style="font-size: 30px !important; float: right; color: #23C6C5; padding-right: 10px;" class="material-icons" data-toggle="tooltip" title="Save">save</i></a> </span>-->
                    <span><a href="javascript:void(0);" onclick="uniform_emp_search_data();"> <i style="font-size: 30px !important; float: right; color: #23C6C5; padding-right: 10px;" class="fa fa-search" data-toggle="tooltip" title="Search"></i></a> </span>

                    <span><a href="javascript:void(0);" onclick="uniform_refresh_add_panel();"> <i style="font-size: 30px !important; float: right; color: #2196F3; padding-right: 10px;" class="material-icons " data-toggle="tooltip" title="Refresh">refresh</i></a> </span>
                </h2>
            </div>
            <div class="body">
                <div class="col-lg-12">
                    <div class="ibox float-e-margins">
                        <div class="ibox-content">

                            <div class="input-group">
                                <input type="text" id="searchname" name="searchname" placeholder="Search Staff by name..." class=" form-control">
                                <span class="input-group-btn">
                                    <button type="button" class="btn btn-info" onclick="uniform_search_name();"> Search</button>

                                </span>
                            </div>
                            <div class="row">
                                <input type="hidden" name="batchid" id="batchid" value="<?php //echo isset($batchid) && !empty($batchid) ? $batchid : ''; 
                                                                                        ?>" />

                                <!--                            <div class="col-lg-12">
                                                            <div id="curd-content" style="display: none;"></div>
                                                        </div>-->
                                <div class="clearfix"></div>
                                <div class="wrapper wrapper-content animated fadeInRight" id="student-data-container">
                                    <div class="row">
                                        <?php
                                        if (isset($user_data) && !empty($user_data) && is_array($user_data)) {
                                            $breaker = 0;
                                            foreach ($user_data as $staff) {
                                                ?>
                                                <div class="col-lg-3">
                                                    <div class="contact-box center-version">
                                                        <a href="javascript:void(0);">
                                                            <?php
                                                            $profile_image = "";
                                                            if (isset($staff['profile_image']) && !empty($staff['profile_image'])) {

                                                                $profile_image = "data:image/jpeg;base64," . $staff['profile_image'];
                                                            } else {
                                                                if (isset($staff['profile_image_alternate']) && !empty($staff['profile_image_alternate'])) {
                                                                    $profile_image = $staff['profile_image_alternate'];
                                                                } else {
                                                                    $profile_image = base_url('assets/img/a0.jpg');
                                                                }
                                                            }
                                                            ?>
                                                            <img alt="image" class="img-circle" src="<?php echo $profile_image; ?>">
                                                            <h3 class="m-b-xs pro-name"><strong><?php echo $staff['Emp_Name'] ?></strong></h3>

                                                            <div class="font-bold" style="height:24px;">Designation:<?php echo $staff['Designation'] ?></div>

                                                        </a>
                                                        <table class="table table-hover" style="margin-bottom: 0;">
                                                            <tbody>
                                                                <tr>
                                                                    <td class="project-status">
                                                                        <span class="label label-primary"><?php echo $staff['DepName']; ?></span>
                                                                    </td>
                                                                </tr>

                                                            </tbody>
                                                        </table>
                                                        <div class="contact-box-footer" style="padding: 5px 5px;">
                                                            <div class="m-t-xs btn-group">
                                                                <a href="javascript:void(0);" onclick="uniform_specimen_delivery('<?php //echo $staff['Emp_id']; 
                                                                                                                                    ?>')" class="btn btn-xs btn-white"><i class="fa fa-user-plus"></i>Specimen Delivery</a>
                                                                <!--<a href="javascript:void(0);" onclick="other_bill('<?php //echo $staff['Emp_id']; 
                                                                                                                        ?>')" class="btn btn-xs btn-white"><i class="fa fa-user-plus"></i>Other Billing</a>-->
                                                                <!--<a href="javascript:void(0);" onclick="send_personal_email('<?php //echo $staff['Emp_id']; 
                                                                                                                                ?>', '<?php // echo $acdyr_id; 
                                                                                                                                                                        ?>', '<?php // echo $batch_id; 
                                                                                                                                                                                                    ?>')" class="btn btn-xs btn-white "><i class="fa fa-billing"></i>Other Billing</a>-->
                                                                <!--<a href="javascript:void(0);" onclick="fees_detail('<?php //echo $staff['Emp_id']; 
                                                                                                                        ?>')" class="btn btn-xs btn-white"><i class="fa fa-user-plus"></i> Fee Details</a>-->
                                                            </div>
                                                        </div>

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
<script type="text/javascript">
    function uniform_emp_search_data() {
        var ops_url = baseurl + 'uniform/delivery/search-emp-data';
        $.ajax({
            type: "POST",
            cache: false,
            async: false,
            url: ops_url,
            data: {
                "load": 1
            },
            success: function(data) {
                if (data) {
                    $('#curd-content').html(data);


                    var animation = "fadeInDown";
                    $("#curd-content").show();
                    $('#curd-content').addClass('animated');
                    $('#curd-content').addClass(animation);
                    $('#add_type').hide();
                    $('#currency_select').select2({
                        'theme': 'bootstrap'
                    });
                } else {
                    alert('No data loaded');
                }
            }
        });
    }

    function uniform_specimen_delivery(Emp_id) {
        //        var batchid = $('#batchid').val();
        var ops_url = baseurl + 'uniform/substore/specimen-delivery/';
        $.ajax({
            type: "POST",
            cache: false,
            async: false,
            url: ops_url,
            data: {
                "load": 1,
                "Empid": Emp_id
            },
            success: function(data) {
                $('#data-view').html(data);
                //                $('#profile-detail-content').html('');
                //                $('#profile-detail-content').html('');
                //                $('#profile-detail-content').html(data);
                //                $('html, body').animate({
                //                    scrollTop: $("#profile-detail-content").offset().top
                //                }, 1000);
            }
        });
    }