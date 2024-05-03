<div class="row" id="">
    <div class="panel panel-info">
        <div class="panel-heading">
            <i class="fa fa-info-circle" style="padding-right:10px;"></i>Data migration RIMS to DOCME
        <a href="javascript:void(0)" onclick="load_fee_student();" id="close_button" data-toggle="tooltip" title="Close" style="float: right; color: #B22222;"><i class="fa fa-close"></i></a>
        </div>
        <div class="panel-body">
        <h3 id="advanced_search_h">THE NEW INDIAN MODEL SCHOOL DUBAI<hr></h3>

        <div id="advanced_search" class="row">
            <div class="row">
                <div class="form-group " style="padding-left: 30px;padding-right: 30px;">
                    <label>Table to Migrate Data</label>
                    <div>
                        <select class="select2_registration form-control" id="NameofBank" name="NameofBank" placeholder="Select a bank" style="width:100%;">                            
                            <?php
                            if (isset($data_port_data) && !empty($data_port_data)) {
                                echo '<option selected value="-1">Select a table to migrate</option>';
                                foreach ($data_port_data as $port) {
                                    echo '<option value="' . $port['id'] . '">' . $port['type_name'] . '</option>';
                                }
                            }
                            ?>     
                        </select>
                    </div>
                 </div>
                <hr>
                <a class="btn btn-info" id="cash_pay_btn" style="margin-left:30px;" href="javascript:void(0);" onclick="pay_amount_data(1);">
                    <i class="fa fa-money">
                        Sync Data to Docme
                    </i>
                </a>
            </div>
        </div>


<script type="text/javascript">
    


</script>