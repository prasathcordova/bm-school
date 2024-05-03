<div class="row clearfix" style="padding-bottom: 60px;">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="card">
            <div class="header">
                <!--  <h2 style="padding-bottom: 10px;font-size: 16px;"><?php echo isset($title) ? $title : "NO TITLE PROVIDED" ?> -->
                <span><a href="javascript:void(0)" onclick="close_add_document();"> <i style="font-size: 30px !important; float: right; color: #E91E63;" class="material-icons" data-toggle="tooltip" title="Close">close</i></a> </span>
                <span><a href="javascript:void(0)" onclick="edit_submit_data();"> <i style="font-size: 30px !important; float: right; color: #23C6C5; padding-right: 10px;" class="material-icons" data-toggle="tooltip" title="Save">save</i></a> </span>
                <span><a href="javascript:void(0)" onclick="refresh_add_panel();"> <i style="font-size: 30px !important; float: right; color: #2196F3; padding-right: 10px;" class="material-icons " data-toggle="tooltip" title="Refresh">refresh</i></a> </span>
                <!--  </h2> -->
            </div>
            <div class="body">
                <?php
                echo form_open('online-registration/add-needed-documents', array('id' => 'document_save', 'role' => 'form'));
                ?>
                <input type="hidden" name="save_flag" id="save_flag" value="1" />
                <input type="hidden" name="doc_id" id="doc_id" value="<?php echo set_value($document_data['document_id'], isset($document_data['document_id']) ? $document_data['document_id'] : '');  ?>" />
                <div class="row clearfix">
                    <div class="col-md-6">
                        <b>Document Name</b><span class="mandatory"> *</span>
                        <div class="form-group">
                            <div class="form-line <?php
                                                    if (form_error('document_name')) {
                                                        echo 'has-error';
                                                    }
                                                    ?> ">
                                <input type="text" class="form-control text-uppercase" placeholder="Enter Document name" name="document_name" id="document_name" value="<?php echo set_value($document_data['document_Name'], isset($document_data['document_Name']) ? $document_data['document_Name'] : '');  ?>" maxlength="30" />
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <div class="form-line  ">
                                <?php 
                                if($document_data['isrequired'] == 1){
                                    $checked = 'checked="checked"';
                                    $value = 1;
                                }else{
                                    $checked = '';
                                    $value = 0;
                                }
                                ?>
                                <label> <input type="checkbox" name="isrequired" onclick="$(this).attr('value', this.checked ? 1 : 0)" value="<?php echo $value; ?>" <?php echo $checked; ?>  id="example1"> <b>Is Required ?</b> </label>
                            </div>
                        </div>
                    </div>

                    <?php echo form_close(); ?>
                </div>
            </div>
        </div>

    </div>
</div>

<script>
    $('#document_save').on('keyup keypress', function(e) {
        var keyCode = e.keyCode || e.which;
        if (keyCode === 13) {
            e.preventDefault();
            return false;
        }
    });
</script>