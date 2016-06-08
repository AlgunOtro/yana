<?php
/**
 * Archivo objetos.php
 *
 * Contiene la Clase Objetos que extiende de la Clase MY_Admin_Ctrl
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
 * Controlador Objetos
 *
 * Permite gestionar los objetos
 *
 * @package Atuk\Usuarios
 * @author Byron Oña
 * @version v1.0.0
 */
class Objetos extends MY_Admin_Ctrl
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

/* End of file objetos.php */
/* Location: ./application/controllers/objetos.php */