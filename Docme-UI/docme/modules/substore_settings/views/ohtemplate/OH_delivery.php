<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10 col-md-8 col-sm-8 col-xs-12">
        <h2 style="font-size: 20px;">
            <?php echo isset($title) ? $title : "NO TITLE PROVIDED" ?>
        </h2>
        <ol class="breadcrumb">
            <?php
            if (isset($bread_crump_data) && !empty($bread_crump_data)) {
                echo $bread_crump_data;
            }
            // dev_export($subject_data);die;
            ?>
        </ol>        
    </div>    
</div>
<div class="wrapper wrapper-content animated fadeInRight" style="padding-top: 1px !important;padding-left: 0px !important;padding-right: 0px !important;">
    <div class="row" style="margin-left: -29px !important; margin-right: -30px !important;">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title" style="    padding: 10px 15px 7px;">
                    <h5><?php echo isset($sub_title) ? $sub_title : "NO TITLE PROVIDED" ?></h5>
                    <div class="ibox-tools" id="add_type">
                        <span><a href="javascript:void(0);"  onclick="();" > <i style="font-size: 35px !important;  float: right;color: #23c6c8;" class="material-icons">save</i></a> </span>

                    </div>
                </div>
                <div class="ibox-content">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="row">
                                <div class="form-group col-lg-6 col-xs-12 col-md-12">
                                    <label>Student Name:</label>
                                    <input id="surname" name="surname" placeholder="Student Name " type="text" class="form-control  input-sm">
                                </div>

                                <div class="form-group col-lg-6 col-xs-12 col-md-12">
                                    <label>Admission Number  :</label>
                                    <input id="surname" name="surname" placeholder="Admission Number" type="text" class="form-control  input-sm">
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-lg-6 col-xs-12 col-md-12">
                                    <label>Class :</label>
                                    <input id="surname" name="surname" placeholder="Class  " type="text" class="form-control  input-sm">
                                </div>

                                <div class="form-group col-lg-6 col-xs-12 col-md-12">
                                    <label> OH Kit Batch  :</label>
                                    <input id="surname" name="surname" placeholder="OH Kit Batch " type="text" class="form-control  input-sm">
                                </div>
                            </div>

                            <br>
                            <br>
                            <div class="row " >
                                <div class="col-lg-8 col-xs-12 col-md-12">

                                    <div class="ibox "style="padding: 2%">
                                        <br>
                                        <br>
                                        <div class="row">  

                                            <div class="col-lg-4 col-xs-12 col-md-12">
                                                <div class="ibox">
                                                    <div class="widget style1  " class="learn-more">
                                                        <b>Item Type :   </b><br><br>
                                                        <b>Item Code :  </b><br><br>
                                                        <b>Quantity  :  </b><br><br>
                                                        <div class="checkbox checkbox-success checkbox-inline">
                                                            <input type="checkbox" id="inlineCheckbox2" value="option1" checked="Checked">
                                                            <label for="inlineCheckbox2">  Delivered </label>
                                                        </div>                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-4 col-xs-12 col-md-12">

                                                <div class="ibox">
                                                    <div class="widget style1  " class="learn-more">
                                                        <b>Item Type :   </b><br><br>
                                                        <b>Item Code :  </b><br><br>
                                                        <b>Quantity  :  </b><br><br>
                                                        <div class="checkbox checkbox-success checkbox-inline">
                                                            <input type="checkbox" id="inlineCheckbox2" value="option1" checked="Checked">
                                                            <label for="inlineCheckbox2"> Delivered  </label>
                                                        </div>                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-4 col-xs-12 col-md-12">

                                                <div class="ibox">
                                                    <div class="widget style1  " class="learn-more">
                                                        <b>Item Type :   </b><br><br>
                                                        <b>Item Code :  </b><br><br>
                                                        <b>Quantity  :  </b><br><br>
                                                        <div class="checkbox checkbox-success checkbox-inline">
                                                            <input type="checkbox" id="inlineCheckbox2" value="option1" checked="Checked">
                                                            <label for="inlineCheckbox2"> Delivered  </label>
                                                        </div>                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-4 col-xs-12 col-md-12">
                                                <div class="ibox">
                                                    <div class="widget style1  " class="learn-more">
                                                        <b>Item Type :   </b><br><br>
                                                        <b>Item Code :  </b><br><br>
                                                        <b>Quantity  :  </b><br><br>
                                                        <div class="checkbox checkbox-success checkbox-inline">
                                                            <input type="checkbox" id="inlineCheckbox2" value="option1" checked="Checked">
                                                            <label for="inlineCheckbox2"> Delivered  </label>
                                                        </div>                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-4 col-xs-12 col-md-12">
                                                <div class="ibox">
                                                    <div class="widget style1  " class="learn-more">
                                                        <b>Item Type :   </b><br><br>
                                                        <b>Item Code :  </b><br><br>
                                                        <b>Quantity  :  </b><br><br>
                                                        <div class="checkbox checkbox-success checkbox-inline">
                                                            <input type="checkbox" id="inlineCheckbox2" value="option1" checked="Checked">
                                                            <label for="inlineCheckbox2"> Delivered  </label>
                                                        </div>                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-4 col-xs-12 col-md-12">
                                                <div class="ibox">
                                                    <div class="widget style1  " class="learn-more">
                                                        <b>Item Type :   </b><br><br>
                                                        <b>Item Code :  </b><br><br>
                                                        <b>Quantity  :  </b><br><br>
                                                        <div class="checkbox checkbox-success checkbox-inline">
                                                            <input type="checkbox" id="inlineCheckbox2" value="option1" checked="Checked">
                                                            <label for="inlineCheckbox2"> Delivered  </label>
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-xs-12 col-md-12 ">
                                    <div class="ibox" style="min-height: 450px">
                                        <div style="padding: 28%" >
                                        </div>

                                        <div class="row" style="padding: 10px;  padding-top: 0.1px">
                                            <div class="col-lg-12 col-xs-12 col-md-12" >
                                                <div class="form-group">
                                                    <div class="col-lg-5 col-xs-12 col-md-12" style="padding: 3px" >
                                                        <label for="title"> Total delivery Quantity :</label>
                                                    </div>
                                                    <div class="col-lg-7 col-xs-12 col-md-12" style="padding-left:1px" >
                                                        <input id="title" type="text" class="form-control" placeholder="" class="input-sm" />
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row" style="padding: 10px;  padding-top: 0.1px">
                                            <div class="col-lg-12 col-xs-12 col-md-12" >
                                                <div class="form-group">
                                                    <div class="col-lg-5 col-xs-12 col-md-12" style="padding: 3px" >
                                                        <label for="title">Total delivery Price :</label>
                                                    </div>
                                                    <div class="col-lg-7 col-xs-12 col-md-12" style="padding-left:1px" >
                                                        <input id="title" type="text" class="form-control" placeholder="" class="input-sm" />
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        
                                    </div>
                                </div> 
                            </div> 

                            </body>
                            </html>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>



<script type="text/javascript">



</script>

