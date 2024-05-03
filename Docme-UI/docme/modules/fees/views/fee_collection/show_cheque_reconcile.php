<div class="wrapper wrapper-content animated fadeInRight" style="padding-top: 1px !important;padding-left: 0px !important;padding-right: 0px !important;">
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <!--style="box-shadow: none;"-->
                <div class="ibox-title" style="border-bottom-color:#ffd300 !important;">
                    <h5><?php echo isset($sub_title) ? $sub_title : "Cheque Reconciliation" ?></h5>
                </div>
                <div class="ibox-content" id="reconcile_loader">

                    <div class="sk-spinner sk-spinner-wave">
                        <div class="sk-rect1"></div>
                        <div class="sk-rect2"></div>
                        <div class="sk-rect3"></div>
                        <div class="sk-rect4"></div>
                        <div class="sk-rect5"></div>
                    </div>

                    <h3 id="admission_div_h">Advanced Filter
                        <!-- Added By SALAHUDHEEN May 29, 2019; Added title="Filter Options" in below <a> tag -->
                        <span style="float: right;"><a href="javascript:void(0)" title="Filter Options" onclick="toggle_advanced()"><i id="toggler" class="fa fa-plus"></i></a></span>
                        <hr style="margin-top:4px;">
                    </h3>
                    <div class="row" id="admission_div" style="display: none;">
                        <div class="col-md-12">
                            <b>Transaction Date(Includes cheque for Fee Payment and Docme Wallet Payment)</b>
                            <div class="form-group">
                                <div class="form-line">
                                    <div class="input-group">
                                        <input type="text" class="form-control" name="datefilter" id="datefilter" readonly="" style="background-color: white;" />
                                        <span class="input-group-btn">
                                            <a id="search_name_btn" class="btn btn-primary" onclick="search_cheque_data();" title="Search">
                                                <i class="fa fa-search"></i>
                                            </a>
                                        </span>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>

                    <h3 id="advanced_search_h">Cheque Need to be Reconcile
                        <hr>
                    </h3>

                    <div id="advanced_search" class="row">
                        <?php echo $this->load->view('search_show_cheque_reconcile', TRUE); ?>
                    </div>

                    <div class="row" id="student-data-container"></div>

                </div>
            </div>
        </div>
    </div>
</div>


