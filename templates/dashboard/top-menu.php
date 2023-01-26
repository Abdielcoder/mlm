        <div class="topbar" style="width: 1010px;">
          <div class="header-left">
            <div class="topnav">
              <a class="menutoggle" href="#" data-toggle="sidebar-collapsed"><span class="menu__handle"><span>Menu</span></span></a>
            </div>
          </div>
          <div class="header-right">
            <ul class="header-menu nav navbar-nav">
              <?php
                 if ($_SESSION['rango'] == 2){
              ?>
               <li id="adminbtn"><a href="<?php base_url(); ?>administrator"> Administración</a></li>
              <?php
                 }
              ?>

              <!-- BEGIN USER DROPDOWN -->
              <li class="dropdown" id="user-header">
                <a href="#" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
                <i class="icon-user"></i>
                <span class="username"><?php nameUser(); ?></span>
                </a>
                <ul class="dropdown-menu">
                  <li>
                    <a href="<?php base_url(); ?>configuration"><i class="icon-settings"></i><span>Configuración</span></a>
                  </li>
                  <li>
                    <a href="<?php base_url(); ?>logout"><i class="icon-logout"></i><span>Cerrar Sesión</span></a>
                  </li>
                </ul>
              </li>
              <!-- END USER DROPDOWN -->
            </ul>
          </div>
          <!-- header-right -->
        </div>