  <div class="ibox-title">
      <h5><?php echo $title; ?></h5>
      <div class="clearfix"></div>
      <div class="ibox-tools" id="edit_type">
          <span><a href="javascript:void(0)" onclick="close_add_state();"> <i style="font-size: 30px !important; float: right; color: #E91E63;" class="material-icons" data-toggle="tooltip" data-placement="right" title="Close">close</i></a> </span>
          <span><a href="javascript:void(0)" onclick="submit_edit_save_data();"> <i style="font-size: 30px !important; float: right; color: #23C6C5; padding-right: 10px;" class="material-icons" data-toggle="tooltip" data-placement="right" title="Save">save</i></a> </span>
      </div>
  </div>
  <div class="ibox-content">
      <div class="row">
          <?php
            echo form_open('state/edit-state', array('id' => 'state_save', 'role' => 'form'));
            ?>


          <div class="col-md-6">
              <div class="form-line <?php
                                    if (form_error('country_select')) {
                                        echo 'has-error';
                                    }
                                    ?> ">
                  <b class="control-label">Country Name *</b>
                  <input type="hidden" name="load" value="0" />
                  <input type="hidden" name="state_id" value="<?php echo isset($state_data['state_id']) ? $state_data['state_id'] : ''; ?>" />
                  <select id="country_select" name="country_select" class="form-control select capitalize" data-live-search="true">
                      <option value="-1" selected>Select</option>
                      <?php
                        $country_selected = isset($country_select) ? $country_select : $state_data['country_id'];
                        if (isset($country_data) && !empty($country_data)) {
                            foreach ($country_data as $country) {
                                if (isset($country_selected) && !empty($country_selected) && $country_selected == $country['country_id']) {
                                    echo '<option selected value = "' . $country['country_id'] . '" >' . $country['country_name'] . "</option>";
                                } else {
                                    echo '<option value = "' . $country['country_id'] . '" >' . $country['country_name'] . "</option>";
                                }
                            }
                        }
                        ?>
                  </select>
                  <?php echo form_error('country_select', '<div class="control-label">', '</div>'); ?>
              </div>

          </div>
          <div class="col-md-6">
              <b>State Name</b><span class="mandatory"> *</span>
              <div class="form-group">
                  <div class="form-line <?php
                                        if (form_error('state_name')) {
                                            echo 'has-error';
                                        }
                                        ?> ">
                      <input type="text" class="form-control text-uppercase" name="state_name" id="state_name" value="<?php echo set_value('state_name', isset($state_name) ? $state_name : ''); ?>" maxlength="50" />
                  </div>
              </div>
          </div>

          <div class="col-md-6">
              <b>State Abbreviation</b><span class="mandatory"> *</span>
              <div class="form-group">
                  <div class="form-line <?php
                                        if (form_error('state_abbr')) {
                                            echo 'has-error';
                                        }
                                        ?> ">
                      <input type="text" class="form-control text-uppercase" name="state_abbr" id="state_abbr" value="<?php echo set_value('state_abbr', isset($state_abbr) ? $state_abbr : ''); ?>" maxlength="50" />
                  </div>
              </div>
          </div>


          <?php echo form_close(); ?>
      </div>
  </div>


  <script>
      $('#state_save').on('keyup keypress', function(e) {
          var keyCode = e.keyCode || e.which;
          if (keyCode === 13) {
              e.preventDefault();
              return false;
          }
      });
  </script>



  <script type="text/javascript">
      function toggle_edit_panel() {
          if ($('#state_add').is(":visible") == true) {
              $("#state_add").slideUp("slow", function() {
                  $("#state_add").hide();
              });
          }
      }

      function clear_controls() {
          $('#state_name').val('');
          $('#state_abbr').val('');

          //$('#language_select').selectpicker('deselectAll');
      }
  </script>