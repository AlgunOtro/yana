<?php
/**
 * Archivo permisos.php
 *
 * Contiene la Clase Permisos que extiende de la Clase MY_Admin_Ctrl
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
 * Controlador Permisos
 *
 * Permite gestionar los permisos de la aplicación
 *
 * @package Atuk\Usuarios
 * @author Byron Oña
 * @version v1.0.0
 */
class Permisos extends MY_Admin_Ctrl
{
    /**
     * Constructor
     *
     * Carga la clase padre MY_Admin_Ctrl
     *
     * @return  void
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

    /**
     * Eliminar data
     *
     * Eliminar un registro en la base de datos
     *
     * @return void
     */
    function eliminar_data()
    {
        $this->load->model('usuarios/permisos_model');
        //Recuperar los errores desde el modelo
        $resultados = $this->permisos_model->eliminar();
        if ($resultados === TRUE)
        {
            $arr_res = array('success' => TRUE);
        }
        else
        {
            $arr_res = array('isError' => TRUE,'msg' => $resultados);
        }
        echo json_encode($arr_res);
    }
}

/* End of file permisos.php */
/* Location: ./application/controllers/permisos.php */