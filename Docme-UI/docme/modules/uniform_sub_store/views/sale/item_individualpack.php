<div class="row" style="margin-left: -29px !important; margin-right: -30px !important;"> 
<div class="ibox-content">
<div class="row clearfix" style="padding-bottom: 60px;">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="card">
            <div class="header">
                <h2 style="padding-bottom: 10px;font-size: 16px;"><?php echo isset($title) ? $title : "NO TITLE PROVIDED" ?>
                    <span><a href="javascript:void(0);"  onclick="close_advance_search();" > <i style="font-size: 30px !important; float: right; color: #E91E63;" class="material-icons" data-toggle="tooltip" title="Close">close</i></a> </span>
                    <span><a href="javascript:void(0);"  onclick="uniform_st_search_data();" > <i style="font-size: 30px !important; float: right; color: #23C6C5; padding-right: 10px;" class="fa fa-search" data-toggle="tooltip" title="Search"></i></a> </span>
                     <!--<span>  <a data-toggle="modal" class="btn btn-primary btn-xs" data-toggle="tooltip" title="Advanced search" data-placement="left"href="javascript:void(0)"style=" float: right;  padding-right: 10px;" onclick="load_st_search();">Search</a></span>-->
                    
                    <span><a href="javascript:void(0);" onclick="refresh_add_panel();"> <i style="font-size: 30px !important; float: right; color: #2196F3; padding-right: 10px;" class="material-icons " data-toggle="tooltip" title="Refresh">refresh</i></a> </span>
                </h2>
            </div>
            <div class="body"> 
                <?php 
                echo form_open('country/add-country', array('id' => 'country_save', 'role' => 'form'));
                ?>
                <input type="hidden" name="save_flag" id="save_flag" value="1" />
                <div class="row clearfix">
                   <div class="col-lg-6">
                        <div class="form-group <?php
                        if (form_error('currency_select')) {
                            echo 'has-error';
                        }
                        ?>">
                            <label>Stream</label><span class="mandatory" > *</span><br/>

                            <select name="currency_select" id="currency_select"  class="form-control " style="width:100%;" >                                

                                <option selected value="-1">Select</option>
                                <?php
                                if (isset($currency_data) && !empty($currency_data)) {
                                    foreach ($currency_data as $currency) {
                                        echo '<option value ="' . $currency['currency_id'] . '">' . $currency['currency_name'] . '</option>';
                                    }
                                }
                                ?>
                            </select>
                            <?php echo form_error('currency_select', '<div class="form-error">', '</div>'); ?>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group <?php
                        if (form_error('currency_select')) {
                            echo 'has-error';
                        }
                        ?>">
                            <label>Class</label><span class="mandatory" > *</span><br/>

                            <select name="currency_select" id="currency_select"  class="form-control " style="width:100%;" >                                

                                <option selected value="-1">Select</option>
                                <?php
                                if (isset($currency_data) && !empty($currency_data)) {
                                    foreach ($currency_data as $currency) {
                                        echo '<option value ="' . $currency['currency_id'] . '">' . $currency['currency_name'] . '</option>';
                                    }
                                }
                                ?>
                            </select>
                            <?php echo form_error('currency_select', '<div class="form-error">', '</div>'); ?>
                        </div>
                    </div>
                     <div class="col-md-6">
                        <b>Student Name</b>
                        <div class="form-group">
                            <div class="form-line <?php
                            if (form_error('country_name')) {
                                echo 'has-error';
                            } 
                            ?> "> 
                                <input type="text" class="form-control text-uppercase"  maxlength="30" name="country_name" id="country_name" value="<?php echo set_value('country_name', isset($country_name)?$country_name:'');  ?>" />
                            </div>                           
                        </div>
                    </div>
                       <div class="col-md-6">
                        <b>Admission Number</b>
                        <div class="form-group">
                            <div class="form-line <?php
                            if (form_error('country_name')) {
                                echo 'has-error';
                            } 
                            ?> "> 
                                <input type="text" class="form-control text-uppercase"  maxlength="30" name="country_name" id="country_name" value="<?php echo set_value('country_name', isset($country_name)?$country_name:'');  ?>" />
                            </div>                           
                        </div>
                    </div>
                    <?php echo form_close(); ?>
                </div>
            </div>
        </div>

    </div>
</div>
</div>
</div>
<script type="text/javascript">
     function uniform_st_search_data() {
        var ops_url = baseurl + 'uniform/uniform/sales/student-item-packing';
        $.ajax({
            type: "POST",
            cache: false,
            async: false,
            url: ops_url,
            data: {"load": 1},
            success: function (data) {
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