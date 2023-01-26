  <body class="sidebar-condensed fixed-topbar boxed color-default bg-clean theme-sdtd separate-inputs account" data-page="login">
    <!--[if lt IE 7]>
    <p class="browsehappy">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
    <![endif]-->

<div class="container" id="login-block">
            <div class="row">
                <div class="col-sm-6 col-md-4 col-md-offset-4">
                    <div class="account-wall">
                        <form id="loginfrm" class="form-signin" role="form" method="POST" action="">

                            <?php
                            knowIPUser();
                            ?>

                            <div class="append-icon">
                                <input type="hidden" name="process" value="1">
                                <input type="text" name="email" class="form-control form-white username text-center" placeholder="Correo Electronico" required="">
                                <i class="icon-user"></i>
                            </div>
                            <div class="append-icon m-b-5">
                                <input type="password" name="password" class="form-control form-white password text-center" placeholder="Contraseña" required="">
                                <i class="icon-lock"></i>
                            </div>
                            <button id="iniciarsession" type="submit" class="btn btn-lg btn-default btn-block ladda-button" data-style="expand-left">Iniciar Sesión</button>
                            </form>
                            <div id="login-links" class="clearfix">
                                <p class="pull-left m-t-20"><a href="<?php base_url(); ?>recuperar-cuenta">Recuperar Cuenta</a></p>
                                <p class="pull-right m-t-20"><a href="<?php base_url(); ?>registro">Registrarme</a></p>
                            </div>
                            <div class="clearfix">
                               <div id="clock-login" class="col-md-12 col-sm-12 col-xs-12 text-center">
                                   <i class="fa fa-clock-o fa-5x fa-spin" aria-hidden="true"></i>
                                   <p>Espere un momento...</p>
                               </div>
                            </div>

                            <div class="clearfix">
                               <div id="error-login" class="col-md-12 col-sm-12 col-xs-12 animated flash">
                                   <div class="alert media fade in alert-danger">
                                     <p>¡Error!</p>
                                     <p>Revisa tus datos de acceso y vuelve a intentarlo.</p>
                                   </div>
                               </div>
                            </div>

                    </div>
                </div>
            </div>
        </div>

