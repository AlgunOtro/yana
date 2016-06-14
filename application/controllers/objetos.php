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
     * Llama a la vista desde la que se cargan los datos.
     *
     * @return void
     */
	function listar()
    {
		$data = array();
		$arr_menu = $this->permiso_acceso->obtener_permisos($this->session->userdata('username'));
		$menu['menu'] = $arr_menu;
		$data = array_merge($data,$menu);

		$this->load->model('usuarios/objetos_model');
		$this->objetos_model->establecer_nombre_tabla('objetos');
		$this->load->view('plantilla/cabecera',$data);
		$this->load->view($this->obtener_nombre_modulo().$this->router->class.'_view',array('total'=>$this->objetos_model->num_registros()));
        $this->load->view('plantilla/pie');
	}
}

/* End of file objetos.php */
/* Location: ./application/controllers/objetos.php */