 <!DOCTYPE html>
<html lang="en" style="" class=" js flexbox canvas canvastext webgl touch geolocation postmessage websqldatabase indexeddb hashchange history draganddrop websockets rgba hsla multiplebgs backgroundsize borderimage borderradius boxshadow textshadow opacity cssanimations csscolumns cssgradients cssreflections csstransforms csstransforms3d csstransitions fontface generatedcontent video audio localstorage sessionstorage webworkers applicationcache svg inlinesvg smil svgclippaths"><head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
    <meta name="description" content="admin-themes-lab">
    <meta name="author" content="themes-lab">
    <link rel="shortcut icon" href="<?php base_url(); ?>assets/global/images/favicon.png" type="image/png">
    <link href="<?php base_url(); ?>assets/global/css/style.css" rel="stylesheet">
    <link href="<?php base_url(); ?>assets/global/css/theme.css" rel="stylesheet">
    <link href="<?php base_url(); ?>assets/global/css/ui.css" rel="stylesheet">
    <link href="<?php base_url(); ?>assets/admin/layout2/css/layout.css" rel="stylesheet">
    <script src="<?php base_url(); ?>assets/global/plugins/modernizr/modernizr-2.6.2-respond-1.1.0.min.js"></script>
    <title><?php Title('Recuperar Cuenta »'); ?></title>
    </head>
  <body class="sidebar-condensed fixed-topbar boxed color-default bg-clean theme-sdtd separate-inputs account" data-page="login">
    <!--[if lt IE 7]>
    <p class="browsehappy">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
    <![endif]-->

<div class="container" id="login-block">
            <div class="row">
                <div class="col-sm-6 col-md-4 col-md-offset-4">
                    <div class="account-wall">
                        <form id="loginfrm" class="form-signin" role="form" method="POST" action="">

                            <div class="append-icon">
                                <input type="hidden" name="process" value="10">
                                <input type="text" name="email" class="form-control form-white username" placeholder="Correo Electronico" required="">
                                <i class="icon-user"></i>
                            </div>
                            <button id="recuperarmicuenta" type="submit" class="btn btn-lg btn-default btn-block ladda-button" data-style="expand-left">Recuperar Cuenta</button>
                            </form>
                            <div id="login-links" class="clearfix">
                                <p class="pull-left m-t-20"><a href="<?php base_url(); ?>">Iniciar Sesión</a></p>
                                <p class="pull-right m-t-20"><a href="<?php base_url(); ?>registro">Registrarme</a></p>
                            </div>
                            <div class="clearfix">
                               <div id="clock-login" class="col-md-12 col-sm-12 col-xs-12 text-center">
                                   <i class="fa fa-clock-o fa-5x fa-spin" aria-hidden="true"></i>
                                   <p>Espere un momento...</p>
                               </div>
                            </div>

                            <div class="clearfix">
                               <div id="error-recovery" class="col-md-12 col-sm-12 col-xs-12 animated flash">
                                   <div class="alert media fade in alert-danger">
                                     <p>¡Error!</p>
                                     <p>El correo que has ingresado no esta asociada con ninguna cuenta en el sistema.</p>
                                   </div>
                               </div>
                            </div>

                            <div class="clearfix">
                               <div id="success-recovery" class="col-md-12 col-sm-12 col-xs-12 animated flash">
                                   <div class="alert media fade in alert-success">
                                     <p>¡Bien!</p>
                                     <p>Enviamos un correo electronico con tu nueva contraseña.</p>
                                   </div>
                               </div>
                            </div>


                    </div>
                </div>
            </div>
        </div>

