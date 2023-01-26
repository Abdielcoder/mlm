<?php
  checkInformationEx2();
?>
<div id="laststep">
   <div class="panel panel-default">
     <div class="panel-heading text-center"><strong>Solo Queda 1 Paso Mas Para Activar Tu Cuenta</strong></div>
     <div class="panel-body">
       <form id="laststepform">
         <input type="hidden" name="process" value="4">
         <p></p>
       	 <div class="input-group">
           <span class="input-group-addon"><i class="fa fa-phone" aria-hidden="true"></i></span>
           <input type="text" name="phone" class="form-control form-white" placeholder="Tu Numero de Celular">
         </div>

       </form>
       <p></p>
       <button id="laststepbutton" class="btn btn-default btn-lg btn-block">Activar Mi Cuenta</button>

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
                <p class="text-center">Has activado tu cuenta correctamente, en un momento seras redireccionado.</p>
              </div>
          </div>
      </div>


     </div>
   </div>
</div>

