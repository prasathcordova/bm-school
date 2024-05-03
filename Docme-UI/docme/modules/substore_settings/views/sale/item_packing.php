    <div class="wrapper wrapper-content animated fadeInRight" style="padding-top: 1px !important;padding-left: 0px !important;padding-right: 0px !important;">
        <div class="row" style="margin-left: -29px !important; margin-right: -30px !important;">
            <div class="col-lg-12">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>Item Packing</h5>
                        <div class="ibox-tools" id="add_type">
                            <span> <a data-toggle="modal" class="btn btn-primary btn-xs" data-toggle="tooltip" title="Advanced search" data-placement="left" href="javascript:void(0)" onclick="load_st_search();">Student Search</a></span>
                            <span><a data-toggle="modal" class="btn btn-primary btn-xs" data-toggle="tooltip" title="Advanced search" data-placement="left" href="javascript:void(0)" onclick="load_emp_search();">Employee Search</a></span>
                        </div>
                    </div>
                    <div class="ibox-content">
                        <div id="curd-content" style="display: none;"></div>
                        <div class="row">
                            <!--<div class="row m-b-sm m-t-sm">-->
                            <!--                                <div class="col-md-1">
                                    <button type="button" id="loading-example-btn" class="btn btn-white btn-sm" ><i class="fa fa-refresh"></i> Refresh</button>
                                </div>-->
                            <!--                                <div class="col-md-12">
                                    <div class="input-group"><input type="text" placeholder="Enter Voucher Number" class="input-sm form-control"> <span class="input-group-btn">
                                        <button type="button" class="btn btn-sm btn-primary"> Go</button> </span></div>
                                </div>-->
                        </div>
                    </div>


                </div>
            </div>
        </div>
    </div>
    <!--</div>-->
    <script type="text/javascript">
        function load_st_search() {
            var ops_url = baseurl + 'itempacking/search-st-advanced';
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

        function load_emp_search() {
            var ops_url = baseurl + 'itempacking/search-emp-advanced';
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

        function close_advance_search() {
            $('#add_type').show();
            $("#curd-content").slideUp("slow", function() {
                $("#curd-content").hide();
            });

        }

        function refresh_add_panel() {
            $('#country_name').val('');
            $('#country_name').parent().removeAttr('class', 'has-error');
            $('#country_nation').val('');
            $('#country_nation').parent().removeAttr('class', 'has-error');
            $('#country_abbr').val('');
            $('#country_abbr').parent().removeAttr('class', 'has-error');
            $('#currency_select').select2('val', -1);
        }
    </script>