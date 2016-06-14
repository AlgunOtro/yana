<?php
/**
 * Archivo intentos_acceso.php
 *
 * Contiene la Clase Intentos_acceso que extiende de la Clase CI_Model
 *
 * @package Atuk\Inicio
 * @author Byron Oña
 * @copyright © 2015-2016 Byron Oña
 * @license GPL
 * @license http://opensource.org/licenses/gpl-license.php GNU Public License
 * @version v1.0.0
 */

/** No acceso directo */
if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Modelo Intentos acceso
 *
 * Este modelo gestiona todos los intentos fallido de inicio de sesión a
 * la aplicación, protege a la aplicación de ataque de fuerza bruta a
 * los usuarios de la base de datos. Opera con las siguientes tablas:
 * - intentos_acceso
 *
 * @package Atuk\Inicio
 * @author Byron Oña
 * @version v1.0.0
 */
class Intentos_acceso extends CI_Model
{
	private $table_name = 'intentos_acceso';

	/**
	 * Constructor
	 *
	 * Carga la instancia de Codeigniter y establece el prefijo
	 * en el nombre de las tablas
	 *
     * @return	void
	 */
	function __construct() {
		parent::__construct();
		$ci =& get_instance();
		$this->table_name = $ci->config->item('db_table_prefix', 'tank_auth').$this->table_name;
	}

	/**
	 * Obtener cantidad intentos
	 *
	 * Get number of attempts to login occured from given IP-address or login
	 *
	 * @param	string	$direccion_ip	Dirección IP
	 * @param	string	$user			Nombre del usuario actual
	 * @return	int
	 */
	function obtener_cantidad_intentos($direccion_ip, $user) {
		$this->db->select('1', FALSE);
		$this->db->where('DIRECCION_IP', $direccion_ip);
		if (strlen($user) > 0) $this->db->where('USUARIO', $user);
		$qres = $this->db->get($this->table_name);
		if($qres){
			return $qres->num_rows();
		} else {
			return 0;
		}

		/* Código para Oracle 11g
		--------------------------
		$query = "SELECT 1 FROM ".$this->table_name." WHERE DIRECCION_IP = '".$direccion_ip."'";
		if( strlen($user) > 0 ) {
			$query .= " AND USUARIO = '".$user."'";
		}
		$res = $this->db->query($query);
		if($qres){
			return $qres->num_rows();
		} else {
			return 0;
		}*/
	}

	/**
	 * Incrementar intento
	 *
	 * Increase number of attempts for given IP-address and login
	 *
	 * @param	string	$direccion_ip	Dirección IP
	 * @param	string	$user			Nombre del usuario actual
	 * @return	bool
	 */
	function incrementar_intento($direccion_ip, $user) {
        $user_agent = $this->input->user_agent();
		return $this->db->insert($this->table_name, array('DIRECCION_IP' => $direccion_ip, 'USUARIO' => $user,'USER_AGENT' => $user_agent));

		/* Código para Oracle 11g
		--------------------------
		$now = new DateTime('now');
        $now->setTimeZone(new DateTimeZone("America/Guayaquil"));
        $fecha_hora = $now->format('d/m/Y H:i:s');
        $user_agent = $this->input->user_agent();
        return $this->db->query("INSERT INTO ".$this->table_name." (DIRECCION_IP,USUARIO,FECHA,USER_AGENT) VALUES ('".$direccion_ip."','".$user."',TO_DATE('".$fecha_hora."','DD/MM/YYYY HH24:MI:SS'),'".$user_agent."')");*/
	}

	/**
	 * Limpiar intentos
	 *
	 * Clear all attempt records for given IP-address and login.
	 * Also purge obsolete login attempts (to keep DB clear).
	 *
	 * @param	string	$direccion_ip	Dirección IP
	 * @param	string	$user			Nombre del usuario actual
	 * @param	int		$expire_period	Tiempo de expiración de intentos fallidos
	 * @return	bool
	 */
	function limpiar_intentos($direccion_ip, $user, $expire_period = 86400) {
		$this->db->where(array('DIRECCION_IP' => $direccion_ip, 'USUARIO' => $user));
		// Purge obsolete login attempts
		$this->db->or_where('UNIX_TIMESTAMP(FECHA) <', time() - $expire_period);
		$res = $this->db->delete($this->table_name);
		return $res;

		/* Código para Oracle 11g
		--------------------------
		return $this->db->query("DELETE FROM ".$this->table_name." WHERE (DIRECCION_IP = '".$direccion_ip."' AND USUARIO = '".$user."') OR ((FECHA - TO_DATE('01-01-1970','DD-MM-YYYY')) * (86400)) <".(time() - $expire_period));*/
	}
}

/* End of file intentos_acceso.php */
/* Location: ./application/models/inicio/intentos_acceso.php */