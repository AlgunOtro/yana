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
		$col_date = isset($_POST['col_date']) ? strval($this->security->xss_clean($_POST['col_date'])) : NULL;
		$col_datetime = isset($_POST['col_datetime']) ? strval($this->security->xss_clean($_POST['col_datetime'])) : NULL;
		$maestro_id = isset($_POST['maestro_id']) ? intval($this->security->xss_clean($_POST['maestro_id'])) : NULL;
		$format = 'm/d/Y';
		$col_date = date_create_from_format( $format , $col_date );
		$col_date = $col_date->format('Y-m-d');
		$format = 'm/d/Y H:i:s';
		$col_datetime = date_create_from_format( $format , $col_datetime );
		$col_datetime = $col_datetime->format('Y-m-d H:i:s');
		$data = array(
			'col_date' => $col_date,
			'col_datetime' => $col_datetime,
			'maestro_id' => $maestro_id
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
		$col_date = isset($_POST['col_date']) ? strval($this->security->xss_clean($_POST['col_date'])) : NULL;
		$col_datetime = isset($_POST['col_datetime']) ? strval($this->security->xss_clean($_POST['col_datetime'])) : NULL;
		$maestro_id = isset($_POST['maestro_id']) ? intval($this->security->xss_clean($_POST['maestro_id'])) : NULL;

		$data = array(
			'col_date' => $col_date,
			'col_datetime' => $col_datetime,
			'maestro_id' => $maestro_id
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