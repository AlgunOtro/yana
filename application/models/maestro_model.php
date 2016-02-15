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
		$col_text_10 = isset($_POST['col_text_10']) ? strval($_POST['col_text_10']) : 'QQQQ';
		$col_int = isset($_POST['col_int']) ? intval($_POST['col_int']) : 10;
		$col_double = isset($_POST['col_double']) ? doubleval($_POST['col_double']) : 646;

		$data = array(
			'col_text_10' => $col_text_10,
			'col_int' => $col_int,
			'col_double' => $col_double
		);
		$resultado = $this->db->insert($this->nombre_tabla, $data);
		var_dump($this->db->last_query());
		return $resultado;
	}

	/**
	 * Actualiza datos del grid
	 *
	 * @return	object
	 */
	function actualizar() {
		$id = isset($_POST['id']) ? intval($_POST['id']) : 0;
		$nombre = isset($_POST['nombre']) ? strval($_POST['nombre']) : '';
		$telefono = isset($_POST['telefono']) ? strval($_POST['telefono']) : '';
		$direccion = isset($_POST['direccion']) ? strval($_POST['direccion']) : '';
		$ci_ruc = isset($_POST['ci_ruc']) ? strval($_POST['ci_ruc']) : '';

		$data = array(
			'nombre' => $nombre,
			'telefono' => $telefono,
			'direccion' => $direccion,
			'ci_ruc' => $ci_ruc
		);
		$this->db->where('id', $id);
		$resultado = $this->db->update($this->nombre_tabla, $data); 
		return $resultado;
	}
}

/* End of file maestro_model.php */
/* Location: ./application/models/maestro_model.php */