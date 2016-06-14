<?php echo doctype('html5');?>
<html lang="es">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title><?php echo $this->lang->line('titulo'); ?></title>
  <?php echo link_tag('assets/imagenes/favicon.ico','icon','image/x-icon');?>
  <?php echo link_tag('assets/css/inicio.css');?>
  <?php echo link_tag('assets/easyui/themes/bootstrap/easyui.css');?>
  <?php echo link_tag('assets/easyui/themes/color.css');?>
  <?php echo link_tag('assets/easyui/themes/icon.css');?>
</head>
<body>
  <?php $attributes = array('class' => 'well','autocomplete'=>'off'); ?>
  <?php echo form_open('inicio/login',$attributes); ?>
  <img id="logo" src="<?php echo base_url('assets/imagenes/logo.png');?>">
  <input type="text" name="nombre" value="<?php echo set_value('nombre'); ?>" placeholder="Nombre" class="form-control" />
  <div style="color:red;"><?php echo form_error('nombre'); ?></div>
  <input type="password" name="clave" value="<?php echo set_value('clave'); ?>" placeholder="Clave" class="form-control" />
  <div style="color: red;"><?php echo form_error('clave'); ?></div>
  <input type="submit" name="submit" id="submit" value="Entrar" class="btn btn-success"/>
  <?php echo form_close(); ?>
  <script type="text/javascript" src="<?php echo base_url("assets/js/jquery.min.js") ?>"></script>
  <script type="text/javascript" src="<?php echo base_url("assets/js/jquery.easyui.min.js") ?>"></script>
  <script type="text/javascript" src="<?php echo base_url("assets/js/easyui-lang-es.js") ?>"></script>
</body>
</html>