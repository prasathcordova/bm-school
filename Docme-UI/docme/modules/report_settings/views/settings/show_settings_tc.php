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
                            <?php if (check_permission(508, 1117, 102)) { ?>
                                <li><a href="javascript:void(0);" onclick="load_reportlongabsentee();"> <i class="fa fa-circle text-danger"></i> Long Absentee Details</a></li>
                            <?php } ?>
                            <?php if (check_permission(508, 1125, 102)) { ?>
                                <li><a href="javascript:void(0);" onclick="load_tc_summary_details();"> <i class="fa fa-circle text-primary"></i> TC Summary Details</a></li>
                            <?php } ?>
                            <?php if (check_permission(508, 1126, 102)) { ?>
                                <li><a href="javascript:void(0);" onclick="load_tc_applied_details();"> <i class="fa fa-circle text-primary"></i> TC Applied Details</a></li>
                            <?php } ?>
                            <?php if (check_permission(508, 1127, 102)) { ?>
                                <li><a href="javascript:void(0);" onclick="load_tc_issue_details();"> <i class="fa fa-circle text-primary"></i> TC Issued Details</a></li>
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

    function load_reportlongabsentee() {
        var ops_url = baseurl + 'report/show-longabsenteepdf';
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

    function load_promotion_details() {
        var ops_url = baseurl + 'report/show-promotion-preloaders';
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

    function load_detained_details() {
        var ops_url = baseurl + 'report/show-detained-preloaders';
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

    function load_tc_summary_details() {
        var ops_url = baseurl + 'report/show-tc-summary-preloaders';
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

    function load_tc_applied_details() {
        var ops_url = baseurl + 'report/show-tc-applied-preloaders';
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

    function load_tc_issue_details() {
        var ops_url = baseurl + 'report/show-tc-issue-preloaders';
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

    function get_class_by_stream(stream_id, disp_field) {

        var ops_url = baseurl + 'course/get-class-by-stream';
        var disp_id;
        if (disp_field == 'undefined') {
            disp_id = $('#class_select');
        } else {
            disp_id = $('#' + disp_field);
        }
        if (stream_id != 'All') {
            $.ajax({
                type: "POST",
                cache: false,
                async: false,
                url: ops_url,
                data: {
                    "load": 1,
                    "stream_id": stream_id
                },
                success: function(result) {
                    var data = JSON.parse(result);
                    if (data.status == 1) {
                        var class_data = data.data;
                        disp_id.empty();
                        disp_id.append("<option value='-1'>Select</option>");
                        disp_id.append("<option value='1000'>ALL</option>");
                        $.each(class_data, function(i, v) {
                            disp_id.append("<option value='" + v.Course_Det_ID + "' >" + v.Description + "</option>");
                        });
                        disp_id.trigger('change');
                    }
                }
            });
        }
    }
</script>