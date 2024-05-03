<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
    <div class="card">
        <div class="header">
            <h2 style="padding-bottom: 10px;font-size: 16px;color: #1c84c6;"><?php echo isset($sub_title) ? $sub_title : "NO TITLE PROVIDED" ?>
                <span><a href="javascript:void(0);" onclick="close_panel();"><i style="font-size: 30px !important; float: right; color: #E91E63;" class="material-icons" data-toggle="tooltip" title="Close">close</i></a> </span>
                <span><a href="javascript:void(0);" onclick="save_spare_details();"><i style="font-size: 30px !important; float: right; color: #23C6C5; padding-right: 10px;" class="material-icons" data-toggle="tooltip" title="Save">save</i></a> </span>
                <span><a href="javascript:void(0);" onclick="clear_controls();"><i style="font-size: 30px !important; float: right; color: #2196F3; padding-right: 10px;" class="material-icons " data-toggle="tooltip" title="Refresh">refresh</i></a> </span>
            </h2>
        </div>
        <div class="body">
            <?php
            echo form_open('', array('id' => 'spares_save', 'role' => 'form'));
            ?>
            <?php
            $breaker = 0;
            ?>
            <div class="col-lg-12">
                <div id="curd-content" style="display: none;"></div>
                <div class="ibox-content">
                    <form method="post" id="myform">
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Name *</label>
                                    <input type="text" class="form-control alpha" maxlength="30" placeholder="Name" name="pname" id="pname" autocomplete="off">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label class="form-label">Description *</label>
                                    <input type="text" maxlength="100" class="form-control" name="desc" placeholder="Description" id="desc" autocomplete="off" maxlength="50">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Part Number *</label>
                                    <input type="text" maxlength="25" class="form-control" placeholder="Part Number" name="p_num" id="p_num" autocomplete="off" style="text-align: left">
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <?php
                if ($breaker == 3) {
                    echo '<div class="clearfix"></div>';
                    $breaker = 0;
                } else {
                    $breaker++;
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



<script type="text/javascript">
    $(document).ready(function() {
        $('.form-control').focus(function() {
            $(this).parent().addClass('focused');
        });

        // On focusout event
        $('.form-control').change(function() {
            var $this = $(this);
            if ($this.parents('.form-group').hasClass('form-float')) {
                if ($this.val() == '') {
                    $this.parents('.form-line').removeClass('focused');
                }
            } else {
                $this.parents('.form-line').removeClass('focused');
            }
        });

        $('.selectpicker').select2({
            "theme": "bootstrap",
            "width": "100%"
        });
    });

    function load_spareform() {
        var ops_url = baseurl + 'transport/show-parts-spare/';
        $.ajax({
            type: "POST",
            cache: false,
            async: false,
            url: ops_url,
            data: {
                "load": 1
            },
            success: function(result) {
                $('#data-view').html(result);
            }
        });
    }

    function save_spare_details() {
        $('#faculty_loader').addClass('sk-loading');
        var ops_url = baseurl + 'transport/addparts-sparevendor/';
        var pname = $('#pname').val();
        var pdesc = $('#desc').val();
        var p_num = $('#p_num').val();


        var alphanumers = /^[a-zA-Z\s]+$/;
        if (pname == '') {
            swal('', 'Name is required.', 'info');
            $('#faculty_loader').removeClass('sk-loading');
            return false;
        }

        if (pdesc == '') {
            swal('', 'Description is required.', 'info');
            $('#faculty_loader').removeClass('sk-loading');
            return false;
        }

        if (p_num == '') {
            swal('', 'Part Number is required.', 'info');
            $('#faculty_loader').removeClass('sk-loading');
            return false;
        }

        // if (!alphanumers.test($("#pname").val())) {
        //     swal('', 'Spare Part Name can have only alphabets.', 'info');
        //     $('#faculty_loader').removeClass('sk-loading');
        //     return false;
        // }
        if ((pname.length > '30') || (pname.length < '3')) {
            swal('', 'Name should contain letters 3 to 30 characters.', 'info');
            $('#faculty_loader').removeClass('sk-loading');
            return false;
        }


        if ((pdesc.length > '50') || (pdesc.length < '3')) {
            swal('', 'Description should contain letters 3 to 50 characters.', 'info');
            $('#faculty_loader').removeClass('sk-loading');
            return false;
        }
        if (p_num == '') {
            swal('', 'Part Number is required.', 'info');
            $('#faculty_loader').removeClass('sk-loading');
            return false;
        }
        if ((p_num.length > '25') || (p_num.length < '3')) {
            swal('', 'Part Number should contain  3 to 25 digits.', 'info');
            $('#faculty_loader').removeClass('sk-loading');
            return false;
        }


        $.ajax({
            type: "POST",
            cache: false,
            async: false,
            url: ops_url,
            data: $('#spares_save').serialize(),
            success: function(result) {
                var data = $.parseJSON(result);
                if (data.status == 1) {
                    load_spareform();
                    swal('Success', 'Spare Part, ' + pname + ' created successfully.', 'success');
                    $('#faculty_loader').removeClass('sk-loading');
                    $("#curd-content").slideUp("slow", function() {
                        $("#curd-content").hide();
                        $('#add_type').show();
                    });
                } else if (data.status == 2) {
                    // $('#curd-content').html('');
                    // $('#curd-content').html(data.view);
                    swal('', data.message, 'info');
                    $('#pname').val('');
                    $('#faculty_loader').removeClass('sk-loading');
                } else if (data.status == 3) {
                    
                    swal('', data.message, 'info');
                    $('#p_num').val('');
                    $('#faculty_loader').removeClass('sk-loading');
                } else {

                    swal('', 'Connection Error. Please contact administrator', 'info');
                    $('#faculty_loader').removeClass('sk-loading');
                }

            }
        });
    }

    function close_panel() {
        if ($('#curd-content').is(":visible") == true) {
            $("#curd-content").slideUp("slow", function() {
                $("#curd-content").hide();
                $('#add_type').show();
                $('#search-feecode').show()
            });
        }
    }

    function clear_controls() {
        $('#pname').val('').focus();
        $('#desc').val('');
        $('#p_num').val('');
    }
</script>