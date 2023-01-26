
    <section style="opacity: 1;">
      <!-- BEGIN SIDEBAR -->
      <?php themeAdd('dashboard/menu.php'); ?>
      <!-- END SIDEBAR -->
      <div class="main-content">
        <!-- BEGIN TOPBAR -->
        <?php themeAdd('dashboard/top-menu.php'); ?>
        <!-- END TOPBAR -->
        <!-- BEGIN PAGE CONTENT -->
        <div class="page-content">
          <div class="row">

            <div class="col-md-6 col-sm-6 col-xs-12">
              <div class="panel panel-default">
                 <div class="panel-heading">
                  <i class="fa fa-user"></i>  Datos de Usuario
                 </div>
                <div class="panel-body">
                     <?php formProfileFunctionGetData();  ?>
                   <p></p>

                   <button id="savechangesprofile" onclick="saveChangeProfile()" class="btn btn-block btn-success">Guardar Cambios</button>
                   <button id="editprofilebutton" onclick="editProfile()" class="btn btn-block btn-default">Cambiar mis Datos</button>
                   <button class="btn btn-block btn-default" data-toggle="modal" data-target="#myModalC">Cambiar mi Contraseña</button>
                   <button class="btn btn-block btn-default" data-toggle="modal" data-target="#myModalE">Cambiar Mi Correo Electronico</button>
                </div>
              </div>
            </div>

            <div class="col-md-6 col-sm-6 col-xs-12">
              <div class="panel panel-default">
                 <div class="panel-heading">
                  <i class="fa fa-eye"></i>  Ultimos Accesos:
                 </div>
                <div class="panel-body">
                  <table class="table">
                    <thead>
                       <tr>
                         <th>Dirección IP</th>
                         <th>Fecha</th>
                       </tr>
                    </thead>
                    <tbody>
                      <?php
                         ShowIPAccessPerUser();
                      ?>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>

           <div class="col-md-6 col-sm-6 col-xs-12">
              <div class="panel panel-default">
                <div class="panel-heading"><i class="fa fa-link" aria-hidden="true"></i> Link de Referencia</div>
                <div class="panel-body">
                    <form id="referalfrmlnk">
                        <input type="hidden" name="process" value="7">
                        <input id="rlperuser" type="text" name="referalink" class="form-control text-center" value="<?php echo get_just_referal_link(); ?>" readonly>
                    </form>
                    <p></p>
                    <button id="linkper" class="btn btn-blue btn-block"><i class="fa fa-hand-pointer-o" aria-hidden="true"></i> Personalizar Link</button>
                    <button id="linkpersave" class="btn btn-success btn-block"><i class="fa fa-floppy-o" aria-hidden="true"></i> Guardar Cambios</button>
                    <button onclick="genRS();" class="btn btn-warning btn-block"><i class="fa fa-circle-o" aria-hidden="true"></i> Generar Random URL</button>
                    <p></p>
                    <div class="alert alert-info text-center" role="alert">
                      Tu nuevo link de referencia no puede tener espacios en blanco ni caracteres como "ñ" o letras con tildes como "á" de esta manera tu link de referencia sera funcional para el sistema.
                    </div>
                </div>
              </div>
           </div>


          </div>
        </div>
        <!-- END PAGE CONTENT -->
      </div>
      <!-- END MAIN CONTENT -->

    </section>
    <!-- END QUICKVIEW SIDEBAR -->


<!-- Modal -->
<div class="modal fade" id="myModalC" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header bg-blue">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Cambiar mi Contraseña</h4>
      </div>
      <div class="modal-body">
          <form id="passform">
             
             <label>Contraseña Actual:</label>
             <input type="password" name="actual" class="form-control">
             <p></p>
             <label>Nueva Contraseña:</label>
             <input type="password" name="newpass" class="form-control">
             <input type="hidden" name="process" value="8">

          </form>

          <p></p>
          <div id="chgpass1" class="alert alert-success text-center" role="alert">Tu Contraseña se ha actualizado correctamente.</div>
          <div id="chgpass2" class="alert alert-warning text-center" role="alert">Esta contraseña ya esta en uso por ti, usa otra contraseña.</div>
          <div id="chgpass3" class="alert alert-danger text-center" role="alert">Tu contraseña actual no es correcta, intenta de nuevo.</div>

      </div>
      <div id="changepass4" class="modal-footer">
        <button onclick="ChangeMyPass();" type="button" class="btn btn-blue"><i class="fa fa-check"></i> Guardar Cambios</button>
        <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times"></i> Cancelar</button>
      </div>
    </div>
  </div>
</div>


<!-- Modal -->
<div class="modal fade" id="myModalE" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header bg-blue">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Cambio de Correo Electronico</h4>
      </div>
      <div class="modal-body">
         <form id="emailfrmch">
            <label>Contraseña Actual:</label>
            <input type="password" name="actual" class="form-control">
            <p></p>
            <label>Nuevo Correo Electronico:</label>
            <input type="text" name="newemail" class="form-control">
            <input type="hidden" name="process" value="9">
         </form>
         <p></p>
         <div id="chgemail1" class="alert alert-success text-center" role="alert">Tu Correo electronico se ha actualizado correctamente.</div>
         <div id="chgemail2" class="alert alert-warning text-center" role="alert">Esta correo electronico ya esta en uso por ti, si vas a cambiarlo usa otro.</div>
         <div id="chgemail3" class="alert alert-warning text-center" role="alert">Esta correo electronico ya esta en uso por otro usuario, usa otro.</div>
         <div id="chgemail4" class="alert alert-warning text-center" role="alert">Para cambiar tu correo electronico necesitas ingresar tu contraseña.</div>
      </div>
      <div class="modal-footer">
        <button onclick="ChangeMyEmail();" type="button" class="btn btn-blue"><i class="fa fa-check"></i> Guardar Cambios</button>
        <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times"></i> Cancelar</button>
      </div>
    </div>
  </div>
</div>