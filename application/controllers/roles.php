<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Roles extends MY_Admin_Ctrl {
	/**
     * Controlador Roles
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

/* End of file roles.php */
/* Location: ./application/controllers/roles.php */