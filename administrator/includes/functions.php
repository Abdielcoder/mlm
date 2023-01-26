<?php

require_once 'login.class.php';
require_once 'xss_filter.class.php';
require_once 'rezize.class.php';
require_once 'arbol.class.php';



function knowIPUser(){
  if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
       $ip = $_SERVER['HTTP_CLIENT_IP'];
   } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
       $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
   } else {
       $ip = $_SERVER['REMOTE_ADDR'];
   }

   session_start();
   $_SESSION['ipaccess'] = $ip;
   
}


function generateRandomString($length = 6) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}


function IsLogin(){

     if (isset($_SESSION['activess'])) 
     {
         if (strcmp($_SESSION['activess'], SESSTK) == 0) 
         {
            header('Location: '.base_url_return().'dashboard');
         }else{

         }
     }
}

function IsLoginProcess(){
     if (isset($_SESSION['activess'])) 
     {
         if (strcmp($_SESSION['activess'], SESSTK) == 0){
         }else{
           exit();
         }
     }
}


function IsloginAdmin(){

     if (isset($_SESSION['activess'])) {
         
         if (isset($_SESSION['rango'])) {
           
            if ($_SESSION['rango'] == 1){
              header('Location: '.base_url_return().'logout'); 
            }

         }else{
           header('Location: '.base_url_return().'logout'); 
         }
       }else{
       header('Location: '.base_url_return().'logout'); 
     }

}

function checkSession(){

    if (!isset($_SESSION['activess'])) {
      header('Location: '.base_url_return().'logout');
    }

    $conexion = Conexion::singleton_conexion();
    $SQL = 'SELECT * FROM usuarios WHERE id = :id';
    $stn = $conexion -> prepare($SQL);
    $stn -> bindParam(':id', $_SESSION['usuario'] ,PDO::PARAM_INT);
    $stn -> execute();

    $rstl = $stn -> fetch();

    if ($rstl['online'] == 0)
    {
      header('Location: '.base_url_return().'logout');
    }

    $conexion = null;

}



function nameUser(){

   $conexion = Conexion::singleton_conexion();

   $SQL = 'SELECT * FROM usuarios WHERE id = :id';
   $stn = $conexion -> prepare($SQL);
   $stn -> bindParam(':id', $_SESSION['usuario'] ,PDO::PARAM_INT);
   $stn -> execute();
   $results = $stn -> fetchAll();
   if (empty($results)){
   }else{
      foreach ($results as $key){
        echo $key['nombre'].' '.$key['apellido'];
      }
   }

   $conexion = null;

}


function Title($data){

   $conexion = Conexion::singleton_conexion();

   $SQL = 'SELECT * FROM config WHERE id = 1';
   $stn = $conexion -> prepare($SQL);
   $stn -> execute();
   $results = $stn -> fetchAll();
   if (empty($results)){
   }else{
   	  foreach ($results as $key){
   	  	echo $data.' '.$key['sitename'];
   	  }
   }

   $conexion = null;

}


function base_url(){
   	  	echo BASEURL;
}



function base_url_return(){
   return BASEURL;
}

function themeAdd($file){
     $baseurl = base_url_return();
     include $base_url.'templates/'.$file;
}


function checkMail($mail){

  $conexion = Conexion::singleton_conexion();

  $SQL = 'SELECT * FROM usuarios WHERE email = :email LIMIT 1';
  $stn = $conexion -> prepare($SQL);
  $stn -> bindParam(':email',$mail,PDO::PARAM_STR);
  $stn -> execute();
  $rst = $stn -> fetchAll();
  if (empty($rst))
  {
    return 1;
  }
  else
  {
    return 2;
  }

  $conexion = null;



}


function LogoutSet(){

  $conexion = Conexion::singleton_conexion();

  $secure = 'UPDATE usuarios SET online = 0, skey = 0 WHERE id = :id';
  $squery = $conexion->prepare($secure);
  $squery->bindParam(':id', $_SESSION['usuario'], PDO::PARAM_INT);
  $squery->execute();  

  $conexion = null;


}


