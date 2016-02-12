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
    <div data-options="region:'north'" style="height:38px">
        <p class="header" align="center"><?php echo 'Plataforma Base';?></p>
    </div>
    <div data-options="region:'south'" style="height:30px;">
        <p class="footer">Página mostrada en <strong>{elapsed_time}</strong> segundos</p>
    </div>
    <div data-options="region:'west',hideCollapsedContent:false" class="Menu" title="Menú" style="width:100px;">
        <a id="btn" style="width:100%" href="<?php echo base_url();?>" class="easyui-linkbutton">Inicio</a>
        <a id="btn" style="width:100%" href="<?php echo base_url('edatagrid');?>" class="easyui-linkbutton">Edatagrid</a>
    </div>
    <div class="principal" data-options="region:'center'" style="padding:4px;">