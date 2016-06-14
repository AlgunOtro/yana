<?php
/**
 * Archivo objetos_model.php
 *
 * Contiene la Clase Objetos_model que extiende de la Clase MY_Admin_Model
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
 * Modelo Objetos
 *
 * Representa los datos de los objetos. Opera con las siguientes tablas:
 * - objetos
 *
 * @package Atuk\Usuarios
 * @author Byron Oña
 * @version v1.0.0
 */
class Objetos_model extends MY_Admin_Model
{
	/**
	 * Constructor
	 *
	 * Carga la clase padre MY_Admin_Model
	 *
     * @return	void
	 */
    function __construct()
    {
        parent::__construct();
    }
}

/* End of file objetos_model.php */
/* Location: ./application/models/usuarios/objetos_model.php */