function get_referal_link(){

   $conexion = Conexion::singleton_conexion();

   $baseurl = base_url_return();

   $SQL = 'SELECT * FROM usuarios WHERE id = :id AND referalnum < 4';
   $stn = $conexion -> prepare($SQL);
   $stn -> bindParam(':id',$_SESSION['usuario'],PDO::PARAM_INT);
   $stn -> execute();
   $results = $stn -> fetchAll();
   if (empty($results)){
   }else{
        foreach ($results as $key){
          return $baseurl.'referal/'.$key['referal'];
        }
   }

   $conexion = null;

}


function get_just_referal_link(){

   $conexion = Conexion::singleton_conexion();

   $SQL = 'SELECT * FROM usuarios WHERE id = :id AND referalnum < 4';
   $stn = $conexion -> prepare($SQL);
   $stn -> bindParam(':id',$_SESSION['usuario'],PDO::PARAM_INT);
   $stn -> execute();
   $results = $stn -> fetchAll();
   if (empty($results)){
   }else{
        foreach ($results as $key){
          return $key['referal'];
        }
   }

   $conexion = null;

}



function checkLevelInternal(){

  $conexion = Conexion::singleton_conexion();
  $SQL = 'SELECT * FROM levels WHERE id = :id LIMIT 1';
  $stn = $conexion -> prepare($SQL);
  $stn -> bindParam(':id',$_SESSION['usuario'],PDO::PARAM_INT);
  $stn -> execute();
  $results = $stn -> fetchAll();
  if (empty($results)){
  }else{
      foreach ($results as $key){
        return $key['nivel'];
      }
  }

  $conexion = null;


}


function advanceRerefal(){

    $conexion = Conexion::singleton_conexion();

    $checklevelinternal = checkLevelInternal();

    $SQL = 'SELECT * FROM usuarios WHERE id = :id';
    $stn = $conexion -> prepare($SQL);
    $stn -> bindParam(':id',$_SESSION['usuario'],PDO::PARAM_INT);
    $stn -> execute();
    $results = $stn -> fetchAll();
    if (empty($results)){
    }else{
        foreach ($results as $key){

           if ($checklevelinternal == 1)
           {
             
               if ($key['referalnum'] == 1) 
               {
                 return 25;
               }elseif ($key['referalnum'] == 2) 
               {
                 return 50;
               }elseif ($key['referalnum'] == 3) 
               {
                 return 75;
               }
               elseif ($key['referalnum'] == 4) 
               {
                 return 100;
               }

           }
           elseif ($checklevelinternal == 1) 
           {
             
           }
           elseif ($checklevelinternal == 3) 
           {
             
           }
           elseif ($checklevelinternal == 4) 
           {
             
           }




        }
    }

    $conexion = null;

}


function myImageUser(){

    $conexion = Conexion::singleton_conexion();

    $SQL = 'SELECT * FROM images WHERE user = :user';
    $stn = $conexion -> prepare($SQL);
    $stn -> bindParam(':user',$_SESSION['usuario'],PDO::PARAM_INT);
    $stn -> execute();
    $results = $stn -> fetchAll();
    if (empty($results)){
            echo base_url().'images/defaultprofile.png';
    }else{
        foreach ($results as $key){
            echo base_url().$key['location'];
            
        }
    }

    $conexion = null;

}


