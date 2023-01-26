    
    <?php checkInformationEx(); ?>

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


            <div class="col-md-6">
              <div class="panel">
                <div class="panel-content">
                  <h4><strong>Link de Referencia:</strong></h4>
                    <div class="input-group">
                      <input id="referallink" type="text" class="form-control" value="<?php echo get_referal_link(); ?>" readonly>
                      <span class="input-group-btn">
                        <button onclick="copyToClipboard('#referallink');" class="btn btn-default" type="button">Copiar</button>
                      </span>
                    </div><!-- /input-group -->
                </div>
              </div>
            </div>

            <div class="col-md-6">
              <div class="panel">
                <div class="panel-content">
                  <h4><strong>Niveles:</strong></h4>
                    <div class="input-group stars">
                         <?php
                          Stars(); 
                         ?>
                         <p></p>
                    </div><!-- /input-group -->
                </div>
              </div>
            </div>


           <div class="col-md-12">
             <div class="panel panel-default">
               <div class="panel-body">
                <div class="col-md-12 col-sm-12 col-xs-12">
                  <h4 class="pull-left"><strong>Arbol:</strong></h4>
                  <a class="btn btn-blue pull-right tree-user"><i class="fa fa-user-plus" aria-hidden="true"></i> Agregar Usuario al Arbol</a>
                </div>
                 <?php
                    $arbol = new Arbol();
                    $arbol->createDesktop($_SESSION['usuario']);
                 ?>
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


<!-- Agregar Usuario -->
<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header bg-blue">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Agregar Al Arbol</h4>
      </div>
      <div class="modal-body">

         <div id="alertadd1" class="alert alert-info text-center" role="alert">
            <i class="fa fa-clock-o fa-5x fa-spin"></i>
            <p class="text-center">Estamos verficando los datos que has enviado, espere un momento.</p>
         </div>

         <div id="alertadd2" class="alert alert-success text-center" role="alert">
            <i class="fa fa-check-square-o fa-5x animated flash infinite" aria-hidden="true"></i>
            <p class="text-center">¡Datos Correctos! Se ha enviado un correo electronico con el enlace de registro.</p>
         </div>

         <div id="alertadd3" class="alert alert-danger text-center" role="alert">
            <i class="fa fa-times fa-5x animated flash infinite" aria-hidden="true"></i>
            <p class="text-center">El sistema no puede procesar estos datos, puede ser porque el correo electronico ya esta en uso.</p>
         </div>


         <form id="addtotree">
            <input type="hidden" name="process" value="6">  
            <label>Correo Electronico:</label>
            <input type="text" name="email" class="form-control">
            <p></p>
            <label>Mensaje:</label>
            <textarea class="form-control" rows="5" name="mensaje"></textarea>
            <input id="positioninpt" type="hidden" name="position" value="">      
         </form>
         <p></p>
         <div class="alert alert-warning" role="alert">
           <p id="sideu" class="text-center">El sistema asignara automaticamente un lugar en el arbol una vez que el usuario active su registro usando el enlace de invitación, enviado en este mensaje.</p>
         </div>
      </div>

      <div id="modalfootertree" class="modal-footer">
        <button onclick="AgregarAlArbol();" type="button" class="btn btn-primary"><i class="fa fa-check" aria-hidden="true"></i> Agregar al Arbol</button>
        <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times"></i> Cancelar</button>
      </div>
    </div>
  </div>
</div>
<!-- Agregar /Usuario -->