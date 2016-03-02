<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title><?php echo 'Yana - '.ucfirst($this->router->class); ?></title>
    <link rel="shortcout icon" href="<?php echo base_url("assets/imagenes/favicon.ico") ?>">
    <!--
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
    -->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url("assets/easyui/themes/default/easyui.css"); ?>" />
    <link rel="stylesheet" type="text/css" href="<?php echo base_url("assets/easyui/themes/icon.css"); ?>" />
    <link rel="stylesheet" type="text/css" href="<?php echo base_url("assets/css/estilos.css"); ?>" />
</head>
<body class="easyui-layout">
    <div data-options="region:'north'" style="height:auto;margin:0;border:0;padding:0;">
        <nav class="navbar navbar-inverse" style="margin:0">
          <div class="container-fluid">
            <div class="navbar-header">
                <a class="navbar-brand" href="#">SIGEP</a>
            </div>
            <ul class="nav navbar-nav">
              <li><a href="/yana">Inicio</a></li>
              <li><a href="subgrid">Subgrid</a></li> 
          </ul>
          <ul class="nav navbar-nav navbar-right">
              <li><a href="#"><span class="glyphicon glyphicon-cog"></span></a></li>
              <li><a href="#"><span class="glyphicon glyphicon-log-out"></span> Salir</a></li>
          </ul>
      </div>
  </nav>
  <!--<p class="header" align="center"><?php //echo 'Plataforma Base';?></p>-->
</div>
<div data-options="region:'south'" style="height:30px;">
    <p class="footer">Página mostrada en <strong>{elapsed_time}</strong> segundos</p>
</div>
<div data-options="region:'west',hideCollapsedContent:false" class="Menu" title="Menú" style="width:100px;">
    <a id="btn" style="width:100%" href="<?php echo base_url();?>" class="easyui-linkbutton" plain="true">Inicio</a>
    <a id="btn" style="width:100%" href="<?php echo base_url('subgrid');?>" class="easyui-linkbutton" plain="true">Subgrid</a>
</div>
<div class="principal" data-options="region:'center'" style="padding:4px;">