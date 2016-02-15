<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Subgrid extends MY_Controlador_Base {

	/**
	 * Controlador Subgrid.
	 *
	 * @author Byron Oña
	 */
	function __construct(){
		parent::__construct();
	}

	/**
     * Llama a la vista desde la que se cargan los datos.
     *
     * @return void
     */
	function listar() {
        $this->load->view('plantilla/cabecera');
		$this->load->view('test_view');
        $this->load->view('plantilla/pie');
	}
}

/* End of file subgrid.php */
/* Location: ./application/controllers/subgrid.php */