function myImageUserPerID($id){

    $conexion = Conexion::singleton_conexion();

    $SQL = 'SELECT * FROM images WHERE user = :user';
    $stn = $conexion -> prepare($SQL);
    $stn -> bindParam(':user',$id,PDO::PARAM_INT);
    $stn -> execute();
    $results = $stn -> fetchAll();
    if (empty($results)){
            $data = base_url_return().'images/defaultprofile.png';
            return '<img width="150" src="'.$data.'">';
    }else{
        foreach ($results as $key){
            $data = base_url_return().$key['location'];
            return '<img width="150" src="'.$data.'"><p></p><button class="btn btn-warning" onclick="dimgU('.$id.')">Eliminar Imagen</button>';
            
        }
    }

    $conexion = null;

}


function checkUserImage(){

    $conexion = Conexion::singleton_conexion();

    $SQL = 'SELECT * FROM images WHERE user = :user';
    $stn = $conexion -> prepare($SQL);
    $stn -> bindParam(':user',$_SESSION['usuario'],PDO::PARAM_INT);
    $stn -> execute();
    $results = $stn -> fetchAll();
    if (empty($results)){
    }else{
        foreach ($results as $key){
            unlink($key['location']);
            $idimg = $key['id'];
        }
    }

    $DEL = 'DELETE FROM images WHERE id = :id';
    $stn = $conexion -> prepare($DEL);
    $stn -> bindParam(':id',$idimg,PDO::PARAM_INT);
    $stn -> execute();

    $conexion = null;

}

function whatIsMyReferalRegister($user){

    $conexion = Conexion::singleton_conexion();

    $SQL = 'SELECT * FROM usuarios WHERE id = :id';
    $stn = $conexion -> prepare($SQL);
    $stn -> bindParam(':id',$user,PDO::PARAM_INT);
    $stn -> execute();
    $results = $stn -> fetchAll();
    if (empty($results)){
    }else{
        foreach ($results as $key){
            return '<p class="text-center">Tu Referido es:</p><strong> '.$key['nombre'].' '.$key['apellido'].'</strong>';
        }
    }

    $conexion = null;


}



// Subir Foto del usuario
function processfilepostpicperfil($archive,$profile){

    // conexion de base de datos
    $conexion = Conexion::singleton_conexion();

    // Si el usuario ya tiene una imagen pues borramos la anterior y
    // ya que se haga el proceso de la nueva.
    checkUserImage();

    //comprobamos si el archivo ha subido y lo movemos a una ruta temporal
    if ($archive && move_uploaded_file($_FILES['file']['tmp_name'],"images/photos/".$profile."/".$archive)){
    }  

    // Creamos ruta del temporal
    $temporal = 'images/photos/'.$profile.'/'.$archive;

    // Creamos un alfanumerico aleatorio.
    $characters = 'abcdefghijklmnopqrstuvwxyz1234567890ABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $string = '';
    for ($i = 0; $i < 60; $i++) {
     $string .= $characters[rand(0, strlen($characters) - 1)];
    }

    // Creamos una fecha para combinar con el string
    $date = date("Y-m-d");
    $datesecond  = date("Y-m-d h:i:s");

    // Asignamos una ruta para el proceso de imagen 
    $ruta = 'images/photos/'.$profile.'/normal-'.$string.$date.'.jpg';

    // Asignamos una ruta para la base de datos
    $finalruta = 'images/photos/'.$profile.'/normal-'.$string.$date.'.jpg';

    list($widthimg, $heightimg) = getimagesize($temporal);

    // Procesamos archivo para redimensionar
    smart_resize_image($temporal, null, 300, 300, false , $ruta, true , false ,100);
   
     
    $SQLImg = 'INSERT INTO images ( location, user, dateimg) 
    VALUES ( :location, :user, :dateimg)';
    $stnimg = $conexion -> prepare($SQLImg);
    $stnimg -> bindParam(':location',$finalruta,PDO::PARAM_STR);
    $stnimg -> bindParam(':user',$_SESSION['usuario'],PDO::PARAM_INT);
    $stnimg -> bindParam(':dateimg',$datesecond,PDO::PARAM_STR);
    $stnimg -> execute();


    $conexion = null;


    echo base_url().$ruta;



}


