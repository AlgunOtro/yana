<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class MY_Admin_Model extends CI_Model {
	/**
     * Modelo Base Administración
     *
     * @author Byron Oña
     */
	private $tiene_acceso = NULL;

	public function __construct(){
		parent::__construct();

		$this->lang->load('sigep','spanish');
		$this->load->model('inicio/permiso_acceso');
		if( $this->session->userdata('logged_in') ) {
			if( ! $this->permiso_acceso->tiene_acceso( $this->router->class, $this->session->userdata('username') ) ) {
				redirect('inicio');
			}
		} else {
            redirect('inicio');
        }
	}
}

/* End of file MY_Admin_Model.php */
/* Location: ./application/core/MY_Admin_Model.php */