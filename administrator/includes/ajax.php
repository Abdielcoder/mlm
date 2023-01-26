<?php


require_once 'functions.php';

// Función para que no se ejecute el archivo directamente
if ( $_SERVER['REQUEST_METHOD']=='GET' && realpath(__FILE__) == realpath( $_SERVER['SCRIPT_FILENAME'] ) ) {
    header( 'HTTP/1.0 403 Forbidden', TRUE, 403 );
}

//
$post = $_POST['process'];

//
if (isset($post)){

   if (is_null($post)){exit;}
   if (empty($post)){exit;}
   if (ctype_space($post)){exit;}

   //
   if ($post == 1){
   	//----------------------------------------------------------------------------------------------------------
       echo '
            <div id="format-window-1" class="panel panel-default animated fadeInUp panel-folder">
             <div class="panel-heading">
               <div class="pull-left titlew" data-id="1"><i class="fa fa-user-o"></i> Usuarios</div>
               <a class="pull-right closew" onclick="CloseWin(1)"><i class="fa fa-times" aria-hidden="true"></i></a>
               <a class="pull-right bigw" onclick="MaxWin(1)"><i class="fa fa-window-maximize" aria-hidden="true"></i></a>
               <a class="pull-right smallw" onclick="SmallWin(1)"><i class="fa fa-window-restore" aria-hidden="true"></i></a>
               <a class="pull-right minusw" onclick="MinusWin(1)"><i class="fa fa-minus" aria-hidden="true"></i></a>
             </div>
              <div class="panel-body">
                 <table id="usrsTable" class="table" style="display:none;">
                    <thead>
                       <tr>
                         <th>Acciones</th>
                         <th>Rango</th>
                         <th>Referidos</th>
                         <th>Email</th>
                         <th>Apellido</th>
                         <th>Nombre</th>
                       </tr>
                    </thead>
                    <tbody id="users-tbody">

                    </tbody>
                 </table>
              </div>
              <script>
                 App();
                 UsuariosAdm();
              </script>
            </div>
       ';

    //----------------------------------------------------------------------------------------------------------
   }else if ($post == 2){
   	//----------------------------------------------------------------------------------------------------------
       echo '
            <div id="format-window-2" class="panel panel-default animated fadeInUp panel-folder">
             <div class="panel-heading">
               <div class="pull-left titlew" data-id="2"><i class="fa fa-cog fa-spin"></i> Ajustes</div>
               <a class="pull-right closew" onclick="CloseWin(2)"><i class="fa fa-times" aria-hidden="true"></i></a>
               <a class="pull-right bigw" onclick="MaxWin(2)"><i class="fa fa-window-maximize" aria-hidden="true"></i></a>
               <a class="pull-right smallw" onclick="SmallWin(2)"><i class="fa fa-window-restore" aria-hidden="true"></i></a>
               <a class="pull-right minusw" onclick="MinusWin(2)"><i class="fa fa-minus" aria-hidden="true"></i></a>
             </div>
              <div class="panel-body">
                 Panel content
              </div>
              <script>App();</script>
            </div>
       ';

    //----------------------------------------------------------------------------------------------------------
   }else if ($post == 3){
   	//----------------------------------------------------------------------------------------------------------
       echo '
            <div id="format-window-3" class="panel panel-default animated fadeInUp panel-folder" style="width:500px;top: 19%;left: 37%;">
             <div class="panel-heading">
               <div class="pull-left titlew" data-id="3"><i class="fa fa-th-large"></i> Modulos</div>
               <a class="pull-right closew" onclick="CloseWin(3)"><i class="fa fa-times" aria-hidden="true"></i></a>
               <a class="pull-right minusw" onclick="MinusWin(3)"><i class="fa fa-minus" aria-hidden="true"></i></a>
             </div>
              <div id="modules-body" class="panel-body">';

                 checkModuleAdm();

              echo '
              </div>
              <script>App();</script>
            </div>
       ';

    //----------------------------------------------------------------------------------------------------------
   }else if ($post == 4){
   	//----------------------------------------------------------------------------------------------------------
       echo '
            <div id="format-window-4" class="panel panel-default animated fadeInUp panel-folder" style="width:500px;top: 19%;left: 37%;">
             <div class="panel-heading">
               <div class="pull-left titlew" data-id="4"><i class="fa fa-envelope-o"></i> Correo</div>
               <a class="pull-right closew" onclick="CloseWin(4)"><i class="fa fa-times" aria-hidden="true"></i></a>
               <a class="pull-right minusw" onclick="MinusWin(4)"><i class="fa fa-minus" aria-hidden="true"></i></a>
             </div>
              <div class="panel-body">';
                 
                 emailConfigForm();
              
        echo'
              </div>
              <script>App();</script>
            </div>
       ';

    //----------------------------------------------------------------------------------------------------------
   }else if ($post == 5){

      // conexion de base de datos
      $conexion = Conexion::singleton_conexion();
     
      $SQL = 'SELECT * FROM usuarios';
      $stn = $conexion -> prepare($SQL);
      $stn -> execute();
      $rst = $stn -> fetchAll();
      if (empty($rst)){
           exit();
      }else{


         foreach ($rst as $key){

            if ($key['rank'] == 1){
              $ranker = 'Usuario';
            }else{
              $ranker = 'Administrador';
            }

            $acciones = '<button onclick="editUserAdm('.$key['id'].')" class="btneditus btn btn-sm btn-block btn-blue" >Editar</button>';

            echo '
            <tr id="usuario'.$key['id'].'">
               <td>'.$acciones.'</td>
               <td>'.$ranker.'</td>
               <td class="text-center">'.$key['referalnum'].'</td>
               <td>'.$key['email'].'</td>
               <td>'.$key['apellido'].'</td>
               <td>'.$key['nombre'].'</td>
            </tr>
              ';
           }

           echo $arr;
      }

      $conexion = null;   
  





   }else if ($post == 6) {


     // XSS
     $xss = new xss_filter();

     $smtp = $xss->filter_it($_POST['smtp']);
     $port = $xss->filter_it($_POST['port']);
     $typesmtp = $xss->filter_it($_POST['typesmtp']);
     $email = $xss->filter_it($_POST['email']);
     $password = $xss->filter_it($_POST['password']);
     $name = $xss->filter_it($_POST['name']);
     $subject = $xss->filter_it($_POST['subject']);
  
     if (empty($smtp) || ctype_space($smtp) || is_null($smtp)) {echo 1;exit();}
     if (empty($port) || ctype_space($port) || is_null($port)) {echo 1;exit();}
     if (empty($typesmtp) || ctype_space($typesmtp) || is_null($typesmtp)) {echo 1;exit();}
     if (empty($email) || ctype_space($email) || is_null($email)) {echo 1;exit();}
     if (empty($password) || ctype_space($password) || is_null($password)) {echo 1;exit();}
     if (empty($name) || ctype_space($name) || is_null($name)) {echo 1;exit();}
     if (empty($subject) || ctype_space($subject) || is_null($subject)) {echo 1;exit();}


      // conexion de base de datos
      $conexion = Conexion::singleton_conexion();

      $SQL = 'UPDATE config SET smtp = ?, port = ?, typesmtp = ?, email = ?, password = ?, name = ?, subject = ? WHERE id = 1';
      $stn = $conexion -> prepare($SQL);
      $stn -> bindParam(1, $smtp ,PDO::PARAM_STR);
      $stn -> bindParam(2, $port ,PDO::PARAM_INT);
      $stn -> bindParam(3, $typesmtp ,PDO::PARAM_INT);
      $stn -> bindParam(4, $email ,PDO::PARAM_STR);
      $stn -> bindParam(5, $password ,PDO::PARAM_STR);
      $stn -> bindParam(6, $name ,PDO::PARAM_STR);
      $stn -> bindParam(7, $subject ,PDO::PARAM_STR);
      $stn -> execute();

      $conexion = null;

      echo 2;


   }else if ($post == 7) {
  

       $modulo = $_POST['module'];

       if (empty($modulo) || ctype_space($modulo) || is_null($modulo)) {echo 1;exit();}


       // conexion de base de datos
       $conexion = Conexion::singleton_conexion();

       $SQL = 'SELECT * FROM config WHERE id = 1';
       $stn = $conexion -> prepare($SQL);
       $stn -> execute();
       $rst = $stn -> fetchAll();
       foreach ($rst as $key){

            if ($modulo == 1){
                $active = $key['iniciodesesion'];

                if ($active == 1){
                   $fndt = 'iniciodesesion = 2';
                }else{
                   $fndt = 'iniciodesesion = 1';
                }
            }else if ($modulo == 2) {
                $active = $key['recuperacion'];

                if ($active == 1){
                   $fndt = 'recuperacion = 2';
                }else{
                   $fndt = 'recuperacion = 1';
                }
            }else if ($modulo == 3) {
                $active = $key['registro'];

                if ($active == 1){
                   $fndt = 'registro = 2';
                }else{
                   $fndt = 'registro = 1';
                }
            }else if ($modulo == 4) {
                $active = $key['fotoperfil'];

                if ($active == 1){
                   $fndt = 'fotoperfil = 2';
                }else{
                   $fndt = 'fotoperfil = 1';
                }
            }else if ($modulo == 5) {
                $active = $key['sitio'];

                if ($active == 1){
                   $fndt = 'sitio = 2';
                }else{
                   $fndt = 'sitio = 1';
                }
            }else if ($modulo == 6) {
                $active = $key['registroarbol'];

                if ($active == 1){
                   $fndt = 'registroarbol = 2';
                }else{
                   $fndt = 'registroarbol = 1';
                }
            }
         
       }

       $update = 'UPDATE config SET '.$fndt.' WHERE id = 1';
       $stnu = $conexion -> prepare($update);
       $stnu -> execute();

       echo $fndt;
 

   }

   else if ($post == 8) {


      // conexion de base de datos
      $conexion = Conexion::singleton_conexion();

      if (isset($_POST['id'])) {
        $theid = $_POST['id'];
      }else{
        exit();
      }
       
      $SQL = 'SELECT usuarios.id AS userid, usuarios.nombre, usuarios.apellido, usuarios.email, usuarios.referal, usuarios.referalnum, usuarios.activo, usuarios.pais, usuarios.rank, usuarios.pais, information.phone FROM usuarios INNER JOIN information ON information.usuario = usuarios.id WHERE usuarios.id = :id';
      $stn = $conexion -> prepare($SQL);
      $stn -> bindParam(':id' , $theid , PDO::PARAM_INT);
      $stn -> execute();
      $rst = $stn -> fetchAll();
      if (empty($rst))
      {
        $conexion = null;
        exit();
      }else{
         foreach ($rst as $key){
              $iduser = $key['userid'];
              $nombre = $key['nombre'];
              $apellido = $key['apellido'];
              $email  = $key['email'];
              $linkreferal =  $key['referal'];
              $referidos  = $key['referalnum'];
              $pais = $key['pais'];
              $activo = $key['activo'];
              $rank = $key['rank'];
              $phone = $key['phone'];
         }

         if ($rank == 1){
           $datark = '
              <option value="1">Usuario</option>
              <option value="2">Administrador</option>
           ';
         }else if ($rank == 2){
           $datark = '
              <option value="2">Administrador</option>
              <option value="1">Usuario</option>
           ';
         }


         if ($activo == 1){
           $dataact = '
              <option value="1">Inactivo</option>
              <option value="2">Activo</option>
           ';
         }else if ($activo == 2){
           $dataact = '
              <option value="2">Activo</option>
              <option value="1">Inactivo</option>
           ';
         }

         echo'


    <!-- Modal -->
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header bg-blue">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="myModalLabel">Editar Usuario</h4>
          </div>
          <div id="editUAppend" class="modal-body">

               <!-- Nav tabs -->
               <ul class="nav nav-tabs" role="tablist">
                 <li role="presentation" class="active"><a href="#home" aria-controls="home" role="tab" data-toggle="tab">Datos Generales</a></li>
                 <li role="presentation"><a href="#profile" aria-controls="profile" role="tab" data-toggle="tab">Imagen de Perfil</a></li>
                 <li role="presentation"><a href="#messages" aria-controls="messages" role="tab" data-toggle="tab">Correo Eletronico & Contraseña</a></li>
               </ul>

               <!-- Tab panes -->
               <div class="tab-content">
                 <div role="tabpanel" class="tab-pane active" id="home">
                   <form id="generalUForm">
                      <label>Nombre:</label>
                      <input type="text" name="nombre" class="form-control form-white" value="'.$nombre.'">
                      <p></p>
                      <label>Apellido:</label>
                      <input type="text" name="apellido" class="form-control form-white" value="'.$apellido.'">
                      <p></p>
                      <label>Pais:</label>
                      <select class="form-control" name="Pais">
                          <optgroup>
                          '.PaisesOptionsUserProfileGetPerID($iduser).'
                          </optgroup>
                          <optgroup>';
                             PaisesOptions(2);
                          echo'</optgroup>
                      </select>
                      <p></p>
                      <label>Rango:</label>
                      <select class="form-control" name="rango">
                       '.$datark.'
                      </select>
                      <p></p>
                      <label>Estado:</label>
                      <select class="form-control" name="status">
                        '.$dataact.'
                      </select>
                      <p></p>
                      <label>Telefono:</label>
                      <input type="text" name="celular" class="form-control form-white" value="'.$phone.'">
                      <p></p>
                      <label>Numero de Referidos:</label>
                      <input type="text" name="referalnum"  value="'.$referidos.'" class="form-control" disabled>
                      <p></p>
                      <label>Link de Referencia:</label>
                      <input type="text" class="form-control" value="'.base_url_return().$linkreferal.'" readonly>
                      <p></p>
                   </form>

                   <button type="button" class="btn btn-success">Guardar Cambios</button>
                   <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>

                 </div>

                 <div role="tabpanel" class="tab-pane text-center" id="profile">
                    '.myImageUserPerID($iduser).'
                 </div>


                 <div role="tabpanel" class="tab-pane" id="messages">
                   
                     <div class="panel panel-default">
                       <div class="panel-heading">Cambiar Contraseña</div>
                       <div class="panel-body">

                        <form id="">
                         <label>Contraseña:</label>
                         <input type="hidden" name="process" value="">
                         <input type="password" class="form-control" name="pass">
                         <p></p>
                        </form>

                         <button class="btn btn-blue">Cambiar Contraseña</button>

                       </div>
                     </div>

                     <p></p>

                     <div class="panel panel-default">
                       <div class="panel-heading">Correo Electronico</div>
                       <div class="panel-body">

                        <form id="">
                         <label>Contraseña:</label>
                         <input type="hidden" name="process" value="">
                         <input type="password" class="form-control" name="pass">
                         <p></p>
                        </form>

                         <button class="btn btn-blue">Cambiar Correo Electronico</button>

                       </div>
                     </div>

                     <p></p>
                   
                 </div>

               </div>
               <p></p>


          </div>
        </div>
      </div>
    </div>
         ';


      }
      

      $conexion = null;











   }else if ($post == 9){
     













   }



}else{
	echo "";
}