// Sumar un referido al numero del usuario
function sumReferalNumber($user){

     // conexion de base de datos
     $conexion = Conexion::singleton_conexion();

     $SQL = 'UPDATE usuarios SET referalnum = referalnum + 1 WHERE id = :id';
     $sentence = $conexion -> prepare($SQL);
     $sentence -> bindParam(':id',$user,PDO::PARAM_INT);
     $sentence -> execute();

     $conexion = null;

}


function PaisesOptions($option){

    $conexion = Conexion::singleton_conexion();

    $SQL = 'SELECT * FROM paises';
    $stn = $conexion -> prepare($SQL);
    $stn -> execute();
    $results = $stn -> fetchAll();
    if (empty($results)){
    }else{
        foreach ($results as $key){
            if ($option == 1) 
            {
              echo '<option value="'.$key['id'].'">'.$key['nombre'].'</option>';
            }
            else
            {
              echo '<option value="'.$key['id'].'">'.$key['nombre'].'</option>';      
            }
        }
    }

    $conexion = null;

}



function PaisesOptionsUserProfileGet(){

    $conexion = Conexion::singleton_conexion();

    $SQL = 'SELECT paises.nombre,paises.id FROM usuarios INNER JOIN paises ON usuarios.pais = paises.id WHERE usuarios.id = :usuario';
    $stn = $conexion -> prepare($SQL);
    $stn -> bindParam(':usuario', $_SESSION['usuario'], PDO::PARAM_INT);
    $stn -> execute();
    $results = $stn -> fetchAll();
    if (empty($results)){
    }else{
        foreach ($results as $key){
            return '<option value="'.$key['id'].'" selected>'.$key['nombre'].'</option>';
        }
    }

    $conexion = null;


}


function PaisesOptionsUserProfileGetPerID($id){

    $conexion = Conexion::singleton_conexion();

    $SQL = 'SELECT paises.id, paises.nombre FROM paises INNER JOIN usuarios ON usuarios.pais = paises.id WHERE usuarios.id = :usuario';
    $stn = $conexion -> prepare($SQL);
    $stn -> bindParam(':usuario', $id, PDO::PARAM_INT);
    $stn -> execute();
    $results = $stn -> fetchAll();
    if (empty($results)){
    }else{
        foreach ($results as $key){
            $data = '<option value="'.$key['id'].'" selected>'.$key['nombre'].'</option>';
            return $data;
        }
    }

    $conexion = null;


}


// Funcion para el perfil del usuario
function formProfileFunctionGetData(){

    $conexion = Conexion::singleton_conexion();

    $SQL = 'SELECT usuarios.nombre,usuarios.apellido,information.phone FROM usuarios INNER JOIN information ON information.usuario = usuarios.id WHERE usuarios.id = :usuario';
    $stn = $conexion -> prepare($SQL);
    $stn -> bindParam(':usuario', $_SESSION['usuario'], PDO::PARAM_INT);
    $stn -> execute();
    $results = $stn -> fetchAll();
    if (empty($results)){
    }else{
        foreach ($results as $key){
            echo '

                   <form id="myprofileform">
                       <input type="hidden" value="5" name="process" >
                       <label>Nombre:</label>
                       <input value="'.$key['nombre'].'" name="nombre" class="form-control" type="text" placeholder="Nombre" disabled="">
                       <p></p>
                       <label>Apellido:</label>
                       <input value="'.$key['apellido'].'" name="apellido" class="form-control" type="text" placeholder="Apellido" disabled="">
                       <p></p>
                       <label>Pais:</label>
                       <select name="pais" class="form-control" disabled="">
                         <optgroup>
                            '.PaisesOptionsUserProfileGet().'
                         </optgroup>
                         <optgroup>
                            ';
                            PaisesOptions(2); 
                            echo'
                         </optgroup>
                       </select>
                       <p></p>
                       <label>Telefono:</label>
                       <input value="'.$key['phone'].'" name="phone" class="form-control" type="text" placeholder="Telefono" disabled="">
                       <p></p>
                   </form>

            ';
        }
    }

    $conexion = null;

}




