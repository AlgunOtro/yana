<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Detalle
 *
 * This model represents user authentication data. It operates the following tables:
 * - detalle,
 * - maestro
 *
 * @package	Yana
 * @author	Byron Oña
 */
class Detalle_model extends MY_Modelo_Base {

	public $nombre_tabla = 'detalle';
	
	function __construct() {
		parent::__construct();
	}

	/**
	 * Inserta datos del grid
	 *
	 * @return	object
	 */
	function insertar() {
		$col_text_10 = isset($_POST['col_text_10']) ? strval($this->security->xss_clean($_POST['col_text_10'])) : '';
		$col_int = isset($_POST['col_int']) ? intval($this->security->xss_clean($_POST['col_int'])) : 0;
		$col_double = isset($_POST['col_double']) ? doubleval($this->security->xss_clean($_POST['col_double'])) : 0;

		$data = array(
			'col_text_10' => $col_text_10,
			'col_int' => $col_int,
			'col_double' => $col_double
		);
		$resultado = $this->db->insert($this->nombre_tabla, $data);
		return $resultado;
	}

	/**
	 * Actualiza datos del grid
	 *
	 * @return	object
	 */
	function actualizar() {
		$id = isset($_POST['id']) ? intval($this->security->xss_clean($_POST['id'])) : 0;
		$col_text_10 = isset($_POST['col_text_10']) ? strval($this->security->xss_clean($_POST['col_text_10'])) : '';
		$col_int = isset($_POST['col_int']) ? intval($this->security->xss_clean($_POST['col_int'])) : 0;
		$col_double = isset($_POST['col_double']) ? doubleval($this->security->xss_clean($_POST['col_double'])) : 0;

		$data = array(
			'col_text_10' => $col_text_10,
			'col_int' => $col_int,
			'col_double' => $col_double
		);
		$this->db->where('id', $id);
		$resultado = $this->db->update($this->nombre_tabla, $data);
		return $resultado;
	}

	/**
	 * Elimina datos del grid
	 *
	 * @return	object
	 */
	function eliminar() {
		$id = isset($_POST['id']) ? intval($this->security->xss_clean($_POST['id'])) : 0;
		$this->db->where('id', $id);
		$resultado = $this->db->delete($this->nombre_tabla);
		return $resultado;
	}

	/**
	 * Obtiene todos los registros.
	 *
	 * @return	object
	 */
	function obtener() {
		$maestro_id = isset($_POST['id']) ? intval($this->security->xss_clean($_POST['id'])) : 0;
		$this->db->from($this->nombre_tabla)->where('maestro_id',$maestro_id);
		$resultado = $this->db->get();
		return $resultado->result_array();
	}
}

/* End of file detalle_model.php */
/* Location: ./application/models/detalle_model.php */