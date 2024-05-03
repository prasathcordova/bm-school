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
                        <a class="btn btn-block btn-primary compose-mail" href="javascript:void(0)">Reports</a>
                        <div class="space-25"></div>
                        <h5>REPORTS</h5>
                        <ul class="category-list" style="padding: 0">
                            <?php if (check_permission(508, 1107, 102)) { ?>
                                <li><a href="javascript:void(0);" onclick="load_familyfilter();"> <i class="fa fa-circle text-primary"></i> Family Report Individual</a></li>
                            <?php } ?>
                            <?php if (check_permission(508, 1108, 102)) { ?>
                                <li><a href="javascript:void(0);" onclick="load_familywise();"> <i class="fa fa-circle text-info"></i> Family Wise Report</a></li>
                            <?php } ?>
                            <?php if (check_permission(508, 1109, 102)) { ?>
                                <li><a href="javascript:void(0);" onclick="load_reportstrength();"> <i class="fa fa-circle text-danger"></i> Student Strength Details Report</a></li>
                            <?php } ?>
                            <?php
                            if (check_permission(508, 1128, 102)) { ?>
                                <li><a href="javascript:void(0);" onclick="load_student_id_wise_report();"> <i class="fa fa-circle text-danger"></i> Student ID Wise Details Report</a></li>
                            <?php } ?>
                            <?php
                            if (check_permission(508, 1110, 102)) { ?>
                                <li><a href="javascript:void(0);" onclick="load_reportstrengthclasswise();"> <i class="fa fa-circle text-danger"></i> Class Wise Strength Details Report</a></li>
                            <?php } ?>
                            <?php
                            if (check_permission(508, 1111, 102)) { ?>
                                <li><a href="javascript:void(0);" onclick="load_reportnationwise();"> <i class="fa fa-circle text-info"></i> Nationality Wise Details</a></li>
                            <?php } ?>
                            <?php
                            if (check_permission(508, 1112, 102)) { ?>
                                <li><a href="javascript:void(0);" onclick="load_reportreligionwise();"> <i class="fa fa-circle text-warning"></i> Religion Wise Details</a></li>
                            <?php } ?>
                            <?php
                            if (check_permission(508, 1113, 102)) { ?>
                                <li><a href="javascript:void(0);" onclick="load_reportprofessionwise();"> <i class="fa fa-circle text-warning"></i> Profession Wise Details</a></li>
                            <?php } ?>
                            <?php
                            if (check_permission(508, 1114, 102)) { ?>
                                <li><a href="javascript:void(0);" onclick="load_reportclassdivsnwise();"> <i class="fa fa-circle text-primary"></i> Class/Division Wise Details</a></li>
                            <?php } ?>
                            <?php
                            if (check_permission(508, 1115, 102)) { ?>
                                <li><a href="javascript:void(0);" onclick="load_batch_notallotedstud();"> <i class="fa fa-circle text-primary"></i> Batch Not Allotted Students Details</a></li>
                            <?php } ?>
                            <?php
                            if (check_permission(508, 1116, 102)) { ?>
                                <li><a href="javascript:void(0);" onclick="load_reportgenderwise();"> <i class="fa fa-circle text-default"></i> Gender Wise Details</a></li>
                            <?php } ?>
                            <?php
                            if (check_permission(508, 1118, 102)) { ?>
                                <li><a href="javascript:void(0);" onclick="load_reportcontact();"> <i class="fa fa-circle text-info"></i> Contact Details</a></li>
                            <?php } ?>
                            <?php
                            if (check_permission(508, 1119, 102)) { ?>
                                <li><a href="javascript:void(0);" onclick="load_reportagewise();"> <i class="fa fa-circle text-primary"></i> Age Wise Details</a></li>
                            <?php } ?>
                            <?php
                            if (check_permission(508, 1120, 102)) { ?>
                                <li><a href="javascript:void(0);" onclick="load_reportcastewise();"> <i class="fa fa-circle text-default"></i> Caste Wise Details</a></li>
                            <?php }
                            if (check_permission(508, 1121, 102)) { ?>
                                <li><a href="javascript:void(0);" onclick="load_reportsexagewise();"> <i class="fa fa-circle text-default"></i> Gender/Age Wise Details</a></li>
                            <?php } ?>
                            <?php
                            if (check_permission(508, 1122, 102)) { ?>
                                <li><a href="javascript:void(0);" onclick="load_reportcollectdocumnt();"> <i class="fa fa-circle text-navy"></i> Collected Document Details</a></li>
                            <?php } ?>

                        </ul>

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
    /*chandrajith code starts*/

    function load_familyfilter() {
        var ops_url = baseurl + 'familyreport/show-class-for-students';

        $.ajax({
            type: "POST",
            cache: false,
            async: false,
            url: ops_url,
            data: {
                "load": 2
            },
            success: function(result) {
                var statusdata = JSON.parse(result);
                if (statusdata.status == 1) {
                    $('#data-view').html(statusdata.data);
                    scrollUp();
                }

            }
        });
    }
    /*chandrajith code ends*/
    // This function written by Elavarasan S @ 27-05-2019 11:30
    function scrollUp() {
        $("html, body").animate({
            scrollTop: 0
        }, "slow");
        return false;
    }


    function load_reportnationwise() {
        var ops_url = baseurl + 'report/show-nationwisepdf';
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
                scrollUp();
            }
        });
    }

    function load_reportcollectdocumnt() {
        var ops_url = baseurl + 'report/show-collectdocmntpdf';
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
                scrollUp();
            }
        });
    }

    function load_reportcastewise() {
        var ops_url = baseurl + 'report/show-castewisepdf';
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
                scrollUp();
            }
        });
    }

    function load_reportagewise() {
        var ops_url = baseurl + 'report/show-agewisepdf';
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
                scrollUp();
            }
        });
    }


    function load_reportclassdivsnwise() {
        var ops_url = baseurl + 'report/show-classdivisnwisepdf';
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
                scrollUp();
            }
        });
    }

    function load_reportreligionwise() {
        var ops_url = baseurl + 'report/show-religionwisepdf';
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
                scrollUp();
            }
        });
    }

    function load_reportprofessionwise() {
        var ops_url = baseurl + 'report/show-professionwiserpt';
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
                scrollUp();
            }
        });
    }

    function load_reportfamilywise() {
        var ops_url = baseurl + 'report/show-familywisepdf';
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
                scrollUp();
            }
        });
    }

    function load_reportstrength() {
        var ops_url = baseurl + 'report/show-studreportpdf';
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
                scrollUp();
            }
        });
    }

    function load_student_id_wise_report() {
        var ops_url = baseurl + 'report/student_id_wise_report';
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
                scrollUp();
            }
        });
    }

    function load_reportstrengthclasswise() {
        var ops_url = baseurl + 'report/show-classwisestrngthpdf';
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
                scrollUp();
            }
        });
    }

    function load_batch_notallotedstud() {
        var ops_url = baseurl + 'report/show-notbatchallotedstudpdf';
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
                scrollUp();
            }
        });
    }

    //create function by vinoth @ 17-06-2019 10:29
    function load_familywise() {
        var ops_url = baseurl + 'report/show-familywisepdf';
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
                scrollUp();
            }
        });
    }

    function load_reportgenderwise() {
        var ops_url = baseurl + 'report/show-genderwisepdf';
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
                scrollUp();
            }
        });
    }

    function load_reportsexagewise() {
        var ops_url = baseurl + 'report/show-agesexwisepdf';
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
                scrollUp();
            }
        });
    }

    function load_reportcontact() {
        var ops_url = baseurl + 'report/show-contactwisepdf';
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
                scrollUp();
            }
        });
    }
</script>