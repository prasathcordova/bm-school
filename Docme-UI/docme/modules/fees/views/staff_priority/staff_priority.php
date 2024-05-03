<div class="wrapper wrapper-content animated fadeInRight" style="padding-top: 1px !important;padding-left: 0px !important;padding-right: 0px !important;">
    <div class="row" style="margin-left: -29px !important; margin-right: -30px !important;">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">

                    <!--                     <div class="image">
                                                                <img alt="image" class="img-responsive" src="<?php echo $img1; ?>">
                                                            </div>-->
                    <h5><?php echo isset($sub_title) ? $sub_title : "NO TITLE PROVIDED" ?></h5>

                </div>
                <div class="ibox-content" id="faculty_loader">
                    <div class="sk-spinner sk-spinner-wave">
                        <div class="sk-rect1"></div>
                        <div class="sk-rect2"></div>
                        <div class="sk-rect3"></div>
                        <div class="sk-rect4"></div>
                        <div class="sk-rect5"></div>
                    </div>
                    <div class="clearfix"></div>

                    <div class="wrapper wrapper-content animated fadeInRight" id="student-data-container">

                        <div class="row" id="data-view-feecode">
                            <div class="ibox-content" id="item_list_detail">
                                <div class="row" id="">
                                    <div class="col-lg-6">
                                        <div class="ibox">

                                            <div class="ibox-title"> 
                                                PRIORITY CONFIGURATION                                            
                                            </div>
                                            <div class="ibox-content" style="height: 195px;"> 
                                                <div class="row">
                                                    <div class="col-lg-6">
                                                        <div class="form-group <?php
                                                        if (form_error('freqid')) {
                                                            echo 'has-error';
                                                        }
                                                        ?>">
                                                            <label>Staff Type</label><span class="mandatory" > *</span><br/>

                                                            <select name="freqid" id="freqid"  class="form-control " style="width:100%;"  >                                
                                                                <option selected value="-1">Select a Staff Type</option>
                                                                <option  value="1">Own Staff</option>
                                                                <option  value="2">Other Institution Staff</option>                                                                
                                                            </select>
                                                            <?php echo form_error('stream_id', '<div class="form-error">', '</div>'); ?>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-12 ">
                                                        <div class="form-group <?php
                                                        if (form_error('freqid')) {
                                                            echo 'has-error';
                                                        }
                                                        ?>">
                                                            <label>Priority</label><span class="mandatory" > *</span><br/>

                                                            <select name="freqid" id="freqid"  class="form-control " style="width:100%;"  >                                
                                                                <option selected value="-1">Select a Priority</option>
                                                                <option  value="1">1</option>
                                                                <option  value="1">2</option>
                                                                <option  value="1">3</option>
                                                                <option  value="1">4</option>
                                                                <option  value="1">5</option>
                                                                <option  value="1">6</option>
                                                                <option  value="1">7</option>
                                                                <option  value="1">8</option>
                                                                
                                                            </select>
                                                            <?php echo form_error('stream_id', '<div class="form-error">', '</div>'); ?>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="ibox">

                                            <div class="ibox-title"> 
                                                FEE STRUCTURE
                                                <!--<span class="label label-info pull-right">NEW</span>-->
                                                <!--                                                            <h4 class="label label-info pull-right">KIT ITEMS</h4>-->
                                            </div>
                                            <div class="ibox-content"> 
                                                <div class="table-responsive">
                                                    <div class="slimScrollDiv" style="position: relative; overflow: hidden; width: auto; height: 160px;"><div class="scroll_content" style="overflow: hidden; width: auto; height: 200px;">
                                                            <table class="table table-hover margin bottom">
                                                                <thead>
                                                                    <tr>
                        <!--                                                        <th style="width: 1%" class="text-center">No.</th>-->
                                                                        <th>FEE CODE</th>
                                                                        <th>DESCRIPTION</th>                                                                                                                                                                                    
                                                                        <th class="text-center">Task</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    <tr>
                                                                        <td>F001</td>
                                                                        <td>TUTION FEES</td>                                                
                                                                        <td class="text-center"><i class="fa fa-paper-plane"></i></td>

                                                                    </tr>                                                 
                                                                    <tr>
                                                                        <td>F002</td>
                                                                        <td>FEE 1</td>                                                
                                                                        <td class="text-center"><i class="fa fa-paper-plane"></i></td>

                                                                    </tr>                                                 
                                                                    <tr>
                                                                        <td>F003</td>
                                                                        <td>FEE 2</td>                                                
                                                                        <td class="text-center"><i class="fa fa-paper-plane"></i></td>

                                                                    </tr>                                                 



                                                                </tbody>
                                                            </table>
                                                        </div><div class="slimScrollBar" style="background: rgb(248, 172, 89); width: 7px; position: absolute; top: 0px; opacity: 0.4; display: none; border-radius: 7px; z-index: 99; right: 1px; height: 68.9655px;"></div><div class="slimScrollRail" style="width: 7px; height: 100%; position: absolute; top: 0px; display: none; border-radius: 7px; background: rgb(51, 51, 51); opacity: 0.2; z-index: 90; right: 1px;"></div></div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="clearfix"></div>
                                    <div class="col-lg-12">
                                        <div class="ibox">

                                            <div class="ibox-title"> 
                                                FEE DETAILS 
                                                <span class="label label-info pull-right"><i class="fa fa-floppy-o" style="font-size:19px;"></i></span>