function ShowIPAccessPerUser(){

    $conexion = Conexion::singleton_conexion();

    $SQL = 'SELECT * FROM access WHERE usuario = :usuario ORDER BY id DESC LIMIT 10';
    $stn = $conexion -> prepare($SQL);
    $stn -> bindParam(':usuario', $_SESSION['usuario'], PDO::PARAM_INT);
    $stn -> execute();
    $results = $stn -> fetchAll();
    if (empty($results)){
    }else{
        foreach ($results as $key){
            echo '
                <tr>
                  <td>'.$key['ipadress'].'</td>
                  <td>'.date('d/m/Y h:i:s A', strtotime($key['dateaccess'])).'</td>
                </tr>
            ';
        }
    }

    $conexion = null;


}


function checkInformationEx(){


    $conexion = Conexion::singleton_conexion();

    $SQL = 'SELECT * FROM information WHERE usuario = :usuario';
    $stn = $conexion -> prepare($SQL);
    $stn -> bindParam(':usuario', $_SESSION['usuario'], PDO::PARAM_INT);
    $stn -> execute();
    $results = $stn -> fetchAll();
    if (empty($results)){

        header('Location: '.base_url_return().'laststep');

    }else{
        
    }

    $conexion = null;

}


function checkInformationEx2(){


    $conexion = Conexion::singleton_conexion();

    $SQL = 'SELECT * FROM information WHERE usuario = :usuario';
    $stn = $conexion -> prepare($SQL);
    $stn -> bindParam(':usuario', $_SESSION['usuario'], PDO::PARAM_INT);
    $stn -> execute();
    $results = $stn -> fetchAll();
    if (empty($results)){
    }else{
        header('Location: '.base_url_return().'dashboard');
    }

    $conexion = null;

}



function checkInformationReturn(){


    $conexion = Conexion::singleton_conexion();

    $SQL = 'SELECT * FROM information WHERE usuario = :usuario';
    $stn = $conexion -> prepare($SQL);
    $stn -> bindParam(':usuario', $_SESSION['usuario'], PDO::PARAM_INT);
    $stn -> execute();
    $results = $stn -> fetchAll();
    if (empty($results)){

        return TRUE;

    }else{

        return FALSE;
        
    }

    $conexion = null;

}




function showInformationProfileUser(){


    $conexion = Conexion::singleton_conexion();

    $SQL = 'SELECT * FROM usuarios WHERE usuario = :usuario';
    $stn = $conexion -> prepare($SQL);
    $stn -> bindParam(':usuario', $_SESSION['usuario'], PDO::PARAM_INT);
    $stn -> execute();
    $results = $stn -> fetchAll();
    if (empty($results)){
    }else{

      foreach ($results as $key) 
      {
        echo '


        ';
      }
        
    }

    $conexion = null;

}



function emailConfig(){

    $conexion = Conexion::singleton_conexion();

    $SQL = 'SELECT * FROM config WHERE id = 1';
    $stn = $conexion -> prepare($SQL);
    $stn -> execute();
    $results = $stn -> fetchAll();
    if (empty($results)){
    }else{
        foreach ($results as $key){
            $smtp = $key['smtp'];
            $port = $key['port'];
            $typesmtp = $key['typesmtp'];
            $email = $key['email'];
            $password = $key['password'];
            $name = $key['name'];
            $subject = $key['subject'];
        }

        $data = $smtp.'|'.$port.'|'.$typesmtp.'|'.$email.'|'.$password.'|'.$name.'|'.$subject;
        return $data;
    }

    $conexion = null;


}



