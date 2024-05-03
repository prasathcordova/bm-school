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

<div class="wrapper wrapper-content">
    <div class="row">
        <div class="col-lg-3">
            <div class="ibox float-e-margins">
                <div class="ibox-content mailbox-content">
                    <div class="file-manager">
                        <div class="btn btn-block btn-primary compose-mail cur-rm">Course Management</div>
                        <div class="space-25"></div>
                        <?php if (check_permission(517, 1130, 101) || check_permission(517, 1131, 101)) { ?>
                            <h5>Batch Management</h5>
                            <ul class="category-list" style="padding: 0">
                                <?php if (check_permission(517, 1130, 101)) { ?>
                                    <li><a href="javascript:void(0);" onclick="load_batch();"> <i class="fa fa-circle text-primary"></i> Batch Settings<span class="label label-warning pull-right"><?php echo $active_data[0]['batch_count']; ?></span> </a></li>
                                <?php } ?>
                                <?php if (check_permission(517, 1131, 101)) { ?>
                                    <li><a href="javascript:void(0);" onclick="load_batchallocate();"> <i class="fa fa-circle text-info"></i> Batch Allocation - Group
                                            <!--<span class="label label-warning pull-right">16</span>-->
                                        </a></li>
                                <?php } ?>
                                <!--<li><a href="<?php // echo base_url('course/batch-allocate');      
                                                    ?>"> <i class="fa fa-circle text-warning"></i> District-->
                            </ul>
                        <?php }
                        if (check_permission(517, 1132, 101)) { ?>
                            <h5>Course Management</h5>
                            <ul class="category-list" style="padding: 0">
                                <!--<li><a href="javascript:void(0);" onclick="load_course();"> <i class="fa fa-circle text-navy"></i> Course <span class="label label-warning pull-right"><?php echo $active_data[0]['course_count']; ?></span> </a></li>-->
                                <li><a href="javascript:void(0);" onclick="load_class();"> <i class="fa fa-circle text-primary"></i> Class Settings<span class="label label-danger pull-right"><?php echo $active_data[0]['class_count']; ?></span> </a></li>



                                <!--<li><a href="<?php echo base_url('course/show-class'); ?>"> <i class="fa fa-circle text-primary"></i> Caste<span class="label label-danger pull-right">2</span></a></li>-->
                                <!--<li><a href="<?php echo base_url('course/show-class'); ?>"> <i class="fa fa-circle text-warning"></i> Community<span class="label label-info pull-right">2</span></a></li>-->
                            </ul>
                        <?php }
                        if (check_permission(517, 1133, 101) || check_permission(517, 1134, 101)) { ?>
                            <h5>Reports</h5>
                            <ul class="category-list" style="padding: 0">
                                <?php if (check_permission(517, 1133, 101)) { ?>
                                    <li><a href="javascript:void(0);" onclick="load_class_reports();"> <i class="fa fa-circle text-primary"></i> Class Wise Report <span class="label label-danger pull-right"><?php echo $active_data[0]['class_count']; ?></span> </a></li>
                                <?php }
                                if (check_permission(517, 1134, 101)) { ?>
                                    <li><a href="javascript:void(0);" onclick="load_batch_reports();"> <i class="fa fa-circle text-info"></i> Batch Wise Report <span class="label label-danger pull-right"><?php echo $active_data[0]['batch_count']; ?></span> </a></li>
                                <?php } ?>
                            </ul>
                        <?php } ?>
                        <div class="clearfix"></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-9 animated fadeInRight">
            <div class="" id="data-view">


            </div>
        </div>
    </div>
</div>


