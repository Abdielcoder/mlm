  
  <title><?php Title('Registro »'); ?></title>
  </head>
  <body class="sidebar-condensed fixed-topbar boxed color-default bg-clean theme-sdtd separate-inputs account" data-page="login">
    <!--[if lt IE 7]>
    <p class="browsehappy">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
    <![endif]-->

<div class="container" id="login-block">
            <div class="row">
                <div class="col-sm-6 col-md-4 col-md-offset-4">
                    <div class="account-wall">
                       <?php
                         if (isset($_SESSION['newid'])) {

                          echo'
                          <div class="alert alert-info text-center" role="alert">
                          '.whatIsMyReferalRegister($_SESSION['referaluser']).' 
                          </div>
                          ';
                          
                       ?>
                        <form id="registerform" class="form-signin" role="form" method="POST" action="">

                            <div class="append-icon">
                                <input type="hidden" name="process" value="2">
                                <input type="text" name="nombre" class="form-control form-white username" placeholder="Nombre" required="">
                                <i class="icon-user"></i>
                            </div>

                            <div class="append-icon">
                                <input type="text" name="apellido" class="form-control form-white username" placeholder="Apellido" required="">
                                <i class="icon-user"></i>
                            </div>

                            <div class="append-icon">
                                <input type="text" name="email" class="form-control form-white username" placeholder="Correo Electronico" required="">
                                <i class="icon-user"></i>
                            </div>
                            <div class="append-icon m-b-5">
                                <input type="password" name="password" class="form-control form-white password" placeholder="Contraseña" required="">
                                <i class="icon-lock"></i>
                            </div>
                            <div class="append-icon m-b-5">
                                <select name="pais" class="form-control">
                                  <?php PaisesOptions(1); ?>
                                </select>
                                <i class="fa fa-globe"></i>
                            </div>                            
                            <button id="registrobutton" type="submit" class="btn btn-lg btn-default btn-block ladda-button" data-style="expand-left">Registrarse</button>
                            </form>
                            <?php
                             }else{
                            ?>
                            
                              <div class="alert alert-danger text-center" role="alert">
                                <i class="fa fa-ban fa-4x" aria-hidden="true"></i> 
                                <p class="text-center">El registro solo esta habilitado mediante un referido, si no tienes un referido no puedes registrarte en el sistema.</p>
                              </div>
                           
                            <?php 
                             }
                            ?>

                            <div id="login-links" class="clearfix">
                                <p class="pull-left m-t-20"><a href="<?php base_url(); ?>">Iniciar Sesión</a></p>
                                <p class="pull-right m-t-20"><a href="<?php base_url(); ?>recuperar-cuenta">Recuperar Cuenta</a></p>
                            </div>
                            <div class="clearfix">
                               <div id="clock-login" class="col-md-12 col-sm-12 col-xs-12 text-center">
                                   <i class="fa fa-clock-o fa-5x fa-spin" aria-hidden="true"></i>
                                   <p>Espere un momento...</p>
                               </div>
                            </div>

                            <div class="clearfix">
                               <div id="success-register" class="col-md-12 col-sm-12 col-xs-12 animated flash">
                                   <div class="alert media fade in alert-success text-center">
                                     <i class="fa fa-check-square-o fa-4x" aria-hidden="true"></i>
                                     <p class="text-center">¡Listo!</p>
                                     <p class="text-center">Ahora solo debes de inciar sesion con tu correo electronico.</p>
                                   </div>
                               </div>
                            </div>

                            <div class="clearfix">
                               <div id="error-login" class="col-md-12 col-sm-12 col-xs-12 animated flash">
                                   <div class="alert media fade in alert-danger">
                                     <p>¡Error!</p>
                                     <p>Este correo electronico ya se encuentra en uso, por favor intenta con una cuenta diferente.</p>
                                   </div>
                               </div>
                            </div>
                    </div>
                </div>
            </div>
        </div>