function Stars(){

  $conexion = Conexion::singleton_conexion();

  $SQL = 'SELECT * FROM usuarios WHERE id = :id';
  $stn = $conexion -> prepare($SQL);
  $stn -> bindParam(':id', $_SESSION['usuario'] ,PDO::PARAM_INT);
  $stn -> execute();
  $rst = $stn -> fetchAll();
  if (empty($rst))
  {
    return 1;
  }
  else
  {
    foreach ($rst as $key){
        $referalnum = $key['referalnum'];
    }

      if ($referalnum == 0) {
         echo '
            <i class="fa fa-star-o fa-2x" aria-hidden="true"></i>
            <i class="fa fa-star-o fa-2x" aria-hidden="true"></i>
            <i class="fa fa-star-o fa-2x" aria-hidden="true"></i>
            <i class="fa fa-star-o fa-2x" aria-hidden="true"></i>
            <i class="fa fa-star-o fa-2x" aria-hidden="true"></i>
         ';
      }else if ($referalnum == 1) {
         echo '
            <i class="fa fa-star-half-o fa-2x" aria-hidden="true"></i>
            <i class="fa fa-star-o fa-2x" aria-hidden="true"></i>
            <i class="fa fa-star-o fa-2x" aria-hidden="true"></i>
            <i class="fa fa-star-o fa-2x" aria-hidden="true"></i>
            <i class="fa fa-star-o fa-2x" aria-hidden="true"></i>
         ';
      }else if ($referalnum < 2){
         echo '
            <i class="fa fa-star fa-2x" aria-hidden="true"></i>
            <i class="fa fa-star-half-o fa-2x" aria-hidden="true"></i>
            <i class="fa fa-star-o fa-2x" aria-hidden="true"></i>
            <i class="fa fa-star-o fa-2x" aria-hidden="true"></i>
            <i class="fa fa-star-o fa-2x" aria-hidden="true"></i>

         ';
      }else if ($referalnum > 2 || $referalnum < 6) {
         echo '
            <i class="fa fa-star fa-2x" aria-hidden="true"></i>
            <i class="fa fa-star fa-2x" aria-hidden="true"></i>
            <i class="fa fa-star-half-o  fa-2x" aria-hidden="true"></i>
            <i class="fa fa-star-o fa-2x" aria-hidden="true"></i>
            <i class="fa fa-star-o fa-2x" aria-hidden="true"></i>
         ';
      }else if ($referalnum > 6 || $referalnum < 14) {
         echo '
            <i class="fa fa-star-o fa-2x" aria-hidden="true"></i>
            <i class="fa fa-star-o fa-2x" aria-hidden="true"></i>
            <i class="fa fa-star-o fa-2x" aria-hidden="true"></i>
            <i class="fa fa-star-o fa-2x" aria-hidden="true"></i>
            <i class="fa fa-star-o fa-2x" aria-hidden="true"></i>
         ';
      }



  }

  $conexion = null;

}



function emailConfigForm(){

    $conexion = Conexion::singleton_conexion();

    $SQL = 'SELECT * FROM config WHERE id = 1';
    $stn = $conexion -> prepare($SQL);
    $stn -> execute();
    $results = $stn -> fetchAll();
    if (empty($results)){
    }else{
        foreach ($results as $key){

          if ($key['typesmtp'] == 1) {
            $datasmtp ='
               <option value="1">TLS</option>
               <option value="2">SSL</option>            
            ';
          }else{
            $datasmtp ='
               <option value="2">SSL</option> 
               <option value="1">TLS</option>           
            ';
          }

          echo'
            <div class="col-md-12 col-sm-12 col-xs-12">
              <form id="emcform">
                  <input type="hidden" value="6" name="process">
                  <label>SMTP:</label>
                  <input type="text" name="smtp" class="form-control" value="'.$key['smtp'].'">
                  <p></p>
                  <label>Puerto:</label>
                  <input type="text" name="port" class="form-control" value="'.$key['port'].'">
                  <p></p>
                  <label>Tipo de Autenticación:</label>
                  <select class="form-control" name="typesmtp">
                  '.$datasmtp.'
                  </select>
                  <p></p>
                  <label>Correo Electronico:</label>
                  <input type="text" name="email" class="form-control" value="'.$key['email'].'">
                  <p></p>
                  <label>Contraseña:</label>
                  <input type="password" name="password" class="form-control" value="'.$key['password'].'">
                  <p></p>
                  <label>Nombre Asignado:</label>
                  <input type="text" name="name" class="form-control" value="'.$key['name'].'">
                  <p></p>
                  <label>Asunto:</label>
                  <input type="text" name="subject" class="form-control" value="'.$key['subject'].'">
                  <p></p>                                                                                  
              </form>
              <div class="col-md-12 col-sm-12 col-xs-12 nopadding">
                 <button onclick="saveConfigEmc();" class="btn btn-blue pull-right"><i class="fa fa-floppy-o"></i> Guardar</button>
              </div>
            </div>
          ';

        }

    }

    $conexion = null;

}


