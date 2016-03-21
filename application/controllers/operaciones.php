<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Operaciones extends MY_Admin_Ctrl {
	/**
     * Controlador Operaciones
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

/* End of file operaciones.php */
/* Location: ./application/controllers/operaciones.php */