<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Permiso_acceso
 *
 * This model serves to watch on all attempts to login on the site
 * (to protect the site from brute-force attack to user database)
 *
 * @author	Byron Oña
 */
class Permiso_acceso extends CI_Model
{
	private $table_name_usuarios = 'USUARIOS';
	private $table_name_roles = 'ROLES';
	private $table_name_usu_rol = 'USUARIOS_ROLES';
	private $table_name_permisos = 'PERMISOS';
	private $table_name_objetos = 'OBJETOS';
	private $table_name_operaciones = 'OPERACIONES';
	private $table_name_rol_per = 'ROLES_PERMISOS';
	private $campo_usuario = 'USUARIO';
	private $directorio_activo = 1;

	function __construct() {
		parent::__construct();
		log_message('debug', 'Clase Modelo Permiso_acceso Iniciado');
		$ci =& get_instance();
		$this->table_name_usuarios = $ci->config->item('db_table_prefix', 'tank_auth').$this->table_name_usuarios;
	}

	/**
	 * Obtener permisos dado un usuario
	 *
	 * @param	string
	 * @return	array
	 */
	function obtener_permisos($usuario) {

		$query = "SELECT T5.NOMBRE NOMBRE,T5.TIPO TIPO,T5.ENLACE ENLACE FROM ".$this->table_name_usuarios." T0 JOIN ".$this->table_name_usu_rol." T1 ON T0.ID = T1.FK_USUARIO_ID JOIN ".$this->table_name_roles." T2 ON T1.FK_ROL_ID = T2.ID JOIN ".$this->table_name_rol_per." T3 ON T2.ID = T3.FK_ROL_ID JOIN ".$this->table_name_permisos." T4 ON T3.FK_PERMISO_ID = T4.ID JOIN ".$this->table_name_objetos." T5 ON T4.FK_OBJETO_ID = T5.ID JOIN ".$this->table_name_operaciones." T6 ON T4.FK_OPERACION_ID = T6.ID WHERE T0.".$this->campo_usuario." = '".$usuario."' AND T6.OPERACION='ver' AND T1.DIRECTORIO_ACTIVO = ".$this->directorio_activo." ORDER BY T5.ID";
		$res = $this->db->query($query);
		if($res){
			return $res->result_array();
		} else {
			return 0;
		}
	}

	/**
	 * Verifica si el usuario tiene acceso al módulo
	 *
	 * @param	string	módulo
	 * @param	string	usuario
	 * @return	bool
	 */
	function tiene_acceso($modulo,$usuario) {
		if( $this->config->item("tiene_directorio_activo") ){
			//echo 'siga como antes';
			$this->campo_usuario = 'USUARIO';
		} else {
			//echo 'nada';
			$this->table_name_usuarios = 'USERS';
			$this->campo_usuario = 'username';
			$this->directorio_activo = 0;
		}
		$query="SELECT 1 FROM ".$this->table_name_usuarios." T0 JOIN ".$this->table_name_usu_rol." T1 ON T0.ID = T1.FK_USUARIO_ID JOIN ".$this->table_name_roles." T2 ON T1.FK_ROL_ID = T2.ID JOIN ".$this->table_name_rol_per." T3 ON T2.ID = T3.FK_ROL_ID JOIN ".$this->table_name_permisos." T4 ON T3.FK_PERMISO_ID = T4.ID JOIN ".$this->table_name_objetos." T5 ON T4.FK_OBJETO_ID = T5.ID JOIN ".$this->table_name_operaciones." T6 ON T4.FK_OPERACION_ID = T6.ID WHERE T0.".$this->campo_usuario." = '".$usuario."' AND UPPER(T5.ENLACE) = '".mb_strtoupper($modulo)."' AND T6.OPERACION = 'ver' AND T1.DIRECTORIO_ACTIVO = ".$this->directorio_activo."";
		$res = $this->db->query($query);
		//var_dump($this->db->last_query());
		if ($res) {
			if ( $res->num_rows() > 0 ) {
				return TRUE;
			}
		}
		return FALSE;
	}

	/**
	 * Verifica si el usuario tiene acceso para leer el módulo
	 *
	 * @param	string	módulo
	 * @param	string	usuario
	 * @return	bool
	 */
	function tiene_acceso_lectura($modulo,$usuario) {
		$query="SELECT 1 FROM ".$this->table_name_usuarios." T0 JOIN ".$this->table_name_usu_rol." T1 ON T0.ID = T1.FK_USUARIO_ID JOIN ".$this->table_name_roles." T2 ON T1.FK_ROL_ID = T2.ID JOIN ".$this->table_name_rol_per." T3 ON T2.ID = T3.FK_ROL_ID JOIN ".$this->table_name_permisos." T4 ON T3.FK_PERMISO_ID = T4.ID JOIN ".$this->table_name_objetos." T5 ON T4.FK_OBJETO_ID = T5.ID JOIN ".$this->table_name_operaciones." T6 ON T4.FK_OPERACION_ID = T6.ID WHERE T0.USUARIO = '".$usuario."' AND UPPER(T5.ENLACE) = '".mb_strtoupper($modulo)."' AND T6.OPERACION = 'leer'";
		$res = $this->db->query($query);
		if ($res) {
			if ( $res->num_rows() > 0 ) {
				return TRUE;
			}
		}
		return FALSE;
	}
}

/* End of file permiso_acceso.php */
/* Location: ./application/models/inicio/permiso_acceso.php */