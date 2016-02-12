<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Edatagrid extends CI_Controller {

	/**
	 * Controlador Edatagrid
	 *
	 * @author Byron Oña byr_070@hotmail.com
	 */
	public function index() {
		redirect('edatagrid/ver');
	}

	/**
	 * Obtiene los datos y los envia a la vista.
	 *
	 *@param void
	 *@return void
	 */
	function obtener_data() {
		$resultado = array('total' => 2, 'rows' => array( array('id' => '1','nombre' => 'Alguien','ci_ruc' => '0000000000','telefono' => '0000000000','direccion' => 'Algún sitio'),array('id' => '2','nombre' => 'Alguien Más','ci_ruc' => '0000000000','telefono' => '0000000000','direccion' => 'Otro sitio') ) );
		echo json_encode($resultado);
	}

	/**
	 * Llamada a las vistas
	 *
	 *@param void
	 *@return void
	 */
	function ver() {
		$this->load->view('plantilla/cabecera');
		$this->load->view('edatagrid');
		$this->load->view('plantilla/pie');
	}
}

/* End of file edatagrid.php */
/* Location: ./application/controllers/edatagrid.php */