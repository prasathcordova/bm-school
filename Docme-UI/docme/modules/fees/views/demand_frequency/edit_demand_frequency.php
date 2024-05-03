<div class="row clearfix" style="padding-bottom: 60px;">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="card">
            <div class="header">
                <h2 style="padding-bottom: 10px;font-size: 16px;"><?php echo isset($title) ? $title : "NO TITLE PROVIDED" ?>
                    <span><a href="javascript:void(0);" onclick="close_panel();"> <i style="font-size: 30px !important; float: right; color: #E91E63;" class="material-icons" data-toggle="tooltip" title="Close">close</i></a> </span>
                    <span><a href="javascript:void(0);" onclick="submit_edit_save_data();"> <i style="font-size: 30px !important; float: right; color: #23C6C5; padding-right: 10px;" class="material-icons" data-toggle="tooltip" title="Save">save</i></a> </span>

                </h2>
            </div>
            <div class="body">
                <?php
                echo form_open('', array('id' => 'demand_frequency_edit_save', 'role' => 'form'));
                ?>
                <input type="hidden" name="save_flag" id="save_flag" value="1" />
                <input type="hidden" name="id" id="id" value="<?php echo set_value('id', isset($id) ? $id : ''); ?>" />
                <input type="hidden" name="title_data" id="title_data" value="<?php echo $title; ?>" />
                <div class="row clearfix">
                    <div class="col-md-6">
                        <!-- Added by SALAHUDHEEN May 27-->
                        <div class="form-group">
                            <label>Frequency Name</label> <span class="mandatory text-danger"> *</span>
                            <div class="form-line <?php
                                                    if (form_error('frequency_name')) {
                                                        echo 'has-error';
                                                    }
                                                    ?> ">
                                <input type="text" class="form-control" name="frequency_name" id="frequency_name" maxlength="20" value="<?php echo set_value('frequency_name', isset($frequency_name) ? $frequency_name : ''); ?>" />
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <!-- Added by SALAHUDHEEN May 27-->
                        <div class="form-group">
                            <label>Frequency Type</label> <span class="mandatory text-danger"> *</span>
                            <div class="form-line <?php
                                                    if (form_error('frequency_type')) {
                                                        echo 'has-error';
                                                    }
                                                    ?> ">
                                <select name="frequency_type" id="frequency_type" class="form-control " onchange="type_changed(this);" style="width:100%;">
                                    <option value="-1" <?php echo  set_select('frequency_type', '-1', isset($frequency_type) && $frequency_type == -1 ? TRUE : FALSE); ?>>Select</option>
                                    <option value="1" <?php echo  set_select('frequency_type', '1', isset($frequency_type) && $frequency_type == 1 ? TRUE : FALSE); ?>>One time fees</option>
                                    <option value="2" <?php echo  set_select('frequency_type', '2', isset($frequency_type) && $frequency_type == 2 ? TRUE : FALSE); ?>>Recurring Fees</option>
                                    <option value="3" <?php echo  set_select('frequency_type', '3', isset($frequency_type) && $frequency_type == 3 ? TRUE : FALSE); ?>>CUSTOM TERM</option>
                                </select>
                                <?php echo form_error('frequency_type', '<div class="form-error">', '</div>'); ?>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <!-- Added by SALAHUDHEEN May 27-->
                        <div class="form-group">
                            <input type="hidden" id="monthval" value="<?php echo $frequency_month_span ?>">
                            <label>Month Span</label> <span class="mandatory text-danger"> *</span>
                            <div class="form-line <?php
                                                    if (form_error('frequency_month_span')) {
                                                        echo 'has-error';
                                                    }
                                                    ?> ">
                                <select name="frequency_month_span" id="frequency_month_span" class="form-control " style="width:100%;">
                                    <option <?php echo  set_select('frequency_month_span', '-1', isset($frequency_month_span) && $frequency_month_span == -1 ? TRUE : FALSE); ?> value="-1">Select</option>
                                    <option data-attribute="1" <?php echo  set_select('frequency_month_span', '-2', isset($frequency_month_span) && $frequency_month_span == -2 ? TRUE : FALSE); ?> value="-2">NA</option>
                                    <option data-attribute="3" <?php echo  set_select('frequency_month_span', '-3', isset($frequency_month_span) && $frequency_month_span == -3 ? TRUE : FALSE); ?> value="-3">CUSTOM TERM</option>
                                    <option data-attribute="2" <?php echo  set_select('frequency_month_span', '1', isset($frequency_month_span) && $frequency_month_span == 1 ? TRUE : FALSE); ?> value="1">1 month</option>
                                    <option data-attribute="2" <?php echo  set_select('frequency_month_span', '2', isset($frequency_month_span) && $frequency_month_span == 2 ? TRUE : FALSE); ?> value="2">2 months</option>
                                    <option data-attribute="2" <?php echo  set_select('frequency_month_span', '3', isset($frequency_month_span) && $frequency_month_span == 3 ? TRUE : FALSE); ?> value="3">3 months</option>
                                    <option data-attribute="2" <?php echo  set_select('frequency_month_span', '4', isset($frequency_month_span) && $frequency_month_span == 4 ? TRUE : FALSE); ?> value="4">4 months</option>
                                    <!-- <option data-attribute="2" <?php echo  set_select('frequency_month_span', '5', isset($frequency_month_span) && $frequency_month_span == 5 ? TRUE : FALSE); ?> value="5">5 months</option> -->
                                    <option data-attribute="2" <?php echo  set_select('frequency_month_span', '6', isset($frequency_month_span) && $frequency_month_span == 6 ? TRUE : FALSE); ?> value="6">6 months</option>
                                    <!-- <option data-attribute="2" <?php echo  set_select('frequency_month_span', '7', isset($frequency_month_span) && $frequency_month_span == 7 ? TRUE : FALSE); ?> value="7">7 months</option>
                                    <option data-attribute="2" <?php echo  set_select('frequency_month_span', '8', isset($frequency_month_span) && $frequency_month_span == 8 ? TRUE : FALSE); ?> value="8">8 months</option>
                                    <option data-attribute="2" <?php echo  set_select('frequency_month_span', '9', isset($frequency_month_span) && $frequency_month_span == 9 ? TRUE : FALSE); ?> value="9">9 months</option>
                                    <option data-attribute="2" <?php echo  set_select('frequency_month_span', '10', isset($frequency_month_span) && $frequency_month_span == 10 ? TRUE : FALSE); ?> value="10">10 months</option>
                                    <option data-attribute="2" <?php echo  set_select('frequency_month_span', '11', isset($frequency_month_span) && $frequency_month_span == 11 ? TRUE : FALSE); ?> value="11">11 months</option> -->
                                    <option data-attribute="2" <?php echo  set_select('frequency_month_span', '12', isset($frequency_month_span) && $frequency_month_span == 12 ? TRUE : FALSE); ?> value="12">12 months</option>
                                </select>
                                <?php echo form_error('frequency_month_span', '<div class="form-error">', '</div>'); ?>
                            </div>
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
    $('#frequency_type').select2({
        'theme': 'bootstrap'
    });
    $('#frequency_month_span').select2({
        'theme': 'bootstrap'
    });
    //SALAHUDHEEN JULY 7
    $("#frequency_type").change(function() {
        //var monthval = $('#monthval').val(); //.attr('selected', true);
        filterSelectOptions($("#frequency_month_span"), "data-attribute", $(this).val());
        //$("#frequency_month_span option[value='" + monthval + "']").attr("selected", "true");
        //$("#frequency_month_span").val(monthval).trigger('change');
    });

    function filterSelectOptions(selectElement, attributeName, attributeValue) {
        if (selectElement.data("currentFilter") != attributeValue) {
            selectElement.data("currentFilter", attributeValue);
            var originalHTML = selectElement.data("originalHTML");
            if (originalHTML)
                selectElement.html(originalHTML)
            else {
                var clone = selectElement.clone();
                clone.children("option[selected]").removeAttr("selected");
                selectElement.data("originalHTML", clone.html());
            }
            if (attributeValue) {
                selectElement.children("option:not([" + attributeName + "='" + attributeValue + "'],:not([" + attributeName + "]))").remove();
            }
        }
    }

    function type_changed() {
        $('#frequency_month_span ').val('-1').trigger('change');
    }


    function type_changeda() {
        var status_value = $('#frequency_type :selected').val();
        if (status_value == -1) {
            $('#frequency_month_span ').val('-1').trigger('change');
            //            $("#frequency_month_span ").prop("disabled", false);
        } else if (status_value == 1) {
            $('#frequency_month_span ').val('-2').trigger('change');
            //            $("#frequency_month_span ").prop("disabled", true);
        } else {
            $('#frequency_month_span ').val('-1').trigger('change');
            //            $("#frequency_month_span ").prop("disabled", false);
        }
    }
</script>