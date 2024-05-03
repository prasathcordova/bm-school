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
                        <a class="btn btn-block btn-primary compose-mail" href="javascript:void(0);">Registration Settings</a>
                        <div class="space-25"></div>
                        <?php if (
                            check_permission(561, 1224, 114) || check_permission(561, 1225, 114) || check_permission(561, 1226, 114)
                        ) { ?>
                            <h5>Payment Settings</h5>
                            <ul class="category-list" style="padding: 0">
                                <?php if (check_permission(561, 1224, 114)) { ?>
                                    <li title="Amount Settings"><a href="javascript:void(0)" onclick="load_amount_settings();"> <i class="fa fa-circle text-primary"></i> Amount Settings </a></li>
                                <?php } ?>
                                <?php if (check_permission(561, 1225, 114)) { ?>
                                    <li title="Payment Allocation"><a href="javascript:void(0)" onclick="load_payment_allocation();"> <i class="fa fa-circle text-warning"></i> Payment Allocation </a></li>
                                <?php } ?>
                                <?php if (check_permission(561, 1226, 114)) { ?>
                                    <li title="Payment Status"><a href="javascript:void(0)" onclick="load_payment_status();"> <i class="fa fa-circle text-info"></i> Payment Status</a></li>
                                <?php } ?>
                            </ul>
                        <?php } ?>
                        <?php if (
                            check_permission(561, 1227, 114)
                        ) { ?>
                            <h5>Date Settings</h5>
                            <ul class="category-list" style="padding: 0">
                                <?php if (check_permission(561, 1227, 114)) { ?>
                                    <li title="Registration Dates"><a href="javascript:void(0)" onclick="load_registration_dates();"> <i class="fa fa-circle text-warning"></i> Registration Dates </a></li>
                                <?php } ?>
                                <!-- <li title="Entrance Dates"><a href="javascript:void(0)" onclick="load_entrance_dates();"> <i class="fa fa-circle text-warning"></i> Entrance Dates </a></li> -->
                            </ul>
                        <?php } ?>
                        <!-- <h5>Other Settings</h5> -->
                        <!-- <ul class="category-list" style="padding: 0"> -->
                        <!-- <li title="Age Settings"><a href="javascript:void(0)" onclick="load_age_settings();"> <i class="fa fa-circle text-primary"></i> Age Settings </a></li> -->
                        <!-- </ul> -->

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
    load_payment_status();

    function load_amount_settings() {
        var ops_url = baseurl + 'registration/show-amount-settings/';
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

    function load_payment_allocation() {
        var ops_url = baseurl + 'registration/show-payment-allocation/';
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

    function load_payment_status() {
        var ops_url = baseurl + 'registration/show-payment-status/';
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

    function load_registration_dates() {
        var ops_url = baseurl + 'registration/show-registration-dates/';
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

    function load_entrance_dates() {
        var ops_url = baseurl + 'registration/show-entrance-dates/';
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

    function load_age_settings() {
        var ops_url = baseurl + 'registration/show-age-settings/';
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