<script type="text/javascript">
    $(function() {
        $('#datefilter span').html(moment().startOf('month').format('DD-MM-YYYY') + ' - ' + moment().endOf('month').format('DD-MM-YYYY'));
        $('#datefilter span').prop("disabled", false);
        $('#datefilter').daterangepicker({
            format: 'DD-MM-YYYY',
            // startDate: moment().subtract(29, 'days'),
            // endDate: moment(),
            // minDate: '01/01/2017',
            // maxDate: '12/31/2019',
            dateLimit: {
                days: 270
            },
            showDropdowns: true,
            showWeekNumbers: true,
            timePicker: false,
            opens: 'right',
            drops: 'down',
            buttonClasses: ['btn', 'btn-sm'],
            applyClass: 'btn-primary',
            cancelClass: 'btn-default',
            separator: ' to ',
            locale: {
                applyLabel: 'Apply',
                cancelLabel: 'Cancel',
                fromLabel: 'From',
                toLabel: 'To',
                customRangeLabel: 'Custom',
                daysOfWeek: ['Su', 'Mo', 'Tu', 'We', 'Th', 'Fr', 'Sa'],
                monthNames: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
                firstDay: 1
            }
        }, function(start, end, label) {
            $('#datefilter span').html(start.format('DD-MM-YYYY') + ' - ' + end.format('DD-MM-YYYY'));
        });
        $('.daterangepicker_start_input').html('');
        $('.daterangepicker_end_input').html('');
        var table2 = $('#available_cheque_for_reconcile').dataTable({
            responsive: false,
            iDisplayLength: 10,
            "ordering": false,
            dom: '<"html5buttons"B>lTfgitp',
            buttons: [],

        });
    });

    function search_cheque_data() {
        if (moment($('#datefilter').data('daterangepicker').startDate).isValid() === false) {
            swal('', 'Select a date for filtering cheque data', 'info');
            return false;
        }

        if (moment($('#datefilter').data('daterangepicker').endDate).isValid() === false) {
            swal('', 'Select a date for filtering cheque data', 'info');
            return false;
        }


        var start_date = moment($('#datefilter').data('daterangepicker').startDate).format('YYYY-MM-DD')
        var end_date = moment($('#datefilter').data('daterangepicker').endDate).format('YYYY-MM-DD')

        var ops_url = baseurl + 'fees/search-cheque-show-reconcile';
        $.ajax({
            type: "POST",
            cache: false,
            async: false,
            url: ops_url,
            data: {
                "load": 1,
                "start_date": start_date,
                "end_date": end_date
            },
            success: function(result) {
                var data = JSON.parse(result)
                if (data.status == 1) {

                    $('#advanced_search').html('');
                    var animation = "fadeInDown";
                    $("#advanced_search").show();
                    $('#advanced_search').addClass('animated');
                    $('#advanced_search').addClass(animation);
                    $('#advanced_search').html(data.view);
                    var table3 = $('#available_cheque_for_reconcile').dataTable({
                        responsive: false,
                        iDisplayLength: 10,
                        "ordering": false,
                    });


                } else if (data.status == 2) {
                    swal('', 'Select a valid date', 'info');
                    return false;
                } else if (data.status == 3) {
                    swal('', 'Please check the data and try again', 'info');
                    $('#advanced_search').html('');
                    $('#advanced_search').html(data.view);
                    return false;
                } else {
                    swal('', 'No data loaded', 'info');
                    return false;
                }
            }
        });
    }
    var chqid = 0;
    var chqnumber = 0;

    function reconcile_data(id, chq_number, element) {
        chqid = id;
        chqnumber = chq_number;
        swalExtend({
            swalFunction: swalFunction,
            hasCancelButton: false,
            buttonNum: 1,
            buttonColor: ["red"],
            buttonNames: ["Close"],
            clickFunctionList: [
                function() {
                    console.debug('ONE BUTTON');
                }
            ]
        });
    }
    var swalFunction = function() {
        swal({
                title: "Cheque Reconciliation",
                text: "Please state the status of the cheque : " + chqnumber,
                type: "info",
                showCancelButton: true,
                showCloseButton: true,
                confirmButtonClass: "btn-primary",
                confirmButtonText: "Reconcile",
                cancelButtonText: "Bounce",
                closeOnConfirm: false,
                closeOnCancel: false,
            },
            function(state) {
                if (state) {
                    var recon_state = reconcile_cheque(chqid);
                    if (recon_state.status == 1) {
                        var recon_wallet_voucher = recon_state.recon_wallet_voucher;
                        if (recon_wallet_voucher == '' || recon_state.recon_voucher == recon_wallet_voucher)
                            var msg_to_display = "The cheque with cheque number " + chqnumber + " is successfully credited to student account. \n Generated Voucher Number : " + recon_state.recon_voucher;
                        else {
                            if (recon_wallet_voucher == null)
                                var msg_to_display = "The cheque with cheque number " + chqnumber + " is successfully credited to student account. \n Generated Voucher Number : " + recon_state.recon_voucher
                            else
                                var msg_to_display = "The cheque with cheque number " + chqnumber + " is successfully credited to student account. \n Generated Voucher Number : " + recon_state.recon_voucher + ". \n Wallet Voucher Number : " + recon_wallet_voucher
                        }
                        swal("Cheque Reconciliation Success", msg_to_display, "success");
                        load_cheque_reconciliation();
                        return false;
                    } else {
                        swal("Cheque Reconciliation Failed", "The cheque with cheque number " + chqnumber + " is failed to realize", "info"); // with message+ recon_state.message
                        return false;
                    }

                } else {

                    swal({
                            title: "Cheque Reconciliation",
                            // text: "Are you sure you want to bounce the cheque with cheque number " + chqnumber + " The student will be blacklisted. Enter the mandatory remark.",
                            text: "Are you sure to bounce the cheque? Once bounced,the student will be blacklisted.\nIf yes enter remark.",
                            type: "info",
                            showCancelButton: true,
                            confirmButtonClass: "btn-primary",
                            confirmButtonText: "Bounce",
                            cancelButtonText: "Cancel",
                            closeOnConfirm: false,
                            closeOnCancel: true,
                            type: "input",
                            inputPlaceholder: "Remarks should contain more than 2 characters"
                        },
                        function(isConfirm) {
                            if (isConfirm) {

                                if (isConfirm.length > 2 && isConfirm.length < 251) {
                                    var recon_state = bounce_cheque(chqid, isConfirm);
                                    if (recon_state.status == 1) {
                                        swal("", "The cheque with cheque number " + chqnumber + " is bounced and the student is blacklisted.", "success");
                                        load_cheque_reconciliation();
                                        return false;
                                    } else {
                                        swal("Cheque Reconciliation Failed", "The cheque with cheque number " + chqnumber + " is failed to realize", "info");; // with message+ recon_state.message
                                        return false;
                                    }
                                } else {
                                    // $('.sweet-alert input[type=text]').attr('placeholder', 'Remarks should contain more than 2 characters').val('').focus(); //.css('font-weight', 'bold')
                                    if (isConfirm.length < 3)
                                        $('.sweet-alert input[type=text]').attr('placeholder', 'Remarks should contain more than 2 characters').val('').focus(); //.css('font-weight', 'bold')
                                    else if (isConfirm.length > 250)
                                        $('.sweet-alert input[type=text]').attr('placeholder', 'Remarks should contain maximum 250 characters').val('').focus(); //.css('font-weight', 'bold')
                                }
                            } else {
                                $('.sweet-alert input[type=text]').attr('placeholder', 'Enter Remark').val('').focus(); //.css('font-weight', 'bold')
                            }

                        });
                }

            });
    };

    function reconcile_dataa(id, chq_number, element) {
        swal({
                title: "Cheque Reconciliation",
                text: "Please state the status of the cheque : " + chq_number,
                type: "info",
                showCancelButton: true,
                showCloseButton: true,
                confirmButtonClass: "btn-primary",
                confirmButtonText: "Reconciled",
                cancelButtonText: "Bounced",
                closeOnConfirm: false,
                closeOnCancel: false,
            },
            function(state) {
                if (state) {
                    var recon_state = reconcile_cheque(id);
                    if (recon_state.status == 1) {
                        swal("Cheque Reconciliation Success", "The cheque with cheque number " + chq_number + " is successfully credited to student account. \n Generated Voucher Number : " + recon_state.recon_voucher, "success");
                        load_cheque_reconciliation();
                        return false;
                    } else {
                        swal("Cheque Reconciliation Failed", "The cheque with cheque number " + chq_number + " is failed to realize", "info"); // with message+ recon_state.message
                        return false;
                    }

                } else {

                    swal({
                            title: "Cheque Reconciliation",
                            text: "Are you sure you want to bounce the cheque with cheque number " + chq_number + " The student will be blacklisted. Enter the mandatory remark.",
                            type: "info",
                            showCancelButton: true,
                            confirmButtonClass: "btn-primary",
                            confirmButtonText: "Bounce",
                            cancelButtonText: "Cancel",
                            closeOnConfirm: false,
                            closeOnCancel: true,
                            type: "input",
                            inputPlaceholder: "Remarks should contain more than 2 characters"
                        },
                        function(isConfirm) {
                            if (isConfirm) {
                                if (isConfirm.length > 2) {
                                    var recon_state = bounce_cheque(id, isConfirm);
                                    if (recon_state.status == 1) {
                                        swal("", "The cheque with cheque number " + chq_number + " is bounced and the student is blacklisted.", "success");
                                        load_cheque_reconciliation();
                                        return false;
                                    } else {
                                        swal("Cheque Reconciliation Failed", "The cheque with cheque number " + chq_number + " is failed to realize", "info");; // with message+ recon_state.message
                                        return false;
                                    }
                                } else {
                                    alert("Remarks should contain more than 2 characters", "info"); // Changed By Salahudheen May 29, 2019
                                }
                            }

                        });
                }

            });
    }

    function toggle_advanced() {
        if ($('#toggler').attr('class') === 'fa fa-plus') {
            $('#toggler').removeClass('fa-plus');
            $('#toggler').addClass('fa-minus');
            $('#admission_div').show();
        } else {
            $('#toggler').removeClass('fa-minus');
            $('#toggler').addClass('fa-plus');
            $('#admission_div').hide();
        }
    }

    function reconcile_cheque(master_id) {
        var status = 0;
        var data;
        var ops_url = baseurl + 'fees/reconcile-cheque';
        $.ajax({
            type: "POST",
            cache: false,
            async: false,
            url: ops_url,
            data: {
                "load": 1,
                "master_id": master_id
            },
            success: function(result) {
                data = JSON.parse(result)
                if (data.status == 1) {
                    status = 1;
                } else {
                    status = 0;
                }
            }
        });
        if (status == 1) {
            return data
        } else {
            return false;
        }
    }

    function bounce_cheque(master_id, remarks) {
        var status = 0;
        var data;
        var ops_url = baseurl + 'fees/bounce-cheque';
        $.ajax({
            type: "POST",
            cache: false,
            async: false,
            url: ops_url,
            data: {
                "load": 1,
                "master_id": master_id,
                "remarks": remarks
            },
            success: function(result) {
                data = JSON.parse(result)
                if (data.status == 1) {
                    status = 1;
                } else {
                    status = 0;
                }
            }
        });
        if (status == 1) {
            return data
        } else {
            return false;
        }
    }

    function cancel_cheque(master_id, chq_number, element) {
        // $('.sweet-alert input[type=text]').attr('maxlength', '10');
        var chqnumber = chq_number;
        swal({
                title: "Cheque Cancellation",
                text: "Are you sure to cancel the cheque? \nIf yes enter remark.",
                type: "info",
                showCancelButton: true,
                confirmButtonClass: "btn-danger",
                confirmButtonText: "Cancel Cheque",
                cancelButtonText: "Close",
                closeOnConfirm: false,
                closeOnCancel: true,
                type: "input",
                inputPlaceholder: "Remarks should contain more than 2 characters"
            },
            function(isConfirm) {
                if (isConfirm) {
                    if (isConfirm.length > 2 && isConfirm.length < 251) {
                        var status = 0;
                        var data;
                        var ops_url = baseurl + 'fees/cancel-cheque';
                        $.ajax({
                            type: "POST",
                            cache: false,
                            async: false,
                            url: ops_url,
                            data: {
                                "load": 1,
                                "master_id": master_id,
                                "remarks": isConfirm
                            },
                            success: function(result) {
                                data = JSON.parse(result)
                                if (data.status == 1) {
                                    swal("", "The cheque with cheque number " + chqnumber + " is Cancelled.", "success");
                                    load_cheque_reconciliation();
                                    return false;
                                } else {
                                    swal("Cheque Cancellation Failed", "The cheque with cheque number " + chqnumber + " is failed to cancel", "info");; // with message+ recon_state.message
                                    return false;
                                }
                            }
                        });
                    } else {
                        if (isConfirm.length < 3)
                            $('.sweet-alert input[type=text]').attr('placeholder', 'Remarks should contain more than 2 characters').val('').focus(); //.css('font-weight', 'bold')
                        else if (isConfirm.length > 250)
                            $('.sweet-alert input[type=text]').attr('placeholder', 'Remarks should only contain maximum 250 characters').val('').focus(); //.css('font-weight', 'bold')
                    }
                } else {
                    $('.sweet-alert input[type=text]').attr('placeholder', 'Enter Remark').val('').focus(); //.css('font-weight', 'bold')
                }

            });
    }
</script>