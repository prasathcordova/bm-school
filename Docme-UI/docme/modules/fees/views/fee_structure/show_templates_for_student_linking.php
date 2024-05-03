<div class="wrapper wrapper-content animated fadeInRight" style="padding-top: 1px !important;padding-left: 0px !important;padding-right: 0px !important;">
    <div class="row" style="margin-left: -29px !important; margin-right: -30px !important;">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5><?php echo isset($sub_title) ? $sub_title : "NO TITLE PROVIDED" ?></h5>
                </div>
                <div class="ibox-content" id="fee_code_loader">
                    <div class="sk-spinner sk-spinner-wave">
                        <div class="sk-rect1"></div>
                        <div class="sk-rect2"></div>
                        <div class="sk-rect3"></div>
                        <div class="sk-rect4"></div>
                        <div class="sk-rect5"></div>
                    </div>
                    <div class="input-group" style="margin-bottom:26px">
                        <input type="text" id="search_template" name="search_template" placeholder="Search Template by name..." class="form-control alphanumeric max20">
                        <span class="input-group-btn">
                            <button type="button" id="button_id" class="btn btns btn-info" onclick="search_template();"> Search</button>

                        </span>
                    </div>
                    <div class=" animated fadeInRight" id="template_replace">
                        <?php
                        echo $this->load->view('show_templates_for_student_linking_search');
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
</script>



<script type="text/javascript">
    $('.scroll_content_1').slimscroll({
        height: '50px',
        color: '#f8ac59',
        scrollByX: '100px'

    })

    function search_template() {
        var search_template = $("#search_template").val();
        if (search_template == '') {
            $("#search_template").focus();
            swal('', 'Search by template name', 'info');
            return false;
        }
        var ops_url = baseurl + 'fees/search-show-template-fees-code-list-for-student-link/';
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

                    });
                } else {
                    if (data.message) {
                        swal('', data.message, 'info');
                        return false;
                    } else {
                        swal('', 'No data available.', 'info');
                        return false;
                    }
                }

            }
        });
    }

    function assign_students_filter(id, name) {
        var ops_url = baseurl + 'fees/show-student-filter-for-fee-allocation/';
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
                    if (data.message) {
                        swal('', data.message, 'info');
                        return false;
                    } else {
                        swal('', 'No data available.', 'info');
                        return false;
                    }

                }

            }
        });
    }


    function view_fee_code_with_template_student(template_id, template_name) {
        var ops_url = baseurl + 'fees/view-linked-fees-code/';
        $.ajax({
            type: "POST",
            cache: false,
            async: false,
            url: ops_url,
            data: {
                "load": 1,
                "template_id": template_id,
                "template_name": template_name,
                "backsection": "student"
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
                    if (data.message) {
                        swal('', data.message, 'info');
                        return false;
                    } else {
                        swal('', 'No data available.', 'info');
                        return false;
                    }
                }

            }
        });
    }
</script>