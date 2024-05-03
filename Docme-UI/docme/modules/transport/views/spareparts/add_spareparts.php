<style>
    /* select2box start*/
    /* Buttons ===================================== */
    .bootstrap-select .btn:focus {
        outline: none !important;
    }

    .bootstrap-select .btn:not(.btn-link):not(.btn-circle) {
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.16), 0 2px 10px rgba(0, 0, 0, 0.12);
        -webkit-border-radius: 2px;
        -moz-border-radius: 2px;
        -ms-border-radius: 2px;
        border-radius: 2px;
        border: none;
        font-size: 13px;
        outline: none;
    }

    .btn:not(.btn-link):not(.btn-circle):hover {
        outline: none;
    }

    .btn:not(.btn-link):not(.btn-circle) i {
        font-size: 20px;
        position: relative;
        top: 3px;
    }

    .btn:not(.btn-link):not(.btn-circle) span {
        position: relative;
        top: -2px;
        margin-left: 3px;
    }

    .bootstrap-select .btn-default,
    .bootstrap-select .btn-default:hover,
    .bootstrap-select .btn-default:active,
    .bootstrap-select .btn-default:focus {
        background-color: #fff !important;
    }

    .bootstrap-select.btn-group,
    .bootstrap-select.btn-group-vertical {
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.16), 0 2px 10px rgba(0, 0, 0, 0.12);
    }

    .bootstrap-select.btn-group .btn,
    .bootstrap-select.btn-group-vertical .btn {
        box-shadow: none !important;
        -webkit-border-radius: 0;
        -moz-border-radius: 0;
        -ms-border-radius: 0;
        border-radius: 0;
    }

    .bootstrap-select.btn-group .btn .caret,
    .bootstrap-select.btn-group-vertical .btn .caret {
        position: relative;
        bottom: 1px;
    }

    .bootstrap-select.btn-group .btn-group,
    .bootstrap-select.btn-group-vertical .btn-group {
        box-shadow: none !important;
    }

    .bootstrap-select.btn-group .btn+.dropdown-toggle,
    .bootstrap-select.btn-group-vertical .btn+.dropdown-toggle {
        border-left: 1px solid rgba(0, 0, 0, 0.08) !important;
    }

    /* Bootstrap Select ============================ */
    .bootstrap-select {
        box-shadow: none !important;
        border-bottom: 1px solid #ddd !important;
        -webkit-border-radius: 0;
        -moz-border-radius: 0;
        -ms-border-radius: 0;
        border-radius: 0;
    }

    .bootstrap-select .dropdown-toggle:focus,
    .bootstrap-select .dropdown-toggle:active {
        outline: none !important;
    }

    .bootstrap-select .bs-searchbox,
    .bootstrap-select .bs-actionsbox,
    .bootstrap-select .bs-donebutton {
        padding: 0 0 5px 0;
        border-bottom: 1px solid #e9e9e9;
    }

    .bootstrap-select .bs-searchbox .form-control,
    .bootstrap-select .bs-actionsbox .form-control,
    .bootstrap-select .bs-donebutton .form-control {
        -webkit-border-radius: 0;
        -moz-border-radius: 0;
        -ms-border-radius: 0;
        border-radius: 0;
        -webkit-box-shadow: none !important;
        -moz-box-shadow: none !important;
        -ms-box-shadow: none !important;
        box-shadow: none !important;
        border: none;
        margin-left: 30px;
    }

    .bootstrap-select .bs-searchbox {
        position: relative;
    }

    .bootstrap-select .bs-searchbox:after {
        content: '\E8B6';
        font-family: 'Material Icons';
        position: absolute;
        top: 0;
        left: 10px;
        font-size: 25px;
    }

    .bootstrap-select ul.dropdown-menu {
        margin-top: 0 !important;
    }

    .bootstrap-select .dropdown-menu li.selected a {
        background-color: #eee !important;
        color: #555 !important;
    }

    .bootstrap-select .dropdown-menu .active a {
        background-color: transparent;
        color: #333 !important;
    }

    .bootstrap-select .dropdown-menu .notify {
        background-color: #F44336 !important;
        color: #fff !important;
        border: none !important;
    }

    .bootstrap-select.btn-group.show-tick .dropdown-menu li.selected a span.check-mark {
        margin-top: 9px;
    }

    /* Dropdown Menu =============================== */
    .dropdown-menu {
        -webkit-border-radius: 0;
        -moz-border-radius: 0;
        -ms-border-radius: 0;
        border-radius: 0;
        margin-top: -35px !important;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.2);
        border: none;
    }

    .dropdown-menu .divider {
        margin: 5px 0;
    }

    .dropdown-menu .header {
        font-size: 13px;
        font-weight: bold;
        min-width: 270px;
        border-bottom: 1px solid #eee;
        text-align: center;
        padding: 4px 0 6px 0;
    }

    .dropdown-menu ul.menu {
        padding-left: 0;
    }

    .dropdown-menu ul.menu.tasks h4 {
        color: #333;
        font-size: 13px;
        margin: 0 0 8px 0;
    }

    .dropdown-menu ul.menu.tasks h4 small {
        float: right;
        margin-top: 6px;
    }

    .dropdown-menu ul.menu.tasks .progress {
        height: 7px;
        margin-bottom: 7px;
    }

    .dropdown-menu ul.menu .icon-circle {
        width: 36px;
        height: 36px;
        -webkit-border-radius: 50%;
        -moz-border-radius: 50%;
        -ms-border-radius: 50%;
        border-radius: 50%;
        color: #fff;
        text-align: center;
        display: inline-block;
    }

    .dropdown-menu ul.menu .icon-circle i {
        font-size: 18px;
        line-height: 36px;
    }

    .dropdown-menu ul.menu li {
        border-bottom: 1px solid #eee;
    }

    .dropdown-menu ul.menu li:last-child {
        border-bottom: none;
    }

    .dropdown-menu ul.menu li a {
        padding: 7px 11px;
        text-decoration: none;
        -moz-transition: 0.5s;
        -o-transition: 0.5s;
        -webkit-transition: 0.5s;
        transition: 0.5s;
    }

    .dropdown-menu ul.menu li a:hover {
        background-color: #e9e9e9;
    }

    .dropdown-menu ul.menu .menu-info {
        display: inline-block;
        position: relative;
        top: 3px;
        left: 5px;
    }

    .dropdown-menu ul.menu .menu-info h4 {
        margin: 0;
        font-size: 13px;
        color: #333;
    }

    .dropdown-menu ul.menu .menu-info p {
        margin: 0;
        font-size: 11px;
        color: #aaa;
    }

    .dropdown-menu ul.menu .menu-info p .material-icons {
        font-size: 13px;
        color: #aaa;
        position: relative;
        top: 2px;
    }

    .dropdown-menu .footer a {
        text-align: center;
        border-top: 1px solid #eee;
        padding: 5px 0 5px 0;
        font-size: 12px;
        margin-bottom: -5px;
    }

    .dropdown-menu .footer a:hover {
        background-color: transparent;
    }

    .dropdown-menu>li>a {
        padding: 7px 18px;
        color: #666;
        -moz-transition: all 0.5s;
        -o-transition: all 0.5s;
        -webkit-transition: all 0.5s;
        transition: all 0.5s;
        font-size: 14px;
        line-height: 25px;
    }

    .dropdown-menu>li>a:hover {
        background-color: rgba(0, 0, 0, 0.075);
    }

    .dropdown-menu>li>a i.material-icons {
        float: left;
        margin-right: 7px;
        margin-top: 2px;
        font-size: 20px;
    }

    .dropdown-animated {
        -webkit-animation-duration: .3s !important;
        -moz-animation-duration: .3s !important;
        -o-animation-duration: .3s !important;
        animation-duration: .3s !important;
    }

    /* select2box end*/

    .form-group .form-control {
        width: 100%;
        border: none;
        box-shadow: none;
        -webkit-border-radius: 0;
        -moz-border-radius: 0;
        -ms-border-radius: 0;
        border-radius: 0;
        padding-left: 0;
    }

    .form-group .form-line {
        width: 100%;
        position: relative;
        border-bottom: 1px solid #ddd;
    }

    .form-group .form-line:after {
        content: '';
        position: absolute;
        left: 0;
        width: 100%;
        height: 0;
        bottom: -1px;
        -moz-transform: scaleX(0);
        -ms-transform: scaleX(0);
        -o-transform: scaleX(0);
        -webkit-transform: scaleX(0);
        transform: scaleX(0);
        -moz-transition: 0.25s ease-in;
        -o-transition: 0.25s ease-in;
        -webkit-transition: 0.25s ease-in;
        transition: 0.25s ease-in;
        border-bottom: 2px solid #23C6C8;
    }

    .form-group .form-line .form-label {
        font-weight: normal;
        color: #aaa;
        position: absolute;
        top: 5px;
        left: 0;
        cursor: text;
        -moz-transition: 0.2s;
        -o-transition: 0.2s;
        -webkit-transition: 0.2s;
        transition: 0.2s;
    }

    .form-group .form-line.focused:after {
        -moz-transform: scaleX(1);
        -ms-transform: scaleX(1);
        -o-transform: scaleX(1);
        -webkit-transform: scaleX(1);
        transform: scaleX(1);
    }

    .form-group .form-line.focused .form-label {
        top: -3px;
        padding-top: -10px;
        left: 0;
        font-size: 12px;
    }
