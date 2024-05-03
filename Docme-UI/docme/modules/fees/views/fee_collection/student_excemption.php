<div class="wrapper wrapper-content animated fadeInRight" style="padding-top: 1px !important;padding-left: 0px !important;padding-right: 0px !important;">
    <div class="row" style="margin-left: -29px !important; margin-right: -30px !important;">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title"style="border-bottom-color:#ffd300 !important;">
                     <?php  
//    $search_image = base_url('assets/img/searchicon.jpg');
//    $advancedsearch = base_url('assets/img/advancedsearch.jpg');
      $student_img = base_url('assets/img/a8.jpg');
      $exemp_img = base_url('assets/img/Exempt.jpg');
    ?>
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
 <div class="row m-b-sm m-t-sm" id="search-feecode">
                              
                               
                            </div>
                        <div class="wrapper wrapper-content animated fadeInRight" id="student-data-container">
 <div class="ibox-tools" id="add_type">
                            <a data-toggle="modal" class="btn btn-primary btn-xs" data-toggle="tooltip" title="submit fee excemption" data-placement="left"href="javascript:void(0)" onclick="add_new_template();">Submit fee Excemption</a>
                        </div>
                    <div class="row">
                         <div class="col-md-6">

                    <div class="profile-image">
                        <img src="<?php echo $student_img; ?>" class="img-circle circle-border m-b-md" alt="profile">
                    </div>
                    <div class="profile-info">
                        <div class="">
                            <div>
                                <h2 class="no-margins">
                                   <!--Adiba Aktar Eva Ibrahim-->
                                </h2>
                                <h4> Adiba Aktar Eva Ibrahim</h4>
                                <!--<h4>40153/17</h4>-->
                                <small>
                                   
                                 Admission No. :  40153/17
                                </small><br>
                                <small>
                                   
                                 Batch :  KG1/A/CBS/FN/ENG/2017-18
                                </small><br>
                                <small>
                                    Class : KGI
                                </small>

                            </div>
                            
                        </div>
                        
                    </div>
                             
                         </div>
                                         
                      
                        <div class="row" style="padding-top: 220px!important;">
                        <div class="col-lg-12">
                            <div id="curd-content" style="display: none;"></div>
                        </div>
                              
                        <div class="col-lg-12">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover dataTables-example" id="tbl_feeexcemption" >

                                    
                                    <thead>
                                        <tr>
                                            <th>Date</th>
                                            <th>Month</th>
                                            <th>Fee Due </th>
                                            <th>Amount</th>                                
                                            <th>Action</th>                                
                                            <!--<th>Task</th>-->                           
                                        </tr>
                                    </thead>
                                    <tbody>
                                      
                                                <tr>
                                                    <td> <?php echo '02.06.2018'; ?></td>
                                                    <td> <?php echo 'JUNE'; ?></td>
                                                    <td> <?php echo '5456'; ?></td>
                                                    <td><?php echo ' hfghg'; ?></td>                                                    
                                                    <!--<td><?php echo ' hfghg'; ?></td>-->                                                    
                                                    <td>
                                                        <a href="javascript:void(0);" onclick="edit_country('<?php // echo $country['country_id']; ?>', '<?php // echo $country['country_name']; ?>', '<?php // echo $country['country_abbr']; ?>', '<?php // echo $country['country_nation']; ?>', '<?php // echo $country['currency_name']; ?>');"  data-toggle="tooltip" data-placement="right" title="Edit <?php // echo $country['country_name']; ?>" data-original-title="<?php // echo $country['country_name']; ?>"  ><i class="fa fa-pencil" style="font-size: 24px; color: #23C6C5; margin: 2%; "></i></a>                                                       
                                                    </td>
                                                </tr>
                                                
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                        
                        <div class="col-lg-12">
               
                            
                        <textarea class="form-control" style="height: 120px;width:780px;"placeholder="Write comment..."></textarea>
                           
                        

                    </div>
                <!--</div>-->
            </div>
                        
<!--<div class="row">-->
    
                                <?php
                                $breaker = 0;
//                                if (isset($feedback_subject_data) && !empty($feedback_subject_data)) {
//                                    foreach ($feedback_subject_data as $subject_data) {
                                        ?>
                                        <div class="col-lg-12">
                            <div id="curd-content" style="display: none;"></div>
                            <div class="ibox-content">

                        <div>
                
                </div>
                       
                </div>
                            
                        </div>
                                        <?php
                                        if ($breaker == 3) {
                                            echo '<div class="clearfix"></div>';
                                            $breaker = 0;
                                        } else {
                                            $breaker ++;
                                        }
//                                    }
//                                }
                                ?>
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
    var list_switchery = [];
    var table = $('#tbl_feeexcemption').dataTable({

        columnDefs: [
            {"width": "20%", className: "capitalize", "targets": 0},
            {"width": "20%", className: "capitalize", "targets": 1},
            {"width": "20%", className: "capitalize", "targets": 2},
            {"width": "20%", className: "capitalize", "targets": 3},
            {"width": "20%", className: "capitalize", "targets": 4},
//            {"width": "20%", className: "capitalize", "targets": 5, "orderable": false}
        ],
        responsive: true,
        stateSave: true,
        iDisplayLength: 10,
        dom: '<"html5buttons"B>lTfgitp',
        buttons: [
            {extend: 'copy'},
            {extend: 'csv', exportOptions: {
                    columns: [0, 1, 2, 3]
                }},
            {extend: 'excel', title: 'Report', exportOptions: {
                    columns: [0, 1, 2, 3]
                }}
        ],
        "fnDrawCallback": function (ele) {
            activateSwitchery();
        },
        
    });
    $('#tbl_country tbody').on('click', function (e) {
        activateSwitchery()
    });

    $(document).ready(function () {
        activateSwitchery();

    });

   
  


       

    function close_add_country() {
        $('#search-feecode').show();
        $('#add_type').show();
        $("#curd-content").slideUp("slow", function () {
            $("#curd-content").hide();
        });

    }

//NEW SCRIPT
    function add_new_fee_type() {
        var ops_url = baseurl + 'fees/add-feetype';
        $.ajax({
            type: "POST",
            cache: false,
            async: false,
            url: ops_url,
            data: {"load": 1},
            success: function (data) {
                if (data) {
                    $('#curd-content').html(data);
                    var animation = "fadeInDown";
                    $('#search-feecode').hide();
                    $("#curd-content").show();
                    $('#curd-content').addClass('animated');
                    $('#curd-content').addClass(animation);
                    $('#add_type').hide();
                    $('#month_span_select').select2({
                        'theme': 'bootstrap'
                    });
                    $('#payment_mode_select').select2({
                        'theme': 'bootstrap'
                    });
                    $('#feetype_select').select2({
                        'theme': 'bootstrap'
                    });
                } else {
                    alert('No data loaded');
                }
            }
        });
    }

 $('.i-checks').iCheck({
        checkboxClass: 'icheckbox_square-green',
        radioClass: 'iradio_square-green'
    });



</script>