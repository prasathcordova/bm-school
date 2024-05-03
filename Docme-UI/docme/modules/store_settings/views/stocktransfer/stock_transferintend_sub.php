<div class="wrapper wrapper-content animated fadeInRight" style="padding-top: 1px !important;padding-left: 0px !important;padding-right: 0px !important;">
    <div class="row" style="margin-left: -29px !important; margin-right: -30px !important;">
        <div class="col-lg-12">
            <div class="wrapper wrapper-content  animated fadeInRight" style="padding-top: 0px;">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="ibox">
                            <div class="ibox-title">
                                <h5><?php echo isset($sub_title) ? $sub_title : "NO TITLE PROVIDED" ?></h5>
                                <div class="ibox-tools" id="add_type">
                                    <span><a href="javascript:void(0);"  onclick="();" > <i style="font-size: 35px !important;  float: right;color: #23c6c8;" class="material-icons">save</i></a> </span>
                                </div>
                            </div>
                            <div class="ibox-content">
                                <div class="row">
                                    <!--<div class="row">-->
                                    <div class="col-lg-4 col-xs-12 col-md-12">
                                        <div class="form-group ">
                                            <label>Source :</label>
                                            <select class="select2_demo_1 form-control">
                                                <option value="1">NIMS DXB</option>
                                                <option value="2">CENTRAL</option>
                                                <option value="2">SHARJAH</option>
                                                <option value="2">ALAIN</option>
                                                <option value="2">ABUDHABI</option>
                                                
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-xs-12 col-md-12">
                                        <div class="form-group ">
                                            <label>Destination :</label>
                                            <select class="select2_demo_1 form-control">
                                                <option value="1">MAIN STORE</option>  
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-xs-12 col-md-12">

                                        <div class="form-group" id="data_1">
                                            <label class="font-noraml">  Transfer Date :</label>
                                            <div class="input-group date">
                                                <span class="input-group-addon"><i class="fa fa-calendar"></i></span><input type="text" class="form-control" value="03/04/2014">
                                            </div>
                                        </div>
                                    </div>
                                    <!--</div>-->
                                 
                                </div>
                                
                                <div class="row " >
                                <div class="col-lg-8">

                                    <div class="ibox purchase-sec">
                                      <div class="scroll_content">
                                        <div class=" input-group">
                                            <input type="text" placeholder="Search Item code / Item " class="input form-control">
                                            <span class="input-group-btn">
                                                <button type="button" class="btn btn btn-primary"> <i class="fa fa-search"></i></button>
                                            </span>
                                        </div>
                                        <div class="row row-new">  

                                            <div class="col-lg-4 col-rt-pa-none">
                                                <div class="purchase-list">
                                                    <div class="widget style1  "onclick="toggleVisibility('Menu1');" class="learn-more">
                                                        <b> Item Type :</b>
                                                        <b> Item Code :</b>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-4 col-rt-pa-none">
                                                <div class="purchase-list">
                                                    <div class="widget style1 " onclick="toggleVisibility('Menu2');" class="learn-more" >
                                                        <b> Item Type :</b>
                                                        <b> Item Code :</b>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-4 col-rt-pa-none">
                                                <div class="purchase-list">
                                                    <div class="widget style1  "onclick="toggleVisibility('Menu3');" class="learn-more" >
                                                        <b> Item Type :</b>
                                                        <b> Item Code :</b>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row row-new">
                                            <div class="col-lg-4 col-rt-pa-none">
                                                <div class="purchase-list">
                                                    <div class="widget style1 " onclick="toggleVisibility('Menu4');" class="learn-more" >
                                                        <b> Item Type :</b>
                                                        <b> Item Code :</b>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-4 col-rt-pa-none">
                                                <div class="purchase-list">
                                                    <div class="widget style1  "onclick="toggleVisibility('Menu5');" class="learn-more" >
                                                        <b> Item Type :</b>
                                                        <b> Item Code :</b>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-4 col-rt-pa-none">
                                                <div class="purchase-list">


                                                    <div class="widget style1 " onclick="toggleVisibility('Menu6');" class="learn-more" >
                                                        <b> Item Type :</b>
                                                        <b> Item Code :</b>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                        
                            <div class="row">
                                <div class="form-group col-lg-4 col-xs-12 col-md-12">
                                    <label> Transfer Note :</label>
                                    <input id="surname" name="surname" placeholder="Transfer Note" type="text" class="form-control  input-sm">
                                </div>
                                <div class="form-group col-lg-4 col-xs-12 col-md-12">
                                    <label>Transfer Quantity :</label>
                                    <input id="surname" name="surname" placeholder="Transfer Quantity" type="text" class="form-control  input-sm">
                                </div>
                                <div class="form-group col-lg-4 col-xs-12 col-md-12">
                                    <label>Total Transfer Value :</label>
                                    <input id="surname" name="surname" placeholder="Total Transfer Value" type="text" class="form-control  input-sm">
                                </div>
                            </div> 
                                </div>

                                </div>

                                <div class="col-lg-4">
                                    <div class="ibox" style="min-height:343px">
                                        <div class="transfer-head">
                                            <h2>Transfer Item</h2>
                                        </div>
                                        <div class="scroll_content">
                                                <div class="inner_div">
                                                    <div id="Menu1" style="display: none;">

                                                        <div class="transfer-list">
                                                            <div class="widget style1 "  >
                                                                <b> Item Type :</b>
                                                                <b> Item Code :</b>
                                                                <b>Price : </b>
                                                              <div class="form-group">
                                                              <label for="title">Quantity:</label>
                                                             <input id="title" class="form-control" placeholder="" type="text">
                                                           </div>
                                                            </div>
                                                        </div>  
                                                    </div>
                                                    <div id="Menu2" style="display: none;">
                                                        <div class="transfer-list">
                                                            <div class="widget style1 "  >
                                                                <b> Item Type :</b>
                                                                <b> Item Code :</b>
                                                                <b>Price : </b>
                                                              <div class="form-group">
                                                              <label for="title">Quantity:</label>
                                                             <input id="title" class="form-control" placeholder="" type="text">
                                                           </div>
                                                            </div>
                                                        </div>  
                                                    </div>
                                                    <div id="Menu3" style="display: none;">
                                                        <div class="transfer-list">
                                                            <div class="widget style1 "  >
                                                                <b> Item Type :</b>
                                                                <b> Item Code :</b>
                                                                <b>Price : </b>
                                                              <div class="form-group">
                                                              <label for="title">Quantity:</label>
                                                             <input id="title" class="form-control" placeholder="" type="text">
                                                           </div>
                                                            </div>
                                                        </div>  
                                                    </div>

                                                    <div id="Menu4" style="display: none;">
                                                        <div class="transfer-list">
                                                            <div class="widget style1 "  >
                                                                <b> Item Type :</b>
                                                                <b> Item Code :</b>
                                                                <b>Price : </b>
                                                              <div class="form-group">
                                                              <label for="title">Quantity:</label>
                                                             <input id="title" class="form-control" placeholder="" type="text">
                                                           </div>
                                                            </div>
                                                        </div>  
                                                    </div>

                                                    <div id="Menu5" style="display: none;">
                                                        <div class="transfer-list">
                                                            <div class="widget style1 "  >
                                                                <b> Item Type :</b>
                                                                <b> Item Code :</b>
                                                                <b>Price : </b>
                                                              <div class="form-group">
                                                              <label for="title">Quantity:</label>
                                                             <input id="title" class="form-control" placeholder="" type="text">
                                                           </div>
                                                            </div>
                                                        </div>   
                                                    </div>
                                                    <div id="Menu6" style="display: none;">
                                                        <div class="transfer-list">
                                                            <div class="widget style1 "  >
                                                                <b> Item Type :</b>
                                                                <b> Item Code :</b>
                                                                <b>Price : </b>
                                                              <div class="form-group">
                                                              <label for="title">Quantity:</label>
                                                             <input id="title" class="form-control" placeholder="" type="text">
                                                           </div>
                                                            </div>
                                                        </div>  
                                                    </div>
                                                </div>
                                        </div>

                                    </div> 
                                </div> 
                            </div> 
                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>





<!-- Chosen -->

<script type="text/javascript">

                                        $(document).ready(function () {

                                            // Add slimscroll to element
                                            $('.scroll_content').slimscroll({
                                                height: '250px'
                                            })
                                            $(".select2_demo_1").select2({
                                                "theme": "bootstrap",
                                                "width": "100%"

                                            });

                                            $('#data_1 .input-group.date').datepicker({
                                                todayBtn: "linked",
                                                keyboardNavigation: false,
                                                forceParse: false,
                                                calendarWeeks: true,
                                                autoclose: true
                                            });


                                        });
                                        
       var divs = ["Menu1", "Menu2", "Menu3", "Menu4", "Menu5", "Menu6"];
        var visibleDivId = null;
        function toggleVisibility(divId) {
            if (visibleDivId === divId) {
                //visibleDivId = null;
            } else {
                visibleDivId = divId;
            }
            hideNonVisibleDivs();
        }
        function hideNonVisibleDivs() {
            var i, divId, div;
            for (i = 0; i < divs.length; i++) {
                divId = divs[i];
                div = document.getElementById(divId);
                if (visibleDivId === divId) {
                    div.style.display = "block";
                } else {
                    div.style.display = "none";
                }
            }
        }

</script>