</style>
<div class="wrapper wrapper-content animated fadeInRight" style="padding-top: 1px !important;padding-left: 0px !important;padding-right: 0px !important;">
    <div class="row" style="margin-left: -29px !important; margin-right: -30px !important;">
        <div class="col-lg-12">
            <div class="card">
                <div class="header">
                    <h2 style="padding-bottom: 10px;padding-left: 10px;font-size: 16px;color:#1c84c6;"><?php echo isset($sub_title) ? $sub_title : "NO TITLE PROVIDED" ?>
                        <span><a href="javascript:void(0);" onclick="close_add_sparepart();"> <i style="font-size: 30px !important; float: right; color: #E91E63;" class="material-icons" data-toggle="tooltip" title="Close">close</i></a> </span>
                        <span><a href="javascript:void(0);" onclick="save_part_details();"> <i style="font-size: 30px !important; float: right; color: #23C6C5; padding-right: 10px;" class="material-icons" data-toggle="tooltip" title="Save">save</i></a> </span>
                        <span><a href="javascript:void(0);" onclick="refresh_add_panel();"> <i style="font-size: 30px !important; float: right; color: #2196F3; padding-right: 10px;" class="material-icons " data-toggle="tooltip" title="Refresh">refresh</i></a> </span>
                    </h2>
                </div>

                <div class="ibox-content" id="faculty_loader">
                    <div class="sk-spinner sk-spinner-wave">
                        <div class="sk-rect1"></div>
                        <div class="sk-rect2"></div>
                        <div class="sk-rect3"></div>
                        <div class="sk-rect4"></div>
                        <div class="sk-rect5"></div>
                    </div>
                    <div class="clearfix"></div>

                    <div class="wrapper wrapper-content animated fadeInRight" id="student-data-container">

                        <div class="row">

                            <?php
                            $breaker = 0;
                            ?>

                            <div class="col-lg-12">
                                <div id="curd-content" style="display: none;"></div>
                                <div class="ibox-content">
                                    <form method="post" id="myform">
                                        <div class="row">


                                            <div class="col-sm-6">
                                                <div class="form-group form-float">
                                                    <div class="form-line">
                                                        <input type="text" class="form-control alpha" name="part_name" id="part_name" autocomplete="off">
                                                        <label class="form-label">Spare Part Name</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="form-group form-float">
                                                    <div class="form-line">
                                                        <input type="text" class="form-control" name="partdesc" id="partdesc" autocomplete="off">
                                                        <label class="form-label">Spare part Description</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="form-group form-float">
                                                    <div class="form-line">
                                                        <input type="text" class="form-control" name="partnum" id="partnum" autocomplete="off">
                                                        <label class="form-label">Spare part Number</label>
                                                    </div>
                                                </div>
                                            </div>






                                        </div>
                                    </form>
                                </div>
                                <?php
                                if ($breaker == 3) {
                                    echo '<div class="clearfix"></div>';
                                    $breaker = 0;
                                } else {
                                    $breaker++;
                                }
                                //                                    }
                                //                                }
                                ?>
                            </div>
                            <!--</div>-->
                        </div>
                        <!--</div>-->
                    </div>
                </div>
            </div>
        </div>
    </div>



    <script type="text/javascript">
        $(document).ready(function() {
            $('.form-control').focus(function() {
                $(this).parent().addClass('focused');
            });

            $('#purchase_date').datepicker({
                todayBtn: "linked",
                keyboardNavigation: false,
                forceParse: false,
                calendarWeeks: true,
                autoclose: true,
                startDate: '+1d'
            });
            // On focusout event
            $('.form-control').focusout(function() {
                var $this = $(this);
                if ($this.parents('.form-group').hasClass('form-float')) {
                    if ($this.val() == '') {
                        $this.parents('.form-line').removeClass('focused');
                    }
                } else {
                    $this.parents('.form-line').removeClass('focused');
                }
            });
            $('.selectpicker').selectpicker();
            $('#data_1 .input-group.date').datepicker({
                todayBtn: "linked",
                keyboardNavigation: false,
                forceParse: false,
                calendarWeeks: true,
                autoclose: true,
                startDate: '+1d'
            });

            $('.clockpicker').clockpicker();
        });


        function refresh_add_panel() {
            $('#part_name').val('');
            $('#partdesc').val('');
            $('#partnum').val('');
            $('#vendor').val('');
            $('#price').val('');
            $('#purchase_date').val('');
            $('#partwarranty').val('');

        }

        $(".select2_vehicle").select2({
            "theme": "bootstrap",
            "width": "100%"
        });
        $(".select2_trip").select2({
            "theme": "bootstrap",
            "width": "100%"
        });
        $(".select2_pickup").select2({
            "theme": "bootstrap",
            "width": "100%"
        });

        function load_sparepart_form() {
            var ops_url = baseurl + 'transport/show-spareparts/';
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

        function save_part_details() {

            var part_name = $('#part_name').val();
            var partdesc = $('#partdesc').val();
            var partnum = $('#partnum').val();
            var ops_url = baseurl + 'transport/save-sparepart';
            $.ajax({
                type: "POST",
                cache: false,
                async: false,
                url: ops_url,
                data: {
                    "load": 1,
                    "sparepartname": part_name,
                    "desc": partdesc,
                    "partnumber": partnum
                },
                success: function(result) {
                    var data = JSON.parse(result);
                    if (data.status == 1) {
                        load_sparepart_form();
                        swal('Success', 'New Spare Part, ' + part_name + ' Saved successfully.', 'success');
                        $('#faculty_loader').removeClass('sk-loading');
                        $("#curd-content").slideUp("slow", function() {
                            $("#curd-content").hide();
                            $('#add_type').show();
                        });
                    } else if (data.status == 2) {
                        $('#curd-content').html('');
                        $('#curd-content').html(data.view);
                        swal('', data.message, 'info');
                        $('#faculty_loader').removeClass('sk-loading');
                    } else if (data.status == 3) {
                        $('#curd-content').html('');
                        $('#curd-content').html(data.view);
                        swal('', data.message, 'info');
                        $('#faculty_loader').removeClass('sk-loading');
                    } else {
                        swal('', 'Connection Error. Please contact administrator', 'info');
                        $('#faculty_loader').removeClass('sk-loading');
                    }
                }
            });
        }
    </script>