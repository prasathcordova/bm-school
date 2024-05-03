<div class="wrapper wrapper-content animated fadeInRight" style="padding-top: 1px !important;padding-left: 0px !important;padding-right: 0px !important;padding-bottom: 0px !important;">
    <div class="row" style="margin-left: -29px !important; margin-right: -30px !important;">
        <input type="hidden" name="amt_distribute_ops" id="amt_distribute_ops" value="0" />
        <input type="hidden" value='<?php echo json_encode($search_elements); ?>' id="search_elements">
        <input type="hidden" value="<?php echo $searchby; ?>" id="searchby">
        <div class="col-lg-12">
            <div class="ibox float-e-margins" style="margin-bottom: 0px;">
                <div class="ibox-title" style="border-bottom-color:#ffd300 !important;">
                    <?php
                    $inst_id = $this->session->userdata('inst_id');
                    $student_img = base_url('assets/img/a0.jpg');
                    //$sear_array = $search_elements;
                    //print_r($sear_array);
                    ?>
                    <h5><?php echo isset($sub_title) ? $sub_title : "NO TITLE PROVIDED" ?></h5>
                    <span style="float:right;">
                        <input type="hidden" name="excess_amount" id="excess_amount" value="0" />
                        <!-- <input type="hidden" name="student_id" id="student_id" value="<?php echo $student_id; ?>" />
                        <input type="hidden" name="student_name" id="student_name" value="<?php echo $student_name; ?>" />
                        <input type="hidden" name="feeid_selected" id="feeid_selected" value="<?php echo $feeid_selected; ?>" /> -->
                    </span>
                </div>
                <div class="ibox-content no-padding" id="pay_loader">
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
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <div id="like_button_container"></div>
                            <div class="profile-image">
                                <?php
                                $profile_image = "";
                                if (!empty(get_student_image($student_data['student_id']))) {
                                    $profile_image = get_student_image($student_data['student_id']);
                                } else if (isset($student_data['profile_image']) && !empty($student_data['profile_image'])) {
                                    $profile_image = "data:image/jpeg;base64," . $student_data['profile_image'];
                                } else {
                                    if (isset($student_data['profile_image_alternate']) && !empty($student_data['profile_image_alternate'])) {
                                        $profile_image = $student_data['profile_image_alternate'];
                                    } else {
                                        $profile_image = base_url('assets/img/a0.jpg');
                                    }
                                }
                                ?>
                                <img src="<?php echo $profile_image; ?>" class="img-circle circle-border m-b-md" alt="profile" style="margin-top: 0px;border-top-width: 0px;" />
                            </div>
                            <div class="profile-info">
                                <input type="hidden" name="student_id" id="student_id" value="<?php echo $student_data['student_id']; ?>" />
                                <input type="hidden" name="student_name" id="student_name" value="<?php echo $student_data['student_name']; ?>" />
                                <!-- <input type="hidden" name="feeid_selected" id="feeid_selected" value="<?php echo $feeid_selected; ?>" /> -->

                                <div class="">
                                    <div>
                                        <h4><?php echo $student_data['student_name']; ?></h4>
                                        <small>
                                            <b>Admission No.</b> : <?php echo $student_data['Admn_No']; ?>
                                        </small><br>
                                        <small>
                                            <b>Batch</b> : <?php echo $student_data['Batch_Name']; ?>
                                        </small><br>
                                        <small>
                                            <b>Class</b> : <?php echo $student_data['Description']; ?>
                                        </small><small>
                                            <b>Nationality</b> : <?php echo ($student_data['Nationality'] = 'INDIAN' ? $student_data['Nationality'] : 'FOREIGN'); ?>
                                        </small><br>
                                        <small>
                                            <b>Priority</b> : <?php echo $student_data['Priority']; ?>
                                        </small>&nbsp;
                                        <small>
                                            <b>Status</b> : <?php echo $student_data['stud_status']; ?>
                                        </small>
                                    </div>
                                </div>
                            </div>
                        </div>
                        </div>
                    <div class="clearfix"></div>
                    
                    <hr style="margin-bottom: 10px;">
                    <div class="row">
                            <div class="col-lg-12 col-md-12 col-xs-12 col-sm-12">
                                <div class="clearfix"></div>
                                <div class="table-responsive">
                                    <table class="table table-striped table-bordered" id="tbl_fee_allocation_data" style="margin-bottom:0px;padding-bottom: 0px !important;padding-top: 0px !important;width: 100%">
                                        <thead>
                                            <tr>
                                                <th width="10%" class="text-center">&nbsp;</th>
                                                <th width="30%">Demanded Month</th>
                                                <th width="30%">Fee Details</th>
                                                <th width="30%" class="text-right">Demanded Amount</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $i = 0;
                                            $ic = 0;
                                            // dev_export($fee_data);
                                            $penalty = 0;
                                            $instlmnt1 = 0;
                                            $termname1 = '';
                                            $penalty_check_array = array();
                                            $row_array = array();
                                            $monthrows = 1;
                                            if (isset($fee_data) && !empty($fee_data)) { //PP_APPLIED 
                                                foreach ($fee_data as $fees) {
                                                    if($fees['deact_status'] == 0)
                                                    { $disabled = 'disabled'; $row_title = 'Some Transactions Done. Cannot Deallocate';}
                                                    else{ $disabled = ''; $row_title = '';}
                                                    if($fees['isactive'] == 1)
                                                    { $checked = 'checked';}
                                                    else{ $checked = ''; }
                                                    if ($fees['is_arrear'] == 1) $txtcolor = "color:hotpink;";
                                                    else $txtcolor = '';
                                            ?>
                                                        <tr title="<?php echo $row_title;?>" <?php echo 'style="' . $txtcolor.'"'; ?>>
                                                            <td class="text-center">
                                                                <input type="checkbox" <?php echo $disabled?> <?php echo $checked?> value="1" name="selectmonth" class="i-checks selectmonth" id="selectmonth_<?php echo ++$ic ?>" chkcount="<?php echo $ic ?>" />
                                                            </td>
                                                            <td><?php echo date('M-Y', strtotime($fees['demanded_on'])); ?>
                                                                <input type="hidden" class="demnadedmonth" value="<?php echo $fees['demanded_on']; ?>" id="month_text_<?php echo $ic ?>" readonly>
                                                            </td>
                                                            <td><?php echo $fees['TRANSACTION_DESC']; ?></td>
                                                            <td class="text-right"><?php echo my_money_format($fees['TRANSACTION_AMOUNT']); ?>
                                                                <input type="hidden" class="demnadedvalue" value="<?php echo round($fees['TRANSACTION_AMOUNT'], 2); ?>" readonly>
                                                                <input type="hidden" class="demandid" value="<?php echo $fees['DEMAND_ID']; ?>" id="demand_text_<?php echo $ic ?>" readonly>
                                                                <input type="hidden" class="feedesc" value="<?php echo $fees['TRANSACTION_DESC']; ?>" readonly>
                                                                <input type="hidden" class="feeidforselection" value="<?php echo $fees['FEEID']; ?>" readonly>
                                                            </td>
                                                        </tr>
                                                    <?php
                                                        $i = $i + 1;
                                                }?>
                                                <tr>
                                                    <td class="text-left" colspan="4"><p>
                                                        <label>Reason</label>
                                                        <input type="text" class="form-control" name="dealloc_reason" id="dealloc_reason" maxlength="100" placeholder="Enter Reason">
                                                    </p></td>
                                                </tr>
                                                
                                                <!-- <tr>
                                                    <td class="text-left" colspan="4"><p>
                                                        <label>Are you sure to deallocate fee for this student? You can't undo this action. When Pressing Deallocate button, You Aggree this</label>
                                                    </p></td>
                                                </tr> -->
                                                <tr>
                                                    <td colspan="4" class="text-right">
                                                        <a style="cursor: pointer;" onclick="deallocate_fees();" class="btn btn-primary" title="Enable / Disable Selected Fees">Enable / Disable</a>
                                                    </td>
                                                </tr>
                                            <?php
                                            }
                                            else {
                                                ?>
                                                <tr>
                                                    <td class="text-center" colspan="4"><h4>No Fees Demanded for this student</h4></td>
                                                </tr>
                                            <?php } ?>
                                        </tbody>
                                    </table>
                                    <input type="hidden" name="totdistamt" id="totdistamt" />
                                    <input type="hidden" name="roundoffamt" id="roundoffamt" />
                                    <input type="hidden" name="card_roundoffamt" id="card_roundoffamt" />
                                    <input type="hidden" name="totamt" id="totamt" />

                                </div>
                                <input type="hidden" name="iter_count" id="iter_count" value="<?php echo $i; ?>" />
                                <div class="clearfix"></div>
                            </div>
                    </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="student-print-container"></div>

    <script type="text/javascript">
        $('#feecode_id').select2({
            'theme': 'bootstrap'
        });
        $('.i-checks').iCheck({
            checkboxClass: 'icheckbox_square-green',
            radioClass: 'iradio_square-green',
        });
        $(".selectmonth").on('ifChanged', function() {
            var chkcount = $(this).attr('chkcount');
            if ($(this).prop('checked') == true) {
                $('#amount_text_' + chkcount).removeAttr('readonly').focus();
            } else {
                $('#amount_text_' + chkcount).prop('readonly', true);
                var amt = $('#amount_text_' + chkcount).val();
                var topamt = $('.toptextbox').val();
                var newamt = ((amt * 1) + (topamt * 1));
                $('#amount_text_' + chkcount).val('');
                $('.toptextbox').val(newamt);
            }
        });
        /*** toptextbox*/
        $(".bottomtextbox").on("blur keypress keydown keyup", function(event) {
            // $(this).val($(this).val().replace(/[^0-9\.]/g, ''));
            // if ((event.which != 46 || $(this).val().indexOf('.') != -1) && (event.which < 48 || event.which > 57)) {
            //     event.preventDefault();
            // }
            var curval = $(this).val();
            var topval = $('.demnadedvalue').val();
            var toptextbox = $('.toptextbox').val();
            // if(curval > toptextbox){
            //     swal('Amount Mismatch','Amount shouldnot exceed '+toptextbox);
            //     return false;
            // }else{
            var totenteredamt = 0;
            $('.bottomtextbox').each(function() {
                var val1 = $(this).val();
                totenteredamt = (totenteredamt * 1) + (val1 * 1);
            });
            var newval = ((topval * 1) - (totenteredamt * 1));
            // }

            if (newval <= 0) {
                // $(this).focus();
                var enteredamt = $(this).val();
                var amt1 = $('.toptextbox').val();
                var oldamt = (amt1 * 1) + (enteredamt * 1);
                $('.toptextbox').val(oldamt);
                $(this).val('');
                swal('Amount Mismatch', 'Amount should not exceed total amount.');
                return false;
            } else {
                $('.toptextbox').val(newval);
            }

        });

        function deallocate_fees() {
            $('#pay_loader').addClass('sk-loading');
            var student_id = $('#student_id').val();
            var student_name = $('#student_name').val();
            // var feeid_selected = $('#feeid_selected').val();
            var feeid_selected = $('.feeidforselection').val();
            var demandid = $('.demandid').val();
            var feedesc = $('.feedesc').val();
            var dealloc_reason = $('#dealloc_reason').val();

            if ($('#dealloc_reason').val().length == 0) {
                $('#dealloc_reason').focus();
                swal('', 'Enter Reason', 'info');
                $('#pay_loader').removeClass('sk-loading');
                return false;
            }
            if ($('#dealloc_reason').val().length < 5) {
                $('#dealloc_reason').focus();
                swal('', 'Reason shuold contain 5 letters', 'info');
                $('#pay_loader').removeClass('sk-loading');
                return false;
            }


            var fee_code_data = [];
            var none_checked = 0;
            var dem_status = 0;
            $('.selectmonth').each(function() {
                // alert($(this).prop('checked'));
                if ($(this).prop('checked') == true) {
                    dem_status = 1;
                }
                else {
                    dem_status = 0;
                }
                var chkcount = $(this).attr('chkcount');
                var dem_id = $('#demand_text_' + chkcount).val();
                var obj_data = {
                    demand_id: dem_id,
                    dem_status: dem_status
                };
                none_checked = none_checked + 1;
                // console.log(obj_data);
                fee_code_data.push(obj_data);
            });
            // alert(none_checked);
            if ((none_checked) == 0) {
                swal('Select Fee', 'Select atleast one fee.','warning');
                $('#pay_loader').removeClass('sk-loading');
                return false;
            }
            // console.log(fee_code_data);
            // $('#pay_loader').removeClass('sk-loading');
            // return false;

            var ops_url = baseurl + 'fees/deallocate_fee_of_student/';
            $.ajax({
                type: "POST",
                cache: false,
                async: true,
                url: ops_url,
                data: {
                    "student_id": student_id,
                    "student_name": student_name,
                    "dealloc_reason": dealloc_reason,
                    "fee_code_data": JSON.stringify(fee_code_data)
                },
                success: function(result) {
                    var data = JSON.parse(result);
                    if (data.status == 1) {
                        swal('Success', 'Fee enabled/disabled successfully.', 'success');
                        get_fees_demnaded_for_student(student_id, student_name)
                        $('#pay_loader').removeClass('sk-loading');
                    } else if (data.status == 4) {
                        swal('', data.message, 'info');
                        $('#pay_loader').removeClass('sk-loading');
                    } else {
                        swal('', 'Connection Error. Please contact administrator', 'info');
                        $('#pay_loader').removeClass('sk-loading');
                    }
                }
            });
        }
        //onkeypress = "return validateFloatKeyPress(this,event);" //Add to the textbox
        function validateFloatKeyPress(el, evt) {
            var charCode = (evt.which) ? evt.which : event.keyCode;
            var number = el.value.split('.');
            if (charCode != 46 && charCode > 31 && (charCode < 48 || charCode > 57)) {
                return false;
            }
            //just one dot
            if (number.length > 1 && charCode == 46) {
                return false;
            }
            //get the carat position
            var caratPos = getSelectionStart(el);
            var dotPos = el.value.indexOf(".");
            if (caratPos > dotPos && dotPos > -1 && (number[1].length > 1)) {
                return false;
            }
            return true;
        }

        function getSelectionStart(o) {
            if (o.createTextRange) {
                var r = document.selection.createRange().duplicate()
                r.moveEnd('character', o.value.length)
                if (r.text == '') return o.value.length
                return o.value.lastIndexOf(r.text)
            } else return o.selectionStart
        }
        /*** */
        $(function() {
            $('#NameofDrawer').keydown(function(er) {
                if (er.altKey || er.ctrlKey) {
                    er.preventDefault();
                } else {
                    var key = er.keyCode;
                    if (!((key == 8) || (key == 9) || (key == 32) || (key == 46) || (key >= 65 && key <= 90) || key == 126 || key == 45 || key == 109 || key == 189 || key == 57 || key == 48)) {
                        er.preventDefault();
                    }
                }
            });
            $('body').on('click', '#reload_collection_detail', function() {
                var studentid = $(this).attr('studentid');
                var studentname = $(this).attr('studentname');
                reload_collection_detail(studentid, studentname);
            });
        });

        //ALLOW ONLY DECIMAL
        $(".allownumericwithdecimal").on("keypress keyup blur", function(event) {
            $(this).val($(this).val().replace(/[^0-9\.]/g, ''));
            if ((event.which != 46 || $(this).val().indexOf('.') != -1) && (event.which < 48 || event.which > 57)) {
                event.preventDefault();
            }
        });

        $('#amt_distribute').change(function() {
            $('#amt_distribute_ops').val('0');
        });

        //GET ROUNDOFF AMOUNT
        function getRoundOffAmount(amount_to_round_off) {
            var num = amount_to_round_off.toString(); //If it's not already a String
            num = num.slice(0, (num.indexOf(".")) + 5); //With 3 exposing the hundredths place
            Number(num); //If you need it back as a Number

            var roundedamount = getRoundoff(amount_to_round_off, '<?php echo $this->session->userdata('Institution_Address'); ?>');
            var roundoffamt = (roundedamount - amount_to_round_off).toFixed(2);
            return {
                "roundedamount": roundedamount,
                "roundoffamt": roundoffamt,
                "distributedamount": num
            };
        }


        function pay_amount_data(paytype) {
            var distr_ops = $('#amt_distribute_ops').val();
            if (distr_ops == '0') {
                swal('', 'Please click distribute to process payment.', 'info');
                return false;
            }
            if (distribute_amount() == true) {
                if (parseFloat($('#excess_amount').val()) > 0) {
                    if (paytype == 4) {
                        swal({
                            title: 'Excess Amount',
                            //text: 'Should the Excess Amount to be transfered to \nDocme Wallet ?',
                            text: 'Only the payable amount will deduct from \nDocMe wallet upon selecting Yes?',
                            type: 'warning',
                            showCancelButton: true,
                            confirmButtonColor: '#3085d6',
                            cancelButtonColor: '#d33',
                            confirmButtonText: 'Yes',
                            cancelButtonText: 'No',
                            closeOnConfirm: false,
                            closeOnCancel: false
                        }, function(isConfirm) {
                            if (isConfirm) {
                                if (paytype == 4) {
                                    wallet_payment();
                                }
                            } else {
                                swal('', 'There is an Excess Amount. Please check the amount entered to pay fee and try again', 'warning');
                                $('#pay_loader').removeClass('sk-loading');
                                return false;
                            }
                        });
                    } else {
                        swal({
                            title: 'Excess Amount',
                            //text: 'Should the Excess Amount to be transfered to \nDocme Wallet ?',
                            text: 'Are you sure the excess amount will be transferred to \nDocMe wallet upon selecting Yes?',
                            type: 'warning',
                            showCancelButton: true,
                            confirmButtonColor: '#3085d6',
                            cancelButtonColor: '#d33',
                            confirmButtonText: 'Yes',
                            cancelButtonText: 'No',
                            closeOnConfirm: false,
                            closeOnCancel: false
                        }, function(isConfirm) {
                            if (isConfirm) {
                                if (paytype == 1) {
                                    cash_pay(1);
                                } else if (paytype == 2) {
                                    cheque_pay(1);
                                } else if (paytype == 3) {
                                    var service_charge = $('#card_service_charge').val();
                                    var surcharge_for_excess_amount = $('#surcharge_for_excess_amount').val();
                                    card_pay(service_charge, surcharge_for_excess_amount, 1);
                                } else if (paytype == 4) {
                                    wallet_payment();
                                } else if (paytype == 5) {
                                    dbt_pay(1);
                                }
                            } else {
                                swal('', 'There is an Excess Amount. Please check the amount entered to pay fee and try again', 'warning');
                                $('#pay_loader').removeClass('sk-loading');
                                return false;
                            }
                        });
                    }

                } else {
                    if (paytype == 1) {
                        cash_pay(2);
                    } else if (paytype == 2) {
                        cheque_pay(2);
                    } else if (paytype == 3) {
                        var service_charge = $('#card_service_charge').val();
                        var surcharge_for_excess_amount = $('#surcharge_for_excess_amount').val();
                        card_pay(service_charge, surcharge_for_excess_amount, 2);
                    } else if (paytype == 4) {
                        wallet_payment();
                    } else if (paytype == 5) {
                        dbt_pay(2);
                    }
                }

            } else {
                swal('', 'Please check the amount and try again', 'info');
                $('#pay_loader').removeClass('sk-loading');
                return false;
            }
        }

        // function change_view_templates(studentid, studentname) {
        //     var feeid = $('#feecode_id').val();
        //     var ops_url = baseurl + 'fees/view_payment_plan';
        //     $.ajax({
        //         type: "POST",
        //         cache: false,
        //         async: false,
        //         url: ops_url,
        //         data: {
        //             "load": 1,
        //             "studentid": studentid,
        //             "studentname": studentname,
        //             "feeid": feeid
        //         },
        //         success: function(result) {
        //             var data = JSON.parse(result);
        //             if (data.status == 1) {
        //                 $('#payment-plan-container').html('');
        //                 $('#payment-plan-container').html(data.view);
        //                 $('html, body').animate({
        //                     scrollTop: 0
        //                 }, 1000);
        //             } else {
        //                 if (data.message) {
        //                     swal('', data.message, 'info');
        //                     return false;
        //                 } else {
        //                     swal('', 'There was no data regarding the selected students. Please contact administrator for further assistance', 'info');
        //                     return false;
        //                 }
        //             }

        //         }
        //     });
        // }
    </script>