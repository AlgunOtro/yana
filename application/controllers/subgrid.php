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
     * Recupera desde la BD los datos existentes en formato JSON
     * 
     * @return void
     */
    function obtener_detalle() {
        $modelo = 'detalle_model';
        $this->load->model($modelo);
        
        $resultado = array();
        $resultado['total'] = $this->$modelo->num_registros();
        $resultado['rows'] = $this->$modelo->obtener();
        echo json_encode($resultado);
    }
}

/* End of file subgrid.php */
/* Location: ./application/controllers/subgrid.php */