<div class="wrapper wrapper-content animated fadeInRight" style="padding-top: 1px !important;padding-left: 0px !important;padding-right: 0px !important;">
    <div class="row" style="margin-left: -29px !important; margin-right: -30px !important;">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5><?php echo isset($sub_title) ? $sub_title : "NO TITLE PROVIDED" ?></h5>
                </div>
                <div class="ibox-content">
                    <div class="input-group" style="margin-bottom:26px">
                        <input type="text" id="search_template" name="search_template" placeholder="Search Template by name..." class="form-control alphanumeric max20">
                        <span class="input-group-btn">
                            <button type="button" id="button_id" class="btn btns btn-info" onclick="search_template();"> Search</button>

                        </span>
                    </div>
                    <div class=" animated fadeInRight" id="template_replace">
                        <?php
                        echo $this->load->view('templates_for_student_listing_search');
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<style>
    #iboxtitle_oh {
        border-bottom: solid 2px #23c6c8 !important;
    }

    .ibox-new-2 {
        padding: 15px !important;
    }

    .form-group-new input {
        border-radius: 3px;
        border: none;
    }

    .product-imitation {
        color: #898989;
        padding: 55px 0;
        margin: 0 0 15px 0;
    }

    .top-pad {
        padding: 15px 0 0 0;
    }

    .btns {
        margin: 0 0 0 10px;
    }

    .i-checks {
        position: absolute;
        right: 12px;
        top: 8px;
    }

    .transfer-list {
        margin: 10px 0;
        position: relative;
    }

    .ibox-new {
        margin: 15px 0 0 0;
        border: solid 2px #F3F3F4;
    }

    a .ibox-new {
        color: #676a6c
    }

    a .ibox-new:hover {
        border: solid 2px #23C6C8;
    }

    a .ibox-new .ibox-title {
        background: #F3F3F4
    }

    a .ibox-new:hover .ibox-title {
        background: #23C6C8 !important;
        color: #fff;
    }
</style>


<script>
    var input = document.getElementById("search_template");
    input.addEventListener("keyup", function(event) {
        event.preventDefault();
        if (event.keyCode === 13) {
            document.getElementById("button_id").click();
        }
    });
    $('.i-checks').iCheck({
        checkboxClass: 'icheckbox_square-green',
        radioClass: 'iradio_square-green'
    });
    $('.scroll_content').slimscroll({
        height: '700px',
        color: '#f8ac59'

    })
    $('.scroll_content_1').slimscroll({
        height: '50px',
        color: '#f8ac59',
        scrollByX: '100px'

    })
</script>



<script type="text/javascript">
    function search_template() {
        var search_template = $("#search_template").val();
        if (search_template == '') {
            $("#search_template").focus();
            swal('', 'Search by template name', 'info');
            return false;
        }
        var ops_url = baseurl + 'fees/fees-student-allotment-search/';
        $.ajax({
            type: "POST",
            cache: false,
            async: false,
            url: ops_url,
            data: {
                "load": 1,
                "search_template": search_template
            },
            success: function(result) {
                var data = JSON.parse(result)

                if (data.status == 1) {
                    $('#template_replace').html('');
                    $('#template_replace').html(data.view);
                    var animation = "fadeInDown";
                    $("#template_replace").show();
                    $('#template_replace').addClass('animated');
                    $('#template_replace').addClass(animation);
                    $('.scroll_content_1').slimscroll({
                        height: '50px',
                        color: '#f8ac59',
                        scrollByX: '100px'

                    })
                    //                    $('#add_type').hide();
                } else {
                    alert('No data loaded');
                }

            }
        });
    }

    function fee_codes_link(id, name) {
        var ops_url = baseurl + 'fees/fees-student-allotment-list/';
        $.ajax({
            type: "POST",
            cache: false,
            async: false,
            url: ops_url,
            data: {
                "load": 1,
                "template_id": id,
                "template_name": name
            },
            success: function(result) {
                var data = JSON.parse(result);
                if (data.status == 1) {
                    $('#data-view').html(data.view);
                    var animation = "fadeInDown";
                    $('#search-feecode').hide();
                    $("#curd-content").show();
                    $('#curd-content').addClass('animated');
                    $('#curd-content').addClass(animation);
                    $('#add_type').hide();
                    $('html, body').animate({
                        scrollTop: $("#content").offset().top
                    }, 1000);
                } else {
                    swal('', 'No data available.', 'info');
                    return false;
                }

            }
        });
    }


    function view_fee_code_with_template(template_id, template_name) {
        var ops_url = baseurl + 'fees/view-linked-fees-code-student-list/';
        $.ajax({
            type: "POST",
            cache: false,
            async: false,
            url: ops_url,
            data: {
                "load": 1,
                "template_id": template_id,
                "template_name": template_name
            },
            success: function(result) {
                var data = JSON.parse(result);
                if (data.status == 1) {
                    $('#data-view').html(data.view);
                    var animation = "fadeInDown";
                    $('#search-feecode').hide();
                    $("#curd-content").show();
                    $('#curd-content').addClass('animated');
                    $('#curd-content').addClass(animation);
                    $('#add_type').hide();
                    $('html, body').animate({
                        scrollTop: $("#content").offset().top
                    }, 1000);
                } else {
                    swal('', 'No data available.', 'info');
                    return false;
                }

            }
        });
    }
</script>