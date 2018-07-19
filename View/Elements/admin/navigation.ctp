<!-- <nav class="navbar-inverse sidebar">
	<div class="navbar-inner">
	<?php
		echo $this->Croogo->adminMenus(CroogoNav::items(), 
                  array('htmlAttributes' => array('id' => 'sidebar-menu')));
	   
        ?>
	</div>
</nav> -->
 
<nav class="navbar-inverse sidebar">
	<div class="navbar-inner">


<ul class="nav nav-stacked" id="sidebar-menu">

<li>
 <a href="<?php echo $this->base.'/pages/home'; ?>" class="menu-users hasChild dropdown-close sidebar-item">
  <i class="icon-home icon-large icon-large"></i> 
  <span>Home</span>
 </a>
 <ul class="nav nav-stacked sub-nav  submenu-users">
  <li>
   <a href="<?php echo $this->base.'/pages/home'; ?>" class="menu-users sidebar-item">
    <i class="icon-white icon-large"></i> 
    <span>inicio</span>
   </a>
  </li>
 </ul>
</li>


 <li><a href="#" class="menu-blocks hasChild dropdown-close sidebar-item"><i class="icon-calendar icon-large icon-large"></i> 
 <span>Citas</span></a>
 <ul class="nav nav-stacked sub-nav  submenu-blocks">
   <li class=" dropdown-submenu">
    <a href="#" class="menu-create hasChild dropdown-close sidebar-item"><i class="icon-white icon-large"></i>      
     <span>List</span>
    </a>
    <ul class="nav nav-stacked sub-nav  submenu-create dropdown-menu">
     <li>
      <a class="menu-list sidebar-item" href="<?php echo $this->base.'/full_calendar/'; ?>">
      <i class="icon-white icon-large"></i> <span>Agenda</span></a>
     </li>
     <li>
        <a href="<?php echo $this->base.'/full_calendar/events/'; ?>" class="menu-node sidebar-item">
         <i class="icon-white icon-large"></i> <span>Eventos</span>
        </a>
     </li>
     <li>
        <a href="<?php echo $this->base.'/full_calendar/event_types/'; ?>" class="menu-node sidebar-item">
         <i class="icon-white icon-large"></i> <span>Tipo de Eventos</span>
        </a>
     </li>
    </ul>
   </li>

   <li class=" dropdown-submenu">
    <a href="#" class="menu-create hasChild dropdown-close sidebar-item"><i class="icon-white icon-large"></i>      
     <span>Create</span>
    </a>
    <ul class="nav nav-stacked sub-nav  submenu-create dropdown-menu">
     <li>
      <a class="menu-list sidebar-item" href="<?php echo $this->base.'/full_calendar/events/add'; ?>">
       <i class="icon-white icon-large"></i> <span>Agendar</span></a>
     </li>
     <li>
      <a href="<?php echo $this->base.'/full_calendar/event_types/add'; ?>" class="menu-node sidebar-item">
       <i class="icon-white icon-large"></i> <span>Tipo de Eventos</span>
      </a>
     </li>
    </ul>
   </li>

  </ul>
 </li>


 <li><a href="#" class="menu-media hasChild dropdown-close sidebar-item"><i class="icon-group icon-large icon-large"></i>     
 <span>Clientes</span></a>
  <ul class="nav nav-stacked sub-nav submenu-media">
   <li>
    <a class="menu-attachments sidebar-item" href="<?php echo $this->base.'/Clientes/'; ?>">
     <i class="icon-white icon-large"></i> <span>List</span></a>
   </li>
   <li>
    <a href="<?php echo $this->base.'/Clientes/add'; ?>" class="menu-menus sidebar-item current">
     <i class="icon-white icon-large"></i> 
     <span>Create</span>
    </a>
   </li>
  </ul>
 </li>


 <li><a href="#" class="menu-content hasChild dropdown-close sidebar-item"><i class="icon-file-alt icon-large icon-large"></i> 
  <span>Expediente</span></a>
  <ul class="nav nav-stacked sub-nav  submenu-content">
   <li class=" dropdown-submenu">
    <a href="#" class="menu-create hasChild dropdown-close sidebar-item"><i class="icon-white icon-large"></i>      
     <span>List</span>
    </a>
    <ul class="nav nav-stacked sub-nav  submenu-create dropdown-menu">
     <li>
      <a class="menu-list sidebar-item" href="<?php echo $this->base.'/Expedientes/'; ?>">
       <i class="icon-white icon-large"></i> <span>Expediente</span>
      </a>
     </li>
