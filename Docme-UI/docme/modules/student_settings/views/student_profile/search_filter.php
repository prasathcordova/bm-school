<div class="row clearfix" style="padding-bottom: 60px;" id="search_bar">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="card">

            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h4><?php echo isset($title) ? $title : "NO TITLE PROVIDED" ?>
                    </h4>
                    <div class="ibox-tools">

                        <span><a href="javascript:void(0);" onclick="close_search();"> <i style="font-size: 30px !important; float: right; color: #E91E63; margin-top: -32px !important;" class="material-icons" data-toggle="tooltip" data-placement="right" title="Close">close</i></a> </span>
                        <span><a href="javascript:void(0);" onclick="search_details('<?php echo $acd_year ?>');"> <i style="font-size: 30px !important; float: right; color: #24c6c8; margin-top: -32px !important; margin-right: 32px !important;" class="material-icons" data-toggle="tooltip" title="Search Students">search</i></a> </span>
                    </div>
                </div>
                <div class="ibox-content" style="text-align: left;">

                    <div class="clearfix">

                        <div class="row">
                            <div class="form-group col-lg-6 col-xs-12 col-md-12" style="margin-bottom: 5px;">
                                <div class="form-group">
                                    <label>Student Name :</label>
                                    <input id="studentname" placeholder="Search By Student Name" name="studentname" type="text" class="form-control input-sm ">
                                </div>
                            </div>
                            <div class="form-group col-lg-6 col-xs-12 col-md-12" style="margin-bottom: 5px;">
                                <div class="form-group">
                                    <label>Admission No. :</label>
                                    <input id="adminno" placeholder="Search By Admission No." name="adminno" type="text" class="form-control input-sm ">
                                </div>
                            </div>
                            <div class="form-group col-lg-6 col-xs-12 col-md-12" style="margin-bottom: 5px;">
                                <div class="form-group">
                                    <label>Parent Name :</label>
                                    <input id="parent_name" placeholder="Search By Parent Name" name="parent_name" type="text" class="form-control input-sm ">
                                </div>
                            </div>
                            <div class="form-group col-lg-6 col-xs-12 col-md-12" style="margin-bottom: 5px;">
                                <div class="form-group">
                                    <label>Mobile No :</label>
                                    <input id="mobileno" placeholder="Search By Mobile No" name="mobileno" type="text" class="form-control input-sm ">
                                </div>
                            </div>
                            <div class="form-group col-lg-6 col-xs-12 col-md-12" style="margin-bottom: 5px;">
                                <div class="form-group">
                                    <label>Email :</label>
                                    <input id="email" placeholder="Search By Email " name="email" type="text" class="form-control input-sm ">
                                </div>
                            </div>
                            <div class="form-group col-lg-6 col-xs-12 col-md-12" style="margin-bottom: 5px;">
                                <label>Class :</label>
                                <select class="select2_registration form-control" id="class_id" name="class_id">
                                    <option value="-1" selected="">select
                                    <option>
                                        <?php
                                        if (isset($class_data) && !empty($class_data)) {
                                            foreach ($class_data as $class) {

                                                echo '<option value="' . $class['Course_Det_ID'] . '" data-masterid="' . $class['Course_Master_ID'] . '"  >' . $class['Description'] . '</option>';
                                            }
                                        }
                                        ?>
                                </select>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
<script>
    $("#class_id").select2({
        "theme": "bootstrap",
        "width": "100%"
    });

    function close_search() {
        $("#search_bar").slideUp();
        $('#search_filter_btn').show();
    }

    function search_details(acd_year) {
        $("#hiddenbutton").show();
        var studentname = $("#studentname").val();
        var adminno = $("#adminno").val();
        var parent_name = $("#parent_name").val();
        var mobileno = $("#mobileno").val();
        var email = $("#email").val();
        var class_id = $("#class_id").val();

        if (class_id == -1) {
            var class_id = '';
        }


        var ops_url = baseurl + 'profile/show-filter';
        $.ajax({
            type: "POST",
            cache: false,
            async: false,
            url: ops_url,
            data: {
                "studentname": studentname,
                "adminno": adminno,
                "parent_name": parent_name,
                "mobileno": mobileno,
                "email": email,
                "class_id": class_id,
                "acd_year": acd_year
            },
            success: function(result) {
                var data = JSON.parse(result)
                if (data.status == 1) {
                    $('#student-search-filter').html('');
                    $('#student-search-filter').html(data.view);
                    var animation = "fadeInDown";
                    $("#student-search-filter").show();
                    $('#student-search-filter').addClass('animated');
                    $('#student-search-filter').addClass(animation);
                    $('#add_type').hide();
                } else {
                    alert('No data loaded');
                }
            }
        });
    }
</script>