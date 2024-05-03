  <div class="ibox-title">
      <h5><?php echo $title; ?></h5>
      <div class="clearfix"></div>
      <div class="ibox-tools" id="edit_type">
          <span><a href="javascript:void(0)" onclick="close_add_city();"> <i style="font-size: 30px !important; float: right; color: #E91E63;" class="material-icons" data-toggle="tooltip" data-placement="right" title="Close">close</i></a> </span>
          <span><a href="javascript:void(0)" onclick="submit_edit_save_data();"> <i style="font-size: 30px !important; float: right; color: #23C6C5; padding-right: 10px;" class="material-icons" data-toggle="tooltip" data-placement="right" title="Save">save</i></a> </span>
      </div>
  </div>
  <div class="ibox-content">
      <div class="row">
          <?php
            echo form_open('city/edit-city', array('id' => 'city_save', 'role' => 'form'));
            ?>

          <div class="col-md-6">
              <div class="form-group <?php
                                        if (form_error('state_select')) {
                                            echo 'has-error';
                                        }
                                        ?> ">
                  <label class="control-label">State Name</label><span class="mandatory"> *</span>
                  <input type="hidden" name="load" value="0" />
                  <input type="hidden" name="city_id" value="<?php echo isset($city_data['city_id']) ? $city_data['city_id'] : ''; ?>" />
                  <select id="state_select" name="state_select" class="form-control select capitalize" data-live-search="true">
                      <!--<option  <?php echo set_select('state_select', '-1'); ?> disabled>Select</option>-->
                      <option value="-1" selected>Select</option>
                      <?php
                        $curerncy_selected = isset($state_select) ? $state_select : $city_data['state_id'];
                        if (isset($state_data) && !empty($state_data)) {
                            foreach ($state_data as $state) {
                                if (isset($curerncy_selected) && !empty($curerncy_selected) && $curerncy_selected == $state['state_id']) {
                                    echo '<option selected value = "' . $state['state_id'] . '" >' . $state['state_name'] . "</option>";
                                } else {
                                    if ($state['state_name'] != '') {
                                        echo '<option value = "' . $state['state_id'] . '" >' . $state['state_name'] . "</option>";
                                    }
                                }
                            }
                        }
                        ?>
                  </select>
                  <?php echo form_error('state_select', '<div class="control-label">', '</div>'); ?>
              </div>
          </div>
          <div class="col-md-6">
              <div class="form-group <?php
                                        if (form_error('city_name')) {
                                            echo 'has-error';
                                        }
                                        ?> ">
                  <label class="control-label">District Name</label><span class="mandatory"> *</span>
                  <input type="text" id="city_name" name="city_name" placeholder="Enter District Name" class="form-control text-uppercase" value="<?php echo set_value('city_name', isset($city_data['city_name']) ? $city_data['city_name'] : ''); ?>" maxlength="30" />
                  <?php echo form_error('city_name', '<div class="control-label">', '</div>'); ?>
              </div>
          </div>
          <div class="col-md-6">
              <div class="form-group <?php
                                        if (form_error('city_abbr')) {
                                            echo 'has-error';
                                        }
                                        ?> ">
                  <label class="control-label">District Abbreviation</label><span class="mandatory"> *</span>
                  <input type="text" id="city_abbr" name="city_abbr" placeholder="Enter District Abbreviation" class="form-control text-uppercase" value="<?php echo $city_data['city_abbr']; ?>" maxlength="15" />
                  <?php echo form_error('city_abbr', '<div class="control-label">', '</div>'); ?>
              </div>
          </div>

          <?php echo form_close(); ?>
      </div>
  </div>

  <script>
      $('#city_save').on('keyup keypress', function(e) {
          var keyCode = e.keyCode || e.which;
          if (keyCode === 13) {
              e.preventDefault();
              return false;
          }
      });
  </script>




  <script type="text/javascript">
      function toggle_edit_panel() {
          if ($('#city_add').is(":visible") == true) {
              $("#city_add").slideUp("slow", function() {
                  $("#city_add").hide();
              });
          }
      }

      function clear_controls() {
          $('#city_name').val('');
          $('#city_abbr').val('');
          $('#state_select').selectpicker('deselectAll');
      }
  </script>