function checkModuleAdm(){

  $conexion = Conexion::singleton_conexion();

  $SQL = 'SELECT * FROM config WHERE id = 1';
  $stn = $conexion -> prepare($SQL);
  $stn -> execute();
  $rst = $stn -> fetchAll();
  foreach ($rst as $key) 
  {

         if ($key['iniciodesesion'] == 1) {
           $actv1 = '';
         }else{
           $actv1 = 'switchOn';
         }
          if ($key['recuperacion'] == 1) {
           $actv2 = '';
         }else{
           $actv2 = 'switchOn';
         }
          if ($key['registro'] == 1) {
           $actv3 = '';
         }else{
           $actv3 = 'switchOn';
         }
          if ($key['fotoperfil'] == 1) {
           $actv4 = '';
         }else{
           $actv4 = 'switchOn';
         }
          if ($key['sitio'] == 1) {
           $actv5 = '';
         }else{
           $actv5 = 'switchOn';
         }
          if ($key['registroarbol'] == 1) {
           $actv6 = '';
         }else{
           $actv6 = 'switchOn';
         }


    echo '
          <div class="col-md-6">
               <label>
                   <p>Inicio de Sesión:</p>
                   <div id="module-1" data-module="1" class="switch '.$actv1.'"></div>
               </label>
               <p></p>
               <label>
                   <p>Recuperación de Cuenta:</p>
                   <div id="module-2" data-module="2" class="switch '.$actv2.'"></div>
               </label>
               <p></p>
               <label>
                  <p>Registro:</p>
                   <div id="module-3" data-module="3" class="switch '.$actv3.'"></div>
              </label>
          </div>
          <div class="col-md-6">
               <label>
                   <p>Foto de Perfil:</p>
                   <div id="module-4" data-module="4" class="switch '.$actv4.'"></div>
               </label>
               <p></p>
               <label>
                   <p>Registro en Arbol:</p>
                   <div id="module-6" data-module="6" class="switch '.$actv6.'"></div>
               </label>
          </div>
    ';

  }  

  $conexion = null;

}

function checkModActivePage($mod){

     $conexion = Conexion::singleton_conexion();

     if ($mod == 1){
       $data = 'iniciodesesion';
     }else if($mod == 2){
       $data = 'registroarbol';
     }else if($mod == 3){
       $data = 'sitio';
     }else if($mod == 4){
       $data = 'fotoperfil';
     }else if($mod == 5){
       $data = 'recuperacion';
     }else if($mod == 6){
       $data = 'registro';
     }

     $SQL = 'SELECT '.$data.' FROM config WHERE id = 1';
     $stn = $conexion -> prepare($SQL);
     $stn -> execute();
     $rst = $stn -> fetchAll();
     foreach ($rst as $key){
         $result = $key[$data];
     }

     return $result;

     $conexion = null;


}