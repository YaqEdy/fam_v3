<!DOCTYPE html>
<!-- 
Template Name: Metronic - Responsive Admin Dashboard Template build with Twitter Bootstrap 3.3.6
Version: 4.5.6
Author: KeenThemes
Website: http://www.keenthemes.com/
Contact: support@keenthemes.com
Follow: www.twitter.com/keenthemes
Dribbble: www.dribbble.com/keenthemes
Like: www.facebook.com/keenthemes
Purchase: http://themeforest.net/item/metronic-responsive-admin-dashboard-template/4021469?ref=keenthemes
Renew Support: http://themeforest.net/item/metronic-responsive-admin-dashboard-template/4021469?ref=keenthemes
License: You must have a valid license purchased only from themeforest(the above link) in order to legally use the theme for your project.
-->
<!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en">
    <!--<![endif]-->
    <!-- BEGIN HEAD -->

    <head>
        <meta charset="utf-8" />
        <title>Login - PNM</title>
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta content="width=device-width, initial-scale=1" name="viewport" />
        <meta content="" name="description" />
        <meta content="" name="author" />
        <!-- BEGIN GLOBAL MANDATORY STYLES -->
        <link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url('metronic/global/plugins/font-awesome/css/font-awesome.min.css'); ?>" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url('metronic/global/plugins/simple-line-icons/simple-line-icons.min.css'); ?>" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url('metronic/global/plugins/bootstrap/css/bootstrap.min.css'); ?>" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url('metronic/global/plugins/bootstrap-switch/css/bootstrap-switch.min.css'); ?>" rel="stylesheet" type="text/css" />
        <!-- END GLOBAL MANDATORY STYLES -->
        <!-- BEGIN PAGE LEVEL PLUGINS -->
        <!-- END PAGE LEVEL PLUGINS -->
        <!-- BEGIN THEME GLOBAL STYLES -->
        <link href="<?php echo base_url('metronic/global/css/components.min.css'); ?>" rel="stylesheet" id="style_components" type="text/css" />
        <link href="<?php echo base_url('metronic/global/css/plugins.min.css'); ?>" rel="stylesheet" type="text/css" />
        <!-- END THEME GLOBAL STYLES -->
        <!-- BEGIN PAGE LEVEL STYLES -->
        <link href="<?php echo base_url('metronic/pages/css/lock-2.min.css'); ?>" rel="stylesheet" type="text/css" />
        <!-- END PAGE LEVEL STYLES -->
        <!-- BEGIN THEME LAYOUT STYLES -->
        <!-- END THEME LAYOUT STYLES -->
        <link rel="shortcut icon" href="favicon.ico" /> </head>
    <!-- END HEAD -->
    <?php 
        $grupnya= json_decode($this->session->userdata('pilihan_grupuser'),true);
//        echo '<pre>';
//        print_r($grupnya);
//        die();
    ?>
<body class="">
        <div class="page-lock">
            <div class="page-logo">
                <a class="brand" href="#">
                    <h3><font color="white"><b>PNM</b></h3></h3>
                    <!--<img src="<?php echo base_url('metronic/pages/img/logo-big.png') ?>" alt="logo" />--> 
                </a>
            </div>
            <div class="page-body">
                <?php 
                    if($this->session->userdata('foto') == '' || $this->session->userdata('foto') == NULL){
                        $url =  base_url("metronic/img/noPhoto.jpg") ;
                    }else{
                        $url = $this->session->userdata('foto');
                    }
                ?>
                
                
                <img width="130" class="lock-avatar" src="<?php echo $url; ?>" alt="">
                <div class="page-lock-info">
                    <h1><?php echo $this->session->userdata('namaKyw'); ?></h1>
                    <span class="email"> Email : <?php echo $this->session->userdata('user_email'); ?></span>
                    <span class="email"> NIK : <?php echo $this->session->userdata('id_user'); ?> </span>
                    <form method="POST" class="form-inline" action="<?php echo base_url('admin/chekinglogin/sess') ?>">
                        <div class="input-group input-medium">
                            <select name="pilihGroup" class="form-control">
                                <?php foreach ($grupnya as $value) { ?>
                                <option value="<?php echo trim($value['usergroup_id'])."-".trim($value['usergroup_desc']) ?>"><?php echo $value['usergroup_desc'] ?></option>      
                                <?php  } ?>
                            </select>
                            <span class="input-group-btn">
                                <button type="submit" class="btn green icn-only">
                                    <i class="m-icon-swapright m-icon-white"></i>
                                </button>
                            </span>
                        </div>
                         <!--/input-group--> 
                        <div class="relogin">
                            <a href="<?php echo base_url('main/logout'); ?>"> Not <font color="white"><b><?php echo $this->session->userdata('name'); ?> ?</b></font> </a>
                        </div>
                    </form>
                </div>
            </div>
            <div class="page-footer-custom"> 2018 &copy; Mitra Tekno Madani </div>
        </div>
        <!--[if lt IE 9]>
