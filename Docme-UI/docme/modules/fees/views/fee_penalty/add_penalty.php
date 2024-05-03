<?php
$acdstartdate = $_SESSION['acd_year_start'];
$acdenddate = $_SESSION['acd_year_end'];
?>
<div class="row clearfix" style="padding-bottom: 60px;">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <h5 style="padding-bottom: 10px;font-size: 16px;"><?php echo isset($title) ? $title : "NO TITLE PROVIDED" ?></h5>
                <div class="ibox-tools">
                    <span><a href="javascript:void(0);" onclick="close_panel();"> <i style="font-size: 30px !important; float: right; color: #E91E63;" class="material-icons" data-toggle="tooltip" title="Close">close</i></a> </span>
                    <span><a href="javascript:void(0);" onclick="submit_data();"> <i style="font-size: 30px !important; float: right; color: #23C6C5; padding-right: 10px;" class="material-icons" data-toggle="tooltip" title="Save">save</i></a> </span>
                    <span><a href="javascript:void(0);" onclick="clear_controls();"> <i style="font-size: 30px !important; float: right; color: #2196F3; padding-right: 10px;" class="material-icons " data-toggle="tooltip" title="Refresh">refresh</i></a> </span>
                </div>
            </div>
            <div class="ibox-content">
                <?php
                echo form_open('', array('id' => 'penalty_save', 'role' => 'form'));
                ?>
                <input type="hidden" name="save_flag" id="save_flag" value="1" />
                <div class="row clearfix">

                    <div class="col-lg-4">
                        <div class="form-group <?php
                                                if (form_error('fee_code')) {
                                                    echo 'has-error';
                                                }
                                                ?>">
                            <label>Fee Code</label><span class="mandatory"> *</span><br />

                            <select name="fee_code" id="fee_code" class="form-control selectbox" style="width:100%;">

                                <option selected value="-1">Select</option>
                                <?php
                                if (isset($fee_codes) && !empty($fee_codes)) {
                                    foreach ($fee_codes as $fee_code) {
                                        echo '<option value ="' . $fee_code['id'] . '">' . $fee_code['description'] . '(' . $fee_code['feeCode'] . ')' . '</option>';
                                    }
                                }
                                ?>
                            </select>
                            <?php echo form_error('fee_code', '<div class="form-error">', '</div>'); ?>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="form-group <?php
                                                if (form_error('penalty_type')) {
                                                    echo 'has-error';
                                                }
                                                ?>">
                            <label>Penalty Type</label><span class="mandatory"> *</span><br />

                            <select name="penalty_type" id="penalty_type" class="form-control selectbox" style="width:100%;" onchange="changeslab()">
                                <option value="S">Slab - S</option>
                                <option value="F">Fixed - F</option>
                            </select>
                            <?php echo form_error('penalty_type', '<div class="form-error">', '</div>'); ?>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <!-- Added by SALAHUDHEEN May 27-->
                        <div class="form-group">
                            <label>Effective Date</label><span class="mandatory"> *</span>
                            <div class="form-line <?php
                                                    if (form_error('fee_code')) {
                                                        echo 'has-error';
                                                    }
                                                    ?> ">
                                <input type="text" class="form-control effectdate" name="effectdate" readonly="" style="background-color:white;" id="reportdate" placeholder="Enter Effective Date" value="<?php echo date('d/m/Y'); ?>">
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-12" id="viewtermdetails">
                        <div class="">
                            <table class="table table-striped table-bordered" id="table_data">
                                <thead>
                                    <tr>
                                        <th width="30%">From Days</th>
                                        <th width="30%">To Days</th>
                                        <th width="30%">Amount</th>
                                        <th width="10%" class="text-center">
                                            <a href="javascript:" name="add" value="Add" class="btn btn-xs btn-success tr_clone_add" title="Add New Row"><i class="fa fa-plus"></i></a>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr id="id1" class="trow tr_clone">
                                        <td><input type="text" class="form-control digits check_val" name="from_day[]" id="from_day1" maxlength="3" value="0" readonly style="background-color:white;"></td>
                                        <td><input type="text" class="form-control digits chech_to_day" onblur="validate_fromday(this);" name="to_day[]" id="to_day1" maxlength="3" style="background-color:white;"></td>
                                        <td><input type="text" class="form-control digits chech_amt" name="penalty_amount[]" id="penalty_amount1" maxlength="4" style="background-color:white;"></td>
                                        <td width="10%" class="text-center"><a class="btn btn-xs label-danger remove_row hidden" title="Remove Row"><i class="fa fa-minus"></i></a></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <?php echo form_close(); ?>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    $('#reportdate').datepicker({
        format: 'dd/mm/yyyy',
        //startDate: '-80d',
        autoclose: true,
        startDate: '<?php echo date('d/m/Y'); ?>', //date('d/m/Y', strtotime($acdstartdate))
        endDate: '<?php echo date('d/m/Y', strtotime($acdenddate)); ?>'

    });

    function validate_fromday(el) {
        var fromday = $(el).closest('.trow').find('.check_val').val();
        var today = $(el).val();
        //if (today != '') {
        // alert(today);
        // alert(fromday);
        if ((today * 1) <= (fromday * 1)) {
            $(el).val('');
            //$(el).focus();
            swal('', 'To Days must be greater than From Days', 'warning');
            return false;
        }
        //}

    }

    function changeslab() {
        var slab = $('#penalty_type').val();
        if (slab == 'F') {
            $(".tr_clone_add").hide();
            $('#table_data').find('.rows_to_remove').not('.tr_clone').remove();
        } else {
            $(".tr_clone_add").show();
        }
    }
    var regex = /^(.*)(\d)+$/i;
    var cindex = 1;

    $(".tr_clone_add").on('click', function() {
        var check_to_clone = ($(this).closest('#table_data').find('.trow').last().find('.chech_to_day').val());
        var check_amt_row = ($(this).closest('#table_data').find('.trow').last().find('.chech_amt').val());
        if (check_to_clone == "" || check_to_clone == 0) {
            //$(this).closest('#table_data').find('.trow').last().find('.chech_to_day').focus();
            swal('', 'Enter To Days to add new Row', 'warning');
            return false;
        } else if (check_amt_row == "" || check_amt_row == 0) {
            //$(this).closest('#table_data').find('.trow').last().find('.chech_to_day').focus();
            swal('', 'Enter Amount to add new Row', 'warning');
            return false;
        } else {
            $(this).closest('#table_data').find('.trow').last().find('.chech_amt').attr('readonly', 'true');
            $(this).closest('#table_data').find('.trow').last().find('.chech_to_day').attr('readonly', 'true');
            $(this).closest('#table_data').find('.trow').last().find('.remove_row').addClass('hidden');
            var $tr = ($(this).closest('#table_data').find('.tr_clone').last());
            var $clone = $tr.clone(true);
            cindex++;
            $clone.find(':text').val('');
            //$clone.find(':text').removeAttr('readonly');
            $clone.attr('id', 'id' + (cindex)); //update row id if required
            $clone.attr('class', 'trow tr_clone' + (cindex) + ' rows_to_remove'); //update row Class if required
            var abcd = $('#to_day' + (cindex - 1)).val(); //Find Value of previous row to days
            $clone.find('.check_val').val((abcd * 1) + 1); //add prev value + 1 to to days of new row
            $clone.find('.remove_row').removeClass('hidden');
            $clone.find('.chech_amt').removeAttr('readonly');
            $clone.find('.chech_to_day').removeAttr('readonly');
            //update ids of elements in row
            $clone.find("*").each(function() {
                var id = this.id || "";
                var match = id.match(regex) || [];
                if (match.length == 3) {
                    this.id = match[1] + (cindex);
                }
            });
            var $tr1 = ($(this).closest('#table_data').find('.trow').last());
            $tr1.after($clone);
        }

    });

    $(document).on('click', '.remove_row', function() {
        $(this).parent().parent().remove();
        cindex--;
        if (cindex >= 1) {
            $('#id' + cindex).find('.remove_row').removeClass('hidden');
            $('#id' + cindex).find('.chech_amt').removeAttr('readonly');
            $('#id' + cindex).find('.chech_to_day').removeAttr('readonly');
        }
        if (cindex == 1) {
            $('#id' + cindex).find('.remove_row').addClass('hidden');
        }

    });



    function close_panel() {
        if ($('#curd-content').is(":visible") == true) {
            $("#curd-content").slideUp("slow", function() {
                $("#curd-content").hide();
                $('#add_type').show();
            });
        }
    }
    $('.selectbox').select2({
        'theme': 'bootstrap'
    });

    function clear_controls() {
        $('.chech_to_day').val('');
        $('.chech_amt').val('');
        $('#fee_code ').val('-1').trigger('change');
        $('#penalty_type ').val('-1').trigger('change');
        $('.trow').not('#id1').remove();
        $('#id1').find('.chech_amt').removeAttr('readonly');
        $('#id1').find('.chech_to_day').removeAttr('readonly');
    }

    function change_is_vat() {
        if ($('#is_vat ').val() == 1) {
            $('#vat_percent').removeAttr('readonly')
        } else if ($('#is_vat ').val() == -1) {
            $('#vat_percent').attr('readonly', 'true')
            $('#vat_percent').val('0');
        }
    }
    $('body').on('blur', '#description', function() {
        var str = $('#description').val();
        var res = str.substring(0, 3);
        $('#fee_shortcode').val(res);
    });
    //Function to allow only Decimal values to textbox
    function validateDec(key) {
        //getting key code of pressed key
        var keycode = (key.which) ? key.which : key.keyCode;
        //comparing pressed keycodes
        if (!(keycode == 8 || keycode == 46) && (keycode < 48 || keycode > 57)) {
            return false;
        } else {
            var parts = key.srcElement.value.split('.');
            if (parts.length > 1 && keycode == 46)
                return false;
            return true;
        }
    }
</script>