<!--                                                 <span class="ibox-tools" id="add_type">
<a data-toggle="modal" class="btn btn-primary btn-xs" data-toggle="tooltip" title="Demand Fees" data-placement="left"href="javascript:void(0);" onclick="add_new_currency();" ><i class="fa fa-floppy-o" style="font-size:13px;"></i></a>
</span>-->
                                            </div>

                                            <div class="ibox-content"> 
                                                <div class="table-responsive">
                                                    <div class="slimScrollDiv" style="position: relative; overflow: hidden; width: auto; height: 160px;"><div class="scroll_content" style="overflow: hidden; width: auto; height: 200px;">
                                                            <table class="table table-hover margin bottom">
                                                                <thead>
                                                                    <tr>
                        <!--                                                        <th style="width: 1%" class="text-center">No.</th>-->
                                                                        <th>FEE CODE</th>
                                                                        <th>DESCRIPTION</th>                                                                                                                                                                                    
                                                                        <th class="text-center">Concession %</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    <tr>
                                                                        <td>F001</td>
                                                                        <td>TUTION FEES</td>                                                
                                                                        <td ><div class="form-group">
                                                            <div class="form-line"> 
                                                                <input type="text" placeholder="Enter Amount" id="sname" name="sname"class="form-control" style="">      
                                                            </div>                           
                                                        </div></td>

                                                                    </tr>                                                 
                                                                    <tr>
                                                                        <td>F002</td>
                                                                        <td>FEE 1</td>                                                
                                                                        <td ><div class="form-group">
                                                            <div class="form-line"> 
                                                                <input type="text" placeholder="Enter Amount" id="sname" name="sname"class="form-control" style="">      
                                                            </div>                           
                                                        </div></td>

                                                                    </tr>                                                 
                                                                    <tr>
                                                                        <td>F003</td>
                                                                        <td>FEE 2</td>                                                
                                                                        <td ><div class="form-group">
                                                            <div class="form-line"> 
                                                                <input type="text" placeholder="Enter Amount" id="sname" name="sname"class="form-control" style="">      
                                                            </div>                           
                                                        </div></td>

                                                                    </tr>                                                 



                                                                </tbody>
                                                            </table>
                                                        </div><div class="slimScrollBar" style="background: rgb(248, 172, 89); width: 7px; position: absolute; top: 0px; opacity: 0.4; display: none; border-radius: 7px; z-index: 99; right: 1px; height: 68.9655px;"></div><div class="slimScrollRail" style="width: 7px; height: 100%; position: absolute; top: 0px; display: none; border-radius: 7px; background: rgb(51, 51, 51); opacity: 0.2; z-index: 90; right: 1px;"></div></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>


                                </div>
                            </div>
                        </div>
                        <!--</div>-->
                    </div>
                    <!--</div>-->
                </div>
            </div>
        </div>
    </div>
</div>


<script type="text/javascript">
    $('#freqid').select2({
        'theme': 'bootstrap'
    });
    $('#monthid').select2({
        'theme': 'bootstrap'
    });
</script>