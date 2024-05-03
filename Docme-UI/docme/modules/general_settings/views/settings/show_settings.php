<style>
    .tag-list li {
        float: none !important;
    }
</style>
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
                        <a class="btn btn-block btn-primary compose-mail" href="javascript:void(0)">General Settings</a>
                        <div class="space-25"></div>
                        <h5>Geographic Settings</h5>

                        <ul class="category-list" style="padding: 0">

                            <li><a href="javascript:void(0)" onclick="load_country();"> <i class="fa fa-circle text-primary"></i> Country <span class="label label-warning pull-right" style="width:40px" id="country_count"><?php echo $count_data[0]['Country']; ?></span> </a></li>
                            <li><a href="javascript:void(0)" onclick="load_state();"> <i class="fa fa-circle text-info"></i> State <span class="label label-danger pull-right" style="width:40px" id="state_count"><?php echo $count_data[0]['States']; ?></span> </a></li>
                            <li><a href="javascript:void(0)" onclick="load_district();"> <i class="fa fa-circle text-warning"></i> District <span class="label label-info pull-right" style="width:40px" id="city_count"><?php echo $count_data[0]['City']; ?></span> </a></li>
                        </ul>
                        <h5>Category Settings</h5>
                        <ul class="category-list" style="padding: 0">
                            <li><a href="javascript:void(0)" onclick="load_religion();"> <i class="fa fa-circle text-navy"></i> Religion <span class="label label-warning pull-right" style="width:40px" id="religion_count"><?php echo $count_data[0]['Religion']; ?></span> </a></li>
                            <li><a href="javascript:void(0)" onclick="load_caste();"> <i class="fa fa-circle text-primary"></i> Caste <span class="label label-danger pull-right" style="width:40px" id="caste_count"><?php echo $count_data[0]['Caste']; ?></span> </a></li>
                            <li><a href="javascript:void(0)" onclick="load_community();"> <i class="fa fa-circle text-warning"></i> Community <span class="label label-info pull-right" style="width:40px" id="community_count"><?php echo $count_data[0]['Community']; ?></span> </a></li>

                            <!--<li><a href="<?php echo base_url('course/show-class'); ?>"> <i class="fa fa-circle text-primary"></i> Caste<span class="label label-danger pull-right">2</span></a></li>-->
                            <!--<li><a href="<?php echo base_url('course/show-class'); ?>"> <i class="fa fa-circle text-warning"></i> Community<span class="label label-info pull-right">2</span></a></li>-->
                        </ul>
                        <h5>Other Settings</h5>
                        <ul class="category-list" style="padding: 0">
                            <?php if (check_permission(560, 1228, 114)) { ?>
                                <li><a href="javascript:void(0)" onclick="load_system_parameters();"> <i class="fa fa-circle text-warning"></i> System Parameters</a></li>
                            <?php } ?>
                            <li><a href="javascript:void(0)" onclick="load_currency();"> <i class="fa fa-circle text-navy"></i> Currency <span class="label label-warning pull-right" style="width:40px" id="currency_count"><?php echo $count_data[0]['Currency']; ?></span> </a></li>
                            <li><a href="javascript:void(0)" onclick="load_language();"> <i class="fa fa-circle text-primary"></i> Language <span class="label label-danger pull-right" style="width:40px" id="language_count"><?php echo $count_data[0]['Languages']; ?></span> </a></li>
                            <li><a href="javascript:void(0)" onclick="load_profession();"> <i class="fa fa-circle text-warning"></i> Profession <span class="label label-info pull-right" style="width:40px" id="profession_count"><?php echo $count_data[0]['Profession']; ?></span> </a></li>

                        </ul>
                        <h5>Reports</h5>
                        <ul class="category-list" style="padding: 0">
                            <li><a href="javascript:void(0)" onclick="get_report('country');"><i class="fa fa-circle text-warning"></i> Country List</a></li>
                            <li><a href="javascript:void(0)" onclick="get_report('state');"><i class="fa fa-circle text-primary"></i> State List</a></li>
                            <li><a href="javascript:void(0)" onclick="get_report('district');"><i class="fa fa-circle text-navy"></i> District List</a></li>
                            <li><a href="javascript:void(0)" onclick="get_report('religion');"><i class="fa fa-circle text-danger"></i> Religion List</a></li>
                            <li><a href="javascript:void(0)" onclick="get_report('caste');"><i class="fa fa-circle text-warning"></i> Caste List</a></li>
                            <li><a href="javascript:void(0)" onclick="get_report('community');"><i class="fa fa-circle text-primary"></i> Community List</a></li>
                            <li><a href="javascript:void(0)" onclick="get_report('language');"><i class="fa fa-circle text-navy"></i> Language List</a></li>
                            <li><a href="javascript:void(0)" onclick="get_report('profession');"><i class="fa fa-circle text-danger"></i> Profession List</a></li>
                            <li><a href="javascript:void(0)" onclick="get_report('currency');"><i class="fa fa-circle text-warning"></i> Currency List</a></li>

                        </ul>
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
    function gs_count() {
        var ops_url = baseurl + 'settings/show-count/';
        $.ajax({
            type: "POST",
            cache: false,
            async: false,
            url: ops_url,
            success: function(result) {
                var data = JSON.parse(result);
                if (data.status == 1) {
                    var count_data = data.data[0];
                    $("#country_count").text(count_data['Country']);
                    $("#state_count").text(count_data['States']);
                    $("#city_count").text(count_data['City']);
                    $("#religion_count").text(count_data['Religion']);
                    $("#caste_count").text(count_data['Caste']);
                    $("#community_count").text(count_data['Community']);
                    $("#currency_count").text(count_data['Currency']);
                    $("#language_count").text(count_data['Languages']);
                    $("#profession_count").text(count_data['Profession']);
                    //                    $.each(count_data, function (i, v) {
                    //                        $("#publisher_count").text('+v.publisher_count+');
                    //                    });
                }
            }
        });
    }
    //    this function written by Elavarasan S @ 18-05-2019 10:30
    function get_report(type) {
        var ops_url = baseurl + 'report/get_general_reports';
        $.ajax({
            type: "POST",
            cache: false,
            async: false,
            url: ops_url,
            data: {
                "type": type
            },
            success: function(data) {
                window.open(data, '_blank');
            }
        });
    }

    load_country();

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

    function load_country() {
        var ops_url = baseurl + 'country/show-country/';
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

    function load_state() {
        var ops_url = baseurl + 'state/show-state/';
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

    function load_district() {
        var ops_url = baseurl + 'city/show-city';
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

    function load_religion() {
        var ops_url = baseurl + 'religion/show-religion';
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

    function load_caste() {
        var ops_url = baseurl + 'caste/show-caste';
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

    function load_community() {
        var ops_url = baseurl + 'community/show-community';
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

    function load_currency() {
        var ops_url = baseurl + 'currency/show-currency';
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

    function load_language() {
        var ops_url = baseurl + 'language/show-language';
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

    function load_profession() {
        var ops_url = baseurl + 'profession/show-profession';
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

    function load_system_parameters() {
        var ops_url = baseurl + 'settings/show-system-parameters';
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