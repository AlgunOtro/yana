<?php echo doctype('html5');?>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title><?php echo $this->lang->line('titulo').' - '.$this->lang->line('aplicacion'); ?></title>
    <?php echo link_tag('assets/imagenes/favicon.ico','icon','image/x-icon');?>
    <?php echo link_tag('assets/css/inicio.css');?>
    <?php echo link_tag('assets/easyui/themes/default/easyui.css');?>
    <?php echo link_tag('assets/easyui/themes/color.css');?>
    <?php echo link_tag('assets/easyui/themes/icon.css');?>
    <?php echo link_tag('assets/css/estilos.css');?>
    <?php echo link_tag('assets/css/carro.css');?>
</head>
<body class="easyui-layout">
    <div class="norte" data-options="region:'north',border:false" style="height:38px">
        <p class="header" style="float:left;align:left;">
            <?php echo $this->lang->line('aplicacion_det').' - '.$this->lang->line('ambiente');?>
        </p>
        <div style="display:block;margin:auto;text-align:right;">
            <?php echo $this->lang->line('saludo').$this->session->userdata('username').nbs(4);?>
            <?php echo anchor('inicio',' ',array('class' => 'easyui-linkbutton','data-options' => "iconCls:'icon-inicio',plain:true"));?>
            <?php if ($this->permiso_acceso->es_admin($this->session->userdata('username'))): ?>
                <?php echo anchor('#',' ',array('class' => 'easyui-menubutton','data-options' => "iconCls:'icon-usuario',menu:'#mm2',hasDownArrow:false"));?>
                <?php echo anchor('#',' ',array('class' => 'easyui-menubutton','data-options' => "iconCls:'icon-config',menu:'#mm1',hasDownArrow:false"));?>
            <?php endif; ?>
            <?php echo anchor('inicio/salir',' ',array('class' => 'easyui-linkbutton','data-options'=>"iconCls:'icon-salir',plain:true"));?>
        </div>
    </div>
    <?php if ($this->permiso_acceso->es_admin($this->session->userdata('username'))): ?>
        <div id="mm1" style="width:auto;">
            <div onclick="javascript:window.location.href='<?php echo base_url("inspecciones");?>';">Inspecciones</div>
            <div onclick="javascript:window.location.href='<?php echo base_url("areas");?>';">Áreas</div>
            <div onclick="javascript:window.location.href='<?php echo base_url("items");?>';">Ítems</div>
            <div onclick="javascript:window.location.href='<?php echo base_url("coordenadas");?>';">Coordenadas</div>
            <div class="menu-sep"></div>
            <div onclick="javascript:window.location.href='<?php echo base_url("fallas");?>';">Fallas</div>
            <div onclick="javascript:window.location.href='<?php echo base_url("severidades");?>';">Severidades</div>
            <div class="menu-sep"></div>
            <div>
                <span>Asignación</span>
                <div>
                    <div onclick="javascript:window.location.href='<?php echo base_url("inspecciones/inspeccion_area");?>';">Inspecciones - Áreas</div>
                    <div onclick="javascript:window.location.href='<?php echo base_url("inspecciones/inspeccion_item");?>';">Inspecciones - Ítems</div>
                    <div onclick="javascript:window.location.href='<?php echo base_url("inspecciones/area_item");?>';">Áreas - Ítems</div>
                    <div onclick="javascript:window.location.href='<?php echo base_url("inspecciones/item_coordenada");?>';">Ítems - Coordenadas</div>
                    <div onclick="javascript:window.location.href='<?php echo base_url("inspecciones/falla_severidad");?>';">Fallas - Severidades</div>
                </div>
            </div>
            <div class="menu-sep"></div>
            <div>
                <span>Visualización</span>
                <div>
                    <div onclick="javascript:window.location.href='<?php echo base_url("inspecciones/item_coordenadas");?>';">Ítems - Coordenadas</div>
                </div>
            </div>
        </div>
    
        <div id="mm2" style="width:auto;">
            <?php foreach ($menu as $key => $objeto) : ?>
                <?php if ($objeto['tipo'] == 'app' AND $objeto['menu'] == 2) : ?>
                    <div onclick="javascript:window.location.href='<?php echo base_url($objeto['enlace']);?>';"><?php echo $objeto['nombre'];?></div>
                <?php endif; ?>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
    <div data-options="region:'south',border:false" style="height:30px;">
        <p class="footer">Página mostrada en <strong>{elapsed_time}</strong> segundos</p>
    </div>

    <div class="Menu" data-options="region:'west',hideCollapsedContent:false,border:false" class="Menu" title="Menú" style="width:105px;">
        <?php foreach ($menu as $key => $objeto) : ?>
            <?php if ($objeto['tipo'] == 'app' AND $objeto['menu'] == 0) : ?>
                <?php echo anchor('/'.strtolower($objeto['enlace']).'/',$objeto['nombre'],array('class' => 'easyui-linkbutton','style' => 'width:100%','data-options' => 'plain:true')); ?>
            <?php elseif ($objeto['tipo'] == 'bi' AND $objeto['menu'] == 0) : ?>
                <a class="easyui-linkbutton" href="http://cenepa/QvAJAXZfc/opendoc.htm?document=<?php echo $objeto['enlace']; ?>&host=QVS@cenepa"><?php echo $objeto['nombre']; ?></a>
            <?php endif; ?>
        <?php endforeach; ?>
		<a style="width:100%" href="<?php echo base_url();?>" class="easyui-linkbutton" data-options="plain:true">Inicio</a>
        <a style="width:100%" href="<?php echo base_url('subgrid');?>" class="easyui-linkbutton" data-options="plain:true">Subgrid</a>
        <a style="width:100%" href="<?php echo base_url('compras');?>" class="easyui-linkbutton" data-options="plain:true">Carrito</a>
        <a style="width:100%" href="<?php echo base_url('proyectos');?>" class="easyui-linkbutton" data-options="plain:true">Proyectos</a>
        <a style="width:100%" href="<?php echo base_url('proyectos/editar');?>" class="easyui-linkbutton" data-options="plain:true">Editar Proyectos</a>
        <a style="width:100%" href="<?php echo base_url('elementos/editar');?>" class="easyui-linkbutton" data-options="plain:true">Editar Elementos</a>
    </div>