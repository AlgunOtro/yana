<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Usuarios extends MY_Admin_Ctrl {
	/**
     * Controlador Usuarios
     *
     * @author Byron Oña
     */

	function __construct(){
		parent::__construct();
	}

	function index() {
		redirect($this->router->class.'/listar');
	}
}

/* End of file usuarios.php */
/* Location: ./application/controllers/usuarios.php */