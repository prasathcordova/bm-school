<div class="row clearfix" style="padding-bottom: 60px;">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="card">
            <div class="header">
                <h2 style="padding-bottom: 10px;font-size: 16px;"><?php echo isset($title) ? $title : "NEW ITEM" ?>
                    <span><a href="javascript:void(0);"  onclick="close_add_details();" > <i style="font-size: 30px !important; float: right; color: #E91E63;" class="material-icons">close</i></a> </span>
                    <span><a href="javascript:void(0);"  onclick="submit_data();" > <i style="font-size: 30px !important; float: right; color: #4CAF50; padding-right: 10px;" class="material-icons">save</i></a> </span>
                    <span><a href="javascript:void(0);" onclick="refresh_add_panel();"> <i style="font-size: 30px !important; float: right; color: #2196F3; padding-right: 10px;" class="material-icons ">refresh</i></a> </span>
                </h2>
            </div>
              <div class="row">
                        <div class="form-group col-lg-6 col-xs-12 col-md-12">
                            <label>Item Code:</label>
                            <input id="surname" name="surname" placeholder="Item Code" type="text" class="form-control  input-sm">
                        </div>
                        <div class="form-group col-lg-6 col-xs-12 col-md-12">
                            <label>Item Name:</label>
                            <input id="surname" name="surname" placeholder="Item name" type="text" class="form-control  input-sm">
                        </div>
                    </div>
                  <div class="row" style="padding:0%">
                        <div class="form-group col-lg-6 col-xs-12 col-md-12" >
                                   <label>Item Type:</label>
                                    <select class="select2_demo_6 form-control">
                                        <option></option>

                                        <option value="1">Option 1</option>
                                        <option value="2">Option 2</option>
                                        <option value="3">Option 3</option>
                                        <option value="4">Option 4</option>
                                        <option value="5">Option 5</option>
                                    </select>
                                </div>

                                <div class="form-group col-lg-6 col-xs-12 col-md-12">
                                   <label>Publisher:</label>
                                    <select class="select2_demo_5 form-control">
                                        <option></option>

                                      <option value="1">Option 1</option>
                                        <option value="2">Option 2</option>
                                        <option value="3">Option 3</option>
                                        <option value="4">Option 4</option>
                                        <option value="5">Option 5</option>
                                    </select>

                                </div>
                             
                            </div>
                    <div class="row">
                          <div class="form-group col-lg-6 col-xs-12 col-md-12" >
                                   <label>Category:</label>
                                    <select class="select2_demo_4 form-control">
                                        <option></option>

                                        <option value="1">Option 1</option>
                                        <option value="2">Option 2</option>
                                        <option value="3">Option 3</option>
                                        <option value="4">Option 4</option>
                                        <option value="5">Option 5</option>
                                    </select>
                                </div>
                       </div>
        </div>

    </div>
</div>
<script type="text/javascript">
  $(".select2_demo_1").select2({ "theme": "bootstrap",
          width: "100%", placeholder: "Select Item type"});
            $(".select2_demo_2").select2({ "theme": "bootstrap",
           width: "100%", placeholder: "Select publisher"});
            $(".select2_demo_3").select2({ "theme": "bootstrap",
           "width": "100%",width: "100%", placeholder: "Select category"});
            $(".select2_demo_4").select2({ "theme": "bootstrap",
           "width": "100%",width: "100%", placeholder: "Select category" });
            $(".select2_demo_5").select2({ "theme": "bootstrap",
           "width": "100%",width: "100%", placeholder: "Select publisher"});
            $(".select2_demo_6").select2({ "theme": "bootstrap",
           "width": "100%",width: "100%", placeholder: "Select Item type"});
            $(".select2_demo_7").select2({ "theme": "bootstrap",
           "width": "100%",width: "100%", placeholder: "Select a state"});
            </script>