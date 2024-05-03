


<?php
if (null !== ($this->session->userdata('payment_status_message')) && $this->session->userdata('payment_status_message') == 1) {
    ?>
    <script type="text/javascript">activate_toast_login('Payment Success', 'Fee payment success. Please check payments tab for more information!!', 'success', 500);</script>    
    <?php
    $this->session->unset_userdata('payment_status_message');
} else if (null !== ($this->session->userdata('payment_status_message')) && $this->session->userdata('payment_status_message') == 2) {
    ?>
    <script type="text/javascript">activate_toast_login_for_error('Payment failed please check the payment info for more details', 'Payment Failed!!', 'error', 500);</script>    
    <?php
    $this->session->unset_userdata('payment_status_message');
}
?>
<style>
    dt {
        padding-bottom: 10px;
        font-weight: 700;
    }
    .nav-tabs > li a:hover,
    .nav-tabs > li a:focus {
        background: #FFF !important;
        /*Modified for tab color*/
        /*background: #23C6C5;*/

    }

    /* select2box start*/
    /* Buttons ===================================== */
    .bootstrap-select .btn:focus {
        outline: none !important; }

    .bootstrap-select .btn:not(.btn-link):not(.btn-circle) {
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.16), 0 2px 10px rgba(0, 0, 0, 0.12);
        -webkit-border-radius: 2px;
        -moz-border-radius: 2px;
        -ms-border-radius: 2px;
        border-radius: 2px;
        border: none;
        font-size: 13px;
        outline: none; }
    .btn:not(.btn-link):not(.btn-circle):hover {
        outline: none; }
    .btn:not(.btn-link):not(.btn-circle) i {
        font-size: 20px;
        position: relative;
        top: 3px; }
    .btn:not(.btn-link):not(.btn-circle) span {
        position: relative;
        top: -2px;
        margin-left: 3px; }
    .bootstrap-select .btn-default,
    .bootstrap-select .btn-default:hover,
    .bootstrap-select .btn-default:active,
    .bootstrap-select .btn-default:focus {
        background-color: #fff !important; }

    .bootstrap-select.btn-group,
    .bootstrap-select.btn-group-vertical {
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.16), 0 2px 10px rgba(0, 0, 0, 0.12); }
    .bootstrap-select.btn-group .btn,
    .bootstrap-select.btn-group-vertical .btn {
        box-shadow: none !important;
        -webkit-border-radius: 0;
        -moz-border-radius: 0;
        -ms-border-radius: 0;
        border-radius: 0; }
    .bootstrap-select.btn-group .btn .caret,
    .bootstrap-select.btn-group-vertical .btn .caret {
        position: relative;
        bottom: 1px; }
    .bootstrap-select.btn-group .btn-group,
    .bootstrap-select.btn-group-vertical .btn-group {
        box-shadow: none !important; }
    .bootstrap-select.btn-group .btn + .dropdown-toggle,
    .bootstrap-select.btn-group-vertical .btn + .dropdown-toggle {
        border-left: 1px solid rgba(0, 0, 0, 0.08) !important; }

    /* Bootstrap Select ============================ */
    .bootstrap-select {
        box-shadow: none !important;
        border-bottom: 1px solid #ddd !important;
        -webkit-border-radius: 0;
        -moz-border-radius: 0;
        -ms-border-radius: 0;
        border-radius: 0; 
        color: #aaa;
        margin-left:-13px !important;
    }
    .bootstrap-select .dropdown-toggle:focus, .bootstrap-select .dropdown-toggle:active {
        outline: none !important; }
    .bootstrap-select .bs-searchbox,
    .bootstrap-select .bs-actionsbox,
    .bootstrap-select .bs-donebutton {
        padding: 0 0 5px 0;
        border-bottom: 1px solid #f68b1f; }
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
        margin-left: 30px; }
    .bootstrap-select .bs-searchbox {
        position: relative; }
    .bootstrap-select .bs-searchbox:after {
        content: '\E8B6';
        font-family: 'Material Icons';
        position: absolute;
        top: 0;
        color: hotpink;
        left: 10px;
        font-size: 25px; }
    .bootstrap-select ul.dropdown-menu {
        margin-top: 0 !important; }
    .bootstrap-select .dropdown-menu li.selected a {
        background-color: transparent !important;
        color: hotpink !important; }
    .bootstrap-select .dropdown-menu .active a {
        background-color: transparent;
        color: #333 !important; }
    .bootstrap-select .dropdown-menu .notify {
        background-color: #F44336 !important;
        color: #fff !important;
        border: none !important; }

    .bootstrap-select.btn-group.show-tick .dropdown-menu li.selected a span.check-mark {
        margin-top: 9px;
        color: hotpink; 
    }

    /* Dropdown Menu =============================== */
    .dropdown-menu {
        -webkit-border-radius: 0;
        -moz-border-radius: 0;
        -ms-border-radius: 0;
        border-radius: 0;
        margin-top: -35px !important;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.2);
        border: none; }
    .dropdown-menu .divider {
        margin: 5px 0; }
    .dropdown-menu .header {
        font-size: 13px;
        font-weight: bold;
        min-width: 270px;
        border-bottom: 1px solid #eee;
        text-align: center;
        padding: 4px 0 6px 0; }
    .dropdown-menu ul.menu {
        padding-left: 0; }
    .dropdown-menu ul.menu.tasks h4 {
        color: #333;
        font-size: 13px;
        margin: 0 0 8px 0; }
    .dropdown-menu ul.menu.tasks h4 small {
        float: right;
        margin-top: 6px; }
    .dropdown-menu ul.menu.tasks .progress {
        height: 7px;
        margin-bottom: 7px; }
    .dropdown-menu ul.menu .icon-circle {
        width: 36px;
        height: 36px;
        -webkit-border-radius: 50%;
        -moz-border-radius: 50%;
        -ms-border-radius: 50%;
        border-radius: 50%;
        color: #fff;
        text-align: center;
        display: inline-block; }
    .dropdown-menu ul.menu .icon-circle i {
        font-size: 18px;
        line-height: 36px; }
    .dropdown-menu ul.menu li {
        border-bottom: 1px solid #eee; }
    .dropdown-menu ul.menu li:last-child {
        border-bottom: none; }
    .dropdown-menu ul.menu li a {
        padding: 7px 11px;
        text-decoration: none;
        -moz-transition: 0.5s;
        -o-transition: 0.5s;
        -webkit-transition: 0.5s;
        transition: 0.5s; }
    .dropdown-menu ul.menu li a:hover {
        background-color: #e9e9e9; }
    .dropdown-menu ul.menu .menu-info {
        display: inline-block;
        position: relative;
        top: 3px;
        left: 5px; }
    .dropdown-menu ul.menu .menu-info h4 {
        margin: 0;
        font-size: 13px;
        color: #333; }
    .dropdown-menu ul.menu .menu-info p {
        margin: 0;
        font-size: 11px;
        color: #aaa; }
    .dropdown-menu ul.menu .menu-info p .material-icons {
        font-size: 13px;
        color: #aaa;
        position: relative;
        top: 2px; }
    .dropdown-menu .footer a {
        text-align: center;
        border-top: 1px solid #eee;
        padding: 5px 0 5px 0;
        font-size: 12px;
        margin-bottom: -5px; }
    .dropdown-menu .footer a:hover {
        background-color: transparent; }
    .dropdown-menu > li > a {
        padding: 7px 18px;
        color: #666;
        -moz-transition: all 0.5s;
        -o-transition: all 0.5s;
        -webkit-transition: all 0.5s;
        transition: all 0.5s;
        font-size: 14px;
        line-height: 25px; }
    .dropdown-menu > li > a:hover {
        background-color: rgba(0, 0, 0, 0.075); }
    .dropdown-menu > li > a i.material-icons {
        float: left;
        margin-right: 7px;
        margin-top: 2px;
        font-size: 20px; }

    .dropdown-animated {
        -webkit-animation-duration: .3s !important;
        -moz-animation-duration: .3s !important;
        -o-animation-duration: .3s !important;
        animation-duration: .3s !important; }
    /* select2box end*/

    .form-group .form-control {
        width: 100%;
        border: none;
        box-shadow: none;
        -webkit-border-radius: 0;
        -moz-border-radius: 0;
        -ms-border-radius: 0;
        border-radius: 0;
        padding-left: 0; }

    .form-group .form-line {
        width: 100%;
        position: relative;
        border-bottom: 1px solid #ddd; }
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
        border-bottom: 1px solid #f68b1f; }
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
        transform: scaleX(1); }
    .form-group .form-line.focused .form-label {
        top: -10px;
        padding-top: -10px;
        left: 0;
        font-size: 12px; }

</style>


<div id="new-view-content" >
    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
            <!--<div class="col-lg-5">-->
            <h1>Communication Details</h1>   
            <div class="col-lg-12"style="padding-top: 48px;">
                <div class="tabs-container">
                    <ul class="nav nav-tabs" role="tablist">
                        <li class="active"><a class="nav-link active" data-toggle="tab" href="#tab-1"> Contact Address</a></li>
                        <li><a class="nav-link" data-toggle="tab" href="#tab-2">Office Address</a></li>
                        <li><a class="nav-link" data-toggle="tab" href="#tab-3">Home Country Address</a></li>
                    </ul>
                    <div class="tab-content">
                        <div role="tabpanel" id="tab-1" class="tab-pane active">
                            <div class="panel-body">
                               
                                <div class="col-sm-4" style="padding-top: 48px;">
                                    <div class="form-group form-float">
                                        <div class="form-line">
                                            <input type="text" class="form-control" name="penalty_amt" id="penalty_amt" autocomplete="off">
                                            <label class="form-label">Address</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-4" style="padding-top: 48px;">
                                    <div class="form-group form-float">
                                        <div class="form-line">
                                            <input type="text" class="form-control" name="penalty_amt" id="penalty_amt" autocomplete="off">
                                            <label class="form-label">Building/House/Flat No</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-4" style="padding-top: 48px;">
                                    <div class="form-group form-float">
                                        <div class="form-line">
                                            <input type="text" class="form-control" name="penalty_amt" id="penalty_amt" autocomplete="off">
                                            <label class="form-label">Land Mark</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-4" style="padding-top: 48px;">
                                    <div class="form-group form-float">
                                        <div class="form-line">
                                            <input type="text" class="form-control" name="penalty_amt" id="penalty_amt" autocomplete="off">
                                            <label class="form-label">Emirates/State</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-4" style="padding-top: 48px;">
                                    <div class="form-group form-float">
                                        <div class="form-line">
                                            <input type="text" class="form-control" name="penalty_amt" id="penalty_amt" autocomplete="off">
                                            <label class="form-label">P.O Box Number</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-4" style="padding-top: 48px;">
                                    <div class="form-group form-float">
                                        <div class="form-line">
                                            <input type="text" class="form-control" name="penalty_amt" id="penalty_amt" autocomplete="off">
                                            <label class="form-label">Land Line Number</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-4" style="padding-top: 48px;">
                                    <div class="form-group form-float">
                                        <div class="form-line">
                                            <input type="text" class="form-control" name="penalty_amt" id="penalty_amt" autocomplete="off">
                                            <label class="form-label">Mobile Number</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-4" style="padding-top: 48px;">
                                    <div class="form-group form-float">
                                        <div class="form-line">
                                            <input type="text" class="form-control" name="penalty_amt" id="penalty_amt" autocomplete="off">
                                            <label class="form-label">Email Address</label>
                                        </div>
                                    </div>
                                </div>
                          
                                
                                
                            </div>
                        </div>
                        <div role="tabpanel" id="tab-2" class="tab-pane">
                            <div class="panel-body">
                               
                                <div class="col-sm-4" style="padding-top: 48px;">
                                    <div class="form-group form-float">
                                        <div class="form-line">
                                            <input type="text" class="form-control" name="penalty_amt" id="penalty_amt" autocomplete="off">
                                            <label class="form-label">Address</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-4" style="padding-top: 48px;">
                                    <div class="form-group form-float">
                                        <div class="form-line">
                                            <input type="text" class="form-control" name="penalty_amt" id="penalty_amt" autocomplete="off">
                                            <label class="form-label">Emirates/State</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-4" style="padding-top: 48px;">
                                    <div class="form-group form-float">
                                        <div class="form-line">
                                            <input type="text" class="form-control" name="penalty_amt" id="penalty_amt" autocomplete="off">
                                            <label class="form-label">P.O Box Number</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-4" style="padding-top: 48px;">
                                    <div class="form-group form-float">
                                        <div class="form-line">
                                            <input type="text" class="form-control" name="penalty_amt" id="penalty_amt" autocomplete="off">
                                            <label class="form-label">Phone Number</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-4" style="padding-top: 48px;">
                                    <div class="form-group form-float">
                                        <div class="form-line">
                                            <input type="text" class="form-control" name="penalty_amt" id="penalty_amt" autocomplete="off">
                                            <label class="form-label">Mobile Number</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-4" style="padding-top: 48px;">
                                    <div class="form-group form-float">
                                        <div class="form-line">
                                            <input type="text" class="form-control" name="penalty_amt" id="penalty_amt" autocomplete="off">
                                            <label class="form-label">Email Address</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div role="tabpanel" id="tab-3" class="tab-pane">
                            <div class="panel-body">
                                <div class="col-sm-4" style="padding-top: 48px;">
                                    <div class="form-group form-float">
                                        <div class="form-line">
                                            <input type="text" class="form-control" name="penalty_amt" id="penalty_amt" autocomplete="off">
                                            <label class="form-label">Address</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-4" style="padding-top: 48px;">
                                    <div class="form-group form-float">
                                        <div class="form-line">
                                            <input type="text" class="form-control" name="penalty_amt" id="penalty_amt" autocomplete="off">
                                            <label class="form-label">Emirates/State</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-4" style="padding-top: 48px;">
                                    <div class="form-group form-float">
                                        <div class="form-line">
                                            <input type="text" class="form-control" name="penalty_amt" id="penalty_amt" autocomplete="off">
                                            <label class="form-label">P.O Box Number</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-4" style="padding-top: 48px;">
                                    <div class="form-group form-float">
                                        <div class="form-line">
                                            <input type="text" class="form-control" name="penalty_amt" id="penalty_amt" autocomplete="off">
                                            <label class="form-label">Phone Number</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-4" style="padding-top: 48px;">
                                    <div class="form-group form-float">
                                        <div class="form-line">
                                            <input type="text" class="form-control" name="penalty_amt" id="penalty_amt" autocomplete="off">
                                            <label class="form-label">Mobile Number</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-4" style="padding-top: 48px;">
                                    <div class="form-group form-float">
                                        <div class="form-line">
                                            <input type="text" class="form-control" name="penalty_amt" id="penalty_amt" autocomplete="off">
                                            <label class="form-label">Email Address</label>
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
<br>

<button type="button" class="btn btn-w-m btn-warning pull-right" style="background-color:#f68b1f!important"onclick="load_form_identification();">Continue</button>


<script type="text/javascript">

    $(document).ready(function () {
        $('.form-control').focus(function () {
            $(this).parent().addClass('focused');
        });

        $('#dob_date').datepicker({
            todayBtn: "linked",
            keyboardNavigation: false,
            forceParse: false,
            calendarWeeks: true,
            autoclose: true,
//                startDate: '+0d'
            format: 'dd/mm/yyyy',
            endDate: '+0d',
        });
        // On focusout event
        $('.form-control').change(function () {
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
//                startDate: '+0d'
        });

        $('.clockpicker').clockpicker();
    });
    function load_form_identification() {
        var ops_url = baseurl + 'tempreg-formpage-identification/';
        $.ajax({
            type: "POST",
            cache: false,
            async: false,
            url: ops_url,
            data: {"load": 1},
            success: function (result) {
                $('#temp-view-reload').html(result);
            }
        });
    }

</script>