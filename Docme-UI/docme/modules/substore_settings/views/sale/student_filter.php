  <script src="<?php echo base_url('assets/theme/js/plugins/iCheck/icheck.min.js'); ?>"></script>
    <script src="<?php echo base_url('assets/theme/js/plugins/dataTables/datatables.min.js'); ?>"></script>	

<div class="wrapper wrapper-content animated fadeInRight" style="padding-top: 1px !important;padding-left: 0px !important;padding-right: 0px !important;">
    <div class="row" style="margin-left: -29px !important; margin-right: -30px !important;">
        <div class="col-lg-12">
            <div class=" animated fadeInRight">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="ibox">
                            <div class="ibox-title">
                                <h5><?php echo isset($sub_title) ? $sub_title : "NO TITLE PROVIDED" ?></h5>
                                <div class="ibox-tools" id="add_type">
                                </div>
                            </div>
                            <div class="ibox-content">
                                <!--<div class="row">-->

                                       <div class="table-responsive">
                                <!--<table class="table table-striped table-bordered table-hover dataTables-example" id="tbl_sale" >-->
 <table class="table table-striped table-bordered table-hover dataTables-example" >
                                    <thead>
                                        <tr>
                                            <th>Item Name</th>
                                            <th>Qty</th>                                
                                            <th>Action</th>  
                                        </tr>
                                    </thead>
                                    <tbody>
                                      
                                                <tr>
                                                    <td><?php echo "fd" ?></td>
                                                    <td>06</td>
                                                    <td><a href="javascript:void(0);" title="Edit"><i class="fa fa-pencil-square-o" aria-hidden="true"style="font-size: 24px; color: #23C6C8; margin: 2%; "></i></a>
                                                        <a href="javascript:void(0);" onclick="get_class();" data-toggle="tooltip" data-placement="right" title="Class" data-original-title="" id="confirm_109"><i class="fa fa-graduation-cap" style="font-size: 24px; color: #23C6C8; margin: 2%; "></i></a></td>
                                                </tr>
                                               
                                    </tbody>
                                </table>
                        </div>


                            </div>
                        </div>
                        
                        
                        <div class="ibox animated fadeInDown" id="class_list">
                            <div class="ibox-content">
                                <div class="row" style="padding:0 0 15px 0;">
                                    <div class="col-sm-6">
                                <select class="select2_demo_1 form-control">
                                <option value="1">Select Class</option>
                                <option value="2">Class 1</option>
                                </select></div>
                                        <div class="col-sm-6">
                                <a href="javascript:void(0);" onclick="class_list_close();" class="pull-right"> <i class="material-icons close" style="color:#E91E63; font-size:30px;opacity: 10;" data-toggle="tooltip" title="Close">close</i></a>
                                <a href="javascript:void(0);" onclick="();"> <i style="font-size: 30px !important;  float: right;color: #23c6c8;" class="material-icons">save</i></a>
                                </div>
                                </div>
                                <div class="row">
                                            <div class="col-lg-6 col-sm-6 col-xs-6">
                                                <div class="panel panel-info">
                                                    <div class="panel-heading">Students List <a href="#" data-toggle="tooltip" data-placement="top" title="Click here to move students to promote list" onclick="select_students_to_promote();" ><span class="glyphicon glyphicon-menu-right span-icon-2"></span><span class="glyphicon glyphicon-menu-right"></span></a><a href="#" data-toggle="tooltip" data-placement="top" title="Select All/ Deselect All" onclick="select_all_promotion();" ><i class="material-icons">select_all</i>
                                                        </a></div> 
                                                    <div class="panel-body" >
                                                        <div class="scrollerdata" id="to_promote">
    
                                                                    <div class="ibox-new student-block">
                                                                        <div class="stu-photo">
                                                                            <img src="http://10.10.5.172:90/docme/Docme-UI/assets/img/a4.jpg"/>
                                                                        </div>
                                                                        <div class="stu-details">
                                                                            <P>Name : <b>ggg</b></p>
                                                                            <P>Admin No : <b>ggg</b></p>
                                                                        </div>
                                                                        <div class="i-checks student-list"data-toggle="tooltip" data-placement="top" title="tooltip-text-here"><label> <input type="checkbox"> <i></i></label></div>
                                                                    </div>
                                                            
                                                                  <div class="ibox-new student-block">
                                                                        <div class="stu-photo">
                                                                            <img src="http://10.10.5.172:90/docme/Docme-UI/assets/img/a4.jpg"/>
                                                                        </div>
                                                                        <div class="stu-details">
                                                                            <P>Name : <b>ggg</b></p>
                                                                            <P>Admin No : <b>ggg</b></p>
                                                                        </div>
                                                                        <div class="i-checks student-list"data-toggle="tooltip" data-placement="top" title="tooltip-text-here"><label> <input type="checkbox"> <i></i></label></div>
                                                                    </div>
                                                            
                                                                    <div class="ibox-new student-block">
                                                                        <div class="stu-photo">
                                                                            <img src="http://10.10.5.172:90/docme/Docme-UI/assets/img/a4.jpg"/>
                                                                        </div>
                                                                        <div class="stu-details">
                                                                            <P>Name : <b>ggg</b></p>
                                                                            <P>Admin No : <b>ggg</b></p>
                                                                        </div>
                                                                        <div class="i-checks student-list"data-toggle="tooltip" data-placement="top" title="tooltip-text-here"><label> <input type="checkbox"> <i></i></label></div>
                                                                    </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                    
                                            <div class="col-lg-6 col-sm-6 col-xs-6">
                                                <div class="panel panel-info">
                                                    <div class="panel-heading">Students List <a href="#" data-toggle="tooltip" data-placement="top" title="Click here to move students to promote list" onclick="select_students_to_promote();" ><span class="glyphicon glyphicon-menu-left span-icon-2"></span><span class="glyphicon glyphicon-menu-left"></span></a><a href="#" data-toggle="tooltip" data-placement="top" title="Select All/ Deselect All" onclick="select_all_promotion();" ><i class="material-icons">select_all</i>
                                                        </a></div> 
                                                    <div class="panel-body" >
                                                        <div class="scrollerdata" id="to_promote">
    
                                                                    <div class="ibox-new student-block">
                                                                        <div class="stu-photo">
                                                                            <img src="http://10.10.5.172:90/docme/Docme-UI/assets/img/a4.jpg"/>
                                                                        </div>
                                                                        <div class="stu-details">
                                                                            <P>Name : <b>ggg</b></p>
                                                                            <P>Admin No : <b>ggg</b></p>
                                                                        </div>
                                                                        <div class="i-checks student-list"data-toggle="tooltip" data-placement="top" title="tooltip-text-here"><label> <input type="checkbox"> <i></i></label></div>
                                                                    </div>
                                                            
                                                                  <div class="ibox-new student-block">
                                                                        <div class="stu-photo">
                                                                            <img src="http://10.10.5.172:90/docme/Docme-UI/assets/img/a4.jpg"/>
                                                                        </div>
                                                                        <div class="stu-details">
                                                                            <P>Name : <b>ggg</b></p>
                                                                            <P>Admin No : <b>ggg</b></p>
                                                                        </div>
                                                                        <div class="i-checks student-list"data-toggle="tooltip" data-placement="top" title="tooltip-text-here"><label> <input type="checkbox"> <i></i></label></div>
                                                                    </div>
                                                            
                                                                    <div class="ibox-new student-block">
                                                                        <div class="stu-photo">
                                                                            <img src="http://10.10.5.172:90/docme/Docme-UI/assets/img/a4.jpg"/>
                                                                        </div>
                                                                        <div class="stu-details">
                                                                            <P>Name : <b>ggg</b></p>
                                                                            <P>Admin No : <b>ggg</b></p>
                                                                        </div>
                                                                        <div class="i-checks student-list"data-toggle="tooltip" data-placement="top" title="tooltip-text-here"><label> <input type="checkbox"> <i></i></label></div>
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



