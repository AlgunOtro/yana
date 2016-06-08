<?php
/**
 * Archivo operaciones_model.php
 *
 * Contiene la Clase Operaciones_model que extiende de la Clase MY_Admin_Model
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
 * Modelo Operaciones
 *
 * Representa los datos de las operaciones. Opera con las siguientes tablas:
 * - operaciones
 *
 * @package Atuk\Usuarios
 * @author Byron Oña
 * @version v1.0.0
 */
class Operaciones_model extends MY_Admin_Model {

    function __construct() {
        parent::__construct();
    }
}

/* End of file operaciones_model.php */
/* Location: ./application/models/usuarios/operaciones_model.php */