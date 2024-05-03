<div class="row clearfix" style="padding-bottom: 60px;" id="search_bar">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="card">

            <div class="ibox float-e-margins"> 
                <div class="ibox-title">
                    <h4><?php echo isset($title) ? $title : "NO TITLE PROVIDED" ?>
                    </h4>
                    <div class="ibox-tools">
                        <span><a href="javascript:void(0);" onclick="close_search();" > <i style="font-size: 30px !important; float: right; color: #E91E63; margin-top: -32px !important;" class="material-icons" data-toggle="tooltip" data-placement="right" title="Close" >close</i></a> </span>

                    </div>
                </div>
                <div class="ibox-content" style="text-align: left;"> 

                    <div class="clearfix">

                        <div class="row">
                            <div class="form-group col-lg-6 col-xs-12 col-md-12" style="margin-bottom: 5px;">
                                <div class="form-group">
                                    <label>Student Name :</label>
                                    <input id="name" placeholder="Search By Student Name" name="name" type="text" class="form-control input-sm ">
                                </div>
                            </div>
                            <div class="form-group col-lg-6 col-xs-12 col-md-12" style="margin-bottom: 5px;">
                                <div class="form-group">
                                    <label>Admission No. :</label>
                                    <input id="name" placeholder="Search By Admission No." name="name" type="text" class="form-control input-sm ">
                                </div>
                            </div>
                            <div class="form-group col-lg-6 col-xs-12 col-md-12" style="margin-bottom: 5px;">
                                <div class="form-group">
                                    <label>Father Name :</label>
                                    <input id="name" placeholder="Search By Father Name" name="name" type="text" class="form-control input-sm ">
                                </div>
                            </div>
                            <div class="form-group col-lg-6 col-xs-12 col-md-12" style="margin-bottom: 5px;">
                                <div class="form-group">
                                    <label>Mobile No :</label>
                                    <input id="name" placeholder="Search By Mobile No" name="name" type="text" class="form-control input-sm ">
                                </div>
                            </div>
                            <div class="form-group col-lg-6 col-xs-12 col-md-12" style="margin-bottom: 5px;">
                                <div class="form-group">
                                    <label>Email :</label>
                                    <input id="name" placeholder="Search By Email " name="name" type="text" class="form-control input-sm ">
                                </div>
                            </div>
                            <div class="form-group col-lg-6 col-xs-12 col-md-12" style="margin-bottom: 5px;">
                                <label>Class :</label>
                                <select class="select2_demo_3 form-control">
                                    <option value="1">lkg</option>
                                    <option value="1">1</option>
                                    <option value="1">2 </option>
                                </select>                
                            </div>       

                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
<script>
    $(".select2_demo_3").select2({
        "theme": "bootstrap",
        "width": "100%"
    });

    function close_search() {
        $("#search_bar").slideUp();


    }
</script>
