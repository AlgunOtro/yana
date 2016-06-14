<?php
/**
 * Archivo usuarios.php
 *
 * Contiene la Clase Usuarios que extiende de la Clase MY_Admin_Ctrl
 *
 * @package Atuk\Usuarios
 * @author Byron Oña
 * @copyright © 2015-2016 Byron Oña
 * @license GPL
 * @license http://opensource.org/licenses/gpl-license.php GNU Public License
 * @version v1.0.0
 */

/** No acceso directo */
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Controlador Usuarios
 *
 * Permite gestionar los usuarios de la aplicación
 *
 * @package Atuk\Usuarios
 * @author Byron Oña
 * @version v1.0.0
 */
class Usuarios extends MY_Admin_Ctrl
{
	/**
	 * Constructor
	 *
	 * Carga la clase padre MY_Admin_Ctrl
	 *
     * @return	void
	 */
	function __construct()
	{
		parent::__construct();
		$this->establecer_nombre_modulo('usuarios/');
	}

	/**
	 * Index
	 *
     * Redirecciona al método listar() para mostrar los datos
     *
     * @return void
     */
	function index()
	{
		redirect($this->router->class.'/listar');
	}
}

/* End of file usuarios.php */
/* Location: ./application/controllers/usuarios.php */