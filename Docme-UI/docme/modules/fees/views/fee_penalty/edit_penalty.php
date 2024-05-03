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
                    <span><a href="javascript:void(0);" onclick="submit_edit_data();"> <i style="font-size: 30px !important; float: right; color: #23C6C5; padding-right: 10px;" class="material-icons" data-toggle="tooltip" title="Save">save</i></a> </span>
                </div>

            </div>
            <div class="ibox-content">
                <?php
                //dev_export($penalty_data);
                echo form_open('', array('id' => 'penalty_update', 'role' => 'form'));
                ?>
                <input type="hidden" name="save_flag" id="save_flag" value="1" />
                <input type="hidden" name="penalty_id" id="penalty_id" value="<?php echo $penalty_data['penalty_id']; ?>" />
                <input type="hidden" name="title_data" id="title_data" value="<?php echo $title; ?>" />
                <div class="row clearfix">
                    <div class="col-lg-4">
                        <div class="form-group <?php
                                                if (form_error('fee_code')) {
                                                    echo 'has-error';
                                                }
                                                ?>">
                            <label>Fee Code</label><span class="mandatory"> *</span><br />

                            <select name="fee_code" id="fee_code" class="form-control selectbox" style="width:100%;">
                                <?php
                                echo '<option value ="' . $penalty_data['fee_id'] . '">' . $penalty_data['fee_name'] . '(' . $penalty_data['fee_code'] . ')' . '</option>';

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
                                                $penaltytype = trim($penalty_data['penalty_type']);
                                                ?>">
                            <label>Penalty Type</label><span class="mandatory"> *</span><br />

                            <select name="penalty_type" id="penalty_type" class="form-control selectbox" style="width:100%;" onchange="changeslab()">
                                <option value="S" <?php if ($penaltytype == 'S') echo 'selected=selected'; ?>>Slab - S</option>
                                <option value="F" <?php if ($penaltytype == 'F') echo 'selected=selected'; ?>>Fixed - F</option>
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
                                <input type="text" class="form-control effectdate" name="effectdate" readonly="" style="background-color:white;" id="reportdate" placeholder="Enter Effective Date" value="<?php echo $penalty_data['effectdate']; ?>">
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

                                            <a href="javascript:" name="add" value="Add" class="btn btn-xs btn-success tr_clone_add" title="Add New Row" <?php if ($penaltytype == 'F') {
                                                                                                                                                                echo 'style="display:none;"';
                                                                                                                                                            } ?>><i class="fa fa-plus"></i></a>

                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if (is_array($penalty_data['details'])) {
                                        $kk = 0;
                                        foreach ($penalty_data['details'] as $pad) {
                                            if ($kk++ > 0) $rows_to_remove = '_d rows_to_remove';
                                            else $rows_to_remove = '';
                                    ?>
                                            <tr id="id1" class="trow tr_clone<?php echo $rows_to_remove; ?>">
                                                <td><input type="text" class="form-control digits" name="from_day[]" id="from_day1" maxlength="3" value="<?php echo $pad['FromDays']; ?>"></td>
                                                <td><input type="text" class="form-control digits" name="to_day[]" id="to_day1" maxlength="3" value="<?php echo $pad['Todays']; ?>"></td>
                                                <td><input type="text" name="penalty_amount[]" id="penalty_amount1" class="form-control  digits" maxlength="4" value="<?php echo $pad['amount']; ?>"></td>
                                                <td width="10%"></td>
                                            </tr>
                                    <?php }
                                    } ?>
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
    $('#reportdate').datepicker({
        format: 'dd/mm/yyyy',
        //startDate: '-80d',
        autoclose: true,
        startDate: '<?php echo date('d/m/Y', strtotime($acdstartdate)); ?>',
        endDate: '<?php echo date('d/m/Y', strtotime($acdenddate)); ?>'

    });

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
        var $tr = ($(this).closest('#table_data').find('.tr_clone').last());
        var $clone = $tr.clone(true);
        cindex++;
        $clone.find(':text').val('');
        $clone.attr('id', 'id' + (cindex)); //update row id if required
        $clone.attr('class', 'trow tr_clone' + (cindex) + ' rows_to_remove'); //update row Class if required
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