<!--
     <li>
      <a href="<?php echo $this->base.'/Expedientes/consulta_expedientes'; ?>" class="menu-node sidebar-item">
       <i class="icon-white icon-large"></i> 
        <span>Rango Expedientes</span>
      </a>
     </li>
-->
     <li>
      <a href="<?php echo $this->base.'/Expedientes/consulta_juzgado'; ?>" class="menu-node sidebar-item">
       <i class="icon-white icon-large"></i> 
        <span>Juzgado</span>
      </a>
     </li>
    </ul>
   </li>
   <li>
    <a href="<?php echo $this->base.'/Expedientes/add'; ?>" class="separator sidebar-item">
     <i class="icon-white icon-large"></i>
     <span>Create</span>
    </a>
   </li>
 </ul></li>

<li><a href="#" class="menu-content hasChild dropdown-close sidebar-item"><i class="icon-file-alt icon-large icon-large"></i> 
  <span>Etapa</span></a>
  <ul class="nav nav-stacked sub-nav  submenu-content">
   <li>
    <a href="<?php echo $this->base.'/Stages/'; ?>" class="separator sidebar-item">
     <i class="icon-white icon-large"></i>
     <span>List</span>
    </a>
   </li>
   <li>
    <a href="<?php echo $this->base.'/Stages/add'; ?>" class="separator sidebar-item">
     <i class="icon-white icon-large"></i>
     <span>Create</span>
    </a>
   </li>
</ul></li>


  <li><a href="#" class="menu-menus hasChild dropdown-close sidebar-item current"><i class="icon-sitemap icon-large icon-large"></i> <span>Partes</span></a>
   <ul class="nav nav-stacked sub-nav  submenu-menus">
    <li><a href="<?php echo $this->base.'/Partes/'; ?>" class="separator sidebar-item"><i class="icon-white icon-large"></i> 
     <span>List</span></a></li>
    <li><a href="<?php echo $this->base.'/Partes/add'; ?>" class="separator sidebar-item"><i class="icon-white icon-large"></i> 
     <span>Create</span></a></li>
   </ul>
  </li>


 <li><a href="#" class="menu-blocks hasChild dropdown-close sidebar-item">
   <i class="icon-money icon-large icon-large"></i> <span>Pagos</span></a>
   <ul class="nav nav-stacked sub-nav  submenu-menus">
    <li><a href="<?php echo $this->base.'/Pagos/'; ?>" class="separator sidebar-item"><i class="icon-white icon-large"></i> 
     <span>List</span></a>
    </li>
    <li><a href="<?php echo $this->base.'/Pagos/add'; ?>" class="separator sidebar-item"><i class="icon-white icon-large"></i> 
      <span>Create</span></a>
    </li>
    </ul></li>



<li><a href="#" class="menu-blocks hasChild dropdown-close sidebar-item"><i class="icon-columns icon-large icon-large"></i> <span>Catalogos</span></a>
 <ul class="nav nav-stacked sub-nav  submenu-blocks">
  <li><a href="<?php echo $this->base.'/Juzgados/'; ?>" class="menu-regions sidebar-item"><i class="icon-white icon-large">
  </i> 
   <span>Juzgados</span></a>
  </li>
  <li><a href="<?php echo $this->base.'/Municipios/'; ?>" class="menu-regions sidebar-item"><i class="icon-white icon-large">
  </i> 
   <span>Municipios</span></a></li>
  <li><a href="<?php echo $this->base.'/TipoCreditos/'; ?>" class="menu-blocks sidebar-item"><i class="icon-white icon-large"></i> 
   <span>Tipo de Creditos</span></a>
  </li>
  <li><a href="<?php echo $this->base.'/Materias/'; ?>" class="menu-regions sidebar-item"><i class="icon-white icon-large"></i> 
  <span>Tipo de Juicios</span></a></li>
 </ul>
</li>


<li>
 <a href="#" class="menu-users hasChild dropdown-close sidebar-item">
  <i class="icon-user icon-large icon-large"></i> 
  <span>Users</span>
 </a>
 <ul class="nav nav-stacked sub-nav  submenu-users">
  <li>
   <a href="<?php echo $this->base.'/Users/'; ?>" class="menu-users sidebar-item">
    <i class="icon-white icon-large"></i> 
    <span>Users</span>
   </a>
  </li>
 </ul>
</li>


</li></ul>	





	</div>
</nav>

