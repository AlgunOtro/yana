<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Tabla
 *
 * This model represents user authentication data. It operates the following tables:
 * - user account data,
 * - user profiles
 *
 * @package	Tank_auth
 * @author	Byron Oña
 */
class Tabla_model extends CI_Model
{
	private $table_name			= 'tabla';

	function __construct() {
		parent::__construct();
		$ci =& get_instance();
		$this->table_name			= $ci->config->item('db_table_prefix', 'tank_auth').$this->table_name;
	}

	/**
	 * Obtiene todos los registros.
	 *
	 * @return	object
	 */
	function obtener_todo() {
		$this->db->from($this->table_name);
		$query = $this->db->get();
		return $query->result_array();
	}

	/**
	 * Obtener numero de registros en la tabla.
	 *
	 * @return	int
	 */
	function num_registros() {
		$this->db->from($this->table_name);
		return $this->db->count_all_results();
	}

	/**
	 * Guardar un registro en la BD
	 *
	 * @return bool
	 */
	function guardar() {
		$data = array(
			'col1' => $this->input->post('col1'),
			'col2' => $this->input->post('col2'),
			'col3' => $this->input->post('col3')
			);
		return $this->db->insert($this->table_name, $data);
	}
}

/* End of file tabla_model.php */
/* Location: ./application/models/tabla_model.php */