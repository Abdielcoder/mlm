<?php
  require_once 'includes/functions.php';
  IsloginAdmin();
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Panel Multi Nivel - Administración</title>

    <link rel="shortcut icon" href="<?php base_url(); ?>assets/global/images/favicon.png" type="image/png">
    <link href="<?php base_url(); ?>assets/global/css/style.css" rel="stylesheet">
    <link href="<?php base_url(); ?>assets/global/css/theme.css" rel="stylesheet">
    <link href="<?php base_url(); ?>assets/global/css/ui.css" rel="stylesheet">
    <link href="<?php base_url(); ?>assets/admin/layout2/css/layout.css" rel="stylesheet">
    <link href="admin.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body>


    <div class="container text-center">


         <div id="header-system" class="col-md-12 col-xs-12 col-sm-12 text-center">
            <h3>Panel Sistema Multi Nivel</h3>
         </div>

         <a data-option="1" class="icon-desktop">
           <i class="fa fa-user" aria-hidden="true"></i>
           <p>Usuarios</p>
         </a>

         <!--
         <a data-option="2" class="icon-desktop">
           <i class="fa fa-cog fa-spin" aria-hidden="true"></i>
           <p>Ajustes</p>
         </a>
         -->

         <a data-option="3" class="icon-desktop">
           <i class="fa fa-th-large" aria-hidden="true"></i>
           <p>Modulos</p>
         </a>

         <a data-option="4" class="icon-desktop">
           <i class="fa fa-envelope-o" aria-hidden="true"></i>
           <p>Correo</p>
         </a>

         <a href="../dashboard" data-option="0" class="icon-desktop">
           <i class="fa fa-reply-all" aria-hidden="true"></i>
           <p>Escritorio</p>
         </a>


      
    </div>

    
    
      <!-- minus app -->
      <div id="minusapp" class="col-md-12 col-sm-12 col-xs-12 text-center">
        
      </div>
      <!-- minus app -->
 

      <!-- app append -->
      <div id="append-data"></div>
      <!-- app append -->

      <!-- append user -->
      <div id="append-user"></div>


    <script src="<?php base_url(); ?>assets/global/plugins/jquery/jquery-3.1.0.min.js"></script>
    <script src="<?php base_url(); ?>assets/global/plugins/jquery-ui/jquery-ui.min.js"></script>
    <script src="<?php base_url(); ?>assets/global/plugins/bootstrap/js/bootstrap.min.js"></script>
    <script src="<?php base_url(); ?>js/jquery.validate.min.js"></script>
    <script src="<?php base_url(); ?>js/additional-methods.min.js"></script>
    <script src="jquery-ui.js"></script>
    <script src="dt.js"></script>
    <script src="animate.js"></script>
</body>
</html>