<style>
    
        .ui-state-highlight { 
        background: #dbf6f6
    }    
    .ibox-title{border-bottom:solid 2px #F3F3F4 !important}  
    .panel-info > .panel-heading{font-size:16px;}
    .panel-info > .panel-heading a{float:right; color:#fff; margin:0 0 0 20px; position:relative;}


    .span-icon-2{position:absolute;right:9px;top:2px;}


    .panel-info > .panel-heading a i{font-size:22px;}
    .panel-info > .panel-heading a:hover{opacity:0.8;}
    .ibox-new{background:#fff;min-height:55px; border:solid 1px #EAEAEA; margin-bottom:15px;}
    .stu-photo{display:inline-block; width:55px; float:left; background:#14B6B8;}
    .stu-details{display:inline-block; padding:8px 10px;}
    .stu-details p{margin:0;}
    .stu-photo img{width:100%;}
    .i-checks{float:right;padding:0 10px;line-height:50px;}  
    .ibox-new-2{padding:15px !important;}

    .form-group-new input{border-radius:3px; border:none;}
    
    .product-imitation{color:#898989;padding:55px 0; margin:0 0 15px 0;}
    .top-pad{padding:15px 0 0 0;}
    .btn{margin:0 0 0 10px;}
    

    .transfer-list{margin:10px 0; position: relative;}
    .ibox-new{margin:15px 0 0 0; border:solid 2px #F3F3F4;}
    a .ibox-new{color:#676a6c}
        a .ibox-new:hover{border:solid 2px #23C6C8;}
        a .ibox-new .ibox-title{background:#F3F3F4}
        a .ibox-new:hover .ibox-title{background:#23C6C8 !important; color:#fff;}
        
        #class_list{display:none;}

</style>


<script>
            $('.i-checks').iCheck({
                checkboxClass: 'icheckbox_square-green',
                radioClass: 'iradio_square-green'
            });
              $('.scroll_content').slimscroll({
             height: '300px'
             })
             
                 $('.scrollerdata').slimscroll({
        height: '250px'
    });

</script>

<script type="text/javascript">
$('document').ready(function(){
$('#class_list').css("display","none");

});



function get_class(){
    var element = document.getElementById("class_list");
    
$('#class_list').css("display","block");
//#Detail_pack{display:block;}
}

function class_list_close(){
    var element = document.getElementById("class_list");
    
$('#class_list').css("display","none");
//#Detail_pack{display:block;}
}





</script>


<script>
 $(document).ready(function(){
            $('.dataTables-example').DataTable({
                pageLength: 25,
                responsive: true,
                dom: '<"html5buttons"B>lTfgitp',
                buttons: [
                    { extend: 'copy'},
                    {extend: 'csv'},
                    {extend: 'excel', title: 'ExampleFile'},
                    {extend: 'pdf', title: 'ExampleFile'},

                    {extend: 'print',
                     customize: function (win){
                            $(win.document.body).addClass('white-bg');
                            $(win.document.body).css('font-size', '10px');

                            $(win.document.body).find('table')
                                    .addClass('compact')
                                    .css('font-size', 'inherit');
                    }
                    }
                ]

            });

        });  

</script>

<script type="text/javascript">


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


    // Add slimscroll to element
    $('.scroll_content').slimscroll({
        height: '415px'
    })

    $('.scroll_content-3').slimscroll({
        height: '380px'
    })

    $('.scroll_content-2').slimscroll({
        height: '405px'
    })

    $(".select2_demo_1").select2({
        "theme": "bootstrap",
        "width": "100%"

    });

       


</script>