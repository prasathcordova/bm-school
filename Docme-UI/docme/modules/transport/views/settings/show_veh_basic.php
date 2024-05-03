<div class="wrapper wrapper-content animated fadeInRight" style="padding-top: 1px !important;padding-left: 0px !important;padding-right: 0px !important;">
    <div class="row" style="margin-left: -29px !important; margin-right: -30px !important;">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title" style="border-bottom-color:#23C6C8!important">      
                    <h5 style="color: #1c84c6;"><?php echo isset($sub_title) ? $sub_title : "NO TITLE PROVIDED" ?></h5>
                </div>
                <div class="ibox-content">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="tabs-container">
                                <ul class="nav nav-tabs">
                                    <li class="active"><a data-toggle="tab" href="#tab-1" onclick="load_vehicle_type();"> Vehicle Type</a></li>
                                    <li class=""><a data-toggle="tab" href="#tab-2" onclick="load_vehicle_make();">Vehicle Make</a></li>
                                    <li class=""><a data-toggle="tab" href="#tab-3" onclick="load_vehicle_model();">Vehicle Model</a></li>
                                    <li class=""><a data-toggle="tab" href="#tab-4" onclick="load_vehicle_insurance();">Vehicle Insurance</a></li>
                                    <li class=""><a data-toggle="tab" href="#tab-5" onclick="load_modelyr();">Vehicle Model Year</a></li>
                                </ul>
                                <div class="tab-content">
                                    <div id="tab-1" class="tab-pane active">
                                        <div class="panel-body">
                                            <div id="veh_type_content">
                                            </div>
                                        </div>
                                    </div>
                                    <div id="tab-2" class="tab-pane">
                                        <div class="panel-body">
                                            <div id="veh_make_content">
                                            </div>
                                        </div>
                                    </div>
                                    <div id="tab-3" class="tab-pane">
                                        <div class="panel-body">
                                            <div id="veh_model_content">
                                            </div>
                                        </div>
                                    </div>
                                    <div id="tab-4" class="tab-pane">
                                        <div class="panel-body">
                                            <div id="veh_ins_content">
                                            </div>
                                        </div>
                                    </div>
                                    <div id="tab-5" class="tab-pane">
                                        <div class="panel-body">
                                            <div id="veh_myr_content">
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
<script>
    load_vehicle_type();
    function load_vehicle_type() {
        var ops_url = baseurl + 'transport/create-vehicletype/';
        $.ajax({
            type: "POST",
            cache: false,
            async: false,
            url: ops_url,
            data: {"load": 1},
            success: function (result) {
                $('#veh_make_content,#veh_ins_content,#veh_model_content,#veh_myr_content').html('');
                $('#veh_type_content').html(result);
            }
        });

    }
    function load_vehicle_make() {
        var ops_url = baseurl + 'transport/create-vehiclemake/';
        $.ajax({
            type: "POST",
            cache: false,
            async: false,
            url: ops_url,
            data: {"load": 1},
            success: function (result) {
                $('#veh_type_content,#veh_ins_content,#veh_model_content,#veh_myr_content').html('');
                $('#veh_make_content').html(result);
            }
        });

    }
    function load_vehicle_model() {
        var ops_url = baseurl + 'transport/create-vehiclemodel/';
        $.ajax({
            type: "POST",
            cache: false,
            async: false,
            url: ops_url,
            data: {"load": 1},
            success: function (result) {
                $('#veh_type_content,#veh_ins_content,#veh_make_content,#veh_myr_content').html('');
                $('#veh_model_content').html(result);
            }
        });

    }
    function load_vehicle_insurance() {
        var ops_url = baseurl + 'transport/create-vehicleinsurance/';
        $.ajax({
            type: "POST",
            cache: false,
            async: false,
            url: ops_url,
            data: {"load": 1},
            success: function (result) {
                $('#veh_type_content,#veh_model_content,#veh_make_content,#veh_myr_content').html('');
                $('#veh_ins_content').html(result);
            }
        });

    }
    
    function load_modelyr() {
        var ops_url = baseurl + 'transport/show-vehicle-modelyear/';
        $.ajax({
            type: "POST",
            cache: false,
            async: false,
            url: ops_url,
            data: {"load": 1},
            success: function (result) {
                $('#veh_type_content,#veh_ins_content,#veh_make_content,#veh_model_content').html('');
                $('#veh_myr_content').html(result);
            }
        });

    }
</script>