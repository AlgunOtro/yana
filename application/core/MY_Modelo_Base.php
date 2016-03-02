<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class MY_Modelo_Base extends CI_Model {

	/**
	 * Modelo Base
	 *
	 * @author Byron Oña
	 */
	public $nombre_tabla = 'maestro';

	function __construct() {
		parent::__construct();
		//$ci =& get_instance();
		//$this->nombre_tabla = $ci->config->item('db_table_prefix', 'tank_auth').$this->nombre_tabla;
	}

	/**
	 * Obtiene todos los registros.
	 *
	 * @return	object
	 */
	function obtener_todo() {
		$this->db->from($this->nombre_tabla);
		$resultado = $this->db->get();
		return $resultado->result_array();
	}

	/**
	 * Obtener el número de los registros.
	 *
	 * @return	int
	 */
	function num_registros() {
		$this->db->from($this->nombre_tabla);
		return $this->db->count_all_results();
	}
}

/* End of file MY_Modelo_Base.php */
/* Location: ./application/core/MY_Modelo_Base.php */