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
		$this->load->model('tabla_model');
		$page = isset($_POST['page']) ? intval($_POST['page']) : 1;
		$rows = isset($_POST['rows']) ? intval($_POST['rows']) : 10;
		$offset = ($page-1)*$rows;
		$sort = isset($_POST['sort']) ? strval($_POST['sort']) : 'id';
		$order = isset($_POST['order']) ? strval($_POST['order']) : 'asc';
		$result = array();
		$result["total"] = $this->tabla_model->num_registros();
		$result["rows"] = $this->tabla_model->obtener_todo();
		echo json_encode($result);
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

	/**
	 * Guardar datos
	 *
	 * @return void
	 */
	function guardar_data() {
		$this->load->model('tabla_model');
		if( $this->tabla_model->guardar() ) {
			$resultado = array('success' => true);
		} else {
			$resultado = array(
				'isError' => true,
				'message' => 'ERROR: No se guardaron los datos.'
				);
		}
		echo json_encode($resultado);
	}
}

/* End of file edatagrid.php */
/* Location: ./application/controllers/edatagrid.php */