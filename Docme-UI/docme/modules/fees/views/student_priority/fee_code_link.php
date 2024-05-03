<div class="row clearfix" style="padding-bottom: 60px;">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="card">
             <div class="header">
                <h2 style="padding-bottom: 10px;font-size: 16px;"><?php $title="Fee Codes List";echo isset($title) ? $title : "NO TITLE PROVIDED" ?>
                    <span><a href="javascript:void(0);"  onclick="close_add_country();" > <i style="font-size: 30px !important; float: right; color: #E91E63;" class="material-icons" data-toggle="tooltip" title="Close">close</i></a> </span>
                  
                </h2>
            </div>
<div class="row" id="data-view-feecode">
    <?php
    $breaker = 0;
    ?>
  
    <div class="row">
        <div class="col-lg-4" style="margin-left:13px;">          
                    <ul class="sortable-list connectList agile-list" id="todo">
                      
                        <li class="warning-element" id="task1">
                            Tution Fees for Class II Students.
                            <div class="agile-detail">                                
                               20% Fee Redemtion
                            </div>
                        </li>
                        
                                <li class="success-element" id="task2">
                                    Tution Fees for Class II Students.
                                    <div class="agile-detail">                                       
                                        20% Fee Redemtion
                                    </div>
                                </li>
                                
                                <li class="info-element" id="task3">
                                    Tution Fees for Class II Students.
                                    <div class="agile-detail">
                                        20% Fee Redemtion
                                    </div>
                                </li>
                                
                                <li class="danger-element" id="task4">
                                    Tution Fees for Class II Students.
                                    <div class="agile-detail">
                                       20% Fee Redemtion
                                    </div>
                                </li>
                               
                                <li class="warning-element" id="task5">
                                    Tution Fees for Class II Students.
                                    <div class="agile-detail">
                                       20% Fee Redemtion
                                    </div>
                                </li>
                                
                                <li class="warning-element" id="task6">
                                    Tution Fees for Class II Students.
                                    <div class="agile-detail">
                                        20% Fee Redemtion
                                    </div>
                                </li>
                                
                                <li class="success-element" id="task7">
                                    Tution Fees for Class II Students.
                                    <div class="agile-detail">
                                      20% Fee Redemtion
                                    </div>
                                </li>
                                
                                <li class="info-element" id="task8">
                                    Tution Fees for Class II Students.
                                    <div class="agile-detail">
                                      20% Fee Redemtion
                                    </div>
                                </li>
                                </ul>
                        </div>
           
        <div class="col-lg-4" style="padding-left:1px;">
               
                        <ul class="sortable-list connectList agile-list" id="inprogress">
                            
                            <li class="success-element" id="task9">
                                Tution Fees for Class II Students.
                                <div class="agile-detail">
                                   20% Fee Redemtion
                                </div>
                            </li>
                            
                            <li class="success-element" id="task10">
                                Tution Fees for Class II Students.
                                <div class="agile-detail">
                                   20% Fee Redemtion
                                </div>
                            </li>
                            
                            <li class="warning-element" id="task11">
                                Tution Fees for Class II Students.
                                <div class="agile-detail">
                                    20% Fee Redemtion
                                </div>
                            </li>
                            
                            <li class="warning-element" id="task12">
                                Tution Fees for Class II Students.
                                <div class="agile-detail">
                                   20% Fee Redemtion
                                </div>
                            </li>
                            
                            <li class="info-element" id="task13">
                                Tution Fees for Class II Students.
                                <div class="agile-detail">
                                   20% Fee Redemtion
                                </div>
                            </li>
                            
                            <li class="success-element" id="task14">
                                Tution Fees for Class II Students.
                                <div class="agile-detail">
                                   20% Fee Redemtion
                                </div>
                            </li>
                            
                            <li class="danger-element" id="task15">
                                Tution Fees for Class II Students.
                                <div class="agile-detail">
                                   20% Fee Redemtion
                                </div>
                            </li>
                        </ul>
                    </div>
              
        <div class="col-lg-4"style="margin-left: -16px;width:225 !important;">
            
                        <ul class="sortable-list connectList agile-list" id="inprogress">
                            
                            <li class="success-element" id="task9">
                                Tution Fees for Class II Students.
                                <div class="agile-detail">
                                  20% Fee Redemtion
                                </div>
                            </li>
                            
                            <li class="success-element" id="task10">
                                Tution Fees for Class II Students.
                                <div class="agile-detail">
                                    20% Fee Redemtion
                                </div>
                            </li>
                            
                            <li class="warning-element" id="task11">
                                Tution Fees for Class II Students.
                                <div class="agile-detail">
                                  20% Fee Redemtion
                                </div>
                            </li>
                            
                            <li class="warning-element" id="task12">
                                Tution Fees for Class II Students.
                                <div class="agile-detail">
                                  20% Fee Redemtion
                                </div>
                            </li>
                            
                            <li class="info-element" id="task13">
                                Tution Fees for Class II Students.
                                <div class="agile-detail">
                                   20% Fee Redemtion
                                </div>
                            </li>
                            
                            <li class="success-element" id="task14">
                                Tution Fees for Class II Students.
                                <div class="agile-detail">
                                   20% Fee Redemtion
                                </div>
                            </li>
                            
                            <li class="danger-element" id="task15">
                                Tution Fees for Class II Students.
                                <div class="agile-detail">
                                   20% Fee Redemtion
                                </div>
                            </li>
                        </ul>
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
</div>
</div>
</div>

<script type="text/javascript">

    $('.i-checks').iCheck({
        checkboxClass: 'icheckbox_square-green',
        radioClass: 'iradio_square-green'
    });



    function edit_demand_frequency() {
        var ops_url = baseurl + 'fees/edit-feedemandfrequency/';
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

    function close_add_country() {
        $('#search-feecode').show();
        $('#add_type').show();
        $("#curd-content").slideUp("slow", function () {
            $("#curd-content").hide();
        });

    }

//NEW SCRIPT
    function link_fee_code() {
        var ops_url = baseurl + 'fees/link-fees-code/';
        $.ajax({
            type: "POST",
            cache: false,
            async: false,
            url: ops_url,
            data: {"load": 1},
            success: function (result) {
                $('#data-view-feecode').html(result);
            }
        });

    }






</script>