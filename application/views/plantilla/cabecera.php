<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title><?php echo 'Yana - '.ucfirst($this->router->class); ?></title>
    <link rel="shortcout icon" href="<?php echo base_url("assets/imagenes/favicon.ico") ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url("assets/easyui/themes/default/easyui.css"); ?>" />
    <link rel="stylesheet" type="text/css" href="<?php echo base_url("assets/easyui/themes/icon.css"); ?>" />
    <link rel="stylesheet" type="text/css" href="<?php echo base_url("assets/css/estilos.css"); ?>" />
</head>
<body class="easyui-layout">

    <div class="norte" data-options="region:'north',border:false">
        <p class="header" align='left' style="float:left;">
            <?php echo 'SIGEP - Ambiente Desarrollo';?>
        </p>
        <div style="display:block;margin:auto;text-align:right;">
          <?php echo anchor('inicio',' ',array('class' => 'easyui-linkbutton','data-options' => "iconCls:'icon-inicio',plain:true"));?>
            <?php echo anchor('#',' ',array('class' => 'easyui-menubutton','data-options' => "iconCls:'icon-usuario',menu:'#mm2',hasDownArrow:false"));?>
            <?php echo anchor('#',' ',array('class' => 'easyui-menubutton','data-options' => "iconCls:'icon-config',menu:'#mm1',hasDownArrow:false"));?>
            <?php echo anchor('inicio/salir',' ',array('class' => 'easyui-linkbutton','data-options'=>"iconCls:'icon-salir',plain:true"));?>
        </div>
    </div>
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
                <div onclick="javascript:window.location.href='<?php echo base_url("inspecciones/item_coordenada");?>';">Fallas - Severidades</div>
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
        <div onclick="javascript:window.location.href='<?php echo base_url("usuarios");?>';">Usuarios</div>
        <div onclick="javascript:window.location.href='<?php echo base_url("roles");?>';">Roles</div>
        <div onclick="javascript:window.location.href='<?php echo base_url("permisos");?>';">Permisos</div>
        <div onclick="javascript:window.location.href='<?php echo base_url("objetos");?>';">Objetos</div>
        <div onclick="javascript:window.location.href='<?php echo base_url("operaciones");?>';">Operaciones</div>
    </div>
<div data-options="region:'south',border:false" style="height:30px;">
    <p class="footer">Página mostrada en <strong>{elapsed_time}</strong> segundos</p>
</div>
<div data-options="region:'west',hideCollapsedContent:false,border:false" class="Menu" title="Menú" style="width:100px;">
    <a id="btn" style="width:100%" href="<?php echo base_url();?>" class="easyui-linkbutton" plain="true">Inicio</a>
    <a id="btn" style="width:100%" href="<?php echo base_url('subgrid');?>" class="easyui-linkbutton" plain="true">Subgrid</a>
</div>
<div class="principal" data-options="region:'center',border:false" style="padding:4px;">