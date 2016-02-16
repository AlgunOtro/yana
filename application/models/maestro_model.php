<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Maestro
 *
 * This model represents user authentication data. It operates the following tables:
 * - user account data,
 * - user profiles
 *
 * @package	Yana
 * @author	Byron Oña
 */
class Maestro_model extends MY_Modelo_Base {

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
}

/* End of file maestro_model.php */
/* Location: ./application/models/maestro_model.php */