<script>
    //    load_graph();
    load_batch();

    function simpleLoad(btn, state) {
        if (state) {
            btn.children().addClass('fa-spin');
            btn.contents().last().replaceWith(" Loading");
        } else {
            setTimeout(function() {
                btn.children().removeClass('fa-spin');
                btn.contents().last().replaceWith(" Refresh");
            }, 2000);
        }
    }
    var list_switchery = [];

    function load_batch() {
        var ops_url = baseurl + 'course/show-batch/';
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

                $('#tbl_batchshow').dataTable({
                    columnDefs: [{
                            "width": "10%",
                            className: "capitalize",
                            "targets": 0
                        },
                        {
                            "width": "10%",
                            className: "capitalize",
                            "targets": 1
                        },
                        {
                            "width": "5%",
                            className: "capitalize",
                            "targets": 2
                        },
                        {
                            "width": "5%",
                            className: "capitalize",
                            "targets": 3
                        },
                        {
                            "width": "10%",
                            className: "capitalize",
                            "targets": 4
                        },
                        {
                            "width": "10%",
                            className: "capitalize",
                            "targets": 5
                        },
                        //                        {"width": "10%", className: "capitalize", "targets": 6},
                        {
                            "width": "10%",
                            className: "capitalize",
                            "targets": 6
                        },
                        {
                            "width": "5%",
                            className: "capitalize",
                            "targets": 7,
                            "orderable": false
                        }
                    ],
                    responsive: true,
                    iDisplayLength: 10,
                    "ordering": false,
                    dom: '<"html5buttons"B>lTfgitp',
                    buttons: [{
                            extend: 'copy'
                        },
                        {
                            extend: 'csv'
                        },
                        {
                            extend: 'excel',
                            title: 'Report'
                        }
                    ],
                    "fnDrawCallback": function(ele) {
                        activateSwitchery();
                    }
                });
            }
        });

    }


    function activateSwitchery() {
        for (var i = 0; i < list_switchery.length; i++) {
            list_switchery[i].destroy();
            list_switchery[i].switcher.remove();
        }
        var list_checkbox = Array.prototype.slice.call(document.querySelectorAll('.js-switch'));
        list_checkbox.forEach(function(html) {
            var switchery = new Switchery(html, {
                color: '#23C6C8',
                secondaryColor: '#F8AC59',
                size: 'small'
            });
            //        var switchery = new Switchery(html, {color: '#a9318a', size: 'small'});
            list_switchery.push(switchery);
        });
    }



    function load_course() {
        var ops_url = baseurl + 'course/show-courses/';
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
                var list_switchery = [];
                $('#tbl_course').dataTable({

                    columnDefs: [{
                            "width": "30%",
                            className: "capitalize",
                            "targets": 0
                        },
                        {
                            "width": "20%",
                            className: "capitalize",
                            "targets": 1
                        },
                        {
                            "width": "20%",
                            className: "capitalize",
                            "targets": 2
                        },
                        {
                            "width": "10%",
                            className: "capitalize",
                            "targets": 3
                        },
                        {
                            "width": "20%",
                            className: "capitalize",
                            "targets": 4,
                            "orderable": false
                        }
                    ],
                    responsive: true,
                    iDisplayLength: 10,
                    dom: '<"html5buttons"B>lTfgitp',
                    buttons: [{
                            extend: 'copy'
                        },
                        {
                            extend: 'csv'
                        },
                        {
                            extend: 'excel',
                            title: 'Report'
                        }
                    ],
                    "fnDrawCallback": function(ele) {
                        activateSwitchery();
                    }


                });

                function activateSwitchery() {
                    for (var i = 0; i < list_switchery.length; i++) {
                        list_switchery[i].destroy();
                        list_switchery[i].switcher.remove();
                    }
                    var list_checkbox = Array.prototype.slice.call(document.querySelectorAll('.js-switch'));
                    list_checkbox.forEach(function(html) {
                        var switchery = new Switchery(html, {
                            color: '#23C6C8',
                            secondaryColor: '#F8AC59',
                            size: 'small'
                        });
                        //        var switchery = new Switchery(html, {color: '#a9318a', size: 'small'});
                        list_switchery.push(switchery);
                    });
                }

            }
        });

    }

    function load_class() {
        var ops_url = baseurl + 'course/show-class/';
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

    function load_class_reports() {
        var ops_url = baseurl + 'course/class-report/';
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

    function load_batch_reports() {
        var ops_url = baseurl + 'course/batch-reportpdf/';
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

    function load_batchallocate() {
        var ops_url = baseurl + 'course/batch-allocate/';
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

                $(".select2_acdyear").select2({
                    placeholder: "Academic Year",
                    "theme": "bootstrap"
                });
                $(".select2_session").select2({
                    placeholder: "Session",
                    "theme": "bootstrap"
                });
                $(".select2_stream").select2({
                    placeholder: "Stream",
                    "theme": "bootstrap"
                });

            }
        });
    }



    function load_graph() {
        var ops_url = baseurl + 'course/show-chart/';
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
</script>