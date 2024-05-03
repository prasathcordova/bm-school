<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title><?php echo APP_TITLE; ?></title>

    <link rel="icon" href="<?php base_url('assets/theme/img/favicon.ico') ?>" type="image/ico">
    <link href="<?php echo base_url('assets/theme/css/bootstrap.min.css') ?>" rel="stylesheet">
    <link href="<?php echo base_url('assets/theme/font-awesome/css/font-awesome.css') ?>" rel="stylesheet">

    <link href="<?php echo base_url('assets/theme/css/animate.css') ?>" rel="stylesheet">
    <link href="<?php echo base_url('assets/theme/css/style.css') ?>" rel="stylesheet">

</head>

<body class="gray-bg">

    

    <div class="middle-box text-center animated fadeInDown">
        <h1>500</h1>
        <h3 class="font-bold">Internal Server Error</h3>

        <div class="error-desc">
            Javascript is mandatory for our application to run and it is turned off in your browser. So kindly enable javascript on your browser and try again to login into app.
            <form class="form-inline m-t" role="form">
                
                <button type="button" class="btn btn-primary"><a href="<?php echo base_url(); ?>">Login</a></button>
            </form>
        </div>
    </div>

    <!-- Mainly scripts -->
    <script src="<?php echo base_url('assets/theme/js/jquery-3.1.1.min.js') ?>"></script>
    <script src="<?php echo base_url('assets/theme/js/bootstrap.min.js') ?>"></script>

</body>

</html>
