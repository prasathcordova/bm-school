<fieldset>

    <div class="row">


        <div class="col-lg-12">
            <div class="panel panel-info">
                <div class="panel-heading">
                    <i class="fa fa-info-circle"></i> Passport Details
                </div>
                <div class="panel-body">
                    <form action="#" id="other_details-passport">
                        <div class="row">
                            <div class="col-lg-6 col-xs-12 col-md-12">
                                <div class="form-group">
                                    <label>Passport Number </label>
                                    <input id="passno" placeholder="Enter Passport Number" maxlength="20" name="passno" pattern="[0-9]" type="text" class="form-control">
                                </div>
                            </div>

                            <div class="col-lg-6 col-xs-12 col-md-12">
                                <div class="form-group">
                                    <label>Place of Issue </label>
                                    <input id="pissue_place" name="pissue_place" maxlength="25" type="text" placeholder="Enter Place of Issue" class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="clearfix"></div>
                        <div class="row">
                            <div class="col-lg-6 col-xs-12 col-md-12">
                                <div class="form-group" id="data_1">
                                    <label class="font-noraml"> Date of Issue</label>
                                    <div class="input-group date">
                                        <span class="input-group-addon"><i class="fa fa-calendar"></i></span><input type="text" placeholder=" Enter Date of Issue" id="pass_issue_date" name="pass_issue_date" class="form-control" value="" readonly="" style="background-color:#fff">
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-6 col-xs-12 col-md-12">
                                <div class="form-group" id="pdata_2">
                                    <label class="font-noraml"> Date Of Expiry </label>
                                    <div class="input-group date">
                                        <span class="input-group-addon"><i class="fa fa-calendar"></i></span><input type="text" placeholder=" Enter Date of Expiry" id="pass_expiry_date" name="pass_expiry_date" class="form-control" value="" readonly="" style="background-color:#fff">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="clearfix"></div>
                        <div class="row">
                            <div class="col-lg-6 col-xs-12 col-md-12">
                                <div class="form-group">
                                    <label>Description </label>
                                    <input id="pdesc" maxlength="50" name="pdesc" type="text" placeholder=" Enter Description" class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="clearfix"></div>
                    </form>
                </div>

            </div>
        </div>
        <div class="col-lg-12">
            <div class="panel panel-info">
                <div class="panel-heading">
                    <i class="fa fa-info-circle"></i> Visa Details
                </div>
                <div class="panel-body">
                    <form action="#" id="other_details-visa">
                        <div class="row">
                            <div class="col-lg-6 col-xs-12 col-md-12">
                                <div class="form-group">
                                    <label>Visa Number </label>
                                    <input id="visano" placeholder="Enter Visa Number" name="visano" maxlength="20" type="text" class="form-control">
                                </div>
                            </div>

                            <div class="col-lg-6 col-xs-12 col-md-12">
                                <div class="form-group">
                                    <label>Place of Issue </label>
                                    <input id="vissue_place" name="vissue_place" type="text" placeholder="Enter Place of Issue" maxlength="25" class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="clearfix"></div>
                        <div class="row">
                            <div class="col-lg-6 col-xs-12 col-md-12">
                                <div class="form-group" id="data_1">
                                    <label class="font-noraml"> Date Of Issue</label>
                                    <div class="input-group date">
                                        <span class="input-group-addon"><i class="fa fa-calendar"></i></span><input type="text" id="visa_issue_date" name="visa_issue_date" placeholder="Enter Date of Issue" class="form-control" value="" readonly="" style="background-color:#fff">
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-6 col-xs-12 col-md-12">
                                <div class="form-group" id="vdata_2">
                                    <label class="font-noraml"> Date of Expiry </label>
                                    <div class="input-group date">
                                        <span class="input-group-addon"><i class="fa fa-calendar"></i></span><input type="text" id="visa_expiry_date" name="visa_expiry_date" placeholder="Enter Date of Expiry" class="form-control" value="" readonly="" style="background-color:#fff">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="clearfix"></div>
                        <div class="row">
                            <div class="col-lg-6 col-xs-12 col-md-12">
                                <div class="form-group">
                                    <label>Description </label>
                                    <input id="vdesc" maxlength="50" name="vdesc" type="text" placeholder=" Enter Description" class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="clearfix"></div>
                    </form>
                </div>

            </div>
        </div>


    </div>

</fieldset>
<script>
    var other_details_passport = $('#other_details-passport');
    var other_details_visa = $('#other_details-visa');
    var other_details_passport_validator;
    var other_details_visa_validator;
    other_details_passport_validator = other_details_passport.validate({
        rules: {
            passno: {
                required: true,
                minlength: 6,
                normalizer: function(value) {
                    return $.trim(value);
                }
            },
            pissue_place: {
                required: true,
                minlength: 3,
                normalizer: function(value) {
                    return $.trim(value);
                }
            },
            pass_issue_date: {
                required: true,
                normalizer: function(value) {
                    return $.trim(value);
                }
            },
            pass_expiry_date: {
                required: true,
                normalizer: function(value) {
                    return $.trim(value);
                }
            },
            pdesc: {
                required: true,
                minlength: 5,
                normalizer: function(value) {
                    return $.trim(value);
                }
            }
        },
        messages: {
            passno: {
                required: "Enter Passport Number",
                minlength: "Enter atleast six characters."
            },
            pissue_place: {
                required: "Enter Place of Issue",
                minlength: "Enter atleast three characters."
            },
            pass_issue_date: {
                required: "Select Date of issue",
            },
            pass_expiry_date: {
                required: "Select Date of expiry",
            },
            pdesc: {
                required: "Enter Description",
                minlength: "Enter atleast 5 characters"
            }
        },
        errorPlacement: function(error, element) {
            $(element).parents('.form-group').append(error);
        }
    });
    other_details_visa_validator = other_details_visa.validate({
        rules: {
            visano: {
                required: true,
                minlength: 6,
                normalizer: function(value) {
                    return $.trim(value);
                }
            },
            vissue_place: {
                required: true,
                minlength: 3,
                normalizer: function(value) {
                    return $.trim(value);
                }
            },
            visa_issue_date: {
                required: true,
                normalizer: function(value) {
                    return $.trim(value);
                }
            },
            visa_expiry_date: {
                required: true,
                normalizer: function(value) {
                    return $.trim(value);
                }
            },
            vdesc: {
                required: true,
                minlength: 5,
                normalizer: function(value) {
                    return $.trim(value);
                }
            },
        },
        messages: {
            visano: {
                required: "Enter Visa Number",
                minlength: "Enter atleast six characters."
            },
            vissue_place: {
                required: "Enter Place of Issue",
                minlength: "Enter atleast three characters."
            },
            visa_issue_date: {
                required: "Select Date of issue",
            },
            visa_expiry_date: {
                required: "Select Date of expiry",
            },
            vdesc: {
                required: "Enter Description",
                minlength: "Enter atleast 5 characters"
            },
        },
        errorPlacement: function(error, element) {
            $(element).parents('.form-group').append(error);
        }
    });
</script>