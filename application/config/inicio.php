<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

$config['login_settings'] =  array(
	'nombre' => array(
		'field' => 'nombre',
		'label' => 'Nombre',
		'rules' => 'trim|required|xss_clean|max_length[40]'
		),
	'clave' => array(
		'field' => 'clave',
		'label' => 'Clave',
		'rules' => 'trim|required|xss_clean|max_length[100]|callback__check_ad'
		)
	);

/* End of file inicio.php */
/* Location: ./application/config/inicio.php */