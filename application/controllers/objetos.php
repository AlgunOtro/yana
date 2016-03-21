<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Objetos extends MY_Admin_Ctrl {
	/**
     * Controlador Objetos
     *
     * @author Byron Oña
     */

	function __construct(){
		parent::__construct();
	}

	function index() {
		redirect($this->router->class.'/listar');
	}

	function probar_modelo() {
		$this->load->model('usuarios/objetos_model');
		var_dump( $this->objetos_model->obtener_id('usuarios') );
		var_dump( $this->objetos_model->existe('usuarios') );
	}
}

/* End of file objetos.php */
/* Location: ./application/controllers/objetos.php */