<!--    <body class="">
        <div class="page-lock">
            <div class="page-logo">
                <a class="brand" href="#">
                    <img  class="page-lock-img" src="<?php echo $this->session->userdata('foto'); ?>" alt="logo"  /> 
                    <img src="<?php echo base_url('metronic/pages/img/logo-big.png') ?>" alt="logo" />
                </a>
            </div>
            <div class="page-body">
                <div class="page-lock-info">
                    <img class="page-lock-img" src="<?php echo base_url('metronic/pages/media/profile/profile.jpg') ?>" alt="">
                    <h1><?php echo $this->session->userdata('namaKyw'); ?></h1>
                    <span class="email"> bob@keenthemes.com </span>
                    <span class="locked"> Silahkan Pilih </span>
                    <form class="form-inline" action="index.html">
                        <div class="input-group input-medium">
                            <input type="text" class="form-control" placeholder="Password">
                            <select class="form-control">
                                <?php foreach ($grupnya as $value) { ?>
                                <option value="<?php echo $value['usergroup_id'] ?>"><?php echo $value['usergroup_desc'] ?></option>      
                                <?php  } ?>
                            </select>
                            <span class="input-group-btn">
                                <button type="submit" class="btn green icn-only">
                                    <i class="m-icon-swapright m-icon-white"></i>
                                </button>
                            </span>
                        </div>
                         /input-group 
                        <div class="relogin">
                            <a href="login.html"> Not Bob Nilson ? </a>
                        </div>
                    </form>
                </div>
            </div>
            <div class="page-footer-custom"> 2014 &copy; Metronic. Admin Dashboard Template. </div>
        </div>
        [if lt IE 9]>
<script src="<?php echo base_url('metronic/global/plugins/respond.min.js'); ?>"></script>
<script src="<?php echo base_url('metronic/global/plugins/excanvas.min.js'); ?>"></script> 
<![endif]
         BEGIN CORE PLUGINS 
-->        <script src="<?php echo base_url('metronic/global/plugins/jquery.min.js'); ?>" type="text/javascript"></script>
        <script src="<?php echo base_url('metronic/global/plugins/bootstrap/js/bootstrap.min.js'); ?>" type="text/javascript"></script>
        <script src="<?php echo base_url('metronic/global/plugins/js.cookie.min.js'); ?>" type="text/javascript"></script>
        <script src="<?php echo base_url('metronic/global/plugins/bootstrap-hover-dropdown/bootstrap-hover-dropdown.min.js'); ?>" type="text/javascript"></script>
        <script src="<?php echo base_url('metronic/global/plugins/jquery-slimscroll/jquery.slimscroll.min.js'); ?>" type="text/javascript"></script>
        <script src="<?php echo base_url('metronic/global/plugins/jquery.blockui.min.js'); ?>" type="text/javascript"></script>
        <script src="<?php echo base_url('metronic/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js'); ?>" type="text/javascript"></script>
<!--         END CORE PLUGINS 
         BEGIN PAGE LEVEL PLUGINS -->
        <script src="<?php echo base_url('metronic/global/plugins/backstretch/jquery.backstretch.min.js'); ?>" type="text/javascript"></script>
<!--         END PAGE LEVEL PLUGINS 
         BEGIN THEME GLOBAL SCRIPTS -->
        <script src="<?php echo base_url('metronic/global/scripts/app.min.js'); ?>" type="text/javascript"></script>
<!--         END THEME GLOBAL SCRIPTS 
         BEGIN PAGE LEVEL SCRIPTS -->
        <script src="<?php echo base_url('metronic/pages/scripts/lock-2.min.js'); ?>" type="text/javascript"></script>
<!--         END PAGE LEVEL SCRIPTS 
         BEGIN THEME LAYOUT SCRIPTS 
         END THEME LAYOUT SCRIPTS -->
    </body>

</html>