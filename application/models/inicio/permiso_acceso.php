<?php
/**
 * Archivo permiso_acceso.php
 *
 * Contiene la Clase Permiso_acceso que extiende de la Clase CI_Model
 *
 * @package Atuk\Inicio
 * @author Byron Oña
 * @copyright © 2015-2016 Byron Oña
 * @license GPL
 * @license http://opensource.org/licenses/gpl-license.php GNU Public License
 * @version v1.0.0
 */

/** No acceso directo */
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Modelo Permiso acceso
 *
 * Este modelo representa los datos de permisos de acceso. Opera
 * con las siguientes tablas:
 * - usuarios
 * - roles
 * - usuarios_roles
 * - permisos
 * - objetos
 * - operaciones
 * - roles_permisos
 *
 * @package Atuk\Inicio
 * @author Byron Oña
 * @version v1.0.0
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

	/**
	 * Constructor
	 *
	 * Carga la instancia de Codeigniter y establece el prefijo
	 * en el nombre de las tablas
	 *
     * @return	void
	 */
	function __construct()
	{
		parent::__construct();
		$ci =& get_instance();
		$this->table_name_usuarios = $ci->config->item('db_table_prefix', 'tank_auth').$this->table_name_usuarios;
	}

	/**
	 * Obtener permisos
	 *
	 * Obtiene permisos del usuario actual
	 *
	 * @param	string	$usuario	Nombre del usuario actual
	 * @return	array
	 */
	function obtener_permisos($usuario)
	{
		if( $this->config->item("tiene_directorio_activo") ){
			//echo 'siga como antes';
			$this->campo_usuario = 'USUARIO';
		} else {
			//echo 'nada';
			$this->table_name_usuarios = 'USERS';
			$this->campo_usuario = 'username';
			$this->directorio_activo = 0;
		}
		//$where_usuario = "T0.".$this->campo_usuario." = '".$usuario."'";
		//$query->free_result();
		/*$query = $this->db->select('T5.nombre,T5.tipo,T5.enlace,T5.menu')
						  ->from($this->table_name_usuarios.' T0')
						  ->join($this->table_name_usu_rol.' T1','T0.id = T1.fk_usuario_id')
						  ->join($this->table_name_roles.' T2','T1.fk_rol_id = T2.id')
						  ->join($this->table_name_rol_per.' T3','T2.id = T3.fk_rol_id')
						  ->join($this->table_name_permisos.' T4','T3.fk_permiso_id = T4.id')
						  ->join($this->table_name_objetos.' T5','T4.fk_objeto_id = T5.id')
						  ->join($this->table_name_operaciones.' T6','T4.fk_operacion_id = T6.id')
						  ->where($where_usuario)
						  ->where('T6.operacion','ver')
						  ->where('T1.directorio_activo',$this->directorio_activo)
						  ->order_by('T5.id');*/
		$query = "SELECT T5.nombre,T5.tipo,T5.enlace,T5.menu
			FROM ".$this->table_name_usuarios." T0
			JOIN ".$this->table_name_usu_rol." T1 ON T0.ID = T1.FK_USUARIO_ID
			JOIN ".$this->table_name_roles." T2 ON T1.FK_ROL_ID = T2.ID
			JOIN ".$this->table_name_rol_per." T3 ON T2.ID = T3.FK_ROL_ID
			JOIN ".$this->table_name_permisos." T4 ON T3.FK_PERMISO_ID = T4.ID
			JOIN ".$this->table_name_objetos." T5 ON T4.FK_OBJETO_ID = T5.ID
			JOIN ".$this->table_name_operaciones." T6 ON T4.FK_OPERACION_ID = T6.ID
			WHERE T0.".$this->campo_usuario." = '".$usuario."' AND T6.OPERACION='ver' AND T1.DIRECTORIO_ACTIVO = ".$this->directorio_activo." ORDER BY T5.ID";
		$res = $this->db->query($query);
		if ( $this->config->item("tiene_directorio_activo"))
			var_dump($this->db->last_query());
		if ($res)
		{
			return $res->result_array();
		}
		else
		{
			return 0;
		}
	}

	/**
	 * Tiene acceso
	 *
	 * Verifica si el usuario tiene acceso al módulo
	 *
	 * @param	string	$modulo		Nombre del módulo
	 * @param	string	$usuario	Nombre del usuario actual
	 * @return	bool
	 */
	function tiene_acceso($modulo,$usuario)
	{
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
		if ($res)
		{
			if ($res->num_rows() > 0)
			{
				return TRUE;
			}
		}
		return FALSE;
	}

	/**
	 * Tiene acceso lectura
	 *
	 * Verifica si el usuario actual tiene acceso para leer el módulo
	 *
	 * @param	string	$modulo		Nombre del módulo
	 * @param	string	$usuario	Nombre del usuario actual
	 * @return	bool
	 */
	function tiene_acceso_lectura($modulo,$usuario)
	{
		$query="SELECT 1 FROM ".$this->table_name_usuarios." T0 JOIN ".$this->table_name_usu_rol." T1 ON T0.ID = T1.FK_USUARIO_ID JOIN ".$this->table_name_roles." T2 ON T1.FK_ROL_ID = T2.ID JOIN ".$this->table_name_rol_per." T3 ON T2.ID = T3.FK_ROL_ID JOIN ".$this->table_name_permisos." T4 ON T3.FK_PERMISO_ID = T4.ID JOIN ".$this->table_name_objetos." T5 ON T4.FK_OBJETO_ID = T5.ID JOIN ".$this->table_name_operaciones." T6 ON T4.FK_OPERACION_ID = T6.ID WHERE T0.USUARIO = '".$usuario."' AND UPPER(T5.ENLACE) = '".mb_strtoupper($modulo)."' AND T6.OPERACION = 'leer'";
		$res = $this->db->query($query);
		if ($res)
		{
			if ($res->num_rows() > 0)
			{
				return TRUE;
			}
		}
		return FALSE;
	}

	/**
     * Es admin
     *
     * Verifica si el usuario pertenece a los administradores
     *
     * @param string $usuario Nombre de usuario actual
     *
     * @return bool
     */
    function es_admin($usuario = '')
    {
    	if( $this->config->item("tiene_directorio_activo") ){
			//echo 'siga como antes';
			$this->campo_usuario = 'USUARIO';
		} else {
			//echo 'nada';
			$this->table_name_usuarios = 'USERS';
			$this->campo_usuario = 'username';
			$this->directorio_activo = 0;
		}
    	$this->db->select('1', FALSE)->from($this->table_name_usuarios.' T0')
    	->join($this->table_name_usu_rol.' T1','T0.ID = T1.FK_USUARIO_ID')
    	->join($this->table_name_roles.' T2','T1.FK_ROL_ID = T2.ID')
    	->where('T0.'.$this->campo_usuario.'',$usuario)
    	->like('T2.ROL','admin');
		$qres = $this->db->get();
		if ($qres)
			if ($qres->num_rows() > 0)
				return TRUE;
		return FALSE;
    }
}

/* End of file permiso_acceso.php */
/* Location: ./application/models/inicio/permiso_acceso.php */